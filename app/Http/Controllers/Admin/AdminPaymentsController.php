<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\ActivityLog;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Boarding;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminPaymentsController extends Controller
{
    /**
     * Display the payments management page
     */
    public function index()
    {
        // Stats for cards
        $totalPayments     = Payment::count();
        $completedPayments = Payment::where('status', 'Completed')->count();
        $pendingPayments   = Payment::where('status', 'Pending')->count();
        $totalRevenue      = Payment::where('status', 'Completed')->sum('amount');

        // Inline data eliminates the second AJAX roundtrip on page load
        $paymentsJson = $this->buildPaymentsCollection()->toJson(JSON_HEX_TAG);

        return view('admin.payments', compact(
            'totalPayments',
            'completedPayments',
            'pendingPayments',
            'totalRevenue',
            'paymentsJson'
        ));
    }

    private function buildPaymentsCollection()
    {
        $payments = Payment::with('user')
            ->select('payments.*')
            ->orderBy('created_at', 'desc')
            ->get();

        $appointmentIds = $payments->where('payable_type', 'App\Models\Appointment')->pluck('payable_id');
        $boardingIds    = $payments->where('payable_type', 'App\Models\Boarding')->pluck('payable_id');

        $appointments = $appointmentIds->isNotEmpty()
            ? Appointment::with('service')->whereIn('appointmentID', $appointmentIds)->get()->keyBy('appointmentID')
            : collect();

        $boardings = $boardingIds->isNotEmpty()
            ? Boarding::whereIn('boardingID', $boardingIds)->get()->keyBy('boardingID')
            : collect();

        foreach ($payments as $payment) {
            if ($payment->payable_type === 'App\Models\Appointment') {
                $appointment = $appointments->get($payment->payable_id);
                if ($appointment) {
                    $payment->service_info = ['name' => $appointment->service->name ?? 'Appointment', 'id' => $appointment->appointmentID];
                }
            } elseif ($payment->payable_type === 'App\Models\Boarding') {
                $boarding = $boardings->get($payment->payable_id);
                if ($boarding) {
                    $payment->service_info = ['name' => 'Boarding: ' . $boarding->boardingType, 'id' => $boarding->boardingID];
                }
            }
        }

        return $payments;
    }

    private function resolveAppointmentTotalCost($appointment): float
    {
        $storedTotal = optional(
            $appointment->payments()->whereNotNull('total_cost')->latest('paymentID')->first()
        )->total_cost;

        if ($storedTotal !== null) {
            return (float) $storedTotal;
        }

        return (float) optional($appointment->service)->price;
    }

    private function resolveBoardingTotalCost($boarding): float
    {
        $storedTotal = optional(
            $boarding->payments()->whereNotNull('total_cost')->latest('paymentID')->first()
        )->total_cost;

        if ($storedTotal !== null) {
            return (float) $storedTotal;
        }

        $service = Service::where('category', 'Boarding')
            ->where('name', 'LIKE', '%' . $boarding->boardingType . '%')
            ->first();

        $days = Carbon::parse($boarding->start_date)->diffInDays(Carbon::parse($boarding->end_date)) + 1;
        if ($boarding->boardingType === 'Daycare') {
            $days = 1;
        }

        return (float) (($service->price ?? 0) * $days);
    }

    /**
     * Get payments data for DataTables
     */
    public function getPaymentsData()
    {
        return response()->json(['data' => $this->buildPaymentsCollection()]);
    }

    /**
     * Show payment details
     */
    public function show($id)
    {
        $payment = Payment::with('user')->findOrFail($id);

        // Get related service details
        if ($payment->payable_type == 'App\Models\Appointment') {
            $payment->service = Appointment::with(['service', 'pet'])->find($payment->payable_id);
        } elseif ($payment->payable_type == 'App\Models\Boarding') {
            $payment->service = Boarding::with('pet')->find($payment->payable_id);
        }

        return response()->json([
            'success' => true,
            'data' => $payment
        ]);
    }

    /**
     * Update payment record
     */
    public function update(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);

        $validated = $request->validate([
            'payment_method' => 'sometimes|required|in:Cash,GCash',
            'reference_number' => 'nullable|string',
            'status' => 'required|in:Pending,Completed,Failed,Refunded',
            'amount' => 'sometimes|required|numeric|min:0',
        ]);

        $effectiveMethod = $validated['payment_method'] ?? $payment->payment_method;
        if ($effectiveMethod === 'GCash' && array_key_exists('reference_number', $validated) && $validated['reference_number'] !== null && $validated['reference_number'] !== '') {
            $request->validate([
                'reference_number' => 'digits:13'
            ]);
        }

        $updateData = [];
        if (array_key_exists('payment_method', $validated)) {
            $updateData['payment_method'] = $validated['payment_method'];
        }
        if (array_key_exists('reference_number', $validated)) {
            $updateData['reference_number'] = $validated['reference_number'];
        }
        if (array_key_exists('amount', $validated)) {
            $updateData['amount'] = $validated['amount'];
        }
        $updateData['status'] = $validated['status'];

        if ($request->filled('admin_notes') && $payment->isFillable('admin_notes')) {
            $updateData['admin_notes'] = $request->input('admin_notes');
        }

        // Log the original state before update
        $admin = auth()->user();
        ActivityLog::create([
            'table_name' => 'payments',
            'record_id' => $payment->paymentID,
            'action' => 'update',
            'old_values' => json_encode($payment->toArray()),
            'new_values' => json_encode(array_merge($updateData, [
                'admin_id' => $admin->userID,
                'admin_name' => $admin->firstName . ' ' . $admin->lastName
            ])),
            'userID' => auth()->id(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);

        $payment->update($updateData);

        return response()->json([
            'success' => true,
            'message' => 'Payment updated successfully',
            'data' => $payment
        ]);
    }

    /**
     * Mark payment as refunded
     */
    public function markAsRefunded(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);

        if ($payment->status !== 'Completed') {
            return response()->json([
                'success' => false,
                'message' => 'Only completed payments can be refunded'
            ], 400);
        }

        // Log the change
        $admin = auth()->user();
        ActivityLog::create([
            'table_name' => 'payments',
            'record_id' => $payment->paymentID,
            'action' => 'update',
            'old_values' => json_encode(['status' => $payment->status]),
            'new_values' => json_encode([
                'status' => 'Refunded',
                'admin_id' => $admin->userID,
                'admin_name' => $admin->firstName . ' ' . $admin->lastName
            ]),
            'userID' => auth()->id(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);

        $payment->status = 'Refunded';
        $payment->save();

        return response()->json([
            'success' => true,
            'message' => 'Payment has been marked as refunded'
        ]);
    }

    /**
     * Complete an existing pending payment record
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'userID' => 'required|exists:users,userID',
            'payable_type' => 'required|string',
            'payable_id' => 'required|integer',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|in:Cash,GCash',
            'reference_number' => 'nullable|string',
            'payment_type' => 'nullable|in:deposit,full,balance'
        ]);

        if ($validated['payment_method'] === 'GCash') {
            $request->validate([
                'reference_number' => 'required|digits:13'
            ]);
        }

        if ($validated['payable_type'] === 'App\Models\Appointment') {
            $payable = Appointment::with(['service', 'payments'])->findOrFail($validated['payable_id']);
        } elseif ($validated['payable_type'] === 'App\Models\Boarding') {
            $payable = Boarding::with('payments')->findOrFail($validated['payable_id']);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unsupported payable type.'
            ], 422);
        }

        $totalCost = $validated['payable_type'] === 'App\Models\Appointment'
            ? $this->resolveAppointmentTotalCost($payable)
            : $this->resolveBoardingTotalCost($payable);

        $completedPayments = $payable->payments()->where('status', 'Completed');
        $completedTotal = (float) $completedPayments->sum('amount');

        // Prevent duplicate completion when booking is already fully paid.
        if ($totalCost > 0 && $completedTotal >= $totalCost) {
            return response()->json([
                'success' => false,
                'message' => 'This booking is already fully paid.'
            ], 422);
        }

        $payment = $payable->payments()
            ->where('status', 'Pending')
            ->latest('paymentID')
            ->first();

        $isNewPaymentRecord = false;
        $oldValues = null;

        if ($payment) {
            $oldValues = $payment->toArray();
        } else {
            // Legacy/admin-created bookings may not have an initial pending payment row.
            $payment = new Payment();
            $payment->userID = $validated['userID'];
            $payment->payable_type = $validated['payable_type'];
            $payment->payable_id = $validated['payable_id'];
            $payment->total_cost = $totalCost;
            $isNewPaymentRecord = true;
        }

        $payment->amount = $validated['amount'];
        $payment->payment_method = $validated['payment_method'];
        $payment->reference_number = $validated['payment_method'] === 'GCash'
            ? ($validated['reference_number'] ?? null)
            : null;
        $payment->payment_type = $validated['payment_type']
            ?? ($completedTotal > 0 ? 'balance' : 'full');
        $payment->status = 'Completed';
        $payment->save();

        // Log the create/update
        ActivityLog::create([
            'table_name' => 'payments',
            'record_id' => $payment->paymentID,
            'action' => $isNewPaymentRecord ? 'create' : 'update',
            'old_values' => $oldValues ? json_encode($oldValues) : null,
            'new_values' => json_encode($payment->toArray()),
            'userID' => auth()->id(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);

        // Update booking status based on when payment was recorded vs booking date/time
        $now = Carbon::now();
        $newStatus = null;

        if ($validated['payable_type'] === 'App\Models\Appointment') {
            // For appointments: combine date and time
            $appointmentDateTime = Carbon::createFromFormat(
                'Y-m-d H:i:s',
                $payable->date . ' ' . $payable->time
            );

            if ($now->lt($appointmentDateTime)) {
                // Payment recorded before appointment time
                $newStatus = 'Confirmed';
            } else {
                // Payment recorded after appointment time
                $newStatus = 'Completed';
            }
        } elseif ($validated['payable_type'] === 'App\Models\Boarding') {
            // For boardings: check if before, during, or after
            $boardingStart = Carbon::parse($payable->start_date);
            $boardingEnd = Carbon::parse($payable->end_date)->endOfDay();

            if ($now->lt($boardingStart)) {
                // Payment recorded before boarding starts
                $newStatus = 'Confirmed';
            } elseif ($now->lte($boardingEnd)) {
                // Payment recorded during boarding (including end date)
                $newStatus = 'Active';
            } else {
                // Payment recorded after boarding ends
                $newStatus = 'Completed';
            }
        }

        // Update booking status if determined
        if ($newStatus && $payable->status !== $newStatus) {
            $oldStatus = $payable->status;
            $payable->status = $newStatus;
            $payable->save();

            // Log the status change
            $bookingTable = $validated['payable_type'] === 'App\Models\Appointment' ? 'appointments' : 'boardings';
            $bookingId = $validated['payable_type'] === 'App\Models\Appointment' ? $payable->appointmentID : $payable->boardingID;

            ActivityLog::create([
                'table_name' => $bookingTable,
                'record_id' => $bookingId,
                'action' => 'update',
                'old_values' => json_encode(['status' => $oldStatus]),
                'new_values' => json_encode(['status' => $newStatus]),
                'userID' => auth()->id(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Payment recorded successfully',
            'data' => $payment
        ]);
    }

    /**
     * Get all fully unpaid bookings for a specific user
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUnpaidBookings(Request $request)
    {
        $userId = $request->query('userID');

        if (!$userId) {
            return response()->json([
                'success' => false,
                'message' => 'User ID is required'
            ], 400);
        }

        try {
            // Get appointments for user through the pets relationship
            $appointments = Appointment::with(['service', 'pet', 'payments' => function ($query) {
                $query->where('status', 'Completed');
            }])
                ->whereHas('pet', function ($query) use ($userId) {
                    $query->where('userID', $userId);
                })
                ->where('status', '!=', 'Cancelled')
                ->get();

            // Filter to only fully unpaid appointments so the admin action completes the existing pending payment.
            $unpaidAppointments = $appointments->filter(function ($appointment) {
                $totalPrice = $this->resolveAppointmentTotalCost($appointment);
                $totalPaid = $appointment->payments->sum('amount');
                return $totalPaid == 0;
            })->values();

            // Get boardings for user
            $boardings = Boarding::with(['pet', 'payments' => function ($query) {
                $query->where('status', 'Completed');
            }])
                ->whereHas('pet', function ($query) use ($userId) {
                    $query->where('userID', $userId);
                })
                ->where('status', '!=', 'Cancelled')
                ->get();

            // Filter to only fully unpaid boardings so the admin action completes the existing pending payment.
            $unpaidBoardings = $boardings->filter(function ($boarding) {
                $totalPrice = $this->resolveBoardingTotalCost($boarding);
                $totalPaid = $boarding->payments->sum('amount');
                return $totalPaid == 0;
            })->values();

            // Add remaining balance to each item
            foreach ($unpaidAppointments as $appointment) {
                $totalPrice = $this->resolveAppointmentTotalCost($appointment);
                $totalPaid = $appointment->payments->sum('amount');
                $appointment->price = $totalPrice;
                $appointment->remaining_balance = max(0, $totalPrice - $totalPaid);
                $appointment->is_partially_paid = false;
            }

            foreach ($unpaidBoardings as $boarding) {
                $totalPrice = $this->resolveBoardingTotalCost($boarding);
                $totalPaid = $boarding->payments->sum('amount');
                $boarding->price = $totalPrice;
                $boarding->remaining_balance = max(0, $totalPrice - $totalPaid);
                $boarding->is_partially_paid = false;
            }

            // Return combined data
            return response()->json([
                'success' => true,
                'appointments' => $unpaidAppointments,
                'boardings' => $unpaidBoardings
            ]);
        } catch (\Exception $e) {
            \Log::error('Error fetching unpaid bookings: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch unpaid bookings.'
            ], 500);
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\ActivityLog;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Boarding;
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
        $paymentsJson = $this->buildPaymentsCollection()->toJson();

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
            'payment_method' => 'sometimes|required|in:Cash,Credit Card,Debit Card,PayPal,GCash,Bank Transfer,Other',
            'reference_number' => 'nullable|string',
            'status' => 'required|in:Pending,Completed,Failed,Refunded',
            'amount' => 'sometimes|required|numeric|min:0',
        ]);

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
        if (!auth()->user()->hasPermission('payments.refund')) {
            return response()->json(['success' => false, 'message' => 'You do not have permission to perform this action.'], 403);
        }
        $payment = Payment::findOrFail($id);
        
        if ($payment->status !== 'Completed') {
            return response()->json([
                'success' => false,
                'message' => 'Only completed payments can be refunded'
            ], 400);
        }
        
        // Log the change
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
     * Store a new payment record
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'userID' => 'required|exists:users,userID',
            'payable_type' => 'required|string',
            'payable_id' => 'required|integer',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|in:Cash,Credit Card,Debit Card,PayPal,GCash,Bank Transfer,Other',
            'reference_number' => 'nullable|string',
            'status' => 'required|in:Pending,Completed,Failed,Refunded'
        ]);
        
        $payment = Payment::create($validated);
        
        // Log the creation
        ActivityLog::create([
            'table_name' => 'payments',
            'record_id' => $payment->paymentID,
            'action' => 'create',
            'new_values' => json_encode($payment->toArray()),
            'userID' => auth()->id(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Payment recorded successfully',
            'data' => $payment
        ]);
    }

    /**
     * Get all unpaid or partially paid bookings for a specific user
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
            $appointments = Appointment::with(['service', 'pet', 'payments' => function($query) {
                    $query->where('status', 'Completed');
                }])
                ->whereHas('pet', function($query) use ($userId) {
                    $query->where('userID', $userId);
                })
                ->where('status', '!=', 'Cancelled')
                ->get();
            
            // Filter to only unpaid or partially paid appointments
            $unpaidAppointments = $appointments->filter(function($appointment) {
                $totalPrice = $appointment->price ?? ($appointment->service->price ?? 0);
                $totalPaid = $appointment->payments->sum('amount');
                return $totalPaid < $totalPrice;
            })->values();
            
            // Get boardings for user
            $boardings = Boarding::with(['pet', 'payments' => function($query) {
                    $query->where('status', 'Completed');
                }])
                ->whereHas('pet', function($query) use ($userId) {
                    $query->where('userID', $userId);
                })
                ->where('status', '!=', 'Cancelled')
                ->get();
            
            // Filter to only unpaid or partially paid boardings
            $unpaidBoardings = $boardings->filter(function($boarding) {
                $totalPrice = $boarding->price ?? 0;
                $totalPaid = $boarding->payments->sum('amount');
                return $totalPaid < $totalPrice;
            })->values();
            
            // Add remaining balance to each item
            foreach ($unpaidAppointments as $appointment) {
                $totalPrice = $appointment->price ?? ($appointment->service->price ?? 0);
                $totalPaid = $appointment->payments->sum('amount');
                $appointment->remaining_balance = max(0, $totalPrice - $totalPaid);
                $appointment->is_partially_paid = $totalPaid > 0;
            }
            
            foreach ($unpaidBoardings as $boarding) {
                $totalPrice = $boarding->price ?? 0;
                $totalPaid = $boarding->payments->sum('amount');
                $boarding->remaining_balance = max(0, $totalPrice - $totalPaid);
                $boarding->is_partially_paid = $totalPaid > 0;
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
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\ActivityLog;
use Carbon\Carbon;

class AdminAppointmentsController extends Controller
{
    public function index()
    {
        // Stats for cards
        $totalAppointments     = Appointment::count();
        $upcomingAppointments  = Appointment::where('date', '>=', now()->format('Y-m-d'))->where('status', 'Confirmed')->count();
        $completedAppointments = Appointment::where('status', 'Completed')->count();
        $cancelledAppointments = Appointment::where('status', 'Cancelled')->count();

        // Inline data eliminates the second AJAX roundtrip on page load
        $appointmentsJson = Appointment::with(['pet.user', 'service', 'payments'])
            ->orderBy('date', 'desc')
            ->get()
            ->toJson(JSON_HEX_TAG);

        return view('admin.appointments', compact(
            'totalAppointments',
            'upcomingAppointments',
            'completedAppointments',
            'cancelledAppointments',
            'appointmentsJson'
        ));
    }

    public function getAppointmentsData()
    {
        try {
            $appointments = Appointment::with(['pet.user', 'service', 'payments'])
                ->orderBy('date', 'desc')
                ->get();
                
            return response()->json([
                'data' => $appointments
            ]);
        } catch (\Exception $e) {
            \Log::error('Error fetching appointments: ' . $e->getMessage());
            return response()->json([
                'error' => 'Failed to load appointments',
                'message' => 'An unexpected error occurred.',
                'data' => []
            ], 500);
        }
    }

    // public function cancelAppointment($id)
    // {
    //     try {
    //         $appointment = Appointment::findOrFail($id);
    //         $appointment->status = 'Cancelled';
    //         $appointment->save();
            
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Appointment cancelled successfully'
    //         ]);
    //     } catch (\Exception $e) {
    //         \Log::error('Error cancelling appointment: ' . $e->getMessage());
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Failed to cancel appointment'
    //         ], 500);
    //     }
    // }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'petID' => 'required|exists:pets,petID',
            'date' => 'required|date|after:today',
            'time' => 'required',
            'serviceID' => 'required|exists:services,serviceID',
            'status' => 'required|in:Pending,Confirmed,Cancelled'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }
        
        // Check for duplicate appointments
        $existingAppointment = Appointment::where('date', $request->date)
            ->where('time', $request->time)
            ->whereIn('status', ['Pending', 'Confirmed'])
            ->exists();
            
        if ($existingAppointment) {
            return response()->json([
                'success' => false,
                'message' => 'This time slot is already booked'
            ], 422);
        }
    
        // Create new appointment
        $appointment = new Appointment();
        $appointment->petID = $request->petID;
        $appointment->date = $request->date;
        $appointment->time = $request->time;
        $appointment->serviceID = $request->serviceID;
        $appointment->status = $request->status;
        $appointment->save();
    
        return response()->json([
            'success' => true,
            'message' => 'Appointment created successfully',
            'appointment' => $appointment
        ]);
    }

    /**
     * Get available time slots for a specific date
     */
    public function getAvailableTimes(Request $request)
    {
        $date = $request->input('date');
        
        if (!$date) {
            return response()->json([
                'success' => false,
                'message' => 'Date is required'
            ], 400);
        }
        
        // Define all possible time slots
        $allTimeSlots = [
            '09:00:00' => '9:00 AM',
            '10:00:00' => '10:00 AM',
            '11:00:00' => '11:00 AM',
            '13:00:00' => '1:00 PM',
            '14:00:00' => '2:00 PM',
            '15:00:00' => '3:00 PM',
            '16:00:00' => '4:00 PM'
        ];
        
        // Get booked appointments for this date
        $bookedAppointments = Appointment::where('date', $date)
            ->whereIn('status', ['Confirmed', 'Pending'])
            ->pluck('time')
            ->toArray();
        
        // Format booked times to match our time format
        $bookedTimes = [];
        foreach ($bookedAppointments as $time) {
            $bookedTimes[\Carbon\Carbon::parse($time)->format('H:i:s')] = true;
        }
        
        // Build response with available and booked slots
        $timeSlots = [];
        foreach ($allTimeSlots as $value => $label) {
            $timeSlots[] = [
                'value' => $value,
                'label' => $label,
                'available' => !isset($bookedTimes[$value])
            ];
        }
        
        return response()->json([
            'success' => true,
            'timeSlots' => $timeSlots
        ]);
    }

    public function listUsers()
    {
        // Get all users, sorted by name for convenience
        $users = \App\Models\User::orderBy('firstName')->get();
        return response()->json($users);
    }

    public function userPets($userId)
    {
        // Get all pets belonging to the specified user
        $pets = \App\Models\Pet::where('userID', $userId)->orderBy('name')->get();
        return response()->json($pets);
    }

    public function listServices()
    {
        // Get only active non-boarding services for appointments
        $services = \App\Models\Service::select(['serviceID', 'name', 'price', 'category', 'description', 'serviceImage'])
            ->where('isActive', true)
            ->whereRaw('LOWER(category) <> ?', ['boarding'])
            ->orderBy('name')
            ->get();
            
        return response()->json($services);
    }

    public function updateStatuses()
    {
        // Find appointments that should be active
        $activated = Appointment::where('status', Appointment::STATUS_CONFIRMED)
            ->get()
            ->filter(function ($appointment) {
                return $appointment->shouldBeActive();
            });
            
        foreach ($activated as $appointment) {
            $appointment->status = Appointment::STATUS_ACTIVE;
            $appointment->save();
        }
        
        // Find appointments that should be completed
        $completed = Appointment::where('status', Appointment::STATUS_ACTIVE)
            ->get()
            ->filter(function ($appointment) {
                return $appointment->shouldBeCompleted();
            });
            
        foreach ($completed as $appointment) {
            $appointment->status = Appointment::STATUS_COMPLETED;
            $appointment->save();
        }
        
        // Find missed appointments
        $missed = Appointment::where('status', Appointment::STATUS_CONFIRMED)
            ->get()
            ->filter(function ($appointment) {
                return $appointment->isMissed();
            });
            
        foreach ($missed as $appointment) {
            $appointment->status = Appointment::STATUS_MISSED;
            $appointment->save();
        }
        
        return [
            'activated' => $activated->count(),
            'completed' => $completed->count(),
            'missed' => $missed->count(),
        ];
    }

    /**
     * Show appointment details
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $appointment = Appointment::with(['service', 'pet.user', 'payments'])
                ->findOrFail($id);
            
            // Format date and time for display
            $appointment->formattedDate = \Carbon\Carbon::parse($appointment->date)->format('F j, Y');
            $appointment->formattedTime = \Carbon\Carbon::parse($appointment->time)->format('g:i A');
            
            return response()->json([
                'success' => true,
                'appointment' => $appointment
            ]);
        } catch (\Exception $e) {
            \Log::error('Error fetching appointment: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve appointment details',
            ], 404);
        }
    }

    /**
     * Update appointment status
     * 
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'status' => 'required|string|in:Pending,Confirmed,Completed,Cancelled'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid status value',
                    'errors' => $validator->errors()
                ], 422);
            }

            $appointment = Appointment::findOrFail($id);
            $oldStatus = $appointment->status;
            $appointment->status = $request->status;
            $appointment->save();
            
            // Log the status change
            \App\Models\ActivityLog::create([
                'table_name' => 'appointments',
                'record_id' => $appointment->appointmentID,
                'action' => 'update_status',
                'old_values' => json_encode(['status' => $oldStatus]),
                'new_values' => json_encode(['status' => $request->status]),
                'userID' => auth()->id(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Appointment status updated successfully',
                'appointment' => $appointment
            ]);
        } catch (\Exception $e) {
            \Log::error('Error updating appointment status: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update appointment status',
            ], 500);
        }
    }

    /**
     * Update appointment details
     * 
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $admin = auth()->user();
            $appointment = Appointment::findOrFail($id);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Appointment not found.'
            ], 404);
        }

        $dateRules = ['required', 'date'];
        if ($request->filled('date') && $request->input('date') !== $appointment->date) {
            $dateRules[] = 'after_or_equal:today';
        }

        $validator = Validator::make($request->all(), [
            'petID' => 'required|exists:pets,petID',
            'serviceID' => 'required|exists:services,serviceID', 
            'date' => $dateRules,
            'time' => 'required',
            'status' => 'required|in:Pending,Confirmed,Completed,Cancelled',
            'before_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'after_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], []);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        if ($request->input('date') !== $appointment->date && Carbon::parse($request->input('date'))->isPast()) {
            return response()->json([
                'success' => false,
                'message' => 'The new appointment date must be today or later.'
            ], 422);
        }

        try {
            // Store original values for logging
            $originalValues = $appointment->toArray();
            
            // Update appointment fields
            $appointment->petID = $request->petID;
            $appointment->serviceID = $request->serviceID;
            $appointment->date = $request->date;
            $appointment->time = $request->time;
            $appointment->status = $request->status;
            
            // Handle image uploads
            if ($request->hasFile('before_image')) {
                // Delete old image if exists
                if ($appointment->before_image && Storage::exists('public/' . $appointment->before_image)) {
                    Storage::delete('public/' . $appointment->before_image);
                }
                
                $beforeImage = $request->file('before_image');
                $beforeImageName = 'before_' . $appointment->appointmentID . '_' . time() . '.' . $beforeImage->getClientOriginalExtension();
                $beforeImagePath = $beforeImage->storeAs('images/grooming', $beforeImageName, 'public');
                $appointment->before_image = $beforeImagePath;
            }
            
            if ($request->hasFile('after_image')) {
                // Delete old image if exists
                if ($appointment->after_image && Storage::exists('public/' . $appointment->after_image)) {
                    Storage::delete('public/' . $appointment->after_image);
                }
                
                $afterImage = $request->file('after_image');
                $afterImageName = 'after_' . $appointment->appointmentID . '_' . time() . '.' . $afterImage->getClientOriginalExtension();
                $afterImagePath = $afterImage->storeAs('images/grooming', $afterImageName, 'public');
                $appointment->after_image = $afterImagePath;
            }
            
            $appointment->save();

            // Log the update action
            ActivityLog::create([
                'table_name' => 'appointments',
                'record_id' => $appointment->appointmentID,
                'action' => 'update',
                'old_values' => json_encode($originalValues),
                'new_values' => json_encode(array_merge($appointment->toArray(), [
                    'admin_id' => $admin->userID,
                    'admin_name' => $admin->firstName . ' ' . $admin->lastName
                ])),
                'userID' => auth()->id(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Appointment updated successfully',
                'data' => $appointment
            ]);
        } catch (\Exception $e) {
            \Log::error('Error updating appointment: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update appointment.'
            ], 500);
        }
    }

    /**
     * Get appointment data for editing
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        try {
            $appointment = Appointment::with(['pet.user', 'service'])->findOrFail($id);
            
            return response()->json([
                'success' => true,
                'appointment' => $appointment,
                'pet' => $appointment->pet,
                'service' => $appointment->service,
                'user' => $appointment->pet->user 
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Appointment not found'
            ], 404);
        }
    }

    public function cancel(Request $request, $id)
    {
        try {
            $admin = auth()->user();
            $appointment = Appointment::findOrFail($id);
            
            // Store original values for logging
            $originalStatus = $appointment->status;
            
            $appointment->status = 'Cancelled';
            $appointment->save();

            // Log the cancellation action
            ActivityLog::create([
                'table_name' => 'appointments',
                'record_id' => $appointment->appointmentID,
                'action' => 'update',
                'old_values' => json_encode(['status' => $originalStatus]),
                'new_values' => json_encode([
                    'status' => 'Cancelled',
                    'cancelled_by_admin_id' => $admin->userID,
                    'cancelled_by_admin_name' => $admin->firstName . ' ' . $admin->lastName
                ]),
                'userID' => auth()->id(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Appointment cancelled successfully'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error cancelling appointment: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to cancel appointment'
            ], 500);
        }
    }

    /**
     * Mark an appointment's payment as completed and confirm the appointment.
     */
    public function markAsPaid(Request $request, $id)
    {
        try {
            $appointment = Appointment::with('payments')->findOrFail($id);
            $admin = auth()->user();

            // Get the most recent payment for this appointment
            $latestPayment = $appointment->payments()->latest()->first();

            if (!$latestPayment) {
                return response()->json(['success' => false, 'message' => 'No payment record found for this appointment.'], 404);
            }

            if ($latestPayment->status === 'Pending') {
                $originalStatus = $appointment->status;
                $latestPayment->status = 'Completed';
                $latestPayment->save();

                $appointment->status = 'Confirmed';
                $appointment->save();

                if ($latestPayment->payment_method === 'GCash') {
                    $message = $latestPayment->payment_type === 'deposit'
                        ? 'GCash deposit verified. Appointment is now Confirmed. Remaining balance will be collected at the visit.'
                        : 'GCash payment verified. Appointment is now Confirmed.';
                } else {
                    $message = 'Cash payment confirmed. Appointment is now Confirmed.';
                }

                $logNote = [
                    'status_from' => $originalStatus,
                    'status_to' => 'Confirmed',
                    'payment_method' => $latestPayment->payment_method,
                    'payment_type' => $latestPayment->payment_type,
                ];
            } elseif ($latestPayment->payment_type === 'deposit' && $latestPayment->status === 'Completed') {
                if ($appointment->payments()->where('payment_type', 'balance')->exists()) {
                    return response()->json(['success' => false, 'message' => 'Balance payment has already been recorded for this appointment.'], 422);
                }

                // GCash deposit was already verified — record the remaining cash balance now.
                $balanceAmount = $latestPayment->total_cost
                    ? round($latestPayment->total_cost - $latestPayment->amount, 2)
                    : round($latestPayment->amount / 0.3 * 0.7, 2);

                $balancePayment = new \App\Models\Payment();
                $balancePayment->userID         = $latestPayment->userID;
                $balancePayment->amount         = $balanceAmount;
                $balancePayment->total_cost     = $latestPayment->total_cost;
                $balancePayment->payment_type   = 'balance';
                $balancePayment->payment_method = 'Cash';
                $balancePayment->status         = 'Completed';
                $balancePayment->payable_id     = $appointment->appointmentID;
                $balancePayment->payable_type   = 'App\Models\Appointment';
                $balancePayment->save();

                $message = "Balance of ₱{$balanceAmount} collected. Appointment fully paid.";
                $logNote  = ['collected_balance' => $balanceAmount];
            } else {
                return response()->json(['success' => false, 'message' => 'This appointment payment is already fully processed.'], 422);
            }

            ActivityLog::create([
                'table_name' => 'appointments',
                'record_id'  => $appointment->appointmentID,
                'action'     => 'payment_collected',
                'old_values' => json_encode([]),
                'new_values' => json_encode(array_merge($logNote, ['by_admin' => $admin->userID])),
                'userID'     => auth()->id(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            return response()->json(['success' => true, 'message' => $message]);
        } catch (\Exception $e) {
            \Log::error('Error marking appointment as paid: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to process payment.'], 500);
        }
    }
}
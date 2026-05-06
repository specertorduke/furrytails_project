<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\Pet;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\ActivityLog;

class AppointmentsController extends Controller
{
/**
 * Get available time slots for a selected date
 */
public function getAvailableTimes(Request $request)
{
    // Validate request
    $request->validate([
        'date' => 'required|date|after:today',
    ]);

    // Define business hours (9 AM to 5 PM)
    $startTime = 9; // 9 AM
    $endTime = 17;  // 5 PM
    $interval = 60; // 60 minutes per appointment

    // ALWAYS get the latest booking data - never use cached values
    // Get booked appointments for this date with a fresh query
    $bookedTimes = Appointment::where('date', $request->date)
        ->whereIn('status', ['Confirmed', 'Pending'])
        ->pluck('time')
        ->toArray();

    // Generate available time slots
    $timeSlots = [];
    for ($hour = $startTime; $hour < $endTime; $hour++) {
        $time = sprintf('%02d:00:00', $hour);
        $label = date('h:i A', strtotime($time));
        
        // Check if this time is booked
        $isAvailable = !in_array($time, $bookedTimes);
        
        $timeSlots[] = [
            'value' => $time,
            'label' => $label,
            'available' => $isAvailable
        ];
    }

    return response()->json([
        'date' => $request->date,
        'timeSlots' => $timeSlots
    ]);
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

            // Authorize: ensure the appointment belongs to the current user
            if ($appointment->pet->userID !== auth()->id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }
            
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
                'message' => 'Failed to retrieve appointment details'
            ], 404);
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
            
            // Make sure the appointment belongs to the authenticated user
            if ($appointment->pet->userID !== auth()->id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }

                if (in_array($appointment->status, ['Cancelled', 'Completed'])) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Cancelled or completed appointments can only be viewed.'
                    ], 422);
                }
            
            return response()->json([
                'success' => true,
                'appointment' => $appointment,
                'pet' => $appointment->pet,
                'service' => $appointment->service,
                'user' => $appointment->pet->user  // Add this line
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Appointment not found'
            ], 404);
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
            // Update validation rules to include grooming-related fields
            $validator = Validator::make($request->all(), [
                'petID' => 'required|exists:pets,petID',
                'date' => 'required|date',
                'time' => 'required',
                'serviceID' => 'required|exists:services,serviceID',
                'before_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'after_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);
        
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }
            
            // Find appointment
            $appointment = Appointment::with('pet')->findOrFail($id);

            // Authorize: ensure the appointment belongs to the current user
            if ($appointment->pet->userID !== auth()->id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }

            if (in_array($appointment->status, ['Cancelled', 'Completed'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cancelled or completed appointments can no longer be edited.'
                ], 422);
            }
            
            // Check for duplicate appointments (excluding this one)
            $existingAppointment = Appointment::where('date', $request->date)
                ->where('time', $request->time)
                ->whereIn('status', ['Pending', 'Confirmed'])
                ->where('appointmentID', '!=', $id)
                ->exists();
                
            if ($existingAppointment) {
                return response()->json([
                    'success' => false,
                    'message' => 'This time slot is already booked'
                ], 422);
            }
        
            // Update appointment basic details
            $appointment->petID = $request->petID;
            $appointment->date = $request->date;
            $appointment->time = $request->time;
            $appointment->serviceID = $request->serviceID;
            
            // Check if this is a grooming appointment by checking the service category
            $isGrooming = false;
            try {
                $service = Service::findOrFail($request->serviceID);
                $isGrooming = strtolower($service->category) === 'grooming';
            } catch (\Exception $e) {
                \Log::warning('Error checking if service is grooming: ' . $e->getMessage());
            }
            
            // Save all changes
            $appointment->save();
        
            return response()->json([
                'success' => true,
                'message' => 'Appointment updated successfully',
                'appointment' => $appointment
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
     * Get all active services
     */
    public function getServicesList()
    {
        try {
            $services = Service::select(['serviceID', 'name', 'price', 'category', 'description', 'serviceImage'])
                ->where('isActive', true)
                ->whereRaw('LOWER(category) <> ?', ['boarding'])
                ->orderBy('name')
                ->get();
                
            return response()->json($services);
        } catch (\Exception $e) {
            \Log::error('Error fetching services: ' . $e->getMessage());
            return response()->json([], 500);
        }
    }

  /**
 * Store a new appointment with concurrency protection
 */
public function store(Request $request)
{
    $request->validate([
        'petID'          => 'required|exists:pets,petID',
        'date'           => 'required|date|after:today',
        'time'           => 'required',
        'serviceID'      => 'required|exists:services,serviceID',
        'payment_method'    => 'required|in:Cash,GCash',
        'reference_number'  => $request->payment_method === 'GCash' ? 'required|digits:13' : 'nullable',
        'payment_type'      => 'nullable|in:deposit,full',
        ]);

    // Begin transaction with exclusive lock to prevent concurrent booking
    DB::beginTransaction();

    try {
        // CRITICAL: Lock the time slot first by checking with a lock
        $existingAppointment = Appointment::where('date', $request->date)
            ->where('time', $request->time)
            ->whereIn('status', ['Pending', 'Confirmed'])
            ->lockForUpdate() // This is key - it prevents concurrent access
            ->first();
            
        if ($existingAppointment) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'This time slot has just been booked by another client. Please select a different time.'
            ], 409); // 409 Conflict status code
        }

        // Create the appointment since we've locked the slot
        $appointment = new Appointment();
        $appointment->petID = $request->petID;
        $appointment->serviceID = $request->serviceID;
        $appointment->date = $request->date;
        $appointment->time = $request->time;
        $appointment->status = 'Pending';
        $appointment->save();

        // Create payment record
        $service = Service::find($request->serviceID);
        $totalPrice = $service->price;

        // Cash bookings always pay the full amount at the counter (deposit N/A for cash).
        // GCash bookings may choose deposit (30% now, balance at visit) or full.
        $paymentMethod = $request->payment_method;
        $paymentType   = ($paymentMethod === 'GCash')
            ? $request->input('payment_type', 'full')
            : 'full';
        $paymentAmount = ($paymentType === 'deposit') ? round($totalPrice * 0.3, 2) : $totalPrice;

        $payment = new \App\Models\Payment();
        $payment->userID          = Auth::id();
        $payment->amount          = $paymentAmount;
        $payment->total_cost      = $totalPrice;
        $payment->payment_type    = $paymentType;
        $payment->payment_method  = $paymentMethod;
        $payment->reference_number = $request->reference_number ?? null;

        // Both Cash and GCash bookings stay Pending until staff verification.
        // For GCash, the reference is submitted now but staff still verifies the transfer manually.
        $payment->status = 'Pending';

        // Set polymorphic relationship
        $payment->payable_id = $appointment->appointmentID;
        $payment->payable_type = 'App\Models\Appointment';
        $payment->save();

        DB::commit();

        // Send booking confirmation email (non-blocking)
        try {
            $appointment->load(['pet', 'service']);
            $emailUser = Auth::user();
            \Illuminate\Support\Facades\Mail::to($emailUser->email)
                ->send(new \App\Mail\BookingConfirmation($appointment, 'appointment', $emailUser, $payment));
        } catch (\Exception $e) {
            \Log::warning('Confirmation email failed: ' . $e->getMessage());
        }

        return response()->json([
            'success'     => true,
            'message'     => 'Appointment created successfully',
            'appointment' => $appointment,
            'payment'     => $payment
        ], 201);
    } catch (\Illuminate\Database\UniqueConstraintViolationException $e) {
        DB::rollBack();
        // This is a fallback if somehow we missed the existing appointment check
        return response()->json([
            'success' => false,
            'message' => 'This time slot has already been booked. Please select a different time.'
        ], 409);
    } catch (\Exception $e) {
        DB::rollBack();
        \Log::error('Error creating appointment: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
        
        return response()->json([
            'success' => false,
            'message' => 'An error occurred while creating the appointment'
        ], 500);
    }
}

    /**
     * Cancel an appointment
     */
    // public function cancelAppointment($id)
    // {
    //     $appointment = Appointment::findOrFail($id);
        
    //     // Check if user owns this appointment
    //     if (Auth::id() !== $appointment->pet->userID) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Unauthorized'
    //         ], 403);
    //     }
        
    //     // Check if appointment can be cancelled
    //     if (in_array($appointment->status, ['Cancelled', 'Completed'])) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'This appointment cannot be cancelled'
    //         ], 400);
    //     }
        
    //     // Cancel the appointment
    //     $appointment->status = 'Cancelled';
    //     $appointment->save();
            
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Appointment cancelled successfully'
    //     ]);
    // }

    public function cancel(Request $request, $id)
    {
        // Validate user password
        $validated = $request->validate([
            'user_password' => 'required|string'
        ], [
            'user_password.required' => 'Password is required to cancel appointments.',
        ]);

        // Verify user password
        $user = auth()->user();
        if (!Hash::check($validated['user_password'], $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid password. Please enter your current password to confirm this action.'
            ], 401);
        }

        try {
            $appointment = Appointment::with('pet')->findOrFail($id);
            
            // Make sure the appointment belongs to the authenticated user
            if ($appointment->pet->userID !== auth()->id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }
            
            // Store original values for logging
            $originalStatus = $appointment->status;
            
            $appointment->status = 'Cancelled';
            $appointment->save();

            // Send cancellation email (non-blocking)
            try {
                $appointment->load('service');
                \Illuminate\Support\Facades\Mail::to($user->email)
                    ->send(new \App\Mail\BookingCancellation($appointment, 'appointment', $user));
            } catch (\Exception $e) {
                \Log::warning('Cancellation email failed: ' . $e->getMessage());
            }

            // Log the cancellation action
            ActivityLog::create([
                'table_name' => 'appointments',
                'record_id' => $appointment->appointmentID,
                'action' => 'update',
                'old_values' => json_encode(['status' => $originalStatus]),
                'new_values' => json_encode([
                    'status' => 'Cancelled',
                    'cancelled_by_user' => true
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
}
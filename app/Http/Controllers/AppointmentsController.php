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

        // Get booked appointments for this date
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
                'error' => $e->getMessage()
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
            $appointment = \App\Models\Appointment::with(['pet.user', 'service'])
                ->findOrFail($id);
                
            return response()->json([
                'success' => true,
                'appointment' => $appointment
            ]);
        } catch (\Exception $e) {
            \Log::error('Error fetching appointment for edit: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve appointment details',
                'error' => $e->getMessage()
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
            $appointment = Appointment::findOrFail($id);
            
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
                'message' => 'Failed to update appointment: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get all active services
     */
    public function getServicesList()
    {
        try {
            $services = Service::select(['serviceID', 'name', 'price'])
                ->where('isActive', true)
                ->where(function($query) {
                    // Exclude services that have "Boarding" or "Daycare" in their name
                    $query->whereRaw('LOWER(name) NOT LIKE ?', ['%boarding%'])
                          ->whereRaw('LOWER(name) NOT LIKE ?', ['%daycare%']);
                })
                ->orderBy('name')
                ->get();
                
            return response()->json($services);
        } catch (\Exception $e) {
            \Log::error('Error fetching services: ' . $e->getMessage());
            return response()->json([], 500);
        }
    }

    /**
     * Store a new appointment
     */
    public function store(Request $request)
    {
        $request->validate([
            'petID'          => 'required|exists:pets,petID',
            'date'           => 'required|date|after:today',
            'time'           => 'required',
            'serviceID'      => 'required|exists:services,serviceID',
            'payment_method' => 'required|in:Cash,Credit Card,Debit Card,PayPal,GCash,Bank Transfer,Other',
            'payment_reference' => 'nullable|string|max:255',
        ]);

        // Retrieve the pet record
        $pet = Pet::findOrFail($request->petID);
        // Optionally ensure the pet belongs to the current user
        if ($pet->userID !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        // Begin transaction
        DB::beginTransaction();

        try {
            // Create the appointment WITHOUT setting a userID
            $appointment = new Appointment();
            // $appointment->userID = Auth::id(); // Remove this line
            $appointment->petID = $request->petID;
            $appointment->serviceID = $request->serviceID;
            $appointment->date = $request->date;
            $appointment->time = $request->time;
            $appointment->status = 'Pending';
            $appointment->save();

            // Create payment record (Payment table uses userID)
            $service = Service::find($request->serviceID);
            $payment = new \App\Models\Payment();
            $payment->userID = Auth::id();
            $payment->amount = $service->price;
            $payment->payment_method = $request->payment_method;
            $payment->reference_number = $request->reference_number;
            $payment->status = $request->payment_method === 'Cash' ? 'Pending' : 'Completed';
            
            // Set polymorphic relationship
            $payment->payable_id = $appointment->appointmentID;
            $payment->payable_type = 'App\Models\Appointment';
            $payment->save();

            // If payment is completed, update appointment status
            if ($payment->status === 'Completed') {
                $appointment->status = 'Confirmed';
                $appointment->save();
            }

            DB::commit();

            return response()->json([
                'success'     => true,
                'message'     => 'Appointment created successfully',
                'appointment' => $appointment,
                'payment'     => $payment
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error creating appointment: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the appointment',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Cancel an appointment
     */
    public function cancelAppointment($id)
    {
        $appointment = Appointment::findOrFail($id);
        
        // Check if user owns this appointment
        if (Auth::id() !== $appointment->pet->userID) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }
        
        // Check if appointment can be cancelled
        if (in_array($appointment->status, ['Cancelled', 'Completed'])) {
            return response()->json([
                'success' => false,
                'message' => 'This appointment cannot be cancelled'
            ], 400);
        }
        
        // Cancel the appointment
        $appointment->status = 'Cancelled';
        $appointment->save();
            
        return response()->json([
            'success' => true,
            'message' => 'Appointment cancelled successfully'
        ]);
    }
}
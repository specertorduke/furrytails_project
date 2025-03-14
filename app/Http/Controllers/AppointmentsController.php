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
        if (Auth::id() !== $appointment->userID) {
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
        
        // Log the cancellation
        activity()
            ->causedBy(Auth::user())
            ->performedOn($appointment)
            ->log('appointment_cancelled');
            
        return response()->json([
            'success' => true,
            'message' => 'Appointment cancelled successfully'
        ]);
    }
}
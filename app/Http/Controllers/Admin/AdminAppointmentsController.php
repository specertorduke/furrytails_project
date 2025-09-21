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

class AdminAppointmentsController extends Controller
{
    public function index()
    {
        // Calculate all the stats needed for cards
        $totalAppointments = Appointment::count();
        
        $upcomingAppointments = Appointment::where('date', '>=', now()->format('Y-m-d'))
            ->where('status', 'Confirmed')
            ->count();
        
        $completedAppointments = Appointment::where('status', 'Completed')->count();
        
        $cancelledAppointments = Appointment::where('status', 'Cancelled')->count();
        
        // Pass all stats to the view
        return view('admin.appointments', compact(
            'totalAppointments', 
            'upcomingAppointments', 
            'completedAppointments', 
            'cancelledAppointments'
        ));
    }

    public function getAppointmentsData()
    {
        try {
            $appointments = Appointment::with(['pet.user', 'service'])
                ->orderBy('date', 'desc')
                ->get();
                
            return response()->json([
                'data' => $appointments
            ]);
        } catch (\Exception $e) {
            \Log::error('Error fetching appointments: ' . $e->getMessage());
            return response()->json([
                'error' => 'Failed to load appointments',
                'message' => $e->getMessage(),
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
        // Get all services, excluding boarding-related services
        $services = \App\Models\Service::where(function($query) {
                // Exclude services that have "Boarding" in their name
                $query->whereRaw('LOWER(name) NOT LIKE ?', ['%boarding%']);
            })
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
                'error' => $e->getMessage()
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
                'error' => $e->getMessage()
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
        // Validate request including admin password
        $validator = Validator::make($request->all(), [
            'petID' => 'required|exists:pets,petID',
            'serviceID' => 'required|exists:services,serviceID', 
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'status' => 'required|in:Pending,Confirmed,Completed,Cancelled',
            'before_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'after_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'admin_password' => 'required|string', // Add admin password requirement
        ], [
            'admin_password.required' => 'Admin password is required to update appointments.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Verify admin password
        $admin = auth()->user();
        if (!Hash::check($request->input('admin_password'), $admin->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid admin password. Please enter your current password to confirm this action.'
            ], 401);
        }

        try {
            $appointment = Appointment::findOrFail($id);
            
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
                'message' => 'Failed to update appointment: ' . $e->getMessage()
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
        // Validate admin password
        $validated = $request->validate([
            'admin_password' => 'required|string'
        ], [
            'admin_password.required' => 'Admin password is required to cancel appointments.',
        ]);

        // Verify admin password
        $admin = auth()->user();
        if (!Hash::check($validated['admin_password'], $admin->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid admin password. Please enter your current password to confirm this action.'
            ], 401);
        }

        try {
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
}
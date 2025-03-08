<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Support\Facades\Validator; 

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

    public function cancelAppointment($id)
    {
        try {
            $appointment = Appointment::findOrFail($id);
            $appointment->status = 'Cancelled';
            $appointment->save();
            
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
}
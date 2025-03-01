<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Service;

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
}
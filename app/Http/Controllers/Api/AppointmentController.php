<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends ApiController
{
    /**
     * Get available time slots for a specific date
     */
    public function getAvailableTimes(Request $request)
    {
        try {
            $date = $request->date ?? date('Y-m-d');
            
            // Define business hours (9AM to 5PM)
            $startTime = Carbon::parse($date . ' 09:00:00');
            $endTime = Carbon::parse($date . ' 17:00:00');
            
            // Get all appointment times for the selected date
            $bookedTimes = Appointment::where('date', $date)
                ->pluck('time')
                ->map(function ($time) {
                    return Carbon::parse($time)->format('H:i:00');
                })
                ->toArray();
                
            // Generate time slots (hourly)
            $availableTimes = [];
            $currentTime = clone $startTime;
            
            while ($currentTime < $endTime) {
                $timeSlot = $currentTime->format('H:i:00');
                
                // Check if this time slot is already booked
                if (!in_array($timeSlot, $bookedTimes)) {
                    $availableTimes[] = $timeSlot;
                }
                
                $currentTime->addHour();
            }
            
            return response()->json($availableTimes);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
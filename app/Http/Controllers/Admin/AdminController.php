<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Boarding;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function getUsersData()
    {
        try {
            // Make sure to use the correct column names from your schema
            $users = User::select([
                'userID', 'firstName', 'lastName', 'email', 
                'phone', 'username', 'role', 'userImage', 
                'created_at', 'updated_at'
            ])->get();
            
            // Logging for debugging
            \Log::info('Users data fetched: ' . $users->count() . ' records');
            
            return response()->json(['data' => $users]);
        } catch (\Exception $e) {
            \Log::error('Error fetching users data: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getUpcomingAppointmentsData()
    {
        $upcomingAppointments = Appointment::with(['pet', 'pet.user', 'service'])
            ->where('date', '>=', now()->format('Y-m-d'))
            ->where('status', 'Confirmed')
            ->orderBy('date')
            ->orderBy('time')
            ->limit(10)
            ->get();

        return response()->json([
            'data' => $upcomingAppointments
        ]);
    }

    public function getOngoingBoardingsData()
    {
        $activeBoardings = Boarding::with(['pet', 'pet.user'])
            ->where('start_date', '<=', now()->format('Y-m-d'))
            ->where('end_date', '>=', now()->format('Y-m-d'))
            ->where('status', 'Active')
            ->get();

        return response()->json([
            'active_count' => $activeBoardings->count(),
            'boardings' => $activeBoardings->map(function ($boarding) {
                return [
                    'boardingID' => $boarding->boardingID,
                    'start_date' => $boarding->start_date,
                    'end_date' => $boarding->end_date,
                    'pet' => [
                        'petID' => $boarding->pet->petID,
                        'name' => $boarding->pet->name,
                        'type' => $boarding->pet->species // Using species as type
                    ],
                    'user' => [
                        'userID' => $boarding->pet->user->userID,
                        'firstName' => $boarding->pet->user->firstName,
                        'lastName' => $boarding->pet->user->lastName
                    ]
                ];
            })
        ]);
    }
}
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
            
            return response()->json(['data' => $users]);
        } catch (\Exception $e) {
            \Log::error('Error fetching users data: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            return response()->json(['message' => 'An unexpected error occurred.'], 500);
        }
    }

    public function getUpcomingAppointmentsData()
    {
        $recentThreshold = now()->subDay();

        $upcomingAppointments = Appointment::with(['pet', 'pet.user', 'service', 'payments'])
            ->where(function ($query) use ($recentThreshold) {
                $query->where(function ($subQuery) {
                    $subQuery->whereIn('status', ['Pending', 'Confirmed', 'Active'])
                        ->where('date', '>=', now()->format('Y-m-d'));
                })->orWhere(function ($subQuery) use ($recentThreshold) {
                    $subQuery->where('status', 'Cancelled')
                        ->where('updated_at', '>=', $recentThreshold);
                });
            })
            ->orderByRaw("CASE WHEN status = 'Pending' THEN 0 WHEN status = 'Confirmed' THEN 1 WHEN status = 'Active' THEN 2 WHEN status = 'Cancelled' THEN 3 ELSE 4 END")
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
        $recentThreshold = now()->subDay();

        $dashboardBoardings = Boarding::with(['pet', 'pet.user', 'payments'])
            ->where(function ($query) use ($recentThreshold) {
                $query->where(function ($subQuery) {
                    $subQuery->whereIn('status', ['Pending', 'Confirmed', 'Active'])
                        ->where('end_date', '>=', now()->format('Y-m-d'));
                })->orWhere(function ($subQuery) use ($recentThreshold) {
                    $subQuery->where('status', 'Cancelled')
                        ->where('updated_at', '>=', $recentThreshold);
                });
            })
            ->orderByRaw("CASE WHEN status = 'Pending' THEN 0 WHEN status = 'Confirmed' THEN 1 WHEN status = 'Active' THEN 2 WHEN status = 'Cancelled' THEN 3 ELSE 4 END")
            ->orderBy('start_date')
            ->limit(10)
            ->get();

        $activeBoardingsCount = Boarding::where('start_date', '<=', now()->format('Y-m-d'))
            ->where('end_date', '>=', now()->format('Y-m-d'))
            ->where('status', 'Active')
            ->count();

        return response()->json([
            'active_count' => $activeBoardingsCount,
            'boardings' => $dashboardBoardings->map(function ($boarding) {
                $latestPayment = $boarding->payments->sortByDesc('paymentID')->first();

                return [
                    'boardingID' => $boarding->boardingID,
                    'start_date' => $boarding->start_date,
                    'end_date' => $boarding->end_date,
                    'status' => $boarding->status,
                    'pet' => [
                        'petID' => $boarding->pet->petID,
                        'name' => $boarding->pet->name,
                        'type' => $boarding->pet->species // Using species as type
                    ],
                    'user' => [
                        'userID' => $boarding->pet->user->userID,
                        'firstName' => $boarding->pet->user->firstName,
                        'lastName' => $boarding->pet->user->lastName
                    ],
                    'latest_payment' => $latestPayment ? [
                        'paymentID' => $latestPayment->paymentID,
                        'amount' => $latestPayment->amount,
                        'status' => $latestPayment->status,
                        'payment_method' => $latestPayment->payment_method,
                    ] : null,
                ];
            })
        ]);
    }
}
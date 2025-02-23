<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\BoardingReservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ManageController extends Controller
{
    public function fetchAppointments()
    {
        try {
            $appointments = Appointment::with(['pet', 'service'])
                ->whereHas('pet', function($query) {
                    $query->where('userID', Auth::id());
                })
                ->select('appointments.*')
                ->get();

            return response()->json([
                'draw' => 1,
                'recordsTotal' => $appointments->count(),
                'recordsFiltered' => $appointments->count(),
                'data' => $appointments
            ]);

        } catch (\Exception $e) {
            Log::error('Appointment fetch error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Failed to fetch appointments',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function fetchBoardings()
    {
        try {
            $boardings = BoardingReservation::with('pet')
                ->whereHas('pet', function($query) {
                    $query->where('userID', Auth::id());
                })
                ->select('boarding_reservations.*')
                ->get();

            return response()->json([
                'draw' => 1,
                'recordsTotal' => $boardings->count(),
                'recordsFiltered' => $boardings->count(),
                'data' => $boardings
            ]);

        } catch (\Exception $e) {
            Log::error('Boarding fetch error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Failed to fetch boardings',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // CRUD operations for appointments
    public function showAppointment($id)
    {
        $appointment = Appointment::with(['pet', 'service'])->findOrFail($id);
        return response()->json($appointment);
    }

    public function updateAppointment(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update($request->all());
        return response()->json(['success' => true]);
    }

    public function deleteAppointment($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();
        return response()->json(['success' => true]);
    }

    public function showBoarding($id)
    {
        $boarding = BoardingReservation::with(['pet', 'service'])->findOrFail($id);
        return response()->json($boarding);
    }

    public function updateBoarding(Request $request, $id)
    {
        $boarding = BoardingReservation::findOrFail($id);
        $boarding->update($request->all());
        return response()->json(['success' => true]);
    }

    public function deleteBoarding($id)
    {
        $boarding = BoardingReservation::findOrFail($id);
        $boarding->delete();
        return response()->json(['success' => true]);
    }
}
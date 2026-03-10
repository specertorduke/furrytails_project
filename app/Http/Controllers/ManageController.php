<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Boarding;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ManageController extends Controller
{
    public function fetchAppointments()
    {
        try {
            $appointments = Appointment::with(['pet', 'service', 'payments'])
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
                'error' => 'Failed to fetch appointments'
            ], 500);
        }
    }

    public function fetchBoardings()
    {
        try {
            $boardings = Boarding::with(['pet', 'payments'])
                ->whereHas('pet', function($query) {
                    $query->where('userID', Auth::id());
                })
                ->select('boardings.*')
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
                'error' => 'Failed to fetch boardings'
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
        $appointment = Appointment::with('pet')->findOrFail($id);

        if (!$appointment->pet || $appointment->pet->userID !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $appointment->update($request->only(['date', 'time', 'notes']));
        return response()->json(['success' => true]);
    }

    public function deleteAppointment($id)
    {
        $appointment = Appointment::with('pet')->findOrFail($id);

        if (!$appointment->pet || $appointment->pet->userID !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $appointment->delete();
        return response()->json(['success' => true]);
    }

    public function showBoarding($id)
    {
        $boarding = Boarding::with(['pet', 'service'])->findOrFail($id);
        return response()->json($boarding);
    }

    public function updateBoarding(Request $request, $id)
    {
        $boarding = Boarding::with('pet')->findOrFail($id);

        if (!$boarding->pet || $boarding->pet->userID !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $boarding->update($request->only(['start_date', 'end_date', 'notes']));
        return response()->json(['success' => true]);
    }

    public function deleteBoarding($id)
    {
        $boarding = Boarding::with('pet')->findOrFail($id);

        if (!$boarding->pet || $boarding->pet->userID !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $boarding->delete();
        return response()->json(['success' => true]);
    }
}
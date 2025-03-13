<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Boarding;
use App\Models\Pet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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
            $boardings = Boarding::with('pet')
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
        $boarding = Boarding::with(['pet', 'service'])->findOrFail($id);
        return response()->json($boarding);
    }

    public function updateBoarding(Request $request, $id)
    {
        $boarding = Boarding::findOrFail($id);
        $boarding->update($request->all());
        return response()->json(['success' => true]);
    }

    public function deleteBoarding($id)
    {
        $boarding = Boarding::findOrFail($id);
        $boarding->delete();
        return response()->json(['success' => true]);
    }

    public function getUserPets()
    {
        return Pet::where('userID', Auth::id())->get();
    }

    public function storeAppointment(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'petID' => 'required|exists:pets,petID',
                'serviceID' => 'required|exists:services,serviceID',
                'date' => 'required|date|after:today',
                'time' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Verify pet belongs to user
            $pet = Pet::where('petID', $request->petID)
                ->where('userID', Auth::id())
                ->first();

            if (!$pet) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid pet selection'
                ], 403);
            }

            // Create appointment
            $appointment = new Appointment();
            $appointment->petID = $request->petID;
            $appointment->serviceID = $request->serviceID;
            $appointment->date = $request->date;
            $appointment->time = $request->time;
            $appointment->status = 'Pending';
            $appointment->save();

            return response()->json([
                'success' => true,
                'message' => 'Appointment created successfully',
                'appointment' => $appointment
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create appointment: ' . $e->getMessage()
            ], 500);
        }
    }
}
<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Appointment;
use App\Models\Boarding;

class DashboardController extends Controller
{
    // Your existing index method stays the same
    public function index(Request $request)
    {
        $userId = Auth::id();

        $appointments = Appointment::with(['pet', 'service'])
            ->whereHas('pet', fn($q) => $q->where('userID', $userId))
            ->where('date', '>=', now())
            ->orderBy('date', 'asc')
            ->get();

        $boardings = Boarding::with('pet')
            ->whereHas('pet', fn($q) => $q->where('userID', $userId))
            ->where('end_date', '>=', now())
            ->orderBy('start_date', 'asc')
            ->get();

        $pets = Pet::where('userID', $userId)->get();

        // JSON strings for inline DataTable initialization (no second AJAX roundtrip)
        // JSON_HEX_TAG prevents </script> injection (stored XSS) when embedded in <script> blocks
        $appointmentsJson = $appointments->toJson(JSON_HEX_TAG);
        $boardingsJson    = $boardings->toJson(JSON_HEX_TAG);
        $petsJson         = $pets->toJson(JSON_HEX_TAG);

        return view('content.dashboard', compact(
            'appointments', 'boardings', 'pets',
            'appointmentsJson', 'boardingsJson', 'petsJson'
        ));
    }

    public function getUpcomingAppointments()
    {
        $appointments = Appointment::with(['pet', 'service'])
            ->whereHas('pet', function ($query) {
                $query->where('userID', Auth::id());
            })
            ->where('date', '>=', now())
            ->orderBy('date', 'asc')
            ->get();
    
        // Return in the format DataTables expects
        return response()->json([
            'data' => $appointments
        ]);
    }
    
    public function getCurrentBoardings()
    {
        $boardings = Boarding::with('pet')
            ->whereHas('pet', function ($query) {
                $query->where('userID', Auth::id());
            })
            ->where('end_date', '>=', now())
            ->orderBy('start_date', 'asc')
            ->get();
    
        // Return in the format DataTables expects
        return response()->json([
            'data' => $boardings
        ]);
    }
    
    public function getPets()
    {
        $pets = Pet::where('userID', Auth::id())
            ->get();
    
        // Return in the format DataTables expects
        return response()->json([
            'data' => $pets
        ]);
    }
}
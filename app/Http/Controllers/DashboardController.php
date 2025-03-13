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
        $pets = Pet::where('userID', Auth::id())->get();
        
        $appointments = Appointment::whereHas('pet', function ($query) {
            $query->where('userID', Auth::id());
        })->where('date', '>=', now())
          ->orderBy('date', 'asc')
          ->get();
          
        $boardings = Boarding::whereHas('pet', function ($query) {
            $query->where('userID', Auth::id());
        })->where('end_date', '>=', now())
          ->orderBy('start_date', 'asc')
          ->get();
          
        return view('content.dashboard', compact('appointments', 'boardings', 'pets'));
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
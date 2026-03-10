<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Appointment;
use App\Models\Boarding;
use Carbon\Carbon;

class DashboardController extends Controller
{
    private function visibleAppointmentsQuery(int $userId)
    {
        $today = Carbon::today()->toDateString();
        $recentThreshold = Carbon::now()->subDay();

        return Appointment::with(['pet', 'service'])
            ->whereHas('pet', fn($q) => $q->where('userID', $userId))
            ->where(function ($query) use ($today, $recentThreshold) {
                $query->where(function ($subQuery) use ($today) {
                    $subQuery->whereIn('status', ['Pending', 'Confirmed', 'Active'])
                        ->where('date', '>=', $today);
                })->orWhere(function ($subQuery) use ($recentThreshold) {
                    $subQuery->where('status', 'Cancelled')
                        ->where('updated_at', '>=', $recentThreshold);
                });
            })
            ->orderByRaw("CASE WHEN status = 'Cancelled' THEN 1 ELSE 0 END")
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc');
    }

    private function visibleBoardingsQuery(int $userId)
    {
        $today = Carbon::today()->toDateString();
        $recentThreshold = Carbon::now()->subDay();

        return Boarding::with('pet')
            ->whereHas('pet', fn($q) => $q->where('userID', $userId))
            ->where(function ($query) use ($today, $recentThreshold) {
                $query->where(function ($subQuery) use ($today) {
                    $subQuery->whereIn('status', ['Pending', 'Confirmed', 'Active'])
                        ->where('end_date', '>=', $today);
                })->orWhere(function ($subQuery) use ($recentThreshold) {
                    $subQuery->where('status', 'Cancelled')
                        ->where('updated_at', '>=', $recentThreshold);
                });
            })
            ->orderByRaw("CASE WHEN status = 'Cancelled' THEN 1 ELSE 0 END")
            ->orderBy('start_date', 'asc');
    }

    // Your existing index method stays the same
    public function index(Request $request)
    {
        $userId = Auth::id();

        $appointments = $this->visibleAppointmentsQuery($userId)->get();

        $boardings = $this->visibleBoardingsQuery($userId)->get();

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
        $appointments = $this->visibleAppointmentsQuery(Auth::id())->get();
    
        // Return in the format DataTables expects
        return response()->json([
            'data' => $appointments
        ]);
    }
    
    public function getCurrentBoardings()
    {
        $boardings = $this->visibleBoardingsQuery(Auth::id())->get();
    
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
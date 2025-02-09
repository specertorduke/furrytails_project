<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Appointment;
use App\Models\BoardingReservation;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Fetch upcoming appointments
        $appointments = Appointment::where('date', '>=', now())->orderBy('date', 'asc')->get();

        // Fetch upcoming boarding reservations
        $boardingReservations = BoardingReservation::where('startDate', '>=', now())->orderBy('startDate', 'asc')->get();

        // Fetch registered pets
        $pets = Pet::all();

        return view('content.dashboard', compact('appointments', 'boardingReservations', 'pets'));
    }
}
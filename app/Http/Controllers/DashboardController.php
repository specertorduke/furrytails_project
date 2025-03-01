<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Appointment;
use App\Models\Boarding;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Fetch pets that belong to the authenticated user
        $pets = Pet::where('userID', Auth::id())->get();

        // Fetch upcoming appointments that belong to the authenticated user's pets
        $appointments = Appointment::whereHas('pet', function ($query) {
            $query->where('userID', Auth::id());
        })->where('date', '>=', now())
          ->orderBy('date', 'asc')
          ->get();

        // Fetch upcoming boarding reservations that belong to the authenticated user's pets
        $boardingReservations = Boarding::whereHas('pet', function ($query) {
            $query->where('userID', Auth::id());
        })->where('start_date', '>=', now())
          ->orderBy('start_date', 'asc')
          ->get();

        return view('content.dashboard', compact('appointments', 'boardingReservations', 'pets'));
    }
}
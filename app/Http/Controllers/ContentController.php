<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\Boarding;
use App\Models\Service;

class ContentController extends Controller
{
    // Methods to return only the main content without layout
    public function exploreContent()
    {
        return view('content.explore');
    }

    public function manageContent()
    {
        $userId = Auth::id();

        // Inline JSON eliminates the AJAX roundtrip on page load
        // JSON_HEX_TAG prevents </script> injection (stored XSS) when embedded in <script> blocks
        $appointmentsJson = Appointment::with(['pet', 'service'])
            ->whereHas('pet', fn($q) => $q->where('userID', $userId))
            ->select('appointments.*')
            ->get()
            ->toJson(JSON_HEX_TAG);

        $boardingsJson = Boarding::with('pet')
            ->whereHas('pet', fn($q) => $q->where('userID', $userId))
            ->select('boardings.*')
            ->get()
            ->toJson(JSON_HEX_TAG);

        return view('content.manage', compact('appointmentsJson', 'boardingsJson'));
    }

    public function petsContent()
    {
        return view('content.pets');
    }

    public function historyContent()
    {
        return view('content.history');
    }

    public function accountContent()
    {
        return view('content.account');
    }

    public function aboutContent()
    {
        return view('content.about');
    }

    public function servicesContent()
    {
        $services = Service::query()
            // Removed the ->where('isActive', true) so unavailable services actually show up
            ->orderBy('category')
            ->orderBy('name')
            // Added the 3 missing columns to the get() array!
            ->get([
                'serviceID', 
                'name', 
                'description', 
                'category', 
                'price', 
                'serviceImage',
                'isActive', 
                'unavailability_reason', 
                'expected_return'
            ]);

        return view('content.services', compact('services'));
    }
}
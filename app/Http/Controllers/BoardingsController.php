<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Boarding;
use App\Models\Payment;
use App\Models\Service;
use App\Models\Pet;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Helpers\ActivityLogger; 

class BoardingsController extends Controller
{
    /**
     * Store a new boarding
     */
    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'petID' => 'required|exists:pets,petID',
            'boardingType' => 'required|in:Daycare,Overnight,Extended',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'payment_method' => 'required|in:Cash,Credit Card,Debit Card,PayPal,GCash,Bank Transfer,Other',
            'payment_reference' => 'nullable|string|max:255',
        ]);

        // Get the service to determine the price
        $service = Service::findOrFail($request->serviceID);

        // Calculate duration and price
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        
        // Include both start and end days in calculation
        $days = $startDate->diffInDays($endDate) + 1;
        
        // For daycare type, ensure price is just for one day
        if ($request->boardingType === 'Daycare') {
            $days = 1;
        }
        
        // Use the price from the service
        $pricePerDay = $service->price;
        $totalPrice = $pricePerDay * $days;

        // Begin transaction
        DB::beginTransaction();

        try {
            // Create the boarding
            $boarding = new Boarding();
            $boarding->petID = $request->petID;
            $boarding->boardingType = $request->boardingType;
            $boarding->start_date = $request->start_date;
            $boarding->end_date = $request->end_date;
            $boarding->status = 'Confirmed';
            $boarding->save();

            // Create payment record
            $payment = new Payment();
            $payment->userID = Auth::id();
            $payment->amount = $totalPrice;
            $payment->payment_method = $request->payment_method;
            $payment->reference_number = $request->payment_reference;
            $payment->status = $request->payment_method === 'Cash' ? 'Pending' : 'Completed';
            
            // Set polymorphic relationship
            $payment->payable_id = $boarding->boardingID;
            $payment->payable_type = 'App\Models\Boarding';
            
            $payment->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Boarding booked successfully',
                'boarding' => $boarding,
                'payment' => $payment
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating boarding: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while booking the boarding',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Cancel a boarding
     */
    public function cancelBoarding($id)
    {
        $boarding = Boarding::findOrFail($id);
        
        // Check if user owns this boarding via the pet
        $pet = Pet::find($boarding->petID);
        if (!$pet || Auth::id() !== $pet->userID) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }
        
        // Check if boarding can be cancelled
        if (in_array($boarding->status, ['Cancelled', 'Completed'])) {
            return response()->json([
                'success' => false,
                'message' => 'This boarding cannot be cancelled'
            ], 400);
        }
        
        // Cancel the boarding
        $boarding->status = 'Cancelled';
        $boarding->save();
        
        // Log the cancellation
        ActivityLogger::log(
            'boardings',
            $boarding->boardingID,
            'update',
            ['status' => 'Confirmed'], // Old status
            ['status' => 'Cancelled']  // New status
        );
            
        return response()->json([
            'success' => true,
            'message' => 'Boarding cancelled successfully'
        ]);
    }

    public function getBoardingServices()
    {
        // Get services with "boarding" in the name or "daycare"
        $services = Service::where('name', 'like', '%boarding%')
                        ->orWhere('name', 'like', '%daycare%')
                        ->get();
                        
        return response()->json($services);
    }
}
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
use Illuminate\Support\Facades\Validator; 


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
     * Get boarding details for view modal
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            // Get boarding with pet, user, AND PAYMENT information
            $boarding = Boarding::with(['pet.user', 'payments'])
                ->findOrFail($id);
                
            // Get the service information for this boarding type
            $service = \App\Models\Service::where('category', 'boarding')
                ->where('name', 'LIKE', '%'.$boarding->boardingType.'%')
                ->first();
                
            // Add service price info to the boarding data
            $boarding->baseRate = $service ? $service->price : 0;
                
            // Get boarding history for this pet
            $boardingHistory = Boarding::where('petID', $boarding->petID)
                ->where('boardingID', '!=', $id)
                ->orderBy('start_date', 'desc')
                ->take(5)
                ->get();
                
            return response()->json([
                'success' => true,
                'boarding' => $boarding,
                'boardingHistory' => $boardingHistory
            ]);
        } catch (\Exception $e) {
            \Log::error('Error fetching boarding details: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve boarding details',
                'error' => $e->getMessage()
            ], 404);
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

    /**
     * Get all boarding services for the dropdown
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBServices()
    {
        try {
            // Get all active boarding services
            $services = Service::where(function($query) {
                    $query->where('type', 'boarding')
                        ->orWhere('name', 'like', '%boarding%')
                        ->orWhere('name', 'like', '%daycare%');
                })
                ->where('status', 'active')
                ->orderBy('name')
                ->get();
                
            return response()->json([
                'success' => true,
                'services' => $services
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching boarding services: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to load services. Please try again.'
            ], 500);
        }
    }

    /**
     * Update boarding details
     * 
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'petID' => 'required|exists:pets,petID',
            'boardingType' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:Confirmed,Active,Completed,Cancelled',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();
            
            // Update boarding
            $boarding = Boarding::findOrFail($id);
            $boarding->petID = $request->petID;
            $boarding->boardingType = $request->boardingType;
            $boarding->start_date = $request->start_date;
            $boarding->end_date = $request->end_date;
            $boarding->status = $request->status;
            $boarding->save();
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Boarding updated successfully',
                'boarding' => $boarding
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error updating boarding: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update boarding: ' . $e->getMessage(),
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function showPet($id)
    {
        try {
            $pet = \App\Models\Pet::with('user')->findOrFail($id);
            
            // Calculate age from birth date
            $birthDate = \Carbon\Carbon::parse($pet->birthDate);
            $pet->age = $birthDate->diffForHumans(null, true);
            
            // Format vaccination date if exists
            if ($pet->lastVaccinationDate) {
                $pet->vaccinationDate = \Carbon\Carbon::parse($pet->lastVaccinationDate)->format('Y-m-d');
            }
            
            // Ensure pet image path is properly formatted
            if ($pet->petImage) {
                $pet->petImage = str_replace('public/', '', $pet->petImage);
            }
            
            return response()->json([
                'success' => true,
                'pet' => $pet
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve pet data',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
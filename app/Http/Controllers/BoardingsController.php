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
use Illuminate\Support\Facades\Hash;
use App\Models\ActivityLog;


class BoardingsController extends Controller
{
/**
 * Store a new boarding with capacity check
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
        'serviceID' => 'required|exists:services,serviceID'
    ]);

    // Begin transaction for concurrency safety
    DB::beginTransaction();

    try {
        // Check boarding capacity with exclusive lock
        $capacityCheck = $this->checkBoardingCapacity($request->start_date, $request->end_date);
        
        if (!$capacityCheck['hasCapacity']) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => "We're sorry, but we've reached our maximum boarding capacity for these dates. Please select different dates or contact us.",
                'capacity' => [
                    'current' => $capacityCheck['currentCount'],
                    'maximum' => $capacityCheck['maxCapacity']
                ]
            ], 409); // Conflict status code
        }

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
                
                \Log::info('Pet data for boarding #' . $id, [
                    'has_pet' => isset($boarding->pet),
                    'pet_data' => $boarding->pet ?? 'No pet found'
                ]); 
                
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
    // public function cancelBoarding($id)
    // {
    //     $boarding = Boarding::findOrFail($id);
        
    //     // Check if user owns this boarding via the pet
    //     $pet = Pet::find($boarding->petID);
    //     if (!$pet || Auth::id() !== $pet->userID) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Unauthorized'
    //         ], 403);
    //     }
        
    //     // Check if boarding can be cancelled
    //     if (in_array($boarding->status, ['Cancelled', 'Completed'])) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'This boarding cannot be cancelled'
    //         ], 400);
    //     }
        
    //     // Cancel the boarding
    //     $boarding->status = 'Cancelled';
    //     $boarding->save();
        
    //     // Log the cancellation
    //     ActivityLogger::log(
    //         'boardings',
    //         $boarding->boardingID,
    //         'update',
    //         ['status' => 'Confirmed'], // Old status
    //         ['status' => 'Cancelled']  // New status
    //     );
            
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Boarding cancelled successfully'
    //     ]);
    // }

    public function cancel(Request $request, $id)
    {
        // Validate user password
        $validated = $request->validate([
            'user_password' => 'required|string'
        ], [
            'user_password.required' => 'Password is required to cancel boardings.',
        ]);

        // Verify user password
        $user = auth()->user();
        if (!Hash::check($validated['user_password'], $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid password. Please enter your current password to confirm this action.'
            ], 401);
        }

        try {
            $boarding = Boarding::with('pet')->findOrFail($id);
            
            // Make sure the boarding belongs to the authenticated user
            if ($boarding->pet->userID !== auth()->id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }
            
            // Store original values for logging
            $originalStatus = $boarding->status;
            
            $boarding->status = 'Cancelled';
            $boarding->save();

            // Log the cancellation action
            ActivityLog::create([
                'table_name' => 'boardings',
                'record_id' => $boarding->boardingID,
                'action' => 'update',
                'old_values' => json_encode(['status' => $originalStatus]),
                'new_values' => json_encode([
                    'status' => 'Cancelled',
                    'cancelled_by_user' => true
                ]),
                'userID' => auth()->id(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Boarding cancelled successfully'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error cancelling boarding: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to cancel boarding'
            ], 500);
        }
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
 * Update boarding details with capacity check
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
        
        // Get the current boarding
        $boarding = Boarding::findOrFail($id);
        
        // If dates are changing and status is active/confirmed, check capacity
        if (($boarding->start_date != $request->start_date || $boarding->end_date != $request->end_date) &&
            in_array($request->status, ['Confirmed', 'Active'])) {
            
            $capacityCheck = $this->checkBoardingCapacity($request->start_date, $request->end_date, $id);
            
            if (!$capacityCheck['hasCapacity']) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => "We're sorry, but we've reached our maximum boarding capacity for these dates. Please select different dates.",
                    'capacity' => [
                        'current' => $capacityCheck['currentCount'],
                        'maximum' => $capacityCheck['maxCapacity']
                    ]
                ], 409); // Conflict status code
            }
        }
        
        // Update boarding
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

    /**
 * Check if there's available capacity for the given date range
 *
 * @param string $startDate
 * @param string $endDate
 * @param int|null $excludeBoardingId Optional ID to exclude from count (for updates)
 * @return array [bool hasCapacity, int currentCount, int maxCapacity]
 */
private function checkBoardingCapacity($startDate, $endDate, $excludeBoardingId = null)
{
    // Get maximum capacity from settings
    $maxCapacity = \App\Models\Setting::where('key', 'boarding_capacity')->first()->value ?? 20;
    
    // Query to find overlapping active bookings
    $query = Boarding::where(function($query) use ($startDate, $endDate) {
            // Bookings that start during our period
            $query->whereBetween('start_date', [$startDate, $endDate])
                // Or bookings that end during our period
                ->orWhereBetween('end_date', [$startDate, $endDate])
                // Or bookings that start before and end after our period
                ->orWhere(function($q) use ($startDate, $endDate) {
                    $q->where('start_date', '<=', $startDate)
                      ->where('end_date', '>=', $endDate);
                });
        })
        ->whereIn('status', ['Confirmed', 'Active']);
    
    // Exclude the current booking if we're updating
    if ($excludeBoardingId) {
        $query->where('boardingID', '!=', $excludeBoardingId);
    }
    
    // Get the count with locking to prevent race conditions
    $currentBookings = $query->lockForUpdate()->count();
    
    // Check if we're at capacity
    $hasCapacity = $currentBookings < $maxCapacity;
    
    return [
        'hasCapacity' => $hasCapacity,
        'currentCount' => $currentBookings,
        'maxCapacity' => $maxCapacity
    ];
}

/**
 * Check capacity for given dates (for frontend preview)
 */
public function checkAvailability(Request $request)
{
    $request->validate([
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date'
    ]);
    
    try {
        $capacityCheck = $this->checkBoardingCapacity($request->start_date, $request->end_date);
        
        return response()->json([
            'success' => true,
            'available' => $capacityCheck['hasCapacity'],
            'currentCount' => $capacityCheck['currentCount'],
            'maxCapacity' => $capacityCheck['maxCapacity'],
            'remainingSpots' => $capacityCheck['maxCapacity'] - $capacityCheck['currentCount']
        ]);
    } catch (\Exception $e) {
        \Log::error('Error checking boarding availability: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Failed to check availability',
            'error' => $e->getMessage()
        ], 500);
    }
}
}
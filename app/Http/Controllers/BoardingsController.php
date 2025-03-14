<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Boarding;
use App\Models\Payment;
use App\Models\Pet;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'boardingType' => 'required|in:Standard,Deluxe,Premium',
            'payment_method' => 'required|in:Cash,Credit Card,Debit Card,PayPal,GCash,Bank Transfer,Other',
            'payment_reference' => 'nullable|string|max:255',
        ]);

        // Calculate duration and price
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $days = $startDate->diffInDays($endDate) + 1; // Include both start and end days
        
        // Set price based on boarding type
        $pricePerDay = 0;
        switch ($request->boardingType) {
            case 'Premium':
                $pricePerDay = 800;
                break;
            case 'Deluxe':
                $pricePerDay = 600;
                break;
            case 'Standard':
            default:
                $pricePerDay = 400;
                break;
        }
        
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

            // Log the activity
            activity()
                ->causedBy(Auth::user())
                ->performedOn($boarding)
                ->withProperties([
                    'petID' => $boarding->petID,
                    'boardingType' => $boarding->boardingType,
                    'start_date' => $boarding->start_date,
                    'end_date' => $boarding->end_date,
                    'days' => $days,
                    'payment_status' => $payment->status
                ])
                ->log('boarding_created');

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
        activity()
            ->causedBy(Auth::user())
            ->performedOn($boarding)
            ->log('boarding_cancelled');
            
        return response()->json([
            'success' => true,
            'message' => 'Boarding cancelled successfully'
        ]);
    }
}
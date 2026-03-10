<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Appointment;
use Auth;
use DB;

class PaymentsController extends Controller
{
    /**
     * Store a newly created payment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'appointmentID'    => 'required|exists:appointments,appointmentID',
                'payment_method'   => 'required|in:Cash,Credit Card,Debit Card,PayPal,GCash,Bank Transfer,Other',
                'reference_number' => 'nullable|string|max:255',
            ]);

            // Begin database transaction
            DB::beginTransaction();
            
            // Get the appointment
            $appointment = Appointment::with('pet')->findOrFail($request->appointmentID);

            // Ensure the appointment belongs to the authenticated user
            if (!$appointment->pet || $appointment->pet->userID !== Auth::id()) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized',
                ], 403);
            }
            
            // Get the service price
            $amount = $appointment->service->price;
            
            // Create payment record
            $payment = new Payment();
            $payment->amount = $amount;
            $payment->payment_method = $request->payment_method;
            $payment->reference_number = $request->reference_number;
            $payment->status = $request->payment_method === 'Cash' ? 'Pending' : 'Completed';
            $payment->userID = Auth::id();
            
            // Set the polymorphic relationship
            $payment->payable_id = $appointment->appointmentID;
            $payment->payable_type = 'App\\Models\\Appointment';
            
            $payment->save();
            
            // Update appointment status if payment is completed
            if ($payment->status === 'Completed') {
                $appointment->status = 'Confirmed';
                $appointment->save();
            }
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Payment recorded successfully',
                'payment' => $payment
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Payment failed.'
            ], 500);
        }
    }
}
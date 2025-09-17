<?php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\ActivityLog;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Boarding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // Add this import
use Carbon\Carbon;

class AdminPaymentsController extends Controller
{
    // ...existing code...

    /**
     * Update payment record
     */
    public function update(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);
        
        $validated = $request->validate([
            'payment_method' => 'required|in:Cash,Credit Card,Debit Card,PayPal,GCash,Bank Transfer,Other',
            'reference_number' => 'nullable|string',
            'status' => 'required|in:Pending,Completed,Failed,Refunded',
            'amount' => 'required|numeric|min:0',
            'password' => 'required|string' // Add password requirement
        ]);

        // Verify admin password
        $admin = auth()->user();
        if (!Hash::check($validated['password'], $admin->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid password. Please enter your current password to confirm this action.'
            ], 401);
        }

        // Remove password from validated data before updating
        unset($validated['password']);
        
        // Log the original state before update
        ActivityLog::create([
            'table_name' => 'payments',
            'record_id' => $payment->paymentID,
            'action' => 'update',
            'old_values' => json_encode($payment->toArray()),
            'new_values' => json_encode(array_merge($validated, [
                'admin_id' => $admin->userID,
                'admin_name' => $admin->firstName . ' ' . $admin->lastName
            ])),
            'userID' => auth()->id(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);
        
        $payment->update($validated);
        
        return response()->json([
            'success' => true,
            'message' => 'Payment updated successfully',
            'data' => $payment
        ]);
    }

    /**
     * Mark payment as refunded
     */
    public function markAsRefunded(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);
        
        // Validate password
        $validated = $request->validate([
            'password' => 'required|string'
        ]);

        // Verify admin password
        $admin = auth()->user();
        if (!Hash::check($validated['password'], $admin->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid password. Please enter your current password to confirm this action.'
            ], 401);
        }
        
        if ($payment->status !== 'Completed') {
            return response()->json([
                'success' => false,
                'message' => 'Only completed payments can be refunded'
            ], 400);
        }
        
        // Log the change
        ActivityLog::create([
            'table_name' => 'payments',
            'record_id' => $payment->paymentID,
            'action' => 'update',
            'old_values' => json_encode(['status' => $payment->status]),
            'new_values' => json_encode([
                'status' => 'Refunded',
                'admin_id' => $admin->userID,
                'admin_name' => $admin->firstName . ' ' . $admin->lastName
            ]),
            'userID' => auth()->id(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);
        
        $payment->status = 'Refunded';
        $payment->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Payment has been marked as refunded'
        ]);
    }

    // ...rest of existing code...
}
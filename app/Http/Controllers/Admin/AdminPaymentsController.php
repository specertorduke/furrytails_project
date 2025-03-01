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
use Carbon\Carbon;

class AdminPaymentsController extends Controller
{
    /**
     * Display the payments management page
     */
    public function index()
    {
        // Get payment statistics
        $totalPayments = Payment::count();
        $completedPayments = Payment::where('status', 'Completed')->count();
        $pendingPayments = Payment::where('status', 'Pending')->count();
        $totalRevenue = Payment::where('status', 'Completed')->sum('amount');

        return view('admin.payments', compact(
            'totalPayments',
            'completedPayments',
            'pendingPayments',
            'totalRevenue'
        ));
    }

    /**
     * Get payments data for DataTables
     */
    public function getPaymentsData()
    {
        $payments = Payment::with('user')
            ->select('payments.*')
            ->orderBy('created_at', 'desc')
            ->get();

        // Load related service info
        foreach ($payments as $payment) {
            if ($payment->payable_type == 'App\Models\Appointment') {
                $appointment = Appointment::with('service')->find($payment->payable_id);
                if ($appointment) {
                    $payment->service_info = [
                        'name' => $appointment->service->name ?? 'Appointment',
                        'id' => $appointment->appointmentID
                    ];
                }
            } elseif ($payment->payable_type == 'App\Models\Boarding') {
                $boarding = Boarding::find($payment->payable_id);
                if ($boarding) {
                    $payment->service_info = [
                        'name' => 'Boarding: ' . $boarding->boardingType,
                        'id' => $boarding->boardingID
                    ];
                }
            }
        }

        return response()->json([
            'data' => $payments
        ]);
    }

    /**
     * Show payment details
     */
    public function show($id)
    {
        $payment = Payment::with('user')->findOrFail($id);
        
        // Get related service details
        if ($payment->payable_type == 'App\Models\Appointment') {
            $payment->service = Appointment::with(['service', 'pet'])->find($payment->payable_id);
        } elseif ($payment->payable_type == 'App\Models\Boarding') {
            $payment->service = Boarding::with('pet')->find($payment->payable_id);
        }
        
        return response()->json([
            'success' => true,
            'data' => $payment
        ]);
    }

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
            'amount' => 'required|numeric|min:0'
        ]);
        
        // Log the original state before update
        ActivityLog::create([
            'table_name' => 'payments',
            'record_id' => $payment->paymentID,
            'action' => 'update',
            'old_values' => json_encode($payment->toArray()),
            'new_values' => json_encode($validated),
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
            'new_values' => json_encode(['status' => 'Refunded']),
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
    
    /**
     * Store a new payment record
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'userID' => 'required|exists:users,userID',
            'payable_type' => 'required|string',
            'payable_id' => 'required|integer',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|in:Cash,Credit Card,Debit Card,PayPal,GCash,Bank Transfer,Other',
            'reference_number' => 'nullable|string',
            'status' => 'required|in:Pending,Completed,Failed,Refunded'
        ]);
        
        $payment = Payment::create($validated);
        
        // Log the creation
        ActivityLog::create([
            'table_name' => 'payments',
            'record_id' => $payment->paymentID,
            'action' => 'create',
            'new_values' => json_encode($payment->toArray()),
            'userID' => auth()->id(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Payment recorded successfully',
            'data' => $payment
        ]);
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\BoardingReservation;
use App\Models\Payment;
use Carbon\Carbon;

class HistoryController extends Controller
{
    public function index()
    {
        $history = collect();
        $user = Auth::user();

        // Get appointments
        $appointments = Auth::user()->appointments()
            ->with(['service', 'pet', 'payments'])  
            ->get()
            ->map(function($appointment) {
                return (object)[
                    'id' => $appointment->appointmentID,
                    'type' => 'appointment',
                    'serviceName' => $appointment->service->name,
                    'petName' => $appointment->pet->name,
                    'status' => $appointment->status,
                    'date' => $appointment->date,
                    'time' => $appointment->time,
                    'payments' => $appointment->payments->map(function($payment) {
                        return [
                            'amount' => $payment->amount,
                            'method' => $payment->method,
                            'status' => $payment->status,
                            'timestamp' => $payment->timestamp,
                            'type' => $payment->type // e.g., 'downpayment', 'full', 'balance'
                        ];
                    })
                ];
            });
        
        // Get boarding reservations
        $boardings = Auth::user()->boardingReservations()
            ->with(['pet', 'payments'])  // Changed to payments
            ->get()
            ->map(function($boarding) {
                return (object)[
                    'id' => $boarding->boardingID,
                    'type' => 'boarding',
                    'serviceName' => $boarding->boardingType . ' Boarding',
                    'petName' => $boarding->pet->name,
                    'status' => $boarding->status,
                    'startDate' => $boarding->startDate,
                    'endDate' => $boarding->endDate,
                    'payments' => $boarding->payments->map(function($payment) {
                        return [
                            'amount' => $payment->amount,
                            'method' => $payment->method,
                            'status' => $payment->status,
                            'timestamp' => $payment->timestamp,
                            'type' => $payment->type // e.g., 'downpayment', 'full', 'balance'
                        ];
                    })
                ];
            });
        
        // Merge and sort by date
        $history = $appointments->concat($boardings)->sortByDesc(function($item) {
                return $item->type === 'appointment' 
                    ? $item->date 
                    : $item->startDate;
        });
        
        $appointmentsCount = $user->appointments()->count();
        $boardingsCount = $user->boardingReservations()->count();

        return view('content.history', compact('history', 'appointmentsCount', 'boardingsCount'));
    }
}
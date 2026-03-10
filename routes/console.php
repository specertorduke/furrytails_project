<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Auto-update appointment and boarding statuses every hour
Schedule::call(function () {
    // Appointment statuses (Confirmed→Active→Completed / Missed)
    try {
        app(\App\Http\Controllers\Admin\AdminAppointmentsController::class)->updateStatuses();
    } catch (\Exception $e) {
        Log::error('Appointment status update failed: ' . $e->getMessage());
    }

    // Boarding statuses (Confirmed→Active on start_date, Active→Completed after end_date)
    try {
        \App\Models\Boarding::where('status', 'Confirmed')
            ->where('start_date', '<=', now()->toDateString())
            ->each(function ($boarding) {
                $boarding->status = 'Active';
                $boarding->save();
            });

        \App\Models\Boarding::where('status', 'Active')
            ->where('end_date', '<', now()->toDateString())
            ->each(function ($boarding) {
                $boarding->status = 'Completed';
                $boarding->save();
            });
    } catch (\Exception $e) {
        Log::error('Boarding status update failed: ' . $e->getMessage());
    }
})->hourly()->name('update-booking-statuses');

// Send day-before reminder emails every day at 9 AM
Schedule::call(function () {
    $tomorrow = now()->addDay()->toDateString();

    // Appointment reminders
    \App\Models\Appointment::with(['pet.user', 'service'])
        ->where('date', $tomorrow)
        ->whereIn('status', ['Pending', 'Confirmed'])
        ->each(function ($appointment) {
            $user = $appointment->pet->user ?? null;
            if ($user && $user->email) {
                try {
                    Mail::to($user->email)
                        ->send(new \App\Mail\DayBeforeReminder($appointment, 'appointment', $user));
                } catch (\Exception $e) {
                    Log::error('Appointment reminder failed (ID ' . $appointment->appointmentID . '): ' . $e->getMessage());
                }
            }
        });

    // Boarding reminders
    \App\Models\Boarding::with(['pet.user'])
        ->where('start_date', $tomorrow)
        ->where('status', 'Confirmed')
        ->each(function ($boarding) {
            $user = $boarding->pet->user ?? null;
            if ($user && $user->email) {
                try {
                    Mail::to($user->email)
                        ->send(new \App\Mail\DayBeforeReminder($boarding, 'boarding', $user));
                } catch (\Exception $e) {
                    Log::error('Boarding reminder failed (ID ' . $boarding->boardingID . '): ' . $e->getMessage());
                }
            }
        });
})->dailyAt('09:00')->name('send-day-before-reminders');


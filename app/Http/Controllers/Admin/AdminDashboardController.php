<?php

namespace App\Http\Controllers\Admin;

class AdminDashboardController extends AdminController
{
    public function index()
    {
        $stats = [
            'users_count' => \App\Models\User::count(),
            'appointments_count' => \App\Models\Appointment::count(),
            'boardings_count' => \App\Models\BoardingReservation::count(),
            'services_count' => \App\Models\Service::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
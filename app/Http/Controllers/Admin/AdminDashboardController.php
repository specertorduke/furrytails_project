<?php

namespace App\Http\Controllers\Admin;

class AdminDashboardController extends AdminController
{
    public function index()
    {
        $stats = [
            'users_count' => \App\Models\User::count(),
            'appointments_count' => \App\Models\Appointment::count(),
            'boardings_count' => \App\Models\Boarding::count(),
            'services_count' => \App\Models\Service::count(),
            'pets_count' => \App\Models\Pet::count()
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
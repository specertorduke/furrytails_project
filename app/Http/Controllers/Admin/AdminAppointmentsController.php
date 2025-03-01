<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;


class AdminAppointmentsController extends Controller
{
    public function index()
    {
        $appointments = Appointment::all();
        return view('admin.appointments', compact('appointments'));
    }
}
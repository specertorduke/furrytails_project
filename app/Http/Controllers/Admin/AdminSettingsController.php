<?php

namespace App\Http\Controllers\Admin;

class AdminDashboardController extends AdminController
{
    public function index()
    {
        return view('admin.settings');
    }
}
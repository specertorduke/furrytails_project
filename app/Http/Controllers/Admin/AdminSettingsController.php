<?php

namespace App\Http\Controllers\Admin;

class AdminSettingsController extends AdminController
{
    public function index()
    {
        return view('admin.settings');
    }
}
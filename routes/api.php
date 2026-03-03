<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PetController;
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\ServiceController;

// Service routes — public (no PII)
Route::get('/services', function() {
    $services = \App\Models\Service::select('serviceID', 'name', 'price', 'description')
        ->orderBy('name')
        ->get();
    return response()->json($services);
});

Route::get('/appointments/available-times', function(Request $request) {
    $date = $request->date ?? date('Y-m-d');
    
    // Return sample available times for now
    $times = ['09:00:00', '10:00:00', '11:00:00', '13:00:00', '14:00:00', '15:00:00', '16:00:00'];
    return response()->json($times);
});

// Authenticated routes — require login
Route::middleware('auth')->group(function () {
    // User routes
    Route::get('/users', function() {
        $users = \App\Models\User::select('userID', 'firstName', 'lastName')
            ->orderBy('lastName')
            ->orderBy('firstName')
            ->get();
        return response()->json($users);
    });

    // Pet routes — scoped to the requesting user's own pets
    Route::get('/users/{user}/pets', function($userId) {
        // Only allow a user to query their own pets
        if ((int)$userId !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $pets = \App\Models\Pet::where('userID', $userId)
            ->select('petID', 'name', 'species')
            ->orderBy('name')
            ->get();
        return response()->json($pets);
    });
});
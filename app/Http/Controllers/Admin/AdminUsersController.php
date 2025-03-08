<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class AdminUsersController extends Controller
{
    public function index()
    {
        // Get total users count
        $totalUsers = User::count();
        
        // Get active users (assuming all users are active since there's no is_active field)
        $activeUsers = $totalUsers;
        
        // Get new users in the last 30 days
        $newUsers = User::where('created_at', '>=', Carbon::now()->subDays(30))->count();
        
        return view('admin.users', compact('totalUsers', 'activeUsers', 'newUsers'));
    }

    /**
     * Get a list of all users for dropdown selection
     */
    public function getUsersList()
    {
        try {
            $users = User::select('userID', 'firstName', 'lastName')
                ->orderBy('firstName')
                ->orderBy('lastName')
                ->get();
                
            return response()->json($users);
        } catch (\Exception $e) {
            \Log::error('Error fetching users list: ' . $e->getMessage());
            return response()->json([], 500);
        }
    }
    
    /**
     * Get all pets belonging to a specific user
     */
    public function getUserPets($userId) 
    {
        try {
            $pets = \App\Models\Pet::where('userID', $userId)->get();
            return response()->json($pets);
        } catch (\Exception $e) {
            \Log::error('Error fetching pets: ' . $e->getMessage());
            return response()->json([]);
        }
    }
}
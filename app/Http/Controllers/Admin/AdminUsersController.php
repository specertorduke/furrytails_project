<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash; 

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

    public function storeUser(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'firstName' => 'required|string|max:100',
            'lastName' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|unique:users,username|max:50',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8',
            'role' => 'required|in:user,admin',
            'userImage' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle image upload if present
        $imagePath = null;
        if ($request->hasFile('userImage')) {
            $imagePath = $request->file('userImage')->store('images/users', 'public');
        }

        // Create new user
        $user = new User();
        $user->firstName = $validated['firstName'];
        $user->lastName = $validated['lastName'];
        $user->email = $validated['email'];
        $user->username = $validated['username'];
        $user->phone = $validated['phone'];
        $user->password = Hash::make($validated['password']);
        $user->role = $validated['role'];
        $user->userImage = $imagePath;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'user' => $user
        ]);
    }
}
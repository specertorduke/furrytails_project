<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pet;
use App\Models\Appointment;
use App\Models\Boarding;
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

    /**
     * Get user details for modal view
     */
    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
            
            // Create empty pets array - we'll check your actual DB structure
            $pets = []; 
            
            // Check database structure and use proper column names
            // This is a simplified approach - check your actual DB columns
            $appointmentsCount = 0;
            $boardingsCount = 0;
            $petsCount = 0;
            
            try {
                // Use DB facade to directly check table structure
                $pets = \DB::table('pets')
                    ->orWhere('userID', $id)
                    ->get();
                
                    // Fix pet image paths
            foreach ($pets as $pet) {
                if (isset($pet->petImage)) {
                    // Remove any incorrect paths that might be stored in the database
                    $imagePath = preg_replace('/^dashboard\/furrytails_project\/public\//', '', $pet->petImage);
                    
                    // Check if path already starts with "storage/"
                    if (strpos($imagePath, 'storage/') === 0) {
                        $pet->petImage = asset($imagePath);
                    } 
                    // Check if path has admin/seed pattern
                    else if (strpos($imagePath, 'admin/seed/') === 0) {
                        $pet->petImage = asset('storage/' . $imagePath);
                    }
                    // For any other path format
                    else {
                        $pet->petImage = asset('storage/' . $imagePath);
                    }
                    
                    // Debug the image path transformation
                    \Log::info('Pet image transformed: ' . $pet->petImage);
                }
            }
            
                $petsCount = count($pets);
                
                // Try different column names since we don't know which one is correct
                $appointmentsCount = \DB::table('appointments')
                    ->orWhere('userID', $id)
                    ->count();
                    
                $boardingsCount = \DB::table('boardings')
                    ->orWhere('userID', $id)
                    ->count();
            } catch (\Exception $e) {
                // Just continue with zeros if this fails
                \Log::warning('Error fetching related data: ' . $e->getMessage());
            }
            
            // Add stats to user object
            $user->appointmentsCount = $appointmentsCount;
            $user->boardingsCount = $boardingsCount;
            $user->petsCount = $petsCount;
            
            // Format profile image URL if exists (using flexible column naming)
            $imageColumn = null;
            if (isset($user->profileImage)) {
                $imageColumn = 'profileImage';
            } else if (isset($user->userImage)) {
                $imageColumn = 'userImage';
            } else if (isset($user->image)) {
                $imageColumn = 'image';
            } else if (isset($user->profile_image)) {
                $imageColumn = 'profile_image';
            }
            
            if ($imageColumn && $user->$imageColumn) {
                $user->profileImage = asset('storage/' . $user->$imageColumn);
            } else {
                $user->profileImage = null;
            }
            
            return response()->json([
                'success' => true,
                'user' => $user,
                'pets' => $pets
            ]);
        } catch (\Exception $e) {
            \Log::error('Error fetching user data: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve user data',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
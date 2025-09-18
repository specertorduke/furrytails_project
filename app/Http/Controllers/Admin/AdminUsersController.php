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
use Illuminate\Support\Facades\Storage;

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
        try {
            // Validate the request
            $validated = $request->validate([
                'firstName' => 'required|string|max:100',
                'lastName' => 'required|string|max:100',
                'email' => 'required|email|unique:users,email',
                'username' => 'required|string|unique:users,username|max:50',
                'phone' => 'required|string|max:20',
                'password' => 'required|string|min:8',
                'role' => 'required|in:user,admin',
                'userImage' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
            ]);

            // Create new user
            $user = new User();
            $user->firstName = $validated['firstName'];
            $user->lastName = $validated['lastName'];
            $user->email = $validated['email'];
            $user->username = $validated['username'];
            $user->phone = $validated['phone'];
            $user->password = Hash::make($validated['password']);
            $user->role = $validated['role'];
            $user->save();

            // Handle image upload if present
            if ($request->hasFile('userImage')) {
                // Log for debugging
                \Log::info('User image upload started', [
                    'userID' => $user->userID,
                    'file' => $request->file('userImage')
                ]);
                
                // Get file extension
                $extension = $request->file('userImage')->getClientOriginalExtension();
                
                // Create custom filename with userID
                $filename = 'user_' . $user->userID . '_' . time() . '.' . $extension;
                
                // Store with custom filename
                $imagePath = $request->file('userImage')->storeAs(
                    'userImages', 
                    $filename, 
                    'public'
                );
                
                // Log success
                \Log::info('User image saved', [
                    'path' => $imagePath
                ]);
                
                $user->userImage = $imagePath;
                $user->save(); // Save again with the image path
            } else if ($request->has('cropped_image')) {
                // Handle base64 encoded image from cropper
                \Log::info('Processing cropped image');
                
                try {
                    $croppedImage = $request->input('cropped_image');
                    
                    // Remove header information from base64 string
                    $image_parts = explode(";base64,", $croppedImage);
                    $image_base64 = isset($image_parts[1]) ? $image_parts[1] : $croppedImage;
                    
                    // Create image from base64 string
                    $imageData = base64_decode($image_base64);
                    
                    // Create custom filename with userID
                    $filename = 'user_' . $user->userID . '_' . time() . '.jpg';
                    
                    // Path to save the image
                    $imagePath = 'userImages/' . $filename;
                    $fullPath = storage_path('app/public/' . $imagePath);
                    
                    // Ensure the directory exists
                    if (!file_exists(dirname($fullPath))) {
                        mkdir(dirname($fullPath), 0755, true);
                    }
                    
                    // Save the image
                    file_put_contents($fullPath, $imageData);
                    
                    // Update user with image path
                    $user->userImage = $imagePath;
                    $user->save();
                    
                    \Log::info('Cropped image saved', ['path' => $imagePath]);
                } catch (\Exception $e) {
                    \Log::error('Error saving cropped image: ' . $e->getMessage());
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'User created successfully',
                'user' => $user
            ]);
        } catch (\Exception $e) {
            \Log::error('Error creating user: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to create user: ' . $e->getMessage()
            ], 500);
        }
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
                
                // Get all pet IDs belonging to this user first
                $petIDs = \DB::table('pets')
                ->where('userID', $id)
                ->pluck('petID')
                ->toArray();

                // Count appointments for these pets
                $appointmentsCount = empty($petIDs) ? 0 : \DB::table('appointments')
                ->whereIn('petID', $petIDs)
                ->count();

                // Count boardings for these pets
                $boardingsCount = empty($petIDs) ? 0 : \DB::table('boardings')
                ->whereIn('petID', $petIDs)
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

    /**
     * Update user details
     */
    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            
            // Store original role to check if it's being changed
            $originalRole = $user->role;
            
            // Validate the request
            $rules = [
                'firstName' => 'required|string|max:100',
                'lastName' => 'required|string|max:100',
                'email' => 'required|email|unique:users,email,' . $id . ',userID',
                'username' => 'required|string|unique:users,username,' . $id . ',userID',
                'phone' => 'required|string|max:20',
                'role' => 'required|in:user,admin',
                'userImage' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ];
            
            $messages = [
                'admin_password.required' => 'Admin password is required when changing user roles.',
                'admin_password.string' => 'Admin password must be a valid string.',
            ];

            // Add password validation only if it's provided
            if ($request->filled('password')) {
                $rules['password'] = 'string|min:8';
            }
            
            // Add admin password requirement if role is being changed
            if ($request->role !== $originalRole) {
                $rules['admin_password'] = 'required|string';
            }
            
            $validated = $request->validate($rules);
            
            // Verify admin password if role is being changed
            if ($request->role !== $originalRole) {
                $admin = auth()->user();
                if (!Hash::check($validated['admin_password'], $admin->password)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Invalid admin password. Please enter your current password to confirm role changes.'
                    ], 401);
                }
                
                // Additional safety check - don't allow removing the last admin
                if ($originalRole === 'admin' && $request->role === 'user') {
                    $adminCount = User::where('role', 'admin')->where('userID', '!=', $id)->count();
                    if ($adminCount < 1) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Cannot remove admin role. At least one admin must remain in the system.'
                        ], 403);
                    }
                }
            }
            
            // Update user data
            $user->firstName = $validated['firstName'];
            $user->lastName = $validated['lastName'];
            $user->email = $validated['email'];
            $user->username = $validated['username'];
            $user->phone = $validated['phone'];
            $user->role = $validated['role'];
            
            // Update password if provided
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            
            // Handle image upload if present
            if ($request->hasFile('userImage')) {
                // Delete old image if it exists and isn't the default
                if ($user->userImage && $user->userImage != 'userImages/default.png') {
                    Storage::disk('public')->delete($user->userImage);
                }
                
                // Get file extension
                $extension = $request->file('userImage')->getClientOriginalExtension();
                
                // Create custom filename with userID
                $filename = 'user_' . $user->userID . '_' . time() . '.' . $extension;
                
                // Store with custom filename
                $imagePath = $request->file('userImage')->storeAs(
                    'userImages', 
                    $filename, 
                    'public'
                );
                
                $user->userImage = $imagePath;
            }
            
            $user->save();
            
            // Log the role change if it occurred
            if ($request->role !== $originalRole) {
                \App\Models\ActivityLog::create([
                    'table_name' => 'users',
                    'record_id' => $user->userID,
                    'action' => 'update',
                    'old_values' => json_encode(['role' => $originalRole]),
                    'new_values' => json_encode([
                        'role' => $user->role,
                        'admin_id' => auth()->id(),
                        'admin_name' => auth()->user()->firstName . ' ' . auth()->user()->lastName
                    ]),
                    'userID' => auth()->id(),
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent()
                ]);
            }
            
            return response()->json([
                'success' => true,
                'message' => 'User updated successfully',
                'user' => $user
            ]);
        } catch (\Exception $e) {
            \Log::error('Error updating user: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update user: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete a user and all related data
     */
    public function destroy(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            
            // Validate admin password requirement
            $validated = $request->validate([
                'admin_password' => 'required|string'
            ], [
                'admin_password.required' => 'Admin password is required to delete users.',
            ]);
            
            // Verify admin password
            $admin = auth()->user();
            if (!Hash::check($validated['admin_password'], $admin->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid admin password. Please enter your current password to confirm user deletion.'
                ], 401);
            }
            
            // Prevent deleting yourself
            if ($user->userID == auth()->id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'You cannot delete your own account.'
                ], 403);
            }
            
            // Prevent deleting the last admin
            if ($user->role === 'admin') {
                $adminCount = User::where('role', 'admin')->where('userID', '!=', $id)->count();
                if ($adminCount < 1) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Cannot delete the last admin user. At least one admin must remain in the system.'
                    ], 403);
                }
            }
            
            // Store user data for logging before deletion
            $userData = $user->toArray();
            
            // Log the deletion action
            ActivityLog::create([
                'table_name' => 'users',
                'record_id' => $user->userID,
                'action' => 'delete',
                'old_values' => json_encode($userData),
                'new_values' => json_encode([
                    'deleted_by_admin_id' => $admin->userID,
                    'deleted_by_admin_name' => $admin->firstName . ' ' . $admin->lastName
                ]),
                'userID' => auth()->id(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);
            
            // Delete user
            $user->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'User deleted successfully'
            ]);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed: ' . implode(', ', $e->validator->errors()->all()),
                'errors' => $e->validator->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Error deleting user: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete user: ' . $e->getMessage()
            ], 500);
        }
    }
}
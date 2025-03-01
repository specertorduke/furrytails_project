<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class AdminAccountController extends Controller
{
    /**
     * Show the admin account settings page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.account');
    }

    /**
     * Update the admin's account information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $user->userID . ',userID'],
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->userID . ',userID'],
            'phoneNumber' => ['required', 'string', 'max:15'],
        ];

        // Only validate password if it's provided
        if ($request->filled('password')) {
            $rules['password'] = ['required', 'confirmed', Password::defaults()];
        }

        $validated = $request->validate($rules);

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old image if it exists and is not the default
            if ($user->userImage && $user->userImage != 'images/default-user.png') {
                Storage::disk('public')->delete($user->userImage);
            }

            // Store the new image
            $imagePath = $request->file('profile_image')->store('images/users', 'public');
            $user->userImage = $imagePath;
        }

        // Update user data
        $user->username = $validated['username'];
        $user->firstName = $validated['firstName'];
        $user->lastName = $validated['lastName'];
        $user->email = $validated['email'];
        $user->phone = $validated['phoneNumber'];

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('admin.account')->with('success', 'Account information updated successfully.');
    }

    /**
     * Log the admin out from all devices.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logoutFromAllDevices()
    {
        Auth::user()->tokens()->delete(); // For API tokens if using them
        Auth::user()->update(['remember_token' => null]);
        
        // Force regenerate the session
        Auth::logout();
        
        return redirect()->route('admin.login')->with('success', 'You have been logged out from all devices.');
    }
}
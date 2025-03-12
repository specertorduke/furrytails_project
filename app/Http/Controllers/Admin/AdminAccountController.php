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

        // Debug the incoming request
        \Log::info('Update account request:', [
            'phone' => $request->phone,
            'full_phone' => $request->full_phone,
            'all_inputs' => $request->all()
        ]);

        $rules = [
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $user->userID . ',userID'],
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->userID . ',userID'],
        ];

        // Handle phone validation
        if ($request->has('full_phone')) {
            $rules['full_phone'] = ['required', 'string', 'regex:/^\+639\d{9}$/'];
        } else {
            $rules['phone'] = ['required', 'string', 'regex:/^9\d{2}\s?\d{3}\s?\d{4}$/'];
        }

        // Only validate password if it's provided
        if ($request->filled('password')) {
            $rules['password'] = ['required', 'confirmed', Password::defaults()];
        }

        $validated = $request->validate($rules);

        // Handle profile image
        if ($request->filled('cropped_image')) {
            $imageData = $request->input('cropped_image');
            if (strpos($imageData, 'data:image/jpeg;base64,') === 0) {
                $imageData = str_replace('data:image/jpeg;base64,', '', $imageData);
                $imageData = str_replace(' ', '+', $imageData);
                $decodedImage = base64_decode($imageData);
                
                if ($decodedImage !== false) {
                    // Delete old image if it exists and is not the default
                    if ($user->userImage && !str_contains($user->userImage, 'default')) {
                        Storage::disk('public')->delete($user->userImage);
                    }
                    
                    // Create a filename and save the image
                    $filename = 'images/users/profile_' . $user->userID . '_' . time() . '.jpg';
                    Storage::disk('public')->put($filename, $decodedImage);
                    $user->userImage = $filename;
                }
            }
        }

        // Update user data
        $user->username = $validated['username'];
        $user->firstName = $validated['firstName'];
        $user->lastName = $validated['lastName'];
        $user->email = $validated['email'];

        // Update phone number - prioritize full_phone if available
        if (isset($validated['full_phone'])) {
            $user->phone = $validated['full_phone'];
        } else if (isset($validated['phone'])) {
            // Format: remove spaces and add +63 prefix
            $user->phone = '+63' . preg_replace('/\s+/', '', $validated['phone']);
        }

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
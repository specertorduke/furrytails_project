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

    public function validateAccountField(Request $request)
    {
        $request->validate([
            'field' => 'required|in:username,email,phone',
            'value' => 'required|string|max:255',
        ]);

        $field = $request->input('field');
        $value = trim($request->input('value'));
        $userId = Auth::user()->userID;

        if ($field === 'username') {
            if (strlen($value) < 5) {
                return response()->json(['available' => false, 'message' => 'Username must be at least 5 characters.']);
            }
            $exists = \App\Models\User::whereRaw('LOWER(username) = ?', [strtolower($value)])
                ->where('userID', '!=', $userId)->exists();
            return response()->json([
                'available' => !$exists,
                'message'   => $exists ? 'Username is already taken.' : 'Username is available.',
            ]);
        }

        if ($field === 'email') {
            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                return response()->json(['available' => false, 'message' => 'Please enter a valid email address.']);
            }
            $exists = \App\Models\User::whereRaw('LOWER(email) = ?', [strtolower($value)])
                ->where('userID', '!=', $userId)->exists();
            return response()->json([
                'available' => !$exists,
                'message'   => $exists ? 'Email is already registered.' : 'Email is available.',
            ]);
        }

        // Phone
        $digits = preg_replace('/\D/', '', $value);
        if (strlen($digits) === 12 && substr($digits, 0, 2) === '63') $digits = substr($digits, 2);
        if (strlen($digits) > 10) $digits = substr($digits, -10);
        $formatted = preg_replace('/^(\d{3})(\d{3})(\d{4})$/', '$1 $2 $3', $digits);
        if (!preg_match('/^9\d{2}\s?\d{3}\s?\d{4}$/', $formatted)) {
            return response()->json(['available' => false, 'message' => 'Phone format must be 9XX XXX XXXX.']);
        }
        $normalized = '+63' . str_replace(' ', '', $formatted);
        $exists = \App\Models\User::where('phone', $normalized)->where('userID', '!=', $userId)->exists();
        return response()->json([
            'available' => !$exists,
            'message'   => $exists ? 'Phone number is already registered.' : 'Phone number is available.',
        ]);
    }
}
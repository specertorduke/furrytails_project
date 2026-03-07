<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class AccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $appointmentsCount = $user->appointments()->count();
        $boardingsCount = $user->boardingReservations()->count();
        $petsCount = $user->pets()->count();

        return view('content.account', compact('appointmentsCount', 'boardingsCount', 'petsCount'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username,'.$user->userID.',userID',
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->userID.',userID',
            'phoneNumber' => 'nullable|string|max:255',
            'current_password' => 'nullable|string|required_with:password',
            'password' => ['nullable', 'confirmed', Password::defaults()],
            'profile_image' => 'nullable|image|max:2048', // 2MB Max
        ]);
        
        // Update basic user info
        $user->username = $validated['username'];
        $user->firstName = $validated['firstName']; 
        $user->lastName = $validated['lastName'];
        $user->email = $validated['email'];
        if (!empty($validated['phoneNumber'])) {
            $digits = preg_replace('/\D/', '', $validated['phoneNumber']);
            if (strlen($digits) === 12 && substr($digits, 0, 2) === '63') $digits = substr($digits, 2);
            $user->phone = '+63' . $digits;
        } else {
            $user->phone = null;
        }
        
        // Handle password change if provided
        if (!empty($validated['password'])) {
            // Verify the current password before allowing the change
            if (!Hash::check($validated['current_password'] ?? '', $user->password)) {
                return back()->withErrors(['current_password' => 'The current password you entered is incorrect.']);
            }
            $user->password = Hash::make($validated['password']);
        }
        
        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old image if it exists and isn't the default
            if ($user->userImage && $user->userImage !== 'userImages/default.png') {
                Storage::disk('public')->delete($user->userImage);
            }
            
            // Store new image
            $imagePath = $request->file('profile_image')->store('userImages', 'public');
            $user->userImage = $imagePath;
        }
        
        $user->save();
        
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function deleteAccount()
    {
        $user = Auth::user();

        if ($user) {
            Auth::logout();
            $user->delete();
            
            return redirect()->route('login')->with('success', 'Your account has been deleted successfully.');
        }

        return redirect()->back()->with('error', 'Failed to delete your account.');
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
            $exists = User::whereRaw('LOWER(username) = ?', [strtolower($value)])
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
            $exists = User::whereRaw('LOWER(email) = ?', [strtolower($value)])
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
        $exists = User::where('phone', $normalized)->where('userID', '!=', $userId)->exists();
        return response()->json([
            'available' => !$exists,
            'message'   => $exists ? 'Phone number is already registered.' : 'Phone number is available.',
        ]);
    }
}

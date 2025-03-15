<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Storage; 

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
            'phoneNumber' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'profile_image' => 'nullable|image|max:2048', // 2MB Max
        ]);
        
        // Update basic user info
        $user->username = $validated['username'];
        $user->firstName = $validated['firstName']; 
        $user->lastName = $validated['lastName'];
        $user->email = $validated['email'];
        $user->phone = $validated['phoneNumber'];
        
        // Handle password change if provided
        if (!empty($validated['password'])) {
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
}

<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AccountController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'You must be logged in to update your profile.');
        }

        $validatedData = $request->validate([
            'username'  => 'required|string|max:255|unique:users,username,' . $user->userID . ',userID',
            'firstName' => 'required|string|max:255',
            'lastName'  => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users,email,' . $user->userID . ',userID',
            'phone'     => 'nullable|string|max:255',
            'password'  => 'nullable|string|min:8|confirmed',
        ]);

        
        $user->fill($validatedData);

        
        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        } else {
            
            unset($user->password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}

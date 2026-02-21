<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    private function normalizePhoneDigits(string $phone): string
    {
        $digits = preg_replace('/\D+/', '', $phone);

        if (str_starts_with($digits, '63') && strlen($digits) === 12) {
            $digits = substr($digits, 2);
        }

        return $digits;
    }

    private function phoneExists(string $phone): bool
    {
        $normalized = $this->normalizePhoneDigits($phone);

        if (!preg_match('/^9\d{9}$/', $normalized)) {
            return false;
        }

        return User::whereRaw(
            "REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(phone, ' ', ''), '-', ''), '(', ''), ')', ''), '+', '') IN (?, ?)",
            [$normalized, '63' . $normalized]
        )->exists();
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|min:5|max:255|unique:users',
            'phone' => ['required', 'string', 'max:15', 'regex:/^9\d{2}\s?\d{3}\s?\d{4}$/'],
            'password' => ['required', 'confirmed', Password::min(8)->uncompromised()], // Laravel's built-in password validation rule that checks against known data breaches
            'terms' => 'accepted',
        ]);

        $validator->after(function ($validator) use ($request) {
            if ($this->phoneExists($request->input('phone', ''))) {
                $validator->errors()->add('phone', 'The phone number has already been taken.');
            }
        });

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'username' => $request->username,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        // Optionally, log the user in after registration
        // Auth::login($user);

        return redirect()->route('login')->with('success', 'Account created successfully. Please log in.');
    }

    public function validateField(Request $request)
    {
        $request->validate([
            'field' => 'required|in:username,email,phone',
            'value' => 'required|string|max:255',
        ]);

        $field = $request->input('field');
        $value = trim($request->input('value'));

        if ($field === 'username') {
            if (strlen($value) < 5) {
                return response()->json([
                    'available' => false,
                    'message' => 'Username must be at least 5 characters.',
                ]);
            }

            $exists = User::whereRaw('LOWER(username) = ?', [strtolower($value)])->exists();

            return response()->json([
                'available' => !$exists,
                'message' => $exists ? 'Username is already taken.' : 'Username is available.',
            ]);
        }

        if ($field === 'email') {
            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                return response()->json([
                    'available' => false,
                    'message' => 'Please enter a valid email address.',
                ]);
            }

            $exists = User::whereRaw('LOWER(email) = ?', [strtolower($value)])->exists();

            return response()->json([
                'available' => !$exists,
                'message' => $exists ? 'Email is already registered.' : 'Email is available.',
            ]);
        }

        $normalizedPhone = $this->normalizePhoneDigits($value);

        if (!preg_match('/^9\d{9}$/', $normalizedPhone)) {
            return response()->json([
                'available' => false,
                'message' => 'Phone format must be 9XX XXX XXXX.',
            ]);
        }

        $exists = $this->phoneExists($value);

        return response()->json([
            'available' => !$exists,
            'message' => $exists ? 'Phone number is already registered.' : 'Phone number is available.',
        ]);
    }
}
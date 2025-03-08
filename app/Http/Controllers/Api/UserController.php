<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends ApiController
{
    /**
     * Get all users for admin appointment selection
     */
    public function index()
    {
        try {
            $users = User::select('userID', 'firstName', 'lastName')
                ->orderBy('lastName')
                ->orderBy('firstName')
                ->get();
                
            return response()->json($users);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
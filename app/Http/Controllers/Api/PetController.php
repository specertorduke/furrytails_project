<?php

namespace App\Http\Controllers\Api;

use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends ApiController
{
    /**
     * Get pets for a specific user
     */
    public function getUserPets($userId)
    {
        try {
            $pets = Pet::where('userID', $userId)
                ->select('petID', 'name', 'species')
                ->orderBy('name')
                ->get();
                
            return response()->json($pets);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
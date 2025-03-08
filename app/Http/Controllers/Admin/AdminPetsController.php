<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use Illuminate\Support\Facades\Validator;

class AdminPetsController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userID' => 'required|exists:users,userID',
            'name' => 'required|string|max:255',
            'species' => 'required|string',
            'breed' => 'required|string|max:255',
            'gender' => 'nullable|string|in:Male,Female',
            'birthDate' => 'nullable|date',
            'weight' => 'nullable|numeric|min:0',
            'isVaccinated' => 'boolean',
            'vaccinationDate' => 'nullable|date',
            'allergies' => 'nullable|string',
            'medicalHistory' => 'nullable|string',
            'notes' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Create new pet
        $pet = new Pet();
        $pet->userID = $request->userID;
        $pet->name = $request->name;
        $pet->species = $request->species;
        $pet->breed = $request->breed;
        $pet->gender = $request->gender;
        $pet->birthDate = $request->birthDate;
        $pet->weight = $request->weight;
        $pet->isVaccinated = $request->isVaccinated;
        $pet->vaccinationDate = $request->vaccinationDate;
        $pet->allergies = $request->allergies;
        $pet->medicalHistory = $request->medicalHistory;
        $pet->notes = $request->notes;
        $pet->save();

        return response()->json([
            'success' => true,
            'message' => 'Pet created successfully',
            'pet' => $pet
        ]);
    }
}
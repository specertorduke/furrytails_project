<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class AdminPetsController extends Controller
{   
    public function index()
    {
        $pets = Pet::with('user')->paginate(12);
        $users = User::orderBy('firstName')->get();
        
        $stats = [
            'total_pets' => Pet::count(),
            'dogs' => Pet::where('species', 'Dog')->count(),
            'cats' => Pet::where('species', 'Cat')->count(),
            'others' => Pet::whereNotIn('species', ['Dog', 'Cat'])->count(),
        ];
        
        return view('admin.pets', compact('pets', 'users', 'stats'));
    }

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
            'lastVaccinationDate' => 'nullable|date',
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

        $pet = new Pet();
        // Store image
        $imagePath = null;
        if ($request->hasFile('petImage')) {
            // Delete the old image if it exists and isn't a default image
            if ($pet->petImage && !str_contains($pet->petImage, 'default.png') && !str_contains($pet->petImage, 'seed/')) {
                Storage::disk('public')->delete($pet->petImage);
            }
            
            $imagePath = $request->file('petImage')->store('petImages', 'public');
            $validated['petImage'] = $imagePath;
        }

        // Create new pet
        $pet->userID = $request->userID;
        $pet->name = $request->name;
        $pet->species = $request->species;
        $pet->breed = $request->breed;
        $pet->gender = $request->gender;
        $pet->birthDate = $request->birthDate;
        $pet->weight = $request->weight;
        $pet->isVaccinated = $request->isVaccinated;
        $pet->lastVaccinationDate = $request->vaccinationDate;
        $pet->allergies = $request->allergies;
        $pet->medicalHistory = $request->medicalHistory;
        $pet->petNotes = $request->notes;
        $pet->petImage = $imagePath;
        $pet->save();

        return response()->json([
            'success' => true,
            'message' => 'Pet created successfully',
            'pet' => $pet
        ]);
    }

    public function showPet($id)
    {
        try {
            $pet = \App\Models\Pet::with('user')->findOrFail($id);
            
            // Calculate age from birth date
            $birthDate = \Carbon\Carbon::parse($pet->birthDate);
            $pet->age = $birthDate->diffForHumans(null, true);
            
            // Format vaccination date if exists
            if ($pet->lastVaccinationDate) {
                $pet->vaccinationDate = \Carbon\Carbon::parse($pet->lastVaccinationDate)->format('Y-m-d');
            }
            
            // Ensure pet image path is properly formatted
            if ($pet->petImage) {
                $pet->petImage = str_replace('public/', '', $pet->petImage);
            }
            
            return response()->json([
                'success' => true,
                'pet' => $pet
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve pet data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $pet = Pet::findOrFail($id);
            
            return response()->json([
                'success' => true,
                'pet' => $pet
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Pet not found'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $pet = Pet::findOrFail($id);
            
            $validated = $request->validate([
                'name' => 'required|string|max:50',
                'species' => 'required|string|max:50',
                'breed' => 'nullable|string|max:50',
                'gender' => 'required|string|max:10',
                'birthDate' => 'required|date',
                'weight' => 'nullable|numeric',
                'petImage' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'userID' => 'required|exists:users,userID',
                'petNotes' => 'nullable|string',
                'medicalHistory' => 'nullable|string',
                'allergies' => 'nullable|string',
                'isVaccinated' => 'nullable|boolean',
                'lastVaccinationDate' => 'nullable|date'
            ]);
            
            // Handle image upload if provided
            if ($request->hasFile('petImage')) {
                $imagePath = $request->file('petImage')->store('petImages', 'public');
                $validated['petImage'] = $imagePath;
            }
            
            // Handle checkbox value
            $validated['isVaccinated'] = $request->has('isVaccinated');
            
            // Update pet
            $pet->update($validated);
            
            return response()->json([
                'success' => true,
                'message' => 'Pet updated successfully',
                'pet' => $pet
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update pet',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $pet = Pet::findOrFail($id);
            
            // Delete pet image if it exists
            if ($pet->petImage && Storage::exists('public/' . $pet->petImage)) {
                Storage::delete('public/' . $pet->petImage);
            }
            
            $pet->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Pet deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete pet',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
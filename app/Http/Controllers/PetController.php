<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::where('userID', Auth::id())->get();
        return view('content.pets', compact('pets'));
    }

    public function edit($id)
    {
        $pet = Pet::findOrFail($id);
        
        if ($pet->userID !== Auth::id()) {
            abort(403);
        }
        
        return response()->json($pet);
    }

    public function addPet(Request $request)
    {
        \Log::info('Pet creation attempted', $request->all());
        
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'species' => 'required|string',
                'petType' => 'required|string',
                'gender' => 'required|string',
                'birthDate' => 'required|date',
                'weight' => 'nullable|numeric',
                'cropped_image' => 'required|string',  // For base64 image data
                'petNotes' => 'nullable|string',
                'medicalHistory' => 'nullable|string',
                'allergies' => 'nullable|string',
                'isVaccinated' => 'nullable|boolean',
                'lastVaccinationDate' => 'nullable|date'
            ]);

            $validated['userID'] = auth()->id();

            // Handle the base64 image data
            if ($request->has('cropped_image')) {
                $imageData = $request->input('cropped_image');
                $imageName = 'pet_' . time() . '.png';
                \Storage::disk('public')->put($imageName, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData)));
                $validated['petImage'] = $imageName;
            }

            $pet = Pet::create($validated);
            
            \Log::info('Pet created successfully', ['pet_id' => $pet->id]);
            
            return redirect()->back()->with('success', 'Pet added successfully!');
        } catch (\Exception $e) {
            \Log::error('Pet creation failed', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Failed to add pet. Please try again.');
        }
    }

    public function deletePet($id)
    {
        try {
            $pet = Pet::findOrFail($id);
            
            // Check if user owns this pet
            if ($pet->userID !== Auth::id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized action'
                ], 403);
            }

            // Delete pet image if it exists and isn't the default
            if ($pet->petImage && $pet->petImage !== 'petImages/default.png') {
                \Storage::disk('public')->delete($pet->petImage);
            }

            // Delete the pet
            $pet->delete();

            return response()->json([
                'success' => true,
                'message' => 'Pet deleted successfully'
            ]);

        } catch (\Exception $e) {
            \Log::error('Pet deletion failed', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete pet: ' . $e->getMessage()
            ], 500);
        }
    }

    
    public function show($id)
    {
        try {
            $pet = Pet::findOrFail($id);
            
            if ($pet->userID !== Auth::id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized access'
                ], 403);
            }

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

    public function updatePet(Request $request, $id)
    {
        try {
            $pet = Pet::findOrFail($id);
            
            if ($pet->userID !== Auth::id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized action'
                ], 403);
            }

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'species' => 'required|string',
                'breed' => 'required|string',
                'gender' => 'required|string',
                'birthDate' => 'required|date',
                'weight' => 'nullable|numeric|min:0',
                'cropped_image' => 'nullable|string',
                'petNotes' => 'nullable|string',
                'medicalHistory' => 'nullable|string',
                'allergies' => 'nullable|string',
                'isVaccinated' => 'required|boolean',
                'lastVaccinationDate' => 'required_if:isVaccinated,1|nullable|date'
            ]);

            // Handle image update if provided
            if ($request->has('cropped_image') && $request->cropped_image !== null) {
                if ($pet->petImage && $pet->petImage !== 'petImages/default.png') {
                    \Storage::disk('public')->delete($pet->petImage);
                }
                $imageData = $request->input('cropped_image');
                $imageName = 'petImages/pet_' . time() . '.png';
                \Storage::disk('public')->put($imageName, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData)));
                $validated['petImage'] = $imageName;
            }

            // Convert isVaccinated to boolean
            $validated['isVaccinated'] = filter_var($validated['isVaccinated'], FILTER_VALIDATE_BOOLEAN);

            // Only include lastVaccinationDate if pet is vaccinated
            if (!$validated['isVaccinated']) {
                $validated['lastVaccinationDate'] = null;
            }

            $pet->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Pet updated successfully',
                'pet' => $pet->fresh()
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Pet update validation failed', ['errors' => $e->errors()]);
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Pet update failed', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to update pet: ' . $e->getMessage()
            ], 500);
        }
    }
}
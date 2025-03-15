<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\Appointment; 
use App\Models\Boarding; 

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::where('userID', Auth::id())->get();
        $user = Auth::user();
        $uniqueSpecies = $user->pets()->distinct()->pluck('species')->toArray();

        return view('content.pets', compact('pets', 'uniqueSpecies'));
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
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Pet added successfully',
                    'pet' => [
                        'id' => $pet->petID,
                        'name' => $pet->name,
                        'image' => $pet->petImage
                    ]
                ]);
            }
        
            // For non-AJAX requests, redirect with flash message
            return redirect()->back()->with('pet_added', [
                'success' => true,
                'name' => $pet->name
            ]);
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
            
            // Check if user owns this pet
            if ($pet->userID !== Auth::id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized action'
                ], 403);
            }

            $validated = $request->validate([
                'name' => 'required|string|max:50',
                'species' => 'required|string|max:50',
                'breed' => 'nullable|string|max:50',
                'gender' => 'required|string|max:10',
                'birthDate' => 'required|date',
                'weight' => 'nullable|numeric',
                // Remove the userID validation since we're using Auth::id()
                'petNotes' => 'nullable|string',
                'medicalHistory' => 'nullable|string',
                'allergies' => 'nullable|string',
                'isVaccinated' => 'required|boolean',
                'lastVaccinationDate' => 'required_if:isVaccinated,1|nullable|date'
            ]);
            
            // Handle image upload if provided
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

            // Update pet
            $pet->update($validated);
            
            return response()->json([
                'success' => true,
                'message' => 'Pet updated successfully',
                'pet' => $pet->fresh()
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
                'message' => 'Failed to update pet: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get the current user's pets for appointment selection
     */
    public function getUserPets()
    {
        $pets = Auth::user()->pets;
        return response()->json($pets);
    }

    /**
     * Get a specific pet by ID (for the current user)
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPet($id)
    {
        try {
            $pet = Pet::where('petID', $id)
                     ->where('userID', Auth::id())
                     ->first();
            
            if (!$pet) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pet not found or not authorized'
                ], 404);
            }
            
            return response()->json([
                'success' => true,
                'pet' => $pet
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load pet details. Please try again.'
            ], 500);
        }
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

    /**
 * Get pet's recent activities (appointments and boardings)
 *
 * @param int $id
 * @return \Illuminate\Http\JsonResponse
 */
public function getPetActivities($id)
{
    try {
        // Verify pet belongs to authenticated user
        $pet = Pet::where('petID', $id)
                ->where('userID', Auth::id())
                ->first();
                
        if (!$pet) {
            return response()->json([
                'success' => false,
                'message' => 'Pet not found or not authorized'
            ], 403);
        }
        
        // Get recent appointments (last 5)
        $appointments = Appointment::where('petID', $id)
            ->with(['service'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        // Get recent boardings (last 5)
        $boardings = Boarding::where('petID', $id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        return response()->json([
            'success' => true,
            'appointments' => $appointments,
            'boardings' => $boardings
        ]);
    } catch (\Exception $e) {
        Log::error('Error getting pet activities: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Failed to load pet activities'
        ], 500);
    }
}
}
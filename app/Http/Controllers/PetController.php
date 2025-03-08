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
        
        // Make sure all fields are being returned
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

            if ($pet->userID !== auth()->id()) {
                return redirect()->back()->with('error', 'Unauthorized action.');
            }

            $pet->delete();

            \Log::info('Pet deleted successfully', ['pet_id' => $id]);

            return redirect()->back()->with('success', 'Pet deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Pet deletion failed', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Failed to delete pet. Please try again.');
        }
    }

    public function updatePet(Request $request, $id)
    {
        $pet = Pet::findOrFail($id);
        
        if ($pet->userID !== Auth::id()) {
            abort(403);
        }
    
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string',
            'petType' => 'required|string',
            'gender' => 'required|string',
            'birthDate' => 'required|date',
            'weight' => 'nullable|numeric',
            'cropped_image' => 'nullable|string',  // For base64 image data
            'petNotes' => 'nullable|string',
            'medicalHistory' => 'nullable|string',
            'allergies' => 'nullable|string',
            'isVaccinated' => 'nullable|boolean',
            'lastVaccinationDate' => 'nullable|date'
        ]);
    
        // Handle the base64 image data
        if ($request->has('cropped_image')) {
            $imageData = $request->input('cropped_image');
            $imageName = 'pet_' . time() . '.png';
            \Storage::disk('public')->put($imageName, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData)));
            $validated['petImage'] = $imageName;
        }
    
        $pet->update($validated);
    
        return redirect()->back()->with('success', 'Pet updated successfully!');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

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

        // Store image
        $imagePath = null;
        if ($request->hasFile('petImage')) {
            $imagePath = $request->file('petImage')->store('images/pets', 'public');
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
}
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
        // Add authorization check
        if ($pet->userID !== Auth::id()) {
            abort(403);
        }
        return response()->json($pet);
    }

    public function update(Request $request, $id)
    {
        $pet = Pet::findOrFail($id);
        // Add authorization check
        if ($pet->userID !== Auth::id()) {
            abort(403);
        }

        // Add validation and update logic here
    }
}
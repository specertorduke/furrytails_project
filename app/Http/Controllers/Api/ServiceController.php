<?php

namespace App\Http\Controllers\Api;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends ApiController
{
    /**
     * Get all services
     */
    public function index()
    {
        try {
            $services = Service::select('serviceID', 'name', 'price', 'category', 'description', 'serviceImage')
                ->where('isActive', true)
                ->whereRaw('LOWER(category) <> ?', ['boarding'])
                ->orderBy('name')
                ->get();
                
            return response()->json($services);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An unexpected error occurred.'], 500);
        }
    }
}
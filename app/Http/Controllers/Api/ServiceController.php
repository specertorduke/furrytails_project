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
            $services = Service::select('serviceID', 'name', 'price')
                ->orderBy('name')
                ->get();
                
            return response()->json($services);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
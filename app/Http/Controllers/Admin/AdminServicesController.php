<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;

class AdminServicesController extends Controller
{
    public function index()
    {
        // Get all services with counts for the stats cards
        $services = Service::orderBy('name')->get();
        $totalServices = $services->count();
        $activeServices = $services->where('isActive', true)->count();
        $serviceCategories = $services->pluck('category')->unique()->count();

        return view('admin.services', compact('services', 'totalServices', 'activeServices', 'serviceCategories'));
    }

    public function getServicesList()
    {
        try {
            $services = Service::select(['serviceID', 'name'])
                ->orderBy('name')
                ->get();
                
            return response()->json($services);
        } catch (\Exception $e) {
            \Log::error('Error fetching services: ' . $e->getMessage());
            return response()->json([], 500);
        }
    }

    public function toggleStatus($id)
    {
        try {
            $service = Service::findOrFail($id);
            $service->isActive = !$service->isActive;
            $service->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Service status updated successfully'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error updating service status: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update service status'
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $service = Service::findOrFail($id);
            
            // Delete service image if it exists
            if ($service->serviceImage && Storage::exists('public/' . $service->serviceImage)) {
                Storage::delete('public/' . $service->serviceImage);
            }
            
            $service->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Service deleted successfully'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error deleting service: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete service'
            ], 500);
        }
    }    
}
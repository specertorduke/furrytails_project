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
            $services = Service::select(['serviceID', 'name', 'price'])
                ->where(function($query) {
                    // Exclude services that have "Boarding" or "Daycare" in their name
                    $query->whereRaw('LOWER(name) NOT LIKE ?', ['%boarding%'])
                          ->whereRaw('LOWER(name) NOT LIKE ?', ['%daycare%']);
                })
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

    /**
     * Get service details for view modal
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            // Get service data
            $service = Service::findOrFail($id);
                
            // Get stats for this service (if needed)
            $stats = [
                'appointmentCount' => 0,
                'revenue' => 0
            ];
            
            // Only attempt to get appointment stats if Appointment model exists
            if (class_exists('\App\Models\Appointment')) {
                try {
                    $stats['appointmentCount'] = \App\Models\Appointment::where('serviceID', $id)->count();
                    
                    // Instead of using 'price' column directly, calculate based on service price
                    // This avoids the "Unknown column 'price'" error
                    $appointmentCount = \App\Models\Appointment::where('serviceID', $id)
                        ->where('status', 'Completed')
                        ->count();
                        
                    $stats['revenue'] = $appointmentCount * $service->price;
                    
                    // Log successful stats retrieval
                    \Log::info("Successfully calculated stats for service ID {$id}: " . json_encode($stats));
                } catch (\Exception $statsError) {
                    \Log::warning('Error fetching appointment stats: ' . $statsError->getMessage());
                    // Don't fail the entire request if just stats have an issue
                }
            }
                
            return response()->json([
                'success' => true,
                'service' => $service,
                'stats' => $stats
            ]);
        } catch (\Exception $e) {
            \Log::error('Error fetching service details: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve service details',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Store a new service
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'category' => 'required|string|max:50',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'isActive' => 'boolean',
            'serviceImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $service = new Service();
            $service->name = $request->name;
            $service->category = $request->category;
            $service->price = $request->price;
            $service->description = $request->description;
            $service->isActive = $request->has('isActive') ? $request->isActive : true;

            // Handle image upload
            if ($request->hasFile('serviceImage')) {
                $image = $request->file('serviceImage');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('serviceImages', $imageName, 'public');
                $service->serviceImage = $path;
            }

            $service->save();

            return response()->json([
                'success' => true,
                'message' => 'Service added successfully',
                'service' => $service
            ]);
        } catch (\Exception $e) {
            \Log::error('Error adding service: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to add service: ' . $e->getMessage()
            ], 500);
        }
    }
}
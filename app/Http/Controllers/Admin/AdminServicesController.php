<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator; 

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
     * Store a newly created service in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'category' => 'required|string|in:Grooming,Boarding,Veterinary,Training',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'serviceImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'isActive' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Create service without image first
            $service = new Service();
            $service->name = $request->name;
            $service->category = $request->category;
            $service->price = $request->price;
            $service->description = $request->description;
            $service->isActive = $request->isActive;
            $service->save();

            // Now handle the image with the service ID
            if ($request->hasFile('serviceImage')) {
                $image = $request->file('serviceImage');
                
                // Generate unique file name with service ID
                $extension = $image->getClientOriginalExtension();
                $fileName = 'service_' . $service->serviceID . '_' . time() . '.' . $extension;
                
                // Store in public disk under services folder
                $path = $image->storeAs('images/services', $fileName, 'public');
                
                // Update the service with the image path
                $service->serviceImage = $path;
                $service->save();
            }

            return response()->json([
                'success' => true,
                'message' => 'Service created successfully',
                'data' => $service
            ]);
        } catch (\Exception $e) {
            \Log::error('Error creating service: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to create service: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update an existing service.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'category' => 'required|string|in:Grooming,Boarding,Veterinary,Training',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'serviceImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'isActive' => 'required|boolean',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
    
        try {
            $service = Service::findOrFail($id);
            
            // Update service fields
            $service->name = $request->name;
            $service->category = $request->category;
            $service->price = $request->price;
            $service->description = $request->description;
            $service->isActive = $request->isActive;
    
            // Handle image update
            if ($request->hasFile('serviceImage')) {
                // Delete old image if exists and not default
                if ($service->serviceImage && !str_contains($service->serviceImage, 'default')) {
                    Storage::disk('public')->delete($service->serviceImage);
                }
                
                // Process new image
                $image = $request->file('serviceImage');
                $extension = $image->getClientOriginalExtension();
                $fileName = 'service_' . $service->serviceID . '_' . time() . '.' . $extension;
                
                // Store in public disk under services folder
                $path = $image->storeAs('images/services', $fileName, 'public');
                
                // Update the image path
                $service->serviceImage = $path;
            }
            
            $service->save();
    
            return response()->json([
                'success' => true,
                'message' => 'Service updated successfully',
                'data' => $service
            ]);
        } catch (\Exception $e) {
            \Log::error('Error updating service: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update service: ' . $e->getMessage()
            ], 500);
        }
    }
}
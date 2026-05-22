<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminServicesController extends Controller
{
    private function normalizeServiceName(?string $name): string
    {
        return preg_replace('/\s+/', ' ', trim((string) $name));
    }

    private function serviceNameKeywords(?string $category): array
    {
        return match ($category) {
            'Grooming' => ['groom', 'grooming'],
            'Boarding' => ['board', 'boarding'],
            'Veterinary' => ['vet', 'veterinary'],
            'Training' => ['train', 'training'],
            default => [],
        };
    }

    private function serviceNameMatchesCategory(string $name, ?string $category): bool
    {
        $keywords = $this->serviceNameKeywords($category);

        if (empty($keywords)) {
            return true;
        }

        $normalizedName = mb_strtolower($name);

        foreach ($keywords as $keyword) {
            if (str_contains($normalizedName, $keyword)) {
                return true;
            }
        }

        return false;
    }

    private function serviceNameRules(?int $ignoreServiceId = null): array
    {
        $rules = [
            'required',
            'string',
            'min:3',
            'max:100',
            'regex:/^[A-Za-z0-9](?:[A-Za-z0-9\s&\'().,-]*[A-Za-z0-9])?$/',
        ];

        $uniqueRule = Rule::unique('services', 'name');
        if ($ignoreServiceId !== null) {
            $uniqueRule->ignore($ignoreServiceId, 'serviceID');
        }

        $rules[] = $uniqueRule;

        return $rules;
    }

    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $category = $request->query('category', 'all');
        $sort = $request->query('sort', 'none');

        // Stats via direct DB queries (independent of pagination)
        $totalServices    = Service::count();
        $activeServices   = Service::where('isActive', true)->count();
        $serviceCategories = Service::select('category')->distinct()->count();
        $existingServiceNames = Service::orderBy('name')->pluck('name')->values();

        $servicesQuery = Service::query();

        if ($search !== '') {
            $servicesQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        if ($category !== 'all' && in_array($category, ['Grooming', 'Boarding', 'Veterinary', 'Training'], true)) {
            $servicesQuery->where('category', $category);
        }

        if ($sort === 'newest') {
            $servicesQuery->orderByDesc('created_at')->orderBy('name');
        } elseif ($sort === 'oldest') {
            $servicesQuery->orderBy('created_at')->orderBy('name');
        } else {
            $servicesQuery->orderBy('name');
        }

        // Paginated services list
        $services = $servicesQuery->paginate(8)->withQueryString();

        return view('admin.services', compact('services', 'totalServices', 'activeServices', 'serviceCategories', 'existingServiceNames', 'search', 'category', 'sort'));
    }

    public function getServicesList()
    {
        try {
            $services = Service::select(['serviceID', 'name', 'price', 'category', 'description', 'serviceImage'])
                ->where('isActive', true)
                ->whereRaw('LOWER(category) <> ?', ['boarding'])
                ->orderBy('name')
                ->get();
                
            return response()->json($services);
        } catch (\Exception $e) {
            \Log::error('Error fetching services: ' . $e->getMessage());
            return response()->json([], 500);
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
            ], 404);
        }
    }

    public function store(Request $request)
    {
        if (!auth()->user()->hasPermission('services.create')) {
            return response()->json(['success' => false, 'message' => 'You do not have permission to perform this action.'], 403);
        }
        $request->merge([
            'name' => $this->normalizeServiceName($request->input('name')),
        ]);
        $serviceNameHint = 'Service name should include the category word, such as Grooming, Boarding, Vet/Veterinary, or Training.';

        // Validate request including admin password
        $validator = Validator::make($request->all(), [
            'name' => $this->serviceNameRules(),
            'category' => 'required|string|in:Grooming,Boarding,Veterinary,Training',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'serviceImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'isActive' => 'required|boolean',
        ], [
            'name.unique' => 'A service with this name already exists. Please choose a different name.',
            'name.regex' => 'Service names can only use letters, numbers, spaces, and common punctuation like & , . - and apostrophes.',
            'name.min' => 'Service name must be at least 3 characters long.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        if (! $this->serviceNameMatchesCategory($request->input('name'), $request->input('category'))) {
            return response()->json([
                'success' => false,
                'errors' => [
                    'name' => [$serviceNameHint],
                ],
            ], 422);
        }

        try {
            $admin = auth()->user();
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

            // Log the creation action
            ActivityLog::create([
                'table_name' => 'services',
                'record_id' => $service->serviceID,
                'action' => 'create',
                'new_values' => json_encode(array_merge($service->toArray(), [
                    'admin_id' => $admin->userID,
                    'admin_name' => $admin->firstName . ' ' . $admin->lastName
                ])),
                'userID' => auth()->id(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Service created successfully',
                'data' => $service
            ]);
        } catch (\Exception $e) {
            \Log::error('Error creating service: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to create service.'
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        if (!auth()->user()->hasPermission('services.edit')) {
            return response()->json(['success' => false, 'message' => 'You do not have permission to perform this action.'], 403);
        }
        $service = Service::findOrFail($id);
        $request->merge([
            'name' => $this->normalizeServiceName($request->input('name')),
        ]);
        $serviceNameHint = 'Service name should include the category word, such as Grooming, Boarding, Vet/Veterinary, or Training.';

        // Validate request including admin password
        $validator = Validator::make($request->all(), [
            'name' => $this->serviceNameRules((int) $id),
            'category' => 'required|string|in:Grooming,Boarding,Veterinary,Training',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'serviceImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'isActive' => 'required|boolean',
        ], [
            'name.unique' => 'A service with this name already exists. Please choose a different name.',
            'name.regex' => 'Service names can only use letters, numbers, spaces, and common punctuation like & , . - and apostrophes.',
            'name.min' => 'Service name must be at least 3 characters long.',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $nameChanged = $request->input('name') !== $service->name;
        $categoryChanged = $request->input('category') !== $service->category;

        if (($nameChanged || $categoryChanged) && ! $this->serviceNameMatchesCategory($request->input('name'), $request->input('category'))) {
            return response()->json([
                'success' => false,
                'errors' => [
                    'name' => [$serviceNameHint],
                ],
            ], 422);
        }

        try {
            $admin = auth()->user();
            
            // Store original values for logging
            $originalValues = $service->toArray();
            
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

            // Log the update action
            ActivityLog::create([
                'table_name' => 'services',
                'record_id' => $service->serviceID,
                'action' => 'update',
                'old_values' => json_encode($originalValues),
                'new_values' => json_encode(array_merge($service->toArray(), [
                    'admin_id' => $admin->userID,
                    'admin_name' => $admin->firstName . ' ' . $admin->lastName
                ])),
                'userID' => auth()->id(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);
    
            return response()->json([
                'success' => true,
                'message' => 'Service updated successfully',
                'data' => $service
            ]);
        } catch (\Exception $e) {
            \Log::error('Error updating service: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update service.'
            ], 500);
        }
    }

    public function toggleStatus(Request $request, $id)
    {
        if (!auth()->user()->hasPermission('services.toggle')) {
            return response()->json(['success' => false, 'message' => 'You do not have permission to perform this action.'], 403);
        }

        try {
            $admin = auth()->user();
            $service = Service::findOrFail($id);
            $originalStatus = $service->isActive;
            
            // Update the status
            $service->isActive = $request->isActive;

            // If making unavailable, save the reason and date
            if (!$request->isActive) {
                $service->unavailability_reason = $request->reason;
                $service->expected_return = $request->expected_date;
            } else {
                // If making available again, clear the reason and date
                $service->unavailability_reason = null;
                $service->expected_return = null;
            }
            
            $service->save();

            // Log the status change
            ActivityLog::create([
                'table_name' => 'services',
                'record_id' => $service->serviceID,
                'action' => 'update',
                'old_values' => json_encode(['isActive' => $originalStatus]),
                'new_values' => json_encode([
                    'isActive' => $service->isActive,
                    'admin_id' => $admin->userID,
                    'admin_name' => $admin->firstName . ' ' . $admin->lastName
                ]),
                'userID' => auth()->id(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);
            
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

    public function destroy(Request $request, $id)
    {
        if (!auth()->user()->hasPermission('services.delete')) {
            return response()->json(['success' => false, 'message' => 'You do not have permission to perform this action.'], 403);
        }

        try {
            $admin = auth()->user();
            $service = Service::findOrFail($id);
            
            // Store service data for logging before deletion
            $serviceData = $service->toArray();
            
            // Delete service image if it exists
            if ($service->serviceImage && Storage::exists('public/' . $service->serviceImage)) {
                Storage::delete('public/' . $service->serviceImage);
            }

            // Log the deletion action before actual deletion
            ActivityLog::create([
                'table_name' => 'services',
                'record_id' => $service->serviceID,
                'action' => 'delete',
                'old_values' => json_encode($serviceData),
                'new_values' => json_encode([
                    'deleted_by_admin_id' => $admin->userID,
                    'deleted_by_admin_name' => $admin->firstName . ' ' . $admin->lastName
                ]),
                'userID' => auth()->id(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);
            
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
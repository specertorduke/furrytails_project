<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Boarding;
use Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\ActivityLog;


class AdminBoardingsController extends Controller {
    public function index()
    {
        // Calculate all the stats needed for cards
        $totalBoardings = Boarding::count();
        
        $activeBoardings = Boarding::where('start_date', '<=', now()->format('Y-m-d'))
            ->where('end_date', '>=', now()->format('Y-m-d'))
            ->where('status', 'Active')
            ->count();
        
        $completedBoardings = Boarding::where('status', 'Completed')->count();
        
        $cancelledBoardings = Boarding::where('status', 'Cancelled')->count();
        
        // Pass all stats to the view
        return view('admin.boardings', compact(
            'totalBoardings', 
            'activeBoardings', 
            'completedBoardings', 
            'cancelledBoardings'
        ));
    }

    public function getBoardingsData()
    {
        try {
            $boardings = Boarding::with(['pet.user'])
                ->orderBy('start_date', 'desc')
                ->get();
                
            return response()->json([
                'data' => $boardings
            ]);
        } catch (\Exception $e) {
            \Log::error('Error fetching boardings: ' . $e->getMessage());
            return response()->json([
                'error' => 'Failed to load boardings',
                'message' => $e->getMessage(),
                'data' => []
            ], 500);
        }
    }

    // public function cancelBoarding($id)
    // {
    //     try {
    //         $boarding = Boarding::findOrFail($id);
    //         $boarding->status = 'Cancelled';
    //         $boarding->save();
            
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Boarding cancelled successfully'
    //         ]);
    //     } catch (\Exception $e) {
    //         \Log::error('Error cancelling boarding: ' . $e->getMessage());
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Failed to cancel boarding'
    //         ], 500);
    //     }
    // }

    public function cancel(Request $request, $id)
    {
        // Validate admin password
        $validated = $request->validate([
            'admin_password' => 'required|string'
        ], [
            'admin_password.required' => 'Admin password is required to cancel boardings.',
        ]);

        // Verify admin password
        $admin = auth()->user();
        if (!Hash::check($validated['admin_password'], $admin->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid admin password. Please enter your current password to confirm this action.'
            ], 401);
        }

        try {
            $boarding = Boarding::findOrFail($id);
            
            // Store original values for logging
            $originalStatus = $boarding->status;
            
            $boarding->status = 'Cancelled';
            $boarding->save();

            // Log the cancellation action
            ActivityLog::create([
                'table_name' => 'boardings',
                'record_id' => $boarding->boardingID,
                'action' => 'update',
                'old_values' => json_encode(['status' => $originalStatus]),
                'new_values' => json_encode([
                    'status' => 'Cancelled',
                    'cancelled_by_admin_id' => $admin->userID,
                    'cancelled_by_admin_name' => $admin->firstName . ' ' . $admin->lastName
                ]),
                'userID' => auth()->id(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Boarding cancelled successfully'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error cancelling boarding: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to cancel boarding'
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'petID' => 'required|exists:pets,petID',
            'boardingType' => 'required|in:daycare,overnight,long-term',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'status' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $boarding = new Boarding();
            $boarding->petID = $request->petID;
            $boarding->boardingType = $request->boardingType;
            $boarding->start_date = $request->start_date;
            $boarding->end_date = $request->end_date;
            $boarding->status = $request->status;
            $boarding->save();

            return response()->json([
                'success' => true,
                'message' => 'Boarding reservation created successfully',
                'boarding' => $boarding
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating boarding reservation',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get boarding details for view modal
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            // Get boarding with pet, user, AND PAYMENT information
            $boarding = Boarding::with(['pet.user', 'payments'])
                ->findOrFail($id);
                
            // Get the service information for this boarding type
            $service = \App\Models\Service::where('category', 'boarding')
                ->where('name', 'LIKE', '%'.$boarding->boardingType.'%')
                ->first();
                
            // Add service price info to the boarding data
            $boarding->baseRate = $service ? $service->price : 0;
                
            // Get boarding history for this pet
            $boardingHistory = Boarding::where('petID', $boarding->petID)
                ->where('boardingID', '!=', $id)
                ->orderBy('start_date', 'desc')
                ->take(5)
                ->get();
                
            return response()->json([
                'success' => true,
                'boarding' => $boarding,
                'boardingHistory' => $boardingHistory
            ]);
        } catch (\Exception $e) {
            \Log::error('Error fetching boarding details: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve boarding details',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Update boarding status
     * 
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:Confirmed,Active,Completed,Cancelled'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $boarding = Boarding::findOrFail($id);
            $boarding->status = $request->status;
            $boarding->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Boarding status updated successfully',
                'boarding' => $boarding
            ]);
        } catch (\Exception $e) {
            \Log::error('Error updating boarding status: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update boarding status',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update boarding details
     * 
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'petID' => 'required|exists:pets,petID',
            'boardingType' => 'required|in:daycare,overnight,long-term',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:Confirmed,Active,Completed,Cancelled'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $boarding = Boarding::findOrFail($id);
            $boarding->petID = $request->petID;
            $boarding->boardingType = $request->boardingType;
            $boarding->start_date = $request->start_date;
            $boarding->end_date = $request->end_date;
            $boarding->status = $request->status;
            $boarding->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Boarding updated successfully',
                'boarding' => $boarding
            ]);
        } catch (\Exception $e) {
            \Log::error('Error updating boarding: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update boarding',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get boarding data for editing
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        try {
            // Get boarding with pet and user information
            $boarding = Boarding::with(['pet.user'])
                ->findOrFail($id);
                
            return response()->json([
                'success' => true,
                'boarding' => $boarding
            ]);
        } catch (\Exception $e) {
            \Log::error('Error fetching boarding for edit: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve boarding data',
                'error' => $e->getMessage()
            ], 404);
        }
    }
}

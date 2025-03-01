<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Boarding;

class AdminBoardingsController extends Controller {
    public function index()
    {
        // Calculate all the stats needed for cards
        $totalBoardings = Boarding::count();
        z
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

    public function cancelBoarding($id)
    {
        try {
            $boarding = Boarding::findOrFail($id);
            $boarding->status = 'Cancelled';
            $boarding->save();
            
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
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class AdminReportsController extends Controller
{
    /**
     * Display the reports page
     */
    public function index()
    {
        // Get activity statistics
        $totalLogs = ActivityLog::count();
        $createActions = ActivityLog::where('action', 'create')->count();
        $updateActions = ActivityLog::where('action', 'update')->count();
        $deleteActions = ActivityLog::where('action', 'delete')->count();
        
        // Get users for filter dropdown
        $users = User::select('userID', 'firstName', 'lastName')->get();
        
        return view('admin.reports', compact(
            'totalLogs', 
            'createActions', 
            'updateActions', 
            'deleteActions',
            'users'
        ));
    }
    
    /**
     * Get activity logs data for DataTables
     */
    public function getLogsData(Request $request)
    {
        $query = ActivityLog::with('user');
        
        // Apply filters if provided
        if ($request->filled('table')) {
            $query->where('table_name', $request->table);
        }
        
        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }
        
        if ($request->filled('user_id')) {
            $query->where('userID', $request->user_id);
        }
        
        if ($request->filled('record_id')) {
            $query->where('record_id', $request->record_id);
        }
        
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        
        return DataTables::of($query)->toJson();
    }
    
    /**
     * Show log details
     */
    public function show($id)
    {
        $log = ActivityLog::with('user')->findOrFail($id);
        
        return response()->json([
            'success' => true,
            'data' => $log
        ]);
    }
    
    /**
     * Restore database to a point in time
     */
    public function restore(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'timestamp' => 'required|date',
            'confirm' => 'required|boolean'
        ]);
        
        if (!$validated['confirm']) {
            return response()->json([
                'success' => false,
                'message' => 'Confirmation is required'
            ], 400);
        }
        
        try {
            // Parse the timestamp
            $timestamp = Carbon::parse($validated['timestamp']);
            
            // Call the Artisan command to restore the database
            Artisan::call('db:restore', [
                '--time' => $timestamp->toDateTimeString(),
                '--confirm' => true
            ]);
            
            // Get command output
            $output = Artisan::output();
            
            // Log the restoration action
            ActivityLog::create([
                'table_name' => 'system',
                'record_id' => 0,
                'action' => 'restore',
                'new_values' => json_encode(['timestamp' => $timestamp->toDateTimeString()]),
                'userID' => auth()->id(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Database restored successfully',
                'output' => $output
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to restore database: ' . $e->getMessage()
            ], 500);
        }
    }
}
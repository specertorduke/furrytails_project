<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Appointment;
use App\Models\Boarding;
use App\Models\Payment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;


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
     * Get activity logs data for DataTables (manual server-side implementation)
     */
    public function getLogsData(Request $request)
    {
        $draw   = (int) $request->input('draw', 1);
        $start  = (int) $request->input('start', 0);
        $length = (int) $request->input('length', 10);

        $query = ActivityLog::with('user');

        // --- Custom filter params sent by the view ---
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

        // --- DataTables global search ---
        $searchValue = $request->input('search.value');
        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->where('table_name', 'like', "%{$searchValue}%")
                  ->orWhere('action',     'like', "%{$searchValue}%")
                  ->orWhere('ip_address', 'like', "%{$searchValue}%")
                  ->orWhere('record_id',  'like', "%{$searchValue}%")
                  ->orWhereHas('user', function ($u) use ($searchValue) {
                      $u->where('firstName', 'like', "%{$searchValue}%")
                        ->orWhere('lastName', 'like', "%{$searchValue}%");
                  });
            });
        }

        $recordsFiltered = $query->count();
        $recordsTotal    = ActivityLog::count();

        // --- Ordering ---
        $columnMap = [
            0 => 'logID',
            1 => 'created_at',
            2 => 'table_name',
            3 => 'record_id',
            4 => 'action',
            6 => 'ip_address',
        ];
        $orderColumnIndex = (int) $request->input('order.0.column', 0);
        $orderDir         = $request->input('order.0.dir', 'desc') === 'asc' ? 'asc' : 'desc';
        $orderColumn      = $columnMap[$orderColumnIndex] ?? 'logID';
        $query->orderBy($orderColumn, $orderDir);

        // --- Pagination ---
        $data = $query->skip($start)->take($length)->get();

        return response()->json([
            'draw'            => $draw,
            'recordsTotal'    => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data'            => $data,
        ]);
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
        if (!auth()->user()->hasPermission('reports.restore')) {
            return response()->json(['success' => false, 'message' => 'You do not have permission to perform this action.'], 403);
        }
        // Validate input
        $validated = $request->validate([
            'timestamp' => 'nullable|date',
            'log_id' => 'nullable|integer|min:1',
            'password' => 'required|string',
            'confirm' => 'required|boolean'
        ]);

        if (!$validated['confirm']) {
            return response()->json([
                'success' => false,
                'message' => 'Confirmation is required'
            ], 400);
        }

        // Verify admin password
        $admin = auth()->user();
        if (!Hash::check($validated['password'], $admin->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid password. Please enter your current password to confirm this action.'
            ], 401);
        }

        if (empty($validated['timestamp']) && empty($validated['log_id'])) {
            return response()->json([
                'success' => false,
                'message' => 'A restore timestamp or log ID is required.'
            ], 422);
        }

        try {
            $restorePoint = null;
            $method = 'timestamp';
            $sourceLogId = null;

            if (!empty($validated['log_id'])) {
                $log = ActivityLog::find($validated['log_id']);

                if (!$log) {
                    return response()->json([
                        'success' => false,
                        'message' => 'The specified activity log could not be found.'
                    ], 404);
                }

                $restorePoint = Carbon::parse($log->created_at);
                $method = 'log_id';
                $sourceLogId = $log->logID;
            }

            if ($restorePoint === null) {
                $restorePoint = Carbon::parse($validated['timestamp']);
            }
            
            // Call the Artisan command to restore the database
            Artisan::call('db:restore', [
                '--time' => $restorePoint->toDateTimeString(),
                '--confirm' => true
            ]);
            
            // Get command output
            $output = Artisan::output();
            
            // Log the restoration action with admin details
            ActivityLog::create([
                'table_name' => 'system',
                'record_id' => 0,
                'action' => 'restore',
                'new_values' => json_encode([
                    'timestamp' => $restorePoint->toDateTimeString(),
                    'method' => $method,
                    'source_log_id' => $sourceLogId,
                    'requested_timestamp' => $validated['timestamp'] ?? null,
                    'admin_id' => $admin->userID,
                    'admin_name' => $admin->firstName . ' ' . $admin->lastName
                ]),
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
                'message' => 'Failed to restore database.'
            ], 500);
        }
    }

    /**
     * Return 12-month analytics: revenue, booking volumes, top services.
     */
    public function getAnalyticsData()
    {
        $months = collect();
        for ($i = 11; $i >= 0; $i--) {
            $months->push(Carbon::now()->startOfMonth()->subMonths($i));
        }

        $windowStart = Carbon::now()->subMonths(11)->startOfMonth();

        // Monthly revenue (Completed payments)
        $revenueRaw = Payment::where('status', 'Completed')
            ->where('created_at', '>=', $windowStart)
            ->select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(amount) as total')
            )
            ->groupBy('year', 'month')
            ->get()
            ->keyBy(fn ($r) => $r->year . '-' . str_pad($r->month, 2, '0', STR_PAD_LEFT));

        // Monthly confirmed appointments
        $appointmentsRaw = Appointment::where('status', 'Confirmed')
            ->where('date', '>=', $windowStart)
            ->select(
                DB::raw('YEAR(date) as year'),
                DB::raw('MONTH(date) as month'),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('year', 'month')
            ->get()
            ->keyBy(fn ($r) => $r->year . '-' . str_pad($r->month, 2, '0', STR_PAD_LEFT));

        // Monthly boardings (non-Cancelled)
        $boardingsRaw = Boarding::whereNotIn('status', ['Cancelled'])
            ->where('start_date', '>=', $windowStart)
            ->select(
                DB::raw('YEAR(start_date) as year'),
                DB::raw('MONTH(start_date) as month'),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('year', 'month')
            ->get()
            ->keyBy(fn ($r) => $r->year . '-' . str_pad($r->month, 2, '0', STR_PAD_LEFT));

        $labels   = [];
        $revenue  = [];
        $apptData = [];
        $brdData  = [];

        foreach ($months as $m) {
            $key        = $m->format('Y-m');
            $labels[]   = $m->format('M Y');
            $revenue[]  = (float) ($revenueRaw[$key]->total   ?? 0);
            $apptData[] = (int)   ($appointmentsRaw[$key]->total ?? 0);
            $brdData[]  = (int)   ($boardingsRaw[$key]->total    ?? 0);
        }

        // Top 5 services by confirmed appointment count (all time)
        $topServices = Service::withCount([
                'appointments' => fn ($q) => $q->where('status', 'Confirmed')
            ])
            ->orderByDesc('appointments_count')
            ->take(5)
            ->get(['serviceID', 'name', 'price', 'category']);

        // Summary totals
        $totalRevenue      = Payment::where('status', 'Completed')->sum('amount');
        $totalAppointments = Appointment::count();
        $totalBoardings    = Boarding::count();
        $totalPayments     = Payment::where('status', 'Completed')->count();

        return response()->json([
            'labels'       => $labels,
            'revenue'      => $revenue,
            'appointments' => $apptData,
            'boardings'    => $brdData,
            'topServices'  => $topServices,
            'totals'       => [
                'revenue'      => $totalRevenue,
                'appointments' => $totalAppointments,
                'boardings'    => $totalBoardings,
                'payments'     => $totalPayments,
            ],
        ]);
    }

    /**
     * Export records as CSV.
     * ?type=payments|appointments|boardings|logs
     */
    public function exportCsv(Request $request)
    {
        $type     = $request->input('type', 'payments');
        $filename = $type . '_export_' . Carbon::now()->format('Y-m-d') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Pragma'              => 'no-cache',
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Expires'             => '0',
        ];

        $callback = function () use ($type) {
            $handle = fopen('php://output', 'w');

            switch ($type) {
                case 'appointments':
                    fputcsv($handle, ['ID', 'Date', 'Time', 'Pet', 'Owner', 'Service', 'Status']);
                    Appointment::with(['pet.user', 'service'])
                        ->orderBy('date', 'desc')
                        ->chunk(500, function ($rows) use ($handle) {
                            foreach ($rows as $a) {
                                $pet   = $a->pet   ? $a->pet->name   : 'N/A';
                                $owner = ($a->pet && $a->pet->user)
                                    ? $a->pet->user->firstName . ' ' . $a->pet->user->lastName
                                    : 'N/A';
                                $svc   = $a->service ? $a->service->name : 'N/A';
                                fputcsv($handle, [
                                    $a->appointmentID, $a->date, $a->time,
                                    $pet, $owner, $svc, $a->status,
                                ]);
                            }
                        });
                    break;

                case 'boardings':
                    fputcsv($handle, ['ID', 'Start Date', 'End Date', 'Type', 'Pet', 'Owner', 'Status']);
                    Boarding::with('pet.user')
                        ->orderBy('start_date', 'desc')
                        ->chunk(500, function ($rows) use ($handle) {
                            foreach ($rows as $b) {
                                $pet   = $b->pet   ? $b->pet->name   : 'N/A';
                                $owner = ($b->pet && $b->pet->user)
                                    ? $b->pet->user->firstName . ' ' . $b->pet->user->lastName
                                    : 'N/A';
                                fputcsv($handle, [
                                    $b->boardingID, $b->start_date, $b->end_date,
                                    $b->boardingType, $pet, $owner, $b->status,
                                ]);
                            }
                        });
                    break;

                case 'logs':
                    fputcsv($handle, ['Log ID', 'Date', 'Table', 'Record ID', 'Action', 'User', 'IP Address']);
                    ActivityLog::with('user')
                        ->orderBy('created_at', 'desc')
                        ->chunk(500, function ($rows) use ($handle) {
                            foreach ($rows as $l) {
                                $user = $l->user
                                    ? $l->user->firstName . ' ' . $l->user->lastName
                                    : 'System';
                                fputcsv($handle, [
                                    $l->logID, $l->created_at, $l->table_name,
                                    $l->record_id, $l->action, $user, $l->ip_address,
                                ]);
                            }
                        });
                    break;

                case 'payments':
                default:
                    fputcsv($handle, ['ID', 'Date', 'User', 'Amount', 'Status', 'Method']);
                    Payment::with('user')
                        ->orderBy('created_at', 'desc')
                        ->chunk(500, function ($rows) use ($handle) {
                            foreach ($rows as $p) {
                                $name = $p->user
                                    ? $p->user->firstName . ' ' . $p->user->lastName
                                    : 'N/A';
                                fputcsv($handle, [
                                    $p->paymentID, $p->created_at, $name,
                                    $p->amount, $p->status, $p->payment_method ?? 'N/A',
                                ]);
                            }
                        });
                    break;
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
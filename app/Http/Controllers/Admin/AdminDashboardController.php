<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Appointment;
use App\Models\Boarding;
use App\Models\Service;
use App\Models\Pet;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB; 

class AdminDashboardController extends AdminController
{
    public function index()
    {
        // Count veterinary appointments (where service name doesn't contain "Grooming")
        $vetAppointmentsCount = Appointment::whereHas('service', function($query) {
            $query->whereRaw('LOWER(name) NOT LIKE ?', ['%grooming%']);
        })->count();
        
        $chartData = $this->getServicePopularityData();
        $recentActivities = $this->getRecentActivities();
        $revenueData = $this->getRevenueData();

        // Get overview stats for dashboard
        $stats = [
            'users_count' => User::count(),
            'vet_appointments_count' => $vetAppointmentsCount,
            'appointments_count' => Appointment::whereHas('service', function($query) {
                $query->whereRaw('LOWER(name) LIKE ?', ['%grooming%']);
            })->count(),
            'boardings_count' => Boarding::count(),
            'pets_count' => Pet::count(),
            'chart_data' => $chartData,
            'recent_activities' => $recentActivities,

            // Revenue data
            'total_revenue' => $revenueData['total_revenue'],
            'revenue_growth' => $revenueData['revenue_growth'],
            'last_month_revenue' => $revenueData['last_month_revenue'],
            'projected_revenue' => $revenueData['projected_revenue']
        ];

        return view('admin.dashboard', compact('stats'));
    }

    /**
     * Get service popularity data for chart
     */
    private function getServicePopularityData()
    {
        $currentYear = Carbon::now()->year;
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        
        // Initialize data structure with zeros for all months
        $groomingData = array_fill(0, 12, 0);
        $vetServicesData = array_fill(0, 12, 0);
        
        // Get grooming appointments by month
        $groomingAppointments = Appointment::select(
                DB::raw('MONTH(date) as month'), 
                DB::raw('COUNT(*) as count')
            )
            ->whereYear('date', $currentYear)
            ->whereHas('service', function($query) {
                $query->whereRaw('LOWER(name) LIKE ?', ['%grooming%']);
            })
            ->groupBy(DB::raw('MONTH(date)'))
            ->get();
            
        // Fill grooming data
        foreach ($groomingAppointments as $appointment) {
            $month = $appointment->month - 1; // Convert 1-12 to 0-11 for array index
            $groomingData[$month] = $appointment->count;
        }
        
        // Get vet appointments by month (non-grooming)
        $vetAppointments = Appointment::select(
                DB::raw('MONTH(date) as month'), 
                DB::raw('COUNT(*) as count')
            )
            ->whereYear('date', $currentYear)
            ->whereHas('service', function($query) {
                $query->whereRaw('LOWER(name) NOT LIKE ?', ['%grooming%']);
            })
            ->groupBy(DB::raw('MONTH(date)'))
            ->get();
            
        // Fill vet services data
        foreach ($vetAppointments as $appointment) {
            $month = $appointment->month - 1;
            $vetServicesData[$month] = $appointment->count;
        }
        
        // Get boarding data by month
        $boardingData = array_fill(0, 12, 0);
        
        $boardings = Boarding::select(
                DB::raw('MONTH(start_date) as month'), 
                DB::raw('COUNT(*) as count')
            )
            ->whereYear('start_date', $currentYear)
            ->groupBy(DB::raw('MONTH(start_date)'))
            ->get();
            
        foreach ($boardings as $boarding) {
            $month = $boarding->month - 1;
            $boardingData[$month] = $boarding->count;
        }
        
        return [
            'months' => $months,
            'grooming' => $groomingData,
            'boarding' => $boardingData,
            'vet_services' => $vetServicesData
        ];
    }

    public function getWeeklyServiceData()
    {
        // Get data for the last 4 weeks
        $weeks = [];
        $groomingData = [];
        $boardingData = [];
        $vetServicesData = [];
        
        for ($i = 3; $i >= 0; $i--) {
            $startDate = Carbon::now()->subWeeks($i)->startOfWeek();
            $endDate = Carbon::now()->subWeeks($i)->endOfWeek();
            
            $weeks[] = 'Week ' . (4 - $i);
            
            // Count grooming appointments
            $groomingCount = Appointment::whereBetween('date', [$startDate, $endDate])
                ->whereHas('service', function($query) {
                    $query->whereRaw('LOWER(name) LIKE ?', ['%grooming%']);
                })
                ->count();
            $groomingData[] = $groomingCount;
            
            // Count vet services
            $vetCount = Appointment::whereBetween('date', [$startDate, $endDate])
                ->whereHas('service', function($query) {
                    $query->whereRaw('LOWER(name) NOT LIKE ?', ['%grooming%']);
                })
                ->count();
            $vetServicesData[] = $vetCount;
            
            // Count boardings
            $boardingCount = Boarding::where(function($query) use ($startDate, $endDate) {
                $query->whereBetween('start_date', [$startDate, $endDate])
                    ->orWhereBetween('end_date', [$startDate, $endDate])
                    ->orWhere(function($q) use ($startDate, $endDate) {
                        $q->where('start_date', '<', $startDate)
                            ->where('end_date', '>', $endDate);
                    });
            })->count();
            $boardingData[] = $boardingCount;
        }
        
        return response()->json([
            'weeks' => $weeks,
            'grooming' => $groomingData,
            'boarding' => $boardingData,
            'vet_services' => $vetServicesData
        ]);
    }

    /**
     * Get recent activities for the dashboard
     */
    private function getRecentActivities()
    {
        $activities = collect();
        
        // Get recent user registrations
        $recentUsers = User::where('role', '!=', 'admin')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function($user) {
                return [
                    'type' => 'user',
                    'icon' => 'user-plus',
                    'color' => '#24CFF4',
                    'title' => 'New user registered',
                    'description' => "{$user->firstName} {$user->lastName} created an account",
                    'time' => $user->created_at,
                    'time_formatted' => $user->created_at->diffForHumans()
                ];
            });
        $activities = $activities->concat($recentUsers);
        
        // Get recent appointments
        $recentAppointments = Appointment::with(['pet', 'service'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function($appointment) {
                $serviceName = $appointment->service->name ?? 'Unknown Service';
                $petName = $appointment->pet->name ?? 'Unknown Pet';
                
                return [
                    'type' => 'appointment',
                    'icon' => 'calendar-check',
                    'color' => '#FF9666',
                    'title' => 'New appointment booked',
                    'description' => "{$serviceName} for {$petName}",
                    'time' => $appointment->created_at,
                    'time_formatted' => $appointment->created_at->diffForHumans()
                ];
            });
        $activities = $activities->concat($recentAppointments);
        
        // Get recent pets
        $recentPets = Pet::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function($pet) {
                $ownerName = $pet->user ? "{$pet->user->firstName} {$pet->user->lastName}" : "Unknown Owner";
                
                return [
                    'type' => 'pet',
                    'icon' => 'paw',
                    'color' => '#66FF8F',
                    'title' => 'New pet registered',
                    'description' => "{$pet->name} ({$pet->type}) added by {$ownerName}",
                    'time' => $pet->created_at,
                    'time_formatted' => $pet->created_at->diffForHumans()
                ];
            });
        $activities = $activities->concat($recentPets);
        
        // Get recent boardings
        $recentBoardings = Boarding::with(['pet', 'user'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function($boarding) {
                $petName = $boarding->pet->name ?? 'Unknown Pet';
                $startDate = Carbon::parse($boarding->start_date)->format('M d');
                $endDate = Carbon::parse($boarding->end_date)->format('M d');
                
                return [
                    'type' => 'boarding',
                    'icon' => 'home',
                    'color' => '#66FF8F',
                    'title' => 'New boarding reservation',
                    'description' => "Boarding for {$petName} from {$startDate} to {$endDate}",
                    'time' => $boarding->created_at,
                    'time_formatted' => $boarding->created_at->diffForHumans()
                ];
            });
        $activities = $activities->concat($recentBoardings);
        
        // Sort by time and take the 4 most recent activities
        return $activities
            ->sortByDesc('time')
            ->take(4)
            ->values()
            ->all();
    }

    /**
     * Calculate revenue metrics for the dashboard
     */
    private function getRevenueData()
    {
        $now = Carbon::now();
        $currentMonth = $now->month;
        $currentYear = $now->year;
        
        // Get the first day of the current month
        $firstDayCurrentMonth = Carbon::createFromDate($currentYear, $currentMonth, 1)->startOfDay();
        
        // Get the first day of the previous month
        $firstDayLastMonth = Carbon::createFromDate($currentYear, $currentMonth, 1)->subMonth()->startOfDay();
        $lastDayLastMonth = Carbon::createFromDate($currentYear, $currentMonth, 1)->subDay()->endOfDay();
        
        // Calculate total revenue
        $totalRevenue = $this->calculateTotalRevenue();
        
        // Calculate current month's revenue
        $currentMonthRevenue = $this->calculateRevenueForPeriod($firstDayCurrentMonth, $now->endOfDay());
        
        // Calculate last month's revenue
        $lastMonthRevenue = $this->calculateRevenueForPeriod($firstDayLastMonth, $lastDayLastMonth);
        
        // Calculate growth percentage
        $revenueGrowth = 0;
        if ($lastMonthRevenue > 0) {
            $completionPercentage = $now->day / $now->daysInMonth; // How far we are through current month
            $projectedMonthlyRevenue = ($completionPercentage > 0) ? $currentMonthRevenue / $completionPercentage : 0;
            $revenueGrowth = ($projectedMonthlyRevenue - $lastMonthRevenue) / $lastMonthRevenue * 100;
        }
        
        // Project next month's revenue based on growth trend
        $growthRate = 1 + ($revenueGrowth / 100);
        $projectedRevenue = $currentMonthRevenue * $growthRate;
        
        // Ensure we have logical values
        if ($projectedRevenue < $currentMonthRevenue && $revenueGrowth > 0) {
            $projectedRevenue = $currentMonthRevenue * 1.05; // Default 5% growth
        }
        
        return [
            'total_revenue' => $totalRevenue,
            'current_month_revenue' => $currentMonthRevenue,
            'last_month_revenue' => $lastMonthRevenue,
            'revenue_growth' => round($revenueGrowth, 1), // Round to 1 decimal place
            'projected_revenue' => round($projectedRevenue)
        ];
    }
    
    /**
     * Calculate total revenue from all payments
     */
    private function calculateTotalRevenue()
    {
        // Assuming you have a payments table with amount column
        // Modify this according to your actual database structure
        return DB::table('payments')->sum('amount') ?? 0;
    }
    
    /**
     * Calculate revenue for a specific time period
     */
    private function calculateRevenueForPeriod($startDate, $endDate)
    {
        // Modify this according to your actual database structure
        return DB::table('payments')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('amount') ?? 0;
    }
}
@extends('admin.adminLayout')

@section('title', 'Admin Dashboard')

@section('content')
<div class="tw-p-6 tw-min-h-screen tw-bg-gray-900">
    <!-- Header Section -->
    <div class="tw-flex tw-flex-col md:tw-flex-row tw-justify-between tw-items-start md:tw-items-center tw-mb-6">
        <div>
            <p class="tw-text-sm tw-text-gray-400">Analytics / Dashboard</p>
            <h1 class="tw-text-2xl tw-font-bold tw-text-white">Admin Dashboard</h1>
        </div>
        <div class="tw-mt-4 md:tw-mt-0">
            <div class="tw-bg-gray-800 tw-text-white tw-px-4 tw-py-2 tw-rounded-lg tw-flex tw-items-center tw-gap-2">
                <i class="fas fa-calendar-alt"></i>
                <span>{{ date('F d, Y') }}</span>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 lg:tw-grid-cols-4 tw-gap-6 tw-mb-6">
        <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-6 tw-border-l-4 tw-border-[#24CFF4] tw-transition-all tw-duration-300 hover:tw-shadow-md">
            <div class="tw-flex tw-justify-between tw-items-center">
                <div>
                    <p class="tw-text-gray-400 tw-text-sm">Total Users</p>
                    <h3 class="tw-text-2xl tw-font-bold tw-text-white">{{ $stats['users_count'] }}</h3>
                    <p class="tw-text-xs tw-text-green-400 tw-mt-1"><i class="fas fa-arrow-up"></i> +5% this week</p>
                </div>
                <div class="tw-bg-gray-700 tw-p-3 tw-rounded-full">
                    <i class="fas fa-users tw-text-[#24CFF4] tw-text-xl"></i>
                </div>
            </div>
        </div>

        <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-6 tw-border-l-4 tw-border-[#66FF8F] tw-transition-all tw-duration-300 hover:tw-shadow-md">
            <div class="tw-flex tw-justify-between tw-items-center">
                <div>
                    <p class="tw-text-gray-400 tw-text-sm">Total Pets</p>
                    <h3 class="tw-text-2xl tw-font-bold tw-text-white">{{ $stats['pets_count'] }}</h3>
                    <p class="tw-text-xs tw-text-green-400 tw-mt-1"><i class="fas fa-arrow-up"></i> +8% this month</p>
                </div>
                <div class="tw-bg-gray-700 tw-p-3 tw-rounded-full">
                    <i class="fas fa-paw tw-text-[#66FF8F] tw-text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-6 tw-border-l-4 tw-border-[#FF9666] tw-transition-all tw-duration-300 hover:tw-shadow-md">
            <div class="tw-flex tw-justify-between tw-items-center">
                <div>
                    <p class="tw-text-gray-400 tw-text-sm">Appointments</p>
                    <h3 class="tw-text-2xl tw-font-bold tw-text-white">{{ $stats['appointments_count'] }}</h3>
                    <p class="tw-text-xs tw-text-green-400 tw-mt-1"><i class="fas fa-arrow-up"></i> +12% this month</p>
                </div>
                <div class="tw-bg-gray-700 tw-p-3 tw-rounded-full">
                    <i class="fas fa-calendar-check tw-text-[#FF9666] tw-text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-6 tw-border-l-4 tw-border-[#66FF8F] tw-transition-all tw-duration-300 hover:tw-shadow-md">
            <div class="tw-flex tw-justify-between tw-items-center">
                <div>
                    <p class="tw-text-gray-400 tw-text-sm">Boardings</p>
                    <h3 class="tw-text-2xl tw-font-bold tw-text-white">{{ $stats['boardings_count'] }}</h3>
                    <p class="tw-text-xs tw-text-green-400 tw-mt-1"><i class="fas fa-arrow-up"></i> +8% this month</p>
                </div>
                <div class="tw-bg-gray-700 tw-p-3 tw-rounded-full">
                    <i class="fas fa-home tw-text-[#66FF8F] tw-text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Row -->
    <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-4 tw-gap-6 tw-mb-6">
        <a type="button" data-modal-target="addUser-modal" class="tw-bg-gray-800 tw-no-underline tw-rounded-xl tw-p-4 tw-flex tw-items-center tw-gap-3 tw-transition-all hover:tw-shadow-md hover:tw-bg-gray-700">
            <div class="tw-h-10 tw-w-10 tw-rounded-full tw-bg-[#24CFF4]/20 tw-flex tw-items-center tw-justify-center tw-flex-shrink-0">
                <i class="fas fa-user-plus tw-text-[#24CFF4]"></i>
            </div>
            <span class="tw-text-sm tw-font-medium tw-text-white">Add User</span>
        </a>
        <a type="button" data-modal-target="admin-addPet-modal" class="tw-bg-gray-800 tw-no-underline tw-rounded-xl tw-p-4 tw-flex tw-items-center tw-gap-3 tw-transition-all hover:tw-shadow-md hover:tw-bg-gray-700">
            <div class="tw-h-10 tw-w-10 tw-rounded-full tw-bg-[#66FF8F]/20 tw-flex tw-items-center tw-justify-center tw-flex-shrink-0">
                <i class="fas fa-paw tw-text-[#66FF8F]"></i>
            </div>
            <span class="tw-text-sm tw-font-medium tw-text-white">Add Pet</span>
        </a>
        <a type="button" data-modal-target="adminAddAppointment-modal" class="tw-bg-gray-800 tw-no-underline tw-rounded-xl tw-p-4 tw-flex tw-items-center tw-gap-3 tw-transition-all hover:tw-shadow-md hover:tw-bg-gray-700">
            <div class="tw-h-10 tw-w-10 tw-rounded-full tw-bg-[#FF9666]/20 tw-flex tw-items-center tw-justify-center tw-flex-shrink-0">
                <i class="fas fa-calendar-plus tw-text-[#FF9666]"></i>
            </div>
            <span class="tw-text-sm tw-font-medium tw-text-white">Add Appointment</span>
        </a>
        <a type="button" data-modal-target="adminAddBoarding-modal" class="tw-bg-gray-800 tw-no-underline tw-rounded-xl tw-p-4 tw-flex tw-items-center tw-gap-3 tw-transition-all hover:tw-shadow-md hover:tw-bg-gray-700">
            <div class="tw-h-10 tw-w-10 tw-rounded-full tw-bg-[#66FF8F]/20 tw-flex tw-items-center tw-justify-center tw-flex-shrink-0">
                <i class="fas fa-home tw-text-[#66FF8F]"></i>
            </div>
            <span class="tw-text-sm tw-font-medium tw-text-white">Add Boarding</span>
        </a>
    </div>

    <!-- Main Content -->
    <div class="tw-grid tw-grid-cols-1 lg:tw-grid-cols-3 tw-gap-6">
        <!-- Left Column - Chart -->
        <div class="lg:tw-col-span-2">
            <!-- Upcoming Appointments Table -->
            <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-6 tw-mb-6 tw-transition-all tw-duration-300 hover:tw-shadow-md">
                <div class="tw-flex tw-justify-between tw-items-center tw-mb-4">
                    <h2 class="tw-text-lg tw-font-bold tw-text-white">Upcoming Appointments</h2>
                    <a href="{{ route('admin.appointments') }}" class="tw-text-[#24CFF4] tw-text-sm tw-font-medium hover:tw-underline">View All</a>
                </div>
                
                <div class="tw-overflow-x-auto">
                    <table id="upcomingAppointmentsTable" class="tw-min-w-full tw-divide-y tw-divide-gray-700">
                        <thead>
                            <tr>
                                <th class="tw-px-4 tw-py-3 tw-bg-gray-700 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">ID</th>
                                <th class="tw-px-4 tw-py-3 tw-bg-gray-700 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">User</th>
                                <th class="tw-px-4 tw-py-3 tw-bg-gray-700 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">Pet</th>
                                <th class="tw-px-4 tw-py-3 tw-bg-gray-700 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">Service</th>
                                <th class="tw-px-4 tw-py-3 tw-bg-gray-700 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">Date</th>
                                <th class="tw-px-4 tw-py-3 tw-bg-gray-700 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">Time</th>
                                <th class="tw-px-4 tw-py-3 tw-bg-gray-700"></th>
                            </tr>
                        </thead>
                        <tbody class="tw-bg-gray-800 tw-divide-y tw-divide-gray-700">
                        </tbody>
                    </table>
                </div>
            </div>   

            <!-- Ongoing Boarding Capacity Visualization -->
            <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-6 tw-mt-6 tw-mb-6 tw-transition-all tw-duration-300 hover:tw-shadow-md">
                <div class="tw-flex tw-justify-between tw-items-center tw-mb-4">
                    <h2 class="tw-text-lg tw-font-bold tw-text-white">Ongoing Boarding</h2>
                    <span class="tw-text-sm tw-font-medium tw-text-gray-300">
                        <span id="active-boardings">{{ $stats['active_boardings'] ?? 0 }}</span>/10 Capacity
                    </span>
                </div>

                <div class="tw-mb-4">
                    <div class="tw-w-full tw-bg-gray-700 tw-rounded-full tw-h-3">
                        <div id="boarding-capacity-bar" class="tw-bg-[#66FF8F] tw-h-3 tw-rounded-full" 
                            style="width: {{ (($stats['active_boardings'] ?? 0) / 10) * 100 }}%"></div>
                    </div>
                    <div class="tw-flex tw-justify-between tw-mt-1">
                        <span class="tw-text-xs tw-text-gray-400">0</span>
                        <span class="tw-text-xs tw-text-gray-400">Capacity: 10</span>
                    </div>
                </div>

                <!-- Boarding Pet Cards Container -->
                <div id="boarding-pets-container" class="tw-grid tw-grid-cols-1 sm:tw-grid-cols-2 lg:tw-grid-cols-3 tw-gap-4">
                    <!-- Pet cards will be populated by JavaScript -->
                </div>

                <div class="tw-mt-4 tw-text-center">
                    <a href="{{ route('admin.boardings') }}" class="tw-text-[#66FF8F] tw-text-sm tw-font-medium hover:tw-underline">
                        View All Boardings
                    </a>
                </div>
            </div>

            <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-6 tw-transition-all tw-duration-300 hover:tw-shadow-md">             
                <div class="tw-flex tw-justify-between tw-items-center tw-mb-4">
                    <h3 class="tw-text-lg tw-font-semibold tw-text-white">Service Popularity</h3>
                    <div class="tw-inline-flex tw-rounded-md tw-shadow-sm" role="group" id="chart-period-toggle">
                        <button type="button" class="tw-px-4 tw-py-2 tw-text-sm tw-font-medium tw-text-white tw-bg-[#0f7e97] tw-border-0 tw-rounded-l-lg tw-focus:tw-outline-none" data-period="monthly">
                            Monthly
                        </button>
                        <button type="button" class="tw-px-4 tw-py-2 tw-text-sm tw-font-medium tw-text-gray-300 tw-bg-gray-700 tw-border-0 tw-rounded-r-lg tw-focus:tw-outline-none" data-period="weekly">
                            Weekly
                        </button>
                    </div>
                </div>

                <!-- Chart canvas -->
                <div class="tw-h-72">
                    <canvas id="servicesChart"></canvas>
                </div>
            </div>
        </div>
        
        <!-- Right Column - Activity and Quick Stats -->
        <div class="lg:tw-col-span-1">
            <!-- Overview Card -->
            <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-6 tw-transition-all tw-duration-300 hover:tw-shadow-md">
                <h2 class="tw-text-lg tw-font-bold tw-text-white tw-mb-4">System Overview</h2>
                
                <div class="tw-space-y-4">
                    <!-- Pet Types Breakdown -->
                    <div>
                        <div class="tw-flex tw-justify-between tw-items-center tw-mb-2">
                            <span class="tw-text-sm tw-text-gray-300">Pet Types</span>
                            <span class="tw-text-sm tw-font-medium tw-text-white">{{ $stats['pets_count'] ?? 0 }} Total</span>
                        </div>
                        <div class="tw-flex tw-gap-2 tw-mb-2">
                            <div class="tw-h-2 tw-rounded-full tw-bg-[#24CFF4]" style="width: {{ ($stats['dogs_percent'] ?? 60) }}%"></div>
                            <div class="tw-h-2 tw-rounded-full tw-bg-[#FF9666]" style="width: {{ ($stats['cats_percent'] ?? 40) }}%"></div>
                        </div>
                        <div class="tw-flex tw-justify-between tw-text-xs tw-text-gray-400">
                            <span><i class="fas fa-circle tw-text-[#24CFF4] tw-mr-1"></i> Dogs ({{ $stats['dogs_percent'] ?? 60 }}%)</span>
                            <span><i class="fas fa-circle tw-text-[#FF9666] tw-mr-1"></i> Cats ({{ $stats['cats_percent'] ?? 40 }}%)</span>
                        </div>
                    </div>
                    
                    <!-- Service Utilization -->
                    <div>
                        <div class="tw-flex tw-justify-between tw-items-center tw-mb-2">
                            <span class="tw-text-sm tw-text-gray-300">Service Utilization</span>
                        </div>
                        <div class="tw-space-y-2">
                            <div>
                                <div class="tw-flex tw-justify-between tw-text-xs tw-mb-1">
                                    <span class="tw-text-gray-400">Grooming</span>
                                    <span class="tw-font-medium tw-text-white">{{ $stats['grooming_percent'] ?? 45 }}%</span>
                                </div>
                                <div class="tw-w-full tw-bg-gray-700 tw-rounded-full tw-h-1">
                                    <div class="tw-bg-[#24CFF4] tw-h-1 tw-rounded-full" style="width: {{ $stats['grooming_percent'] ?? 45 }}%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="tw-flex tw-justify-between tw-text-xs tw-mb-1">
                                    <span class="tw-text-gray-400">Boarding</span>
                                    <span class="tw-font-medium tw-text-white">{{ $stats['boarding_percent'] ?? 30 }}%</span>
                                </div>
                                <div class="tw-w-full tw-bg-gray-700 tw-rounded-full tw-h-1">
                                    <div class="tw-bg-[#FF9666] tw-h-1 tw-rounded-full" style="width: {{ $stats['boarding_percent'] ?? 30 }}%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="tw-flex tw-justify-between tw-text-xs tw-mb-1">
                                    <span class="tw-text-gray-400">Vet Services</span>
                                    <span class="tw-font-medium tw-text-white">{{ $stats['vet_appointments_count'] ?? 25 }}%</span>
                                </div>
                                <div class="tw-w-full tw-bg-gray-700 tw-rounded-full tw-h-1">
                                    <div class="tw-bg-[#66FF8F] tw-h-1 tw-rounded-full" style="width: {{ $stats['vet_appointments_count'] ?? 25 }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Recent Activity -->
            <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-6 tw-mt-6 tw-transition-all tw-duration-300 hover:tw-shadow-md">
                <h2 class="tw-text-lg tw-font-bold tw-text-white tw-mb-4">Recent Activity</h2>
                
                <div class="tw-space-y-4">
                    @forelse($stats['recent_activities'] as $index => $activity)
                        <div class="tw-flex tw-gap-4">
                            <div class="{{ $index < count($stats['recent_activities']) - 1 ? 'tw-relative' : '' }}">
                                <div class="tw-h-10 tw-w-10 tw-rounded-full tw-bg-gray-700 tw-flex tw-items-center tw-justify-center">
                                    <i class="fas fa-{{ $activity['icon'] }}" style="color: {{ $activity['color'] }}"></i>
                                </div>
                                @if($index < count($stats['recent_activities']) - 1)
                                    <div class="tw-absolute tw-top-10 tw-bottom-0 tw-left-1/2 tw-w-px tw-bg-gray-600"></div>
                                @endif
                            </div>
                            <div>
                                <p class="tw-text-sm tw-font-medium tw-text-white">{{ $activity['title'] }}</p>
                                <p class="tw-text-xs tw-text-gray-400">{{ $activity['description'] }}</p>
                                <p class="tw-text-xs tw-text-gray-500 tw-mt-1">{{ $activity['time_formatted'] }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="tw-text-center tw-py-4">
                            <i class="fas fa-history tw-text-gray-600 tw-text-3xl tw-mb-2"></i>
                            <p class="tw-text-gray-400">No recent activity</p>
                        </div>
                    @endforelse
                </div>
                
                <a href="{{ route('admin.reports') }}" class="tw-block tw-text-center tw-text-[#24CFF4] tw-text-sm tw-font-medium tw-mt-4 hover:tw-underline">View All Activity</a>
            </div>

            <!-- Total Revenue Card -->
            <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-6 tw-mt-6 tw-transition-all tw-duration-300 hover:tw-shadow-md">
                <h2 class="tw-text-lg tw-font-bold tw-text-white tw-mb-4">Total Revenue</h2>
                
                <div class="tw-flex tw-flex-col tw-items-center tw-text-center">
                    <div class="tw-h-16 tw-w-16 tw-bg-gray-700/50 tw-rounded-full tw-flex tw-items-center tw-justify-center tw-mb-3">
                        <i class="fas fa-coins tw-text-purple-500 tw-text-2xl"></i>
                    </div>
                    <h3 class="tw-text-3xl tw-font-bold tw-text-white">₱ {{ number_format($stats['total_revenue'] ?? 0) }}</h3>
                    
                    @if(isset($stats['revenue_growth']))
                        @php $growthClass = $stats['revenue_growth'] >= 0 ? 'tw-text-green-400' : 'tw-text-red-400'; @endphp
                        <p class="tw-text-sm {{ $growthClass }} tw-mt-1">
                            <i class="fas fa-{{ $stats['revenue_growth'] >= 0 ? 'arrow-up' : 'arrow-down' }}"></i> 
                            {{ abs($stats['revenue_growth']) }}% this month
                        </p>
                    @else
                        <p class="tw-text-sm tw-text-green-400 tw-mt-1"><i class="fas fa-arrow-up"></i> +15% this month</p>
                    @endif
                    
                    <div class="tw-w-full tw-h-px tw-bg-gray-700 tw-my-4"></div>
                    
                    <div class="tw-grid tw-grid-cols-2 tw-gap-4 tw-w-full">
                        <div class="tw-bg-gray-700/50 tw-rounded-lg tw-p-3 tw-text-center">
                            <p class="tw-text-xs tw-text-gray-400">Last Month</p>
                            <p class="tw-text-sm tw-font-medium tw-text-white">₱ {{ number_format($stats['last_month_revenue'] ?? 0) }}</p>
                        </div>
                        <div class="tw-bg-gray-700/50 tw-rounded-lg tw-p-3 tw-text-center">
                            <p class="tw-text-xs tw-text-gray-400">Projected</p>
                            <p class="tw-text-sm tw-font-medium tw-text-white">₱ {{ number_format($stats['projected_revenue'] ?? 0) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.loadChartJsIfNeeded = function(callback) {
        // Check if Chart.js is already loaded
        if (window.Chart) {
            console.log('Chart.js already loaded');
            if (callback) callback();
            return;
        }
        
        console.log('Loading Chart.js dynamically...');
        const script = document.createElement('script');
        script.src = 'https://cdn.jsdelivr.net/npm/chart.js';
        script.async = true;
        script.onload = function() {
            console.log('Chart.js loaded successfully');
            if (callback) callback();
        };
        script.onerror = function() {
            console.error('Failed to load Chart.js');
        };
        document.head.appendChild(script);
    };

    // Global Chart Namespace
    window.DashboardCharts = {
        servicesChart: null,
        chartData: null,
        toggleHandlersAttached: false, // Track if handlers are attached
        
        // Initialize the services popularity chart
        initializeServicesChart: function(data) {
            // Ensure Chart.js is loaded before proceeding
            if (!window.Chart) {
                console.log('Chart.js not loaded yet, loading it first...');
                window.loadChartJsIfNeeded(() => this.initializeServicesChart(data));
                return;
            }

            console.log('Initializing services chart...');
            
            // Store data for later use
            this.chartData = data || @json($stats['chart_data'] ?? []);
            
            // Check if canvas exists
            const chartCanvas = document.getElementById('servicesChart');
            if (!chartCanvas) {
                console.error('Services chart canvas not found!');
                return;
            }
            
            const ctx = chartCanvas.getContext('2d');
            
            // Ensure old chart is completely destroyed
            this.cleanup();
            
            // Create new chart
            this.servicesChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: this.chartData.weeks || this.chartData.months || ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Grooming',
                        data: this.chartData.grooming || [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        backgroundColor: 'rgba(36, 207, 244, 0.1)',
                        borderColor: '#24CFF4',
                        borderWidth: 2,
                        tension: 0.4,
                        pointBackgroundColor: '#24CFF4',
                        pointRadius: 4,
                        pointHoverRadius: 6,
                    }, {
                        label: 'Boarding',
                        data: this.chartData.boarding || [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        backgroundColor: 'rgba(255, 150, 102, 0.1)',
                        borderColor: '#FF9666',
                        borderWidth: 2,
                        tension: 0.4,
                        pointBackgroundColor: '#FF9666',
                        pointRadius: 4,
                        pointHoverRadius: 6,
                    }, {
                        label: 'Vet Services',
                        data: this.chartData.vet_services || [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        backgroundColor: 'rgba(102, 255, 143, 0.1)',
                        borderColor: '#66FF8F',
                        borderWidth: 2,
                        tension: 0.4,
                        pointBackgroundColor: '#66FF8F',
                        pointRadius: 4,
                        pointHoverRadius: 6,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 12,
                                font: {
                                    size: 11
                                },
                                color: '#e5e7eb' // Light text for dark theme
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.7)',
                            padding: 10,
                            titleFont: {
                                size: 13
                            },
                            bodyFont: {
                                size: 12
                            },
                            displayColors: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(255, 255, 255, 0.1)' // Lighter grid lines
                            },
                            ticks: {
                                color: '#9ca3af' // Gray text for ticks
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#9ca3af' // Gray text for ticks
                            }
                        }
                    }
                }
            });
            
            // Only set up toggle buttons once
            if (!this.toggleHandlersAttached) {
                this.setupChartToggles();
            }
        },
        
        // Set up the weekly/monthly toggle buttons
        setupChartToggles: function() {
            // First remove all existing event listeners
            const toggleButtons = document.querySelectorAll('#chart-period-toggle button');
            toggleButtons.forEach(button => {
                // Clone and replace to remove all event listeners
                const newButton = button.cloneNode(true);
                button.parentNode.replaceChild(newButton, button);
            });
            
            // Now attach our handlers to the fresh buttons
            document.querySelectorAll('#chart-period-toggle button').forEach(button => {
                button.addEventListener('click', this.handleToggleClick.bind(this));
            });
            
            // Mark handlers as attached
            this.toggleHandlersAttached = true;
        },
        
        // Handle toggle button clicks
        handleToggleClick: function(event) {
            const period = event.currentTarget.getAttribute('data-period');
            
            // Update toggle button UI
            document.querySelectorAll('#chart-period-toggle button').forEach(btn => {
                btn.classList.remove('tw-bg-[#0f7e97]', 'tw-text-white');
                btn.classList.add('tw-bg-gray-700', 'tw-text-gray-300');
            });
            
            event.currentTarget.classList.remove('tw-bg-gray-700', 'tw-text-gray-300');
            event.currentTarget.classList.add('tw-bg-[#0f7e97]', 'tw-text-white');
            
            // Get appropriate data
            if (period === 'weekly') {
                this.fetchWeeklyData();
            } else {
                // Use monthly data - no need to destroy and recreate if we can update
                this.updateChartWithMonthlyData();
            }
        },
        
        // Update chart with monthly data without recreating
        updateChartWithMonthlyData: function() {
            if (!this.servicesChart) {
                this.initializeServicesChart(this.chartData);
                return;
            }
            
            // Update existing chart with monthly data
            this.servicesChart.data.labels = this.chartData.months || ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            this.servicesChart.data.datasets[0].data = this.chartData.grooming || [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            this.servicesChart.data.datasets[1].data = this.chartData.boarding || [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            this.servicesChart.data.datasets[2].data = this.chartData.vet_services || [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            this.servicesChart.update();
        },
        
        // Fetch weekly chart data
        fetchWeeklyData: function() {
            // Ensure Chart.js is loaded
            if (!window.Chart) {
                console.log('Chart.js not loaded yet, loading it first...');
                window.loadChartJsIfNeeded(() => this.fetchWeeklyData());
                return;
            }

            const chartCanvas = document.getElementById('servicesChart');
            if (!chartCanvas) {
                console.error('Services chart canvas not found!');
                return;
            }
            
            // Create loading indicator
            const loadingId = 'chart-loading-indicator';
            let loadingText = document.getElementById(loadingId);
            
            if (!loadingText) {
                loadingText = document.createElement('div');
                loadingText.id = loadingId;
                loadingText.textContent = 'Loading data...';
                loadingText.className = 'tw-text-center tw-text-gray-400 tw-py-10 tw-absolute tw-inset-0 tw-flex tw-items-center tw-justify-center';
                const chartContainer = chartCanvas.parentNode;
                chartContainer.style.position = 'relative';
                chartContainer.appendChild(loadingText);
            }
            
            // Hide chart while loading
            chartCanvas.style.opacity = '0.3';
            
            // Fetch weekly data
            fetch('{{ route("admin.dashboard.weekly-data") }}')
                .then(response => response.json())
                .then(data => {
                    // Remove loading indicator
                    const loadingElement = document.getElementById(loadingId);
                    if (loadingElement) {
                        loadingElement.remove();
                    }
                    
                    // Show chart again
                    chartCanvas.style.opacity = '1';
                    
                    // Update chart with new data
                    if (this.servicesChart) {
                        this.servicesChart.data.labels = data.weeks || ['Week 1', 'Week 2', 'Week 3', 'Week 4'];
                        this.servicesChart.data.datasets[0].data = data.grooming || [0, 0, 0, 0];
                        this.servicesChart.data.datasets[1].data = data.boarding || [0, 0, 0, 0];
                        this.servicesChart.data.datasets[2].data = data.vet_services || [0, 0, 0, 0];
                        this.servicesChart.update();
                    } else {
                        this.initializeServicesChart(data);
                    }
                })
                .catch(error => {
                    console.error('Error fetching weekly data:', error);
                    const loadingElement = document.getElementById(loadingId);
                    if (loadingElement) {
                        loadingElement.textContent = 'Failed to load data';
                        loadingElement.className = 'tw-text-center tw-text-red-400 tw-py-10 tw-absolute tw-inset-0 tw-flex tw-items-center tw-justify-center';
                        
                        // Auto-remove after 3 seconds
                        setTimeout(() => {
                            if (document.getElementById(loadingId)) {
                                document.getElementById(loadingId).remove();
                                chartCanvas.style.opacity = '1';
                                this.updateChartWithMonthlyData(); // Fall back to monthly data
                            }
                        }, 3000);
                    }
                });
        },
        
        // Clean up chart instances
        cleanup: function() {
            if (this.servicesChart) {
                this.servicesChart.destroy();
                this.servicesChart = null;
            }
            
            // Remove any loading indicators
            const loadingElement = document.getElementById('chart-loading-indicator');
            if (loadingElement) {
                loadingElement.remove();
            }
        }
    };

    // Initialize on first page load
    document.addEventListener('DOMContentLoaded', function() {
        window.DashboardCharts.initializeServicesChart();
    });

    // Clean up before content changes
    document.addEventListener('contentWillChange', function() {
        window.DashboardCharts.cleanup();
    });

    // Clean up and reinitialize when content changes
    document.addEventListener('contentChanged', function() {
        // Reset toggle handler state so we reattach on new content
        window.DashboardCharts.toggleHandlersAttached = false;
        
        // Small delay to ensure DOM is updated
        setTimeout(function() {
            window.DashboardCharts.initializeServicesChart();
        }, 100);
    });
</script>

<script>
// Dashboard functionality namespace
window.DashboardPage = window.DashboardPage || {
    upcomingAppointmentsTable: null,
    
    // Initialize tables
    initializeTables: function() {
        console.log('Initializing dashboard tables...');
        
        // Destroy existing tables first
        this.destroyTables();
        
        // Initialize upcoming appointments table
        this.upcomingAppointmentsTable = $('#upcomingAppointmentsTable').DataTable({
            serverSide: false,
            ajax: {
                url: '{{ route("admin.upcoming-appointments.data") }}',
                type: 'GET',
                dataSrc: 'data',
                error: function(xhr, error, thrown) {
                    console.error('Appointments Ajax error:', xhr, error, thrown);
                }
            },
            columns: [
                { data: 'appointmentID', width: '5%' },
                { 
                    data: null,
                    width: '20%',
                    render: function(data) {
                        try {
                    // Check if we can access the user data safely
                    const firstName = data.pet?.user?.firstName || 'Unknown';
                    const lastName = data.pet?.user?.lastName || 'User';
                    
                    return `
                        <div class="tw-flex tw-items-center">
                            <div class="tw-h-8 tw-w-8 tw-rounded-full tw-bg-gray-700 tw-flex tw-justify-center tw-items-center">
                                <i class="fas fa-user tw-text-gray-400"></i>
                            </div>
                            <div class="tw-ml-3">
                                <div class="tw-text-sm tw-font-medium tw-text-gray-200">${firstName} ${lastName}</div>
                            </div>
                        </div>
                    `;
                } catch(e) {
                    console.error('Error rendering user data:', e);
                    return '<div class="tw-text-red-400">Error</div>';
                }
            }
                },
                { 
                    data: 'pet.name',
                    render: function(data, type, row) {
                        return data || 'N/A';
                    }
                },
                { 
                    data: 'service.name',
                    render: function(data, type, row) {
                        return data || 'N/A';
                    }
                },
                { 
                    data: 'date',
                    render: function(data) {
                        return moment(data).format('MMM DD, YYYY');
                    }
                },
                { 
                    data: 'time',
                    render: function(data) {
                        return moment(data, 'HH:mm:ss').format('h:mm A');
                    }
                },
                {
                    data: null,
                    width: '10%',
                    render: function(data) {
                        return `
                            <a href="/admin/appointments/${data.appointmentID}" class="tw-text-[#24CFF4] hover:tw-text-blue-300">View</a>
                        `;
                    },
                    orderable: false
                }
            ],
            autoWidth: false,
            scrollX: false,
            searching: false,
            paging: true,
            info: false,
            lengthChange: false,
            pageLength: 5,
            order: [[4, 'asc'], [5, 'asc']],
            language: {
                emptyTable: '<div class="tw-flex tw-flex-col tw-items-center tw-gap-2 tw-py-4"><i class="fas fa-calendar-times tw-text-4xl tw-text-gray-600"></i><p>No upcoming appointments</p></div>'
            },
            drawCallback: function() {
                DashboardPage.applyTableStyling();
            }
        });
        
        // Load ongoing boarding data
        this.loadOngoingBoardings();
    },
    
    destroyTables: function() {
        if ($.fn.DataTable.isDataTable('#upcomingAppointmentsTable')) {
            $('#upcomingAppointmentsTable').DataTable().clear().destroy();
        }
    },
    
    applyTableStyling: function() {
        // Style DataTable elements to match dark theme
        $('.dataTables_wrapper .dataTables_paginate').addClass('tw-text-gray-400 tw-mt-3');
        $('.dataTables_wrapper .paginate_button').addClass('tw-text-gray-400 hover:tw-text-white');
        $('.dataTables_wrapper .paginate_button.current').addClass('tw-bg-gray-700 !tw-text-white !tw-border-gray-600 hover:!tw-bg-gray-600');
        $('.dataTables_wrapper .paginate_button:not(.current)').addClass('tw-bg-transparent !tw-border-gray-700');
    },
    
    loadOngoingBoardings: function() {
    fetch('{{ route("admin.ongoing-boardings.data") }}')
        .then(response => response.json())
        .then(data => {
            // Update capacity indicator
            const activeCount = data.active_count || 0;
            $('#active-boardings').text(activeCount);
            $('#boarding-capacity-bar').css('width', `${(activeCount / 10) * 100}%`);
            
            // Render pet cards
            const container = $('#boarding-pets-container');
            container.empty();
            
            if (data.boardings && data.boardings.length > 0) {
                data.boardings.forEach(boarding => {
                    // Use species instead of type for dog/cat icons
                    const petIcon = boarding.pet.type.toLowerCase() === 'dog' ? 
                        '<i class="fas fa-dog tw-text-[#66FF8F]"></i>' : 
                        '<i class="fas fa-cat tw-text-[#FF9666]"></i>';
                        
                    const endDate = moment(boarding.end_date).format('MMM DD');
                    
                    const card = `
                        <div class="tw-bg-gray-700 tw-rounded-lg tw-p-3 tw-flex tw-items-center tw-gap-3">
                            <div class="tw-h-10 tw-w-10 tw-bg-gray-600 tw-rounded-full tw-flex tw-items-center tw-justify-center">
                                ${petIcon}
                            </div>
                            <div>
                                <div class="tw-text-sm tw-font-medium tw-text-white">${boarding.pet.name}</div>
                                <div class="tw-flex tw-items-center tw-gap-2 tw-text-xs tw-text-gray-400">
                                    <span>${boarding.user.lastName}</span>
                                    <span>•</span>
                                    <span>Until ${endDate}</span>
                                </div>
                            </div>
                        </div>
                    `;
                    
                    container.append(card);
                });
            } else {
                container.html(`
                    <div class="tw-col-span-full tw-p-4 tw-text-center">
                        <i class="fas fa-home tw-text-gray-600 tw-text-3xl tw-mb-2"></i>
                        <p class="tw-text-gray-400">No pets currently boarding</p>
                    </div>
                `);
            }
        })
        .catch(error => {
            console.error('Error loading boarding data:', error);
            $('#boarding-pets-container').html(`
                <div class="tw-col-span-full tw-p-4 tw-text-center">
                    <i class="fas fa-exclamation-triangle tw-text-red-500 tw-text-3xl tw-mb-2"></i>
                    <p class="tw-text-gray-400">Error loading boarding data</p>
                </div>
            `);
        });
    }
};

// Initialize when page loads
$(document).ready(function() {
    if ($.fn.DataTable) {
        DashboardPage.initializeTables();
    } else {
        console.error('DataTables is not loaded!');
    }
});

// Handle dynamic content changes
document.addEventListener('contentChanged', function() {
    if (window.jQuery && $.fn.DataTable) {
        DashboardPage.initializeTables();
    }
});

document.addEventListener('contentWillChange', function() {
    if (window.jQuery && $.fn.DataTable) {
        DashboardPage.destroyTables();
    }
});
</script>

<script>
    // Make sure this runs after all DOM content is loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize all modals
        const modalButtons = document.querySelectorAll('[data-modal-toggle]');
        
        modalButtons.forEach(button => {
            button.addEventListener('click', function() {
                const modalId = this.getAttribute('data-modal-target');
                const modalElement = document.getElementById(modalId);
                
                if (modalElement) {
                    modalElement.classList.toggle('tw-hidden');
                } else {
                    console.error(`Modal with ID ${modalId} not found`);
                }
            });
        });

        // Close modal when clicking on the close button
        const closeButtons = document.querySelectorAll('[data-modal-toggle]');
        closeButtons.forEach(button => {
            button.addEventListener('click', function() {
                const modalId = this.getAttribute('data-modal-toggle');
                const modal = document.getElementById(modalId);
                if (modal) {
                    if (!this.closest(`#${modalId}`)) return;
                    modal.classList.add('tw-hidden');
                }
            });
        });

        // Close modal when clicking outside
        document.addEventListener('click', function(event) {
            const modals = document.querySelectorAll('[id$="-modal"]');
            modals.forEach(modal => {
                if (event.target === modal) {
                    modal.classList.add('tw-hidden');
                }
            });
        });
    });
</script>

<script>
    function initializeModals() {
        // First, remove any existing event listeners to prevent duplicates
        document.querySelectorAll('[data-modal-target]').forEach(button => {
            button.removeEventListener('click', handleModalOpen);
            button.addEventListener('click', handleModalOpen);
        });
        
        document.querySelectorAll('[data-modal-toggle]').forEach(button => {
            button.removeEventListener('click', handleModalToggle);
            button.addEventListener('click', handleModalToggle);
        });
        
        // Handle clicks outside modals
        document.removeEventListener('click', handleOutsideClick);
        document.addEventListener('click', handleOutsideClick);
    }

    // Separate functions for event handlers
    function handleModalOpen(e) {
        const modalId = this.getAttribute('data-modal-target');
        const modalElement = document.getElementById(modalId);
        if (modalElement) {
            modalElement.classList.remove('tw-hidden');
            console.log(`Opening modal: ${modalId}`);
        } else {
            console.error(`Modal with ID ${modalId} not found`);
        }
    }

    function handleModalToggle(e) {
        const modalId = this.getAttribute('data-modal-toggle');
        const modal = document.getElementById(modalId);
        if (modal) {
            // Only close the modal if the button is inside the modal
            // This prevents the toggle button from both opening AND closing the modal
            if (this.closest(`#${modalId}`)) {
                modal.classList.add('tw-hidden');
                console.log(`Closing modal: ${modalId}`);
            }
        }
    }

    function handleOutsideClick(e) {
        document.querySelectorAll('[id$="-modal"]').forEach(modal => {
            if (e.target === modal) {
                modal.classList.add('tw-hidden');
                console.log('Closing modal by outside click');
            }
        });
    }

    // Initialize modals on page load
    document.addEventListener('DOMContentLoaded', initializeModals);

    // Re-initialize when content changes
    document.addEventListener('contentChanged', initializeModals);
</script>

<!-- modals -->
@include('modals.admin.admin-add-boarding')
@include('modals.admin.admin-add-user')
@include('modals.admin.admin-add-appointment')
@include('modals.admin.admin-add-pet')
@endsection
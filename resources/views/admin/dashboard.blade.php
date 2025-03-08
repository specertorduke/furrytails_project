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
        
        <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-6 tw-border-l-4 tw-border-purple-500 tw-transition-all tw-duration-300 hover:tw-shadow-md">
            <div class="tw-flex tw-justify-between tw-items-center">
                <div>
                    <p class="tw-text-gray-400 tw-text-sm">Total Revenue</p>
                    <h3 class="tw-text-2xl tw-font-bold tw-text-white">₱ {{ number_format($stats['total_revenue'] ?? 25000) }}</h3>
                    <p class="tw-text-xs tw-text-green-400 tw-mt-1"><i class="fas fa-arrow-up"></i> +15% this month</p>
                </div>
                <div class="tw-bg-gray-700 tw-p-3 tw-rounded-full">
                    <i class="fas fa-coins tw-text-purple-500 tw-text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Row -->
    <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-4 tw-gap-6 tw-mb-6">
        <a type="button" data-modal-target="addUser-modal" data-modal-toggle="addUser-modal" class="tw-bg-gray-800 tw-no-underline tw-rounded-xl tw-p-4 tw-flex tw-items-center tw-gap-3 tw-transition-all hover:tw-shadow-md hover:tw-bg-gray-700">
            <div class="tw-h-10 tw-w-10 tw-rounded-full tw-bg-[#24CFF4]/20 tw-flex tw-items-center tw-justify-center tw-flex-shrink-0">
                <i class="fas fa-user-plus tw-text-[#24CFF4]"></i>
            </div>
            <span class="tw-text-sm tw-font-medium tw-text-white">Add User</span>
        </a>
        <a type="button" data-modal-target="adminAddAppointment-modal" data-modal-toggle="adminAddAppointment-modal" class="tw-bg-gray-800 tw-no-underline tw-rounded-xl tw-p-4 tw-flex tw-items-center tw-gap-3 tw-transition-all hover:tw-shadow-md hover:tw-bg-gray-700">
            <div class="tw-h-10 tw-w-10 tw-rounded-full tw-bg-[#FF9666]/20 tw-flex tw-items-center tw-justify-center tw-flex-shrink-0">
                <i class="fas fa-calendar-plus tw-text-[#FF9666]"></i>
            </div>
            <span class="tw-text-sm tw-font-medium tw-text-white">Add Appointment</span>
        </a>
        <a href="#" class="tw-bg-gray-800 tw-no-underline tw-rounded-xl tw-p-4 tw-flex tw-items-center tw-gap-3 tw-transition-all hover:tw-shadow-md hover:tw-bg-gray-700">
            <div class="tw-h-10 tw-w-10 tw-rounded-full tw-bg-[#66FF8F]/20 tw-flex tw-items-center tw-justify-center tw-flex-shrink-0">
                <i class="fas fa-home tw-text-[#66FF8F]"></i>
            </div>
            <span class="tw-text-sm tw-font-medium tw-text-white">Add Boarding</span>
        </a>
        <a href="{{ route('admin.reports') }}" class="tw-bg-gray-800 tw-no-underline tw-rounded-xl tw-p-4 tw-flex tw-items-center tw-gap-3 tw-transition-all hover:tw-shadow-md hover:tw-bg-gray-700" onclick="loadContent(event, '{{ route('admin.reports') }}')">
            <div class="tw-h-10 tw-w-10 tw-rounded-full tw-bg-purple-500/20 tw-flex tw-items-center tw-justify-center tw-flex-shrink-0">
                <i class="fas fa-history tw-text-purple-500"></i>
            </div>
            <span class="tw-text-sm tw-font-medium tw-text-white">Logs</span>
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
                <div class="tw-flex tw-justify-between tw-items-center tw-mb-6">
                    <h2 class="tw-text-lg tw-font-bold tw-text-white">Service Popularity</h2>
                    <div class="tw-flex tw-gap-2">
                        <button class="tw-px-3 tw-py-1 tw-bg-gray-700 tw-rounded-lg tw-text-sm tw-font-medium tw-text-gray-300 hover:tw-bg-gray-600">Weekly</button>
                        <button class="tw-px-3 tw-py-1 tw-bg-[#24CFF4] tw-rounded-lg tw-text-sm tw-font-medium tw-text-white">Monthly</button>
                    </div>
                </div>
                
                <!-- Chart Canvas -->
                <div class="tw-relative tw-h-[300px]">
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
                                    <span class="tw-font-medium tw-text-white">{{ $stats['vet_percent'] ?? 25 }}%</span>
                                </div>
                                <div class="tw-w-full tw-bg-gray-700 tw-rounded-full tw-h-1">
                                    <div class="tw-bg-[#66FF8F] tw-h-1 tw-rounded-full" style="width: {{ $stats['vet_percent'] ?? 25 }}%"></div>
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
                    <div class="tw-flex tw-gap-4">
                        <div class="tw-relative">
                            <div class="tw-h-10 tw-w-10 tw-rounded-full tw-bg-gray-700 tw-flex tw-items-center tw-justify-center">
                                <i class="fas fa-user-plus tw-text-[#24CFF4]"></i>
                            </div>
                            <div class="tw-absolute tw-top-10 tw-bottom-0 tw-left-1/2 tw-w-px tw-bg-gray-600"></div>
                        </div>
                        <div>
                            <p class="tw-text-sm tw-font-medium tw-text-white">New user registered</p>
                            <p class="tw-text-xs tw-text-gray-400">John Doe created an account</p>
                            <p class="tw-text-xs tw-text-gray-500 tw-mt-1">10 minutes ago</p>
                        </div>
                    </div>
                    
                    <div class="tw-flex tw-gap-4">
                        <div class="tw-relative">
                            <div class="tw-h-10 tw-w-10 tw-rounded-full tw-bg-gray-700 tw-flex tw-items-center tw-justify-center">
                                <i class="fas fa-calendar-check tw-text-[#FF9666]"></i>
                            </div>
                            <div class="tw-absolute tw-top-10 tw-bottom-0 tw-left-1/2 tw-w-px tw-bg-gray-600"></div>
                        </div>
                        <div>
                            <p class="tw-text-sm tw-font-medium tw-text-white">New appointment booked</p>
                            <p class="tw-text-xs tw-text-gray-400">Grooming service for Max</p>
                            <p class="tw-text-xs tw-text-gray-500 tw-mt-1">1 hour ago</p>
                        </div>
                    </div>
                    
                    <div class="tw-flex tw-gap-4">
                        <div class="tw-relative">
                            <div class="tw-h-10 tw-w-10 tw-rounded-full tw-bg-gray-700 tw-flex tw-items-center tw-justify-center">
                                <i class="fas fa-paw tw-text-[#66FF8F]"></i>
                            </div>
                            <div class="tw-absolute tw-top-10 tw-bottom-0 tw-left-1/2 tw-w-px tw-bg-gray-600"></div>
                        </div>
                        <div>
                            <p class="tw-text-sm tw-font-medium tw-text-white">New pet registered</p>
                            <p class="tw-text-xs tw-text-gray-400">Luna (Cat) added by Sarah Williams</p>
                            <p class="tw-text-xs tw-text-gray-500 tw-mt-1">3 hours ago</p>
                        </div>
                    </div>
                    
                    <div class="tw-flex tw-gap-4">
                        <div>
                            <div class="tw-h-10 tw-w-10 tw-rounded-full tw-bg-gray-700 tw-flex tw-items-center tw-justify-center">
                                <i class="fas fa-dollar-sign tw-text-purple-500"></i>
                            </div>
                        </div>
                        <div>
                            <p class="tw-text-sm tw-font-medium tw-text-white">Payment received</p>
                            <p class="tw-text-xs tw-text-gray-400">₱2,500 for boarding services</p>
                            <p class="tw-text-xs tw-text-gray-500 tw-mt-1">5 hours ago</p>
                        </div>
                    </div>
                </div>
                
                <a href="#" class="tw-block tw-text-center tw-text-[#24CFF4] tw-text-sm tw-font-medium tw-mt-4 hover:tw-underline">View All Activity</a>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Chart for Services - Dark Theme
    const ctx = document.getElementById('servicesChart').getContext('2d');
    const servicesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Grooming',
                data: [65, 59, 80, 81, 56, 55, 40, 45, 60, 70, 75, 90],
                backgroundColor: 'rgba(36, 207, 244, 0.1)',
                borderColor: '#24CFF4',
                borderWidth: 2,
                tension: 0.4,
                pointBackgroundColor: '#24CFF4',
                pointRadius: 4,
                pointHoverRadius: 6,
            }, {
                label: 'Boarding',
                data: [28, 48, 40, 19, 86, 27, 90, 60, 30, 40, 50, 70],
                backgroundColor: 'rgba(255, 150, 102, 0.1)',
                borderColor: '#FF9666',
                borderWidth: 2,
                tension: 0.4,
                pointBackgroundColor: '#FF9666',
                pointRadius: 4,
                pointHoverRadius: 6,
            }, {
                label: 'Vet Services',
                data: [45, 25, 30, 50, 30, 40, 35, 20, 45, 35, 55, 40],
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
    // Create a function to initialize all modals
    function initializeModals() {
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
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', initializeModals);
    
    // Re-initialize when content changes
    document.addEventListener('contentChanged', initializeModals);
</script>
@endsection
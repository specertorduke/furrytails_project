@extends('admin.adminLayout')

@section('title', 'Appointments Management')

@section('content')
<div class="tw-p-6 tw-min-h-screen tw-bg-gray-900">
    <!-- Header Section -->
    <div class="tw-flex tw-flex-col md:tw-flex-row tw-justify-between tw-items-start md:tw-items-center tw-mb-6">
        <div>
            <p class="tw-text-sm tw-text-gray-400">Administration / Appointments</p>
            <h1 class="tw-text-2xl tw-font-bold tw-text-white">Appointments Management</h1>
        </div>
        <div class="tw-mt-4 md:tw-mt-0">
            <button type="button" id="addAppointmentBtn" class="tw-bg-[#FF9666] tw-text-white tw-px-4 tw-py-2 tw-rounded-xl tw-transition-all tw-duration-300 hover:tw-shadow-lg hover:tw-opacity-90 tw-font-semibold active:tw-bg-orange-400">
                <i class="fas fa-calendar-plus tw-mr-2"></i> Add Appointment
            </button>
        </div>
    </div>

    <!-- Appointment Stats Cards -->
    <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-4 tw-gap-6 tw-mb-6">
        <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-6 tw-border-l-4 tw-border-[#FF9666] tw-transition-all tw-duration-300 hover:tw-shadow-md">
            <div class="tw-flex tw-justify-between tw-items-center">
                <div>
                    <p class="tw-text-gray-400 tw-text-sm">Total Appointments</p>
                    <h3 class="tw-text-2xl tw-font-bold tw-text-white">{{ $totalAppointments ?? 0 }}</h3>
                </div>
                <div class="tw-bg-gray-700 tw-p-3 tw-rounded-full">
                    <i class="fas fa-calendar-check tw-text-[#FF9666] tw-text-xl"></i>
                </div>
            </div>
        </div>
        <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-6 tw-border-l-4 tw-border-blue-500 tw-transition-all tw-duration-300 hover:tw-shadow-md">
            <div class="tw-flex tw-justify-between tw-items-center">
                <div>
                    <p class="tw-text-gray-400 tw-text-sm">Upcoming</p>
                    <h3 class="tw-text-2xl tw-font-bold tw-text-white">{{ $upcomingAppointments ?? 0 }}</h3>
                </div>
                <div class="tw-bg-gray-700 tw-p-3 tw-rounded-full">
                    <i class="fas fa-clock tw-text-blue-500 tw-text-xl"></i>
                </div>
            </div>
        </div>
        <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-6 tw-border-l-4 tw-border-green-500 tw-transition-all tw-duration-300 hover:tw-shadow-md">
            <div class="tw-flex tw-justify-between tw-items-center">
                <div>
                    <p class="tw-text-gray-400 tw-text-sm">Completed</p>
                    <h3 class="tw-text-2xl tw-font-bold tw-text-white">{{ $completedAppointments ?? 0 }}</h3>
                </div>
                <div class="tw-bg-gray-700 tw-p-3 tw-rounded-full">
                    <i class="fas fa-check-circle tw-text-green-500 tw-text-xl"></i>
                </div>
            </div>
        </div>
        <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-6 tw-border-l-4 tw-border-red-500 tw-transition-all tw-duration-300 hover:tw-shadow-md">
            <div class="tw-flex tw-justify-between tw-items-center">
                <div>
                    <p class="tw-text-gray-400 tw-text-sm">Cancelled</p>
                    <h3 class="tw-text-2xl tw-font-bold tw-text-white">{{ $cancelledAppointments ?? 0 }}</h3>
                </div>
                <div class="tw-bg-gray-700 tw-p-3 tw-rounded-full">
                    <i class="fas fa-times-circle tw-text-red-500 tw-text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Controls -->
    <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-4 tw-mb-6">
        <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-3 tw-gap-4">
            <div>
                <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-300 tw-mb-1">Status</label>
                <select id="status-filter" class="tw-w-full tw-bg-gray-700 tw-text-white tw-border-gray-600 tw-rounded-lg tw-px-3 tw-py-2">
                    <option value="">All Statuses</option>
                    <option value="Pending">Pending</option>
                    <option value="Confirmed">Confirmed</option>
                    <option value="Completed">Completed</option>
                    <option value="Cancelled">Cancelled</option>
                </select>
            </div>
            <div>
                <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-300 tw-mb-1">Service Type</label>
                <select id="service-filter" class="tw-w-full tw-bg-gray-700 tw-text-white tw-border-gray-600 tw-rounded-lg tw-px-3 tw-py-2">
                    <option value="">All Services</option>
                    <!-- Will be populated dynamically -->
                </select>
            </div>
            <div>
                <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-300 tw-mb-1">Date Range</label>
                <div class="tw-flex tw-gap-2">
                    <input type="date" id="date-from" class="tw-w-full tw-bg-gray-700 tw-text-white tw-border-gray-600 tw-rounded-lg tw-px-3 tw-py-2">
                    <input type="date" id="date-to" class="tw-w-full tw-bg-gray-700 tw-text-white tw-border-gray-600 tw-rounded-lg tw-px-3 tw-py-2">
                </div>
            </div>
        </div>
    </div>

    <!-- Appointments Table -->
    <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-6 tw-overflow-x-auto">
        <div>
            <table id="appointmentsTable" class="tw-min-w-full tw-divide-y tw-divide-gray-700">
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Create a namespace for our appointments page functionality
    window.AppointmentsPage = window.AppointmentsPage || {
        appointmentsTable: null,

        // CRUD Functions
        viewAppointment: function(id) {
            console.log('View appointment', id);
            // Implement view functionality
        },

        editAppointment: function(id) {
            console.log('Edit appointment', id);
            // Implement edit functionality
        },

        cancelAppointment: function(id) {
            Swal.fire({
                title: 'Cancel this appointment?',
                text: "You can't undo this action!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#FF9666',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, cancel it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Make AJAX call to cancel
                    fetch(`/admin/appointments/${id}/cancel`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if(data.success) {
                            this.appointmentsTable.ajax.reload();
                            Swal.fire('Cancelled!', 'Appointment has been cancelled.', 'success');
                        } else {
                            Swal.fire('Error!', data.message || 'Failed to cancel appointment.', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Error!', 'An error occurred while cancelling the appointment.', 'error');
                    });
                }
            });
        },

        initializeTables: function() {
            console.log('Initializing appointments table...');
            
            // Destroy existing table first
            this.destroyTables();
            $('#appointmentsTable').empty();

            // Setup table structure with headers
            $('#appointmentsTable').html(`
                <thead class="tw-bg-gray-700">
                    <tr>
                        <th class="tw-px-4 tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">ID</th>
                        <th class="tw-px-4 tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">Client</th>
                        <th class="tw-px-4 tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">Pet</th>
                        <th class="tw-px-4 tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">Service</th>
                        <th class="tw-px-4 tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">Date</th>
                        <th class="tw-px-4 tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">Time</th>
                        <th class="tw-px-4 tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">Status</th>
                        <th class="tw-px-4 tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            `);
            
            // Initialize appointments table
            this.appointmentsTable = $('#appointmentsTable').DataTable({
                serverSide: false,
                ajax: {
                    url: '{{ route("admin.appointments.data") }}',
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
                        width: '15%',
                        render: function(data) {
                            try {
                                // Access user data through pet relationship
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
                        width: '10%',
                        render: function(data, type, row) {
                            const petIcon = row.pet?.species?.toLowerCase().includes('cat') ? 
                                '<i class="fas fa-cat tw-text-[#FF9666] tw-mr-2"></i>' : 
                                '<i class="fas fa-dog tw-text-[#24CFF4] tw-mr-2"></i>';
                                
                            return `<div class="tw-flex tw-items-center">${petIcon} ${data || 'Unknown'}</div>`;
                        }
                    },
                    { 
                        data: 'service.name',
                        width: '15%',
                        render: function(data, type, row) {
                            return data || 'Unknown Service';
                        }
                    },
                    { 
                        data: 'date',
                        width: '10%',
                        render: function(data) {
                            return moment(data).format('MMM DD, YYYY');
                        }
                    },
                    { 
                        data: 'time',
                        width: '10%',
                        render: function(data) {
                            return moment(data, 'HH:mm:ss').format('h:mm A');
                        }
                    },
                    { 
                        data: 'status',
                        width: '10%',
                        render: function(data) {
                            let badgeClass;
                            let iconClass;
                            
                            switch(data) {
                                case 'Confirmed':
                                    badgeClass = 'tw-bg-blue-900 tw-text-blue-300';
                                    iconClass = 'tw-text-blue-300 fa-check-circle';
                                    break;
                                case 'Completed':
                                    badgeClass = 'tw-bg-green-900 tw-text-green-300';
                                    iconClass = 'tw-text-green-300 fa-check-double';
                                    break;
                                case 'Cancelled':
                                    badgeClass = 'tw-bg-red-900 tw-text-red-300';
                                    iconClass = 'tw-text-red-300 fa-times-circle';
                                    break;
                                default: // Pending or other status
                                    badgeClass = 'tw-bg-yellow-900 tw-text-yellow-300';
                                    iconClass = 'tw-text-yellow-300 fa-clock';
                            }
                            
                            return `<span class="tw-px-2 tw-py-1 tw-rounded-full tw-text-xs ${badgeClass}">
                                <i class="fas ${iconClass} tw-mr-1"></i> ${data}
                            </span>`;
                        }
                    },
                    {
                        data: null,
                        width: '15%',
                        render: function(data) {
                            const cancelBtn = data.status !== 'Cancelled' && data.status !== 'Completed' ? 
                                `<button onclick="AppointmentsPage.cancelAppointment(${data.appointmentID})" class="tw-text-red-500 hover:tw-text-red-300">
                                    <i class="fas fa-ban"></i>
                                </button>` : '';
                                
                            return `
                                <div class="tw-flex tw-space-x-3 tw-justify-center">
                                    <button onclick="AppointmentsPage.viewAppointment(${data.appointmentID})" class="tw-text-[#24CFF4] hover:tw-text-blue-300">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button onclick="AppointmentsPage.editAppointment(${data.appointmentID})" class="tw-text-yellow-500 hover:tw-text-yellow-300">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    ${cancelBtn}
                                </div>
                            `;
                        },
                        orderable: false
                    }
                ],
                autoWidth: false,
                scrollX: false,
                dom: 'Blfrtip',
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                buttons: [
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print tw-mr-2"></i> Print',
                        className: 'tw-text-white tw-bg-gray-700 tw-border-gray-600 tw-rounded-md tw-px-3 tw-py-2 tw-mr-2 hover:tw-bg-gray-600',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        },
                        title: 'Appointments Report'
                    }
                ],
                language: {
                    lengthMenu: "_MENU_ per page",
                    search: "_INPUT_",
                    searchPlaceholder: "Search appointments..."
                },
                order: [[4, 'asc'], [5, 'asc']], // Order by date, then time
                drawCallback: function() {
                    AppointmentsPage.applyTableStyling();
                }
            });

            // Initialize filters
            this.initializeFilters();
        },

        initializeFilters: function() {
            // Service types filter
            fetch('{{ route("admin.services.list") }}')
                .then(response => response.json())
                .then(data => {
                    const serviceFilter = $('#service-filter');
                    data.forEach(service => {
                        serviceFilter.append(`<option value="${service.serviceID}">${service.name}</option>`);
                    });
                })
                .catch(error => console.error('Error loading services:', error));
            
            // Apply filters on change
            $('#status-filter, #service-filter, #date-from, #date-to').on('change', () => {
                this.applyFilters();
            });
        },

        applyFilters: function() {
            const statusFilter = $('#status-filter').val();
            const serviceFilter = $('#service-filter').val();
            const dateFrom = $('#date-from').val();
            const dateTo = $('#date-to').val();
            
            $.fn.dataTable.ext.search.push((settings, data, dataIndex) => {
                const rowData = this.appointmentsTable.row(dataIndex).data();
                
                // Status filter
                if (statusFilter && rowData.status !== statusFilter) {
                    return false;
                }
                
                // Service filter
                if (serviceFilter && rowData.service?.serviceID != serviceFilter) {
                    return false;
                }
                
                // Date range filter
                if (dateFrom || dateTo) {
                    const appointmentDate = moment(rowData.date);
                    
                    if (dateFrom && appointmentDate.isBefore(moment(dateFrom))) {
                        return false;
                    }
                    
                    if (dateTo && appointmentDate.isAfter(moment(dateTo))) {
                        return false;
                    }
                }
                
                return true;
            });
            
            this.appointmentsTable.draw();
            
            // Clear the custom filter
            $.fn.dataTable.ext.search.pop();
        },

        destroyTables: function() {
            if ($.fn.DataTable.isDataTable('#appointmentsTable')) {
                console.log('Destroying existing DataTable');
                $('#appointmentsTable').DataTable().clear().destroy();
                // Empty the table to remove any headers/content
                $('#appointmentsTable').empty();
            }
        },

        applyTableStyling: function() {
            // Style DataTable elements to match dark theme
            $('.dataTables_wrapper .dataTables_length select').addClass('tw-bg-gray-700 tw-text-white tw-border-gray-600 tw-rounded-lg');
            $('.dataTables_wrapper .dataTables_filter input').addClass('tw-bg-gray-700 tw-text-white tw-border-gray-600 tw-rounded-lg tw-px-3 tw-py-2');
            $('.dataTables_wrapper .dataTables_info').addClass('tw-text-gray-400 tw-mt-3');
            $('.dataTables_wrapper .dataTables_paginate').addClass('tw-text-gray-400');
            $('.dataTables_wrapper .paginate_button').addClass('tw-text-gray-400 hover:tw-text-white');
            $('.dataTables_wrapper .paginate_button.current').addClass('tw-bg-gray-700 !tw-text-white !tw-border-gray-600 hover:!tw-bg-gray-600');
            $('.dataTables_wrapper .paginate_button:not(.current)').addClass('tw-bg-transparent !tw-border-gray-700');
        }
    };

    // Initialize tables when page loads directly
    $(document).ready(function() {
        console.log('Document ready, jQuery version:', $.fn.jquery);
        // Check if DataTable is available
        if (!$.fn.DataTable) {
            console.error('DataTables is not loaded!');
        } else {
            console.log('DataTables is loaded, version:', $.fn.DataTable.version);
            AppointmentsPage.initializeTables();
        }
        
        $('#addAppointmentBtn').click(function() {
            console.log('Add appointment button clicked');
            // Implement add appointment functionality
        });
    });

    // Handle dynamic content changes
    document.addEventListener('contentChanged', function() {
        console.log('Content changed event received');
        // Make sure jQuery and DataTables are available
        if (window.jQuery && $.fn.DataTable) {
            AppointmentsPage.initializeTables();
        } else {
            console.error('jQuery or DataTables not available on content change');
        }
    });

    // Cleanup when content will change
    document.addEventListener('contentWillChange', function() {
        console.log('Content will change event received');
        if (window.jQuery && $.fn.DataTable) {
            AppointmentsPage.destroyTables();
        }
    });
</script>
@endpush
@endsection
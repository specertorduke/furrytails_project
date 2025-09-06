@extends('admin.adminLayout')

@section('title', 'System Reports & Audit Logs')

@section('content')
<div class="tw-p-6 tw-min-h-screen tw-bg-gray-900">
    <!-- Header Section -->
    <div class="tw-flex tw-flex-col md:tw-flex-row tw-justify-between tw-items-start md:tw-items-center tw-mb-6">
        <div>
            <p class="tw-text-sm tw-text-gray-400">Administration / Reports</p>
            <h1 class="tw-text-2xl tw-font-bold tw-text-white">System Reports & Audit Logs</h1>
        </div>
        <div class="tw-mt-4 md:tw-mt-0">
            <button type="button" id="restoreDatabaseBtn" class="tw-bg-red-600 tw-text-white tw-px-4 tw-py-2 tw-rounded-xl tw-transition-all tw-duration-300 hover:tw-shadow-lg hover:tw-opacity-90 tw-font-semibold active:tw-bg-red-700">
                <i class="fas fa-history tw-mr-2"></i> Restore Database
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-4 tw-gap-6 tw-mb-6">
        <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-6 tw-border-l-4 tw-border-blue-500 tw-transition-all tw-duration-300 hover:tw-shadow-md">
            <div class="tw-flex tw-justify-between tw-items-center">
                <div>
                    <p class="tw-text-gray-400 tw-text-sm">Total Records</p>
                    <h3 class="tw-text-2xl tw-font-bold tw-text-white">{{ $totalLogs ?? 0 }}</h3>
                </div>
                <div class="tw-bg-gray-700 tw-p-3 tw-rounded-full">
                    <i class="fas fa-database tw-text-blue-500 tw-text-xl"></i>
                </div>
            </div>
        </div>
        <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-6 tw-border-l-4 tw-border-green-500 tw-transition-all tw-duration-300 hover:tw-shadow-md">
            <div class="tw-flex tw-justify-between tw-items-center">
                <div>
                    <p class="tw-text-gray-400 tw-text-sm">Create Actions</p>
                    <h3 class="tw-text-2xl tw-font-bold tw-text-white">{{ $createActions ?? 0 }}</h3>
                </div>
                <div class="tw-bg-gray-700 tw-p-3 tw-rounded-full">
                    <i class="fas fa-plus-circle tw-text-green-500 tw-text-xl"></i>
                </div>
            </div>
        </div>
        <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-6 tw-border-l-4 tw-border-yellow-500 tw-transition-all tw-duration-300 hover:tw-shadow-md">
            <div class="tw-flex tw-justify-between tw-items-center">
                <div>
                    <p class="tw-text-gray-400 tw-text-sm">Update Actions</p>
                    <h3 class="tw-text-2xl tw-font-bold tw-text-white">{{ $updateActions ?? 0 }}</h3>
                </div>
                <div class="tw-bg-gray-700 tw-p-3 tw-rounded-full">
                    <i class="fas fa-edit tw-text-yellow-500 tw-text-xl"></i>
                </div>
            </div>
        </div>
        <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-6 tw-border-l-4 tw-border-red-500 tw-transition-all tw-duration-300 hover:tw-shadow-md">
            <div class="tw-flex tw-justify-between tw-items-center">
                <div>
                    <p class="tw-text-gray-400 tw-text-sm">Delete Actions</p>
                    <h3 class="tw-text-2xl tw-font-bold tw-text-white">{{ $deleteActions ?? 0 }}</h3>
                </div>
                <div class="tw-bg-gray-700 tw-p-3 tw-rounded-full">
                    <i class="fas fa-trash-alt tw-text-red-500 tw-text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Controls -->
    <div class="tw-bg-gray-800 tw-rounded-xl tw-overflow-x-auto tw-shadow-sm tw-p-4 tw-mb-6">
        <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-5 tw-gap-4">
            <div>
                <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-300 tw-mb-1">Table</label>
                <select id="table-filter" class="tw-w-full tw-bg-gray-700 tw-text-white tw-border-gray-600 tw-rounded-lg tw-px-2 tw-py-1.5">
                    <option value="">All Tables</option>
                    <option value="users">Users</option>
                    <option value="pets">Pets</option>
                    <option value="appointments">Appointments</option>
                    <option value="services">Services</option>
                    <option value="boardings">Boarding</option>
                    <option value="payments">Payments</option>
                </select>
            </div>
            <div>
                <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-300 tw-mb-1">Action</label>
                <select id="action-filter" class="tw-w-full tw-bg-gray-700 tw-text-white tw-border-gray-600 tw-rounded-lg tw-px-2 tw-py-1.5">
                    <option value="">All Actions</option>
                    <option value="create">Create</option>
                    <option value="update">Update</option>
                    <option value="delete">Delete</option>
                </select>
            </div>
            <div>
                <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-300 tw-mb-1">User</label>
                <select id="user-filter" class="tw-w-full tw-bg-gray-700 tw-text-white tw-border-gray-600 tw-rounded-lg tw-px-2 tw-py-1.5">
                    <option value="">All Users</option>
                    @foreach ($users ?? [] as $user)
                        <option value="{{ $user->userID }}">{{ $user->firstName }} {{ $user->lastName }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-300 tw-mb-1">Record ID</label>
                <input type="number" id="record-id-filter" class="tw-w-full tw-bg-gray-700 tw-text-white tw-border-gray-600 tw-rounded-lg tw-px-2 tw-py-1.5" placeholder="Filter by ID">
            </div>
            <div>
                <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-300 tw-mb-1">Date Range</label>
                <div class="tw-flex tw-flex-row tw-gap-2">
                    <div class="tw-w-full">
                        <div class="tw-flex tw-items-center tw-bg-gray-700 tw-border-gray-600 tw-rounded-lg">
                            <span class="tw-text-gray-400 tw-px-2 tw-text-xs">From</span>
                            <input type="date" id="date-from" class="tw-w-full tw-bg-gray-700 tw-text-white tw-border-0 tw-rounded-r-lg tw-px-1 tw-py-1.5 focus:tw-outline-none">
                        </div>
                    </div>
                    <div class="tw-w-full">
                        <div class="tw-flex tw-items-center tw-bg-gray-700 tw-border-gray-600 tw-rounded-lg">
                            <span class="tw-text-gray-400 tw-px-2 tw-text-xs">To</span>
                            <input type="date" id="date-to" class="tw-w-full tw-bg-gray-700 tw-text-white tw-border-0 tw-rounded-r-lg tw-px-1 tw-py-1.5 focus:tw-outline-none">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Activity Logs Table -->
    <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-6 tw-overflow-x-auto">
        <div>
            <table id="activityLogsTable" class="tw-min-w-full tw-divide-y tw-divide-gray-700">
                <thead class="tw-bg-gray-700">
                    <tr>
                        <th class="tw-px-4 tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">ID</th>
                        <th class="tw-px-4 tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">Date/Time</th>
                        <th class="tw-px-4 tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">Table</th>
                        <th class="tw-px-4 tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">Record ID</th>
                        <th class="tw-px-4 tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">Action</th>
                        <th class="tw-px-4 tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">User</th>
                        <th class="tw-px-4 tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">IP Address</th>
                        <th class="tw-px-4 tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="tw-bg-gray-800 tw-divide-y tw-divide-gray-700">
                    <!-- Data will be loaded by DataTables -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- View Log Details Modal -->
<div id="viewLogModal" class="modal tw-hidden tw-fixed tw-inset-0 tw-z-50 tw-overflow-auto tw-bg-black tw-bg-opacity-50 tw-flex tw-justify-center tw-items-center">
    <div class="modal-content tw-bg-gray-800 tw-rounded-xl tw-shadow-lg tw-max-w-4xl tw-w-full tw-mx-4 tw-p-6">
        <div class="tw-flex tw-justify-between tw-items-center tw-mb-4">
            <h3 class="tw-text-xl tw-font-bold tw-text-white">Log Details</h3>
            <button type="button" class="close-modal tw-text-gray-400 hover:tw-text-white">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div id="logDetails" class="tw-text-gray-300">
            <!-- Content will be loaded dynamically -->
            <div class="tw-animate-pulse">
                <div class="tw-h-4 tw-bg-gray-600 tw-rounded tw-w-3/4 tw-mb-2"></div>
                <div class="tw-h-4 tw-bg-gray-600 tw-rounded tw-w-1/2 tw-mb-2"></div>
            </div>
        </div>
        
        <div class="tw-mt-6">
            <h4 class="tw-text-lg tw-font-semibold tw-text-white tw-mb-3">Values Comparison</h4>
            <div id="valueComparison" class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-4">
                <div class="tw-animate-pulse">
                    <div class="tw-h-4 tw-bg-gray-600 tw-rounded tw-w-3/4 tw-mb-2"></div>
                    <div class="tw-h-4 tw-bg-gray-600 tw-rounded tw-w-1/2 tw-mb-2"></div>
                </div>
            </div>
        </div>
        
        <div class="tw-flex tw-justify-end tw-mt-6">
            <button type="button" class="close-modal tw-bg-gray-600 tw-text-white tw-px-4 tw-py-2 tw-rounded-lg">Close</button>
            <button type="button" id="restoreToPointBtn" class="tw-bg-red-600 tw-text-white tw-px-4 tw-py-2 tw-rounded-lg tw-ml-3">
                <i class="fas fa-history tw-mr-2"></i> Restore To This Point
            </button>
        </div>
    </div>
</div>

<!-- Database Restoration Modal -->
<div id="restoreDatabaseModal" class="modal tw-hidden tw-fixed tw-inset-0 tw-z-50 tw-overflow-auto tw-bg-black tw-bg-opacity-50 tw-flex tw-justify-center tw-items-center">
    <div class="modal-content tw-bg-gray-800 tw-rounded-xl tw-shadow-lg tw-max-w-lg tw-w-full tw-mx-4 tw-p-6">
        <div class="tw-flex tw-justify-between tw-items-center tw-mb-4">
            <h3 class="tw-text-xl tw-font-bold tw-text-white">Restore Database</h3>
            <button type="button" class="close-modal tw-text-gray-400 hover:tw-text-white">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="tw-text-gray-300 tw-mb-4">
            <p class="tw-text-red-400 tw-font-bold tw-mb-2">⚠️ WARNING: This is a destructive operation</p>
            <p>Restoring the database will revert all changes made after the selected timestamp.</p>
            <p class="tw-mt-2">Make sure you understand the consequences before proceeding.</p>
        </div>
        
        <form id="restoreDatabaseForm" class="tw-space-y-4">
            <div>
                <label for="restore-datetime" class="tw-block tw-text-sm tw-font-medium tw-text-gray-300 tw-mb-1">Restore Point (Date & Time)</label>
                <input type="datetime-local" id="restore-datetime" name="restore_datetime" class="tw-w-full tw-bg-gray-700 tw-text-white tw-border-gray-600 tw-rounded-lg tw-px-3 tw-py-2" required>
            </div>
            
            <div class="tw-mt-4">
                <label class="tw-flex tw-items-center">
                    <input type="checkbox" id="restore-confirm" name="restore_confirm" class="tw-rounded tw-bg-gray-700 tw-text-blue-500 tw-border-gray-600" required>
                    <span class="tw-ml-2 tw-text-gray-300">I understand this will permanently revert data</span>
                </label>
            </div>
            
            <div class="tw-flex tw-justify-end tw-pt-4">
                <button type="button" class="close-modal tw-bg-gray-600 tw-text-white tw-px-4 tw-py-2 tw-rounded-lg tw-mr-2">Cancel</button>
                <button type="submit" class="tw-bg-red-600 tw-text-white tw-px-4 tw-py-2 tw-rounded-lg">Restore Database</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {

        $(document).on('click', '.buttons-collection', function() {
            // Ensure dropdown is visible and properly positioned
            $('.dt-button-collection').css({
                'display': 'block',
                'z-index': 1000, 
                'background-color': '#1f2937', // tw-gray-800
                'border': '1px solid #374151', // tw-gray-700
                'border-radius': '0.5rem',
                'padding': '0.5rem 0',
                'min-width': '150px',
                'margin-top': '0.25rem'
            });
            
            // Style individual dropdown items
            $('.dt-button-collection .dt-button').css({
                'display': 'block',
                'width': '100%',
                'text-align': 'left',
                'border': 'none',
                'background-color': 'transparent',
                'color': '#e5e7eb', // tw-gray-200
                'padding': '0.5rem 1rem',
                'margin': '0'
            });
            
            // Hover effect for dropdown items
            $('.dt-button-collection .dt-button').hover(
                function() { $(this).css('background-color', '#374151'); }, // hover in
                function() { $(this).css('background-color', 'transparent'); } // hover out
            );
        });

        // Initialize main object
        window.ReportsPage = window.ReportsPage || {
            // Initialize DataTable for activity logs
            initializeTables: function() {
                this.logsTable = $('#activityLogsTable').DataTable({
                    serverSide: true,
                    ajax: {
                        url: '{{ route("admin.reports.data") }}',
                        type: 'GET',
                        data: function(d) {
                            d.table = $('#table-filter').val();
                            d.action = $('#action-filter').val();
                            d.user_id = $('#user-filter').val();
                            d.record_id = $('#record-id-filter').val();
                            d.date_from = $('#date-from').val();
                            d.date_to = $('#date-to').val();
                        },
                        error: function(xhr) {
                            console.error('Ajax error:', xhr);
                            Swal.fire({
                                title: 'Error',
                                text: 'Failed to load activity logs. Please try again.',
                                icon: 'error'
                            });
                        }
                    },
                    columns: [
                        { data: 'logID', width: '5%' },
                        { 
                            data: 'created_at',
                            width: '12%',
                            render: function(data) {
                                return moment(data).format('MMM DD, YYYY h:mm A');
                            }
                        },
                        { 
                            data: 'table_name',
                            width: '10%',
                            render: function(data) {
                                // Capitalize and format table name
                                const formattedTable = data.replace(/_/g, ' ')
                                    .replace(/\b\w/g, l => l.toUpperCase());
                                
                                // Different icons for different tables
                                let iconClass = 'fa-table';
                                if (data === 'users') iconClass = 'fa-users';
                                if (data === 'pets') iconClass = 'fa-paw';
                                if (data === 'appointments') iconClass = 'fa-calendar-check';
                                if (data === 'services') iconClass = 'fa-concierge-bell';
                                if (data === 'boardings') iconClass = 'fa-home';
                                if (data === 'payments') iconClass = 'fa-credit-card';
                                
                                return `<span><i class="fas ${iconClass} tw-mr-2"></i>${formattedTable}</span>`;
                            }
                        },
                        { data: 'record_id', width: '8%' },
                        { 
                            data: 'action',
                            width: '8%',
                            render: function(data) {
                                if (data === 'create') {
                                    return '<span class="tw-px-2 tw-py-1 tw-bg-green-900 tw-text-green-300 tw-rounded tw-text-xs">Create</span>';
                                } else if (data === 'update') {
                                    return '<span class="tw-px-2 tw-py-1 tw-bg-yellow-900 tw-text-yellow-300 tw-rounded tw-text-xs">Update</span>';
                                } else if (data === 'delete') {
                                    return '<span class="tw-px-2 tw-py-1 tw-bg-red-900 tw-text-red-300 tw-rounded tw-text-xs">Delete</span>';
                                }
                                return data;
                            }
                        },
                        { 
                            data: null,
                            width: '15%',
                            render: function(data) {
                                const user = data.user;
                                if (!user) return '<span class="tw-text-gray-500">System</span>';
                                
                                return `
                                    <div class="tw-flex tw-items-center">
                                        <div class="tw-h-7 tw-w-7 tw-rounded-full tw-bg-gray-700 tw-flex tw-justify-center tw-items-center">
                                            <i class="fas fa-user tw-text-gray-400"></i>
                                        </div>
                                        <div class="tw-ml-2">
                                            <div class="tw-text-sm tw-font-medium tw-text-gray-200">${user.firstName} ${user.lastName}</div>
                                        </div>
                                    </div>
                                `;
                            }
                        },
                        { 
                            data: 'ip_address',
                            width: '10%',
                            render: function(data) {
                                return data || '<span class="tw-text-gray-500">N/A</span>';
                            }
                        },
                        { 
                            data: null,
                            orderable: false,
                            width: '12%',
                            render: function(data) {
                                return `
                                    <div class="tw-flex tw-space-x-2">
                                        <button type="button" class="view-log-btn tw-bg-blue-600 hover:tw-bg-blue-700 tw-p-1.5 tw-rounded-lg" data-id="${data.logID}" title="View Details">
                                            <i class="fas fa-eye tw-text-white"></i>
                                        </button>
                                        <button type="button" class="restore-point-btn tw-bg-red-600 hover:tw-bg-red-700 tw-p-1.5 tw-rounded-lg" data-id="${data.logID}" data-time="${data.created_at}" title="Restore to this point">
                                            <i class="fas fa-history tw-text-white"></i>
                                        </button>
                                    </div>
                                `;
                            }
                        }
                    ],
                    order: [[0, 'desc']],
                    language: {
                        lengthMenu: "_MENU_ per page",
                        search: "_INPUT_",
                        searchPlaceholder: "Search logs..."
                    },
                    pageLength: 20,
                    responsive: true,
                    dom: 'Bfrtip',
                    buttons: [
                        {
                            extend: 'collection',
                            text: '<i class="fas fa-download tw-mr-1"></i> Export',
                            className: 'tw-bg-gray-700 tw-text-white tw-border-0 tw-rounded-lg tw-px-3 tw-py-2 tw-mr-2 hover:tw-bg-gray-600',
                            buttons: [
                                {
                                    extend: 'copy',
                                    text: '<i class="fas fa-copy tw-mr-1"></i> Copy',
                                    className: 'tw-bg-gray-700 tw-text-white tw-border-0 tw-rounded-none tw-px-4 tw-py-2 hover:tw-bg-gray-600'
                                },
                                {
                                    extend: 'csv',
                                    text: '<i class="fas fa-file-csv tw-mr-1"></i> CSV',
                                    className: 'tw-bg-gray-700 tw-text-white tw-border-0 tw-rounded-none tw-px-4 tw-py-2 hover:tw-bg-gray-600'
                                },
                                {
                                    extend: 'excel',
                                    text: '<i class="fas fa-file-excel tw-mr-1"></i> Excel',
                                    className: 'tw-bg-gray-700 tw-text-white tw-border-0 tw-rounded-none tw-px-4 tw-py-2 hover:tw-bg-gray-600'
                                },
                                {
                                    extend: 'pdf',
                                    text: '<i class="fas fa-file-pdf tw-mr-1"></i> PDF',
                                    className: 'tw-bg-gray-700 tw-text-white tw-border-0 tw-rounded-none tw-px-4 tw-py-2 hover:tw-bg-gray-600'
                                }]
                        }, {
                            extend: 'print',
                            text: '<i class="fas fa-print tw-mr-1"></i> Print',
                            className: 'tw-bg-gray-700 tw-text-white tw-border-0 tw-rounded-lg tw-px-3 tw-py-2 hover:tw-bg-gray-600',
                            exportOptions: {
                                columns: ':not(:last-child)'
                            }
                        }
                    ]
                });
            },
            
            // Set up filter event handlers
            setupFilters: function() {
                $('#table-filter, #action-filter, #user-filter, #date-from, #date-to').on('change', function() {
                    ReportsPage.logsTable.ajax.reload();
                });
                
                $('#record-id-filter').on('keyup', function() {
                    ReportsPage.logsTable.ajax.reload();
                });
            },
            
            // View log details handler
            viewLogDetails: function(id) {
                fetch(`{{ route('admin.reports.show', ':id') }}`.replace(':id', id))
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! Status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        if(data.success) {
                            const log = data.data;
                            const logDate = moment(log.created_at).format('MMM DD, YYYY h:mm:ss A');
                            const userName = log.user ? `${log.user.firstName} ${log.user.lastName}` : 'System';
                            
                            // Construct log details HTML
                            const detailsHtml = `
                                <div class="tw-grid tw-grid-cols-2 tw-gap-4">
                                    <div>
                                        <p class="tw-text-sm tw-text-gray-400">Log ID</p>
                                        <p class="tw-font-medium">${log.logID}</p>
                                    </div>
                                    <div>
                                        <p class="tw-text-sm tw-text-gray-400">Date & Time</p>
                                        <p class="tw-font-medium">${logDate}</p>
                                    </div>
                                    <div>
                                        <p class="tw-text-sm tw-text-gray-400">Table</p>
                                        <p class="tw-font-medium">${log.table_name.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase())}</p>
                                    </div>
                                    <div>
                                        <p class="tw-text-sm tw-text-gray-400">Record ID</p>
                                        <p class="tw-font-medium">${log.record_id}</p>
                                    </div>
                                    <div>
                                        <p class="tw-text-sm tw-text-gray-400">Action</p>
                                        <p class="tw-font-medium">${log.action.charAt(0).toUpperCase() + log.action.slice(1)}</p>
                                    </div>
                                    <div>
                                        <p class="tw-text-sm tw-text-gray-400">User</p>
                                        <p class="tw-font-medium">${userName}</p>
                                    </div>
                                    <div>
                                        <p class="tw-text-sm tw-text-gray-400">IP Address</p>
                                        <p class="tw-font-medium">${log.ip_address || 'N/A'}</p>
                                    </div>
                                    <div>
                                        <p class="tw-text-sm tw-text-gray-400">User Agent</p>
                                        <p class="tw-font-medium tw-truncate" title="${log.user_agent || 'N/A'}">${log.user_agent || 'N/A'}</p>
                                    </div>
                                </div>
                            `;
                            
                            // Parse old and new values for comparison
                            let oldValues = {};
                            let newValues = {};
                            
                            try {
                                if (log.old_values) {
                                    oldValues = typeof log.old_values === 'string' 
                                        ? JSON.parse(log.old_values) 
                                        : log.old_values;
                                }
                                
                                if (log.new_values) {
                                    newValues = typeof log.new_values === 'string'
                                        ? JSON.parse(log.new_values)
                                        : log.new_values;
                                }
                            } catch (e) {
                                console.error('Error parsing values:', e);
                            }
                            
                            // Create comparison table
                            let comparisonHtml = '';
                            
                            if (log.action === 'create') {
                                comparisonHtml = `
                                    <div class="tw-col-span-2">
                                        <div class="tw-bg-gray-700 tw-rounded-lg tw-p-4">
                                            <h5 class="tw-text-white tw-font-medium tw-mb-2">New Record Values</h5>
                                            <div class="tw-overflow-x-auto">
                                                <table class="tw-w-full tw-text-sm">
                                                    <thead>
                                                        <tr class="tw-border-b tw-border-gray-600">
                                                            <th class="tw-text-left tw-py-2 tw-px-2">Field</th>
                                                            <th class="tw-text-left tw-py-2 tw-px-2">Value</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        ${Object.entries(newValues).map(([key, value]) => {
                                                            const displayValue = value === null ? 'null' : 
                                                                (typeof value === 'object' ? JSON.stringify(value) : value);
                                                            return `
                                                                <tr class="tw-border-b tw-border-gray-600">
                                                                    <td class="tw-py-2 tw-px-2 tw-font-medium">${key}</td>
                                                                    <td class="tw-py-2 tw-px-2 tw-text-green-300">${displayValue}</td>
                                                                </tr>
                                                            `;
                                                        }).join('')}
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                `;
                            } else if (log.action === 'delete') {
                                comparisonHtml = `
                                    <div class="tw-col-span-2">
                                        <div class="tw-bg-gray-700 tw-rounded-lg tw-p-4">
                                            <h5 class="tw-text-white tw-font-medium tw-mb-2">Deleted Record Values</h5>
                                            <div class="tw-overflow-x-auto">
                                                <table class="tw-w-full tw-text-sm">
                                                    <thead>
                                                        <tr class="tw-border-b tw-border-gray-600">
                                                            <th class="tw-text-left tw-py-2 tw-px-2">Field</th>
                                                            <th class="tw-text-left tw-py-2 tw-px-2">Value</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        ${Object.entries(oldValues).map(([key, value]) => {
                                                            const displayValue = value === null ? 'null' : 
                                                                (typeof value === 'object' ? JSON.stringify(value) : value);
                                                            return `
                                                                <tr class="tw-border-b tw-border-gray-600">
                                                                    <td class="tw-py-2 tw-px-2 tw-font-medium">${key}</td>
                                                                    <td class="tw-py-2 tw-px-2 tw-text-red-300">${displayValue}</td>
                                                                </tr>
                                                            `;
                                                        }).join('')}
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                `;
                            } else if (log.action === 'update') {
                                // Get all unique keys from both objects
                                const allKeys = [...new Set([...Object.keys(oldValues), ...Object.keys(newValues)])];
                                
                                comparisonHtml = `
                                    <div class="tw-col-span-1">
                                        <div class="tw-bg-gray-700 tw-rounded-lg tw-p-4">
                                            <h5 class="tw-text-white tw-font-medium tw-mb-2">Old Values</h5>
                                            <div class="tw-overflow-x-auto">
                                                <table class="tw-w-full tw-text-sm">
                                                    <thead>
                                                        <tr class="tw-border-b tw-border-gray-600">
                                                            <th class="tw-text-left tw-py-2 tw-px-2">Field</th>
                                                            <th class="tw-text-left tw-py-2 tw-px-2">Value</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        ${allKeys.map(key => {
                                                            const oldVal = oldValues[key];
                                                            const newVal = newValues[key];
                                                            const changed = JSON.stringify(oldVal) !== JSON.stringify(newVal);
                                                            
                                                            const displayValue = oldVal === undefined ? '' : 
                                                                (oldVal === null ? 'null' : 
                                                                    (typeof oldVal === 'object' ? JSON.stringify(oldVal) : oldVal));
                                                            
                                                            return `
                                                                <tr class="tw-border-b tw-border-gray-600 ${changed ? 'tw-bg-red-900/20' : ''}">
                                                                    <td class="tw-py-2 tw-px-2 tw-font-medium">${key}</td>
                                                                    <td class="tw-py-2 tw-px-2 ${changed ? 'tw-text-red-300' : ''}">${displayValue}</td>
                                                                </tr>
                                                            `;
                                                        }).join('')}
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tw-col-span-1">
                                        <div class="tw-bg-gray-700 tw-rounded-lg tw-p-4">
                                            <h5 class="tw-text-white tw-font-medium tw-mb-2">New Values</h5>
                                            <div class="tw-overflow-x-auto">
                                                <table class="tw-w-full tw-text-sm">
                                                    <thead>
                                                        <tr class="tw-border-b tw-border-gray-600">
                                                            <th class="tw-text-left tw-py-2 tw-px-2">Field</th>
                                                            <th class="tw-text-left tw-py-2 tw-px-2">Value</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        ${allKeys.map(key => {
                                                            const oldVal = oldValues[key];
                                                            const newVal = newValues[key];
                                                            const changed = JSON.stringify(oldVal) !== JSON.stringify(newVal);
                                                            
                                                            const displayValue = newVal === undefined ? '' : 
                                                                (newVal === null ? 'null' : 
                                                                    (typeof newVal === 'object' ? JSON.stringify(newVal) : newVal));
                                                            
                                                            return `
                                                                <tr class="tw-border-b tw-border-gray-600 ${changed ? 'tw-bg-green-900/20' : ''}">
                                                                    <td class="tw-py-2 tw-px-2 tw-font-medium">${key}</td>
                                                                    <td class="tw-py-2 tw-px-2 ${changed ? 'tw-text-green-300' : ''}">${displayValue}</td>
                                                                </tr>
                                                            `;
                                                        }).join('')}
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                `;
                            }
                            
                            // Update modal content
                            $('#logDetails').html(detailsHtml);
                            $('#valueComparison').html(comparisonHtml);
                            
                            // Store log ID for potential restore action
                            $('#restoreToPointBtn').data('time', log.created_at);
                            
                            // Show the modal
                            $('#viewLogModal').removeClass('tw-hidden');
                        } else {
                            Swal.fire('Error', 'Failed to load log details', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Error', 'An error occurred while loading log details', 'error');
                    });
            },
            // Restore database to a point in time
            restoreDatabase: function(timestamp) {
                Swal.fire({
                    title: 'Are you sure?',
                    html: `
                        <p class="tw-text-red-400 tw-font-bold tw-mb-2">⚠️ WARNING: This is a destructive operation</p>
                        <p>You are about to restore the database to ${moment(timestamp).format('MMM DD, YYYY h:mm:ss A')}</p>
                        <p>All changes after this point will be lost.</p>
                    `,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, restore it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show loading state
                        Swal.fire({
                            title: 'Restoring Database',
                            html: 'This may take some time. Please wait...',
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            willOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        
                        fetch("{{ route('admin.reports.restore') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                timestamp: timestamp,
                                confirm: true
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: 'Restored!',
                                    text: 'Database has been restored successfully.',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    // Reload the page to show restored data
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire('Error', data.message || 'Failed to restore database.', 'error');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire('Error', 'An error occurred during database restoration.', 'error');
                        });
                    }
                });
            }
        };
        
        // Initialize the page
        ReportsPage.initializeTables();
        ReportsPage.setupFilters();
        
        // Set up event listeners for buttons in the table
        $(document).on('click', '.view-log-btn', function() {
            const logId = $(this).data('id');
            ReportsPage.viewLogDetails(logId);
        });
        
        $(document).on('click', '.restore-point-btn', function() {
            const timestamp = $(this).data('time');
            ReportsPage.restoreDatabase(timestamp);
        });
        
        // Modal close buttons
        $('.close-modal').on('click', function() {
            $('.modal').addClass('tw-hidden');
        });
        
        // Restore database from modal button
        $('#restoreToPointBtn').on('click', function() {
            const timestamp = $(this).data('time');
            $('.modal').addClass('tw-hidden');
            ReportsPage.restoreDatabase(timestamp);
        });
        
        // Restore database form
        $('#restoreDatabaseBtn').on('click', function() {
            // Set default datetime to current time minus 24 hours
            const yesterday = new Date(Date.now() - 24 * 60 * 60 * 1000);
            const defaultDatetime = yesterday.toISOString().slice(0, 16);
            $('#restore-datetime').val(defaultDatetime);
            
            // Show the modal
            $('#restoreDatabaseModal').removeClass('tw-hidden');
        });
        
        // Handle form submission for database restoration
        $('#restoreDatabaseForm').on('submit', function(e) {
            e.preventDefault();
            
            const timestamp = $('#restore-datetime').val();
            const confirmed = $('#restore-confirm').is(':checked');
            
            if (confirmed && timestamp) {
                // Hide the modal
                $('#restoreDatabaseModal').addClass('tw-hidden');
                
                // Show confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    html: `
                        <p class="tw-text-red-400 tw-font-bold tw-mb-2">⚠️ WARNING: This is a destructive operation</p>
                        <p>You are about to restore the database to ${moment(timestamp).format('MMM DD, YYYY h:mm:ss A')}</p>
                        <p>All changes after this point will be lost.</p>
                    `,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, restore it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show loading state
                        Swal.fire({
                            title: 'Restoring Database',
                            html: 'This may take some time. Please wait...',
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            willOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        
                        fetch("{{ route('admin.reports.restore') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                timestamp: timestamp,
                                confirm: true
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: 'Restored!',
                                    text: 'Database has been restored successfully.',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    // Reload the page to show restored data
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire('Error', data.message || 'Failed to restore database.', 'error');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire('Error', 'An error occurred during database restoration.', 'error');
                        });
                    }
                });
            }
        });
    });
</script>
@endpush
@endsection
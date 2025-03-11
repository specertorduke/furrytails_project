@extends('admin.adminLayout')

@section('title', 'Boardings Management')

@section('content')
<div class="tw-p-6 tw-min-h-screen tw-bg-gray-900">
    <!-- Header Section -->
    <div class="tw-flex tw-flex-col md:tw-flex-row tw-justify-between tw-items-start md:tw-items-center tw-mb-6">
        <div>
            <p class="tw-text-sm tw-text-gray-400">Administration / Boardings</p>
            <h1 class="tw-text-2xl tw-font-bold tw-text-white">Boardings Management</h1>
        </div>
        <div class="tw-mt-4 md:tw-mt-0">
            <button type="button" id="addBoardingBtn" class="tw-bg-[#4dc76d] tw-text-white tw-px-4 tw-py-2 tw-rounded-xl tw-transition-all tw-duration-300 hover:tw-shadow-lg hover:tw-opacity-90 tw-font-semibold active:tw-bg-green-400">
                <i class="fas fa-home tw-mr-2"></i> Add Boarding
            </button>
        </div>
    </div>

    <!-- Boarding Stats Cards -->
    <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-4 tw-gap-6 tw-mb-6">
        <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-6 tw-border-l-4 tw-border-[#66FF8F] tw-transition-all tw-duration-300 hover:tw-shadow-md">
            <div class="tw-flex tw-justify-between tw-items-center">
                <div>
                    <p class="tw-text-gray-400 tw-text-sm">Total Boardings</p>
                    <h3 class="tw-text-2xl tw-font-bold tw-text-white">{{ $totalBoardings ?? 0 }}</h3>
                </div>
                <div class="tw-bg-gray-700 tw-p-3 tw-rounded-full">
                    <i class="fas fa-home tw-text-[#66FF8F] tw-text-xl"></i>
                </div>
            </div>
        </div>
        <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-6 tw-border-l-4 tw-border-blue-500 tw-transition-all tw-duration-300 hover:tw-shadow-md">
            <div class="tw-flex tw-justify-between tw-items-center">
                <div>
                    <p class="tw-text-gray-400 tw-text-sm">Active</p>
                    <h3 class="tw-text-2xl tw-font-bold tw-text-white">{{ $activeBoardings ?? 0 }}</h3>
                </div>
                <div class="tw-bg-gray-700 tw-p-3 tw-rounded-full">
                    <i class="fas fa-bed tw-text-blue-500 tw-text-xl"></i>
                </div>
            </div>
        </div>
        <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-6 tw-border-l-4 tw-border-green-500 tw-transition-all tw-duration-300 hover:tw-shadow-md">
            <div class="tw-flex tw-justify-between tw-items-center">
                <div>
                    <p class="tw-text-gray-400 tw-text-sm">Completed</p>
                    <h3 class="tw-text-2xl tw-font-bold tw-text-white">{{ $completedBoardings ?? 0 }}</h3>
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
                    <h3 class="tw-text-2xl tw-font-bold tw-text-white">{{ $cancelledBoardings ?? 0 }}</h3>
                </div>
                <div class="tw-bg-gray-700 tw-p-3 tw-rounded-full">
                    <i class="fas fa-times-circle tw-text-red-500 tw-text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Controls -->
    <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-4 tw-mb-6 tw-overflow-x-auto">
        <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-3 tw-gap-4">
            <div>
                <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-300 tw-mb-1">Status</label>
                <select id="status-filter" class="tw-w-full tw-bg-gray-700 tw-text-white tw-border-gray-600 tw-rounded-lg tw-px-3 tw-py-2">
                    <option value="">All Statuses</option>
                    <option value="Pending">Pending</option>
                    <option value="Active">Active</option>
                    <option value="Completed">Completed</option>
                    <option value="Cancelled">Cancelled</option>
                </select>
            </div>
            <div>
                <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-300 tw-mb-1">Pet Type</label>
                <select id="pet-type-filter" class="tw-w-full tw-bg-gray-700 tw-text-white tw-border-gray-600 tw-rounded-lg tw-px-3 tw-py-2">
                    <option value="">All Types</option>
                    <option value="Dog">Dogs</option>
                    <option value="Cat">Cats</option>
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

    <!-- Boardings Table -->
    <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-6 tw-overflow-x-auto">
        <div>
            <table id="boardingsTable" class="tw-min-w-full tw-divide-y tw-divide-gray-700">
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
</div>

@push('scripts')
<script>
    // Create a namespace for our boardings page functionality
    window.BoardingsPage = window.BoardingsPage || {
        boardingsTable: null,

        // CRUD Functions
        viewBoarding: function(id) {
            console.log('View boarding', id);
            // Implement view functionality
        },

        editBoarding: function(id) {
            console.log('Edit boarding', id);
            // Implement edit functionality
        },

        cancelBoarding: function(id) {
            Swal.fire({
                title: 'Cancel this boarding?',
                text: "You can't undo this action!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#66FF8F',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, cancel it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Make AJAX call to cancel
                    fetch(`/admin/boardings/${id}/cancel`, {
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
                            this.boardingsTable.ajax.reload();
                            Swal.fire('Cancelled!', 'Boarding has been cancelled.', 'success');
                        } else {
                            Swal.fire('Error!', data.message || 'Failed to cancel boarding.', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Error!', 'An error occurred while cancelling the boarding.', 'error');
                    });
                }
            });
        },

        initializeTables: function() {
            console.log('Initializing boardings table...');
            
            // Destroy existing table first
            this.destroyTables();
            $('#boardingsTable').empty();

            // Setup table structure with headers
            $('#boardingsTable').html(`
                <thead class="tw-bg-gray-700">
                    <tr>
                        <th class="tw-px-4 tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">ID</th>
                        <th class="tw-px-4 tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">Client</th>
                        <th class="tw-px-4 tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">Pet</th>
                        <th class="tw-px-4 tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">Start Date</th>
                        <th class="tw-px-4 tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">End Date</th>
                        <th class="tw-px-4 tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">Duration</th>
                        <th class="tw-px-4 tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">Status</th>
                        <th class="tw-px-4 tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            `);
            
            // Initialize boardings table
            this.boardingsTable = $('#boardingsTable').DataTable({
                serverSide: false,
                ajax: {
                    url: '{{ route("admin.boardings.data") }}',
                    type: 'GET',
                    dataSrc: 'data',
                    error: function(xhr, error, thrown) {
                        console.error('Boardings Ajax error:', xhr, error, thrown);
                    }
                },
                columns: [
                    { data: 'boardingID', width: '5%' },
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
                        data: 'start_date',
                        width: '12%',
                        render: function(data) {
                            return moment(data).format('MMM DD, YYYY');
                        }
                    },
                    { 
                        data: 'end_date',
                        width: '12%',
                        render: function(data) {
                            return moment(data).format('MMM DD, YYYY');
                        }
                    },
                    { 
                        data: null,
                        width: '8%',
                        render: function(data) {
                            const startDate = moment(data.start_date);
                            const endDate = moment(data.end_date);
                            const duration = endDate.diff(startDate, 'days') + 1;
                            return `${duration} day${duration !== 1 ? 's' : ''}`;
                        }
                    },
                    { 
                        data: 'status',
                        width: '10%',
                        render: function(data) {
                            let badgeClass;
                            let iconClass;
                            
                            switch(data) {
                                case 'Active':
                                    badgeClass = 'tw-bg-blue-900 tw-text-blue-300';
                                    iconClass = 'tw-text-blue-300 fa-bed';
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
                                `<button onclick="BoardingsPage.cancelBoarding(${data.boardingID})" class="tw-text-red-500 hover:tw-text-red-300">
                                    <i class="fas fa-ban"></i>
                                </button>` : '';
                                
                            return `
                                <div class="tw-flex tw-space-x-3 tw-justify-center">
                                    <button onclick="BoardingsPage.viewBoarding(${data.boardingID})" class="tw-text-[#24CFF4] hover:tw-text-blue-300">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button onclick="BoardingsPage.editBoarding(${data.boardingID})" class="tw-text-yellow-500 hover:tw-text-yellow-300">
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
                        title: 'Boardings Report'
                    }
                ],
                language: {
                    lengthMenu: "_MENU_ per page",
                    search: "_INPUT_",
                    searchPlaceholder: "Search boardings..."
                },
                order: [[3, 'desc'], [4, 'asc']], // Order by start date desc, then end date asc
                drawCallback: function() {
                    BoardingsPage.applyTableStyling();
                }
            });

            // Initialize filters
            this.initializeFilters();
            this.loadOngoingBoardings();
        },

        initializeFilters: function() {
            // Apply filters on change
            $('#status-filter, #pet-type-filter, #date-from, #date-to').on('change', () => {
                this.applyFilters();
            });
        },

        applyFilters: function() {
            const statusFilter = $('#status-filter').val();
            const breedFilter = $('#pet-type-filter').val();
            const dateFrom = $('#date-from').val();
            const dateTo = $('#date-to').val();
            
            $.fn.dataTable.ext.search.push((settings, data, dataIndex) => {
                const rowData = this.boardingsTable.row(dataIndex).data();
                
                // Status filter
                if (statusFilter && rowData.status !== statusFilter) {
                    return false;
                }
                
                // Pet type filter
                if (breedFilter && rowData.pet?.species?.toLowerCase() !== breedFilter.toLowerCase()) {
                    return false;
                }
                
                // Date range filter (check if boarding period overlaps with selected date range)
                if (dateFrom || dateTo) {
                    const startDate = moment(rowData.start_date);
                    const endDate = moment(rowData.end_date);
                    
                    if (dateFrom && endDate.isBefore(moment(dateFrom))) {
                        return false;
                    }
                    
                    if (dateTo && startDate.isAfter(moment(dateTo))) {
                        return false;
                    }
                }
                
                return true;
            });
            
            this.boardingsTable.draw();
            
            // Clear the custom filter
            $.fn.dataTable.ext.search.pop();
        },

        destroyTables: function() {
            if ($.fn.DataTable.isDataTable('#boardingsTable')) {
                console.log('Destroying existing DataTable');
                $('#boardingsTable').DataTable().clear().destroy();
                // Empty the table to remove any headers/content
                $('#boardingsTable').empty();
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
        },

        loadOngoingBoardings: function() {
        fetch('{{ route("boardings.ongoing-boardings.data") }}')
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

    // Initialize tables when page loads directly
    $(document).ready(function() {
        console.log('Document ready, jQuery version:', $.fn.jquery);
        // Check if DataTable is available
        if (!$.fn.DataTable) {
            console.error('DataTables is not loaded!');
        } else {
            console.log('DataTables is loaded, version:', $.fn.DataTable.version);
            BoardingsPage.initializeTables();
        }
        
        $('#addBoardingBtn').click(function() {
            console.log('Add boarding button clicked');
            // Implement add boarding functionality
        });
    });

    // Handle dynamic content changes
    document.addEventListener('contentChanged', function() {
        console.log('Content changed event received');
        // Make sure jQuery and DataTables are available
        if (window.jQuery && $.fn.DataTable) {
            BoardingsPage.initializeTables();
        } else {
            console.error('jQuery or DataTables not available on content change');
        }
    });

    // Cleanup when content will change
    document.addEventListener('contentWillChange', function() {
        console.log('Content will change event received');
        if (window.jQuery && $.fn.DataTable) {
            BoardingsPage.destroyTables();
        }
    });
</script>
@endpush
@endsection
@extends('admin.adminLayout')

@section('title', 'Users Management')

@section('content')
<div class="tw-p-6 tw-min-h-screen tw-bg-gray-900">
    <!-- Header Section -->
    <div class="tw-flex tw-flex-col md:tw-flex-row tw-justify-between tw-items-start md:tw-items-center tw-mb-6">
        <div>
            <p class="tw-text-sm tw-text-gray-400">Administration / Users</p>
            <h1 class="tw-text-2xl tw-font-bold tw-text-white">User Management</h1>
        </div>
        <div class="tw-mt-4 md:tw-mt-0">
            <button type="button" id="addUserBtn" class="tw-bg-[#24CFF4] tw-text-white tw-px-4 tw-py-2 tw-rounded-xl tw-transition-all tw-duration-300 hover:tw-shadow-lg hover:tw-opacity-90 tw-font-semibold active:tw-bg-blue-400">
                <i class="fas fa-user-plus tw-mr-2"></i> Add User
            </button>
        </div>
    </div>

    <!-- Users Stats Cards -->
    <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-3 tw-gap-6 tw-mb-6">
        <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-6 tw-border-l-4 tw-border-[#24CFF4] tw-transition-all tw-duration-300 hover:tw-shadow-md">
            <div class="tw-flex tw-justify-between tw-items-center">
                <div>
                    <p class="tw-text-gray-400 tw-text-sm">Total Users</p>
                    <h3 class="tw-text-2xl tw-font-bold tw-text-white">{{ $totalUsers ?? 0 }}</h3>
                </div>
                <div class="tw-bg-gray-700 tw-p-3 tw-rounded-full">
                    <i class="fas fa-users tw-text-[#24CFF4] tw-text-xl"></i>
                </div>
            </div>
        </div>
        <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-6 tw-border-l-4 tw-border-green-500 tw-transition-all tw-duration-300 hover:tw-shadow-md">
            <div class="tw-flex tw-justify-between tw-items-center">
                <div>
                    <p class="tw-text-gray-400 tw-text-sm">Active Users</p>
                    <h3 class="tw-text-2xl tw-font-bold tw-text-white">{{ $activeUsers ?? 0 }}</h3>
                </div>
                <div class="tw-bg-gray-700 tw-p-3 tw-rounded-full">
                    <i class="fas fa-user-check tw-text-green-500 tw-text-xl"></i>
                </div>
            </div>
        </div>
        <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-6 tw-border-l-4 tw-border-yellow-500 tw-transition-all tw-duration-300 hover:tw-shadow-md">
            <div class="tw-flex tw-justify-between tw-items-center">
                <div>
                    <p class="tw-text-gray-400 tw-text-sm">New Users (30 days)</p>
                    <h3 class="tw-text-2xl tw-font-bold tw-text-white">{{ $newUsers ?? 0 }}</h3>
                </div>
                <div class="tw-bg-gray-700 tw-p-3 tw-rounded-full">
                    <i class="fas fa-user-plus tw-text-yellow-500 tw-text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-6 tw-overflow-x-auto">
        <div>
            <table id="usersTable" class="tw-min-w-full tw-divide-y tw-divide-gray-700">
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Create a namespace for our users page functionality
    window.UsersPage = window.UsersPage || {
        usersTable: null,

        // CRUD Functions
        viewUser: function(id) {
            console.log('View user', id);
        },

        editUser: function(id) {
            console.log('Edit user', id);
        },

        deleteUser: function(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#24CFF4',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Make AJAX call to delete
                    fetch(`/admin/users/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if(data.success) {
                            this.usersTable.ajax.reload();
                            Swal.fire('Deleted!', 'User has been deleted.', 'success');
                        } else {
                            Swal.fire('Error!', data.message || 'Failed to delete user.', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Error!', 'An error occurred while deleting the user.', 'error');
                    });
                }
            });
        },

        initializeTables: function() {
            console.log('Initializing users table...');
            
            // Destroy existing table first
            this.destroyTables();
            $('#usersTable').empty();

            // Setup table structure with headers
            // Important: We're adding the HTML structure for the table here
            $('#usersTable').html(`
                <thead class="tw-bg-gray-700">
                    <tr>
                        <th class="tw-px-4 tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">ID</th>
                        <th class="tw-px-4 tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">Name</th>
                        <th class="tw-px-4 tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">Email</th>
                        <th class="tw-px-4 tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">Phone</th>
                        <th class="tw-px-4 tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">Username</th>
                        <th class="tw-px-4 tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">Role</th>
                        <th class="tw-px-4 tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            `);
            
            // Initialize users table
            this.usersTable = $('#usersTable').DataTable({
                serverSide: false,
                ajax: {
                    url: '{{ route("admin.users.data") }}',
                    type: 'GET',
                    dataSrc: 'data',
                    error: function(xhr, error, thrown) {
                        console.error('Users Ajax error:', xhr, error, thrown);
                    }
                },
                columns: [
                    { data: 'userID', width: '5%' },
                    { 
                        data: null,
                        width: '20%',
                        render: function(data) {
                            const image = data.userImage 
                                ? `<img src="../storage/${data.userImage}" alt="${data.firstName}" class="tw-h-8 tw-w-8 tw-rounded-full tw-object-cover">` 
                                : `<i class="fas fa-user tw-text-gray-400"></i>`;
                                
                            return `
                                <div class="tw-flex tw-items-center">
                                    <div class="tw-h-8 tw-w-8 tw-rounded-full tw-bg-gray-700 tw-flex tw-justify-center tw-items-center">
                                        ${image}
                                    </div>
                                    <div class="tw-ml-3">
                                        <div class="tw-text-sm tw-font-medium tw-text-gray-200">${data.firstName} ${data.lastName}</div>
                                    </div>
                                </div>
                            `;
                        }
                    },
                    { data: 'email', width: '15%' },
                    { data: 'phone', width: '15%' },
                    { data: 'username', width: '15%' },
                    { 
                        data: 'role',
                        width: '10%',
                        render: function(data) {
                            return data === 'admin' ? 
                                '<span class="tw-px-2 tw-py-1 tw-rounded-full tw-text-xs tw-bg-red-900 tw-text-red-300">Admin</span>' : 
                                '<span class="tw-px-2 tw-py-1 tw-rounded-full tw-text-xs tw-bg-blue-900 tw-text-blue-300">User</span>';
                        }
                    },
                    {
                        data: null,
                        width: '20%',
                        render: function(data) {
                            const deleteButton = data.role !== 'admin' ? 
                                `<button onclick="UsersPage.deleteUser(${data.userID})" class="tw-text-red-500 hover:tw-text-red-300">
                                    <i class="fas fa-trash"></i>
                                </button>` : '';
                                
                            return `
                                <div class="tw-flex tw-space-x-3 tw-justify-center">
                                    <button onclick="UsersPage.viewUser(${data.userID})" class="tw-text-[#24CFF4] hover:tw-text-blue-300">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button onclick="UsersPage.editUser(${data.userID})" class="tw-text-yellow-500 hover:tw-text-yellow-300">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    ${deleteButton}
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
                            columns: [0, 1, 2, 3, 4, 5]
                        },
                        title: 'Users Report'
                    }
                ],
                language: {
                    lengthMenu: "_MENU_ per page",
                    search: "_INPUT_",
                    searchPlaceholder: "Search users..."
                },
                order: [[0, 'desc']],
                drawCallback: function() {
                    UsersPage.applyTableStyling();
                }
            });
        },

        destroyTables: function() {
            if ($.fn.DataTable.isDataTable('#usersTable')) {
                console.log('Destroying existing DataTable');
                $('#usersTable').DataTable().clear().destroy();
                // Empty the table to remove any headers/content
                $('#usersTable').empty();
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
            UsersPage.initializeTables();
        }
        
        $('#addUserBtn').click(function() {
            console.log('Add user button clicked');
        });
    });

    // Initialize tables when content changes
    document.addEventListener('contentChanged', function() {
        console.log('Content changed event received');
        // Make sure jQuery and DataTables are available
        if (window.jQuery && $.fn.DataTable) {
            UsersPage.initializeTables();
        } else {
            console.error('jQuery or DataTables not available on content change');
        }
    });

    // Cleanup when content will change
    document.addEventListener('contentWillChange', function() {
        console.log('Content will change event received');
        if (window.jQuery && $.fn.DataTable) {
            UsersPage.destroyTables();
        }
    });
</script>
@endpush
@endsection
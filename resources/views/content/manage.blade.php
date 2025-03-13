@extends('main')

@section('title', 'Manage')

@section('content')
<div class="tw-p-6 tw-bg-gradient-to-tl tw-h-screen tw-to-[#b7f4ff] tw-from-white">
    <div class="tw-flex tw-justify-between tw-items-center tw-mb-6">
        <div>
            <p class="tw-text-sm tw-text-gray-500">Pages / Manage</p>
            <h1 class="tw-text-2xl tw-font-bold">Manage</h1>
        </div>
        <div class="tw-flex tw-gap-2">
            <button type="button" data-modal-target="addAppointment" data-modal-toggle="addAppointment-modal" 
                class="tw-bg-[#24CFF4] tw-text-white tw-px-4 tw-py-2 tw-rounded-xl tw-transition-all tw-duration-300 hover:tw-shadow-lg hover:tw-opacity-90 tw-font-semibold active:tw-bg-blue-400">
                <i class="fas fa-plus"></i> New Appointment
            </button>
            <button type="button" data-modal-target="addBoarding-modal" data-modal-toggle="addBoarding-modal" 
                class="tw-bg-[#24CFF4] tw-text-white tw-px-4 tw-py-2 tw-rounded-xl tw-transition-all tw-duration-300 hover:tw-shadow-lg hover:tw-opacity-90 tw-font-semibold active:tw-bg-blue-400">
                <i class="fas fa-plus"></i> New Boarding
            </button>
        </div>
    </div>

    <ul class="nav nav-tabs" id="manageTabs" role="tablist">
        <li class="nav-item">
            <a class="manage-tab active" id="appointments-tab" data-toggle="tab" href="#appointments" role="tab" 
            aria-controls="appointments" aria-selected="true">
                Appointments
            </a>
        </li>
        <li class="nav-item">
            <a class="manage-tab" id="boardings-tab" data-toggle="tab" href="#boardings" role="tab" 
            aria-controls="boardings" aria-selected="false">
                Boardings
            </a>        
        </li>
    </ul>
    
    <div class="tab-content" id="manageTabsContent">
        <!-- Appointments Tab -->
        <div class="tab-pane fade show active" id="appointments" role="tabpanel" aria-labelledby="appointments-tab">
            <div class="tw-bg-white tw-shadow-sm tw-rounded-b-2xl tw-rounded-tr-2xl  tw-p-6 tw-mt-[0.6rem]">
                <div class="table-responsive">
                <table id="appointmentsTable" class="table table-hover w-100">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Pet Name</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Service</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
                </div>
            </div>
        </div>

        <!-- Boardings Tab -->
        <div class="tab-pane fade" id="boardings" role="tabpanel" aria-labelledby="boardings-tab">
            <div class="tw-bg-white tw-shadow-sm tw-rounded-b-2xl tw-rounded-tr-2xl  tw-p-6 tw-mt-2">
                <div class="table-responsive">
                    <table id="boardingsTable" class="table table-hover w-100">
                        <thead>
                            <tr class="tw-border-b">
                                <th>Boarding Tier</th>
                                <th>Pet Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                                <th>ID</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Create a namespace for our manage page functionality
    window.ManagePage = window.ManagePage || {
        appointmentsTable: null,
        boardingsTable: null,

        // CRUD Functions
    viewAppointment: function(id) {
            // Show appointment details modal
        },

        editAppointment: function(id) {
            // Show edit appointment modal
        },

        deleteAppointment: function(id) {
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
                    fetch(`/appointments/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if(data.success) {
                            this.appointmentsTable.ajax.reload();
                            Swal.fire('Deleted!', 'Appointment has been deleted.', 'success');
                        }
                    });
                }
            });
        },

        // Similar functions for boarding...
        viewBoarding: function(id) {
            // Show boarding details modal
        },

        editBoarding: function(id) {
            // Show edit boarding modal
        },

        deleteBoarding: function(id) {
            // Similar to deleteAppointment
        },

        initializeTables: function() {
            console.log('Initializing tables...');
            
            // Destroy existing tables first
            this.destroyTables();
            
            // Restore table headers
            $('#appointmentsTable').html(`
                <thead>
                    <tr class="tw-border-b">
                        <th class="tw-p-2 tw-text-left">ID</th>
                        <th class="tw-p-2 tw-text-left">Pet Name</th>
                        <th class="tw-p-2 tw-text-left">Date</th>
                        <th class="tw-p-2 tw-text-left">Time</th>
                        <th class="tw-p-2 tw-text-left">Service</th>
                        <th class="tw-p-2 tw-text-left">Status</th>
                        <th class="tw-p-2 tw-text-left">Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            `);

            $('#boardingsTable').html(`
                <thead>
                    <tr class="tw-border-b">
                        <th class="tw-p-2 tw-text-left">ID</th>
                        <th class="tw-p-2 tw-text-left">Boarding Tier</th>
                        <th class="tw-p-2 tw-text-left">Pet Name</th>
                        <th class="tw-p-2 tw-text-left">Start Date</th>
                        <th class="tw-p-2 tw-text-left">End Date</th>
                        <th class="tw-p-2 tw-text-left">Status</th>
                        <th class="tw-p-2 tw-text-left">Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            `);
            
            const commonConfig = {
                serverSide: false,
                autoWidth: false,
                scrollX: false,
                dom: 'Blfrtip',
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                buttons: [
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print tw-mr-2"></i> Print',
                        className: 'tw-mr-2'
                    }
                ],
                language: {
                    lengthMenu: "_MENU_ per page",
                    search: "_INPUT_",
                    searchPlaceholder: "Search records..."
                }
            };

            // Initialize appointments table
            this.appointmentsTable = $('#appointmentsTable').DataTable({
                ...commonConfig,
                ajax: {
                    url: '{{ route("manage.appointments") }}',
                    type: 'GET',
                    error: function (xhr, error, thrown) {
                        console.error('Appointments Ajax error:', xhr, error, thrown);
                    }
                },
                columns: [
                    { data: 'appointmentID', width: '5%' },
                    { data: 'pet.name', width: '15%' },
                    { data: 'date', width: '15%' },
                    { data: 'time', width: '10%' },
                    { data: 'service.name', width: '20%' },
                    { 
                        data: 'status',
                        width: '15%',
                        render: function(data) {
                            let colorClass = data === 'Confirmed' ? 'tw-bg-green-100 tw-text-green-800' :
                                        data === 'Pending' ? 'tw-bg-yellow-100 tw-text-yellow-800' :
                                        'tw-bg-red-100 tw-text-red-800';
                            return `<span class="tw-px-3 tw-py-1 tw-rounded-full tw-text-sm ${colorClass}">${data}</span>`;
                        }
                    },
                    {
                        data: null,
                        width: '20%',
                        render: function(data) {
                            return `
                                <div class="tw-flex tw-gap-2 tw-justify-center">
                                    <button onclick="ManagePage.viewAppointment(${data.appointmentID})" 
                                            class="tw-text-blue-500 hover:tw-text-blue-700">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button onclick="ManagePage.editAppointment(${data.appointmentID})" 
                                            class="tw-text-yellow-500 hover:tw-text-yellow-700">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="ManagePage.deleteAppointment(${data.appointmentID})" 
                                            class="tw-text-red-500 hover:tw-text-red-700">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            `;
                        }
                    }
                ],
        
            });

            // Initialize boardings table
            this.boardingsTable = $('#boardingsTable').DataTable({
                ...commonConfig,
                ajax: {
                    url: '{{ route("manage.boardings") }}',
                    type: 'GET',
                    error: function (xhr, error, thrown) {
                    console.error('Boardings Ajax error:', {
                        status: xhr.status,
                        statusText: xhr.statusText,
                        responseText: xhr.responseText,
                        error: error,
                        thrown: thrown
                    });
                    }
                },
                columns: [
                    { data: 'boardingID', width: '5%' },
                    { data: 'boardingType', width: '15%' },
                    { data: 'pet.name', width: '15%' },
                    { data: 'start_date', width: '15%' },
                    { data: 'end_date', width: '15%' },
                    { 
                        data: 'status',
                        width: '15%',
                        render: function(data) {
                            let colorClass = data === 'Confirmed' ? 'tw-bg-green-100 tw-text-green-800' :
                                        data === 'Pending' ? 'tw-bg-yellow-100 tw-text-yellow-800' :
                                        'tw-bg-red-100 tw-text-red-800';
                            return `<span class="tw-px-3 tw-py-1 tw-rounded-full tw-text-sm ${colorClass}">${data}</span>`;
                        }
                    },
                    {
                        data: null,
                        render: function(data) {
                            return `
                                <div class="tw-flex tw-gap-2 tw-justify-center">
                                    <button onclick="ManagePage.viewBoarding(${data.boardingID})" 
                                            class="tw-text-blue-500 hover:tw-text-blue-700">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button onclick="ManagePage.editBoarding(${data.boardingID})" 
                                            class="tw-text-yellow-500 hover:tw-text-yellow-700">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="ManagePage.deleteBoarding(${data.boardingID})" 
                                            class="tw-text-red-500 hover:tw-text-red-700">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            `;
                        }
                    }
                ]
            });
        },

        destroyTables: function() {
            if ($.fn.DataTable.isDataTable('#appointmentsTable')) {
                $('#appointmentsTable').DataTable().clear().destroy();
                $('#appointmentsTable').empty();
            }
            if ($.fn.DataTable.isDataTable('#boardingsTable')) {
                $('#boardingsTable').DataTable().clear().destroy();
                $('#boardingsTable').empty();
            }
        }
    }; 

    // Initialize tables when page loads directly
    $(document).ready(function() {
        ManagePage.initializeTables();
    });

    // Initialize tables when content changes
    document.addEventListener('contentChanged', function() {
        console.log('Content changed event received');
        ManagePage.initializeTables();
    });

    // Cleanup when content will change
    document.addEventListener('contentWillChange', function() {
        console.log('Content will change event received');
        ManagePage.destroyTables();
    });
</script>
@endpush
@endsection
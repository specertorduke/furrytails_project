@extends('main')

@section('title', 'Manage')

@section('content')
<div class="tw-p-6 tw-min-h-screen tw-overflow-y-auto tw-bg-[#f4fbfd]">
    <div class="tw-flex tw-justify-between tw-items-center tw-mb-6">
        <div>
            <!-- <p class="tw-text-sm tw-text-gray-500">Pages / Manage</p> -->
            <h1 class="tw-text-2xl tw-font-bold">Manage</h1>
        </div>
        <div class="tw-flex tw-gap-2">
            <button type="button" data-modal-target="addAppointment-modal" data-modal-toggle="addAppointment-modal" 
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
        <li class="nav-item shadow-[0_-10px_15px_-3px_rgba(0,0,0,0.1),0_-4px_6px_-4px_rgba(0,0,0,0.1)]">
            <a class="manage-tab active" id="appointments-tab" data-toggle="tab" href="#appointments" role="tab" 
            aria-controls="appointments" aria-selected="true">
                Appointments
            </a>
        </li>
        <li class="nav-item shadow-[0_-10px_15px_-3px_rgba(0,0,0,0.1),0_-4px_6px_-4px_rgba(0,0,0,0.1)]">
            <a class="manage-tab" id="boardings-tab" data-toggle="tab" href="#boardings" role="tab" 
            aria-controls="boardings" aria-selected="false">
                Boardings
            </a>        
        </li>
    </ul>
    
    <div class="tab-content tw-shadow-lg" id="manageTabsContent">
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

@include('modals.user.edit-boarding')
@include('modals.user.edit-appointment')
@include('modals.user.add-boarding')
@include('modals.user.add-appointment')
@include('modals.user.add-pet')
@include('modals.user.view-boarding')
@include('modals.user.view-appointment')
@include('modals.user.payment-modal')

@push('scripts')
<script>
    // Trigger contentChanged event to ensure modal scripts are loaded
    document.dispatchEvent(new Event('contentChanged'));
    
    // Create a namespace for our manage page functionality
    window.ManagePage = window.ManagePage || {
        appointmentsTable: null,
        boardingsTable: null,

        // CRUD Functions
        viewAppointment: function(id) {
            if(typeof window.openAppointmentModal === 'function') {
                window.openAppointmentModal(id);
            } else {
                console.error("openAppointmentModal function not found");
                Swal.fire({
                    title: 'Error',
                    text: 'Could not open appointment details. Please try again later.',
                    icon: 'error',
                    confirmButtonColor: '#24CFF4',
                });
            }
        },

        editAppointment: function(id) {
            if(typeof window.openEditAppointmentModal === 'function') {
                window.openEditAppointmentModal(id);
            } else {
                console.error("openEditAppointmentModal function not found");
                Swal.fire({
                    title: 'Error',
                    text: 'Could not fetch appointment details. Please try again later.',
                    icon: 'error',
                    confirmButtonColor: '#24CFF4',
                });
            }
        },

        cancelAppointment: function(id) {
            // First, get the appointment details to check the date
            fetch(`{{ route('user.appointments.show', '') }}/${id}`, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success && data.appointment) {
                    const appointment = data.appointment;
                    const appointmentDate = new Date(appointment.date);
                    const today = new Date();
                    const timeDiff = appointmentDate.getTime() - today.getTime();
                    const daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));
                    
                    let warningMessage = '';
                    let canCancel = daysDiff >= 3;
                    
                    if (canCancel) {
                        warningMessage = `
                            <div class="tw-text-left tw-mb-4">
                                <p class="tw-text-blue-400 tw-font-bold tw-mb-2">📅 Cancellation Policy</p>
                                <p class="tw-mb-2">Appointments can be cancelled up to 3 days before the scheduled date.</p>
                                <p class="tw-mb-2 tw-text-green-600 tw-font-medium">✓ You have ${daysDiff} day(s) remaining to cancel this appointment.</p>
                                <p class="tw-mb-2">This will permanently cancel your appointment scheduled for ${appointmentDate.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })}.</p>
                            </div>
                        `;
                    } else {
                        warningMessage = `
                            <div class="tw-text-left tw-mb-4">
                                <p class="tw-text-red-400 tw-font-bold tw-mb-2">❌ Cannot Cancel</p>
                                <p class="tw-mb-2">Appointments can only be cancelled up to 3 days before the scheduled date.</p>
                                <p class="tw-mb-2 tw-text-red-600 tw-font-medium">Your appointment is in ${daysDiff} day(s), which is less than the required 3-day notice.</p>
                                <p class="tw-mb-2">Please contact our office directly for assistance with cancellations within 3 days.</p>
                            </div>
                        `;
                    }
                    
                    if (!canCancel) {
                        // Show info modal for appointments that can't be cancelled
                        Swal.fire({
                            title: 'Cancellation Not Allowed',
                            html: warningMessage,
                            icon: 'info',
                            confirmButtonColor: '#24CFF4',
                            confirmButtonText: 'I Understand'
                        });
                        return;
                    }
                    
                    // Show cancellation confirmation for appointments that can be cancelled
                    Swal.fire({
                        title: 'Cancel this appointment?',
                        html: `
                            ${warningMessage}
                            <input type="password" id="cancel-password" class="swal2-input" placeholder="Enter your password" style="margin: 10px 0;">
                        `,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#24CFF4',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, cancel it!',
                        preConfirm: () => {
                            const password = document.getElementById('cancel-password').value;
                            if (!password) {
                                Swal.showValidationMessage('Please enter your password');
                                return false;
                            }
                            return password;
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Make AJAX call to cancel
                            fetch("{{ route('user.appointments.cancel', ['id' => ':id']) }}".replace(':id', id), {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({
                                    user_password: result.value
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if(data.success) {
                                    this.appointmentsTable.ajax.reload();
                                    Swal.fire({
                                        title: 'Cancelled!',
                                        text: 'Your appointment has been cancelled.',
                                        icon: 'success',
                                        confirmButtonColor: '#24CFF4'
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: data.message || 'Failed to cancel appointment.',
                                        icon: 'error',
                                        confirmButtonColor: '#24CFF4'
                                    });
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'An error occurred while cancelling the appointment.',
                                    icon: 'error',
                                    confirmButtonColor: '#24CFF4'
                                });
                            });
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Could not load appointment details.',
                        icon: 'error',
                        confirmButtonColor: '#24CFF4'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error!',
                    text: 'An error occurred while loading appointment details.',
                    icon: 'error',
                    confirmButtonColor: '#24CFF4'
                });
            });
        },

        // Similar functions for boarding...
        viewBoarding: function(id) {
            if(typeof window.openViewBoardingModal === 'function') {
                window.openViewBoardingModal(id);
            } else {
                console.error("openViewBoardingModal function not found");
                Swal.fire({
                    title: 'Error',
                    text: 'Could not fetch boarding details. Please try again later.',
                    icon: 'error',
                    confirmButtonColor: '#24CFF4',
                });
            }
        },

        editBoarding: function(id) {
            if(typeof window.openEditBoardingModal === 'function') {
                window.openEditBoardingModal(id);
            } else {
                console.error("openEditBoardingModal function not found");
                Swal.fire({
                    title: 'Error',
                    text: 'Could not fetch boarding details. Please try again later.',
                    icon: 'error',
                    confirmButtonColor: '#24CFF4',
                });
            }
        },

        cancelBoarding: function(id) {
            // First, get the boarding details to check the date
            fetch(`{{ route('user.boardings.show', '') }}/${id}`, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success && data.boarding) {
                    const boarding = data.boarding;
                    const startDate = new Date(boarding.start_date);
                    const today = new Date();
                    const timeDiff = startDate.getTime() - today.getTime();
                    const daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));
                    
                    let warningMessage = '';
                    let canCancel = daysDiff >= 3;
                    
                    if (canCancel) {
                        warningMessage = `
                            <div class="tw-text-left tw-mb-4">
                                <p class="tw-text-blue-400 tw-font-bold tw-mb-2">📅 Cancellation Policy</p>
                                <p class="tw-mb-2">Boarding reservations can be cancelled up to 3 days before the start date.</p>
                                <p class="tw-mb-2 tw-text-green-600 tw-font-medium">✓ You have ${daysDiff} day(s) remaining to cancel this boarding.</p>
                                <p class="tw-mb-2">This will permanently cancel your boarding reservation starting ${startDate.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })}.</p>
                            </div>
                        `;
                    } else {
                        warningMessage = `
                            <div class="tw-text-left tw-mb-4">
                                <p class="tw-text-red-400 tw-font-bold tw-mb-2">❌ Cannot Cancel</p>
                                <p class="tw-mb-2">Boarding reservations can only be cancelled up to 3 days before the start date.</p>
                                <p class="tw-mb-2 tw-text-red-600 tw-font-medium">Your boarding starts in ${daysDiff} day(s), which is less than the required 3-day notice.</p>
                                <p class="tw-mb-2">Please contact our office directly for assistance with cancellations within 3 days.</p>
                            </div>
                        `;
                    }
                    
                    if (!canCancel) {
                        // Show info modal for boardings that can't be cancelled
                        Swal.fire({
                            title: 'Cancellation Not Allowed',
                            html: warningMessage,
                            icon: 'info',
                            confirmButtonColor: '#24CFF4',
                            confirmButtonText: 'I Understand'
                        });
                        return;
                    }
                    
                    // Show cancellation confirmation for boardings that can be cancelled
                    Swal.fire({
                        title: 'Cancel this boarding?',
                        html: `
                            ${warningMessage}
                            <input type="password" id="cancel-boarding-password" class="swal2-input" placeholder="Enter your password" style="margin: 10px 0;">
                        `,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#24CFF4',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, cancel it!',
                        preConfirm: () => {
                            const password = document.getElementById('cancel-boarding-password').value;
                            if (!password) {
                                Swal.showValidationMessage('Please enter your password');
                                return false;
                            }
                            return password;
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Make AJAX call to cancel
                            fetch("{{ route('user.boardings.cancel', ['id' => ':id']) }}".replace(':id', id), {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({
                                    user_password: result.value
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if(data.success) {
                                    this.boardingsTable.ajax.reload();
                                    Swal.fire({
                                        title: 'Cancelled!',
                                        text: 'Your boarding has been cancelled.',
                                        icon: 'success',
                                        confirmButtonColor: '#24CFF4'
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: data.message || 'Failed to cancel boarding.',
                                        icon: 'error',
                                        confirmButtonColor: '#24CFF4'
                                    });
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'An error occurred while cancelling the boarding.',
                                    icon: 'error',
                                    confirmButtonColor: '#24CFF4'
                                });
                            });
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Could not load boarding details.',
                        icon: 'error',
                        confirmButtonColor: '#24CFF4'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error!',
                    text: 'An error occurred while loading boarding details.',
                    icon: 'error',
                    confirmButtonColor: '#24CFF4'
                });
            });
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
                    { 
                        data: 'date', 
                        width: '15%',
                        render: function(data) {
                            const date = new Date(data);
                            return date.toLocaleDateString('en-US', { 
                                year: 'numeric', 
                                month: 'short', 
                                day: 'numeric' 
                            });
                        }
                    },
                    { 
                        data: 'time', 
                        width: '10%',
                        render: function(data) {
                            // Convert 24-hour time to 12-hour format
                            const [hours, minutes] = data.split(':');
                            const hour = parseInt(hours);
                            const ampm = hour >= 12 ? 'PM' : 'AM';
                            const hour12 = hour % 12 || 12;
                            return `${hour12}:${minutes} ${ampm}`;
                        }
                    },
                    { data: 'service.name', width: '20%' },
                    { 
                        data: 'status',
                        width: '15%',
                        render: function(data) {
                            let colorClass = data === 'Confirmed' ? 'tw-bg-green-100 tw-text-green-800' :
                                        data === 'Completed' ? 'tw-bg-gray-100 tw-text-gray-800' :
                                        data === 'Pending' ? 'tw-bg-yellow-100 tw-text-yellow-800' :
                                        data === 'Active' ? 'tw-bg-orange-100 tw-text-orange-800' :
                                        'tw-bg-red-100 tw-text-red-800';
                            return `<span class="tw-px-3 tw-py-1 tw-rounded-full tw-text-sm ${colorClass}">${data}</span>`;
                        }
                    },
                    {
                        data: null,
                        width: '20%',
                        render: function(data) {
                            // If appointment is completed or cancelled, show only view button
                            if (data.status === 'Completed' || data.status === 'Cancelled') {
                                return `
                                    <div class="tw-flex tw-gap-2 tw-justify-center">
                                        <button onclick="ManagePage.viewAppointment(${data.appointmentID})" 
                                                class="tw-text-blue-500 hover:tw-text-blue-700">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                `;
                            }
                            // Otherwise, show all action buttons
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
                                    <button onclick="ManagePage.cancelAppointment(${data.appointmentID})" 
                                            class="tw-text-red-500 hover:tw-text-red-700">
                                        <i class="fas fa-ban"></i>
                                    </button>
                                </div>
                            `;
                        }
                    }
                ],
                createdRow: function(row, data, dataIndex) {
                    // Highlight upcoming appointments (within 3 days from now)
                    if (data.status === 'Confirmed') {
                        const today = new Date();
                        today.setHours(0, 0, 0, 0);
                        const appointmentDate = new Date(data.date);
                        const daysUntilAppointment = Math.ceil((appointmentDate - today) / (1000 * 60 * 60 * 24));
                        
                        if (daysUntilAppointment >= 0 && daysUntilAppointment <= 3) {
                            // Upcoming appointments (within 3 days) - light blue background
                            $(row).addClass('tw-bg-blue-50');
                        }
                    }
                }
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
                    { 
                        data: 'start_date', 
                        width: '15%',
                        render: function(data) {
                            const date = new Date(data);
                            return date.toLocaleDateString('en-US', { 
                                year: 'numeric', 
                                month: 'short', 
                                day: 'numeric' 
                            });
                        }
                    },
                    { 
                        data: 'end_date', 
                        width: '15%',
                        render: function(data) {
                            const date = new Date(data);
                            return date.toLocaleDateString('en-US', { 
                                year: 'numeric', 
                                month: 'short', 
                                day: 'numeric' 
                            });
                        }
                    },
                    { 
                        data: 'status',
                        width: '15%',
                        render: function(data) {
                            let colorClass = data === 'Confirmed' ? 'tw-bg-green-100 tw-text-green-800' :
                                        data === 'Active' ? 'tw-bg-orange-100 tw-text-orange-800' :
                                        data === 'Completed' ? 'tw-bg-gray-100 tw-text-gray-800' :
                                        data === 'Cancelled' ? 'tw-bg-red-100 tw-text-red-800' :
                                        'tw-bg-yellow-100 tw-text-yellow-800';
                            return `<span class="tw-px-3 tw-py-1 tw-rounded-full tw-text-sm ${colorClass}">${data}</span>`;
                        }
                    },
                    {
                        data: null,
                        render: function(data) {
                            // If boarding is completed or cancelled, show only view button
                            if (data.status === 'Completed' || data.status === 'Cancelled') {
                                return `
                                    <div class="tw-flex tw-gap-2 tw-justify-center">
                                        <button onclick="ManagePage.viewBoarding(${data.boardingID})" 
                                                class="tw-text-blue-500 hover:tw-text-blue-700">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                `;
                            }
                            // Otherwise, show all action buttons
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
                                    <button onclick="ManagePage.cancelBoarding(${data.boardingID})" 
                                            class="tw-text-red-500 hover:tw-text-red-700">
                                        <i class="fas fa-ban"></i>
                                    </button>
                                </div>
                            `;
                        }
                    }
                ],
                createdRow: function(row, data, dataIndex) {
                    // Highlight upcoming bookings (within 7 days from now) and active bookings
                    if (data.status === 'Active') {
                        // Active bookings - bright green background
                        $(row).addClass('tw-bg-green-50');
                    } else if (data.status === 'Confirmed') {
                        // Check if boarding starts within the next 7 days
                        const today = new Date();
                        today.setHours(0, 0, 0, 0);
                        const startDate = new Date(data.start_date);
                        const daysUntilStart = Math.ceil((startDate - today) / (1000 * 60 * 60 * 24));
                        
                        if (daysUntilStart >= 0 && daysUntilStart <= 7) {
                            // Upcoming bookings (within 7 days) - light blue background
                            $(row).addClass('tw-bg-blue-50');
                        }
                    }
                }
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
    
</script>
@endpush
@endsection
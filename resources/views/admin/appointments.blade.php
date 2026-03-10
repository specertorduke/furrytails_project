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
            @if(auth()->user()->hasPermission('appointments.create'))
            <button data-modal-target="adminAddAppointment-modal" data-modal-toggle="adminAddAppointment-modal" id="addAppointmentBtn" class="tw-bg-[#FF9666] tw-text-white tw-px-4 tw-py-2 tw-rounded-xl tw-transition-all tw-duration-300 hover:tw-shadow-lg hover:tw-opacity-90 tw-font-semibold active:tw-bg-orange-400">
                <i class="fas fa-calendar-plus tw-mr-2"></i> Add Appointment
            </button>
            @endif
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
    <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-4 tw-mb-6 tw-overflow-x-auto">
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
    var appointmentPerms = {
        canCreate:    {{ auth()->user()->hasPermission('appointments.create') ? 'true' : 'false' }},
        canEdit:      {{ auth()->user()->hasPermission('appointments.edit')   ? 'true' : 'false' }},
        canCancel:    {{ auth()->user()->hasPermission('appointments.cancel') ? 'true' : 'false' }},
        canMarkPaid:  {{ auth()->user()->hasPermission('appointments.edit')   ? 'true' : 'false' }},
    };
    // Create a namespace for our appointments page functionality
    window.AppointmentsPage = Object.assign(window.AppointmentsPage || {}, {
        appointmentsTable: null,

        reloadTable: function(table, url) {
            fetch(url, { headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' } })
                .then(r => r.json())
                .then(json => { table.clear().rows.add(json.data || []).draw(false); })
                .catch(err => console.error('Table reload error:', err));
        },
        // CRUD Functions
        viewAppointment: function(id) {
            console.log('View appointment', id);
            if (typeof window.openAppointmentModal === 'function') {
                window.openAppointmentModal(id);
            } else {
                console.error('openAppointmentModal function not found');
            }
        },

        markAppointmentPaid: function(id, actionType, amount) {
            const isBalance = actionType === 'balance';
            const isGcashVerification = actionType === 'verify-gcash';
            const title    = isBalance ? 'Collect Remaining Balance' : (isGcashVerification ? 'Verify GCash Payment' : 'Mark Cash Payment as Collected');
            const text     = isBalance
                ? `Confirm collection of ₱${parseFloat(amount).toFixed(2)} cash (remaining balance) from the client?`
                : (isGcashVerification
                    ? `Confirm that the submitted GCash payment of ₱${parseFloat(amount).toFixed(2)} has been received?`
                    : `Confirm receipt of ₱${parseFloat(amount).toFixed(2)} cash from the client?`);

            Swal.fire({
                title: title,
                text: text,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#22c55e',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, confirm',
                background: '#374151',
                color: '#fff'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch("{{ route('admin.appointments.mark-paid', ['id' => ':id']) }}".replace(':id', id), {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({})
                    })
                    .then(r => r.json())
                    .then(data => {
                        if (data.success) {
                            this.reloadTable(this.appointmentsTable, '{{ route("admin.appointments.data") }}');
                            Swal.fire({ title: 'Done!', text: data.message, icon: 'success', confirmButtonColor: '#FF9666', background: '#374151', color: '#fff' });
                        } else {
                            Swal.fire({ title: 'Error!', text: data.message || 'Failed to process payment.', icon: 'error', confirmButtonColor: '#FF9666', background: '#374151', color: '#fff' });
                        }
                    })
                    .catch(() => {
                        Swal.fire({ title: 'Error!', text: 'An error occurred.', icon: 'error', confirmButtonColor: '#FF9666', background: '#374151', color: '#fff' });
                    });
                }
            });
        },

        editAppointment: function(id) {
            console.log('Edit appointment', id);
            if (typeof window.openEditAppointmentModal === 'function') {
                window.openEditAppointmentModal(id);
            } else {
                console.error('openEditAppointmentModal function not found');
                Swal.fire({
                    title: 'Feature Not Available',
                    text: 'The edit appointment feature is not available at the moment.',
                    icon: 'warning',
                    confirmButtonColor: '#FF9666',
                    background: '#374151',
                    color: '#fff'
                });
            }
        },

        cancelAppointment: function(id) {
            // First, get the appointment details to check the date and show details
            fetch(`{{ route('admin.appointments.show', '') }}/${id}`, {
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
                    
                    // Format client name
                    const clientName = appointment.pet?.user ? 
                        `${appointment.pet.user.firstName} ${appointment.pet.user.lastName}` : 
                        'Unknown Client';
                    
                    // Format date and time
                    const formattedDate = appointmentDate.toLocaleDateString('en-US', { 
                        weekday: 'long', 
                        year: 'numeric', 
                        month: 'long', 
                        day: 'numeric' 
                    });
                    const formattedTime = new Date(`1970-01-01T${appointment.time}`).toLocaleTimeString('en-US', {
                        hour: 'numeric',
                        minute: '2-digit',
                        hour12: true
                    });
                    
                    let warningMessage = `
                        <div class="tw-text-left tw-mb-4">
                            <p class="tw-text-blue-400 tw-font-bold tw-mb-3">📅 Appointment Details</p>
                            <div class="tw-bg-gray-700 tw-text-white tw-p-3 tw-rounded-lg tw-mb-3">
                                <p class="tw-mb-1"><strong>Client:</strong> ${clientName}</p>
                                <p class="tw-mb-1"><strong>Pet:</strong> ${appointment.pet?.name || 'Unknown'} (${appointment.pet?.species || 'Unknown'})</p>
                                <p class="tw-mb-1"><strong>Service:</strong> ${appointment.service?.name || 'Unknown Service'}</p>
                                <p class="tw-mb-1"><strong>Date:</strong> ${formattedDate}</p>
                                <p class="tw-mb-1"><strong>Time:</strong> ${formattedTime}</p>
                                <p><strong>Status:</strong> ${appointment.status}</p>
                            </div>
                            
                            <p class="tw-text-yellow-400 tw-font-bold tw-mb-2">⚠️ Cancellation Policy</p>
                            <p class="tw-mb-2">Standard policy: Appointments should be cancelled at least 3 days in advance.</p>
                    `;
                    
                    if (daysDiff >= 3) {
                        warningMessage += `<p class="tw-mb-2 tw-text-green-600 tw-font-medium">✓ This appointment is ${daysDiff} day(s) away - within policy.</p>`;
                    } else if (daysDiff >= 0) {
                        warningMessage += `<p class="tw-mb-2 tw-text-yellow-600 tw-font-medium">⚠️ This appointment is ${daysDiff} day(s) away - less than recommended 3 days notice.</p>`;
                    } else {
                        warningMessage += `<p class="tw-mb-2 tw-text-red-600 tw-font-medium">⚠️ This appointment was ${Math.abs(daysDiff)} day(s) ago.</p>`;
                    }
                    
                    warningMessage += `
                            <p class="tw-mb-2">As an admin, you can cancel this appointment at any time, but please consider the client's situation.</p>
                        </div>
                    `;
                    
                    // Show cancellation confirmation
                    Swal.fire({
                        title: 'Cancel this appointment?',
                        html: `
                            ${warningMessage}
                        `,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#FF9666',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, cancel it!',
                        background: '#374151',
                        color: '#fff'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Make AJAX call to cancel
                            console.log("cancelling: " + id);
                            fetch("{{ route('admin.appointments.cancel', ['id' => ':id']) }}".replace(':id', id), {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({})
                            })
                            .then(response => response.json())
                            .then(data => {
                                if(data.success) {
                                    this.reloadTable(this.appointmentsTable, '{{ route("admin.appointments.data") }}');
                                    Swal.fire({
                                        title: 'Cancelled!',
                                        text: 'Appointment has been cancelled.',
                                        icon: 'success',
                                        confirmButtonColor: '#FF9666',
                                        background: '#374151',
                                        color: '#fff'
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: data.message || 'Failed to cancel appointment.',
                                        icon: 'error',
                                        confirmButtonColor: '#FF9666',
                                        background: '#374151',
                                        color: '#fff'
                                    });
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'An error occurred while cancelling the appointment.',
                                    icon: 'error',
                                    confirmButtonColor: '#FF9666',
                                    background: '#374151',
                                    color: '#fff'
                                });
                            });
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Could not load appointment details.',
                        icon: 'error',
                        confirmButtonColor: '#FF9666',
                        background: '#374151',
                        color: '#fff'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error!',
                    text: 'An error occurred while loading appointment details.',
                    icon: 'error',
                    confirmButtonColor: '#FF9666',
                    background: '#374151',
                    color: '#fff'
                });
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
                data: {!! $appointmentsJson !!},
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
                            const cancelBtn = appointmentPerms.canCancel && data.status !== 'Cancelled' && data.status !== 'Completed' ? 
                                `<button onclick="AppointmentsPage.cancelAppointment(${data.appointmentID})" class="tw-text-red-500 hover:tw-text-red-300" title="Cancel">
                                    <i class="fas fa-ban"></i>
                                </button>` : '';
                            const editBtn = appointmentPerms.canEdit ?
                                `<button onclick="AppointmentsPage.editAppointment(${data.appointmentID})" class="tw-text-yellow-500 hover:tw-text-yellow-300" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>` : '';

                            // Determine payment action needed
                            let markPaidBtn = '';
                            if (appointmentPerms.canMarkPaid && data.status !== 'Cancelled' && data.status !== 'Completed') {
                                const pmts = data.payments || [];
                                const latest = pmts.length ? pmts.reduce((a,b) => (a.paymentID > b.paymentID ? a : b)) : null;
                                const hasBalance = pmts.some(p => p.payment_type === 'balance');

                                if (latest && latest.payment_type === 'deposit' && latest.status === 'Completed' && !hasBalance) {
                                    // GCash deposit paid — still needs balance collected
                                    const bal = latest.total_cost
                                        ? parseFloat(latest.total_cost - latest.amount).toFixed(2)
                                        : parseFloat(latest.amount / 0.3 * 0.7).toFixed(2);
                                    markPaidBtn = `<button onclick="AppointmentsPage.markAppointmentPaid(${data.appointmentID},'balance',${bal})" class="tw-text-orange-400 hover:tw-text-orange-200" title="Collect Balance ₱${bal}"><i class="fas fa-hand-holding-usd"></i></button>`;
                                } else if (latest && latest.status === 'Pending') {
                                    const amt = parseFloat(latest.amount).toFixed(2);
                                    const actionType = latest.payment_method === 'GCash' ? 'verify-gcash' : 'cash';
                                    const title = latest.payment_method === 'GCash'
                                        ? `Verify GCash Payment ₱${amt}`
                                        : `Mark Cash Paid ₱${amt}`;
                                    markPaidBtn = `<button onclick="AppointmentsPage.markAppointmentPaid(${data.appointmentID},'${actionType}',${amt})" class="tw-text-green-500 hover:tw-text-green-300" title="${title}"><i class="fas fa-check-circle"></i></button>`;
                                }
                            }
                                
                            return `
                                <div class="tw-flex tw-space-x-3 tw-justify-center">
                                    <button onclick="AppointmentsPage.viewAppointment(${data.appointmentID})" class="tw-text-[#24CFF4] hover:tw-text-blue-300" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    ${editBtn}
                                    ${markPaidBtn}
                                    ${cancelBtn}
                                </div>
                            `;
                        },
                        orderable: false
                    }
                ],
                autoWidth: false,
                scrollX: false,
                dom: '<"tw-flex tw-flex-wrap tw-justify-between tw-items-center tw-gap-3 tw-mb-4"B<"tw-flex tw-items-center tw-gap-2"lf>>rt<"tw-flex tw-justify-between tw-items-center tw-mt-3"ip>',
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
    });

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

    window.initializeAppointmentsPageTables = function() {
        console.log('Content changed event received');
        // Make sure jQuery and DataTables are available
        if (window.jQuery && $.fn.DataTable) {
            AppointmentsPage.initializeTables();
        } else {
            console.error('jQuery or DataTables not available on content change');
        }
    };

    window.destroyAppointmentsPageTables = function() {
        console.log('Content will change event received');
        if (window.jQuery && $.fn.DataTable) {
            AppointmentsPage.destroyTables();
        }
    };

    document.removeEventListener('contentChanged', window.initializeAppointmentsPageTables);
    document.addEventListener('contentChanged', window.initializeAppointmentsPageTables);

    document.removeEventListener('contentWillChange', window.destroyAppointmentsPageTables);
    document.addEventListener('contentWillChange', window.destroyAppointmentsPageTables);

    if (document.getElementById('appointmentsTable') && window.jQuery && $.fn.DataTable) {
        AppointmentsPage.initializeTables();
    }
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
@endpush

<!-- modals -->
@include('modals.admin.admin-view-appointment')
@include('modals.admin.admin-add-appointment')
@include('modals.admin.admin-edit-appointment')
@include('modals.admin.admin-view-user')
@include('modals.admin.admin-view-pet')

@endsection

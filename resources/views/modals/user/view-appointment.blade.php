<!-- View Appointment Modal -->
<div id="viewAppointment-modal" tabindex="-1" aria-hidden="true" class="tw-hidden tw-fixed tw-top-0 tw-left-0 tw-right-0 tw-z-50 tw-w-full tw-p-4 tw-overflow-x-hidden tw-overflow-y-auto md:tw-inset-0 tw-h-full tw-max-h-full tw-flex tw-items-center tw-justify-center tw-backdrop-blur-sm tw-bg-black/30">
    <div class="tw-relative tw-w-full tw-max-w-2xl tw-max-h-full tw-animate-modal-entry">
        <!-- Modal content -->
        <div class="tw-relative tw-bg-white tw-rounded-2xl tw-shadow-lg tw-transform tw-transition-all">
            <!-- Modal header -->
            <div class="tw-flex tw-items-center tw-justify-between tw-p-4 md:tw-p-5 tw-border-b tw-rounded-t">
                <h3 class="tw-text-xl tw-font-semibold tw-text-gray-800">Appointment Details</h3>
                <button type="button" class="tw-bg-white tw-rounded-lg tw-text-sm tw-w-8 tw-h-8 tw-flex tw-justify-center tw-items-center tw-transition-all hover:tw-bg-gray-100" data-modal-toggle="viewAppointment-modal">
                    <svg class="tw-w-3 tw-h-3 tw-text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            
            <!-- Modal body -->
            <div class="tw-p-4 md:tw-p-5">
                <!-- Appointment Status Badge - Shown at the top for visibility -->
                <div class="tw-flex tw-justify-center tw-mb-5">
                    <div id="appointmentStatusBadge" class="tw-px-4 tw-py-2 tw-rounded-full tw-text-sm tw-font-medium">
                        <span id="statusText"></span>
                    </div>
                </div>

                <!-- Payment Status Section -->
                <div class="tw-flex tw-justify-center tw-mb-5" id="paymentStatusContainer">
                    <div id="paymentStatusBadge" class="tw-px-4 tw-py-2 tw-rounded-full tw-text-sm tw-font-medium tw-hidden">
                        <span id="paymentStatusText"></span>
                    </div>
                </div>

                <!-- Appointment Info Section -->
                <div class="tw-flex tw-flex-col md:tw-flex-row tw-gap-6">
                    <!-- Service Info Column -->
                    <div class="tw-flex tw-flex-col tw-items-center tw-bg-gray-50 tw-p-4 tw-rounded-xl tw-shadow-sm">
                        <div id="serviceIcon" class="tw-w-16 tw-h-16 tw-flex tw-items-center tw-justify-center tw-rounded-full tw-bg-blue-50 tw-mb-3">
                            <i class="fas fa-concierge-bell tw-text-5xl tw-text-[#24CFF4]"></i>
                        </div>
                        <h4 id="serviceName" class="tw-text-lg tw-font-medium tw-text-gray-800 tw-mb-1">Service Name</h4>
                        <p id="servicePrice" class="tw-text-[#20b9db] tw-font-bold">₱0.00</p>
                        
                        <div class="tw-mt-4 tw-w-full">
                            <div class="tw-flex tw-justify-between tw-items-center tw-mb-2">
                                <span class="tw-text-sm tw-text-gray-500">Date:</span>
                                <span id="appointmentDate" class="tw-text-sm tw-font-medium tw-text-gray-700">Not set</span>
                            </div>
                            <div class="tw-flex tw-justify-between tw-items-center">
                                <span class="tw-text-sm tw-text-gray-500">Time:</span>
                                <span id="appointmentTime" class="tw-text-sm tw-font-medium tw-text-gray-700">Not set</span>
                            </div>
                        </div>
                    </div>

                    <!-- Pet Details Column -->
                    <div class="tw-flex-1 tw-bg-gray-50 tw-rounded-xl tw-p-4 tw-shadow-sm">
                        <h4 class="tw-font-medium tw-text-gray-800 tw-mb-3">Pet Information</h4>
                        <div class="tw-flex tw-items-center tw-mb-4">
                            <div id="petImage" class="tw-w-10 tw-h-10 tw-rounded-full tw-bg-gray-200 tw-overflow-hidden tw-flex tw-items-center tw-justify-center tw-mr-3">
                                <i class="fas fa-paw tw-text-gray-400"></i>
                            </div>
                            <div>
                                <p id="petName" class="tw-font-medium tw-text-gray-800">Pet Name</p>
                                <div class="tw-flex tw-items-center tw-gap-2">
                                    <span id="petSpecies" class="tw-text-xs tw-px-2 tw-py-1 tw-rounded-full tw-bg-blue-100 tw-text-blue-800">Species</span>
                                    <span id="petBreed" class="tw-text-xs tw-text-gray-500">Breed</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Payment Details -->
                        <div id="paymentDetailsContainer" class="tw-border-t tw-border-gray-200 tw-pt-3 tw-mt-3">
                            <h5 class="tw-font-medium tw-text-gray-800 tw-mb-2">Payment Information</h5>
                            <div class="tw-flex tw-justify-between tw-items-center tw-mb-2">
                                <span class="tw-text-sm tw-text-gray-500">Payment Status:</span>
                                <span id="paymentCount" class="tw-text-sm tw-font-medium tw-text-gray-700">Loading...</span>
                            </div>
                            
                            <!-- Payments List -->
                            <div id="paymentsListContainer" class="tw-mt-2 tw-max-h-32 tw-overflow-y-auto"></div>
                        </div>
                        
                        <!-- Before/After Images for Grooming -->
                        <div id="groomingSection" class="tw-hidden tw-border-t tw-border-gray-200 tw-pt-3 tw-mt-3">
                            <h5 class="tw-font-medium tw-text-gray-800 tw-mb-2">Grooming Photos</h5>
                            <div class="tw-grid tw-grid-cols-2 tw-gap-3">
                                <div id="beforeImageContainer" class="tw-text-center">
                                    <span class="tw-text-xs tw-text-gray-500 tw-block tw-mb-1">Before</span>
                                    <div class="tw-h-24 tw-bg-gray-100 tw-rounded tw-flex tw-items-center tw-justify-center">
                                        <span class="tw-text-gray-400 tw-text-xs">No image</span>
                                    </div>
                                </div>
                                <div id="afterImageContainer" class="tw-text-center">
                                    <span class="tw-text-xs tw-text-gray-500 tw-block tw-mb-1">After</span>
                                    <div class="tw-h-24 tw-bg-gray-100 tw-rounded tw-flex tw-items-center tw-justify-center">
                                        <span class="tw-text-gray-400 tw-text-xs">No image</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Timestamps -->
                        <div class="tw-text-xs tw-text-gray-500 tw-mt-4">
                            <div>Created: <span id="appointmentCreatedAt">Unknown</span></div>
                            <div id="appointmentUpdatedBlock" class="tw-hidden">
                                Last updated: <span id="appointmentUpdatedAt">Unknown</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Actions Section -->
                <div class="tw-flex tw-justify-between tw-mt-6 tw-pt-4 tw-border-t tw-border-gray-200">
                    <div>
                        <!-- Empty space to keep flex layout balanced -->
                    </div>
                    
                    <div class="tw-flex tw-gap-2">
                        <!-- Edit button -->
                        <button id="editAppointmentBtn" class="tw-bg-gray-100 tw-text-gray-700 tw-px-4 tw-py-2 tw-rounded-lg tw-font-medium tw-transition-all hover:tw-bg-gray-200">
                            <i class="fas fa-edit tw-mr-2"></i>Edit
                        </button>
                        
                        <!-- Cancel button -->
                        <button id="cancelAppointmentBtn" class="tw-bg-red-50 tw-text-red-600 tw-px-4 tw-py-2 tw-rounded-lg tw-font-medium tw-transition-all hover:tw-bg-red-100 tw-hidden">
                            <i class="fas fa-times-circle tw-mr-2"></i>Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
['DOMContentLoaded', 'contentChanged'].forEach(eventName => {
    document.addEventListener(eventName, function() {    
        // Global variable to store current appointment data
        window.currentAppointmentData = null;
        
        // Function to open appointment modal with data
        window.openAppointmentModal = function(appointmentId) {
            // Show loading state
            const viewAppointmentModal = document.getElementById('viewAppointment-modal');
            if (!viewAppointmentModal) {
                console.error('View appointment modal not found');
                return;
            }
            
            // Show modal with loading indicator
            viewAppointmentModal.classList.remove('tw-hidden');
            
            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            // Fetch appointment data - adjust the route as needed for user view
            fetch("{{ route('user.appointments.show', ['id' => ':appointmentId']) }}".replace(':appointmentId', appointmentId), {
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to fetch appointment data');
                }
                return response.json();
            })
            .then(data => {
                // Store the appointment data globally
                window.currentAppointmentData = data.appointment;
                populateAppointmentData(data.appointment);
            })
            .catch(error => {
                console.error('Error fetching appointment:', error);
                Swal.fire({
                    title: 'Error',
                    text: 'Failed to load appointment details.',
                    icon: 'error',
                    confirmButtonColor: '#24CFF4'
                });
                viewAppointmentModal.classList.add('tw-hidden');
            });
        };
        
        // Function to populate appointment data in the modal
        function populateAppointmentData(appointment) {
            console.log("Populating appointment data:", appointment);
            
            // Set appointment date and time
            document.getElementById('appointmentDate').textContent = formatDate(appointment.date);
            document.getElementById('appointmentTime').textContent = formatTime(appointment.time);
            
            // Set service information
            if (appointment.service) {
                document.getElementById('serviceName').textContent = appointment.service.name;
                const price = parseFloat(appointment.service.price);
                document.getElementById('servicePrice').textContent = '₱' + (isNaN(price) ? '0.00' : price.toFixed(2));
            }
            
            // Set pet information
            if (appointment.pet) {
                document.getElementById('petName').textContent = appointment.pet.name;
                document.getElementById('petSpecies').textContent = appointment.pet.species;
                document.getElementById('petBreed').textContent = appointment.pet.breed;
                
                // Set pet image if available
                const petImage = document.getElementById('petImage');
                if (appointment.pet.petImage) {
                    let imageUrl = "{{ asset('') }}" + (appointment.pet.petImage.startsWith('storage/') 
                        ? appointment.pet.petImage 
                        : 'storage/' + appointment.pet.petImage);
                    
                    petImage.innerHTML = `<img src="${imageUrl}" alt="${appointment.pet.name}" class="tw-h-full tw-w-full tw-object-cover">`;
                } else {
                    // Default icon based on species
                    let speciesIcon = '<i class="fas fa-paw tw-text-sm tw-text-gray-500"></i>';
                    
                    if (appointment.pet.species && appointment.pet.species.toLowerCase() === 'dog') {
                        speciesIcon = '<i class="fas fa-dog tw-text-sm tw-text-gray-500"></i>';
                    } else if (appointment.pet.species && appointment.pet.species.toLowerCase() === 'cat') {
                        speciesIcon = '<i class="fas fa-cat tw-text-sm tw-text-gray-500"></i>';
                    }
                    
                    petImage.innerHTML = speciesIcon;
                }

                
            }
            
            // Set status badge and buttons based on current status
            setStatusDisplay(appointment.status);
            
            // Set creation and update timestamps
            if (appointment.created_at) {
                document.getElementById('appointmentCreatedAt').textContent = formatDateTime(appointment.created_at);
            }
            
            if (appointment.updated_at && appointment.updated_at !== appointment.created_at) {
                document.getElementById('appointmentUpdatedBlock').classList.remove('tw-hidden');
                document.getElementById('appointmentUpdatedAt').textContent = formatDateTime(appointment.updated_at);
            } else {
                document.getElementById('appointmentUpdatedBlock').classList.add('tw-hidden');
            }

            // Handle payment information if available
            if (appointment.payments && appointment.payments.length > 0) {
                // Filter payments - only show completed cash payments or any non-cash payments
                const validPayments = appointment.payments.filter(payment => 
                    payment.payment_method !== 'Cash' || payment.status === 'Completed'
                );
                
                if (validPayments.length > 0) {
                    document.getElementById('paymentStatusContainer').classList.remove('tw-hidden');
                    document.getElementById('paymentStatusBadge').classList.remove('tw-hidden');
                    
                    // Get the latest valid payment
                    const latestPayment = validPayments[0];
                    const paymentStatusEl = document.getElementById('paymentStatusText');
                    
                    paymentStatusEl.innerHTML = '<i class="fas fa-credit-card tw-mr-2"></i>' + latestPayment.status;
                    const paymentStatusBadge = document.getElementById('paymentStatusBadge');
                    
                    // Style the payment status badge
                    const paymentStatusClass = getPaymentStatusClass(latestPayment.status);
                    paymentStatusBadge.className = `tw-px-4 tw-py-2 tw-rounded-full tw-text-sm tw-font-medium ${paymentStatusClass}`;
                    
                    // Populate payment details
                    document.getElementById('paymentCount').textContent = `${validPayments.length} payment(s)`;
                    
                    // Create payment list items
                    const paymentsContainer = document.getElementById('paymentsListContainer');
                    paymentsContainer.innerHTML = '';
                    
                    validPayments.forEach(payment => {
                        const paymentItem = document.createElement('div');
                        paymentItem.className = 'tw-flex tw-justify-between tw-items-center tw-py-1 tw-border-b tw-border-gray-100 tw-text-sm';
                        
                        // Parse amount as float before using toFixed
                        const amount = parseFloat(payment.amount);
                        
                        paymentItem.innerHTML = `
                            <span>${payment.payment_method} - ${formatDateTime(payment.created_at)}</span>
                            <span class="tw-font-medium">₱${isNaN(amount) ? '0.00' : amount.toFixed(2)}</span>
                        `;
                        
                        paymentsContainer.appendChild(paymentItem);
                    });
                } else {
                    document.getElementById('paymentStatusContainer').classList.add('tw-hidden');
                    document.getElementById('paymentCount').textContent = 'No valid payments';
                }
            } else {
                document.getElementById('paymentStatusContainer').classList.add('tw-hidden');
                document.getElementById('paymentCount').textContent = 'No payments';
            }

            // Show grooming images if available
            if ((appointment.before_image || appointment.after_image) && appointment.service && appointment.service.name.toLowerCase().includes('groom')) {
                document.getElementById('groomingSection').classList.remove('tw-hidden');
                
                if (appointment.before_image) {
                    const beforeContainer = document.getElementById('beforeImageContainer');
                    beforeContainer.innerHTML = `
                        <span class="tw-text-xs tw-text-gray-500 tw-block tw-mb-1">Before</span>
                        <div class="tw-h-24 tw-bg-gray-100 tw-rounded tw-overflow-hidden">
                            <img src="{{ asset('storage') }}/${appointment.before_image}" 
                            alt="Before grooming" class="tw-w-full tw-h-full tw-object-cover"/>
                        </div>
                    `;
                }
                
                if (appointment.after_image) {
                    const afterContainer = document.getElementById('afterImageContainer');
                    afterContainer.innerHTML = `
                        <span class="tw-text-xs tw-text-gray-500 tw-block tw-mb-1">After</span>
                        <div class="tw-h-24 tw-bg-gray-100 tw-rounded tw-overflow-hidden">
                            <img src="{{ asset('storage') }}/${appointment.after_image}" 
                            alt="After grooming" class="tw-w-full tw-h-full tw-object-cover"/>
                        </div>
                    `;
                }
            } else {
                document.getElementById('groomingSection').classList.add('tw-hidden');
            }
        }
        
        // Set status badge and action buttons based on current status
        function setStatusDisplay(status) {
            const statusBadge = document.getElementById('appointmentStatusBadge');
            const statusText = document.getElementById('statusText');
            const editBtn = document.getElementById('editAppointmentBtn');
            const cancelBtn = document.getElementById('cancelAppointmentBtn');
            
            // Reset all styling first
            statusBadge.className = 'tw-px-4 tw-py-2 tw-rounded-full tw-text-sm tw-font-medium';
            
            // Configure based on status
            switch (status) {
                case 'Pending':
                    statusBadge.classList.add('tw-bg-yellow-100', 'tw-text-yellow-800');
                    statusText.innerHTML = '<i class="fas fa-clock tw-mr-2"></i>Pending';
                    editBtn.classList.remove('tw-hidden');
                    cancelBtn.classList.remove('tw-hidden');
                    break;
                    
                case 'Confirmed':
                    statusBadge.classList.add('tw-bg-blue-100', 'tw-text-blue-800');
                    statusText.innerHTML = '<i class="fas fa-check-circle tw-mr-2"></i>Confirmed';
                    editBtn.classList.add('tw-hidden');
                    cancelBtn.classList.remove('tw-hidden');
                    break;
                    
                case 'Active':
                    statusBadge.classList.add('tw-bg-green-100', 'tw-text-green-800');
                    statusText.innerHTML = '<i class="fas fa-spinner fa-spin tw-mr-2"></i>In Progress';
                    editBtn.classList.add('tw-hidden');
                    cancelBtn.classList.add('tw-hidden');
                    break;
                    
                case 'Completed':
                    statusBadge.classList.add('tw-bg-green-100', 'tw-text-green-800');
                    statusText.innerHTML = '<i class="fas fa-check-double tw-mr-2"></i>Completed';
                    editBtn.classList.add('tw-hidden');
                    cancelBtn.classList.add('tw-hidden');
                    break;
                    
                case 'Cancelled':
                    statusBadge.classList.add('tw-bg-red-100', 'tw-text-red-800');
                    statusText.innerHTML = '<i class="fas fa-times-circle tw-mr-2"></i>Cancelled';
                    editBtn.classList.add('tw-hidden');
                    cancelBtn.classList.add('tw-hidden');
                    break;
                    
                default:
                    statusBadge.classList.add('tw-bg-gray-100', 'tw-text-gray-800');
                    statusText.innerHTML = '<i class="fas fa-question-circle tw-mr-2"></i>' + status;
                    editBtn.classList.add('tw-hidden');
                    cancelBtn.classList.add('tw-hidden');
            }
        }
        
        // Handle cancel button click
        document.getElementById('cancelAppointmentBtn').addEventListener('click', function() {
            if (!window.currentAppointmentData) return;
            
            Swal.fire({
                title: 'Cancel Appointment?',
                text: 'Are you sure you want to cancel this appointment?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#24CFF4',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, cancel it!',
                cancelButtonText: 'No, keep it'
            }).then((result) => {
                if (result.isConfirmed) {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    
                    // Call the API to cancel the appointment
                    fetch("{{ route('user.appointments.cancel', ['id' => ':id']) }}".replace(':id', window.currentAppointmentData.appointmentID), {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Failed to cancel appointment');
                        }
                        return response.json();
                    })
                    .then(data => {
                        Swal.fire({
                            title: 'Cancelled!',
                            text: 'Your appointment has been cancelled.',
                            icon: 'success',
                            confirmButtonColor: '#24CFF4'
                        });
                        
                        // Update status in the current view
                        if (window.currentAppointmentData) {
                            window.currentAppointmentData.status = 'Cancelled';
                            setStatusDisplay('Cancelled');
                        }
                        
                        // Refresh data tables if they exist
                        if (window.ManagePage && typeof window.ManagePage.refreshTables === 'function') {
                            window.ManagePage.refreshTables();
                        }
                        if (window.DashboardPage && typeof window.DashboardPage.initializeTables === 'function') {
                            window.DashboardPage.initializeTables();
                        }
                    })
                    .catch(error => {
                        console.error('Error cancelling appointment:', error);
                        Swal.fire({
                            title: 'Error',
                            text: 'Failed to cancel the appointment.',
                            icon: 'error',
                            confirmButtonColor: '#24CFF4'
                        });
                    });
                }
            });
        });
        
        // Setup edit appointment button handler
        document.getElementById('editAppointmentBtn').addEventListener('click', function() {
            document.getElementById('viewAppointment-modal').classList.add('tw-hidden');
            if(typeof window.openEditAppointmentModal === 'function') {
                window.openEditAppointmentModal(window.currentAppointmentData.appointmentID);
            } else {
                console.error("openEditAppointmentModal function not found");
                Swal.fire({
                    title: 'Error',
                    text: 'Could not fetch appointment details. Please try again later.',
                    icon: 'error',
                    confirmButtonColor: '#24CFF4',
                });
            }
        });
        
        // Close modal handler
        const modalToggle = document.querySelector('[data-modal-toggle="viewAppointment-modal"]');
        if (modalToggle) {
            modalToggle.addEventListener('click', function() {
                document.getElementById('viewAppointment-modal').classList.add('tw-hidden');
            });
        }
        
        // Helper function for payment status styling
        function getPaymentStatusClass(status) {
            switch (status) {
                case 'Completed':
                    return 'tw-bg-green-100 tw-text-green-800';
                case 'Pending':
                    return 'tw-bg-yellow-100 tw-text-yellow-800';
                case 'Failed':
                    return 'tw-bg-red-100 tw-text-red-800';
                default:
                    return 'tw-bg-gray-100 tw-text-gray-800';
            }
        }
        
        // Utility function to format date
        function formatDate(dateString) {
            if (!dateString) return 'Not specified';
            
            const date = new Date(dateString);
            return date.toLocaleDateString('en-US', { 
                weekday: 'long',
                year: 'numeric', 
                month: 'long', 
                day: 'numeric'
            });
        }
        
        // Utility function to format time
        function formatTime(timeString) {
            if (!timeString) return 'Not specified';
            
            const [hours, minutes] = timeString.split(':');
            const time = new Date();
            time.setHours(parseInt(hours, 10));
            time.setMinutes(parseInt(minutes, 10));
            
            return time.toLocaleTimeString('en-US', {
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            });
        }
        
        // Utility function to format date and time together
        function formatDateTime(dateTimeString) {
            if (!dateTimeString) return 'Not specified';
            
            const date = new Date(dateTimeString);
            return date.toLocaleDateString('en-US', {
                month: 'short',
                day: 'numeric', 
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            });
        }
    });
});
</script>
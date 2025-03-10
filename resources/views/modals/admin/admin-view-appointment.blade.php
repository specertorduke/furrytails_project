<!-- View Appointment Modal -->
<div id="viewAppointment-modal" tabindex="-1" aria-hidden="true" class="tw-hidden tw-fixed tw-top-0 tw-left-0 tw-right-0 tw-z-50 tw-w-full tw-p-4 tw-overflow-x-hidden tw-overflow-y-auto md:tw-inset-0 tw-h-full tw-max-h-full tw-flex tw-items-center tw-justify-center tw-backdrop-blur-sm tw-bg-black/60">
    <div class="tw-relative tw-w-full tw-max-w-2xl tw-max-h-full tw-animate-modal-entry">
        <!-- Modal content -->
        <div class="tw-relative tw-bg-gray-800 tw-rounded-lg tw-shadow-sm tw-transform tw-transition-all">
            <!-- Modal header -->
            <div class="tw-flex tw-items-center tw-justify-between tw-p-4 md:tw-p-5 tw-border-b tw-rounded-t tw-border-gray-700">
                <h3 class="tw-text-lg tw-font-semibold tw-text-white">Appointment Details</h3>
                <button type="button" class="tw-text-gray-400 tw-bg-transparent tw-hover:tw-bg-gray-700 tw-hover:tw-text-white tw-rounded-lg tw-text-sm tw-w-8 tw-h-8 ms-auto tw-inline-flex tw-justify-center tw-items-center" data-modal-toggle="viewAppointment-modal">
                    <svg class="tw-w-3 tw-h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
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
                        <!-- Status will be set via JavaScript -->
                        <span id="statusText">Loading...</span>
                    </div>
                </div>

                <!-- Appointment Info Section -->
                <div class="tw-flex tw-flex-col md:tw-flex-row tw-gap-6">
                    <!-- Service Info Column -->
                    <div class="tw-flex tw-flex-col tw-items-center">
                        <div id="serviceIcon" class="tw-h-32 tw-w-32 tw-rounded-full tw-bg-gray-700 tw-flex tw-items-center tw-justify-center tw-overflow-hidden">
                            <!-- Icon will be set via JavaScript -->
                            <i class="fas fa-concierge-bell tw-text-4xl tw-text-gray-500"></i>
                        </div>
                        <p id="serviceName" class="tw-mt-3 tw-text-lg tw-font-semibold tw-text-white">Loading...</p>
                        <p id="servicePrice" class="tw-text-sm tw-text-gray-400"></p>
                    </div>
                    
                    <!-- Appointment Details Column -->
                    <div class="tw-flex-1">
                        <h4 class="tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-2">Appointment Details</h4>
                        
                        <!-- Date and Time -->
                        <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-4 tw-mb-4">
                            <div>
                                <p class="tw-text-xs tw-text-gray-400">Date</p>
                                <p id="appointmentDate" class="tw-text-sm tw-text-white"></p>
                            </div>
                            <div>
                                <p class="tw-text-xs tw-text-gray-400">Time</p>
                                <p id="appointmentTime" class="tw-text-sm tw-text-white"></p>
                            </div>
                        </div>
                        
                        <!-- Pet Information -->
                        <div class="tw-mt-6 tw-p-3 tw-bg-gray-700/30 tw-rounded-lg">
                            <h4 class="tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-2">Pet Information</h4>
                            <div class="tw-flex tw-items-center tw-gap-3">
                                <div id="petImage" class="tw-h-10 tw-w-10 tw-rounded-full tw-bg-gray-700 tw-flex tw-items-center tw-justify-center tw-overflow-hidden">
                                    <i class="fas fa-paw tw-text-sm tw-text-gray-500"></i>
                                </div>
                                <div>
                                    <p id="petName" class="tw-text-sm tw-text-white tw-font-medium"></p>
                                    <div class="tw-flex tw-items-center tw-gap-2">
                                        <span id="petSpecies" class="tw-text-xs tw-text-gray-400"></span>
                                        <span class="tw-text-xs tw-text-gray-500">•</span>
                                        <span id="petBreed" class="tw-text-xs tw-text-gray-400"></span>
                                    </div>
                                </div>
                                <button id="viewPetBtn" class="tw-ml-auto tw-text-xs tw-bg-gray-700 hover:tw-bg-gray-600 tw-text-gray-200 tw-px-3 tw-py-1 tw-rounded-lg">
                                    <i class="fas fa-external-link-alt tw-mr-1"></i> View
                                </button>
                            </div>
                        </div>
                        
                        <!-- Client Information -->
                        <div class="tw-mt-4 tw-p-3 tw-bg-gray-700/30 tw-rounded-lg">
                            <h4 class="tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-2">Client Information</h4>
                            <div class="tw-flex tw-items-center tw-gap-3">
                                <div id="clientImage" class="tw-h-10 tw-w-10 tw-rounded-full tw-bg-gray-700 tw-flex tw-items-center tw-justify-center tw-overflow-hidden">
                                    <i class="fas fa-user tw-text-sm tw-text-gray-500"></i>
                                </div>
                                <div>
                                    <p id="clientName" class="tw-text-sm tw-text-white tw-font-medium"></p>
                                    <p id="clientEmail" class="tw-text-xs tw-text-gray-400"></p>
                                </div>
                                <button id="viewClientBtn" class="tw-ml-auto tw-text-xs tw-bg-gray-700 hover:tw-bg-gray-600 tw-text-gray-200 tw-px-3 tw-py-1 tw-rounded-lg">
                                    <i class="fas fa-external-link-alt tw-mr-1"></i> View
                                </button>
                            </div>
                        </div>
                        
                        <!-- Appointment History -->
                        <div class="tw-mt-4">
                            <h4 class="tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-2">Appointment History</h4>
                            <div class="tw-relative">
                                <!-- Timeline will be set via JavaScript -->
                                <div class="tw-border-l-2 tw-border-gray-700 tw-ml-2.5 tw-pl-4 tw-py-2 tw-space-y-4" id="appointmentHistory">
                                    <div class="tw-flex tw-items-start">
                                        <div class="tw-absolute tw-mt-1.5 tw-w-5 tw-h-5 tw-rounded-full tw-bg-blue-500 -tw-left-2.5 tw-border tw-border-gray-800"></div>
                                        <div>
                                            <p class="tw-text-xs tw-text-gray-400">Created</p>
                                            <p id="appointmentCreatedAt" class="tw-text-sm tw-text-white"></p>
                                        </div>
                                    </div>
                                    <div class="tw-flex tw-items-start" id="appointmentUpdatedBlock">
                                        <div class="tw-absolute tw-mt-1.5 tw-w-5 tw-h-5 tw-rounded-full tw-bg-yellow-500 -tw-left-2.5 tw-border tw-border-gray-800"></div>
                                        <div>
                                            <p class="tw-text-xs tw-text-gray-400">Last updated</p>
                                            <p id="appointmentUpdatedAt" class="tw-text-sm tw-text-white"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Actions Section -->
                <div class="tw-flex tw-justify-between tw-mt-8 tw-pt-4 tw-border-t tw-border-gray-700">
                    <div>
                        <button id="editAppointmentBtn" class="tw-text-white tw-bg-blue-600 hover:tw-bg-blue-700 tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center tw-flex tw-items-center">
                            <i class="fas fa-edit tw-mr-2"></i> Edit
                        </button>
                    </div>
                    
                    <div class="tw-flex tw-gap-2">
                        <!-- Status change buttons - conditionally displayed based on current status -->
                        <button id="confirmAppointmentBtn" class="tw-hidden tw-text-white tw-bg-green-600 hover:tw-bg-green-700 tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center tw-flex tw-items-center">
                            <i class="fas fa-check tw-mr-2"></i> Confirm
                        </button>
                        
                        <button id="completeAppointmentBtn" class="tw-hidden tw-text-white tw-bg-green-600 hover:tw-bg-green-700 tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center tw-flex tw-items-center">
                            <i class="fas fa-check-double tw-mr-2"></i> Complete
                        </button>
                        
                        <button id="cancelAppointmentBtn" class="tw-hidden tw-text-white tw-bg-red-600 hover:tw-bg-red-700 tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center tw-flex tw-items-center">
                            <i class="fas fa-times tw-mr-2"></i> Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Global variable to store current appointment data
    window.currentAppointmentData = null;
    
    // Function to open appointment modal with data
    window.openAppointmentModal = function(appointmentId) {
        // Show loading state
        const viewAppointmentModal = document.getElementById('viewAppointment-modal');
        if (!viewAppointmentModal) {
            console.error('View appointment modal not found in DOM');
            return;
        }
        
        // Show modal with loading indicator
        viewAppointmentModal.classList.remove('tw-hidden');
        
        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // Fetch appointment data
        fetch("{{ route('admin.appointments.show', ['id' => ':appointmentId']) }}".replace(':appointmentId', appointmentId), {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                console.error('Server responded with status:', response.status);
                return response.json().then(err => {
                    throw new Error(err.message || 'Failed to load appointment data');
                });
            }
            return response.json();
        })
        .then(data => {
            if (!data.success) {
                throw new Error(data.message || 'Failed to load appointment data');
            }
            
            // Store current appointment data
            window.currentAppointmentData = data.appointment;
            
            // Populate appointment information
            populateAppointmentData(data.appointment);
        })
        .catch(error => {
            console.error('Error fetching appointment data:', error);
            Swal.fire({
                title: 'Error!',
                text: 'Failed to load appointment data',
                icon: 'error',
                confirmButtonColor: '#FF9666',
                background: '#374151',
                color: '#fff'
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
            document.getElementById('serviceName').textContent = appointment.service.name || 'Unknown Service';
            document.getElementById('servicePrice').textContent = formatPrice(appointment.service.price);
            
            // Set service icon based on service type
            const serviceIcon = document.getElementById('serviceIcon');
            let iconClass = 'fa-concierge-bell'; // Default icon
            
            // Customize icon based on service name/type if needed
            const serviceName = (appointment.service.name || '').toLowerCase();
            if (serviceName.includes('groom')) {
                iconClass = 'fa-cut';
            } else if (serviceName.includes('walk')) {
                iconClass = 'fa-walking';
            } else if (serviceName.includes('board')) {
                iconClass = 'fa-bed';
            } else if (serviceName.includes('train')) {
                iconClass = 'fa-graduation-cap';
            } else if (serviceName.includes('vet') || serviceName.includes('exam')) {
                iconClass = 'fa-stethoscope';
            }
            
            serviceIcon.innerHTML = `<i class="fas ${iconClass} tw-text-5xl tw-text-[#FF9666]"></i>`;
        }
        
        // Set pet information
        if (appointment.pet) {
            document.getElementById('petName').textContent = appointment.pet.name || 'Unknown Pet';
            document.getElementById('petSpecies').textContent = appointment.pet.species || '';
            document.getElementById('petBreed').textContent = appointment.pet.breed || '';
            
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
            
            // Set up view pet button
            const viewPetBtn = document.getElementById('viewPetBtn');
            viewPetBtn.addEventListener('click', function() {
                // Close appointment modal first
                const viewAppointmentModal = document.getElementById('viewAppointment-modal');
                viewAppointmentModal.classList.add('tw-hidden');
                // Open pet modal with pet ID
                if (typeof window.openPetModal === 'function') {
                    window.openPetModal(appointment.pet.petID);
                } else {
                    console.error('openPetModal function not found');
                }
            });
            
            // Set client information if available through pet
            if (appointment.pet.user) {
                const client = appointment.pet.user;
                document.getElementById('clientName').textContent = `${client.firstName || ''} ${client.lastName || ''}`.trim() || 'Unknown Client';
                document.getElementById('clientEmail').textContent = client.email || '';
                
                // Set client image if available
                const clientImage = document.getElementById('clientImage');
                if (client.userImage) {
                    let imageUrl = "{{ asset('') }}" + (client.userImage.startsWith('storage/') 
                        ? client.userImage 
                        : 'storage/' + client.userImage);
                    
                    clientImage.innerHTML = `<img src="${imageUrl}" alt="Client" class="tw-h-full tw-w-full tw-object-cover">`;
                }
                
                // Set up view client button
                const viewClientBtn = document.getElementById('viewClientBtn');
                viewClientBtn.addEventListener('click', function() {
                    // Close appointment modal first
                    const viewAppointmentModal = document.getElementById('viewAppointment-modal');
                    viewAppointmentModal.classList.add('tw-hidden');
                    // Open user modal with client ID
                    if (typeof window.openUserModal === 'function') {
                        window.openUserModal(client.userID);
                    } else {
                        console.error('openUserModal function not found');
                    }
                });
            }
        }
        
        // Set status badge and buttons based on current status
        setStatusDisplay(appointment.status);
        
        // Set creation and update timestamps
        if (appointment.created_at) {
            document.getElementById('appointmentCreatedAt').textContent = formatDateTime(appointment.created_at);
        }
        
        if (appointment.updated_at && appointment.updated_at !== appointment.created_at) {
            document.getElementById('appointmentUpdatedAt').textContent = formatDateTime(appointment.updated_at);
            document.getElementById('appointmentUpdatedBlock').classList.remove('tw-hidden');
        } else {
            document.getElementById('appointmentUpdatedBlock').classList.add('tw-hidden');
        }
    }
    
    // Set status badge and action buttons based on current status
    function setStatusDisplay(status) {
        const statusBadge = document.getElementById('appointmentStatusBadge');
        const statusText = document.getElementById('statusText');
        const confirmBtn = document.getElementById('confirmAppointmentBtn');
        const completeBtn = document.getElementById('completeAppointmentBtn');
        const cancelBtn = document.getElementById('cancelAppointmentBtn');
        
        // Hide all action buttons first
        confirmBtn.classList.add('tw-hidden');
        completeBtn.classList.add('tw-hidden');
        cancelBtn.classList.add('tw-hidden');
        
        // Configure based on status
        switch (status) {
            case 'Pending':
                statusBadge.className = 'tw-px-4 tw-py-2 tw-rounded-full tw-text-sm tw-font-medium tw-bg-yellow-900 tw-text-yellow-300';
                statusText.innerHTML = '<i class="fas fa-clock tw-mr-2"></i> Pending';
                
                // Show confirm and cancel buttons for pending appointments
                confirmBtn.classList.remove('tw-hidden');
                cancelBtn.classList.remove('tw-hidden');
                break;
                
            case 'Confirmed':
                statusBadge.className = 'tw-px-4 tw-py-2 tw-rounded-full tw-text-sm tw-font-medium tw-bg-blue-900 tw-text-blue-300';
                statusText.innerHTML = '<i class="fas fa-check-circle tw-mr-2"></i> Confirmed';
                
                // Show complete and cancel buttons for confirmed appointments
                completeBtn.classList.remove('tw-hidden');
                cancelBtn.classList.remove('tw-hidden');
                break;
                
            case 'Completed':
                statusBadge.className = 'tw-px-4 tw-py-2 tw-rounded-full tw-text-sm tw-font-medium tw-bg-green-900 tw-text-green-300';
                statusText.innerHTML = '<i class="fas fa-check-double tw-mr-2"></i> Completed';
                // No action buttons needed for completed appointments
                break;
                
            case 'Cancelled':
                statusBadge.className = 'tw-px-4 tw-py-2 tw-rounded-full tw-text-sm tw-font-medium tw-bg-red-900 tw-text-red-300';
                statusText.innerHTML = '<i class="fas fa-times-circle tw-mr-2"></i> Cancelled';
                // No action buttons needed for cancelled appointments
                break;
                
            default:
                statusBadge.className = 'tw-px-4 tw-py-2 tw-rounded-full tw-text-sm tw-font-medium tw-bg-gray-700 tw-text-gray-300';
                statusText.innerHTML = status || 'Unknown';
        }
    }
    
    // Set up status change buttons event handlers
    document.getElementById('confirmAppointmentBtn').addEventListener('click', function() {
        updateAppointmentStatus('Confirmed');
    });
    
    document.getElementById('completeAppointmentBtn').addEventListener('click', function() {
        updateAppointmentStatus('Completed');
    });
    
    document.getElementById('cancelAppointmentBtn').addEventListener('click', function() {
        updateAppointmentStatus('Cancelled');
    });
    
    // Function to update appointment status
    function updateAppointmentStatus(newStatus) {
        if (!window.currentAppointmentData) return;
        
        Swal.fire({
            title: `${newStatus} this appointment?`,
            text: `Are you sure you want to mark this appointment as ${newStatus}?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#FF9666',
            cancelButtonColor: '#6B7280',
            confirmButtonText: 'Yes, update status',
            background: '#374151',
            color: '#fff'
        }).then((result) => {
            if (result.isConfirmed) {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                
                // Send request to update status
                fetch("{{ route('admin.appointments.update-status', ['id' => ':appointmentId']) }}".replace(':appointmentId', window.currentAppointmentData.appointmentID), {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ status: newStatus })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update current appointment data with the new status
                        window.currentAppointmentData.status = newStatus;
                        setStatusDisplay(newStatus);
                        
                        // Show success message
                        Swal.fire({
                            title: 'Status Updated!',
                            text: `Appointment has been marked as ${newStatus}`,
                            icon: 'success',
                            confirmButtonColor: '#FF9666',
                            background: '#374151',
                            color: '#fff'
                        });
                        
                        // Refresh the appointments table if available
                        if (window.AppointmentsPage && window.AppointmentsPage.appointmentsTable) {
                            window.AppointmentsPage.appointmentsTable.ajax.reload();
                        }
                    } else {
                        throw new Error(data.message || 'Failed to update appointment status');
                    }
                })
                .catch(error => {
                    console.error('Error updating status:', error);
                    Swal.fire({
                        title: 'Error!',
                        text: error.message || 'Failed to update appointment status',
                        icon: 'error',
                        confirmButtonColor: '#FF9666',
                        background: '#374151',
                        color: '#fff'
                    });
                });
            }
        });
    }
    
    // Setup edit appointment button handler
    document.getElementById('editAppointmentBtn').addEventListener('click', function() {
        if (window.currentAppointmentData) {
            // Close this modal
            document.getElementById('viewAppointment-modal').classList.add('tw-hidden');
            
            // Call the edit function if it exists
            if (typeof window.AppointmentsPage.editAppointment === 'function') {
                window.AppointmentsPage.editAppointment(window.currentAppointmentData.appointmentID);
            } else {
                console.error('editAppointment function not found');
            }
        }
    });
    
    // Close modal handler
    const modalToggle = document.querySelector('[data-modal-toggle="viewAppointment-modal"]');
    if (modalToggle) {
        modalToggle.addEventListener('click', function() {
            document.getElementById('viewAppointment-modal').classList.add('tw-hidden');
        });
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
            hour: 'numeric',
            minute: '2-digit',
            hour12: true
        });
    }
    
    // Utility function to format date and time together
    function formatDateTime(dateTimeString) {
        if (!dateTimeString) return 'Not specified';
        
        const date = new Date(dateTimeString);
        return date.toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'short',
            day: 'numeric',
            hour: 'numeric',
            minute: '2-digit',
            hour12: true
        });
    }
    
    // Utility function to format price
    function formatPrice(price) {
        if (price === undefined || price === null) return '';
        
        return new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD',
            minimumFractionDigits: 2
        }).format(price);
    }
    
    // Initialize event listeners for both DOMContentLoaded and contentChanged
    ['DOMContentLoaded', 'contentChanged'].forEach(eventName => {
        document.addEventListener(eventName, function() {
            // Any initialization code needed for the appointment view modal
            console.log('Appointment view modal initialized');
        });
    });
});
</script>
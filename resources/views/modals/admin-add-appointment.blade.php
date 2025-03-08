<!-- Main modal -->
<div id="adminAddAppointment-modal" tabindex="-1" aria-hidden="true" class="tw-hidden tw-fixed tw-top-0 tw-left-0 tw-right-0 tw-z-50 tw-w-full tw-p-4 tw-overflow-x-hidden tw-overflow-y-auto md:tw-inset-0 tw-h-full tw-max-h-full tw-flex tw-items-center tw-justify-center tw-backdrop-blur-sm tw-bg-black/60">
    <div class="tw-relative tw-w-full tw-max-w-md tw-max-h-full tw-animate-modal-entry">
        <!-- Modal content -->
        <div class="tw-relative tw-bg-gray-800 tw-rounded-lg tw-shadow-sm tw-transform tw-transition-all">
            <!-- Modal header -->
            <div class="tw-flex tw-items-center tw-justify-between tw-p-4 md:tw-p-5 tw-border-b tw-rounded-t tw-border-gray-700">
                <h3 class="tw-text-lg tw-font-semibold tw-text-white">Add Appointment</h3>
                <button type="button" class="tw-text-gray-400 tw-bg-transparent tw-hover:tw-bg-gray-700 tw-hover:tw-text-white tw-rounded-lg tw-text-sm tw-w-8 tw-h-8 ms-auto tw-inline-flex tw-justify-center tw-items-center" data-modal-toggle="adminAddAppointment-modal">
                    <svg class="tw-w-3 tw-h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            
            <!-- Modal body -->
            <form id="adminAppointmentForm" class="tw-p-4 md:tw-p-5">
                <!-- User selection field - Admin specific -->
                <div class="tw-mb-4">
                    <label for="selected-user" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white">Select User</label>
                    <select id="selected-user" name="selected-user" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required>
                        <option value="">Select a user</option>
                        <!-- User options will be populated via AJAX -->
                    </select>
                </div>

                <!-- Pet selection field - will be populated based on selected user -->
                <div class="tw-mb-4">
                    <label for="selected-pet" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white">Pet</label>
                    <select id="selected-pet" name="selected-pet" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required disabled>
                        <option value="">Select a user first</option>
                    </select>
                </div>

                <!-- Date and Time fields on the same row -->
                <div class="tw-grid tw-grid-cols-2 tw-gap-4 tw-mb-4">
                    <div>
                        <label for="appointment-date" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white">Date</label>
                        <input type="date" name="appointment-date" id="appointment-date" 
                            min="{{ date('Y-m-d', strtotime('+1 day')) }}" 
                            class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required>
                    </div>
                    <div>
                        <label for="appointment-time" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white">Time</label>
                        <select id="appointment-time" name="appointment-time" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required disabled>
                            <option value="">Select date first</option>
                        </select>
                    </div>
                </div>

                <!-- Service selection -->
                <div class="tw-mb-4">
                    <label for="service" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white">Service</label>
                    <select id="service" name="service" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required>
                        <option value="">Select service</option>
                        <!-- Service options will be populated via AJAX -->
                    </select>
                </div>
                
                <button type="submit" class="tw-text-black tw-inline-flex tw-items-center tw-bg-[#24CFF4] hover:tw-bg-[#63e4fd] focus:tw-outline-none focus:tw-bg-[#038cb7] tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center">
                    <svg class="tw-me-1 tw--ms-1 tw-w-5 tw-h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    Add Appointment
                </button>
            </form>
        </div>
    </div>
</div>

<script>
// Create a namespace for our appointment modal functionality
const AdminAppointmentModal = {
    // Store elements references
    elements: {
        userSelect: null,
        petSelect: null,
        dateInput: null,
        timeSelect: null,
        serviceSelect: null,
        form: null
    },
    
    // Submission state tracking
    isSubmitting: false,
    
    // Initialize the modal functionality
    init: function() {
        // Get elements
        this.elements.userSelect = document.getElementById('selected-user');
        this.elements.petSelect = document.getElementById('selected-pet');
        this.elements.dateInput = document.getElementById('appointment-date');
        this.elements.timeSelect = document.getElementById('appointment-time');
        this.elements.serviceSelect = document.getElementById('service');
        this.elements.form = document.getElementById('adminAppointmentForm');
        
        // Set up event handlers
        this.setupEventHandlers();
    },
    
    setupEventHandlers: function() {
        // Setup user selection change handler
        if (this.elements.userSelect) {
            this.elements.userSelect.addEventListener('change', this.handleUserChange.bind(this));
        }
        
        // Setup date change handler
        if (this.elements.dateInput) {
            this.elements.dateInput.addEventListener('change', this.handleDateChange.bind(this));
        }
        
        // Setup form submission
        if (this.elements.form) {
            this.elements.form.addEventListener('submit', this.handleFormSubmit.bind(this));
        }
        
        // Setup modal toggle button
        const modalToggleBtn = document.querySelector('[data-modal-target="adminAddAppointment-modal"]');
        if (modalToggleBtn) {
            modalToggleBtn.addEventListener('click', () => {
                this.loadUsers();
                this.loadServices();
            });
        }
    },
    
    loadUsers: function() {
        // Set loading state
        this.elements.userSelect.innerHTML = '<option value="">Loading users...</option>';
        
        // Fetch real users from the database
        fetch(`{{ route('admin.users.list') }}`, {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            this.elements.userSelect.innerHTML = '<option value="">Select a user</option>';
            data.forEach(user => {
                this.elements.userSelect.innerHTML += `<option value="${user.userID}">${user.firstName} ${user.lastName} (ID: ${user.userID})</option>`;
            });
        })
        .catch(err => {
            console.error('Error loading users:', err);
            this.elements.userSelect.innerHTML = '<option value="">Error loading users</option>';
        });
    },
    
    handleUserChange: function() {
        const userId = this.elements.userSelect.value;
        
        // Reset and disable pet select if no user is selected
        if (!userId) {
            this.elements.petSelect.innerHTML = '<option value="">Select a user first</option>';
            this.elements.petSelect.disabled = true;
            return;
        }

        // Enable pet select and show loading state
        this.elements.petSelect.disabled = false;
        this.elements.petSelect.innerHTML = '<option value="">Loading pets...</option>';
        
        // Fetch real pets from the database for this user
        fetch(`{{ url('/admin/users') }}/${userId}/pets`, {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            this.elements.petSelect.innerHTML = '<option value="">Select a pet</option>';
            
            if (data.length === 0) {
                this.elements.petSelect.innerHTML += '<option value="" disabled>No pets found for this user</option>';
            } else {
                data.forEach(pet => {
                    this.elements.petSelect.innerHTML += `<option value="${pet.petID}">${pet.name} (${pet.species}) (ID: ${pet.petID})</option>`;
                });
            }
        })
        .catch(err => {
            console.error('Error loading pets:', err);
            this.elements.petSelect.innerHTML = '<option value="">Error loading pets</option>';
        });
    },
    
    handleDateChange: function() {
        const selectedDate = this.elements.dateInput.value;
        
        // Reset and disable time select if no date is selected
        if (!selectedDate) {
            this.elements.timeSelect.innerHTML = '<option value="">Select date first</option>';
            this.elements.timeSelect.disabled = true;
            return;
        }

        // Enable time select
        this.elements.timeSelect.disabled = false;
        
        // Set loading state
        this.elements.timeSelect.innerHTML = '<option value="">Loading available times...</option>';
        
        // Fetch time slots for the selected date
        fetch(`{{ route('admin.appointments.available-times') }}?date=${selectedDate}`, {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            let timeOptions = '<option value="">Select a time</option>';
            
            // Check if we have time slots
            if (data.timeSlots && data.timeSlots.length > 0) {
                data.timeSlots.forEach(slot => {
                    if (slot.available) {
                        timeOptions += `<option value="${slot.value}">${slot.label}</option>`;
                    } else {
                        timeOptions += `<option value="${slot.value}" disabled>${slot.label} (Booked)</option>`;
                    }
                });
            } else {
                timeOptions = '<option value="" disabled>No time slots available</option>';
            }
            
            this.elements.timeSelect.innerHTML = timeOptions;
        })
        .catch(err => {
            console.error('Error loading available times:', err);
            this.elements.timeSelect.innerHTML = '<option value="">Error loading times</option>';
        });
    },
    
    loadServices: function() {
        // Set loading state
        this.elements.serviceSelect.innerHTML = '<option value="">Loading services...</option>';
        
        // Fetch real services from the database
        fetch(`{{ route('admin.services.list') }}`, {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            this.elements.serviceSelect.innerHTML = '<option value="">Select a service</option>';
            data.forEach(service => {
                this.elements.serviceSelect.innerHTML += `<option value="${service.serviceID}">${service.name} - ₱${service.price}</option>`;
            });
        })
        .catch(err => {
            console.error('Error loading services:', err);
            this.elements.serviceSelect.innerHTML = '<option value="">Error loading services</option>';
        });
    },
    
    handleFormSubmit: function(e) {
        e.preventDefault();

        // Validate form
        if (this.isSubmitting) {
            return;
        }
        if (!this.elements.userSelect.value) {
            this.showError('Please select a user');
            return;
        }
        if (!this.elements.petSelect.value) {
            this.showError('Please select a pet');
            return;
        }
        if (!this.elements.dateInput.value) {
            this.showError('Please select a date');
            return;
        }
        // Validate that the selected date is at least tomorrow
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        tomorrow.setHours(0, 0, 0, 0);
        
        const selectedDate = new Date(this.elements.dateInput.value);
        selectedDate.setHours(0, 0, 0, 0);
        
        if (selectedDate < tomorrow) {
            this.showError('Appointments must be scheduled at least 1 day in advance');
            return;
        }
        if (!this.elements.timeSelect.value) {
            this.showError('Please select a time');
            return;
        }
        if (!this.elements.serviceSelect.value) {
            this.showError('Please select a service');
            return;
        }

        // Show confirmation dialog
        Swal.fire({
            title: 'Add Appointment',
            text: 'Are you sure you want to add this appointment?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#24CFF4',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, add appointment',
            cancelButtonText: 'Cancel',
            background: '#374151',
            color: '#fff'
        }).then((result) => {
            if (result.isConfirmed) {
                // Prepare the data for submission
                this.isSubmitting = true;

                const submitButton = document.querySelector('#adminAppointmentForm button[type="submit"]');
                const originalButtonText = submitButton.innerHTML;
                submitButton.disabled = true;
                submitButton.innerHTML = `<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg> Processing...`;

                const formData = {
                    petID: this.elements.petSelect.value,
                    date: this.elements.dateInput.value,
                    time: this.elements.timeSelect.value,
                    serviceID: this.elements.serviceSelect.value,
                    status: 'Confirmed' // Default status for admin-created appointments
                };
                
                // Get the CSRF token from the meta tag
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                
                // Submit the data to the server
                fetch('{{ route("admin.appointments.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(formData)
                })
                .then(response => {
                    return response.text().then(text => {
                        console.log('Server response:', text);
                        try {
                            return JSON.parse(text);
                        } catch (error) {
                            console.error('Failed to parse JSON:', error);
                            throw new Error('Server returned invalid JSON: ' + text);
                        }
                    });
                })
                .then(data => {
                    this.isSubmitting = false;
                
                    // Reset button
                    submitButton.disabled = false;
                    submitButton.innerHTML = originalButtonText;

                    // Show success message
                    Swal.fire({
                        title: 'Success!',
                        text: 'Appointment has been added to the database',
                        icon: 'success',
                        confirmButtonColor: '#24CFF4',
                        background: '#374151',
                        color: '#fff'
                    }).then(() => {
                        // Reset form and close modal
                        this.elements.form.reset();
                        const modal = document.getElementById('adminAddAppointment-modal');
                        modal.classList.add('tw-hidden');
                        
                        // Reload the page to reflect changes
                        window.location.reload();
                    });
                })
                .catch(err => {
                     // Reset submitting flag
                    this.isSubmitting = false;
                    
                    // Reset button
                    submitButton.disabled = false;
                    submitButton.innerHTML = originalButtonText;

                    console.error('Error saving appointment:', err);
                    this.showError(err.message || 'Failed to create appointment. Please try again.');
                });
            }
        });
    },
    
    showError: function(message) {
        Swal.fire({
            title: 'Error',
            text: message,
            icon: 'error',
            confirmButtonColor: '#24CFF4',
            background: '#374151',
            color: '#fff'
        });
    }
};

// Initialize after DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    AdminAppointmentModal.init();
});
</script>
<!-- Main modal -->
<div id="addAppointment-modal" tabindex="-1" aria-hidden="true" class="tw-hidden tw-fixed tw-top-0 tw-left-0 tw-right-0 tw-z-50 tw-w-full tw-p-4 tw-overflow-x-hidden tw-overflow-y-auto md:tw-inset-0 tw-h-full tw-max-h-full tw-flex tw-items-center tw-justify-center tw-backdrop-blur-sm tw-bg-black/60">
    <div class="tw-relative tw-w-full tw-max-w-md tw-max-h-full tw-animate-modal-entry">
        <!-- Modal content -->
        <div class="tw-relative tw-bg-white tw-rounded-lg tw-shadow-sm tw-transform tw-transition-all">
            <!-- Modal header -->
            <div class="tw-flex tw-items-center tw-justify-between tw-p-4 md:tw-p-5 tw-border-b tw-rounded-t tw-border-gray-200">
                <h3 class="tw-text-lg tw-font-semibold tw-text-gray-900">Add Appointment</h3>
                <button type="button" class="tw-text-gray-400 tw-bg-transparent tw-hover:tw-bg-gray-100 tw-hover:tw-text-gray-900 tw-rounded-lg tw-text-sm tw-w-8 tw-h-8 ms-auto tw-inline-flex tw-justify-center tw-items-center" data-modal-toggle="addAppointment-modal">
                    <svg class="tw-w-3 tw-h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            
            <!-- Modal body -->
            <form id="appointmentForm" class="tw-p-4 md:tw-p-5">
                <!-- Pet selection field -->
                <div class="tw-mb-4">
                    <label for="selected-pet" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-700">Pet</label>
                    <select id="selected-pet" name="selected-pet" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required>
                        <option value="">Select your pet</option>
                    </select>
                </div>

                <!-- Date and Time fields on the same row -->
                <div class="tw-grid tw-grid-cols-2 tw-gap-4 tw-mb-4">
                    <div>
                        <label for="appointment-date" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-700">Date</label>
                        <input type="date" name="appointment-date" id="appointment-date" 
                            value="" 
                            min="{{ date('Y-m-d', strtotime('+1 day')) }}" 
                            class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required>
                    </div>
                    <div>
                        <label for="appointment-time" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-700">Time</label>
                        <select id="appointment-time" name="appointment-time" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required disabled>
                            <option value="">Select date first</option>
                        </select>
                    </div>
                </div>

                <!-- Service selection -->
                <div class="tw-mb-4">
                    <label for="service" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-700">Service</label>
                    <select id="service" name="service" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required>
                        <option value="">Select service</option>
                    </select>
                </div>
                
                <button type="submit" class="tw-text-black tw-inline-flex tw-items-center tw-bg-[#24CFF4] hover:tw-bg-[#63e4fd] focus:tw-outline-none focus:tw-bg-[#038cb7] tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center">
                    <svg class="tw-me-1 tw--ms-1 tw-w-5 tw-h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    Add Booking
                </button>
            </form>
        </div>
    </div>
</div>

<script>
// Create a namespace for our appointment modal functionality
const AppointmentModal = {
    // Store elements references
    elements: {
        petSelect: null,
        dateInput: null,
        timeSelect: null,
        serviceSelect: null,
        form: null
    },
    
    // Store appointment data temporarily
    appointmentData: null,
    petData: null,
    serviceData: null,
    
    // Submission state tracking
    isSubmitting: false,
    
    // Initialize the modal functionality
    init: function() {
        // Get elements
        this.elements.petSelect = document.getElementById('selected-pet');
        this.elements.dateInput = document.getElementById('appointment-date');
        this.elements.timeSelect = document.getElementById('appointment-time');
        this.elements.serviceSelect = document.getElementById('service');
        this.elements.form = document.getElementById('appointmentForm');
        
        // Clear date input value to ensure no default date is selected
        if (this.elements.dateInput) {
            this.elements.dateInput.value = '';
        }

        // Set up event handlers
        this.setupEventHandlers();
    },
    
    setupEventHandlers: function() {
        // Setup date change handler
        if (this.elements.dateInput) {
            this.elements.dateInput.addEventListener('change', this.handleDateChange.bind(this));
        }
        
        // Setup form submission
        if (this.elements.form) {
            this.elements.form.addEventListener('submit', this.handleFormSubmit.bind(this));
        }
        
        // Setup modal toggle button
        const modalToggleBtn = document.querySelector('[data-modal-target="addAppointment-modal"]');
        if (modalToggleBtn) {
            modalToggleBtn.addEventListener('click', () => {
                this.loadPets();
                this.loadServices();
            });
        }
    },
    
    loadPets: function() {
        // Set loading state
        this.elements.petSelect.innerHTML = '<option value="">Loading pets...</option>';
        
        // Fetch user's pets from the database
        fetch(`{{ route('user.pets.list') }}`, {
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
            this.elements.petSelect.innerHTML = '<option value="">Select your pet</option>';
            
            if (data.length === 0) {
                this.elements.petSelect.innerHTML += '<option value="" disabled>No pets found. Please add a pet first.</option>';
            } else {
                data.forEach(pet => {
                    this.elements.petSelect.innerHTML += `<option value="${pet.petID}">${pet.name} (${pet.species})</option>`;
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
        fetch(`{{ route('appointments.available-times') }}?date=${selectedDate}`, {
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
        
        // Fetch services from the database
        fetch(`{{ route('services.list') }}`, {
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
            title: 'Book Appointment',
            text: 'Proceed to payment details?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#24CFF4',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, continue',
            cancelButtonText: 'Cancel',
            background: '#ffffff', 
            color: '#111827'
        }).then((result) => {
            if (result.isConfirmed) {
                this.prepareAppointmentData();
            }
        });
    },
    
    prepareAppointmentData: function() {
        // Gather form data
        const petID = this.elements.petSelect.value;
        const date = this.elements.dateInput.value;
        const time = this.elements.timeSelect.value;
        const serviceID = this.elements.serviceSelect.value;
        
        // Store the appointment data
        this.appointmentData = {
            petID: petID,
            date: date,
            time: time,
            serviceID: serviceID,
            status: 'Pending'
        };
        
        // Get pet details
        const petOption = this.elements.petSelect.options[this.elements.petSelect.selectedIndex];
        const petText = petOption.text;
        const petNameMatch = petText.match(/(.*) \((.*)\)/);
        
        if (petNameMatch) {
            this.petData = {
                petID: petID,
                name: petNameMatch[1],
                species: petNameMatch[2]
            };
        }
        
        // Get service details
        const serviceOption = this.elements.serviceSelect.options[this.elements.serviceSelect.selectedIndex];
        const serviceText = serviceOption.text;
        const serviceMatch = serviceText.match(/(.*) - ₱(.*)/);
        
        if (serviceMatch) {
            this.serviceData = {
                serviceID: serviceID,
                name: serviceMatch[1],
                price: serviceMatch[2]
            };
        }
        
        // Close the appointment modal
        const modal = document.getElementById('addAppointment-modal');
        modal.classList.add('tw-hidden');
        
        // Dispatch custom event to trigger payment modal
        const appointmentInfo = {
            appointment: this.appointmentData,
            pet: this.petData,
            service: this.serviceData
        };
        
        const paymentEvent = new CustomEvent('showPaymentModal', { 
            detail: appointmentInfo 
        });
        
        document.dispatchEvent(paymentEvent);
    },
    
    showError: function(message) {
        Swal.fire({
            title: 'Error',
            text: message,
            icon: 'error',
            confirmButtonColor: '#24CFF4',
            background: '#ffffff',
            color: '#111827'
        });
    }
};

// Initialize after DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    AppointmentModal.init();
});

document.addEventListener('contentChanged', function() {
    AppointmentModal.init();
});
</script>
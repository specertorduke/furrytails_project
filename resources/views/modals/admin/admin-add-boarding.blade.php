<!-- Main modal -->
<div id="adminAddBoarding-modal" tabindex="-1" aria-hidden="true" class="tw-hidden tw-fixed tw-top-0 tw-left-0 tw-right-0 tw-z-50 tw-w-full tw-p-4 tw-overflow-x-hidden tw-overflow-y-auto md:tw-inset-0 tw-h-full tw-max-h-full tw-flex tw-items-center tw-justify-center tw-backdrop-blur-sm tw-bg-black/60">
    <div class="tw-relative tw-w-full tw-max-w-md tw-max-h-full tw-animate-modal-entry">
        <!-- Modal content -->
        <div class="tw-relative tw-bg-gray-800 tw-rounded-lg tw-shadow-sm tw-transform tw-transition-all">
            <!-- Modal header -->
            <div class="tw-flex tw-items-center tw-justify-between tw-p-4 md:tw-p-5 tw-border-b tw-rounded-t tw-border-gray-700">
                <h3 class="tw-text-lg tw-font-semibold tw-text-white">Add Boarding</h3>
                <button type="button" class="tw-text-gray-400 tw-bg-transparent tw-hover:tw-bg-gray-700 tw-hover:tw-text-white tw-rounded-lg tw-text-sm tw-w-8 tw-h-8 ms-auto tw-inline-flex tw-justify-center tw-items-center" data-modal-toggle="adminAddBoarding-modal">
                    <svg class="tw-w-3 tw-h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            
            <!-- Modal body -->
            <form id="adminBoardingForm" class="tw-p-4 md:tw-p-5">
                <!-- User selection field - Admin specific -->
                <div class="tw-mb-4">
                    <label for="boarding-user" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white">Select User</label>
                    <select id="boarding-user" name="boarding-user" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required>
                        <option value="">Select a user</option>
                        <!-- User options will be populated via AJAX -->
                    </select>
                </div>

                <!-- Pet selection field - will be populated based on selected user -->
                <div class="tw-mb-4">
                    <label for="boarding-pet" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white">Pet</label>
                    <select id="boarding-pet" name="boarding-pet" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required disabled>
                        <option value="">Select a user first</option>
                    </select>
                </div>

                <!-- Boarding type selection -->
                <div class="tw-mb-4">
                    <label for="boarding-type" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white">Boarding Type</label>
                    <select id="boarding-type" name="boarding-type" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required>
                        <option value="">Select type</option>
                        <option value="daycare">Daycare</option>
                        <option value="overnight">Overnight</option>
                        <option value="long-term">Long-term Boarding</option>
                    </select>
                </div>

                <!-- Date fields - displayed only for long-term boarding -->
                <div id="boarding-date-fields" class="tw-hidden">
                    <div class="tw-grid tw-grid-cols-2 tw-gap-4 tw-mb-4">
                        <div>
                            <label for="boarding-start" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white">Start Date</label>
                            <input type="date" name="boarding-start" id="boarding-start" 
                                min="{{ date('Y-m-d') }}" 
                                class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5">
                        </div>
                        <div>
                            <label for="boarding-end" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white">End Date</label>
                            <input type="date" name="boarding-end" id="boarding-end"
                                min="{{ date('Y-m-d', strtotime('+1 day')) }}" 
                                class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5">
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="tw-text-black tw-inline-flex tw-items-center tw-bg-[#24CFF4] hover:tw-bg-[#63e4fd] focus:tw-outline-none focus:tw-bg-[#038cb7] tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center">
                    <svg class="tw-me-1 tw--ms-1 tw-w-5 tw-h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    Add Boarding
                </button>
            </form>
        </div>
    </div>
</div>

<script>
// Create a namespace for our boarding modal functionality
const AdminBoardingModal = {
    // Store elements references
    elements: {
        userSelect: null,
        petSelect: null,
        typeSelect: null,
        dateFields: null,
        startDate: null,
        endDate: null,
        form: null
    },
    
    // Submission state tracking
    isSubmitting: false,
    
    // Initialize the modal functionality
    init: function() {
        // Get elements
        this.elements.userSelect = document.getElementById('boarding-user');
        this.elements.petSelect = document.getElementById('boarding-pet');
        this.elements.typeSelect = document.getElementById('boarding-type');
        this.elements.dateFields = document.getElementById('boarding-date-fields');
        this.elements.startDate = document.getElementById('boarding-start');
        this.elements.endDate = document.getElementById('boarding-end');
        this.elements.form = document.getElementById('adminBoardingForm');
        
        // Set up event handlers
        this.setupEventHandlers();
    },
    
    setupEventHandlers: function() {
        // Setup user selection change handler
        if (this.elements.userSelect) {
            this.elements.userSelect.addEventListener('change', this.handleUserChange.bind(this));
        }
        
        // Setup boarding type change handler
        if (this.elements.typeSelect) {
            this.elements.typeSelect.addEventListener('change', this.handleTypeChange.bind(this));
        }
        
        // Setup start date change handler to update end date minimum
        if (this.elements.startDate) {
            this.elements.startDate.addEventListener('change', this.handleStartDateChange.bind(this));
        }
        
        // Setup form submission
        if (this.elements.form) {
            this.elements.form.addEventListener('submit', this.handleFormSubmit.bind(this));
        }
        
        // Setup modal toggle button
        const modalToggleBtn = document.querySelector('[data-modal-target="adminAddBoarding-modal"]');
        if (modalToggleBtn) {
            modalToggleBtn.addEventListener('click', () => {
                // Show the modal by removing the hidden class
                const modal = document.getElementById('adminAddBoarding-modal');
                if (modal) {
                    modal.classList.remove('tw-hidden');
                }
                
                // Load users when opening the modal
                this.loadUsers();
            });
        }
        
        // Setup modal close button
        const closeModalBtn = document.querySelector('[data-modal-toggle="adminAddBoarding-modal"]');
        if (closeModalBtn) {
            closeModalBtn.addEventListener('click', () => {
                const modal = document.getElementById('adminAddBoarding-modal');
                if (modal) {
                    modal.classList.add('tw-hidden');
                }
                this.resetForm();
            });
        }
    },
    
    resetForm: function() {
        if (this.elements.form) {
            this.elements.form.reset();
        }
        
        // Reset pet select
        if (this.elements.petSelect) {
            this.elements.petSelect.innerHTML = '<option value="">Select a user first</option>';
            this.elements.petSelect.disabled = true;
        }
        
        // Hide date fields
        if (this.elements.dateFields) {
            this.elements.dateFields.classList.add('tw-hidden');
        }
    },
    
    loadUsers: function() {
        // Set loading state
        this.elements.userSelect.innerHTML = '<option value="">Loading users...</option>';
        
        // Fetch users from the database
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
        
        // Fetch pets for this user
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
    
    handleTypeChange: function() {
        const boardingType = this.elements.typeSelect.value;
        
        // Show/hide date fields based on boarding type
        if (boardingType === 'long-term') {
            this.elements.dateFields.classList.remove('tw-hidden');
            this.elements.startDate.required = true;
            this.elements.endDate.required = true;
        } else {
            this.elements.dateFields.classList.add('tw-hidden');
            this.elements.startDate.required = false;
            this.elements.endDate.required = false;
            this.elements.startDate.value = '';
            this.elements.endDate.value = '';
        }
    },
    
    handleStartDateChange: function() {
        if (this.elements.startDate.value) {
            // Set the minimum end date to be the day after start date
            const startDate = new Date(this.elements.startDate.value);
            startDate.setDate(startDate.getDate() + 1);
            
            const year = startDate.getFullYear();
            const month = String(startDate.getMonth() + 1).padStart(2, '0');
            const day = String(startDate.getDate()).padStart(2, '0');
            
            this.elements.endDate.min = `${year}-${month}-${day}`;
            
            // Clear end date if it's before the new minimum
            if (this.elements.endDate.value && new Date(this.elements.endDate.value) < startDate) {
                this.elements.endDate.value = '';
            }
        }
    },
    
    handleFormSubmit: function(e) {
        e.preventDefault();

        // Validate form
        if (this.isSubmitting) {
            return;
        }
        
        // Basic validations
        if (!this.elements.userSelect.value) {
            this.showError('Please select a user');
            return;
        }
        
        if (!this.elements.petSelect.value) {
            this.showError('Please select a pet');
            return;
        }
        
        if (!this.elements.typeSelect.value) {
            this.showError('Please select a boarding type');
            return;
        }
        
        // Validate dates for long-term boarding
        if (this.elements.typeSelect.value === 'long-term') {
            if (!this.elements.startDate.value) {
                this.showError('Please select a start date');
                return;
            }
            
            if (!this.elements.endDate.value) {
                this.showError('Please select an end date');
                return;
            }
            
            const startDate = new Date(this.elements.startDate.value);
            const endDate = new Date(this.elements.endDate.value);
            
            if (endDate <= startDate) {
                this.showError('End date must be after start date');
                return;
            }
        }

        // Show confirmation dialog
        Swal.fire({
            title: 'Add Boarding',
            text: 'Are you sure you want to add this boarding reservation?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#24CFF4',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, add boarding',
            cancelButtonText: 'Cancel',
            background: '#374151',
            color: '#fff'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submitBoardingData();
            }
        });
    },
    
    submitBoardingData: function() {
        this.isSubmitting = true;
        
        const submitButton = document.querySelector('#adminBoardingForm button[type="submit"]');
        const originalButtonText = submitButton.innerHTML;
        submitButton.disabled = true;
        submitButton.innerHTML = `<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg> Processing...`;

        // Prepare boarding data based on type
        const boardingType = this.elements.typeSelect.value;
        let startDate, endDate;
        
        if (boardingType === 'long-term') {
            startDate = this.elements.startDate.value;
            endDate = this.elements.endDate.value;
        } else if (boardingType === 'overnight') {
            // For overnight, use today and tomorrow
            const today = new Date();
            const tomorrow = new Date(today);
            tomorrow.setDate(tomorrow.getDate() + 1);
            
            startDate = today.toISOString().split('T')[0];
            endDate = tomorrow.toISOString().split('T')[0];
        } else {
            // For daycare, use today for both
            const today = new Date().toISOString().split('T')[0];
            startDate = today;
            endDate = today;
        }
        
        const formData = {
            petID: this.elements.petSelect.value,
            boardingType: boardingType,
            start_date: startDate,
            end_date: endDate,
            status: 'Confirmed' // Admin-created bookings are confirmed by default
        };
        
        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // Submit to server
        fetch('{{ route("admin.boarding.store") }}', {
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
            submitButton.disabled = false;
            submitButton.innerHTML = originalButtonText;

            Swal.fire({
                title: 'Success!',
                text: 'Boarding reservation has been added',
                icon: 'success',
                confirmButtonColor: '#24CFF4',
                background: '#374151',
                color: '#fff'
            }).then(() => {
                // Reset form and close modal
                this.resetForm();
                const modal = document.getElementById('adminAddBoarding-modal');
                modal.classList.add('tw-hidden');
                
                // Reload page to reflect changes
                window.location.href = "{{ route('admin.boardings') }}";
            });
        })
        .catch(err => {
            this.isSubmitting = false;
            submitButton.disabled = false;
            submitButton.innerHTML = originalButtonText;

            console.error('Error saving boarding:', err);
            this.showError(err.message || 'Failed to create boarding reservation. Please try again.');
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
    AdminBoardingModal.init();
});

document.addEventListener('contentChanged', function() {
    AdminBoardingModal.init();
});
</script>
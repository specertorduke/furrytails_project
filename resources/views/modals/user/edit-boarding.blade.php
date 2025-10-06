<!-- Edit Boarding Modal -->
<div id="editBoarding-modal" tabindex="-1" aria-hidden="true" class="tw-hidden tw-fixed tw-top-0 tw-left-0 tw-right-0 tw-z-50 tw-w-full tw-p-4 tw-overflow-x-hidden tw-overflow-y-auto md:tw-inset-0 tw-h-full tw-max-h-full tw-flex tw-items-center tw-justify-center tw-backdrop-blur-sm tw-bg-black/60">
    <div class="tw-relative tw-w-full tw-max-w-md tw-max-h-full tw-animate-modal-entry">
        <!-- Modal content -->
        <div class="tw-relative tw-bg-white tw-rounded-lg tw-shadow-sm tw-transform tw-transition-all">
            <!-- Modal header -->
            <div class="tw-flex tw-items-center tw-justify-between tw-p-4 md:tw-p-5 tw-border-b tw-rounded-t tw-border-gray-200">
                <h3 class="tw-text-lg tw-font-semibold tw-text-gray-900">Edit Pet Boarding</h3>
                <button type="button" class="tw-text-gray-400 tw-bg-transparent tw-hover:tw-bg-gray-100 tw-hover:tw-text-gray-900 tw-rounded-lg tw-text-sm tw-w-8 tw-h-8 ms-auto tw-inline-flex tw-justify-center tw-items-center" data-modal-toggle="editBoarding-modal">
                    <svg class="tw-w-3 tw-h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            
            <!-- Modal body -->
            <form id="editBoardingForm" class="tw-p-4 md:tw-p-5">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" id="edit-boarding-id" name="boardingID">
                <input type="hidden" id="edit-boarding-pet" name="petID">
                <input type="hidden" id="edit-boarding-type" name="serviceID">
                <input type="hidden" id="edit-boarding-boardingType" name="boardingType">
                
                <!-- Edit Time Restriction Warning -->
                <div id="edit-restriction-warning" class="tw-mb-4 tw-hidden">
                    <div class="tw-bg-amber-50 tw-border tw-border-amber-200 tw-rounded-lg tw-p-3">
                        <div class="tw-flex tw-items-center">
                            <svg class="tw-w-5 tw-h-5 tw-text-amber-400 tw-mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="tw-text-amber-800 tw-text-sm tw-font-medium" id="edit-restriction-message">
                                <!-- Message will be populated via JavaScript -->
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Edit Disabled Warning -->
                <div id="edit-disabled-warning" class="tw-mb-4 tw-hidden">
                    <div class="tw-bg-red-50 tw-border tw-border-red-200 tw-rounded-lg tw-p-3">
                        <div class="tw-flex tw-items-center">
                            <svg class="tw-w-5 tw-h-5 tw-text-red-400 tw-mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="tw-text-red-800 tw-text-sm tw-font-medium">
                                Editing is no longer allowed. You can only edit boardings at least 3 days before the start date.
                            </span>
                        </div>
                    </div>
                </div>
                
                <!-- Current Boarding Details Section (Read-only) -->
                <div class="tw-mb-4">
                    <h4 class="tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-3">Current Boarding Details</h4>
                    
                    <div class="tw-bg-gray-50 tw-rounded-lg tw-p-4 tw-space-y-3">
                        <!-- Pet Information (Read-only) -->
                        <div class="tw-flex tw-justify-between tw-items-center">
                            <span class="tw-text-sm tw-text-gray-600">Pet:</span>
                            <span class="tw-text-sm tw-font-medium tw-text-gray-800" id="current-pet-info">-</span>
                        </div>
                        
                        <!-- Service Information (Read-only) -->
                        <div class="tw-flex tw-justify-between tw-items-center">
                            <span class="tw-text-sm tw-text-gray-600">Service:</span>
                            <span class="tw-text-sm tw-font-medium tw-text-gray-800" id="current-service-info">-</span>
                        </div>
                        
                        <!-- Boarding Type (Read-only) -->
                        <div class="tw-flex tw-justify-between tw-items-center">
                            <span class="tw-text-sm tw-text-gray-600">Type:</span>
                            <span class="tw-text-sm tw-font-medium tw-text-gray-800" id="current-type-info">-</span>
                        </div>
                    </div>
                </div>

                <!-- Editable Date Range Section -->
                <div class="tw-mb-4" id="edit-editable-section">
                    <h4 class="tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-3">Reschedule Boarding</h4>
                    
                    <div class="tw-grid tw-grid-cols-2 tw-gap-4">
                        <div>
                            <label for="edit-start-date" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-700">New Start Date</label>
                            <input type="date" name="start_date" id="edit-start-date" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required>
                        </div>
                        <div>
                            <label for="edit-end-date" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-700">New End Date</label>
                            <input type="date" name="end_date" id="edit-end-date" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required>
                        </div>
                    </div>
                    
                    <!-- Date validation warning -->
                    <div id="edit-date-warning" class="tw-mt-2 tw-hidden">
                        <p class="tw-text-red-500 tw-text-sm tw-flex tw-items-center">
                            <svg class="tw-w-4 tw-h-4 tw-mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                            <span id="edit-date-warning-text">End date must be after start date.</span>
                        </p>
                    </div>
                </div>
                
                <!-- Status (Hidden, for system use) -->
                <input type="hidden" id="edit-boarding-status" name="status" value="Confirmed">
                
                <div class="tw-flex tw-gap-3">
                    <button type="button" data-modal-toggle="editBoarding-modal" class="tw-text-gray-700 tw-bg-gray-200 hover:tw-bg-gray-300 tw-font-medium tw-rounded-lg tw-text-sm tw-px-4 tw-py-2.5 tw-text-center tw-flex-1">
                        Cancel
                    </button>
                    <button type="submit" class="tw-text-black tw-inline-flex tw-items-center tw-justify-center tw-bg-[#24CFF4] hover:tw-bg-[#63e4fd] focus:tw-outline-none focus:tw-bg-[#038cb7] tw-font-medium tw-rounded-lg tw-text-sm tw-px-4 tw-py-2.5 tw-text-center tw-flex-1">
                        <i class="fas fa-save tw-mr-2"></i>
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Create a namespace for our edit boarding modal functionality
const EditBoardingModal = {
    // Store elements references
    elements: {
        petIDInput: null,
        serviceIDInput: null,
        boardingTypeInput: null,
        startDateInput: null,
        endDateInput: null,
        boardingStatusInput: null,
        form: null,
        boardingIDInput: null,
    },
    
    // Store boarding data temporarily
    boardingID: null,
    boardingData: null,
    canEdit: true,
    
    // Initialize the modal functionality
    init: function() {
        // Get elements
        this.elements.petIDInput = document.getElementById('edit-boarding-pet');
        this.elements.serviceIDInput = document.getElementById('edit-boarding-type');
        this.elements.boardingTypeInput = document.getElementById('edit-boarding-boardingType');
        this.elements.startDateInput = document.getElementById('edit-start-date');
        this.elements.endDateInput = document.getElementById('edit-end-date');
        this.elements.boardingStatusInput = document.getElementById('edit-boarding-status');
        this.elements.form = document.getElementById('editBoardingForm');
        this.elements.boardingIDInput = document.getElementById('edit-boarding-id');
        
        // Set up event handlers
        this.setupEventHandlers();
        
        // Set minimum dates to today
        this.setMinimumDates();
    },
    
    setupEventHandlers: function() {
        // Setup date validation
        this.elements.startDateInput.addEventListener('change', () => {
            this.validateDates();
        });
        
        this.elements.endDateInput.addEventListener('change', () => {
            this.validateDates();
        });
                
        // Setup form submission
        if (this.elements.form) {
            this.elements.form.addEventListener('submit', this.handleFormSubmit.bind(this));
        }
        
        // Setup modal toggle button
        const modalToggleBtns = document.querySelectorAll('[data-modal-toggle="editBoarding-modal"]');
        if (modalToggleBtns.length > 0) {
            modalToggleBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    document.getElementById('editBoarding-modal').classList.add('tw-hidden');
                });
            });
        }
    },
    
    setMinimumDates: function() {
        // Set minimum date to today for both date inputs
        const today = new Date().toISOString().split('T')[0];
        this.elements.startDateInput.setAttribute('min', today);
        this.elements.endDateInput.setAttribute('min', today);
    },
    
    resetForm: function() {
        this.elements.form.reset();
        this.elements.startDateInput.value = '';
        this.elements.endDateInput.value = '';
        this.canEdit = true;
        
        // Hide warning messages
        document.getElementById('edit-date-warning').classList.add('tw-hidden');
        document.getElementById('edit-restriction-warning').classList.add('tw-hidden');
        document.getElementById('edit-disabled-warning').classList.add('tw-hidden');
        
        // Re-enable date inputs
        this.elements.startDateInput.disabled = false;
        this.elements.endDateInput.disabled = false;
    },
    
    displayCurrentBoardingDetails: function(boarding) {
        // Display current pet
        const petNameSpan = document.getElementById('current-pet-info');
        if (petNameSpan && boarding.pet) {
            petNameSpan.textContent = `${boarding.pet.name} (${boarding.pet.species || 'Unknown'})`;
        }
        
        // Display current service
        const serviceNameSpan = document.getElementById('current-service-info');
        if (serviceNameSpan && boarding.service) {
            serviceNameSpan.textContent = `${boarding.service.name} - ₱${parseFloat(boarding.service.price).toLocaleString('en-US', { minimumFractionDigits: 2 })}`;
        }
        
        // Display current boarding type
        const typeSpan = document.getElementById('current-type-info');
        if (typeSpan) {
            typeSpan.textContent = boarding.boardingType;
        }
    },
    
    checkEditingRestrictions: function(boarding) {
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        
        const startDate = new Date(boarding.start_date);
        startDate.setHours(0, 0, 0, 0);
        
        // Calculate days until start
        const daysUntilStart = Math.floor((startDate - today) / (1000 * 60 * 60 * 24));
        
        // Check if editing should be disabled
        if (daysUntilStart < 3) {
            this.canEdit = false;
            
            // Disable date inputs
            this.elements.startDateInput.disabled = true;
            this.elements.endDateInput.disabled = true;
            
            // Show disabled warning
            const disabledWarning = document.getElementById('edit-disabled-warning');
            disabledWarning.classList.remove('tw-hidden');
            
            // Hide the regular restriction warning
            document.getElementById('edit-restriction-warning').classList.add('tw-hidden');
        } else {
            this.canEdit = true;
            
            // Show the regular restriction warning (3 days notice)
            const restrictionWarning = document.getElementById('edit-restriction-warning');
            const restrictionMessage = document.getElementById('edit-restriction-message');
            restrictionWarning.classList.remove('tw-hidden');
            
            if (restrictionMessage) {
                restrictionMessage.textContent = 'Reminder: Boardings can only be edited at least 3 days before the start date.';
            }
            
            // Hide disabled warning
            document.getElementById('edit-disabled-warning').classList.add('tw-hidden');
        }
    },
    
    validateDates: function() {
        const startDate = new Date(this.elements.startDateInput.value);
        const endDate = new Date(this.elements.endDateInput.value);
        const warning = document.getElementById('edit-date-warning');
        const warningText = document.getElementById('edit-date-warning-text');
        
        // Reset warning
        warning.classList.add('tw-hidden');
        
        // Check if dates are valid
        if (isNaN(startDate.getTime()) || isNaN(endDate.getTime())) {
            return true; // Not complete yet, so don't show warning
        }
        
        // Check if end date is before start date
        if (endDate < startDate) {
            warning.classList.remove('tw-hidden');
            warningText.textContent = 'End date must be after start date.';
            return false;
        }
        
        return true;
    },
    
    loadBoardingData: function(boardingId) {
        this.resetForm();
        this.boardingID = boardingId;
        this.elements.boardingIDInput.value = boardingId;
        
        // Fetch boarding data from the server
        fetch(`{{ route('user.boardings.show', ['id' => ':id']) }}`.replace(':id', boardingId), {
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
            if (!data.success) {
                throw new Error(data.message || 'Failed to load boarding data');
            }
            
            // Store boarding data
            this.boardingData = data.boarding;
            
            // Fill the form with boarding data
            this.populateForm(data);
        })
        .catch(err => {
            console.error('Error loading boarding data:', err);
            Swal.fire({
                title: 'Error',
                text: 'Could not load boarding data. Please try again.',
                icon: 'error',
                confirmButtonColor: '#24CFF4'
            });
        });
    },
    
    populateForm: function(data) {
        const boarding = data.boarding;
        
        // Set hidden inputs (these won't be editable)
        this.elements.petIDInput.value = boarding.petID;
        this.elements.serviceIDInput.value = boarding.serviceID;
        this.elements.boardingTypeInput.value = boarding.boardingType;
        this.elements.boardingStatusInput.value = boarding.status;
        
        // Display current boarding details (read-only)
        this.displayCurrentBoardingDetails(boarding);
        
        // Check editing restrictions (3-day rule)
        this.checkEditingRestrictions(boarding);
        
        // Set dates (editable if canEdit is true)
        this.elements.startDateInput.value = boarding.start_date;
        this.elements.endDateInput.value = boarding.end_date;
    },
    
    handleFormSubmit: function(e) {
        e.preventDefault();

        // Check if editing is allowed
        if (!this.canEdit) {
            this.showError('Cannot edit boarding less than 3 days before the start date.');
            return;
        }

        // Validate dates
        if (!this.elements.startDateInput.value) {
            this.showError('Please select a start date');
            return;
        }
        
        if (!this.elements.endDateInput.value) {
            this.showError('Please select an end date');
            return;
        }
        
        // Validate dates
        if (!this.validateDates()) {
            this.showError('End date must be after start date');
            return;
        }
        
        // Prepare form data
        const formData = new FormData();
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        formData.append('_method', 'PUT');
        formData.append('petID', this.elements.petIDInput.value);
        formData.append('boardingType', this.elements.boardingTypeInput.value);
        formData.append('serviceID', this.elements.serviceIDInput.value);
        formData.append('start_date', this.elements.startDateInput.value);
        formData.append('end_date', this.elements.endDateInput.value);
        formData.append('status', this.elements.boardingStatusInput.value);
        
        // Show loading state
        const submitButton = this.elements.form.querySelector('button[type="submit"]');
        const originalButtonText = submitButton.innerHTML;
        submitButton.disabled = true;
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin tw-mr-2"></i> Saving...';
        
        // Submit form
        fetch(`{{ route('user.boardings.update', ['id' => ':id']) }}`.replace(':id', this.boardingID), {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (!data.success) {
                throw new Error(data.message || 'Failed to update boarding');
            }
            
            // Show success message
            Swal.fire({
                title: 'Success!',
                text: 'Boarding has been updated successfully.',
                icon: 'success',
                confirmButtonColor: '#24CFF4'
            }).then(() => {
                // Close modal
                document.getElementById('editBoarding-modal').classList.add('tw-hidden');
                
                // Refresh data in the main dashboard
                if (window.DashboardPage && window.DashboardPage.initializeTables) {
                    window.DashboardPage.initializeTables();
                }
            });
        })
        .catch(err => {
            console.error('Error updating boarding:', err);
            this.showError(err.message || 'Failed to update boarding. Please try again.');
        })
        .finally(() => {
            // Reset button state
            submitButton.disabled = false;
            submitButton.innerHTML = originalButtonText;
        });
    },
    
    showError: function(message) {
        Swal.fire({
            title: 'Error',
            text: message,
            icon: 'error',
            confirmButtonColor: '#24CFF4'
        });
    }
};

// Initialize after DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    EditBoardingModal.init();
});

document.addEventListener('contentChanged', function() {
    EditBoardingModal.init();
});

// Make the edit boarding function globally available
window.openEditBoardingModal = function(boardingId) {
    // Show the modal
    const modal = document.getElementById('editBoarding-modal');
    modal.classList.remove('tw-hidden');
    
    // Load the boarding data
    EditBoardingModal.loadBoardingData(boardingId);
};
</script>
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
            <div class="tw-p-4 md:tw-p-5">
                <!-- Edit Time Restriction Warning -->
                <div id="edit-boarding-restriction-warning" class="tw-mb-4 tw-hidden">
                    <div class="tw-bg-amber-50 tw-border tw-border-amber-200 tw-rounded-lg tw-p-3">
                        <div class="tw-flex tw-items-center">
                            <svg class="tw-w-5 tw-h-5 tw-text-amber-400 tw-mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="tw-text-amber-800 tw-text-sm tw-font-medium" id="boarding-restriction-message">
                                <!-- Message will be populated via JavaScript -->
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Edit Disabled Warning -->
                <div id="edit-boarding-disabled-warning" class="tw-mb-4 tw-hidden">
                    <div class="tw-bg-red-50 tw-border tw-border-red-200 tw-rounded-lg tw-p-3">
                        <div class="tw-flex tw-items-center">
                            <svg class="tw-w-5 tw-h-5 tw-text-red-400 tw-mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="tw-text-red-800 tw-text-sm tw-font-medium">
                                Editing is no longer allowed. You can only edit bookings at least 3 days before the scheduled date.
                            </span>
                        </div>
                    </div>
                </div>

                <form id="editBoardingForm">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" id="edit-boarding-id" name="boardingID">
                    <input type="hidden" id="edit-petID" name="petID">
                    <input type="hidden" id="edit-serviceID" name="serviceID">
                    <input type="hidden" id="edit-boardingType" name="boardingType">
                    
                    <!-- Current Boarding Details Section (Read-only) -->
                <div class="tw-mb-6">
                    <h4 class="tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-3">Current Boarding Details</h4>
                    
                    <div class="tw-bg-gray-50 tw-rounded-lg tw-p-4 tw-space-y-3">
                        <!-- Pet Information (Read-only) -->
                        <div class="tw-flex tw-justify-between tw-items-center">
                            <span class="tw-text-sm tw-text-gray-600">Pet:</span>
                            <span class="tw-text-sm tw-font-medium tw-text-gray-800" id="current-pet-info">-</span>
                        </div>
                        
                        <!-- Service Information (Read-only) -->
                        <div class="tw-flex tw-justify-between tw-items-center">
                            <span class="tw-text-sm tw-text-gray-600">Service Type:</span>
                            <span class="tw-text-sm tw-font-medium tw-text-gray-800" id="current-service-info">-</span>
                        </div>
                        
                        <!-- Status (Read-only) -->
                        <div class="tw-flex tw-justify-between tw-items-center">
                            <span class="tw-text-sm tw-text-gray-600">Status:</span>
                            <span class="tw-text-sm tw-font-medium" id="current-status">-</span>
                        </div>
                    </div>
                </div>

                <!-- Editable Dates Section -->
                <div class="tw-mb-6">
                    <h4 class="tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-3">Reschedule Boarding</h4>
                    
                    <!-- Date Range fields -->
                    <div id="edit-date-range-container" class="tw-grid tw-grid-cols-2 tw-gap-4 tw-mb-4">
                        <div>
                            <label for="edit-start-date" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-700">New Start Date</label>
                            <input type="date" name="start_date" id="edit-start-date" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required>
                        </div>
                        <div>
                            <label for="edit-end-date" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-700">New End Date</label>
                            <input type="date" name="end_date" id="edit-end-date" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required>
                        </div>
                    </div>

                    <!-- Single Date field (for daycare) -->
                    <div id="edit-single-date-container" class="tw-mb-4 tw-hidden">
                        <label for="edit-daycare-date" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-700">New Date</label>
                        <input type="date" name="daycare_date" id="edit-daycare-date" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5">
                    </div>
                </div>

                <!-- Status (Hidden - will be kept the same) -->
                <input type="hidden" id="edit-boarding-status" name="status">

                <!-- Price calculation -->
                <div class="tw-mb-4 tw-p-3 tw-bg-gray-50 tw-rounded-lg tw-border tw-border-gray-200">
                    <div class="tw-flex tw-justify-between tw-items-center">
                        <span class="tw-text-sm tw-font-medium tw-text-gray-700">Total Price:</span>
                        <span id="edit-boarding-price" class="tw-text-lg tw-font-bold tw-text-[#24CFF4]">₱0.00</span>
                    </div>
                    <p class="tw-text-xs tw-text-gray-500 tw-mt-1">Price calculation: <span id="edit-price-calculation">Select service and dates</span></p>
                </div>

                <!-- Date validation warning -->
                <div id="edit-date-warning" class="tw-mt-2 tw-hidden tw-mb-4">
                    <p class="tw-text-red-500 tw-text-sm tw-flex tw-items-center">
                        <i class="fas fa-exclamation-triangle tw-mr-2"></i>
                        <span id="edit-date-warning-text">End date must be after start date.</span>
                    </p>
                </div>
                
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
        startDateInput: null,
        endDateInput: null,
        daycareDate: null,
        dateRangeContainer: null,
        singleDateContainer: null,
        boardingStatusInput: null,
        priceDisplay: null,
        priceCalculation: null,
        form: null,
        petIDInput: null,
        serviceIDInput: null,
        boardingTypeInput: null,
    },
    
    // Store boarding data temporarily
    boardingID: null,
    boardingData: null,
    petData: null,
    serviceData: null,
    price: 0,
    services: [],
    selectedService: null,
    isDaycare: false,
    isOvernight: false,
    isExtended: false,
    allPets: [],
    boundOvernightListener: null,
    canEdit: false,
    originalStartDate: null,
    
    // Initialize the modal functionality
    init: function() {
        // Get elements
        this.elements.startDateInput = document.getElementById('edit-start-date');
        this.elements.endDateInput = document.getElementById('edit-end-date');
        this.elements.daycareDate = document.getElementById('edit-daycare-date');
        this.elements.dateRangeContainer = document.getElementById('edit-date-range-container');
        this.elements.singleDateContainer = document.getElementById('edit-single-date-container');
        this.elements.boardingStatusInput = document.getElementById('edit-boarding-status');
        this.elements.priceDisplay = document.getElementById('edit-boarding-price');
        this.elements.priceCalculation = document.getElementById('edit-price-calculation');
        this.elements.form = document.getElementById('editBoardingForm');
        this.elements.boardingIDInput = document.getElementById('edit-boarding-id');
        this.elements.petIDInput = document.getElementById('edit-petID');
        this.elements.serviceIDInput = document.getElementById('edit-serviceID');
        this.elements.boardingTypeInput = document.getElementById('edit-boardingType');
        
        this.boundOvernightListener = this.updateOvernightEndDate.bind(this);
        
        // Set up event handlers
        this.setupEventHandlers();
    },
    
    setupEventHandlers: function() {
        // Setup input change handlers for price calculation
        this.elements.startDateInput.addEventListener('change', () => {
            this.validateDates();
            this.calculatePrice();
        });
        
        this.elements.endDateInput.addEventListener('change', () => {
            this.validateDates();
            this.calculatePrice();
        });
        
        this.elements.daycareDate.addEventListener('change', this.calculatePrice.bind(this));
                
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
    
    resetForm: function() {
        this.elements.form.reset();
        this.elements.startDateInput.value = '';
        this.elements.endDateInput.value = '';
        this.elements.daycareDate.value = '';
        this.elements.priceDisplay.textContent = '₱0.00';
        this.elements.priceCalculation.textContent = 'Select service and dates';
        this.selectedService = null;
        this.isDaycare = false;
        this.isOvernight = false;
        this.isExtended = false;
        
        // Reset visibility of date fields
        this.elements.dateRangeContainer.classList.remove('tw-hidden');
        this.elements.singleDateContainer.classList.add('tw-hidden');
        
        // Remove overnight listener if it was added
        this.elements.startDateInput.removeEventListener('change', this.boundOvernightListener);
        
        // Hide error message if shown
        document.getElementById('edit-date-warning').classList.add('tw-hidden');
    },
    

    
    loadBoardingServicesAsync: function() {
        // Fetch boarding services from the database (only for pricing info)
        return fetch(`{{ route('services.boarding') }}`, {
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
            console.log('Services data received:', data); // Debug response
            this.services = data;
            return data; // Return services for chaining
        })
        .catch(err => {
            console.error('Error loading boarding services:', err);
            throw err; // Re-throw to handle in promise chain
        });
    },
    
    // Function to check editing restrictions
    checkEditingRestrictions: function(startDate) {
        const today = new Date();
        today.setHours(0, 0, 0, 0); // Reset time to midnight for accurate day comparison
        
        const bookingStartDate = new Date(startDate);
        bookingStartDate.setHours(0, 0, 0, 0);
        
        // Calculate days between today and booking start date
        const diffTime = bookingStartDate - today;
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        
        const restrictionWarning = document.getElementById('edit-boarding-restriction-warning');
        const disabledWarning = document.getElementById('edit-boarding-disabled-warning');
        const dateInputs = [this.elements.startDateInput, this.elements.endDateInput, this.elements.daycareDate];
        const saveButton = document.querySelector('#editBoardingForm button[type="submit"]');
        
        if (diffDays < 3) {
            // Editing not allowed
            this.canEdit = false;
            disabledWarning.classList.remove('tw-hidden');
            restrictionWarning.classList.add('tw-hidden');
            
            // Disable all date inputs
            dateInputs.forEach(input => {
                if (input) {
                    input.disabled = true;
                    input.style.opacity = '0.5';
                    input.style.cursor = 'not-allowed';
                }
            });
            
            // Disable save button
            if (saveButton) {
                saveButton.disabled = true;
                saveButton.style.opacity = '0.5';
                saveButton.style.cursor = 'not-allowed';
            }
        } else if (diffDays <= 7) {
            // Show warning but allow editing
            this.canEdit = true;
            restrictionWarning.classList.remove('tw-hidden');
            disabledWarning.classList.add('tw-hidden');
            
            let message = '';
            if (diffDays === 3) {
                message = 'Last day to edit! You can only edit bookings at least 3 days in advance.';
            } else {
                message = `${diffDays} days remaining to edit this booking. You can only edit bookings at least 3 days in advance.`;
            }
            
            document.getElementById('boarding-restriction-message').textContent = message;
            
            // Enable date inputs
            dateInputs.forEach(input => {
                if (input) {
                    input.disabled = false;
                    input.style.opacity = '1';
                    input.style.cursor = 'pointer';
                }
            });
            
            // Enable save button
            if (saveButton) {
                saveButton.disabled = false;
                saveButton.style.opacity = '1';
                saveButton.style.cursor = 'pointer';
            }
        } else {
            // Normal editing allowed
            this.canEdit = true;
            restrictionWarning.classList.add('tw-hidden');
            disabledWarning.classList.add('tw-hidden');
            
            // Enable date inputs
            dateInputs.forEach(input => {
                if (input) {
                    input.disabled = false;
                    input.style.opacity = '1';
                    input.style.cursor = 'pointer';
                }
            });
            
            // Enable save button
            if (saveButton) {
                saveButton.disabled = false;
                saveButton.style.opacity = '1';
                saveButton.style.cursor = 'pointer';
            }
        }
    },
    
    // Function to set minimum date to today for all date inputs
    setMinimumDates: function() {
        const today = new Date();
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0');
        const day = String(today.getDate()).padStart(2, '0');
        const minDate = `${year}-${month}-${day}`;
        
        // Set min attribute for all date inputs
        if (this.elements.startDateInput) {
            this.elements.startDateInput.setAttribute('min', minDate);
        }
        if (this.elements.endDateInput) {
            this.elements.endDateInput.setAttribute('min', minDate);
        }
        if (this.elements.daycareDate) {
            this.elements.daycareDate.setAttribute('min', minDate);
        }
    },

    // Add new method to handle overnight end date calculation
    updateOvernightEndDate: function() {
        const startDate = this.elements.startDateInput.value;
        if (!startDate) return;
        
        // Get the next day
        const nextDay = new Date(startDate);
        nextDay.setDate(nextDay.getDate() + 1);
        
        // Format next day as YYYY-MM-DD for input
        const year = nextDay.getFullYear();
        const month = String(nextDay.getMonth() + 1).padStart(2, '0');
        const day = String(nextDay.getDate()).padStart(2, '0');
        const formattedNextDay = `${year}-${month}-${day}`;
        
        // Set end date to next day
        this.elements.endDateInput.value = formattedNextDay;
        
        // Recalculate price
        this.calculatePrice();
    },
    
    calculatePrice: function() {
        if (!this.selectedService) {
            this.price = 0;
            this.elements.priceDisplay.textContent = '₱0.00';
            this.elements.priceCalculation.textContent = 'Select service and dates';
            return;
        }
        
        if (this.isDaycare) {
            // For daycare, price is fixed regardless of date
            const dayDate = this.elements.daycareDate.value;
            if (!dayDate) {
                this.price = 0;
                this.elements.priceDisplay.textContent = '₱0.00';
                this.elements.priceCalculation.textContent = 'Select date';
                return;
            }
            
            // Price is just the service price (fixed price)
            this.price = parseFloat(this.selectedService.price);
            this.elements.priceDisplay.textContent = `₱${this.price.toLocaleString('en-US', { minimumFractionDigits: 2 })}`;
            this.elements.priceCalculation.textContent = `Daycare - ${this.selectedService.name}`;
            
        } else if (this.isOvernight) {
            // For overnight boarding, price is fixed regardless of date
            const startDate = this.elements.startDateInput.value;
            if (!startDate) {
                this.price = 0;
                this.elements.priceDisplay.textContent = '₱0.00';
                this.elements.priceCalculation.textContent = 'Select start date';
                return;
            }
            
            // Price is just the service price (fixed price)
            this.price = parseFloat(this.selectedService.price);
            this.elements.priceDisplay.textContent = `₱${this.price.toLocaleString('en-US', { minimumFractionDigits: 2 })}`;
            this.elements.priceCalculation.textContent = `Overnight Stay - ${this.selectedService.name}`;
            
        } else {
            // For extended boarding, calculate based on number of days
            const startDate = this.elements.startDateInput.value;
            const endDate = this.elements.endDateInput.value;
            
            if (!startDate || !endDate) {
                this.price = 0;
                this.elements.priceDisplay.textContent = '₱0.00';
                this.elements.priceCalculation.textContent = 'Select start and end dates';
                return;
            }
            
            // Calculate number of days
            const start = new Date(startDate);
            const end = new Date(endDate);
            
            // Include both start and end days in the calculation
            const days = Math.floor((end - start) / (1000 * 60 * 60 * 24)) + 1;
            
            if (days <= 0) {
                this.price = 0;
                this.elements.priceDisplay.textContent = '₱0.00';
                this.elements.priceCalculation.textContent = 'End date must be after start date';
                return;
            }
            
            // Calculate price (service price is daily rate)
            const pricePerDay = parseFloat(this.selectedService.price);
            const totalPrice = pricePerDay * days;
            this.price = totalPrice;
            
            this.elements.priceDisplay.textContent = `₱${totalPrice.toLocaleString('en-US', { minimumFractionDigits: 2 })}`;
            this.elements.priceCalculation.textContent = `${days} day(s) × ₱${pricePerDay} = ₱${totalPrice.toLocaleString('en-US', { minimumFractionDigits: 2 })}`;
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
        
        // Show loading state
        this.elements.priceCalculation.textContent = 'Loading boarding data...';
        
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
            console.log('Boarding data received:', data);
            
            if (!data.success) {
                throw new Error(data.message || 'Failed to load boarding data');
            }
            
            // Store boarding data
            this.boardingData = data.boarding;
            this.petData = data.boarding.pet;
            this.originalStartDate = data.boarding.start_date;
            
            // Set service data if we have it
            if (data.boarding.service) {
                this.serviceData = data.boarding.service;
            }
            
            // Check if editing is allowed
            this.checkEditingRestrictions(data.boarding.start_date);
            
            // Load services to get pricing info, then populate form
            this.loadBoardingServicesAsync().then(() => {
                // Now populate the form after services are loaded
                this.populateForm(data);
                
                // Set minimum date to today for all date inputs
                this.setMinimumDates();
            });
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
        console.log('Populating form with boarding:', boarding);
        
        // Set hidden fields for pet, service, and status
        this.elements.petIDInput.value = boarding.petID;
        this.elements.boardingStatusInput.value = boarding.status;
        this.elements.boardingTypeInput.value = boarding.boardingType;
        
        // Display pet information (read-only)
        const pet = boarding.pet;
        if (pet) {
            document.getElementById('current-pet-info').textContent = `${pet.name} (${pet.species})`;
        }
        
        // Display service information (read-only)
        // Find the matching service to get service ID and price
        let matchingService = null;
        if (this.services && this.services.length > 0) {
            const boardingTypeLower = boarding.boardingType.toLowerCase();
            matchingService = this.services.find(service => 
                service.name.toLowerCase().includes(boardingTypeLower)
            );
            
            if (matchingService) {
                this.selectedService = matchingService;
                this.elements.serviceIDInput.value = matchingService.serviceID;
                document.getElementById('current-service-info').textContent = `${matchingService.name} (₱${matchingService.price})`;
            } else {
                document.getElementById('current-service-info').textContent = boarding.boardingType;
            }
        }
        
        // Display status (read-only) with color coding
        const statusElement = document.getElementById('current-status');
        statusElement.textContent = boarding.status;
        statusElement.className = 'tw-text-sm tw-font-medium tw-px-2 tw-py-1 tw-rounded-full tw-text-xs';
        
        switch(boarding.status) {
            case 'Confirmed':
                statusElement.classList.add('tw-bg-blue-100', 'tw-text-blue-800');
                break;
            case 'Active':
                statusElement.classList.add('tw-bg-green-100', 'tw-text-green-800');
                break;
            case 'Completed':
                statusElement.classList.add('tw-bg-gray-100', 'tw-text-gray-800');
                break;
            case 'Cancelled':
                statusElement.classList.add('tw-bg-red-100', 'tw-text-red-800');
                break;
            default:
                statusElement.classList.add('tw-bg-gray-100', 'tw-text-gray-800');
        }
        
        // Determine boarding type and show appropriate date fields
        const boardingTypeLower = boarding.boardingType.toLowerCase();
        this.isDaycare = boardingTypeLower.includes('daycare');
        this.isOvernight = boardingTypeLower.includes('overnight');
        this.isExtended = boardingTypeLower.includes('extended');
        
        // Set up date fields based on boarding type
        if (this.isDaycare) {
            // For daycare, show single date field
            this.elements.dateRangeContainer.classList.add('tw-hidden');
            this.elements.singleDateContainer.classList.remove('tw-hidden');
            this.elements.startDateInput.removeAttribute('required');
            this.elements.endDateInput.removeAttribute('required');
            this.elements.daycareDate.setAttribute('required', 'required');
            this.elements.daycareDate.value = boarding.start_date;
        } else if (this.isOvernight) {
            // For overnight, show start date only (end date is auto-calculated)
            this.elements.dateRangeContainer.classList.remove('tw-hidden');
            this.elements.singleDateContainer.classList.add('tw-hidden');
            this.elements.startDateInput.setAttribute('required', 'required');
            this.elements.daycareDate.removeAttribute('required');
            
            // Hide end date input as it will be auto-calculated
            document.querySelector('label[for="edit-end-date"]').parentElement.classList.add('tw-hidden');
            this.elements.endDateInput.removeAttribute('required');
            
            // Add overnight listener
            this.elements.startDateInput.addEventListener('change', this.boundOvernightListener);
            
            this.elements.startDateInput.value = boarding.start_date;
            this.elements.endDateInput.value = boarding.end_date;
        } else {
            // For extended boarding, show both date inputs
            this.elements.dateRangeContainer.classList.remove('tw-hidden');
            this.elements.singleDateContainer.classList.add('tw-hidden');
            this.elements.startDateInput.setAttribute('required', 'required');
            this.elements.endDateInput.setAttribute('required', 'required');
            this.elements.daycareDate.removeAttribute('required');
            
            // Show end date input
            document.querySelector('label[for="edit-end-date"]').parentElement.classList.remove('tw-hidden');
            
            this.elements.startDateInput.value = boarding.start_date;
            this.elements.endDateInput.value = boarding.end_date;
        }
        
        // Calculate and display the price
        this.calculatePrice();
    },
    
    handleFormSubmit: function(e) {
        e.preventDefault();

        // Check if editing is allowed
        if (!this.canEdit) {
            Swal.fire({
                title: 'Editing Not Allowed',
                text: 'You can only edit bookings at least 3 days before the scheduled date.',
                icon: 'warning',
                confirmButtonColor: '#24CFF4'
            });
            return;
        }

        // Validate dates based on boarding type
        if (this.isDaycare) {
            // Daycare validation
            if (!this.elements.daycareDate.value) {
                this.showError('Please select a date for daycare');
                return;
            }
        } else {
            // Boarding validation
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
        }
        
        // Prepare form data
        const formData = new FormData();
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        formData.append('_method', 'PUT');
        formData.append('petID', this.elements.petIDInput.value);
        formData.append('boardingType', this.elements.boardingTypeInput.value);
        formData.append('serviceID', this.elements.serviceIDInput.value);
        formData.append('status', this.elements.boardingStatusInput.value);
        
        // Dates - use daycare date for both start and end if it's a daycare
        if (this.isDaycare) {
            formData.append('start_date', this.elements.daycareDate.value);
            formData.append('end_date', this.elements.daycareDate.value);
        } else {
            formData.append('start_date', this.elements.startDateInput.value);
            formData.append('end_date', this.elements.endDateInput.value);
        }
        
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
                text: 'Boarding dates updated successfully.',
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
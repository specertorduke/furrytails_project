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
                
                <!-- Pet selection field -->
                <div class="tw-mb-4">
                    <label for="edit-boarding-pet" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-700">Pet</label>
                    <select id="edit-boarding-pet" name="petID" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required>
                        <!-- Will be populated with user's pets via JavaScript -->
                    </select>
                </div>

                <!-- Boarding Type -->
                <div class="tw-mb-4">
                    <label for="edit-boarding-type" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-700">Service Type</label>
                    <select id="edit-boarding-type" name="boardingType" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required>
                        <!-- Will be populated with service types via JavaScript -->
                    </select>
                </div>

                <!-- Date Range fields -->
                <div id="edit-date-range-container" class="tw-grid tw-grid-cols-2 tw-gap-4 tw-mb-4">
                    <div>
                        <label for="edit-start-date" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-700">Start Date</label>
                        <input type="date" name="start_date" id="edit-start-date" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required>
                    </div>
                    <div>
                        <label for="edit-end-date" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-700">End Date</label>
                        <input type="date" name="end_date" id="edit-end-date" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required>
                    </div>
                </div>

                <!-- Single Date field (for daycare) -->
                <div id="edit-single-date-container" class="tw-mb-4 tw-hidden">
                    <label for="edit-daycare-date" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-700">Date</label>
                    <input type="date" name="daycare_date" id="edit-daycare-date" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5">
                </div>

                <!-- Status Selection -->
                <div class="tw-mb-4">
                    <label for="edit-boarding-status" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-700">Status</label>
                    <select id="edit-boarding-status" name="status" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required>
                        <option value="Confirmed">Confirmed</option>
                        <option value="Active">Active</option>
                        <option value="Completed">Completed</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
                </div>

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
        petSelect: null,
        boardingTypeSelect: null,
        startDateInput: null,
        endDateInput: null,
        daycareDate: null,
        dateRangeContainer: null,
        singleDateContainer: null,
        boardingStatusSelect: null,
        priceDisplay: null,
        priceCalculation: null,
        form: null,
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
    
    // Initialize the modal functionality
    init: function() {
        // Get elements
        this.elements.petSelect = document.getElementById('edit-boarding-pet');
        this.elements.boardingTypeSelect = document.getElementById('edit-boarding-type');
        this.elements.startDateInput = document.getElementById('edit-start-date');
        this.elements.endDateInput = document.getElementById('edit-end-date');
        this.elements.daycareDate = document.getElementById('edit-daycare-date');
        this.elements.dateRangeContainer = document.getElementById('edit-date-range-container');
        this.elements.singleDateContainer = document.getElementById('edit-single-date-container');
        this.elements.boardingStatusSelect = document.getElementById('edit-boarding-status');
        this.elements.priceDisplay = document.getElementById('edit-boarding-price');
        this.elements.priceCalculation = document.getElementById('edit-price-calculation');
        this.elements.form = document.getElementById('editBoardingForm');
        this.elements.boardingIDInput = document.getElementById('edit-boarding-id');
        
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
        this.elements.boardingTypeSelect.addEventListener('change', this.handleServiceChange.bind(this));
        this.elements.petSelect.addEventListener('change', this.handlePetChange.bind(this));
                
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
    
    loadPets: function() {
        // Set loading state
        this.elements.petSelect.innerHTML = '<option value="">Loading pets...</option>';
        
        // Fetch user's pets from the database with better debugging
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
            console.log('Pet data received:', data); // Debug response
            this.elements.petSelect.innerHTML = '<option value="">Select your pet</option>';
            
            // Handle different response formats
            let pets = [];
            if (Array.isArray(data)) {
                // If response is a direct array of pets
                pets = data;
            } else if (data.pets && Array.isArray(data.pets)) {
                // If response has a "pets" key with array
                pets = data.pets;
            } else if (data.data && Array.isArray(data.data)) {
                // If response follows Laravel API resource format
                pets = data.data;
            } else {
                console.error('Unexpected pet data format:', data);
            }
            
            this.allPets = pets;
            
            if (this.allPets.length === 0) {
                this.elements.petSelect.innerHTML += '<option value="" disabled>No pets found. Please add a pet first.</option>';
            } else {
                this.allPets.forEach(pet => {
                    const option = document.createElement('option');
                    option.value = pet.petID;
                    option.textContent = `${pet.name} (${pet.species || 'Unknown'})`;
                    
                    // Select the pet if it matches the boarding pet
                    if (this.petData && pet.petID == this.petData.petID) {
                        option.selected = true;
                    }
                    
                    this.elements.petSelect.appendChild(option);
                });
            }
        })
        .catch(err => {
            console.error('Error loading pets:', err);
            this.elements.petSelect.innerHTML = '<option value="">Error loading pets</option>';
            
            // More detailed error in console
            console.error('Fetch details:', {
                url: `{{ route('user.pets.list') }}`,
                error: err.message
            });
        });
    },

    handlePetChange: function() {
        const petID = this.elements.petSelect.value;
        if (!petID || !this.allPets) {
            this.petData = null;
            return;
        }
        
        // Find the selected pet in our stored pets array
        this.petData = this.allPets.find(pet => pet.petID == petID);
        console.log('Selected pet:', this.petData);
    },
    
    loadBoardingServices: function() {
        // Set loading state
        this.elements.boardingTypeSelect.innerHTML = '<option value="">Loading services...</option>';
        
        // Fetch boarding services from the database
        fetch(`{{ route('services.boarding') }}`, {
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
            this.services = data;
            this.elements.boardingTypeSelect.innerHTML = '<option value="">Select service type</option>';
            
            if (data.length === 0) {
                this.elements.boardingTypeSelect.innerHTML += '<option value="" disabled>No boarding services available</option>';
            } else {
                data.forEach(service => {
                    const option = document.createElement('option');
                    option.value = service.serviceID;
                    option.textContent = `${service.name} - ₱${service.price}`;
                    
                    // Select the service if it matches the boarding service
                    if (this.serviceData && service.serviceID == this.serviceData.serviceID) {
                        option.selected = true;
                    }
                    
                    this.elements.boardingTypeSelect.appendChild(option);
                });
            }
            
            // If we have a boarding type already, handle the service change
            if (this.elements.boardingTypeSelect.value) {
                this.handleServiceChange();
            }
        })
        .catch(err => {
            console.error('Error loading boarding services:', err);
            this.elements.boardingTypeSelect.innerHTML = '<option value="">Error loading services</option>';
        });
    },
    
    handleServiceChange: function() {
        const serviceID = this.elements.boardingTypeSelect.value;
        if (!serviceID) {
            // Reset UI elements if no service selected
            this.elements.dateRangeContainer.classList.add('tw-hidden');
            this.elements.singleDateContainer.classList.add('tw-hidden');
            this.elements.priceDisplay.textContent = '₱0.00';
            this.elements.priceCalculation.textContent = 'Select service and dates';
            return;
        }
        
        // Find the selected service data
        this.selectedService = this.services.find(service => service.serviceID == serviceID);
        if (!this.selectedService) return;
        
        const serviceName = this.selectedService.name.toLowerCase();
        
        // Check service type
        this.isDaycare = serviceName.includes('daycare');
        this.isOvernight = serviceName.includes('overnight');
        this.isExtended = serviceName.includes('extended');
        
        // Show/hide appropriate date fields
        if (this.isDaycare) {
            // For daycares, hide date range and show single date
            this.elements.dateRangeContainer.classList.add('tw-hidden');
            this.elements.singleDateContainer.classList.remove('tw-hidden');
            this.elements.startDateInput.removeAttribute('required');
            this.elements.endDateInput.removeAttribute('required');
            this.elements.daycareDate.setAttribute('required', 'required');
            
            // Copy start date to daycare date if set
            if (this.elements.startDateInput.value && !this.elements.daycareDate.value) {
                this.elements.daycareDate.value = this.elements.startDateInput.value;
            }
            
        } else {
            // For any boarding service, show appropriate fields
            this.elements.dateRangeContainer.classList.remove('tw-hidden');
            this.elements.singleDateContainer.classList.add('tw-hidden');
            this.elements.startDateInput.setAttribute('required', 'required');
            this.elements.daycareDate.removeAttribute('required');
            
            // Handle overnight boarding - show only start date
            if (this.isOvernight) {
                // Hide end date input as it will be auto-calculated
                document.querySelector('label[for="edit-end-date"]').parentElement.classList.add('tw-hidden');
                this.elements.endDateInput.removeAttribute('required');
                
                // Add the event listener for overnight - using our stored bound function
                this.elements.startDateInput.addEventListener('change', this.boundOvernightListener);
                
                // If start date already has a value, update end date now
                if (this.elements.startDateInput.value) {
                    this.updateOvernightEndDate();
                }
            } else {
                // For extended boarding, show both date inputs
                document.querySelector('label[for="edit-end-date"]').parentElement.classList.remove('tw-hidden');
                this.elements.endDateInput.setAttribute('required', 'required');
                
                // Remove overnight listener if it was added
                this.elements.startDateInput.removeEventListener('change', this.boundOvernightListener);
            }
        }
        
        // Recalculate price
        this.calculatePrice();
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
            if (!data.success) {
                throw new Error(data.message || 'Failed to load boarding data');
            }
            
            // Store boarding data
            this.boardingData = data.boarding;
            this.petData = data.boarding.pet;
            
            // Set service data if we have it
            if (data.boarding.service) {
                this.serviceData = data.boarding.service;
            }
            
            // Fill the form with boarding data
            this.populateForm(data);
            
            // Load pets and services dropdowns
            this.loadPets();
            this.loadBoardingServices();
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
        
        // Set status
        this.elements.boardingStatusSelect.value = boarding.status;
        
        // Set dates
        this.elements.startDateInput.value = boarding.start_date;
        this.elements.endDateInput.value = boarding.end_date;
        
        // For daycare, also set the daycare date
        if (boarding.boardingType.toLowerCase() === 'daycare') {
            this.elements.daycareDate.value = boarding.start_date;
        }
        
    },
    
    handleFormSubmit: function(e) {
        e.preventDefault();

        // Validate form
        if (!this.elements.petSelect.value) {
            this.showError('Please select a pet');
            return;
        }
        
        if (!this.elements.boardingTypeSelect.value) {
            this.showError('Please select a service type');
            return;
        }
        
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
        formData.append('petID', this.elements.petSelect.value);
        
        // Determine boarding type from service name
        const selectedService = this.services.find(s => s.serviceID == this.elements.boardingTypeSelect.value);
        let boardingType = 'Extended';
        if (selectedService) {
            const serviceName = selectedService.name.toLowerCase();
            if (serviceName.includes('daycare')) {
                boardingType = 'Daycare';
            } else if (serviceName.includes('overnight')) {
                boardingType = 'Overnight';
            }
        }
        formData.append('boardingType', boardingType);
        formData.append('serviceID', this.elements.boardingTypeSelect.value);
        
        // Dates - use daycare date for both start and end if it's a daycare
        if (this.isDaycare) {
            formData.append('start_date', this.elements.daycareDate.value);
            formData.append('end_date', this.elements.daycareDate.value);
        } else {
            formData.append('start_date', this.elements.startDateInput.value);
            formData.append('end_date', this.elements.endDateInput.value);
        }
        
        // Status
        formData.append('status', this.elements.boardingStatusSelect.value);
        
        
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
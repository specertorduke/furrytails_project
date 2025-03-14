<!-- Main modal -->
<div id="addBoarding-modal" tabindex="-1" aria-hidden="true" class="tw-hidden tw-fixed tw-top-0 tw-left-0 tw-right-0 tw-z-50 tw-w-full tw-p-4 tw-overflow-x-hidden tw-overflow-y-auto md:tw-inset-0 tw-h-full tw-max-h-full tw-flex tw-items-center tw-justify-center tw-backdrop-blur-sm tw-bg-black/60">
    <div class="tw-relative tw-w-full tw-max-w-md tw-max-h-full tw-animate-modal-entry">
        <!-- Modal content -->
        <div class="tw-relative tw-bg-white tw-rounded-lg tw-shadow-sm tw-transform tw-transition-all">
            <!-- Modal header -->
            <div class="tw-flex tw-items-center tw-justify-between tw-p-4 md:tw-p-5 tw-border-b tw-rounded-t tw-border-gray-200">
                <h3 class="tw-text-lg tw-font-semibold tw-text-gray-900">Add Pet Boarding</h3>
                <button type="button" class="tw-text-gray-400 tw-bg-transparent tw-hover:tw-bg-gray-100 tw-hover:tw-text-gray-900 tw-rounded-lg tw-text-sm tw-w-8 tw-h-8 ms-auto tw-inline-flex tw-justify-center tw-items-center" data-modal-toggle="addBoarding-modal">
                    <svg class="tw-w-3 tw-h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            
            <!-- Modal body -->
            <form id="boardingForm" class="tw-p-4 md:tw-p-5">
                <!-- Pet selection field -->
                <div class="tw-mb-4">
                    <label for="boarding-pet" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-700">Pet</label>
                    <select id="boarding-pet" name="boarding-pet" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required>
                        <option value="">Select your pet</option>
                    </select>
                </div>

                <!-- Boarding Type -->
                <div class="tw-mb-4">
                    <label for="boarding-type" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-700">Service Type</label>
                    <select id="boarding-type" name="boarding-type" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required>
                        <option value="">Select service type</option>
                    </select>
                </div>

                <!-- Date Range fields (will be shown/hidden based on service type) -->
                <div id="date-range-container" class="tw-grid tw-grid-cols-2 tw-gap-4 tw-mb-4">
                    <div>
                        <label for="start-date" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-700">Start Date</label>
                        <input type="date" name="start-date" id="start-date" 
                            value="" 
                            min="{{ date('Y-m-d', strtotime('+1 day')) }}" 
                            class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required>
                    </div>
                    <div>
                        <label for="end-date" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-700">End Date</label>
                        <input type="date" name="end-date" id="end-date" 
                            min="{{ date('Y-m-d') }}" 
                            class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required>
                    </div>
                </div>

                <!-- Single Date field (for daycare) -->
                <div id="single-date-container" class="tw-mb-4 tw-hidden">
                    <label for="daycare-date" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-700">Date</label>
                    <input type="date" name="daycare-date" id="daycare-date" 
                        min="{{ date('Y-m-d') }}" 
                        class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5">
                </div>

                <!-- Price calculation -->
                <div class="tw-mb-4 tw-p-3 tw-bg-gray-50 tw-rounded-lg tw-border tw-border-gray-200">
                    <div class="tw-flex tw-justify-between tw-items-center">
                        <span class="tw-text-sm tw-font-medium tw-text-gray-700">Estimated Cost:</span>
                        <span id="boarding-price" class="tw-text-lg tw-font-bold tw-text-[#24CFF4]">₱0.00</span>
                    </div>
                    <p class="tw-text-xs tw-text-gray-500 tw-mt-1">Price calculation: <span id="price-calculation">Select service and dates</span></p>
                </div>
                
                <button type="submit" class="tw-text-black tw-inline-flex tw-items-center tw-bg-[#24CFF4] hover:tw-bg-[#63e4fd] focus:tw-outline-none focus:tw-bg-[#038cb7] tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center">
                    <svg class="tw-me-1 tw--ms-1 tw-w-5 tw-h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    Proceed to Payment
                </button>
            </form>
        </div>
    </div>
</div>

<script>
// Create a namespace for our boarding modal functionality
const BoardingModal = {
    // Store elements references
    elements: {
        petSelect: null,
        boardingTypeSelect: null,
        startDateInput: null,
        endDateInput: null,
        daycareDate: null,
        dateRangeContainer: null,
        singleDateContainer: null,
        priceDisplay: null,
        priceCalculation: null,
        form: null
    },
    
    // Store boarding data temporarily
    boardingData: null,
    petData: null,
    serviceData: null, // Use consistent naming (not boardingTypeData)
    price: 0,
    services: [],
    selectedService: null,
    isDaycare: false,
    isOvernight: false,
    isExtended: false,
    boundOvernightListener: null,
    
    // Initialize the modal functionality
    init: function() {
        // Get elements
        this.elements.petSelect = document.getElementById('boarding-pet');
        this.elements.boardingTypeSelect = document.getElementById('boarding-type');
        this.elements.startDateInput = document.getElementById('start-date');
        this.elements.endDateInput = document.getElementById('end-date');
        this.elements.daycareDate = document.getElementById('daycare-date');
        this.elements.dateRangeContainer = document.getElementById('date-range-container');
        this.elements.singleDateContainer = document.getElementById('single-date-container');
        this.elements.priceDisplay = document.getElementById('boarding-price');
        this.elements.priceCalculation = document.getElementById('price-calculation');
        this.elements.form = document.getElementById('boardingForm');
        
        // Clear date input values to ensure no default date is selected
        this.elements.startDateInput.value = '';
        this.elements.endDateInput.value = '';
        this.elements.daycareDate.value = '';

        this.boundOvernightListener = this.updateOvernightEndDate.bind(this);

        // Set up event handlers
        this.setupEventHandlers();
    },
    
    setupEventHandlers: function() {
        // Setup input change handlers for price calculation
        this.elements.startDateInput.addEventListener('change', this.calculatePrice.bind(this));
        this.elements.endDateInput.addEventListener('change', this.calculatePrice.bind(this));
        this.elements.daycareDate.addEventListener('change', this.calculatePrice.bind(this));
        this.elements.boardingTypeSelect.addEventListener('change', this.handleServiceChange.bind(this));
        
        // Setup form submission
        if (this.elements.form) {
            this.elements.form.addEventListener('submit', this.handleFormSubmit.bind(this));
        }
        
        // Setup modal toggle button
        const modalToggleBtn = document.querySelector('[data-modal-target="addBoarding-modal"]');
        if (modalToggleBtn) {
            modalToggleBtn.addEventListener('click', () => {
                this.loadPets();
                this.loadBoardingServices();
                this.resetForm();
            });
        }
        
        // Setup close button
        const closeBtn = document.querySelector('[data-modal-toggle="addBoarding-modal"]');
        if (closeBtn) {
            closeBtn.addEventListener('click', () => {
                document.getElementById('addBoarding-modal').classList.add('tw-hidden');
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
        
        // Reset visibility of end date field
        document.querySelector('label[for="end-date"]').parentElement.classList.remove('tw-hidden');

        this.elements.startDateInput.removeEventListener('change', this.boundOvernightListener);
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
            
            this.allPets = data;

            if (data.length === 0) {
                this.elements.petSelect.innerHTML += '<option value="" disabled>No pets found. Please add a pet first.</option>';
            } else {
                data.forEach(pet => {
                    this.elements.petSelect.innerHTML += `<option value="${pet.petID}">${pet.name} (${pet.species})</option>`;
                });
            }

            this.elements.petSelect.addEventListener('change', this.handlePetChange.bind(this));
        })
        .catch(err => {
            console.error('Error loading pets:', err);
            this.elements.petSelect.innerHTML = '<option value="">Error loading pets</option>';
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
                    this.elements.boardingTypeSelect.innerHTML += `<option value="${service.serviceID}">${service.name} - ₱${service.price}</option>`;
                });
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
        } else {
            // For any boarding service, show appropriate fields
            this.elements.dateRangeContainer.classList.remove('tw-hidden');
            this.elements.singleDateContainer.classList.add('tw-hidden');
            this.elements.startDateInput.setAttribute('required', 'required');
            this.elements.daycareDate.removeAttribute('required');
            
            // Handle overnight boarding - show only start date
            if (this.isOvernight) {
                // Hide end date input as it will be auto-calculated
                document.querySelector('label[for="end-date"]').parentElement.classList.add('tw-hidden');
                this.elements.endDateInput.removeAttribute('required');
                
                // Add the event listener for overnight - using our stored bound function
                this.elements.startDateInput.addEventListener('change', this.boundOvernightListener);
                
                // If start date already has a value, update end date now
                if (this.elements.startDateInput.value) {
                    this.updateOvernightEndDate();
                }
            } else {
                // For extended boarding, show both date inputs
                document.querySelector('label[for="end-date"]').parentElement.classList.remove('tw-hidden');
                this.elements.endDateInput.setAttribute('required', 'required');
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
            this.price = this.selectedService.price;
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
            this.price = this.selectedService.price;
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
            const pricePerDay = this.selectedService.price;
            const totalPrice = pricePerDay * days;
            this.price = totalPrice;
            
            this.elements.priceDisplay.textContent = `₱${totalPrice.toLocaleString('en-US', { minimumFractionDigits: 2 })}`;
            this.elements.priceCalculation.textContent = `${days} day(s) × ₱${pricePerDay} = ₱${totalPrice.toLocaleString('en-US', { minimumFractionDigits: 2 })}`;
        }
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
            
            // Validate that end date is after or equal to start date
            const startDate = new Date(this.elements.startDateInput.value);
            const endDate = new Date(this.elements.endDateInput.value);
            
            if (endDate < startDate) {
                this.showError('End date must be after or equal to start date');
                return;
            }
        }

        // Show confirmation dialog
        Swal.fire({
            title: 'Book Boarding',
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
                this.prepareBoardingData();
            }
        });
    },
    
    prepareBoardingData: function() {
        // Gather form data
        const petID = this.elements.petSelect.value;
        const serviceID = this.elements.boardingTypeSelect.value;
        
        let startDate, endDate;
        
        if (!this.petData) {
            // If petData is missing, try to set it now
            if (this.allPets) {
                this.petData = this.allPets.find(pet => pet.petID == petID);
            }
            
            // If still missing, create minimal pet data
            if (!this.petData) {
                this.petData = { petID: petID };
                console.warn('Pet data is incomplete, only ID available');
            }
        }
        
        if (!this.serviceData) {
            // If serviceData is missing, try to set it now
            if (this.selectedService) {
                this.serviceData = this.selectedService;
            }
            
            // If still missing, create minimal service data
            if (!this.serviceData) {
                this.serviceData = { serviceID: serviceID };
                console.warn('Service data is incomplete, only ID available');
            }
        }

        if (this.isDaycare) {
            // For daycare, both start and end date are the same
            startDate = this.elements.daycareDate.value;
            endDate = this.elements.daycareDate.value;
        } else {
            // For boarding, use the range
            startDate = this.elements.startDateInput.value;
            endDate = this.elements.endDateInput.value;
        }
        
        // IMPORTANT: Always set a default boardingType first
        let boardingType = 'Overnight';
        
        // Then try to determine more specifically what type it is
        if (this.selectedService && this.selectedService.name) {
            const serviceName = this.selectedService.name.toLowerCase();
            if (serviceName.includes('daycare')) {
                boardingType = 'Daycare';
            } else if (serviceName.includes('extended')) {
                boardingType = 'Extended';
            } else if (serviceName.includes('overnight')) {
                boardingType = 'Overnight';
            }
        }

        // Store the boarding data with explicit boardingType
        this.boardingData = {
            petID: petID,
            boardingType: boardingType, // Explicitly set
            start_date: startDate,
            end_date: endDate,
            status: 'Confirmed'
        };
        
        // Make sure to log the data for debugging
        console.log('Boarding data prepared:', this.boardingData);
            
        // Other code remains the same...

        // Close the boarding modal
        const modal = document.getElementById('addBoarding-modal');
        modal.classList.add('tw-hidden');
        
        // When creating the event object, duplicate the boardingType at top level also
        const boardingInfo = {
            boarding: this.boardingData,
            pet: this.petData,
            service: this.serviceData,
            price: this.price,
            boardingType: boardingType // Add it here too for flexibility
        };
        
        console.log('Dispatching payment event with data:', boardingInfo);
        
        const paymentEvent = new CustomEvent('showPaymentModal', { 
            detail: boardingInfo 
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
    BoardingModal.init();
});

document.addEventListener('contentChanged', function() {
    BoardingModal.init();
});
</script>
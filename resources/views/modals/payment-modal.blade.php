<!-- Payment Modal -->
<div id="payment-modal" tabindex="-1" aria-hidden="true" class="tw-hidden tw-fixed tw-top-0 tw-left-0 tw-right-0 tw-z-50 tw-w-full tw-p-4 tw-overflow-x-hidden tw-overflow-y-auto md:tw-inset-0 tw-h-full tw-max-h-full tw-flex tw-items-center tw-justify-center tw-backdrop-blur-sm tw-bg-black/60">
    <div class="tw-relative tw-w-full tw-max-w-md tw-max-h-full tw-animate-modal-entry">
        <!-- Modal content -->
        <div class="tw-relative tw-bg-gray-800 tw-rounded-lg tw-shadow-sm tw-transform tw-transition-all">
            <!-- Modal header -->
            <div class="tw-flex tw-items-center tw-justify-between tw-p-4 md:tw-p-5 tw-border-b tw-rounded-t tw-border-gray-700">
                <h3 class="tw-text-lg tw-font-semibold tw-text-white">Payment Details</h3>
                <button type="button" class="tw-text-gray-400 tw-bg-transparent tw-hover:tw-bg-gray-700 tw-hover:tw-text-white tw-rounded-lg tw-text-sm tw-w-8 tw-h-8 ms-auto tw-inline-flex tw-justify-center tw-items-center" data-modal-toggle="payment-modal">
                    <svg class="tw-w-3 tw-h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            
            <!-- Modal body -->
            <div class="tw-p-4 md:tw-p-5">
                <!-- Service Summary -->
                <div class="tw-mb-6 tw-bg-gray-700 tw-rounded-lg tw-p-4">
                    <h4 class="tw-text-md tw-font-medium tw-text-white tw-mb-2" id="payment-service-type">Booking Summary</h4>
                    
                    <div class="tw-space-y-2">
                        <!-- Service/Boarding Type -->
                        <div class="tw-flex tw-justify-between tw-items-center">
                            <span class="tw-text-sm tw-text-gray-300">Service</span>
                            <span class="tw-text-sm tw-font-medium tw-text-white" id="payment-service-name">-</span>
                        </div>
                        
                        <!-- Pet Information -->
                        <div class="tw-flex tw-justify-between tw-items-center">
                            <span class="tw-text-sm tw-text-gray-300">Pet</span>
                            <span class="tw-text-sm tw-font-medium tw-text-white" id="payment-pet-info">-</span>
                        </div>
                        
                        <!-- Date and Time - For appointments -->
                        <div class="tw-flex tw-justify-between tw-items-center appointment-detail">
                            <span class="tw-text-sm tw-text-gray-300">Date & Time</span>
                            <span class="tw-text-sm tw-font-medium tw-text-white" id="payment-datetime">-</span>
                        </div>
                        
                        <!-- Date Range - For boarding -->
                        <div class="tw-flex tw-justify-between tw-items-center boarding-detail tw-hidden">
                            <span class="tw-text-sm tw-text-gray-300">Stay Period</span>
                            <span class="tw-text-sm tw-font-medium tw-text-white" id="payment-date-range">-</span>
                        </div>
                        
                        <!-- Duration - For boarding -->
                        <div class="tw-flex tw-justify-between tw-items-center boarding-detail tw-hidden">
                            <span class="tw-text-sm tw-text-gray-300">Duration</span>
                            <span class="tw-text-sm tw-font-medium tw-text-white" id="payment-duration">-</span>
                        </div>
                        
                        <hr class="tw-border-gray-600">
                        
                        <!-- Total Amount -->
                        <div class="tw-flex tw-justify-between tw-items-center">
                            <span class="tw-text-sm tw-font-medium tw-text-white">Total Amount</span>
                            <span class="tw-text-lg tw-font-bold tw-text-[#24CFF4]" id="payment-amount">₱0.00</span>
                        </div>
                    </div>
                </div>
                
                <!-- Payment Form -->
                <form id="paymentForm">
                    <!-- Hidden fields for appointment data -->
                    <input type="hidden" id="p.petID" name="petID" value="">
                    <input type="hidden" id="p.serviceID" name="serviceID" value="">
                    <input type="hidden" id="amount" name="amount" value="">
                    <input type="hidden" id="p.date" name="date" value="">
                    <input type="hidden" id="p.time" name="time" value="">
                    <input type="hidden" id="booking-type" name="booking_type" value="">
                    
                    <!-- Hidden fields for boarding data -->
                    <input type="hidden" id="start_date" name="start_date" value="">
                    <input type="hidden" id="end_date" name="end_date" value="">
                    <input type="hidden" id="boarding_type" name="boarding_type" value="">
                    
                    <!-- Payment method -->
                    <div class="tw-mb-5">
                        <label for="payment_method" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white">Payment Method</label>
                        <select id="payment_method" name="payment_method" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required>
                            <option value="">Select payment method</option>
                            <option value="Cash">Cash (Pay at Counter)</option>
                            <option value="GCash">GCash</option>
                            <option value="Credit Card">Credit Card</option>
                            <option value="Debit Card">Debit Card</option>
                            <option value="PayPal">PayPal</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                        </select>
                    </div>
                    
                    <!-- Reference Number -->
                    <div id="reference-number-container" class="tw-mb-5 tw-hidden">
                        <label for="reference_number" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white">Reference Number</label>
                        <div class="tw-flex tw-items-center">
                            <input type="text" id="reference_number" name="reference_number" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" placeholder="Transaction ID or receipt number">
                            <div class="tw-ml-2" id="reference-info">
                                <span class="tw-cursor-pointer tw-text-gray-400 hover:tw-text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-5 tw-w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <p class="tw-mt-1 tw-text-xs tw-text-gray-400">Required for online payment methods</p>
                    </div>
                    
                    <!-- GCash QR Code container (hidden by default) -->
                    <div id="gcash-qr-container" class="tw-mb-5 tw-hidden tw-text-center">
                        <p class="tw-mb-2 tw-text-sm tw-text-white">Scan the QR code to pay via GCash</p>
                        <div class="tw-bg-white tw-p-3 tw-rounded-lg tw-inline-block">
                            <img src="{{ asset('assets/images/gcash-qr.png') }}" alt="GCash QR Code" class="tw-h-48 tw-w-48 tw-object-contain">
                        </div>
                        <p class="tw-mt-2 tw-text-sm tw-text-gray-300">After payment, enter your reference number above</p>
                    </div>
                
                    <div class="tw-flex tw-justify-end tw-mt-4">
                        <button type="button" id="cancel-payment" class="tw-text-white tw-bg-gray-600 hover:tw-bg-gray-500 tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-mr-2">
                            Cancel
                        </button>
                        <button type="submit" id="confirm-payment" class="tw-text-black tw-bg-[#24CFF4] hover:tw-bg-[#63e4fd] tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5">
                            Confirm Payment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Create a namespace for our payment modal functionality
const PaymentModal = {
    // Store elements references
    elements: {
        modal: null,
        form: null,
        paymentMethod: null,
        referenceContainer: null,
        gCashQrContainer: null,
        
        // Summary elements
        serviceType: null,
        serviceName: null,
        petInfo: null,
        dateTime: null,
        dateRange: null,
        duration: null,
        amount: null
    },
    
    // Type of booking ('appointment' or 'boarding')
    bookingType: null,
    
    // Store the original data
    originalData: null,
    
    // Submission state tracking
    isSubmitting: false,
    
    // Initialize the modal functionality
    init: function() {
        // Get modal elements
        this.elements.modal = document.getElementById('payment-modal');
        this.elements.form = document.getElementById('paymentForm');
        this.elements.paymentMethod = document.getElementById('payment_method');
        this.elements.referenceContainer = document.getElementById('reference-number-container');
        this.elements.gCashQrContainer = document.getElementById('gcash-qr-container');
        
        // Get summary display elements
        this.elements.serviceType = document.getElementById('payment-service-type');
        this.elements.serviceName = document.getElementById('payment-service-name');
        this.elements.petInfo = document.getElementById('payment-pet-info');
        this.elements.dateTime = document.getElementById('payment-datetime');
        this.elements.dateRange = document.getElementById('payment-date-range');
        this.elements.duration = document.getElementById('payment-duration');
        this.elements.amount = document.getElementById('payment-amount');
        
        // Set up event handlers
        this.setupEventHandlers();
        
        // Set up tooltips for the reference number info icon
        if (typeof tippy !== 'undefined') {
            this.setupTooltips();
        }
    },
    
    setupEventHandlers: function() {
        // Payment method change handler
        if (this.elements.paymentMethod) {
            this.elements.paymentMethod.addEventListener('change', this.handlePaymentMethodChange.bind(this));
        }
        
        // Form submission
        if (this.elements.form) {
            this.elements.form.addEventListener('submit', this.handleFormSubmit.bind(this));
        }
        
        // Cancel button
        const cancelBtn = document.getElementById('cancel-payment');
        if (cancelBtn) {
            cancelBtn.addEventListener('click', this.closeModal.bind(this));
        }
        
        // Modal close button
        const closeBtn = document.querySelector('[data-modal-toggle="payment-modal"]');
        if (closeBtn) {
            closeBtn.addEventListener('click', this.closeModal.bind(this));
        }
        
        // Listen for the showPaymentModal event from the appointment or boarding modal
        document.addEventListener('showPaymentModal', this.showModal.bind(this));
    },
    
    setupTooltips: function() {
        tippy('#reference-info', {
            content: 'For online payments, enter the transaction ID or receipt number you received after payment.',
            placement: 'top',
            theme: 'dark',
            animation: 'scale'
        });
    },
    
    handlePaymentMethodChange: function() {
        const selectedMethod = this.elements.paymentMethod.value;
        
        // Show/hide reference number field based on payment method
        if (selectedMethod && selectedMethod !== 'Cash') {
            this.elements.referenceContainer.classList.remove('tw-hidden');
            
            // Show GCash QR code if GCash is selected
            if (selectedMethod === 'GCash') {
                this.elements.gCashQrContainer.classList.remove('tw-hidden');
            } else {
                this.elements.gCashQrContainer.classList.add('tw-hidden');
            }
            
            // Make reference number required for non-cash payments
            document.getElementById('reference_number').setAttribute('required', 'required');
        } else {
            this.elements.referenceContainer.classList.add('tw-hidden');
            this.elements.gCashQrContainer.classList.add('tw-hidden');
            document.getElementById('reference_number').removeAttribute('required');
        }
    },
    
    showModal: function(event) {
        // Get data from the event
        const data = event.detail;
        
        // Store original data for later use
        this.originalData = data;
        
        // Determine if this is an appointment or boarding payment
        if (data.appointment) {
            this.bookingType = 'appointment';
            this.displayAppointmentDetails(data);
        } else if (data.boarding) {
            this.bookingType = 'boarding';
            this.displayBoardingDetails(data);
        } else {
            console.error('Invalid payment data, missing both appointment and boarding information');
            return;
        }
        
        // Reset form
        this.elements.form.reset();
        this.elements.paymentMethod.value = '';
        this.elements.referenceContainer.classList.add('tw-hidden');
        this.elements.gCashQrContainer.classList.add('tw-hidden');
        
        // Show the modal
        this.elements.modal.classList.remove('tw-hidden');
    },
    
    displayAppointmentDetails: function(data) {
        // Get data from the event
        const appointment = data.appointment;
        const pet = data.pet;
        const service = data.service;
        
        // Show appointment details and hide boarding details
        document.querySelectorAll('.appointment-detail').forEach(el => el.classList.remove('tw-hidden'));
        document.querySelectorAll('.boarding-detail').forEach(el => el.classList.add('tw-hidden'));
        
        // Update service type heading
        this.elements.serviceType.textContent = 'Appointment Summary';
        
        // Set service name
        this.elements.serviceName.textContent = service.name;
        
        // Set pet info
        this.elements.petInfo.textContent = `${pet.name} (${pet.species})`;
        
        // Format and set date & time
        const formattedDate = new Date(appointment.date).toLocaleDateString('en-US', { 
            weekday: 'long', 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric' 
        });
        this.elements.dateTime.textContent = `${formattedDate}, ${appointment.time}`;
        
        // Set amount
        this.elements.amount.textContent = `₱${service.price}`;
        
        // Set hidden form values
        document.getElementById('booking-type').value = 'appointment';
        document.getElementById('p.petID').value = appointment.petID;
        document.getElementById('p.serviceID').value = appointment.serviceID;
        document.getElementById('amount').value = service.price;
        document.getElementById('p.date').value = appointment.date;
        document.getElementById('p.time').value = appointment.time;
    },
    
    displayBoardingDetails: function(data) {
        // Get data from the event
        const boarding = data.boarding;
        const pet = data.pet;
        const boardingType = data.boardingType;
        const price = data.price;
        
        // Show boarding details and hide appointment details
        document.querySelectorAll('.boarding-detail').forEach(el => el.classList.remove('tw-hidden'));
        document.querySelectorAll('.appointment-detail').forEach(el => el.classList.add('tw-hidden'));
        
        // Update service type heading
        this.elements.serviceType.textContent = 'Boarding Summary';
        
        // Set service name (boarding type)
        this.elements.serviceName.textContent = boardingType.name;
        
        // Set pet info
        this.elements.petInfo.textContent = `${pet.name} (${pet.species})`;
        
        // Format and set date range
        const startDate = new Date(boarding.start_date).toLocaleDateString('en-US', { 
            month: 'long', 
            day: 'numeric',
            year: 'numeric'
        });
        const endDate = new Date(boarding.end_date).toLocaleDateString('en-US', { 
            month: 'long', 
            day: 'numeric',
            year: 'numeric' 
        });
        this.elements.dateRange.textContent = `${startDate} - ${endDate}`;
        
        // Calculate and set duration
        const start = new Date(boarding.start_date);
        const end = new Date(boarding.end_date);
        const days = Math.ceil((end - start) / (1000 * 60 * 60 * 24));
        this.elements.duration.textContent = `${days} day${days !== 1 ? 's' : ''}`;
        
        // Set amount
        this.elements.amount.textContent = `₱${price}`;
        
        // Set hidden form values
        document.getElementById('booking-type').value = 'boarding';
        document.getElementById('p.petID').value = boarding.petID;
        document.getElementById('amount').value = price;
        document.getElementById('start_date').value = boarding.start_date;
        document.getElementById('end_date').value = boarding.end_date;
        document.getElementById('boarding_type').value = boarding.boardingType;
    },
    
    closeModal: function() {
        // Hide the modal
        this.elements.modal.classList.add('tw-hidden');
    },
    
    handleFormSubmit: function(e) {
        e.preventDefault();
        
        // Check if already submitting
        if (this.isSubmitting) {
            return;
        }
        
        // Validate form
        if (!this.elements.paymentMethod.value) {
            this.showError('Please select a payment method');
            return;
        }
        
        // If non-cash payment, require reference number
        if (this.elements.paymentMethod.value !== 'Cash' && !document.getElementById('reference_number').value) {
            this.showError('Please enter a reference number for your payment');
            return;
        }
        
        // Show confirmation dialog
        Swal.fire({
            title: 'Confirm Payment',
            text: `Proceed with ${this.elements.paymentMethod.value} payment for this ${this.bookingType}?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#24CFF4',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, confirm',
            cancelButtonText: 'Cancel',
            background: '#374151',
            color: '#fff'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submitPayment();
            }
        });
    },
    
    submitPayment: function() {
        // Set submitting flag
        this.isSubmitting = true;
        
        // Disable submit button and show loading state
        const submitBtn = document.getElementById('confirm-payment');
        const originalBtnText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = `<svg class="tw-animate-spin -tw-ml-1 tw-mr-3 tw-h-5 tw-w-5 tw-text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="tw-opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="tw-opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg> Processing...`;
        
        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // Create FormData object
        const formData = new FormData(this.elements.form);
        
        // Convert FormData to a plain object
        const formDataObject = {};
        formData.forEach((value, key) => {
            formDataObject[key] = value;
        });
        
        // Determine which endpoint to use
        let endpoint = '';
        if (this.bookingType === 'appointment') {
            endpoint = '{{ route("appointments.store") }}';
        } else {
            endpoint = '{{ route("boardings.store") }}';
        }
        
        // Send request to server
        fetch(endpoint, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify(formDataObject)
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(data => {
                    throw new Error(data.message || `Failed to create ${this.bookingType}`);
                });
            }
            return response.json();
        })
        .then(data => {
            // Reset submission flag
            this.isSubmitting = false;
            
            // Reset button
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalBtnText;
            
            // Close the modal
            this.closeModal();
            
            // Show success message
            Swal.fire({
                title: this.bookingType === 'appointment' ? 'Appointment Booked!' : 'Boarding Booked!',
                text: data.message || `Your ${this.bookingType} has been booked successfully.`,
                icon: 'success',
                confirmButtonColor: '#24CFF4',
                background: '#374151',
                color: '#fff'
            }).then(() => {
                // Refresh the page or relevant component
                window.location.reload();
            });
        })
        .catch(error => {
            // Reset submission flag
            this.isSubmitting = false;
            
            // Reset button
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalBtnText;
            
            // Show error message
            this.showError(error.message || `Failed to create ${this.bookingType}. Please try again.`);
            console.error(`Error creating ${this.bookingType}:`, error);
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
    PaymentModal.init();
});

document.addEventListener('contentChanged', function() {
    PaymentModal.init();
});
</script>
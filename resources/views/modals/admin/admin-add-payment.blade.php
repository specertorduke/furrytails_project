<!-- Add Payment Modal -->
<div id="addPayment-modal" tabindex="-1" aria-hidden="true" class="tw-hidden tw-fixed tw-top-0 tw-left-0 tw-right-0 tw-z-50 tw-w-full tw-p-4 tw-overflow-x-hidden tw-overflow-y-auto md:tw-inset-0 tw-h-full tw-max-h-full tw-flex tw-items-center tw-justify-center tw-backdrop-blur-sm tw-bg-black/60">
    <div class="tw-relative tw-w-full tw-max-w-md tw-max-h-full tw-animate-modal-entry">
        <!-- Modal content -->
        <div class="tw-relative tw-bg-gray-800 tw-rounded-lg tw-shadow-sm tw-transform tw-transition-all">
            <!-- Modal header -->
            <div class="tw-flex tw-items-center tw-justify-between tw-p-4 md:tw-p-5 tw-border-b tw-rounded-t tw-border-gray-700">
                <h3 class="tw-text-lg tw-font-semibold tw-text-white">Record Payment</h3>
                <button type="button" class="tw-text-gray-400 tw-bg-transparent tw-hover:tw-bg-gray-700 tw-hover:tw-text-white tw-rounded-lg tw-text-sm tw-w-8 tw-h-8 ms-auto tw-inline-flex tw-justify-center tw-items-center" data-modal-toggle="addPayment-modal">
                    <svg class="tw-w-3 tw-h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            
            <!-- Modal body -->
            <form id="addPaymentForm" class="tw-p-4 md:tw-p-5">
                <!-- User selection field -->
                <div class="tw-mb-4">
                    <label for="payment-user" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white">Select User</label>
                    <select id="payment-user" name="payment-user" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required>
                        <option value="">Select a user</option>
                        <!-- User options will be populated via AJAX -->
                    </select>
                </div>

                <!-- Unpaid booking selection field -->
                <div class="tw-mb-4">
                    <label for="payment-booking" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white">Select Unpaid Booking</label>
                    <select id="payment-booking" name="payment-booking" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required disabled>
                        <option value="">Select a user first</option>
                    </select>
                </div>

                <!-- Amount -->
                <div class="tw-mb-4">
                    <label for="payment-amount" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white">Amount (₱)</label>
                    <div class="tw-relative">
                        <span class="tw-absolute tw-inset-y-0 tw-left-0 tw-flex tw-items-center tw-pl-3 tw-pointer-events-none tw-text-gray-400">₱</span>
                        <input type="number" name="payment-amount" id="payment-amount" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-pl-8 tw-p-2.5" required min="0" step="0.01" placeholder="0.00">
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="tw-mb-4">
                    <label for="payment-method" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white">Payment Method</label>
                    <select id="payment-method" name="payment-method" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required>
                        <option value="">Select payment method</option>
                        <option value="Cash">Cash</option>
                        <option value="Credit Card">Credit Card</option>
                        <option value="Debit Card">Debit Card</option>
                        <option value="PayPal">PayPal</option>
                        <option value="GCash">GCash</option>
                        <option value="Bank Transfer">Bank Transfer</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <!-- Reference Number -->
                <div class="tw-mb-4">
                    <label for="payment-reference" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white">Reference Number (Optional)</label>
                    <input type="text" name="payment-reference" id="payment-reference" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" placeholder="Transaction ID, receipt number, etc.">
                </div>

                <!-- Status -->
                <div class="tw-mb-4">
                    <label for="payment-status" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white">Status</label>
                    <select id="payment-status" name="payment-status" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required>
                        <option value="Pending">Pending</option>
                        <option value="Completed" selected>Completed</option>
                        <option value="Failed">Failed</option>
                        <option value="Refunded">Refunded</option>
                    </select>
                </div>
                
                <button type="submit" class="tw-text-black tw-inline-flex tw-items-center tw-bg-green-600 hover:tw-bg-green-500 focus:tw-outline-none focus:tw-bg-green-700 tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center">
                    <i class="fas fa-plus-circle tw-mr-2"></i>
                    Record Payment
                </button>
            </form>
        </div>
    </div>
</div>

<script>
// Create a namespace for our payment modal functionality
const AdminPaymentModal = {
    // Store elements references
    elements: {
        userSelect: null,
        bookingSelect: null,
        amountInput: null,
        methodSelect: null,
        referenceInput: null,
        statusSelect: null,
        form: null,
        modal: null
    },
    
    // Submission state tracking
    isSubmitting: false,
    
    // Initialize the modal functionality
    init: function() {
        // Get elements
        this.elements.userSelect = document.getElementById('payment-user');
        this.elements.bookingSelect = document.getElementById('payment-booking');
        this.elements.amountInput = document.getElementById('payment-amount');
        this.elements.methodSelect = document.getElementById('payment-method');
        this.elements.referenceInput = document.getElementById('payment-reference');
        this.elements.statusSelect = document.getElementById('payment-status');
        this.elements.form = document.getElementById('addPaymentForm');
        this.elements.modal = document.getElementById('addPayment-modal');
        
        // Set up event handlers
        this.setupEventHandlers();
    },
    
    setupEventHandlers: function() {
        // Setup modal toggle button
        const modalToggleBtn = document.getElementById('addPaymentBtn');
        if (modalToggleBtn) {
            modalToggleBtn.addEventListener('click', () => {
                // Show the modal by removing the hidden class
                if (this.elements.modal) {
                    this.elements.modal.classList.remove('tw-hidden');
                    this.resetForm();
                    // Load users when opening the modal
                    this.loadUsers();
                }
            });
        }
        
        // Setup modal close button
        const closeModalBtn = document.querySelector('[data-modal-toggle="addPayment-modal"]');
        if (closeModalBtn) {
            closeModalBtn.addEventListener('click', () => {
                if (this.elements.modal) {
                    this.elements.modal.classList.add('tw-hidden');
                }
            });
        }
        
        // Setup user selection change handler
        if (this.elements.userSelect) {
            this.elements.userSelect.addEventListener('change', () => {
                this.loadUnpaidBookings();
            });
        }
        
        // Setup form submission
        if (this.elements.form) {
            this.elements.form.addEventListener('submit', this.handleFormSubmit.bind(this));
        }
    },
    
    resetForm: function() {
        if (this.elements.form) {
            this.elements.form.reset();
        }
        
        // Reset booking select
        if (this.elements.bookingSelect) {
            this.elements.bookingSelect.innerHTML = '<option value="">Select a user first</option>';
            this.elements.bookingSelect.disabled = true;
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
    
    loadUnpaidBookings: function() {
        const userId = this.elements.userSelect.value;
        
        // Reset and disable booking select if no user is selected
        if (!userId) {
            this.elements.bookingSelect.innerHTML = '<option value="">Select a user first</option>';
            this.elements.bookingSelect.disabled = true;
            return;
        }
        
        // Enable booking select and show loading state
        this.elements.bookingSelect.disabled = false;
        this.elements.bookingSelect.innerHTML = '<option value="">Loading unpaid bookings...</option>';
        
        // Endpoint for getting unpaid bookings
        const endpoint = `{{ route('admin.bookings.unpaid') }}?userID=${userId}`;

        // Fetch unpaid bookings for this user
        fetch(endpoint, {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log('Unpaid bookings data received:', data);
            this.elements.bookingSelect.innerHTML = '<option value="">Select a booking</option>';
            
            const appointments = data.appointments || [];
            const boardings = data.boardings || [];
            
            if (appointments.length === 0 && boardings.length === 0) {
                this.elements.bookingSelect.innerHTML += '<option value="" disabled>No unpaid bookings found for this user</option>';
            } else {
                // Add appointment options with styling
                if (appointments.length > 0) {
                    this.elements.bookingSelect.innerHTML += '<optgroup label="Appointments">';
                    appointments.forEach(appointment => {
                        const serviceDate = new Date(appointment.date).toLocaleDateString();
                        const serviceName = appointment.service?.name || 'Unknown Service';
                        const servicePrice = appointment.price || (appointment.service?.price || 0);
                        const remainingBalance = appointment.remaining_balance || servicePrice;
                        const partialPaymentBadge = appointment.is_partially_paid ? 
                            '<span class="tw-ml-1 tw-px-1 tw-py-0.5 tw-bg-yellow-900 tw-text-yellow-300 tw-rounded-sm tw-text-xs">Partial</span>' : '';
                        
                        this.elements.bookingSelect.innerHTML += `
                            <option value="A${appointment.appointmentID}" data-price="${remainingBalance}" data-type="appointment">
                                ${serviceName} (${serviceDate}) - ₱${remainingBalance.toFixed(2)} ${partialPaymentBadge}
                            </option>`;
                    });
                    this.elements.bookingSelect.innerHTML += '</optgroup>';
                }

                // Add boarding options with styling
                if (boardings.length > 0) {
                    this.elements.bookingSelect.innerHTML += '<optgroup label="Boardings">';
                    boardings.forEach(boarding => {
                        const startDate = new Date(boarding.start_date).toLocaleDateString();
                        const endDate = new Date(boarding.end_date).toLocaleDateString();
                        const boardingType = boarding.boardingType || 'Boarding';
                        const boardingPrice = boarding.price || 0;
                        const remainingBalance = boarding.remaining_balance || boardingPrice;
                        const partialPaymentBadge = boarding.is_partially_paid ? 
                            '<span class="tw-ml-1 tw-px-1 tw-py-0.5 tw-bg-yellow-900 tw-text-yellow-300 tw-rounded-sm tw-text-xs">Partial</span>' : '';
                        
                        this.elements.bookingSelect.innerHTML += `
                            <option value="B${boarding.boardingID}" data-price="${remainingBalance}" data-type="boarding">
                                ${boardingType} (${startDate} - ${endDate}) - ₱${remainingBalance.toFixed(2)} ${partialPaymentBadge}
                            </option>`;
                    });
                    this.elements.bookingSelect.innerHTML += '</optgroup>';
                }
            }
            
            // Set up change handler for booking selection to auto-fill amount
            this.elements.bookingSelect.addEventListener('change', () => {
                const selectedOption = this.elements.bookingSelect.options[this.elements.bookingSelect.selectedIndex];
                if (selectedOption && selectedOption.dataset.price) {
                    this.elements.amountInput.value = selectedOption.dataset.price;
                }
            });
        })
        .catch(err => {
            console.error('Error loading unpaid bookings:', err);
            this.elements.bookingSelect.innerHTML = '<option value="">Error loading unpaid bookings</option>';
        });
    },
    
    handleFormSubmit: function(e) {
        e.preventDefault();
        
        if (this.isSubmitting) {
            return;
        }
        
        // Validate form
        if (!this.validateForm()) {
            return;
        }
        
        // Show confirmation dialog
        Swal.fire({
            title: 'Record Payment',
            text: 'Are you sure you want to record this payment?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#4CAF50',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, record it',
            cancelButtonText: 'Cancel',
            background: '#374151',
            color: '#fff'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submitPaymentData();
            }
        });
    },
    
    validateForm: function() {
        // Basic validations
        const userId = this.elements.userSelect.value;
        if (!userId) {
            this.showError('Please select a user');
            return false;
        }
        
        const bookingValue = this.elements.bookingSelect.value;
        if (!bookingValue) {
            this.showError('Please select a booking');
            return false;
        }
        
        const amount = parseFloat(this.elements.amountInput.value);
        if (isNaN(amount) || amount <= 0) {
            this.showError('Please enter a valid amount');
            return false;
        }
        
        const method = this.elements.methodSelect.value;
        if (!method) {
            this.showError('Please select a payment method');
            return false;
        }
        
        const status = this.elements.statusSelect.value;
        if (!status) {
            this.showError('Please select a status');
            return false;
        }
        
        return true;
    },
    
    submitPaymentData: function() {
        this.isSubmitting = true;
        
        const submitButton = this.elements.form.querySelector('button[type="submit"]');
        const originalButtonText = submitButton.innerHTML;
        submitButton.disabled = true;
        submitButton.innerHTML = `<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg> Processing...`;
        
        // Parse booking ID format (A123 or B456)
        const bookingValue = this.elements.bookingSelect.value;
        let payableType, payableId;
        
        if (bookingValue.startsWith('A')) {
            payableType = 'App\\Models\\Appointment';
            payableId = bookingValue.substring(1); // Remove the 'A' prefix
        } else if (bookingValue.startsWith('B')) {
            payableType = 'App\\Models\\Boarding';
            payableId = bookingValue.substring(1); // Remove the 'B' prefix
        } else {
            this.showError('Invalid booking selection');
            return;
        }
        
        // Prepare data
        const paymentData = {
            userID: this.elements.userSelect.value,
            payable_type: payableType,
            payable_id: payableId,
            amount: this.elements.amountInput.value,
            payment_method: this.elements.methodSelect.value,
            reference_number: this.elements.referenceInput.value,
            status: this.elements.statusSelect.value
        };
        
        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // Submit to server
        fetch('{{ route("admin.payments.store") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify(paymentData)
        })
        .then(response => response.json())
        .then(data => {
            this.isSubmitting = false;
            submitButton.disabled = false;
            submitButton.innerHTML = originalButtonText;
            
            if (data.success) {
                Swal.fire({
                    title: 'Success!',
                    text: 'Payment has been recorded successfully',
                    icon: 'success',
                    confirmButtonColor: '#4CAF50',
                    background: '#374151',
                    color: '#fff'
                }).then(() => {
                    // Reset form and close modal
                    this.resetForm();
                    this.elements.modal.classList.add('tw-hidden');
                    
                    // Reload page to reflect changes
                    window.location.reload();
                });
            } else {
                this.showError(data.message || 'Failed to record payment. Please try again.');
            }
        })
        .catch(err => {
            this.isSubmitting = false;
            submitButton.disabled = false;
            submitButton.innerHTML = originalButtonText;
            
            console.error('Error recording payment:', err);
            this.showError('Failed to record payment. Please try again.');
        });
    },
    
    showError: function(message) {
        Swal.fire({
            title: 'Error',
            text: message,
            icon: 'error',
            confirmButtonColor: '#4CAF50',
            background: '#374151',
            color: '#fff'
        });
    }
};

// Initialize after DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    AdminPaymentModal.init();
});

// Initialize when content is dynamically loaded
document.addEventListener('contentChanged', function() {
    AdminPaymentModal.init();
});
</script>
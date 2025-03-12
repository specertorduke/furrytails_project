<!-- Edit Payment Modal -->
<div id="editPayment-modal" tabindex="-1" aria-hidden="true" class="tw-hidden tw-fixed tw-top-0 tw-left-0 tw-right-0 tw-z-50 tw-w-full tw-p-4 tw-overflow-x-hidden tw-overflow-y-auto md:tw-inset-0 tw-h-full tw-max-h-full tw-flex tw-items-center tw-justify-center tw-backdrop-blur-sm tw-bg-black/60">
    <div class="tw-relative tw-w-full tw-max-w-md tw-max-h-full tw-animate-modal-entry">
        <!-- Modal content -->
        <div class="tw-relative tw-bg-gray-800 tw-rounded-lg tw-shadow-sm tw-transform tw-transition-all">
            <!-- Modal header -->
            <div class="tw-flex tw-items-center tw-justify-between tw-p-4 md:tw-p-5 tw-border-b tw-rounded-t tw-border-gray-700">
                <h3 class="tw-text-lg tw-font-semibold tw-text-white">Edit Payment</h3>
                <button type="button" class="tw-text-gray-400 tw-bg-transparent tw-hover:tw-bg-gray-700 tw-hover:tw-text-white tw-rounded-lg tw-text-sm tw-w-8 tw-h-8 ms-auto tw-inline-flex tw-justify-center tw-items-center" data-modal-toggle="editPayment-modal">
                    <svg class="tw-w-3 tw-h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            
            <!-- Modal body -->
            <div class="tw-p-4 md:tw-p-5">
                <form id="editPaymentForm">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" id="editPaymentID" name="paymentID">
                    
                    <!-- Payment Information -->
                    <div class="tw-mb-6">
                        <h4 class="tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-3">Payment Information</h4>
                        
                        <!-- User and Service Information (Read-only) -->
                        <div class="tw-bg-gray-700/30 tw-p-3 tw-rounded-lg tw-mb-4">
                            <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-y-2 tw-gap-x-3">
                                <div class="tw-text-gray-400 tw-text-sm">Client:</div>
                                <div id="edit-payment-client" class="tw-text-white tw-text-sm"></div>
                                
                                <div class="tw-text-gray-400 tw-text-sm">Service:</div>
                                <div id="edit-payment-service" class="tw-text-white tw-text-sm"></div>
                                
                                <div class="tw-text-gray-400 tw-text-sm">Date:</div>
                                <div id="edit-payment-date" class="tw-text-white tw-text-sm"></div>
                            </div>
                        </div>
                        
                        <!-- Amount -->
                        <div class="tw-mb-4">
                            <label for="edit-payment-amount" class="tw-block tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-1">Amount (₱)</label>
                            <div class="tw-relative">
                                <span class="tw-absolute tw-inset-y-0 tw-left-0 tw-flex tw-items-center tw-pl-3 tw-pointer-events-none tw-text-gray-400">₱</span>
                                <input type="number" name="amount" id="edit-payment-amount" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-pl-8 tw-p-2.5" required min="0" step="0.01" placeholder="0.00">
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="tw-mb-4">
                            <label for="edit-payment-method" class="tw-block tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-1">Payment Method</label>
                            <select id="edit-payment-method" name="payment_method" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required>
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
                            <label for="edit-payment-reference" class="tw-block tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-1">Reference Number (Optional)</label>
                            <input type="text" name="reference_number" id="edit-payment-reference" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" placeholder="Transaction ID, receipt number, etc.">
                        </div>
                        
                        <!-- Status -->
                        <div class="tw-mt-4">
                            <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-3">Payment Status</label>
                            
                            <!-- Hidden input to store the selected status -->
                            <input type="hidden" id="edit-payment-status" name="status" value="Pending">
                            
                            <div class="tw-flex tw-flex-wrap tw-gap-2">
                                <button type="button" data-status="Pending" class="payment-status-button tw-px-4 tw-py-2 tw-rounded-md tw-text-sm tw-font-medium tw-flex tw-items-center tw-gap-2 tw-bg-gray-700 hover:tw-bg-yellow-700">
                                    <i class="fas fa-clock"></i> Pending
                                </button>
                                
                                <button type="button" data-status="Completed" class="payment-status-button tw-px-4 tw-py-2 tw-rounded-md tw-text-sm tw-font-medium tw-flex tw-items-center tw-gap-2 tw-bg-gray-700 hover:tw-bg-green-700">
                                    <i class="fas fa-check-circle"></i> Completed
                                </button>
                                
                                <button type="button" data-status="Failed" class="payment-status-button tw-px-4 tw-py-2 tw-rounded-md tw-text-sm tw-font-medium tw-flex tw-items-center tw-gap-2 tw-bg-gray-700 hover:tw-bg-red-700">
                                    <i class="fas fa-times-circle"></i> Failed
                                </button>
                                
                                <button type="button" data-status="Refunded" class="payment-status-button tw-px-4 tw-py-2 tw-rounded-md tw-text-sm tw-font-medium tw-flex tw-items-center tw-gap-2 tw-bg-gray-700 hover:tw-bg-purple-700">
                                    <i class="fas fa-undo"></i> Refunded
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Actions Section -->
                    <div class="tw-flex tw-justify-between tw-mt-8 tw-pt-4 tw-border-t tw-border-gray-700">
                        <button type="button" data-modal-toggle="editPayment-modal" class="tw-text-gray-300 tw-bg-gray-700 hover:tw-bg-gray-600 tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center">
                            Cancel
                        </button>
                        <button type="submit" id="savePaymentBtn" class="tw-text-white tw-bg-[#24CFF4] hover:tw-bg-blue-500 tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center tw-flex tw-items-center">
                            <i class="fas fa-save tw-mr-2"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
['DOMContentLoaded', 'contentChanged'].forEach(eventName => {
    document.addEventListener(eventName, function() {
        // Global variable to store the editing payment's ID
        let editingPaymentID = null;

        // Make function available globally
        window.openEditPaymentModal = function(paymentId) {
            // Store the payment ID we're editing
            editingPaymentID = paymentId;
            
            // Show loading state
            const editPaymentModal = document.getElementById('editPayment-modal');
            if (!editPaymentModal) {
                console.error('Edit payment modal not found in DOM');
                return;
            }
            
            // Show modal
            editPaymentModal.classList.remove('tw-hidden');
            
            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            // Fetch payment data
            fetch(`{{ route('admin.payments.show', '') }}/${paymentId}`, {
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
                        throw new Error(err.message || 'Failed to load payment data');
                    });
                }
                return response.json();
            })
            .then(data => {
                if (!data.success) {
                    throw new Error(data.message || 'Failed to load payment data');
                }
                
                // Populate form with data
                populatePaymentForm(data.data);
            })
            .catch(error => {
                console.error('Error fetching payment data:', error);
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to load payment data',
                    icon: 'error',
                    confirmButtonColor: '#24CFF4',
                    background: '#374151',
                    color: '#fff'
                });
                
                editPaymentModal.classList.add('tw-hidden');
            });
        };
        
        // Function to populate the payment form
        function populatePaymentForm(payment) {
            // Set hidden payment ID
            document.getElementById('editPaymentID').value = payment.paymentID;
            
            // Set amount
            document.getElementById('edit-payment-amount').value = payment.amount;
            
            // Set payment method
            const methodSelect = document.getElementById('edit-payment-method');
            for (let i = 0; i < methodSelect.options.length; i++) {
                if (methodSelect.options[i].value === payment.payment_method) {
                    methodSelect.selectedIndex = i;
                    break;
                }
            }
            
            // Set reference number
            document.getElementById('edit-payment-reference').value = payment.reference_number || '';
            
            // Set status
            updateStatusButtons(payment.status);
            
            // Set read-only information
            if (payment.user) {
                const clientName = `${payment.user.firstName || ''} ${payment.user.lastName || ''}`.trim();
                document.getElementById('edit-payment-client').textContent = clientName || 'Unknown Client';
            } else {
                document.getElementById('edit-payment-client').textContent = 'Unknown Client';
            }
            
            // Set service type and details
            let serviceName = 'Unknown Service';
            const modelName = payment.payable_type.split('\\').pop();
            
            if (modelName === 'Appointment') {
                if (payment.service && payment.service.service) {
                    serviceName = `Appointment: ${payment.service.service.name}`;
                } else {
                    serviceName = 'Appointment';
                }
            } else if (modelName === 'Boarding') {
                if (payment.service) {
                    serviceName = `Boarding: ${payment.service.boardingType || 'Standard'}`;
                } else {
                    serviceName = 'Boarding';
                }
            }
            
            document.getElementById('edit-payment-service').textContent = serviceName;
            
            // Set date
            if (payment.created_at) {
                document.getElementById('edit-payment-date').textContent = formatDateTime(payment.created_at);
            } else {
                document.getElementById('edit-payment-date').textContent = 'Unknown Date';
            }
        }
        
        // Function to update status buttons appearance
        function updateStatusButtons(selectedStatus) {
            // Update the hidden input
            document.getElementById('edit-payment-status').value = selectedStatus;
            
            // Update button appearance
            const buttons = document.querySelectorAll('.payment-status-button');
            buttons.forEach(button => {
                const status = button.getAttribute('data-status');
                
                // Reset all buttons
                button.classList.remove('tw-bg-yellow-700', 'tw-bg-green-700', 'tw-bg-red-700', 'tw-bg-purple-700');
                button.classList.add('tw-bg-gray-700');
                
                // Highlight selected button
                if (status === selectedStatus) {
                    button.classList.remove('tw-bg-gray-700');
                    
                    // Apply appropriate color based on status
                    switch (status) {
                        case 'Pending':
                            button.classList.add('tw-bg-yellow-700');
                            break;
                        case 'Completed':
                            button.classList.add('tw-bg-green-700');
                            break;
                        case 'Failed':
                            button.classList.add('tw-bg-red-700');
                            break;
                        case 'Refunded':
                            button.classList.add('tw-bg-purple-700');
                            break;
                    }
                }
            });
        }
        
        // Set up event listeners for status buttons
        document.querySelectorAll('.payment-status-button').forEach(button => {
            button.addEventListener('click', function() {
                const status = this.getAttribute('data-status');
                updateStatusButtons(status);
            });
        });

        // Handle form submission
        const editPaymentForm = document.getElementById('editPaymentForm');
        if (editPaymentForm) {
            editPaymentForm.addEventListener('submit', function(event) {
                event.preventDefault();
                
                // Basic validation
                const amount = parseFloat(document.getElementById('edit-payment-amount').value);
                const method = document.getElementById('edit-payment-method').value;
                const status = document.getElementById('edit-payment-status').value;
                
                if (isNaN(amount) || amount <= 0) {
                    Swal.fire({
                        title: 'Invalid Amount',
                        text: 'Please enter a valid amount greater than zero',
                        icon: 'warning',
                        confirmButtonColor: '#24CFF4',
                        background: '#374151',
                        color: '#fff'
                    });
                    return;
                }
                
                if (!method) {
                    Swal.fire({
                        title: 'Missing Information',
                        text: 'Please select a payment method',
                        icon: 'warning',
                        confirmButtonColor: '#24CFF4',
                        background: '#374151',
                        color: '#fff'
                    });
                    return;
                }
                
                if (!status) {
                    Swal.fire({
                        title: 'Missing Information',
                        text: 'Please select a payment status',
                        icon: 'warning',
                        confirmButtonColor: '#24CFF4',
                        background: '#374151',
                        color: '#fff'
                    });
                    return;
                }
                
                // Show loading state
                const saveButton = document.getElementById('savePaymentBtn');
                const originalButtonHTML = saveButton.innerHTML;
                saveButton.disabled = true;
                saveButton.innerHTML = '<i class="fas fa-spinner fa-spin tw-mr-2"></i> Saving...';
                
                // Prepare the data for submission
                const formData = {
                    amount: amount,
                    payment_method: method,
                    reference_number: document.getElementById('edit-payment-reference').value,
                    status: status,
                    _method: 'PUT' // Laravel method spoofing
                };
                
                // Get CSRF token
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                
                // Send update request
                fetch(`{{ route('admin.payments.update', '') }}/${editingPaymentID}`, {
                    method: 'POST', // POST with _method=PUT for Laravel method spoofing
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(formData)
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(data => {
                            throw new Error(data.message || 'Server error: ' + response.status);
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Show success message
                        Swal.fire({
                            title: 'Success!',
                            text: 'Payment updated successfully',
                            icon: 'success',
                            confirmButtonColor: '#24CFF4',
                            background: '#374151',
                            color: '#fff'
                        }).then(() => {
                            // Hide modal and refresh data
                            document.getElementById('editPayment-modal').classList.add('tw-hidden');
                            
                            // Refresh the payments table
                            if (window.PaymentsPage && window.PaymentsPage.paymentsTable) {
                                window.PaymentsPage.paymentsTable.ajax.reload();
                            } else {
                                // If we can't refresh the table, reload the page
                                window.location.reload();
                            }
                        });
                    } else {
                        throw new Error(data.message || 'Failed to update payment');
                    }
                })
                .catch(error => {
                    console.error('Error updating payment:', error);
                    Swal.fire({
                        title: 'Error!',
                        text: error.message || 'Failed to update payment',
                        icon: 'error',
                        confirmButtonColor: '#24CFF4',
                        background: '#374151',
                        color: '#fff'
                    });
                })
                .finally(() => {
                    // Restore button state
                    saveButton.disabled = false;
                    saveButton.innerHTML = originalButtonHTML;
                });
            });
        }
        
        // Connect the global edit function to the PaymentsPage namespace
        if (window.PaymentsPage) {
            window.PaymentsPage.editPayment = window.openEditPaymentModal;
        }
        
        // Modal close handler
        const editModalToggle = document.querySelector('[data-modal-toggle="editPayment-modal"]');
        if (editModalToggle) {
            editModalToggle.addEventListener('click', function() {
                document.getElementById('editPayment-modal').classList.add('tw-hidden');
            });
        }
        
        // Utility function to format date and time
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
    });
});
</script>
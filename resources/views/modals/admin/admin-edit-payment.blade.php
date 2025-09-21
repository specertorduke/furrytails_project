<!-- Edit Payment Modal -->
<div id="editPayment-modal" tabindex="-1" aria-hidden="true" class="tw-hidden tw-fixed tw-top-0 tw-left-0 tw-right-0 tw-z-50 tw-w-full tw-p-4 tw-overflow-x-hidden tw-overflow-y-auto md:tw-inset-0 tw-h-full tw-max-h-full tw-flex tw-items-center tw-justify-center tw-backdrop-blur-sm tw-bg-black/60">
    <div class="tw-relative tw-w-full tw-max-w-md tw-max-h-full tw-animate-modal-entry">
        <!-- Modal content -->
        <div class="tw-relative tw-bg-gray-800 tw-rounded-lg tw-shadow-sm tw-transform tw-transition-all">
            <!-- Modal header -->
            <div class="tw-flex tw-items-center tw-justify-between tw-p-4 md:tw-p-5 tw-border-b tw-rounded-t tw-border-gray-700">
                <h3 class="tw-text-lg tw-font-semibold tw-text-white">Update Payment Status</h3>
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
                    
                    <!-- Payment Information (Read-only) -->
                    <div class="tw-mb-6">
                        <h4 class="tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-3">Payment Details</h4>
                        
                        <div class="tw-bg-gray-700/30 tw-p-4 tw-rounded-lg tw-mb-4">
                            <div class="tw-space-y-3">
                                <div class="tw-flex tw-justify-between">
                                    <span class="tw-text-gray-400 tw-text-sm">Payment ID:</span>
                                    <span id="edit-payment-id" class="tw-text-white tw-text-sm tw-font-medium"></span>
                                </div>
                                
                                <div class="tw-flex tw-justify-between">
                                    <span class="tw-text-gray-400 tw-text-sm">Client:</span>
                                    <span id="edit-payment-client" class="tw-text-white tw-text-sm"></span>
                                </div>
                                
                                <div class="tw-flex tw-justify-between">
                                    <span class="tw-text-gray-400 tw-text-sm">Service:</span>
                                    <span id="edit-payment-service" class="tw-text-white tw-text-sm"></span>
                                </div>
                                
                                <div class="tw-flex tw-justify-between">
                                    <span class="tw-text-gray-400 tw-text-sm">Amount:</span>
                                    <span id="edit-payment-amount-display" class="tw-text-white tw-text-sm tw-font-medium"></span>
                                </div>
                                
                                <div class="tw-flex tw-justify-between">
                                    <span class="tw-text-gray-400 tw-text-sm">Payment Method:</span>
                                    <span id="edit-payment-method-display" class="tw-text-white tw-text-sm"></span>
                                </div>
                                
                                <div class="tw-flex tw-justify-between">
                                    <span class="tw-text-gray-400 tw-text-sm">Reference:</span>
                                    <span id="edit-payment-reference-display" class="tw-text-white tw-text-sm"></span>
                                </div>
                                
                                <div class="tw-flex tw-justify-between">
                                    <span class="tw-text-gray-400 tw-text-sm">Date:</span>
                                    <span id="edit-payment-date" class="tw-text-white tw-text-sm"></span>
                                </div>
                                
                                <div class="tw-flex tw-justify-between">
                                    <span class="tw-text-gray-400 tw-text-sm">Current Status:</span>
                                    <span id="edit-payment-current-status" class="tw-text-sm tw-font-medium tw-px-2 tw-py-1 tw-rounded"></span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Status Update Section -->
                        <div class="tw-mt-4">
                            <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-3">Update Payment Status</label>
                            
                            <!-- Hidden input to store the selected status -->
                            <input type="hidden" id="edit-payment-status" name="status" value="">
                            
                            <div class="tw-grid tw-grid-cols-2 tw-gap-2">
                                <button type="button" data-status="Pending" class="payment-status-button tw-px-4 tw-py-3 tw-rounded-md tw-text-sm tw-font-medium tw-flex tw-items-center tw-justify-center tw-gap-2 tw-bg-gray-700 hover:tw-bg-yellow-600 tw-transition-colors">
                                    <i class="fas fa-clock"></i> Pending
                                </button>
                                
                                <button type="button" data-status="Completed" class="payment-status-button tw-px-4 tw-py-3 tw-rounded-md tw-text-sm tw-font-medium tw-flex tw-items-center tw-justify-center tw-gap-2 tw-bg-gray-700 hover:tw-bg-green-600 tw-transition-colors">
                                    <i class="fas fa-check-circle"></i> Completed
                                </button>
                                
                                <button type="button" data-status="Failed" class="payment-status-button tw-px-4 tw-py-3 tw-rounded-md tw-text-sm tw-font-medium tw-flex tw-items-center tw-justify-center tw-gap-2 tw-bg-gray-700 hover:tw-bg-red-600 tw-transition-colors">
                                    <i class="fas fa-times-circle"></i> Failed
                                </button>
                                
                                <button type="button" data-status="Refunded" class="payment-status-button tw-px-4 tw-py-3 tw-rounded-md tw-text-sm tw-font-medium tw-flex tw-items-center tw-justify-center tw-gap-2 tw-bg-gray-700 hover:tw-bg-purple-600 tw-transition-colors">
                                    <i class="fas fa-undo"></i> Refunded
                                </button>
                            </div>
                        </div>
                        
                        <!-- Admin Notes -->
                        <div class="tw-mt-4">
                            <label for="edit-admin-notes" class="tw-block tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-1">Admin Notes (Optional)</label>
                            <textarea id="edit-admin-notes" name="admin_notes" rows="3" 
                                class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" 
                                placeholder="Add notes about this status change..."></textarea>
                        </div>
                    </div>
                    
                    <!-- Admin Password for Security -->
                    <div class="tw-mb-4">
                        <label for="edit-admin-password" class="tw-block tw-text-sm tw-font-medium tw-text-gray-300 tw-mb-1">
                            <i class="fas fa-lock tw-mr-2"></i>Admin Password (Required)
                        </label>
                        <input type="password" id="edit-admin-password" name="admin_password" 
                            class="tw-w-full tw-bg-gray-700 tw-text-white tw-border-gray-600 tw-rounded-lg tw-px-3 tw-py-2" 
                            placeholder="Enter your current password" required>
                        <p class="tw-text-xs tw-text-gray-400 tw-mt-1">Required for security when updating payment status</p>
                    </div>
                    
                    <!-- Actions Section -->
                    <div class="tw-flex tw-justify-between tw-mt-8 tw-pt-4 tw-border-t tw-border-gray-700">
                        <button type="button" data-modal-toggle="editPayment-modal" class="tw-text-gray-300 tw-bg-gray-700 hover:tw-bg-gray-600 tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center">
                            Cancel
                        </button>
                        <button type="submit" id="savePaymentBtn" class="tw-bg-blue-600 hover:tw-bg-blue-700 tw-text-white tw-px-5 tw-py-2.5 tw-rounded-lg tw-font-medium tw-text-sm tw-flex tw-items-center">
                            <i class="fas fa-save tw-mr-2"></i>Update Status
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
        window.currentPaymentId = null; 

        // Make function available globally
        window.openEditPaymentModal = function(paymentId) {
            // Store the payment ID we're editing
            window.currentPaymentId = paymentId;
            
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
            
            // Display payment information (read-only)
            document.getElementById('edit-payment-id').textContent = `#${payment.paymentID}`;
            document.getElementById('edit-payment-amount-display').textContent = `₱${parseFloat(payment.amount).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
            document.getElementById('edit-payment-method-display').textContent = payment.payment_method || 'Not specified';
            document.getElementById('edit-payment-reference-display').textContent = payment.reference_number || 'None';
            
            // Set current status display
            displayCurrentStatus(payment.status);
            
            // Set status for selection (current status)
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
            
            // Clear previous admin notes
            document.getElementById('edit-admin-notes').value = '';
            document.getElementById('edit-admin-password').value = '';
        }
        
        // Function to display current status with appropriate styling
        function displayCurrentStatus(status) {
            const statusElement = document.getElementById('edit-payment-current-status');
            statusElement.textContent = status;
            
            // Remove all status classes
            statusElement.classList.remove('tw-bg-yellow-700', 'tw-bg-green-700', 'tw-bg-red-700', 'tw-bg-purple-700', 'tw-text-yellow-100', 'tw-text-green-100', 'tw-text-red-100', 'tw-text-purple-100');
            
            // Apply appropriate color based on status
            switch (status) {
                case 'Pending':
                    statusElement.classList.add('tw-bg-yellow-700', 'tw-text-yellow-100');
                    break;
                case 'Completed':
                    statusElement.classList.add('tw-bg-green-700', 'tw-text-green-100');
                    break;
                case 'Failed':
                    statusElement.classList.add('tw-bg-red-700', 'tw-text-red-100');
                    break;
                case 'Refunded':
                    statusElement.classList.add('tw-bg-purple-700', 'tw-text-purple-100');
                    break;
                default:
                    statusElement.classList.add('tw-bg-gray-700', 'tw-text-gray-100');
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
                button.classList.remove('tw-bg-yellow-600', 'tw-bg-green-600', 'tw-bg-red-600', 'tw-bg-purple-600', 'tw-text-white');
                button.classList.add('tw-bg-gray-700', 'tw-text-gray-300');
                
                // Highlight selected button
                if (status === selectedStatus) {
                    button.classList.remove('tw-bg-gray-700', 'tw-text-gray-300');
                    button.classList.add('tw-text-white');
                    
                    // Apply appropriate color based on status
                    switch (status) {
                        case 'Pending':
                            button.classList.add('tw-bg-yellow-600');
                            break;
                        case 'Completed':
                            button.classList.add('tw-bg-green-600');
                            break;
                        case 'Failed':
                            button.classList.add('tw-bg-red-600');
                            break;
                        case 'Refunded':
                            button.classList.add('tw-bg-purple-600');
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

        // Handle form submission with confirmation
        const editPaymentForm = document.getElementById('editPaymentForm');
        if (editPaymentForm) {
            editPaymentForm.addEventListener('submit', function(event) {
                event.preventDefault();
                
                const newStatus = document.getElementById('edit-payment-status').value;
                const adminPassword = document.getElementById('edit-admin-password').value;
                
                // Validation
                if (!newStatus) {
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
                
                if (!adminPassword) {
                    Swal.fire({
                        title: 'Password Required',
                        text: 'Please enter your admin password for security verification',
                        icon: 'warning',
                        confirmButtonColor: '#24CFF4',
                        background: '#374151',
                        color: '#fff'
                    });
                    return;
                }
                
                // Show confirmation dialog
                Swal.fire({
                    title: 'Update Payment Status',
                    text: `Are you sure you want to change the payment status to "${newStatus}"?`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#24CFF4',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, update status!',
                    cancelButtonText: 'Cancel',
                    background: '#374151',
                    color: '#fff'
                }).then((result) => {
                    if (result.isConfirmed) {
                        submitPaymentStatusUpdate();
                    }
                });
            });
        }
        
        // Function to submit the payment status update
        function submitPaymentStatusUpdate() {
            // Show loading state
            const saveButton = document.getElementById('savePaymentBtn');
            const originalButtonHTML = saveButton.innerHTML;
            saveButton.disabled = true;
            saveButton.innerHTML = '<i class="fas fa-spinner fa-spin tw-mr-2"></i> Updating...';
            
            // Prepare the data for submission
            const formData = {
                status: document.getElementById('edit-payment-status').value,
                admin_notes: document.getElementById('edit-admin-notes').value,
                admin_password: document.getElementById('edit-admin-password').value,
                _method: 'PUT'
            };
            
            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            // Send update request
            fetch(`{{ route('admin.payments.update', '') }}/${window.currentPaymentId}`, {
                method: 'POST',
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
                        text: 'Payment status updated successfully',
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
                    throw new Error(data.message || 'Failed to update payment status');
                }
            })
            .catch(error => {
                console.error('Error updating payment:', error);
                Swal.fire({
                    title: 'Error!',
                    text: error.message || 'Failed to update payment status',
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
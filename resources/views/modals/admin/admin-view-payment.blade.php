<!-- View Payment Modal -->
<div id="viewPayment-modal" tabindex="-1" aria-hidden="true" class="tw-hidden tw-fixed tw-top-0 tw-left-0 tw-right-0 tw-z-50 tw-w-full tw-p-4 tw-overflow-x-hidden tw-overflow-y-auto md:tw-inset-0 tw-h-full tw-max-h-full tw-flex tw-items-center tw-justify-center tw-backdrop-blur-sm tw-bg-black/60">
    <div class="tw-relative tw-w-full tw-max-w-2xl tw-max-h-full tw-animate-modal-entry">
        <!-- Modal content -->
        <div class="tw-relative tw-bg-gray-800 tw-rounded-lg tw-shadow-sm tw-transform tw-transition-all">
            <!-- Modal header -->
            <div class="tw-flex tw-items-center tw-justify-between tw-p-4 md:tw-p-5 tw-border-b tw-rounded-t tw-border-gray-700">
                <h3 class="tw-text-lg tw-font-semibold tw-text-white">Payment Details</h3>
                <button type="button" class="tw-text-gray-400 tw-bg-transparent tw-hover:tw-bg-gray-700 tw-hover:tw-text-white tw-rounded-lg tw-text-sm tw-w-8 tw-h-8 ms-auto tw-inline-flex tw-justify-center tw-items-center" data-modal-toggle="viewPayment-modal">
                    <svg class="tw-w-3 tw-h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            
            <!-- Modal body -->
            <div class="tw-p-4 md:tw-p-5">
                <!-- Payment Status Badge - Shown at the top for visibility -->
                <div class="tw-flex tw-justify-center tw-mb-5">
                    <div id="paymentStatusBadge" class="tw-px-4 tw-py-2 tw-rounded-full tw-text-sm tw-font-medium">
                        <!-- Status will be set via JavaScript -->
                        <span id="paymentStatusText">Loading...</span>
                    </div>
                </div>

                <!-- Payment Info Section -->
                <div class="tw-flex tw-flex-col md:tw-flex-row tw-gap-6">
                    <!-- Payment Icon Column -->
                    <div class="tw-flex tw-flex-col tw-items-center">
                        <div id="paymentIcon" class="tw-h-32 tw-w-32 tw-rounded-full tw-bg-gray-700 tw-flex tw-items-center tw-justify-center tw-overflow-hidden">
                            <!-- Icon will be set via JavaScript -->
                            <i class="fas fa-file-invoice-dollar tw-text-5xl tw-text-green-500"></i>
                        </div>
                        <p id="paymentAmount" class="tw-mt-3 tw-text-xl tw-font-semibold tw-text-white">₱0.00</p>
                        <p id="paymentMethod" class="tw-text-sm tw-text-gray-400"></p>
                    </div>
                    
                    <!-- Payment Details Column -->
                    <div class="tw-flex-1">
                        <h4 class="tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-2">Payment Details</h4>
                        
                        <!-- Reference Information -->
                        <div class="tw-bg-gray-700/30 tw-p-3 tw-rounded-lg tw-mb-4">
                            <div class="tw-grid tw-grid-cols-2 tw-gap-y-2">
                                <div class="tw-text-gray-400 tw-text-sm">Payment ID:</div>
                                <div id="paymentId" class="tw-text-white tw-text-sm tw-font-medium"></div>
                                
                                <div class="tw-text-gray-400 tw-text-sm">Reference Number:</div>
                                <div id="referenceNumber" class="tw-text-white tw-text-sm"></div>
                                
                                <div class="tw-text-gray-400 tw-text-sm">Date:</div>
                                <div id="paymentDate" class="tw-text-white tw-text-sm"></div>
                            </div>
                        </div>
                        
                        <!-- Service Information Section -->
                        <div class="tw-mt-4 tw-p-3 tw-bg-gray-700/30 tw-rounded-lg tw-mb-4">
                            <h4 class="tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-2">Service Information</h4>
                            <div class="tw-grid tw-grid-cols-2 tw-gap-y-2">
                                <div class="tw-text-gray-400 tw-text-sm">Service Type:</div>
                                <div id="serviceType" class="tw-text-white tw-text-sm tw-flex tw-items-center">
                                    <i id="serviceTypeIcon" class="fas fa-question-circle tw-mr-2 tw-text-gray-400"></i>
                                    <span id="serviceTypeName">Unknown</span>
                                </div>
                                
                                <div class="tw-text-gray-400 tw-text-sm">Service Name:</div>
                                <div id="serviceName" class="tw-text-white tw-text-sm"></div>
                                
                                <div id="serviceDateRow" class="tw-text-gray-400 tw-text-sm">Service Date:</div>
                                <div id="serviceDate" class="tw-text-white tw-text-sm"></div>
                                
                                <div id="petRow" class="tw-text-gray-400 tw-text-sm">Pet:</div>
                                <div id="petName" class="tw-text-white tw-text-sm"></div>
                                
                                <div class="tw-text-gray-400 tw-text-sm tw-col-span-2 tw-mt-2">
                                    <a href="#" id="viewServiceBtn" class="tw-text-[#24CFF4] hover:tw-text-blue-300 tw-text-xs tw-flex tw-items-center">
                                        <i class="fas fa-external-link-alt tw-mr-1"></i>
                                        View Service Details
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Client Information -->
                        <div class="tw-mt-4 tw-p-3 tw-bg-gray-700/30 tw-rounded-lg">
                            <h4 class="tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-2">Client Information</h4>
                            <div class="tw-flex tw-items-center">
                                <div id="clientImage" class="tw-h-10 tw-w-10 tw-rounded-full tw-bg-gray-700 tw-flex tw-justify-center tw-items-center tw-overflow-hidden">
                                    <i class="fas fa-user tw-text-gray-500"></i>
                                </div>
                                <div class="tw-ml-3">
                                    <div id="clientName" class="tw-text-sm tw-font-medium tw-text-white">Loading...</div>
                                    <div id="clientEmail" class="tw-text-xs tw-text-gray-400"></div>
                                </div>
                                <div class="tw-ml-auto">
                                    <button id="viewClientBtn" class="tw-text-xs tw-bg-gray-700 tw-text-gray-300 hover:tw-bg-gray-600 tw-px-2 tw-py-1 tw-rounded">
                                        <i class="fas fa-eye tw-mr-1"></i> View Client
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Timestamps Section -->
                        <div class="tw-mt-4 tw-text-xs tw-text-gray-500">
                            <div class="tw-flex tw-justify-between">
                                <span>Created: <span id="paymentCreatedAt"></span></span>
                                <span id="paymentUpdatedBlock" class="tw-hidden">
                                    Last Updated: <span id="paymentUpdatedAt"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Actions Section -->
                <div class="tw-flex tw-justify-between tw-mt-8 tw-pt-4 tw-border-t tw-border-gray-700">
                    <div>
                        <button id="editPaymentBtn" class="tw-text-white tw-bg-blue-600 hover:tw-bg-blue-700 tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center tw-flex tw-items-center">
                            <i class="fas fa-edit tw-mr-2"></i> Edit Payment
                        </button>
                    </div>
                    
                    <div>
                        <!-- Refund button - conditionally displayed based on current status -->
                        <button id="refundPaymentBtn" class="tw-hidden tw-text-white tw-bg-purple-600 hover:tw-bg-purple-700 tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center tw-flex tw-items-center">
                            <i class="fas fa-undo tw-mr-2"></i> Refund Payment
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
['DOMContentLoaded', 'contentChanged'].forEach(eventName => {
    document.addEventListener(eventName, function() {
        // Global variable to store current payment data
        window.currentPaymentData = null;
        
        // Function to open payment modal with data
        window.openPaymentModal = function(paymentId) {
            // Show loading state
            const viewPaymentModal = document.getElementById('viewPayment-modal');
            if (!viewPaymentModal) {
                console.error('View payment modal not found in DOM');
                return;
            }
            
            // Show modal with loading indicator
            viewPaymentModal.classList.remove('tw-hidden');
            
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
                
                // Store current payment data
                window.currentPaymentData = data.data;
                
                // Populate payment information
                populatePaymentData(data.data);
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
                
                viewPaymentModal.classList.add('tw-hidden');
            });
        };
        
        // Function to populate payment data in the modal
        function populatePaymentData(payment) {
            console.log("Populating payment data:", payment);
            
            // Set payment amount with formatting
            document.getElementById('paymentAmount').textContent = formatPrice(payment.amount);
            
            // Set payment method with appropriate icon
            let methodIcon = 'fa-money-bill-wave';
            if (payment.payment_method === 'Credit Card' || payment.payment_method === 'Debit Card') {
                methodIcon = 'fa-credit-card';
            } else if (payment.payment_method === 'PayPal') {
                methodIcon = 'fa-paypal';
            } else if (payment.payment_method === 'GCash') {
                methodIcon = 'fa-mobile-alt';
            } else if (payment.payment_method === 'Bank Transfer') {
                methodIcon = 'fa-university';
            }
            
            document.getElementById('paymentMethod').innerHTML = `<i class="fas ${methodIcon} tw-mr-2"></i> ${payment.payment_method}`;
            
            // Set payment icon based on status
            const paymentIcon = document.getElementById('paymentIcon');
            let iconClass = 'fa-file-invoice-dollar';
            let iconColor = 'tw-text-green-500';
            
            if (payment.status === 'Pending') {
                iconClass = 'fa-clock';
                iconColor = 'tw-text-yellow-500';
            } else if (payment.status === 'Failed') {
                iconClass = 'fa-times-circle';
                iconColor = 'tw-text-red-500';
            } else if (payment.status === 'Refunded') {
                iconClass = 'fa-undo';
                iconColor = 'tw-text-purple-500';
            }
            
            paymentIcon.innerHTML = `<i class="fas ${iconClass} tw-text-5xl ${iconColor}"></i>`;
            
            // Set basic payment details
            document.getElementById('paymentId').textContent = payment.paymentID || 'N/A';
            document.getElementById('referenceNumber').textContent = payment.reference_number || 'N/A';
            document.getElementById('paymentDate').textContent = formatDateTime(payment.created_at);
            
            // Set status badge
            const statusBadge = document.getElementById('paymentStatusBadge');
            const statusText = document.getElementById('paymentStatusText');
            
            switch (payment.status) {
                case 'Completed':
                    statusBadge.className = 'tw-px-4 tw-py-2 tw-rounded-full tw-text-sm tw-font-medium tw-bg-green-900 tw-text-green-300';
                    statusText.innerHTML = '<i class="fas fa-check-circle tw-mr-2"></i> Completed';
                    break;
                case 'Pending':
                    statusBadge.className = 'tw-px-4 tw-py-2 tw-rounded-full tw-text-sm tw-font-medium tw-bg-yellow-900 tw-text-yellow-300';
                    statusText.innerHTML = '<i class="fas fa-clock tw-mr-2"></i> Pending';
                    break;
                case 'Failed':
                    statusBadge.className = 'tw-px-4 tw-py-2 tw-rounded-full tw-text-sm tw-font-medium tw-bg-red-900 tw-text-red-300';
                    statusText.innerHTML = '<i class="fas fa-times-circle tw-mr-2"></i> Failed';
                    break;
                case 'Refunded':
                    statusBadge.className = 'tw-px-4 tw-py-2 tw-rounded-full tw-text-sm tw-font-medium tw-bg-purple-900 tw-text-purple-300';
                    statusText.innerHTML = '<i class="fas fa-undo tw-mr-2"></i> Refunded';
                    break;
                default:
                    statusBadge.className = 'tw-px-4 tw-py-2 tw-rounded-full tw-text-sm tw-font-medium tw-bg-gray-700 tw-text-gray-300';
                    statusText.innerHTML = payment.status || 'Unknown';
            }
            
            // Set service information based on payable_type
            const serviceType = document.getElementById('serviceType');
            const serviceTypeIcon = document.getElementById('serviceTypeIcon');
            const serviceTypeName = document.getElementById('serviceTypeName');
            const serviceName = document.getElementById('serviceName');
            const serviceDate = document.getElementById('serviceDate');
            const petName = document.getElementById('petName');
            const viewServiceBtn = document.getElementById('viewServiceBtn');
            
            // Extract model name from namespace
            const modelName = payment.payable_type.split('\\').pop();
            
            if (modelName === 'Appointment') {
                serviceTypeIcon.className = 'fas fa-calendar-check tw-mr-2 tw-text-[#FF9666]';
                serviceTypeName.textContent = 'Appointment';
                
                if (payment.service && payment.service.service) {
                    serviceName.textContent = payment.service.service.name || 'N/A';
                    serviceDate.textContent = formatDate(payment.service.date) + ' ' + formatTime(payment.service.time);
                    
                    if (payment.service.pet) {
                        petName.textContent = payment.service.pet.name || 'N/A';
                    }
                    
                    // Set up view service button
                    viewServiceBtn.setAttribute('data-id', payment.service.appointmentID);
                    viewServiceBtn.setAttribute('data-type', 'appointment');
                    viewServiceBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        const viewPaymentModal = document.getElementById('viewPayment-modal');
                        viewPaymentModal.classList.add('tw-hidden');
                        if (typeof window.openAppointmentModal === 'function') {
                            window.openAppointmentModal(payment.service.appointmentID);
                        } else {
                            console.error('openAppointmentModal function not found');
                        }
                    });
                }
                
            } else if (modelName === 'Boarding') {
                serviceTypeIcon.className = 'fas fa-home tw-mr-2 tw-text-[#24CFF4]';
                serviceTypeName.textContent = 'Boarding';
                
                if (payment.service) {
                    serviceName.textContent = payment.service.boardingType || 'Standard Boarding';
                    
                    const startDate = formatDate(payment.service.start_date);
                    const endDate = formatDate(payment.service.end_date);
                    serviceDate.textContent = `${startDate} - ${endDate}`;
                    
                    if (payment.service.pet) {
                        petName.textContent = payment.service.pet.name || 'N/A';
                    }
                    
                    // Set up view service button
                    viewServiceBtn.setAttribute('data-id', payment.service.boardingID);
                    viewServiceBtn.setAttribute('data-type', 'boarding');
                    viewServiceBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        const viewPaymentModal = document.getElementById('viewPayment-modal');
                        viewPaymentModal.classList.add('tw-hidden');
                        if (typeof window.openBoardingModal === 'function') {
                            window.openBoardingModal(payment.service.boardingID);
                        } else {
                            console.error('openBoardingModal function not found');
                        }
                    });
                }
            } else {
                // Unknown service type
                serviceTypeIcon.className = 'fas fa-question-circle tw-mr-2 tw-text-gray-400';
                serviceTypeName.textContent = modelName || 'Unknown';
                serviceName.textContent = 'N/A';
                serviceDate.textContent = 'N/A';
                petName.textContent = 'N/A';
                
                // Hide view service button
                viewServiceBtn.style.display = 'none';
            }
            
            // Set client information
            if (payment.user) {
                document.getElementById('clientName').textContent = `${payment.user.firstName || ''} ${payment.user.lastName || ''}`.trim() || 'Unknown Client';
                document.getElementById('clientEmail').textContent = payment.user.email || '';
                
                // Set client image if available
                const clientImage = document.getElementById('clientImage');
                if (payment.user.userImage) {
                    let imageUrl = "{{ asset('storage/') }}/" + payment.user.userImage.replace(/^storage\//i, '');
                    clientImage.innerHTML = `<img src="${imageUrl}" alt="Client" class="tw-h-full tw-w-full tw-object-cover">`;
                }
                
                // Set up view client button - clone and replace to avoid duplicate event listeners
                const viewClientBtn = document.getElementById('viewClientBtn');
                const newViewClientBtn = viewClientBtn.cloneNode(true);
                viewClientBtn.parentNode.replaceChild(newViewClientBtn, viewClientBtn);
                
                newViewClientBtn.addEventListener('click', function() {
                    // Close payment modal first
                    const viewPaymentModal = document.getElementById('viewPayment-modal');
                    viewPaymentModal.classList.add('tw-hidden');
                    // Open user modal with client ID
                    if (typeof window.openUserModal === 'function') {
                        window.openUserModal(payment.user.userID);
                    } else {
                        console.error('openUserModal function not found');
                    }
                });
            }
            
            // Set creation and update timestamps
            if (payment.created_at) {
                document.getElementById('paymentCreatedAt').textContent = formatDateTime(payment.created_at);
            }
            
            if (payment.updated_at && payment.updated_at !== payment.created_at) {
                document.getElementById('paymentUpdatedAt').textContent = formatDateTime(payment.updated_at);
                document.getElementById('paymentUpdatedBlock').classList.remove('tw-hidden');
            } else {
                document.getElementById('paymentUpdatedBlock').classList.add('tw-hidden');
            }
            
            // Set up edit button - clone and replace to avoid duplicate event listeners
            const editBtn = document.getElementById('editPaymentBtn');
            const newEditBtn = editBtn.cloneNode(true);
            editBtn.parentNode.replaceChild(newEditBtn, editBtn);
            
            newEditBtn.addEventListener('click', function() {
                // Close payment modal first
                const viewPaymentModal = document.getElementById('viewPayment-modal');
                viewPaymentModal.classList.add('tw-hidden');
                
                // Call the edit function from PaymentsPage namespace
                if (typeof window.PaymentsPage.editPayment === 'function') {
                    window.PaymentsPage.editPayment(payment.paymentID);
                } else {
                    console.error('editPayment function not found');
                }
            });
            
            // Show/hide refund button based on status
            const refundBtn = document.getElementById('refundPaymentBtn');
            if (payment.status === 'Completed') {
                refundBtn.classList.remove('tw-hidden');
                
                // Set up refund button - clone and replace to avoid duplicate event listeners
                const newRefundBtn = refundBtn.cloneNode(true);
                refundBtn.parentNode.replaceChild(newRefundBtn, refundBtn);
                
                newRefundBtn.addEventListener('click', function() {
                    // Close payment modal first
                    const viewPaymentModal = document.getElementById('viewPayment-modal');
                    viewPaymentModal.classList.add('tw-hidden');
                    
                    // Call the refund function from PaymentsPage namespace
                    if (typeof window.PaymentsPage.markAsRefunded === 'function') {
                        window.PaymentsPage.markAsRefunded(payment.paymentID);
                    } else {
                        console.error('markAsRefunded function not found');
                    }
                });
            } else {
                refundBtn.classList.add('tw-hidden');
            }
        }
        
        // Close modal handler
        const modalToggle = document.querySelector('[data-modal-toggle="viewPayment-modal"]');
        if (modalToggle) {
            modalToggle.addEventListener('click', function() {
                document.getElementById('viewPayment-modal').classList.add('tw-hidden');
            });
        }
        
        // Utility function to format date
        function formatDate(dateString) {
            if (!dateString) return 'Not specified';
            
            const date = new Date(dateString);
            return date.toLocaleDateString('en-US', { 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric'
            });
        }
        
        // Utility function to format time
        function formatTime(timeString) {
            if (!timeString) return '';
            
            // Handle MySQL time format (HH:MM:SS)
            const timeParts = timeString.split(':');
            if (timeParts.length >= 2) {
                let hours = parseInt(timeParts[0], 10);
                const minutes = parseInt(timeParts[1], 10);
                const ampm = hours >= 12 ? 'PM' : 'AM';
                
                hours = hours % 12;
                hours = hours ? hours : 12; // the hour '0' should be '12'
                
                return `${hours}:${minutes.toString().padStart(2, '0')} ${ampm}`;
            }
            
            return timeString;
        }
        
        // Utility function to format date and time together
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
        
        // Function to format price in PHP peso
        function formatPrice(price) {
            return new Intl.NumberFormat('en-PH', {
                style: 'currency',
                currency: 'PHP',
                currencyDisplay: 'symbol',
                minimumFractionDigits: 2
            }).format(price).replace('PHP', '₱');
        }
    });
});
</script>
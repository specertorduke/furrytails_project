<!-- View Boarding Modal -->
<div id="admin-viewBoarding-modal" tabindex="-1" aria-hidden="true" class="tw-hidden tw-fixed tw-top-0 tw-left-0 tw-right-0 tw-z-[9999] tw-w-full tw-p-4 tw-overflow-x-hidden tw-overflow-y-auto md:tw-inset-0 tw-h-full tw-max-h-full tw-flex tw-items-center tw-justify-center tw-backdrop-blur-sm tw-bg-black/60">
    <div class="tw-relative tw-w-full tw-max-w-2xl tw-max-h-full tw-animate-modal-entry">
        <!-- Modal content -->
        <div class="tw-relative tw-bg-gray-800 tw-rounded-lg tw-shadow-sm tw-transform tw-transition-all">
            <!-- Modal header -->
            <div class="tw-flex tw-items-center tw-justify-between tw-p-4 md:tw-p-5 tw-border-b tw-rounded-t tw-border-gray-700">
                <h3 class="tw-text-lg tw-font-semibold tw-text-white">Boarding Details</h3>
                <button type="button" id="adminBoardingModalCloseBtn" class="tw-text-gray-400 tw-bg-transparent tw-hover:tw-bg-gray-700 tw-hover:tw-text-white tw-rounded-lg tw-text-sm tw-w-8 tw-h-8 ms-auto tw-inline-flex tw-justify-center tw-items-center" data-modal-toggle="admin-viewBoarding-modal">
                    <svg class="tw-w-3 tw-h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            
            <!-- Modal body -->
            <div class="tw-p-4 md:tw-p-5">
                <!-- Boarding Status Badge - Shown at the top for visibility -->
                <div class="tw-flex tw-justify-center tw-mb-5">
                    <div id="boardingStatusBadge" class="tw-px-4 tw-py-2 tw-rounded-full tw-text-sm tw-font-medium">
                        <!-- Status will be set via JavaScript -->
                        <span id="adminBoardingStatusText">Loading...</span>
                    </div>
                </div>

                <!-- Payment Status Section -->
                <div class="tw-flex tw-justify-center tw-mb-5" id="adminBoardingPaymentStatusContainer">
                    <div id="adminBoardingPaymentStatusBadge" class="tw-px-4 tw-py-2 tw-rounded-full tw-text-sm tw-font-medium tw-hidden">
                        <span id="adminBoardingPaymentStatusText">No payment info</span>
                    </div>
                </div>

                <!-- Boarding Info Section -->
                <div class="tw-flex tw-flex-col md:tw-flex-row tw-gap-6">
                    <!-- Boarding Type Column -->
                    <div class="tw-flex tw-flex-col tw-items-center">
                        <div id="boardingIcon" class="tw-h-32 tw-w-32 tw-rounded-full tw-bg-gray-700 tw-flex tw-items-center tw-justify-center tw-overflow-hidden">
                            <!-- Icon will be set via JavaScript -->
                            <i class="fas fa-home tw-text-4xl tw-text-[#66FF8F]"></i>
                        </div>
                        <p id="boardingType" class="tw-mt-3 tw-text-lg tw-font-semibold tw-text-white">Loading...</p>
                        <p id="boardingDuration" class="tw-text-sm tw-text-gray-400"></p>
                    </div>
                    
                    <!-- Boarding Details Column -->
                    <div class="tw-flex-1">
                        <h4 class="tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-2">Boarding Details</h4>
                        
                        <!-- Date Information -->
                        <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-4 tw-mb-4">
                            <div>
                                <p class="tw-text-xs tw-text-gray-400">Start Date</p>
                                <p id="boardingStartDate" class="tw-text-sm tw-text-white"></p>
                            </div>
                            <div>
                                <p class="tw-text-xs tw-text-gray-400">End Date</p>
                                <p id="boardingEndDate" class="tw-text-sm tw-text-white"></p>
                            </div>
                        </div>
                        
                        <!-- Price Information Section -->
                        <div class="tw-mt-4 tw-p-3 tw-bg-gray-700/30 tw-rounded-lg tw-mb-4">
                            <h4 class="tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-2">Price Information</h4>
                            <div class="tw-grid tw-grid-cols-2 tw-gap-2">
                                <div>
                                    <p class="tw-text-xs tw-text-gray-400">Base Rate</p>
                                    <p id="baseRate" class="tw-text-sm tw-text-white">₱0.00</p>
                                </div>
                                <div>
                                    <p class="tw-text-xs tw-text-gray-400">Duration</p>
                                    <p id="priceDuration" class="tw-text-sm tw-text-white">0 days</p>
                                </div>
                                <div class="tw-col-span-2">
                                    <p class="tw-text-xs tw-text-gray-400">Total Price</p>
                                    <p id="totalPrice" class="tw-text-lg tw-font-semibold tw-text-[#66FF8F]">₱0.00</p>
                                </div>
                            </div>
                        </div>

                        <!-- Pet Information -->
                        <div class="tw-mt-6 tw-p-3 tw-bg-gray-700/30 tw-rounded-lg">
                            <h4 class="tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-2">Pet Information</h4>
                            <div class="tw-flex tw-items-center tw-gap-3">
                                <div id="adminBoardingPetImage" class="tw-h-10 tw-w-10 tw-rounded-full tw-bg-gray-700 tw-flex tw-items-center tw-justify-center tw-overflow-hidden">
                                    <i class="fas fa-paw tw-text-sm tw-text-gray-500"></i>
                                </div>
                                <div>
                                    <p id="adminBoardingPetName" class="tw-text-sm tw-text-white tw-font-medium"></p>
                                    <div class="tw-flex tw-items-center tw-gap-2">
                                        <span id="adminBoardingPetSpecies" class="tw-text-xs tw-text-gray-400"></span>
                                        <span class="tw-text-xs tw-text-gray-500">•</span>
                                        <span id="adminBoardingPetBreed" class="tw-text-xs tw-text-gray-400"></span>
                                    </div>
                                </div>
                                <button id="adminBoardingViewPetBtn" class="tw-ml-auto tw-text-xs tw-bg-gray-700 hover:tw-bg-gray-600 tw-text-gray-200 tw-px-3 tw-py-1 tw-rounded-lg">
                                    <i class="fas fa-external-link-alt tw-mr-1"></i> View
                                </button>
                            </div>
                        </div>
                        
                        <!-- Client Information -->
                        <div class="tw-mt-4 tw-p-3 tw-bg-gray-700/30 tw-rounded-lg">
                            <h4 class="tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-2">Client Information</h4>
                            <div class="tw-flex tw-items-center tw-gap-3">
                                <div id="adminBoardingClientImage" class="tw-h-10 tw-w-10 tw-rounded-full tw-bg-gray-700 tw-flex tw-items-center tw-justify-center tw-overflow-hidden">
                                    <i class="fas fa-user tw-text-sm tw-text-gray-500"></i>
                                </div>
                                <div>
                                    <p id="adminBoardingClientName" class="tw-text-sm tw-text-white tw-font-medium"></p>
                                    <p id="adminBoardingClientEmail" class="tw-text-xs tw-text-gray-400"></p>
                                </div>
                                <button id="adminBoardingViewClientBtn" class="tw-ml-auto tw-text-xs tw-bg-gray-700 hover:tw-bg-gray-600 tw-text-gray-200 tw-px-3 tw-py-1 tw-rounded-lg">
                                    <i class="fas fa-external-link-alt tw-mr-1"></i> View
                                </button>
                            </div>
                        </div>
                        
                        <!-- Boarding History -->
                        <div class="tw-mt-4">
                            <h4 class="tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-2">Boarding History</h4>
                            <div class="tw-relative">
                                <!-- Timeline will be set via JavaScript -->
                                <div class="tw-border-l-2 tw-border-gray-700 tw-ml-2.5 tw-pl-4 tw-py-2 tw-space-y-4" id="boardingHistory">
                                    <div class="tw-flex tw-items-start">
                                        <div class="tw-absolute tw-mt-1.5 tw-w-5 tw-h-5 tw-rounded-full tw-bg-blue-500 -tw-left-2.5 tw-border tw-border-gray-800"></div>
                                        <div>
                                            <p class="tw-text-xs tw-text-gray-400">Created</p>
                                            <p id="boardingCreatedAt" class="tw-text-sm tw-text-white"></p>
                                        </div>
                                    </div>
                                    <div class="tw-flex tw-items-start" id="boardingUpdatedBlock">
                                        <div class="tw-absolute tw-mt-1.5 tw-w-5 tw-h-5 tw-rounded-full tw-bg-yellow-500 -tw-left-2.5 tw-border tw-border-gray-800"></div>
                                        <div>
                                            <p class="tw-text-xs tw-text-gray-400">Last updated</p>
                                            <p id="boardingUpdatedAt" class="tw-text-sm tw-text-white"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Details Section-->
                        <div class="tw-bg-gray-700/30 tw-p-4 tw-rounded-lg tw-mt-4 tw-hidden" id="adminBoardingPaymentDetailsContainer">
                            <div class="tw-flex tw-justify-between tw-items-center tw-mb-2">
                                <h4 class="tw-text-sm tw-font-medium tw-text-gray-400">Payment History</h4>
                                <span class="tw-text-xs tw-text-gray-400" id="adminBoardingPaymentCount">0 payments</span>
                            </div>
                            
                            <!-- List of payments -->
                            <div class="tw-space-y-3 tw-max-h-60 tw-overflow-y-auto" id="adminBoardingPaymentsListContainer">
                                <!-- Will be populated by JavaScript -->
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Actions Section -->
                <div class="tw-flex tw-justify-between tw-mt-8 tw-pt-4 tw-border-t tw-border-gray-700">
                    <div>
                        <button id="editBoardingBtn" class="tw-text-white tw-bg-blue-600 hover:tw-bg-blue-700 tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center tw-flex tw-items-center">
                            <i class="fas fa-edit tw-mr-2"></i> Edit
                        </button>
                    </div>
                    
                    <div class="tw-flex tw-gap-2">
                        <!-- Status change buttons - conditionally displayed based on current status -->
                        <button id="confirmBoardingBtn" class="tw-hidden tw-text-white tw-bg-green-600 hover:tw-bg-green-700 tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center tw-flex tw-items-center">
                            <i class="fas fa-check tw-mr-2"></i> Confirm
                        </button>
                        
                        <button id="activateBoardingBtn" class="tw-hidden tw-text-white tw-bg-green-500 hover:tw-bg-green-700 tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center tw-flex tw-items-center">
                            <i class="fas fa-bed tw-mr-2"></i> Mark as Active
                        </button>
                        
                        <button id="completeBoardingBtn" class="tw-hidden tw-text-white tw-bg-green-600 hover:tw-bg-green-700 tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center tw-flex tw-items-center">
                            <i class="fas fa-check-double tw-mr-2"></i> Complete
                        </button>
                        
                        <button id="cancelBoardingBtn" class="tw-hidden tw-text-white tw-bg-red-600 hover:tw-bg-red-700 tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center tw-flex tw-items-center">
                            <i class="fas fa-times tw-mr-2"></i> Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function initializeAdminViewBoardingModal() {
    const boardingModal = document.getElementById('admin-viewBoarding-modal');
    if (!boardingModal) {
        return;
    }

    if (boardingModal.parentElement !== document.body) {
        document.body.appendChild(boardingModal);
    }

    const getBoardingElement = (id) => boardingModal.querySelector(`#${id}`);
    const resetBoardingButton = (id) => {
        const button = getBoardingElement(id);
        const replacement = button.cloneNode(true);
        button.parentNode.replaceChild(replacement, button);
        return replacement;
    };
    const showBoardingModal = () => {
        boardingModal.classList.remove('tw-hidden');
        boardingModal.style.display = 'flex';
        boardingModal.style.zIndex = '9999';
        boardingModal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    };
    const hideBoardingModal = () => {
        boardingModal.classList.add('tw-hidden');
        boardingModal.style.display = '';
        boardingModal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    };

            // Global variable to store current boarding data
    window.currentBoardingData = null;
    
    // Function to open boarding modal with data
    window.openBoardingModal = function(boardingID) {
        const viewBoardingModal = boardingModal;
        // Show loading state
        if (!viewBoardingModal) {
            console.error('View boarding modal not found in DOM');
            return;
        }
        
        // Show modal with loading indicator
        showBoardingModal();
        viewBoardingModal.scrollTop = 0;
        
        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // Fetch boarding data
        fetch("{{ route('admin.boardings.show', ['id' => ':boardingId']) }}".replace(':boardingId', boardingID), {
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
                    throw new Error(err.message || 'Failed to load boarding data');
                });
            }
            return response.json();
        })
        .then(data => {
            if (!data.success) {
                throw new Error(data.message || 'Failed to load boarding data');
            }
            
            // Store current boarding data
            window.currentBoardingData = data.boarding;
            
            // Populate boarding information
            populateBoardingData(data.boarding);
        })
        .catch(error => {
            console.error('Error fetching boarding data:', error);
            Swal.fire({
                title: 'Error!',
                text: 'Failed to load boarding data',
                icon: 'error',
                confirmButtonColor: '#66FF8F',
                background: '#374151',
                color: '#fff'
            });
            
            hideBoardingModal();
        });
    };
    
    // Function to populate boarding data in the modal
    function populateBoardingData(boarding) {
        console.log("Populating boarding data:", boarding);
        
        // Set boarding dates
        getBoardingElement('boardingStartDate').textContent = formatDate(boarding.start_date);
        getBoardingElement('boardingEndDate').textContent = formatDate(boarding.end_date);
        
        // Set boarding type and calculate duration
        getBoardingElement('boardingType').textContent = boarding.boardingType || 'Standard Boarding';
        
        // Calculate and set duration
        const startDate = new Date(boarding.start_date);
        const endDate = new Date(boarding.end_date);
        const durationDays = calculateDays(startDate, endDate);
        getBoardingElement('boardingDuration').textContent = `${durationDays} day${durationDays !== 1 ? 's' : ''}`;
        
        // Get base rate from the boarding data (supplied by the controller)
        const baseRate = boarding.baseRate || 0;

        // Calculate price
        const price = calculateBoardingPrice(baseRate, durationDays);
        getBoardingElement('baseRate').textContent = formatPrice(price.baseRate) + ' per day';
        getBoardingElement('priceDuration').textContent = `${durationDays} day${durationDays !== 1 ? 's' : ''}`;
        getBoardingElement('totalPrice').textContent = formatPrice(price.totalPrice);

        // Set boarding icon based on type
        const boardingIcon = getBoardingElement('boardingIcon');
        let iconClass = 'fa-home'; // Default icon
        
        // Customize icon based on boarding type if needed
        const boardingType = (boarding.boardingType || '').toLowerCase();
        if (boardingType.includes('kennel')) {
            iconClass = 'fa-house';
        } else if (boardingType.includes('luxury') || boardingType.includes('premium')) {
            iconClass = 'fa-hotel';
        } else if (boardingType.includes('daycare')) {
            iconClass = 'fa-sun';
        }
        
        boardingIcon.innerHTML = `<i class="fas ${iconClass} tw-text-5xl tw-text-[#66FF8F]"></i>`;
        
        // Handle payment information if available
        if (boarding.payments && boarding.payments.length > 0) {
            try {
                // Sort payments by date (newest first)
                const sortedPayments = [...boarding.payments].sort((a, b) => 
                    new Date(b.created_at) - new Date(a.created_at)
                );
                
                // Calculate total amount paid from completed payments
                const totalPaid = boarding.payments
                    .filter(payment => payment.status === 'Completed')
                    .reduce((sum, payment) => sum + (parseFloat(payment.amount) || 0), 0);
                
                // Get boarding price for comparison
                const boardingPrice = price.totalPrice || 0;
                
                console.log('Payment totals:', { totalPaid, boardingPrice });
                
                // Show payment status badge based on payment total vs boarding price
                const paymentStatusBadge = getBoardingElement('adminBoardingPaymentStatusBadge');
                const paymentStatusText = getBoardingElement('adminBoardingPaymentStatusText');
                
                // Clear existing content to prevent duplication
                while (paymentStatusBadge && paymentStatusBadge.firstChild) {
                    paymentStatusBadge.removeChild(paymentStatusBadge.firstChild);
                }
                
                if (paymentStatusBadge) {
                    paymentStatusBadge.className = 'tw-px-4 tw-py-2 tw-rounded-full tw-text-sm tw-font-medium';
                    paymentStatusBadge.appendChild(paymentStatusText);
                    paymentStatusText.innerHTML = '';
                    
                    paymentStatusBadge.classList.remove('tw-hidden');
                    
                    // Get the most recent payment for additional context
                    const latestPayment = sortedPayments[0];
                    
                    // Determine payment status
                    if (totalPaid >= boardingPrice && boardingPrice > 0) {
                        // Fully paid
                        paymentStatusBadge.classList.add('tw-bg-green-900', 'tw-text-green-300');
                        paymentStatusText.innerHTML = '<i class="fas fa-check-circle tw-mr-2"></i> Paid';
                    } else if (totalPaid > 0) {
                        // Partially paid
                        paymentStatusBadge.classList.add('tw-bg-blue-900', 'tw-text-blue-300');
                        paymentStatusText.innerHTML = '<i class="fas fa-credit-card tw-mr-2"></i> Partially Paid';
                    } else if (latestPayment.status === 'Pending') {
                        // Pending payment
                        paymentStatusBadge.classList.add('tw-bg-yellow-900', 'tw-text-yellow-300');
                        paymentStatusText.innerHTML = '<i class="fas fa-clock tw-mr-2"></i> Payment Pending';
                    } else if (latestPayment.status === 'Failed') {
                        // Failed payment
                        paymentStatusBadge.classList.add('tw-bg-red-900', 'tw-text-red-300');
                        paymentStatusText.innerHTML = '<i class="fas fa-times-circle tw-mr-2"></i> Payment Failed';
                    } else if (latestPayment.status === 'Refunded') {
                        // Refunded payment
                        paymentStatusBadge.classList.add('tw-bg-purple-900', 'tw-text-purple-300');
                        paymentStatusText.innerHTML = '<i class="fas fa-undo tw-mr-2"></i> Refunded';
                    } else {
                        // Other status
                        paymentStatusBadge.classList.add('tw-bg-gray-700', 'tw-text-gray-300');
                        paymentStatusText.innerHTML = latestPayment.status || 'Unknown';
                    }
                    
                    // Add payment amount information to the status when partially paid
                    if (totalPaid > 0 && totalPaid < boardingPrice) {
                        // Show paid amount vs total
                        const remainingAmount = boardingPrice - totalPaid;
                        const percentPaid = Math.round((totalPaid / boardingPrice) * 100);
                        
                        // Add payment info tooltip
                        const paymentInfo = document.createElement('div');
                        paymentInfo.className = 'tw-mt-1 tw-text-xs tw-text-center';
                        paymentInfo.innerHTML = `${formatPrice(totalPaid)} of ${formatPrice(boardingPrice)} (${percentPaid}%)`;
                        paymentStatusBadge.appendChild(paymentInfo);
                    }
                    
                    // Display payment details container
                    const paymentDetailsContainer = getBoardingElement('adminBoardingPaymentDetailsContainer');
                    if (paymentDetailsContainer) {
                        paymentDetailsContainer.classList.remove('tw-hidden');
                        
                        // Update payment count
                        const paymentCount = getBoardingElement('adminBoardingPaymentCount');
                        if (paymentCount) {
                            paymentCount.textContent = `${boarding.payments.length} payment${boarding.payments.length !== 1 ? 's' : ''}`;
                        }
                        
                        // Generate payment list HTML
                        const paymentsListContainer = getBoardingElement('adminBoardingPaymentsListContainer');
                        if (paymentsListContainer) {
                            paymentsListContainer.innerHTML = '';
                            
                            sortedPayments.forEach((payment, index) => {
                                // Create payment card
                                const paymentCard = document.createElement('div');
                                paymentCard.className = 'tw-bg-gray-800 tw-rounded-md tw-p-3 tw-border-l-4';
                                
                                // Set border color based on status
                                switch(payment.status) {
                                    case 'Completed':
                                        paymentCard.classList.add('tw-border-green-500');
                                        break;
                                    case 'Pending':
                                        paymentCard.classList.add('tw-border-yellow-500');
                                        break;
                                    case 'Failed':
                                        paymentCard.classList.add('tw-border-red-500');
                                        break;
                                    case 'Refunded':
                                        paymentCard.classList.add('tw-border-purple-500');
                                        break;
                                    default:
                                        paymentCard.classList.add('tw-border-gray-600');
                                }
                                
                                // Payment header with amount and status
                                const paymentHeader = `
                                    <div class="tw-flex tw-justify-between tw-items-center tw-mb-2">
                                        <div class="tw-font-medium tw-text-white">${formatPrice(payment.amount)}</div>
                                        <div class="tw-text-xs tw-px-2 tw-py-1 tw-rounded-full ${getPaymentStatusClass(payment.status)}">
                                            ${payment.status}
                                        </div>
                                    </div>
                                `;
                                
                                // Payment details
                                const paymentDetails = `
                                    <div class="tw-grid tw-grid-cols-2 tw-gap-2 tw-text-xs">
                                        <div>
                                            <span class="tw-text-gray-400">Method:</span>
                                            <span class="tw-text-gray-200">${payment.payment_method || 'Not specified'}</span>
                                        </div>
                                        <div>
                                            <span class="tw-text-gray-400">Date:</span>
                                            <span class="tw-text-gray-200">${formatDateTime(payment.created_at)}</span>
                                        </div>
                                        ${payment.reference_number ? `
                                        <div class="tw-col-span-2">
                                            <span class="tw-text-gray-400">Reference:</span>
                                            <span class="tw-text-gray-200">${payment.reference_number}</span>
                                        </div>` : ''}
                                    </div>
                                `;
                                
                                paymentCard.innerHTML = paymentHeader + paymentDetails;
                                paymentsListContainer.appendChild(paymentCard);
                            });
                        }
                    }
                }
            } catch (error) {
                console.error('Error processing payment data:', error);
                const paymentStatusBadge = getBoardingElement('adminBoardingPaymentStatusBadge');
                if (paymentStatusBadge) {
                    paymentStatusBadge.className = 'tw-px-4 tw-py-2 tw-rounded-full tw-text-sm tw-font-medium tw-bg-gray-700 tw-text-gray-300';
                    const paymentStatusText = getBoardingElement('adminBoardingPaymentStatusText');
                    if (paymentStatusText) {
                        paymentStatusText.innerHTML = '<i class="fas fa-exclamation-triangle tw-mr-2"></i> Error loading payments';
                    }
                }
            }
        } else {
            // No payment information available
            const paymentStatusBadge = getBoardingElement('adminBoardingPaymentStatusBadge');
            const paymentStatusText = getBoardingElement('adminBoardingPaymentStatusText');
            
            if (paymentStatusBadge && paymentStatusText) {
                // Clear existing content to prevent duplication
                while (paymentStatusBadge.firstChild) {
                    paymentStatusBadge.removeChild(paymentStatusBadge.firstChild);
                }
                
                paymentStatusBadge.className = 'tw-px-4 tw-py-2 tw-rounded-full tw-text-sm tw-font-medium tw-bg-gray-700 tw-text-gray-300';
                paymentStatusBadge.appendChild(paymentStatusText);
                paymentStatusText.innerHTML = '<i class="fas fa-dollar-sign tw-mr-2"></i> Not Paid';
                
                paymentStatusBadge.classList.remove('tw-hidden');
                
                // Show payment details container with empty state
                const paymentDetailsContainer = getBoardingElement('adminBoardingPaymentDetailsContainer');
                if (paymentDetailsContainer) {
                    paymentDetailsContainer.classList.remove('tw-hidden');
                    
                    const paymentCount = getBoardingElement('adminBoardingPaymentCount');
                    if (paymentCount) {
                        paymentCount.textContent = '0 payments';
                    }
                    
                    const paymentsListContainer = getBoardingElement('adminBoardingPaymentsListContainer');
                    if (paymentsListContainer) {
                        paymentsListContainer.innerHTML = `
                            <div class="tw-text-center tw-py-4 tw-text-gray-400">
                                <i class="fas fa-receipt tw-text-2xl tw-mb-2"></i>
                                <p>No payments recorded</p>
                            </div>
                        `;
                    }
                }
            }
        }
        
        // Set pet information
        if (boarding.pet) {
            getBoardingElement('adminBoardingPetName').textContent = boarding.pet.name || 'Unknown Pet';
            getBoardingElement('adminBoardingPetSpecies').textContent = boarding.pet.species || '';
            getBoardingElement('adminBoardingPetBreed').textContent = boarding.pet.breed || '';
            
            // Set pet image if available
            const petImage = getBoardingElement('adminBoardingPetImage');
            if (boarding.pet.petImage) {
                let imageUrl = "{{ asset('storage/') }}/" + boarding.pet.petImage.replace(/^storage\//i, '');
                petImage.innerHTML = `<img src="${imageUrl}" alt="${boarding.pet.name}" class="tw-h-full tw-w-full tw-object-cover">`;
            } else {
                // Default icon based on species
                let speciesIcon = '<i class="fas fa-paw tw-text-sm tw-text-gray-500"></i>';
                
                if (boarding.pet.species && boarding.pet.species.toLowerCase() === 'dog') {
                    speciesIcon = '<i class="fas fa-dog tw-text-sm tw-text-gray-500"></i>';
                } else if (boarding.pet.species && boarding.pet.species.toLowerCase() === 'cat') {
                    speciesIcon = '<i class="fas fa-cat tw-text-sm tw-text-gray-500"></i>';
                }
                
                petImage.innerHTML = speciesIcon;
            }
            
            // Set up view pet button - clone and replace to avoid duplicate event listeners
            const viewPetBtn = getBoardingElement('adminBoardingViewPetBtn');
            const newViewPetBtn = viewPetBtn.cloneNode(true);
            viewPetBtn.parentNode.replaceChild(newViewPetBtn, viewPetBtn);
            
            newViewPetBtn.addEventListener('click', function() {
                // Close boarding modal first
                hideBoardingModal();
                // Open pet modal with pet ID
                if (typeof window.openPetModal === 'function') {
                    window.openPetModal(boarding.pet.petID);
                } else {
                    console.error('openPetModal function not found');
                }
            });
            
            // Set client information if available through pet
            if (boarding.pet.user) {
                const client = boarding.pet.user;
                getBoardingElement('adminBoardingClientName').textContent = `${client.firstName || ''} ${client.lastName || ''}`.trim() || 'Unknown Client';
                getBoardingElement('adminBoardingClientEmail').textContent = client.email || '';
                
                // Set client image if available
                const clientImage = getBoardingElement('adminBoardingClientImage');
                if (client.userImage) {
                    let imageUrl = "{{ asset('storage/') }}/" + client.userImage.replace(/^storage\//i, '');
                    clientImage.innerHTML = `<img src="${imageUrl}" alt="Client" class="tw-h-full tw-w-full tw-object-cover">`;
                }
                
                // Set up view client button - clone and replace to avoid duplicate event listeners
                const viewClientBtn = getBoardingElement('adminBoardingViewClientBtn');
                const newViewClientBtn = viewClientBtn.cloneNode(true);
                viewClientBtn.parentNode.replaceChild(newViewClientBtn, viewClientBtn);
                
                newViewClientBtn.addEventListener('click', function() {
                    // Close boarding modal first
                    hideBoardingModal();
                    // Open user modal with client ID
                    if (typeof window.openUserModal === 'function') {
                        window.openUserModal(client.userID);
                    } else {
                        console.error('openUserModal function not found');
                    }
                });
            }
        }
        
        // Set status badge and buttons based on current status
        setStatusDisplay(boarding.status);
        
        // Set creation and update timestamps
        if (boarding.created_at) {
            getBoardingElement('boardingCreatedAt').textContent = formatDateTime(boarding.created_at);
        }
        
        if (boarding.updated_at && boarding.updated_at !== boarding.created_at) {
            getBoardingElement('boardingUpdatedAt').textContent = formatDateTime(boarding.updated_at);
            getBoardingElement('boardingUpdatedBlock').classList.remove('tw-hidden');
        } else {
            getBoardingElement('boardingUpdatedBlock').classList.add('tw-hidden');
        }
    }

    // Helper function for payment status styling
    function getPaymentStatusClass(status) {
        switch(status) {
            case 'Completed':
                return 'tw-bg-green-900 tw-text-green-300';
            case 'Pending':
                return 'tw-bg-yellow-900 tw-text-yellow-300';
            case 'Failed':
                return 'tw-bg-red-900 tw-text-red-300';
            case 'Refunded':
                return 'tw-bg-purple-900 tw-text-purple-300';
            default:
                return 'tw-bg-gray-700 tw-text-gray-300';
        }
    }
    
    // Set status badge and action buttons based on current status
    function setStatusDisplay(status) {
        const statusBadge = getBoardingElement('boardingStatusBadge');
        const statusText = getBoardingElement('adminBoardingStatusText');
        const confirmBtn = getBoardingElement('confirmBoardingBtn');
        const activateBtn = getBoardingElement('activateBoardingBtn');
        const completeBtn = getBoardingElement('completeBoardingBtn');
        const cancelBtn = getBoardingElement('cancelBoardingBtn');
        
        // Hide all action buttons first
        confirmBtn.classList.add('tw-hidden');
        activateBtn.classList.add('tw-hidden');
        completeBtn.classList.add('tw-hidden');
        cancelBtn.classList.add('tw-hidden');
        
        // Configure based on status
        switch (status) {
            case 'Confirmed':
                statusBadge.className = 'tw-px-4 tw-py-2 tw-rounded-full tw-text-sm tw-font-medium tw-bg-blue-900 tw-text-blue-300';
                statusText.innerHTML = '<i class="fas fa-check-circle tw-mr-2"></i> Confirmed';
                
                // Show activate and cancel buttons for confirmed bookings
                activateBtn.classList.remove('tw-hidden');
                cancelBtn.classList.remove('tw-hidden');
                break;
                
            case 'Active':
                statusBadge.className = 'tw-px-4 tw-py-2 tw-rounded-full tw-text-sm tw-font-medium tw-bg-[#066925] tw-text-[#66FF8F]';
                statusText.innerHTML = '<i class="fas fa-bed tw-mr-2"></i> Active';
                
                // Show complete and cancel buttons for active boardings
                completeBtn.classList.remove('tw-hidden');
                cancelBtn.classList.remove('tw-hidden');
                break;
                
            case 'Completed':
                statusBadge.className = 'tw-px-4 tw-py-2 tw-rounded-full tw-text-sm tw-font-medium tw-bg-green-900 tw-text-green-300';
                statusText.innerHTML = '<i class="fas fa-check-double tw-mr-2"></i> Completed';
                // No action buttons needed for completed boardings
                break;
                
            case 'Cancelled':
                statusBadge.className = 'tw-px-4 tw-py-2 tw-rounded-full tw-text-sm tw-font-medium tw-bg-red-900 tw-text-red-300';
                statusText.innerHTML = '<i class="fas fa-times-circle tw-mr-2"></i> Cancelled';
                // No action buttons needed for cancelled boardings
                break;
                
            default: // Unknown status
                statusBadge.className = 'tw-px-4 tw-py-2 tw-rounded-full tw-text-sm tw-font-medium tw-bg-gray-700 tw-text-gray-300';
                statusText.innerHTML = status || 'Unknown';
        }
    }
    
    // Set up status change buttons event handlers
    resetBoardingButton('confirmBoardingBtn').addEventListener('click', function() {
        updateBoardingStatus('Confirmed');
    });
    
    resetBoardingButton('activateBoardingBtn').addEventListener('click', function() {
        updateBoardingStatus('Active');
    });
    
    resetBoardingButton('completeBoardingBtn').addEventListener('click', function() {
        updateBoardingStatus('Completed');
    });
    
    resetBoardingButton('cancelBoardingBtn').addEventListener('click', function() {
        updateBoardingStatus('Cancelled');
    });
    
    // Function to update boarding status
    function updateBoardingStatus(newStatus) {
        if (!window.currentBoardingData) return;
        
        Swal.fire({
            title: `${newStatus} this boarding?`,
            text: `Are you sure you want to mark this boarding as ${newStatus}?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#66FF8F',
            cancelButtonColor: '#6B7280',
            confirmButtonText: 'Yes, update status',
            background: '#374151',
            color: '#fff'
        }).then((result) => {
            if (result.isConfirmed) {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                
                // Send request to update status
                fetch("{{ route('admin.boardings.update-status', ['id' => ':boardingId']) }}".replace(':boardingId', window.currentBoardingData.boardingID), {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ status: newStatus })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update current boarding data with the new status
                        window.currentBoardingData.status = newStatus;
                        setStatusDisplay(newStatus);
                        
                        // Show success message
                        Swal.fire({
                            title: 'Status Updated!',
                            text: `Boarding has been marked as ${newStatus}`,
                            icon: 'success',
                            confirmButtonColor: '#66FF8F',
                            background: '#374151',
                            color: '#fff'
                        });
                        
                        // Refresh the boardings table if available
                        if (window.BoardingsPage && window.BoardingsPage.boardingsTable) {
                            window.BoardingsPage.boardingsTable.ajax.reload();
                        }
                    } else {
                        throw new Error(data.message || 'Failed to update boarding status');
                    }
                })
                .catch(error => {
                    console.error('Error updating status:', error);
                    Swal.fire({
                        title: 'Error!',
                        text: error.message || 'Failed to update boarding status',
                        icon: 'error',
                        confirmButtonColor: '#66FF8F',
                        background: '#374151',
                        color: '#fff'
                    });
                });
            }
        });
    }
    
    // Setup edit boarding button handler
    resetBoardingButton('editBoardingBtn').addEventListener('click', function() {
        if (window.currentBoardingData) {
            // Close this modal
            hideBoardingModal();
            
            // Call the edit function if it exists
            if (typeof window.BoardingsPage.editBoarding === 'function') {
                window.BoardingsPage.editBoarding(window.currentBoardingData.boardingID);
            } else {
                console.error('editBoarding function not found');
            }
        }
    });
    
    // Close modal handler
    const modalToggle = resetBoardingButton('adminBoardingModalCloseBtn');
    if (modalToggle) {
        modalToggle.addEventListener('click', function() {
            hideBoardingModal();
        });
    }
    
    // Utility function to format date
    function formatDate(dateString) {
        if (!dateString) return 'Not specified';
        
        const date = new Date(dateString);
        return date.toLocaleDateString('en-US', { 
            weekday: 'long',
            year: 'numeric', 
            month: 'long', 
            day: 'numeric'
        });
    }
    
    // Utility function to calculate number of days between two dates (inclusive)
    function calculateDays(startDate, endDate) {
        // Add one day to include the end date in the count
        return Math.floor((endDate - startDate) / (1000 * 60 * 60 * 24)) + 1;
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

    // Function to calculate boarding price based on base rate and duration
    function calculateBoardingPrice(baseRate, durationDays) {
        // If we don't have a base rate, use a default
        const rate = parseFloat(baseRate) || 350;
        
        // Calculate total price
        const totalPrice = rate * durationDays;
        
        return {
            baseRate: rate,
            totalPrice: totalPrice
        };
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
}

initializeAdminViewBoardingModal();
document.addEventListener('contentChanged', initializeAdminViewBoardingModal);
</script>



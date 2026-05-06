<!-- View Appointment Modal -->
<div id="viewAppointment-modal" tabindex="-1" aria-hidden="true" class="tw-hidden tw-fixed tw-top-0 tw-left-0 tw-right-0 tw-z-50 tw-w-full tw-p-4 tw-overflow-x-hidden tw-overflow-y-auto md:tw-inset-0 tw-h-full tw-max-h-full tw-flex tw-items-center tw-justify-center tw-backdrop-blur-sm tw-bg-black/30">
    <div class="tw-relative tw-w-full tw-max-w-4xl tw-max-h-full tw-animate-modal-entry">
        <!-- Modal content -->
        <div class="tw-relative tw-bg-white tw-rounded-lg tw-shadow-xl tw-transform tw-transition-all">
            <!-- Modal header -->
            <div class="tw-flex tw-items-center tw-justify-between tw-p-4 md:tw-p-5 tw-border-b tw-rounded-t tw-border-gray-200">
                <h3 class="tw-text-lg tw-font-semibold tw-text-gray-800">Appointment Details</h3>
                <button type="button" class="tw-bg-transparent tw-text-gray-500 tw-rounded-lg tw-text-sm tw-w-8 tw-h-8 tw-flex tw-justify-center tw-items-center tw-transition-all hover:tw-bg-gray-100 hover:tw-text-gray-700" data-modal-toggle="viewAppointment-modal">
                    <svg class="tw-w-3 tw-h-3 tw-text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            
            <!-- Modal body -->
            <div class="tw-p-4 md:tw-p-5">
                <div class="tw-grid tw-grid-cols-1 lg:tw-grid-cols-3 tw-gap-6">
                    <!-- Left Column - Appointment Details -->
                    <div class="lg:tw-col-span-2">
                        <div class="tw-bg-gray-50 tw-rounded-lg tw-p-5 tw-mb-6 tw-shadow-sm">
                            <div class="tw-flex tw-justify-between tw-items-center tw-mb-4">
                                <div>
                                    <h4 class="tw-text-gray-500 tw-text-sm tw-font-medium">Appointment ID</h4>
                                    <p id="appointmentId" class="tw-text-lg tw-font-semibold"></p>
                                </div>
                                <div class="tw-text-right">
                                    <h4 class="tw-text-gray-500 tw-text-sm tw-font-medium">Status</h4>
                                    <span id="appointmentStatusBadge" class="tw-px-3 tw-py-1 tw-rounded-full tw-text-sm tw-font-medium tw-inline-flex tw-items-center tw-justify-center tw-mt-1">
                                        <span id="statusText"></span>
                                    </span>
                                </div>
                            </div>

                            <div class="tw-flex tw-items-center tw-gap-4 tw-mb-4">
                                <div id="serviceIcon" class="tw-w-16 tw-h-16 tw-flex tw-items-center tw-justify-center tw-rounded-full tw-bg-blue-50">
                                    <i class="fas fa-concierge-bell tw-text-5xl tw-text-[#24CFF4]"></i>
                                </div>
                                <div>
                                    <h4 id="serviceName" class="tw-text-lg tw-font-semibold tw-text-gray-800 tw-mb-1">Service Name</h4>
                                    <p id="servicePrice" class="tw-text-[#20b9db] tw-font-bold">₱0.00</p>
                                </div>
                            </div>

                            <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-4">
                                <div>
                                    <h4 class="tw-text-gray-500 tw-text-sm tw-font-medium">Appointment Date</h4>
                                    <p id="appointmentDate" class="tw-font-medium tw-text-gray-800">Not set</p>
                                </div>
                                <div>
                                    <h4 class="tw-text-gray-500 tw-text-sm tw-font-medium">Appointment Time</h4>
                                    <p id="appointmentTime" class="tw-font-medium tw-text-gray-800">Not set</p>
                                </div>
                            </div>

                            <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-4 tw-mt-4">
                                <div>
                                    <h4 class="tw-text-gray-500 tw-text-sm tw-font-medium">Created</h4>
                                    <p id="appointmentCreatedAt" class="tw-font-medium tw-text-gray-800">Unknown</p>
                                </div>
                                <div id="appointmentUpdatedBlock" class="tw-hidden">
                                    <h4 class="tw-text-gray-500 tw-text-sm tw-font-medium">Last Updated</h4>
                                    <p id="appointmentUpdatedAt" class="tw-font-medium tw-text-gray-800">Unknown</p>
                                </div>
                            </div>
                        </div>

                        <div class="tw-bg-gray-50 tw-rounded-lg tw-p-5 tw-mb-6 tw-shadow-sm">
                            <div class="tw-flex tw-items-center tw-justify-between tw-mb-3">
                                <h3 class="tw-text-lg tw-font-medium tw-flex tw-items-center">
                                    <svg class="tw-w-5 tw-h-5 tw-mr-2 tw-text-[#24CFF4]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path>
                                        <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path>
                                    </svg>
                                    Payment Details
                                </h3>
                                <div id="paymentStatusContainer">
                                    <div id="paymentStatusBadge" class="tw-px-4 tw-py-2 tw-rounded-full tw-text-sm tw-font-medium tw-hidden">
                                        <span id="paymentStatusText"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-3 tw-gap-4 tw-mb-3">
                                <div>
                                    <h4 class="tw-text-gray-500 tw-text-sm tw-font-medium">Payment Method</h4>
                                    <p id="view-payment-method" class="tw-font-medium"></p>
                                </div>
                                <div>
                                    <h4 class="tw-text-gray-500 tw-text-sm tw-font-medium">Payment Status</h4>
                                    <p id="paymentCount" class="tw-font-medium tw-text-gray-800">Loading...</p>
                                </div>
                                <div>
                                    <h4 class="tw-text-gray-500 tw-text-sm tw-font-medium">Total Amount</h4>
                                    <p id="appointmentTotalAmount" class="tw-font-semibold tw-text-[#24CFF4]">₱0.00</p>
                                </div>
                            </div>

                            <div id="paymentDetailsContainer" class="tw-border-t tw-border-gray-200 tw-pt-3 tw-mt-3">
                                <div id="paymentsListContainer" class="tw-mt-2 tw-max-h-32 tw-overflow-y-auto"></div>
                            </div>
                        </div>

                        <div id="groomingSection" class="tw-hidden tw-bg-gray-50 tw-rounded-lg tw-p-5 tw-shadow-sm">
                            <h3 class="tw-text-lg tw-font-medium tw-mb-3 tw-flex tw-items-center">
                                <svg class="tw-w-5 tw-h-5 tw-mr-2 tw-text-[#24CFF4]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                </svg>
                                Grooming Photos
                            </h3>
                            <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-3">
                                <div id="beforeImageContainer" class="tw-text-center">
                                    <span class="tw-text-xs tw-text-gray-500 tw-block tw-mb-1">Before</span>
                                    <div class="tw-h-24 tw-bg-gray-100 tw-rounded tw-flex tw-items-center tw-justify-center">
                                        <span class="tw-text-gray-400 tw-text-xs">No image</span>
                                    </div>
                                </div>
                                <div id="afterImageContainer" class="tw-text-center">
                                    <span class="tw-text-xs tw-text-gray-500 tw-block tw-mb-1">After</span>
                                    <div class="tw-h-24 tw-bg-gray-100 tw-rounded tw-flex tw-items-center tw-justify-center">
                                        <span class="tw-text-gray-400 tw-text-xs">No image</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Pet Info -->
                    <div class="lg:tw-col-span-1">
                        <div class="tw-bg-gray-50 tw-rounded-lg tw-p-5 tw-shadow-sm">
                            <h3 class="tw-text-lg tw-font-medium tw-mb-3 tw-flex tw-items-center">
                                <svg class="tw-w-5 tw-h-5 tw-mr-2 tw-text-[#24CFF4]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M6.56 1.14a.75.75 0 01.7-.09l7 3a.75.75 0 01.44.69v9.25a.75.75 0 01-1.5 0V5.23l-5.5-2.36V16.5a.75.75 0 01-1.5 0V2.5c0-.27.18-.51.44-.59l.01-.01z" clip-rule="evenodd" />
                                    <path d="M17.5 12a1 1 0 01-.75-.34l-2.5-2.67a1 1 0 01-.03-1.3l2.5-3a1 1 0 111.53 1.28l-1.89 2.26L17.8 9.8a1 1 0 01-.16 1.4.94.94 0 01-.14.04z" clip-rule="evenodd" />
                                </svg>
                                Pet Information
                            </h3>

                            <div class="tw-flex tw-justify-center tw-mb-4">
                                <div id="petImage" class="tw-w-32 tw-h-32 tw-rounded-full tw-overflow-hidden tw-border-4 tw-border-[#24CFF4]/30 tw-bg-gray-200 tw-flex tw-items-center tw-justify-center">
                                    <i class="fas fa-paw tw-text-gray-400 tw-text-3xl"></i>
                                </div>
                            </div>

                            <div class="tw-text-center tw-mb-4">
                                <h4 id="petName" class="tw-text-xl tw-font-semibold tw-mb-1"></h4>
                                <div class="tw-flex tw-items-center tw-justify-center tw-gap-2 tw-flex-wrap">
                                    <span id="petSpecies" class="tw-px-3 tw-py-1 tw-rounded-full tw-text-sm tw-bg-blue-100 tw-text-blue-800"></span>
                                    <span id="petBreed" class="tw-text-sm tw-text-gray-500"></span>
                                </div>
                            </div>

                            <div class="tw-grid tw-grid-cols-2 tw-gap-3 tw-mt-4">
                                <div>
                                    <h4 class="tw-text-gray-500 tw-text-sm tw-font-medium">Age</h4>
                                    <p id="petAge" class="tw-font-medium"></p>
                                </div>
                                <div>
                                    <h4 class="tw-text-gray-500 tw-text-sm tw-font-medium">Gender</h4>
                                    <p id="petGender" class="tw-font-medium"></p>
                                </div>
                                <div>
                                    <h4 class="tw-text-gray-500 tw-text-sm tw-font-medium">Weight</h4>
                                    <p id="petWeight" class="tw-font-medium"></p>
                                </div>
                                <div>
                                    <h4 class="tw-text-gray-500 tw-text-sm tw-font-medium">Breed</h4>
                                    <p id="petBreed" class="tw-font-medium"></p>
                                </div>
                            </div>

                            <div class="tw-mt-4">
                                <h4 class="tw-text-gray-500 tw-text-sm tw-font-medium">Special Notes</h4>
                                <p id="petNotes" class="tw-font-medium tw-bg-white tw-p-3 tw-rounded tw-mt-1 tw-text-sm tw-h-24 tw-overflow-y-auto"></p>
                            </div>
                        </div>

                        <div class="tw-mt-4 tw-space-y-3">
                            <button id="editAppointmentBtn" class="tw-w-full tw-bg-gray-100 tw-text-gray-700 tw-px-4 tw-py-2 tw-rounded-lg tw-font-medium tw-transition-all hover:tw-bg-gray-200">
                                <i class="fas fa-edit tw-mr-2"></i>Edit
                            </button>

                            <button id="cancelAppointmentBtn" class="tw-hidden tw-w-full tw-bg-red-50 tw-text-red-600 tw-px-4 tw-py-2 tw-rounded-lg tw-font-medium tw-transition-all hover:tw-bg-red-100">
                                <i class="fas fa-times-circle tw-mr-2"></i>Cancel Booking
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
['DOMContentLoaded', 'contentChanged'].forEach(eventName => {
    document.addEventListener(eventName, function() {    
        // Global variable to store current appointment data
        window.currentAppointmentData = null;
        
        // Function to open appointment modal with data
        window.openAppointmentModal = function(appointmentId) {
            // Show loading state
            const viewAppointmentModal = document.getElementById('viewAppointment-modal');
            if (!viewAppointmentModal) {
                console.error('View appointment modal not found');
                return;
            }
            
            // Show modal with loading indicator
            viewAppointmentModal.classList.remove('tw-hidden');
            
            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            // Fetch appointment data - adjust the route as needed for user view
            fetch("{{ route('user.appointments.show', ['id' => ':appointmentId']) }}".replace(':appointmentId', appointmentId), {
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to fetch appointment data');
                }
                return response.json();
            })
            .then(data => {
                // Store the appointment data globally
                window.currentAppointmentData = data.appointment;
                populateAppointmentData(data.appointment);
            })
            .catch(error => {
                console.error('Error fetching appointment:', error);
                Swal.fire({
                    title: 'Error',
                    text: 'Failed to load appointment details.',
                    icon: 'error',
                    confirmButtonColor: '#24CFF4'
                });
                viewAppointmentModal.classList.add('tw-hidden');
            });
        };
        
        // Function to populate appointment data in the modal
        function populateAppointmentData(appointment) {
            console.log("Populating appointment data:", appointment);

            document.getElementById('appointmentId').textContent = '#' + (appointment.appointmentID || appointment.id || 'N/A');
            
            // Set appointment date and time
            document.getElementById('appointmentDate').textContent = formatDate(appointment.date);
            document.getElementById('appointmentTime').textContent = formatTime(appointment.time);
            
            // Set service information
            if (appointment.service) {
                document.getElementById('serviceName').textContent = appointment.service.name;
                const price = parseFloat(appointment.service.price);
                document.getElementById('servicePrice').textContent = '₱' + (isNaN(price) ? '0.00' : price.toFixed(2));
            }
            
            // Set pet information
            if (appointment.pet) {
                document.getElementById('petName').textContent = appointment.pet.name;
                document.getElementById('petSpecies').textContent = appointment.pet.species;
                document.getElementById('petBreed').textContent = appointment.pet.breed;
                document.getElementById('petAge').textContent = formatPetAge(appointment.pet.birthDate || appointment.pet.birthdate);
                document.getElementById('petGender').textContent = appointment.pet.gender || 'Not specified';
                document.getElementById('petWeight').textContent = appointment.pet.weight ? `${appointment.pet.weight} kg` : 'Not specified';
                document.getElementById('petNotes').textContent = appointment.pet.petNotes || appointment.pet.special_notes || 'No special notes provided.';
                
                // Set pet image if available
                const petImage = document.getElementById('petImage');
                if (appointment.pet.petImage) {
                    let imageUrl = "{{ asset('') }}" + (appointment.pet.petImage.startsWith('storage/') 
                        ? appointment.pet.petImage 
                        : 'storage/' + appointment.pet.petImage);
                    
                    petImage.innerHTML = `<img src="${imageUrl}" alt="${appointment.pet.name}" class="tw-h-full tw-w-full tw-object-cover">`;
                } else {
                    // Default icon based on species
                    let speciesIcon = '<i class="fas fa-paw tw-text-sm tw-text-gray-500"></i>';
                    
                    if (appointment.pet.species && appointment.pet.species.toLowerCase() === 'dog') {
                        speciesIcon = '<i class="fas fa-dog tw-text-sm tw-text-gray-500"></i>';
                    } else if (appointment.pet.species && appointment.pet.species.toLowerCase() === 'cat') {
                        speciesIcon = '<i class="fas fa-cat tw-text-sm tw-text-gray-500"></i>';
                    }
                    
                    petImage.innerHTML = speciesIcon;
                }

                
            }
            
            // Set status badge and buttons based on current status
            setStatusDisplay(appointment.status);
            
            // Set creation and update timestamps
            if (appointment.created_at) {
                document.getElementById('appointmentCreatedAt').textContent = formatDateTime(appointment.created_at);
            }
            
            if (appointment.updated_at && appointment.updated_at !== appointment.created_at) {
                document.getElementById('appointmentUpdatedBlock').classList.remove('tw-hidden');
                document.getElementById('appointmentUpdatedAt').textContent = formatDateTime(appointment.updated_at);
            } else {
                document.getElementById('appointmentUpdatedBlock').classList.add('tw-hidden');
            }

            // Handle payment information — deposit/balance aware
            if (appointment.payments && appointment.payments.length > 0) {
                const pmts = appointment.payments;
                const depositPmt   = pmts.find(p => p.payment_type === 'deposit' && p.status === 'Completed');
                const balancePmt   = pmts.find(p => p.payment_type === 'balance');
                const fullPmt      = pmts.find(p => p.payment_type === 'full' && p.status === 'Completed');
                const pendingGcashPmt = pmts.find(p => p.payment_method === 'GCash' && p.status === 'Pending');
                const cashPendingPmt = pmts.find(p => p.payment_method === 'Cash' && p.status === 'Pending');
                const paymentMethodEl = document.getElementById('view-payment-method');
                const totalAmountEl = document.getElementById('appointmentTotalAmount');

                document.getElementById('paymentStatusContainer').classList.remove('tw-hidden');
                document.getElementById('paymentStatusBadge').classList.remove('tw-hidden');
                document.getElementById('paymentCount').textContent = '';

                const paymentsContainer = document.getElementById('paymentsListContainer');
                paymentsContainer.innerHTML = '';

                let badgeClass = '';
                let badgeText  = '';
                let summaryHtml = '';

                if (pendingGcashPmt) {
                    const submittedAmt = parseFloat(pendingGcashPmt.amount);
                    const totalCost = parseFloat(pendingGcashPmt.total_cost || (pendingGcashPmt.payment_type === 'deposit' ? (submittedAmt / 0.3) : submittedAmt));
                    const balanceAmt = Math.max(0, totalCost - submittedAmt);
                    const isDeposit = pendingGcashPmt.payment_type === 'deposit';
                    badgeClass = 'tw-bg-yellow-100 tw-text-yellow-800';
                    badgeText = '<i class="fas fa-clock tw-mr-2"></i>Pending Verification';
                    paymentMethodEl.innerHTML = `GCash <span class="tw-text-xs tw-text-gray-400">(${isDeposit ? 'deposit submitted' : 'payment submitted'})</span>`;
                    totalAmountEl.textContent = '₱' + totalCost.toFixed(2);
                    document.getElementById('paymentCount').textContent = 'Pending Verification';
                    summaryHtml = `
                        <div class="tw-bg-yellow-50 tw-border tw-border-yellow-200 tw-rounded-lg tw-p-3 tw-text-sm">
                            <div class="tw-flex tw-justify-between tw-mb-1">
                                <span class="tw-text-yellow-700 tw-font-medium">GCash ${isDeposit ? 'Deposit' : 'Payment'} Submitted</span>
                                <span class="tw-font-semibold tw-text-yellow-800">₱${submittedAmt.toFixed(2)}</span>
                            </div>
                            <div class="tw-flex tw-justify-between tw-mb-2">
                                <span class="tw-text-gray-600">Reference</span>
                                <span>${pendingGcashPmt.reference_number || 'N/A'}</span>
                            </div>
                            <p class="tw-text-xs tw-text-gray-600">Your booking stays pending until staff verifies that the GCash payment went through.</p>
                            ${isDeposit ? `<p class="tw-text-xs tw-text-amber-700 tw-mt-2">If approved, the remaining balance of ₱${balanceAmt.toFixed(2)} will be collected in cash during your visit.</p>` : ''}
                        </div>`;
                } else if (depositPmt && !balancePmt) {
                    // GCash deposit paid — balance still owed at visit
                    const depositAmt = parseFloat(depositPmt.amount);
                    const totalCost  = parseFloat(depositPmt.total_cost || (depositAmt / 0.3));
                    const balanceAmt = totalCost - depositAmt;
                    badgeClass  = 'tw-bg-blue-100 tw-text-blue-800';
                    badgeText   = '<i class="fas fa-credit-card tw-mr-2"></i>Deposit Paid';
                    paymentMethodEl.innerHTML = 'GCash <span class="tw-text-xs tw-text-gray-400">(deposit)</span>';
                    totalAmountEl.textContent = '₱' + totalCost.toFixed(2);
                    document.getElementById('paymentCount').textContent = 'Deposit Paid';
                    summaryHtml = `
                        <div class="tw-bg-blue-50 tw-border tw-border-blue-200 tw-rounded-lg tw-p-3 tw-text-sm">
                            <div class="tw-flex tw-justify-between tw-mb-1">
                                <span class="tw-text-blue-700 tw-font-medium">GCash Deposit (30%)</span>
                                <span class="tw-font-semibold tw-text-blue-800">₱${depositAmt.toFixed(2)}</span>
                            </div>
                            <div class="tw-flex tw-justify-between tw-mb-2">
                                <span class="tw-text-gray-600">Full Service Price</span>
                                <span>₱${totalCost.toFixed(2)}</span>
                            </div>
                            <div class="tw-border-t tw-border-blue-200 tw-pt-2 tw-flex tw-justify-between">
                                <span class="tw-font-medium tw-text-amber-700"><i class="fas fa-info-circle tw-mr-1"></i>Balance due at visit (cash):</span>
                                <span class="tw-font-bold tw-text-amber-700">₱${balanceAmt.toFixed(2)}</span>
                            </div>
                        </div>`;

                } else if (depositPmt && balancePmt) {
                    // Both deposit + balance collected — fully settled
                    const totalPaid = parseFloat(depositPmt.amount) + parseFloat(balancePmt.amount);
                    badgeClass  = 'tw-bg-green-100 tw-text-green-800';
                    badgeText   = '<i class="fas fa-check-circle tw-mr-2"></i>Fully Paid';
                    paymentMethodEl.textContent = 'GCash + Cash';
                    totalAmountEl.textContent = '₱' + totalPaid.toFixed(2);
                    document.getElementById('paymentCount').textContent = 'Fully Paid';
                    summaryHtml = `
                        <div class="tw-bg-green-50 tw-border tw-border-green-200 tw-rounded-lg tw-p-3 tw-text-sm">
                            <div class="tw-flex tw-justify-between tw-mb-1">
                                <span class="tw-text-gray-600">GCash Deposit</span>
                                <span>₱${parseFloat(depositPmt.amount).toFixed(2)}</span>
                            </div>
                            <div class="tw-flex tw-justify-between tw-mb-2">
                                <span class="tw-text-gray-600">Cash Balance Collected</span>
                                <span>₱${parseFloat(balancePmt.amount).toFixed(2)}</span>
                            </div>
                            <div class="tw-border-t tw-border-green-200 tw-pt-2 tw-flex tw-justify-between">
                                <span class="tw-font-semibold tw-text-green-700">Total Paid</span>
                                <span class="tw-font-bold tw-text-green-700">₱${totalPaid.toFixed(2)}</span>
                            </div>
                        </div>`;

                } else if (fullPmt) {
                    // Full GCash payment
                    const amt = parseFloat(fullPmt.amount);
                    badgeClass  = 'tw-bg-green-100 tw-text-green-800';
                    badgeText   = '<i class="fas fa-check-circle tw-mr-2"></i>Fully Paid';
                    paymentMethodEl.textContent = 'GCash';
                    totalAmountEl.textContent = '₱' + amt.toFixed(2);
                    document.getElementById('paymentCount').textContent = 'Fully Paid';
                    summaryHtml = `
                        <div class="tw-bg-green-50 tw-border tw-border-green-200 tw-rounded-lg tw-p-3 tw-text-sm">
                            <div class="tw-flex tw-justify-between">
                                <span class="tw-text-gray-600">GCash Payment</span>
                                <span class="tw-font-bold tw-text-green-700">₱${amt.toFixed(2)}</span>
                            </div>
                        </div>`;

                } else if (cashPendingPmt) {
                    // Cash — awaiting collection at counter
                    const amt = parseFloat(cashPendingPmt.amount);
                    badgeClass  = 'tw-bg-yellow-100 tw-text-yellow-800';
                    badgeText   = '<i class="fas fa-clock tw-mr-2"></i>Pending';
                    paymentMethodEl.innerHTML = 'Cash <span class="tw-text-xs tw-text-gray-400">(pay at counter)</span>';
                    totalAmountEl.textContent = '₱' + amt.toFixed(2);
                    document.getElementById('paymentCount').textContent = 'Pending';
                    summaryHtml = `
                        <div class="tw-bg-yellow-50 tw-border tw-border-yellow-200 tw-rounded-lg tw-p-3 tw-text-sm">
                            <div class="tw-flex tw-justify-between tw-items-center">
                                <span class="tw-text-yellow-700"><i class="fas fa-info-circle tw-mr-1"></i>Cash — bring on your visit:</span>
                                <span class="tw-font-bold tw-text-yellow-700">₱${amt.toFixed(2)}</span>
                            </div>
                            <p class="tw-text-xs tw-text-gray-500 tw-mt-1">Your booking is awaiting staff confirmation once payment is verified.</p>
                        </div>`;

                } else {
                    // Fallback for any other state
                    const fallbackPmt = pmts[pmts.length - 1];
                    const amt = parseFloat(fallbackPmt.amount);
                    badgeClass  = getPaymentStatusClass(fallbackPmt.status);
                    badgeText   = '<i class="fas fa-credit-card tw-mr-2"></i>' + fallbackPmt.status;
                    paymentMethodEl.textContent = fallbackPmt.payment_method || 'N/A';
                    totalAmountEl.textContent = '₱' + amt.toFixed(2);
                    document.getElementById('paymentCount').textContent = fallbackPmt.status || 'Unknown';
                    summaryHtml = `<div class="tw-text-sm tw-text-gray-600">₱${amt.toFixed(2)} via ${fallbackPmt.payment_method}</div>`;
                }

                document.getElementById('paymentStatusText').innerHTML = badgeText;
                document.getElementById('paymentStatusBadge').className =
                    `tw-px-4 tw-py-2 tw-rounded-full tw-text-sm tw-font-medium ${badgeClass}`;
                paymentsContainer.innerHTML = summaryHtml;

            } else {
                document.getElementById('paymentStatusContainer').classList.add('tw-hidden');
                document.getElementById('paymentCount').textContent = 'No payments';
                document.getElementById('view-payment-method').textContent = 'Not yet paid';
                document.getElementById('appointmentTotalAmount').textContent = appointment.service ? `₱${parseFloat(appointment.service.price || 0).toFixed(2)}` : '₱0.00';
            }

            // Show grooming images if available
            if ((appointment.before_image || appointment.after_image) || appointment.service && appointment.service.name.toLowerCase().includes('groom')) {
                document.getElementById('groomingSection').classList.remove('tw-hidden');
                
                if (appointment.before_image) {
                    const beforeContainer = document.getElementById('beforeImageContainer');
                    beforeContainer.innerHTML = `
                        <span class="tw-text-xs tw-text-gray-500 tw-block tw-mb-1">Before</span>
                        <div class="tw-h-24 tw-bg-gray-100 tw-rounded tw-overflow-hidden">
                            <img src="{{ asset('storage') }}/${appointment.before_image}" 
                            alt="Before grooming" class="tw-w-full tw-h-full tw-object-cover"/>
                        </div>
                    `;
                }
                
                if (appointment.after_image) {
                    const afterContainer = document.getElementById('afterImageContainer');
                    afterContainer.innerHTML = `
                        <span class="tw-text-xs tw-text-gray-500 tw-block tw-mb-1">After</span>
                        <div class="tw-h-24 tw-bg-gray-100 tw-rounded tw-overflow-hidden">
                            <img src="{{ asset('storage') }}/${appointment.after_image}" 
                            alt="After grooming" class="tw-w-full tw-h-full tw-object-cover"/>
                        </div>
                    `;
                }
            } else {
                document.getElementById('groomingSection').classList.add('tw-hidden');
            }
        }
        
        // Set status badge and action buttons based on current status
        function setStatusDisplay(status) {
            const statusBadge = document.getElementById('appointmentStatusBadge');
            const statusText = document.getElementById('statusText');
            const editBtn = document.getElementById('editAppointmentBtn');
            const cancelBtn = document.getElementById('cancelAppointmentBtn');
            
            // Reset all styling first
            statusBadge.className = 'tw-px-4 tw-py-2 tw-rounded-full tw-text-sm tw-font-medium';
            
            // Configure based on status
            switch (status) {
                case 'Pending':
                    statusBadge.classList.add('tw-bg-yellow-100', 'tw-text-yellow-800');
                    statusText.innerHTML = '<i class="fas fa-clock tw-mr-2"></i>Pending';
                    editBtn.classList.remove('tw-hidden');
                    cancelBtn.classList.remove('tw-hidden');
                    break;
                    
                case 'Confirmed':
                    statusBadge.classList.add('tw-bg-blue-100', 'tw-text-blue-800');
                    statusText.innerHTML = '<i class="fas fa-check-circle tw-mr-2"></i>Confirmed';
                    editBtn.classList.add('tw-hidden');
                    cancelBtn.classList.remove('tw-hidden');
                    break;
                    
                case 'Active':
                    statusBadge.classList.add('tw-bg-green-100', 'tw-text-green-800');
                    statusText.innerHTML = '<i class="fas fa-spinner fa-spin tw-mr-2"></i>In Progress';
                    editBtn.classList.add('tw-hidden');
                    cancelBtn.classList.add('tw-hidden');
                    break;
                    
                case 'Completed':
                    statusBadge.classList.add('tw-bg-green-100', 'tw-text-green-800');
                    statusText.innerHTML = '<i class="fas fa-check-double tw-mr-2"></i>Completed';
                    editBtn.classList.add('tw-hidden');
                    cancelBtn.classList.add('tw-hidden');
                    break;
                    
                case 'Cancelled':
                    statusBadge.classList.add('tw-bg-red-100', 'tw-text-red-800');
                    statusText.innerHTML = '<i class="fas fa-times-circle tw-mr-2"></i>Cancelled';
                    editBtn.classList.add('tw-hidden');
                    cancelBtn.classList.add('tw-hidden');
                    break;
                    
                default:
                    statusBadge.classList.add('tw-bg-gray-100', 'tw-text-gray-800');
                    statusText.innerHTML = '<i class="fas fa-question-circle tw-mr-2"></i>' + status;
                    editBtn.classList.add('tw-hidden');
                    cancelBtn.classList.add('tw-hidden');
            }
        }
        
        // Handle cancel button click
        document.getElementById('cancelAppointmentBtn').addEventListener('click', function() {
            if (!window.currentAppointmentData) return;
            
            Swal.fire({
                title: 'Cancel Appointment?',
                html: '<p style="margin-bottom:10px">Are you sure you want to cancel this appointment? This cannot be undone.</p>' +
                      '<input type="password" id="cancel-appt-modal-pw" class="swal2-input" placeholder="Enter your password to confirm">',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, cancel it!',
                cancelButtonText: 'No, keep it',
                preConfirm: () => {
                    const pw = document.getElementById('cancel-appt-modal-pw').value;
                    if (!pw) { Swal.showValidationMessage('Please enter your password'); return false; }
                    return pw;
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    
                    fetch("{{ route('user.appointments.cancel', ['id' => ':id']) }}".replace(':id', window.currentAppointmentData.appointmentID), {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ user_password: result.value })
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(data => {
                                throw new Error(data.message || 'Failed to cancel appointment');
                            });
                        }
                        return response.json();
                    })
                    .then(data => {
                        Swal.fire({
                            title: 'Cancelled!',
                            text: 'Your appointment has been cancelled.',
                            icon: 'success',
                            confirmButtonColor: '#24CFF4'
                        });
                        
                        if (window.currentAppointmentData) {
                            window.currentAppointmentData.status = 'Cancelled';
                            setStatusDisplay('Cancelled');
                        }
                        
                        if (window.ManagePage && typeof window.ManagePage.refreshTables === 'function') {
                            window.ManagePage.refreshTables();
                        }
                        if (window.DashboardPage && typeof window.DashboardPage.initializeTables === 'function') {
                            window.DashboardPage.initializeTables();
                        }
                    })
                    .catch(error => {
                        console.error('Error cancelling appointment:', error);
                        Swal.fire({
                            title: 'Error',
                            text: error.message || 'Failed to cancel the appointment.',
                            icon: 'error',
                            confirmButtonColor: '#24CFF4'
                        });
                    });
                }
            });
        });
        
        // Setup edit appointment button handler
        document.getElementById('editAppointmentBtn').addEventListener('click', function() {
            document.getElementById('viewAppointment-modal').classList.add('tw-hidden');
            if(typeof window.openEditAppointmentModal === 'function') {
                window.openEditAppointmentModal(window.currentAppointmentData.appointmentID);
            } else {
                console.error("openEditAppointmentModal function not found");
                Swal.fire({
                    title: 'Error',
                    text: 'Could not fetch appointment details. Please try again later.',
                    icon: 'error',
                    confirmButtonColor: '#24CFF4',
                });
            }
        });
        
        // Close modal handler
        const modalToggle = document.querySelector('[data-modal-toggle="viewAppointment-modal"]');
        if (modalToggle) {
            modalToggle.addEventListener('click', function() {
                document.getElementById('viewAppointment-modal').classList.add('tw-hidden');
            });
        }
        
        // Helper function for payment status styling
        function getPaymentStatusClass(status) {
            switch (status) {
                case 'Completed':
                    return 'tw-bg-green-100 tw-text-green-800';
                case 'Pending':
                    return 'tw-bg-yellow-100 tw-text-yellow-800';
                case 'Failed':
                    return 'tw-bg-red-100 tw-text-red-800';
                default:
                    return 'tw-bg-gray-100 tw-text-gray-800';
            }
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
        
        // Utility function to format time
        function formatTime(timeString) {
            if (!timeString) return 'Not specified';
            
            const [hours, minutes] = timeString.split(':');
            const time = new Date();
            time.setHours(parseInt(hours, 10));
            time.setMinutes(parseInt(minutes, 10));
            
            return time.toLocaleTimeString('en-US', {
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            });
        }
        
        // Utility function to format date and time together
        function formatDateTime(dateTimeString) {
            if (!dateTimeString) return 'Not specified';
            
            const date = new Date(dateTimeString);
            return date.toLocaleDateString('en-US', {
                month: 'short',
                day: 'numeric', 
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            });
        }

        function formatPetAge(birthDateString) {
            if (!birthDateString) return 'Not specified';

            const birthDate = new Date(birthDateString);
            if (Number.isNaN(birthDate.getTime())) return 'Not specified';

            const today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDifference = today.getMonth() - birthDate.getMonth();

            if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }

            if (age < 1) {
                const months = Math.max(1, Math.floor((today - birthDate) / (1000 * 60 * 60 * 24 * 30)));
                return months + ' month' + (months !== 1 ? 's' : '');
            }

            return age + ' year' + (age !== 1 ? 's' : '');
        }
    });
});
</script>



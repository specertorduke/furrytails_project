<!-- filepath: c:\xampp\htdocs\dashboard\furrytails_project\resources\views\modals\user\view-boarding.blade.php -->
<!-- View Boarding Modal -->
<div id="viewBoarding-modal" tabindex="-1" aria-hidden="true" class="tw-hidden tw-fixed tw-top-0 tw-left-0 tw-right-0 tw-z-50 tw-w-full tw-p-4 tw-overflow-x-hidden tw-overflow-y-auto md:tw-inset-0 tw-h-full tw-max-h-full tw-flex tw-items-center tw-justify-center tw-backdrop-blur-sm tw-bg-black/30">
    <div class="tw-relative tw-w-full tw-max-w-4xl tw-max-h-full tw-animate-modal-entry">
        <!-- Modal content -->
        <div class="tw-relative tw-bg-white tw-rounded-lg tw-shadow-xl">
            <!-- Modal header -->
            <div class="tw-flex tw-items-center tw-justify-between tw-p-4 md:tw-p-5 tw-border-b tw-rounded-t tw-border-gray-200">
                <h3 class="tw-text-lg tw-font-semibold tw-text-gray-800">Boarding Details</h3>
                <button type="button" class="tw-text-gray-500 tw-bg-transparent tw-hover:tw-bg-gray-100 tw-hover:tw-text-gray-700 tw-rounded-lg tw-text-sm tw-w-8 tw-h-8 ms-auto tw-inline-flex tw-justify-center tw-items-center" data-modal-toggle="viewBoarding-modal">
                    <svg class="tw-w-3 tw-h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            
            <!-- Modal body -->
            <div class="tw-p-4 md:tw-p-5">
                <div class="tw-grid tw-grid-cols-1 lg:tw-grid-cols-3 tw-gap-6">
                    <!-- Left Column - Boarding Details -->
                    <div class="lg:tw-col-span-2">
                        <div class="tw-bg-gray-50 tw-rounded-lg tw-p-5 tw-mb-6 tw-shadow-sm">
                            <!-- Boarding ID & Status -->
                            <div class="tw-flex tw-justify-between tw-items-center tw-mb-4">
                                <div>
                                    <h4 class="tw-text-gray-500 tw-text-sm tw-font-medium">Boarding ID</h4>
                                    <p class="tw-text-lg tw-font-semibold" id="view-boarding-id"></p>
                                </div>
                                <div class="tw-text-right">
                                    <h4 class="tw-text-gray-500 tw-text-sm tw-font-medium">Status</h4>
                                    <span id="view-boarding-status" class="tw-px-3 tw-py-1 tw-rounded-full tw-text-sm tw-bg-blue-100 tw-text-blue-800"></span>
                                </div>
                            </div>

                            <!-- Boarding Type & Duration -->
                            <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-4 tw-mb-4">
                                <div>
                                    <h4 class="tw-text-gray-500 tw-text-sm tw-font-medium">Boarding Type</h4>
                                    <p id="view-boarding-type" class="tw-font-medium"></p>
                                </div>
                                <div>
                                    <h4 class="tw-text-gray-500 tw-text-sm tw-font-medium">Duration</h4>
                                    <p id="view-boarding-duration" class="tw-font-medium"></p>
                                </div>
                            </div>

                            <!-- Date Range -->
                            <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-4 tw-mb-4">
                                <div>
                                    <h4 class="tw-text-gray-500 tw-text-sm tw-font-medium">Start Date</h4>
                                    <p id="view-boarding-start" class="tw-font-medium"></p>
                                </div>
                                <div>
                                    <h4 class="tw-text-gray-500 tw-text-sm tw-font-medium">End Date</h4>
                                    <p id="view-boarding-end" class="tw-font-medium"></p>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Information -->
                        <div class="tw-bg-gray-50 tw-rounded-lg tw-p-5 tw-mb-6 tw-shadow-sm">
                            <h3 class="tw-text-lg tw-font-medium tw-mb-3 tw-flex tw-items-center">
                                <svg class="tw-w-5 tw-h-5 tw-mr-2 tw-text-[#24CFF4]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path>
                                    <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path>
                                </svg>
                                Payment Details
                            </h3>

                            <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-3 tw-gap-4 tw-mb-3">
                                <div>
                                    <h4 class="tw-text-gray-500 tw-text-sm tw-font-medium">Daily Rate</h4>
                                    <p id="view-boarding-rate" class="tw-font-medium"></p>
                                </div>
                                <div>
                                    <h4 class="tw-text-gray-500 tw-text-sm tw-font-medium">Total Days</h4>
                                    <p id="view-boarding-days" class="tw-font-medium"></p>
                                </div>
                                <div>
                                    <h4 class="tw-text-gray-500 tw-text-sm tw-font-medium">Total Amount</h4>
                                    <p id="view-boarding-total" class="tw-font-semibold tw-text-[#24CFF4]"></p>
                                </div>
                            </div>

                            <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-4">
                                <div>
                                    <h4 class="tw-text-gray-500 tw-text-sm tw-font-medium">Payment Method</h4>
                                    <p id="view-payment-method" class="tw-font-medium"></p>
                                </div>
                                <div>
                                    <h4 class="tw-text-gray-500 tw-text-sm tw-font-medium">Payment Status</h4>
                                    <span id="view-payment-status" class="tw-px-3 tw-py-1 tw-rounded-full tw-text-sm"></span>
                                </div>
                            </div>

                            <div id="payment-reference-section" class="tw-mt-3 tw-hidden">
                                <h4 class="tw-text-gray-500 tw-text-sm tw-font-medium">Reference Number</h4>
                                <p id="view-payment-reference" class="tw-font-medium"></p>
                            </div>
                        </div>

                        <!-- Previous Boarding History -->
                        <div class="tw-bg-gray-50 tw-rounded-lg tw-p-5 tw-shadow-sm">
                            <h3 class="tw-text-lg tw-font-medium tw-mb-3 tw-flex tw-items-center">
                                <svg class="tw-w-5 tw-h-5 tw-mr-2 tw-text-[#24CFF4]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                </svg>
                                Previous Boardings
                            </h3>
                            
                            <div id="boarding-history-container" class="tw-overflow-y-auto tw-max-h-60">
                                <div id="no-history" class="tw-text-gray-500 tw-text-center tw-py-3 tw-hidden">
                                    No previous boarding history found.
                                </div>
                                <div id="boarding-history-list">
                                    <!-- History items will be populated by JavaScript -->
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
                            
                            <!-- Pet Image -->
                            <div class="tw-flex tw-justify-center tw-mb-4">
                                <div id="boarding-pet-image" class="tw-w-32 tw-h-32 tw-rounded-full tw-overflow-hidden tw-border-4 tw-border-[#24CFF4]/30 tw-bg-gray-200 tw-flex tw-items-center tw-justify-center">
                                    <!-- Image will be populated by JavaScript -->
                                </div>
                            </div>
                            
                            <!-- Pet Details -->
                            <div class="tw-text-center tw-mb-4">
                                <h4 id="view-pet-name" class="tw-text-xl tw-font-semibold tw-mb-1"></h4>
                                <span id="view-pet-species" class="tw-px-3 tw-py-1 tw-rounded-full tw-text-sm"></span>
                            </div>
                            
                            <div class="tw-grid tw-grid-cols-2 tw-gap-3 tw-mt-4">
                                <div>
                                    <h4 class="tw-text-gray-500 tw-text-sm tw-font-medium">Breed</h4>
                                    <p id="view-pet-breed" class="tw-font-medium"></p>
                                </div>
                                <div>
                                    <h4 class="tw-text-gray-500 tw-text-sm tw-font-medium">Age</h4>
                                    <p id="view-pet-age" class="tw-font-medium"></p>
                                </div>
                                <div>
                                    <h4 class="tw-text-gray-500 tw-text-sm tw-font-medium">Gender</h4>
                                    <p id="view-pet-gender" class="tw-font-medium"></p>
                                </div>
                                <div>
                                    <h4 class="tw-text-gray-500 tw-text-sm tw-font-medium">Weight</h4>
                                    <p id="view-pet-weight" class="tw-font-medium"></p>
                                </div>
                            </div>
                            
                            <!-- Special Notes -->
                            <div class="tw-mt-4">
                                <h4 class="tw-text-gray-500 tw-text-sm tw-font-medium">Special Notes</h4>
                                <p id="view-pet-notes" class="tw-font-medium tw-bg-white tw-p-3 tw-rounded tw-mt-1 tw-text-sm tw-h-24 tw-overflow-y-auto"></p>
                            </div>
                        </div>

                        <!-- Actions Section -->
                        <div class="tw-mt-4 tw-space-y-3">
                            <!-- Cancel Button (Only visible for non-completed boardings) -->
                            <button type="button" id="cancelBoardingBtn" class="tw-hidden tw-w-full tw-text-white tw-bg-red-600 hover:tw-bg-red-700 tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center tw-flex tw-justify-center tw-items-center tw-gap-2">
                                <svg class="tw-w-4 tw-h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Cancel Boarding
                            </button>
                            
                            <!-- Close Button -->
                            <button type="button" data-modal-toggle="viewBoarding-modal" class="tw-w-full tw-text-gray-600 tw-bg-gray-100 hover:tw-bg-gray-200 tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center">
                                Close
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
    
    // Global variable to store the current boarding ID
    let currentBoardingId = null;
    
    // Make function available globally
    window.openViewBoardingModal = function(boardingId) {
        // Store the boarding ID
        currentBoardingId = boardingId;
        
        // Show modal
        const viewBoardingModal = document.getElementById('viewBoarding-modal');
        if (!viewBoardingModal) {
            console.error('View boarding modal not found in DOM');
            return;
        }
        
        // Show modal
        viewBoardingModal.classList.remove('tw-hidden');
        
        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // Fetch boarding data
        fetch("{{ route('user.boardings.show', ['id' => ':boardingId']) }}".replace(':boardingId', boardingId), {
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
            
            console.log("Boarding data received:", data);
            
            // Populate boarding details
            populateBoardingDetails(data.boarding);
            
            // Populate pet information - pet is nested in boarding object
            populatePetDetails(data.boarding.pet);
            
            // Populate payment information - payments array is in boarding object
            populatePaymentDetails(data.boarding.payments, data.boarding);
            
            // Populate boarding history
            populateBoardingHistory(data.boardingHistory);
            
            // Show/hide cancel button based on status
            toggleCancelButton(data.boarding);
        })
        .catch(error => {
            console.error('Error fetching boarding data:', error);
            Swal.fire({
                title: 'Error!',
                text: 'Failed to load boarding data',
                icon: 'error',
                confirmButtonColor: '#24CFF4'
            });
            
            viewBoardingModal.classList.add('tw-hidden');
        });
    };
    
    // Function to populate boarding details
    function populateBoardingDetails(boarding) {
        // Set boarding ID
        document.getElementById('view-boarding-id').textContent = '#' + boarding.boardingID;
        
        // Format and set status with appropriate color
        const statusElement = document.getElementById('view-boarding-status');
        statusElement.textContent = boarding.status;
        
        // Remove any existing status classes
        statusElement.className = "tw-px-3 tw-py-1 tw-rounded-full tw-text-sm";
        
        // Add appropriate status color class
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
        
        // Set boarding type
        document.getElementById('view-boarding-type').textContent = boarding.boardingType || 'Regular Boarding';
        
        // Format dates
        const startDate = new Date(boarding.start_date);
        const endDate = new Date(boarding.end_date);
        
        const formatOptions = { weekday: 'short', year: 'numeric', month: 'short', day: 'numeric' };
        document.getElementById('view-boarding-start').textContent = startDate.toLocaleDateString('en-US', formatOptions);
        document.getElementById('view-boarding-end').textContent = endDate.toLocaleDateString('en-US', formatOptions);
        
        // Calculate duration
        const diffTime = Math.abs(endDate - startDate);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        document.getElementById('view-boarding-duration').textContent = diffDays + ' day' + (diffDays !== 1 ? 's' : '');
        document.getElementById('view-boarding-days').textContent = diffDays + ' day' + (diffDays !== 1 ? 's' : '');
    }
    
    // Function to populate pet details
    function populatePetDetails(pet) {
    console.log("Pet data received:", pet);
    if (!pet) {
        console.error("No pet data provided");
        return;
    }
    
    // Set pet name
    document.getElementById('view-pet-name').textContent = pet.name || 'Unknown';
    
    // Set pet image or use default
    const petImage = document.getElementById('boarding-pet-image');
    if (pet.petImage) {
        let imageUrl = "{{ asset('') }}" + (pet.petImage.startsWith('storage/') 
            ? pet.petImage 
            : 'storage/' + pet.petImage);
        petImage.innerHTML = `<img src="${imageUrl}" alt="${pet.name}" class="tw-w-full tw-h-full tw-object-cover">`;
    } else {
        // Default icon based on species
        let speciesIcon = '<i class="fas fa-paw tw-text-4xl tw-text-gray-400"></i>';
        
        if (pet.species && pet.species.toLowerCase() === 'dog') {
            speciesIcon = '<i class="fas fa-dog tw-text-4xl tw-text-gray-400"></i>';
        } else if (pet.species && pet.species.toLowerCase() === 'cat') {
            speciesIcon = '<i class="fas fa-cat tw-text-4xl tw-text-gray-400"></i>';
        }
        
        petImage.innerHTML = speciesIcon;
    }
    
    // Set pet species with appropriate styling
    const speciesElement = document.getElementById('view-pet-species');
    speciesElement.textContent = pet.species || 'Unknown';
    
    // Apply species-specific styling
    speciesElement.className = "tw-px-3 tw-py-1 tw-rounded-full tw-text-sm";
    if (pet.species && pet.species.toLowerCase() === 'dog') {
        speciesElement.classList.add('tw-bg-blue-100', 'tw-text-blue-800');
    } else if (pet.species && pet.species.toLowerCase() === 'cat') {
        speciesElement.classList.add('tw-bg-purple-100', 'tw-text-purple-800');
    } else {
        speciesElement.classList.add('tw-bg-green-100', 'tw-text-green-800');
    }
    
    // Set other pet details
    document.getElementById('view-pet-breed').textContent = pet.breed || 'Not specified';
    
    // Calculate and format age
    let ageText = 'Not specified';
    if (pet.birthDate || pet.birthdate) { // Check both possible property names
        const birthDate = new Date(pet.birthDate || pet.birthdate);
        const today = new Date();
        let age = today.getFullYear() - birthDate.getFullYear();
        const monthDifference = today.getMonth() - birthDate.getMonth();
        
        if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        
        if (age < 1) {
            // Calculate months for puppies/kittens
            const months = today.getMonth() - birthDate.getMonth();
            ageText = months + ' month' + (months !== 1 ? 's' : '');
        } else {
            ageText = age + ' year' + (age !== 1 ? 's' : '');
        }
    }
    document.getElementById('view-pet-age').textContent = ageText;
    
    // Set gender with icon
    const genderIcon = pet.gender?.toLowerCase() === 'female' ? '♀' : '♂';
    document.getElementById('view-pet-gender').innerHTML = `${genderIcon} ${pet.gender || 'Not specified'}`;
    
    // Set weight with unit
    document.getElementById('view-pet-weight').textContent = pet.weight ? `${pet.weight} kg` : 'Not specified';
    
    // Set special notes or default message
    document.getElementById('view-pet-notes').textContent = 
        pet.petNotes || pet.special_notes || 'No special notes provided.';
}
    
    // Function to populate payment details
    function populatePaymentDetails(payments, boarding) {
        try {
            // Get the first payment if payments is an array
            let payment = null;
            if (Array.isArray(payments) && payments.length > 0) {
                payment = payments[0];
            } else if (payments && !Array.isArray(payments)) {
                payment = payments;
            }
            
            // Safely calculate the rate with fallbacks
            let rate = 0;
            let total_days = 1;
            
            // Calculate total days if dates are available
            if (boarding.start_date && boarding.end_date) {
                const startDate = new Date(boarding.start_date);
                const endDate = new Date(boarding.end_date);
                const diffTime = Math.abs(endDate - startDate);
                total_days = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1; // +1 to include both start and end days
            } else if (boarding.total_days) {
                total_days = boarding.total_days;
            }
            
            // Calculate daily rate based on available data
            if (payment && payment.amount && total_days > 0) {
                rate = payment.amount / total_days;
            } else if (boarding.baseRate) {
                rate = parseFloat(boarding.baseRate);
            } else if (boarding.price_per_day) {
                rate = parseFloat(boarding.price_per_day);
            } else if (boarding.total_price && total_days > 0) {
                rate = boarding.total_price / total_days;
            }
            
            // Display rate with safeguard against NaN
            document.getElementById('view-boarding-rate').textContent = isNaN(rate) ? 
                '₱0.00' : '₱' + parseFloat(rate).toFixed(2);
            
            // Calculate total amount
            let totalAmount = 0;
            if (payment && payment.amount) {
                totalAmount = parseFloat(payment.amount);
            } else if (boarding.total_price) {
                totalAmount = parseFloat(boarding.total_price);
            } else if (rate && total_days) {
                totalAmount = rate * total_days;
            }
            
            // Display total with safeguard against NaN
            document.getElementById('view-boarding-total').textContent = isNaN(totalAmount) ? 
                '₱0.00' : '₱' + parseFloat(totalAmount).toFixed(2);
            
            // Set payment method with default value
            const paymentMethod = payment && payment.payment_method ? payment.payment_method : 'Not yet paid';
            document.getElementById('view-payment-method').textContent = paymentMethod;
            
            // Set payment status with appropriate color
            const paymentStatusElement = document.getElementById('view-payment-status');
            const paymentStatus = payment && payment.status ? payment.status : 'Pending';
            paymentStatusElement.textContent = paymentStatus;
            
            // Remove any existing status classes
            paymentStatusElement.className = "tw-px-3 tw-py-1 tw-rounded-full tw-text-sm";
            
            // Add appropriate status color class
            switch(paymentStatus) {
                case 'Completed':
                    paymentStatusElement.classList.add('tw-bg-green-100', 'tw-text-green-800');
                    break;
                case 'Pending':
                    paymentStatusElement.classList.add('tw-bg-yellow-100', 'tw-text-yellow-800');
                    break;
                case 'Refunded':
                    paymentStatusElement.classList.add('tw-bg-blue-100', 'tw-text-blue-800');
                    break;
                case 'Failed':
                    paymentStatusElement.classList.add('tw-bg-red-100', 'tw-text-red-800');
                    break;
                default:
                    paymentStatusElement.classList.add('tw-bg-gray-100', 'tw-text-gray-800');
            }
            
            // Show/hide payment reference section
            const referenceSection = document.getElementById('payment-reference-section');
            if (payment && payment.reference_number) {
                referenceSection.classList.remove('tw-hidden');
                document.getElementById('view-payment-reference').textContent = payment.reference_number;
            } else {
                referenceSection.classList.add('tw-hidden');
            }
        } catch (error) {
            console.error("Error in populatePaymentDetails:", error);
            // Set default values if there's an error
            document.getElementById('view-boarding-rate').textContent = '₱0.00';
            document.getElementById('view-boarding-total').textContent = '₱0.00';
            document.getElementById('view-payment-method').textContent = 'Not available';
            
            const paymentStatusElement = document.getElementById('view-payment-status');
            paymentStatusElement.textContent = 'Unknown';
            paymentStatusElement.className = "tw-px-3 tw-py-1 tw-rounded-full tw-text-sm tw-bg-gray-100 tw-text-gray-800";
            
            document.getElementById('payment-reference-section').classList.add('tw-hidden');
        }
    }
    
    // Function to populate boarding history
    function populateBoardingHistory(history) {
        const historyList = document.getElementById('boarding-history-list');
        const noHistory = document.getElementById('no-history');
        
        // Clear previous entries
        historyList.innerHTML = '';
        
        // Check if history exists
        if (!history || history.length === 0) {
            noHistory.classList.remove('tw-hidden');
            return;
        }
        
        // Hide "no history" message
        noHistory.classList.add('tw-hidden');
        
        // Add history items
        history.forEach(item => {
            if (item.boardingID === currentBoardingId) return; // Skip current boarding
            
            const startDate = new Date(item.start_date).toLocaleDateString('en-US', {
                year: 'numeric', month: 'short', day: 'numeric'
            });
            
            const endDate = new Date(item.end_date).toLocaleDateString('en-US', {
                year: 'numeric', month: 'short', day: 'numeric'
            });
            
            // Determine status color class
            let statusColorClass = 'tw-bg-gray-100 tw-text-gray-800';
            switch(item.status) {
                case 'Completed':
                    statusColorClass = 'tw-bg-green-100 tw-text-green-800';
                    break;
                case 'Cancelled':
                    statusColorClass = 'tw-bg-red-100 tw-text-red-800';
                    break;
                case 'Active':
                    statusColorClass = 'tw-bg-blue-100 tw-text-blue-800';
                    break;
                case 'Pending':
                    statusColorClass = 'tw-bg-yellow-100 tw-text-yellow-800';
                    break;
            }
            
            const historyItem = document.createElement('div');
            historyItem.className = 'tw-border-b tw-border-gray-200 tw-py-3 tw-last:tw-border-0';
            historyItem.innerHTML = `
                <div class="tw-flex tw-justify-between tw-items-center">
                    <div>
                        <p class="tw-font-medium">${startDate} - ${endDate}</p>
                        <p class="tw-text-gray-500 tw-text-sm">ID: #${item.boardingID}</p>
                    </div>
                    <span class="tw-px-2 tw-py-1 tw-rounded-full tw-text-xs ${statusColorClass}">
                        ${item.status}
                    </span>
                </div>
            `;
            
            historyList.appendChild(historyItem);
        });
    }
    
    // Function to toggle cancel button visibility based on status
    function toggleCancelButton(boarding) {
        const cancelButton = document.getElementById('cancelBoardingBtn');
        
        // Only show cancel button for pending or active boardings
        // And if the start date is in the future (for pending) or today or future (for active)
        const startDate = new Date(boarding.start_date);
        const today = new Date();
        today.setHours(0, 0, 0, 0); // Set to beginning of day for accurate comparison
        
        const canCancel = (
            (boarding.status === 'Pending' || boarding.status === 'Active')
            && startDate >= today
        );
        
        if (canCancel) {
            cancelButton.classList.remove('tw-hidden');
            
            // Add click handler for cancel button
            cancelButton.onclick = function() {
                confirmCancelBoarding(boarding.boardingID);
            };
        } else {
            cancelButton.classList.add('tw-hidden');
        }
    }
    
    // Function to handle boarding cancellation
    function confirmCancelBoarding(boardingId) {
        Swal.fire({
            title: 'Cancel Boarding?',
            text: 'Are you sure you want to cancel this boarding? This action cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#94a3b8',
            confirmButtonText: 'Yes, cancel it',
            cancelButtonText: 'No, keep it'
        }).then((result) => {
            if (result.isConfirmed) {
                // Get CSRF token
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                
                // Send cancel request
                fetch("{{ route('user.boardings.cancel', ['id' => ':id']) }}".replace(':id', boardingId), {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => {
                            throw new Error(err.message || 'Failed to cancel boarding');
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Cancelled!',
                            text: 'Your boarding has been cancelled successfully.',
                            icon: 'success',
                            confirmButtonColor: '#24CFF4'
                        }).then(() => {
                            // Close modal
                            document.getElementById('viewBoarding-modal').classList.add('tw-hidden');
                            
                            // Refresh data in the main page
                            if (window.DashboardPage && window.DashboardPage.initializeTables) {
                                window.DashboardPage.initializeTables();
                            }
                        });
                    } else {
                        throw new Error(data.message || 'Failed to cancel boarding');
                    }
                })
                .catch(error => {
                    console.error('Error cancelling boarding:', error);
                    Swal.fire({
                        title: 'Error!',
                        text: error.message || 'Failed to cancel boarding',
                        icon: 'error',
                        confirmButtonColor: '#24CFF4'
                    });
                });
            }
        });
    }
    
    // Modal close handler
    const viewModalToggleButtons = document.querySelectorAll('[data-modal-toggle="viewBoarding-modal"]');
    if (viewModalToggleButtons) {
        viewModalToggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                document.getElementById('viewBoarding-modal').classList.add('tw-hidden');
            });
        });
    }
    
    // Connect the global view function for use from other pages
    window.ViewBoarding = window.openViewBoardingModal;
});
});
</script>
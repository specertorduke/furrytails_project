<!-- View Service Modal -->
<div id="viewService-modal" tabindex="-1" aria-hidden="true" class="tw-hidden tw-fixed tw-top-0 tw-left-0 tw-right-0 tw-z-50 tw-w-full tw-p-4 tw-overflow-x-hidden tw-overflow-y-auto md:tw-inset-0 tw-h-full tw-max-h-full tw-flex tw-items-center tw-justify-center tw-backdrop-blur-sm tw-bg-black/60">
    <div class="tw-relative tw-w-full tw-max-w-2xl tw-max-h-full tw-animate-modal-entry">
        <!-- Modal content -->
        <div class="tw-relative tw-bg-gray-800 tw-rounded-lg tw-shadow-sm tw-transform tw-transition-all">
            <!-- Modal header -->
            <div class="tw-flex tw-items-center tw-justify-between tw-p-4 md:tw-p-5 tw-border-b tw-rounded-t tw-border-gray-700">
                <h3 class="tw-text-lg tw-font-semibold tw-text-white">Service Details</h3>
                <button type="button" class="tw-text-gray-400 tw-bg-transparent tw-hover:tw-bg-gray-700 tw-hover:tw-text-white tw-rounded-lg tw-text-sm tw-w-8 tw-h-8 ms-auto tw-inline-flex tw-justify-center tw-items-center" data-modal-toggle="viewService-modal">
                    <svg class="tw-w-3 tw-h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            
            <!-- Modal body -->
            <div class="tw-p-4 md:tw-p-5">
                <!-- Service Status Badge - Shown at the top for visibility -->
                <div class="tw-flex tw-justify-center tw-mb-5">
                    <div id="serviceStatusBadge" class="tw-px-4 tw-py-2 tw-rounded-full tw-text-sm tw-font-medium">
                        <!-- Status will be set via JavaScript -->
                        <span id="statusText">Loading...</span>
                    </div>
                </div>

                <!-- Service Info Section -->
                <div class="tw-flex tw-flex-col md:tw-flex-row tw-gap-6">
                    <!-- Service Image Column -->
                    <div class="tw-flex tw-flex-col tw-items-center">
                        <div id="serviceImageContainer" class="tw-h-52 tw-w-52 tw-rounded-lg tw-bg-gray-700 tw-flex tw-items-center tw-justify-center tw-overflow-hidden">
                            <!-- Image will be set via JavaScript -->
                            <i class="fas fa-concierge-bell tw-text-4xl tw-text-[#24CFF4]"></i>
                        </div>
                        <p id="serviceCategory" class="tw-mt-3 tw-text-md tw-font-semibold tw-text-gray-400 tw-px-3 tw-py-1 tw-rounded-full tw-bg-gray-700"></p>
                    </div>
                    
                    <!-- Service Details Column -->
                    <div class="tw-flex-1">
                        <h4 id="serviceName" class="tw-text-xl tw-font-bold tw-text-white tw-mb-2">Loading...</h4>
                        
                        <!-- Price Information -->
                        <div class="tw-mb-4">
                            <span class="tw-text-2xl tw-font-bold tw-text-[#66FF8F]" id="servicePrice">₱0.00</span>
                        </div>
                        
                        <!-- Service Description -->
                        <div class="tw-mt-4 tw-p-3 tw-bg-gray-700/30 tw-rounded-lg tw-mb-4">
                            <h4 class="tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-2">Description</h4>
                            <p id="serviceDescription" class="tw-text-sm tw-text-gray-200">Loading service description...</p>
                        </div>
                        
                        <!-- Service Usage Statistics Section -->
                        <div class="tw-mt-4 tw-p-3 tw-bg-gray-700/30 tw-rounded-lg">
                            <h4 class="tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-2">Service Statistics</h4>
                            <div class="tw-grid tw-grid-cols-2 tw-gap-4">
                                <div>
                                    <p class="tw-text-xs tw-text-gray-400">Used in Appointments</p>
                                    <p id="appointmentCount" class="tw-text-sm tw-text-white">0</p>
                                </div>
                                <div>
                                    <p class="tw-text-xs tw-text-gray-400">Revenue Generated</p>
                                    <p id="revenueGenerated" class="tw-text-sm tw-text-[#66FF8F]">₱0.00</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Service History -->
                        <div class="tw-mt-4">
                            <h4 class="tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-2">Service History</h4>
                            <div class="tw-relative">
                                <!-- Timeline will be set via JavaScript -->
                                <div class="tw-border-l-2 tw-border-gray-700 tw-ml-2.5 tw-pl-4 tw-py-2 tw-space-y-4" id="serviceHistory">
                                    <div class="tw-flex tw-items-start">
                                        <div class="tw-absolute tw-mt-1.5 tw-w-5 tw-h-5 tw-rounded-full tw-bg-blue-500 -tw-left-2.5 tw-border tw-border-gray-800"></div>
                                        <div>
                                            <p class="tw-text-xs tw-text-gray-400">Created</p>
                                            <p id="serviceCreatedAt" class="tw-text-sm tw-text-white"></p>
                                        </div>
                                    </div>
                                    <div class="tw-flex tw-items-start" id="serviceUpdatedBlock">
                                        <div class="tw-absolute tw-mt-1.5 tw-w-5 tw-h-5 tw-rounded-full tw-bg-yellow-500 -tw-left-2.5 tw-border tw-border-gray-800"></div>
                                        <div>
                                            <p class="tw-text-xs tw-text-gray-400">Last updated</p>
                                            <p id="serviceUpdatedAt" class="tw-text-sm tw-text-white"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Actions Section -->
                <div class="tw-flex tw-justify-between tw-mt-8 tw-pt-4 tw-border-t tw-border-gray-700">
                    <div>
                        <button id="editServiceBtn" class="tw-text-white tw-bg-blue-600 hover:tw-bg-blue-700 tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center tw-flex tw-items-center">
                            <i class="fas fa-edit tw-mr-2"></i> Edit
                        </button>
                    </div>
                    
                    <div class="tw-flex tw-gap-2">
                        <button id="toggleStatusBtn" class="tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center tw-flex tw-items-center">
                            <i class="fas tw-mr-2" id="toggleStatusIcon"></i> <span id="toggleStatusText">Toggle Status</span>
                        </button>
                        
                        <button id="deleteServiceBtn" class="tw-text-white tw-bg-red-600 hover:tw-bg-red-700 tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center tw-flex tw-items-center">
                            <i class="fas fa-trash tw-mr-2"></i> Delete
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
        // Global variable to store current service data
        window.currentServiceData = null;
        
        // Function to open service modal with data
        window.openServiceModal = function(serviceId) {
            // Show loading state
            const viewServiceModal = document.getElementById('viewService-modal');
            if (!viewServiceModal) {
                console.error('View service modal not found in DOM');
                return;
            }
            
            // Show modal with loading indicator
            viewServiceModal.classList.remove('tw-hidden');
            
            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            // Fetch service data
            fetch("{{ route('admin.services.show', ['id' => ':serviceId']) }}".replace(':serviceId', serviceId), {
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
                        throw new Error(err.message || 'Failed to load service data');
                    });
                }
                return response.json();
            })
            .then(data => {
                if (!data.success) {
                    throw new Error(data.message || 'Failed to load service data');
                }
                
                // Store current service data
                window.currentServiceData = data.service;
                
                // Populate service information
                populateServiceData(data.service, data.stats);
            })
            .catch(error => {
                console.error('Error fetching service data:', error);
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to load service data',
                    icon: 'error',
                    confirmButtonColor: '#24CFF4',
                    background: '#374151',
                    color: '#fff'
                });
                
                viewServiceModal.classList.add('tw-hidden');
            });
        };
        
        // Function to populate service data in the modal
        function populateServiceData(service, stats) {
            console.log("Populating service data:", service);
            
            // Set service name and category
            document.getElementById('serviceName').textContent = service.name || 'Unnamed Service';
            document.getElementById('serviceCategory').textContent = service.category || 'Uncategorized';
            
            // Set price
            document.getElementById('servicePrice').textContent = formatPrice(service.price);
            
            // Set description
            document.getElementById('serviceDescription').textContent = service.description || 'No description available';
            
            // Set service image if available
            const serviceImageContainer = document.getElementById('serviceImageContainer');
            if (service.serviceImage && service.serviceImage !== 'serviceImages/default.png') {
                let imageUrl = "{{ asset('storage/') }}/" + service.serviceImage.replace(/^storage\//i, '');
                serviceImageContainer.innerHTML = `<img src="${imageUrl}" alt="${service.name}" class="tw-h-full tw-w-full tw-object-cover">`;
            } else {
                // Default icon based on category
                let categoryIcon = 'concierge-bell';
                let iconColor = '#24CFF4';
                
                if (service.category) {
                    const category = service.category.toLowerCase();
                    if (category.includes('groom')) {
                        categoryIcon = 'cut';
                        iconColor = '#FF9666';
                    } else if (category.includes('board')) {
                        categoryIcon = 'home';
                        iconColor = '#66FF8F';
                    } else if (category.includes('vet')) {
                        categoryIcon = 'stethoscope';
                        iconColor = '#FF6666';
                    } else if (category.includes('train')) {
                        categoryIcon = 'graduation-cap';
                        iconColor = '#FFCC66';
                    }
                }
                
                serviceImageContainer.innerHTML = `<i class="fas fa-${categoryIcon} tw-text-6xl" style="color: ${iconColor}"></i>`;
            }
            
            // Set service statistics if available
            if (stats) {
                document.getElementById('appointmentCount').textContent = stats.appointmentCount || '0';
                document.getElementById('revenueGenerated').textContent = formatPrice(stats.revenue || 0);
            }
            
            // Set status badge based on isActive
            setStatusDisplay(service.isActive);
            
            // Set creation and update timestamps
            if (service.created_at) {
                document.getElementById('serviceCreatedAt').textContent = formatDateTime(service.created_at);
            }
            
            if (service.updated_at && service.updated_at !== service.created_at) {
                document.getElementById('serviceUpdatedAt').textContent = formatDateTime(service.updated_at);
                document.getElementById('serviceUpdatedBlock').classList.remove('tw-hidden');
            } else {
                document.getElementById('serviceUpdatedBlock').classList.add('tw-hidden');
            }
            
            // Set up action buttons
            setupActionButtons(service);
        }
        
        // Function to set up action buttons
        function setupActionButtons(service) {
            // Setup edit button handler - clone and replace to avoid duplicate listeners
            const editServiceBtn = document.getElementById('editServiceBtn');
            const newEditServiceBtn = editServiceBtn.cloneNode(true);
            editServiceBtn.parentNode.replaceChild(newEditServiceBtn, editServiceBtn);
            
            newEditServiceBtn.addEventListener('click', function() {
                if (window.currentServiceData) {
                    // Close this modal
                    document.getElementById('viewService-modal').classList.add('tw-hidden');
                    
                    // Call the edit function
                    if (typeof window.editService === 'function') {
                        window.editService(window.currentServiceData.serviceID);
                    } else {
                        console.error('editService function not found');
                    }
                }
            });
            
            // Setup toggle status button - clone and replace to avoid duplicate listeners
            const toggleStatusBtn = document.getElementById('toggleStatusBtn');
            const toggleStatusIcon = document.getElementById('toggleStatusIcon');
            const toggleStatusText = document.getElementById('toggleStatusText');
            
            // Set button appearance based on current status
            if (service.isActive) {
                toggleStatusBtn.className = 'tw-text-white tw-bg-red-600 hover:tw-bg-red-700 tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center tw-flex tw-items-center';
                toggleStatusIcon.className = 'fas fa-times tw-mr-2';
                toggleStatusText.textContent = 'Deactivate';
            } else {
                toggleStatusBtn.className = 'tw-text-white tw-bg-green-600 hover:tw-bg-green-700 tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center tw-flex tw-items-center';
                toggleStatusIcon.className = 'fas fa-check tw-mr-2';
                toggleStatusText.textContent = 'Activate';
            }
            
            const newToggleStatusBtn = toggleStatusBtn.cloneNode(true);
            toggleStatusBtn.parentNode.replaceChild(newToggleStatusBtn, toggleStatusBtn);
            
            newToggleStatusBtn.addEventListener('click', function() {
                if (window.currentServiceData) {
                    // Close this modal
                    document.getElementById('viewService-modal').classList.add('tw-hidden');
                    
                    // Call the toggle status function
                    if (typeof window.toggleServiceStatus === 'function') {
                        window.toggleServiceStatus(window.currentServiceData.serviceID, !window.currentServiceData.isActive);
                    } else {
                        console.error('toggleServiceStatus function not found');
                    }
                }
            });
            
            // Setup delete button - clone and replace to avoid duplicate listeners
            const deleteServiceBtn = document.getElementById('deleteServiceBtn');
            const newDeleteServiceBtn = deleteServiceBtn.cloneNode(true);
            deleteServiceBtn.parentNode.replaceChild(newDeleteServiceBtn, deleteServiceBtn);
            
            newDeleteServiceBtn.addEventListener('click', function() {
                if (window.currentServiceData) {
                    // Close this modal
                    document.getElementById('viewService-modal').classList.add('tw-hidden');
                    
                    // Call the delete function
                    if (typeof window.deleteService === 'function') {
                        window.deleteService(window.currentServiceData.serviceID);
                    } else {
                        console.error('deleteService function not found');
                    }
                }
            });
        }
        
        // Set status badge based on isActive
        function setStatusDisplay(isActive) {
            const statusBadge = document.getElementById('serviceStatusBadge');
            const statusText = document.getElementById('statusText');
            
            if (isActive) {
                statusBadge.className = 'tw-px-4 tw-py-2 tw-rounded-full tw-text-sm tw-font-medium tw-bg-green-900 tw-text-green-300';
                statusText.innerHTML = '<i class="fas fa-check-circle tw-mr-2"></i> Active';
            } else {
                statusBadge.className = 'tw-px-4 tw-py-2 tw-rounded-full tw-text-sm tw-font-medium tw-bg-red-900 tw-text-red-300';
                statusText.innerHTML = '<i class="fas fa-times-circle tw-mr-2"></i> Inactive';
            }
        }
        
        // Close modal handler
        const modalToggle = document.querySelector('[data-modal-toggle="viewService-modal"]');
        if (modalToggle) {
            const newModalToggle = modalToggle.cloneNode(true);
            modalToggle.parentNode.replaceChild(newModalToggle, modalToggle);
            
            newModalToggle.addEventListener('click', function() {
                document.getElementById('viewService-modal').classList.add('tw-hidden');
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
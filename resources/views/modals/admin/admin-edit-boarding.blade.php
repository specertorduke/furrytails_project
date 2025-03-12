<!-- Edit Boarding Modal -->
<div id="editBoarding-modal" tabindex="-1" aria-hidden="true" class="tw-hidden tw-fixed tw-top-0 tw-left-0 tw-right-0 tw-z-50 tw-w-full tw-p-4 tw-overflow-x-hidden tw-overflow-y-auto md:tw-inset-0 tw-h-full tw-max-h-full tw-flex tw-items-center tw-justify-center tw-backdrop-blur-sm tw-bg-black/60">
    <div class="tw-relative tw-w-full tw-max-w-xl tw-max-h-full tw-animate-modal-entry">
        <!-- Modal content -->
        <div class="tw-relative tw-bg-gray-800 tw-rounded-lg tw-shadow-sm tw-transform tw-transition-all">
            <!-- Modal header -->
            <div class="tw-flex tw-items-center tw-justify-between tw-p-4 md:tw-p-5 tw-border-b tw-rounded-t tw-border-gray-700">
                <h3 class="tw-text-lg tw-font-semibold tw-text-white">Edit Boarding</h3>
                <button type="button" class="tw-text-gray-400 tw-bg-transparent tw-hover:tw-bg-gray-700 tw-hover:tw-text-white tw-rounded-lg tw-text-sm tw-w-8 tw-h-8 ms-auto tw-inline-flex tw-justify-center tw-items-center" data-modal-toggle="editBoarding-modal">
                    <svg class="tw-w-3 tw-h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            
            <!-- Modal body -->
            <div class="tw-p-4 md:tw-p-5">
                <form id="editBoardingForm">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" id="editBoardingID" name="boardingID">
                    
                    <!-- Client & Pet Selection Section -->
                    <div class="tw-mb-6">
                        <h4 class="tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-3">Client & Pet</h4>
                        
                        <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-4">
                            <!-- Client Selection -->
                            <div>
                                <label for="edit-boarding-userID" class="tw-block tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-1">Client</label>
                                <select id="edit-boarding-userID" name="userID" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-block tw-w-full tw-p-2.5 focus:tw-border-[#66FF8F] focus:tw-ring-[#66FF8F]" required>
                                    <option value="">Select a client</option>
                                    <!-- Will be populated via JavaScript -->
                                </select>
                            </div>
                            
                            <!-- Pet Selection -->
                            <div>
                                <label for="edit-boarding-petID" class="tw-block tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-1">Pet</label>
                                <select id="edit-boarding-petID" name="petID" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-block tw-w-full tw-p-2.5 focus:tw-border-[#66FF8F] focus:tw-ring-[#66FF8F]" required>
                                    <option value="">Select a pet</option>
                                    <!-- Will be populated via JavaScript -->
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Boarding Details Section -->
                    <div class="tw-mb-6">
                        <h4 class="tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-3">Boarding Details</h4>
                        
                        <!-- Boarding Type -->
                        <div class="tw-mb-4">
                            <label for="edit-boardingType" class="tw-block tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-1">Boarding Type</label>
                            <select id="edit-boardingType" name="boardingType" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-block tw-w-full tw-p-2.5 focus:tw-border-[#66FF8F] focus:tw-ring-[#66FF8F]" required>
                                <option value="">Select boarding type</option>
                                <option value="daycare">Daycare</option>
                                <option value="overnight">Overnight</option>
                                <option value="long-term">Long-term</option>
                            </select>
                        </div>
                        
                        <!-- Date Range -->
                        <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-4">
                            <!-- Start Date -->
                            <div>
                                <label for="edit-start_date" class="tw-block tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-1">Start Date</label>
                                <input type="date" id="edit-start_date" name="start_date" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-block tw-w-full tw-p-2.5 focus:tw-border-[#66FF8F] focus:tw-ring-[#66FF8F]" required>
                            </div>
                            
                            <!-- End Date -->
                            <div>
                                <label for="edit-end_date" class="tw-block tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-1">End Date</label>
                                <input type="date" id="edit-end_date" name="end_date" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-block tw-w-full tw-p-2.5 focus:tw-border-[#66FF8F] focus:tw-ring-[#66FF8F]" required>
                            </div>
                        </div>
                        
                        <!-- Warning for date validation -->
                        <div id="date-warning" class="tw-mt-2 tw-hidden">
                            <p class="tw-text-yellow-500 tw-text-sm tw-flex tw-items-center">
                                <i class="fas fa-exclamation-triangle tw-mr-2"></i>
                                <span id="date-warning-text">End date must be after start date.</span>
                            </p>
                        </div>
                        
                        <!-- Status Selection -->
                        <div class="tw-mt-4">
                            <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-3">Boarding Status</label>
                            
                            <!-- Hidden input to store the selected status -->
                            <input type="hidden" id="edit-boarding-status" name="status" value="Active">
                            
                            <div class="tw-flex tw-flex-wrap tw-gap-2">
                                <button type="button" data-status="Confirmed" class="boarding-status-button tw-px-4 tw-py-2 tw-rounded-md tw-text-sm tw-font-medium tw-flex tw-items-center tw-gap-2 tw-bg-gray-700 hover:tw-bg-blue-700">
                                    <i class="fas fa-calendar-check"></i> Confirmed
                                </button>
                                
                                <button type="button" data-status="Active" class="boarding-status-button tw-px-4 tw-py-2 tw-rounded-md tw-text-sm tw-font-medium tw-flex tw-items-center tw-gap-2 tw-bg-gray-700 hover:tw-bg-blue-700">
                                    <i class="fas fa-bed"></i> Active
                                </button>
                                
                                <button type="button" data-status="Completed" class="boarding-status-button tw-px-4 tw-py-2 tw-rounded-md tw-text-sm tw-font-medium tw-flex tw-items-center tw-gap-2 tw-bg-gray-700 hover:tw-bg-green-700">
                                    <i class="fas fa-check-double"></i> Completed
                                </button>
                                
                                <button type="button" data-status="Cancelled" class="boarding-status-button tw-px-4 tw-py-2 tw-rounded-md tw-text-sm tw-font-medium tw-flex tw-items-center tw-gap-2 tw-bg-gray-700 hover:tw-bg-red-700">
                                    <i class="fas fa-times-circle"></i> Cancelled
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Actions Section -->
                    <div class="tw-flex tw-justify-between tw-mt-8 tw-pt-4 tw-border-t tw-border-gray-700">
                        <button type="button" data-modal-toggle="editBoarding-modal" class="tw-text-gray-300 tw-bg-gray-700 hover:tw-bg-gray-600 tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center">
                            Cancel
                        </button>
                        <button type="submit" id="saveBoardingBtn" class="tw-text-white tw-bg-[#66FF8F] hover:tw-bg-green-500 tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center tw-flex tw-items-center">
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
    // Global variable to store the editing boarding's ID
    let editingBoardingID = null;

    // Make function available globally
    window.openEditBoardingModal = function(boardingId) {
        // Store the boarding ID we're editing
        editingBoardingID = boardingId;
        
        // Show loading state
        const editBoardingModal = document.getElementById('editBoarding-modal');
        if (!editBoardingModal) {
            console.error('Edit boarding modal not found in DOM');
            return;
        }
        
        // Show modal
        editBoardingModal.classList.remove('tw-hidden');
        
        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // Fetch boarding data
        fetch("{{ route('admin.boardings.edit', ['id' => ':boardingId']) }}".replace(':boardingId', boardingId), {
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
            
            // Populate form with data
            document.getElementById('editBoardingID').value = data.boarding.boardingID;
            document.getElementById('edit-start_date').value = data.boarding.start_date;
            document.getElementById('edit-end_date').value = data.boarding.end_date;
            updateStatusButtons(data.boarding.status);
            
            const boardingTypeSelect = document.getElementById('edit-boardingType');
            const boardingTypeValue = data.boarding.boardingType;

            for(let i = 0; i < boardingTypeSelect.options.length; i++) {
                if (boardingTypeSelect.options[i].value.toLowerCase() === boardingTypeValue.toLowerCase()) {
                    boardingTypeSelect.selectedIndex = i;
                    break;
                }
            }
            // Fetch users, pet's user will be selected
            fetchUsers(data.boarding.pet.userID);
            
            // Fetch pets for the selected user after user is set
            setTimeout(() => {
                fetchPets(data.boarding.pet.userID, data.boarding.petID);
            }, 500);
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
            
            editBoardingModal.classList.add('tw-hidden');
        });
    };
    
    // Function to fetch users for dropdown
    function fetchUsers(selectedUserID) {
        fetch("{{ route('admin.users.list') }}", {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to load users');
            }
            return response.json();
        })
        .then(users => {
            const userSelect = document.getElementById('edit-boarding-userID');
            userSelect.innerHTML = '<option value="">Select a client</option>';
            
            users.forEach(user => {
                const option = document.createElement('option');
                option.value = user.userID;
                option.textContent = `${user.firstName} ${user.lastName}`;
                
                // Set as selected if this is the correct user
                if (user.userID == selectedUserID) {
                    option.selected = true;
                }
                
                userSelect.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error fetching users:', error);
        });
    }
    
    // Function to fetch pets for a user
    function fetchPets(userID, selectedPetID) {
        if (!userID) return;
        
        fetch("{{ route('admin.users.pets', ['userId' => ':userId']) }}".replace(':userId', userID), {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to load pets');
            }
            return response.json();
        })
        .then(pets => {
            const petSelect = document.getElementById('edit-boarding-petID');
            petSelect.innerHTML = '<option value="">Select a pet</option>';
            
            if (pets.length === 0) {
                const option = document.createElement('option');
                option.value = "";
                option.textContent = "No pets found for this user";
                petSelect.appendChild(option);
                return;
            }
            
            pets.forEach(pet => {
                const option = document.createElement('option');
                option.value = pet.petID;
                option.textContent = `${pet.name} (${pet.species})`;
                
                // Set as selected if this is the correct pet
                if (pet.petID == selectedPetID) {
                    option.selected = true;
                }
                
                petSelect.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error fetching pets:', error);
        });
    }
    
    // Set up event listeners for user selection change
    const userSelect = document.getElementById('edit-boarding-userID');
    if (userSelect) {
        userSelect.addEventListener('change', function() {
            const userID = this.value;
            if (userID) {
                fetchPets(userID);
            } else {
                // Clear pet dropdown if no user selected
                const petSelect = document.getElementById('edit-boarding-petID');
                petSelect.innerHTML = '<option value="">Select a pet</option>';
            }
        });
    }
    
    // Validate dates when they change
    const startDateInput = document.getElementById('edit-start_date');
    const endDateInput = document.getElementById('edit-end_date');
    const dateWarning = document.getElementById('date-warning');
    
    function validateDates() {
        if (startDateInput.value && endDateInput.value) {
            const start = new Date(startDateInput.value);
            const end = new Date(endDateInput.value);
            
            if (end < start) {
                dateWarning.classList.remove('tw-hidden');
                return false;
            } else {
                dateWarning.classList.add('tw-hidden');
                return true;
            }
        }
        return true; // If both dates aren't filled, don't show warning yet
    }
    
    if (startDateInput && endDateInput) {
        startDateInput.addEventListener('change', validateDates);
        endDateInput.addEventListener('change', validateDates);
    }

    // Handle form submission
    const editBoardingForm = document.getElementById('editBoardingForm');
    if (editBoardingForm) {
        editBoardingForm.addEventListener('submit', function(event) {
            event.preventDefault();
            
            // Basic validation
            const petID = document.getElementById('edit-boarding-petID').value;
            const boardingType = document.getElementById('edit-boardingType').value;
            const startDate = document.getElementById('edit-start_date').value;
            const endDate = document.getElementById('edit-end_date').value;
            
            if (!petID || !boardingType || !startDate || !endDate) {
                Swal.fire({
                    title: 'Missing Information',
                    text: 'Please fill in all required fields',
                    icon: 'warning',
                    confirmButtonColor: '#66FF8F',
                    background: '#374151',
                    color: '#fff'
                });
                return;
            }
            
            // Validate dates
            if (!validateDates()) {
                Swal.fire({
                    title: 'Invalid Dates',
                    text: 'End date must be after start date',
                    icon: 'warning',
                    confirmButtonColor: '#66FF8F',
                    background: '#374151',
                    color: '#fff'
                });
                return;
            }
            
            // Show loading state
            const saveButton = document.getElementById('saveBoardingBtn');
            const originalButtonHTML = saveButton.innerHTML;
            saveButton.disabled = true;
            saveButton.innerHTML = '<i class="fas fa-spinner fa-spin tw-mr-2"></i> Saving...';
            
            // Collect form data
            const formData = new FormData(this);
            
            // Ensure method spoofing is set
            formData.append('_method', 'PUT');
            
            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            // Send update request
            fetch("{{ route('admin.boardings.update', ['id' => ':id']) }}".replace(':id', editingBoardingID), {
                method: 'POST', // POST with _method=PUT for Laravel method spoofing
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    // Don't set Content-Type with FormData
                },
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    // Try to parse error response if possible
                    return response.text().then(text => {
                        try {
                            return JSON.parse(text);
                        } catch (e) {
                            throw new Error('Server returned status ' + response.status);
                        }
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Show success message
                    Swal.fire({
                        title: 'Success!',
                        text: 'Boarding updated successfully',
                        icon: 'success',
                        confirmButtonColor: '#66FF8F',
                        background: '#374151',
                        color: '#fff'
                    }).then(() => {
                        // Hide modal and refresh data
                        document.getElementById('editBoarding-modal').classList.add('tw-hidden');
                        
                        // Refresh the boardings table
                        if (window.BoardingsPage && window.BoardingsPage.boardingsTable) {
                            window.BoardingsPage.boardingsTable.ajax.reload();
                        } else {
                            // If we can't refresh the table, reload the page
                            location.reload();
                        }
                    });
                } else {
                    throw new Error(data.message || 'Failed to update boarding');
                }
            })
            .catch(error => {
                console.error('Error updating boarding:', error);
                Swal.fire({
                    title: 'Error!',
                    text: error.message || 'Failed to update boarding',
                    icon: 'error',
                    confirmButtonColor: '#66FF8F',
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
    
    // Connect the global edit function to this modal's open function
    window.BoardingsPage = window.BoardingsPage || {};
    window.BoardingsPage.editBoarding = window.openEditBoardingModal;
    
    // Modal close handler
    const editModalToggle = document.querySelector('[data-modal-toggle="editBoarding-modal"]');
    if (editModalToggle) {
        editModalToggle.addEventListener('click', function() {
            document.getElementById('editBoarding-modal').classList.add('tw-hidden');
        });
    }

    // Function to update status buttons appearance based on the selected status
    function updateStatusButtons(selectedStatus) {
        // Update the hidden input
        document.getElementById('edit-boarding-status').value = selectedStatus;
        
        // Update button appearance
        const buttons = document.querySelectorAll('.boarding-status-button');
        buttons.forEach(button => {
            const status = button.getAttribute('data-status');
            
            // Reset all buttons
            button.classList.remove('tw-bg-blue-700', 'tw-bg-green-700', 'tw-bg-red-700');
            button.classList.add('tw-bg-gray-700');
            
            // Highlight selected button
            if (status === selectedStatus) {
                button.classList.remove('tw-bg-gray-700');
                
                // Apply appropriate color based on status
                switch (status) {
                    case 'Confirmed':
                        button.classList.add('tw-bg-blue-700');
                        break;
                    case 'Active':
                        button.classList.add('tw-bg-blue-700');
                        break;
                    case 'Completed':
                        button.classList.add('tw-bg-green-700');
                        break;
                    case 'Cancelled':
                        button.classList.add('tw-bg-red-700');
                        break;
                }
            }
        });
    }

    // Set up event listeners for status buttons
    document.querySelectorAll('.boarding-status-button').forEach(button => {
        button.addEventListener('click', function() {
            const status = this.getAttribute('data-status');
            updateStatusButtons(status);
        });
    });
});
});
</script>
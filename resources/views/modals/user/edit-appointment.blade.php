<!-- filepath: c:\xampp\htdocs\dashboard\furrytails_project\resources\views\modals\user\edit-appointment.blade.php -->
<!-- Edit Appointment Modal -->
<div id="editAppointment-modal" tabindex="-1" aria-hidden="true" class="tw-hidden tw-fixed tw-top-0 tw-left-0 tw-right-0 tw-z-50 tw-w-full tw-p-4 tw-overflow-x-hidden tw-overflow-y-auto md:tw-inset-0 tw-h-full tw-max-h-full tw-flex tw-items-center tw-justify-center tw-backdrop-blur-sm tw-bg-black/30">
    <div class="tw-relative tw-w-full tw-max-w-xl tw-max-h-full tw-animate-modal-entry">
        <!-- Modal content -->
        <div class="tw-relative tw-bg-white tw-rounded-lg tw-shadow-xl">
            <!-- Modal header -->
            <div class="tw-flex tw-items-center tw-justify-between tw-p-4 md:tw-p-5 tw-border-b tw-rounded-t tw-border-gray-200">
                <h3 class="tw-text-lg tw-font-semibold tw-text-gray-800">Edit Appointment</h3>
                <button type="button" class="tw-text-gray-500 tw-bg-transparent tw-hover:tw-bg-gray-100 tw-hover:tw-text-gray-700 tw-rounded-lg tw-text-sm tw-w-8 tw-h-8 ms-auto tw-inline-flex tw-justify-center tw-items-center" data-modal-toggle="editAppointment-modal">
                    <svg class="tw-w-3 tw-h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            
            <!-- Modal body -->
            <div class="tw-p-4 md:tw-p-5">
                <form id="editAppointmentForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" id="editAppointmentID" name="appointmentID">
                    
                    <!-- Pet Selection Section -->
                    <div class="tw-mb-6">
                        <h4 class="tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-3">Your Pet</h4>
                        
                        <div class="tw-grid tw-grid-cols-1 tw-gap-4">
                            <!-- Pet Selection -->
                            <div>
                                <label for="edit-petID" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-700">Select Pet</label>
                                <select id="edit-petID" name="petID" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-700 tw-text-sm tw-rounded-lg focus:tw-ring-[#24CFF4] focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5">
                                    <option value="">Select a pet</option>
                                    <!-- Pets will be populated via JavaScript -->
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Service & Time Selection Section -->
                    <div class="tw-mb-6">
                        <h4 class="tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-3">Service Details</h4>
                        
                        <div class="tw-grid tw-grid-cols-1 tw-gap-4">
                            <!-- Service Selection -->
                            <div>
                                <label for="edit-serviceID" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-700">Select Service</label>
                                <select id="edit-serviceID" name="serviceID" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-700 tw-text-sm tw-rounded-lg focus:tw-ring-[#24CFF4] focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5">
                                    <option value="">Select a service</option>
                                    <!-- Services will be populated via JavaScript -->
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Date & Time Selection Section -->
                    <div class="tw-mb-6">
                        <h4 class="tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-3">Date & Time</h4>
                        
                        <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-4">
                            <!-- Date Picker -->
                            <div>
                                <label for="edit-date" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-700">Date</label>
                                <input type="date" id="edit-date" name="date" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-700 tw-text-sm tw-rounded-lg focus:tw-ring-[#24CFF4] focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5">
                            </div>

                            <!-- Time Select -->
                            <div>
                                <label for="edit-time" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-700">Time</label>
                                <select id="edit-time" name="time" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-700 tw-text-sm tw-rounded-lg focus:tw-ring-[#24CFF4] focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5">
                                    <option value="">Select date first</option>
                                </select>
                            </div>
                        </div>

                        <!-- Grooming Section - Only visible for grooming services -->
                        <div id="grooming-section" class="tw-mt-6 tw-hidden">
                            <h4 class="tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-3">Grooming Images (If Applicable)</h4>
                            
                            <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-4">
                                <!-- Before Image -->
                                <div>
                                    <label class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-700">Before Image</label>
                                    <div id="before-image-preview" class="tw-mt-2 tw-flex tw-justify-center tw-items-center tw-bg-gray-50 tw-border tw-border-gray-200 tw-rounded-lg tw-h-40">
                                        <span class="tw-text-gray-400 tw-text-sm">No image uploaded</span>
                                    </div>
                                </div>

                                <!-- After Image -->
                                <div>
                                    <label class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-700">After Image</label>
                                    <div id="after-image-preview" class="tw-mt-2 tw-flex tw-justify-center tw-items-center tw-bg-gray-50 tw-border tw-border-gray-200 tw-rounded-lg tw-h-40">
                                        <span class="tw-text-gray-400 tw-text-sm">No image uploaded</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Time slot availability warning -->
                        <div id="time-warning" class="tw-mt-2 tw-hidden">
                            <p class="tw-text-amber-500 tw-text-sm tw-flex tw-items-center">
                                <svg class="tw-w-4 tw-h-4 tw-mr-1.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                Some time slots may not be available
                            </p>
                        </div>
                    </div>

                    <!-- Appointment Status (Hidden, for system use) -->
                    <input type="hidden" id="edit-status" name="status" value="Pending">
                    
                    <!-- Actions Section -->
                    <div class="tw-flex tw-justify-between tw-mt-8 tw-pt-4 tw-border-t tw-border-gray-200">
                        <button type="button" data-modal-toggle="editAppointment-modal" class="tw-text-gray-600 tw-bg-gray-100 hover:tw-bg-gray-200 tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center">
                            Cancel
                        </button>
                        <button type="submit" id="saveAppointmentBtn" class="tw-text-white tw-bg-[#24CFF4] hover:tw-bg-[#45E3FF] tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center tw-flex tw-items-center">
                            <svg class="tw-w-4 tw-h-4 tw-mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Save Changes
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
    // Global variable to store the editing appointment's ID
    let editingAppointmentID = null;
    let originalDate = null;
    let originalTime = null;

    // Make function available globally
    window.openEditAppointmentModal = function(appointmentId) {
        // Store the appointment ID we're editing
        editingAppointmentID = appointmentId;
        
        // Reset the grooming section
        document.getElementById('before-image-preview').innerHTML = '<span class="tw-text-gray-400 tw-text-sm">No image uploaded</span>';
        document.getElementById('after-image-preview').innerHTML = '<span class="tw-text-gray-400 tw-text-sm">No image uploaded</span>';
        
        // Show modal
        const editAppointmentModal = document.getElementById('editAppointment-modal');
        if (!editAppointmentModal) {
            console.error('Edit appointment modal not found in DOM');
            return;
        }
        
        // Show modal
        editAppointmentModal.classList.remove('tw-hidden');
        
        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // Fetch appointment data
        fetch("{{ route('user.appointments.edit', ['id' => ':appointmentId']) }}".replace(':appointmentId', appointmentId), {
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
                    throw new Error(err.message || 'Failed to load appointment data');
                });
            }
            return response.json();
        })
        .then(data => {
            if (!data.success) {
                throw new Error(data.message || 'Failed to load appointment data');
            }
            
            // Store original values for comparison
            originalDate = data.appointment.date;
            originalTime = data.appointment.time;
            
            // Populate form with data
            document.getElementById('editAppointmentID').value = data.appointment.appointmentID;
            document.getElementById('edit-date').value = data.appointment.date;
            document.getElementById('edit-status').value = data.appointment.status;
            
            // Show before image if available
            if (data.appointment.before_image) {
                const beforePreview = document.getElementById('before-image-preview');
                beforePreview.innerHTML = `
                    <img src="{{ asset('storage') }}/${data.appointment.before_image}" alt="Before Grooming" class="tw-h-full tw-w-full tw-object-cover tw-rounded-lg">
                `;
            }
            
            // Show after image if available
            if (data.appointment.after_image) {
                const afterPreview = document.getElementById('after-image-preview');
                afterPreview.innerHTML = `
                    <img src="{{ asset('storage') }}/${data.appointment.after_image}" alt="After Grooming" class="tw-h-full tw-w-full tw-object-cover tw-rounded-lg">
                `;
            }
            
            // Fetch services, appointment's service will be selected
            fetchServices(data.appointment.serviceID);
            
            // Fetch time slots after we have the date
            fetchTimeSlots(data.appointment.date, data.appointment.time);
            
            // Fetch pets for the current user
            fetchUserPets(data.appointment.petID);
            
            // Check if this is a grooming appointment and show section if needed
            setTimeout(() => {
                toggleGroomingSection();
            }, 800);
        })
        .catch(error => {
            console.error('Error fetching appointment data:', error);
            Swal.fire({
                title: 'Error!',
                text: 'Failed to load appointment data',
                icon: 'error',
                confirmButtonColor: '#24CFF4'
            });
            
            editAppointmentModal.classList.add('tw-hidden');
        });
    };
    
    // Function to fetch services for dropdown
    function fetchServices(selectedServiceID) {
        fetch("{{ route('services.list') }}", {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to load services');
            }
            return response.json();
        })
        .then(services => {
            const serviceSelect = document.getElementById('edit-serviceID');
            serviceSelect.innerHTML = '<option value="">Select a service</option>';
            
            services.forEach(service => {
                const option = document.createElement('option');
                option.value = service.serviceID;
                option.textContent = `${service.name} (₱${service.price})`;
                
                // Add data attribute for category to help determine if grooming
                option.dataset.category = service.category || '';
                
                // Set as selected if this is the correct service
                if (service.serviceID == selectedServiceID) {
                    option.selected = true;
                }
                
                serviceSelect.appendChild(option);
            });
            
            // After loading services, check if we need to show grooming section
            toggleGroomingSection();
        })
        .catch(error => {
            console.error('Error fetching services:', error);
        });
    }
    
    // Function to fetch pets for the current user
    function fetchUserPets(selectedPetID) {
        fetch("{{ route('user.pets.list') }}", {
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
            const petSelect = document.getElementById('edit-petID');
            petSelect.innerHTML = '<option value="">Select a pet</option>';
            
            if (pets.length === 0) {
                const option = document.createElement('option');
                option.value = "";
                option.textContent = "No pets found";
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
    
    // Function to fetch available time slots
    function fetchTimeSlots(date, selectedTime) {
        if (!date) return;
        
        // Get current date and time
        const now = new Date();
        const selectedDate = new Date(date);
        const isToday = selectedDate.toDateString() === now.toDateString();
        const currentHour = now.getHours();
        const currentMinutes = now.getMinutes();
        
        fetch("{{ route('appointments.available-times') }}?date=" + date + 
            (editingAppointmentID ? "&exclude=" + editingAppointmentID : ""), {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to load time slots');
            }
            return response.json();
        })
        .then(data => {
            const timeSelect = document.getElementById('edit-time');
            timeSelect.innerHTML = '<option value="">Select a time</option>';
            
            // Show warning if some slots might be booked
            const timeWarning = document.getElementById('time-warning');
            timeWarning.classList.add('tw-hidden');
            
            let atLeastOneUnavailable = false;
            
            // Process the time slots
            data.timeSlots.forEach(slot => {
                const option = document.createElement('option');
                option.value = slot.value;
                option.textContent = slot.label;
                
                // Check if this is the original time for this appointment
                const isOriginalTime = slot.value === originalTime && date === originalDate;
                
                // Parse the time from the slot (assuming format like "09:00:00")
                const [hours, minutes] = slot.value.split(':').map(Number);
                
                // For today's date, check if the time is at least 1 hour in the future
                let isPastOrTooSoon = false;
                if (isToday) {
                    const slotTime = new Date();
                    slotTime.setHours(hours, minutes, 0);
                    
                    // Add 1 hour to current time for minimum booking window
                    const minBookingTime = new Date();
                    minBookingTime.setHours(currentHour + 1, currentMinutes, 0);
                    
                    // Check if slot is in the past or less than 1 hour in the future
                    isPastOrTooSoon = slotTime < minBookingTime;
                }
                
                // Include the time slot if:
                // 1. It's the original time for this appointment (always show current selection)
                // 2. OR it's available AND not in the past/too soon
                if (isOriginalTime || (slot.available && !isPastOrTooSoon)) {
                    if (isOriginalTime) {
                        option.textContent += ' (Current)';
                        option.selected = true;
                    }
                    timeSelect.appendChild(option);
                } else {
                    // Track that at least one slot is unavailable
                    atLeastOneUnavailable = true;
                }
            });
            
            // Show warning if needed
            if (atLeastOneUnavailable) {
                timeWarning.classList.remove('tw-hidden');
                timeWarning.querySelector('p').innerHTML = `
                    <svg class="tw-w-4 tw-h-4 tw-mr-1.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    ${isToday ? 'Some time slots are unavailable (must be at least 1 hour from now)' : 'Some time slots may not be available'}
                `;
            }

            // If no valid options were added (besides the placeholder)
            if (timeSelect.options.length <= 1) {
                const option = document.createElement('option');
                option.value = "";
                option.textContent = isToday ? "No available times today" : "No available times";
                timeSelect.appendChild(option);
            }
        })
        .catch(error => {
            console.error('Error fetching time slots:', error);
        });
    }
    
    // Set up event listeners for date selection change
    const dateInput = document.getElementById('edit-date');
    if (dateInput) {
        dateInput.addEventListener('change', function() {
            const selectedDate = this.value;
            const timeSelect = document.getElementById('edit-time');
            
            // Reset and disable time select if no date is selected
            if (!selectedDate) {
                timeSelect.innerHTML = '<option value="">Select date first</option>';
                timeSelect.disabled = true;
                return;
            }

            // Enable time select
            timeSelect.disabled = false;
            
            // Set loading state
            timeSelect.innerHTML = '<option value="">Loading available times...</option>';
            
            // Hide warning initially
            document.getElementById('time-warning').classList.add('tw-hidden');
            
            // Fetch time slots for the selected date
            fetchTimeSlots(selectedDate, originalTime);
        });
    }

    // Handle form submission
    const editAppointmentForm = document.getElementById('editAppointmentForm');
    if (editAppointmentForm) {
        editAppointmentForm.addEventListener('submit', function(event) {
            event.preventDefault();
            
            // Basic validation
            const petID = document.getElementById('edit-petID').value;
            const serviceID = document.getElementById('edit-serviceID').value;
            const date = document.getElementById('edit-date').value;
            const time = document.getElementById('edit-time').value;
            
            if (!petID || !serviceID || !date || !time) {
                Swal.fire({
                    title: 'Missing Information',
                    text: 'Please fill in all required fields',
                    icon: 'warning',
                    confirmButtonColor: '#24CFF4'
                });
                return;
            }
            
            // Show loading state
            const saveButton = document.getElementById('saveAppointmentBtn');
            const originalButtonHTML = saveButton.innerHTML;
            saveButton.disabled = true;
            saveButton.innerHTML = '<svg class="tw-animate-spin tw-h-4 tw-w-4 tw-mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="tw-opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="tw-opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Saving...';
            
            // Collect form data
            const formData = new FormData(this);
            
            // Ensure method spoofing is set
            formData.append('_method', 'PUT');
            
            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            // Send update request
            fetch("{{ route('user.appointments.update', ['id' => ':id']) }}".replace(':id', editingAppointmentID), {
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
                    return response.json().then(data => {
                        throw new Error(data.message || 'Failed to update appointment');
                    }).catch(() => {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Show success message
                    Swal.fire({
                        title: 'Success!',
                        text: 'Appointment updated successfully',
                        icon: 'success',
                        confirmButtonColor: '#24CFF4'
                    }).then(() => {
                        // Close the modal
                        document.getElementById('editAppointment-modal').classList.add('tw-hidden');
                        
                        // Reload data in the main page
                        if (window.DashboardPage && window.DashboardPage.initializeTables) {
                            window.DashboardPage.initializeTables();
                        }
                    });
                } else {
                    throw new Error(data.message || 'Failed to update appointment');
                }
            })
            .catch(error => {
                console.error('Error updating appointment:', error);
                Swal.fire({
                    title: 'Error!',
                    text: error.message || 'Failed to update appointment',
                    icon: 'error',
                    confirmButtonColor: '#24CFF4'
                });
            })
            .finally(() => {
                // Restore button state
                saveButton.disabled = false;
                saveButton.innerHTML = originalButtonHTML;
            });
        });
    }
    
    // Modal close handler
    const editModalToggleButtons = document.querySelectorAll('[data-modal-toggle="editAppointment-modal"]');
    if (editModalToggleButtons) {
        editModalToggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                document.getElementById('editAppointment-modal').classList.add('tw-hidden');
            });
        });
    }

    // Check if a service is a grooming service
    function isGroomingService(serviceID) {
        // We need to check if the selected service is a grooming service
        const serviceSelect = document.getElementById('edit-serviceID');
        const selectedOption = serviceSelect.options[serviceSelect.selectedIndex];
        
        if (selectedOption) {
            // First check the data-category attribute
            if (selectedOption.dataset.category && 
                selectedOption.dataset.category.toLowerCase() === 'grooming') {
                return true;
            }
            
            // Fallback: Check if the service name contains "grooming" (case insensitive)
            return selectedOption.textContent.toLowerCase().includes('grooming');
        }
        
        return false;
    }
    
    // Toggle visibility of grooming section based on selected service
    function toggleGroomingSection() {
        const groomingSection = document.getElementById('grooming-section');
        if (!groomingSection) return;
        
        // Check if current selected service is grooming
        if (isGroomingService(document.getElementById('edit-serviceID').value)) {
            groomingSection.classList.remove('tw-hidden');
        } else {
            groomingSection.classList.add('tw-hidden');
        }
    }
    
    // Handle service selection change to show/hide grooming fields
    const serviceSelect = document.getElementById('edit-serviceID');
    if (serviceSelect) {
        serviceSelect.addEventListener('change', function() {
            toggleGroomingSection();
        });
    }
    
    // Connect the global edit function for use from other pages
    window.EditAppointment = window.openEditAppointmentModal;
});
});
</script>
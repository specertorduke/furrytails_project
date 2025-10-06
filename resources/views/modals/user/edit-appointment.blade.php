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
                <!-- Edit Time Restriction Warning -->
                <div id="edit-restriction-warning" class="tw-mb-4 tw-hidden">
                    <div class="tw-bg-amber-50 tw-border tw-border-amber-200 tw-rounded-lg tw-p-3">
                        <div class="tw-flex tw-items-center">
                            <svg class="tw-w-5 tw-h-5 tw-text-amber-400 tw-mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="tw-text-amber-800 tw-text-sm tw-font-medium" id="restriction-message">
                                <!-- Message will be populated via JavaScript -->
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Edit Disabled Warning -->
                <div id="edit-disabled-warning" class="tw-mb-4 tw-hidden">
                    <div class="tw-bg-red-50 tw-border tw-border-red-200 tw-rounded-lg tw-p-3">
                        <div class="tw-flex tw-items-center">
                            <svg class="tw-w-5 tw-h-5 tw-text-red-400 tw-mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="tw-text-red-800 tw-text-sm tw-font-medium">
                                Editing is no longer allowed. You can only edit appointments at least 3 days before the scheduled date.
                            </span>
                        </div>
                    </div>
                </div>

                <form id="editAppointmentForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" id="editAppointmentID" name="appointmentID">
                    
                    <!-- Current Appointment Details Section -->
                    <div class="tw-mb-6">
                        <h4 class="tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-3">Current Appointment Details</h4>
                        
                        <div class="tw-bg-gray-50 tw-rounded-lg tw-p-4 tw-space-y-3">
                            <!-- Pet Information (Read-only) -->
                            <div class="tw-flex tw-justify-between tw-items-center">
                                <span class="tw-text-sm tw-text-gray-600">Pet:</span>
                                <span class="tw-text-sm tw-font-medium tw-text-gray-800" id="current-pet-info">-</span>
                                <input type="hidden" id="edit-petID" name="petID">
                            </div>
                            
                            <!-- Service Information (Read-only) -->
                            <div class="tw-flex tw-justify-between tw-items-center">
                                <span class="tw-text-sm tw-text-gray-600">Service:</span>
                                <span class="tw-text-sm tw-font-medium tw-text-gray-800" id="current-service-info">-</span>
                                <input type="hidden" id="edit-serviceID" name="serviceID">
                            </div>
                            
                            <!-- Status -->
                            <div class="tw-flex tw-justify-between tw-items-center">
                                <span class="tw-text-sm tw-text-gray-600">Status:</span>
                                <span class="tw-text-sm tw-font-medium" id="current-status">-</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Editable Date & Time Section -->
                    <div class="tw-mb-6" id="editable-section">
                        <h4 class="tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-3">Reschedule Appointment</h4>
                        
                        <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-4">
                            <!-- Date Picker -->
                            <div>
                                <label for="edit-date" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-700">New Date</label>
                                <input type="date" id="edit-date" name="date" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-700 tw-text-sm tw-rounded-lg focus:tw-ring-[#24CFF4] focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5">
                            </div>

                            <!-- Time Select -->
                            <div>
                                <label for="edit-time" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-700">New Time</label>
                                <select id="edit-time" name="time" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-700 tw-text-sm tw-rounded-lg focus:tw-ring-[#24CFF4] focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5">
                                    <option value="">Select date first</option>
                                </select>
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
    let canEdit = false;

    // Make function available globally
    window.openEditAppointmentModal = function(appointmentId) {
        // Store the appointment ID we're editing
        editingAppointmentID = appointmentId;
        
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
            document.getElementById('edit-petID').value = data.appointment.petID;
            document.getElementById('edit-serviceID').value = data.appointment.serviceID;
            
            // Display current appointment details (read-only)
            displayCurrentAppointmentDetails(data.appointment, data.pet, data.service);
            
            // Check if editing is allowed and show appropriate warnings
            checkEditingRestrictions(data.appointment.date);
            
            // Fetch time slots after we have the date
            if (canEdit) {
                fetchTimeSlots(data.appointment.date, data.appointment.time);
            }
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
    
    // Function to display current appointment details
    function displayCurrentAppointmentDetails(appointment, pet, service) {
        // Set pet info
        document.getElementById('current-pet-info').textContent = pet ? `${pet.name} (${pet.species})` : 'Unknown Pet';
        
        // Set service info
        document.getElementById('current-service-info').textContent = service ? `${service.name} (₱${service.price})` : 'Unknown Service';
        
        // Set status with appropriate styling
        const statusElement = document.getElementById('current-status');
        statusElement.textContent = appointment.status;
        
        // Add status-specific styling
        statusElement.className = 'tw-text-sm tw-font-medium tw-px-2 tw-py-1 tw-rounded-full tw-text-xs';
        switch(appointment.status.toLowerCase()) {
            case 'pending':
                statusElement.classList.add('tw-bg-yellow-100', 'tw-text-yellow-800');
                break;
            case 'confirmed':
                statusElement.classList.add('tw-bg-green-100', 'tw-text-green-800');
                break;
            case 'active':
                statusElement.classList.add('tw-bg-orange-100', 'tw-text-orange-800');
                break;
            case 'completed':
                statusElement.classList.add('tw-bg-gray-100', 'tw-text-gray-800');
                break;
            case 'cancelled':
                statusElement.classList.add('tw-bg-red-100', 'tw-text-red-800');
                break;
            default:
                statusElement.classList.add('tw-bg-gray-100', 'tw-text-gray-800');
        }
    }
    
    // Function to check editing restrictions
    function checkEditingRestrictions(appointmentDate) {
        const today = new Date();
        const appointmentDateTime = new Date(appointmentDate);
        
        // Calculate days between today and appointment
        const diffTime = appointmentDateTime - today;
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        
        const restrictionWarning = document.getElementById('edit-restriction-warning');
        const disabledWarning = document.getElementById('edit-disabled-warning');
        const editableSection = document.getElementById('editable-section');
        const saveButton = document.getElementById('saveAppointmentBtn');
        const dateInput = document.getElementById('edit-date');
        const timeSelect = document.getElementById('edit-time');
        
        if (diffDays < 3) {
            // Editing not allowed
            canEdit = false;
            disabledWarning.classList.remove('tw-hidden');
            restrictionWarning.classList.add('tw-hidden');
            editableSection.style.opacity = '0.5';
            editableSection.style.pointerEvents = 'none';
            saveButton.disabled = true;
            saveButton.style.opacity = '0.5';
            dateInput.disabled = true;
            timeSelect.disabled = true;
        } else if (diffDays <= 7) {
            // Show warning but allow editing
            canEdit = true;
            restrictionWarning.classList.remove('tw-hidden');
            disabledWarning.classList.add('tw-hidden');
            
            let message = '';
            if (diffDays === 3) {
                message = 'Last day to edit! You can only edit appointments at least 3 days in advance.';
            } else {
                message = `${diffDays} days remaining to edit this appointment. You can only edit appointments at least 3 days in advance.`;
            }
            
            document.getElementById('restriction-message').textContent = message;
            
            // Enable editing
            editableSection.style.opacity = '1';
            editableSection.style.pointerEvents = 'auto';
            saveButton.disabled = false;
            saveButton.style.opacity = '1';
            dateInput.disabled = false;
            timeSelect.disabled = false;
        } else {
            // Normal editing allowed
            canEdit = true;
            restrictionWarning.classList.add('tw-hidden');
            disabledWarning.classList.add('tw-hidden');
            editableSection.style.opacity = '1';
            editableSection.style.pointerEvents = 'auto';
            saveButton.disabled = false;
            saveButton.style.opacity = '1';
            dateInput.disabled = false;
            timeSelect.disabled = false;
        }
    }
    
    // Function to fetch available time slots
    function fetchTimeSlots(date, selectedTime) {
        if (!date || !canEdit) return;
        
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
            if (!canEdit) return;
            
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
            
            if (!canEdit) {
                Swal.fire({
                    title: 'Editing Not Allowed',
                    text: 'You can only edit appointments at least 3 days before the scheduled date.',
                    icon: 'warning',
                    confirmButtonColor: '#24CFF4'
                });
                return;
            }
            
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
    
    // Connect the global edit function for use from other pages
    window.EditAppointment = window.openEditAppointmentModal;
});
});
</script>
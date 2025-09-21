<!-- Edit Appointment Modal -->
<div id="editAppointment-modal" tabindex="-1" aria-hidden="true" class="tw-hidden tw-fixed tw-top-0 tw-left-0 tw-right-0 tw-z-50 tw-w-full tw-p-4 tw-overflow-x-hidden tw-overflow-y-auto md:tw-inset-0 tw-h-full tw-max-h-full tw-flex tw-items-center tw-justify-center tw-backdrop-blur-sm tw-bg-black/60">
    <div class="tw-relative tw-w-full tw-max-w-xl tw-max-h-full tw-animate-modal-entry">
        <!-- Modal content -->
        <div class="tw-relative tw-bg-gray-800 tw-rounded-lg tw-shadow-sm tw-transform tw-transition-all">
            <!-- Modal header -->
            <div class="tw-flex tw-items-center tw-justify-between tw-p-4 md:tw-p-5 tw-border-b tw-rounded-t tw-border-gray-700">
                <h3 class="tw-text-lg tw-font-semibold tw-text-white">Edit Appointment</h3>
                <button type="button" class="tw-text-gray-400 tw-bg-transparent tw-hover:tw-bg-gray-700 tw-hover:tw-text-white tw-rounded-lg tw-text-sm tw-w-8 tw-h-8 ms-auto tw-inline-flex tw-justify-center tw-items-center" data-modal-toggle="editAppointment-modal">
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
                    <input type="hidden" id="edit-petID" name="petID">
                    <input type="hidden" id="edit-serviceID" name="serviceID">
                    
                    <!-- Current Appointment Details Section (Read-only) -->
                    <div class="tw-mb-6">
                        <h4 class="tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-3">Current Appointment Details</h4>
                        
                        <div class="tw-bg-gray-700 tw-rounded-lg tw-p-4 tw-space-y-3">
                            <!-- Client Information (Read-only) -->
                            <div class="tw-flex tw-justify-between tw-items-center">
                                <span class="tw-text-sm tw-text-gray-400">Client:</span>
                                <span class="tw-text-sm tw-font-medium tw-text-white" id="current-client-info">-</span>
                            </div>
                            
                            <!-- Pet Information (Read-only) -->
                            <div class="tw-flex tw-justify-between tw-items-center">
                                <span class="tw-text-sm tw-text-gray-400">Pet:</span>
                                <span class="tw-text-sm tw-font-medium tw-text-white" id="current-pet-info">-</span>
                            </div>
                            
                            <!-- Service Information (Read-only) -->
                            <div class="tw-flex tw-justify-between tw-items-center">
                                <span class="tw-text-sm tw-text-gray-400">Service:</span>
                                <span class="tw-text-sm tw-font-medium tw-text-white" id="current-service-info">-</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Editable Status Section -->
                    <div class="tw-mb-6">
                        <h4 class="tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-3">Update Status</h4>
                        
                        <!-- Hidden input to store the selected status -->
                        <input type="hidden" id="edit-status" name="status" value="Pending">
                        
                        <div class="tw-flex tw-flex-wrap tw-gap-2">
                            <button type="button" data-status="Pending" class="status-button tw-px-4 tw-py-2 tw-rounded-md tw-text-sm tw-font-medium tw-flex tw-items-center tw-gap-2 tw-bg-gray-700 hover:tw-bg-yellow-700">
                                <i class="fas fa-clock"></i> Pending
                            </button>
                            
                            <button type="button" data-status="Confirmed" class="status-button tw-px-4 tw-py-2 tw-rounded-md tw-text-sm tw-font-medium tw-flex tw-items-center tw-gap-2 tw-bg-gray-700 hover:tw-bg-blue-700">
                                <i class="fas fa-check-circle"></i> Confirmed
                            </button>
                            
                            <button type="button" data-status="Completed" class="status-button tw-px-4 tw-py-2 tw-rounded-md tw-text-sm tw-font-medium tw-flex tw-items-center tw-gap-2 tw-bg-gray-700 hover:tw-bg-green-700">
                                <i class="fas fa-check-double"></i> Completed
                            </button>
                            
                            <button type="button" data-status="Cancelled" class="status-button tw-px-4 tw-py-2 tw-rounded-md tw-text-sm tw-font-medium tw-flex tw-items-center tw-gap-2 tw-bg-gray-700 hover:tw-bg-red-700">
                                <i class="fas fa-times-circle"></i> Cancelled
                            </button>
                        </div>
                    </div>
                    
                    <!-- Editable Date & Time Section -->
                    <div class="tw-mb-6">
                        <h4 class="tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-3">Reschedule Appointment</h4>
                        
                        <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-4">
                            <!-- Date Selection -->
                            <div>
                                <label for="edit-date" class="tw-block tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-1">New Date</label>
                                <input type="date" id="edit-date" name="date" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-block tw-w-full tw-p-2.5 focus:tw-border-[#FF9666] focus:tw-ring-[#FF9666]" required>
                            </div>
                            
                            <!-- Time Selection -->
                            <div>
                                <label for="edit-time" class="tw-block tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-1">New Time</label>
                                <select id="edit-time" name="time" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-block tw-w-full tw-p-2.5 focus:tw-border-[#FF9666] focus:tw-ring-[#FF9666]" required>
                                    <option value="">Select a time</option>
                                    <!-- Will be populated via JavaScript -->
                                </select>
                            </div>
                        </div>
                        
                        <!-- Time slot availability warning -->
                        <div id="time-warning" class="tw-mt-2 tw-hidden">
                            <p class="tw-text-yellow-500 tw-text-sm tw-flex tw-items-center">
                                <i class="fas fa-exclamation-triangle tw-mr-2"></i>
                                <span id="time-warning-text">Some time slots may not be available</span>
                            </p>
                        </div>
                    </div>

                    <!-- Grooming Section - Only visible for grooming services -->
                    <div id="grooming-section" class="tw-mb-6 tw-hidden">
                        <h4 class="tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-3">Grooming Information</h4>
                        
                        <div class="tw-grid tw-grid-cols-1 tw-gap-4">
                            <!-- Before and After Images -->
                            <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-4 tw-mt-4">
                                <!-- Before Image -->
                                <div>
                                    <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-2">Before Grooming</label>
                                    <div class="tw-flex tw-flex-col tw-items-center">
                                        <div id="before-image-preview" class="tw-mb-2 tw-w-full tw-h-40 tw-bg-gray-700 tw-border tw-border-gray-600 tw-rounded-lg tw-flex tw-items-center tw-justify-center">
                                            <span class="tw-text-gray-400 tw-text-sm">No image uploaded</span>
                                        </div>
                                        <label for="before_image" class="tw-cursor-pointer tw-bg-gray-700 hover:tw-bg-gray-600 tw-text-white tw-font-medium tw-rounded-lg tw-text-sm tw-px-4 tw-py-2 tw-text-center tw-flex tw-items-center">
                                            <i class="fas fa-camera tw-mr-2"></i> Upload Before Image
                                        </label>
                                        <input type="file" name="before_image" id="before_image" class="tw-hidden" accept="image/*">
                                    </div>
                                </div>
                                
                                <!-- After Image -->
                                <div>
                                    <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-2">After Grooming</label>
                                    <div class="tw-flex tw-flex-col tw-items-center">
                                        <div id="after-image-preview" class="tw-mb-2 tw-w-full tw-h-40 tw-bg-gray-700 tw-border tw-border-gray-600 tw-rounded-lg tw-flex tw-items-center tw-justify-center">
                                            <span class="tw-text-gray-400 tw-text-sm">No image uploaded</span>
                                        </div>
                                        <label for="after_image" class="tw-cursor-pointer tw-bg-gray-700 hover:tw-bg-gray-600 tw-text-white tw-font-medium tw-rounded-lg tw-text-sm tw-px-4 tw-py-2 tw-text-center tw-flex tw-items-center">
                                            <i class="fas fa-camera tw-mr-2"></i> Upload After Image
                                        </label>
                                        <input type="file" name="after_image" id="after_image" class="tw-hidden" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Admin Password Section -->
                    <div class="tw-mb-6">
                        <label for="admin-password-edit-appointment" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white">
                            <i class="fas fa-lock tw-mr-2"></i>Admin Password (Required for Security)
                        </label>
                        <input type="password" id="admin-password-edit-appointment" name="admin-password" 
                               class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#FF9666] tw-focus:tw-border-[#FF9666] tw-block tw-w-full tw-p-2.5" 
                               placeholder="Enter your current password" required>
                        <p class="tw-text-xs tw-text-gray-400 tw-mt-1">Enter your admin password to confirm appointment changes</p>
                    </div>
                    
                    <!-- Actions Section -->
                    <div class="tw-flex tw-justify-between tw-mt-8 tw-pt-4 tw-border-t tw-border-gray-700">
                        <button type="button" data-modal-toggle="editAppointment-modal" class="tw-text-gray-300 tw-bg-gray-700 hover:tw-bg-gray-600 tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center">
                            Cancel
                        </button>
                        <button type="submit" id="saveAppointmentBtn" class="tw-text-white tw-bg-[#FF9666] hover:tw-bg-orange-500 tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center tw-flex tw-items-center">
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
        
        // Clear admin password field
        document.getElementById('admin-password-edit-appointment').value = '';
        
        // Show loading state
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
        fetch("{{ route('admin.appointments.edit', ['id' => ':appointmentId']) }}".replace(':appointmentId', appointmentId), {
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
            document.getElementById('edit-petID').value = data.appointment.petID;
            document.getElementById('edit-serviceID').value = data.appointment.serviceID;
            updateStatusButtons(data.appointment.status);
            
            // Display current appointment details (read-only)
            displayCurrentAppointmentDetails(data.appointment, data.pet, data.service, data.user);
            
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
            
            // Fetch time slots after we have the date
            fetchTimeSlots(data.appointment.date, data.appointment.time);
            
            // Check if this is a grooming appointment and show section if needed
            if (data.service && data.service.category && data.service.category.toLowerCase() === 'grooming') {
                document.getElementById('grooming-section').classList.remove('tw-hidden');
            } else {
                document.getElementById('grooming-section').classList.add('tw-hidden');
            }
        })
        .catch(error => {
            console.error('Error fetching appointment data:', error);
            Swal.fire({
                title: 'Error!',
                text: 'Failed to load appointment data',
                icon: 'error',
                confirmButtonColor: '#FF9666',
                background: '#374151',
                color: '#fff'
            });
            
            editAppointmentModal.classList.add('tw-hidden');
        });
    };
    
    // Function to display current appointment details
    function displayCurrentAppointmentDetails(appointment, pet, service, user) {
        // Set client info
        document.getElementById('current-client-info').textContent = user ? `${user.firstName} ${user.lastName}` : 'Unknown Client';
        
        // Set pet info
        document.getElementById('current-pet-info').textContent = pet ? `${pet.name} (${pet.species})` : 'Unknown Pet';
        
        // Set service info
        document.getElementById('current-service-info').textContent = service ? `${service.name} (₱${service.price})` : 'Unknown Service';
    }
    
    // Function to fetch available time slots
    function fetchTimeSlots(date, selectedTime) {
        if (!date) return;
        
        fetch("{{ route('admin.appointments.available-times') }}?date=" + date + 
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
            if (data.timeSlots && Array.isArray(data.timeSlots)) {
                data.timeSlots.forEach(slot => {
                    const option = document.createElement('option');
                    option.value = slot.value;
                    option.textContent = slot.label;
                    
                    // Check if this is the original time for this appointment
                    const isOriginalTime = slot.value === originalTime && date === originalDate;
                    
                    // Include the time slot if it's available or it's the original time
                    if (slot.available || isOriginalTime) {
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
            }
            
            // Show warning if needed
            if (atLeastOneUnavailable) {
                timeWarning.classList.remove('tw-hidden');
            }

            // If no valid options were added (besides the placeholder)
            if (timeSelect.options.length <= 1) {
                const option = document.createElement('option');
                option.value = "";
                option.textContent = "No available times";
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
            const date = document.getElementById('edit-date').value;
            const time = document.getElementById('edit-time').value;
            const adminPassword = document.getElementById('admin-password-edit-appointment').value;
            
            if (!date || !time) {
                Swal.fire({
                    title: 'Missing Information',
                    text: 'Please fill in all required fields',
                    icon: 'warning',
                    confirmButtonColor: '#FF9666',
                    background: '#374151',
                    color: '#fff'
                });
                return;
            }

            if (!adminPassword) {
                Swal.fire({
                    title: 'Admin Password Required',
                    text: 'Please enter your admin password to confirm this action',
                    icon: 'warning',
                    confirmButtonColor: '#FF9666',
                    background: '#374151',
                    color: '#fff'
                });
                return;
            }
            
            // Show loading state
            const saveButton = document.getElementById('saveAppointmentBtn');
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
            fetch("{{ route('admin.appointments.update', ['id' => ':id']) }}".replace(':id', editingAppointmentID), {
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
                        throw new Error(data.message || `HTTP error! Status: ${response.status}`);
                    }).catch(parseError => {
                        throw new Error(`Server returned status ${response.status}`);
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
                        confirmButtonColor: '#FF9666',
                        background: '#374151',
                        color: '#fff'
                    }).then(() => {
                        // Hide modal and refresh data
                        document.getElementById('editAppointment-modal').classList.add('tw-hidden');
                        
                        // Refresh the appointments table
                        if (window.AppointmentsPage && window.AppointmentsPage.appointmentsTable) {
                            window.AppointmentsPage.appointmentsTable.ajax.reload();
                        } else {
                            // If we can't refresh the table, reload the page
                            location.reload();
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
                    confirmButtonColor: '#FF9666',
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
    
    // Modal close handler
    const editModalToggle = document.querySelector('[data-modal-toggle="editAppointment-modal"]');
    if (editModalToggle) {
        editModalToggle.addEventListener('click', function() {
            document.getElementById('editAppointment-modal').classList.add('tw-hidden');
        });
    }

    // Function to update status buttons appearance based on the selected status
    function updateStatusButtons(selectedStatus) {
        // Update the hidden input
        document.getElementById('edit-status').value = selectedStatus;
        
        // Update button appearance
        const buttons = document.querySelectorAll('.status-button');
        buttons.forEach(button => {
            const status = button.getAttribute('data-status');
            
            // Reset all buttons
            button.classList.remove('tw-bg-yellow-700', 'tw-bg-blue-700', 'tw-bg-green-700', 'tw-bg-red-700');
            button.classList.add('tw-bg-gray-700');
            
            // Highlight selected button
            if (status === selectedStatus) {
                button.classList.remove('tw-bg-gray-700');
                
                // Apply appropriate color based on status
                switch (status) {
                    case 'Pending':
                        button.classList.add('tw-bg-yellow-700');
                        break;
                    case 'Confirmed':
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
    document.querySelectorAll('.status-button').forEach(button => {
        button.addEventListener('click', function() {
            const status = this.getAttribute('data-status');
            updateStatusButtons(status);
        });
    });
    
    // Set up image preview functionality
    function setupImagePreview(inputId, previewId) {
        const input = document.getElementById(inputId);
        const preview = document.getElementById(previewId);
        
        if (!input || !preview) return;
        
        input.addEventListener('change', function() {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.innerHTML = `
                        <img src="${e.target.result}" alt="Image Preview" class="tw-h-full tw-w-full tw-object-cover tw-rounded-lg">
                    `;
                };
                
                reader.readAsDataURL(input.files[0]);
            }
        });
    }
    
    // Setup image previews
    setupImagePreview('before_image', 'before-image-preview');
    setupImagePreview('after_image', 'after-image-preview');
    
    // Connect the global edit function
    window.AppointmentsPage = window.AppointmentsPage || {};
    window.AppointmentsPage.editAppointment = window.openEditAppointmentModal;
    });
});
</script>
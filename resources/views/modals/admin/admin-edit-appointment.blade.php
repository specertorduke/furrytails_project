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
                    
                    <!-- Client & Pet Selection Section -->
                    <div class="tw-mb-6">
                        <h4 class="tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-3">Client & Pet</h4>
                        
                        <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-4">
                            <!-- Client Selection -->
                            <div>
                                <label for="edit-userID" class="tw-block tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-1">Client</label>
                                <select id="edit-userID" name="userID" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-block tw-w-full tw-p-2.5 focus:tw-border-[#FF9666] focus:tw-ring-[#FF9666]" required>
                                    <option value="">Select a client</option>
                                    <!-- Will be populated via JavaScript -->
                                </select>
                            </div>
                            
                            <!-- Pet Selection -->
                            <div>
                                <label for="edit-petID" class="tw-block tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-1">Pet</label>
                                <select id="edit-petID" name="petID" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-block tw-w-full tw-p-2.5 focus:tw-border-[#FF9666] focus:tw-ring-[#FF9666]" required>
                                    <option value="">Select a pet</option>
                                    <!-- Will be populated via JavaScript -->
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Service & Time Selection Section -->
                    <div class="tw-mb-6">
                        <h4 class="tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-3">Service Details</h4>
                        
                        <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-4">
                            <!-- Service Selection -->
                            <div>
                                <label for="edit-serviceID" class="tw-block tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-1">Service</label>
                                <select id="edit-serviceID" name="serviceID" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-block tw-w-full tw-p-2.5 focus:tw-border-[#FF9666] focus:tw-ring-[#FF9666]" required>
                                    <option value="">Select a service</option>
                                    <!-- Will be populated via JavaScript -->
                                </select>
                            </div>
                            
                            <!-- Status Selection -->
                            <div class="tw-col-span-2 tw-mt-4">
                                <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-3">Appointment Status</label>
                                
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
                        </div>
                    </div>
                    
                    <!-- Date & Time Selection Section -->
                    <div class="tw-mb-6">
                        <h4 class="tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-3">Date & Time</h4>
                        
                        <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-4">
                            <!-- Date Selection -->
                            <div>
                                <label for="edit-date" class="tw-block tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-1">Date</label>
                                <input type="date" id="edit-date" name="date" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-block tw-w-full tw-p-2.5 focus:tw-border-[#FF9666] focus:tw-ring-[#FF9666]" required>
                            </div>
                            
                            <!-- Time Selection -->
                            <div>
                                <label for="edit-time" class="tw-block tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-1">Time</label>
                                <select id="edit-time" name="time" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-block tw-w-full tw-p-2.5 focus:tw-border-[#FF9666] focus:tw-ring-[#FF9666]" required>
                                    <option value="">Select a time</option>
                                    <!-- Will be populated via JavaScript -->
                                </select>
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
                        
                        <!-- Time slot availability warning -->
                        <div id="time-warning" class="tw-mt-2 tw-hidden">
                            <p class="tw-text-yellow-500 tw-text-sm tw-flex tw-items-center">
                                <i class="fas fa-exclamation-triangle tw-mr-2"></i>
                                <span id="time-warning-text">This time slot may conflict with existing appointments.</span>
                            </p>
                        </div>
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
            updateStatusButtons(data.appointment.status);
            
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
                        
            // Fetch users, pet's user will be selected
            fetchUsers(data.appointment.pet.userID);
            
            // Fetch services, appointment's service will be selected
            fetchServices(data.appointment.serviceID);
            
            // Fetch time slots after we have the date
            fetchTimeSlots(data.appointment.date, data.appointment.time);
            
            // Fetch pets for the selected user after user is set
            setTimeout(() => {
                fetchPets(data.appointment.pet.userID, data.appointment.petID);
            }, 500);
            
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
                confirmButtonColor: '#FF9666',
                background: '#374151',
                color: '#fff'
            });
            
            editAppointmentModal.classList.add('tw-hidden');
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
            const userSelect = document.getElementById('edit-userID');
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
    
    // Function to fetch services for dropdown
    function fetchServices(selectedServiceID) {
        fetch("{{ route('admin.services.list') }}", {
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
            const petSelect = document.getElementById('edit-petID');
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
            if (!data.success) {
                throw new Error(data.message || 'Failed to load time slots');
            }
            
            const timeSelect = document.getElementById('edit-time');
            timeSelect.innerHTML = '<option value="">Select a time</option>';
            
            // Handle different data formats that might be returned from the API
            if (Array.isArray(data.timeSlots)) {
                // Format where timeSlots is an array of objects with value and label properties
                data.timeSlots.forEach(slot => {
                    const option = document.createElement('option');
                    option.value = slot.value;
                    option.textContent = slot.label;
                    
                    // Mark booked slots
                    const isBooked = data.bookedSlots && data.bookedSlots.includes(slot.value);
                    if (isBooked) {
                        // Only add the time if it's the current appointment's time
                        if (slot.value === selectedTime) {
                            option.textContent += ' (Current)';
                            timeSelect.appendChild(option);
                        }
                    } else {
                        timeSelect.appendChild(option);
                    }
                    
                    // Set as selected if this is the current time
                    if (slot.value === selectedTime) {
                        option.selected = true;
                    }
                });
            } else {
                // Format where timeSlots is an object with key-value pairs
                Object.entries(data.timeSlots).forEach(([value, label]) => {
                    const option = document.createElement('option');
                    option.value = value;
                    
                    // Handle if label is an object or string
                    if (typeof label === 'object' && label !== null) {
                        option.textContent = label.label || value;
                    } else {
                        option.textContent = label;
                    }
                    
                    // Mark booked slots
                    const isBooked = data.bookedSlots && data.bookedSlots.includes(value);
                    if (isBooked) {
                        // Only add the time if it's the current appointment's time
                        if (value === selectedTime) {
                            option.textContent += ' (Current)';
                            timeSelect.appendChild(option);
                        }
                    } else {
                        timeSelect.appendChild(option);
                    }
                    
                    // Set as selected if this is the current time
                    if (value === selectedTime) {
                        option.selected = true;
                    }
                });
            }
        })
        .catch(error => {
            console.error('Error fetching time slots:', error);
        });
    }
    
    // Set up event listeners for user selection change
    const userSelect = document.getElementById('edit-userID');
    if (userSelect) {
        userSelect.addEventListener('change', function() {
            const userID = this.value;
            if (userID) {
                fetchPets(userID);
            } else {
                // Clear pet dropdown if no user selected
                const petSelect = document.getElementById('edit-petID');
                petSelect.innerHTML = '<option value="">Select a pet</option>';
            }
        });
    }
    
    function handleDateChange() {
        const selectedDate = document.getElementById('edit-date').value;
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
        
        // Fetch time slots for the selected date, excluding current appointment
        fetch(`{{ route('admin.appointments.available-times') }}?date=${selectedDate}${editingAppointmentID ? '&exclude=' + editingAppointmentID : ''}`, {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            let timeOptions = '<option value="">Select a time</option>';
            
            // Check if we have time slots
            if (data.timeSlots && data.timeSlots.length > 0) {
                data.timeSlots.forEach(slot => {
                    // Check if this is the original time for this appointment
                    const isOriginalTime = slot.value === originalTime && selectedDate === originalDate;
                    
                    if (slot.available || isOriginalTime) {
                        timeOptions += `<option value="${slot.value}" ${isOriginalTime ? 'selected' : ''}>${slot.label}${isOriginalTime ? ' (Current)' : ''}</option>`;
                    } else {
                        timeOptions += `<option value="${slot.value}" disabled>${slot.label} (Booked)</option>`;
                    }
                });
            } else if (data.timeSlots && typeof data.timeSlots === 'object') {
                // Handle case where timeSlots is an object instead of array
                Object.entries(data.timeSlots).forEach(([value, label]) => {
                    // Format the label if it's an object
                    const displayLabel = typeof label === 'object' ? (label.label || value) : label;
                    
                    // Check if this is the original time for this appointment
                    const isOriginalTime = value === originalTime && selectedDate === originalDate;
                    
                    // Check if slot is booked (and not the current time)
                    const isBooked = data.bookedSlots && data.bookedSlots.includes(value) && !isOriginalTime;
                    
                    if (!isBooked) {
                        timeOptions += `<option value="${value}" ${isOriginalTime ? 'selected' : ''}>${displayLabel}${isOriginalTime ? ' (Current)' : ''}</option>`;
                    } else {
                        timeOptions += `<option value="${value}" disabled>${displayLabel} (Booked)</option>`;
                    }
                });
            } else {
                timeOptions = '<option value="" disabled>No time slots available</option>';
            }
            
            timeSelect.innerHTML = timeOptions;
        })
        .catch(err => {
            console.error('Error loading available times:', err);
            timeSelect.innerHTML = '<option value="">Error loading times</option>';
        });
    }

    // Set up event listeners for date selection change
    const dateInput = document.getElementById('edit-date');
    if (dateInput) {
        dateInput.addEventListener('change', function() {
            handleDateChange();
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
    
    // Connect the global edit function to this modal's open function
    window.AppointmentsPage = window.AppointmentsPage || {};
    window.AppointmentsPage.editAppointment = window.openEditAppointmentModal;
    
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
    
    // Handle service selection change to show/hide grooming fields
    const serviceSelect = document.getElementById('edit-serviceID');
    if (serviceSelect) {
        serviceSelect.addEventListener('change', function() {
            toggleGroomingSection();
        });
    }
    });
});
</script>
<!-- Main modal -->
<div id="admin-addPet-modal" tabindex="-1" aria-hidden="true" class="tw-hidden tw-fixed tw-top-0 tw-left-0 tw-right-0 tw-z-50 tw-w-full tw-p-4 tw-overflow-x-hidden tw-overflow-y-auto md:tw-inset-0 tw-h-full tw-max-h-full tw-flex tw-items-center tw-justify-center tw-backdrop-blur-sm tw-bg-black/60">
    <div class="tw-relative tw-w-full tw-max-w-md tw-max-h-full tw-animate-modal-entry">
        <!-- Modal content -->
        <div class="tw-relative tw-bg-gray-800 tw-rounded-lg tw-shadow-sm tw-transform tw-transition-all">
            <!-- Modal header -->
            <div class="tw-flex tw-items-center tw-justify-between tw-p-4 md:tw-p-5 tw-border-b tw-rounded-t tw-border-gray-700">
                <h3 class="tw-text-lg tw-font-semibold tw-text-white">Add Pet</h3>
                <button type="button" class="tw-text-gray-400 tw-bg-transparent tw-hover:tw-bg-gray-700 tw-hover:tw-text-white tw-rounded-lg tw-text-sm tw-w-8 tw-h-8 ms-auto tw-inline-flex tw-justify-center tw-items-center" data-modal-toggle="admin-addPet-modal">
                    <svg class="tw-w-3 tw-h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            
            <!-- Modal body -->
            <form id="adminPetForm" class="tw-p-4 md:tw-p-5">
                <!-- User selection field -->
                <div class="tw-mb-4">
                    <label for="pet-owner" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white">Owner</label>
                    <select id="pet-owner" name="pet-owner" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required>
                        <option value="">Select an owner</option>
                        <!-- User options will be populated via AJAX -->
                    </select>
                </div>

                <!-- Pet name field -->
                <div class="tw-mb-4">
                    <label for="pet-name" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white">Name</label>
                    <input type="text" id="pet-name" name="pet-name" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required placeholder="Pet name">
                </div>

                <!-- Pet species and breed -->
                <div class="tw-grid tw-grid-cols-2 tw-gap-4 tw-mb-4">
                    <div>
                        <label for="pet-species" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white">Species</label>
                        <select id="pet-species" name="pet-species" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required>
                            <option value="">Select species</option>
                            <option value="Dog">Dog</option>
                            <option value="Cat">Cat</option>
                            <option value="Rabbit">Rabbit</option>
                            <option value="Hamster">Hamster</option>
                            <option value="Guinea Pig">Guinea Pig</option>
                        </select>
                    </div>
                    <div>
                        <label for="pet-breed" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white">Breed</label>
                        <input type="text" id="pet-breed" name="pet-breed" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required placeholder="Breed">
                    </div>
                </div>
                
                <!-- Gender and birth date -->
                <div class="tw-grid tw-grid-cols-2 tw-gap-4 tw-mb-4">
                    <div>
                        <label for="pet-gender" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white">Gender</label>
                        <select id="pet-gender" name="pet-gender" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required>
                            <option value="">Select gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div>
                        <label for="pet-birthdate" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white">Birth Date</label>
                        <input type="date" id="pet-birthdate" name="pet-birthdate" max="{{ date('Y-m-d') }}" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5">
                    </div>
                </div>
                
                <!-- Weight and vaccination status -->
                <div class="tw-grid tw-grid-cols-2 tw-gap-4 tw-mb-4">
                    <div>
                        <label for="pet-weight" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white">Weight (kg)</label>
                        <input type="number" id="pet-weight" name="pet-weight" step="0.5" min="0" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5">
                    </div>
                    <div>
                        <label class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white">Vaccination Status</label>
                        <div class="tw-flex tw-items-center tw-gap-2">
                            <label class="tw-inline-flex tw-items-center">
                                <input type="checkbox" id="pet-vaccinated" name="pet-vaccinated" class="tw-form-checkbox tw-h-4 tw-w-4 tw-text-[#24CFF4] tw-bg-gray-700 tw-border-gray-600">
                                <span class="tw-ml-2 tw-text-white">Vaccinated</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Vaccination date - initially hidden -->
                <div id="vaccination-date-container" class="tw-hidden tw-mb-4">
                    <label for="pet-vaccination-date" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white">Last Vaccination Date</label>
                    <input type="date" id="pet-vaccination-date" name="pet-vaccination-date" max="{{ date('Y-m-d') }}" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5">
                </div>
                
                <!-- Allergies -->
                <div class="tw-mb-4">
                    <label for="pet-allergies" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white">Allergies</label>
                    <input type="text" id="pet-allergies" name="pet-allergies" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" placeholder="List any known allergies (optional)">
                </div>
                
                <!-- Medical history -->
                <div class="tw-mb-4">
                    <label for="pet-medical-history" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white">Medical History</label>
                    <textarea id="pet-medical-history" name="pet-medical-history" rows="2" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" placeholder="Any relevant medical history (optional)"></textarea>
                </div>
                
                <!-- Notes -->
                <div class="tw-mb-4">
                    <label for="pet-notes" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white">Additional Notes</label>
                    <textarea id="pet-notes" name="pet-notes" rows="2" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" placeholder="Any additional information (optional)"></textarea>
                </div>

                <!-- Pet image upload -->
                <div class="tw-mb-4">
                    <label class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white" for="pet-image">Pet Image</label>
                    <div class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-w-full">
                        <!-- Upload Area -->
                        <label for="pet-image" id="pet-upload-area" class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-w-full tw-h-64 tw-border-2 tw-border-gray-600 tw-border-dashed tw-rounded-lg tw-cursor-pointer tw-bg-gray-700 hover:tw-bg-gray-600">
                            <div class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-pt-5 tw-pb-6">
                                <svg class="tw-w-8 tw-h-8 tw-mb-4 tw-text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                </svg>
                                <p class="tw-mb-2 tw-text-sm tw-text-gray-400"><span class="tw-font-semibold">Click to upload</span> or drag and drop</p>
                                <p class="tw-text-xs tw-text-gray-500">PNG, JPG or JPEG (MAX. 2MB)</p>
                            </div>
                            <input id="pet-image" type="file" class="tw-hidden" accept="image/png, image/jpeg, image/jpg" />
                        </label>

                        <!-- Cropper Area (Hidden by default) -->
                        <div id="pet-cropper-area" class="tw-hidden tw-w-full">
                            <div class="tw-relative tw-w-full tw-aspect-square tw-max-w-md tw-mx-auto tw-overflow-hidden">
                                <img id="pet-cropper-image" class="tw-max-w-full">
                            </div>
                            <div class="tw-flex tw-justify-end tw-mt-4 tw-space-x-2">
                                <button type="button" id="pet-cancel-crop" class="tw-px-4 tw-py-2 tw-text-sm tw-text-gray-300 hover:tw-text-gray-100">Cancel</button>
                                <button type="button" id="pet-apply-crop" class="tw-px-4 tw-py-2 tw-text-sm tw-text-black tw-bg-[#66FF8F] tw-rounded hover:tw-bg-[#83ffab]">Apply Crop</button>
                            </div>
                        </div>

                        <!-- Preview Area (Hidden by default) -->
                        <div id="pet-preview-area" class="tw-hidden tw-flex tw-flex-col tw-items-center tw-justify-center tw-mt-4">
                            <img id="pet-preview-image" class="tw-w-32 tw-h-32 tw-rounded-full tw-object-cover tw-border-4 tw-border-[#66FF8F]">
                            <button type="button" id="pet-change-image" class="tw-text-sm tw-mt-3 tw-text-[#66FF8F] hover:tw-text-[#83ffab]">Change Image</button>
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="tw-text-black tw-inline-flex tw-items-center tw-bg-[#66FF8F] hover:tw-bg-[#83ffab] focus:tw-outline-none focus:tw-bg-[#4cd471] tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center">
                    <svg class="tw-me-1 tw--ms-1 tw-w-5 tw-h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    Add Pet
                </button>
            </form>
    </div>
</div>

<script>
['DOMContentLoaded', 'contentChanged'].forEach(eventName => {
    document.addEventListener(eventName, function() {
    // Initialize the cropper variables
    let cropper = null;
    const uploadArea = document.getElementById('pet-upload-area');
    const cropperArea = document.getElementById('pet-cropper-area');
    const previewArea = document.getElementById('pet-preview-area');
    const fileInput = document.getElementById('pet-image');
    const cropperImage = document.getElementById('pet-cropper-image');
    const previewImage = document.getElementById('pet-preview-image');
    let croppedImageData = null;

    // Reset function
    function resetImageUpload() {
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
        if (fileInput) fileInput.value = '';
        uploadArea.classList.remove('tw-hidden');
        cropperArea.classList.add('tw-hidden');
        previewArea.classList.add('tw-hidden');
        croppedImageData = null;
    }

    // Add change image functionality
    const changeImageBtn = document.getElementById('pet-change-image');
    if (changeImageBtn) {
        changeImageBtn.addEventListener('click', function() {
            resetImageUpload();
            fileInput.click();
        });
    }

    // Handle file input change
    if (fileInput) {
        fileInput.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    uploadArea.classList.add('tw-hidden');
                    cropperArea.classList.remove('tw-hidden');
                    cropperImage.src = e.target.result;
                    
                    if (cropper) {
                        cropper.destroy();
                    }

                    cropper = new Cropper(cropperImage, {
                        aspectRatio: 1,
                        viewMode: 1,
                        dragMode: 'move',
                        guides: false,
                        center: true,
                        cropBoxMovable: false,
                        cropBoxResizable: false,
                        minContainerWidth: 300,
                        minContainerHeight: 300
                    });
                };
                
                reader.readAsDataURL(this.files[0]);
            }
        });
    }

    // Cancel crop
    const cancelCropBtn = document.getElementById('pet-cancel-crop');
    if (cancelCropBtn) {
        cancelCropBtn.addEventListener('click', resetImageUpload);
    }

    // Apply crop
    const applyCropBtn = document.getElementById('pet-apply-crop');
    if (applyCropBtn) {
        applyCropBtn.addEventListener('click', function() {
            if (cropper) {
                croppedImageData = cropper.getCroppedCanvas({
                    width: 300,
                    height: 300
                }).toDataURL('image/jpeg', 0.9);
                
                previewImage.src = croppedImageData;
                cropperArea.classList.add('tw-hidden');
                previewArea.classList.remove('tw-hidden');
            }
        });
    }

    // Pet Modal specific functionality
    const AdminPetModal = {
        // Store elements references
        elements: {
            ownerSelect: document.getElementById('pet-owner'),
            petNameInput: document.getElementById('pet-name'),
            speciesSelect: document.getElementById('pet-species'),
            breedInput: document.getElementById('pet-breed'),
            genderSelect: document.getElementById('pet-gender'),
            birthDateInput: document.getElementById('pet-birthdate'),
            weightInput: document.getElementById('pet-weight'),
            vaccinatedCheckbox: document.getElementById('pet-vaccinated'),
            vaccinationDateInput: document.getElementById('pet-vaccination-date'),
            allergiesInput: document.getElementById('pet-allergies'),
            medicalHistoryInput: document.getElementById('pet-medical-history'),
            notesInput: document.getElementById('pet-notes'),
            form: document.getElementById('adminPetForm')
        },
        
        // Submission state tracking
        isSubmitting: false,
        
        // Initialize the modal functionality
        init: function() {
            // Setup form submission
            if (this.elements.form) {
                this.elements.form.addEventListener('submit', this.handleFormSubmit.bind(this));
            }
            
            // Setup modal toggle button
            const modalToggleBtn = document.querySelector('[data-modal-target="admin-addPet-modal"]');
            if (modalToggleBtn) {
                modalToggleBtn.addEventListener('click', () => {
                    this.loadUsers();
                });
            }

            // Setup modal close button
            const modalCloseBtn = document.querySelector('[data-modal-toggle="admin-addPet-modal"]');
            if (modalCloseBtn) {
                modalCloseBtn.addEventListener('click', () => {
                    document.getElementById('admin-addPet-modal').classList.add('tw-hidden');
                    resetImageUpload();
                    this.elements.form.reset();
                });
            }

            // Setup vaccination checkbox
            const vaccinatedCheckbox = document.getElementById('pet-vaccinated');
            if (vaccinatedCheckbox) {
                vaccinatedCheckbox.addEventListener('change', function() {
                    const vaccinationDateContainer = document.getElementById('vaccination-date-container');
                    const vaccinationDateInput = document.getElementById('pet-vaccination-date');
                    
                    if (this.checked) {
                        vaccinationDateContainer.classList.remove('tw-hidden');
                        vaccinationDateInput.required = true;
                    } else {
                        vaccinationDateContainer.classList.add('tw-hidden');
                        vaccinationDateInput.required = false;
                        vaccinationDateInput.value = '';
                    }
                });
            }
        },
        
        loadUsers: function() {
            // Set loading state
            this.elements.ownerSelect.innerHTML = '<option value="">Loading users...</option>';
            
            // Fetch users from the database
            fetch(`{{ route('admin.users.list') }}`, {
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
                this.elements.ownerSelect.innerHTML = '<option value="">Select an owner</option>';
                data.forEach(user => {
                    this.elements.ownerSelect.innerHTML += `<option value="${user.userID}">${user.firstName} ${user.lastName} (ID: ${user.userID})</option>`;
                });
            })
            .catch(err => {
                console.error('Error loading users:', err);
                this.elements.ownerSelect.innerHTML = '<option value="">Error loading users</option>';
            });
        },
        
        handleFormSubmit: function(e) {
            e.preventDefault();
            
            // Validate form
            if (this.isSubmitting) {
                return;
            }
            
            if (!this.elements.ownerSelect.value) {
                this.showError('Please select a pet owner');
                return;
            }
            
            if (!this.elements.petNameInput.value.trim()) {
                this.showError('Please enter a pet name');
                return;
            }
            
            if (!this.elements.speciesSelect.value) {
                this.showError('Please select a species');
                return;
            }
            
            if (!this.elements.breedInput.value.trim()) {
                this.showError('Please enter a breed');
                return;
            }

            if (!this.elements.genderSelect.value) {
                this.showError('Please select a gender');
                return;
            }

            // Image validation
            if (!croppedImageData) {
                this.showError('Please upload and crop a pet image');
                return;
            }

            // Show confirmation dialog
            Swal.fire({
                title: 'Add Pet',
                text: 'Are you sure you want to add this pet?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#66FF8F',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, add pet',
                cancelButtonText: 'Cancel',
                background: '#374151',
                color: '#fff'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submitPetData();
                }
            });
        },
        
        submitPetData: function() {
            // Set submitting flag
            this.isSubmitting = true;
            
            // Disable submit button and show loading state
            const submitButton = document.querySelector('#adminPetForm button[type="submit"]');
            const originalButtonText = submitButton.innerHTML;
            submitButton.disabled = true;
            submitButton.innerHTML = `<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg> Processing...`;
            
            // Prepare form data
            const formData = new FormData();
            formData.append('userID', this.elements.ownerSelect.value);
            formData.append('name', this.elements.petNameInput.value);
            formData.append('species', this.elements.speciesSelect.value);
            formData.append('breed', this.elements.breedInput.value);
            formData.append('gender', this.elements.genderSelect.value);
            formData.append('birthDate', this.elements.birthDateInput.value || '');
            formData.append('weight', this.elements.weightInput.value || '');
            formData.append('isVaccinated', this.elements.vaccinatedCheckbox.checked ? '1' : '0');
            
            if (this.elements.vaccinatedCheckbox.checked) {
                formData.append('vaccinationDate', this.elements.vaccinationDateInput.value);
            }
            
            formData.append('allergies', this.elements.allergiesInput.value || '');
            formData.append('medicalHistory', this.elements.medicalHistoryInput.value || '');
            formData.append('notes', this.elements.notesInput.value || '');
            
            // Convert cropped image data to blob and add to form data
            fetch(croppedImageData)
                .then(res => res.blob())
                .then(blob => {
                    formData.append('petImage', blob, 'pet-image.png');
                    
                    // Get the CSRF token from the meta tag
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    
                    // Submit the data to the server
                    return fetch('{{ route("admin.pets.store") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: formData
                    });
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(data => {
                            throw new Error(data.message || 'Error adding pet');
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    // Reset submitting flag
                    this.isSubmitting = false;
                    
                    // Reset button
                    submitButton.disabled = false;
                    submitButton.innerHTML = originalButtonText;
                    
                    // Show success message
                    Swal.fire({
                        title: 'Success!',
                        text: 'Pet has been added to the database',
                        icon: 'success',
                        confirmButtonColor: '#66FF8F',
                        background: '#374151',
                        color: '#fff'
                    }).then(() => {
                        // Reset form and close modal
                        this.elements.form.reset();
                        resetImageUpload();
                        const modal = document.getElementById('admin-addPet-modal');
                        modal.classList.add('tw-hidden');
                        
                        // Reload the page to reflect changes
                        window.location.href = "{{ route('admin.pets') }}";
                    });
                })
                .catch(err => {
                    // Reset submitting flag
                    this.isSubmitting = false;
                    
                    // Reset button
                    submitButton.disabled = false;
                    submitButton.innerHTML = originalButtonText;
                    
                    // Show error
                    console.error('Error saving pet:', err);
                    this.showError(err.message || 'Failed to create pet. Please try again.');
                });
        },
        
        showError: function(message) {
            Swal.fire({
                title: 'Error',
                text: message,
                icon: 'error',
                confirmButtonColor: '#66FF8F',
                background: '#374151',
                color: '#fff'
            });
        }
    };

    // Initialize Pet Modal
    AdminPetModal.init();
});
});
</script>
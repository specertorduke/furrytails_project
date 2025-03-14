<!-- Main modal -->
<div id="addPet-modal" tabindex="-1" aria-hidden="true" class="tw-hidden tw-fixed tw-top-0 tw-left-0 tw-right-0 tw-z-50 tw-w-full tw-p-4 tw-overflow-x-hidden tw-overflow-y-auto md:tw-inset-0 tw-h-full tw-max-h-full tw-flex tw-items-center tw-justify-center tw-backdrop-blur-sm tw-bg-gray-800/30">
    <div class="tw-relative tw-w-full tw-max-w-md tw-max-h-full tw-animate-modal-entry">
        <!-- Modal content -->
        <div class="tw-relative tw-bg-white tw-rounded-lg tw-shadow-sm tw-transform tw-transition-all">
            <!-- Modal header -->
            <div class="tw-flex tw-items-center tw-justify-between tw-p-4 md:tw-p-5 tw-border-b tw-rounded-t tw-border-gray-200">
                <h3 class="tw-text-lg tw-font-semibold tw-text-gray-900">Add Pet</h3>
                <button type="button" class="tw-text-gray-500 tw-bg-transparent tw-hover:tw-bg-gray-100 tw-hover:tw-text-gray-900 tw-rounded-lg tw-text-sm tw-w-8 tw-h-8 ms-auto tw-inline-flex tw-justify-center tw-items-center" data-modal-toggle="addPet-modal">
                    <svg class="tw-w-3 tw-h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            
            <!-- Modal body -->
            <form id="addPetForm" method="POST" action="{{ route('pets.add') }}" enctype="multipart/form-data" class="tw-p-4 md:tw-p-5">
                @csrf
                <!-- Pet name field -->
                <div class="tw-mb-4">
                    <label for="pet-name" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Name</label>
                    <input type="text" id="pet-name" name="name" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required placeholder="Pet name">
                </div>

                <!-- Pet species and breed -->
                <div class="tw-grid tw-grid-cols-2 tw-gap-4 tw-mb-4">
                    <div>
                        <label for="pet-species" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Species</label>
                        <select id="pet-species" name="species" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required>
                            <option value="">Select species</option>
                            <option value="Dog">Dog</option>
                            <option value="Cat">Cat</option>
                            <option value="Rabbit">Rabbit</option>
                            <option value="Hamster">Hamster</option>
                            <option value="Guinea Pig">Guinea Pig</option>
                        </select>
                    </div>
                    <div>
                        <label for="pet-breed" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Breed</label>
                        <input type="text" id="pet-breed" name="petType" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required placeholder="Breed/Type">
                    </div>
                </div>
                
                <!-- Gender and birth date -->
                <div class="tw-grid tw-grid-cols-2 tw-gap-4 tw-mb-4">
                    <div>
                        <label for="pet-gender" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Gender</label>
                        <select id="pet-gender" name="gender" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required>
                            <option value="">Select gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div>
                        <label for="pet-birthdate" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Birth Date</label>
                        <input type="date" id="pet-birthdate" name="birthDate" max="{{ date('Y-m-d') }}" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required>
                    </div>
                </div>
                
                <!-- Weight and vaccination status -->
                <div class="tw-grid tw-grid-cols-2 tw-gap-4 tw-mb-4">
                    <div>
                        <label for="pet-weight" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Weight (kg)</label>
                        <input type="number" id="pet-weight" name="weight" step="0.1" min="0" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" placeholder="0.0">
                    </div>
                    <div>
                        <label class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Vaccination Status</label>
                        <div class="tw-flex tw-items-center tw-gap-2">
                            <label class="tw-inline-flex tw-items-center">
                                <input type="checkbox" id="pet-vaccinated" name="isVaccinated" class="tw-form-checkbox tw-h-4 tw-w-4 tw-text-[#24CFF4] tw-bg-gray-50 tw-border-gray-300">
                                <span class="tw-ml-2 tw-text-gray-700">Vaccinated</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Vaccination date - initially hidden -->
                <div id="vaccination-date-container" class="tw-hidden tw-mb-4">
                    <label for="pet-vaccination-date" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Last Vaccination Date</label>
                    <input type="date" id="pet-vaccination-date" name="lastVaccinationDate" max="{{ date('Y-m-d') }}" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5">
                </div>
                
                <!-- Allergies -->
                <div class="tw-mb-4">
                    <label for="pet-allergies" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Allergies</label>
                    <input type="text" id="pet-allergies" name="allergies" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" placeholder="List any known allergies (optional)">
                </div>
                
                <!-- Medical history -->
                <div class="tw-mb-4">
                    <label for="pet-medical-history" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Medical History</label>
                    <textarea id="pet-medical-history" name="medicalHistory" rows="2" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" placeholder="Any relevant medical history (optional)"></textarea>
                </div>
                
                <!-- Notes -->
                <div class="tw-mb-4">
                    <label for="pet-notes" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Additional Notes</label>
                    <textarea id="pet-notes" name="petNotes" rows="2" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" placeholder="Any additional information (optional)"></textarea>
                </div>

                <!-- Pet image upload -->
                <div class="tw-mb-4">
                    <label class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900" for="pet-image">Pet Image</label>
                    <div class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-w-full">
                        <!-- Upload Area -->
                        <label for="pet-image" id="upload-area" class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-w-full tw-h-64 tw-border-2 tw-border-gray-300 tw-border-dashed tw-rounded-lg tw-cursor-pointer tw-bg-gray-50 hover:tw-bg-gray-100">
                            <div class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-pt-5 tw-pb-6">
                                <svg class="tw-w-8 tw-h-8 tw-mb-4 tw-text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                </svg>
                                <p class="tw-mb-2 tw-text-sm tw-text-gray-500"><span class="tw-font-semibold">Click to upload</span> or drag and drop</p>
                                <p class="tw-text-xs tw-text-gray-500">PNG, JPG or JPEG (MAX. 2MB)</p>
                            </div>
                            <input id="pet-image" type="file" class="tw-hidden" accept="image/png, image/jpeg, image/jpg" />
                        </label>

                        <!-- Cropper Area (Hidden by default) -->
                        <div id="cropper-area" class="tw-hidden tw-w-full">
                            <div class="tw-relative tw-w-full tw-aspect-square tw-max-w-md tw-mx-auto tw-overflow-hidden">
                                <img id="cropper-image" class="tw-max-w-full">
                            </div>
                            <div class="tw-flex tw-justify-end tw-mt-4 tw-space-x-2">
                                <button type="button" id="cancel-crop" class="tw-px-4 tw-py-2 tw-text-sm tw-text-gray-600 hover:tw-text-gray-900">Cancel</button>
                                <button type="button" id="apply-crop" class="tw-px-4 tw-py-2 tw-text-sm tw-text-white tw-bg-[#24CFF4] tw-rounded hover:tw-bg-[#63e4fd]">Apply Crop</button>
                            </div>
                        </div>

                        <!-- Preview Area (Hidden by default) -->
                        <div id="preview-area" class="tw-hidden tw-flex tw-flex-col tw-items-center tw-justify-center tw-mt-4">
                            <img id="preview-image" class="tw-w-32 tw-h-32 tw-rounded-full tw-object-cover tw-border-4 tw-border-[#24CFF4]">
                            <button type="button" id="change-image" class="tw-text-sm tw-mt-3 tw-text-[#24CFF4] hover:tw-text-[#63e4fd]">Change Image</button>
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="tw-text-black tw-inline-flex tw-items-center tw-bg-[#24CFF4] hover:tw-bg-[#63e4fd] focus:tw-outline-none focus:tw-bg-[#038cb7] tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center">
                    <svg class="tw-me-1 tw--ms-1 tw-w-5 tw-h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    Add Pet
                </button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet"/>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const PetModal = {
        elements: {
            modal: document.getElementById('addPet-modal'),
            form: document.getElementById('addPetForm'),
            uploadArea: document.getElementById('upload-area'),
            cropperArea: document.getElementById('cropper-area'),
            previewArea: document.getElementById('preview-area'),
            fileInput: document.getElementById('pet-image'),
            cropperImage: document.getElementById('cropper-image'),
            previewImage: document.getElementById('preview-image'),
            vaccinatedCheckbox: document.getElementById('pet-vaccinated'),
            vaccinationDateContainer: document.getElementById('vaccination-date-container'),
            vaccinationDateInput: document.getElementById('pet-vaccination-date'),
            cancelCropBtn: document.getElementById('cancel-crop'),
            applyCropBtn: document.getElementById('apply-crop'),
            changeImageBtn: document.getElementById('change-image')
        },
        
        cropper: null,
        croppedImageData: null,
        
        init: function() {
            // Setup event listeners
            this.setupEventListeners();
            
            // Setup modal toggle button
            const modalToggleBtn = document.querySelector('[data-modal-target="addPet-modal"]');
            if (modalToggleBtn) {
                modalToggleBtn.addEventListener('click', this.openModal.bind(this));
            }

            // Setup modal close button
            const modalCloseBtn = document.querySelector('[data-modal-toggle="addPet-modal"]');
            if (modalCloseBtn) {
                modalCloseBtn.addEventListener('click', this.closeModal.bind(this));
            }
        },
        
        setupEventListeners: function() {
            // Vaccination checkbox handler
            if (this.elements.vaccinatedCheckbox) {
                this.elements.vaccinatedCheckbox.addEventListener('change', this.handleVaccinationChange.bind(this));
            }
            
            // File input handler
            if (this.elements.fileInput) {
                this.elements.fileInput.addEventListener('change', this.handleFileChange.bind(this));
            }
            
            // Cropper buttons
            if (this.elements.cancelCropBtn) {
                this.elements.cancelCropBtn.addEventListener('click', this.resetImageUpload.bind(this));
            }
            
            if (this.elements.applyCropBtn) {
                this.elements.applyCropBtn.addEventListener('click', this.applyCrop.bind(this));
            }
            
            // Change image button
            if (this.elements.changeImageBtn) {
                this.elements.changeImageBtn.addEventListener('click', this.triggerFileInput.bind(this));
            }
            
            // Form submission
            if (this.elements.form) {
                this.elements.form.addEventListener('submit', this.handleFormSubmit.bind(this));
            }
        },
        
        handleVaccinationChange: function() {
            const isVaccinated = this.elements.vaccinatedCheckbox.checked;
            this.elements.vaccinationDateContainer.classList.toggle('tw-hidden', !isVaccinated);
            this.elements.vaccinationDateInput.disabled = !isVaccinated;
            this.elements.vaccinationDateInput.required = isVaccinated;
            
            if (!isVaccinated) {
                this.elements.vaccinationDateInput.value = '';
            }
        },
        
        handleFileChange: function(e) {
            if (this.elements.fileInput.files && this.elements.fileInput.files[0]) {
                const reader = new FileReader();
                
                reader.onload = (e) => {
                    this.elements.uploadArea.classList.add('tw-hidden');
                    this.elements.cropperArea.classList.remove('tw-hidden');
                    this.elements.cropperImage.src = e.target.result;
                    
                    // Destroy previous cropper if exists
                    if (this.cropper) {
                        this.cropper.destroy();
                    }

                    // Initialize cropper with a slight delay to ensure image is loaded
                    setTimeout(() => {
                        this.cropper = new Cropper(this.elements.cropperImage, {
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
                    }, 100);
                };
                
                reader.readAsDataURL(this.elements.fileInput.files[0]);
            }
        },
        
        resetImageUpload: function() {
            if (this.cropper) {
                this.cropper.destroy();
                this.cropper = null;
            }
            
            this.elements.fileInput.value = '';
            this.elements.uploadArea.classList.remove('tw-hidden');
            this.elements.cropperArea.classList.add('tw-hidden');
            this.elements.previewArea.classList.add('tw-hidden');
            this.croppedImageData = null;
        },
        
        triggerFileInput: function() {
            this.resetImageUpload();
            this.elements.fileInput.click();
        },
        
        applyCrop: function() {
            if (this.cropper) {
                try {
                    const croppedCanvas = this.cropper.getCroppedCanvas({
                        width: 300,
                        height: 300
                    });
                    
                    if (croppedCanvas) {
                        this.croppedImageData = croppedCanvas.toDataURL('image/jpeg', 0.9);
                        this.elements.previewImage.src = this.croppedImageData;
                        this.elements.cropperArea.classList.add('tw-hidden');
                        this.elements.previewArea.classList.remove('tw-hidden');
                        
                        // Add hidden input for the cropped image data
                        let hiddenInput = document.getElementById('cropped-image-data');
                        if (!hiddenInput) {
                            hiddenInput = document.createElement('input');
                            hiddenInput.type = 'hidden';
                            hiddenInput.id = 'cropped-image-data';
                            hiddenInput.name = 'cropped_image';
                            this.elements.form.appendChild(hiddenInput);
                        }
                        hiddenInput.value = this.croppedImageData;
                    }
                } catch (error) {
                    console.error('Error during crop:', error);
                }
            }
        },
        
        openModal: function() {
            this.elements.modal.classList.remove('tw-hidden');
        },
        
        closeModal: function() {
            this.elements.modal.classList.add('tw-hidden');
            this.resetForm();
        },
        
        resetForm: function() {
            this.elements.form.reset();
            this.resetImageUpload();
            this.elements.vaccinationDateContainer.classList.add('tw-hidden');
            this.elements.vaccinationDateInput.disabled = true;
            this.elements.vaccinationDateInput.required = false;
        },
        
        handleFormSubmit: function(e) {
            e.preventDefault();
            
            // Validate image
            if (!this.croppedImageData) {
                Swal.fire({
                    title: 'Image Required',
                    text: 'Please select and crop an image for your pet',
                    icon: 'warning',
                    confirmButtonColor: '#24CFF4',
                    background: '#ffffff',
                    color: '#111827'
                });
                return;
            }

            // Ensure isVaccinated is set to true or false
            const isVaccinatedInput = document.createElement('input');
            isVaccinatedInput.type = 'hidden';
            isVaccinatedInput.name = 'isVaccinated';
            isVaccinatedInput.value = this.elements.vaccinatedCheckbox.checked ? '1' : '0';
            this.elements.form.appendChild(isVaccinatedInput);

            // Show confirmation dialog
            Swal.fire({
                title: 'Add Pet',
                text: 'Are you sure you want to add this pet?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#24CFF4',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, add pet',
                cancelButtonText: 'Cancel',
                background: '#ffffff',
                color: '#111827'
            }).then((result) => {
                if (result.isConfirmed) {
            // Submit form with AJAX instead of normal submission
            const form = this.elements.form;
            const formData = new FormData(form);
            
            // Show loading state
            Swal.fire({
                title: 'Adding your pet...',
                text: 'Please wait',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });
            
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Show success message
                Swal.fire({
                    title: 'Success!',
                    text: `${formData.get('name')} has been added to your pets`,
                    icon: 'success',
                    confirmButtonColor: '#24CFF4',
                    confirmButtonText: 'Add another pet',
                    showCancelButton: true,
                    cancelButtonText: 'Done',
                    background: '#ffffff',
                    color: '#111827'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Reset form for adding another pet
                        this.resetForm();
                        this.openModal();
                    } else {
                        // Close modal
                        this.closeModal();
                    }
                });
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error',
                    text: 'There was a problem adding your pet. Please try again.',
                    icon: 'error',
                    confirmButtonColor: '#24CFF4',
                    background: '#ffffff',
                    color: '#111827'
                });
            });
        }
            });
        }
    };

    // Initialize the Pet Modal
    PetModal.init();
});

// Re-initialize when content is dynamically changed
document.addEventListener('contentChanged', function() {
    const PetModal = {
        // Same implementation as above
        // This ensures the modal works even after dynamic content changes
    };
    PetModal.init();
});
</script>
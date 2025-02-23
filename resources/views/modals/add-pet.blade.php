<!-- Main modal -->
<div id="addPet-modal" tabindex="-1" aria-hidden="true" class="tw-hidden tw-fixed tw-top-0 tw-left-0 tw-right-0 tw-z-50 tw-w-full tw-p-4 tw-overflow-x-hidden tw-overflow-y-auto md:tw-inset-0 tw-h-full tw-max-h-full tw-flex tw-items-center tw-justify-center tw-backdrop-blur-sm tw-bg-black/30">
    <div class="tw-relative tw-w-full tw-max-w-md tw-max-h-full tw-animate-modal-entry">
        <!-- Modal content -->
        <div class="tw-relative tw-bg-white tw-rounded-lg tw-shadow-sm dark:tw-bg-gray-700 tw-transform tw-transition-all">
            <!-- Modal header -->
            <div class="tw-flex tw-items-center tw-justify-between tw-p-4 md:tw-p-5 tw-border-b tw-rounded-t dark:tw-border-gray-600 tw-border-gray-200">
                <h3 class="tw-text-lg tw-font-semibold tw-text-gray-900 dark:tw-text-white">Add Pet</h3>
                <button type="button" class="tw-text-gray-400 tw-bg-transparent tw-hover:tw-bg-gray-200 tw-hover:tw-text-gray-900 tw-rounded-lg tw-text-sm tw-w-8 tw-h-8 ms-auto tw-inline-flex tw-justify-center tw-items-center dark:tw-hover:tw-bg-gray-600 dark:tw-hover:tw-text-white" data-modal-toggle="addPet-modal">
                    <svg class="tw-w-3 tw-h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="tw-p-4 md:tw-p-5" enctype="multipart/form-data">
                <!-- Name field -->
                <div class="tw-col-span-2 tw-mb-4">
                    <label for="pet-name" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Pet Name</label>
                    <input type="text" name="pet-name" id="pet-name" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-primary-600 tw-focus:tw-border-primary-600 tw-block tw-w-full tw-p-2.5" required>
                </div>

                <!-- Species and Type fields -->
                <div class="tw-col-span-1 tw-mb-4">
                    <label for="species" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Species</label>
                    <select id="species" name="species" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-primary-500 tw-focus:tw-border-primary-500 tw-block tw-w-full tw-p-2.5" required>
                        <option value="" selected>Select Species</option>
                        <option value="Dog">Dog</option>
                        <option value="Cat">Cat</option>
                        <option value="Rabbit">Rabbit</option>
                        <option value="Hamster">Hamster</option>
                        <option value="Guinea Pig">Guinea Pig</option>
                    </select>
                </div>

                <div class="tw-col-span-1 tw-mb-4">
                    <label for="breed" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Breed/Type</label>
                    <input type="text" name="breed" id="breed" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-primary-600 tw-focus:tw-border-primary-600 tw-block tw-w-full tw-p-2.5" required>
                </div>

                <!-- Gender and Birth Date fields -->
                <div class="tw-col-span-1 tw-mb-4">
                    <label for="gender" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Gender</label>
                    <select id="gender" name="gender" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-primary-500 tw-focus:tw-border-primary-500 tw-block tw-w-full tw-p-2.5" required>
                        <option value="" selected>Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <div class="tw-col-span-1 tw-mb-4">
                    <label for="birthDate" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Birth Date</label>
                    <input type="date" name="birthDate" id="birthDate" max="{{ date('Y-m-d') }}" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-primary-600 tw-focus:tw-border-primary-600 tw-block tw-w-full tw-p-2.5" required>
                </div>

                <!-- Weight and Vaccination Status -->
                <div class="tw-col-span-1 tw-mb-4">
                    <label for="weight" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Weight (kg)</label>
                    <input type="number" name="weight" id="weight" step="0.01" min="0" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-primary-600 tw-focus:tw-border-primary-600 tw-block tw-w-full tw-p-2.5">
                </div>

                <div class="tw-col-span-1 tw-mb-4">
                    <label class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Vaccination Status</label>
                    <div class="tw-flex tw-items-center tw-gap-4">
                        <label class="tw-inline-flex tw-items-center">
                            <input type="checkbox" name="isVaccinated" id="isVaccinated" class="tw-form-checkbox tw-h-4 tw-w-4 tw-text-primary-600">
                            <span class="tw-ml-2">Vaccinated</span>
                        </label>
                        <input type="date" 
                            name="lastVaccinationDate" 
                            id="lastVaccinationDate" 
                            max="{{ date('Y-m-d') }}" 
                            class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-primary-600 tw-focus:tw-border-primary-600 tw-flex-1 tw-p-2.5 tw-hidden" 
                            disabled>            
                    </div>
                </div>

                <!-- Medical Information -->
                <div class="tw-col-span-2 tw-mb-4">
                    <label for="allergies" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Allergies</label>
                    <input type="text" name="allergies" id="allergies" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-primary-600 tw-focus:tw-border-primary-600 tw-block tw-w-full tw-p-2.5" placeholder="List any known allergies">
                </div>

                <div class="tw-col-span-2 tw-mb-4">
                    <label for="medicalHistory" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Medical History</label>
                    <textarea id="medicalHistory" name="medicalHistory" rows="2" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-primary-600 tw-focus:tw-border-primary-600 tw-block tw-w-full tw-p-2.5" placeholder="Any relevant medical history..."></textarea>
                </div>

                <!-- Notes field -->
                <div class="tw-col-span-2 tw-mb-4">
                    <label for="notes" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Additional Notes</label>
                    <textarea id="notes" name="notes" rows="2" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-primary-600 tw-focus:tw-border-primary-600 tw-block tw-w-full tw-p-2.5" placeholder="Any special notes about your pet..."></textarea>
                </div>
                <div class="tw-col-span-2 tw-mb-4">
                    <label class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900 dark:tw-text-white">Pet Image</label>
                    <div class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-w-full">
                        <!-- Upload Area -->
                        <label for="pet-image" id="upload-area" class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-w-full tw-h-64 tw-border-2 tw-border-gray-300 tw-border-dashed tw-rounded-lg tw-cursor-pointer tw-bg-gray-50 hover:tw-bg-gray-100">
                            <div class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-pt-5 tw-pb-6">
                                <svg class="tw-w-8 tw-h-8 tw-mb-4 tw-text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                </svg>
                                <p class="tw-mb-2 tw-text-sm tw-text-gray-500"><span class="tw-font-semibold">Click to upload</span> or drag and drop</p>
                                <p class="tw-text-xs tw-text-gray-500">PNG, JPG or JPEG</p>
                            </div>
                            <input id="pet-image" type="file" class="tw-hidden" accept="image/png, image/jpeg, image/jpg" />
                        </label>

                        <!-- Cropper Area (Hidden by default) -->
                        <div id="cropper-area" class="tw-hidden tw-w-full">
                            <div class="tw-relative tw-w-full tw-aspect-square tw-max-w-md tw-mx-auto tw-overflow-hidden">
                                <img id="cropper-image" class="tw-max-w-full">
                            </div>
                            <div class="tw-flex tw-justify-end tw-mt-4 tw-space-x-2">
                                <button type="button" id="cancel-crop" class="tw-px-4 tw-py-2 tw-text-sm tw-text-gray-500 hover:tw-text-gray-700">Cancel</button>
                                <button type="button" id="apply-crop" class="tw-px-4 tw-py-2 tw-text-sm tw-text-white tw-bg-blue-500 tw-rounded hover:tw-bg-blue-600">Apply Crop</button>
                            </div>
                        </div>

                        <!-- Preview Area (Hidden by default) -->
                        <div id="preview-area" class="tw-hidden tw-flex tw-flex-col tw-justify-center tw-mt-4">
                            <img id="preview-image" class="tw-w-32 tw-h-32 tw-rounded-full tw-object-cover">
                            <button type="button" id="change-image" class="tw-text-sm tw-mt-3 tw-text-blue-500 hover:tw-text-blue-700">Change Image</button>
                        </div>
                    </div>
                </div>
                <button type="submit" class="tw-text-white tw-inline-flex tw-items-center tw-bg-[#24CFF4] hover:tw-bg-[#63e4fd] focus:tw-outline-none focus:tw-bg-[#038cb7] tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center">
                    <svg class="tw-me-1 tw--ms-1 tw-w-5 tw-h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    Add Pet
                </button>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const isVaccinatedCheckbox = document.getElementById('isVaccinated');
    const lastVaccinationDateInput = document.getElementById('lastVaccinationDate');

    if (isVaccinatedCheckbox) {
        isVaccinatedCheckbox.addEventListener('change', function() {
            lastVaccinationDateInput.classList.toggle('tw-hidden', !this.checked);
            lastVaccinationDateInput.disabled = !this.checked;
            if (this.checked) {
                lastVaccinationDateInput.required = true;
            } else {
                lastVaccinationDateInput.required = false;
                lastVaccinationDateInput.value = '';
            }
        });
    }

    let cropper = null;
    const uploadArea = document.getElementById('upload-area');
    const cropperArea = document.getElementById('cropper-area');
    const previewArea = document.getElementById('preview-area');
    const fileInput = document.getElementById('pet-image');
    const cropperImage = document.getElementById('cropper-image');
    const previewImage = document.getElementById('preview-image');
    let croppedImageData = null;

    // Reset function
    function resetImageUpload() {
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
        fileInput.value = '';
        uploadArea.classList.remove('tw-hidden');
        cropperArea.classList.add('tw-hidden');
        previewArea.classList.add('tw-hidden');
        croppedImageData = null;
    }

    // Add change image functionality
    const changeImageBtn = document.getElementById('change-image');
    if (changeImageBtn) {
        changeImageBtn.addEventListener('click', function() {
            resetImageUpload();
            fileInput.click();
        });
    }

    // Update cropper initialization with better options
    cropper = new Cropper(cropperImage, {
        aspectRatio: 1,
        viewMode: 1,
        dragMode: 'move',
        guides: false,
        center: true,
        cropBoxMovable: false,
        cropBoxResizable: false,
        minContainerWidth: 300,
        minContainerHeight: 300,
        autoCropArea: 1,
        responsive: true,
        background: false,
        modal: true,
        initialAspectRatio: 1,
        zoomOnWheel: true,
        cropBoxShape: 'circle'
    });

    // Handle modal close
    const modalToggle = document.querySelector('[data-modal-toggle="addPet-modal"]');
    if (modalToggle) {
        modalToggle.addEventListener('click', resetImageUpload);
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
    const cancelCropBtn = document.getElementById('cancel-crop');
    if (cancelCropBtn) {
        cancelCropBtn.addEventListener('click', resetImageUpload);
    }

    // Apply crop
    const applyCropBtn = document.getElementById('apply-crop');
    if (applyCropBtn) {
        applyCropBtn.addEventListener('click', function() {
            if (cropper) {
                croppedImageData = cropper.getCroppedCanvas({
                    width: 300,
                    height: 300
                }).toDataURL();
                
                previewImage.src = croppedImageData;
                cropperArea.classList.add('tw-hidden');
                previewArea.classList.remove('tw-hidden');
                
                let hiddenInput = document.getElementById('cropped-image-data');
                if (!hiddenInput) {
                    hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.id = 'cropped-image-data';
                    hiddenInput.name = 'cropped_image';
                    document.querySelector('#addPet-modal form').appendChild(hiddenInput);
                }
                hiddenInput.value = croppedImageData;
            }
        });
    }

    // Form submission
    const form = document.querySelector('#addPet-modal form');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!croppedImageData) {
                Swal.fire({
                    title: 'Image Required',
                    text: 'Please select and crop an image for your pet',
                    icon: 'warning',
                    confirmButtonColor: '#24CFF4',
                    confirmButtonText: 'OK'
                });
                return;
            }

            // Show confirmation dialog
            Swal.fire({
                title: 'Add Pet',
                text: 'Are you sure you want to add this pet?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#24CFF4',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, add pet',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show success message
                    Swal.fire({
                        title: 'Success!',
                        text: 'Pet has been added successfully',
                        icon: 'success',
                        confirmButtonColor: '#24CFF4'
                    }).then(() => {
                        // Reset form and close modal
                        form.reset();
                        resetImageUpload();
                        // Close the modal - adjust based on your modal library
                        const modal = document.getElementById('addPet-modal');
                        modal.classList.add('tw-hidden');
                    });
                }
            });
        });
    }
});
</script>
<!-- Edit Pet Modal -->
<div id="editPet-modal" tabindex="-1" aria-hidden="true" class="tw-hidden tw-fixed tw-top-0 tw-left-0 tw-right-0 tw-z-50 tw-w-full tw-p-4 tw-overflow-x-hidden tw-overflow-y-auto md:tw-inset-0 tw-h-full tw-max-h-full tw-flex tw-items-center tw-justify-center tw-backdrop-blur-sm tw-bg-black/30">
    <div class="tw-relative tw-w-full tw-max-w-md tw-max-h-full tw-animate-modal-entry">
        <div class="tw-relative tw-bg-white tw-rounded-lg tw-shadow-sm dark:tw-bg-gray-700 tw-transform tw-transition-all">
            <button type="button" class="tw-absolute tw-top-3 tw-right-3 tw-text-gray-400 hover:tw-text-gray-600" onclick="closeEditPetModal()">
                <i class="fas fa-times"></i>
            </button>
            <form method="POST" action="" enctype="multipart/form-data" class="tw-p-4 md:tw-p-5">
                @csrf
                @method('PUT')
                <div class="tw-col-span-2 tw-mb-4">
                    <label for="name" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Name</label>
                    <input type="text" id="name" name="name" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-primary-600 tw-focus:tw-border-primary-600 tw-block tw-w-full tw-p-2.5" required>
                </div>
                <div class="tw-col-span-2 tw-mb-4">
                    <label for="species" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Species</label>
                    <input type="text" id="species" name="species" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-primary-600 tw-focus:tw-border-primary-600 tw-block tw-w-full tw-p-2.5" required>
                </div>
                <div class="tw-col-span-2 tw-mb-4">
                    <label for="petType" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Type</label>
                    <input type="text" id="petType" name="petType" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-primary-600 tw-focus:tw-border-primary-600 tw-block tw-w-full tw-p-2.5" required>
                </div>
                <div class="tw-col-span-2 tw-mb-4">
                    <label for="gender" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Gender</label>
                    <input type="text" id="gender" name="gender" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-primary-600 tw-focus:tw-border-primary-600 tw-block tw-w-full tw-p-2.5" required>
                </div>
                <div class="tw-col-span-2 tw-mb-4">
                    <label for="birthDate" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Birth Date</label>
                    <input type="date" id="birthDate" name="birthDate" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-primary-600 tw-focus:tw-border-primary-600 tw-block tw-w-full tw-p-2.5" required>
                </div>
                <div class="tw-col-span-2 tw-mb-4">
                    <label for="weight" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Weight</label>
                    <input type="number" step="0.01" id="weight" name="weight" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-primary-600 tw-focus:tw-border-primary-600 tw-block tw-w-full tw-p-2.5">
                </div>
                <div class="tw-col-span-2 tw-mb-4">
                    <label class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Vaccination Status</label>
                    <div class="tw-flex tw-items-center tw-gap-4">
                        <label class="tw-inline-flex tw-items-center">
                            <input type="checkbox" name="isVaccinated" id="isVaccinated" class="tw-form-checkbox tw-h-4 tw-w-4 tw-text-primary-600">
                            <span class="tw-ml-2">Vaccinated</span>
                        </label>
                        <input type="date" name="lastVaccinationDate" id="lastVaccinationDate" max="{{ date('Y-m-d') }}" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-primary-600 tw-focus:tw-border-primary-600 tw-flex-1 tw-p-2.5 tw-hidden" disabled>
                    </div>
                </div>
                <div class="tw-col-span-2 tw-mb-4">
                    <label for="medicalHistory" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Medical History</label>
                    <textarea id="medicalHistory" name="medicalHistory" rows="2" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-primary-600 tw-focus:tw-border-primary-600 tw-block tw-w-full tw-p-2.5"></textarea>
                </div>
                <div class="tw-col-span-2 tw-mb-4">
                    <label for="petNotes" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Additional Notes</label>
                    <textarea id="petNotes" name="petNotes" rows="2" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-primary-600 tw-focus:tw-border-primary-600 tw-block tw-w-full tw-p-2.5"></textarea>
                </div>
                <div class="tw-col-span-2 tw-mb-4">
                    <label class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900 dark:tw-text-white">Pet Image</label>
                    <div class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-w-full">
                        <label for="pet-image" id="upload-area" class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-w-full tw-h-64 tw-border-2 tw-border-gray-300 tw-border-dashed tw-rounded-lg tw-cursor-pointer tw-bg-gray-50 hover:tw-bg-gray-100">
                            <span class="tw-text-gray-500">Click to upload or drag and drop</span>
                            <input type="file" id="pet-image" name="petImage" class="tw-hidden">
                        </label>

                        <!-- Cropper Area (Hidden by default) -->
                        <div id="cropper-area" class="tw-hidden tw-w-full">
                            <img id="cropper-image" class="tw-w-full tw-h-64 tw-object-cover">
                            <div class="tw-flex tw-justify-between tw-mt-2">
                                <button type="button" id="cancel-crop" class="tw-bg-red-500 tw-text-white tw-px-4 tw-py-2 tw-rounded-lg">Cancel</button>
                                <button type="button" id="apply-crop" class="tw-bg-green-500 tw-text-white tw-px-4 tw-py-2 tw-rounded-lg">Apply</button>
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
                    Update Pet
                </button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet"/>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const isVaccinatedCheckbox = document.getElementById('isVaccinated');
    const lastVaccinationDateInput = document.getElementById('lastVaccinationDate');
    const birthDateInput = document.getElementById('birthDate');

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

    // Reset func
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

    // button link para sa change image
    const changeImageBtn = document.getElementById('change-image');
    if (changeImageBtn) {
        changeImageBtn.addEventListener('click', function() {
            resetImageUpload();
            
        });
    }

    // cropper logic function
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
                    document.querySelector('#editPet-modal form').appendChild(hiddenInput);
                }
                hiddenInput.value = croppedImageData;
            }
        });
    }

    // submit sa form
    const form = document.querySelector('#editPet-modal form');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            
            Swal.fire({
                title: 'Update Pet',
                text: 'Are you sure you want to update this pet?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#24CFF4',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update pet',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                    resetImageUpload();
                    const modal = document.getElementById('editPet-modal');
                    modal.classList.add('tw-hidden');
                }
            });
        });
    }
});

function closeEditPetModal() {
    document.getElementById('editPet-modal').classList.add('tw-hidden');
}
</script>
<!-- Edit Pet Modal -->
<div id="editPet-modal" tabindex="-1" aria-hidden="true" class="tw-hidden tw-fixed tw-top-0 tw-left-0 tw-right-0 tw-z-50 tw-w-full tw-p-4 tw-overflow-x-hidden tw-overflow-y-auto md:tw-inset-0 tw-h-full tw-max-h-full tw-flex tw-items-center tw-justify-center tw-backdrop-blur-sm tw-bg-black/30">
    <div class="tw-relative tw-w-full tw-max-w-md tw-max-h-full tw-animate-modal-entry">
        <!-- Modal content -->
        <div class="tw-relative tw-bg-white tw-rounded-lg tw-shadow-sm dark:tw-bg-gray-700">
            <!-- Modal header -->
            <div class="tw-flex tw-items-center tw-justify-between tw-p-4 md:tw-p-5 tw-border-b tw-rounded-t dark:tw-border-gray-600 tw-border-gray-200">
                <h3 class="tw-text-lg tw-font-semibold tw-text-gray-900 dark:tw-text-white">Edit Pet</h3>
                <button type="button" class="tw-text-gray-400 tw-bg-transparent tw-hover:tw-bg-gray-200 tw-hover:tw-text-gray-900 tw-rounded-lg tw-text-sm tw-w-8 tw-h-8 ms-auto tw-inline-flex tw-justify-center tw-items-center dark:tw-hover:tw-bg-gray-600 dark:tw-hover:tw-text-white" data-modal-toggle="editPet-modal">
                    <svg class="tw-w-3 tw-h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <!-- Modal body -->
            <form id="editPetForm" method="POST" enctype="multipart/form-data" class="tw-p-4 md:tw-p-5">
                @csrf
                <input type="hidden" id="edit_pet_id" name="petID">

                <!-- Name field -->
                <div class="tw-col-span-2 tw-mb-4">
                    <label for="edit_pet_name" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Pet Name</label>
                    <input type="text" name="name" id="edit_pet_name" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-primary-600 tw-focus:tw-border-primary-600 tw-block tw-w-full tw-p-2.5" required>
                </div>

                <!-- Species and Type fields -->
                <div class="tw-col-span-1 tw-mb-4">
                    <label for="edit_species" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Species</label>
                    <select id="edit_species" name="species" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-primary-500 tw-focus:tw-border-primary-500 tw-block tw-w-full tw-p-2.5" required>
                        <option value="">Select Species</option>
                        <option value="Dog">Dog</option>
                        <option value="Cat">Cat</option>
                        <option value="Rabbit">Rabbit</option>
                        <option value="Hamster">Hamster</option>
                        <option value="Guinea Pig">Guinea Pig</option>
                    </select>   
                </div>

                <div class="tw-col-span-1 tw-mb-4">
                    <label for="edit_breed" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Breed/Type</label>
                    <input type="text" name="breed" id="edit_breed" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-primary-600 tw-focus:tw-border-primary-600 tw-block tw-w-full tw-p-2.5" required>
                </div>

                <!-- Gender and Birth Date fields -->
                <div class="tw-col-span-1 tw-mb-4">
                    <label for="edit_gender" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Gender</label>
                    <select id="edit_gender" name="gender" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-primary-500 tw-focus:tw-border-primary-500 tw-block tw-w-full tw-p-2.5" required>
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <div class="tw-col-span-1 tw-mb-4">
                    <label for="edit_birthDate" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Birth Date</label>
                    <input type="date" name="birthDate" id="edit_birthDate" max="{{ date('Y-m-d') }}" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-primary-600 tw-focus:tw-border-primary-600 tw-block tw-w-full tw-p-2.5" required>
                </div>

                <!-- Weight and Vaccination Status -->
                <div class="tw-col-span-1 tw-mb-4">
                    <label for="edit_weight" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Weight (kg)</label>
                    <input type="number" name="weight" id="edit_weight" step="0.01" min="0" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-primary-600 tw-focus:tw-border-primary-600 tw-block tw-w-full tw-p-2.5">
                </div>

                <div class="tw-col-span-1 tw-mb-4">
                    <label class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Vaccination Status</label>
                    <div class="tw-flex tw-items-center tw-gap-4">
                        <label class="tw-inline-flex tw-items-center">
                            <input type="checkbox" name="isVaccinated" id="edit_isVaccinated" class="tw-form-checkbox tw-h-4 tw-w-4 tw-text-primary-600">
                            <span class="tw-ml-2">Vaccinated</span>
                        </label>
                        <input type="date" 
                            name="lastVaccinationDate" 
                            id="edit_lastVaccinationDate" 
                            max="{{ date('Y-m-d') }}" 
                            class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-primary-600 tw-focus:tw-border-primary-600 tw-flex-1 tw-p-2.5 tw-hidden" 
                            disabled>
                    </div>
                </div>

                <!-- Medical Information -->
                <div class="tw-col-span-2 tw-mb-4">
                    <label for="edit_allergies" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Allergies</label>
                    <input type="text" name="allergies" id="edit_allergies" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-primary-600 tw-focus:tw-border-primary-600 tw-block tw-w-full tw-p-2.5" placeholder="List any known allergies">
                </div>

                <div class="tw-col-span-2 tw-mb-4">
                    <label for="edit_medicalHistory" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Medical History</label>
                    <textarea id="edit_medicalHistory" name="medicalHistory" rows="2" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-primary-600 tw-focus:tw-border-primary-600 tw-block tw-w-full tw-p-2.5" placeholder="Any relevant medical history..."></textarea>
                </div>

                <!-- Notes field -->
                <div class="tw-col-span-2 tw-mb-4">
                    <label for="edit_petNotes" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Additional Notes</label>
                    <textarea id="edit_petNotes" name="petNotes" rows="2" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-primary-600 tw-focus:tw-border-primary-600 tw-block tw-w-full tw-p-2.5" placeholder="Any special notes about your pet..."></textarea>
                </div>

                <!-- Pet Image -->
                <div class="tw-col-span-2 tw-mb-4">
                    <label class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Pet Image</label>
                    <div class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-w-full">
                        <!-- Upload Area -->
                        <label for="edit_pet_image" id="edit_upload_area" class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-w-full tw-h-64 tw-border-2 tw-border-gray-300 tw-border-dashed tw-rounded-lg tw-cursor-pointer tw-bg-gray-50 hover:tw-bg-gray-100">
                            <div class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-pt-5 tw-pb-6">
                                <svg class="tw-w-8 tw-h-8 tw-mb-4 tw-text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                </svg>
                                <p class="tw-mb-2 tw-text-sm tw-text-gray-500"><span class="tw-font-semibold">Click to change</span> or drag and drop</p>
                                <p class="tw-text-xs tw-text-gray-500">PNG, JPG or JPEG</p>
                            </div>
                            <input id="edit_pet_image" type="file" class="tw-hidden" accept="image/png, image/jpeg, image/jpg" />
                        </label>

                        <!-- Cropper Area -->
                        <div id="edit_cropper_area" class="tw-hidden tw-w-full">
                            <img id="edit_cropper_image" class="tw-w-full tw-h-64 tw-object-cover">
                            <div class="tw-flex tw-justify-between tw-mt-2">
                                <button type="button" id="editcancel_crop" class="tw-bg-red-500 tw-text-white tw-px-4 tw-py-2 tw-rounded-lg">Cancel</button>
                                <button type="button" id="editapply_crop" class="tw-bg-green-500 tw-text-white tw-px-4 tw-py-2 tw-rounded-lg">Apply</button>
                            </div>
                        </div>

                        <!-- Preview Area -->
                        <div id="edit_preview_area" class="tw-hidden tw-flex tw-flex-col tw-justify-center tw-mt-4">
                            <img id="edit_preview_image" class="tw-w-32 tw-h-32 tw-rounded-full tw-object-cover">
                            <button type="button" id="edit_change_image" class="tw-text-sm tw-mt-3 tw-text-blue-500 hover:tw-text-blue-700">Change Image</button>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    let editCropper = null;
    let editCroppedImageData = null;
    
    const editUploadArea = document.getElementById('edit_upload_area');
    const editCropperArea = document.getElementById('edit_cropper_area');
    const editPreviewArea = document.getElementById('edit_preview_area');
    const editFileInput = document.getElementById('edit_pet_image');
    const editCropperImage = document.getElementById('edit_cropper_image');
    const editPreviewImage = document.getElementById('edit_preview_image');
    const editIsVaccinatedCheckbox = document.getElementById('edit_isVaccinated');
    const editLastVaccinationDateInput = document.getElementById('edit_lastVaccinationDate');

    // Function to populate form with pet data
    window.populateEditPetForm = function(pet) {
        document.getElementById('edit_pet_id').value = pet.petID;
        document.getElementById('edit_pet_name').value = pet.name;
        document.getElementById('edit_species').value = pet.species;
        document.getElementById('edit_breed').value = pet.breed;
        document.getElementById('edit_gender').value = pet.gender;
        document.getElementById('edit_birthDate').value = pet.birthDate;
        document.getElementById('edit_weight').value = pet.weight;
        document.getElementById('edit_allergies').value = pet.allergies || '';
        document.getElementById('edit_medicalHistory').value = pet.medicalHistory || '';
        document.getElementById('edit_petNotes').value = pet.petNotes || '';

        // Handle vaccination status
        editIsVaccinatedCheckbox.checked = pet.isVaccinated;
        if (pet.isVaccinated && pet.lastVaccinationDate) {
            editLastVaccinationDateInput.value = pet.lastVaccinationDate;
            editLastVaccinationDateInput.classList.remove('tw-hidden');
            editLastVaccinationDateInput.disabled = false;
        }

        // Handle pet image
        if (pet.petImage) {
            editUploadArea.classList.add('tw-hidden');
            editPreviewArea.classList.remove('tw-hidden');
            // Properly format the image URL
            const imageUrl = pet.petImage.startsWith('storage/') 
                ? `/${pet.petImage}` 
                : `/storage/${pet.petImage}`;
            editPreviewImage.src = imageUrl;
            editCroppedImageData = null; // Reset cropped data since we're using existing image
        }
    };

    // Reset image upload function
    function resetEditImageUpload() {
        if (editCropper) {
            editCropper.destroy();
            editCropper = null;
        }
        editFileInput.value = '';
        editUploadArea.classList.remove('tw-hidden');
        editCropperArea.classList.add('tw-hidden');
        editPreviewArea.classList.add('tw-hidden');
    }

    // Change image button handler
    document.getElementById('edit_change_image').addEventListener('click', function(e) {
        e.preventDefault();
        resetEditImageUpload();
        editFileInput.click();
    });

    // File input change handler
    editFileInput.addEventListener('change', function(e) {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                editUploadArea.classList.add('tw-hidden');
                editCropperArea.classList.remove('tw-hidden');
                editCropperImage.src = e.target.result;
                
                if (editCropper) {
                    editCropper.destroy();
                }

                setTimeout(() => {
                    editCropper = new Cropper(editCropperImage, {
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
            reader.readAsDataURL(this.files[0]);
        }
    });

    // Cancel crop button handler
    document.getElementById('editcancel_crop').addEventListener('click', function(e) {
        e.preventDefault();
        resetEditImageUpload();
    });

    // Apply crop button handler
    document.getElementById('editapply_crop').addEventListener('click', function(e) {
        e.preventDefault();
        if (editCropper) {
            try {
                const croppedCanvas = editCropper.getCroppedCanvas({
                    width: 300,
                    height: 300
                });
                
                if (croppedCanvas) {
                    editCroppedImageData = croppedCanvas.toDataURL();
                    editPreviewImage.src = editCroppedImageData;
                    editCropperArea.classList.add('tw-hidden');
                    editPreviewArea.classList.remove('tw-hidden');
                    
                    let hiddenInput = document.getElementById('edit_cropped_image_data');
                    if (!hiddenInput) {
                        hiddenInput = document.createElement('input');
                        hiddenInput.type = 'hidden';
                        hiddenInput.id = 'edit_cropped_image_data';
                        hiddenInput.name = 'cropped_image';
                        document.getElementById('editPetForm').appendChild(hiddenInput);
                    }
                    hiddenInput.value = editCroppedImageData;
                }
            } catch (error) {
                console.error('Error during crop:', error);
            }
        }
    });

    // Vaccination checkbox handler
    editIsVaccinatedCheckbox.addEventListener('change', function() {
        editLastVaccinationDateInput.classList.toggle('tw-hidden', !this.checked);
        editLastVaccinationDateInput.disabled = !this.checked;
        if (this.checked) {
            editLastVaccinationDateInput.required = true;
        } else {
            editLastVaccinationDateInput.required = false;
            editLastVaccinationDateInput.value = '';
        }
    });

    // Form submission handler
    document.getElementById('editPetForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        Swal.fire({
            title: 'Update Pet',
            text: 'Are you sure you want to update this pet\'s information?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#24CFF4',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update pet',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                const petId = document.getElementById('edit_pet_id').value;
                const formData = new FormData(this);
                
                // Ensure isVaccinated is properly set
                formData.set('isVaccinated', document.getElementById('edit_isVaccinated').checked ? '1' : '0');
                
                // Only include lastVaccinationDate if pet is vaccinated
                if (!document.getElementById('edit_isVaccinated').checked) {
                    formData.delete('lastVaccinationDate');
                }
                
                fetch(`/pets/${petId}/update`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => Promise.reject(err));
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Success!',
                            text: data.message || 'Pet information updated successfully',
                            icon: 'success',
                            confirmButtonColor: '#24CFF4'
                        }).then(() => {
                            document.getElementById('editPet-modal').classList.add('tw-hidden');
                            window.location.reload();
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    let errorMessage = 'Failed to update pet';
                    if (error.errors) {
                        // Join all validation errors into a single message
                        errorMessage = Object.values(error.errors).flat().join('\n');
                    } else if (error.message) {
                        errorMessage = error.message;
                    }
                    
                    Swal.fire({
                        title: 'Error!',
                        text: errorMessage,
                        icon: 'error',
                        confirmButtonColor: '#24CFF4'
                    });
                });
            }
        });
    });

    // Edit modal close handlers
    document.querySelectorAll('[data-modal-toggle="editPet-modal"]').forEach(element => {
        element.addEventListener('click', () => {
            document.getElementById('editPet-modal').classList.add('tw-hidden');
        });
    });
});
</script>
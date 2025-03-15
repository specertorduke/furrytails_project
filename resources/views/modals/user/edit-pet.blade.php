<!-- filepath: c:\xampp\htdocs\dashboard\furrytails_project\resources\views\modals\user\edit-pet.blade.php -->
<!-- Edit Pet Modal -->
<div id="editPet-modal" tabindex="-1" aria-hidden="true" class="tw-hidden tw-fixed tw-top-0 tw-left-0 tw-right-0 tw-z-50 tw-w-full tw-p-4 tw-overflow-x-hidden tw-overflow-y-auto md:tw-inset-0 tw-h-full tw-max-h-full tw-flex tw-items-center tw-justify-center tw-backdrop-blur-sm tw-bg-black/60">
    <div class="tw-relative tw-w-full tw-max-w-xl tw-max-h-full tw-animate-modal-entry">
        <!-- Modal content -->
        <div class="tw-relative tw-bg-white tw-rounded-lg tw-shadow-sm tw-transform tw-transition-all">
            <!-- Modal header -->
            <div class="tw-flex tw-items-center tw-justify-between tw-p-4 md:tw-p-5 tw-border-b tw-rounded-t tw-border-gray-200">
                <h3 class="tw-text-lg tw-font-semibold tw-text-gray-900">Edit Pet</h3>
                <button type="button" class="tw-text-gray-400 tw-bg-transparent tw-hover:tw-bg-gray-100 tw-hover:tw-text-gray-900 tw-rounded-lg tw-text-sm tw-w-8 tw-h-8 ms-auto tw-inline-flex tw-justify-center tw-items-center" data-modal-toggle="editPet-modal">
                    <svg class="tw-w-3 tw-h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            
            <!-- Modal body -->
            <div class="tw-p-4 md:tw-p-5">
                <form id="editPetForm">
                    @csrf
                    <input type="hidden" id="edit_pet_id" name="petID">
                    
                    <!-- Pet Basic Information Section -->
                    <div class="tw-mb-6">
                        <h4 class="tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-3">Basic Information</h4>
                        
                        <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-4">
                            <!-- Pet Name -->
                            <div>
                                <label for="edit_name" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">Pet Name</label>
                                <input type="text" id="edit_name" name="name" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-block tw-w-full tw-p-2.5 focus:tw-border-[#24CFF4] focus:tw-ring-[#24CFF4]" required>
                            </div>
                            
                            <!-- Species Selection -->
                            <div>
                                <label for="edit_species" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">Species</label>
                                <select id="edit_species" name="species" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-block tw-w-full tw-p-2.5 focus:tw-border-[#24CFF4] focus:tw-ring-[#24CFF4]" required>
                                    <option value="">Select species</option>
                                    <option value="Dog">Dog</option>
                                    <option value="Cat">Cat</option>
                                    <option value="Rabbit">Rabbit</option>
                                    <option value="Hamster">Hamster</option>
                                    <option value="Bird">Bird</option>
                                    <option value="Guinea Pig">Guinea Pig</option>
                                    <option value="Fish">Fish</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            
                            <!-- Breed -->
                            <div>
                                <label for="edit_breed" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">Breed</label>
                                <input type="text" id="edit_breed" name="breed" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-block tw-w-full tw-p-2.5 focus:tw-border-[#24CFF4] focus:tw-ring-[#24CFF4]" required>
                            </div>
                            
                            <!-- Gender -->
                            <div>
                                <label for="edit_gender" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">Gender</label>
                                <select id="edit_gender" name="gender" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-block tw-w-full tw-p-2.5 focus:tw-border-[#24CFF4] focus:tw-ring-[#24CFF4]" required>
                                    <option value="">Select gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            
                            <!-- Birth Date -->
                            <div>
                                <label for="edit_birthDate" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">Birth Date</label>
                                <input type="date" id="edit_birthDate" name="birthDate" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-block tw-w-full tw-p-2.5 focus:tw-border-[#24CFF4] focus:tw-ring-[#24CFF4]" required>
                            </div>
                            
                            <!-- Weight -->
                            <div>
                                <label for="edit_weight" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">Weight (kg)</label>
                                <input type="number" id="edit_weight" name="weight" step="0.01" min="0" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-block tw-w-full tw-p-2.5 focus:tw-border-[#24CFF4] focus:tw-ring-[#24CFF4]">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Pet Health Information Section -->
                    <div class="tw-mb-6">
                        <h4 class="tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-3">Health Information</h4>
                        
                        <!-- Vaccination Status -->
                        <div class="tw-flex tw-items-center tw-mb-4">
                            <div class="tw-flex tw-items-center">
                                <input id="edit_isVaccinated" type="checkbox" name="isVaccinated" value="1" class="tw-w-4 tw-h-4 tw-text-[#24CFF4] tw-border-gray-300 tw-rounded focus:tw-ring-[#24CFF4]">
                                <label for="edit_isVaccinated" class="tw-ml-2 tw-text-sm tw-font-medium tw-text-gray-700">Vaccinated</label>
                            </div>
                        </div>
                        
                        <!-- Vaccination Date (conditionally displayed) -->
                        <div id="vaccinationDateContainer" class="tw-mb-4 tw-hidden">
                            <label for="edit_lastVaccinationDate" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">Last Vaccination Date</label>
                            <input type="date" id="edit_lastVaccinationDate" name="lastVaccinationDate" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-block tw-w-full tw-p-2.5 focus:tw-border-[#24CFF4] focus:tw-ring-[#24CFF4]">
                        </div>
                        
                        <!-- Medical History -->
                        <div class="tw-mb-4">
                            <label for="edit_medicalHistory" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">Medical History</label>
                            <textarea id="edit_medicalHistory" name="medicalHistory" rows="3" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-block tw-w-full tw-p-2.5 focus:tw-border-[#24CFF4] focus:tw-ring-[#24CFF4]" placeholder="Enter medical history..."></textarea>
                        </div>
                        
                        <!-- Allergies -->
                        <div>
                            <label for="edit_allergies" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">Allergies</label>
                            <textarea id="edit_allergies" name="allergies" rows="3" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-block tw-w-full tw-p-2.5 focus:tw-border-[#24CFF4] focus:tw-ring-[#24CFF4]" placeholder="List any allergies..."></textarea>
                        </div>
                    </div>
                    
                    <!-- Additional Information Section -->
                    <div class="tw-mb-6">
                        <h4 class="tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-3">Additional Information</h4>
                        
                        <!-- Notes -->
                        <div>
                            <label for="edit_petNotes" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">Notes</label>
                            <textarea id="edit_petNotes" name="petNotes" rows="3" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-block tw-w-full tw-p-2.5 focus:tw-border-[#24CFF4] focus:tw-ring-[#24CFF4]" placeholder="Enter additional notes..."></textarea>
                        </div>
                    </div>
                    
                    <!-- Pet Image Section -->
                    <div class="tw-mb-6">
                        <h4 class="tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-3">Pet Image</h4>
                        
                        <div class="tw-flex tw-flex-col tw-items-center tw-justify-center">
                            <div id="edit_image_preview" class="tw-w-40 tw-h-40 tw-rounded-full tw-overflow-hidden tw-bg-gray-100 tw-mb-4 tw-flex tw-items-center tw-justify-center">
                                <i class="fas fa-paw tw-text-4xl tw-text-gray-300"></i>
                            </div>
                            
                            <label for="edit_pet_image" class="tw-cursor-pointer tw-bg-[#24CFF4] tw-text-white tw-px-4 tw-py-2 tw-rounded-lg tw-text-sm tw-font-medium">
                                <i class="fas fa-camera tw-mr-2"></i> Change Image
                            </label>
                            <input type="file" id="edit_pet_image" accept="image/*" class="tw-hidden">
                            <input type="hidden" id="edit_cropped_image" name="cropped_image">
                            
                            <p id="edit_image_name" class="tw-text-sm tw-text-gray-500 tw-mt-2"></p>
                        </div>
                    </div>
                    
                    <!-- Actions Section -->
                    <div class="tw-flex tw-justify-between tw-mt-8 tw-pt-4 tw-border-t tw-border-gray-200">
                        <button type="button" data-modal-toggle="editPet-modal" class="tw-text-gray-700 tw-bg-gray-100 hover:tw-bg-gray-200 tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center">
                            Cancel
                        </button>
                        <button type="submit" id="savePetChangesBtn" class="tw-text-white tw-bg-[#24CFF4] hover:tw-bg-[#00b8dd] tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center tw-flex tw-items-center">
                            <i class="fas fa-save tw-mr-2"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Cropper Modal for Image Editing -->
<div id="cropperModal" class="tw-hidden tw-fixed tw-top-0 tw-left-0 tw-right-0 tw-z-50 tw-w-full tw-p-4 tw-overflow-x-hidden tw-overflow-y-auto md:tw-inset-0 tw-h-full tw-max-h-full tw-flex tw-items-center tw-justify-center tw-backdrop-blur-sm tw-bg-black/60">
    <div class="tw-relative tw-w-full tw-max-w-lg tw-max-h-full">
        <div class="tw-relative tw-bg-white tw-rounded-lg tw-shadow-sm">
            <div class="tw-flex tw-items-center tw-justify-between tw-p-4 tw-border-b tw-rounded-t tw-border-gray-200">
                <h3 class="tw-text-lg tw-font-semibold tw-text-gray-900">Crop Image</h3>
                <button type="button" id="closeCropperModal" class="tw-text-gray-400 tw-bg-transparent tw-hover:tw-bg-gray-100 tw-hover:tw-text-gray-900 tw-rounded-lg tw-text-sm tw-w-8 tw-h-8 tw-inline-flex tw-justify-center tw-items-center">
                    <svg class="tw-w-3 tw-h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="tw-p-4">
                <div class="tw-mb-4">
                    <div id="cropperContainer" class="tw-max-h-96 tw-overflow-hidden">
                        <img id="cropperImage" src="" alt="Image to crop" class="tw-max-w-full">
                    </div>
                </div>
                <div class="tw-flex tw-justify-end">
                    <button type="button" id="cropImageBtn" class="tw-text-white tw-bg-[#24CFF4] hover:tw-bg-[#00b8dd] tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center">
                        Crop & Use Image
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
['DOMContentLoaded', 'contentChanged'].forEach(eventName => {
    document.addEventListener(eventName, function() {    
    // Initialize variables for cropper
    let cropper = null;
    let currentPetImage = null;
    
    // Function to populate the edit pet form with data
    window.populateEditPetForm = function(pet) {
        // Set hidden ID field
        document.getElementById('edit_pet_id').value = pet.petID;
        
        // Set form fields
        document.getElementById('edit_name').value = pet.name;
        document.getElementById('edit_species').value = pet.species;
        document.getElementById('edit_breed').value = pet.breed;
        document.getElementById('edit_gender').value = pet.gender;
        document.getElementById('edit_birthDate').value = pet.birthDate;
        document.getElementById('edit_weight').value = pet.weight;
        document.getElementById('edit_medicalHistory').value = pet.medicalHistory;
        document.getElementById('edit_allergies').value = pet.allergies;
        document.getElementById('edit_petNotes').value = pet.petNotes;
        
        // Set vaccination status
        const isVaccinatedCheckbox = document.getElementById('edit_isVaccinated');
        isVaccinatedCheckbox.checked = pet.isVaccinated;
        
        // Show/hide vaccination date field based on vaccination status
        const vaccinationDateContainer = document.getElementById('vaccinationDateContainer');
        vaccinationDateContainer.classList.toggle('tw-hidden', !pet.isVaccinated);
        
        // Set vaccination date if available
        if (pet.lastVaccinationDate) {
            document.getElementById('edit_lastVaccinationDate').value = pet.lastVaccinationDate;
        }
        
        // Set pet image in preview
        const imagePreview = document.getElementById('edit_image_preview');
        if (pet.petImage) {
            const imageUrl = "{{ asset('storage/') }}/" + pet.petImage;
            imagePreview.innerHTML = `<img src="${imageUrl}" alt="${pet.name}" class="tw-w-full tw-h-full tw-object-cover">`;
            currentPetImage = imageUrl;
        } else {
            // Set default image based on species
            let speciesIcon = '<i class="fas fa-paw tw-text-4xl tw-text-gray-300"></i>';
            
            if (pet.species.toLowerCase() === 'dog') {
                speciesIcon = '<i class="fas fa-dog tw-text-4xl tw-text-gray-300"></i>';
            } else if (pet.species.toLowerCase() === 'cat') {
                speciesIcon = '<i class="fas fa-cat tw-text-4xl tw-text-gray-300"></i>';
            }
            
            imagePreview.innerHTML = speciesIcon;
            currentPetImage = null;
        }
    };
    
    // Event listener for vaccination checkbox
    const isVaccinatedCheckbox = document.getElementById('edit_isVaccinated');
    if (isVaccinatedCheckbox) {
        isVaccinatedCheckbox.addEventListener('change', function() {
            const vaccinationDateContainer = document.getElementById('vaccinationDateContainer');
            vaccinationDateContainer.classList.toggle('tw-hidden', !this.checked);
            
            if (!this.checked) {
                document.getElementById('edit_lastVaccinationDate').value = '';
            }
        });
    }
    
    // Handle image upload and cropping
    const editPetImage = document.getElementById('edit_pet_image');
    const cropperModal = document.getElementById('cropperModal');
    const cropperImage = document.getElementById('cropperImage');
    const closeCropperModal = document.getElementById('closeCropperModal');
    const cropImageBtn = document.getElementById('cropImageBtn');
    
    if (editPetImage) {
        editPetImage.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (!file) return;
            
            // Display selected file name
            const imageNameDisplay = document.getElementById('edit_image_name');
            if (imageNameDisplay) {
                imageNameDisplay.textContent = file.name;
            }
            
            // Create image URL and show in cropper
            const imageURL = URL.createObjectURL(file);
            cropperImage.src = imageURL;
            cropperModal.classList.remove('tw-hidden');
            
            // Initialize cropper after image is loaded
            cropperImage.onload = function() {
                if (cropper) {
                    cropper.destroy();
                }
                
                cropper = new Cropper(cropperImage, {
                    aspectRatio: 1,
                    viewMode: 1,
                    autoCropArea: 1,
                    responsive: true,
                    background: false,
                    guides: true,
                    center: true,
                    highlight: false,
                    cropBoxResizable: true,
                    dragMode: 'move',
                });
            };
        });
    }
    
    // Close cropper modal
    if (closeCropperModal) {
        closeCropperModal.addEventListener('click', function() {
            cropperModal.classList.add('tw-hidden');
            if (cropper) {
                cropper.destroy();
                cropper = null;
            }
        });
    }
    
    // Crop and use image
    if (cropImageBtn) {
        cropImageBtn.addEventListener('click', function() {
            if (!cropper) return;
            
            // Get cropped canvas as base64 string
            const canvas = cropper.getCroppedCanvas({
                width: 300,
                height: 300,
                fillColor: '#fff'
            });
            
            // Convert to base64 and set as image preview
            const croppedImageData = canvas.toDataURL('image/jpeg');
            const imagePreview = document.getElementById('edit_image_preview');
            imagePreview.innerHTML = `<img src="${croppedImageData}" alt="Cropped pet image" class="tw-w-full tw-h-full tw-object-cover">`;
            
            // Store base64 data in hidden input for form submission
            document.getElementById('edit_cropped_image').value = croppedImageData;
            
            // Close cropper modal
            cropperModal.classList.add('tw-hidden');
            cropper.destroy();
            cropper = null;
        });
    }
    
    // Form submission handler
    const editPetForm = document.getElementById('editPetForm');
    if (editPetForm) {
        editPetForm.addEventListener('submit', function(e) {
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
                    
                    // Show loading state
                    const saveButton = document.getElementById('savePetChangesBtn');
                    const originalButtonHTML = saveButton.innerHTML;
                    saveButton.disabled = true;
                    saveButton.innerHTML = '<i class="fas fa-spinner fa-spin tw-mr-2"></i> Saving...';
                    
                    // Send AJAX request to update pet
                    fetch(`{{ route('user.pets.update', ['id' => ':id']) }}`.replace(':id', petId), {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(err => {
                                throw err;
                            });
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
                        } else {
                            throw new Error(data.message || 'Failed to update pet');
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
                    })
                    .finally(() => {
                        // Restore button state
                        saveButton.disabled = false;
                        saveButton.innerHTML = originalButtonHTML;
                    });
                }
            });
        });
    }
    
    // Close modal handler
    const modalToggle = document.querySelector('[data-modal-toggle="editPet-modal"]');
    if (modalToggle) {
        modalToggle.addEventListener('click', function() {
            document.getElementById('editPet-modal').classList.add('tw-hidden');
        });
    }
            // Any initialization code needed for the edit pet modal
            console.log('Edit pet modal initialized');
});
});
</script>
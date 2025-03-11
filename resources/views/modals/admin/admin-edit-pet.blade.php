<!-- Edit Pet Modal -->
<div id="editPet-modal" tabindex="-1" aria-hidden="true" class="tw-hidden tw-fixed tw-top-0 tw-left-0 tw-right-0 tw-z-50 tw-w-full tw-p-4 tw-overflow-x-hidden tw-overflow-y-auto md:tw-inset-0 tw-h-full tw-max-h-full tw-flex tw-items-center tw-justify-center tw-backdrop-blur-sm tw-bg-black/60">
    <div class="tw-relative tw-w-full tw-max-w-2xl tw-max-h-full tw-animate-modal-entry">
        <!-- Modal content -->
        <div class="tw-relative tw-bg-gray-800 tw-rounded-lg tw-shadow-sm tw-transform tw-transition-all">
            <!-- Modal header -->
            <div class="tw-flex tw-items-center tw-justify-between tw-p-4 md:tw-p-5 tw-border-b tw-rounded-t tw-border-gray-700">
                <h3 class="tw-text-lg tw-font-semibold tw-text-white">Edit Pet</h3>
                <button type="button" class="tw-text-gray-400 tw-bg-transparent tw-hover:tw-bg-gray-700 tw-hover:tw-text-white tw-rounded-lg tw-text-sm tw-w-8 tw-h-8 ms-auto tw-inline-flex tw-justify-center tw-items-center" data-modal-toggle="editPet-modal">
                    <svg class="tw-w-3 tw-h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            
            <!-- Modal body -->
            <div class="tw-p-4 md:tw-p-5">
                <form id="editPetForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" id="editPetID" name="petID">
                    
                    <!-- Pet Info Section -->
                    <div class="tw-flex tw-flex-col md:tw-flex-row tw-gap-6">
                        <!-- Pet Image Column -->
                        <div class="tw-flex tw-flex-col tw-items-center">
                            <div id="editPetImage" class="tw-h-40 tw-w-40 tw-rounded-full tw-bg-gray-700 tw-flex tw-items-center tw-justify-center tw-overflow-hidden">
                                <!-- Image will be set via JavaScript -->
                                <i class="fas fa-paw tw-text-4xl tw-text-gray-500"></i>
                            </div>
                            <div class="tw-mt-3 tw-w-full">
                                <label for="petImageUpload" class="tw-block tw-w-full">
                                    <div class="tw-bg-gray-700 tw-text-sm tw-text-[#24CFF4] tw-px-4 tw-py-2 tw-rounded-lg tw-cursor-pointer hover:tw-bg-gray-600 tw-text-center">
                                        <i class="fas fa-camera tw-mr-2"></i> Change Photo
                                    </div>
                                </label>
                                <input type="file" id="petImageUpload" name="petImage" class="tw-hidden" accept="image/jpeg, image/png, image/jpg">
                            </div>
                        </div>
                        
                        <!-- Pet Details Column -->
                        <div class="tw-flex-1 tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-4">
                            <!-- Name -->
                            <div>
                                <label for="name" class="tw-block tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-1">Pet Name</label>
                                <input type="text" id="name" name="name" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-block tw-w-full tw-p-2.5 focus:tw-border-blue-500 focus:tw-ring-blue-500" required>
                            </div>
                            
                            <!-- Species -->
                            <div>
                                <label for="species" class="tw-block tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-1">Species</label>
                                <select id="species" name="species" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-block tw-w-full tw-p-2.5 focus:tw-border-blue-500 focus:tw-ring-blue-500" required>
                                    <option value="Dog">Dog</option>
                                    <option value="Cat">Cat</option>
                                    <option value="Rabbit">Rabbit</option>
                                    <option value="Hamster">Hamster</option>
                                    <option value="Guinea Pig">Guinea Pig</option>
                                    <option value="Bird">Bird</option>
                                    <option value="Fish">Fish</option>
                                    <option value="Reptile">Reptile</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            
                            <!-- Breed -->
                            <div>
                                <label for="breed" class="tw-block tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-1">Breed</label>
                                <input type="text" id="breed" name="breed" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-block tw-w-full tw-p-2.5 focus:tw-border-blue-500 focus:tw-ring-blue-500">
                            </div>
                            
                            <!-- Gender -->
                            <div>
                                <label for="gender" class="tw-block tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-1">Gender</label>
                                <select id="gender" name="gender" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-block tw-w-full tw-p-2.5 focus:tw-border-blue-500 focus:tw-ring-blue-500" required>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            
                            <!-- Birth Date -->
                            <div>
                                <label for="birthDate" class="tw-block tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-1">Birth Date</label>
                                <input type="date" id="birthDate" name="birthDate" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-block tw-w-full tw-p-2.5 focus:tw-border-blue-500 focus:tw-ring-blue-500" required>
                            </div>
                            
                            <!-- Weight -->
                            <div>
                                <label for="weight" class="tw-block tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-1">Weight (kg)</label>
                                <input type="number" step="0.01" id="weight" name="weight" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-block tw-w-full tw-p-2.5 focus:tw-border-blue-500 focus:tw-ring-blue-500">
                            </div>
                            
                            <!-- Owner -->
                            <div class="tw-col-span-2">
                                <label for="userID" class="tw-block tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-1">Owner</label>
                                <select id="userID" name="userID" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-block tw-w-full tw-p-2.5 focus:tw-border-blue-500 focus:tw-ring-blue-500" required>
                                    <!-- Will be populated via JavaScript -->
                                </select>
                            </div>
                            
                            <!-- Vaccination Status -->
                            <div>
                                <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-1">Vaccination Status</label>
                                <div class="tw-flex tw-items-center tw-mt-2">
                                    <input type="checkbox" id="isVaccinated" name="isVaccinated" class="tw-w-4 tw-h-4 tw-text-blue-600 tw-bg-gray-700 tw-border-gray-600 tw-rounded focus:tw-ring-blue-500">
                                    <label for="isVaccinated" class="tw-ml-2 tw-text-sm tw-text-gray-300">Pet is vaccinated</label>
                                </div>
                            </div>
                            
                            <!-- Last Vaccination Date -->
                            <div>
                                <label for="lastVaccinationDate" class="tw-block tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-1">Last Vaccination Date</label>
                                <input type="date" id="lastVaccinationDate" name="lastVaccinationDate" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-block tw-w-full tw-p-2.5 focus:tw-border-blue-500 focus:tw-ring-blue-500">
                            </div>
                            
                            <!-- Medical History -->
                            <div class="tw-col-span-2">
                                <label for="medicalHistory" class="tw-block tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-1">Medical History</label>
                                <textarea id="medicalHistory" name="medicalHistory" rows="3" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-block tw-w-full tw-p-2.5 focus:tw-border-blue-500 focus:tw-ring-blue-500"></textarea>
                            </div>
                            
                            <!-- Allergies -->
                            <div class="tw-col-span-2">
                                <label for="allergies" class="tw-block tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-1">Allergies</label>
                                <textarea id="allergies" name="allergies" rows="2" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-block tw-w-full tw-p-2.5 focus:tw-border-blue-500 focus:tw-ring-blue-500"></textarea>
                            </div>
                            
                            <!-- Notes -->
                            <div class="tw-col-span-2">
                                <label for="petNotes" class="tw-block tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-1">Notes</label>
                                <textarea id="petNotes" name="petNotes" rows="3" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-block tw-w-full tw-p-2.5 focus:tw-border-blue-500 focus:tw-ring-blue-500"></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Actions Section -->
                    <div class="tw-flex tw-justify-between tw-mt-8 tw-pt-4 tw-border-t tw-border-gray-700">
                        <button type="button" data-modal-toggle="editPet-modal" class="tw-text-gray-300 tw-bg-gray-700 hover:tw-bg-gray-600 tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center">
                            Cancel
                        </button>
                        <button type="submit" id="savePetBtn" class="tw-text-white tw-bg-blue-600 hover:tw-bg-blue-700 tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center tw-flex tw-items-center">
                            <i class="fas fa-save tw-mr-2"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Global variable to store the editing pet's ID
    let editingPetID = null;
    // Function to open edit pet modal with data
    window.openEditPetModal = function(petId) {
        // Store the pet ID we're editing
        editingPetID = petId;
        
        // Show loading state
        const editPetModal = document.getElementById('editPet-modal');
        if (!editPetModal) {
            console.error('Edit pet modal not found in DOM');
            return;
        }
        
        // Show modal
        editPetModal.classList.remove('tw-hidden');
        
        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // Fetch pet data
        fetch("{{ route('admin.pets.edit', ['id' => ':petId']) }}".replace(':petId', petId), {           
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
                    throw new Error(err.message || 'Failed to load pet data');
                });
            }
            return response.json();
        })
        .then(data => {
            if (!data.success) {
                throw new Error(data.message || 'Failed to load pet data');
            }
            
            // Fill form with pet data
            populateEditForm(data.pet);
            
            // Fetch users for the dropdown
            fetchUsers();
        })
        .catch(error => {
            console.error('Error fetching pet data:', error);
            Swal.fire({
                title: 'Error!',
                text: 'Failed to load pet data',
                icon: 'error',
                confirmButtonColor: '#24CFF4',
                background: '#374151',
                color: '#fff'
            });
            
            editPetModal.classList.add('tw-hidden');
        });
    };
    
    // Function to fetch users for the dropdown
    function fetchUsers() {
        const currentUserID = document.getElementById('userID').value;

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
            const userSelect = document.getElementById('userID');
            userSelect.innerHTML = '';
            
            users.forEach(user => {
                const option = document.createElement('option');
                option.value = user.userID;
                option.textContent = `${user.firstName} ${user.lastName}`;

                // Set as selected if this is the current owner
                if (user.userID == currentUserID) {
                    option.selected = true;
                }

                userSelect.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error fetching users:', error);
        });
    }
    
    // Function to populate edit form with pet data
    function populateEditForm(pet) {
        // Set form field values
        document.getElementById('editPetID').value = pet.petID;
        document.getElementById('name').value = pet.name;
        document.getElementById('species').value = pet.species;
        document.getElementById('breed').value = pet.breed || '';
        document.getElementById('gender').value = pet.gender;
        document.getElementById('birthDate').value = pet.birthDate;
        document.getElementById('weight').value = pet.weight || '';
        document.getElementById('isVaccinated').checked = pet.isVaccinated;
        document.getElementById('lastVaccinationDate').value = pet.lastVaccinationDate || '';
        document.getElementById('medicalHistory').value = pet.medicalHistory || '';
        document.getElementById('allergies').value = pet.allergies || '';
        document.getElementById('petNotes').value = pet.petNotes || '';
        document.getElementById('userID').value = pet.userID;
        
        // Set pet image
        const petImage = document.getElementById('editPetImage');
        if (pet.petImage) {
            // Use Laravel's asset helper
            let imageUrl = "{{ asset('') }}" + (pet.petImage.startsWith('storage/') 
                ? pet.petImage 
                : 'storage/' + pet.petImage);
            
            petImage.innerHTML = `<img src="${imageUrl}" alt="${pet.name}" class="tw-h-full tw-w-full tw-object-cover">`;
        } else {
            // Default icon based on species
            let speciesIcon = '<i class="fas fa-paw tw-text-4xl tw-text-gray-500"></i>';
            
            if (pet.species.toLowerCase() === 'dog') {
                speciesIcon = '<i class="fas fa-dog tw-text-4xl tw-text-gray-500"></i>';
            } else if (pet.species.toLowerCase() === 'cat') {
                speciesIcon = '<i class="fas fa-cat tw-text-4xl tw-text-gray-500"></i>';
            }
            
            petImage.innerHTML = `
                <div class="tw-h-full tw-w-full tw-flex tw-items-center tw-justify-center tw-bg-gray-700">
                    ${speciesIcon}
                </div>
            `;
        }
        
        // Toggle vaccination date field based on vaccination status
        toggleVaccinationDateField();
    }
    
    // Image upload preview handler
    const petImageUpload = document.getElementById('petImageUpload');
    const editPetImage = document.getElementById('editPetImage');
    
    if (petImageUpload && editPetImage) {
        petImageUpload.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    editPetImage.innerHTML = `<img src="${e.target.result}" alt="Preview" class="tw-h-full tw-w-full tw-object-cover">`;
                };
                reader.readAsDataURL(file);
            }
        });
    }
    
    // Toggle vaccination date field based on vaccination status
    const isVaccinatedCheckbox = document.getElementById('isVaccinated');
    if (isVaccinatedCheckbox) {
        isVaccinatedCheckbox.addEventListener('change', toggleVaccinationDateField);
    }
    
    function toggleVaccinationDateField() {
        const lastVaccinationDateField = document.getElementById('lastVaccinationDate');
        if (!lastVaccinationDateField) return;
        
        if (isVaccinatedCheckbox.checked) {
            lastVaccinationDateField.removeAttribute('disabled');
            lastVaccinationDateField.parentElement.classList.remove('tw-opacity-50');
        } else {
            lastVaccinationDateField.setAttribute('disabled', 'disabled');
            lastVaccinationDateField.value = '';
            lastVaccinationDateField.parentElement.classList.add('tw-opacity-50');
        }
    }
    
    // Handle form submission
    const editPetForm = document.getElementById('editPetForm');
    if (editPetForm) {
        editPetForm.addEventListener('submit', function(event) {
            event.preventDefault();
            
            // Show loading state
            const saveButton = document.getElementById('savePetBtn');
            const originalButtonHTML = saveButton.innerHTML;
            saveButton.disabled = true;
            saveButton.innerHTML = '<i class="fas fa-spinner fa-spin tw-mr-2"></i> Saving...';
            
            // Create FormData object (handles file uploads)
            const formData = new FormData(this);

            // Only include the image if a file was selected
            const imageInput = document.getElementById('petImageUpload');
            if (imageInput.files.length === 0) {
                // No new file selected, remove the empty file input from the form data
                formData.delete('petImage');
            }

            // Make sure name and species are included
            if (!formData.get('name')) {
                formData.set('name', document.getElementById('name').value);
            }

            if (!formData.get('species')) {
                formData.set('species', document.getElementById('species').value);
            }

            // Handle boolean fields properly
            formData.set('isVaccinated', document.getElementById('isVaccinated').checked ? '1' : '0');

            // Make sure method spoofing is set
            formData.append('_method', 'PUT');
            
            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            // Send update request
            fetch("{{ route('admin.pets.update', ['id' => ':id']) }}".replace(':id', editingPetID), {
                method: 'POST', // POST with _method=PUT for Laravel method spoofing
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    // Don't set Content-Type with FormData
                },
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    console.error('Server responded with status:', response.status);
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
                        text: 'Pet updated successfully',
                        icon: 'success',
                        confirmButtonColor: '#24CFF4',
                        background: '#374151',
                        color: '#fff'
                    }).then(() => {
                        // Hide modal and refresh data
                        document.getElementById('editPet-modal').classList.add('tw-hidden');
                        // Reload the page or refresh the pet cards
                        location.reload();
                    });
                } else {
                    throw new Error(data.message || 'Failed to update pet');
                }
            })
            .catch(error => {
                console.error('Error updating pet:', error);
                Swal.fire({
                    title: 'Error!',
                    text: error.message || 'Failed to update pet',
                    icon: 'error',
                    confirmButtonColor: '#24CFF4',
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
    const editModalToggle = document.querySelector('[data-modal-toggle="editPet-modal"]');
    if (editModalToggle) {
        editModalToggle.addEventListener('click', function() {
            document.getElementById('editPet-modal').classList.add('tw-hidden');
        });
    }
    
    // Initialize vaccination date field state on page load
    if (isVaccinatedCheckbox) {
        toggleVaccinationDateField();
    }
});

 // Connect edit button from view modal
 window.editPet = function(petId) {
        // Close view pet modal if it's open
        const viewPetModal = document.getElementById('viewPet-modal');
        if (viewPetModal && !viewPetModal.classList.contains('tw-hidden')) {
            viewPetModal.classList.add('tw-hidden');
        }
        
        // Open edit modal
        openEditPetModal(petId);
 };
</script>
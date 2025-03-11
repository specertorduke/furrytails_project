<!-- View Pet Modal -->
<div id="viewPet-modal" tabindex="-1" aria-hidden="true" class="tw-hidden tw-fixed tw-top-0 tw-left-0 tw-right-0 tw-z-50 tw-w-full tw-p-4 tw-overflow-x-hidden tw-overflow-y-auto md:tw-inset-0 tw-h-full tw-max-h-full tw-flex tw-items-center tw-justify-center tw-backdrop-blur-sm tw-bg-black/60">
    <div class="tw-relative tw-w-full tw-max-w-2xl tw-max-h-full tw-animate-modal-entry">
        <!-- Modal content -->
        <div class="tw-relative tw-bg-gray-800 tw-rounded-lg tw-shadow-sm tw-transform tw-transition-all">
            <!-- Modal header -->
            <div class="tw-flex tw-items-center tw-justify-between tw-p-4 md:tw-p-5 tw-border-b tw-rounded-t tw-border-gray-700">
                <h3 class="tw-text-lg tw-font-semibold tw-text-white">Pet Profile</h3>
                <button type="button" class="tw-text-gray-400 tw-bg-transparent tw-hover:tw-bg-gray-700 tw-hover:tw-text-white tw-rounded-lg tw-text-sm tw-w-8 tw-h-8 ms-auto tw-inline-flex tw-justify-center tw-items-center" data-modal-toggle="viewPet-modal">
                    <svg class="tw-w-3 tw-h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            
            <!-- Modal body -->
            <div class="tw-p-4 md:tw-p-5">
                <!-- Pet Info Section -->
                <div class="tw-flex tw-flex-col md:tw-flex-row tw-gap-6">
                    <!-- Pet Image Column -->
                    <div class="tw-flex tw-flex-col tw-items-center">
                        <div id="admin.petImage" class="tw-h-40 tw-w-40 tw-rounded-full tw-bg-gray-700 tw-flex tw-items-center tw-justify-center tw-overflow-hidden">
                            <!-- Image will be set via JavaScript -->
                            <i class="fas fa-paw tw-text-4xl tw-text-gray-500"></i>
                        </div>
                        <p id="petName" class="tw-mt-3 tw-text-lg tw-font-semibold tw-text-white"></p>
                        <span id="petSpecies" class="tw-px-3 tw-py-1 tw-mt-2 tw-text-xs tw-rounded-full tw-text-white"></span>
                    </div>
                    
                    <!-- Pet Details Column -->
                    <div class="tw-flex-1">
                        <h4 class="tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-2">Pet Details</h4>
                        
                        <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-4 tw-mb-4">
                            <div>
                                <p class="tw-text-xs tw-text-gray-400">Breed</p>
                                <p id="petBreed" class="tw-text-sm tw-text-white"></p>
                            </div>
                            <div>
                                <p class="tw-text-xs tw-text-gray-400">Gender</p>
                                <p id="petGender" class="tw-text-sm tw-text-white"></p>
                            </div>
                            <div>
                                <p class="tw-text-xs tw-text-gray-400">Age</p>
                                <p id="petAge" class="tw-text-sm tw-text-white"></p>
                            </div>
                            <div>
                                <p class="tw-text-xs tw-text-gray-400">Weight</p>
                                <p id="petWeight" class="tw-text-sm tw-text-white"></p>
                            </div>
                        </div>
                        
                        <!-- Vaccination Status -->
                        <div class="tw-mt-4 tw-mb-4">
                            <p class="tw-text-xs tw-text-gray-400">Vaccination Status</p>
                            <div id="petVaccinationStatus" class="tw-flex tw-items-center tw-gap-2 tw-mt-1">
                                <i class="fas fa-syringe tw-text-gray-500"></i>
                                <span id="vaccinationText" class="tw-text-sm tw-text-white"></span>
                            </div>
                        </div>
                        
                        <!-- Medical Information -->
                        <div class="tw-mt-6">
                            <h4 class="tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-2">Medical Information</h4>
                            
                            <div class="tw-mt-3">
                                <p class="tw-text-xs tw-text-gray-400">Medical History</p>
                                <p id="petMedicalHistory" class="tw-text-sm tw-text-white tw-bg-gray-700/50 tw-p-3 tw-rounded-lg tw-mt-1"></p>
                            </div>
                            
                            <div class="tw-mt-3">
                                <p class="tw-text-xs tw-text-gray-400">Allergies</p>
                                <p id="petAllergies" class="tw-text-sm tw-text-white tw-bg-gray-700/50 tw-p-3 tw-rounded-lg tw-mt-1"></p>
                            </div>
                            
                            <div class="tw-mt-3">
                                <p class="tw-text-xs tw-text-gray-400">Notes</p>
                                <p id="view-petNotes" class="tw-text-sm tw-text-white tw-bg-gray-700/50 tw-p-3 tw-rounded-lg tw-mt-1"></p>
                            </div>
                        </div>
                        
                        <!-- Owner Information -->
                        <div class="tw-mt-6 tw-p-3 tw-bg-gray-700/30 tw-rounded-lg">
                            <h4 class="tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-2">Owner Information</h4>
                            <div class="tw-flex tw-items-center tw-gap-3">
                                <div id="ownerImage" class="tw-h-10 tw-w-10 tw-rounded-full tw-bg-gray-700 tw-flex tw-items-center tw-justify-center tw-overflow-hidden">
                                    <i class="fas fa-user tw-text-sm tw-text-gray-500"></i>
                                </div>
                                <div>
                                    <p id="ownerName" class="tw-text-sm tw-text-white tw-font-medium"></p>
                                    <p id="ownerEmail" class="tw-text-xs tw-text-gray-400"></p>
                                </div>
                                <button id="admin.viewOwnerBtn" class="tw-ml-auto tw-text-xs tw-bg-gray-700 hover:tw-bg-gray-600 tw-text-gray-200 tw-px-3 tw-py-1 tw-rounded-lg">
                                    <i class="fas fa-external-link-alt tw-mr-1"></i> View
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Actions Section -->
                <div class="tw-flex tw-justify-between tw-mt-8 tw-pt-4 tw-border-t tw-border-gray-700">
                    <button id="editPetBtn" class="tw-text-white tw-bg-blue-600 hover:tw-bg-blue-700 tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center tw-flex tw-items-center">
                        <i class="fas fa-edit tw-mr-2"></i> Edit Pet
                    </button>
                    
                    <button id="deletePetBtn" class="tw-text-white tw-bg-red-600 hover:tw-bg-red-700 tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center tw-flex tw-items-center">
                        <i class="fas fa-trash-alt tw-mr-2"></i> Delete Pet
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Global variable to store current pet data
    window.currentPetData = null;
    
    // Function to open pet modal with data
    window.openPetModal = function(petId) {
        // Show loading state
        const viewPetModal = document.getElementById('viewPet-modal');
        if (!viewPetModal) {
            console.error('View pet modal not found in DOM');
            return;
        }
        
        // Show modal with loading indicator
        viewPetModal.classList.remove('tw-hidden');
        
        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // Fetch pet data
        fetch("{{ route('admin.pets.show', ['id' => ':petId']) }}".replace(':petId', petId), {            method: 'GET',
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
            
            // Store current pet data
            window.currentPetData = data.pet;
            
            // Populate pet information
            populatePetData(data.pet);
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
            
            viewPetModal.classList.add('tw-hidden');
        });
    };
    
    // Function to populate pet data in the modal
    function populatePetData(pet) {
        // Set text content for pet details
        document.getElementById('petName').textContent = pet.name;
        document.getElementById('petBreed').textContent = pet.breed || 'Not specified';
        document.getElementById('petGender').textContent = pet.gender;
        
        // Calculate and set age from birthDate
        const birthDate = new Date(pet.birthDate);
        const ageInMonths = calculateAgeInMonths(birthDate);
        const ageText = formatAgeText(ageInMonths);
        document.getElementById('petAge').textContent = ageText;
        
        document.getElementById('petWeight').textContent = pet.weight ? `${pet.weight} kg` : 'Not recorded';
        
        // Set medical information
        document.getElementById('petMedicalHistory').textContent = pet.medicalHistory || 'No medical history recorded';
        document.getElementById('petAllergies').textContent = pet.allergies || 'No allergies recorded';
        document.getElementById('view-petNotes').textContent = pet.petNotes || 'No additional notes';
        
        // Set vaccination status
        const vaccinationText = document.getElementById('vaccinationText');
        if (pet.isVaccinated) {
            vaccinationText.innerHTML = `<span class="tw-text-green-500">Vaccinated</span>`;
            if (pet.lastVaccinationDate) {
                vaccinationText.innerHTML += ` <span class="tw-text-xs tw-text-gray-400">(Last vaccination: ${formatDate(pet.lastVaccinationDate)})</span>`;
            }
        } else {
            vaccinationText.innerHTML = `<span class="tw-text-red-500">Not Vaccinated</span>`;
        }
        
        // Set species with appropriate color
        const speciesBadge = document.getElementById('petSpecies');
        speciesBadge.textContent = pet.species;
        
        // Set color based on species
        if (pet.species.toLowerCase() === 'dog') {
            speciesBadge.classList.add('tw-bg-green-600');
            speciesBadge.classList.remove('tw-bg-yellow-600', 'tw-bg-purple-600');
        } else if (pet.species.toLowerCase() === 'cat') {
            speciesBadge.classList.add('tw-bg-yellow-600');
            speciesBadge.classList.remove('tw-bg-green-600', 'tw-bg-purple-600');
        } else {
            speciesBadge.classList.add('tw-bg-purple-600');
            speciesBadge.classList.remove('tw-bg-green-600', 'tw-bg-yellow-600');
        }
        
        // Set pet image
        const petImage = document.getElementById('admin.petImage');
        if (pet.petImage) {
           // Use Laravel's asset helper
            let imageUrl = "{{ asset('') }}" + (pet.petImage.startsWith('storage/') 
                ? pet.petImage 
                : 'storage/' + pet.petImage);
            
            petImage.innerHTML = `<img src="${imageUrl}" alt="${pet.name}" class="tw-h-full tw-w-full tw-object-cover">`;
            
            console.log('Pet image URL:', imageUrl); // Debug log
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
        
        // Set owner information
        if (pet.user) {
            document.getElementById('ownerName').textContent = `${pet.user.firstName} ${pet.user.lastName}`;
            document.getElementById('ownerEmail').textContent = pet.user.email;
            
            // Set owner image if available
            const ownerImage = document.getElementById('ownerImage');
            if (pet.user && pet.user.userImage) {
                // Use Laravel's asset helper
                let imageUrl = "{{ asset('') }}" + (pet.user.userImage.startsWith('storage/') 
                    ? pet.user.userImage 
                    : 'storage/' + pet.user.userImage);
                
                ownerImage.innerHTML = `<img src="${imageUrl}" alt="Owner" class="tw-h-full tw-w-full tw-object-cover">`;
            }
                        
            // Set up view owner button
            const viewOwnerBtn = document.getElementById('admin.viewOwnerBtn');
            viewOwnerBtn.addEventListener('click', function() {
                // Close pet modal first
                document.getElementById('viewPet-modal').classList.add('tw-hidden');

                // Open user modal with owner ID
                if (typeof window.openUserModal === 'function') {
                    window.openUserModal(pet.user.userID || pet.userID);
                } else {
                    console.error('openUserModal function not found');
                }
            });
        }
    }
    
    // Utility function to calculate age in months
    function calculateAgeInMonths(birthDate) {
        const today = new Date();
        let months = (today.getFullYear() - birthDate.getFullYear()) * 12;
        months -= birthDate.getMonth();
        months += today.getMonth();
        return months <= 0 ? 0 : months;
    }
    
    // Utility function to format age text
    function formatAgeText(months) {
        if (months < 1) {
            return 'Less than 1 month';
        } else if (months < 12) {
            return `${months} month${months > 1 ? 's' : ''}`;
        } else {
            const years = Math.floor(months / 12);
            const remainingMonths = months % 12;
            
            if (remainingMonths === 0) {
                return `${years} year${years > 1 ? 's' : ''}`;
            } else {
                return `${years} year${years > 1 ? 's' : ''}, ${remainingMonths} month${remainingMonths > 1 ? 's' : ''}`;
            }
        }
    }
    
    // Utility function to format date
    function formatDate(dateString) {
        if (!dateString) return 'N/A';
        
        const date = new Date(dateString);
        return date.toLocaleDateString('en-US', { 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric'
        });
    }
    
    // Close modal handler
    const modalToggle = document.querySelector('[data-modal-toggle="viewPet-modal"]');
    if (modalToggle) {
        modalToggle.addEventListener('click', function() {
            document.getElementById('viewPet-modal').classList.add('tw-hidden');
        });
    }
    
    // Edit pet button handler
    const editPetBtn = document.getElementById('editPetBtn');
    if (editPetBtn) {
        editPetBtn.addEventListener('click', function() {
            if (window.currentPetData) {
                // Close this modal
                document.getElementById('viewPet-modal').classList.add('tw-hidden');
                
                // Call the edit function if it exists
                if (typeof window.editPet === 'function') {
                    window.editPet(window.currentPetData.petID);
                } else {
                    console.error('editPet function not found');
                }
            }
        });
    }
    
    // Delete pet button handler
    const deletePetBtn = document.getElementById('deletePetBtn');
    if (deletePetBtn) {
        deletePetBtn.addEventListener('click', function() {
        if (!window.currentPetData) return;
        
        // Use the global deletePet function
        if (typeof window.deletePet === 'function') {
            window.deletePet(window.currentPetData.petID);
        } else {
            console.error('deletePet function not found');
            // Fallback alert if the function isn't available
            Swal.fire({
                title: 'System Error',
                text: 'Delete function not available. Please try again later.',
                icon: 'error',
                confirmButtonColor: '#24CFF4',
                background: '#374151',
                color: '#fff'
            });
        }
    });
}
    
    // Initialize event listeners for both DOMContentLoaded and contentChanged
    ['DOMContentLoaded', 'contentChanged'].forEach(eventName => {
        document.addEventListener(eventName, function() {
            // Any initialization code needed for the pet view modal
            console.log('Pet view modal initialized');
        });
    });
});
</script>
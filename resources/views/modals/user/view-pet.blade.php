<!-- filepath: c:\xampp\htdocs\dashboard\furrytails_project\resources\views\modals\user\view-pet.blade.php -->
<!-- View Pet Modal -->
<div id="viewPet-modal" tabindex="-1" aria-hidden="true" class="tw-hidden tw-fixed tw-top-0 tw-left-0 tw-right-0 tw-z-50 tw-w-full tw-p-4 tw-overflow-x-hidden tw-overflow-y-auto md:tw-inset-0 tw-h-full tw-max-h-full tw-flex tw-items-center tw-justify-center tw-backdrop-blur-sm tw-bg-black/60">
    <div class="tw-relative tw-w-full tw-max-w-2xl tw-max-h-full tw-animate-modal-entry">
        <!-- Modal content -->
        <div class="tw-relative tw-bg-white tw-rounded-lg tw-shadow-sm tw-transform tw-transition-all">
            <!-- Modal header -->
            <div class="tw-flex tw-items-center tw-justify-between tw-p-4 md:tw-p-5 tw-border-b tw-rounded-t tw-border-gray-200">
                <h3 class="tw-text-lg tw-font-semibold tw-text-gray-900">Pet Profile</h3>
                <button type="button" class="tw-text-gray-400 tw-bg-transparent tw-hover:tw-bg-gray-100 tw-hover:tw-text-gray-900 tw-rounded-lg tw-text-sm tw-w-8 tw-h-8 ms-auto tw-inline-flex tw-justify-center tw-items-center" data-modal-toggle="viewPet-modal">
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
                        <div id="petImage" class="tw-h-40 tw-w-40 tw-rounded-full tw-bg-gray-100 tw-flex tw-items-center tw-justify-center tw-overflow-hidden tw-border tw-border-gray-200">
                            <!-- Image will be set via JavaScript -->
                            <i class="fas fa-paw tw-text-4xl tw-text-gray-300"></i>
                        </div>
                        <p id="petName" class="tw-mt-3 tw-text-lg tw-font-semibold tw-text-gray-900"></p>
                        <span id="petSpecies" class="tw-px-3 tw-py-1 tw-mt-2 tw-text-xs tw-rounded-full tw-text-white"></span>
                    </div>
                    
                    <!-- Pet Details Column -->
                    <div class="tw-flex-1">
                        <h4 class="tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-2">Pet Details</h4>
                        
                        <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-4 tw-mb-4">
                            <div>
                                <p class="tw-text-xs tw-text-gray-500">Breed</p>
                                <p id="petBreed" class="tw-text-sm tw-text-gray-900"></p>
                            </div>
                            <div>
                                <p class="tw-text-xs tw-text-gray-500">Gender</p>
                                <p id="petGender" class="tw-text-sm tw-text-gray-900"></p>
                            </div>
                            <div>
                                <p class="tw-text-xs tw-text-gray-500">Age</p>
                                <p id="petAge" class="tw-text-sm tw-text-gray-900"></p>
                            </div>
                            <div>
                                <p class="tw-text-xs tw-text-gray-500">Weight</p>
                                <p id="petWeight" class="tw-text-sm tw-text-gray-900"></p>
                            </div>
                        </div>
                        
                        <!-- Vaccination Status -->
                        <div class="tw-mt-4 tw-mb-4">
                            <p class="tw-text-xs tw-text-gray-500">Vaccination Status</p>
                            <div id="petVaccinationStatus" class="tw-flex tw-items-center tw-gap-2 tw-mt-1">
                                <i class="fas fa-syringe tw-text-gray-500"></i>
                                <span id="vaccinationText" class="tw-text-sm tw-text-gray-900"></span>
                            </div>
                        </div>
                        
                        <!-- Medical Information -->
                        <div class="tw-mt-6">
                            <h4 class="tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-2">Medical Information</h4>
                            
                            <div class="tw-mt-3">
                                <p class="tw-text-xs tw-text-gray-500">Medical History</p>
                                <p id="petMedicalHistory" class="tw-text-sm tw-text-gray-900 tw-bg-gray-50 tw-p-3 tw-rounded-lg tw-mt-1 tw-border tw-border-gray-200"></p>
                            </div>
                            
                            <div class="tw-mt-3">
                                <p class="tw-text-xs tw-text-gray-500">Allergies</p>
                                <p id="petAllergies" class="tw-text-sm tw-text-gray-900 tw-bg-gray-50 tw-p-3 tw-rounded-lg tw-mt-1 tw-border tw-border-gray-200"></p>
                            </div>
                            
                            <div class="tw-mt-3">
                                <p class="tw-text-xs tw-text-gray-500">Notes</p>
                                <p id="view-petNotes" class="tw-text-sm tw-text-gray-900 tw-bg-gray-50 tw-p-3 tw-rounded-lg tw-mt-1 tw-border tw-border-gray-200"></p>
                            </div>
                        </div>
                        
                        <!-- Recent Activity
                        <div class="tw-mt-6 tw-p-3 tw-bg-blue-50 tw-rounded-lg tw-border tw-border-blue-100">
                            <h4 class="tw-text-sm tw-font-medium tw-text-blue-800 tw-mb-2">
                                <i class="fas fa-calendar-alt tw-mr-2"></i> Recent Activity
                            </h4>
                            <div id="recentActivity" class="tw-text-sm tw-text-gray-700">
                                <p class="tw-text-center tw-text-gray-500 tw-text-xs">Loading recent activities...</p>
                            </div>
                        </div> -->
                    </div>
                </div>
                
                <!-- Actions Section -->
                <div class="tw-flex tw-justify-between tw-mt-8 tw-pt-4 tw-border-t tw-border-gray-200">
                    <button id="bookAppointmentBtn" class="tw-opacity-0 tw-text-white tw-bg-[#24CFF4] hover:tw-bg-[#00b8dd] tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center tw-flex tw-items-center">
                        <i class="fas fa-calendar-plus tw-mr-2"></i> Book Appointment
                    </button>
                    
                    <div class="tw-flex tw-gap-2">
                        <button id="editPetBtn" class="tw-text-gray-900 tw-bg-white tw-border tw-border-gray-300 hover:tw-bg-gray-100 tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center tw-flex tw-items-center">
                            <i class="fas fa-edit tw-mr-2"></i> Edit
                        </button>
                        
                        <button id="deletePetBtn" class="tw-text-white tw-bg-red-600 hover:tw-bg-red-700 tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center tw-flex tw-items-center">
                            <i class="fas fa-trash-alt tw-mr-2"></i> Delete
                        </button>
                    </div>
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
        // Show the modal
        const viewPetModal = document.getElementById('viewPet-modal');
        if (!viewPetModal) {
            console.error('View pet modal not found in DOM');
            return;
        }
        
        // Show modal with loading indicator
        viewPetModal.classList.remove('tw-hidden');
        
        // Fetch pet data using route helper
        fetch(`{{ route('user.pets.show', ['id' => ':id']) }}`.replace(':id', petId), {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
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
            
            // Load recent activities for this pet
            // loadRecentActivities(petId);
        })
        .catch(error => {
            console.error('Error fetching pet data:', error);
            Swal.fire({
                title: 'Error!',
                text: 'Failed to load pet data',
                icon: 'error',
                confirmButtonColor: '#24CFF4'
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
            vaccinationText.innerHTML = `<span class="tw-text-green-600">Vaccinated</span>`;
            if (pet.lastVaccinationDate) {
                vaccinationText.innerHTML += ` <span class="tw-text-xs tw-text-gray-500">(Last vaccination: ${formatDate(pet.lastVaccinationDate)})</span>`;
            }
        } else {
            vaccinationText.innerHTML = `<span class="tw-text-red-500">Not Vaccinated</span>`;
        }
        
        // Set species with appropriate color
        const speciesBadge = document.getElementById('petSpecies');
        speciesBadge.textContent = pet.species;
        
        // Set color based on species
        if (pet.species.toLowerCase() === 'dog') {
            speciesBadge.classList.add('tw-bg-green-500');
            speciesBadge.classList.remove('tw-bg-yellow-500', 'tw-bg-purple-500');
        } else if (pet.species.toLowerCase() === 'cat') {
            speciesBadge.classList.add('tw-bg-yellow-500');
            speciesBadge.classList.remove('tw-bg-green-500', 'tw-bg-purple-500');
        } else {
            speciesBadge.classList.add('tw-bg-purple-500');
            speciesBadge.classList.remove('tw-bg-green-500', 'tw-bg-yellow-500');
        }
        
        // Set pet image
        const petImage = document.getElementById('petImage');
        if (pet.petImage) {
            // Use Laravel's asset helper
            let imageUrl = "{{ asset('storage/') }}/" + pet.petImage;
            
            petImage.innerHTML = `<img src="${imageUrl}" alt="${pet.name}" class="tw-h-full tw-w-full tw-object-cover">`;
        } else {
            // Default icon based on species
            let speciesIcon = '<i class="fas fa-paw tw-text-4xl tw-text-gray-300"></i>';
            
            if (pet.species.toLowerCase() === 'dog') {
                speciesIcon = '<i class="fas fa-dog tw-text-4xl tw-text-gray-300"></i>';
            } else if (pet.species.toLowerCase() === 'cat') {
                speciesIcon = '<i class="fas fa-cat tw-text-4xl tw-text-gray-300"></i>';
            }
            
            petImage.innerHTML = speciesIcon;
        }
        
        // Initialize button handlers
        setupButtonHandlers();
    }
    
    
    // Helper function for status colors
    function getStatusClass(status) {
        switch(status?.toLowerCase()) {
            case 'completed':
                return 'tw-bg-green-100 tw-text-green-800';
            case 'confirmed':
                return 'tw-bg-blue-100 tw-text-blue-800';
            case 'cancelled':
                return 'tw-bg-red-100 tw-text-red-800';
            case 'active':
                return 'tw-bg-yellow-100 tw-text-yellow-800';
            default:
                return 'tw-bg-gray-100 tw-text-gray-800';
        }
    }
    
    // Set up button handlers
    function setupButtonHandlers() {
        // Book appointment button
        const bookAppointmentBtn = document.getElementById('bookAppointmentBtn');
        if (bookAppointmentBtn) {
            bookAppointmentBtn.addEventListener('click', function() {
                // Close the modal
                document.getElementById('viewPet-modal').classList.add('tw-hidden');
                
                // Open the appointment modal if it exists
                if (typeof window.openAppointmentModal === 'function' && window.currentPetData) {
                    window.openAppointmentModal(window.currentPetData.petID);
                } else {
                    // If the function doesn't exist, navigate to the appointment page
                    window.location.href = "{{ route('dashboard') }}";
                }
            });
        }
        
        // Edit pet button
        const editPetBtn = document.getElementById('editPetBtn');
        if (editPetBtn) {
            editPetBtn.addEventListener('click', function() {
                if (window.currentPetData) {
                    // Close this modal
                    document.getElementById('viewPet-modal').classList.add('tw-hidden');
                    
                    // Call the edit function if it exists
                    if (typeof window.editPet === 'function') {
                        window.editPet(window.currentPetData.petID);
                    }
                }
            });
        }
        
        // Delete pet button
        const deletePetBtn = document.getElementById('deletePetBtn');
        if (deletePetBtn) {
            deletePetBtn.addEventListener('click', function() {
                if (window.currentPetData) {
                    // Call the delete function if it exists
                    if (typeof window.deletePet === 'function') {
                        window.deletePet(window.currentPetData.petID);
                    }
                }
            });
        }
        
        // Close modal handler
        const modalToggle = document.querySelector('[data-modal-toggle="viewPet-modal"]');
        if (modalToggle) {
            modalToggle.addEventListener('click', function() {
                document.getElementById('viewPet-modal').classList.add('tw-hidden');
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
    
    // Initialize event listeners for both DOMContentLoaded and contentChanged
    ['DOMContentLoaded', 'contentChanged'].forEach(eventName => {
        document.addEventListener(eventName, function() {
            // Any initialization code needed for the pet view modal
            console.log('Pet view modal initialized');
        });
    });
});
</script>
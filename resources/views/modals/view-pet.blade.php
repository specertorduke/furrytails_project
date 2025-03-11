<!-- View Pet Modal -->
<div id="viewPet-modal" tabindex="-1" aria-hidden="true" class="tw-hidden tw-fixed tw-top-0 tw-left-0 tw-right-0 tw-z-50 tw-w-full tw-p-4 tw-overflow-x-hidden tw-overflow-y-auto md:tw-inset-0 tw-h-full tw-max-h-full tw-flex tw-items-center tw-justify-center tw-backdrop-blur-sm tw-bg-black/60">
     <div class="tw-relative tw-w-full tw-max-w-2xl tw-max-h-full tw-animate-modal-entry">
         <!-- Modal content -->
         <div class="tw-relative tw-bg-gray-800 tw-rounded-lg tw-shadow-sm">
             <!-- Modal header -->
             <div class="tw-flex tw-items-center tw-justify-between tw-p-4 md:tw-p-5 tw-border-b tw-rounded-t tw-border-gray-700">
                 <h3 class="tw-text-lg tw-font-semibold tw-text-white">Pet Details</h3>
                 <button type="button" class="tw-text-gray-400 tw-bg-transparent hover:tw-bg-gray-700 hover:tw-text-white tw-rounded-lg tw-text-sm tw-w-8 tw-h-8 tw-flex tw-justify-center tw-items-center" data-modal-toggle="viewPet-modal">
                     <i class="fas fa-times"></i>
                 </button>
             </div>
 
             <!-- Modal body -->
             <div class="tw-p-4 md:tw-p-5">
                 <!-- Pet Info Section -->
                 <div class="tw-flex tw-flex-col md:tw-flex-row tw-gap-6">
                     <!-- Pet Image Column -->
                     <div class="tw-flex tw-flex-col tw-items-center">
                         <div id="petImage" class="tw-h-40 tw-w-40 tw-rounded-full tw-bg-gray-700 tw-flex tw-items-center tw-justify-center tw-overflow-hidden">
                             <!-- Image will be set via JavaScript -->
                             <i class="fas fa-paw tw-text-4xl tw-text-gray-500"></i>
                         </div>
                         <h2 id="petName" class="tw-mt-3 tw-text-lg tw-font-semibold tw-text-white"></h2>
                         <span id="petSpecies" class="tw-px-3 tw-py-1 tw-mt-2 tw-text-xs tw-rounded-full tw-text-white"></span>
                     </div>
 
                     <!-- Pet Details Column -->
                     <div class="tw-flex-1">
                         <!-- Basic Information -->
                         <div class="tw-mb-6">
                             <h4 class="tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-3">Basic Information</h4>
                             <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-4">
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
                         </div>
 
                         <!-- Vaccination Status -->
                         <div class="tw-mb-6">
                             <h4 class="tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-2">Vaccination Status</h4>
                             <div id="vaccinationStatus" class="tw-flex tw-items-center tw-gap-2">
                                 <i class="fas fa-syringe tw-text-gray-500"></i>
                                 <span id="vaccinationText" class="tw-text-sm tw-text-white"></span>
                             </div>
                         </div>
 
                         <!-- Medical Information -->
                         <div class="tw-mb-6">
                             <h4 class="tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-3">Medical Information</h4>
                             <div class="tw-space-y-4">
                                 <div>
                                     <p class="tw-text-xs tw-text-gray-400">Medical History</p>
                                     <p id="petMedicalHistory" class="tw-text-sm tw-text-white tw-bg-gray-700/50 tw-p-3 tw-rounded-lg tw-mt-1"></p>
                                 </div>
                                 <div>
                                     <p class="tw-text-xs tw-text-gray-400">Allergies</p>
                                     <p id="petAllergies" class="tw-text-sm tw-text-white tw-bg-gray-700/50 tw-p-3 tw-rounded-lg tw-mt-1"></p>
                                 </div>
                                 <div>
                                     <p class="tw-text-xs tw-text-gray-400">Additional Notes</p>
                                     <p id="petNotes" class="tw-text-sm tw-text-white tw-bg-gray-700/50 tw-p-3 tw-rounded-lg tw-mt-1"></p>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
 
             <!-- Modal footer -->
             <div class="tw-flex tw-justify-end tw-gap-3 tw-p-4 md:tw-p-5 tw-border-t tw-border-gray-700">
                 <button type="button" class="tw-text-white tw-bg-blue-600 hover:tw-bg-blue-700 tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5" onclick="editPet(currentPetData.petID)">
                     <i class="fas fa-edit tw-mr-2"></i>Edit
                 </button>
                 <button type="button" class="tw-text-gray-300 tw-bg-gray-700 hover:tw-bg-gray-600 tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5" data-modal-toggle="viewPet-modal">
                     Close
                 </button>
             </div>
         </div>
     </div>
 </div>
 
 <script>
 document.addEventListener('DOMContentLoaded', function() {
     let currentPetData = null;
 
     // Function to open pet modal
     window.openPetModal = function(petId) {
         const modal = document.getElementById('viewPet-modal');
         modal.classList.remove('tw-hidden');
 
         // Fetch pet data
         fetch(`/pets/${petId}`, {
             headers: {
                 'Accept': 'application/json',
                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
             }
         })
         .then(response => response.json())
         .then(data => {
             if (data.success) {
                 currentPetData = data.pet;
                 populatePetData(data.pet);
             }
         })
         .catch(error => {
             console.error('Error fetching pet data:', error);
             Swal.fire({
                 title: 'Error!',
                 text: 'Failed to load pet data',
                 icon: 'error',
                 confirmButtonColor: '#24CFF4'
             });
         });
     };
 
     // Function to populate pet data
     function populatePetData(pet) {
         // Set basic information
         document.getElementById('petName').textContent = pet.name;
         document.getElementById('petBreed').textContent = pet.breed || 'Not specified';
         document.getElementById('petGender').textContent = pet.gender || 'Not specified';
         document.getElementById('petWeight').textContent = pet.weight ? `${pet.weight} kg` : 'Not specified';
         
         // Set species with appropriate color
         const speciesBadge = document.getElementById('petSpecies');
         speciesBadge.textContent = pet.species;
         
         // Set color based on species
         if (pet.species.toLowerCase() === 'dog') {
             speciesBadge.className = 'tw-px-3 tw-py-1 tw-mt-2 tw-text-xs tw-rounded-full tw-text-white tw-bg-green-600';
         } else if (pet.species.toLowerCase() === 'cat') {
             speciesBadge.className = 'tw-px-3 tw-py-1 tw-mt-2 tw-text-xs tw-rounded-full tw-text-white tw-bg-yellow-600';
         } else {
             speciesBadge.className = 'tw-px-3 tw-py-1 tw-mt-2 tw-text-xs tw-rounded-full tw-text-white tw-bg-purple-600';
         }
 
         // Calculate and set age
         if (pet.birthDate) {
             const birthDate = new Date(pet.birthDate);
             const ageInMonths = calculateAgeInMonths(birthDate);
             document.getElementById('petAge').textContent = formatAgeText(ageInMonths);
         } else {
             document.getElementById('petAge').textContent = 'Not specified';
         }
 
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
 
         // Set medical information
         document.getElementById('petMedicalHistory').textContent = pet.medicalHistory || 'No medical history recorded';
         document.getElementById('petAllergies').textContent = pet.allergies || 'No allergies recorded';
         document.getElementById('petNotes').textContent = pet.petNotes || 'No additional notes';
 
         // Set pet image
         const petImage = document.getElementById('petImage');
         if (pet.petImage) {
             let imageUrl = pet.petImage.startsWith('storage/') 
                 ? `/storage/${pet.petImage}` 
                 : `/storage/${pet.petImage}`;
             petImage.innerHTML = `<img src="${imageUrl}" alt="${pet.name}" class="tw-h-full tw-w-full tw-object-cover">`;
         } else {
             let speciesIcon = '<i class="fas fa-paw tw-text-4xl tw-text-gray-500"></i>';
             if (pet.species.toLowerCase() === 'dog') {
                 speciesIcon = '<i class="fas fa-dog tw-text-4xl tw-text-gray-500"></i>';
             } else if (pet.species.toLowerCase() === 'cat') {
                 speciesIcon = '<i class="fas fa-cat tw-text-4xl tw-text-gray-500"></i>';
             }
             petImage.innerHTML = speciesIcon;
         }
     }
 
     // Utility functions
     function calculateAgeInMonths(birthDate) {
         const today = new Date();
         let months = (today.getFullYear() - birthDate.getFullYear()) * 12;
         months -= birthDate.getMonth();
         months += today.getMonth();
         return months <= 0 ? 0 : months;
     }
 
     function formatAgeText(months) {
         if (months < 1) return 'Less than 1 month';
         if (months < 12) return `${months} month${months > 1 ? 's' : ''}`;
         
         const years = Math.floor(months / 12);
         const remainingMonths = months % 12;
         
         if (remainingMonths === 0) return `${years} year${years > 1 ? 's' : ''}`;
         return `${years} year${years > 1 ? 's' : ''}, ${remainingMonths} month${remainingMonths > 1 ? 's' : ''}`;
     }
 
     function formatDate(dateString) {
         if (!dateString) return '';
         const date = new Date(dateString);
         return date.toLocaleDateString('en-US', { 
             year: 'numeric', 
             month: 'long', 
             day: 'numeric'
         });
     }
 
     // Modal close handlers
     document.querySelectorAll('[data-modal-toggle="viewPet-modal"]').forEach(element => {
         element.addEventListener('click', () => {
             document.getElementById('viewPet-modal').classList.add('tw-hidden');
         });
     });
 });
 </script>
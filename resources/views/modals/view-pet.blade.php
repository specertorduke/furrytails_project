<!-- View Pet Modal -->
<div id="viewPet-modal" tabindex="-1" aria-hidden="true" class="tw-hidden tw-fixed tw-top-0 tw-left-0 tw-right-0 tw-z-50 tw-w-full tw-p-4 tw-overflow-x-hidden tw-overflow-y-auto md:tw-inset-0 tw-h-full tw-max-h-full tw-flex tw-items-center tw-justify-center tw-backdrop-blur-sm tw-bg-black/30">
    <div class="tw-relative tw-w-full tw-max-w-md tw-max-h-full tw-animate-modal-entry">
        <!-- Modal content -->
        <div class="tw-relative tw-bg-white tw-rounded-lg tw-shadow-sm dark:tw-bg-gray-700 tw-transform tw-transition-all">
            <!-- Modal header -->
            <div class="tw-flex tw-items-center tw-justify-between tw-p-4 md:tw-p-5 tw-border-b tw-rounded-t dark:tw-border-gray-600 tw-border-gray-200">
                <h3 class="tw-text-lg tw-font-semibold tw-text-gray-900 dark:tw-text-white">Pet Details</h3>
                <button type="button" class="tw-text-gray-400 hover:tw-text-gray-900 dark:hover:tw-text-white" data-modal-hide="viewPet-modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <!-- Modal body -->
            <div class="tw-p-4 md:tw-p-5">
                <div class="tw-flex tw-flex-col tw-items-center tw-mb-4">
                    <img id="petImage" src="" alt="Pet Image" class="tw-w-32 tw-h-32 tw-rounded-full tw-object-cover tw-mb-4">
                    <h4 id="petName" class="tw-text-xl tw-font-semibold tw-text-gray-900 dark:tw-text-white"></h4>
                    <p id="petType" class="tw-text-sm tw-text-gray-500 dark:tw-text-gray-400"></p>
                </div>
                <div class="tw-space-y-2">
                    <div class="tw-flex tw-items-center tw-gap-2">
                        <i class="fas fa-paw tw-text-gray-400"></i>
                        <span id="petSpecies" class="tw-text-sm tw-text-gray-600 dark:tw-text-gray-300"></span>
                    </div>
                    <div class="tw-flex tw-items-center tw-gap-2">
                        <i class="fas fa-venus-mars tw-text-gray-400"></i>
                        <span id="petGender" class="tw-text-sm tw-text-gray-600 dark:tw-text-gray-300"></span>
                    </div>
                    <div class="tw-flex tw-items-center tw-gap-2">
                        <i class="fas fa-birthday-cake tw-text-gray-400"></i>
                        <span id="petBirthDate" class="tw-text-sm tw-text-gray-600 dark:tw-text-gray-300"></span>
                    </div>
                    <div class="tw-flex tw-items-center tw-gap-2">
                        <i class="fas fa-weight tw-text-gray-400"></i>
                        <span id="petWeight" class="tw-text-sm tw-text-gray-600 dark:tw-text-gray-300"></span>
                    </div>
                    <div class="tw-flex tw-items-center tw-gap-2">
                        <i class="fas fa-syringe tw-text-gray-400"></i>
                        <span id="petVaccinationStatus" class="tw-text-sm tw-text-gray-600 dark:tw-text-gray-300"></span>
                    </div>
                    <div class="tw-flex tw-items-center tw-gap-2">
                        <i class="fas fa-notes-medical tw-text-gray-400"></i>
                        <span id="petMedicalHistory" class="tw-text-sm tw-text-gray-600 dark:tw-text-gray-300"></span>
                    </div>
                    <div class="tw-flex tw-items-center tw-gap-2">
                        <i class="fas fa-allergies tw-text-gray-400"></i>
                        <span id="petAllergies" class="tw-text-sm tw-text-gray-600 dark:tw-text-gray-300"></span>
                    </div>
                    <div class="tw-flex tw-items-center tw-gap-2">
                        <i class="fas fa-sticky-note tw-text-gray-400"></i>
                        <span id="petNotes" class="tw-text-sm tw-text-gray-600 dark:tw-text-gray-300"></span>
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="tw-flex tw-items-center tw-justify-end tw-p-4 md:tw-p-5 tw-border-t tw-rounded-b dark:tw-border-gray-600 tw-border-gray-200">
                <button type="button" class="tw-bg-[#24CFF4] tw-text-white tw-px-4 tw-py-2 tw-rounded-xl tw-transition-all tw-duration-300 hover:tw-shadow-lg hover:tw-opacity-90" data-modal-hide="viewPet-modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function viewPet(petId) {
        fetch(`/pets/${petId}/edit`)
            .then(response => response.json())
            .then(pet => {
                document.getElementById('petImage').src = `/storage/${pet.petImage}`;
                document.getElementById('petName').textContent = pet.name;
                document.getElementById('petType').textContent = pet.petType;
                document.getElementById('petSpecies').textContent = pet.species;
                document.getElementById('petGender').textContent = pet.gender;
                document.getElementById('petBirthDate').textContent = new Date(pet.birthDate).toLocaleDateString();
                document.getElementById('petWeight').textContent = `${pet.weight} kg`;
                document.getElementById('petVaccinationStatus').textContent = pet.isVaccinated ? 'Vaccinated' : 'Not Vaccinated';
                document.getElementById('petMedicalHistory').textContent = pet.medicalHistory || 'No medical history';
                document.getElementById('petAllergies').textContent = pet.allergies || 'No allergies';
                document.getElementById('petNotes').textContent = pet.petNotes || 'No notes';
                document.getElementById('viewPet-modal').classList.remove('tw-hidden');
            })
            .catch(error => console.error('Error fetching pet data:', error));
    }
</script>
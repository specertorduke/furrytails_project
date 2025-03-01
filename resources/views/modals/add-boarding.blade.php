<!-- Main modal -->
<div id="addBoarding-modal" tabindex="-1" aria-hidden="true" class="tw-hidden tw-fixed tw-top-0 tw-left-0 tw-right-0 tw-z-50 tw-w-full tw-p-4 tw-overflow-x-hidden tw-overflow-y-auto md:tw-inset-0 tw-h-full tw-max-h-full tw-flex tw-items-center tw-justify-center tw-backdrop-blur-sm tw-bg-black/30">
    <div class="tw-relative tw-w-full tw-max-w-md tw-max-h-full tw-animate-modal-entry">
        <!-- Modal content -->
        <div class="tw-relative tw-bg-white tw-rounded-lg tw-shadow-sm dark:tw-bg-gray-700 tw-transform tw-transition-all">
            <!-- Modal header -->
            <div class="tw-flex tw-items-center tw-justify-between tw-p-4 md:tw-p-5 tw-border-b tw-rounded-t dark:tw-border-gray-600 tw-border-gray-200">
                <h3 class="tw-text-lg tw-font-semibold tw-text-gray-900 dark:tw-text-white">Add Pet Boarding</h3>
                <button type="button" class="tw-text-gray-400 tw-bg-transparent tw-hover:tw-bg-gray-200 tw-hover:tw-text-gray-900 tw-rounded-lg tw-text-sm tw-w-8 tw-h-8 ms-auto tw-inline-flex tw-justify-center tw-items-center dark:tw-hover:tw-bg-gray-600 dark:tw-hover:tw-text-white" data-modal-toggle="addBoarding-modal">
                    <svg class="tw-w-3 tw-h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="tw-p-4 md:tw-p-5">
                <div class="tw-grid tw-gap-4 tw-mb-4 tw-grid-cols-2">
                    <div class="tw-col-span-2">
                        <label for="selected-pet" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900 dark:tw-text-white">Pet Name</label>
                        <select id="selected-pet" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-primary-500 tw-focus:tw-border-primary-500 tw-block tw-w-full tw-p-2.5 dark:tw-bg-gray-600 dark:tw-border-gray-500 dark:tw-placeholder-gray-400 dark:tw-text-white dark:tw-focus:tw-ring-primary-500 dark:tw-focus:tw-border-primary-500">
                            <option selected="">Select Pet</option>
                            <option value="1">Buddy</option>
                            <option value="2">Moodeng</option>
                            <option value="3">Max</option>
                        </select>                    
                    </div>
                    <div class="tw-col-span-2">
                        <label for="boarding-tier" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900 dark:tw-text-white">Boarding Tier</label>
                        <select id="boarding-tier" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-primary-500 tw-focus:tw-border-primary-500 tw-block tw-w-full tw-p-2.5 dark:tw-bg-gray-600 dark:tw-border-gray-500 dark:tw-placeholder-gray-400 dark:tw-text-white dark:tw-focus:tw-ring-primary-500 dark:tw-focus:tw-border-primary-500">
                            <option value="" selected>Select Tier</option>
                            <option value="daycare">Daycare</option>
                            <option value="overnight">Overnight</option>
                            <option value="long-term">Long-term Boarding</option>
                        </select>
                    </div>
                    <div id="date-fields" class="tw-hidden tw-col-span-2">
                        <div class="tw-grid tw-grid-cols-2 tw-gap-4">
                            <div class="tw-col-span-2 sm:tw-col-span-1">
                                <label for="start-date" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900 dark:tw-text-white">Start Date</label>
                                <input type="date" name="start-date" id="start-date" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-primary-600 tw-focus:tw-border-primary-600 tw-block tw-w-full tw-p-2.5 dark:tw-bg-gray-600 dark:tw-border-gray-500 dark:tw-placeholder-gray-400 dark:tw-text-white dark:tw-focus:tw-ring-primary-500 dark:tw-focus:tw-border-primary-500" required="">
                            </div>
                            <div class="tw-col-span-2 sm:tw-col-span-1">
                                <label for="end-date" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900 dark:tw-text-white">End Date</label>
                                <input type="date" name="end-date" id="end-date" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-primary-600 tw-focus:tw-border-primary-600 tw-block tw-w-full tw-p-2.5 dark:tw-bg-gray-600 dark:tw-border-gray-500 dark:tw-placeholder-gray-400 dark:tw-text-white dark:tw-focus:tw-ring-primary-500 dark:tw-focus:tw-border-primary-500" required="">
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="tw-text-white tw-inline-flex tw-items-center tw-bg-[#24CFF4] hover:tw-bg-[#63e4fd] focus:tw-outline-none focus:tw-bg-[#038cb7] tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center">
                    <svg class="tw-me-1 tw--ms-1 tw-w-5 tw-h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    <span>Proceed to Payment</span>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const boardingModal = document.getElementById('addBoarding-modal');
    const boardingTierSelect = document.getElementById('boarding-tier');
    const dateFields = document.getElementById('date-fields');
    const start_date = document.getElementById('start-date');
    const end_date = document.getElementById('end-date');
    const form = boardingModal.querySelector('form');

    // Reset date fields on page load
    dateFields.classList.add('tw-hidden');
    start_date.removeAttribute('required');
    end_date.removeAttribute('required');

    // Handle boarding tier changes
    boardingTierSelect.addEventListener('change', function() {
        if (this.value === 'long-term') {
            dateFields.classList.remove('tw-hidden');
            start_date.setAttribute('required', '');
            end_date.setAttribute('required', '');
        } else {
            dateFields.classList.add('tw-hidden');
            start_date.removeAttribute('required');
            end_date.removeAttribute('required');
            start_date.value = '';
            end_date.value = '';
        }
    });

    // Handle form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Check if all required fields are filled
        const pet = document.getElementById('selected-pet').value;
        const tier = document.getElementById('boarding-tier').value;
        
        if (!pet || pet === 'Select Pet' || !tier || tier === 'Select Tier') {
            Swal.fire({
                title: 'Missing Information',
                text: 'Please fill in all required fields',
                icon: 'warning',
                confirmButtonColor: '#24CFF4',
                confirmButtonText: 'OK'
            });
            return;
        }

        // Additional validation for long-term boarding
        if (tier === 'long-term' && (!start_date.value || !end_date.value)) {
            Swal.fire({
                title: 'Missing Dates',
                text: 'Please select both start and end dates',
                icon: 'warning',
                confirmButtonColor: '#24CFF4',
                confirmButtonText: 'OK'
            });
            return;
        }

        // Show confirmation dialog
        Swal.fire({
            title: 'Confirm Boarding',
            text: 'Would you like to proceed with the payment?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#24CFF4',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, proceed',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Get payment modal and update its content
                const paymentModal = document.getElementById('payment-modal');
                if (paymentModal) {
                    const modalTitle = paymentModal.querySelector('#modal-title');
                    const detailsLabel = paymentModal.querySelector('#details-label');
                    const submitButtonText = paymentModal.querySelector('#submit-button-text');
                    const boardingDetails = paymentModal.querySelector('#appointment-details');
                    
                    // Get selected values
                    const petName = document.getElementById('selected-pet').options[document.getElementById('selected-pet').selectedIndex].text;
                    
                    // Update modal text
                    if (modalTitle) modalTitle.textContent = 'Boarding Payment';
                    if (detailsLabel) detailsLabel.textContent = 'Boarding';
                    if (submitButtonText) submitButtonText.textContent = 'Add Boarding';
                    if (boardingDetails) {
                        let details = `Pet: ${petName}\nTier: ${tier}`;
                        if (tier === 'long-term') {
                            details += `\nStart Date: ${start_date.value}\nEnd Date: ${end_date.value}`;
                        }
                        boardingDetails.value = details;
                    }
                    
                    // Hide boarding modal
                    boardingModal.classList.add('tw-hidden');
                    
                    // Show payment modal
                    setTimeout(() => {
                        paymentModal.classList.remove('tw-hidden');
                    }, 100);
                }
            }
        });
    });

    // Handle close button
    const closeBtn = boardingModal.querySelector('[data-modal-toggle="addBoarding-modal"]');
    if (closeBtn) {
        closeBtn.addEventListener('click', function() {
            boardingModal.classList.add('tw-hidden');
        });
    }
});
</script>
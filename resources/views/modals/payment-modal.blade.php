<!-- Main modal -->
<div id="payment-modal" tabindex="-1" aria-hidden="true" class="tw-hidden tw-fixed tw-top-0 tw-left-0 tw-right-0 tw-z-50 tw-w-full tw-p-4 tw-overflow-x-hidden tw-overflow-y-auto md:tw-inset-0 tw-h-full tw-max-h-full tw-flex tw-items-center tw-justify-center tw-backdrop-blur-sm tw-bg-black/30">
    <div class="tw-relative tw-w-full tw-max-w-md tw-max-h-full tw-animate-modal-entry">
        <!-- Modal content -->
        <div class="tw-relative tw-bg-white tw-rounded-lg tw-shadow-sm dark:tw-bg-gray-700 tw-transform tw-transition-all">
            <!-- Modal header -->
            <div class="tw-flex tw-items-center tw-justify-between tw-p-4 md:tw-p-5 tw-border-b tw-rounded-t dark:tw-border-gray-600 tw-border-gray-200">
                <h3 class="tw-text-lg tw-font-semibold tw-text-gray-900 dark:tw-text-white">Payment</h3>
                <button type="button" class="tw-text-gray-400 tw-bg-transparent tw-hover:tw-bg-gray-200 tw-hover:tw-text-gray-900 tw-rounded-lg tw-text-sm tw-w-8 tw-h-8 ms-auto tw-inline-flex tw-justify-center tw-items-center dark:tw-hover:tw-bg-gray-600 dark:tw-hover:tw-text-white" data-modal-toggle="payment-modal">
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
                        <label for="appointment-details" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900 dark:tw-text-white">
                            <span id="details-label">Appointment</span> Details
                        </label>
                        <textarea id="appointment-details" rows="4" class="tw-block tw-p-2.5 tw-w-full tw-text-sm tw-text-gray-900 tw-bg-gray-50 tw-rounded-lg tw-border tw-border-gray-300 tw-focus:tw-ring-primary-500 tw-focus:tw-border-primary-500 dark:tw-bg-gray-600 dark:tw-border-gray-500 dark:tw-placeholder-gray-400 dark:tw-text-white dark:tw-focus:tw-ring-primary-500 dark:tw-focus:tw-border-primary-500" placeholder="Details of the appointment or boarding..."></textarea>
                    </div>
                    <div class="tw-col-span-2">
                        <label for="price" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900 dark:tw-text-white">Price</label>
                        <div id="price" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-p-2.5 dark:tw-bg-gray-600 dark:tw-border-gray-500 dark:tw-placeholder-gray-400 dark:tw-text-white">
                            <!-- Display the predetermined price here -->
                            <?php
                            $price = 0; // Default price
                            $appointmentPrice = 0; // Default price
                            $boardingTierPrice = 0; // Default price
                            if (isset($isBoarding) && $isBoarding) {
                                $price = $boardingTierPrice * $numberOfDays; // Calculate boarding price
                            } else {
                                $price = $appointmentPrice; // Appointment price
                            }
                            echo "₱" . number_format($price, 2);
                            ?>
                        </div>
                    </div>
                    <div class="tw-col-span-2">
                        <label for="payment-method" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900 dark:tw-text-white">Payment Method</label>
                        <select id="payment-method" name="payment-method" class="tw-block tw-w-full tw-p-2.5 tw-text-sm tw-text-gray-900 tw-bg-gray-50 tw-rounded-lg tw-border tw-border-gray-300 tw-focus:tw-ring-primary-500 tw-focus:tw-border-primary-500 dark:tw-bg-gray-600 dark:tw-border-gray-500 dark:tw-placeholder-gray-400 dark:tw-text-white dark:tw-focus:tw-ring-primary-500 dark:tw-focus:tw-border-primary-500">
                            <option value="" selected>Select Method</option>
                            <option value="walk-in">Walk-in Pay</option>
                            <option value="gcash">GCash</option>
                            <option value="debit-card">Debit Card</option>
                            <option value="credit-card">Credit Card</option>
                        </select>
                    </div>
                    <div id="payment-fields" class="tw-col-span-2">
                        <!-- Dynamic payment fields will be inserted here -->
                    </div>                    
                </div>
                <button type="submit" data-modal-target="confirm-modal" data-modal-toggle="confirm-modal" class="tw-text-white tw-inline-flex tw-items-center tw-bg-[#24CFF4] hover:tw-bg-[#63e4fd] focus:tw-outline-none focus:tw-bg-[#038cb7] tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center dark:bg-blue-600 dark:hover:tw-bg-blue-700 dark:focus:tw-ring-blue-800">
                    <svg class="tw-me-1 tw--ms-1 tw-w-5 tw-h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    <span id="submit-button-text">Add Appointment</span>
                </button>
            </form>
        </div>
    </div>
</div>

@include('modals.confirmation')
@include('modals.success')

<script>
document.addEventListener('DOMContentLoaded', function() {
    const paymentModal = document.getElementById('payment-modal');
    const submitButtonText = document.getElementById('submit-button-text');
    const modalTitle = document.getElementById('modal-title');
    const detailsLabel = document.getElementById('details-label');

    document.addEventListener('click', function(e) {
        if (e.target.dataset.modalTarget === 'payment-modal') {
            const isBoarding = e.target.dataset.isBoarding === 'true';
            const type = isBoarding ? 'Boarding' : 'Appointment';
            
            // Update all text elements
            submitButtonText.textContent = `Add ${type}`;
            modalTitle.textContent = type;
            detailsLabel.textContent = type;
        }
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Listen for payment modal button click to update confirmation modal
    document.addEventListener('click', function(e) {
        if (e.target.dataset.modalTarget === 'confirm-modal') {
            const isBoarding = document.querySelector('[data-is-boarding="true"]') !== null;
            const type = isBoarding ? 'boarding' : 'appointment';
            
            // Update confirmation modal text
            document.getElementById('confirm-type').textContent = type;
            
            // Update success modal text when confirm button is clicked
            document.getElementById('confirm-yes').addEventListener('click', function() {
                document.getElementById('success-type').textContent = type.charAt(0).toUpperCase() + type.slice(1);
            });
        }
    });
});
</script>
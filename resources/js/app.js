import './bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import 'flowbite';
import { Modal } from 'flowbite';
import 'flowbite/dist/flowbite.js';

// Move the modal initialization into a separate function
function initializeModals() {
    const modalIds = ['addAppointment-modal', 'payment-modal', 'addBoarding-modal', 'addPet-modal'];

    modalIds.forEach(modalId => {
        const $modalElement = document.querySelector(`#${modalId}`);
        
        const modalOptions = {
            onShow: (modal) => {
                modal._targetEl.classList.remove('tw-hidden');
                document.body.classList.add('tw-overflow-hidden');
                modal._targetEl.classList.add('tw-flex');
                modal._targetEl.setAttribute('aria-modal', 'true');
                modal._targetEl.setAttribute('role', 'dialog');
            },
            onHide: (modal) => {
                modal._targetEl.classList.add('tw-hidden');
                document.body.classList.remove('tw-overflow-hidden');
                modal._targetEl.classList.remove('tw-flex');
                modal._targetEl.setAttribute('aria-modal', 'false');
                modal._targetEl.removeAttribute('role');
            }
        };

        if ($modalElement) {
            const modal = new Modal($modalElement, modalOptions);
            
            // Handle modal triggers
            const modalToggles = document.querySelectorAll(`[data-modal-toggle="${modalId}"]`);
            modalToggles.forEach(toggle => {
                toggle.addEventListener('click', () => {
                    modal.toggle();
                });
            });
        }
    });
}

// Call on initial page load
document.addEventListener('DOMContentLoaded', initializeModals);

// Add event listener for page changes
document.addEventListener('contentChanged', initializeModals);

// Payment modal
document.addEventListener('DOMContentLoaded', function() {
    const paymentMethod = document.getElementById('payment-method');
    const paymentFields = document.getElementById('payment-fields');

    paymentMethod.addEventListener('change', function() {
        const selectedMethod = this.value;
        if (selectedMethod === 'walk-in') {
            paymentFields.innerHTML = '';
        } else if (selectedMethod === 'gcash') {
            paymentFields.innerHTML = `
                <div class="tw-col-span-2">
                    <label class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900 dark:tw-text-white">GCash Number</label>
                    <input type="text" name="gcash-number" class="tw-block tw-w-full tw-p-2.5 tw-text-sm tw-text-gray-900 tw-bg-gray-50 tw-rounded-lg tw-border tw-border-gray-300" required>
                </div>
                <div class="tw-col-span-2">
                    <label class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900 dark:tw-text-white">Account Name</label>
                    <input type="text" name="gcash-name" class="tw-block tw-w-full tw-p-2.5 tw-text-sm tw-text-gray-900 tw-bg-gray-50 tw-rounded-lg tw-border tw-border-gray-300" required>
                </div>`;
        } else if (selectedMethod === 'debit-card' || selectedMethod === 'credit-card') {
            paymentFields.innerHTML = `
                <div class="tw-col-span-2">
                    <label class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900 dark:tw-text-white">Card Number</label>
                    <input type="text" name="card-number" class="tw-block tw-w-full tw-p-2.5 tw-text-sm tw-text-gray-900 tw-bg-gray-50 tw-rounded-lg tw-border tw-border-gray-300" required>
                </div>
                <div class="tw-col-span-2 tw-grid tw-grid-cols-2 tw-gap-4">
                    <div>
                        <label class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900 dark:tw-text-white">Expiry Date</label>
                        <input type="text" name="card-expiry" placeholder="MM/YY" class="tw-block tw-w-full tw-p-2.5 tw-text-sm tw-text-gray-900 tw-bg-gray-50 tw-rounded-lg tw-border tw-border-gray-300" required>
                    </div>
                    <div>
                        <label class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900 dark:tw-text-white">CVV</label>
                        <input type="text" name="card-cvv" class="tw-block tw-w-full tw-p-2.5 tw-text-sm tw-text-gray-900 tw-bg-gray-50 tw-rounded-lg tw-border tw-border-gray-300" required>
                    </div>
                </div>
                <div class="tw-col-span-2">
                    <label class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900 dark:tw-text-white">Cardholder Name</label>
                    <input type="text" name="card-name" class="tw-block tw-w-full tw-p-2.5 tw-text-sm tw-text-gray-900 tw-bg-gray-50 tw-rounded-lg tw-border tw-border-gray-300" required>
                </div>`;
        }
    });
});

//confirmation and success modal
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('#payment-modal form');
    const confirmModal = document.getElementById('confirm-modal');
    const successModal = document.getElementById('success-modal');
    
    // Prevent default form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        // Show confirmation modal
        confirmModal.classList.remove('tw-hidden');
    });

    // Handle confirmation
    document.getElementById('confirm-yes').addEventListener('click', function() {
        // Hide confirmation modal
        confirmModal.classList.add('tw-hidden');
        
        // Here you would normally submit the form data
        // For example:
        // submitFormData();

        // Show success modal
        successModal.classList.remove('tw-hidden');
    });

    // Close button handlers
    document.querySelectorAll('[data-modal-hide]').forEach(button => {
        button.addEventListener('click', function() {
            const modalId = this.getAttribute('data-modal-hide');
            document.getElementById(modalId).classList.add('tw-hidden');
        });
    });
});

// Function to handle form submission (implement as needed)
function submitFormData() {
    // Add your form submission logic here
    // This could be an AJAX call to your backend
}
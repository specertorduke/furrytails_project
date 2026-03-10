import './bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import 'flowbite/dist/flowbite.js';
import 'datatables.net-bs5';
import 'datatables.net-buttons-bs5';
import 'datatables.net-buttons/js/buttons.print';

// ---------------------------------------------------------------------------
// Modal delegation — permanent fix for SPA dynamic content.
// Replaces Flowbite's per-element initialization (which breaks on DOM swaps).
// ONE listener on document handles every modal toggle/target/hide button,
// current or future, regardless of how the page was loaded.
// ---------------------------------------------------------------------------
(function () {
    function showModal(id) {
        var el = document.getElementById(id);
        if (!el) return;
        el.classList.remove('tw-hidden');
        el.setAttribute('aria-hidden', 'false');
        el.setAttribute('aria-modal', 'true');
        el.setAttribute('role', 'dialog');
        document.body.classList.add('tw-overflow-hidden');
    }

    function hideModal(id) {
        var el = document.getElementById(id);
        if (!el) return;
        el.classList.add('tw-hidden');
        el.setAttribute('aria-hidden', 'true');
        el.removeAttribute('aria-modal');
        el.removeAttribute('role');
        // Only unlock scroll if no other modals are still open
        if (!document.querySelector('[id$="-modal"]:not(.tw-hidden)')) {
            document.body.classList.remove('tw-overflow-hidden');
        }
    }

    // Exposed globally so page scripts can open/close modals programmatically
    window.ftModalShow = showModal;
    window.ftModalHide = hideModal;

    // Delegated click handler — catches data-modal-toggle, data-modal-target, data-modal-hide
    document.addEventListener('click', function (e) {
        var trigger = e.target.closest('[data-modal-toggle],[data-modal-target],[data-modal-hide]');
        if (!trigger) return;

        // data-modal-hide always closes the named modal
        var hideId = trigger.dataset.modalHide;
        if (hideId) { hideModal(hideId); return; }

        var id = trigger.dataset.modalToggle || trigger.dataset.modalTarget;
        if (!id) return;
        var el = document.getElementById(id);
        if (!el) return;
        // Use position, not tw-hidden state, to decide action.
        // Page scripts may add tw-hidden before this handler fires (event bubbles
        // to document last), so reading classList here gives the post-script state
        // and would reverse the action. Instead:
        //   trigger inside the modal  = close button → always hide
        //   trigger outside the modal = open button  → always show
        if (el.contains(trigger)) {
            hideModal(id);
        } else {
            showModal(id);
        }
    });

    // Close the topmost open modal on Escape
    document.addEventListener('keydown', function (e) {
        if (e.key !== 'Escape') return;
        var open = document.querySelectorAll('[id$="-modal"]:not(.tw-hidden)');
        if (open.length) hideModal(open[open.length - 1].id);
    });
}());

// ---------------------------------------------------------------------------
// Keep aria-hidden / aria-modal / body-scroll in sync whenever any code
// toggles tw-hidden on a *-modal element directly (e.g. openXxxModal()).
// ---------------------------------------------------------------------------
(function () {
    var observer = new MutationObserver(function (mutations) {
        mutations.forEach(function (m) {
            var el = m.target;
            if (!el.id || !el.id.endsWith('-modal')) return;
            var hidden = el.classList.contains('tw-hidden');
            el.setAttribute('aria-hidden', hidden ? 'true' : 'false');
            if (!hidden) {
                el.setAttribute('aria-modal', 'true');
                el.setAttribute('role', 'dialog');
                document.body.classList.add('tw-overflow-hidden');
            } else {
                el.removeAttribute('aria-modal');
                el.removeAttribute('role');
                if (!document.querySelector('[id$="-modal"]:not(.tw-hidden)')) {
                    document.body.classList.remove('tw-overflow-hidden');
                }
            }
        });
    });
    function startObserver() {
        observer.observe(document.body, {
            subtree: true,
            attributes: true,
            attributeFilter: ['class']
        });
    }
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', startObserver);
    } else {
        startObserver();
    }
}());

// Payment modal
document.addEventListener('DOMContentLoaded', function() {
    const paymentMethod = document.getElementById('payment-method');
    const paymentFields = document.getElementById('payment-fields');

    if (paymentMethod && paymentFields) {
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
    }
});

//confirmation and success modal
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('#payment-modal form');
    const confirmModal = document.getElementById('confirm-modal');
    const successModal = document.getElementById('success-modal');
    
    if (form && confirmModal && successModal) {
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

        // Note: [data-modal-hide] close buttons are handled by the global delegation above
    }
});

// Function to handle form submission (implement as needed)
function submitFormData() {
    // Add your form submission logic here
    // This could be an AJAX call to your backend
}

// chart manager
// Add this as a new global chart management utility

window.ChartsManager = {
    activeCharts: {},
    
    register: function(id, chartInstance) {
        this.activeCharts[id] = chartInstance;
    },
    
    get: function(id) {
        return this.activeCharts[id];
    },
    
    destroy: function(id) {
        if (this.activeCharts[id]) {
            this.activeCharts[id].destroy();
            delete this.activeCharts[id];
        }
    },
    
    destroyAll: function() {
        Object.keys(this.activeCharts).forEach(id => {
            this.destroy(id);
        });
    }
};

// Auto cleanup on page navigation
window.addEventListener('beforeunload', function() {
    window.ChartsManager.destroyAll();
});
<!-- Edit Service Modal -->
<div id="editService-modal" tabindex="-1" aria-hidden="true" class="tw-hidden tw-fixed tw-top-0 tw-left-0 tw-right-0 tw-z-50 tw-w-full tw-p-4 tw-overflow-x-hidden tw-overflow-y-auto md:tw-inset-0 tw-h-full tw-max-h-full tw-flex tw-items-center tw-justify-center tw-backdrop-blur-sm tw-bg-black/60">
    <div class="tw-relative tw-w-full tw-max-w-md tw-max-h-full tw-animate-modal-entry">
        <!-- Modal content -->
        <div class="tw-relative tw-bg-gray-800 tw-rounded-lg tw-shadow-sm tw-transform tw-transition-all">
            <!-- Modal header -->
            <div class="tw-flex tw-items-center tw-justify-between tw-p-4 md:tw-p-5 tw-border-b tw-rounded-t tw-border-gray-700">
                <h3 class="tw-text-lg tw-font-semibold tw-text-white">Edit Service</h3>
                <button type="button" class="tw-text-gray-400 tw-bg-transparent tw-hover:tw-bg-gray-700 tw-hover:tw-text-white tw-rounded-lg tw-text-sm tw-w-8 tw-h-8 ms-auto tw-inline-flex tw-justify-center tw-items-center" data-modal-toggle="editService-modal">
                    <svg class="tw-w-3 tw-h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            
            <!-- Modal body -->
            <form id="editServiceForm" class="tw-p-4 md:tw-p-5" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" id="edit-service-id" name="serviceID">
                
                <!-- Service Name -->
                <div class="tw-mb-4">
                    <label for="edit-service-name" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white">Service Name</label>
                    <input type="text" name="name" id="edit-service-name" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5 placeholder:tw-text-gray-400" required maxlength="100" placeholder="Enter service name">
                </div>

                <!-- Service Category -->
                <div class="tw-mb-4">
                    <label for="edit-service-category" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white">Category</label>
                    <select id="edit-service-category" name="category" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required>
                        <option value="">Select category</option>
                        <option value="Grooming">Grooming</option>
                        <option value="Boarding">Boarding</option>
                        <option value="Veterinary">Veterinary</option>
                        <option value="Training">Training</option>
                    </select>
                </div>

                <!-- Service Price -->
                <div class="tw-mb-4">
                    <label for="edit-service-price" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white">Price (₱)</label>
                    <div class="tw-relative">
                        <span class="tw-absolute tw-inset-y-0 tw-left-0 tw-flex tw-items-center tw-pl-3 tw-pointer-events-none tw-text-gray-400">₱</span>
                        <input type="number" name="price" id="edit-service-price" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-pl-8 tw-p-2.5 placeholder:tw-text-gray-400" required min="0" step="0.01" placeholder="0.00">
                    </div>
                </div>

                <!-- Service Description -->
                <div class="tw-mb-4">
                    <label for="edit-service-description" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white">Description</label>
                    <textarea id="edit-service-description" name="description" rows="3" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5 placeholder:tw-text-gray-400" placeholder="Enter service description"></textarea>
                </div>

                <!-- Service Image -->
                <div class="tw-mb-4">
                    <label class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white" for="edit-service-image">Service Image</label>
                    <div class="tw-flex tw-items-center tw-justify-center tw-w-full">
                        <label for="edit-service-image" class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-w-full tw-h-32 tw-border-2 tw-border-dashed tw-rounded-lg tw-cursor-pointer tw-bg-gray-700 hover:tw-bg-gray-600 tw-border-gray-600">
                            <div id="edit-image-preview" class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-w-full tw-h-full">
                                <svg class="tw-w-8 tw-h-8 tw-text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                </svg>
                                <p class="tw-text-xs tw-text-gray-400">Click to upload new image (optional)</p>
                            </div>
                            <input id="edit-service-image" name="serviceImage" type="file" class="tw-hidden" accept="image/*" />
                        </label>
                    </div>
                    <p class="tw-text-xs tw-text-gray-400 tw-mt-1">Leave empty to keep current image</p>
                </div>

                <!-- Service Status -->
                <div class="tw-flex tw-items-start tw-mb-5">
                    <input type="hidden" name="isActive" value="0"> <!-- Important: ensures a value is sent even if unchecked -->
                    <input id="edit-service-active" name="isActive" type="checkbox" value="1" class="tw-w-4 tw-h-4 tw-mt-0.5 tw-text-blue-600 tw-bg-gray-700 tw-border-gray-600 tw-rounded">
                    <label for="edit-service-active" class="tw-ml-2 tw-text-sm tw-font-medium tw-text-white tw-leading-tight">Service is active and available to customers</label>
                </div>

                <div class="tw-mb-4">
                    <label for="admin-password-edit" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white">
                        <i class="fas fa-lock tw-mr-2"></i>Admin Password (Required for Security)
                    </label>
                    <input type="password" id="admin-password-edit" name="admin-password" 
                        class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5 placeholder:tw-text-gray-400" 
                        placeholder="Enter your current password" required>
                    <p class="tw-text-xs tw-text-gray-400 tw-mt-1">Enter your admin password to confirm service changes</p>
                </div>                
                
                <button type="submit" class="tw-text-black tw-inline-flex tw-items-center tw-bg-[#24CFF4] hover:tw-bg-[#63e4fd] focus:tw-outline-none focus:tw-bg-[#038cb7] tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center">
                    <i class="fas fa-save tw-me-1 tw--ms-1"></i>
                    Update Service
                </button>
            </form>
        </div>
    </div>
</div>

<script>
// Create a namespace for our service edit modal functionality
const AdminEditServiceModal = {
    // Store elements references
    elements: {
        nameInput: null,
        categorySelect: null,
        priceInput: null,
        descriptionInput: null,
        imageInput: null,
        imagePreview: null,
        activeCheckbox: null,
        form: null,
        modal: null,
        serviceIdInput: null
    },
    
    // Submission state tracking
    isSubmitting: false,
    currentServiceId: null,
    currentImageUrl: null,
    
    // Initialize the modal functionality
    init: function() {
        // Get elements
        this.elements.nameInput = document.getElementById('edit-service-name');
        this.elements.categorySelect = document.getElementById('edit-service-category');
        this.elements.priceInput = document.getElementById('edit-service-price');
        this.elements.descriptionInput = document.getElementById('edit-service-description');
        this.elements.imageInput = document.getElementById('edit-service-image');
        this.elements.imagePreview = document.getElementById('edit-image-preview');
        this.elements.activeCheckbox = document.getElementById('edit-service-active');
        this.elements.form = document.getElementById('editServiceForm');
        this.elements.modal = document.getElementById('editService-modal');
        this.elements.serviceIdInput = document.getElementById('edit-service-id');
        
        // Set up event handlers
        this.setupEventHandlers();
    },
    
    setupEventHandlers: function() {
        // Setup modal close button
        const closeModalBtn = document.querySelector('[data-modal-toggle="editService-modal"]');
        if (closeModalBtn) {
            closeModalBtn.addEventListener('click', () => {
                if (this.elements.modal) {
                    this.elements.modal.classList.add('tw-hidden');
                }
            });
        }
        
        // Setup image input change handler
        if (this.elements.imageInput) {
            this.elements.imageInput.addEventListener('change', this.handleImageChange.bind(this));
        }
        
        // Setup form submission
        if (this.elements.form) {
            this.elements.form.addEventListener('submit', this.handleFormSubmit.bind(this));
        }

        // Make the editService function available globally
        window.editService = this.openEditModal.bind(this);
    },
    
    openEditModal: function(serviceId) {
        this.currentServiceId = serviceId;
        if (this.elements.serviceIdInput) {
            this.elements.serviceIdInput.value = serviceId;
        }
        
        // Show the modal
        if (this.elements.modal) {
            this.elements.modal.classList.remove('tw-hidden');
        }
        
        // Fetch service data
        this.fetchServiceData(serviceId);
    },
    
    fetchServiceData: function(serviceId) {
        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // Add loading state
        const form = this.elements.form;
        form.classList.add('tw-opacity-50');
        form.querySelectorAll('input:not([type="number"]), select, textarea, button').forEach(elem => {
            elem.disabled = true;
        });
        // Handle number inputs separately to preserve spinner button styling
        form.querySelectorAll('input[type="number"]').forEach(elem => {
            elem.style.pointerEvents = 'none';
            elem.classList.add('tw-cursor-not-allowed');
        });
        
        fetch(`{{ route('admin.services.show', ['id' => ':id']) }}`.replace(':id', serviceId), {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.success && data.service) {
                this.populateFormData(data.service);
            } else {
                throw new Error('Failed to load service data');
            }
        })
        .catch(err => {
            console.error('Error fetching service data:', err);
            this.showError('Failed to load service data. Please try again.');
        })
        .finally(() => {
            // Remove loading state
            form.classList.remove('tw-opacity-50');
            form.querySelectorAll('input:not([type="number"]), select, textarea, button').forEach(elem => {
                elem.disabled = false;
            });
            // Re-enable number inputs
            form.querySelectorAll('input[type="number"]').forEach(elem => {
                elem.style.pointerEvents = '';
                elem.classList.remove('tw-cursor-not-allowed');
            });
        });
    },
    
    populateFormData: function(service) {
        // Set form field values
        this.elements.nameInput.value = service.name || '';
        this.elements.categorySelect.value = service.category || '';
        this.elements.priceInput.value = service.price || '';
        this.elements.descriptionInput.value = service.description || '';
        this.elements.activeCheckbox.checked = service.isActive ? true : false;
        
        // Update image preview if there's an image
        if (service.serviceImage) {
            this.currentImageUrl = `{{ asset('storage') }}/${service.serviceImage}`;
            this.elements.imagePreview.innerHTML = `
                <img src="${this.currentImageUrl}" alt="Preview" class="tw-h-full tw-w-full tw-object-cover tw-rounded-lg" />
                <p class="tw-text-xs tw-text-gray-400 tw-absolute tw-bottom-1 tw-bg-gray-800/80 tw-px-2 tw-py-1 tw-rounded">
                    Current image
                </p>
            `;
            this.elements.imagePreview.classList.add("tw-relative");
        }
    },
    
    handleImageChange: function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (event) => {
                this.elements.imagePreview.innerHTML = `
                    <img src="${event.target.result}" alt="Preview" class="tw-h-full tw-w-full tw-object-cover tw-rounded-lg" />
                    <p class="tw-text-xs tw-text-gray-400 tw-absolute tw-bottom-1 tw-bg-gray-800/80 tw-px-2 tw-py-1 tw-rounded">
                        ${file.name}
                    </p>
                `;
                this.elements.imagePreview.classList.add("tw-relative");
            };
            reader.readAsDataURL(file);
        }
    },
    
    validateForm: function() {
        // Basic validations
        const name = this.elements.nameInput.value.trim();
        if (!name) {
            this.showError('Please enter a service name');
            return false;
        }
        
        const category = this.elements.categorySelect.value;
        if (!category) {
            this.showError('Please select a category');
            return false;
        }
        
        const price = parseFloat(this.elements.priceInput.value);
        if (isNaN(price) || price < 0) {
            this.showError('Please enter a valid price');
            return false;
        }
        
        return true;
    },
    
    handleFormSubmit: function(e) {
        e.preventDefault();
        
        if (this.isSubmitting) {
            return;
        }
        
        // Validate form
        if (!this.validateForm()) {
            return;
        }
        
        // Show confirmation dialog
        Swal.fire({
            title: 'Update Service',
            text: 'Are you sure you want to update this service?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#24CFF4',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update service',
            cancelButtonText: 'Cancel',
            background: '#374151',
            color: '#fff'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submitServiceData();
            }
        });
    },
    
    submitServiceData: function() {
        this.isSubmitting = true;
        
        const submitButton = this.elements.form.querySelector('button[type="submit"]');
        const originalButtonText = submitButton.innerHTML;
        submitButton.disabled = true;
        submitButton.innerHTML = `<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg> Processing...`;
        
        // Create FormData object for file upload
        const formData = new FormData(this.elements.form);
        formData.append('admin_password', document.getElementById('admin-password-edit').value);

        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // Submit to server
        fetch(`{{ route('admin.services.update', ['id' => ':serviceId']) }}`.replace(':serviceId', this.currentServiceId), {
            method: 'POST', // Using POST with method spoofing for file uploads
            headers: {
                'X-CSRF-TOKEN': csrfToken
                // Don't set Content-Type for multipart/form-data
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            this.isSubmitting = false;
            submitButton.disabled = false;
            submitButton.innerHTML = originalButtonText;
            
            if (data.success) {
                Swal.fire({
                    title: 'Success!',
                    text: 'Service has been updated successfully',
                    icon: 'success',
                    confirmButtonColor: '#24CFF4',
                    background: '#374151',
                    color: '#fff'
                }).then(() => {
                    // Reset form and close modal
                    this.elements.modal.classList.add('tw-hidden');
                    
                    // Reload page to reflect changes
                    window.location.reload();
                });
            } else {
                let errorMessage = 'Failed to update service. Please try again.';
                if (data.errors) {
                    errorMessage = Object.values(data.errors).flat().join('<br>');
                } else if (data.message) {
                    errorMessage = data.message;
                }
                
                this.showError(errorMessage);
            }
        })
        .catch(err => {
            this.isSubmitting = false;
            submitButton.disabled = false;
            submitButton.innerHTML = originalButtonText;
            
            console.error('Error updating service:', err);
            this.showError('Failed to update service. Please try again.');
        });
    },
    
    showError: function(message) {
        Swal.fire({
            title: 'Error',
            html: message,
            icon: 'error',
            confirmButtonColor: '#24CFF4',
            background: '#374151',
            color: '#fff'
        });
    }
};

// Initialize after DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    AdminEditServiceModal.init();
});

// Initialize when content is dynamically loaded
document.addEventListener('contentChanged', function() {
    AdminEditServiceModal.init();
});
</script>
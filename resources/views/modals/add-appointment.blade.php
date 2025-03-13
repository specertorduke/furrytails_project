<div id="addAppointment-modal" tabindex="-1" aria-hidden="true" class="tw-hidden overflow-y-auto overflow-x-hidden tw-fixed tw-top-0 tw-right-0 tw-left-0 tw-z-50 tw-justify-center tw-items-center tw-w-full md:tw-inset-0 tw-h-[calc(100%-1rem)] tw-max-h-full">
    <div class="tw-relative tw-p-4 tw-w-full tw-max-w-2xl tw-max-h-full">
        <div class="tw-relative tw-bg-white tw-rounded-lg tw-shadow dark:tw-bg-gray-700">
            <!-- Modal header -->
            <div class="tw-flex tw-items-center tw-justify-between tw-p-4 md:tw-p-5 tw-border-b tw-rounded-t dark:tw-border-gray-600">
                <h3 class="tw-text-xl tw-font-semibold tw-text-gray-900 dark:tw-text-white">
                    Add New Appointment
                </h3>
                <button type="button" class="tw-text-gray-400 tw-bg-transparent hover:tw-bg-gray-200 hover:tw-text-gray-900 tw-rounded-lg tw-text-sm tw-w-8 tw-h-8 tw-flex tw-justify-center tw-items-center dark:hover:tw-bg-gray-600 dark:hover:tw-text-white" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Modal body -->
            <form id="addAppointmentForm" class="tw-p-4 md:tw-p-5">
                @csrf
                <div class="tw-grid tw-gap-4 tw-mb-4 tw-grid-cols-2">
                    <div class="tw-col-span-2">
                        <label for="petID" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Pet</label>
                        <select id="petID" name="petID" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg focus:tw-ring-primary-600 focus:tw-border-primary-600 tw-block tw-w-full tw-p-2.5" required>
                            <option value="">Select Pet</option>
                        </select>
                    </div>
                    <div class="tw-col-span-2">
                        <label for="serviceID" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Service</label>
                        <select id="serviceID" name="serviceID" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg focus:tw-ring-primary-600 focus:tw-border-primary-600 tw-block tw-w-full tw-p-2.5" required>
                            <option value="">Select Service</option>
                        </select>
                    </div>
                    <div class="tw-col-span-1">
                        <label for="date" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Date</label>
                        <input type="date" id="date" name="date" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg focus:tw-ring-primary-600 focus:tw-border-primary-600 tw-block tw-w-full tw-p-2.5" required>
                    </div>
                    <div class="tw-col-span-1">
                        <label for="time" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Time</label>
                        <select id="time" name="time" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg focus:tw-ring-primary-600 focus:tw-border-primary-600 tw-block tw-w-full tw-p-2.5" required>
                            <option value="">Select Time</option>
                        </select>
                    </div>
                </div>
                <div class="tw-flex tw-justify-end">
                    <button type="button" class="tw-text-gray-500 tw-bg-white hover:tw-bg-gray-100 focus:tw-ring-4 focus:tw-outline-none focus:tw-ring-blue-300 tw-rounded-lg tw-border tw-border-gray-200 tw-text-sm tw-font-medium tw-px-5 tw-py-2.5 hover:tw-text-gray-900 focus:tw-z-10 mr-2" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="tw-text-white tw-bg-[#24CFF4] hover:tw-bg-blue-400 focus:tw-ring-4 focus:tw-outline-none focus:tw-ring-blue-300 tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5">Add Appointment</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add this at the beginning of your script
    const modal = document.getElementById('addAppointment-modal');
    const form = document.getElementById('addAppointmentForm');

    // Function to close modal and reset form
    function closeModal() {
        modal.classList.add('tw-hidden');
        form.reset();
        // Reset select elements to default
        document.getElementById('petID').selectedIndex = 0;
        document.getElementById('serviceID').selectedIndex = 0;
        document.getElementById('time').selectedIndex = 0;
    }

    // Add event listeners for modal closing
    const closeButtons = document.querySelectorAll('[data-bs-dismiss="modal"]');
    closeButtons.forEach(button => {
        button.addEventListener('click', closeModal);
    });

    // Close modal on clicking outside
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            closeModal();
        }
    });

    // Close modal on Escape key press
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !modal.classList.contains('tw-hidden')) {
            closeModal();
        }
    });

    // Function to open modal (add this if you need it)
    window.openAddAppointmentModal = function() {
        modal.classList.remove('tw-hidden');
    };

    // Load user's pets
    fetch('/manage/pets')
        .then(response => response.json())
        .then(pets => {
            const petSelect = document.getElementById('petID');
            pets.forEach(pet => {
                const option = new Option(pet.name, pet.petID);
                petSelect.add(option);
            });
        });

    // Load services (excluding boarding)
    fetch('/admin/appointments/services')
        .then(response => response.json())
        .then(services => {
            const serviceSelect = document.getElementById('serviceID');
            services.forEach(service => {
                const option = new Option(service.name, service.serviceID);
                serviceSelect.add(option);
            });
        });

    // Date and time handling
    const dateInput = document.getElementById('date');
    const timeSelect = document.getElementById('time');

    // Set minimum date to today
    const today = new Date().toISOString().split('T')[0];
    dateInput.min = today;

    dateInput.addEventListener('change', function() {
        fetch(`/admin/appointments/available-times?date=${this.value}`)
            .then(response => response.json())
            .then(data => {
                timeSelect.innerHTML = '<option value="">Select Time</option>';
                if (data.timeSlots) {
                    data.timeSlots.forEach(slot => {
                        if (slot.available) {
                            const option = new Option(slot.label, slot.value);
                            timeSelect.add(option);
                        }
                    });
                }
            });
    });

    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(form);
        fetch('/manage/appointments', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(Object.fromEntries(formData))
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                closeModal(); // Use the new closeModal function
                if (window.ManagePage && window.ManagePage.appointmentsTable) {
                    window.ManagePage.appointmentsTable.ajax.reload();
                }
                Swal.fire('Success!', 'Appointment created successfully', 'success');
            } else {
                Swal.fire('Error!', data.message || 'Failed to create appointment', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire('Error!', 'Something went wrong', 'error');
        });
    });
});
</script>
@endpush
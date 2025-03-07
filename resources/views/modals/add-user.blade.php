<!-- Main modal -->
<div id="addUser-modal" tabindex="-1" aria-hidden="true" class="tw-hidden tw-fixed tw-top-0 tw-left-0 tw-right-0 tw-z-50 tw-w-full tw-p-4 tw-overflow-x-hidden tw-overflow-y-auto md:tw-inset-0 tw-h-full tw-max-h-full tw-flex tw-items-center tw-justify-center tw-backdrop-blur-sm tw-bg-black/60">
    <div class="tw-relative tw-w-full tw-max-w-md tw-max-h-full tw-animate-modal-entry">
        <!-- Modal content -->
        <div class="tw-relative tw-bg-gray-800 tw-rounded-lg tw-shadow-sm tw-transform tw-transition-all">
            <!-- Modal header -->
            <div class="tw-flex tw-items-center tw-justify-between tw-p-4 md:tw-p-5 tw-border-b tw-rounded-t tw-border-gray-700">
                <h3 class="tw-text-lg tw-font-semibold tw-text-white">Add User</h3>
                <button type="button" class="tw-text-gray-400 tw-bg-transparent tw-hover:tw-bg-gray-700 tw-hover:tw-text-white tw-rounded-lg tw-text-sm tw-w-8 tw-h-8 ms-auto tw-inline-flex tw-justify-center tw-items-center" data-modal-toggle="addUser-modal">
                    <svg class="tw-w-3 tw-h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            
            <!-- Modal body -->
            <form class="tw-p-4 md:tw-p-5" enctype="multipart/form-data">
                <!-- First Name and Last Name fields in same row -->
                <div class="tw-grid tw-grid-cols-2 tw-gap-4 tw-mb-4">
                    <!-- First Name field -->
                    <div>
                        <label for="first-name" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white">First Name</label>
                        <input type="text" name="first-name" id="first-name" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required>
                    </div>

                    <!-- Last Name field -->
                    <div>
                        <label for="last-name" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white">Last Name</label>
                        <input type="text" name="last-name" id="last-name" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required>
                    </div>
                </div>

                <!-- Email field - Single row -->
                <div class="tw-mb-4">
                    <label for="email" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white">Email</label>
                    <input type="email" name="email" id="email" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required>
                </div>

                <!-- Username field - Single row -->
                <div class="tw-mb-4">
                    <label for="username" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white">Username</label>
                    <input type="text" name="username" id="username" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required>
                </div>

                <!-- Phone field - Single row -->
                <div class="tw-mb-4">
                    <label for="phone" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white">Phone</label>
                    <input type="tel" name="phone" id="phone" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required>
                </div>

                <!-- Password field - Single row -->
                <div class="tw-mb-4">
                    <label for="password" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white">Password</label>
                    <input type="password" name="password" id="password" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required>
                </div>

                <!-- Confirm Password field - Single row -->
                <div class="tw-mb-4">
                    <label for="password-confirm" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white">Confirm Password</label>
                    <input type="password" name="password-confirm" id="password-confirm" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required>
                </div>

                <!-- Role field - Single row -->
                <div class="tw-mb-4">
                    <label for="role" class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white">Role</label>
                    <select id="role" name="role" class="tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white tw-text-sm tw-rounded-lg tw-focus:tw-ring-[#24CFF4] tw-focus:tw-border-[#24CFF4] tw-block tw-w-full tw-p-2.5" required>
                        <option value="user" selected>User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <!-- User Image - Single row -->
                <div class="tw-mb-4">
                    <label class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-white">Profile Image</label>
                    <div class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-w-full">
                        <!-- Upload Area -->
                        <label for="user-image" id="upload-area" class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-w-full tw-h-64 tw-border-2 tw-border-gray-600 tw-border-dashed tw-rounded-lg tw-cursor-pointer tw-bg-gray-700 hover:tw-bg-gray-600">
                            <div class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-pt-5 tw-pb-6">
                                <svg class="tw-w-8 tw-h-8 tw-mb-4 tw-text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                </svg>
                                <p class="tw-mb-2 tw-text-sm tw-text-gray-400"><span class="tw-font-semibold">Click to upload</span> or drag and drop</p>
                                <p class="tw-text-xs tw-text-gray-400">PNG, JPG or JPEG</p>
                            </div>
                            <input id="user-image" name="user-image" type="file" class="tw-hidden" accept="image/png, image/jpeg, image/jpg" />
                        </label>

                        <!-- Cropper Area (Hidden by default) -->
                        <div id="cropper-area" class="tw-hidden tw-w-full">
                            <div class="tw-relative tw-w-full tw-aspect-square tw-max-w-md tw-mx-auto tw-overflow-hidden">
                                <img id="cropper-image" class="tw-max-w-full">
                            </div>
                            <div class="tw-flex tw-justify-end tw-mt-4 tw-space-x-2">
                                <button type="button" id="cancel-crop" class="tw-px-4 tw-py-2 tw-text-sm tw-text-gray-400 hover:tw-text-gray-300">Cancel</button>
                                <button type="button" id="apply-crop" class="tw-px-4 tw-py-2 tw-text-sm tw-text-white tw-bg-[#24CFF4] tw-rounded hover:tw-bg-[#20b9db]">Apply Crop</button>
                            </div>
                        </div>

                        <!-- Preview Area (Hidden by default) -->
                        <div id="preview-area" class="tw-hidden tw-flex tw-flex-col tw-justify-center tw-mt-4">
                            <img id="preview-image" class="tw-w-32 tw-h-32 tw-rounded-full tw-object-cover">
                            <button type="button" id="change-image" class="tw-text-sm tw-mt-3 tw-text-[#24CFF4] hover:tw-text-[#63e4fd]">Change Image</button>
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="tw-text-black tw-inline-flex tw-items-center tw-bg-[#24CFF4] hover:tw-bg-[#63e4fd] focus:tw-outline-none focus:tw-bg-[#038cb7] tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center">
                    <svg class="tw-me-1 tw--ms-1 tw-w-5 tw-h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    Add User
                </button>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let cropper = null;
    const uploadArea = document.getElementById('upload-area');
    const cropperArea = document.getElementById('cropper-area');
    const previewArea = document.getElementById('preview-area');
    const fileInput = document.getElementById('user-image');
    const cropperImage = document.getElementById('cropper-image');
    const previewImage = document.getElementById('preview-image');
    let croppedImageData = null;

    // Reset function
    function resetImageUpload() {
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
        fileInput.value = '';
        uploadArea.classList.remove('tw-hidden');
        cropperArea.classList.add('tw-hidden');
        previewArea.classList.add('tw-hidden');
        croppedImageData = null;
    }

    // Add change image functionality
    const changeImageBtn = document.getElementById('change-image');
    if (changeImageBtn) {
        changeImageBtn.addEventListener('click', function() {
            resetImageUpload();
            fileInput.click();
        });
    }

    // Handle file input change
    if (fileInput) {
        fileInput.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    uploadArea.classList.add('tw-hidden');
                    cropperArea.classList.remove('tw-hidden');
                    cropperImage.src = e.target.result;
                    
                    if (cropper) {
                        cropper.destroy();
                    }

                    cropper = new Cropper(cropperImage, {
                        aspectRatio: 1,
                        viewMode: 1,
                        dragMode: 'move',
                        guides: false,
                        center: true,
                        cropBoxMovable: false,
                        cropBoxResizable: false,
                        minContainerWidth: 300,
                        minContainerHeight: 300
                    });
                };
                
                reader.readAsDataURL(this.files[0]);
            }
        });
    }

    // Cancel crop
    const cancelCropBtn = document.getElementById('cancel-crop');
    if (cancelCropBtn) {
        cancelCropBtn.addEventListener('click', resetImageUpload);
    }

    // Apply crop
    const applyCropBtn = document.getElementById('apply-crop');
    if (applyCropBtn) {
        applyCropBtn.addEventListener('click', function() {
            if (cropper) {
                croppedImageData = cropper.getCroppedCanvas({
                    width: 300,
                    height: 300
                }).toDataURL();
                
                previewImage.src = croppedImageData;
                cropperArea.classList.add('tw-hidden');
                previewArea.classList.remove('tw-hidden');
                
                let hiddenInput = document.getElementById('cropped-image-data');
                if (!hiddenInput) {
                    hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.id = 'cropped-image-data';
                    hiddenInput.name = 'cropped_image';
                    document.querySelector('#addUser-modal form').appendChild(hiddenInput);
                }
                hiddenInput.value = croppedImageData;
            }
        });
    }

    // Handle modal close
    const modalToggle = document.querySelector('[data-modal-toggle="addUser-modal"]');
    if (modalToggle) {
        modalToggle.addEventListener('click', function() {
            resetImageUpload();
        });
    }

    // Form submission with validation
    const form = document.querySelector('#addUser-modal form');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validate password match
            const password = document.getElementById('password').value;
            const passwordConfirm = document.getElementById('password-confirm').value;
            
            if (password !== passwordConfirm) {
                Swal.fire({
                    title: 'Password Error',
                    text: 'Passwords do not match',
                    icon: 'error',
                    confirmButtonColor: '#24CFF4',
                    confirmButtonText: 'OK'
                });
                return;
            }

            // Show confirmation dialog
            Swal.fire({
                title: 'Add User',
                text: 'Are you sure you want to add this user?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#24CFF4',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, add user',
                cancelButtonText: 'Cancel',
                background: '#374151', // Dark background
                color: '#fff' // White text
            }).then((result) => {
                if (result.isConfirmed) {
                    // Here you would typically make an AJAX call to add the user
                    
                    Swal.fire({
                        title: 'Success!',
                        text: 'User has been added successfully',
                        icon: 'success',
                        confirmButtonColor: '#24CFF4',
                        background: '#374151', // Dark background
                        color: '#fff' // White text
                    }).then(() => {
                        // Reset form and close modal
                        form.reset();
                        resetImageUpload();
                        
                        // Close the modal
                        const modal = document.getElementById('addUser-modal');
                        modal.classList.add('tw-hidden');
                    });
                }
            });
        });
    }
});
</script>
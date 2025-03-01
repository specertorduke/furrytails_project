@extends('admin.adminLayout')

@section('title', 'Account Settings')

@section('content')
<div class="tw-p-6 tw-min-h-screen tw-bg-gray-900">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col">
                <p class="tw-text-sm tw-text-gray-400">Administration / Account Settings</p>
                <h1 class="tw-text-2xl tw-font-bold tw-text-white">Account Settings</h1>
            </div>
        </div>

        <!-- Account Settings Content -->
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="tw-bg-gray-800 tw-shadow-sm tw-rounded-xl tw-p-8 tw-transition-all tw-duration-300 tw-ease-in-out hover:tw-shadow-lg">
                    <!-- Profile Image Section -->
                    <div class="row justify-content-center mb-5">
                        <div class="col-12 col-md-6 text-center">
                            <div class="tw-relative tw-group tw-inline-block">
                                <div class="tw-w-32 tw-h-32 tw-rounded-full tw-overflow-hidden tw-border-2 tw-border-gray-700">
                                    <img src="{{ asset('storage/' . Auth::user()->userImage) }}" alt="Profile" 
                                        class="tw-w-full tw-h-full tw-object-cover">
                                    <div class="tw-absolute tw-inset-0 tw-bg-black tw-bg-opacity-0 tw-flex tw-items-center tw-justify-center tw-rounded-full tw-transition-all tw-duration-300 group-hover:tw-bg-opacity-60">
                                        <label for="profile_image" class="tw-cursor-pointer">
                                            <i class="fas fa-camera tw-text-white tw-opacity-0 tw-text-2xl group-hover:tw-opacity-100 tw-transition-all tw-duration-300"></i>
                                        </label>
                                    </div>
                                </div>
                                <input type="file" id="profile_image" name="profile_image" class="tw-hidden" accept="image/*">
                            </div>
                            <h2 class="tw-text-xl tw-font-bold tw-mt-4 tw-text-white">{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</h2>
                            <p class="tw-text-gray-400">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    
                    <form method="POST" action="{{ route('admin.account.update') }}" enctype="multipart/form-data" id="accountForm">
                        @csrf
                        @method('PUT')

                        <div class="row g-4">
                            <!-- Username Field -->
                            <div class="col-12">
                                <label for="username" class="tw-block tw-text-sm tw-font-medium tw-text-gray-300 tw-mb-1">Username</label>
                                <input type="text" id="username" name="username" value="{{ old('username', Auth::user()->username) }}" required 
                                    class="tw-mt-1 tw-w-full tw-px-4 tw-py-2 tw-bg-gray-700 tw-border-gray-600 tw-text-gray-200 tw-rounded-lg tw-shadow-sm focus:tw-ring-blue-500 focus:tw-border-blue-500 tw-transition-all tw-duration-300">
                            </div>

                            <!-- Name Fields -->
                            <div class="col-12 col-md-6">
                                <label for="firstName" class="tw-block tw-text-sm tw-font-medium tw-text-gray-300 tw-mb-1">First Name</label>
                                <input type="text" id="firstName" name="firstName" value="{{ old('firstName', Auth::user()->firstName) }}" required 
                                    class="tw-mt-1 tw-w-full tw-px-4 tw-py-2 tw-bg-gray-700 tw-border-gray-600 tw-text-gray-200 tw-rounded-lg tw-shadow-sm focus:tw-ring-blue-500 focus:tw-border-blue-500 tw-transition-all tw-duration-300">
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="lastName" class="tw-block tw-text-sm tw-font-medium tw-text-gray-300 tw-mb-1">Last Name</label>
                                <input type="text" id="lastName" name="lastName" value="{{ old('lastName', Auth::user()->lastName) }}" required 
                                    class="tw-mt-1 tw-w-full tw-px-4 tw-py-2 tw-bg-gray-700 tw-border-gray-600 tw-text-gray-200 tw-rounded-lg tw-shadow-sm focus:tw-ring-blue-500 focus:tw-border-blue-500 tw-transition-all tw-duration-300">
                            </div>

                            <!-- Contact Fields -->
                            <div class="col-12 col-md-6">
                                <label for="email" class="tw-block tw-text-sm tw-font-medium tw-text-gray-300 tw-mb-1">Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required 
                                    class="tw-mt-1 tw-w-full tw-px-4 tw-py-2 tw-bg-gray-700 tw-border-gray-600 tw-text-gray-200 tw-rounded-lg tw-shadow-sm focus:tw-ring-blue-500 focus:tw-border-blue-500 tw-transition-all tw-duration-300">
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="phoneNumber" class="tw-block tw-text-sm tw-font-medium tw-text-gray-300 tw-mb-1">Contact Number</label>
                                <input type="text" id="phoneNumber" name="phoneNumber" value="{{ old('phone', Auth::user()->phone) }}" required 
                                    class="tw-mt-1 tw-w-full tw-px-4 tw-py-2 tw-bg-gray-700 tw-border-gray-600 tw-text-gray-200 tw-rounded-lg tw-shadow-sm focus:tw-ring-blue-500 focus:tw-border-blue-500 tw-transition-all tw-duration-300">
                            </div>

                            <!-- Password Fields -->
                            <div class="col-12 col-md-6">
                                <label for="password" class="tw-block tw-text-sm tw-font-medium tw-text-gray-300 tw-mb-1">New Password</label>
                                <div class="tw-relative">
                                    <input type="password" id="password" name="password" 
                                        class="tw-mt-1 tw-w-full tw-px-4 tw-py-2 tw-bg-gray-700 tw-border-gray-600 tw-text-gray-200 tw-rounded-lg tw-shadow-sm focus:tw-ring-blue-500 focus:tw-border-blue-500 tw-transition-all tw-duration-300">
                                </div>
                                <span class="tw-text-xs tw-text-gray-400">Leave blank to keep your current password</span>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="password_confirmation" class="tw-block tw-text-sm tw-font-medium tw-text-gray-300 tw-mb-1">Confirm Password</label>
                                <div class="tw-relative">
                                    <input type="password" id="password_confirmation" name="password_confirmation" 
                                        class="tw-mt-1 tw-w-full tw-px-4 tw-py-2 tw-bg-gray-700 tw-border-gray-600 tw-text-gray-200 tw-rounded-lg tw-shadow-sm focus:tw-ring-blue-500 focus:tw-border-blue-500 tw-transition-all tw-duration-300">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-12 d-flex justify-content-center">
                                <button type="button" onclick="confirmUpdate()" 
                                    class="tw-bg-blue-600 tw-text-white tw-font-bold tw-py-3 tw-px-6 tw-rounded-xl tw-transition-all tw-duration-300 tw-ease-in-out hover:tw-bg-blue-500 active:tw-bg-blue-700 tw-shadow-sm hover:tw-shadow-md tw-flex tw-items-center tw-gap-2">
                                    <i class="fas fa-save"></i>
                                    Save Changes
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Danger Zone -->
                    <div class="tw-border-t tw-border-gray-700 tw-mt-8 tw-pt-6">
                        <h3 class="tw-text-red-500 tw-font-semibold tw-mb-2">Danger Zone</h3>
                        <button type="button" onclick="confirmAdminLogout()" 
                            class="tw-text-red-400 hover:tw-text-red-300 tw-text-sm">
                            <i class="fas fa-sign-out-alt tw-mr-1"></i> Log Out From All Devices
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="cropperModal" class="tw-hidden tw-fixed tw-inset-0 tw-z-50 tw-overflow-auto tw-bg-black tw-bg-opacity-50 tw-flex tw-justify-center tw-items-center">
    <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-lg tw-max-w-lg tw-w-full tw-mx-4 tw-p-6">
        <div class="tw-flex tw-justify-between tw-items-center tw-mb-4">
            <h3 class="tw-text-xl tw-font-bold tw-text-white">Crop Profile Image</h3>
            <button type="button" id="closeCropModal" class="tw-text-gray-400 hover:tw-text-white">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="tw-bg-gray-700 tw-p-2 tw-rounded-lg">
            <img id="cropperImage" src="" alt="Image to crop" class="tw-max-w-full tw-h-auto">
        </div>
        <div class="tw-flex tw-justify-end tw-mt-6 tw-space-x-2">
            <button type="button" id="cancelCrop" class="tw-bg-gray-600 tw-text-white tw-px-4 tw-py-2 tw-rounded-lg">Cancel</button>
            <button type="button" id="saveCrop" class="tw-bg-blue-600 tw-text-white tw-px-4 tw-py-2 tw-rounded-lg">Save</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        let cropper;
        let croppedImage;
        
        // Profile image cropper
        const cropperModal = document.getElementById('cropperModal');
        const cropperImage = document.getElementById('cropperImage');
        
        document.getElementById('profile_image').addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    cropperImage.src = e.target.result;
                    cropperModal.classList.remove('tw-hidden');
                    
                    // Initialize cropper
                    if (cropper) {
                        cropper.destroy();
                    }
                    
                    cropper = new Cropper(cropperImage, {
                        aspectRatio: 1,
                        viewMode: 1,
                        dragMode: 'move',
                        autoCropArea: 1,
                        restore: false,
                        guides: true,
                        center: true,
                        highlight: false,
                        cropBoxMovable: true,
                        cropBoxResizable: true,
                        toggleDragModeOnDblclick: false,
                    });
                };
                reader.readAsDataURL(e.target.files[0]);
            }
        });
        
        // Close cropper modal
        document.getElementById('closeCropModal').addEventListener('click', function() {
            cropperModal.classList.add('tw-hidden');
            if (cropper) {
                cropper.destroy();
            }
        });
        
        document.getElementById('cancelCrop').addEventListener('click', function() {
            cropperModal.classList.add('tw-hidden');
            if (cropper) {
                cropper.destroy();
            }
        });
        
        // Save cropped image
        document.getElementById('saveCrop').addEventListener('click', function() {
            croppedImage = cropper.getCroppedCanvas({
                width: 300,
                height: 300,
                imageSmoothingEnabled: true,
                imageSmoothingQuality: 'high',
            }).toDataURL('image/jpeg');
            
            // Update preview
            document.querySelector('.tw-w-32.tw-h-32 img').src = croppedImage;
            
            // Create a blob from the data URL
            const blobBin = atob(croppedImage.split(',')[1]);
            const array = [];
            for (let i = 0; i < blobBin.length; i++) {
                array.push(blobBin.charCodeAt(i));
            }
            const file = new Blob([new Uint8Array(array)], {type: 'image/jpeg'});
            
            // Create a new File from the blob
            const fileName = 'profile_image_' + Date.now() + '.jpg';
            const newFile = new File([file], fileName, {type: 'image/jpeg'});
            
            // Create a FileList replacement
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(newFile);
            
            // Assign the file to the input
            document.getElementById('profile_image').files = dataTransfer.files;
            
            // Close modal
            cropperModal.classList.add('tw-hidden');
            if (cropper) {
                cropper.destroy();
            }
        });
    });

    // Form submission with SweetAlert
    function confirmUpdate() {
        Swal.fire({
            title: 'Save Changes?',
            text: 'Are you sure you want to update your profile?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save changes',
            cancelButtonText: 'Cancel',
            background: '#1F2937',
            color: '#fff'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('accountForm').submit();
            }
        });
    }

    // Admin logout from all devices
    function confirmAdminLogout() {
        Swal.fire({
            title: 'Log Out From All Devices?',
            text: 'This will revoke all active sessions. You will need to log in again.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, log out everywhere',
            cancelButtonText: 'Cancel',
            background: '#1F2937',
            color: '#fff'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('admin.logout.devices') }}";
            }
        });
    }

    // Initialize SweetAlert messages
    @if(session('success'))
        Swal.fire({
            title: 'Success!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonColor: '#3085d6',
            background: '#1F2937',
            color: '#fff'
        });
    @endif

    @if($errors->any())
        Swal.fire({
            title: 'Error!',
            html: "{!! implode('<br>', $errors->all()) !!}",
            icon: 'error',
            confirmButtonColor: '#3085d6',
            background: '#1F2937',
            color: '#fff'
        });
    @endif
</script>
@endpush

@endsection
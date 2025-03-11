@extends('main')

@section('title', 'Account')

@section('content')
<div class="tw-p-6 tw-bg-gradient-to-tl tw-h-screen tw-overflow-y-auto tw-to-[#b7f4ff] tw-from-white">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col">
                <p class="tw-text-sm tw-text-gray-500">Pages / Account Settings</p>
                <h1 class="tw-text-2xl tw-font-bold">Account Settings</h1>
            </div>
        </div>

        <!-- Account Settings Content -->
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="tw-bg-white tw-shadow-sm tw-rounded-2xl tw-p-8 tw-transition-all tw-duration-300 tw-ease-in-out hover:tw-shadow-lg">
                    <!-- Profile Image Section -->
                    <div class="row justify-content-center mb-5">
                        <div class="col-12 col-md-6 text-center">
                            <div class="tw-relative tw-group tw-inline-block">
                                <div class="tw-w-32 tw-h-32 tw-rounded-full tw-overflow-hidden">
                                    <img src="{{ asset('storage/' . Auth::user()->userImage) }}" alt="Profile" 
                                        class="tw-w-full tw-h-full tw-object-cover">
                                    <div class="tw-absolute tw-inset-0 tw-bg-black tw-bg-opacity-0 tw-flex tw-items-center tw-justify-center tw-rounded-full tw-transition-all tw-duration-300 group-hover:tw-bg-opacity-40">
                                        <label for="profile_image" class="tw-cursor-pointer">
                                            <i class="fas fa-camera tw-text-white tw-opacity-0 tw-text-2xl group-hover:tw-opacity-100 tw-transition-all tw-duration-300"></i>
                                        </label>
                                    </div>
                                </div>
                                <input type="file" id="profile_image" name="profile_image" class="tw-hidden" accept="image/*">
                            </div>
                            <h2 class="tw-text-xl tw-font-bold tw-mt-4">{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</h2>
                            <p class="tw-text-gray-500">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <form method="POST" id="accountupdate" action="{{ route('account.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-4">
                            <!-- Username Field -->
                            <div class="col-12">
                                <label for="username" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Username</label>
                                <input type="text" id="username" name="username" value="{{ old('username', Auth::user()->username) }}" required 
                                    class="tw-mt-1 tw-w-full tw-px-4 tw-py-2 tw-border tw-rounded-xl tw-shadow-sm focus:tw-ring-[#24CFF4] focus:tw-border-[#24CFF4] tw-transition-all tw-duration-300">
                            </div>

                            <!-- Name Fields -->
                            <div class="col-12 col-md-6">
                                <label for="firstName" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">First Name</label>
                                <input type="text" id="firstName" name="firstName" value="{{ old('firstName', Auth::user()->firstName) }}" required 
                                    class="tw-mt-1 tw-w-full tw-px-4 tw-py-2 tw-border tw-rounded-xl tw-shadow-sm focus:tw-ring-[#24CFF4] focus:tw-border-[#24CFF4] tw-transition-all tw-duration-300">
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="lastName" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Last Name</label>
                                <input type="text" id="lastName" name="lastName" value="{{ old('lastName', Auth::user()->lastName) }}" required 
                                    class="tw-mt-1 tw-w-full tw-px-4 tw-py-2 tw-border tw-rounded-xl tw-shadow-sm focus:tw-ring-[#24CFF4] focus:tw-border-[#24CFF4] tw-transition-all tw-duration-300">
                            </div>

                            <!-- Contact Fields -->
                            <div class="col-12 col-md-6">
                                <label for="email" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required 
                                    class="tw-mt-1 tw-w-full tw-px-4 tw-py-2 tw-border tw-rounded-xl tw-shadow-sm focus:tw-ring-[#24CFF4] focus:tw-border-[#24CFF4] tw-transition-all tw-duration-300">
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="phoneNumber" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Contact Number</label>
                                <input type="text" id="phoneNumber" name="phoneNumber" value="{{ old('phone', Auth::user()->phone) }}" required 
                                    class="tw-mt-1 tw-w-full tw-px-4 tw-py-2 tw-border tw-rounded-xl tw-shadow-sm focus:tw-ring-[#24CFF4] focus:tw-border-[#24CFF4] tw-transition-all tw-duration-300">
                            </div>

                            <!-- Password Fields -->
                            <div class="col-12 col-md-6">
                                <label for="password" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">New Password</label>
                                <input type="password" id="password" name="password" 
                                    class="tw-mt-1 tw-w-full tw-px-4 tw-py-2 tw-border tw-rounded-xl tw-shadow-sm focus:tw-ring-[#24CFF4] focus:tw-border-[#24CFF4] tw-transition-all tw-duration-300">
                                <span class="tw-text-xs tw-text-gray-500">Leave blank to keep your current password</span>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="password_confirmation" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Confirm Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" 
                                    class="tw-mt-1 tw-w-full tw-px-4 tw-py-2 tw-border tw-rounded-xl tw-shadow-sm focus:tw-ring-[#24CFF4] focus:tw-border-[#24CFF4] tw-transition-all tw-duration-300">
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-12 d-flex justify-content-center">
                                <button type="button" onclick="confirmUpdate()" class="tw-bg-[#24CFF4] tw-text-white tw-font-bold tw-py-3 tw-px-6 tw-rounded-xl tw-transition-all tw-duration-300 tw-ease-in-out hover:tw-bg-[#63e4fd] focus:tw-bg-[#038cb7] tw-shadow-sm hover:tw-shadow-md tw-flex tw-items-center tw-gap-2">
                                    <i class="fas fa-save"></i>
                                    Save Changes
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Add this at the bottom of your form -->
                    <div class="tw-border-t tw-mt-8 tw-pt-6">
                        <h3 class="tw-text-red-500 tw-font-semibold tw-mb-2">Danger Zone</h3>
                        <button type="button" onclick="confirmAccountDeletion()" 
                            class="tw-text-red-500 hover:tw-text-red-700 tw-text-sm">
                            <i class="fas fa-trash-alt tw-mr-1"></i> Delete Account
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Profile image preview
    document.getElementById('profile_image').addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.querySelector('.tw-w-32.tw-h-32 img').src = e.target.result;
            };
            reader.readAsDataURL(e.target.files[0]);
        }
    });

    // Form submission with SweetAlert
    function confirmUpdate() {
        Swal.fire({
            title: 'Save Changes?',
            text: 'Are you sure you want to update your profile?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#24CFF4',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save changes',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("accountupdate").submit();
            }
        });
    }

    // Initialize SweetAlert messages
    @if(session('success'))
        Swal.fire({
            title: 'Success!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonColor: '#24CFF4'
        });
    @endif

    @if($errors->any())
        Swal.fire({
            title: 'Error!',
            html: "{!! implode('<br>', $errors->all()) !!}",
            icon: 'error',
            confirmButtonColor: '#24CFF4'
        });
    @endif

    // Account deletion confirmation
    function confirmAccountDeletion() {
        Swal.fire({
            title: 'Delete Account?',
            text: 'This action cannot be undone. Are you sure?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete account',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('{{ route('account.delete') }}', {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                }).then(response => {
                    if (response.ok) {
                        Swal.fire('Error!', 'Failed to delete your account.', 'error');
                        
                    } else {
                        window.location.href = '{{ route('login') }}';
                    }
                });
            }
        });
    }
</script>

@endsection
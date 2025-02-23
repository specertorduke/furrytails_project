@extends('main')

@section('title', 'Account')

@section('content')
<div class="tw-p-6 tw-bg-gradient-to-tl tw-h-screen tw-to-[#b7f4ff]  tw-from-white">
    <div class="tw-flex tw-justify-between tw-items-center tw-mb-6">
        <div>
            <p class="tw-text-sm tw-text-gray-500">Pages / Account Settings</p>
            <h1 class="tw-text-2xl tw-font-bold">Account Settings</h1>
        </div>
    </div>

    <!-- Account Settings Content -->
    <div class="tw-bg-white tw-shadow-sm tw-rounded-lg tw-p-6 tw-transition-all tw-duration-300 tw-ease-in-out hover:tw-shadow-lg">
        <h2 class="tw-text-xl tw-font-bold tw-mb-4">Profile Information</h2>
        <form method="POST" action="{{ route('account.update') }}">
            @csrf
            @method('PUT')  

            <div class="tw-mb-4">
                <label for="userName" class="tw-block tw-text-sm tw-font-normal tw-text-gray-700">Username </label>
                <input type="text" id="username" name="username" value="{{ old('username', Auth::user()->username) }}" required 
                    class="tw-mt-1 tw-w-full tw-px-3 tw-py-2 tw-border tw-rounded-md tw-shadow-sm focus:tw-ring-indigo-500 focus:tw-border-indigo-500">
            </div>

            <div class="tw-mb-4">
                <label for="firstName" class="tw-block tw-text-sm tw-font-normal tw-text-gray-700">First Name</label>
                <input type="text" id="firstName" name="firstName" value="{{ old('firstName', Auth::user()->firstName) }}" required 
                    class="tw-mt-1 tw-w-full tw-px-3 tw-py-2 tw-border tw-rounded-md tw-shadow-sm focus:tw-ring-indigo-500 focus:tw-border-indigo-500">
            </div>

            <div class="tw-mb-4">
                <label for="lastName" class="tw-block tw-text-sm tw-font-normal tw-text-gray-700">Last Name</label>
                <input type="text" id="lastName" name="lastName" value="{{ old('lastName', Auth::user()->lastName) }}" required 
                    class="tw-mt-1 tw-w-full tw-px-3 tw-py-2 tw-border tw-rounded-md tw-shadow-sm focus:tw-ring-indigo-500 focus:tw-border-indigo-500">
            </div>

            <div class="tw-mb-4">
                <label for="email" class="tw-block tw-text-sm tw-font-normal tw-text-gray-700">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required 
                    class="tw-mt-1 tw-w-full tw-px-3 tw-py-2 tw-border tw-rounded-md tw-shadow-sm focus:tw-ring-indigo-500 focus:tw-border-indigo-500">
            </div>

            <div class="tw-mb-4">
                <label for="phoneNumber" class="tw-block tw-text-sm tw-font-normal tw-text-gray-700">Contact Number</label>
                <input type="text" id="phoneNumber" name="phoneNumber" value="{{ old('phone', Auth::user()->phone) }}" required 
                    class="tw-mt-1 tw-w-full tw-px-3 tw-py-2 tw-border tw-rounded-md tw-shadow-sm focus:tw-ring-indigo-500 focus:tw-border-indigo-500">
            </div>

            <div class="tw-mb-4">
                <label for="password" class="tw-block tw-text-sm tw-font-normal tw-text-gray-700">New Password</label>
                <input type="password" id="password" name="password" 
                    class="tw-mt-1 tw-w-full tw-px-3 tw-py-2 tw-border tw-rounded-md tw-shadow-sm focus:tw-ring-indigo-500 focus:tw-border-indigo-500">
                <span class="tw-text-xs tw-text-gray-500">Leave blank to keep your current password</span>
            </div>

            <div class="tw-mb-4">
                <label for="password_confirmation" class="tw-block tw-text-sm tw-font-normal tw-text-gray-700">Confirm New Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" 
                    class="tw-mt-1 tw-w-full tw-px-3 tw-py-2 tw-border tw-rounded-md tw-shadow-sm focus:tw-ring-indigo-500 focus:tw-border-indigo-500">
            </div>

            <button type="submit" class="tw-bg-[#24CFF4] tw-text-white tw-font-bold tw-py-2 tw-px-4 tw-rounded-full tw-transition-all tw-duration-300 tw-ease-in-out hover:tw-bg-[#63e4fd] focus:tw-bg-[#038cb7]">
                Update Profile
            </button>
        </form>
    </div>
</div>

@endsection 
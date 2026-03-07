@extends('admin.adminLayout')

@section('title', 'Account Settings')

@section('content')
@php $user = Auth::user(); @endphp

<div class="tw-p-6 tw-min-h-screen tw-bg-gray-900">

    <!-- Page Header -->
    <div class="tw-mb-6">
        <p class="tw-text-xs tw-text-gray-500 tw-uppercase tw-tracking-wider">Administration / Account Settings</p>
        <h1 class="tw-text-2xl tw-font-bold tw-text-white tw-mt-1">Account Settings</h1>
    </div>

    <div class="tw-grid tw-grid-cols-1 lg:tw-grid-cols-3 tw-gap-6">

        <!-- â”€â”€ Left: Profile Card â”€â”€ -->
        <div class="lg:tw-col-span-1 tw-space-y-4">

            <!-- Avatar + Info Card -->
            <div class="tw-bg-gray-800 tw-rounded-2xl tw-border tw-border-gray-700 tw-p-6">
                <div class="tw-flex tw-flex-col tw-items-center tw-text-center">

                    <!-- Clickable avatar with camera overlay -->
                    <div class="tw-relative tw-group tw-cursor-pointer" onclick="document.getElementById('profile_image').click()">
                        <div class="tw-w-28 tw-h-28 tw-rounded-full tw-overflow-hidden tw-ring-4 tw-ring-[#24CFF4]/25">
                            <img id="profile-preview"
                                src="{{ $user->profile_image_url }}"
                                alt="Profile"
                                class="tw-w-full tw-h-full tw-object-cover">
                        </div>
                        <div class="tw-absolute tw-inset-0 tw-rounded-full tw-bg-black/0 group-hover:tw-bg-black/50 tw-flex tw-items-center tw-justify-center tw-transition-all tw-duration-200">
                            <i class="fas fa-camera tw-text-white tw-text-xl tw-opacity-0 group-hover:tw-opacity-100 tw-transition-all tw-duration-200"></i>
                        </div>
                        <span class="tw-absolute tw-bottom-0 tw-right-1 tw-w-7 tw-h-7 tw-bg-[#24CFF4] tw-rounded-full tw-flex tw-items-center tw-justify-center tw-shadow-md">
                            <i class="fas fa-pen tw-text-white tw-text-xs"></i>
                        </span>
                    </div>
                    <input type="file" id="profile_image" class="tw-hidden" accept="image/*">

                    <h2 class="tw-mt-4 tw-text-lg tw-font-semibold tw-text-white">{{ $user->firstName }} {{ $user->lastName }}</h2>
                    <p class="tw-text-gray-400 tw-text-sm tw-mt-0.5">{{ '@' . $user->username }}</p>
                    <span class="tw-mt-2 tw-px-3 tw-py-1 tw-rounded-full tw-text-xs tw-font-semibold {{ $user->adminRoleColor }}">
                        {{ $user->adminRoleLabel }}
                    </span>
                </div>

                <!-- Info list -->
                <div class="tw-mt-6 tw-pt-4 tw-border-t tw-border-gray-700 tw-space-y-3">
                    <div class="tw-flex tw-items-center tw-gap-3">
                        <div class="tw-w-7 tw-h-7 tw-rounded-lg tw-bg-gray-700 tw-flex tw-items-center tw-justify-center tw-flex-shrink-0">
                            <i class="fas fa-envelope tw-text-gray-400 tw-text-xs"></i>
                        </div>
                        <span class="tw-text-gray-300 tw-text-sm tw-truncate">{{ $user->email }}</span>
                    </div>
                    <div class="tw-flex tw-items-center tw-gap-3">
                        <div class="tw-w-7 tw-h-7 tw-rounded-lg tw-bg-gray-700 tw-flex tw-items-center tw-justify-center tw-flex-shrink-0">
                            <i class="fas fa-phone tw-text-gray-400 tw-text-xs"></i>
                        </div>
                        <span class="tw-text-gray-300 tw-text-sm">{{ $user->phone ?: 'â€”' }}</span>
                    </div>
                    <div class="tw-flex tw-items-center tw-gap-3">
                        <div class="tw-w-7 tw-h-7 tw-rounded-lg tw-bg-gray-700 tw-flex tw-items-center tw-justify-center tw-flex-shrink-0">
                            <i class="fas fa-calendar-alt tw-text-gray-400 tw-text-xs"></i>
                        </div>
                        <span class="tw-text-gray-300 tw-text-sm">Since {{ $user->created_at->format('M Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Danger Zone Card -->
            <div class="tw-bg-gray-800 tw-rounded-2xl tw-border tw-border-red-900/40 tw-p-5">
                <p class="tw-text-xs tw-font-semibold tw-text-red-400 tw-uppercase tw-tracking-wider tw-mb-3">Danger Zone</p>
                <button type="button" onclick="confirmAdminLogout()"
                    class="tw-w-full tw-flex tw-items-center tw-justify-center tw-gap-2 tw-py-2.5 tw-px-4 tw-rounded-xl tw-border tw-border-red-800 tw-text-red-400 hover:tw-bg-red-950/50 tw-transition-colors tw-text-sm tw-font-medium">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout All Devices
                </button>
            </div>
        </div>

        <!-- â”€â”€ Right: Settings Tabs â”€â”€ -->
        <div class="lg:tw-col-span-2">
            <div class="tw-bg-gray-800 tw-rounded-2xl tw-border tw-border-gray-700 tw-overflow-hidden">

                <!-- Tab Navigation -->
                <div class="tw-flex tw-border-b tw-border-gray-700 tw-bg-gray-800/80">
                    <button type="button" id="tab-profile" onclick="switchTab('profile')"
                        class="tw-flex tw-items-center tw-gap-2 tw-px-6 tw-py-4 tw-text-sm tw-font-medium tw-transition-all tw-duration-150 tw-border-b-2 tw-border-[#24CFF4] tw-text-[#24CFF4]">
                        <i class="fas fa-user tw-text-xs"></i> Profile
                    </button>
                    <button type="button" id="tab-security" onclick="switchTab('security')"
                        class="tw-flex tw-items-center tw-gap-2 tw-px-6 tw-py-4 tw-text-sm tw-font-medium tw-transition-all tw-duration-150 tw-border-b-2 tw-border-transparent tw-text-gray-400 hover:tw-text-gray-200">
                        <i class="fas fa-shield-alt tw-text-xs"></i> Security
                    </button>
                </div>

                <form method="POST" action="{{ route('admin.account.update') }}" enctype="multipart/form-data" id="accountForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="cropped_image" id="cropped_image_data">
                    <input type="hidden" name="active_tab" id="active_tab" value="profile">

                    <!-- â”€â”€ Profile Panel â”€â”€ -->
                    <div id="panel-profile" class="tw-p-6">
                        <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-5">

                            <!-- Username (full width) -->
                            <div class="md:tw-col-span-2">
                                <label class="tw-block tw-text-xs tw-font-semibold tw-text-gray-400 tw-uppercase tw-tracking-wider tw-mb-2">Username</label>
                                <div class="tw-relative">
                                    <span class="tw-absolute tw-inset-y-0 tw-left-3.5 tw-flex tw-items-center tw-text-gray-500 tw-text-sm">@</span>
                                    <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}" required
                                        class="tw-w-full tw-bg-gray-700/60 tw-border tw-border-gray-600 hover:tw-border-gray-500 focus:tw-border-[#24CFF4] tw-rounded-xl tw-pl-9 tw-pr-4 tw-py-2.5 tw-text-white tw-text-sm tw-outline-none tw-transition-colors">
                                </div>
                                <p id="username-feedback" class="tw-text-xs tw-mt-1.5 tw-hidden"></p>
                            </div>

                            <!-- First Name -->
                            <div>
                                <label class="tw-block tw-text-xs tw-font-semibold tw-text-gray-400 tw-uppercase tw-tracking-wider tw-mb-2">First Name</label>
                                <input type="text" id="firstName" name="firstName" value="{{ old('firstName', $user->firstName) }}" required
                                    class="tw-w-full tw-bg-gray-700/60 tw-border tw-border-gray-600 hover:tw-border-gray-500 focus:tw-border-[#24CFF4] tw-rounded-xl tw-px-4 tw-py-2.5 tw-text-white tw-text-sm tw-outline-none tw-transition-colors">
                                <p id="firstName-feedback" class="tw-text-xs tw-mt-1.5 tw-hidden"></p>
                            </div>

                            <!-- Last Name -->
                            <div>
                                <label class="tw-block tw-text-xs tw-font-semibold tw-text-gray-400 tw-uppercase tw-tracking-wider tw-mb-2">Last Name</label>
                                <input type="text" id="lastName" name="lastName" value="{{ old('lastName', $user->lastName) }}" required
                                    class="tw-w-full tw-bg-gray-700/60 tw-border tw-border-gray-600 hover:tw-border-gray-500 focus:tw-border-[#24CFF4] tw-rounded-xl tw-px-4 tw-py-2.5 tw-text-white tw-text-sm tw-outline-none tw-transition-colors">
                                <p id="lastName-feedback" class="tw-text-xs tw-mt-1.5 tw-hidden"></p>
                            </div>

                            <!-- Email (full width) -->
                            <div class="md:tw-col-span-2">
                                <label class="tw-block tw-text-xs tw-font-semibold tw-text-gray-400 tw-uppercase tw-tracking-wider tw-mb-2">Email Address</label>
                                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                                    class="tw-w-full tw-bg-gray-700/60 tw-border tw-border-gray-600 hover:tw-border-gray-500 focus:tw-border-[#24CFF4] tw-rounded-xl tw-px-4 tw-py-2.5 tw-text-white tw-text-sm tw-outline-none tw-transition-colors">
                                <p id="email-feedback" class="tw-text-xs tw-mt-1.5 tw-hidden"></p>
                            </div>

                            <!-- Phone (full width) -->
                            <div class="md:tw-col-span-2">
                                <label class="tw-block tw-text-xs tw-font-semibold tw-text-gray-400 tw-uppercase tw-tracking-wider tw-mb-2">Phone Number</label>
                                <div class="tw-flex">
                                    <span class="tw-inline-flex tw-items-center tw-px-3.5 tw-bg-gray-700 tw-border tw-border-r-0 tw-border-gray-600 tw-rounded-l-xl tw-text-gray-300 tw-text-sm tw-font-medium">+63</span>
                                    <input type="tel" id="phoneNumber" name="phone"
                                        value="{{ old('phone', $user->phone ? (str_starts_with($user->phone, '+63') ? substr($user->phone, 3) : $user->phone) : '') }}"
                                        maxlength="12" placeholder="9XX XXX XXXX"
                                        class="tw-flex-1 tw-bg-gray-700/60 tw-border tw-border-gray-600 hover:tw-border-gray-500 focus:tw-border-[#24CFF4] tw-rounded-r-xl tw-px-4 tw-py-2.5 tw-text-white tw-text-sm tw-outline-none tw-transition-colors">
                                </div>
                                <div class="tw-flex tw-justify-between tw-mt-1.5">
                                    <span class="tw-text-xs tw-text-gray-500">Format: 9XX XXX XXXX</span>
                                    <p id="phone-feedback" class="tw-text-xs tw-hidden"></p>
                                </div>
                            </div>
                        </div>

                        <!-- Save Button -->
                        <div class="tw-flex tw-justify-end tw-mt-6 tw-pt-4 tw-border-t tw-border-gray-700">
                            <button type="button" onclick="confirmUpdate()"
                                class="tw-inline-flex tw-items-center tw-gap-2 tw-px-5 tw-py-2.5 tw-bg-[#24CFF4] hover:tw-bg-[#1ab8db] tw-text-white tw-rounded-xl tw-text-sm tw-font-semibold tw-transition-colors tw-shadow-md">
                                <i class="fas fa-save"></i> Save Changes
                            </button>
                        </div>
                    </div>

                    <!-- â”€â”€ Security Panel â”€â”€ -->
                    <div id="panel-security" class="tw-p-6 tw-hidden">
                        <p class="tw-text-sm tw-text-gray-400 tw-mb-5">Leave the password fields blank to keep your current password.</p>

                        <div class="tw-grid tw-grid-cols-1 tw-gap-5 tw-max-w-lg">
                            <!-- New Password -->
                            <div>
                                <label class="tw-block tw-text-xs tw-font-semibold tw-text-gray-400 tw-uppercase tw-tracking-wider tw-mb-2">New Password</label>
                                <div class="tw-relative">
                                    <input type="password" id="password" name="password" placeholder="Enter new password"
                                        class="tw-w-full tw-bg-gray-700/60 tw-border tw-border-gray-600 hover:tw-border-gray-500 focus:tw-border-[#24CFF4] tw-rounded-xl tw-px-4 tw-py-2.5 tw-pr-12 tw-text-white tw-text-sm tw-outline-none tw-transition-colors">
                                    <button type="button" onclick="togglePwd('password')" class="tw-absolute tw-inset-y-0 tw-right-3.5 tw-text-gray-500 hover:tw-text-gray-300 tw-transition-colors">
                                        <i id="eye-password" class="fas fa-eye-slash"></i>
                                    </button>
                                </div>
                                <p id="password-strength" class="tw-text-xs tw-mt-1.5 tw-hidden"></p>
                            </div>

                            <!-- Confirm Password -->
                            <div>
                                <label class="tw-block tw-text-xs tw-font-semibold tw-text-gray-400 tw-uppercase tw-tracking-wider tw-mb-2">Confirm New Password</label>
                                <div class="tw-relative">
                                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm new password"
                                        class="tw-w-full tw-bg-gray-700/60 tw-border tw-border-gray-600 hover:tw-border-gray-500 focus:tw-border-[#24CFF4] tw-rounded-xl tw-px-4 tw-py-2.5 tw-pr-12 tw-text-white tw-text-sm tw-outline-none tw-transition-colors">
                                    <button type="button" onclick="togglePwd('password_confirmation')" class="tw-absolute tw-inset-y-0 tw-right-3.5 tw-text-gray-500 hover:tw-text-gray-300 tw-transition-colors">
                                        <i id="eye-password_confirmation" class="fas fa-eye-slash"></i>
                                    </button>
                                </div>
                                <p id="password-match" class="tw-text-xs tw-mt-1.5 tw-hidden"></p>
                            </div>
                        </div>

                        <!-- Save Button -->
                        <div class="tw-flex tw-justify-end tw-mt-6 tw-pt-4 tw-border-t tw-border-gray-700">
                            <button type="button" onclick="confirmUpdate()"
                                class="tw-inline-flex tw-items-center tw-gap-2 tw-px-5 tw-py-2.5 tw-bg-[#24CFF4] hover:tw-bg-[#1ab8db] tw-text-white tw-rounded-xl tw-text-sm tw-font-semibold tw-transition-colors tw-shadow-md">
                                <i class="fas fa-lock"></i> Update Password
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<!-- Cropper Modal -->
<div id="cropperModal" class="tw-hidden tw-fixed tw-inset-0 tw-z-50 tw-flex tw-items-center tw-justify-center tw-bg-black/60 tw-backdrop-blur-sm">
    <div class="tw-bg-gray-800 tw-rounded-2xl tw-shadow-2xl tw-border tw-border-gray-700 tw-w-full tw-max-w-md tw-mx-4 tw-p-6">
        <div class="tw-flex tw-justify-between tw-items-center tw-mb-4">
            <h3 class="tw-text-lg tw-font-bold tw-text-white">Crop Profile Photo</h3>
            <button type="button" id="closeCropModal" class="tw-w-8 tw-h-8 tw-rounded-lg tw-bg-gray-700 hover:tw-bg-gray-600 tw-text-gray-400 hover:tw-text-white tw-flex tw-items-center tw-justify-center tw-transition-colors">
                <i class="fas fa-times tw-text-xs"></i>
            </button>
        </div>
        <div class="tw-bg-gray-900/50 tw-rounded-xl tw-overflow-hidden tw-p-2">
            <img id="cropperImage" src="" alt="Crop" class="tw-max-w-full tw-block">
        </div>
        <div class="tw-flex tw-justify-end tw-gap-2 tw-mt-4">
            <button type="button" id="cancelCrop"
                class="tw-px-4 tw-py-2 tw-rounded-xl tw-bg-gray-700 hover:tw-bg-gray-600 tw-text-gray-300 tw-text-sm tw-transition-colors">
                Cancel
            </button>
            <button type="button" id="saveCrop"
                class="tw-px-4 tw-py-2 tw-rounded-xl tw-bg-[#24CFF4] hover:tw-bg-[#1ab8db] tw-text-white tw-text-sm tw-font-semibold tw-transition-colors">
                <i class="fas fa-crop-alt tw-mr-1"></i> Apply Crop
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    let cropper;

    // -- Real-time validation ------------------------------------------------
    const validateFieldUrl = "{{ route('admin.account.validate-field') }}";
    const fieldState = {
        username: { available: null, pending: false },
        email:    { available: null, pending: false },
        phone:    { available: null, pending: false },
    };
    const debounceTimers = {};

    function setFeedback(id, message, type) {
        const el = document.getElementById(id);
        if (!el) return;
        el.classList.remove('tw-hidden','tw-text-gray-400','tw-text-red-400','tw-text-green-400','tw-text-amber-400');
        if (!message) { el.classList.add('tw-hidden'); el.innerHTML = ''; return; }
        const colorMap = { error: 'tw-text-red-400', success: 'tw-text-green-400', warning: 'tw-text-amber-400' };
        el.classList.add(colorMap[type] || 'tw-text-gray-400');
        el.innerHTML = message;
    }

    function queueCheck(field, value, delay) {
        clearTimeout(debounceTimers[field]);
        debounceTimers[field] = setTimeout(function() { checkAvailability(field, value); }, delay || 350);
    }

    async function checkAvailability(field, value) {
        fieldState[field].pending = true;
        const feedbackId = field + '-feedback';
        try {
            const res = await fetch(validateFieldUrl + '?' + new URLSearchParams({ field: field, value: value }), {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            const data = await res.json();
            fieldState[field].available = !!data.available;
            fieldState[field].pending = false;
            const icon = data.available ? 'fa-check-circle' : 'fa-exclamation-circle';
            setFeedback(feedbackId, '<i class="fas ' + icon + ' tw-mr-1"></i>' + data.message, data.available ? 'success' : 'error');
        } catch (e) {
            fieldState[field].available = false;
            fieldState[field].pending = false;
            setFeedback(feedbackId, '<i class="fas fa-exclamation-circle tw-mr-1"></i> Unable to validate right now.', 'warning');
        }
    }

    function validatePasswords() {
        const pwd  = document.getElementById('password').value;
        const conf = document.getElementById('password_confirmation').value;
        if (pwd.length > 0) {
            const strong = pwd.length >= 8 && /[a-zA-Z]/.test(pwd) && /\d/.test(pwd) && /[!@#$%^&*(),.?":{}|<>]/.test(pwd);
            setFeedback('password-strength',
                strong ? '<i class="fas fa-check-circle tw-mr-1"></i> Strong password'
                       : 'Must have 8+ chars, letters, numbers & symbols',
                strong ? 'success' : 'error');
        } else {
            setFeedback('password-strength', '');
        }
        if (pwd.length > 0 && conf.length > 0) {
            if (pwd === conf) setFeedback('password-match', '<i class="fas fa-check-circle tw-mr-1"></i> Passwords match', 'success');
            else              setFeedback('password-match', '<i class="fas fa-exclamation-circle tw-mr-1"></i> Passwords do not match', 'error');
        } else {
            setFeedback('password-match', '');
        }
    }

    // -- Field listeners -----------------------------------------------------
    const usernameEl = document.getElementById('username');
    if (usernameEl) {
        usernameEl.addEventListener('input', function() {
            const val = this.value.trim();
            fieldState.username.available = null;
            if (!val) { setFeedback('username-feedback', ''); return; }
            if (val.length < 5) { setFeedback('username-feedback', 'Username must be at least 5 characters.', 'error'); return; }
            setFeedback('username-feedback', '<i class="fas fa-spinner fa-spin tw-mr-1"></i> Checking...', 'warning');
            queueCheck('username', val);
        });
    }

    const emailEl = document.getElementById('email');
    if (emailEl) {
        emailEl.addEventListener('input', function() {
            const val = this.value.trim();
            fieldState.email.available = null;
            if (!val) { setFeedback('email-feedback', ''); return; }
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val)) { setFeedback('email-feedback', 'Please enter a valid email address.', 'error'); return; }
            setFeedback('email-feedback', '<i class="fas fa-spinner fa-spin tw-mr-1"></i> Checking...', 'warning');
            queueCheck('email', val);
        });
    }

    const firstNameEl = document.getElementById('firstName');
    if (firstNameEl) {
        firstNameEl.addEventListener('input', function() {
            setFeedback('firstName-feedback', this.value.trim() ? '' : 'First name cannot be empty.', 'error');
        });
    }

    const lastNameEl = document.getElementById('lastName');
    if (lastNameEl) {
        lastNameEl.addEventListener('input', function() {
            setFeedback('lastName-feedback', this.value.trim() ? '' : 'Last name cannot be empty.', 'error');
        });
    }

    document.getElementById('password').addEventListener('input', validatePasswords);
    document.getElementById('password_confirmation').addEventListener('input', validatePasswords);

    // â”€â”€ Tab switching â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€
    window.switchTab = function(tab) {
        ['profile', 'security'].forEach(function(t) {
            const panel = document.getElementById('panel-' + t);
            const btn   = document.getElementById('tab-' + t);
            if (t === tab) {
                panel.classList.remove('tw-hidden');
                btn.classList.add('tw-border-[#24CFF4]', 'tw-text-[#24CFF4]');
                btn.classList.remove('tw-border-transparent', 'tw-text-gray-400');
            } else {
                panel.classList.add('tw-hidden');
                btn.classList.remove('tw-border-[#24CFF4]', 'tw-text-[#24CFF4]');
                btn.classList.add('tw-border-transparent', 'tw-text-gray-400');
            }
        });
        document.getElementById('active_tab').value = tab;
    };

    // â”€â”€ Password visibility toggle â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€
    window.togglePwd = function(fieldId) {
        const input = document.getElementById(fieldId);
        const icon  = document.getElementById('eye-' + fieldId);
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        }
    };

    // â”€â”€ Phone formatting â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€
    // -- Phone formatting & validation -------------------------------------
    const phoneInput = document.getElementById('phoneNumber');
    if (phoneInput) {
        phoneInput.addEventListener('input', function(e) {
            let val = e.target.value.replace(/\D/g, '');
            if (val.length > 10) val = val.slice(0, 10);
            if (val.length > 6)      val = val.slice(0, 3) + ' ' + val.slice(3, 6) + ' ' + val.slice(6);
            else if (val.length > 3) val = val.slice(0, 3) + ' ' + val.slice(3);
            e.target.value = val;
            fieldState.phone.available = null;
            if (!val) { setFeedback('phone-feedback', ''); return; }
            if (!/^9\d{2}\s?\d{3}\s?\d{4}$/.test(val)) {
                setFeedback('phone-feedback', '<i class="fas fa-exclamation-circle tw-mr-1"></i> Invalid format. Use 9XX XXX XXXX.', 'error');
                return;
            }
            setFeedback('phone-feedback', '<i class="fas fa-spinner fa-spin tw-mr-1"></i> Checking phone...', 'warning');
            queueCheck('phone', val);
        });
    }

    // â”€â”€ Profile image â†’ Cropper â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€
    const cropperModal = document.getElementById('cropperModal');
    const cropperImage = document.getElementById('cropperImage');

    document.getElementById('profile_image').addEventListener('change', function(e) {
        if (!e.target.files || !e.target.files[0]) return;
        const reader = new FileReader();
        reader.onload = function(ev) {
            cropperImage.src = ev.target.result;
            cropperModal.classList.remove('tw-hidden');
            if (cropper) cropper.destroy();
            cropper = new Cropper(cropperImage, {
                aspectRatio: 1, viewMode: 1, dragMode: 'move',
                autoCropArea: 1, restore: false, guides: true,
                center: true, highlight: false, cropBoxMovable: true, cropBoxResizable: true,
            });
        };
        reader.readAsDataURL(e.target.files[0]);
    });

    function closeCropper() {
        cropperModal.classList.add('tw-hidden');
        if (cropper) { cropper.destroy(); cropper = null; }
    }

    document.getElementById('closeCropModal').addEventListener('click', closeCropper);
    document.getElementById('cancelCrop').addEventListener('click', closeCropper);

    document.getElementById('saveCrop').addEventListener('click', function() {
        const dataUrl = cropper.getCroppedCanvas({ width: 300, height: 300 }).toDataURL('image/jpeg');
        document.getElementById('profile-preview').src = dataUrl;
        document.getElementById('cropped_image_data').value = dataUrl;
        closeCropper();
    });

    // â”€â”€ Confirm update â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€
    // -- Confirm update -------------------------------------------------------
    function hasErrors(feedbackIds, errorClass) {
        return feedbackIds.some(function(id) {
            const el = document.getElementById(id);
            return el && !el.classList.contains('tw-hidden') && el.classList.contains(errorClass);
        });
    }

    window.confirmUpdate = function() {
        const activeTab = document.getElementById('active_tab').value;

        // Block while async checks are running
        if (fieldState.username.pending || fieldState.email.pending || fieldState.phone.pending) {
            Swal.fire({ title: 'Please wait', text: 'Still validating your inputs, try again in a moment.', icon: 'info',
                confirmButtonColor: '#24CFF4', background: '#1f2937', color: '#f9fafb' });
            return;
        }

        if (activeTab === 'profile') {
            // Required fields
            const fn = document.getElementById('firstName').value.trim();
            const ln = document.getElementById('lastName').value.trim();
            const un = document.getElementById('username').value.trim();
            const em = document.getElementById('email').value.trim();
            if (!fn || !ln || !un || !em) {
                Swal.fire({ title: 'Missing fields', text: 'Please fill in all required fields.', icon: 'error',
                    confirmButtonColor: '#24CFF4', background: '#1f2937', color: '#f9fafb' });
                return;
            }
            // Any red feedback in profile panel
            if (hasErrors(['firstName-feedback','lastName-feedback','username-feedback','email-feedback','phone-feedback'], 'tw-text-red-400')) {
                Swal.fire({ title: 'Fix errors first', text: 'Please correct the highlighted fields before saving.', icon: 'error',
                    confirmButtonColor: '#24CFF4', background: '#1f2937', color: '#f9fafb' });
                return;
            }
            // Uniqueness failures
            if (fieldState.username.available === false || fieldState.email.available === false || fieldState.phone.available === false) {
                Swal.fire({ title: 'Fix errors first', text: 'Username, email or phone is already taken.', icon: 'error',
                    confirmButtonColor: '#24CFF4', background: '#1f2937', color: '#f9fafb' });
                return;
            }
            // Phone format
            const pInput = document.getElementById('phoneNumber');
            const pValue = pInput ? pInput.value.trim() : '';
            if (pValue && !/^9\d{2}\s?\d{3}\s?\d{4}$/.test(pValue)) {
                setFeedback('phone-feedback', '<i class="fas fa-exclamation-circle tw-mr-1"></i> Invalid format. Use 9XX XXX XXXX.', 'error');
                pInput.focus();
                return;
            }
            // Build full_phone hidden input
            const oldH = document.querySelector('input[name="full_phone"]');
            if (oldH) oldH.remove();
            if (pValue) {
                const h = document.createElement('input');
                h.type = 'hidden'; h.name = 'full_phone';
                h.value = '+63' + pValue.replace(/\s/g, '');
                document.getElementById('accountForm').appendChild(h);
            }
        } else {
            // Security tab
            const pwd  = document.getElementById('password').value;
            const conf = document.getElementById('password_confirmation').value;
            if (pwd) {
                const strong = pwd.length >= 8 && /[a-zA-Z]/.test(pwd) && /\d/.test(pwd) && /[!@#$%^&*(),.?":{}|<>]/.test(pwd);
                if (!strong) {
                    Swal.fire({ title: 'Weak password', text: 'Password must have 8+ characters, letters, numbers & symbols.', icon: 'error',
                        confirmButtonColor: '#24CFF4', background: '#1f2937', color: '#f9fafb' });
                    return;
                }
                if (pwd !== conf) {
                    Swal.fire({ title: 'Passwords do not match', text: 'Please make sure both password fields match.', icon: 'error',
                        confirmButtonColor: '#24CFF4', background: '#1f2937', color: '#f9fafb' });
                    return;
                }
            }
        }

        Swal.fire({
            title: 'Save Changes?',
            text: 'Are you sure you want to update your profile?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#24CFF4',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Yes, save changes',
            cancelButtonText: 'Cancel',
            background: '#1f2937',
            color: '#f9fafb'
        }).then(function(result) {
            if (result.isConfirmed) {
                document.getElementById('accountForm').setAttribute('data-confirmed', 'true');
                document.getElementById('accountForm').submit();
            } else {
                const h2 = document.querySelector('input[name="full_phone"]');
                if (h2) h2.remove();
            }
        });
    };

    document.getElementById('accountForm').addEventListener('submit', function(e) {
        if (!this.hasAttribute('data-confirmed')) {
            e.preventDefault();
            window.confirmUpdate();
        }
    });

    // â”€â”€ Logout all devices â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€
    window.confirmAdminLogout = function() {
        Swal.fire({
            title: 'Log Out From All Devices?',
            text: 'This will revoke all active sessions. You will need to log in again.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Yes, log out everywhere',
            cancelButtonText: 'Cancel',
            background: '#1f2937',
            color: '#f9fafb'
        }).then(function(result) {
            if (result.isConfirmed) {
                window.location.href = "{{ route('admin.logout.devices') }}";
            }
        });
    };

    // â”€â”€ Session flash â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€
    // -- Session flash -------------------------------------------------------
    @if(session('success'))
        Swal.fire({ title: 'Success!', text: "{{ session('success') }}", icon: 'success',
            confirmButtonColor: '#24CFF4', background: '#1f2937', color: '#f9fafb' });
    @endif

    @if($errors->any())
        Swal.fire({ title: 'Error!', html: "{!! implode('<br>', $errors->all()) !!}", icon: 'error',
            confirmButtonColor: '#24CFF4', background: '#1f2937', color: '#f9fafb' });
    @endif
});
</script>
@endpush

@endsection

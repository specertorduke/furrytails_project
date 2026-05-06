@extends('main')

@section('title', 'Account')

@section('content')
@php $user = Auth::user(); @endphp

<div id="user-account-settings" class="tw-p-6 tw-min-h-screen tw-bg-gradient-to-br tw-from-white tw-to-[#e0f9fd]">

    <!-- Page Header -->
    <div class="tw-mb-6">
        <h1 class="tw-text-2xl tw-font-bold tw-text-gray-800">Account Settings</h1>
        <p class="tw-text-sm tw-text-gray-500 tw-mt-0.5">Manage your profile and security settings</p>
    </div>

    <div class="tw-grid tw-grid-cols-1 lg:tw-grid-cols-3 tw-gap-6">

        <!-- ── Left: Profile Card ── -->
        <div class="lg:tw-col-span-1 tw-space-y-4">

            <!-- Avatar + Info Card -->
            <div class="tw-bg-white tw-rounded-2xl tw-border tw-border-gray-100 tw-shadow-sm tw-p-6">
                <div class="tw-flex tw-flex-col tw-items-center tw-text-center">

                    <!-- Clickable avatar with camera overlay -->
                    <div class="tw-relative tw-group tw-cursor-pointer" onclick="document.getElementById('profile_image').click()">
                        <div class="tw-w-28 tw-h-28 tw-rounded-full tw-overflow-hidden tw-ring-4 tw-ring-[#24CFF4]/25">
                            <img id="profile-preview"
                                src="{{ $user->profile_image_url }}"
                                data-original-src="{{ $user->profile_image_url }}"
                                alt="Profile"
                                class="tw-w-full tw-h-full tw-object-cover">
                        </div>
                        <div class="tw-absolute tw-inset-0 tw-rounded-full tw-bg-black/0 group-hover:tw-bg-black/40 tw-flex tw-items-center tw-justify-center tw-transition-all tw-duration-200">
                            <i class="fas fa-camera tw-text-white tw-text-xl tw-opacity-0 group-hover:tw-opacity-100 tw-transition-all tw-duration-200"></i>
                        </div>
                        <span class="tw-absolute tw-bottom-0 tw-right-1 tw-w-7 tw-h-7 tw-bg-[#24CFF4] tw-rounded-full tw-flex tw-items-center tw-justify-center tw-shadow-md">
                            <i class="fas fa-pen tw-text-white tw-text-xs"></i>
                        </span>
                    </div>
                    <input type="file" id="profile_image" name="profile_image" class="tw-hidden" accept="image/*">

                    <h2 class="tw-mt-4 tw-text-lg tw-font-semibold tw-text-gray-800">{{ $user->firstName }} {{ $user->lastName }}</h2>
                    <p class="tw-text-gray-500 tw-text-sm tw-mt-0.5">{{ '@' . $user->username }}</p>
                    <span class="tw-mt-2 tw-px-3 tw-py-1 tw-rounded-full tw-text-xs tw-font-semibold tw-bg-[#24CFF4]/15 tw-text-[#038cb7]">
                        Customer
                    </span>
                </div>

                <!-- Info list -->
                <div class="tw-mt-6 tw-pt-4 tw-border-t tw-border-gray-100 tw-space-y-3">
                    <div class="tw-flex tw-items-center tw-gap-3">
                        <div class="tw-w-7 tw-h-7 tw-rounded-lg tw-bg-[#24CFF4]/10 tw-flex tw-items-center tw-justify-center tw-flex-shrink-0">
                            <i class="fas fa-envelope tw-text-[#24CFF4] tw-text-xs"></i>
                        </div>
                        <span class="tw-text-gray-600 tw-text-sm tw-truncate">{{ $user->email }}</span>
                    </div>
                    <div class="tw-flex tw-items-center tw-gap-3">
                        <div class="tw-w-7 tw-h-7 tw-rounded-lg tw-bg-[#24CFF4]/10 tw-flex tw-items-center tw-justify-center tw-flex-shrink-0">
                            <i class="fas fa-phone tw-text-[#24CFF4] tw-text-xs"></i>
                        </div>
                        <span class="tw-text-gray-600 tw-text-sm">{{ $user->phone ?: '—' }}</span>
                    </div>
                    <div class="tw-flex tw-items-center tw-gap-3">
                        <div class="tw-w-7 tw-h-7 tw-rounded-lg tw-bg-[#24CFF4]/10 tw-flex tw-items-center tw-justify-center tw-flex-shrink-0">
                            <i class="fas fa-calendar-alt tw-text-[#24CFF4] tw-text-xs"></i>
                        </div>
                        <span class="tw-text-gray-600 tw-text-sm">Since {{ $user->created_at->format('M Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Danger Zone Card -->
            <div class="tw-bg-white tw-rounded-2xl tw-border tw-border-red-100 tw-shadow-sm tw-p-5">
                <p class="tw-text-xs tw-font-semibold tw-text-red-400 tw-uppercase tw-tracking-wider tw-mb-3">Danger Zone</p>
                <button type="button" onclick="confirmAccountDeletion()"
                    class="tw-w-full tw-flex tw-items-center tw-justify-center tw-gap-2 tw-py-2.5 tw-px-4 tw-rounded-xl tw-border tw-border-red-200 tw-text-red-500 hover:tw-bg-red-50 tw-transition-colors tw-text-sm tw-font-medium">
                    <i class="fas fa-trash-alt"></i>
                    Delete My Account
                </button>
            </div>
        </div>

        <!-- ── Right: Settings Tabs ── -->
        <div class="lg:tw-col-span-2">
            <div class="tw-bg-white tw-rounded-2xl tw-border tw-border-gray-100 tw-shadow-sm tw-overflow-hidden">

                <!-- Tab Navigation -->
                <div class="tw-flex tw-border-b tw-border-gray-100">
                    <button type="button" id="tab-profile" onclick="switchTab('profile')"
                        class="tw-flex tw-items-center tw-gap-2 tw-px-6 tw-py-4 tw-text-sm tw-font-medium tw-transition-all tw-duration-150 tw-border-b-2 tw-border-[#24CFF4] tw-text-[#24CFF4]">
                        <i class="fas fa-user tw-text-xs"></i> Profile
                    </button>
                    <button type="button" id="tab-security" onclick="switchTab('security')"
                        class="tw-flex tw-items-center tw-gap-2 tw-px-6 tw-py-4 tw-text-sm tw-font-medium tw-transition-all tw-duration-150 tw-border-b-2 tw-border-transparent tw-text-gray-400 hover:tw-text-gray-700">
                        <i class="fas fa-shield-alt tw-text-xs"></i> Security
                    </button>
                </div>

                <form method="POST" id="accountupdate" action="{{ route('account.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="active_tab" id="active_tab" value="profile">

                    <!-- ── Profile Panel ── -->
                    <div id="panel-profile" class="tw-p-6">
                        <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-5">

                            <!-- Username (full width) -->
                            <div class="md:tw-col-span-2">
                                <label class="tw-block tw-text-xs tw-font-semibold tw-text-gray-500 tw-uppercase tw-tracking-wider tw-mb-2">Username</label>
                                <div class="tw-relative">
                                    <span class="tw-absolute tw-inset-y-0 tw-left-3.5 tw-flex tw-items-center tw-text-gray-400 tw-text-sm">@</span>
                                    <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}" required
                                        class="tw-w-full tw-bg-gray-50 tw-border tw-border-gray-200 hover:tw-border-gray-300 focus:tw-border-[#24CFF4] tw-rounded-xl tw-pl-9 tw-pr-4 tw-py-2.5 tw-text-gray-800 tw-text-sm tw-outline-none tw-transition-colors">
                                </div>
                                <p id="username-feedback" class="tw-text-xs tw-mt-1.5 tw-hidden"></p>
                            </div>

                            <!-- First Name -->
                            <div>
                                <label class="tw-block tw-text-xs tw-font-semibold tw-text-gray-500 tw-uppercase tw-tracking-wider tw-mb-2">First Name</label>
                                <input type="text" id="firstName" name="firstName" value="{{ old('firstName', $user->firstName) }}" required
                                    class="tw-w-full tw-bg-gray-50 tw-border tw-border-gray-200 hover:tw-border-gray-300 focus:tw-border-[#24CFF4] tw-rounded-xl tw-px-4 tw-py-2.5 tw-text-gray-800 tw-text-sm tw-outline-none tw-transition-colors">
                                <p id="firstName-feedback" class="tw-text-xs tw-mt-1.5 tw-hidden"></p>
                            </div>

                            <!-- Last Name -->
                            <div>
                                <label class="tw-block tw-text-xs tw-font-semibold tw-text-gray-500 tw-uppercase tw-tracking-wider tw-mb-2">Last Name</label>
                                <input type="text" id="lastName" name="lastName" value="{{ old('lastName', $user->lastName) }}" required
                                    class="tw-w-full tw-bg-gray-50 tw-border tw-border-gray-200 hover:tw-border-gray-300 focus:tw-border-[#24CFF4] tw-rounded-xl tw-px-4 tw-py-2.5 tw-text-gray-800 tw-text-sm tw-outline-none tw-transition-colors">
                                <p id="lastName-feedback" class="tw-text-xs tw-mt-1.5 tw-hidden"></p>
                            </div>

                            <!-- Email (full width) -->
                            <div class="md:tw-col-span-2">
                                <label class="tw-block tw-text-xs tw-font-semibold tw-text-gray-500 tw-uppercase tw-tracking-wider tw-mb-2">Email Address</label>
                                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                                    class="tw-w-full tw-bg-gray-50 tw-border tw-border-gray-200 hover:tw-border-gray-300 focus:tw-border-[#24CFF4] tw-rounded-xl tw-px-4 tw-py-2.5 tw-text-gray-800 tw-text-sm tw-outline-none tw-transition-colors">
                                <p id="email-feedback" class="tw-text-xs tw-mt-1.5 tw-hidden"></p>
                            </div>

                            <!-- Phone (full width) -->
                            <div class="md:tw-col-span-2">
                                <label class="tw-block tw-text-xs tw-font-semibold tw-text-gray-500 tw-uppercase tw-tracking-wider tw-mb-2">Phone Number</label>
                                <input type="text" id="phoneNumber" name="phoneNumber"
                                    value="{{ old('phoneNumber', $user->phone ? (str_starts_with($user->phone, '+63') ? substr($user->phone, 3) : $user->phone) : '') }}"
                                    placeholder="9XX XXX XXXX"
                                    class="tw-w-full tw-bg-gray-50 tw-border tw-border-gray-200 hover:tw-border-gray-300 focus:tw-border-[#24CFF4] tw-rounded-xl tw-px-4 tw-py-2.5 tw-text-gray-800 tw-text-sm tw-outline-none tw-transition-colors">
                                <p id="phone-feedback" class="tw-text-xs tw-mt-1.5 tw-hidden"></p>
                            </div>
                        </div>

                        <!-- Save Button -->
                        <div class="tw-flex tw-justify-end tw-mt-6 tw-pt-4 tw-border-t tw-border-gray-100">
                            <button type="button" onclick="confirmUpdate()"
                                class="tw-inline-flex tw-items-center tw-gap-2 tw-px-5 tw-py-2.5 tw-bg-[#24CFF4] hover:tw-bg-[#1ab8db] tw-text-white tw-rounded-xl tw-text-sm tw-font-semibold tw-transition-colors tw-shadow-sm">
                                <i class="fas fa-save"></i> Save Changes
                            </button>
                        </div>
                    </div>

                    <!-- ── Security Panel ── -->
                    <div id="panel-security" class="tw-p-6 tw-hidden">
                        <p class="tw-text-sm tw-text-gray-500 tw-mb-5">Leave the password fields blank to keep your current password.</p>

                        <div class="tw-grid tw-grid-cols-1 tw-gap-5 tw-max-w-lg">
                            <!-- Current Password -->
                            <div>
                                <label class="tw-block tw-text-xs tw-font-semibold tw-text-gray-500 tw-uppercase tw-tracking-wider tw-mb-2">Current Password</label>
                                <div class="tw-relative">
                                    <input type="password" id="current_password" name="current_password" autocomplete="current-password" placeholder="Enter your current password"
                                        class="tw-w-full tw-bg-gray-50 tw-border tw-border-gray-200 hover:tw-border-gray-300 focus:tw-border-[#24CFF4] tw-rounded-xl tw-px-4 tw-py-2.5 tw-pr-12 tw-text-gray-800 tw-text-sm tw-outline-none tw-transition-colors">
                                    <button type="button" onclick="togglePwd('current_password')" class="tw-absolute tw-inset-y-0 tw-right-3.5 tw-text-gray-400 hover:tw-text-gray-600 tw-transition-colors">
                                        <i id="eye-current_password" class="fas fa-eye-slash"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- New Password -->
                            <div>
                                <label class="tw-block tw-text-xs tw-font-semibold tw-text-gray-500 tw-uppercase tw-tracking-wider tw-mb-2">New Password</label>
                                <div class="tw-relative">
                                    <input type="password" id="password" name="password" autocomplete="new-password" placeholder="Enter new password"
                                        class="tw-w-full tw-bg-gray-50 tw-border tw-border-gray-200 hover:tw-border-gray-300 focus:tw-border-[#24CFF4] tw-rounded-xl tw-px-4 tw-py-2.5 tw-pr-12 tw-text-gray-800 tw-text-sm tw-outline-none tw-transition-colors">
                                    <button type="button" onclick="togglePwd('password')" class="tw-absolute tw-inset-y-0 tw-right-3.5 tw-text-gray-400 hover:tw-text-gray-600 tw-transition-colors">
                                        <i id="eye-password" class="fas fa-eye-slash"></i>
                                    </button>
                                </div>
                                <p id="password-strength" class="tw-text-xs tw-mt-1.5 tw-hidden"></p>
                            </div>

                            <!-- Confirm Password -->
                            <div>
                                <label class="tw-block tw-text-xs tw-font-semibold tw-text-gray-500 tw-uppercase tw-tracking-wider tw-mb-2">Confirm New Password</label>
                                <div class="tw-relative">
                                    <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password" placeholder="Confirm new password"
                                        class="tw-w-full tw-bg-gray-50 tw-border tw-border-gray-200 hover:tw-border-gray-300 focus:tw-border-[#24CFF4] tw-rounded-xl tw-px-4 tw-py-2.5 tw-pr-12 tw-text-gray-800 tw-text-sm tw-outline-none tw-transition-colors">
                                    <button type="button" onclick="togglePwd('password_confirmation')" class="tw-absolute tw-inset-y-0 tw-right-3.5 tw-text-gray-400 hover:tw-text-gray-600 tw-transition-colors">
                                        <i id="eye-password_confirmation" class="fas fa-eye-slash"></i>
                                    </button>
                                </div>
                                <p id="password-match" class="tw-text-xs tw-mt-1.5 tw-hidden"></p>
                            </div>
                        </div>

                        <!-- Save Button -->
                        <div class="tw-flex tw-justify-end tw-mt-6 tw-pt-4 tw-border-t tw-border-gray-100">
                            <button type="button" onclick="confirmUpdate()"
                                class="tw-inline-flex tw-items-center tw-gap-2 tw-px-5 tw-py-2.5 tw-bg-[#24CFF4] hover:tw-bg-[#1ab8db] tw-text-white tw-rounded-xl tw-text-sm tw-font-semibold tw-transition-colors tw-shadow-sm">
                                <i class="fas fa-lock"></i> Update Password
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
window.initUserAccountSettings = function() {
    const accountRoot = document.getElementById('user-account-settings');
    const accountForm = document.getElementById('accountupdate');

    if (!accountRoot || !accountForm || accountForm.dataset.initialized === 'true') {
        return;
    }

    accountForm.dataset.initialized = 'true';
    const validateFieldUrl = "{{ route('account.validate-field') }}";
    const fieldState = {
        username: { available: null, pending: false },
        email:    { available: null, pending: false },
        phone:    { available: null, pending: false },
    };
    const debounceTimers = {};

    accountForm.reset();

    const previewImage = document.getElementById('profile-preview');
    if (previewImage && previewImage.dataset.originalSrc) {
        previewImage.src = previewImage.dataset.originalSrc;
    }

    function setFeedback(id, message, type) {
        const el = document.getElementById(id);
        if (!el) return;

        el.classList.remove('tw-hidden', 'tw-text-gray-500', 'tw-text-red-500', 'tw-text-green-600', 'tw-text-amber-600');

        if (!message) {
            el.classList.add('tw-hidden');
            el.innerHTML = '';
            return;
        }

        const colorMap = {
            error: 'tw-text-red-500',
            success: 'tw-text-green-600',
            warning: 'tw-text-amber-600',
        };

        el.classList.add(colorMap[type] || 'tw-text-gray-500');
        el.innerHTML = message;
    }

    function queueCheck(field, value, delay) {
        clearTimeout(debounceTimers[field]);
        debounceTimers[field] = setTimeout(function() {
            checkAvailability(field, value);
        }, delay || 350);
    }

    async function checkAvailability(field, value) {
        fieldState[field].pending = true;
        const feedbackId = field + '-feedback';

        try {
            const query = new URLSearchParams({ field: field, value: value }).toString();
            const response = await fetch(validateFieldUrl + '?' + query, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
                credentials: 'same-origin',
            });

            if (!response.ok) {
                throw new Error('Validation request failed.');
            }

            const data = await response.json();
            fieldState[field].available = !!data.available;
            fieldState[field].pending = false;

            const icon = data.available ? 'fa-check-circle' : 'fa-exclamation-circle';
            setFeedback(
                feedbackId,
                '<i class="fas ' + icon + ' tw-mr-1"></i>' + data.message,
                data.available ? 'success' : 'error'
            );
        } catch (error) {
            fieldState[field].available = false;
            fieldState[field].pending = false;
            setFeedback(feedbackId, '<i class="fas fa-exclamation-circle tw-mr-1"></i> Unable to validate right now.', 'warning');
        }
    }

    function validatePasswords() {
        const passwordEl = document.getElementById('password');
        const confirmationEl = document.getElementById('password_confirmation');

        if (!passwordEl || !confirmationEl) {
            return;
        }

        const password = passwordEl.value;
        const confirmation = confirmationEl.value;

        if (password.length > 0) {
            const strong = password.length >= 8 && /[a-zA-Z]/.test(password) && /\d/.test(password) && /[!@#$%^&*(),.?":{}|<>]/.test(password);
            setFeedback(
                'password-strength',
                strong ? '<i class="fas fa-check-circle tw-mr-1"></i> Strong password' : 'Must have 8+ chars, letters, numbers & symbols',
                strong ? 'success' : 'error'
            );
        } else {
            setFeedback('password-strength', '');
        }

        if (password.length > 0 && confirmation.length > 0) {
            setFeedback(
                'password-match',
                password === confirmation
                    ? '<i class="fas fa-check-circle tw-mr-1"></i> Passwords match'
                    : '<i class="fas fa-exclamation-circle tw-mr-1"></i> Passwords do not match',
                password === confirmation ? 'success' : 'error'
            );
        } else {
            setFeedback('password-match', '');
        }
    }

    function hasErrors(feedbackIds) {
        return feedbackIds.some(function(id) {
            const el = document.getElementById(id);
            return el && !el.classList.contains('tw-hidden') && el.classList.contains('tw-text-red-500');
        });
    }

    window.switchTab = function(tab) {
        ['profile', 'security'].forEach(function(section) {
            const panel = document.getElementById('panel-' + section);
            const button = document.getElementById('tab-' + section);

            if (!panel || !button) {
                return;
            }

            if (section === tab) {
                panel.classList.remove('tw-hidden');
                button.classList.add('tw-border-[#24CFF4]', 'tw-text-[#24CFF4]');
                button.classList.remove('tw-border-transparent', 'tw-text-gray-400');
            } else {
                panel.classList.add('tw-hidden');
                button.classList.remove('tw-border-[#24CFF4]', 'tw-text-[#24CFF4]');
                button.classList.add('tw-border-transparent', 'tw-text-gray-400');
            }
        });

        const activeTab = document.getElementById('active_tab');
        if (activeTab) {
            activeTab.value = tab;
        }
    };

    window.togglePwd = function(fieldId) {
        const input = document.getElementById(fieldId);
        const icon = document.getElementById('eye-' + fieldId);

        if (!input || !icon) {
            return;
        }

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        }
    };

    const usernameEl = document.getElementById('username');
    if (usernameEl) {
        usernameEl.addEventListener('input', function() {
            const value = this.value.trim();
            fieldState.username.available = null;

            if (!value) {
                setFeedback('username-feedback', '');
                return;
            }

            if (value.length < 5) {
                setFeedback('username-feedback', 'Username must be at least 5 characters.', 'error');
                return;
            }

            setFeedback('username-feedback', '<i class="fas fa-spinner fa-spin tw-mr-1"></i> Checking...', 'warning');
            queueCheck('username', value);
        });
    }

    const emailEl = document.getElementById('email');
    if (emailEl) {
        emailEl.addEventListener('input', function() {
            const value = this.value.trim();
            fieldState.email.available = null;

            if (!value) {
                setFeedback('email-feedback', '');
                return;
            }

            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
                setFeedback('email-feedback', 'Please enter a valid email address.', 'error');
                return;
            }

            setFeedback('email-feedback', '<i class="fas fa-spinner fa-spin tw-mr-1"></i> Checking...', 'warning');
            queueCheck('email', value);
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

    const passwordEl = document.getElementById('password');
    const passwordConfirmationEl = document.getElementById('password_confirmation');

    if (passwordEl) {
        passwordEl.addEventListener('input', validatePasswords);
    }

    if (passwordConfirmationEl) {
        passwordConfirmationEl.addEventListener('input', validatePasswords);
    }

    const phoneInput = document.getElementById('phoneNumber');
    if (phoneInput) {
        phoneInput.addEventListener('input', function(event) {
            let value = event.target.value.replace(/\D/g, '');

            if (value.length > 10) {
                value = value.slice(0, 10);
            }

            if (value.length > 6) {
                value = value.slice(0, 3) + ' ' + value.slice(3, 6) + ' ' + value.slice(6);
            } else if (value.length > 3) {
                value = value.slice(0, 3) + ' ' + value.slice(3);
            }

            event.target.value = value;
            fieldState.phone.available = null;

            if (!value) {
                setFeedback('phone-feedback', '');
                return;
            }

            if (!/^9\d{2}\s?\d{3}\s?\d{4}$/.test(value)) {
                setFeedback('phone-feedback', '<i class="fas fa-exclamation-circle tw-mr-1"></i> Invalid format. Use 9XX XXX XXXX.', 'error');
                return;
            }

            setFeedback('phone-feedback', '<i class="fas fa-spinner fa-spin tw-mr-1"></i> Checking phone...', 'warning');
            queueCheck('phone', value);
        });
    }

    const profileImageInput = document.getElementById('profile_image');
    if (profileImageInput) {
        profileImageInput.addEventListener('change', function(event) {
            if (event.target.files && event.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function(loadEvent) {
                    if (previewImage) {
                        previewImage.src = loadEvent.target.result;
                    }
                };
                reader.readAsDataURL(event.target.files[0]);
            }
        });
    }

    window.confirmUpdate = function() {
        const activeTab = document.getElementById('active_tab').value;

        if (fieldState.username.pending || fieldState.email.pending || fieldState.phone.pending) {
            Swal.fire({
                title: 'Please wait',
                text: 'Still validating your inputs, try again in a moment.',
                icon: 'info',
                confirmButtonColor: '#24CFF4'
            });
            return;
        }

        if (activeTab === 'profile') {
            const firstName = document.getElementById('firstName').value.trim();
            const lastName = document.getElementById('lastName').value.trim();
            const username = document.getElementById('username').value.trim();
            const email = document.getElementById('email').value.trim();

            if (!firstName || !lastName || !username || !email) {
                Swal.fire({
                    title: 'Missing fields',
                    text: 'Please fill in all required fields.',
                    icon: 'error',
                    confirmButtonColor: '#24CFF4'
                });
                return;
            }

            if (hasErrors(['firstName-feedback', 'lastName-feedback', 'username-feedback', 'email-feedback', 'phone-feedback'])) {
                Swal.fire({
                    title: 'Fix errors first',
                    text: 'Please correct the highlighted fields before saving.',
                    icon: 'error',
                    confirmButtonColor: '#24CFF4'
                });
                return;
            }

            if (fieldState.username.available === false || fieldState.email.available === false || fieldState.phone.available === false) {
                Swal.fire({
                    title: 'Fix errors first',
                    text: 'Username, email or phone is already taken.',
                    icon: 'error',
                    confirmButtonColor: '#24CFF4'
                });
                return;
            }

            const phoneValue = phoneInput ? phoneInput.value.trim() : '';
            if (phoneValue && !/^9\d{2}\s?\d{3}\s?\d{4}$/.test(phoneValue)) {
                setFeedback('phone-feedback', '<i class="fas fa-exclamation-circle tw-mr-1"></i> Invalid format. Use 9XX XXX XXXX.', 'error');
                phoneInput.focus();
                return;
            }
        } else {
            const password = passwordEl ? passwordEl.value : '';
            const confirmation = passwordConfirmationEl ? passwordConfirmationEl.value : '';

            if (password) {
                const strong = password.length >= 8 && /[a-zA-Z]/.test(password) && /\d/.test(password) && /[!@#$%^&*(),.?":{}|<>]/.test(password);

                if (!strong) {
                    Swal.fire({
                        title: 'Weak password',
                        text: 'Password must have 8+ characters, letters, numbers & symbols.',
                        icon: 'error',
                        confirmButtonColor: '#24CFF4'
                    });
                    return;
                }

                if (password !== confirmation) {
                    Swal.fire({
                        title: 'Passwords do not match',
                        text: 'Please make sure both password fields match.',
                        icon: 'error',
                        confirmButtonColor: '#24CFF4'
                    });
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
            cancelButtonText: 'Cancel'
        }).then(function(result) {
            if (result.isConfirmed) {
                accountForm.setAttribute('data-confirmed', 'true');
                accountForm.submit();
            }
        });
    };

    if (accountForm) {
        accountForm.addEventListener('submit', function(event) {
            if (!this.hasAttribute('data-confirmed')) {
                event.preventDefault();
                window.confirmUpdate();
                return;
            }

            this.removeAttribute('data-confirmed');
        });
    }

    window.confirmAccountDeletion = function() {
        Swal.fire({
            title: 'Confirm Account Deletion',
            text: 'This action cannot be undone. Enter your password to confirm.',
            input: 'password',
            inputPlaceholder: 'Enter your current password',
            inputAttributes: { autocomplete: 'current-password' },
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Delete my account',
            cancelButtonText: 'Cancel',
            inputValidator: function(value) {
                if (!value) {
                    return 'Password is required.';
                }
            }
        }).then(function(result) {
            if (result.isConfirmed) {
                fetch('{{ route('account.delete') }}', {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json'
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify({ password: result.value })
                }).then(function(response) {
                    return response.json();
                }).then(function(data) {
                    if (data.success) {
                        window.location.href = '{{ route('login') }}';
                    } else {
                        Swal.fire('Error!', data.message || 'Failed to delete your account.', 'error');
                    }
                }).catch(function() {
                    Swal.fire('Error!', 'An error occurred while processing your request.', 'error');
                });
            }
        });
    };

    @if(session('success'))
        Swal.fire({ title: 'Success!', text: "{{ session('success') }}", icon: 'success', confirmButtonColor: '#24CFF4' });
    @endif

    @if($errors->any())
        Swal.fire({ title: 'Error!', html: {!! json_encode(implode('<br>', $errors->all()), JSON_HEX_TAG) !!}, icon: 'error', confirmButtonColor: '#24CFF4' });
    @endif
};

window.initUserAccountSettings();
</script>
@endpush

@endsection

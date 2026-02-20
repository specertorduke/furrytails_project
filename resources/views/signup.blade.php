<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .signup-bg-pattern {
            background-color: #24CFF4;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        .form-card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }
        .input-group-text {
            border-right: 0;
            background-color: white;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #24CFF4;
        }
        .form-control {
            border-left: 0;
        }
        .input-group:focus-within .input-group-text {
            border-color: #24CFF4;
            color: #24CFF4;
        }
    </style>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body>
    <div class="tw-h-screen tw-w-full tw-flex tw-relative">
        <a href="{{ route('home') }}" class="tw-absolute tw-top-6 tw-left-6 tw-z-50 tw-text-white hover:tw-text-gray-100 tw-transition-colors tw-duration-300 tw-flex tw-items-center tw-gap-2 tw-no-underline tw-bg-white/10 tw-px-4 tw-py-2 tw-rounded-full tw-backdrop-blur-sm">
            <i class="fas fa-arrow-left"></i>
            <span class="tw-font-medium">Home</span>
        </a>

        <!-- Left Side - Branding -->
        <div class="tw-hidden md:tw-flex tw-w-1/2 tw-flex-col tw-justify-center tw-items-center tw-relative signup-bg-pattern tw-text-white tw-p-12 tw-overflow-hidden">
            <div class="tw-absolute tw-top-0 tw-left-0 tw-w-full tw-h-full tw-bg-gradient-to-br tw-from-[#24CFF4]/90 tw-to-[#0aa5cb]/90"></div>
            
            <div class="tw-relative tw-z-10 tw-flex tw-flex-col tw-items-center tw-text-center">
                <a href="{{ route('home') }}" class="tw-mb-8 tw-transform hover:tw-scale-105 tw-transition-transform tw-duration-300">
                    <img src="{{ asset('images/business-logo/logo.png') }}" alt="Business Logo" class="tw-w-64 tw-drop-shadow-lg">                
                </a>
                
                <div class="tw-mt-8 tw-max-w-lg tw-text-center">
                    <h2 class="tw-text-4xl tw-font-bold tw-mb-4 text-white tw-drop-shadow-md">Join Our Community</h2>
                    <p class="tw-text-lg tw-font-medium tw-text-white/90 tw-leading-relaxed tw-drop-shadow-sm">
                        FurryTails is the perfect place for your furry friends. 
                        Create an account to book premium boarding, grooming, and more for your beloved pets.
                    </p>
                </div>
            </div>
            
            <!-- decorative paw prints -->
            <i class="fas fa-paw tw-text-white/10 tw-text-9xl tw-absolute -tw-bottom-10 -tw-left-10 tw-rotate-12"></i>
            <i class="fas fa-paw tw-text-white/10 tw-text-8xl tw-absolute tw-top-20 tw-right-20 -tw-rotate-12"></i>
        </div>

        <!-- Right Side - Sign Up Form -->
        <div class="tw-w-full md:tw-w-1/2 tw-flex tw-items-center tw-justify-center tw-bg-gray-50 tw-p-4 tw-overflow-y-auto tw-h-full">
            <div class="tw-w-full tw-max-w-xl form-card tw-rounded-2xl tw-shadow-2xl tw-p-8 tw-my-8 tw-border tw-border-gray-100 tw-my-auto">
                <div class="tw-flex tw-flex-col tw-items-center tw-mb-6">
                    <div class="tw-w-16 tw-h-16 tw-bg-[#eafbff] tw-rounded-full tw-flex tw-items-center tw-justify-center tw-mb-4 tw-shadow-sm">
                        <i class="fas fa-user-plus tw-text-2xl tw-text-[#24CFF4]"></i>
                    </div>
                    <h2 class="tw-text-2xl tw-font-bold tw-text-gray-800">Create Account</h2>
                    <p class="tw-text-gray-500 tw-mt-1">Sign up to get started</p>
                </div>
                
                @if ($errors->any())
                    <div class="tw-bg-red-50 tw-border-l-4 tw-border-red-500 tw-text-red-700 tw-p-4 tw-rounded-r-lg tw-mb-6 tw-text-sm tw-shadow-sm animate__animated animate__shakeX" role="alert">
                        <div class="tw-flex tw-items-center tw-mb-1">
                            <i class="fas fa-exclamation-circle tw-mr-2"></i>
                            <strong class="tw-font-bold">Please correct the errors</strong>
                        </div>
                        <ul class="tw-list-none tw-pl-0 tw-mb-0">
                            @foreach ($errors->all() as $error)
                                <li class="tw-ml-6">• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('signup.submit') }}" class="tw-space-y-4" id="signupForm">
                    @csrf
                    <div class="tw-grid tw-grid-cols-2 tw-gap-4">
                        <div>
                            <label for="firstName" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">First Name</label>
                            <input type="text" id="firstName" name="firstName" value="{{ old('firstName') }}" required 
                                class="form-control tw-w-full tw-border tw-border-gray-300 tw-rounded-lg tw-py-2.5 tw-px-3 focus:tw-ring-2 focus:tw-ring-[#24CFF4] focus:tw-border-[#24CFF4] tw-transition-all placeholder:tw-text-gray-400" placeholder="John">
                        </div>
                        <div>
                            <label for="lastName" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">Last Name</label>
                            <input type="text" id="lastName" name="lastName" value="{{ old('lastName') }}" required 
                                class="form-control tw-w-full tw-border tw-border-gray-300 tw-rounded-lg tw-py-2.5 tw-px-3 focus:tw-ring-2 focus:tw-ring-[#24CFF4] focus:tw-border-[#24CFF4] tw-transition-all placeholder:tw-text-gray-400" placeholder="Doe">
                        </div>
                    </div>

                    <div>
                        <label for="email" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">Email Address</label>
                        <div class="tw-flex tw-items-center tw-shadow-sm tw-rounded-lg tw-overflow-hidden tw-border tw-border-gray-300 focus-within:tw-ring-2 focus-within:tw-ring-[#24CFF4] focus-within:tw-border-[#24CFF4] tw-transition-all">
                            <span class="tw-pl-3 tw-bg-white tw-text-gray-400">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required 
                                class="tw-flex-1 tw-border-0 tw-py-2.5 tw-px-2 focus:tw-outline-none focus:tw-ring-0 placeholder:tw-text-gray-400" 
                                placeholder="john.doe@example.com">
                        </div>
                        <p id="email-feedback" class="tw-text-xs tw-mt-1 tw-hidden"></p>
                    </div>

                    <div>
                        <label for="username" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">Username</label>
                        <div class="tw-flex tw-items-center tw-shadow-sm tw-rounded-lg tw-overflow-hidden tw-border tw-border-gray-300 focus-within:tw-ring-2 focus-within:tw-ring-[#24CFF4] focus-within:tw-border-[#24CFF4] tw-transition-all">
                            <span class="tw-pl-3 tw-bg-white tw-text-gray-400">
                                <i class="fas fa-user"></i>
                            </span>
                            <input type="text" id="username" name="username" value="{{ old('username') }}" required 
                                class="tw-flex-1 tw-border-0 tw-py-2.5 tw-px-2 focus:tw-outline-none focus:tw-ring-0 placeholder:tw-text-gray-400" 
                                placeholder="johndoe123">
                        </div>
                        <p id="username-feedback" class="tw-text-xs tw-mt-1 tw-hidden"></p>
                    </div>

                    <div>
                        <label for="phone" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">Phone Number</label>
                        <div class="tw-flex tw-items-center tw-shadow-sm tw-rounded-lg tw-overflow-hidden tw-border tw-border-gray-300 focus-within:tw-ring-2 focus-within:tw-ring-[#24CFF4] focus-within:tw-border-[#24CFF4] tw-transition-all">
                            <span class="tw-pl-3 tw-bg-white tw-text-gray-500 tw-font-medium">
                                +63
                            </span>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required 
                                maxlength="12" 
                                class="tw-flex-1 tw-border-0 tw-py-2.5 tw-px-2 focus:tw-outline-none focus:tw-ring-0 placeholder:tw-text-gray-400" 
                                placeholder="9XX XXX XXXX">
                        </div>
                        <div class="tw-flex tw-justify-between tw-items-center tw-mt-1">
                            <span class="tw-text-xs tw-text-gray-500">Format: 9XX XXX XXXX</span>
                            <p id="phone-feedback" class="tw-hidden tw-text-red-500 tw-text-xs tw-flex tw-items-center"></p>
                        </div>
                    </div>

                    <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-4">
                        <div>
                            <label for="password" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">Password</label>
                            <div class="tw-relative tw-flex tw-items-center tw-shadow-sm tw-rounded-lg tw-overflow-hidden tw-border tw-border-gray-300 focus-within:tw-ring-2 focus-within:tw-ring-[#24CFF4] focus-within:tw-border-[#24CFF4] tw-transition-all">
                                <span class="tw-pl-3 tw-bg-white tw-text-gray-400">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input type="password" id="password" name="password" required 
                                    class="tw-flex-1 tw-border-0 tw-py-2.5 tw-px-2 focus:tw-outline-none focus:tw-ring-0 placeholder:tw-text-gray-400" 
                                    placeholder="••••••••">
                                <button type="button" onclick="togglePassword('password', 'toggleIcon')" class="tw-px-3 tw-text-gray-400 hover:tw-text-[#24CFF4] tw-bg-transparent tw-transition-colors focus:tw-outline-none">
                                    <i class="fa-regular fa-eye" id="toggleIcon"></i>
                                </button>
                            </div>
                        </div>

                        <div>
                            <label for="password_confirmation" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">Confirm Password</label>
                            <div class="tw-relative tw-flex tw-items-center tw-shadow-sm tw-rounded-lg tw-overflow-hidden tw-border tw-border-gray-300 focus-within:tw-ring-2 focus-within:tw-ring-[#24CFF4] focus-within:tw-border-[#24CFF4] tw-transition-all">
                                <span class="tw-pl-3 tw-bg-white tw-text-gray-400">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input type="password" id="password_confirmation" name="password_confirmation" required 
                                    class="tw-flex-1 tw-border-0 tw-py-2.5 tw-px-2 focus:tw-outline-none focus:tw-ring-0 placeholder:tw-text-gray-400" 
                                    placeholder="••••••••">
                                <button type="button" onclick="togglePassword('password_confirmation', 'toggleIconConfirm')" class="tw-px-3 tw-text-gray-400 hover:tw-text-[#24CFF4] tw-bg-transparent tw-transition-colors focus:tw-outline-none">
                                    <i class="fa-regular fa-eye" id="toggleIconConfirm"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <span id="password-requirements" class="tw-text-xs tw-text-gray-500 tw-block tw-mt-1">Use 8+ chars with letters, numbers & symbols</span>
                    <p id="password-match-feedback" class="tw-text-xs tw-mt-1 tw-hidden"></p>

                    <div class="tw-flex tw-items-start tw-mt-4">
                        <div class="tw-flex tw-items-center tw-h-5">
                            <input id="terms" name="terms" type="checkbox" value="1" {{ old('terms') ? 'checked' : '' }} required class="tw-focus:ring-[#24CFF4] tw-h-4 tw-w-4 tw-text-[#24CFF4] tw-border-gray-300 tw-rounded">
                        </div>
                        <div class="tw-ml-3 tw-text-sm">
                            <label for="terms" class="tw-font-medium tw-text-gray-700">I agree to the <a href="#" class="tw-text-[#24CFF4] hover:tw-underline">Terms of Use</a> and <a href="#" class="tw-text-[#24CFF4] hover:tw-underline">Privacy Policy</a>.</label>
                        </div>
                    </div>
                    <p id="terms-feedback" class="tw-text-xs tw-mt-1 tw-hidden"></p>

                    <button type="submit" id="createAccountBtn" class="tw-w-full tw-mt-6 tw-bg-gray-400 tw-text-white tw-font-bold tw-py-3 tw-px-4 tw-rounded-lg tw-shadow-lg tw-transform tw-transition-all tw-duration-300 focus:tw-outline-none tw-cursor-not-allowed" disabled>
                        Create Account <i class="fas fa-arrow-right tw-ml-2"></i>
                    </button>
                    <p id="form-guidance" class="tw-text-xs tw-text-amber-600 tw-mt-2"></p>
                </form>

                <p class="tw-mt-6 tw-text-center tw-text-sm tw-text-gray-600">
                    Already have an account? <a href="{{ route('login') }}" class="tw-text-[#24CFF4] tw-font-semibold hover:tw-text-[#0aa5cb] hover:tw-underline">Log in here</a>
                </p>
            </div>
        </div>
        </div>
    </div>

    <script>
        const validateFieldUrl = "{{ route('signup.validate-field') }}";

        const fieldState = {
            username: { available: null, pending: false, checkedValue: '' },
            email: { available: null, pending: false, checkedValue: '' },
            phone: { available: null, pending: false, checkedValue: '' },
        };

        const debounceTimers = {
            username: null,
            email: null,
            phone: null,
        };

        function togglePassword(fieldId, iconId) {
            const passwordInput = document.getElementById(fieldId);
            const toggleIcon = document.getElementById(iconId);

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        function setFeedback(elementId, message, type = 'neutral') {
            const el = document.getElementById(elementId);

            if (!el) {
                return;
            }

            el.classList.remove('tw-hidden', 'tw-text-gray-500', 'tw-text-red-500', 'tw-text-green-500', 'tw-text-amber-600');

            if (!message) {
                el.classList.add('tw-hidden');
                el.innerHTML = '';
                return;
            }

            if (type === 'error') {
                el.classList.add('tw-text-red-500');
            } else if (type === 'success') {
                el.classList.add('tw-text-green-500');
            } else if (type === 'warning') {
                el.classList.add('tw-text-amber-600');
            } else {
                el.classList.add('tw-text-gray-500');
            }

            el.innerHTML = message;
        }

        function normalizePhoneDigits(value) {
            let digits = value.replace(/\D/g, '');

            if (digits.startsWith('63') && digits.length === 12) {
                digits = digits.slice(2);
            }

            if (digits.length > 10) {
                digits = digits.slice(0, 10);
            }

            return digits;
        }

        function formatPhoneForDisplay(digits) {
            if (digits.length > 6) {
                return `${digits.slice(0, 3)} ${digits.slice(3, 6)} ${digits.slice(6)}`;
            }

            if (digits.length > 3) {
                return `${digits.slice(0, 3)} ${digits.slice(3)}`;
            }

            return digits;
        }

        async function checkAvailability(field, value) {
            fieldState[field].pending = true;
            checkFormValidation();

            try {
                const params = new URLSearchParams({ field, value });
                const response = await fetch(`${validateFieldUrl}?${params.toString()}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (!response.ok) {
                    throw new Error('Validation request failed');
                }

                const data = await response.json();

                const currentFieldValue = field === 'phone'
                    ? document.getElementById('phone').value.trim()
                    : document.getElementById(field).value.trim();

                if (currentFieldValue !== value) {
                    return;
                }

                fieldState[field].available = !!data.available;
                fieldState[field].checkedValue = value;

                if (field === 'username') {
                    setFeedback('username-feedback', data.message, data.available ? 'success' : 'error');
                } else if (field === 'email') {
                    setFeedback('email-feedback', data.message, data.available ? 'success' : 'error');
                } else if (field === 'phone') {
                    const icon = data.available ? 'fa-check-circle' : 'fa-exclamation-circle';
                    setFeedback('phone-feedback', `<i class="fas ${icon} tw-mr-1"></i> ${data.message}`, data.available ? 'success' : 'error');
                }
            } catch (error) {
                fieldState[field].available = false;

                if (field === 'username') {
                    setFeedback('username-feedback', 'Unable to validate username right now.', 'warning');
                } else if (field === 'email') {
                    setFeedback('email-feedback', 'Unable to validate email right now.', 'warning');
                } else if (field === 'phone') {
                    setFeedback('phone-feedback', '<i class="fas fa-exclamation-circle tw-mr-1"></i> Unable to validate phone right now.', 'warning');
                }
            } finally {
                fieldState[field].pending = false;
                checkFormValidation();
            }
        }

        function queueAvailabilityCheck(field, value, delay = 350) {
            clearTimeout(debounceTimers[field]);
            debounceTimers[field] = setTimeout(() => checkAvailability(field, value), delay);
        }

        function checkFormValidation() {
            const firstName = document.getElementById('firstName').value.trim();
            const lastName = document.getElementById('lastName').value.trim();
            const email = document.getElementById('email').value.trim();
            const username = document.getElementById('username').value.trim();
            const phone = document.getElementById('phone').value.trim();
            const password = document.getElementById('password').value;
            const passwordConfirmation = document.getElementById('password_confirmation').value;
            const termsAccepted = document.getElementById('terms').checked;
            const createAccountBtn = document.getElementById('createAccountBtn');
            const passwordRequirements = document.getElementById('password-requirements');

            const missingItems = [];
            const invalidItems = [];

            if (!firstName) missingItems.push('first name');
            if (!lastName) missingItems.push('last name');
            if (!email) missingItems.push('email');
            if (!username) missingItems.push('username');
            if (!phone) missingItems.push('phone number');
            if (!password) missingItems.push('password');
            if (!passwordConfirmation) missingItems.push('confirm password');
            if (!termsAccepted) missingItems.push('terms acceptance');

            const hasMinLength = password.length >= 8;
            const hasLetter = /[a-zA-Z]/.test(password);
            const hasNumber = /\d/.test(password);
            const hasSymbol = /[!@#$%^&*(),.?":{}|<>]/.test(password);
            const isPasswordStrong = hasMinLength && hasLetter && hasNumber && hasSymbol;

            if (password.length > 0) {
                if (isPasswordStrong) {
                    passwordRequirements.classList.remove('tw-text-gray-500', 'tw-text-red-500');
                    passwordRequirements.classList.add('tw-text-green-500');
                    passwordRequirements.innerHTML = '<i class="fas fa-check-circle tw-mr-1"></i> Strong password';
                } else {
                    passwordRequirements.classList.remove('tw-text-gray-500', 'tw-text-green-500');
                    passwordRequirements.classList.add('tw-text-red-500');
                    passwordRequirements.innerHTML = 'Password must have 8+ chars, letters, numbers & symbols';
                    invalidItems.push('password strength');
                }
            } else {
                passwordRequirements.classList.remove('tw-text-green-500', 'tw-text-red-500');
                passwordRequirements.classList.add('tw-text-gray-500');
                passwordRequirements.innerHTML = 'Use 8+ chars with letters, numbers & symbols';
            }

            const doPasswordsMatch = password.length > 0 && passwordConfirmation.length > 0 && password === passwordConfirmation;

            if (password.length > 0 && passwordConfirmation.length > 0 && !doPasswordsMatch) {
                setFeedback('password-match-feedback', '<i class="fas fa-exclamation-circle tw-mr-1"></i> Passwords do not match.', 'error');
                invalidItems.push('password confirmation mismatch');
            } else if (password.length > 0 && passwordConfirmation.length > 0 && doPasswordsMatch) {
                setFeedback('password-match-feedback', '<i class="fas fa-check-circle tw-mr-1"></i> Passwords match.', 'success');
            } else {
                setFeedback('password-match-feedback', '');
            }

            const emailFormatValid = email.length > 0 ? /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email) : false;
            const usernameLengthValid = username.length >= 5;
            const phoneFormatValid = /^9\d{2}\s?\d{3}\s?\d{4}$/.test(phone);

            if (email.length > 0 && !emailFormatValid) {
                invalidItems.push('email format');
            }

            if (username.length > 0 && !usernameLengthValid) {
                invalidItems.push('username minimum length (5)');
            }

            if (phone.length > 0 && !phoneFormatValid) {
                invalidItems.push('phone format');
            }

            if (email.length > 0 && emailFormatValid && fieldState.email.available === false) {
                invalidItems.push('email uniqueness');
            }

            if (username.length > 0 && usernameLengthValid && fieldState.username.available === false) {
                invalidItems.push('username uniqueness');
            }

            if (phone.length > 0 && phoneFormatValid && fieldState.phone.available === false) {
                invalidItems.push('phone uniqueness');
            }

            const nonTermsMissingCount = missingItems.filter((item) => item !== 'terms acceptance').length;
            const shouldShowTermsOnlyPrompt = !termsAccepted && nonTermsMissingCount === 0 && invalidItems.length === 0;

            if (shouldShowTermsOnlyPrompt) {
                setFeedback('terms-feedback', '<i class="fas fa-exclamation-circle tw-mr-1"></i> Please accept Terms of Use and Privacy Policy.', 'error');
            } else {
                setFeedback('terms-feedback', '');
            }

            const hasPendingChecks = fieldState.username.pending || fieldState.email.pending || fieldState.phone.pending;
            const fieldsReadyForUniqueCheck = emailFormatValid && usernameLengthValid && phoneFormatValid;
            const uniqueChecksPassed = fieldState.email.available === true && fieldState.username.available === true && fieldState.phone.available === true;

            const allFilled = firstName && lastName && email && username && phone && password && passwordConfirmation && termsAccepted;
            const allValid = allFilled && isPasswordStrong && doPasswordsMatch && fieldsReadyForUniqueCheck && uniqueChecksPassed && !hasPendingChecks;

            if (allValid) {
                createAccountBtn.disabled = false;
                createAccountBtn.classList.remove('tw-bg-gray-400', 'tw-cursor-not-allowed');
                createAccountBtn.classList.add('tw-bg-[#24CFF4]', 'tw-cursor-pointer');
                setFeedback('form-guidance', '<i class="fas fa-check-circle tw-mr-1"></i> All set. You can create your account.', 'success');
            } else {
                createAccountBtn.disabled = true;
                createAccountBtn.classList.remove('tw-bg-[#24CFF4]', 'tw-cursor-pointer');
                createAccountBtn.classList.add('tw-bg-gray-400', 'tw-cursor-not-allowed');

                if (hasPendingChecks) {
                    setFeedback('form-guidance', '<i class="fas fa-spinner fa-spin tw-mr-1"></i> Checking availability...', 'warning');
                } else {
                    const guidance = [];

                    if (missingItems.length) {
                        guidance.push(`Missing: ${missingItems.join(', ')}`);
                    }

                    if (invalidItems.length) {
                        guidance.push(`Fix: ${[...new Set(invalidItems)].join(', ')}`);
                    }

                    setFeedback('form-guidance', guidance.length ? guidance.join(' • ') : 'Complete all required fields to continue.', 'warning');
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('signupForm');
            const phoneInput = document.getElementById('phone');
            const usernameInput = document.getElementById('username');
            const emailInput = document.getElementById('email');
            const allInputs = document.querySelectorAll('#signupForm input[required]');

            allInputs.forEach((input) => {
                input.addEventListener('input', checkFormValidation);
                input.addEventListener('blur', checkFormValidation);
            });

            usernameInput.addEventListener('input', function () {
                const value = usernameInput.value.trim();

                fieldState.username.available = null;
                fieldState.username.checkedValue = '';

                if (!value) {
                    setFeedback('username-feedback', '');
                    checkFormValidation();
                    return;
                }

                if (value.length < 5) {
                    setFeedback('username-feedback', 'Username must be at least 5 characters.', 'error');
                    checkFormValidation();
                    return;
                }

                setFeedback('username-feedback', '<i class="fas fa-spinner fa-spin tw-mr-1"></i> Checking username...', 'warning');
                queueAvailabilityCheck('username', value);
            });

            emailInput.addEventListener('input', function () {
                const value = emailInput.value.trim();

                fieldState.email.available = null;
                fieldState.email.checkedValue = '';

                if (!value) {
                    setFeedback('email-feedback', '');
                    checkFormValidation();
                    return;
                }

                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                if (!emailPattern.test(value)) {
                    setFeedback('email-feedback', 'Please enter a valid email address.', 'error');
                    checkFormValidation();
                    return;
                }

                setFeedback('email-feedback', '<i class="fas fa-spinner fa-spin tw-mr-1"></i> Checking email...', 'warning');
                queueAvailabilityCheck('email', value);
            });

            phoneInput.addEventListener('input', function (e) {
                const digits = normalizePhoneDigits(e.target.value);
                const formatted = formatPhoneForDisplay(digits);
                e.target.value = formatted;

                fieldState.phone.available = null;
                fieldState.phone.checkedValue = '';

                if (!formatted) {
                    setFeedback('phone-feedback', '');
                    checkFormValidation();
                    return;
                }

                const phoneRegex = /^9\d{2}\s?\d{3}\s?\d{4}$/;

                if (!phoneRegex.test(formatted)) {
                    setFeedback('phone-feedback', '<i class="fas fa-exclamation-circle tw-mr-1"></i> Invalid format. Use 9XX XXX XXXX.', 'error');
                    checkFormValidation();
                    return;
                }

                setFeedback('phone-feedback', '<i class="fas fa-spinner fa-spin tw-mr-1"></i> Checking phone...', 'warning');
                queueAvailabilityCheck('phone', formatted);
            });

            if (usernameInput.value.trim().length >= 5) {
                setFeedback('username-feedback', '<i class="fas fa-spinner fa-spin tw-mr-1"></i> Checking username...', 'warning');
                queueAvailabilityCheck('username', usernameInput.value.trim(), 50);
            }

            const initialEmail = emailInput.value.trim();
            if (initialEmail && /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(initialEmail)) {
                setFeedback('email-feedback', '<i class="fas fa-spinner fa-spin tw-mr-1"></i> Checking email...', 'warning');
                queueAvailabilityCheck('email', initialEmail, 50);
            }

            const initialPhoneDigits = normalizePhoneDigits(phoneInput.value);
            if (initialPhoneDigits) {
                phoneInput.value = formatPhoneForDisplay(initialPhoneDigits);
            }

            if (/^9\d{2}\s?\d{3}\s?\d{4}$/.test(phoneInput.value.trim())) {
                setFeedback('phone-feedback', '<i class="fas fa-spinner fa-spin tw-mr-1"></i> Checking phone...', 'warning');
                queueAvailabilityCheck('phone', phoneInput.value.trim(), 50);
            }

            if (form) {
                form.addEventListener('submit', function(e) {
                    checkFormValidation();

                    if (document.getElementById('createAccountBtn').disabled) {
                        e.preventDefault();
                        setFeedback('form-guidance', '<i class="fas fa-exclamation-circle tw-mr-1"></i> Please complete the missing/invalid fields above before submitting.', 'error');
                        return;
                    }

                    e.preventDefault();

                    const firstName = document.getElementById('firstName').value;
                    const lastName = document.getElementById('lastName').value;
                    const email = document.getElementById('email').value;
                    const username = document.getElementById('username').value;
                    const phoneValue = document.getElementById('phone').value.trim();

                    Swal.fire({
                        title: 'Confirm Account Creation',
                        html: `
                            <div class="tw-text-left tw-space-y-2">
                                <p><strong>Name:</strong> ${firstName} ${lastName}</p>
                                <p><strong>Email:</strong> ${email}</p>
                                <p><strong>Username:</strong> ${username}</p>
                                <p><strong>Phone:</strong> +63${phoneValue.replace(/\s/g, '')}</p>
                            </div>
                            <br>
                            <p class="tw-text-sm tw-text-gray-600">Please verify your information is correct before proceeding.</p>
                        `,
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#24CFF4',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, create account!',
                        cancelButtonText: 'Cancel',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const createBtn = document.getElementById('createAccountBtn');
                            createBtn.innerHTML = '<i class="fas fa-spinner fa-spin tw-mr-2"></i>Creating Account...';
                            createBtn.disabled = true;
                            form.submit();
                        }
                    });
                });
            }

            checkFormValidation();
        });
    </script>
</body>
</html>
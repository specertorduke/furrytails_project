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
                            <p id="phone-error" class="tw-hidden tw-text-red-500 tw-text-xs tw-flex tw-items-center"><i class="fas fa-exclamation-circle tw-mr-1"></i> Invalid format</p>
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
                    <span class="tw-text-xs tw-text-gray-500 tw-block tw-mt-1">Use 8+ chars with letters, numbers & symbols</span>

                    <div class="tw-flex tw-items-start tw-mt-4">
                        <div class="tw-flex tw-items-center tw-h-5">
                            <input id="terms" type="checkbox" required class="tw-focus:ring-[#24CFF4] tw-h-4 tw-w-4 tw-text-[#24CFF4] tw-border-gray-300 tw-rounded">
                        </div>
                        <div class="tw-ml-3 tw-text-sm">
                            <label for="terms" class="tw-font-medium tw-text-gray-700">I agree to the <a href="#" class="tw-text-[#24CFF4] hover:tw-underline">Terms of Use</a> and <a href="#" class="tw-text-[#24CFF4] hover:tw-underline">Privacy Policy</a>.</label>
                        </div>
                    </div>

                    <button type="submit" id="createAccountBtn" class="tw-w-full tw-mt-6 tw-bg-gray-400 tw-text-white tw-font-bold tw-py-3 tw-px-4 tw-rounded-lg tw-shadow-lg tw-transform tw-transition-all tw-duration-300 focus:tw-outline-none tw-cursor-not-allowed" disabled>
                        Create Account <i class="fas fa-arrow-right tw-ml-2"></i>
                    </button>
                </form>

                <p class="tw-mt-6 tw-text-center tw-text-sm tw-text-gray-600">
                    Already have an account? <a href="{{ route('login') }}" class="tw-text-[#24CFF4] tw-font-semibold hover:tw-text-[#0aa5cb] hover:tw-underline">Log in here</a>
                </p>
            </div>
        </div>
        </div>
    </div>

    <script>
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

        function checkFormValidation() {
            const firstName = document.getElementById('firstName').value.trim();
            const lastName = document.getElementById('lastName').value.trim();
            const email = document.getElementById('email').value.trim();
            const username = document.getElementById('username').value.trim();
            const phone = document.getElementById('phone').value.trim();
            const password = document.getElementById('password').value.trim();
            const passwordConfirmation = document.getElementById('password_confirmation').value.trim();
            const createAccountBtn = document.getElementById('createAccountBtn');
            
            // Check if phone is valid
            const phoneRegex = /^9\d{2}\s?\d{3}\s?\d{4}$/;
            const isPhoneValid = phoneRegex.test(phone);
            
            // Check if passwords match
            const doPasswordsMatch = password === passwordConfirmation && password.length > 0;
            
            // Check if all fields are filled and valid
            const allFieldsFilled = firstName && lastName && email && username && phone && password && passwordConfirmation;
            const allValid = allFieldsFilled && isPhoneValid && doPasswordsMatch;
            
            if (allValid) {
                createAccountBtn.disabled = false;
                createAccountBtn.classList.remove('tw-bg-gray-400', 'tw-cursor-not-allowed');
                createAccountBtn.classList.add('tw-bg-[#24CFF4]', 'tw-cursor-pointer');
            } else {
                createAccountBtn.disabled = true;
                createAccountBtn.classList.remove('tw-bg-[#24CFF4]', 'tw-cursor-pointer');
                createAccountBtn.classList.add('tw-bg-gray-400', 'tw-cursor-not-allowed');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const phoneInput = document.getElementById('phone');
            const allInputs = document.querySelectorAll('#signupForm input[required]');
            
            // Add event listeners to all required inputs for real-time validation
            allInputs.forEach(input => {
                input.addEventListener('input', checkFormValidation);
                input.addEventListener('blur', checkFormValidation);
            });

            if (phoneInput) {
                phoneInput.addEventListener('input', function(e) {
                    let value = e.target.value.replace(/\D/g, ''); // Remove non-digits
                    
                    // Limit to 10 digits (excluding +63 prefix)
                    if (value.length > 10) {
                        value = value.slice(0, 10);
                    }
                    
                    // Format with spaces
                    if (value.length > 3 && value.length <= 6) {
                        value = value.slice(0, 3) + ' ' + value.slice(3);
                    } else if (value.length > 6) {
                        value = value.slice(0, 3) + ' ' + value.slice(3, 6) + ' ' + value.slice(6);
                    }
                    
                    e.target.value = value;
                    
                    // Validate format for visual feedback
                    const phoneRegex = /^9\d{2}\s?\d{3}\s?\d{4}$/;
                    if (value.length > 0 && !phoneRegex.test(value)) {
                        phoneInput.classList.add('tw-border-yellow-400');
                        phoneInput.classList.remove('tw-border-green-500');
                        document.getElementById('phone-error').classList.add('tw-hidden');
                    } else if (value.length > 0) {
                        phoneInput.classList.remove('tw-border-yellow-400');
                        phoneInput.classList.add('tw-border-green-500');
                        document.getElementById('phone-error').classList.add('tw-hidden');
                    } else {
                        phoneInput.classList.remove('tw-border-yellow-400', 'tw-border-green-500');
                    }
                    
                    // Check form validation after phone input change
                    checkFormValidation();
                });
            }
            
            // Validate form submission with confirmation
            const form = document.getElementById('signupForm');
            if (form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault(); // Always prevent default first
                    
                    const phoneInput = document.getElementById('phone');
                    const phoneValue = phoneInput.value.trim();
                    const phoneRegex = /^9\d{2}\s?\d{3}\s?\d{4}$/;
                    
                    if (!phoneRegex.test(phoneValue)) {
                        phoneInput.classList.add('tw-border-red-500');
                        document.getElementById('phone-error').classList.remove('tw-hidden');
                        phoneInput.focus();
                        return;
                    }
                    
                    // Check if passwords match
                    const password = document.getElementById('password').value;
                    const passwordConfirmation = document.getElementById('password_confirmation').value;
                    
                    if (password !== passwordConfirmation) {
                        Swal.fire({
                            title: 'Password Mismatch',
                            text: 'Passwords do not match. Please check and try again.',
                            icon: 'error',
                            confirmButtonColor: '#24CFF4'
                        });
                        return;
                    }
                    
                    // Show confirmation dialog
                    const firstName = document.getElementById('firstName').value;
                    const lastName = document.getElementById('lastName').value;
                    const email = document.getElementById('email').value;
                    const username = document.getElementById('username').value;
                    
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
                            // Show loading state
                            const createBtn = document.getElementById('createAccountBtn');
                            const originalText = createBtn.innerHTML;
                            createBtn.innerHTML = '<i class="fas fa-spinner fa-spin tw-mr-2"></i>Creating Account...';
                            createBtn.disabled = true;
                            
                            // Add the +63 prefix to phone before submitting
                            const hiddenPhoneInput = document.createElement('input');
                            hiddenPhoneInput.type = 'hidden';
                            hiddenPhoneInput.name = 'full_phone';
                            hiddenPhoneInput.value = '+63' + phoneValue.replace(/\s/g, '');
                            form.appendChild(hiddenPhoneInput);
                            
                            // Submit the form
                            form.submit();
                        }
                    });
                });
            }
            
            // Initial validation check
            checkFormValidation();
        });
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body>
    <div class="container-fluid vh-100">
        <div class="row h-100">
            <div class="col-md-6 d-flex flex-column justify-content-center align-items-center tw-p-20 bgcolor-1">
                <img src="{{ asset('images/business-logo/logo.png') }}" alt="Business Logo" class="mb-4" style="max-width: 300px;">                
                <img src="{{ asset('images/icons/paw-white.png') }}" alt="white paw icon" class="mb-4 tw-w-full tw-place-self-start" style="max-width: 50px;">                
                <h2 class="font-poppins tw-font-bold tw-w-full">FurryTails</h2>
                <p class="tw-text-justify font-poppins">Easily spoil your dogs! FurryTails is your one-stop shop for scheduling your pets' comfortable boarding and expert grooming services. We've got them covered whether it's a spa day or a secure stay. Enroll right away to provide your pet with the affection and attention they merit!.</p>
            </div>

            <div class="col-md-6 d-flex flex-column justify-content-center align-items-center tw-bg-white">
                <div class="tw-w-3/5 tw-p-6 tw-shadow-lg tw-rounded-lg tw-mt-10 tw-mb-10">
                    <div class="tw-flex tw-flex-col tw-items-center">
                        <img src="{{ asset('images/icons/signUp.png') }}" alt="User Avatar" class="tw-w-[4rem] tw-h-[4rem] tw-mb-4 tw-rounded-full">
                        <h2 class="tw-text-left tw-w-full tw-text-lg tw-font-semibold tw-mb-4 tw-text-[1.3rem]">Sign Up</h2>
                    </div>
                    
                    @if ($errors->any())
                        <div class="tw-bg-red-100 tw-border tw-border-red-400 tw-text-red-700 tw-px-4 tw-py-3 tw-rounded tw-relative tw-mb-4" role="alert">
                            <strong class="tw-font-bold">Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('signup.submit') }}" class="tw-space-y-4" id="signupForm">
                        @csrf
                        <div class="tw-flex tw-space-x-4">
                            <div class="tw-w-1/2">
                                <label for="firstName" class="tw-block tw-text-sm tw-font-normal tw-text-gray-700">First Name</label>
                                <input type="text" id="firstName" name="firstName" value="{{ old('firstName') }}" required 
                                    class="tw-mt-1 tw-w-full tw-px-3 tw-py-2 tw-border tw-rounded-md tw-shadow-sm focus:tw-ring-indigo-500 focus:tw-border-indigo-500">
                            </div>
                            <div class="tw-w-1/2">
                                <label for="lastName" class="tw-block tw-text-sm tw-font-normal tw-text-gray-700">Last Name</label>
                                <input type="text" id="lastName" name="lastName" value="{{ old('lastName') }}" required 
                                    class="tw-mt-1 tw-w-full tw-px-3 tw-py-2 tw-border tw-rounded-md tw-shadow-sm focus:tw-ring-indigo-500 focus:tw-border-indigo-500">
                            </div>
                        </div>

                        <div>
                            <label for="email" class="tw-block tw-text-sm tw-font-normal tw-text-gray-700">Email Address</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required 
                                class="tw-mt-1 tw-w-full tw-px-3 tw-py-2 tw-border tw-rounded-md tw-shadow-sm focus:tw-ring-indigo-500 focus:tw-border-indigo-500">
                        </div>

                        <div>
                            <label for="username" class="tw-block tw-text-sm tw-font-normal tw-text-gray-700">Username</label>
                            <input type="text" id="username" name="username" value="{{ old('username') }}" required 
                                class="tw-mt-1 tw-w-full tw-px-3 tw-py-2 tw-border tw-rounded-md tw-shadow-sm focus:tw-ring-indigo-500 focus:tw-border-indigo-500">
                        </div>

                        <div>
                            <label for="phone" class="tw-block tw-text-sm tw-font-normal tw-text-gray-700">Phone Number</label>
                            <div class="tw-relative">
                                <span class="tw-absolute tw-left-3 tw-top-1/2 -tw-translate-y-1/2 tw-text-gray-400">+63</span>
                                <input type="tel" id="phone" name="phone" value="{{ old('phone') ? substr(old('phone'), 3) : '' }}" required 
                                    placeholder="9XX XXX XXXX" 
                                    class="tw-mt-1 tw-w-full tw-px-3 tw-py-2 tw-pl-12 tw-border tw-rounded-md tw-shadow-sm focus:tw-ring-indigo-500 focus:tw-border-indigo-500">
                            </div>
                            <div class="tw-flex tw-justify-between tw-items-center tw-mt-1">
                                <span class="tw-text-xs tw-text-gray-500">Format: 9XX XXX XXXX</span>
                                <p id="phone-error" class="tw-hidden tw-text-red-500 tw-text-xs">Invalid phone number format</p>
                            </div>
                        </div>

                        <div>
                            <label for="password" class="tw-block tw-text-sm tw-font-normal tw-text-gray-700">Password</label>
                            <div class="tw-relative">
                                <input type="password" id="password" name="password" required 
                                    class="tw-mt-1 tw-w-full tw-px-3 tw-py-2 tw-border tw-rounded-md tw-shadow-sm focus:tw-ring-indigo-500 focus:tw-border-indigo-500">
                                <span onclick="togglePassword()" class="tw-absolute tw-inset-y-0 tw-right-0 tw-flex tw-items-center tw-pr-3 tw-text-gray-400 hover:tw-text-gray-600 tw-cursor-pointer tw-transition-colors tw-duration-200">
                                    <i class="fa-regular fa-eye tw-text-lg" id="toggleIcon"></i>
                                </span>
                            </div>
                            <span class="tw-text-xs tw-text-gray-500">Tip: Use 8 or more characters with a mix of letters, numbers & symbols</span>
                        </div>

                        <div>
                            <label for="password_confirmation" class="tw-block tw-text-sm tw-font-normal tw-text-gray-700">Confirm Password</label>
                            <div class="tw-relative">
                                <input type="password" id="password_confirmation" name="password_confirmation" required 
                                    class="tw-mt-1 tw-w-full tw-px-3 tw-py-2 tw-border tw-rounded-md tw-shadow-sm focus:tw-ring-indigo-500 focus:tw-border-indigo-500">
                            </div>
                        </div>

                        <div class="tw-text-center tw-text-sm tw-text-gray-600">
                            By creating an account, you agree to our <a href="#" class="tw-text-indigo-600 hover:tw-underline">Terms of Use</a> and <a href="#" class="tw-text-indigo-600 hover:tw-underline">Privacy Policy</a>.
                        </div>

                        <button type="submit" id="createAccountBtn" class="tw-bg-gray-400 tw-text-white tw-font-bold tw-py-2 tw-px-4 tw-text-sm tw-rounded-full tw-transition-all tw-duration-300 tw-ease-in-out hover:tw-bg-[#24CFF4] focus:tw-bg-[#24CFF4] tw-block tw-mx-auto tw-cursor-not-allowed" disabled>
                            Create Account
                        </button>
                    </form>

                    <p class="tw-mt-4 tw-text-center tw-text-sm tw-text-gray-600">
                        Already have an account? <a href="{{ route('login') }}" class="tw-text-indigo-600 hover:tw-underline">Log in</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
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
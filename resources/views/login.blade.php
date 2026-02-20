<!-- filepath: /c:/xampp/htdocs/furrytails_project/resources/views/login.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .login-bg-pattern {
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
        <div class="tw-hidden md:tw-flex tw-w-1/2 tw-flex-col tw-justify-center tw-items-center tw-relative login-bg-pattern tw-text-white tw-p-12 tw-overflow-hidden">
            <div class="tw-absolute tw-top-0 tw-left-0 tw-w-full tw-h-full tw-bg-gradient-to-br tw-from-[#24CFF4]/90 tw-to-[#0aa5cb]/90"></div>
            
            <div class="tw-relative tw-z-10 tw-flex tw-flex-col tw-items-center tw-text-center">
                <a href="{{ route('home') }}" class="tw-mb-8 tw-transform hover:tw-scale-105 tw-transition-transform tw-duration-300">
                    <img src="{{ asset('images/business-logo/logo.png') }}" alt="Business Logo" class="tw-w-64 tw-drop-shadow-lg">                
                </a>
                
                <div class="tw-mt-8 tw-max-w-lg tw-text-center">
                    <h2 class="tw-text-4xl tw-font-bold tw-mb-4 text-white tw-drop-shadow-md">Welcome Back!</h2>
                    <p class="tw-text-lg tw-font-medium tw-text-white/90 tw-leading-relaxed tw-drop-shadow-sm">
                        FurryTails is your one-stop shop for scheduling your pets' comfortable boarding and expert grooming services. 
                        Login to access your pet's dashboard and schedule new appointments.
                    </p>
                </div>
            </div>
            
            <!-- decorative paw prints -->
            <i class="fas fa-paw tw-text-white/10 tw-text-9xl tw-absolute -tw-bottom-10 -tw-left-10 tw-rotate-12"></i>
            <i class="fas fa-paw tw-text-white/10 tw-text-8xl tw-absolute tw-top-20 tw-right-20 -tw-rotate-12"></i>
        </div>

        <!-- Right Side - Login Form -->
        <div class="tw-w-full md:tw-w-1/2 tw-flex tw-items-center tw-justify-center tw-bg-gray-50 tw-p-6 tw-overflow-y-auto tw-h-full">
            <div class="tw-w-full tw-max-w-md form-card tw-rounded-2xl tw-shadow-2xl tw-p-8 tw-border tw-border-gray-100 tw-my-auto">
                <div class="tw-flex tw-flex-col tw-items-center tw-mb-8">
                    <div class="tw-w-20 tw-h-20 tw-bg-[#eafbff] tw-rounded-full tw-flex tw-items-center tw-justify-center tw-mb-4 tw-shadow-sm">
                        <i class="fas fa-user tw-text-3xl tw-text-[#24CFF4]"></i>
                    </div>
                    <h2 class="tw-text-2xl tw-font-bold tw-text-gray-800">Sign In</h2>
                    <p class="tw-text-gray-500 tw-mt-1">Welcome back to FurryTails</p>
                </div>
                
                <!-- Error Message -->
                @if ($errors->any())
                    <div class="tw-bg-red-50 tw-border-l-4 tw-border-red-500 tw-text-red-700 tw-p-4 tw-rounded-r-lg tw-mb-6 tw-text-sm tw-shadow-sm animate__animated animate__shakeX" role="alert">
                        <div class="tw-flex tw-items-center tw-mb-1">
                            <i class="fas fa-exclamation-circle tw-mr-2"></i>
                            <strong class="tw-font-bold">Authentication failed</strong>
                        </div>
                        <ul class="tw-list-none tw-pl-0 tw-mb-0">
                            @foreach ($errors->all() as $error)
                                <li class="tw-ml-6">• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Forms -->
                <form method="POST" action="{{ route('login.submit') }}" class="tw-space-y-6">
                    @csrf
                    
                    <div>
                        <label for="login" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1.5">Username or Email</label>
                        <div class="tw-flex tw-items-center tw-shadow-sm tw-rounded-lg tw-overflow-hidden tw-border tw-border-gray-300 focus-within:tw-ring-2 focus-within:tw-ring-[#24CFF4] focus-within:tw-border-[#24CFF4] tw-transition-all">
                            <span class="tw-pl-3 tw-bg-white tw-text-gray-400">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input type="text" id="login" name="login" required 
                                class="tw-flex-1 tw-border-0 tw-py-2.5 tw-px-2 focus:tw-outline-none focus:tw-ring-0 placeholder:tw-text-gray-400" 
                                placeholder="Enter your username or email">
                        </div>
                    </div>

                    <div>
                        <label for="password" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1.5">Password</label>
                        <div class="tw-relative tw-flex tw-items-center tw-shadow-sm tw-rounded-lg tw-overflow-hidden tw-border tw-border-gray-300 focus-within:tw-ring-2 focus-within:tw-ring-[#24CFF4] focus-within:tw-border-[#24CFF4] tw-transition-all">
                            <span class="tw-pl-3 tw-bg-white tw-text-gray-400">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" id="password" name="password" required 
                                class="tw-flex-1 tw-border-0 tw-py-2.5 tw-px-2 focus:tw-outline-none focus:tw-ring-0 placeholder:tw-text-gray-400"
                                placeholder="Enter your password">
                            <button type="button" onclick="togglePassword()" class="tw-px-3 tw-text-gray-400 hover:tw-text-[#24CFF4] tw-bg-transparent tw-transition-colors focus:tw-outline-none">
                                <i class="fa-regular fa-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="tw-flex tw-justify-between tw-items-center">
                        <label class="tw-inline-flex tw-items-center tw-cursor-pointer">
                            <input type="checkbox" name="remember" id="remember" class="tw-rounded tw-border-gray-300 tw-text-[#24CFF4] focus:tw-ring-[#24CFF4] tw-h-4 tw-w-4 tw-transition duration-150 ease-in-out">
                            <span class="tw-ml-2 tw-text-sm tw-text-gray-600">Remember me</span>
                        </label>
                        <a href="#" class="tw-text-sm tw-font-medium tw-text-[#24CFF4] hover:tw-text-[#0aa5cb] tw-no-underline">Forgot password?</a>
                    </div>

                    <button type="submit" class="tw-w-full tw-bg-gradient-to-r tw-from-[#24CFF4] tw-to-[#0aa5cb] tw-text-white tw-font-bold tw-py-3 tw-px-4 tw-rounded-lg tw-shadow-lg tw-transform tw-transition-all tw-duration-300 hover:tw-scale-[1.02] hover:tw-shadow-xl focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-offset-2 focus:tw-ring-[#24CFF4]">
                        Sign In <i class="fas fa-arrow-right tw-ml-2"></i>
                    </button>
                </form>

                <div class="tw-relative tw-my-8">
                    <div class="tw-absolute tw-inset-0 tw-flex tw-items-center">
                        <div class="tw-w-full tw-border-t tw-border-gray-200"></div>
                    </div>
                    <div class="tw-relative tw-flex tw-justify-center tw-text-sm">
                        <span class="tw-px-4 tw-bg-white tw-text-gray-500">Or continue with</span>
                    </div>
                </div>

                <a href="{{ route('google.redirect') }}" class="tw-flex tw-items-center tw-justify-center tw-gap-3 tw-w-full tw-bg-white tw-border tw-border-gray-300 tw-text-gray-700 tw-font-medium tw-py-2.5 tw-px-4 tw-rounded-lg tw-transition-all tw-duration-300 hover:tw-bg-gray-50 hover:tw-shadow-md hover:tw-border-gray-400 tw-no-underline group">
                    <svg class="tw-w-5 tw-h-5 group-hover:tw-scale-110 tw-transition-transform" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                    </svg>
                    <span>Google</span>
                </a>

                <p class="tw-mt-8 tw-text-center tw-text-sm tw-text-gray-600">
                    Don't have an account? <a href="{{ route('signup') }}" class="tw-text-[#24CFF4] tw-font-semibold hover:tw-text-[#0aa5cb] hover:tw-underline">Sign up for free</a>
                </p>
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
    </script>

    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: "{{ session('success') }}",
            confirmButtonColor: '#24CFF4',
            confirmButtonText: 'OK'
        });
    </script>
    @endif
</body>
</html>
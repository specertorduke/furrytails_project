<!-- filepath: /c:/xampp/htdocs/furrytails_project/resources/views/auth/forgot-password.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - FurryTails</title>
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
                    <h2 class="tw-text-4xl tw-font-bold tw-mb-4 text-white tw-drop-shadow-md">Reset Your Password</h2>
                    <p class="tw-text-lg tw-font-medium tw-text-white/90 tw-leading-relaxed tw-drop-shadow-sm">
                        Don't worry! We'll help you reset your password and get back to your FurryTails account quickly and securely.
                    </p>
                </div>
            </div>
            
            <!-- decorative paw prints -->
            <i class="fas fa-paw tw-text-white/10 tw-text-9xl tw-absolute -tw-bottom-10 -tw-left-10 tw-rotate-12"></i>
            <i class="fas fa-paw tw-text-white/10 tw-text-8xl tw-absolute tw-top-20 tw-right-20 -tw-rotate-12"></i>
        </div>

        <!-- Right Side - Form -->
        <div class="tw-w-full md:tw-w-1/2 tw-flex tw-items-center tw-justify-center tw-bg-gray-50 tw-p-6 tw-overflow-y-auto tw-h-full">
            <div class="tw-w-full tw-max-w-md form-card tw-rounded-2xl tw-shadow-2xl tw-p-8 tw-border tw-border-gray-100 tw-my-auto">
                <div class="tw-flex tw-flex-col tw-items-center tw-mb-8">
                    <div class="tw-w-20 tw-h-20 tw-bg-[#eafbff] tw-rounded-full tw-flex tw-items-center tw-justify-center tw-mb-4 tw-shadow-sm">
                        <i class="fas fa-lock tw-text-3xl tw-text-[#24CFF4]"></i>
                    </div>
                    <h2 class="tw-text-2xl tw-font-bold tw-text-gray-800">Forgot Password?</h2>
                    <p class="tw-text-gray-500 tw-mt-1">We'll send you a reset link</p>
                </div>
                
                <!-- Status Message -->
                @if (session('status'))
                    <div class="tw-bg-green-50 tw-border-l-4 tw-border-green-500 tw-text-green-700 tw-p-4 tw-rounded-r-lg tw-mb-6 tw-text-sm tw-shadow-sm animate__animated animate__fadeIn" role="alert">
                        <div class="tw-flex tw-items-center tw-mb-1">
                            <i class="fas fa-check-circle tw-mr-2"></i>
                            <strong class="tw-font-bold">Success!</strong>
                        </div>
                        <p class="tw-ml-6">{{ session('status') }}</p>
                    </div>
                @endif

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="tw-bg-red-50 tw-border-l-4 tw-border-red-500 tw-text-red-700 tw-p-4 tw-rounded-r-lg tw-mb-6 tw-text-sm tw-shadow-sm animate__animated animate__shakeX" role="alert">
                        <div class="tw-flex tw-items-center tw-mb-1">
                            <i class="fas fa-exclamation-circle tw-mr-2"></i>
                            <strong class="tw-font-bold">Error</strong>
                        </div>
                        <ul class="tw-list-none tw-pl-0 tw-mb-0">
                            @foreach ($errors->all() as $error)
                                <li class="tw-ml-6">• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form -->
                <form method="POST" action="{{ route('password.email') }}" class="tw-space-y-6">
                    @csrf
                    
                    <div>
                        <label for="email" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-2">
                            <i class="fas fa-envelope tw-mr-2 tw-text-[#24CFF4]"></i>Email Address
                        </label>
                        <div class="tw-input-group tw-flex">
                            <span class="tw-input-group-text tw-border tw-border-gray-300 tw-rounded-l-lg tw-px-4 tw-py-3 tw-bg-white tw-flex tw-items-center">
                                <i class="fas fa-envelope tw-text-gray-400"></i>
                            </span>
                            <input 
                                type="email" 
                                class="tw-form-control tw-flex-1 tw-border tw-border-l-0 tw-border-gray-300 tw-rounded-r-lg tw-px-4 tw-py-3 tw-focus:outline-none tw-focus:ring-2 tw-focus:ring-offset-0 tw-focus:ring-[#24CFF4] @error('email') tw-border-red-500 @enderror" 
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="Enter your email address"
                                required
                            >
                        </div>
                        @error('email')
                            <span class="tw-text-red-500 tw-text-xs tw-mt-1 tw-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <button 
                        type="submit" 
                        class="tw-w-full tw-bg-[#24CFF4] hover:tw-bg-[#0aa5cb] tw-text-white tw-font-semibold tw-py-3 tw-rounded-lg tw-transition tw-duration-300 tw-transform hover:tw-scale-105 tw-shadow-lg hover:tw-shadow-xl tw-flex tw-items-center tw-justify-center tw-gap-2"
                    >
                        <i class="fas fa-paper-plane"></i>
                        Send Reset Link
                    </button>

                    <div class="tw-relative tw-my-6">
                        <div class="tw-absolute tw-inset-0 tw-flex tw-items-center">
                            <div class="tw-w-full tw-border-t tw-border-gray-300"></div>
                        </div>
                        <div class="tw-relative tw-flex tw-justify-center tw-text-sm">
                            <span class="tw-px-2 tw-bg-gray-50 tw-text-gray-500">or</span>
                        </div>
                    </div>

                    <div class="tw-text-center">
                        <p class="tw-text-gray-600 tw-text-sm">
                            Remember your password? 
                            <a href="{{ route('login') }}" class="tw-text-[#24CFF4] hover:tw-text-[#0aa5cb] tw-font-semibold tw-no-underline tw-transition tw-duration-200">
                                Sign In
                            </a>
                        </p>
                    </div>

                    <div class="tw-text-center tw-mt-4">
                        <p class="tw-text-gray-600 tw-text-sm">
                            Don't have an account? 
                            <a href="{{ route('signup') }}" class="tw-text-[#24CFF4] hover:tw-text-[#0aa5cb] tw-font-semibold tw-no-underline tw-transition tw-duration-200">
                                Sign Up
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<!-- filepath: /c:/xampp/htdocs/furrytails_project/resources/views/login.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

            <div class="col-md-6 d-flex flex-column justify-content-center align-items-center tw-bg-gray-50">
                <div class="tw-w-3/5 tw-p-6 tw-shadow-xl tw-rounded-lg">
                    <div class="tw-flex tw-flex-col tw-items-center">
                        <img src="{{ asset('images/icons/signIn.png') }}" alt="User Avatar" class="tw-w-[4rem] tw-h-[4rem] tw-mb-4 tw-rounded-full">
                        <h2 class="tw-text-center tw-w-full tw-text-lg tw-font-semibold tw-mb-4 tw-text-[1.3rem]">Sign in</h2>
                    </div>
                    
                    <!-- Error Message -->
                    @if ($errors->any())
                        <div class="tw-bg-red-100 tw-border tw-border-red-400 tw-text-red-700 tw-px-4 tw-py-3 tw-rounded tw-relative tw-mb-4" role="alert">
                            <strong class="tw-font-bold">Whoops!</strong>
                            <span class="tw-block sm:tw-inline">Something went wrong:</span>
                            <ul class="tw-mt-2 tw-list-disc tw-list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Forms -->
                    <form method="POST" action="{{ route('login.submit') }}" class="tw-space-y-4">
                        @csrf
                        <div>
                            <label for="login" class="tw-block tw-text-sm tw-font-normal tw-text-gray-700">Username or Email Address</label>
                            <input type="text" id="login" name="login" required 
                                class="tw-mt-1 tw-w-full tw-px-3 tw-py-2 tw-border tw-rounded-md tw-shadow-sm focus:tw-ring-indigo-500 focus:tw-border-indigo-500">
                        </div>

                        <div>
                            <label for="password" class="tw-block tw-text-sm tw-font-normal tw-text-gray-700">Your password</label>
                            <div class="tw-relative">
                                <input type="password" id="password" name="password" required 
                                    class="tw-mt-1 tw-w-full tw-px-3 tw-py-2 tw-border tw-rounded-md tw-shadow-sm focus:tw-ring-indigo-500 focus:tw-border-indigo-500">
                                <span onclick="togglePassword()" class="tw-absolute tw-inset-y-0 tw-right-0 tw-flex tw-items-center tw-pr-3 tw-text-gray-400 hover:tw-text-gray-600 tw-cursor-pointer tw-transition-colors tw-duration-200">
                                    <i class="fa-regular fa-eye tw-text-lg" id="toggleIcon"></i>
                                </span>
                            </div>
                        </div>
                        
                        <div class="tw-text-right">
                            <a href="#" class="tw-text-sm tw-text-indigo-600 hover:tw-underline">Forgot your password</a>
                        </div>

                        <button type="submit" class="tw-bg-[#24CFF4] tw-text-white tw-font-bold tw-py-3 tw-px-8 tw-text-sm tw-rounded-full tw-transition-all tw-duration-300 tw-ease-in-out hover:tw-bg-[#63e4fd] focus:tw-bg-[#038cb7] tw-block tw-mx-auto">
                            Sign in
                        </button>
                    </form>

                    <div class="tw-mt-4 tw-flex tw-items-center tw-justify-center">
                        <div class="tw-border-t tw-border-gray-300 tw-flex-grow"></div>
                        <span class="tw-px-4 tw-text-sm tw-text-gray-500">OR</span>
                        <div class="tw-border-t tw-border-gray-300 tw-flex-grow"></div>
                    </div>

                    <a href="{{ route('google.redirect') }}" class="tw-mt-4 tw-flex tw-items-center tw-justify-center tw-gap-3 tw-bg-white tw-border tw-border-gray-300 tw-text-gray-700 tw-font-semibold tw-py-3 tw-px-6 tw-rounded-full tw-transition-all tw-duration-300 tw-ease-in-out hover:tw-bg-gray-50 hover:tw-shadow-md">
                        <svg class="tw-w-5 tw-h-5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                        </svg>
                        <span>Continue with Google</span>
                    </a>

                    <p class="tw-mt-4 tw-text-center tw-text-sm tw-text-gray-600">
                        Don’t have an account? <a href="{{ route('signup') }}" class="tw-text-indigo-600 hover:tw-underline">Sign up</a>
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
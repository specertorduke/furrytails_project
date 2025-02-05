<!-- filepath: /c:/xampp/htdocs/dashboard/furrytails_project/resources/views/login.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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
                <div class="tw-w-3/5 tw-p-6 tw-shadow-lg tw-rounded-lg">
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
                            <a href="#" class="tw-text-sm tw-text-indigo-600 hover:tw-underline">Forget your password</a>
                        </div>

                        <button type="submit" class="tw-bg-gray-400 tw-text-white tw-font-bold tw-py-3 tw-px-8 tw-text-sm tw-rounded-full tw-transition-all tw-duration-300 tw-ease-in-out hover:tw-bg-blue-400 tw-block tw-mx-auto">
                            Sign in
                        </button>
                    </form>

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

</body>
</html>
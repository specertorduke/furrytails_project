<!-- filepath: /c:/xampp/htdocs/dashboard/furrytails_project/resources/views/login.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body>
    <div class="container-fluid vh-100">
        <div class="row h-100">
            <div class="col-md-6 d-flex flex-column justify-content-center align-items-center tw-p-20 bgcolor-1">
                <img src="{{ asset('images/business-logo/logo.png') }}" alt="Business Logo" class="mb-4" style="max-width: 300px;">                
                <img src="{{ asset('images\icons\paw-white.png') }}" alt="white paw icon" class="mb-4 tw-w-full tw-place-self-start" style="max-width: 50px;">                
                <h2 class="font-poppins tw-font-bold tw-w-full">FurryTails</h2>
                <p class="tw-text-justify font-poppins">Pamper your pets with ease! FurryTails is your one-stop platform for booking professional grooming and cozy boarding services for your furry friends. Whether it’s a spa day or a safe stay, we’ve got their tails covered. Sign up now to give your pet the love and care they deserve!.</p>
            </div>

            <div class="col-md-6 d-flex flex-column justify-content-center align-items-center">
                <div class="card w-75">
                    <div class="card-header">
                        <h3 class="text-center">Login</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
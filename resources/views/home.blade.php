<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FurryTails - Pet Care Services</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <style>
        .sticky-header {
            position: sticky;
            top: 0;
            z-index: 1000;
            background-color: white;
        }
        .hover-animate {
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .hover-animate:hover {
            transform: scale(1.1);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .nav-link-h {
            transition: transform 0.4s !important;
        }
        .nav-link-h:hover, .nav-link-h:focus {
            transform: scale(1.02) !important;
        }
        @media (max-width: 768px) {
            .desktop-menu {
                display: none !important;
            }
            .mobile-menu {
                display: block !important;
            }
        }
        @media (min-width: 769px) {
            .desktop-menu {
                display: flex !important;
            }
            .mobile-menu {
                display: none !important;
            }
        }
    </style>
</head>
<body class="font-poppins">
    <!-- Navigation Bar -->
    <nav class="tw-bg-white tw-shadow-md sticky-header">
        <div class="container-fluid px-4 py-3">
            <div class="row align-items-center">
                <div class="col-6 col-md-3">
                    <div class="tw-flex tw-items-center">
                        <img src="{{ asset('images/business-logo/logo.png') }}" alt="FurryTails Logo" class="tw-h-12">
                        <span class="tw-ml-4 tw-text-xl tw-font-semibold">FurryTails</span>
                    </div>
                </div>
                <div class="col-6 col-md-9 tw-flex tw-justify-end">
                    <div class="tw-flex tw-items-center desktop-menu" style="justify-content: end;">
                        <ul class="tw-flex tw-items-center tw-space-x-12 tw-list-none tw-m-0 tw-p-1">
                            <li><a href="#" class="tw-h-full tw-w-full tw-text-gray-600 nav-link-h tw-no-underline">Home</a></li>
                            <li><a href="#about" class="tw-h-full tw-w-full tw-text-gray-600 nav-link-h tw-no-underline">About</a></li>
                            <li><a href="#services" class="tw-h-full tw-w-full tw-text-gray-600 nav-link-h tw-no-underline">Services</a></li>
                            <li><a href="#contact" class="tw-h-full tw-w-full tw-text-gray-600 nav-link-h tw-no-underline">Contact</a></li>
                            <li><a href="{{ route('login') }}" class="tw-bg-[#24CFF4] tw-text-white tw-no-underline tw-px-6 tw-py-2 tw-rounded-full hover:tw-bg-[#63e4fd] tw-transition-colors" style="padding-left: 1rem; padding-right: 1rem;">Sign In</a></li>
                        </ul>
                    </div>
                    <button class="tw-text-gray-600 mobile-menu" onclick="toggleMobileMenu()">
                        <i class="fas fa-bars tw-text-2xl"></i>
                    </button>
                </div>
            </div>
            <!-- Mobile Menu -->
            <div id="mobileMenu" class="tw-hidden tw-mt-4 tw-space-y-4 tw-pb-4">
                <div class="tw-flex tw-ml-3 tw-flex-col tw-items-baseline tw-space-y-4">
                    <a href="#" class="tw-h-full tw-w-full tw-text-gray-600 nav-link-h tw-no-underline">Home</a>
                    <a href="#about" class="tw-h-full tw-w-full tw-text-gray-600 nav-link-h tw-no-underline">About</a>
                    <a href="#services" class="tw-h-full tw-w-full tw-text-gray-600 nav-link-h tw-no-underline">Services</a>
                    <a href="#contact" class="tw-h-full tw-w-full tw-text-gray-600 nav-link-h tw-no-underline">Contact</a>
                </div>
                <a href="{{ route('login') }}" class="tw-block tw-bg-[#24CFF4] tw-text-white tw-px-6 tw-py-2 tw-rounded-full hover:tw-bg-[#63e4fd] tw-text-center tw-no-underline">Sign In</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="tw-bg-gradient-to-r tw-from-[#d8f9ff] tw-to-white">
        <div class="container-fluid px-4 py-5">
            <div class="row align-items-center">
                <div class="col-12 col-md-6 mb-4 mb-md-0">
                    <h1 class="tw-text-4xl md:tw-text-5xl tw-font-bold mb-4">Welcome to FurryTails</h1>
                    <p class="tw-text-gray-600 mb-4 tw-text-lg">Your trusted partner in pet care. We provide premium boarding and grooming services for your beloved furry friends.</p>
                    <div class="d-flex gap-3">
                        <a href="{{ route('signup') }}" class="tw-bg-[#24CFF4] tw-text-white tw-px-8 tw-py-3 tw-rounded-full hover:tw-bg-[#63e4fd] tw-transition-colors tw-no-underline">Get Started</a>
                        <a href="#services" class="tw-bg-white tw-text-[#24CFF4] tw-px-8 tw-py-3 tw-rounded-full tw-border tw-border-[#24CFF4] hover:tw-bg-[#d8f9ff] tw-transition-colors tw-no-underline">Learn More</a>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <img src="{{ asset('images/home/hero-img.png') }}" alt="Happy Pets" class="img-fluid tw-rounded-lg tw-shadow-xl hover-animate">
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-5">
        <div class="container-fluid px-4">
            <div class="row align-items-center">
                <div class="col-12 col-md-6 mb-4 mb-md-0">
                    <img src="{{ asset('images/home/about-image.png') }}" alt="Our Story" class="img-fluid tw-rounded-lg tw-shadow-xl hover-animate">
                </div>
                <div class="col-12 col-md-6">
                    <h2 class="tw-text-3xl tw-font-bold mb-4">Our Story</h2>
                    <p class="tw-text-gray-600 mb-4">FurryTails was founded with a simple mission: to provide the highest quality pet care services while giving pet owners peace of mind. We understand that your pets are family, and we treat them as our own.</p>
                    <a href="#contact" class="tw-text-[#24CFF4] hover:tw-underline tw-no-underline">Learn more about our journey →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="tw-bg-gray-50 py-5">
        <div class="container-fluid px-4">
            <h2 class="tw-text-3xl tw-font-bold text-center mb-5">Our Services</h2>
            <div class="row g-4">
                <!-- Pet Boarding -->
                <div class="col-12 col-md-4">
                    <div class="tw-bg-white tw-rounded-lg tw-shadow-lg tw-p-6 tw-transition-transform hover:tw-scale-105 h-100 hover-animate">
                        <div class="tw-flex tw-justify-center mb-4">
                            <i class="fas fa-home tw-text-4xl tw-text-[#24CFF4]"></i>
                        </div>
                        <h3 class="tw-text-xl tw-font-semibold text-center mb-3">Pet Boarding</h3>
                        <p class="tw-text-gray-600 text-center mb-0">Safe and comfortable accommodation for your pets while you're away.</p>
                    </div>
                </div>
                <!-- Pet Grooming -->
                <div class="col-12 col-md-4">
                    <div class="tw-bg-white tw-rounded-lg tw-shadow-lg tw-p-6 tw-transition-transform hover:tw-scale-105 h-100 hover-animate">
                        <div class="tw-flex tw-justify-center mb-4">
                            <i class="fas fa-cut tw-text-4xl tw-text-[#24CFF4]"></i>
                        </div>
                        <h3 class="tw-text-xl tw-font-semibold text-center mb-3">Pet Grooming</h3>
                        <p class="tw-text-gray-600 text-center mb-0">Professional grooming services to keep your pets clean and healthy.</p>
                    </div>
                </div>
                <!-- Pet Training -->
                <div class="col-12 col-md-4">
                    <div class="tw-bg-white tw-rounded-lg tw-shadow-lg tw-p-6 tw-transition-transform hover:tw-scale-105 h-100 hover-animate">
                        <div class="tw-flex tw-justify-center mb-4">
                            <i class="fas fa-paw tw-text-4xl tw-text-[#24CFF4]"></i>
                        </div>
                        <h3 class="tw-text-xl tw-font-semibold text-center mb-3">Pet Training</h3>
                        <p class="tw-text-gray-600 text-center mb-0">Expert training sessions to help your pets develop good behaviors.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-5">
        <div class="container-fluid px-4">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <h2 class="tw-text-3xl tw-font-bold text-center mb-5">Contact Us</h2>
                    <form action = "https://submit-form.com/vpxJvmHCD">
                        <div class="row g-3 mb-3">
                            <div class="col-12 col-md-6">
                                <label class="tw-block tw-text-sm tw-font-normal tw-text-gray-700 mb-2">Name</label>
                                <input type="text" id="name" name="name" placeholder="Name" required="" class="form-control tw-rounded-md tw-shadow-sm">
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="tw-block tw-text-sm tw-font-normal tw-text-gray-700 mb-2">Email</label>
                                <input type="email" id="email" name="email" placeholder="Email" required="" class="form-control tw-rounded-md tw-shadow-sm">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="tw-block tw-text-sm tw-font-normal tw-text-gray-700 mb-2">Message</label>
                            <textarea rows="4" id="message" name="message" placeholder="Message" required="" class="form-control tw-rounded-md tw-shadow-sm"></textarea>
                        </div>
                        <button type="submit" class="tw-bg-[#24CFF4] tw-text-white tw-font-bold tw-py-3 tw-px-8 tw-rounded-full tw-transition-colors hover:tw-bg-[#63e4fd] d-block mx-auto">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="tw-bg-gray-50 py-4">
        <div class="container-fluid px-4">
            <div class="row align-items-center">
                <div class="col-12 col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <div class="tw-flex tw-items-center justify-content-center justify-content-md-start">
                        <img src="{{ asset('images/business-logo/logo.png') }}" alt="FurryTails Logo" class="tw-h-10">
                        <span class="tw-ml-2 tw-text-lg tw-font-semibold">FurryTails</span>
                    </div>
                </div>
                <div class="col-12 col-md-6 text-center text-md-end">
                    <div class="tw-flex tw-space-x-7 justify-content-center justify-content-md-end">
                        <a href="#" class="tw-text-gray-600 hover:tw-text-[#24CFF4]"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="tw-text-gray-600 hover:tw-text-[#24CFF4]"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="tw-text-gray-600 hover:tw-text-[#24CFF4]"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 text-center">
                    <p class="tw-text-gray-600 tw-text-sm mb-0">© 2025 FurryTails. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobileMenu');
            mobileMenu.classList.toggle('tw-hidden');
        }
    </script>
</body>
</html>
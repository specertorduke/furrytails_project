@extends('main')

@section('title', 'About Us')

@section('content')
<div class="container-fluid tw-min-h-screen tw-overflow-y-auto tw-bg-[#f4fbfd] tw-p-6 font-poppins">
    <div class="tw-overflow-hidden tw-rounded-3xl tw-bg-gradient-to-r tw-from-[#1cb8d8] tw-to-[#24CFF4] tw-p-6 tw-text-white tw-shadow-lg tw-mb-5">
        <div class="row g-4 tw-items-center">
            <div class="col-12 col-lg-8">
                <p class="tw-mb-2 tw-text-sm tw-uppercase tw-tracking-[0.2em] tw-text-white/80">About FurryTails</p>
                <h1 class="tw-mb-2 tw-text-3xl tw-font-bold md:tw-text-4xl">Care, comfort, and convenience for every pet family</h1>
                <p class="tw-mb-0 tw-max-w-2xl tw-text-white/90">Professional grooming and boarding support with an online experience that keeps everything simple, clear, and easy to manage.</p>
            </div>
            <div class="col-12 col-lg-4 tw-flex tw-justify-start lg:tw-justify-end tw-mt-2 lg:tw-mt-0">
                <div class="tw-rounded-2xl tw-bg-white/15 tw-p-4 tw-backdrop-blur-sm tw-w-full lg:tw-max-w-sm">
                    <div class="tw-flex tw-items-center tw-gap-3">
                        <img src="{{ asset('images/business-logo/logo.png') }}" alt="FurryTails Logo" class="tw-h-14 tw-w-14 tw-rounded-full tw-object-cover tw-ring-2 tw-ring-white/40">
                        <div>
                            <p class="tw-mb-0 tw-text-sm tw-font-semibold">FurryTails</p>
                            <p class="tw-mb-0 tw-text-xs tw-text-white/80">Fluff & Co</p>
                        </div>
                    </div>
                    <p class="tw-mt-3 tw-mb-0 tw-text-sm tw-text-white/90">A friendlier way to learn what we do, why we do it, and how to get started.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="tw-px-0 tw-pt-4 tw-pb-4">

        <!-- Mission & Story -->
        <div class="container-fluid tw-mb-16">
            <div class="row g-4">
                <!-- Mission -->
                <div class="col-12 col-md-6">
                    <div class="tw-bg-white tw-rounded-3xl tw-p-8 tw-h-100 tw-shadow-md hover:tw-shadow-xl tw-transition-all tw-duration-300 tw-border-l-4 tw-border-[#24CFF4]">
                        <div class="tw-flex tw-items-center tw-gap-3 tw-mb-5">
                            <div class="tw-bg-[#e0f9ff] tw-rounded-2xl tw-p-3">
                                <i class="fas fa-bullseye tw-text-[#24CFF4] tw-text-2xl"></i>
                            </div>
                            <h2 class="tw-text-2xl tw-font-bold tw-text-gray-800">Our Mission</h2>
                        </div>
                        <p class="tw-text-gray-600 tw-leading-relaxed">
                            At FurryTails, our mission is simple: to provide exceptional care and comfort for your beloved pets. We believe every pet deserves to feel loved, safe, and pampered. Through our convenient online platform, we make it easy for pet owners to book professional grooming and boarding services, ensuring your furry friends are always in the best hands. Because when your pet is happy, you're happy too!
                        </p>
                    </div>
                </div>

                <!-- Photo 1 -->
                <div class="col-12 col-md-6">
                    <div class="tw-rounded-3xl tw-overflow-hidden tw-shadow-md hover:tw-shadow-xl tw-transition-all tw-duration-300 tw-h-100">
                        <img src="{{ asset('images/stock/about-photo1.jpg') }}" alt="Pet Grooming"
                             class="tw-w-full tw-h-full tw-object-cover">
                    </div>
                </div>

                <!-- Photo 2 -->
                <div class="col-12 col-md-6">
                    <div class="tw-rounded-3xl tw-overflow-hidden tw-shadow-md hover:tw-shadow-xl tw-transition-all tw-duration-300 tw-h-100">
                        <img src="{{ asset('images/stock/about-photo2.jpg') }}" alt="Pet Boarding"
                             class="tw-w-full tw-h-full tw-object-cover">
                    </div>
                </div>

                <!-- Story -->
                <div class="col-12 col-md-6">
                    <div class="tw-bg-white tw-rounded-3xl tw-p-8 tw-h-100 tw-shadow-md hover:tw-shadow-xl tw-transition-all tw-duration-300 tw-border-l-4 tw-border-[#24CFF4]">
                        <div class="tw-flex tw-items-center tw-gap-3 tw-mb-5">
                            <div class="tw-bg-[#e0f9ff] tw-rounded-2xl tw-p-3">
                                <i class="fas fa-book-open tw-text-[#24CFF4] tw-text-2xl"></i>
                            </div>
                            <h2 class="tw-text-2xl tw-font-bold tw-text-gray-800">Our Story</h2>
                        </div>
                        <p class="tw-text-gray-600 tw-leading-relaxed">
                            FurryTails was born from a deep love of animals and a desire to make quality pet care accessible to everyone. What started as a small local grooming service grew into a full-service pet care platform. Today, we proudly serve hundreds of pet families, offering everything from professional grooming appointments to multi-day boarding — all bookable through our easy-to-use online system.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Why Choose Us -->
        <div class="container-fluid tw-mb-16">
            <h2 class="tw-text-3xl tw-font-bold tw-text-center tw-mb-2 tw-text-gray-800">
                Why Choose <span class="tw-text-[#24CFF4]">FurryTails?</span>
            </h2>
            <p class="tw-text-center tw-text-gray-500 tw-mb-10">Everything your pet needs, all in one place.</p>
            <div class="row g-4">
                <div class="col-12 col-md-4">
                    <div class="tw-bg-white tw-rounded-3xl tw-p-8 tw-text-center tw-shadow-md hover:tw-shadow-xl hover:tw-translate-y-[-6px] tw-transition-all tw-duration-300 tw-h-100">
                        <div class="tw-bg-[#e0f9ff] tw-rounded-full tw-w-20 tw-h-20 tw-flex tw-items-center tw-justify-center tw-mx-auto tw-mb-5">
                            <i class="fas fa-shield-alt tw-text-[#24CFF4] tw-text-3xl"></i>
                        </div>
                        <h3 class="tw-text-xl tw-font-bold tw-text-gray-800 tw-mb-3">Trusted & Safe</h3>
                        <p class="tw-text-gray-500 tw-leading-relaxed">Your pets are in caring, experienced hands. We prioritize safety, hygiene, and comfort in every service we provide.</p>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="tw-bg-white tw-rounded-3xl tw-p-8 tw-text-center tw-shadow-md hover:tw-shadow-xl hover:tw-translate-y-[-6px] tw-transition-all tw-duration-300 tw-h-100">
                        <div class="tw-bg-[#e0f9ff] tw-rounded-full tw-w-20 tw-h-20 tw-flex tw-items-center tw-justify-center tw-mx-auto tw-mb-5">
                            <i class="fas fa-star tw-text-[#24CFF4] tw-text-3xl"></i>
                        </div>
                        <h3 class="tw-text-xl tw-font-bold tw-text-gray-800 tw-mb-3">Expert Care</h3>
                        <p class="tw-text-gray-500 tw-leading-relaxed">Our professional groomers and caretakers are trained to handle pets of all breeds and sizes with skill and genuine compassion.</p>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="tw-bg-white tw-rounded-3xl tw-p-8 tw-text-center tw-shadow-md hover:tw-shadow-xl hover:tw-translate-y-[-6px] tw-transition-all tw-duration-300 tw-h-100">
                        <div class="tw-bg-[#e0f9ff] tw-rounded-full tw-w-20 tw-h-20 tw-flex tw-items-center tw-justify-center tw-mx-auto tw-mb-5">
                            <i class="fas fa-calendar-check tw-text-[#24CFF4] tw-text-3xl"></i>
                        </div>
                        <h3 class="tw-text-xl tw-font-bold tw-text-gray-800 tw-mb-3">Easy Booking</h3>
                        <p class="tw-text-gray-500 tw-leading-relaxed">Schedule grooming or boarding in just a few clicks. Manage appointments, track your pets, and stay updated — all in one place.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Location Section -->
        <div class="container-fluid tw-mb-16">
            <h2 class="tw-text-3xl tw-font-bold tw-text-center tw-mb-2 tw-text-gray-800">
                Find <span class="tw-text-[#24CFF4]">Us Here</span>
            </h2>
            <p class="tw-text-center tw-text-gray-500 tw-mb-10">Come visit us — we'd love to meet you and your pet!</p>
            <div class="row g-4 align-items-stretch">
                <div class="col-12 col-lg-8">
                    <div class="tw-rounded-3xl tw-overflow-hidden tw-border-4 tw-border-[#24CFF4] tw-shadow-lg tw-h-100" style="min-height: 380px;">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d989.8796021498383!2d125.5956992309869!3d7.065729099999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32f96d65ac7d3493%3A0xa54471a513d5fc70!2sUniversity%20of%20Mindanao%20-%20Matina!5e0!3m2!1sen!2sph!4v1740412211361!5m2!1sen!2sph"
                            class="tw-w-full tw-h-full"
                            style="border:0; min-height: 380px;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="tw-bg-white tw-rounded-3xl tw-p-8 tw-shadow-md tw-h-100">
                        <h3 class="tw-text-xl tw-font-bold tw-text-gray-800 tw-mb-6">Get In Touch</h3>
                        <div class="tw-flex tw-flex-col tw-gap-5">
                            <div class="tw-flex tw-items-start tw-gap-4">
                                <div class="tw-bg-[#e0f9ff] tw-rounded-xl tw-p-3 tw-flex-shrink-0">
                                    <i class="fas fa-map-marker-alt tw-text-[#24CFF4] tw-text-lg"></i>
                                </div>
                                <div>
                                    <p class="tw-font-semibold tw-text-gray-700 tw-mb-1">Address</p>
                                    <p class="tw-text-gray-500 tw-text-sm">University of Mindanao – Matina,<br>Davao City, Philippines</p>
                                </div>
                            </div>
                            <div class="tw-flex tw-items-start tw-gap-4">
                                <div class="tw-bg-[#e0f9ff] tw-rounded-xl tw-p-3 tw-flex-shrink-0">
                                    <i class="fas fa-clock tw-text-[#24CFF4] tw-text-lg"></i>
                                </div>
                                <div>
                                    <p class="tw-font-semibold tw-text-gray-700 tw-mb-1">Hours</p>
                                    <p class="tw-text-gray-500 tw-text-sm">Mon – Sat: 8:00 AM – 6:00 PM</p>
                                    <p class="tw-text-gray-500 tw-text-sm">Sunday: 9:00 AM – 3:00 PM</p>
                                </div>
                            </div>
                            <div class="tw-flex tw-items-start tw-gap-4">
                                <div class="tw-bg-[#e0f9ff] tw-rounded-xl tw-p-3 tw-flex-shrink-0">
                                    <i class="fas fa-phone tw-text-[#24CFF4] tw-text-lg"></i>
                                </div>
                                <div>
                                    <p class="tw-font-semibold tw-text-gray-700 tw-mb-1">Phone</p>
                                    <p class="tw-text-gray-500 tw-text-sm">+63 912 345 6789</p>
                                </div>
                            </div>
                            <div class="tw-flex tw-items-start tw-gap-4">
                                <div class="tw-bg-[#e0f9ff] tw-rounded-xl tw-p-3 tw-flex-shrink-0">
                                    <i class="fas fa-envelope tw-text-[#24CFF4] tw-text-lg"></i>
                                </div>
                                <div>
                                    <p class="tw-font-semibold tw-text-gray-700 tw-mb-1">Email</p>
                                    <p class="tw-text-gray-500 tw-text-sm">contact@furrytails.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Connect With Us CTA -->
        <div class="container-fluid tw-mb-10">
            <div class="tw-bg-gradient-to-r tw-from-[#0da8c5] tw-to-[#24CFF4] tw-rounded-3xl tw-py-14 tw-px-8 tw-text-center tw-shadow-lg">
                <h2 class="tw-text-3xl tw-font-bold tw-text-white tw-mb-3">Stay Connected</h2>
                <p class="tw-text-white/90 tw-mb-8 tw-text-lg">Follow us on social media for the latest updates, pet care tips, and adorable photos!</p>
                <div class="tw-flex tw-justify-center tw-gap-5 tw-flex-wrap">
                    <a href="#" title="Facebook"
                       class="tw-bg-white tw-text-[#24CFF4] hover:tw-bg-[#0da8c5] hover:tw-text-white tw-w-14 tw-h-14 tw-rounded-full tw-flex tw-items-center tw-justify-center tw-text-xl tw-shadow-md tw-transition-all tw-duration-300 hover:tw-scale-110">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" title="Instagram"
                       class="tw-bg-white tw-text-[#24CFF4] hover:tw-bg-[#0da8c5] hover:tw-text-white tw-w-14 tw-h-14 tw-rounded-full tw-flex tw-items-center tw-justify-center tw-text-xl tw-shadow-md tw-transition-all tw-duration-300 hover:tw-scale-110">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" title="Twitter / X"
                       class="tw-bg-white tw-text-[#24CFF4] hover:tw-bg-[#0da8c5] hover:tw-text-white tw-w-14 tw-h-14 tw-rounded-full tw-flex tw-items-center tw-justify-center tw-text-xl tw-shadow-md tw-transition-all tw-duration-300 hover:tw-scale-110">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="mailto:contact@furrytails.com" title="Email Us"
                       class="tw-bg-white tw-text-[#24CFF4] hover:tw-bg-[#0da8c5] hover:tw-text-white tw-w-14 tw-h-14 tw-rounded-full tw-flex tw-items-center tw-justify-center tw-text-xl tw-shadow-md tw-transition-all tw-duration-300 hover:tw-scale-110">
                        <i class="fas fa-envelope"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="container-fluid tw-pb-4">
            <div class="tw-text-center">
                <p class="tw-text-gray-400 tw-text-sm">© 2025 FurryTails. All rights reserved.</p>
            </div>
        </div>

    </div>
</div>

@endsection

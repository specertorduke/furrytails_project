@extends('main')

@section('title', 'About Us')

@section('content')
<div class="tw-p-6 tw-bg-gradient-to-tl tw-min-h-screen tw-to-[#b7f4ff] tw-from-white">
    <!-- Header -->
    <div class="container-fluid mb-4">
        <div class="row">
            <div class="col-12">
                <!-- <p class="tw-text-sm tw-text-gray-500">Pages / About Us</p> -->
                <h1 class="tw-text-2xl tw-font-bold">About Us</h1>
            </div>
        </div>
    </div>

    <!-- Logo Section -->
    <div class="container-fluid mb-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-4 text-center">
                <img src="{{ asset('images\business-logo\logo.png') }}" alt="FurryTails Logo" 
                     class="tw-w-48 tw-h-48 tw-rounded-full tw-shadow-lg mx-auto" 
                     data-aos="zoom-in">
            </div>
        </div>
    </div>

    <!-- 2x2 Grid Section -->
    <div class="container-fluid mb-5">
        <div class="row g-4">
            <!-- Mission -->
            <div class="col-12 col-md-6">
                <div class="tw-bg-white tw-rounded-2xl tw-p-8 tw-h-100 tw-shadow-sm hover:tw-shadow-lg tw-transition-all tw-duration-300">
                    <h2 class="tw-text-2xl tw-font-bold tw-mb-4 tw-text-[#24CFF4]">Our Mission</h2>
                    <p class="tw-text-gray-600 tw-leading-relaxed">
                        At FurryTails, our mission is simple: to provide exceptional care and comfort for your beloved pets. We believe every pet deserves to feel loved, safe, and pampered. Through our convenient online platform, we make it easy for pet owners to book professional grooming and boarding services, ensuring your furry friends are always in the best hands. Because when your pet is happy, you're happy too!
                    </p>
                </div>
            </div>

            <!-- Image 1 -->
            <div class="col-12 col-md-6">
                <div class="tw-rounded-2xl tw-overflow-hidden tw-shadow-sm hover:tw-shadow-lg tw-transition-all tw-duration-300 tw-h-100">
                    <img src="{{ asset('images/stock/about-photo1.jpg') }}" alt="Pet Grooming" 
                         class="tw-w-full tw-h-full tw-object-cover">
                </div>
            </div>

            <!-- Image 2 -->
            <div class="col-12 col-md-6">
                <div class="tw-rounded-2xl tw-overflow-hidden tw-shadow-sm hover:tw-shadow-lg tw-transition-all tw-duration-300 tw-h-100">
                    <img src="{{ asset('images/stock/about-photo2.jpg') }}" alt="Pet Shop" 
                         class="tw-w-full tw-h-full tw-object-cover">
                </div>
            </div>

            <!-- Story -->
            <div class="col-12 col-md-6">
                <div class="tw-bg-white tw-rounded-2xl tw-p-8 tw-h-100 tw-shadow-sm hover:tw-shadow-lg tw-transition-all tw-duration-300">
                    <h2 class="tw-text-2xl tw-font-bold tw-mb-4 tw-text-[#24CFF4]">Our Story</h2>
                    <p class="tw-text-gray-600 tw-leading-relaxed">
                        At FurryTails, our mission is simple: to provide exceptional care and comfort for your beloved pets. We believe every pet deserves to feel loved, safe, and pampered. Through our convenient online platform, we make it easy for pet owners to book professional grooming and boarding services, ensuring your furry friends are always in the best hands. Because when your pet is happy, you're happy too!
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Location Section -->
    <div class="container-fluid mb-5">
        <div class="row">
            <div class="col-12">
                <h2 class="tw-text-3xl tw-font-bold text-center mb-4 tw-text-[#24CFF4]">Location</h2>
                <div class="tw-rounded-2xl tw-overflow-hidden tw-border-4 tw-border-[#24CFF4]">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d989.8796021498383!2d125.5956992309869!3d7.065729099999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32f96d65ac7d3493%3A0xa54471a513d5fc70!2sUniversity%20of%20Mindanao%20-%20Matina!5e0!3m2!1sen!2sph!4v1740412211361!5m2!1sen!2sph"                     
                        class="tw-w-full tw-h-[450px]"
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- Developers Section -->
    

    <!-- Contact Section -->
    <div class="container-fluid mb-4">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="tw-text-3xl tw-font-bold mb-4 tw-text-[#24CFF4]">Contact Us</h2>
                <div class="d-flex justify-content-center gap-4 mb-3">
                    <!-- Social Media -->
                    <a href="#" class="tw-text-[#24CFF4] hover:tw-text-[#63e4fd] tw-text-2xl" title="Facebook">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="#" class="tw-text-[#24CFF4] hover:tw-text-[#63e4fd] tw-text-2xl" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="tw-text-[#24CFF4] hover:tw-text-[#63e4fd] tw-text-2xl" title="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <!-- Contact Icons -->
                    <a href="mailto:contact@furrytails.com" class="tw-text-[#24CFF4] hover:tw-text-[#63e4fd] tw-text-2xl" title="Email Us">
                        <i class="fas fa-envelope"></i>
                    </a>
                    <a href="tel:+1234567890" class="tw-text-[#24CFF4] hover:tw-text-[#63e4fd] tw-text-2xl" title="Call Us">
                        <i class="fas fa-phone"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center">
                <p class="tw-text-gray-500 tw-text-sm">© 2025 FurryTails. All rights reserved.</p>
            </div>
        </div>
    </div>
</div>

<script>
    AOS.init({
        once: true,
        duration: 1000
    });
</script>
@endsection
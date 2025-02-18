@extends('main')

@section('title', 'About Us')

@section('content')
<div class="tw-p-6 tw-bg-gradient-to-tl tw-min-h-screen tw-to-[#d8f9ff] tw-from-white">
    <div class="tw-flex tw-flex-col md:tw-flex-row tw-justify-between tw-items-center tw-mb-6" data-aos="fade-down">
        <div>
            <p class="tw-text-sm tw-text-gray-500">Pages / About Us</p>
            <h1 class="tw-text-2xl tw-font-bold">About Us</h1>
        </div>
    </div>

    <!-- Div para sa m and v-->
    <div class="tw-bg-white tw-shadow-sm tw-rounded-lg tw-p-6 tw-transition-all tw-duration-300 tw-ease-in-out hover:tw-shadow-lg" data-aos="fade-up">
        <h2 class="tw-text-xl tw-font-bold tw-mb-4">Our Mission</h2>
        <p class="tw-text-gray-700">Welcome to FurryTails! We are dedicated to providing the best care for your beloved pets. Our team of experienced professionals is passionate about ensuring your pets receive the love and attention they deserve. Whether it's grooming, boarding, or training, we are here to help. Thank you for choosing FurryTails!</p>
    
        <h2 class="tw-text-xl tw-font-bold tw-mb-4">Our Vision</h2>
        <p class="tw-text-gray-700">By establishing a strong connection with the community and their companions, we aim to reach a broader audience to enable our services to aid those that need them. We hope that you can watch over us and provide your suggestions as we strive to reach this vision!</p>
    </div>

    <!-- dev section -->
    <div class="tw-mt-6 tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-6">
        <!-- zander -->
        <div class="tw-bg-white tw-shadow-sm tw-rounded-lg tw-p-6 tw-text-center tw-transition-all tw-duration-300 tw-ease-in-out hover:tw-shadow-lg" data-aos="fade-right">
            <img src="{{ asset('images/developer_images/realzander.png') }}" alt="Developer Image" class="tw-rounded-full tw-mx-auto tw-mb-4 tw-w-32 tw-h-32 tw-object-cover">
            <h2 class="tw-text-lg tw-font-bold">Zander Duhaylungsod</h2>
            <p class="tw-text-gray-700">Test TEst</p>
        </div>

        <!-- charms -->
        <div class="tw-bg-white tw-shadow-sm tw-rounded-lg tw-p-6 tw-text-center tw-transition-all tw-duration-300 tw-ease-in-out hover:tw-shadow-lg" data-aos="fade-left">
            <img src="{{ asset('images/developer_images/realcharmelle.png') }}" alt="Developer Image" class="tw-rounded-full tw-mx-auto tw-mb-4 tw-w-32 tw-h-32 tw-object-cover">
            <h2 class="tw-text-lg tw-font-bold">Charmelle John Cahucom</h2>
            <p class="tw-text-gray-700">haha so real</p>
        </div>
    </div>
</div>

<script>
    AOS.init({
        once: true
    });
</script>
@endsection

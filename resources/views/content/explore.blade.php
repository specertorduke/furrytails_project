@extends('main')

@section('title', 'Explore')

@section('content')
<div class="container-fluid tw-min-h-screen tw-overflow-y-auto tw-bg-[#f4fbfd] tw-p-6 font-poppins">
    <div class="tw-overflow-hidden tw-rounded-3xl tw-bg-gradient-to-r tw-from-[#1cb8d8] tw-to-[#24CFF4] tw-p-6 tw-text-white tw-shadow-lg tw-mb-5">
        <div class="row g-4 tw-items-center">
            <div class="col-12 col-lg-8">
                <p class="tw-mb-2 tw-text-sm tw-uppercase tw-tracking-[0.2em] tw-text-white/80">Discover</p>
                <h1 class="tw-mb-2 tw-text-3xl tw-font-bold md:tw-text-4xl">Explore FurryTails</h1>
                <p class="tw-mb-0 tw-max-w-2xl tw-text-white/90">Jump into the areas that matter most, from services and bookings to pets and account settings.</p>
            </div>
            <div class="col-12 col-lg-4 tw-flex tw-justify-start lg:tw-justify-end tw-mt-2 lg:tw-mt-0">
                <div class="tw-rounded-2xl tw-bg-white/15 tw-p-4 tw-backdrop-blur-sm tw-w-full lg:tw-max-w-sm">
                    <p class="tw-mb-1 tw-text-xs tw-uppercase tw-tracking-wider tw-text-white/80">Quick Access</p>
                    <p class="tw-mb-0 tw-text-sm tw-text-white/90">Use the cards below to move between key pages fast.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 xl:tw-grid-cols-3 tw-gap-5">
        <a href="{{ route('content.services') }}" onclick="loadContent(event, '{{ route('content.services') }}')" class="tw-group tw-rounded-3xl tw-bg-white tw-p-6 tw-shadow-sm tw-transition-all hover:tw-shadow-xl hover:tw--translate-y-1 tw-no-underline">
            <div class="tw-flex tw-items-center tw-justify-between tw-mb-4">
                <div class="tw-rounded-2xl tw-bg-[#e0f9ff] tw-p-3">
                    <i class="fas fa-store tw-text-[#24CFF4] tw-text-xl"></i>
                </div>
                <span class="tw-text-xs tw-font-semibold tw-uppercase tw-tracking-[0.2em] tw-text-[#159cbb]">Services</span>
            </div>
            <h2 class="tw-mb-2 tw-text-xl tw-font-bold tw-text-gray-800">Browse services</h2>
            <p class="tw-mb-0 tw-text-sm tw-text-gray-600">See what is available and book the right service with a single click.</p>
        </a>

        <a href="{{ route('content.manage') }}" onclick="loadContent(event, '{{ route('content.manage') }}')" class="tw-group tw-rounded-3xl tw-bg-white tw-p-6 tw-shadow-sm tw-transition-all hover:tw-shadow-xl hover:tw--translate-y-1 tw-no-underline">
            <div class="tw-flex tw-items-center tw-justify-between tw-mb-4">
                <div class="tw-rounded-2xl tw-bg-[#eef8ff] tw-p-3">
                    <i class="fas fa-calendar-check tw-text-[#159cbb] tw-text-xl"></i>
                </div>
                <span class="tw-text-xs tw-font-semibold tw-uppercase tw-tracking-[0.2em] tw-text-[#159cbb]">Bookings</span>
            </div>
            <h2 class="tw-mb-2 tw-text-xl tw-font-bold tw-text-gray-800">Manage bookings</h2>
            <p class="tw-mb-0 tw-text-sm tw-text-gray-600">Open your appointment and boarding lists to review, edit, or add a reservation.</p>
        </a>

        <a href="{{ route('content.pets') }}" onclick="loadContent(event, '{{ route('content.pets') }}')" class="tw-group tw-rounded-3xl tw-bg-white tw-p-6 tw-shadow-sm tw-transition-all hover:tw-shadow-xl hover:tw--translate-y-1 tw-no-underline">
            <div class="tw-flex tw-items-center tw-justify-between tw-mb-4">
                <div class="tw-rounded-2xl tw-bg-[#f0fbff] tw-p-3">
                    <i class="fas fa-paw tw-text-[#20b9db] tw-text-xl"></i>
                </div>
                <span class="tw-text-xs tw-font-semibold tw-uppercase tw-tracking-[0.2em] tw-text-[#159cbb]">Pets</span>
            </div>
            <h2 class="tw-mb-2 tw-text-xl tw-font-bold tw-text-gray-800">View pet profiles</h2>
            <p class="tw-mb-0 tw-text-sm tw-text-gray-600">Jump into your pet registry and manage each profile from one place.</p>
        </a>
    </div>
</div>

@endsection

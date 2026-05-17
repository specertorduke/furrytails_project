@extends('main')

@section('title', 'Services')

@section('content')
@php
$services = $services ?? collect([]);
$categories = $services->pluck('category')->filter()->unique()->values();
@endphp

<div class="container-fluid tw-min-h-screen tw-overflow-y-auto tw-bg-[#f4fbfd] tw-p-6 font-poppins">
    <div class="tw-overflow-hidden tw-rounded-3xl tw-bg-gradient-to-r tw-from-[#1cb8d8] tw-to-[#24CFF4] tw-p-6 tw-text-white tw-shadow-lg">
        <div class="row tw-items-center">
            <div class="col-12 col-lg-8">
                <p class="tw-mb-2 tw-text-sm tw-uppercase tw-tracking-[0.2em] tw-text-white/80">FurryTails Catalog</p>
                <h1 class="tw-mb-2 tw-text-3xl tw-font-bold md:tw-text-4xl">Pick The Perfect Care For Your Pet</h1>
                <p class="tw-mb-0 tw-max-w-2xl tw-text-white/90">
                    Explore our active services with photos, clear pricing, and details so you can book with confidence.
                </p>
            </div>
            <div class="col-12 col-lg-4 tw-mt-4 lg:tw-mt-0">
                <div class="tw-rounded-2xl tw-bg-white/15 tw-p-4 tw-backdrop-blur-sm">
                    <p class="tw-mb-1 tw-text-xs tw-uppercase tw-tracking-wider tw-text-white/80">Total Active Services</p>
                    <p class="tw-mb-0 tw-text-3xl tw-font-bold">{{ $services->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="tw-mt-5 tw-rounded-2xl tw-bg-white tw-p-4 tw-shadow-md">
        <div class="tw-flex tw-flex-col tw-gap-3 md:tw-flex-row md:tw-items-center md:tw-justify-between">
            <div class="tw-flex tw-flex-wrap tw-gap-2" id="category-filters">
                <button type="button" data-category="all" class="category-filter tw-rounded-full tw-bg-[#24CFF4] tw-px-4 tw-py-2 tw-text-sm tw-font-semibold tw-text-white tw-transition-all">
                    All
                </button>
                @foreach ($categories as $category)
                <button type="button" data-category="{{ strtolower($category) }}" class="category-filter tw-rounded-full tw-bg-[#eef7fc] tw-px-4 tw-py-2 tw-text-sm tw-font-semibold tw-text-[#159cbb] tw-transition-all hover:tw-bg-[#dbf5fc]">
                    {{ $category }}
                </button>
                @endforeach
            </div>
            <div class="tw-relative tw-w-full md:tw-max-w-sm">
                <i class="fas fa-search tw-pointer-events-none tw-absolute tw-left-3 tw-top-1/2 -tw-translate-y-1/2 tw-text-gray-400"></i>
                <input id="service-search" type="text" placeholder="Search by name or description" class="tw-w-full tw-rounded-xl tw-border tw-border-gray-200 tw-bg-[#f9fcff] tw-py-2 tw-pl-10 tw-pr-4 tw-text-sm tw-text-gray-700 focus:tw-border-[#24CFF4] focus:tw-outline-none">
            </div>
        </div>
    </div>

    <div class="row tw-mt-2" id="services-grid">
        @forelse ($services as $service)
        @php
        $imagePath = $service->serviceImage ? preg_replace('/^storage\//i', '', $service->serviceImage) : null;
        $categoryLower = strtolower($service->category ?? 'uncategorized');
        @endphp
        <div class="col-12 col-md-6 col-xl-4 tw-mt-4 service-card" data-category="{{ $categoryLower }}" data-search="{{ strtolower(($service->name ?? '') . ' ' . ($service->description ?? '') . ' ' . ($service->category ?? '')) }}">
            <div class="tw-group tw-h-full tw-overflow-hidden tw-rounded-2xl tw-bg-white tw-shadow-md tw-transition-all tw-duration-300 hover:tw--translate-y-1 hover:tw-shadow-xl">
                <div class="tw-relative tw-h-52 tw-w-full tw-bg-[#eafaff]">
                    @if ($imagePath)
                    <img src="{{ asset('storage/' . $imagePath) }}" alt="{{ $service->name }}" class="tw-h-full tw-w-full tw-object-cover">
                    @else
                    <div class="tw-flex tw-h-full tw-w-full tw-items-center tw-justify-center">
                        <i class="fas fa-concierge-bell tw-text-5xl tw-text-[#24CFF4]"></i>
                    </div>
                    @endif
                    <span class="tw-absolute tw-left-3 tw-top-3 tw-rounded-full tw-bg-white/90 tw-px-3 tw-py-1 tw-text-xs tw-font-semibold tw-text-[#0b88a3]">
                        {{ $service->category ?? 'General' }}
                    </span>
                </div>
                <div class="tw-flex tw-h-[calc(100%-13rem)] tw-flex-col tw-p-5">
                    <div class="tw-mb-2 tw-flex tw-items-start tw-justify-between tw-gap-3">
                        <h3 class="tw-mb-0 tw-text-lg tw-font-bold tw-text-gray-900">{{ $service->name }}</h3>
                        <span class="tw-whitespace-nowrap tw-text-base tw-font-bold tw-text-[#159cbb]">₱{{ number_format((float) $service->price, 2) }}</span>
                    </div>
                    <p class="tw-mb-4 tw-line-clamp-3 tw-text-sm tw-leading-6 tw-text-gray-600">
                        {{ $service->description ?: 'A quality pet care service crafted by the FurryTails team.' }}
                    </p>
                    <div class="tw-mt-auto">
                        <button type="button" class="service-book-btn tw-w-full tw-rounded-xl tw-bg-[#24CFF4] tw-px-3 tw-py-2 tw-text-sm tw-font-semibold tw-text-white tw-transition-all hover:tw-bg-[#1eb9da]" data-booking-type="{{ $categoryLower === 'boarding' ? 'boarding' : 'appointment' }}" data-service-id="{{ $service->serviceID }}">
                            {{ $categoryLower === 'boarding' ? 'Book Boarding' : 'Book Appointment' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 tw-mt-4">
            <div class="tw-rounded-2xl tw-bg-white tw-p-8 tw-text-center tw-shadow-md">
                <i class="fas fa-box-open tw-mb-3 tw-text-4xl tw-text-gray-300"></i>
                <h3 class="tw-mb-2 tw-text-xl tw-font-bold tw-text-gray-800">No Active Services Yet</h3>
                <p class="tw-mb-0 tw-text-gray-500">Please check back soon. We are preparing new services for your pets.</p>
            </div>
        </div>
        @endforelse

        <div id="no-results" class="col-12 tw-mt-4 tw-hidden">
            <div class="tw-rounded-2xl tw-bg-white tw-p-8 tw-text-center tw-shadow-md">
                <i class="fas fa-search-minus tw-mb-3 tw-text-4xl tw-text-gray-300"></i>
                <h3 class="tw-mb-2 tw-text-xl tw-font-bold tw-text-gray-800">No matching records found</h3>
                <p class="tw-mb-0 tw-text-gray-500">Try adjusting your search or filters.</p>
            </div>
        </div>
    </div>
</div>

@include('modals.user.add-appointment')
@include('modals.user.add-boarding')
@include('modals.user.payment-modal')

<script>
    document.addEventListener('contentChanged', function() {
        const categoryButtons = document.querySelectorAll('.category-filter');
        const serviceCards = document.querySelectorAll('.service-card');
        const searchInput = document.getElementById('service-search');
        const bookButtons = document.querySelectorAll('.service-book-btn');

        if (!categoryButtons.length || !serviceCards.length || !searchInput) {
            return;
        }

        let activeCategory = 'all';

        const applyFilters = () => {
            const searchTerm = searchInput.value.toLowerCase().trim();

            serviceCards.forEach((card) => {
                const cardCategory = card.getAttribute('data-category') || '';
                const searchable = card.getAttribute('data-search') || '';
                const categoryMatch = activeCategory === 'all' || cardCategory === activeCategory;
                const searchMatch = !searchTerm || searchable.includes(searchTerm);

                card.classList.toggle('tw-hidden', !(categoryMatch && searchMatch));
            });

            const noResultsEl = document.getElementById('no-results');
            if (noResultsEl) {
                const anyVisible = Array.from(serviceCards).some(card => !card.classList.contains('tw-hidden'));
                if (serviceCards.length && !anyVisible) {
                    noResultsEl.classList.remove('tw-hidden');
                } else {
                    noResultsEl.classList.add('tw-hidden');
                }
            }
        };

        categoryButtons.forEach((button) => {
            button.addEventListener('click', function() {
                categoryButtons.forEach((btn) => {
                    btn.classList.remove('tw-bg-[#24CFF4]', 'tw-text-white');
                    btn.classList.add('tw-bg-[#eef7fc]', 'tw-text-[#159cbb]');
                });

                this.classList.remove('tw-bg-[#eef7fc]', 'tw-text-[#159cbb]');
                this.classList.add('tw-bg-[#24CFF4]', 'tw-text-white');
                activeCategory = this.getAttribute('data-category') || 'all';
                applyFilters();
            });
        });

        searchInput.addEventListener('input', applyFilters);

        bookButtons.forEach((button) => {
            button.addEventListener('click', function() {
                const serviceId = this.getAttribute('data-service-id');
                const bookingType = this.getAttribute('data-booking-type');

                if (!serviceId || !bookingType) {
                    return;
                }

                if (bookingType === 'boarding') {
                    document.dispatchEvent(new CustomEvent('openBoardingModalWithService', {
                        detail: {
                            serviceId: serviceId
                        }
                    }));
                } else {
                    document.dispatchEvent(new CustomEvent('openAppointmentModalWithService', {
                        detail: {
                            serviceId: serviceId
                        }
                    }));
                }
            });
        });

        applyFilters();
    });

    document.addEventListener('DOMContentLoaded', function() {
        document.dispatchEvent(new Event('contentChanged'));
    });

</script>
@endsection

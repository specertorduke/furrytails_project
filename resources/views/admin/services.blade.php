@extends('admin.adminLayout')

@section('title', 'Services Management')

@section('content')
<div class="tw-p-6 tw-min-h-screen tw-bg-gray-900">
    <!-- Header Section -->
    <div class="tw-flex tw-flex-col md:tw-flex-row tw-justify-between tw-items-start md:tw-items-center tw-mb-6">
        <div>
            <p class="tw-text-sm tw-text-gray-400">Administration / Services</p>
            <h1 class="tw-text-2xl tw-font-bold tw-text-white">Services Management</h1>
        </div>
        <div class="tw-mt-4 md:tw-mt-0">
            <button type="button" id="addServiceBtn" class="tw-bg-[#24CFF4] tw-text-white tw-px-4 tw-py-2 tw-rounded-xl tw-transition-all tw-duration-300 hover:tw-shadow-lg hover:tw-opacity-90 tw-font-semibold active:tw-bg-blue-400">
                <i class="fas fa-plus tw-mr-2"></i> Add Service
            </button>
        </div>
    </div>

    <!-- Service Stats Cards -->
    <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-3 tw-gap-6 tw-mb-6">
        <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-6 tw-border-l-4 tw-border-[#24CFF4] tw-transition-all tw-duration-300 hover:tw-shadow-md">
            <div class="tw-flex tw-justify-between tw-items-center">
                <div>
                    <p class="tw-text-gray-400 tw-text-sm">Total Services</p>
                    <h3 class="tw-text-2xl tw-font-bold tw-text-white">{{ $totalServices ?? 0 }}</h3>
                </div>
                <div class="tw-bg-gray-700 tw-p-3 tw-rounded-full">
                    <i class="fas fa-concierge-bell tw-text-[#24CFF4] tw-text-xl"></i>
                </div>
            </div>
        </div>
        <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-6 tw-border-l-4 tw-border-[#FF9666] tw-transition-all tw-duration-300 hover:tw-shadow-md">
            <div class="tw-flex tw-justify-between tw-items-center">
                <div>
                    <p class="tw-text-gray-400 tw-text-sm">Active Services</p>
                    <h3 class="tw-text-2xl tw-font-bold tw-text-white">{{ $activeServices ?? 0 }}</h3>
                </div>
                <div class="tw-bg-gray-700 tw-p-3 tw-rounded-full">
                    <i class="fas fa-check-circle tw-text-[#FF9666] tw-text-xl"></i>
                </div>
            </div>
        </div>
        <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-6 tw-border-l-4 tw-border-[#66FF8F] tw-transition-all tw-duration-300 hover:tw-shadow-md">
            <div class="tw-flex tw-justify-between tw-items-center">
                <div>
                    <p class="tw-text-gray-400 tw-text-sm">Service Categories</p>
                    <h3 class="tw-text-2xl tw-font-bold tw-text-white">{{ $serviceCategories ?? 0 }}</h3>
                </div>
                <div class="tw-bg-gray-700 tw-p-3 tw-rounded-full">
                    <i class="fas fa-tags tw-text-[#66FF8F] tw-text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Controls -->
    <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-4 tw-mb-6">
        <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-4">
            <div>
                <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-300 tw-mb-1">Search</label>
                <input type="text" id="search-service" placeholder="Search services..." class="tw-w-full tw-bg-gray-700 tw-text-white tw-border-gray-600 tw-rounded-lg tw-px-3 tw-py-2">
            </div>
            <div>
                <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-300 tw-mb-1">Category</label>
                <div class="tw-flex tw-flex-wrap tw-gap-2" id="category-filters">
                    <button class="category-filter tw-px-3 tw-py-1 tw-rounded-lg tw-text-white tw-bg-blue-600" data-category="all">All</button>
                    <button class="category-filter tw-px-3 tw-py-1 tw-rounded-lg tw-text-white tw-bg-gray-700" data-category="Grooming">Grooming</button>
                    <button class="category-filter tw-px-3 tw-py-1 tw-rounded-lg tw-text-white tw-bg-gray-700" data-category="Boarding">Boarding</button>
                    <button class="category-filter tw-px-3 tw-py-1 tw-rounded-lg tw-text-white tw-bg-gray-700" data-category="Veterinary">Veterinary</button>
                    <button class="category-filter tw-px-3 tw-py-1 tw-rounded-lg tw-text-white tw-bg-gray-700" data-category="Training">Training</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Services Grid -->
    <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-6 service-grid">
        @forelse($services ?? [] as $service)
        <div class="service-card tw-bg-gray-800 tw-rounded-xl tw-overflow-hidden tw-shadow-sm tw-transition-all tw-duration-300 hover:tw-shadow-lg" data-category="{{ $service->category }}">
            <div class="tw-relative">
                <!-- Banner image takes full width -->
                <img src="{{ asset('storage/' . $service->serviceImage) }}" 
                    alt="{{ $service->name }}" 
                    class="tw-w-full tw-h-40 tw-object-cover">
                
                <!-- Category badge -->
                <div class="tw-absolute tw-top-3 tw-right-3">
                    <span class="tw-px-3 tw-py-1 tw-rounded-full tw-text-sm tw-bg-gray-900/80 tw-backdrop-blur-sm tw-text-white">
                        {{ $service->category }}
                    </span>
                </div>
                
                <!-- Status indicator -->
                <div class="tw-absolute tw-top-3 tw-left-3">
                    @if($service->isActive)
                    <span class="tw-px-3 tw-py-1 tw-rounded-full tw-text-xs tw-bg-green-900/80 tw-backdrop-blur-sm tw-text-green-300">
                        <i class="fas fa-check-circle tw-mr-1"></i> Active
                    </span>
                    @else
                    <span class="tw-px-3 tw-py-1 tw-rounded-full tw-text-xs tw-bg-red-900/80 tw-backdrop-blur-sm tw-text-red-300">
                        <i class="fas fa-times-circle tw-mr-1"></i> Inactive
                    </span>
                    @endif
                </div>
            </div>
            
            <div class="tw-p-4">
                <div class="tw-flex tw-justify-between tw-items-start tw-mb-3">
                    <h3 class="tw-text-xl tw-font-semibold tw-text-white">{{ $service->name }}</h3>
                    <span class="tw-text-lg tw-text-[#66FF8F] tw-font-semibold">₱{{ number_format($service->price, 2) }}</span>
                </div>
                
                <div class="tw-space-y-2 tw-mb-4">
                    <!-- Description with truncation -->
                    <div class="tw-flex tw-items-start tw-gap-2">
                        <i class="fas fa-info-circle tw-text-gray-400 tw-mt-1"></i>
                        <p class="tw-text-sm tw-text-gray-400 tw-line-clamp-2">
                            {{ $service->description ?: 'No description available' }}
                        </p>
                    </div>
                </div>
                
                <div class="tw-flex tw-justify-between tw-items-center">
                    <button onclick="viewService({{ $service->serviceID }})" 
                            class="tw-text-[#24CFF4] tw-text-sm hover:tw-underline">
                        View Details
                    </button>
                    <div class="tw-flex tw-gap-2">
                        <button onclick="editService({{ $service->serviceID }})" 
                                class="tw-bg-yellow-500 tw-text-white tw-px-3 tw-py-1 tw-rounded-xl tw-transition-all tw-duration-300 hover:tw-opacity-90">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button onclick="toggleServiceStatus({{ $service->serviceID }}, {{ $service->isActive ? 'false' : 'true' }})" 
                                class="tw-bg-{{ $service->isActive ? 'red' : 'green' }}-500 tw-text-white tw-px-3 tw-py-1 tw-rounded-xl tw-transition-all tw-duration-300 hover:tw-opacity-90">
                            <i class="fas fa-{{ $service->isActive ? 'times' : 'check' }}"></i>
                        </button>
                        <button onclick="deleteService({{ $service->serviceID }})" 
                                class="tw-bg-red-600 tw-text-white tw-px-3 tw-py-1 tw-rounded-xl tw-transition-all tw-duration-300 hover:tw-opacity-90">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="tw-col-span-2">
            <div class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-bg-gray-800 tw-rounded-xl tw-p-8 tw-shadow-sm">
                <i class="fas fa-concierge-bell tw-text-5xl tw-text-gray-600 tw-mb-4"></i>
                <p class="tw-text-gray-400 tw-mb-4">No services available</p>
                <button type="button" id="noServicesAddBtn" class="tw-bg-[#24CFF4] tw-text-white tw-px-6 tw-py-2 tw-rounded-xl tw-transition-all tw-duration-300 hover:tw-shadow-lg hover:tw-opacity-90">
                    <i class="fas fa-plus tw-mr-2"></i>Add Service
                </button>
            </div>
        </div>
        @endforelse
    </div>
</div>

@push('scripts')
<script>
    window.ServicesPage = window.ServicesPage || {
        initializeServices: function() {
            console.log('Initializing services page...');
            this.setupEventListeners();
            this.setupFilters();
        },

        setupEventListeners: function() {
            document.getElementById('addServiceBtn')?.addEventListener('click', this.openAddServiceModal);
            document.getElementById('noServicesAddBtn')?.addEventListener('click', this.openAddServiceModal);
        },

        setupFilters: function() {
            const searchInput = document.getElementById('search-service');
            const categoryButtons = document.querySelectorAll('.category-filter');
            
            // Search functionality
            if (searchInput) {
                searchInput.addEventListener('input', this.filterServices);
            }
            
            // Category filtering
            categoryButtons.forEach(button => {
                button.addEventListener('click', () => {
                    categoryButtons.forEach(btn => {
                        btn.classList.remove('tw-bg-blue-600');
                        btn.classList.add('tw-bg-gray-700');
                    });
                    button.classList.remove('tw-bg-gray-700');
                    button.classList.add('tw-bg-blue-600');
                    this.filterServices();
                });
            });
        },
        
        filterServices: function() {
            const searchTerm = document.getElementById('search-service').value.toLowerCase();
            const activeCategory = document.querySelector('.category-filter.tw-bg-blue-600').dataset.category;
            const serviceCards = document.querySelectorAll('.service-card');
            
            serviceCards.forEach(card => {
                const serviceName = card.querySelector('h3').textContent.toLowerCase();
                const serviceCategory = card.dataset.category;
                
                const matchesSearch = serviceName.includes(searchTerm);
                const matchesCategory = activeCategory === 'all' || serviceCategory === activeCategory;
                
                card.style.display = matchesSearch && matchesCategory ? 'block' : 'none';
            });
        },
        
        openAddServiceModal: function() {
            console.log('Opening add service modal');
            // Implement modal functionality
        }
    };

    // Global functions for service actions
    window.editService = function(serviceId) {
        console.log('Editing service with ID:', serviceId);
        // Add your edit service logic here
    };

    window.viewService = function(serviceId) {
        console.log('Viewing service with ID:', serviceId);
        // Add your view service logic here
    };

    window.toggleServiceStatus = function(serviceId, newStatus) {
        console.log('Toggling service status:', serviceId, 'to', newStatus);
        
        Swal.fire({
            title: newStatus ? 'Activate service?' : 'Deactivate service?',
            text: newStatus 
                ? "This service will be visible to customers" 
                : "This service will be hidden from customers",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: newStatus ? '#66FF8F' : '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: newStatus ? 'Yes, activate it!' : 'Yes, deactivate it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Send status update request
                fetch(`/admin/services/${serviceId}/toggle-status`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ isActive: newStatus })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Updated!',
                            text: `Service has been ${newStatus ? 'activated' : 'deactivated'}.`,
                            icon: 'success',
                            confirmButtonColor: '#24CFF4'
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: data.message || 'Something went wrong.',
                            icon: 'error',
                            confirmButtonColor: '#24CFF4'
                        });
                    }
                });
            }
        });
    };

    window.deleteService = function(serviceId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Send delete request
                fetch(`/admin/services/${serviceId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'Service has been deleted.',
                            icon: 'success',
                            confirmButtonColor: '#24CFF4'
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: data.message || 'Something went wrong.',
                            icon: 'error',
                            confirmButtonColor: '#24CFF4'
                        });
                    }
                });
            }
        });
    };

    // Initialize when page loads directly
    document.addEventListener('DOMContentLoaded', function() {
        ServicesPage.initializeServices();
    });

    // Initialize when content is dynamically loaded
    document.addEventListener('contentChanged', function() {
        ServicesPage.initializeServices();
    });
</script>
@endpush
@endsection
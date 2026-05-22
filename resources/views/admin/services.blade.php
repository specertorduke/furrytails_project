@extends('admin.adminLayout')

@section('title', 'Services Management')

@section('content')
<style>
    /* Prevent layout shift when adding font-weight */
    .category-filter {
        position: relative;
    }
    .category-filter::after {
        content: attr(data-text);
        content: attr(data-text) / "";
        height: 0;
        visibility: hidden;
        overflow: hidden;
        user-select: none;
        pointer-events: none;
        font-weight: 600;
        display: block;
    }
</style>
<div class="tw-p-6 tw-min-h-screen tw-bg-gray-900">
    @php
        $currentCategory = $category ?? 'all';
        $currentSort = $sort ?? 'none';
    @endphp
    <!-- Header Section -->
    <div class="tw-flex tw-flex-col md:tw-flex-row tw-justify-between tw-items-start md:tw-items-center tw-mb-6">
        <div>
            <p class="tw-text-sm tw-text-gray-400">Administration / Services</p>
            <h1 class="tw-text-2xl tw-font-bold tw-text-white">Services Management</h1>
        </div>
        <div class="tw-mt-4 md:tw-mt-0">
            @if(auth()->user()->hasPermission('services.create'))
            <button type="button" id="addServiceBtn" class="tw-bg-[#27b5d4] tw-text-white tw-px-4 tw-py-2 tw-rounded-xl tw-transition-all tw-duration-300 hover:tw-shadow-lg hover:tw-opacity-90 tw-font-semibold active:tw-bg-blue-400">
                <i class="fas fa-plus tw-mr-2"></i> Add Service
            </button>
            @endif
        </div>
    </div>

    <!-- Service Stats Cards -->
    <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-3 tw-gap-6 tw-mb-6">
        <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-6 tw-border-l-4 tw-border-[#27b5d4] tw-transition-all tw-duration-300 hover:tw-shadow-md">
            <div class="tw-flex tw-justify-between tw-items-center">
                <div>
                    <p class="tw-text-gray-400 tw-text-sm">Total Services</p>
                    <h3 class="tw-text-2xl tw-font-bold tw-text-white">{{ $totalServices ?? 0 }}</h3>
                </div>
                <div class="tw-bg-gray-700 tw-p-3 tw-rounded-full">
                    <i class="fas fa-concierge-bell tw-text-[#27b5d4] tw-text-xl"></i>
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
                <input type="text" id="search-service" value="{{ $search ?? '' }}" placeholder="Search services..." class="tw-w-full tw-bg-gray-700 tw-text-white tw-border-gray-600 tw-rounded-lg tw-px-3 tw-py-2">
            </div>
            <div>
                <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-300 tw-mb-1">Category</label>
                <div class="tw-flex tw-items-center tw-gap-2">
                    <div class="tw-flex tw-flex-wrap tw-gap-2 tw-flex-1" id="category-filters">
                        <button type="button" class="category-filter {{ $currentCategory === 'all' ? 'active tw-bg-[#27b5d4] tw-font-semibold' : 'tw-bg-gray-700 hover:tw-bg-gray-600' }} tw-px-3 tw-py-1 tw-rounded-lg tw-text-white tw-transition-all tw-duration-300" data-category="all" data-text="All">All</button>
                        <button type="button" class="category-filter {{ $currentCategory === 'Grooming' ? 'active tw-bg-[#27b5d4] tw-font-semibold' : 'tw-bg-gray-700 hover:tw-bg-gray-600' }} tw-px-3 tw-py-1 tw-rounded-lg tw-text-white tw-transition-all tw-duration-300" data-category="Grooming" data-text="Grooming">Grooming</button>
                        <button type="button" class="category-filter {{ $currentCategory === 'Boarding' ? 'active tw-bg-[#27b5d4] tw-font-semibold' : 'tw-bg-gray-700 hover:tw-bg-gray-600' }} tw-px-3 tw-py-1 tw-rounded-lg tw-text-white tw-transition-all tw-duration-300" data-category="Boarding" data-text="Boarding">Boarding</button>
                        <button type="button" class="category-filter {{ $currentCategory === 'Veterinary' ? 'active tw-bg-[#27b5d4] tw-font-semibold' : 'tw-bg-gray-700 hover:tw-bg-gray-600' }} tw-px-3 tw-py-1 tw-rounded-lg tw-text-white tw-transition-all tw-duration-300" data-category="Veterinary" data-text="Veterinary">Veterinary</button>
                        <button type="button" class="category-filter {{ $currentCategory === 'Training' ? 'active tw-bg-[#27b5d4] tw-font-semibold' : 'tw-bg-gray-700 hover:tw-bg-gray-600' }} tw-px-3 tw-py-1 tw-rounded-lg tw-text-white tw-transition-all tw-duration-300" data-category="Training" data-text="Training">Training</button>
                    </div>
                    <!-- Sort Button -->
                    <button id="sort-by-date" 
                            class="tw-px-3 tw-py-1 tw-rounded-lg tw-text-white tw-text-base {{ $currentSort !== 'none' ? 'tw-bg-[#27b5d4] tw-text-black hover:tw-bg-[#1db8d9]' : 'tw-bg-gray-700 hover:tw-bg-gray-600' }} tw-transition-all tw-duration-300 tw-flex tw-items-center tw-justify-center" 
                            data-sort-order="{{ $currentSort }}"
                            title="{{ $currentSort === 'newest' ? 'Sort: Newest First' : ($currentSort === 'oldest' ? 'Sort: Oldest First' : 'Sort by date') }}">
                        <i class="fas {{ $currentSort === 'newest' ? 'fa-arrow-down-short-wide' : ($currentSort === 'oldest' ? 'fa-arrow-up-short-wide' : 'fa-sort') }}"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.adminExistingServiceNames = @json($existingServiceNames ?? []);
    </script>

    <!-- Services Grid -->
    <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-6 service-grid">
        @forelse($services ?? [] as $service)
        <div class="service-card tw-bg-gray-800 tw-rounded-xl tw-overflow-hidden tw-shadow-sm tw-transition-all tw-duration-300 hover:tw-shadow-lg" data-category="{{ $service->category }}" data-created="{{ optional($service->created_at)->timestamp ?? 0 }}" data-original-index="{{ $loop->index }}">
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
                    <span class="tw-text-lg tw-text-white tw-font-semibold">₱{{ number_format($service->price, 2) }}</span>
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
                            class="tw-text-[#27b5d4] tw-text-sm hover:tw-underline">
                        View Details
                    </button>
                    <div class="tw-flex tw-gap-2">
                        @if(auth()->user()->hasPermission('services.edit'))
                        <button onclick="editService({{ $service->serviceID }})" 
                                class="tw-bg-yellow-500 tw-text-white tw-px-3 tw-py-1 tw-rounded-xl tw-transition-all tw-duration-300 hover:tw-opacity-90">
                            <i class="fas fa-edit"></i>
                        </button>
                        @endif
                        @if(auth()->user()->hasPermission('services.toggle'))
                        <button onclick="toggleServiceStatus({{ $service->serviceID }}, {{ $service->isActive ? 'false' : 'true' }})" 
                                class="tw-bg-{{ $service->isActive ? 'red' : 'green' }}-500 tw-text-white tw-px-3 tw-py-1 tw-rounded-xl tw-transition-all tw-duration-300 hover:tw-opacity-90">
                            <i class="fas fa-{{ $service->isActive ? 'times' : 'check' }}"></i>
                        </button>
                        @endif
                        @if(auth()->user()->hasPermission('services.delete'))
                        <button onclick="deleteService({{ $service->serviceID }})" 
                                class="tw-bg-red-600 tw-text-white tw-px-3 tw-py-1 tw-rounded-xl tw-transition-all tw-duration-300 hover:tw-opacity-90">
                            <i class="fas fa-trash"></i>
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="tw-col-span-2">
            <div class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-bg-gray-800 tw-rounded-xl tw-p-8 tw-shadow-sm">
                <i class="fas fa-concierge-bell tw-text-5xl tw-text-gray-600 tw-mb-4"></i>
                <p class="tw-text-gray-400 tw-mb-4">No services available</p>
                @if(auth()->user()->hasPermission('services.create'))
                <button type="button" id="noServicesAddBtn" class="tw-bg-[#27b5d4] tw-text-white tw-px-6 tw-py-2 tw-rounded-xl tw-transition-all tw-duration-300 hover:tw-shadow-lg hover:tw-opacity-90">
                    <i class="fas fa-plus tw-mr-2"></i>Add Service
                </button>
                @endif
            </div>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($services->hasPages())
    <div class="tw-mt-6">
        {{ $services->links('pagination.dark') }}
    </div>
    @endif
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
            const addButton = document.getElementById('addServiceBtn');
            const emptyStateButton = document.getElementById('noServicesAddBtn');

            if (addButton && !addButton.dataset.bound) {
                addButton.addEventListener('click', this.openAddServiceModal.bind(this));
                addButton.dataset.bound = 'true';
            }

            if (emptyStateButton && !emptyStateButton.dataset.bound) {
                emptyStateButton.addEventListener('click', this.openAddServiceModal.bind(this));
                emptyStateButton.dataset.bound = 'true';
            }
        },

        setupFilters: function() {
            const searchInput = document.getElementById('search-service');
            const categoryButtons = document.querySelectorAll('.category-filter');
            const sortButton = document.getElementById('sort-by-date');
            
            // Search functionality
            if (searchInput && !searchInput.dataset.bound) {
                searchInput.addEventListener('input', () => {
                    clearTimeout(this.searchDebounceTimer);
                    this.searchDebounceTimer = setTimeout(() => this.filterServices(), 250);
                });
                searchInput.addEventListener('keydown', (event) => {
                    if (event.key === 'Enter') {
                        event.preventDefault();
                        this.filterServices();
                    }
                });
                searchInput.dataset.bound = 'true';
            }
            
            // Category filtering
            categoryButtons.forEach(button => {
                if (button.dataset.bound) {
                    return;
                }

                button.addEventListener('click', () => {
                    categoryButtons.forEach(btn => {
                        btn.classList.remove('tw-bg-[#27b5d4]', 'active', 'tw-font-semibold');
                        btn.classList.add('tw-bg-gray-700', 'hover:tw-bg-gray-600');
                    });
                    button.classList.remove('tw-bg-gray-700', 'hover:tw-bg-gray-600');
                    button.classList.add('tw-bg-[#27b5d4]', 'active', 'tw-font-semibold');
                    this.filterServices();
                });
                button.dataset.bound = 'true';
            });
            
            // Sort button functionality
            if (sortButton && !sortButton.dataset.bound) {
                sortButton.dataset.sortOrder = sortButton.dataset.sortOrder || 'none';
                const icon = sortButton.querySelector('i');

                sortButton.addEventListener('click', () => {
                    const currentOrder = sortButton.dataset.sortOrder;
                    const icon = sortButton.querySelector('i');
                    
                    // Toggle sort order: none -> newest -> oldest -> none
                    if (currentOrder === 'none') {
                        sortButton.dataset.sortOrder = 'newest';
                        sortButton.title = 'Sort: Newest First';
                        if (icon) {
                            icon.className = 'fas fa-arrow-down-short-wide';
                        }
                        sortButton.classList.remove('tw-bg-gray-700', 'hover:tw-bg-gray-600');
                        sortButton.classList.add('tw-bg-[#27b5d4]', 'tw-text-black', 'hover:tw-bg-[#1db8d9]');
                    } else if (currentOrder === 'newest') {
                        sortButton.dataset.sortOrder = 'oldest';
                        sortButton.title = 'Sort: Oldest First';
                        if (icon) {
                            icon.className = 'fas fa-arrow-up-short-wide';
                        }
                    } else {
                        sortButton.dataset.sortOrder = 'none';
                        sortButton.title = 'Sort by date';
                        if (icon) {
                            icon.className = 'fas fa-sort';
                        }
                        sortButton.classList.remove('tw-bg-[#27b5d4]', 'tw-text-black', 'hover:tw-bg-[#1db8d9]');
                        sortButton.classList.add('tw-bg-gray-700', 'hover:tw-bg-gray-600');
                    }
                    
                    this.filterServices();
                });
                sortButton.dataset.bound = 'true';
            }
        },
        
        filterServices: function() {
            const searchInput = document.getElementById('search-service');
            const activeCategoryButton = document.querySelector('.category-filter.active');
            const sortButton = document.getElementById('sort-by-date');
            const searchTerm = searchInput ? searchInput.value.trim() : '';
            const activeCategory = activeCategoryButton ? activeCategoryButton.dataset.category : 'all';
            const sortOrder = sortButton ? sortButton.dataset.sortOrder : 'none';
            const url = new URL(window.location.href);

            if (searchTerm) {
                url.searchParams.set('search', searchTerm);
            } else {
                url.searchParams.delete('search');
            }

            if (activeCategory && activeCategory !== 'all') {
                url.searchParams.set('category', activeCategory);
            } else {
                url.searchParams.delete('category');
            }

            if (sortOrder && sortOrder !== 'none') {
                url.searchParams.set('sort', sortOrder);
            } else {
                url.searchParams.delete('sort');
            }

            url.searchParams.delete('page');

            if (typeof window.loadContent === 'function') {
                window.loadContent({ preventDefault() {} }, url.toString());
            } else {
                window.location.href = url.toString();
            }
        },
        
        openAddServiceModal: function() {
            if (typeof window.openAddServiceModal === 'function') {
                window.openAddServiceModal();
            } else {
                console.error('openAddServiceModal is not defined');
            }
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
        
        // Directly call the modal open function
        if (typeof window.openServiceModal === 'function') {
            window.openServiceModal(serviceId);
        } else {
            console.error('openServiceModal function is not defined');
            // Fallback direct fetch if needed
            fetch(`/admin/services/${serviceId}`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show some kind of alert at least
                    Swal.fire({
                        title: data.service.name,
                        text: data.service.description || 'No description available',
                        icon: 'info',
                        confirmButtonColor: '#27b5d4',
                        background: '#374151',
                        color: '#fff'
                    });
                }
            });
        }
    };

    window.toggleServiceStatus = function(serviceId, newStatus) {
    console.log('Toggling service status:', serviceId, 'to', newStatus);
    
    Swal.fire({
        title: newStatus ? 'Activate service?' : 'Deactivate service?',
        html: `
            <div class="tw-text-left tw-mb-4">
                <p class="tw-mb-2 tw-text-white">${newStatus 
                    ? "This service will be visible to customers" 
                    : "This service will be hidden from customers"}</p>
            </div>
        `,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: newStatus ? '#10b981' : '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: newStatus ? 'Yes, activate it!' : 'Yes, deactivate it!',
        background: '#374151',
        color: '#fff'
    }).then((result) => {
        if (result.isConfirmed) {
            // Send status update request
            fetch("{{ route('admin.services.toggle-status', ['id' => ':serviceId']) }}".replace(':serviceId', serviceId), {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ 
                    isActive: newStatus
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: 'Updated!',
                        text: `Service has been ${newStatus ? 'activated' : 'deactivated'}.`,
                        icon: 'success',
                        confirmButtonColor: '#27b5d4',
                        background: '#374151',
                        color: '#fff'
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: data.message || 'Something went wrong.',
                            icon: 'error',
                            confirmButtonColor: '#27b5d4',
                            background: '#374151',
                            color: '#fff'
                        });
                    }
                });
            }
        });
    };

    window.deleteService = function(serviceId) {
        Swal.fire({
            title: 'Delete Service',
            html: `
                <div class="tw-text-left tw-mb-4">
                    <p class="tw-text-red-400 tw-font-bold tw-mb-2">⚠️ WARNING: This action cannot be undone</p>
                    <p class="tw-mb-2 tw-text-white">This will permanently delete the service and all related data.</p>
                </div>
            `,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            background: '#374151',
            color: '#fff'
        }).then((result) => {
            if (result.isConfirmed) {
                // Send delete request
                fetch("{{ route('admin.services.destroy', ['id' => ':serviceId']) }}".replace(':serviceId', serviceId), {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({})
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => {
                            throw new Error(err.message || 'Failed to delete service');
                        });
                    }

                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'Service has been deleted.',
                            icon: 'success',
                            confirmButtonColor: '#27b5d4',
                            background: '#374151',
                            color: '#fff'
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: data.message || 'Something went wrong.',
                            icon: 'error',
                            confirmButtonColor: '#27b5d4',
                            background: '#374151',
                            color: '#fff'
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        title: 'Error!',
                        text: error.message || 'Failed to delete service.',
                        icon: 'error',
                        confirmButtonColor: '#27b5d4',
                        background: '#374151',
                        color: '#fff'
                    });
                });
            }
        });
    };

    // Initialize when page loads directly
    if (!window.__servicesPageListenersBound) {
        window.__servicesPageListenersBound = true;

        document.addEventListener('DOMContentLoaded', function() {
            ServicesPage.initializeServices();
        });

        // Initialize when content is dynamically loaded
        document.addEventListener('contentChanged', function() {
            ServicesPage.initializeServices();
        });
    }
</script>
@endpush

<!-- modals -->
@include('modals.admin.admin-view-service')
@include('modals.admin.admin-add-service')
@include('modals.admin.admin-edit-service')

@endsection

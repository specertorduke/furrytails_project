@extends('admin.adminLayout')

@section('title', 'Manage Pets')

@section('content')
<div class="tw-p-6 tw-bg-gray-900 tw-min-h-screen tw-overflow-y-auto">
    <!-- Header with Title -->
    <div class="tw-flex tw-justify-between tw-items-center tw-mb-6">
        <div>
            <p class="tw-text-sm tw-text-gray-400">Administration / Pets</p>
            <h1 class="tw-text-2xl tw-font-bold tw-text-white">Manage All Pets</h1>
        </div>
        <div class="tw-flex tw-items-center tw-gap-4">
            <button type="button" data-modal-target="admin-addPet-modal"
                class="tw-bg-[#66FF8F] tw-text-black tw-px-4 tw-py-2 tw-rounded-lg tw-transition-all tw-duration-300 hover:tw-shadow-lg hover:tw-opacity-90 tw-font-semibold">
                <i class="fas fa-plus tw-mr-2"></i> Add New Pet
            </button>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="tw-bg-gray-800 tw-rounded-xl tw-p-4 tw-mb-6 tw-shadow-sm">
        <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-3 tw-gap-4">
            <div>
                <input type="text" id="searchPet" placeholder="Search pets..." 
                    class="tw-w-full tw-px-4 tw-py-2 tw-rounded-lg tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white focus:tw-border-[#24CFF4] focus:tw-ring-1 focus:tw-ring-[#24CFF4]">
            </div>
            <div>
                <select id="filterUser" class="tw-w-full tw-px-4 tw-py-2 tw-rounded-lg tw-bg-gray-700 tw-border tw-border-gray-600 tw-text-white focus:tw-border-[#24CFF4] focus:tw-ring-1 focus:tw-ring-[#24CFF4]">
                    <option value="">All Users</option>
                    @foreach($users as $user)
                        <option value="{{ $user->userID }}">{{ $user->firstName }} {{ $user->lastName }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <div class="tw-flex tw-flex-wrap tw-gap-2">
                    <button class="tw-px-3 tw-py-1 tw-rounded-lg tw-text-sm tw-font-medium tw-transition-all tw-bg-blue-500 tw-text-white species-filter active" data-species="all">All</button>
                    <button class="tw-px-3 tw-py-1 tw-rounded-lg tw-text-sm tw-font-medium tw-transition-all tw-bg-gray-700 tw-text-white species-filter" data-species="Dog">Dogs</button>
                    <button class="tw-px-3 tw-py-1 tw-rounded-lg tw-text-sm tw-font-medium tw-transition-all tw-bg-gray-700 tw-text-white species-filter" data-species="Cat">Cats</button>
                    <button class="tw-px-3 tw-py-1 tw-rounded-lg tw-text-sm tw-font-medium tw-transition-all tw-bg-gray-700 tw-text-white species-filter" data-species="Other">Others</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Row -->
    <div class="tw-grid tw-grid-cols-1 sm:tw-grid-cols-2 lg:tw-grid-cols-4 tw-gap-4 tw-mb-6">
        <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-6 tw-border-l-4 tw-border-blue-500 tw-transition-all tw-duration-300 hover:tw-shadow-md">
            <div class="tw-flex tw-justify-between tw-items-center">
                <div>
                    <p class="tw-text-gray-400 tw-text-sm">Total Pets</p>
                    <h3 class="tw-text-2xl tw-font-bold tw-text-white">{{ $stats['total_pets'] ?? 0 }}</h3>
                </div>
                <div class="tw-bg-gray-700 tw-p-3 tw-rounded-full">
                    <i class="fas fa-paw tw-text-blue-500 tw-text-xl"></i>
                </div>
            </div>
        </div>
        <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-6 tw-border-l-4 tw-border-green-500 tw-transition-all tw-duration-300 hover:tw-shadow-md">
            <div class="tw-flex tw-justify-between tw-items-center">
                <div>
                    <p class="tw-text-gray-400 tw-text-sm">Dogs</p>
                    <h3 class="tw-text-2xl tw-font-bold tw-text-white">{{ $stats['dogs'] ?? 0 }}</h3>
                </div>
                <div class="tw-bg-gray-700 tw-p-3 tw-rounded-full">
                    <i class="fas fa-dog tw-text-green-500 tw-text-xl"></i>
                </div>
            </div>
        </div>
        <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-6 tw-border-l-4 tw-border-yellow-500 tw-transition-all tw-duration-300 hover:tw-shadow-md">
            <div class="tw-flex tw-justify-between tw-items-center">
                <div>
                    <p class="tw-text-gray-400 tw-text-sm">Cats</p>
                    <h3 class="tw-text-2xl tw-font-bold tw-text-white">{{ $stats['cats'] ?? 0 }}</h3>
                </div>
                <div class="tw-bg-gray-700 tw-p-3 tw-rounded-full">
                    <i class="fas fa-cat tw-text-yellow-500 tw-text-xl"></i>
                </div>
            </div>
        </div>
        <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-6 tw-border-l-4 tw-border-purple-500 tw-transition-all tw-duration-300 hover:tw-shadow-md">
            <div class="tw-flex tw-justify-between tw-items-center">
                <div>
                    <p class="tw-text-gray-400 tw-text-sm">Other Pets</p>
                    <h3 class="tw-text-2xl tw-font-bold tw-text-white">{{ $stats['others'] ?? 0 }}</h3>
                </div>
                <div class="tw-bg-gray-700 tw-p-3 tw-rounded-full">
                    <i class="fa-solid fa-hand-holding-heart tw-text-purple-500 tw-text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Pet Cards Grid -->
    <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 lg:tw-grid-cols-3 xl:tw-grid-cols-4 tw-gap-6">
        @forelse($pets as $pet)
        <div class="pet-card" data-user="{{ $pet->userID }}" data-species="{{ $pet->species }}">
            <div class="tw-bg-gray-800 tw-rounded-xl tw-overflow-hidden tw-shadow-sm tw-transition-all tw-duration-300 hover:tw-shadow-lg hover:-tw-translate-y-1 tw-relative tw-group">
                <!-- Admin Actions -->
                <div class="tw-absolute tw-top-2 tw-right-2 tw-z-20 tw-flex tw-gap-2 tw-opacity-0 tw-invisible group-hover:tw-opacity-100 group-hover:tw-visible tw-transition-all tw-duration-300">
                    <button onclick="editPet({{ $pet->petID }})" 
                        class="tw-bg-blue-500 tw-text-white tw-rounded-full tw-w-8 tw-h-8 tw-flex tw-items-center tw-justify-center hover:tw-bg-blue-600 tw-shadow-md tw-transform hover:tw-scale-110 tw-transition-all">
                        <i class="fas fa-edit tw-text-sm"></i>
                    </button>
                    <button onclick="deletePet({{ $pet->petID }})" 
                        class="tw-bg-red-500 tw-text-white tw-rounded-full tw-w-8 tw-h-8 tw-flex tw-items-center tw-justify-center hover:tw-bg-red-600 tw-shadow-md tw-transform hover:tw-scale-110 tw-transition-all">
                        <i class="fas fa-trash-alt tw-text-sm"></i>
                    </button>
                </div>
                
                <!-- Pet Image -->
                <div class="tw-relative">
                    <img src="{{ asset('storage/' . ($pet->petImage ?? 'images/pets/default.jpg')) }}" 
                        alt="{{ $pet->name }}" 
                        class="tw-w-full tw-h-48 tw-object-cover">
                    <div class="tw-absolute tw-top-3 tw-left-3">
                        <span class="tw-px-3 tw-py-1 tw-rounded-full tw-text-sm tw-bg-white/90 tw-backdrop-blur-sm 
                            @if(trim(strtolower($pet->species)) === 'dog') tw-text-green-800
                            @elseif(trim(strtolower($pet->species)) === 'cat') tw-text-yellow-800
                            @else tw-text-blue-800 @endif">
                            {{ $pet->species }}
                        </span>
                    </div>
                </div>
                
                <!-- Pet Info -->
                <div class="tw-p-4">
                    <!-- Owner Info Badge -->
                    <div class="tw-bg-gray-700/50 tw-rounded-lg tw-px-3 tw-py-1 tw-mb-3 tw-flex tw-items-center tw-gap-2">
                        <i class="fas fa-user tw-text-blue-400 tw-text-sm"></i>
                        <span class="tw-text-xs tw-text-gray-300">{{ $pet->user->firstName }} {{ $pet->user->lastName }}</span>
                    </div>
                    
                    <div class="tw-flex tw-justify-between tw-items-start tw-mb-3">
                        <h3 class="tw-text-xl tw-font-semibold tw-text-white">{{ $pet->name }}</h3>
                        <span class="tw-bg-gray-700 tw-text-xs tw-px-2 tw-py-1 tw-rounded tw-text-gray-300">{{ $pet->breed }}</span>
                    </div>
                    
                    <div class="tw-space-y-2 tw-mb-4">
                        <!-- Age information -->
                        <div class="tw-flex tw-items-center tw-gap-2">
                            <i class="fas fa-birthday-cake tw-text-gray-500"></i>
                            <span class="tw-text-sm tw-text-gray-300">{{ $pet->age }}</span>
                        </div>
                        
                        <!-- Gender information -->
                        <div class="tw-flex tw-items-center tw-gap-2">
                            <i class="fas fa-venus-mars tw-text-gray-500"></i>
                            <span class="tw-text-sm tw-text-gray-300">{{ $pet->gender }}</span>
                        </div>
                        
                        <!-- Weight information -->
                        <div class="tw-flex tw-items-center tw-gap-2">
                            <i class="fas fa-weight tw-text-gray-500"></i>
                            <span class="tw-text-sm tw-text-gray-300">{{ number_format($pet->weight, 2) }} kg</span>
                        </div>
                        
                        <!-- Vaccination status -->
                        <div class="tw-flex tw-items-center tw-gap-2">
                            <i class="fas fa-syringe tw-text-gray-500"></i>
                            <span class="tw-text-sm">
                                @if($pet->isVaccinated)
                                    <span class="tw-text-green-500">Vaccinated</span>
                                    <!-- Only show last vaccination date if vaccinated -->
                                    <span class="tw-text-xs tw-text-gray-400">({{ \Carbon\Carbon::parse($pet->vaccinationDate)->format('M d, Y') }})</span>
                                @else
                                    <span class="tw-text-red-500">Not Vaccinated</span>
                                @endif
                            </span>
                        </div>
                    </div>
                    
                    <div class="tw-flex tw-justify-between tw-items-center">
                        <button onclick="viewPet({{ $pet->petID }})" 
                                class="tw-text-[#24CFF4] tw-text-sm hover:tw-underline">
                            View Details
                        </button>
                        <span class="tw-text-xs tw-text-gray-400">ID: #{{ $pet->petID }}</span>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="tw-col-span-full">
            <div class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-bg-gray-800 tw-rounded-xl tw-p-8 tw-shadow-sm">
                <i class="fas fa-paw tw-text-5xl tw-text-gray-600 tw-mb-4"></i>
                <p class="tw-text-gray-400 tw-mb-4">No pets found in the database</p>
                <button type="button" data-modal-target="admin-addPet-modal" data-modal-toggle="admin-addPet-modal" 
                        class="tw-bg-[#66FF8F] tw-text-black tw-px-6 tw-py-2 tw-rounded-lg tw-transition-all tw-duration-300 hover:tw-shadow-lg hover:tw-opacity-90">
                    <i class="fas fa-plus tw-mr-2"></i>Add First Pet
                </button>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($pets->hasPages())
    <div class="tw-mt-6">
        {{ $pets->links('pagination.tailwind') }}
    </div>
    @endif
</div>

<script>
    // Global delete pet function that can be called from anywhere
    window.deletePet = function(petId) {
        Swal.fire({
            title: 'Delete Pet',
            text: "Are you sure you want to delete this pet? This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6B7280',
            confirmButtonText: 'Yes, delete pet',
            background: '#374151',
            color: '#fff'
        }).then((result) => {
            if (result.isConfirmed) {
                // Get CSRF token
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                
                // Send request to delete pet
                fetch("{{ route('admin.pets.destroy', ['id' => ':petId']) }}".replace(':petId', petId), {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to delete pet');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'Pet has been deleted successfully',
                            icon: 'success',
                            confirmButtonColor: '#24CFF4',
                            background: '#374151',
                            color: '#fff'
                        }).then(() => {
                            // Close any open modals
                            const viewPetModal = document.getElementById('viewPet-modal');
                            if (viewPetModal) {
                                viewPetModal.classList.add('tw-hidden');
                            }
                            
                            // Reload page to refresh the pet list
                            location.reload();
                        });
                    } else {
                        throw new Error(data.message || 'Failed to delete pet');
                    }
                })
                .catch(error => {
                    console.error('Error deleting pet:', error);
                    Swal.fire({
                        title: 'Error!',
                        text: error.message || 'Failed to delete pet',
                        icon: 'error',
                        confirmButtonColor: '#24CFF4',
                        background: '#374151',
                        color: '#fff'
                    });
                });
            }
        });
    };

    // Initialize admin pets page
    function initializeAdminPetsPage() {
        // Search and filter functionality
        const searchPet = document.getElementById('searchPet');
        const filterUser = document.getElementById('filterUser');
        const speciesFilters = document.querySelectorAll('.species-filter');
        const petCards = document.querySelectorAll('.pet-card');

        // Search functionality
        if (searchPet) {
            searchPet.addEventListener('input', filterPets);
        }

        // User filter
        if (filterUser) {
            filterUser.addEventListener('change', filterPets);
        }

        // Species filter
        speciesFilters.forEach(button => {
            button.addEventListener('click', () => {
                speciesFilters.forEach(btn => {
                    btn.classList.remove('active');
                    btn.classList.add('tw-bg-gray-700');
                    btn.classList.remove('tw-bg-blue-500');
                });
                button.classList.add('active', 'tw-bg-blue-500');
                button.classList.remove('tw-bg-gray-700');
                filterPets();
            });
        });

        function filterPets() {
            const searchTerm = searchPet.value.toLowerCase();
            const selectedUser = filterUser.value;
            const activeSpecies = document.querySelector('.species-filter.active').dataset.species;

            petCards.forEach(card => {
                const petName = card.querySelector('h3').textContent.toLowerCase();
                const petUser = card.dataset.user;
                const petSpecies = card.dataset.species;
                
                const matchesSearch = petName.includes(searchTerm);
                const matchesUser = selectedUser === '' || petUser === selectedUser;
                const matchesSpecies = activeSpecies === 'all' || petSpecies === activeSpecies;
                
                if (matchesSearch && matchesUser && matchesSpecies) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    }

    // Edit pet function
    window.editPet = function(petId) {
        // Fetch pet details
        fetch(`/admin/pets/${petId}/edit`, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Pet data:', data.pet);
                // Populate and show edit modal
                // You'll need to create an edit pet modal
            } else {
                Swal.fire({
                    title: 'Error!',
                    text: 'Could not load pet details',
                    icon: 'error',
                    background: '#374151',
                    color: '#fff'
                });
            }
        });
    }

    // View pet details function
    window.viewPet = function(petId) {
        // Use the new openPetModal function instead of SweetAlert
    if (typeof window.openPetModal === 'function') {
        window.openPetModal(petId);
    } else {
        console.error('openPetModal function not found');
        // Fetch pet details and show in a modal
        fetch(`/admin/pets/${petId}`, {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Show pet details in a modal using SweetAlert or custom modal
                Swal.fire({
                    title: data.pet.name,
                    html: `
                        <div class="tw-text-left">
                            <p><strong>Owner:</strong> ${data.pet.user.firstName} ${data.pet.user.lastName}</p>
                            <p><strong>Species:</strong> ${data.pet.species}</p>
                            <p><strong>Breed:</strong> ${data.pet.breed}</p>
                            <p><strong>Gender:</strong> ${data.pet.gender}</p>
                            <p><strong>Age:</strong> ${data.pet.age}</p>
                            <p><strong>Weight:</strong> ${data.pet.weight} kg</p>
                            <p><strong>Vaccination:</strong> ${data.pet.isVaccinated ? 'Yes' : 'No'}</p>
                            <p><strong>Medical History:</strong> ${data.pet.medicalHistory || 'None'}</p>
                            <p><strong>Allergies:</strong> ${data.pet.allergies || 'None'}</p>
                            <p><strong>Notes:</strong> ${data.pet.notes || 'None'}</p>
                        </div>
                    `,
                    imageUrl: data.pet.petImage ? `/storage/${data.pet.petImage}` : null,
                    imageAlt: data.pet.name,
                    background: '#374151',
                    color: '#fff'
                });
            } else {
                Swal.fire({
                    title: 'Error!',
                    text: 'Could not load pet details',
                    icon: 'error',
                    background: '#374151',
                    color: '#fff'
                });
            }
        });
    }
        
    }

    // Initialize when document loads
    document.addEventListener('DOMContentLoaded', function() {
        initializeAdminPetsPage();
        
        // Initialize the pet modal functionality
        if (typeof AdminPetModal !== 'undefined') {
            AdminPetModal.init();
        }
    });

    document.addEventListener('contentChanged', function() {
        initializeAdminPetsPage();
        
        // Initialize the pet modal functionality
        if (typeof AdminPetModal !== 'undefined') {
            AdminPetModal.init();
        }
    });
</script>

<script>
    function initializeModals() {
        // First, remove any existing event listeners to prevent duplicates
        document.querySelectorAll('[data-modal-target]').forEach(button => {
            button.removeEventListener('click', handleModalOpen);
            button.addEventListener('click', handleModalOpen);
        });
        
        document.querySelectorAll('[data-modal-toggle]').forEach(button => {
            button.removeEventListener('click', handleModalToggle);
            button.addEventListener('click', handleModalToggle);
        });
        
        // Handle clicks outside modals
        document.removeEventListener('click', handleOutsideClick);
        document.addEventListener('click', handleOutsideClick);
    }

    // Separate functions for event handlers
    function handleModalOpen(e) {
        const modalId = this.getAttribute('data-modal-target');
        const modalElement = document.getElementById(modalId);
        if (modalElement) {
            modalElement.classList.remove('tw-hidden');
            console.log(`Opening modal: ${modalId}`);
        } else {
            console.error(`Modal with ID ${modalId} not found`);
        }
    }

    function handleModalToggle(e) {
        const modalId = this.getAttribute('data-modal-toggle');
        const modal = document.getElementById(modalId);
        if (modal) {
            // Only close the modal if the button is inside the modal
            // This prevents the toggle button from both opening AND closing the modal
            if (this.closest(`#${modalId}`)) {
                modal.classList.add('tw-hidden');
                console.log(`Closing modal: ${modalId}`);
            }
        }
    }

    function handleOutsideClick(e) {
        document.querySelectorAll('[id$="-modal"]').forEach(modal => {
            if (e.target === modal) {
                modal.classList.add('tw-hidden');
                console.log('Closing modal by outside click');
            }
        });
    }

    // Initialize modals on page load
    document.addEventListener('DOMContentLoaded', initializeModals);

    // Re-initialize when content changes
    document.addEventListener('contentChanged', initializeModals);
</script>

<!-- modals -->
@include('modals.admin.admin-edit-pet')
@include('modals.admin.admin-view-pet')
@include('modals.admin.admin-add-pet')
@endsection
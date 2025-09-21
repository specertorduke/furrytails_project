<!-- View User Modal -->
<div id="viewUser-modal" tabindex="-1" aria-hidden="true" class="tw-hidden tw-fixed tw-top-0 tw-left-0 tw-right-0 tw-z-50 tw-w-full tw-p-4 tw-overflow-x-hidden tw-overflow-y-auto md:tw-inset-0 tw-h-full tw-max-h-full tw-flex tw-items-center tw-justify-center tw-backdrop-blur-sm tw-bg-black/60">
    <div class="tw-relative tw-w-full tw-max-w-2xl tw-max-h-full tw-animate-modal-entry">
        <!-- Modal content -->
        <div class="tw-relative tw-bg-gray-800 tw-rounded-lg tw-shadow-sm tw-transform tw-transition-all">
            <!-- Modal header -->
            <div class="tw-flex tw-items-center tw-justify-between tw-p-4 md:tw-p-5 tw-border-b tw-rounded-t tw-border-gray-700">
                <h3 class="tw-text-lg tw-font-semibold tw-text-white">User Profile</h3>
                <button type="button" class="tw-text-gray-400 tw-bg-transparent tw-hover:tw-bg-gray-700 tw-hover:tw-text-white tw-rounded-lg tw-text-sm tw-w-8 tw-h-8 ms-auto tw-inline-flex tw-justify-center tw-items-center" data-modal-toggle="viewUser-modal">
                    <svg class="tw-w-3 tw-h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            
            <!-- Modal body -->
            <div class="tw-p-4 md:tw-p-5">
                <!-- User Info Section -->
                <div class="tw-flex tw-flex-col md:tw-flex-row tw-gap-6">
                    <!-- User Image Column -->
                    <div class="tw-flex tw-flex-col tw-items-center">
                        <div id="userImage" class="tw-h-40 tw-w-40 tw-rounded-full tw-bg-gray-700 tw-flex tw-items-center tw-justify-center tw-overflow-hidden">
                            <!-- Image will be set via JavaScript -->
                            <i class="fas fa-user tw-text-4xl tw-text-gray-500"></i>
                        </div>
                        <p id="userName" class="tw-mt-3 tw-text-lg tw-font-semibold tw-text-white"></p>
                        <span id="userRole" class="tw-px-3 tw-py-1 tw-mt-2 tw-text-xs tw-rounded-full tw-text-white"></span>
                    </div>
                    
                    <!-- User Details Column -->
                    <div class="tw-flex-1">
                        <h4 class="tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-2">Account Details</h4>
                        
                        <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-4 tw-mb-4">
                            <div>
                                <p class="tw-text-xs tw-text-gray-400">Username</p>
                                <p id="userUsername" class="tw-text-sm tw-text-white"></p>
                            </div>
                            <div>
                                <p class="tw-text-xs tw-text-gray-400">Email</p>
                                <p id="userEmail" class="tw-text-sm tw-text-white"></p>
                            </div>
                            <div>
                                <p class="tw-text-xs tw-text-gray-400">Phone</p>
                                <p id="userPhone" class="tw-text-sm tw-text-white"></p>
                            </div>
                            <div>
                                <p class="tw-text-xs tw-text-gray-400">Account Created</p>
                                <p id="userCreated" class="tw-text-sm tw-text-white"></p>
                            </div>
                        </div>
                        
                        <div class="tw-mt-6">
                            <h4 class="tw-text-sm tw-font-medium tw-text-gray-400 tw-mb-2">User Activity</h4>
                            
                            <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-3 tw-gap-4 tw-mb-4">
                                <div class="tw-bg-gray-700/50 tw-p-3 tw-rounded-lg">
                                    <div class="tw-text-xs tw-text-gray-400">Total Appointments</div>
                                    <div id="userAppointments" class="tw-text-lg tw-font-medium tw-text-white">0</div>
                                </div>
                                <div class="tw-bg-gray-700/50 tw-p-3 tw-rounded-lg">
                                    <div class="tw-text-xs tw-text-gray-400">Total Boardings</div>
                                    <div id="userBoardings" class="tw-text-lg tw-font-medium tw-text-white">0</div>
                                </div>
                                <div class="tw-bg-gray-700/50 tw-p-3 tw-rounded-lg">
                                    <div class="tw-text-xs tw-text-gray-400">Registered Pets</div>
                                    <div id="userPetsCount" class="tw-text-lg tw-font-medium tw-text-white">0</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Pets Section -->
                <div class="tw-mt-8">
                    <div class="tw-flex tw-justify-between tw-items-center tw-mb-4">
                        <h4 class="tw-text-md tw-font-medium tw-text-white">User's Pets</h4>
                    </div>
                    
                    <div id="userPetsContainer" class="tw-grid tw-grid-cols-1 sm:tw-grid-cols-2 md:tw-grid-cols-3 lg:tw-grid-cols-4 tw-gap-4">
                        <!-- Pet cards will be added here via JavaScript -->
                    </div>
                    
                    <!-- No pets message (hidden by default) -->
                    <div id="noPetsMessage" class="tw-hidden tw-text-center tw-py-10">
                        <i class="fas fa-paw tw-text-gray-600 tw-text-4xl tw-mb-3"></i>
                        <p class="tw-text-gray-400">This user has no registered pets</p>
                    </div>
                </div>
                
                <!-- Actions Section -->
                <div class="tw-flex tw-justify-between tw-mt-8 tw-pt-4 tw-border-t tw-border-gray-700">
                    <button id="editUserBtn" class="tw-text-white tw-bg-blue-600 hover:tw-bg-blue-700 tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center tw-flex tw-items-center">
                        <i class="fas fa-edit tw-mr-2"></i> Edit User
                    </button>
                    
                   <div class="tw-flex tw-gap-2">
                        <button id="deleteUserBtn" 
                                class="tw-bg-red-600 hover:tw-bg-red-700 tw-text-white tw-px-4 tw-py-2 tw-rounded-lg tw-flex tw-items-center tw-gap-2">
                            <i class="fas fa-trash"></i>
                            Delete User
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Global variable to store current user data
    let currentUserData = null;
    
    // Function to open user modal with data
    window.openUserModal = function(userId) {
        // Show loading state
        const viewUserModal = document.getElementById('viewUser-modal');
        if (!viewUserModal) {
            console.error('View user modal not found in DOM');
            return;
        }
        
        // Show modal first with loading indicator
        viewUserModal.classList.remove('tw-hidden');
        
        // Find pet container - might not exist yet if modal just loaded
        const petsContainer = document.getElementById('userPetsContainer');
        if (petsContainer) {
            petsContainer.innerHTML = `
                <div class="tw-col-span-full tw-flex tw-justify-center tw-py-6">
                    <div class="tw-animate-spin tw-rounded-full tw-h-10 tw-w-10 tw-border-t-2 tw-border-b-2 tw-border-[#24CFF4]"></div>
                </div>
            `;
        }

        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // Fetch user data
        fetch("{{ route('admin.users.show', ['id' => ':userId']) }}".replace(':userId', userId), {           
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                console.error('Server responded with status:', response.status);
                return response.json().then(err => {
                    throw new Error(err.message || 'Failed to load user data');
                });
            }

            return response.json();
            })
        .then(data => {
            if (!data.success) {
            throw new Error(data.message || 'Failed to load user data');
            }
            
            // Store current user data
            currentUserData = data.user;
            window.currentUserData = data.user;

            // Populate user information
            populateUserData(data.user);
            
            // Populate pets
            populatePets(data.pets || []);
        })
        .catch(error => {
            console.error('Error fetching user data:', error);
            Swal.fire({
                title: 'Error!',
                text: 'Failed to load user data',
                icon: 'error',
                confirmButtonColor: '#24CFF4',
                background: '#374151',
                color: '#fff'
            });

            viewUserModal.classList.add('tw-hidden');
        });
    };
    
    // Function to populate user data in the modal
    function populateUserData(user) {
        // Set text content for user details
        document.getElementById('userName').textContent = `${user.firstName} ${user.lastName}`;
        document.getElementById('userUsername').textContent = user.username || 'Not set';
        document.getElementById('userEmail').textContent = user.email || 'Not set';
        document.getElementById('userPhone').textContent = user.phone || 'Not set';
        document.getElementById('userCreated').textContent = formatDate(user.created_at);
        
        // Set role badge
        const roleBadge = document.getElementById('userRole');
        roleBadge.textContent = user.role.toUpperCase();
        
        if (user.role === 'admin') {
            roleBadge.classList.add('tw-bg-purple-600');
            roleBadge.classList.remove('tw-bg-blue-600');
        } else {
            roleBadge.classList.add('tw-bg-blue-600');
            roleBadge.classList.remove('tw-bg-purple-600');
        }
        
        // Set profile image
        const userImage = document.getElementById('userImage');
        if (user.profileImage) {
            userImage.innerHTML = `<img src="${user.profileImage}" alt="${user.firstName}" class="tw-h-full tw-w-full tw-object-cover">`;
        } else {
            userImage.innerHTML = `
                <div class="tw-h-full tw-w-full tw-flex tw-items-center tw-justify-center tw-bg-gray-700">
                    <i class="fas fa-user tw-text-4xl tw-text-gray-500"></i>
                </div>
            `;
        }
        
        // Set stats
        document.getElementById('userAppointments').textContent = user.appointmentsCount || 0;
        document.getElementById('userBoardings').textContent = user.boardingsCount || 0;
        document.getElementById('userPetsCount').textContent = user.petsCount || 0;
    }
    
    // Function to populate pets in the modal
    function populatePets(pets) {
        console.log('Raw pets data:', pets); // Debug
        
        const petsContainer = document.getElementById('userPetsContainer');
        const noPetsMessage = document.getElementById('noPetsMessage');
        
        // Clear previous content
        petsContainer.innerHTML = '';
        
        // Show no pets message if no pets
        if (!pets || pets.length === 0) {
            noPetsMessage.classList.remove('tw-hidden');
            return;
        }
        
        // Hide no pets message
        noPetsMessage.classList.add('tw-hidden');
        
        // Add pet cards
        pets.forEach(pet => {
            // Helper function to get property with various possible names
            const getPetProp = (propOptions, defaultValue) => {
                for (const prop of propOptions) {
                    if (pet[prop] !== undefined) return pet[prop];
                }
                return defaultValue;
            };
            
            // Get all possible properties using various naming conventions
            const petId = getPetProp(['petID', 'id', 'petId'], '0');
            const petName = getPetProp(['petName', 'name'], 'Unknown Pet');
            const petType = getPetProp(['petType', 'type', 'species', 'animalType'], 'Unknown');
            const petBreed = getPetProp(['petBreed', 'breed'], 'Unknown breed');
            const petImage = getPetProp(['petImage', 'image', 'photo'], null);
            
            const petCard = document.createElement('div');
            petCard.className = 'tw-bg-gray-700 tw-rounded-xl tw-overflow-hidden tw-transition-all hover:tw-shadow-md';
            
            // Default pet icon based on type
            let petIcon = '<i class="fas fa-paw tw-text-3xl tw-text-gray-500"></i>';
            const petTypeLower = petType.toLowerCase();
            
            if (petTypeLower.includes('dog')) {
                petIcon = '<i class="fas fa-dog tw-text-3xl tw-text-blue-400"></i>';
            } else if (petTypeLower.includes('cat')) {
                petIcon = '<i class="fas fa-cat tw-text-3xl tw-text-amber-400"></i>';
            }
            
            // Pet image or icon
            let petImageHtml = `
                <div class="tw-h-36 tw-w-full tw-bg-gray-800 tw-flex tw-items-center tw-justify-center">
                    ${petIcon}
                </div>
            `;
            
            if (petImage) {
                petImageHtml = `
                    <div class="tw-h-36 tw-w-full tw-bg-gray-800 tw-overflow-hidden">
                        <img src="${petImage}" alt="${petName}" class="tw-h-full tw-w-full tw-object-cover" 
                            onerror="this.onerror=null; this.parentNode.innerHTML='<div class=\\'tw-h-full tw-w-full tw-flex tw-items-center tw-justify-center tw-bg-gray-800\\'>${petIcon}</div>
                    </div>
                `;
                console.log('Adding image:', petImage);
            }
            
            // Create the inner HTML in one continuous template string without potential syntax errors
            const iconHtml = petIcon.replace(/'/g, "\\'"); // Escape any single quotes in the icon
            petCard.innerHTML = `
                ${petImageHtml}
                <div class="tw-p-3">
                    <h5 class="tw-text-white tw-font-medium tw-text-base tw-mb-1">${petName}</h5>
                    <div class="tw-flex tw-flex-col tw-gap-1">
                        <span class="tw-text-xs tw-text-gray-400 tw-mb-1">${petType}</span>
                        <div class="tw-flex tw-justify-center">
                            <span class="tw-text-xs tw-px-2 tw-py-1 tw-rounded-full tw-bg-gray-600 tw-text-gray-300 tw-text-center">
                                ${petBreed}
                            </span>
                        </div>
                    </div>
                </div>`;
            
            // Add click event to view pet details
            petCard.style.cursor = 'pointer';
            petCard.addEventListener('click', function() {
                // Close the user modal first
                document.getElementById('viewUser-modal').classList.add('tw-hidden');
                
                // Then open pet modal with the pet ID
                if (typeof window.openPetModal === 'function') {
                    window.openPetModal(petId);
                } else {
                    console.log('View details for pet:', petId);
                    Swal.fire({
                        title: 'Function Not Available',
                        text: 'Pet view functionality is not available.',
                        icon: 'info',
                        confirmButtonColor: '#24CFF4',
                        background: '#374151',
                        color: '#fff'
                    });
                }
            });
            
            petsContainer.appendChild(petCard);
        });
    }
    
    // Utility function to format date
    function formatDate(dateString) {
        if (!dateString) return 'N/A';
        
        const date = new Date(dateString);
        return date.toLocaleDateString('en-US', { 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric'
        });
    }
    
    // Close modal handler
    const modalToggle = document.querySelector('[data-modal-toggle="viewUser-modal"]');
    if (modalToggle) {
        modalToggle.addEventListener('click', function() {
            document.getElementById('viewUser-modal').classList.add('tw-hidden');
        });
    }
    
    // Edit user button handler
    const viewEditUserBtn = document.getElementById('editUserBtn');
    if (viewEditUserBtn) {
        viewEditUserBtn.addEventListener('click', function() {
            if (window.currentUserData) {
                document.getElementById('viewUser-modal').classList.add('tw-hidden');
                const id = window.currentUserData.userID || window.currentUserData.id;
                console.log('Edit user with ID:', id);
                if (typeof window.openEditUserModal === 'function') {
                    window.openEditUserModal(id);
                } else {
                    console.error('openEditUserModal function not found');
                }
            }
        }); 
    }
    
    // DELETE USER BUTTON HANDLER - Add this new section
    const deleteUserBtn = document.getElementById('deleteUserBtn');
    if (deleteUserBtn) {
        deleteUserBtn.addEventListener('click', function() {
            console.log('Delete button clicked'); // Debug log
            
            if (window.currentUserData) {
                const userId = window.currentUserData.userID || window.currentUserData.id;
                const userName = window.currentUserData.firstName + ' ' + window.currentUserData.lastName;
                
                console.log('Attempting to delete user:', userId, userName); // Debug log
                
                // Check if the function exists
                if (typeof window.deleteUser === 'function') {
                    window.deleteUser(userId, userName);
                } else if (typeof window.UsersPage?.deleteUser === 'function') {
                    window.UsersPage.deleteUser(userId, userName);
                } else {
                    console.error('No delete function available');
                    // Fallback: implement delete here directly
                    deleteUserDirectly(userId, userName);
                }
            } else {
                console.error('No current user data available');
                Swal.fire({
                    title: 'Error',
                    text: 'No user data available for deletion',
                    icon: 'error',
                    confirmButtonColor: '#24CFF4',
                    background: '#374151',
                    color: '#fff'
                });
            }
        });
    }
    
    // Fallback delete function if the main one isn't available
    function deleteUserDirectly(userId, userName) {
        console.log('Using direct delete function for:', userId, userName);
        
        Swal.fire({
            title: 'Delete User Account',
            html: `
                <div class="tw-text-left tw-mb-4">
                    <p class="tw-text-red-400 tw-font-bold tw-mb-2">⚠️ WARNING: This action cannot be undone</p>
                    <p class="tw-mb-2">You are about to permanently delete:</p>
                    <p class="tw-font-bold tw-bg-gray-100 tw-p-2 tw-rounded tw-text-gray-800">${userName || 'this user'}</p>
                    <p class="tw-mt-2 tw-text-sm">This will remove all user data, appointments, pets, and boarding records.</p>
                </div>
                <input type="password" id="delete-user-password" class="swal2-input" placeholder="Enter your admin password" style="margin: 10px 0;">
            `,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete user!',
            cancelButtonText: 'Cancel',
            preConfirm: () => {
                const password = document.getElementById('delete-user-password').value;
                if (!password) {
                    Swal.showValidationMessage('Please enter your admin password');
                    return false;
                }
                return password;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Show loading state
                Swal.fire({
                    title: 'Deleting User',
                    text: 'Please wait...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                // Get CSRF token
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                
                // Send delete request with password
                fetch(`{{ route('admin.users.destroy', ':id') }}`.replace(':id', userId), {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        admin_password: result.value
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => {
                            throw new Error(err.message || 'Failed to delete user');
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'User has been deleted successfully',
                            icon: 'success',
                            confirmButtonColor: '#24CFF4',
                            background: '#374151',
                            color: '#fff'
                        }).then(() => {
                            // Close the modal
                            document.getElementById('viewUser-modal').classList.add('tw-hidden');
                            
                            // Reload users table or page
                            if (window.UsersPage && window.UsersPage.usersTable) {
                                window.UsersPage.usersTable.ajax.reload();
                            } else {
                                location.reload();
                            }
                        });
                    } else {
                        throw new Error(data.message || 'Failed to delete user');
                    }
                })
                .catch(error => {
                    console.error('Error deleting user:', error);
                    Swal.fire({
                        title: 'Error!',
                        text: error.message || 'Failed to delete user',
                        icon: 'error',
                        confirmButtonColor: '#24CFF4',
                        background: '#374151',
                        color: '#fff'
                    });
                });
            }
        });
    }
});
</script>
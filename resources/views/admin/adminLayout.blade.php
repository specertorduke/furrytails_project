<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title','Admin Dashboard')</title>
<link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script> 
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
@vite('resources/css/admin.css')
@vite('resources/js/app.js')
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<style>
    /* Dark admin theme */
    #sidebar {
        background-color: #1a202c;
    }
    
    #sidebar .nav-link {
        color: #cbd5e0;
    }
    
    #sidebar .nav-link:hover {
        background-color: #2d3748;
    }
    
    #sidebar .nav-link.active {
        background-color: #27b5d4;
        color: #ffffff;
    }
    
    #sidebar #logo h1, #sidebar #logo p {
        color: #ffffff;
    }
    
    #sidebar .border-b {
        border-color: #4a5568;
    }
    
    #sidebar.collapsed {
        width: 64px !important;
        padding: 0.2rem !important;
    }
    
    #sidebar.collapsed .nav-link span {
        display: none;
    }
    
    #sidebar.collapsed .nav-link i {
        margin-right: 0;
    }
    
    #sidebar.collapsed .tw-flex-col {
        align-items: center;
    }
    
    #sidebar.collapsed .tw-ml-[1.4rem] {
        margin-left: 0 !important;
    }
    
    #sidebar.collapsed .tw-flex-col h1, #sidebar.collapsed .tw-flex-col p {
        display: none;
    }
    
    #sidebar.collapsed #logo {
        justify-content: center;
        margin-left: 0 !important;
        padding: 0.5rem 0;
    }

    #sidebar.collapsed #logo img {
        width: 2.5rem;
        height: 2.5rem;
    }

    #sidebar.collapsed #logo .tw-flex-col {
        display: none;
    }
    
    #main-content.collapsed {
        margin-left: 64px !important;
    }
    
    .nav-a.collapsed {
        justify-content: center;
        font-size: 1.2rem;
    }
    
    .nav-i.collapsed {
        margin: 0 !important;
    }

    @media (max-width: 768px) {
        /* Same mobile styles but with dark theme */
        #sidebar {
            transform: translateX(-100%);
            overflow-y: auto;
            max-height: 100vh;
            -webkit-overflow-scrolling: touch;
        }
        
        #sidebar.show {
            transform: translateX(0);
            width: 256px !important;
            padding: 1rem !important;
        }
        
        #sidebar.collapsed {
            width: 64px !important;
            padding: 0.2rem !important;
            transform: translateX(0);
        }
        
        #main-content {
            margin-left: 0 !important;
        }
        
        #main-content.show {
            margin-left: 256px !important;
        }
        
        #main-content.collapsed {
            margin-left: 64px !important;
        }
        
        #header {
            margin-left: 0 !important;
        }
        
        #logo.collapsed {
            margin-left: 0.3rem !important;
        }
        
        .d-md-none {
            display: block !important;
        }
        
        #sidebar.collapsed #logo {
            padding: 0.5rem 0;
            margin-left: 0 !important;
        }

        #sidebar.collapsed #logo img {
            width: 2.5rem;
            height: 2.5rem;
            margin: 0 auto;
        }

        #sidebar.collapsed #logo .tw-flex-col {
            display: none;
        }
    }

    @media (min-width: 769px) {
        .d-md-none {
            display: none !important;
        }
    }
</style>
</head>
<body class="tw-bg-gray-100 tw-font-poppins tw-h-screen">
<div class="tw-flex tw-h-screen">
    <!-- Sidebar -->
    <div id="sidebar" class="tw-w-64 tw-shadow-md tw-p-4 tw-flex tw-overflow-y-auto tw-flex-col tw-justify-between tw-fixed tw-h-screen tw-transition-all tw-duration-300 tw-ease-in-out">
        <div>
            <div class="tw-flex tw-items-center tw-justify-start tw-py-4 tw-ml-[1.4rem] tw-border-b tw-border-gray-500" id="logo">
                <img src="{{ asset('images/business-logo/logo-square.png') }}" alt="Admin Logo" class="tw-w-12 tw-h-12">
                <div class="tw-flex tw-flex-col tw-items-start tw-ml-1">
                    <h1 class="tw-text-[1.25rem] tw-leading-[1.25rem] tw-font-bold tw-m-0 tw-text-white">Admin Panel</h1>
                    <p class="tw-text-sm tw-m-0 tw-text-gray-400">FurryTails</p>
                </div>
            </div>
            <nav class="tw-mt-6" id="nav">
                <ul class="tw-space-y-4 tw-p-2">
                    <li>
                        <a class="nav-link nav-a tw-flex tw-items-center tw-px-4 tw-py-3 tw-rounded-md" href="{{ route('admin.dashboard') }}" onclick="loadContent(event, '{{ route('admin.dashboard') }}')">
                            <i class="fas fa-tachometer-alt nav-i tw-mr-2"></i> <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link nav-a tw-flex tw-items-center tw-px-4 tw-py-3 tw-rounded-md" href="{{ route('admin.users') }}" onclick="loadContent(event, '{{ route('admin.users') }}')">
                            <i class="fas fa-users nav-i tw-mr-2"></i> <span>Users</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link nav-a tw-flex tw-items-center tw-px-4 tw-py-3 tw-rounded-md" href="{{ route('admin.pets') }}" onclick="loadContent(event, '{{ route('admin.pets') }}')">
                            <i class="fas fa-paw nav-i tw-mr-2"></i> <span>Pets</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link nav-a tw-flex tw-items-center tw-px-4 tw-py-3 tw-rounded-md" href="{{ route('admin.appointments') }}" onclick="loadContent(event, '{{ route('admin.appointments') }}')">
                            <i class="fas fa-calendar-check nav-i tw-mr-2"></i> <span>Appointments</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link nav-a tw-flex tw-items-center tw-px-4 tw-py-3 tw-rounded-md" href="{{ route('admin.boardings') }}" onclick="loadContent(event, '{{ route('admin.boardings') }}')">
                            <i class="fas fa-home nav-i tw-mr-2"></i> <span>Boardings</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link nav-a tw-flex tw-items-center tw-px-4 tw-py-3 tw-rounded-md" href="{{ route('admin.services') }}" onclick="loadContent(event, '{{ route('admin.services') }}')">
                            <i class="fas fa-concierge-bell nav-i tw-mr-2"></i> <span>Services</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link nav-a tw-flex tw-items-center tw-px-4 tw-py-3 tw-rounded-md" href="{{ route('admin.payments') }}" onclick="loadContent(event, '{{ route('admin.payments') }}')">
                            <i class="fas fa-credit-card nav-i tw-mr-2"></i> <span>Payments</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link nav-a tw-flex tw-items-center tw-px-4 tw-py-3 tw-rounded-md" href="{{ route('admin.reports') }}" onclick="loadContent(event, '{{ route('admin.reports') }}')">
                            <i class="fas fa-chart-bar nav-i tw-mr-2"></i> <span>Logs</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link nav-a tw-flex tw-items-center tw-px-4 tw-py-3 tw-rounded-md" href="{{ route('admin.account') }}" onclick="loadContent(event, '{{ route('admin.account') }}')">
                            <i class="fas fa-user-cog nav-i tw-mr-2"></i> <span>Account</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="tw-px-2">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link tw-flex tw-items-center tw-w-full tw-px-4 tw-py-3 tw-rounded-md tw-text-gray-300" id="logout-button">
                    <i class="fas fa-sign-out-alt tw-mr-2"></i> <span>Logout</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div id="main-content" class="admin-section tw-flex-1 tw-h-screen tw-ml-[16rem] tw-overflow-y-auto font-poppins tw-relative">
        @include('components.loading-admin')
        <div id="header" class="tw-flex tw-justify-between tw-items-center tw-p-4 tw-bg-gray-800 tw-shadow-md d-md-none">
            <button class="tw-text-white tw-text-2xl" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            <span class="tw-text-white tw-font-bold">Admin Panel</span>
        </div>
        <div>
            @yield('content')
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
        once: true
        });
        applyCollapsedState();

        const links = document.querySelectorAll('.nav-link');
        links.forEach(link => {
            link.addEventListener('click', function(event) {
                if (link.id === 'logout-button') {
                    return; // Bypass loadContent for logout button
                }
                loadContent(event, link.getAttribute('href'));
            });
        });

        updateActiveLink(window.location.pathname);

        // Initial check
        handleResize();

        // Add event listener for window resize
        window.addEventListener('resize', handleResize);
        
        if (typeof initializeModals === 'function') {
        initializeModals();
        }
    });

    function toggleDropdown() {
        const dropdown = document.getElementById('dropdown');
        dropdown.classList.toggle('tw-hidden');
    }

    function loadContent(event, url) {
        event.preventDefault();
        
        const loadingScreen = document.getElementById('loading-screen');
        loadingScreen.classList.remove('tw-hidden');
        
        document.dispatchEvent(new Event('contentWillChange'));

        history.pushState(null, '', url);
        fetch(url)
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const content = doc.querySelector('#main-content');
                const scripts = doc.querySelectorAll('script');
                const title = doc.querySelector('title');
                
                if (content) {
                    document.getElementById('main-content').innerHTML = content.innerHTML;
                    
                    if (title) {
                        document.title = title.innerText;
                    }
                    updateActiveLink(url);
                    
                    // Execute all scripts from the loaded content
                    scripts.forEach(script => {
                        if (script.innerHTML) {
                            const newScript = document.createElement('script');
                            newScript.textContent = script.innerHTML;
                            document.body.appendChild(newScript);
                        }
                    });
                    
                    // Initialize Flowbite
                    if (typeof initFlowbite === 'function') {
                        initFlowbite();
                    }
                    
                    // Trigger content changed event
                    document.dispatchEvent(new Event('contentChanged'));
                    
                    if (window.innerWidth < 769) {
                        applyCollapsedState();
                    }
                    
                    loadingScreen.classList.add('tw-hidden');
                } else {
                    console.error('Error: #main-content not found in the fetched HTML.');
                    loadingScreen.classList.add('tw-hidden');
                }
            })
            .catch(error => {
                console.error('Error loading content:', error);
                loadingScreen.classList.add('tw-hidden');
            });
    }

        window.addEventListener('popstate', function() {
            const url = location.pathname;
            fetch(url)
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const content = doc.querySelector('#main-content');
                    if (content) {
                        document.getElementById('main-content').innerHTML = content.innerHTML;
                        updateActiveLink(url); // Update active link on popstate
                        initFlowbite();
                    } else {
                        console.error('Error: #main-content not found in the fetched HTML.');
                    }
                })
                .catch(error => console.error('Error loading content:', error));
        });

        function updateActiveLink(url) {
            const links = document.querySelectorAll('.nav-link');
            links.forEach(link => {
                link.classList.remove('active');
                const linkHref = link.getAttribute('href');
                if (linkHref && (linkHref === url || url.endsWith(new URL(linkHref, window.location.origin).pathname))) {
                    link.classList.add('active');
                }
            });
        }

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const header = document.getElementById('header');
            const mainContent = document.getElementById('main-content');
            const logo = document.getElementById('logo');
            const navLinks = document.querySelectorAll('.nav-a');
            const navIcons = document.querySelectorAll('.nav-i');

            // Get current state
            const isHidden = !sidebar.classList.contains('show') && !sidebar.classList.contains('collapsed');
            const isCollapsed = sidebar.classList.contains('collapsed');

            // Reset all classes first
            sidebar.classList.remove('show', 'collapsed');
            mainContent.classList.remove('show', 'collapsed');
            header.classList.remove('show', 'collapsed');
            logo.classList.remove('show', 'collapsed');
            navLinks.forEach(link => link.classList.remove('show', 'collapsed'));
            navIcons.forEach(icon => icon.classList.remove('show', 'collapsed'));

            if (isHidden) {
                // If hidden, show fully
                sidebar.classList.add('show');
                mainContent.classList.add('show');
                header.classList.add('show');
                logo.classList.add('show');
            } else if (!isCollapsed) {
                // If showing fully, collapse
                sidebar.classList.add('collapsed');
                mainContent.classList.add('collapsed');
                header.classList.add('collapsed');
                logo.classList.add('collapsed');
                navLinks.forEach(link => link.classList.add('collapsed'));
                navIcons.forEach(icon => icon.classList.add('collapsed'));
            }
            // If collapsed, will reset to hidden state (no classes)

            // Save the current state in localStorage
            const state = isHidden ? 'show' : (!isCollapsed ? 'collapsed' : 'hidden');
            localStorage.setItem('sidebarState', state);

            document.dispatchEvent(new Event('sidebarStateChanged'));
            updateLoadingScreenPosition();
        }

        // Update the handleResize function
        function handleResize() {
            const sidebar = document.getElementById('sidebar');
            const header = document.getElementById('header');
            const mainContent = document.getElementById('main-content');
            const logo = document.getElementById('logo');
            const navLinks = document.querySelectorAll('.nav-a');
            const navIcons = document.querySelectorAll('.nav-i');

            if (window.innerWidth >= 769) {
                // Reset mobile classes
                sidebar.classList.remove('show', 'collapsed');
                mainContent.classList.remove('show', 'collapsed');
                header.classList.remove('show', 'collapsed');
                logo.classList.remove('show', 'collapsed');
                navLinks.forEach(link => link.classList.remove('show', 'collapsed'));
                navIcons.forEach(icon => icon.classList.remove('show', 'collapsed'));
            } else {
                // Apply saved state or default to hidden
                const savedState = localStorage.getItem('sidebarState') || 'hidden';
                if (savedState === 'show') {
                    sidebar.classList.add('show');
                    mainContent.classList.add('show');
                } else if (savedState === 'collapsed') {
                    sidebar.classList.add('collapsed');
                    mainContent.classList.add('collapsed');
                    navLinks.forEach(link => link.classList.add('collapsed'));
                    navIcons.forEach(icon => icon.classList.add('collapsed'));
                }
            }
        }

        // Update the applyCollapsedState function
        function applyCollapsedState() {
            if (window.innerWidth < 769) {
                const savedState = localStorage.getItem('sidebarState') || 'hidden';
                const sidebar = document.getElementById('sidebar');
                const header = document.getElementById('header');
                const mainContent = document.getElementById('main-content');
                const logo = document.getElementById('logo');
                const navLinks = document.querySelectorAll('.nav-a');
                const navIcons = document.querySelectorAll('.nav-i');

                // Reset all classes first
                sidebar.classList.remove('show', 'collapsed');
                mainContent.classList.remove('show', 'collapsed');
                header.classList.remove('show', 'collapsed');
                logo.classList.remove('show', 'collapsed');
                navLinks.forEach(link => link.classList.remove('show', 'collapsed'));
                navIcons.forEach(icon => icon.classList.remove('show', 'collapsed'));

                if (savedState === 'show') {
                    sidebar.classList.add('show');
                    mainContent.classList.add('show');
                } else if (savedState === 'collapsed') {
                    sidebar.classList.add('collapsed');
                    mainContent.classList.add('collapsed');
                    navLinks.forEach(link => link.classList.add('collapsed'));
                    navIcons.forEach(icon => icon.classList.add('collapsed'));
                }
            }
        }
</script>
@stack('scripts')

<!-- modals -->
@include('modals.admin.admin-view-user')
@include('modals.admin.admin-add-boarding')
@include('modals.admin.admin-add-user')
@include('modals.admin.admin-add-appointment')
@include('modals.admin.admin-add-pet')
</body>
</html>
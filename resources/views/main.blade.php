<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Dashboard')</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <style>
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
            #main-content {
                margin-left: 64px !important;
            }
            #main-content.collapsed {
                margin-left: 64px !important;
            }
            #header {
                margin-left: 191px !important;
            }
            #header.collapsed {
                margin-left: 0 !important;
            }
            #logo.collapsed {
                margin-left: 0.3rem !important;
            }
            .d-md-none {
                display: block !important;
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
        <div id="sidebar" class="tw-w-64 tw-bg-white tw-shadow-md tw-p-4 tw-flex tw-flex-col tw-justify-between tw-fixed tw-h-screen tw-transition-all tw-duration-300 tw-ease-in-out">
            <div>
                <div class="tw-flex tw-items-center tw-justify-start tw-py-4 tw-ml-[1.4rem] tw-border-b tw-border-gray-200" id="logo">
                    <img src="{{ asset('images/business-logo/logo-square.png') }}" alt="Business Logo" class="tw-w-12 tw-h-12">
                    <div class="tw-flex tw-flex-col tw-items-start tw-ml-1">
                        <h1 class="tw-text-[1.25rem] tw-leading-[1.25rem] tw-font-bold tw-m-0" style="color: #24CFF4;">FurryTails</h1>
                        <p class="tw-text-sm tw-m-0" style="color: #24CFF4;">Fluff & Co</p>
                    </div>
                </div>
                <nav class="tw-mt-6" id="nav">
                    <ul class="tw-space-y-4 tw-p-2">
                        <li>
                            <a class="nav-link nav-a tw-flex tw-items-center tw-px-4 tw-py-3 tw-rounded-md tw-text-gray-500 active" href="{{ route('dashboard') }}" onclick="loadContent(event, '{{ route('dashboard') }}')">
                                <i class="fas fa-tachometer-alt nav-i tw-mr-2"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link nav-a tw-flex tw-items-center tw-px-4 tw-py-3 tw-rounded-md tw-text-gray-500" href="{{ route('content.explore') }}" onclick="loadContent(event, '{{ route('content.explore') }}')">
                                <i class="fas fa-search nav-i tw-mr-2"></i> <span>Explore</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link nav-a tw-flex tw-items-center tw-px-4 tw-py-3 tw-rounded-md tw-text-gray-500" href="{{ route('content.manage') }}" onclick="loadContent(event, '{{ route('content.manage') }}')">
                                <i class="fas fa-cogs nav-i tw-mr-2"></i> <span>Manage</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link nav-a tw-flex tw-items-center tw-px-4 tw-py-3 tw-rounded-md tw-text-gray-500" href="{{ route('content.pets') }}" onclick="loadContent(event, '{{ route('content.pets') }}')">
                                <i class="fas fa-paw nav-i tw-mr-2"></i> <span>Pets</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link nav-a tw-flex tw-items-center tw-px-4 tw-py-3 tw-rounded-md tw-text-gray-500" href="{{ route('content.history') }}" onclick="loadContent(event, '{{ route('content.history') }}')">
                                <i class="fas fa-history nav-i tw-mr-2"></i> <span>History</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link nav-a tw-flex tw-items-center tw-px-4 tw-py-3 tw-rounded-md tw-text-gray-500" href="{{ route('content.account') }}" onclick="loadContent(event, '{{ route('content.account') }}')">
                                <i class="fas fa-user nav-i tw-mr-2"></i> <span>Account</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link nav-a tw-flex tw-items-center tw-px-4 tw-py-3 tw-rounded-md tw-text-gray-500" href="{{ route('content.about') }}" onclick="loadContent(event, '{{ route('content.about') }}')">
                                <i class="fas fa-info-circle nav-i tw-mr-2"></i> <span>About Us</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="tw-px-2">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-link tw-flex tw-items-center tw-w-full tw-px-4 tw-py-3 tw-rounded-md tw-text-gray-500" id="logout-button">
                        <i class="fas fa-sign-out-alt tw-mr-2"></i> <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div id="main-content" class="tw-flex-1 tw-h-screen tw-ml-[16rem] tw-overflow-y-auto font-poppins">
            <div id="header" class="tw-flex tw-justify-between tw-items-center tw-p-4 tw-bg-white tw-shadow-md d-md-none">
                <button class="tw-text-gray-600 tw-text-2xl" onclick="toggleSidebar()">
                    <i class="fas fa-bars tw-text-blue-300"></i>
                </button>
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
            }););
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

            function handleResize() {
            const sidebar = document.getElementById('sidebar');
            const header = document.getElementById('header');
            const mainContent = document.getElementById('main-content');
            const logo = document.getElementById('logo');
            const navLinks = document.querySelectorAll('.nav-a');
            const navIcons = document.querySelectorAll('.nav-i');

                if (window.innerWidth >= 769) {
                    sidebar.classList.remove('collapsed');
                    mainContent.classList.remove('collapsed');
                    header.classList.remove('collapsed');
                    logo.classList.remove('collapsed');
                    navLinks.forEach(link => link.classList.remove('collapsed'));
                    navIcons.forEach(icon => icon.classList.remove('collapsed'));
                } else {
                    sidebar.classList.add('collapsed');
                    mainContent.classList.add('collapsed');
                    header.classList.add('collapsed');
                    logo.classList.add('collapsed');
                    navLinks.forEach(link => link.classList.add('collapsed'));
                    navIcons.forEach(icon => icon.classList.add('collapsed'));
                }
            }

            // Initial check
            handleResize();

            // Add event listener for window resize
            window.addEventListener('resize', handleResize);
        });

        function toggleDropdown() {
            const dropdown = document.getElementById('dropdown');
            dropdown.classList.toggle('tw-hidden');
        }

        function loadContent(event, url) {
            event.preventDefault();
            history.pushState(null, '', url);
            fetch(url)
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const content = doc.querySelector('#main-content');
                    const title = doc.querySelector('title');
                    if (content) {
                        document.getElementById('main-content').innerHTML = content.innerHTML;
                        document.dispatchEvent(new Event('contentChanged'));
                        if (title) {
                            document.title = title.innerText;
                        }
                        updateActiveLink(url); // Pass the URL here
                        if (window.innerWidth < 769) {
                            applyCollapsedState();
                        }
                        initFlowbite();
                    } else {
                        console.error('Error: #main-content not found in the fetched HTML.');
                    }
                })
            .catch(error => console.error('Error loading content:', error));
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
                if (link.getAttribute('href') === url) {
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

            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('collapsed');
            header.classList.toggle('collapsed');
            logo.classList.toggle('collapsed');
            navLinks.forEach(link => link.classList.toggle('collapsed'));
            navIcons.forEach(icon => icon.classList.toggle('collapsed'));

            // Save the current state in localStorage
            const collapsed = sidebar.classList.contains('collapsed');
            localStorage.setItem('sidebarCollapsed', collapsed);
        }

        function applyCollapsedState() {
            const collapsed = localStorage.getItem('sidebarCollapsed') === 'true';
            const sidebar = document.getElementById('sidebar');
            const header = document.getElementById('header');
            const mainContent = document.getElementById('main-content');
            const logo = document.getElementById('logo');
            const navLinks = document.querySelectorAll('.nav-a');
            const navIcons = document.querySelectorAll('.nav-i');
        
            if (collapsed) {
                sidebar.classList.add('collapsed');
                mainContent.classList.add('collapsed');
                header.classList.add('collapsed');
                logo.classList.add('collapsed');
                navLinks.forEach(link => link.classList.add('collapsed'));
                navIcons.forEach(icon => icon.classList.add('collapsed'));
            }
        }
    </script>
    @include('modals.add-appointment')
    @include('modals.add-boarding')
    @include('modals.add-pet')
    @include('modals.payment-modal')

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>
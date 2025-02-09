<!-- filepath: /c:/xampp/htdocs/dashboard/furrytails_project/resources/views/main.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Dashboard')</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head> 
<body class="tw-bg-gray-100 tw-font-poppins tw-h-screen">
    <div class="tw-flex tw-h-screen">
        <!-- Sidebar -->
        <div class="tw-w-64 tw-bg-white tw-shadow-md tw-p-4 tw-flex tw-flex-col tw-justify-between tw-fixed tw-h-screen">
            <div>
                <div class="tw-flex tw-items-center tw-justify-start tw-py-4 tw-ml-[1.4rem] tw-border-b tw-border-gray-200">
                    <img src="{{ asset('images/business-logo/logo-square.png') }}" alt="Business Logo" class="tw-w-12 tw-h-12">
                    <div class="tw-flex tw-flex-col tw-items-start tw-ml-1">
                        <h1 class="tw-text-[1.25rem] tw-leading-[1.25rem] tw-font-bold tw-m-0" style="color: #24CFF4;">FurryTails</h1>
                        <p class="tw-text-sm tw-m-0" style="color: #24CFF4;">Fluff & Co</p>
                    </div>
                </div>
                <nav class="tw-mt-6">
                    <ul class="tw-space-y-4 tw-p-2">
                        <li>
                            <a href="{{ route('dashboard') }}" class="nav-link tw-flex tw-items-center tw-px-4 tw-py-3 tw-rounded-md tw-text-gray-500 hover:tw-text-white active" onclick="loadContent(event, '{{ route('dashboard') }}')">
                                <i class="fas fa-tachometer-alt tw-mr-2"></i> Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('content.explore') }}" class="nav-link tw-flex tw-items-center tw-px-4 tw-py-3 tw-rounded-md tw-text-gray-500 hover:tw-text-white" onclick="loadContent(event, '{{ route('content.explore') }}')">
                                <i class="fas fa-search tw-mr-2"></i> Explore
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('content.manage') }}" class="nav-link tw-flex tw-items-center tw-px-4 tw-py-3 tw-rounded-md tw-text-gray-500 hover:tw-text-white" onclick="loadContent(event, '{{ route('content.manage') }}')">
                                <i class="fas fa-cogs tw-mr-2"></i> Manage
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('content.pets') }}" class="nav-link tw-flex tw-items-center tw-px-4 tw-py-3 tw-rounded-md tw-text-gray-500 hover:tw-text-white" onclick="loadContent(event, '{{ route('content.pets') }}')">
                                <i class="fas fa-paw tw-mr-2"></i> Pets
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('content.history') }}" class="nav-link tw-flex tw-items-center tw-px-4 tw-py-3 tw-rounded-md tw-text-gray-500 hover:tw-text-white" onclick="loadContent(event, '{{ route('content.history') }}')">
                                <i class="fas fa-history tw-mr-2"></i> History
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('content.account') }}" class="nav-link tw-flex tw-items-center tw-px-4 tw-py-3 tw-rounded-md tw-text-gray-500 hover:tw-text-white" onclick="loadContent(event, '{{ route('content.account') }}')">
                                <i class="fas fa-user tw-mr-2"></i> Account
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('content.about') }}" class="nav-link tw-flex tw-items-center tw-px-4 tw-py-3 tw-rounded-md tw-text-gray-500 hover:tw-text-white" onclick="loadContent(event, '{{ route('content.about') }}')">
                                <i class="fas fa-info-circle tw-mr-2"></i> About Us
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="tw-px-2">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-link tw-flex tw-items-center tw-w-full tw-px-4 tw-py-3 tw-rounded-md tw-text-gray-500 hover:tw-text-white" id="logout-button">
                        <i class="fas fa-sign-out-alt tw-mr-2"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="tw-flex-1 tw-h-screen tw-ml-[16rem] tw-overflow-y-auto font-poppins">
            <div id="main-content" class="">
                @yield('content')
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const links = document.querySelectorAll('.nav-link');
            links.forEach(link => {
                link.addEventListener('click', function(event) {
                    if (link.id === 'logout-button') {
                        return; // Bypass loadContent for logout button
                    }
                    loadContent(event, link.getAttribute('href'));
                });
            });
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
                        if (title) {
                            document.title = title.innerText;
                        }
                        updateActiveLink(url); // Pass the URL here
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
    </script>
</body>
</html>
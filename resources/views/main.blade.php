<!-- filepath: /c:/xampp/htdocs/dashboard/furrytails_project/resources/views/main.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FurryTails</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="tw-bg-gray-100 tw-font-poppins tw-h-full">
    <div class="tw-flex tw-h-full">
        <!-- Sidebar -->
        <div class="tw-w-64 tw-bg-white tw-shadow-md tw-p-4 tw-flex tw-flex-col tw-justify-between">
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
                            <a href="{{ route('content.dashboard') }}" class="nav-link tw-flex tw-items-center tw-px-4 tw-py-3 tw-rounded-md tw-text-gray-500 hover:tw-text-white active" onclick="loadContent(event, '{{ route('content.dashboard') }}')">
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
            <div class="tw-px-2 tw-pt-9">
                <a href="{{ route('login') }}" class="nav-link tw-flex tw-items-center tw-px-4 tw-py-3 tw-rounded-md tw-text-gray-500 hover:tw-text-white">
                    <i class="fas fa-sign-out-alt tw-mr-2"></i> Logout
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="tw-flex-1 tw-p-6 tw-overflow-y-auto tw-bg-[#e2fdfd] font-poppins" id="main-content">
            @include('content.dashboard')
        </div>
    </div>

    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('dropdown');
            dropdown.classList.toggle('tw-hidden');
        }

        function loadContent(event, url) {
            event.preventDefault();
            fetch(url)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('main-content').innerHTML = html;
                    updateActiveLink(event.target);
                })
                .catch(error => console.error('Error loading content:', error));
        }

        function updateActiveLink(target) {
            const links = document.querySelectorAll('.nav-link');
            links.forEach(link => link.classList.remove('active'));
            target.closest('.nav-link').classList.add('active');
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.tw-rounded-full')) {
                const dropdowns = document.getElementsByClassName('tw-hidden');
                for (let i = 0; i < dropdowns.length; i++) {
                    const openDropdown = dropdowns[i];
                    if (!openDropdown.classList.contains('tw-hidden')) {
                        openDropdown.classList.add('tw-hidden');
                    }
                }
            }
        }
    </script>
</body>
</html>
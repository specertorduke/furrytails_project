<!-- filepath: /c:/xampp/htdocs/dashboard/furrytails_project/resources/views/content/partials/dashboard.blade.php -->
<div class="tw-flex tw-justify-between tw-items-center tw-mb-6">
    <div>
        <p class="tw-text-sm tw-text-gray-500">Pages / Dashboard</p>
        <h1 class="tw-text-2xl tw-font-bold">Dashboard</h1>
    </div>
    <div class="tw-flex tw-items-center">
        <input type="text" placeholder="Search..." class="tw-px-4 tw-py-2 tw-border tw-rounded-md tw-shadow-sm focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-indigo-500">
        <div class="tw-relative tw-ml-4">
            <img src="{{ asset('images\icons\signIn.png') }}" alt="User Avatar" class="tw-w-10 tw-h-10 tw-rounded-full tw-cursor-pointer" onclick="toggleDropdown()">
            <div id="dropdown" class="tw-absolute tw-right-0 tw-mt-2 tw-w-48 tw-bg-white tw-rounded-md tw-shadow-lg tw-hidden">
                <a href="#" class="tw-block tw-px-4 tw-py-2 tw-text-gray-700 hover:tw-bg-gray-100">Account Settings</a>
                <a href="{{ route('logout') }}" class="tw-block tw-px-4 tw-py-2 tw-text-gray-700 hover:tw-bg-gray-100">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Buttons -->
<div class="tw-flex tw-justify-center tw-space-x-4 tw-mb-6">
    <button class="tw-bg-blue-500 tw-text-white tw-font-bold tw-py-2 tw-px-4 tw-rounded-full tw-transition-all tw-duration-300 tw-ease-in-out hover:tw-bg-blue-600">
        Add Appointment
    </button>
    <button class="tw-bg-green-500 tw-text-white tw-font-bold tw-py-2 tw-px-4 tw-rounded-full tw-transition-all tw-duration-300 tw-ease-in-out hover:tw-bg-green-600">
        Add Boarding
    </button>
    <button class="tw-bg-purple-500 tw-text-white tw-font-bold tw-py-2 tw-px-4 tw-rounded-full tw-transition-all tw-duration-300 tw-ease-in-out hover:tw-bg-purple-600">
        Add Pet
    </button>
</div>

<div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-3 tw-gap-6">
    <!-- Main Content Area -->
    <div class="md:tw-col-span-2">
        <!-- Upcoming Appointments -->
        <div class="tw-bg-white tw-shadow-sm tw-rounded-lg tw-p-6 tw-mb-6 tw-transition-all tw-duration-300 tw-ease-in-out hover:tw-shadow-lg">
            <h2 class="tw-text-xl tw-font-bold tw-mb-4">Upcoming Appointments</h2>
            <table class="tw-w-full">
                <thead>
                    <tr class="tw-border-b">
                        <th class="tw-p-2 tw-text-left">Date</th>
                        <th class="tw-p-2 tw-text-left">Time</th>
                        <th class="tw-p-2 tw-text-left">Pet</th>
                        <th class="tw-p-2 tw-text-left">Service</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="tw-border-b hover:tw-bg-gray-100">
                        <td class="tw-p-2">2025-02-15</td>
                        <td class="tw-p-2">10:00 AM</td>
                        <td class="tw-p-2">Buddy</td>
                        <td class="tw-p-2">Grooming</td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>

        <!-- Upcoming Boarding -->
        <div class="tw-bg-white tw-shadow-sm tw-rounded-lg tw-p-6 tw-transition-all tw-duration-300 tw-ease-in-out hover:tw-shadow-lg">
            <h2 class="tw-text-xl tw-font-bold tw-mb-4">Upcoming Boarding</h2>
            <table class="tw-w-full">
                <thead>
                    <tr class="tw-border-b">
                        <th class="tw-p-2 tw-text-left">Start Date</th>
                        <th class="tw-p-2 tw-text-left">End Date</th>
                        <th class="tw-p-2 tw-text-left">Pet</th>
                        <th class="tw-p-2 tw-text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="tw-border-b hover:tw-bg-gray-100">
                        <td class="tw-p-2">2025-02-20</td>
                        <td class="tw-p-2">2025-02-25</td>
                        <td class="tw-p-2">Buddy</td>
                        <td class="tw-p-2">Confirmed</td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Registered Pets Sidebar -->
    <div class="md:tw-col-span-1">
        <div class="tw-bg-white tw-shadow-sm tw-rounded-lg tw-p-6 tw-transition-all tw-duration-300 tw-ease-in-out hover:tw-shadow-lg">
            <h2 class="tw-text-xl tw-font-bold tw-mb-4">Registered Pets</h2>
            <table class="tw-w-full">
                <thead>
                    <tr class="tw-border-b">
                        <th class="tw-p-2 tw-text-left">Name</th>
                        <th class="tw-p-2 tw-text-left">Type</th>
                        <th class="tw-p-2 tw-text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="tw-border-b hover:tw-bg-gray-100">
                        <td class="tw-p-2">Buddy</td>
                        <td class="tw-p-2">Dog</td>
                        <td class="tw-p-2">Approved</td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
    </div>
</div>
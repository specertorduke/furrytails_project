<!-- filepath: /c:/xampp/htdocs/dashboard/furrytails_project/resources/views/content/partials/dashboard.blade.php -->
<div class="tw-flex tw-justify-between tw-items-center tw-mb-6">
    <div>
        <p class="tw-text-sm tw-text-gray-500">Pages / Dashboard</p>
        <h1 class="tw-text-2xl tw-font-bold">Dashboard</h1>
    </div>
    <div class="tw-flex tw-items-center tw-py-3 tw-px-4 tw-bg-white tw-rounded-[2rem] tw-shadow-md">
        <div class="tw-flex tw-items-center tw-bg-blue-50 tw-rounded-[2rem] tw-shadow-sm">
            <i class="fa fa-search tw-ml-4 tw-text-gray-500"></i>
            <input type="text" placeholder="Search..." class="tw-px-4 tw-py-2 tw-bg-blue-50 tw-rounded-[2rem] focus:tw-outline-none">
        </div>
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
<div class="tw-flex tw-justify-center tw-gap-4 tw-space-x-4 tw-mb-6">
    <button class="tw-flex tw-items-center tw-rounded-2xl tw-shadow-md tw-px-4 tw-py-4 tw-space-x-3 button-hover">
        <div class="tw-flex tw-justify-center tw-items-center tw-w-12 tw-h-12 tw-bg-blue-50 tw-p-2 tw-rounded-full">
            <i class="fa-solid fa-calendar tw-text-[1.2rem] tw-text-[#24CFF4]"></i>
        </div>
        <span class="text-blue-900 tw-font-bold">Add Appointment</span>
    </button>

    <button class="tw-flex tw-items-center tw-rounded-2xl tw-shadow-md tw-px-4 tw-py-4 tw-space-x-3 button-hover">
        <div class="tw-flex tw-justify-center tw-items-center tw-w-12 tw-h-12 tw-bg-blue-50 tw-p-2 tw-rounded-full">
            <i class="fa-solid fa-bookmark tw-text-[1.2rem] tw-text-[#24CFF4]"></i>
        </div>
        <span class="text-blue-900 tw-font-bold">Add Boarding</span>
    </button>

    <button class="tw-flex tw-items-center tw-rounded-2xl tw-shadow-md tw-px-4 tw-py-4 tw-space-x-3 button-hover">
        <div class="tw-flex tw-justify-center tw-items-center tw-w-12 tw-h-12 tw-bg-blue-50 tw-p-2 tw-rounded-full">
            <i class="fa-solid fa-paw tw-text-[1.2rem] tw-text-[#24CFF4]"></i>
        </div>
        <span class="text-blue-900 tw-font-bold">Add Pet</span>
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
                    <tr class="tw-border-b hover:tw-bg-gray-100">
                        <td class="tw-p-2">2025-02-20</td>
                        <td class="tw-p-2">2025-02-25</td>
                        <td class="tw-p-2">Buddy</td>
                        <td class="tw-p-2">Confirmed</td>
                    </tr>
                    <tr class="tw-border-b hover:tw-bg-gray-100">
                        <td class="tw-p-2">2025-02-20</td>
                        <td class="tw-p-2">2025-02-25</td>
                        <td class="tw-p-2">Buddy</td>
                        <td class="tw-p-2">Confirmed</td>
                    </tr>
                    <tr class="tw-border-b hover:tw-bg-gray-100">
                        <td class="tw-p-2">2025-02-20</td>
                        <td class="tw-p-2">2025-02-25</td>
                        <td class="tw-p-2">Buddy</td>
                        <td class="tw-p-2">Confirmed</td>
                    </tr>
                    <tr class="tw-border-b hover:tw-bg-gray-100">
                        <td class="tw-p-2">2025-02-20</td>
                        <td class="tw-p-2">2025-02-25</td>
                        <td class="tw-p-2">Buddy</td>
                        <td class="tw-p-2">Confirmed</td>
                    </tr>
                    <tr class="tw-border-b hover:tw-bg-gray-100">
                        <td class="tw-p-2">2025-02-20</td>
                        <td class="tw-p-2">2025-02-25</td>
                        <td class="tw-p-2">Buddy</td>
                        <td class="tw-p-2">Confirmed</td>
                    </tr>
                    <tr class="tw-border-b hover:tw-bg-gray-100">
                        <td class="tw-p-2">2025-02-20</td>
                        <td class="tw-p-2">2025-02-25</td>
                        <td class="tw-p-2">Buddy</td>
                        <td class="tw-p-2">Confirmed</td>
                    </tr>
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
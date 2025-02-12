@extends('main')

@section('title', 'Dashboard')

@section('content')
<div class="tw-flex tw-flex-col tw-h-screen tw-p-6 tw-overflow-y-auto tw-bg-gradient-to-tl tw-to-[#d8f9ff]  tw-from-white font-poppins" id="main-content">
    <div class="tw-flex tw-justify-between tw-items-center tw-mb-6">
        <div>
            <p class="tw-text-sm tw-text-gray-500">Pages / Dashboard</p>
            <h1 class="tw-text-2xl tw-font-bold">Dashboard</h1>
        </div>
        <div class="tw-flex tw-items-center tw-py-[0.60rem] tw-px-4 tw-bg-white tw-rounded-[2rem] tw-shadow-md">
            <div class="tw-flex tw-items-center tw-bg-blue-50 tw-rounded-[2rem] tw-shadow-sm tw-transition-all tw-duration-300 hover:tw-bg-white hover:tw-shadow-lg">
                <i class="fa fa-search tw-ml-4 tw-text-gray-500"></i>
                <input type="text" placeholder="Search..." class="tw-px-4 tw-py-2 tw-outline-none tw-bg-blue-50 tw-rounded-[2rem] tw-transition-all tw-duration-300 hover:tw-bg-white focus:tw-outline-none">
            </div>
            <div class="tw-relative tw-ml-4">
                <img src="{{ asset('storage/' . Auth::user()->userImage) }}" alt="User Avatar" class="tw-w-10 tw-h-10 tw-rounded-full tw-cursor-pointer tw-transition-all tw-duration-300 hover:tw-brightness-75" onclick="toggleDropdown()">
                <div id="dropdown" class="tw-absolute tw-right-0 tw-mt-2 tw-w-48 tw-bg-white tw-rounded-md tw-shadow-lg tw-hidden">
                    <a href="{{ route('content.account') }}" class="tw-block tw-no-underline tw-px-4 tw-py-2 tw-text-gray-700 tw-transition-all tw-duration-300 tw-ease-in-out hover:tw-bg-gray-100" onclick="loadContent(event, '{{ route('content.account') }}')">Account Settings</a>
                    <form class="tw-m-0" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="tw-block tw-text-left tw-no-underline tw-w-full tw-px-4 tw-py-2 tw-text-gray-700 tw-transition-all tw-duration-300 tw-ease-in-out hover:tw-bg-gray-100" id="logout-button">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Buttons -->
    <div class="tw-flex tw-justify-center tw-gap-4 tw-space-x-4 tw-mb-6">
        <button class="tw-flex tw-items-center tw-rounded-2xl tw-shadow-md tw-px-4 tw-py-4 tw-space-x-3 tw-group button-hover">
            <div class="tw-flex tw-justify-center tw-items-center tw-w-12 tw-h-12 tw-bg-blue-50 tw-p-2 tw-rounded-full group-hover:tw-bg-white">
                <i class="fa-solid fa-calendar tw-text-[1.2rem] tw-text-[#24CFF4]"></i>
            </div>
            <span class="text-blue-900 tw-font-bold">Add Appointment</span>
        </button>

        <button class="tw-flex tw-items-center tw-rounded-2xl tw-shadow-md tw-px-4 tw-py-4 tw-space-x-3 tw-group button-hover">
            <div class="tw-flex tw-justify-center tw-items-center tw-w-12 tw-h-12 tw-bg-blue-50 tw-p-2 tw-rounded-full group-hover:tw-bg-white">
                <i class="fa-solid fa-bookmark tw-text-[1.2rem] tw-text-[#24CFF4]"></i>
            </div>
            <span class="text-blue-900 tw-font-bold">Add Boarding</span>
        </button>

        <button class="tw-flex tw-items-center tw-rounded-2xl tw-shadow-md tw-px-4 tw-py-4 tw-space-x-3 tw-group button-hover">
            <div class="tw-flex tw-justify-center tw-items-center tw-w-12 tw-h-12 tw-bg-blue-50 tw-p-2 tw-rounded-full group-hover:tw-bg-white">
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
                <div class="tw-flex tw-justify-between tw-items-center tw-mb-4">
                    <h2 class="tw-text-xl tw-font-bold">Upcoming Appointments</h2>
                    <a href="{{ route('content.manage') }}" class="tw-bg-[#F4F7FE] tw-text-[#159cbb] tw-px-4 tw-py-1 tw-rounded-full tw-transition-all tw-no-underline tw-duration-300 tw-ease-in-out hover:tw-bg-[#24CFF4] hover:tw-text-white" onclick="loadContent(event, '{{ route('content.manage') }}')">Edit</a>
                </div>
                <table class="tw-w-full">
                    <thead>
                        <tr class="tw-border-b">
                            <th class="tw-p-2 tw-text-left tw-cursor-pointer" onclick="sortTable('appointments', 0)">ID <i class="fa fa-sort tw-text-gray-200 tw-ml-1 hover:tw-text-gray-400"></i></th>
                            <th class="tw-p-2 tw-text-left tw-cursor-pointer" onclick="sortTable('appointments', 1)">Date <i class="fa fa-sort tw-text-gray-200 tw-ml-1 hover:tw-text-gray-400"></i></th>
                            <th class="tw-p-2 tw-text-left tw-cursor-pointer" onclick="sortTable('appointments', 2)">Time <i class="fa fa-sort tw-text-gray-200 tw-ml-1 hover:tw-text-gray-400"></i></th>
                            <th class="tw-p-2 tw-text-left tw-cursor-pointer" onclick="sortTable('appointments', 3)">Pet <i class="fa fa-sort tw-text-gray-200 tw-ml-1 hover:tw-text-gray-400"></i></th>
                            <th class="tw-p-2 tw-text-left tw-cursor-pointer" onclick="sortTable('appointments', 4)">Service <i class="fa fa-sort tw-text-gray-200 tw-ml-1 hover:tw-text-gray-400"></i></th>
                            <th class="tw-p-2 tw-text-left tw-cursor-pointer" onclick="sortTable('appointments', 5)">Status <i class="fa fa-sort tw-text-gray-200 tw-ml-1 hover:tw-text-gray-400"></i></th>
                        </tr>
                    </thead>
                    <tbody id="appointments">
                        @foreach ($appointments as $appointment)
                            <tr class="tw-border-b hover:tw-bg-gray-100" onmouseover="showDownloadIcon(this)" onmouseout="hideDownloadIcon(this)">
                                <td class="tw-p-2">{{ $appointment->appointmentID }}</td>
                                <td class="tw-p-2">{{ $appointment->date }}</td>
                                <td class="tw-p-2">{{ $appointment->time }}</td>
                                <td class="tw-p-2">{{ $appointment->pet->name }}</td>
                                <td class="tw-p-2">{{ $appointment->service->name }}</td>
                                <td class="tw-p-2">{{ $appointment->status }}</td>
                                <td class="tw-p-2 tw-relative tw-cursor-pointer tw-flex tw-justify-center tw-text-gray-500 hover:tw-text-gray-700 tw-mt-3 tw-mr-3 tw-items-center"><i class="fa fa-download tw-absolute tw-hidden download-icon"></i></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Upcoming Boarding Reservations -->
            <div class="tw-bg-white tw-shadow-sm tw-rounded-lg tw-p-6 tw-transition-all tw-duration-300 tw-ease-in-out hover:tw-shadow-lg">
                <div class="tw-flex tw-justify-between tw-items-center tw-mb-4">
                    <h2 class="tw-text-xl tw-font-bold">Upcoming Boarding Reservations</h2>
                    <a href="{{ route('content.manage') }}" class="tw-bg-[#F4F7FE] tw-text-[#159cbb] tw-px-4 tw-py-1 tw-rounded-full tw-transition-all tw-no-underline tw-duration-300 tw-ease-in-out hover:tw-bg-[#24CFF4] hover:tw-text-white" onclick="loadContent(event, '{{ route('content.manage') }}')">Edit</a>
                </div>
                <table class="tw-w-full">
                    <thead>
                        <tr class="tw-border-b">
                            <th class="tw-p-2 tw-text-left tw-cursor-pointer" onclick="sortTable('boardingReservations', 0)">ID <i class="fa fa-sort tw-text-gray-200 tw-ml-1 hover:tw-text-gray-400"></i></th>
                            <th class="tw-p-2 tw-text-left tw-cursor-pointer" onclick="sortTable('boardingReservations', 1)">Start Date <i class="fa fa-sort tw-text-gray-200 tw-ml-1 hover:tw-text-gray-400"></i></th>
                            <th class="tw-p-2 tw-text-left tw-cursor-pointer" onclick="sortTable('boardingReservations', 2)">End Date <i class="fa fa-sort tw-text-gray-200 tw-ml-1 hover:tw-text-gray-400"></i></th>
                            <th class="tw-p-2 tw-text-left tw-cursor-pointer" onclick="sortTable('boardingReservations', 3)">Pet <i class="fa fa-sort tw-text-gray-200 tw-ml-1 hover:tw-text-gray-400"></i></th>
                            <th class="tw-p-2 tw-text-left tw-cursor-pointer" onclick="sortTable('boardingReservations', 4)">Status <i class="fa fa-sort tw-text-gray-200 tw-ml-1 hover:tw-text-gray-400"></i></th>
                        </tr>
                    </thead>
                    <tbody id="boardingReservations">
                        @foreach ($boardingReservations as $reservation)
                            <tr class="tw-border-b hover:tw-bg-gray-100" onmouseover="showDownloadIcon(this)" onmouseout="hideDownloadIcon(this)">
                                <td class="tw-p-2">{{ $reservation->reservationID }}</td>
                                <td class="tw-p-2">{{ $reservation->startDate }}</td>
                                <td class="tw-p-2">{{ $reservation->endDate }}</td>
                                <td class="tw-p-2">{{ $reservation->pet->name }}</td>
                                <td class="tw-p-2">{{ $reservation->status }}</td>
                                <td class="tw-p-2 tw-relative tw-cursor-pointer or- tw-flex tw-justify-center tw-text-gray-500 hover:tw-text-gray-700 tw-mt-3 tw-mr-3 tw-items-center"><i class="fa fa-download tw-absolute tw-hidden download-icon"></i></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Registered Pets Sidebar -->
        <div class="md:tw-col-span-1">
            <div class="tw-bg-white tw-shadow-sm tw-rounded-lg tw-p-6 tw-transition-all tw-duration-300 tw-ease-in-out hover:tw-shadow-lg">
                <div class="tw-flex tw-justify-between tw-items-center tw-mb-4">
                    <h2 class="tw-text-xl tw-font-bold">Registered Pets</h2>
                    <a href="{{ route('content.pets') }}" class="tw-bg-[#F4F7FE] tw-text-[#159cbb] tw-px-4 tw-py-1 tw-rounded-full tw-transition-all tw-no-underline tw-duration-300 tw-ease-in-out hover:tw-bg-[#24CFF4] hover:tw-text-white" onclick="loadContent(event, '{{ route('content.pets') }}')">See All</a>
                </div>
                <table class="tw-w-full">
                    <thead>
                        <tr class="tw-border-b">
                            <th class="tw-p-2 tw-text-left cursor-pointer" onclick="sortTable('pets', 0)"></th>
                            <th class="tw-p-2 tw-text-left cursor-pointer" onclick="sortTable('pets', 1)">Name <i class="fa fa-sort tw-text-gray-200 tw-ml-1 hover:tw-text-gray-400"></i></th>
                            <th class="tw-p-2 tw-text-left cursor-pointer" onclick="sortTable('pets', 2)">Species <i class="fa fa-sort tw-text-gray-200 tw-ml-1 hover:tw-text-gray-400"></i></th>
                        </tr>
                    </thead>
                    <tbody id="pets">
                        @foreach ($pets as $pet)
                            <tr class="tw-border-b hover:tw-bg-gray-100">
                                <td class="tw-p-2">
                                    <img src="{{ asset('storage/' . $pet->petImage) }}" alt="{{ $pet->name }}" class="tw-w-10 tw-h-10 tw-rounded-full">
                                </td>
                                <td class="tw-p-2">{{ $pet->name }}</td>
                                <td class="tw-p-2">{{ $pet->species }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    //doesn't work
    // Track sort state for each table's columns
    const tableStates = {
        'appointments': { currentColumn: null, sortOrder: 'asc' },
        'boardingReservations': { currentColumn: null, sortOrder: 'asc' },
        'pets': { currentColumn: null, sortOrder: 'asc' }
    };

    function sortTable(tableId, columnIndex) {
        // Get the table element
        const table = document.getElementById(tableId);
        if (!table) return;

        // Get current state or initialize
        const state = tableStates[tableId];

        // Update sort order
        if (state.currentColumn === columnIndex) {
            state.sortOrder = state.sortOrder === 'asc' ? 'desc' : 'asc';
        } else {
            state.currentColumn = columnIndex;
            state.sortOrder = 'asc';
        }

        // Update sort icons - looking in the thead for icons
        const thead = table.querySelector('thead');
        if (!thead) return;

        const headers = thead.getElementsByTagName('th');
        for (let i = 0; i < headers.length; i++) {
            const icon = headers[i].querySelector('i');
            if (icon) {
                if (i === columnIndex) {
                    icon.className = state.sortOrder === 'asc' 
                        ? 'fa fa-sort-asc tw-text-gray-200 tw-ml-1 hover:tw-text-gray-400'
                        : 'fa fa-sort-desc tw-text-gray-200 tw-ml-1 hover:tw-text-gray-400';
                } else {
                    icon.className = 'fa fa-sort tw-text-gray-200 tw-ml-1 hover:tw-text-gray-400';
                }
            }
        }
    }

    function showDownloadIcon(row) {
        const downloadIcon = row.getElementsByClassName('download-icon')[0];
        if (downloadIcon) {
            downloadIcon.classList.remove('tw-hidden');
        }
    }

    function hideDownloadIcon(row) {
        const downloadIcon = row.getElementsByClassName('download-icon')[0];
        if (downloadIcon) {
            downloadIcon.classList.add('tw-hidden');
        }
    }
</script>

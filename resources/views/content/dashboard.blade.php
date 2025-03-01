@extends('main')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid tw-min-h-screen tw-p-6 tw-overflow-y-auto tw-bg-gradient-to-tl tw-to-[#b7f4ff] tw-from-white font-poppins">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12 col-md-6">
            <p class="tw-text-sm tw-text-gray-500">Pages / Dashboard</p>
            <h1 class="tw-text-2xl tw-font-bold">Dashboard</h1>
        </div>
        <div class="col-12 col-md-6 d-flex justify-content-md-end tw-justify-end align-items-center mt-3 mt-md-0">
            <div class="tw-flex tw-items-center tw-justify-end tw-bg-white tw-py-1 tw-px-4 tw-rounded-full tw-shadow-md tw-gap-4 tw-transition-all tw-duration-300 tw-ease-in-out hover:tw-shadow-lg">
                <!-- Add user's first name -->
                <span class="tw-text-gray-700 tw-font-medium">{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</span>
                <!-- Profile dropdown -->
                <div class="tw-relative">
                    <img src="{{ asset('storage/' . Auth::user()->userImage) }}" alt="User Avatar" class="tw-w-10 tw-h-10 tw-rounded-full tw-cursor-pointer tw-transition-all tw-duration-300 hover:tw-brightness-75 tw-object-cover" onclick="toggleDropdown()">
                    <div id="dropdown" class="tw-absolute tw-rounded-3xl tw-z-20 tw-right-0 tw-mt-2 tw-w-48 tw-bg-white tw-rounded-md tw-shadow-lg tw-hidden">
                        <a href="{{ route('content.account') }}" class="tw-block tw-no-underline tw-px-4 tw-py-2 tw-text-gray-700 tw-transition-all tw-duration-300 tw-ease-in-out hover:tw-bg-gray-100" onclick="loadContent(event, '{{ route('content.account') }}')">Account Settings</a>
                        <form class="tw-m-0" method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="tw-block tw-text-left tw-no-underline tw-w-full tw-px-4 tw-py-2 tw-text-gray-700 tw-transition-all tw-duration-300 tw-ease-in-out hover:tw-bg-gray-100" id="logout-button">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="tw-bg-white tw-rounded-2xl tw-p-6 tw-shadow-sm tw-transition-all tw-duration-300 hover:tw-shadow-lg">
                <h2 class="tw-text-2xl tw-font-bold tw-mb-2">Welcome back, {{ Auth::user()->firstName }}! 👋</h2>
                <p class="tw-text-gray-600">Here's what's happening with your pets today</p>
                
                <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-3 tw-gap-4 tw-mt-4">
                    <!-- Upcoming Appointments Card -->
                    <div class="tw-bg-[#FFF4F0] tw-rounded-xl tw-p-4 tw-flex tw-items-center tw-gap-4">
                        <div class="tw-bg-[#FF9666] tw-rounded-full tw-p-3">
                            <i class="fas fa-calendar tw-text-white tw-text-xl"></i>
                        </div>
                        <div>
                            <p class="tw-text-sm tw-text-gray-600">Upcoming Appointments</p>
                            <h3 class="tw-text-xl tw-font-bold">{{ count($appointments) }}</h3>
                        </div>
                    </div>
                    
                    <!-- Active Boardings Card -->
                    <div class="tw-bg-[#F0FFF4] tw-rounded-xl tw-p-4 tw-flex tw-items-center tw-gap-4">
                        <div class="tw-bg-[#66FF8F] tw-rounded-full tw-p-3">
                            <i class="fas fa-home tw-text-white tw-text-xl"></i>
                        </div>
                        <div>
                            <p class="tw-text-sm tw-text-gray-600">Active Boardings</p>
                            <h3 class="tw-text-xl tw-font-bold">{{ count($boardingReservations) }}</h3>
                        </div>
                    </div>

                    <!-- Total Pets Card -->
                    <div class="tw-bg-[#F0FBFF] tw-rounded-xl tw-p-4 tw-flex tw-items-center tw-gap-4">
                        <div class="tw-bg-[#24CFF4] tw-rounded-full tw-p-3">
                            <i class="fas fa-paw tw-text-white tw-text-xl"></i>
                        </div>
                        <div>
                            <p class="tw-text-sm tw-text-gray-600">Total Pets</p>
                            <h3 class="tw-text-xl tw-font-bold">{{ count($pets) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Buttons Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <button type="button" data-modal-target="addAppointment-modal" data-modal-toggle="addAppointment-modal" 
                    class="tw-flex tw-items-center tw-rounded-2xl tw-shadow-sm tw-px-6 tw-py-4 tw-space-x-3 tw-group tw-transition-all tw-duration-300 hover:tw-shadow-lg hover:tw-scale-105 tw-bg-gradient-to-r tw-from-[#e09dff] tw-to-[#45E3FF]">
                    <div class="tw-flex tw-justify-center tw-items-center tw-w-12 tw-h-12 tw-bg-white/30 tw-backdrop-blur-sm tw-p-2 tw-rounded-full group-hover:tw-bg-white/40">
                        <i class="fa-solid fa-calendar tw-text-[1.2rem] tw-text-white"></i>
                    </div>
                    <span class="tw-text-white tw-font-bold">Add Appointment</span>
                </button>
                <button type="button" data-modal-target="addBoarding-modal" data-modal-toggle="addBoarding-modal" class="tw-flex tw-items-center tw-rounded-2xl tw-shadow-sm tw-px-6 tw-py-4 tw-space-x-3 tw-group tw-transition-all tw-duration-300 hover:tw-shadow-lg hover:tw-scale-105 tw-bg-gradient-to-r tw-from-[#1be6ba] tw-to-[#45E3FF]">               
                    <div class="tw-flex tw-justify-center tw-items-center tw-w-12 tw-h-12 tw-bg-white/30 tw-backdrop-blur-sm tw-p-2 tw-rounded-full group-hover:tw-bg-white/40">
                        <i class="fa-solid fa-bookmark tw-text-[1.2rem] tw-text-white"></i>
                    </div>
                    <span class="tw-text-white tw-font-bold">Add Boarding</span>
                </button>
                <button type="button" data-modal-target="addPet-modal" data-modal-toggle="addPet-modal" class="tw-flex tw-items-center tw-rounded-2xl tw-shadow-sm tw-px-6 tw-py-4 tw-space-x-3 tw-group tw-transition-all tw-duration-300 hover:tw-shadow-lg hover:tw-scale-105 tw-bg-gradient-to-r tw-from-[#24a8f4] tw-to-[#45E3FF]">
                    <div class="tw-flex tw-justify-center tw-items-center tw-w-12 tw-h-12 tw-bg-white/30 tw-backdrop-blur-sm tw-p-2 tw-rounded-full group-hover:tw-bg-white/40">
                        <i class="fa-solid fa-paw tw-text-[1.2rem] tw-text-white"></i>
                    </div>
                    <span class="tw-text-white tw-font-bold">Add Pet</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="row">
        <!-- Left Column -->
        <div class="col-12 col-lg-8 mb-4">
            <!-- Upcoming Appointments -->
            <div class="tw-bg-white tw-shadow-sm tw-rounded-2xl tw-p-6 mb-4 tw-transition-all tw-duration-300 tw-ease-in-out hover:tw-shadow-lg">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="tw-text-xl tw-font-bold mb-0">Upcoming Appointments</h2>
                    <a href="{{ route('content.manage') }}" class="tw-bg-[#F4F7FE] tw-text-[#159cbb] tw-px-4 tw-py-1 tw-rounded-full tw-transition-all tw-no-underline tw-duration-300 tw-ease-in-out hover:tw-bg-[#24CFF4] hover:tw-text-white" onclick="loadContent(event, '{{ route('content.manage') }}')">Edit</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
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
                            @forelse ($appointments as $appointment)
                                <tr class="tw-border-b hover:tw-bg-gray-100" onmouseover="showDownloadIcon(this)" onmouseout="hideDownloadIcon(this)">
                                    <td class="tw-p-2">{{ $appointment->appointmentID }}</td>
                                    <td class="tw-p-2">{{ $appointment->date }}</td>
                                    <td class="tw-p-2">{{ $appointment->time }}</td>
                                    <td class="tw-p-2">{{ $appointment->pet->name }}</td>
                                    <td class="tw-p-2">{{ $appointment->service->name }}</td>
                                    <td class="tw-p-2">
                                        <span class="tw-px-3 tw-py-1 tw-rounded-full tw-text-sm 
                                            @if($appointment->status === 'Confirmed') 
                                                tw-bg-green-100 tw-text-green-800
                                            @elseif($appointment->status === 'Pending')
                                                tw-bg-yellow-100 tw-text-yellow-800
                                            @else
                                                tw-bg-red-100 tw-text-red-800
                                            @endif">
                                            {{ $appointment->status }}
                                        </span>
                                    </td>
                                    <td class="tw-p-2 tw-relative tw-cursor-pointer tw-border-b-0 tw-text-gray-500 hover:tw-text-gray-700 tw-items-center"><i class="fa fa-download tw-absolute tw-hidden download-icon tw-top-1/2 tw-left-1/2 tw--translate-x-1/2 tw--translate-y-1/2"></i></td>
                                </tr>

                                @empty
                                <tr>
                                    <td colspan="7" class="tw-text-center tw-py-8">
                                        <div class="tw-flex tw-flex-col tw-items-center tw-gap-2">
                                            <i class="fas fa-calendar-times tw-text-4xl tw-text-gray-300"></i>
                                            <p class="tw-text-gray-500">No upcoming appointments</p>
                                            <button data-modal-target="addAppointment-modal" data-modal-toggle="addAppointment-modal" 
                                                class="tw-text-[#24CFF4] tw-text-sm hover:tw-underline">Schedule one now</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Upcoming Boarding Reservations -->
            <div class="tw-bg-white tw-shadow-sm tw-rounded-2xl tw-p-6 tw-transition-all tw-duration-300 tw-ease-in-out hover:tw-shadow-lg">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="tw-text-xl tw-font-bold mb-0">Current Boarding Reservations</h2>
                    <a href="{{ route('content.manage') }}" class="tw-bg-[#F4F7FE] tw-text-[#159cbb] tw-px-4 tw-py-1 tw-rounded-full tw-transition-all tw-no-underline tw-duration-300 tw-ease-in-out hover:tw-bg-[#24CFF4] hover:tw-text-white" onclick="loadContent(event, '{{ route('content.manage') }}')">Edit</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
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
                            @forelse ($boardingReservations as $reservation)
                                <tr class="tw-border-b hover:tw-bg-gray-100" onmouseover="showDownloadIcon(this)" onmouseout="hideDownloadIcon(this)">
                                    <td class="tw-p-2">{{ $reservation->boardingID }}</td>
                                    <td class="tw-p-2">{{ $reservation->start_date }}</td>
                                    <td class="tw-p-2">{{ $reservation->end_date }}</td>
                                    <td class="tw-p-2">{{ $reservation->pet->name }}</td>
                                    <td class="tw-p-2">
                                        <span class="tw-px-3 tw-py-1 tw-rounded-full tw-text-sm 
                                            @if($appointment->status === 'Confirmed') 
                                                tw-bg-green-100 tw-text-green-800
                                            @elseif($appointment->status === 'Pending')
                                                tw-bg-yellow-100 tw-text-yellow-800
                                            @else
                                                tw-bg-red-100 tw-text-red-800
                                            @endif">
                                            {{ $appointment->status }}
                                        </span>
                                    </td>
                                    <td class="tw-p-2 tw-relative tw-border-b-0 tw-cursor-pointer tw-text-gray-500 hover:tw-text-gray-700 tw-items-center"><i class="fa fa-download tw-absolute tw-hidden download-icon tw-top-1/2 tw-left-1/2 tw--translate-x-1/2 tw--translate-y-1/2"></i></td>
                                </tr>

                                @empty
                                <tr>
                                    <td colspan="7" class="tw-text-center tw-py-8">
                                        <div class="tw-flex tw-flex-col tw-items-center tw-gap-2">
                                            <i class="fas fa-calendar-times tw-text-4xl tw-text-gray-300"></i>
                                            <p class="tw-text-gray-500">No boarding reservations</p>
                                            <button data-modal-target="addBoarding-modal" data-modal-toggle="addBoarding-modal" 
                                                class="tw-text-[#24CFF4] tw-text-sm hover:tw-underline">Schedule one now</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Timeline Section -->
            <div class="tw-bg-white tw-shadow-sm tw-rounded-2xl tw-p-6 tw-mt-4 tw-transition-all tw-duration-300 tw-ease-in-out hover:tw-shadow-lg">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="tw-text-xl tw-font-bold mb-0">Weekly Events Timeline</h2>
                </div>

                <!-- Timeline Container -->
                <div class="tw-flex tw-flex-col tw-items-center">
                    <!-- Circular Progress Container -->
                    <div class="tw-relative tw-w-[280px] tw-h-[280px] tw-mb-4">
                        <!-- SVG Progress Ring -->
                        <svg class="tw-w-full tw-h-full tw-rotate-[-90deg]" viewBox="0 0 100 100">
                            <circle 
                                class="tw-fill-none tw-stroke-gray-100" 
                                cx="50" cy="50" r="45" 
                                stroke-width="10"
                            />
                            <circle 
                                class="tw-fill-none tw-stroke-[#24CFF4] tw-transition-all tw-duration-1000"
                                cx="50" cy="50" r="45" 
                                stroke-width="10"
                                stroke-dasharray="283"
                                stroke-dashoffset="{{ 283 - (283 * (\Carbon\Carbon::now()->dayOfWeek + 1) / 7) }}"
                                stroke-linecap="round"
                            />
                        </svg>

                        <!-- Center Content -->
                        <div class="tw-absolute tw-inset-0 tw-flex tw-flex-col tw-items-center tw-justify-center">
                            <div class="tw-text-center">
                                <h3 class="tw-text-3xl tw-font-bold tw-bg-gradient-to-r tw-from-[#24CFF4] tw-to-[#45E3FF] tw-text-transparent tw-bg-clip-text">
                                    {{ \Carbon\Carbon::now()->setTimezone('Asia/Manila')->format('D') }}
                                </h3>
                                <p class="tw-text-sm tw-text-gray-500">{{ \Carbon\Carbon::now()->setTimezone('Asia/Manila')->format('M d') }}</p>
                            </div>
                        </div>

                        <!-- Event Markers -->
                        @php
                            $nextWeek = \Carbon\Carbon::now()->setTimezone('Asia/Manila')->addDays(7);
                            $currentWeekEvents = $appointments->merge($boardingReservations)
                                ->filter(function($event) use ($nextWeek) {
                                    $eventDate = isset($event->date) 
                                        ? \Carbon\Carbon::parse($event->date)
                                        : \Carbon\Carbon::parse($event->start_date);
                                    return $eventDate->lte($nextWeek);
                                })
                                ->sortBy(function($event) {
                                    return isset($event->date) 
                                        ? $event->date 
                                        : $event->start_date;
                                })
                                ->take(7);
                        @endphp

                        @foreach($currentWeekEvents as $index => $event)
                            @php
                                $eventDate = isset($event->date) 
                                    ? \Carbon\Carbon::parse($event->date)
                                    : \Carbon\Carbon::parse($event->start_date);
                                $angle = ($eventDate->dayOfWeek * (360 / 7)) - 90;
                                $radians = $angle * (pi() / 180);
                                $x = 140 + cos($radians) * 120;
                                $y = 140 + sin($radians) * 120;
                                $isToday = $eventDate->isToday();
                            @endphp
                            <div class="tw-absolute tw-w-12 tw-h-12 tw-rounded-full tw-bg-white tw-shadow-md tw-flex tw-flex-col tw-items-center tw-justify-center tw-transition-all hover:tw-scale-110 hover:tw-shadow-lg {{ $isToday ? 'tw-ring-2 tw-ring-[#24CFF4]' : '' }}"
                                style="left: {{ $x - 24 }}px; top: {{ $y - 24 }}px">
                                <i class="fas {{ isset($event->appointmentID) ? 'fa-calendar' : 'fa-home' }} 
                                        {{ isset($event->appointmentID) ? 'tw-text-[#FF9666]' : 'tw-text-[#66FF8F]' }}"></i>
                                <span class="tw-text-[10px] tw-mt-1">{{ $eventDate->format('D') }}</span>
                            </div>
                        @endforeach
                    </div>

                    <!-- Legend -->
                    <div class="tw-flex tw-flex-wrap tw-justify-center tw-gap-6 tw-mt-2">
                        <div class="tw-flex tw-items-center tw-gap-2">
                            <div class="tw-w-3 tw-h-3 tw-rounded-full tw-bg-[#FF9666]"></div>
                            <span class="tw-text-sm tw-text-gray-600">Appointments</span>
                        </div>
                        <div class="tw-flex tw-items-center tw-gap-2">
                            <div class="tw-w-3 tw-h-3 tw-rounded-full tw-bg-[#66FF8F]"></div>
                            <span class="tw-text-sm tw-text-gray-600">Boardings</span>
                        </div>
                    </div>

                    <!-- Summary -->
                    <div class="tw-flex tw-justify-between tw-w-full tw-mt-4 tw-px-4">
                        <div class="tw-text-center">
                            <p class="tw-text-2xl tw-font-bold tw-text-[#FF9666]">{{ count($appointments) }}</p>
                            <p class="tw-text-sm tw-text-gray-500">Appointments</p>
                        </div>
                        <div class="tw-text-center">
                            <p class="tw-text-2xl tw-font-bold tw-text-[#66FF8F]">{{ count($boardingReservations) }}</p>
                            <p class="tw-text-sm tw-text-gray-500">Boardings</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Registered Pets Sidebar -->
        <div class="col-12 col-lg-4">
            <div class="tw-bg-white tw-shadow-sm tw-rounded-2xl tw-p-6 tw-transition-all tw-duration-300 tw-ease-in-out hover:tw-shadow-lg">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="tw-text-xl tw-font-bold mb-0">Registered Pets</h2>
                    <a href="{{ route('content.pets') }}" class="tw-bg-[#F4F7FE] tw-text-[#159cbb] tw-px-4 tw-py-1 tw-rounded-full tw-transition-all tw-no-underline tw-duration-300 tw-ease-in-out hover:tw-bg-[#24CFF4] hover:tw-text-white" onclick="loadContent(event, '{{ route('content.pets') }}')">See All</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="tw-border-b">
                                <th class="tw-p-2 tw-text-left tw-cursor-pointer" onclick="sortTable('pets', 0)"></th>
                                <th class="tw-p-2 tw-text-left tw-cursor-pointer" onclick="sortTable('pets', 1)">Name <i class="fa fa-sort tw-text-gray-200 tw-ml-1 hover:tw-text-gray-400"></i></th>
                                <th class="tw-p-2 tw-text-left tw-cursor-pointer" onclick="sortTable('pets', 2)">Species <i class="fa fa-sort tw-text-gray-200 tw-ml-1 hover:tw-text-gray-400"></i></th>
                            </tr>
                        </thead>
                        <tbody id="pets">
                            @forelse ($pets as $pet)
                                <tr class="tw-border-b hover:tw-bg-gray-100">
                                    <td class="tw-p-2 tw-min-w-[40px]">
                                        <img src="{{ asset('storage/' . $pet->petImage) }}" alt="{{ $pet->name }}" class="tw-w-10 tw-h-10 tw-rounded-full tw-object-cover">
                                    </td>
                                    <td class="tw-p-2">{{ $pet->name }}</td>
                                    <td class="tw-p-2">
                                        <span class="tw-px-3 tw-py-1 tw-rounded-full tw-text-sm 
                                                @if($pet->species === 'Dog') 
                                                    tw-bg-green-100 tw-text-green-800
                                                @elseif($pet->species === 'Cat')
                                                    tw-bg-yellow-100 tw-text-yellow-800
                                                @else
                                                    tw-bg-red-100 tw-text-red-800
                                                @endif"> {{ $pet->species }}
                                        </span>
                                    </td>
                                </tr>

                                @empty
                                <tr>
                                    <td colspan="7" class="tw-text-center tw-py-8">
                                        <div class="tw-flex tw-flex-col tw-items-center tw-gap-2">
                                            <i class="fas fa-calendar-times tw-text-4xl tw-text-gray-300"></i>
                                            <p class="tw-text-gray-500">No registered pets</p>
                                            <button data-modal-target="addPet-modal" data-modal-toggle="addPet-modal" 
                                                class="tw-text-[#24CFF4] tw-text-sm hover:tw-underline">Register one now</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pet Care Tips Section -->
            <div class="tw-bg-white tw-shadow-sm tw-rounded-2xl tw-p-6 tw-mt-4 tw-transition-all tw-duration-300 tw-ease-in-out hover:tw-shadow-lg">
                <h2 class="tw-text-xl tw-font-bold mb-4">Pet Care Tips 🐾</h2>
                <div class="tw-space-y-4">
                    <div class="tw-flex tw-items-start tw-gap-3 tw-p-3 tw-rounded-xl tw-bg-[#F0FBFF] tw-transition-all hover:tw-shadow-md">
                        <div class="tw-bg-[#24CFF4] tw-rounded-full tw-p-2 tw-flex-shrink-0">
                            <i class="fas fa-heart tw-text-white"></i>
                        </div>
                        <div>
                            <h3 class="tw-font-semibold tw-text-sm">Regular Check-ups</h3>
                            <p class="tw-text-gray-600 tw-text-sm">Schedule regular vet visits to keep your pet healthy and happy.</p>
                        </div>
                    </div>

                    <div class="tw-flex tw-items-start tw-gap-3 tw-p-3 tw-rounded-xl tw-bg-[#FFF4F0] tw-transition-all hover:tw-shadow-md">
                        <div class="tw-bg-[#FF9666] tw-rounded-full tw-p-2 tw-flex-shrink-0">
                            <i class="fas fa-clock tw-text-white"></i>
                        </div>
                        <div>
                            <h3 class="tw-font-semibold tw-text-sm">Exercise Time</h3>
                            <p class="tw-text-gray-600 tw-text-sm">Make sure your pet gets regular exercise and playtime.</p>
                        </div>
                    </div>

                    <div class="tw-flex tw-items-start tw-gap-3 tw-p-3 tw-rounded-xl tw-bg-[#F0FFF4] tw-transition-all hover:tw-shadow-md">
                        <div class="tw-bg-[#66FF8F] tw-rounded-full tw-p-2 tw-flex-shrink-0">
                            <i class="fas fa-utensils tw-text-white"></i>
                        </div>
                        <div>
                            <h3 class="tw-font-semibold tw-text-sm">Healthy Diet</h3>
                            <p class="tw-text-gray-600 tw-text-sm">Maintain a balanced diet appropriate for your pet's needs.</p>
                        </div>
                    </div>

                    <!-- Quick Action Button -->
                    <button type="button" data-modal-target="addAppointment-modal" data-modal-toggle="addAppointment-modal" 
                        class="tw-w-full tw-mt-4 tw-bg-gradient-to-r tw-from-[#24CFF4] tw-to-[#45E3FF] tw-text-white tw-rounded-xl tw-py-3 tw-px-4 tw-flex tw-items-center tw-justify-center tw-gap-2 tw-transition-all hover:tw-shadow-md hover:tw-opacity-90">
                        <i class="fas fa-plus-circle"></i>
                        <span>Schedule a Check-up</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    function addLoadingState(tableId) {
        const table = document.getElementById(tableId);
        if (table) {
            table.classList.add('tw-opacity-50');
            table.classList.add('tw-pointer-events-none');
        }
    }

    function removeLoadingState(tableId) {
        const table = document.getElementById(tableId);
        if (table) {
            table.classList.remove('tw-opacity-50');
            table.classList.remove('tw-pointer-events-none');
        }
    }

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

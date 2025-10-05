@extends('main')

@section('title', 'Dashboard')

@section('content')
@php
    $boardings = $boardings ?? collect([]);
    $appointments = $appointments ?? collect([]);
    $pets = $pets ?? collect([]);
@endphp
<div class="container-fluid tw-min-h-screen tw-p-6 tw-overflow-y-auto tw-bg-[#f4fbfd] font-poppins">    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12 col-md-6">
            <p class="tw-text-sm tw-text-gray-500">Pages / Dashboard</p>
            <h1 class="tw-text-2xl tw-font-bold">Dashboard</h1>
        </div>
        <div class="col-12 col-md-6 d-flex justify-content-md-end tw-justify-end align-items-center mt-3 mt-md-0">
            <div class="tw-flex tw-items-center tw-justify-end tw-bg-white tw-py-1 tw-px-4 tw-rounded-full tw-shadow-md tw-gap-4 tw-transition-all tw-duration-300 tw-ease-in-out hover:tw-shadow-lg">
                <!--    user's first name -->
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
            <div class="tw-bg-white tw-rounded-2xl tw-p-6 tw-shadow-md tw-transition-all tw-duration-300 hover:tw-shadow-lg">
                <h2 class="tw-text-2xl tw-font-bold tw-mb-2">Welcome back, {{ Auth::user()->firstName }}! 👋</h2>
                <p class="tw-text-gray-600">Here's what's happening with your pets today</p>
                
                <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-3 tw-gap-4 tw-mt-4">
                    <!-- Upcoming Appointments Card -->
                    <div class="tw-bg-[#eef7fc] tw-rounded-xl tw-p-4 tw-flex tw-items-center tw-gap-4">
                        <div class="tw-bg-[#24CFF4] tw-rounded-full tw-p-3">
                            <i class="fas fa-calendar tw-text-white tw-text-xl"></i>
                        </div>
                        <div>
                            <p class="tw-text-sm tw-text-gray-600">Upcoming Appointments</p>
                            <h3 class="tw-text-xl tw-font-bold">{{ count($appointments) }}</h3>
                        </div>
                    </div>
                    
                    <!-- Active Boardings Card -->
                    <div class="tw-bg-[#f0f8fe] tw-rounded-xl tw-p-4 tw-flex tw-items-center tw-gap-4">
                        <div class="tw-bg-[#45E3FF] tw-rounded-full tw-p-3">
                            <i class="fas fa-home tw-text-white tw-text-xl"></i>
                        </div>
                        <div>
                            <p class="tw-text-sm tw-text-gray-600">Active Boardings</p>
                            <h3 class="tw-text-xl tw-font-bold">{{ count($boardings) }}</h3>
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
                class="tw-flex tw-items-center tw-rounded-2xl tw-shadow-md tw-px-6 tw-py-4 tw-space-x-3 tw-group tw-transition-all tw-duration-300 hover:tw-shadow-lg hover:tw-scale-105 tw-bg-[#45E3FF]">
                <div class="tw-flex tw-justify-center tw-items-center tw-w-12 tw-h-12 tw-bg-white/30 tw-backdrop-blur-sm tw-p-2 tw-rounded-full group-hover:tw-bg-white/40">
                    <i class="fa-solid fa-calendar tw-text-[1.2rem] tw-text-white"></i>
                </div>
                <span class="tw-text-white tw-font-bold">Add Appointment</span>
            </button>

            <button type="button" data-modal-target="addBoarding-modal" data-modal-toggle="addBoarding-modal" 
                class="tw-flex tw-items-center tw-rounded-2xl tw-shadow-md tw-px-6 tw-py-4 tw-space-x-3 tw-group tw-transition-all tw-duration-300 hover:tw-shadow-lg hover:tw-scale-105 tw-bg-[#24CFF4]">               
                <div class="tw-flex tw-justify-center tw-items-center tw-w-12 tw-h-12 tw-bg-white/30 tw-backdrop-blur-sm tw-p-2 tw-rounded-full group-hover:tw-bg-white/40">
                    <i class="fa-solid fa-bookmark tw-text-[1.2rem] tw-text-white"></i>
                </div>
                <span class="tw-text-white tw-font-bold">Add Boarding</span>
            </button>

            <button type="button" data-modal-target="addPet-modal" data-modal-toggle="addPet-modal" 
                class="tw-flex tw-items-center tw-rounded-2xl tw-shadow-md tw-px-6 tw-py-4 tw-space-x-3 tw-group tw-transition-all tw-duration-300 hover:tw-shadow-lg hover:tw-scale-105 tw-bg-[#20b9db]">
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
            <div class="tw-bg-white tw-shadow-md tw-rounded-2xl tw-p-6 mb-4 tw-transition-all tw-duration-300 tw-ease-in-out hover:tw-shadow-lg">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="tw-text-xl tw-font-bold mb-0">Upcoming Appointments</h2>
                    <a href="{{ route('content.manage') }}" class="tw-bg-[#F4F7FE] tw-text-[#159cbb] tw-px-4 tw-py-1 tw-rounded-full tw-transition-all tw-no-underline tw-duration-300 tw-ease-in-out hover:tw-bg-[#24CFF4] hover:tw-text-white" onclick="loadContent(event, '{{ route('content.manage') }}')">See All</a>
                </div>
                <div class="table-responsive">
                <table id="appointmentsTable" class="table table-hover">
                        <thead>
                            <tr class="tw-border-b">
                                <th class="tw-p-2 tw-text-left">ID</th>
                                <th class="tw-p-2 tw-text-left">Date</th>
                                <th class="tw-p-2 tw-text-left">Time</th>
                                <th class="tw-p-2 tw-text-left">Pet</th>
                                <th class="tw-p-2 tw-text-left">Service</th>
                                <th class="tw-p-2 tw-text-left">Status</th>
                                <th class="tw-p-2 tw-text-left"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($appointments as $appointment)
                                <tr class="tw-border-b hover:tw-bg-gray-100">
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
            <div class="tw-bg-white tw-shadow-md tw-rounded-2xl tw-p-6 tw-transition-all tw-duration-300 tw-ease-in-out hover:tw-shadow-lg">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="tw-text-xl tw-font-bold mb-0">Current Boarding Reservations</h2>
                    <a href="{{ route('content.manage') }}" class="tw-bg-[#F4F7FE] tw-text-[#159cbb] tw-px-4 tw-py-1 tw-rounded-full tw-transition-all tw-no-underline tw-duration-300 tw-ease-in-out hover:tw-bg-[#24CFF4] hover:tw-text-white" onclick="loadContent(event, '{{ route('content.manage') }}')">See All</a>
                </div>
                <div class="table-responsive">
                <table id="boardingReservationsTable" class="table table-hover">
                        <thead>
                            <tr class="tw-border-b">
                                <th class="tw-p-2 tw-text-left">ID</th>
                                <th class="tw-p-2 tw-text-left">Start Date</th>
                                <th class="tw-p-2 tw-text-left">End Date</th>
                                <th class="tw-p-2 tw-text-left">Pet</th>
                                <th class="tw-p-2 tw-text-left">Status</th>
                                <th class="tw-p-2 tw-text-left"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($boardings as $boarding)
                                <tr class="tw-border-b hover:tw-bg-gray-100">
                                    <td class="tw-p-2">{{ $boarding->boardingID }}</td>
                                    <td class="tw-p-2">{{ $boarding->start_date }}</td>
                                    <td class="tw-p-2">{{ $boarding->end_date }}</td>
                                    <td class="tw-p-2">{{ $boarding->pet->name }}</td>
                                    <td class="tw-p-2">
                                        <span class="tw-px-3 tw-py-1 tw-rounded-full tw-text-sm 
                                            @if($boarding->status === 'Confirmed') 
                                                tw-bg-green-100 tw-text-green-800
                                            @elseif($boarding->status === 'Pending')
                                                tw-bg-yellow-100 tw-text-yellow-800
                                            @else
                                                tw-bg-red-100 tw-text-red-800
                                            @endif">
                                            {{ $boarding->status }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="tw-text-center tw-py-8">
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
        </div>

        <!-- Registered Pets Sidebar -->
        <div class="col-12 col-lg-4">
            <div class="tw-bg-white tw-shadow-md tw-rounded-2xl tw-p-6 tw-transition-all tw-duration-300 tw-ease-in-out hover:tw-shadow-lg">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="tw-text-xl tw-font-bold mb-0">Registered Pets</h2>
                    <a href="{{ route('content.pets') }}" class="tw-bg-[#F4F7FE] tw-text-[#159cbb] tw-px-4 tw-py-1 tw-rounded-full tw-transition-all tw-no-underline tw-duration-300 tw-ease-in-out hover:tw-bg-[#24CFF4] hover:tw-text-white" onclick="loadContent(event, '{{ route('content.pets') }}')">See All</a>
                </div>
                <div class="table-responsive">
                <table id="petsTable" class="table table-hover">
                        <thead>
                            <tr class="tw-border-b">
                                <th class="tw-p-2 tw-text-left"></th>
                                <th class="tw-p-2 tw-text-left">Name</th>
                                <th class="tw-p-2 tw-text-left">Species</th>
                            </tr>
                        </thead>
                        <tbody>
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
                                    <td colspan="3" class="tw-text-center tw-py-8">
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

            <!-- This Week's Schedule -->
            <div class="tw-bg-white tw-shadow-md tw-rounded-2xl tw-p-6 tw-mt-4 tw-transition-all tw-duration-300 tw-ease-in-out hover:tw-shadow-lg">
                <h2 class="tw-text-xl tw-font-bold mb-4">This Week's Schedule 📅</h2>
                
                @php
                    $today = \Carbon\Carbon::now()->setTimezone('Asia/Manila');
                    $nextWeek = $today->copy()->addDays(7);
                    
                    // Get upcoming events for the next 7 days
                    $upcomingAppointments = $appointments->filter(function($appointment) use ($today, $nextWeek) {
                        $date = \Carbon\Carbon::parse($appointment->date);
                        return $date->between($today->startOfDay(), $nextWeek->endOfDay());
                    });
                    
                    $upcomingBoardings = $boardings->filter(function($boarding) use ($today, $nextWeek) {
                        $date = \Carbon\Carbon::parse($boarding->start_date);
                        return $date->between($today->startOfDay(), $nextWeek->endOfDay());
                    });
                    
                    $hasEvents = $upcomingAppointments->count() > 0 || $upcomingBoardings->count() > 0;
                @endphp

                @if($hasEvents)
                    <div class="tw-space-y-3">
                        <!-- Summary Cards -->
                        <div class="tw-grid tw-grid-cols-2 tw-gap-3 tw-mb-4">
                            <div class="tw-bg-[#fff5f0] tw-rounded-xl tw-p-3 tw-text-center">
                                <div class="tw-flex tw-items-center tw-justify-center tw-gap-2">
                                    <i class="fas fa-calendar tw-text-[#FF9666]"></i>
                                    <span class="tw-text-2xl tw-font-bold tw-text-[#FF9666]">{{ $upcomingAppointments->count() }}</span>
                                </div>
                                <p class="tw-text-xs tw-text-gray-600 tw-mt-1">Appointments</p>
                            </div>
                            <div class="tw-bg-[#f0fff5] tw-rounded-xl tw-p-3 tw-text-center">
                                <div class="tw-flex tw-items-center tw-justify-center tw-gap-2">
                                    <i class="fas fa-home tw-text-[#66FF8F]"></i>
                                    <span class="tw-text-2xl tw-font-bold tw-text-[#66FF8F]">{{ $upcomingBoardings->count() }}</span>
                                </div>
                                <p class="tw-text-xs tw-text-gray-600 tw-mt-1">Boardings</p>
                            </div>
                        </div>

                        <!-- Event List -->
                        <div class="tw-space-y-2 tw-max-h-[300px] tw-overflow-y-auto">
                            @foreach($upcomingAppointments->sortBy('date') as $appointment)
                                @php
                                    $date = \Carbon\Carbon::parse($appointment->date);
                                    $isToday = $date->isToday();
                                    $isTomorrow = $date->isTomorrow();
                                @endphp
                                <div class="tw-flex tw-items-start tw-gap-3 tw-p-3 tw-rounded-xl tw-bg-[#fff5f0] tw-border-l-4 tw-border-[#FF9666] tw-transition-all hover:tw-shadow-md {{ $isToday ? 'tw-ring-2 tw-ring-[#FF9666]' : '' }}">
                                    <div class="tw-bg-[#FF9666] tw-rounded-full tw-p-2 tw-flex-shrink-0">
                                        <i class="fas fa-calendar tw-text-white tw-text-sm"></i>
                                    </div>
                                    <div class="tw-flex-1">
                                        <div class="tw-flex tw-items-start tw-justify-between">
                                            <h3 class="tw-font-semibold tw-text-sm tw-text-gray-800">{{ $appointment->service->name }}</h3>
                                            @if($isToday)
                                                <span class="tw-px-2 tw-py-0.5 tw-bg-[#FF9666] tw-text-white tw-text-xs tw-rounded-full">Today</span>
                                            @elseif($isTomorrow)
                                                <span class="tw-px-2 tw-py-0.5 tw-bg-orange-400 tw-text-white tw-text-xs tw-rounded-full">Tomorrow</span>
                                            @endif
                                        </div>
                                        <p class="tw-text-xs tw-text-gray-600 tw-mt-1">
                                            <i class="far fa-clock tw-mr-1"></i>{{ $appointment->time }} • {{ $date->format('M d, D') }}
                                        </p>
                                        <p class="tw-text-xs tw-text-gray-500 tw-mt-1">
                                            <i class="fas fa-paw tw-mr-1"></i>{{ $appointment->pet->name }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach

                            @foreach($upcomingBoardings->sortBy('start_date') as $boarding)
                                @php
                                    $date = \Carbon\Carbon::parse($boarding->start_date);
                                    $endDate = \Carbon\Carbon::parse($boarding->end_date);
                                    $isToday = $date->isToday();
                                    $isTomorrow = $date->isTomorrow();
                                @endphp
                                <div class="tw-flex tw-items-start tw-gap-3 tw-p-3 tw-rounded-xl tw-bg-[#f0fff5] tw-border-l-4 tw-border-[#66FF8F] tw-transition-all hover:tw-shadow-md {{ $isToday ? 'tw-ring-2 tw-ring-[#66FF8F]' : '' }}">
                                    <div class="tw-bg-[#66FF8F] tw-rounded-full tw-p-2 tw-flex-shrink-0">
                                        <i class="fas fa-home tw-text-white tw-text-sm"></i>
                                    </div>
                                    <div class="tw-flex-1">
                                        <div class="tw-flex tw-items-start tw-justify-between">
                                            <h3 class="tw-font-semibold tw-text-sm tw-text-gray-800">Boarding Stay</h3>
                                            @if($isToday)
                                                <span class="tw-px-2 tw-py-0.5 tw-bg-[#66FF8F] tw-text-white tw-text-xs tw-rounded-full">Starts Today</span>
                                            @elseif($isTomorrow)
                                                <span class="tw-px-2 tw-py-0.5 tw-bg-green-400 tw-text-white tw-text-xs tw-rounded-full">Tomorrow</span>
                                            @endif
                                        </div>
                                        <p class="tw-text-xs tw-text-gray-600 tw-mt-1">
                                            <i class="far fa-calendar tw-mr-1"></i>{{ $date->format('M d') }} - {{ $endDate->format('M d') }}
                                        </p>
                                        <p class="tw-text-xs tw-text-gray-500 tw-mt-1">
                                            <i class="fas fa-paw tw-mr-1"></i>{{ $boarding->pet->name }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-py-8">
                        <div class="tw-bg-[#f0f8fe] tw-rounded-full tw-p-6 tw-mb-3">
                            <i class="fas fa-calendar-check tw-text-4xl tw-text-[#24CFF4]"></i>
                        </div>
                        <p class="tw-text-gray-700 tw-font-semibold tw-text-sm">No events this week</p>
                        <p class="tw-text-gray-500 tw-text-xs tw-mt-1">You're all clear!</p>
                    </div>
                @endif
            </div>

            <!-- Pet Care Tips Section -->
            <div class="tw-bg-white tw-shadow-md tw-rounded-2xl tw-p-6 tw-mt-4 tw-transition-all tw-duration-300 tw-ease-in-out hover:tw-shadow-lg">
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
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
window.DashboardPage = window.DashboardPage || {
    appointmentsTable: null,
    boardingsTable: null,
    petsTable: null,

    initializeTables: function() {
        console.log('Initializing dashboard tables...');
        this.destroyTables();

        // Restore table headers since we’ll clear them before re-initialization
        $('#appointmentsTable').html(`
            <thead>
                <tr class="tw-border-b">
                    <th class="tw-p-2 tw-text-left">ID</th>
                    <th class="tw-p-2 tw-text-left">Pet Name</th>
                    <th class="tw-p-2 tw-text-left">Date</th>
                    <th class="tw-p-2 tw-text-left">Time</th>
                    <th class="tw-p-2 tw-text-left">Service</th>
                    <th class="tw-p-2 tw-text-left">Status</th>
                    <th class="tw-p-2 tw-text-left">Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        `);

        $('#boardingReservationsTable').html(`
            <thead>
                <tr class="tw-border-b">
                    <th class="tw-p-2 tw-text-left">ID</th>
                    <th class="tw-p-2 tw-text-left">Start Date</th>
                    <th class="tw-p-2 tw-text-left">End Date</th>
                    <th class="tw-p-2 tw-text-left">Pet Name</th>
                    <th class="tw-p-2 tw-text-left">Status</th>
                    <th class="tw-p-2 tw-text-left">Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        `);

        $('#petsTable').html(`
            <thead>
                <tr class="tw-border-b">
                    <th class="tw-p-2 tw-text-left"></th>
                    <th class="tw-p-2 tw-text-left">Name</th>
                    <th class="tw-p-2 tw-text-left">Species</th>
                </tr>
            </thead>
            <tbody></tbody>
        `);

        // Define a common configuration object used by all tables
        const commonConfig = {
            serverSide: false,
            autoWidth: false,
            scrollX: false,
            dom: 'Blfrtip',
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            buttons: [
                {
                    extend: 'print',
                    text: '<i class="fas fa-print tw-mr-2"></i> Print',
                    className: 'tw-mr-2'
                }
            ],
            language: {
                lengthMenu: "_MENU_ per page",
                search: "_INPUT_",
                searchPlaceholder: "Search records...",
                emptyTable: `
                    <div class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-py-12">
                        <div class="tw-bg-gray-100 tw-rounded-full tw-p-6 tw-mb-4">
                            <i class="fas fa-calendar-times tw-text-5xl tw-text-gray-400"></i>
                        </div>
                        <p class="tw-text-gray-500 tw-text-lg tw-font-medium">No data available</p>
                    </div>
                `,
                zeroRecords: `
                    <div class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-py-12">
                        <div class="tw-bg-gray-100 tw-rounded-full tw-p-6 tw-mb-4">
                            <i class="fas fa-search tw-text-5xl tw-text-gray-400"></i>
                        </div>
                        <p class="tw-text-gray-500 tw-text-lg tw-font-medium">No matching records found</p>
                    </div>
                `
            }
        };

        // Initialize appointments table (using AJAX similar to ManagePage)
        this.appointmentsTable = $('#appointmentsTable').DataTable({
            ...commonConfig,
            ajax: {
                url: '{{ route("dashboard.upcoming-appointments") }}',
                type: 'GET',
                error: function (xhr, error, thrown) {
                    console.error('Appointments Ajax error:', xhr, error, thrown);
                }
            },
            language: {
                ...commonConfig.language,
                emptyTable: `
                    <div class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-py-12">
                        <div class="tw-bg-[#f0f8fe] tw-rounded-full tw-p-6 tw-mb-4">
                            <i class="fas fa-calendar-times tw-text-5xl tw-text-[#24CFF4]"></i>
                        </div>
                        <p class="tw-text-gray-700 tw-text-lg tw-font-semibold tw-mb-1">No upcoming appointments</p>
                        <p class="tw-text-gray-500 tw-text-sm tw-mb-4">Schedule your first appointment to get started</p>
                        <button data-modal-target="addAppointment-modal" data-modal-toggle="addAppointment-modal" 
                            class="tw-bg-[#24CFF4] tw-text-white tw-px-6 tw-py-2 tw-rounded-full tw-transition-all tw-duration-300 hover:tw-bg-[#1db8d9] hover:tw-shadow-md">
                            <i class="fas fa-plus tw-mr-2"></i>Schedule Appointment
                        </button>
                    </div>
                `
            },
            columns: [
                { data: 'appointmentID', width: '5%' },
                { data: 'pet.name', width: '15%' },
                { data: 'date', width: '15%' },
                { data: 'time', width: '10%' },
                { data: 'service.name', width: '20%' },
                { 
                    data: 'status',
                    width: '15%',
                    render: function(data) {
                        let colorClass = data === 'Confirmed' ? 'tw-bg-green-100 tw-text-green-800' :
                                         data === 'Pending' ? 'tw-bg-yellow-100 tw-text-yellow-800' :
                                         'tw-bg-red-100 tw-text-red-800';
                        return `<span class="tw-px-3 tw-py-1 tw-rounded-full tw-text-sm ${colorClass}">${data}</span>`;
                    }
                },
                {
                    data: null,
                    width: '20%',
                    render: function(data) {
                        const cancelBtn = data.status !== 'Cancelled' && data.status !== 'Completed' ? 
                            `<button onclick="DashboardPage.cancelAppointment(${data.appointmentID})" 
                                    class="tw-text-red-500 hover:tw-text-red-700">
                                <i class="fas fa-ban"></i>
                            </button>` : '';
                            
                        return `
                            <div class="tw-flex tw-gap-2 tw-justify-center">
                                <button onclick="DashboardPage.viewAppointment(${data.appointmentID})" 
                                        class="tw-text-blue-500 hover:tw-text-blue-700">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button onclick="DashboardPage.editAppointment(${data.appointmentID})" 
                                        class="tw-text-yellow-500 hover:tw-text-yellow-700">
                                    <i class="fas fa-edit"></i>
                                </button>
                                ${cancelBtn}
                            </div>
                        `;
                    }
                }
            ]
        });

        // Initialize boardings table
        this.boardingsTable = $('#boardingReservationsTable').DataTable({
            ...commonConfig,
            ajax: {
                url: '{{ route("dashboard.current-boardings") }}',
                type: 'GET',
                error: function (xhr, error, thrown) {
                    console.error('Boardings Ajax error:', { status: xhr.status, statusText: xhr.statusText, error: error });
                }
            },
            language: {
                ...commonConfig.language,
                emptyTable: `
                    <div class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-py-12">
                        <div class="tw-bg-[#f0f8fe] tw-rounded-full tw-p-6 tw-mb-4">
                            <i class="fas fa-home tw-text-5xl tw-text-[#24CFF4]"></i>
                        </div>
                        <p class="tw-text-gray-700 tw-text-lg tw-font-semibold tw-mb-1">No boarding reservations</p>
                        <p class="tw-text-gray-500 tw-text-sm tw-mb-4">Book a boarding stay for your pet</p>
                        <button data-modal-target="addBoarding-modal" data-modal-toggle="addBoarding-modal" 
                            class="tw-bg-[#24CFF4] tw-text-white tw-px-6 tw-py-2 tw-rounded-full tw-transition-all tw-duration-300 hover:tw-bg-[#1db8d9] hover:tw-shadow-md">
                            <i class="fas fa-plus tw-mr-2"></i>Book Boarding
                        </button>
                    </div>
                `
            },
            columns: [
                { data: 'boardingID', width: '5%' },
                { data: 'start_date', width: '20%' },
                { data: 'end_date', width: '20%' },
                { data: 'pet.name', width: '20%' },
                { 
                    data: 'status',
                    width: '15%',
                    render: function(data) {
                        let colorClass = data === 'Confirmed' ? 'tw-bg-green-100 tw-text-green-800' :
                                         data === 'Pending' ? 'tw-bg-yellow-100 tw-text-yellow-800' :
                                         'tw-bg-red-100 tw-text-red-800';
                        return `<span class="tw-px-3 tw-py-1 tw-rounded-full tw-text-sm ${colorClass}">${data}</span>`;
                    }
                },
                {
                    data: null,
                    width: '15%',
                    render: function(data) {
                        const cancelBtn = data.status !== 'Cancelled' && data.status !== 'Completed' ? 
                            `<button onclick="DashboardPage.cancelBoarding(${data.boardingID})" 
                                    class="tw-text-red-500 hover:tw-text-red-700">
                                <i class="fas fa-ban"></i>
                            </button>` : '';
                            
                        return `
                            <div class="tw-flex tw-gap-2 tw-justify-center">
                                <button onclick="DashboardPage.viewBoarding(${data.boardingID})" 
                                        class="tw-text-blue-500 hover:tw-text-blue-700">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button onclick="DashboardPage.editBoarding(${data.boardingID})" 
                                        class="tw-text-yellow-500 hover:tw-text-yellow-700">
                                    <i class="fas fa-edit"></i>
                                </button>
                                ${cancelBtn}
                            </div>
                        `;
                    }
                }
            ]
        });

        // Initialize pets table (assuming you have an endpoint; adjust if using server-rendered data)
        this.petsTable = $('#petsTable').DataTable({
            ...commonConfig,
            dom: 'lrtip', 
            buttons: [],
            ajax: {
                url: '{{ route("dashboard.pets") }}',
                type: 'GET',
                error: function (xhr, error, thrown) {
                    console.error('Pets Ajax error:', xhr, error, thrown);
                }
            },
            language: {
                ...commonConfig.language,
                emptyTable: `
                    <div class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-py-12">
                        <div class="tw-bg-[#f0f8fe] tw-rounded-full tw-p-6 tw-mb-4">
                            <i class="fas fa-paw tw-text-5xl tw-text-[#24CFF4]"></i>
                        </div>
                        <p class="tw-text-gray-700 tw-text-lg tw-font-semibold tw-mb-1">No registered pets</p>
                        <p class="tw-text-gray-500 tw-text-sm tw-mb-4">Add your first pet to get started</p>
                        <button data-modal-target="addPet-modal" data-modal-toggle="addPet-modal" 
                            class="tw-bg-[#24CFF4] tw-text-white tw-px-6 tw-py-2 tw-rounded-full tw-transition-all tw-duration-300 hover:tw-bg-[#1db8d9] hover:tw-shadow-md">
                            <i class="fas fa-plus tw-mr-2"></i>Register Pet
                        </button>
                    </div>
                `
            },
            columns: [
                { 
                    data: 'petImage', 
                    width: '20%',
                    render: function(data) {
                        return `<div class="tw-flex tw-justify-center tw-items-center">
                            <div class="tw-w-10 tw-h-10 tw-min-w-[40px] tw-overflow-hidden tw-rounded-full tw-flex-shrink-0 tw-border tw-border-gray-200">
                                <img src="{{ asset('storage') }}/${data}" class="tw-w-full tw-h-full tw-object-cover">
                            </div>
                        </div>`;
                    }
                },
                { data: 'name', width: '45%' },
                { 
                    data: 'species', 
                    width: '45%',
                    render: function(data) {
                        let colorClass = data === 'Dog' ? 'tw-bg-green-100 tw-text-green-800' :
                                        data === 'Cat' ? 'tw-bg-yellow-100 tw-text-yellow-800' :
                                        'tw-bg-red-100 tw-text-red-800';
                        return `<span class="tw-px-3 tw-py-1 tw-rounded-full tw-text-sm ${colorClass}">${data}</span>`;
                    }
                }
            ]
        });
    },

    destroyTables: function() {
        if ($.fn.DataTable.isDataTable('#appointmentsTable')) {
            $('#appointmentsTable').DataTable().clear().destroy();
            $('#appointmentsTable').empty();
        }
        if ($.fn.DataTable.isDataTable('#boardingReservationsTable')) {
            $('#boardingReservationsTable').DataTable().clear().destroy();
            $('#boardingReservationsTable').empty();
        }
        if ($.fn.DataTable.isDataTable('#petsTable')) {
            $('#petsTable').DataTable().clear().destroy();
            $('#petsTable').empty();
        }
    },

    // Appointment actions
    viewAppointment: function(id) {
        if(typeof window.openAppointmentModal === 'function') {
            window.openAppointmentModal(id);
        } else {
            console.error("openAppointmentModal function not found");
            Swal.fire({
                title: 'Error',
                text: 'Could not open appointment details. Please try again later.',
                icon: 'error',
                confirmButtonColor: '#24CFF4',
            });
        }
    },

    editAppointment: function(id) {
        if(typeof window.openEditAppointmentModal === 'function') {
            window.openEditAppointmentModal(id);
        } else {
            console.error("openEditAppointmentModal function not found");
            Swal.fire({
                title: 'Error',
                text: 'Could not fetch appointment details. Please try again later.',
                icon: 'error',
                confirmButtonColor: '#24CFF4',
            });
        }
    },

    cancelAppointment: function(id) {
        Swal.fire({
            title: 'Cancel Appointment?',
            text: "This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, cancel it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Send AJAX request to cancel the appointment
                fetch("{{ route('user.appointments.cancel', ['id' => ':id']) }}".replace(':id', id), {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Refresh the datatable
                        this.appointmentsTable.ajax.reload();
                        
                        Swal.fire(
                            'Cancelled!',
                            'The appointment has been cancelled.',
                            'success'
                        );
                    } else {
                        throw new Error(data.message || 'An error occurred');
                    }
                })
                .catch(error => {
                    Swal.fire(
                        'Error!',
                        error.message,
                        'error'
                    );
                });
            }
        });
},

    // Boarding actions
    viewBoarding: function(id) {
        if(typeof window.openViewBoardingModal === 'function') {
            window.openViewBoardingModal(id);
        } else {
            console.error("openViewBoardingModal function not found");
            Swal.fire({
                title: 'Error',
                text: 'Could not fetch boarding details. Please try again later.',
                icon: 'error',
                confirmButtonColor: '#24CFF4',
            });
        }
    },

    editBoarding: function(id) {
        if(typeof window.openEditBoardingModal === 'function') {
            window.openEditBoardingModal(id);
        } else {
            console.error("openEditBoardingModal function not found");
            Swal.fire({
                title: 'Error',
                text: 'Could not fetch boarding details. Please try again later.',
                icon: 'error',
                confirmButtonColor: '#24CFF4',
            });
        }
    },

    cancelBoarding: function(id) {
        Swal.fire({
            title: 'Cancel Boarding?',
            text: "This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, cancel it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Send AJAX request to cancel the boarding
                fetch(`{{ route('user.boardings.cancel', ['id' => ':id']) }}`.replace(':id', id), {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Refresh the datatable
                        this.boardingsTable.ajax.reload();
                        
                        Swal.fire(
                            'Cancelled!',
                            'The boarding has been cancelled.',
                            'success'
                        );
                    } else {
                        throw new Error(data.message || 'An error occurred');
                    }
                })
                .catch(error => {
                    Swal.fire(
                        'Error!',
                        error.message,
                        'error'
                    );
                });
            }
        });
    }
};

$(document).ready(function() {
    DashboardPage.initializeTables();
});

document.addEventListener('contentChanged', function() {
    console.log('Content changed event received');
    DashboardPage.initializeTables();
});

document.addEventListener('contentWillChange', function() {
    console.log('Content will change event received');
    DashboardPage.destroyTables();
});
</script>
@endpush

@include('modals.user.edit-appointment')
@include('modals.user.add-appointment')
@include('modals.user.edit-boarding')
@include('modals.user.add-boarding')
@include('modals.user.add-pet')
@include('modals.user.payment-modal')
@include('modals.user.view-boarding')
@include('modals.user.view-appointment')

@endsection



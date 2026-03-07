@extends('admin.adminLayout')

@section('title', 'System Settings')

@section('content')
<div class="tw-p-6 tw-min-h-screen tw-bg-gray-900">

    <!-- Header -->
    <div class="tw-mb-6">
        <p class="tw-text-sm tw-text-gray-400">Administration / Settings</p>
        <h1 class="tw-text-2xl tw-font-bold tw-text-white">System Settings</h1>
    </div>

    @if(session('success'))
    <div class="tw-mb-4 tw-bg-green-800 tw-border tw-border-green-600 tw-text-green-200 tw-px-4 tw-py-3 tw-rounded-lg tw-flex tw-items-center tw-gap-2">
        <i class="fas fa-check-circle"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    @if(session('error'))
    <div class="tw-mb-4 tw-bg-red-800 tw-border tw-border-red-600 tw-text-red-200 tw-px-4 tw-py-3 tw-rounded-lg tw-flex tw-items-center tw-gap-2">
        <i class="fas fa-exclamation-circle"></i>
        <span>{{ session('error') }}</span>
    </div>
    @endif

    <div class="tw-grid tw-grid-cols-1 lg:tw-grid-cols-3 tw-gap-6">

        <!-- Left column: General Settings form -->
        <div class="lg:tw-col-span-2 tw-space-y-6">

            <!-- General Settings -->
            <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-6">
                <h2 class="tw-text-lg tw-font-semibold tw-text-white tw-mb-5 tw-flex tw-items-center tw-gap-2">
                    <i class="fas fa-sliders-h tw-text-blue-400"></i> General Settings
                </h2>
                <form action="{{ route('admin.settings.save') }}" method="POST">
                    @csrf
                    <div class="tw-space-y-4">
                        <div>
                            <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-300 tw-mb-1">Clinic / Business Name</label>
                            <input type="text" name="clinic_name"
                                value="{{ $settings['clinic_name']->value ?? config('app.name') }}"
                                class="tw-w-full tw-bg-gray-700 tw-text-white tw-border tw-border-gray-600 tw-rounded-lg tw-px-3 tw-py-2 focus:tw-outline-none focus:tw-border-blue-500">
                        </div>
                        <div>
                            <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-300 tw-mb-1">Contact Email</label>
                            <input type="email" name="contact_email"
                                value="{{ $settings['contact_email']->value ?? '' }}"
                                placeholder="e.g. info@furrytails.com"
                                class="tw-w-full tw-bg-gray-700 tw-text-white tw-border tw-border-gray-600 tw-rounded-lg tw-px-3 tw-py-2 focus:tw-outline-none focus:tw-border-blue-500">
                        </div>
                        <div>
                            <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-300 tw-mb-1">Contact Phone</label>
                            <input type="text" name="contact_phone"
                                value="{{ $settings['contact_phone']->value ?? '' }}"
                                placeholder="e.g. +63 900 000 0000"
                                class="tw-w-full tw-bg-gray-700 tw-text-white tw-border tw-border-gray-600 tw-rounded-lg tw-px-3 tw-py-2 focus:tw-outline-none focus:tw-border-blue-500">
                        </div>
                        <div>
                            <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-300 tw-mb-1">Business Address</label>
                            <textarea name="business_address" rows="2"
                                placeholder="Street, City, Province"
                                class="tw-w-full tw-bg-gray-700 tw-text-white tw-border tw-border-gray-600 tw-rounded-lg tw-px-3 tw-py-2 focus:tw-outline-none focus:tw-border-blue-500">{{ $settings['business_address']->value ?? '' }}</textarea>
                        </div>
                    </div>

                    <h2 class="tw-text-lg tw-font-semibold tw-text-white tw-mt-8 tw-mb-5 tw-flex tw-items-center tw-gap-2">
                        <i class="fas fa-calendar-alt tw-text-purple-400"></i> Booking Settings
                    </h2>
                    <div class="tw-grid tw-grid-cols-1 sm:tw-grid-cols-2 tw-gap-4">
                        <div>
                            <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-300 tw-mb-1">Max Appointments Per Day</label>
                            <input type="number" name="max_appointments_per_day" min="1" max="100"
                                value="{{ $settings['max_appointments_per_day']->value ?? 10 }}"
                                class="tw-w-full tw-bg-gray-700 tw-text-white tw-border tw-border-gray-600 tw-rounded-lg tw-px-3 tw-py-2 focus:tw-outline-none focus:tw-border-blue-500">
                        </div>
                        <div>
                            <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-300 tw-mb-1">Max Boarding Capacity</label>
                            <input type="number" name="max_boarding_capacity" min="1" max="500"
                                value="{{ $settings['max_boarding_capacity']->value ?? 20 }}"
                                class="tw-w-full tw-bg-gray-700 tw-text-white tw-border tw-border-gray-600 tw-rounded-lg tw-px-3 tw-py-2 focus:tw-outline-none focus:tw-border-blue-500">
                        </div>
                        <div>
                            <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-300 tw-mb-1">Session Idle Timeout (minutes)</label>
                            <input type="number" name="session_idle_timeout" min="5" max="480"
                                value="{{ $settings['session_idle_timeout']->value ?? env('SESSION_IDLE_TIMEOUT', 30) }}"
                                class="tw-w-full tw-bg-gray-700 tw-text-white tw-border tw-border-gray-600 tw-rounded-lg tw-px-3 tw-py-2 focus:tw-outline-none focus:tw-border-blue-500">
                            <p class="tw-text-xs tw-text-gray-500 tw-mt-1">Admins are logged out after this many minutes of inactivity.</p>
                        </div>
                        <div>
                            <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-300 tw-mb-1">Currency Symbol</label>
                            <input type="text" name="currency_symbol"
                                value="{{ $settings['currency_symbol']->value ?? '₱' }}"
                                class="tw-w-full tw-bg-gray-700 tw-text-white tw-border tw-border-gray-600 tw-rounded-lg tw-px-3 tw-py-2 focus:tw-outline-none focus:tw-border-blue-500">
                        </div>
                    </div>

                    <div class="tw-mt-6 tw-flex tw-justify-end">
                        <button type="submit"
                            class="tw-bg-blue-600 hover:tw-bg-blue-500 tw-text-white tw-px-6 tw-py-2 tw-rounded-lg tw-font-semibold tw-transition-colors">
                            <i class="fas fa-save tw-mr-2"></i> Save Settings
                        </button>
                    </div>
                </form>
            </div>

        </div>

        <!-- Right column: System Information -->
        <div class="tw-space-y-6">
            <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-6">
                <h2 class="tw-text-lg tw-font-semibold tw-text-white tw-mb-5 tw-flex tw-items-center tw-gap-2">
                    <i class="fas fa-server tw-text-yellow-400"></i> System Information
                </h2>
                <ul class="tw-space-y-3 tw-text-sm">
                    @foreach($sysInfo as $label => $value)
                    <li class="tw-flex tw-justify-between tw-items-center tw-border-b tw-border-gray-700 tw-pb-2 last:tw-border-0 last:tw-pb-0">
                        <span class="tw-text-gray-400 tw-capitalize">{{ str_replace('_', ' ', $label) }}</span>
                        <span class="tw-text-white tw-font-medium tw-text-right">{{ $value }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>

            <!-- Persisted settings count -->
            <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-6">
                <h2 class="tw-text-lg tw-font-semibold tw-text-white tw-mb-4 tw-flex tw-items-center tw-gap-2">
                    <i class="fas fa-database tw-text-green-400"></i> Stored Settings
                </h2>
                <p class="tw-text-gray-400 tw-text-sm">
                    <span class="tw-text-2xl tw-font-bold tw-text-white tw-block">{{ $settings->count() }}</span>
                    setting{{ $settings->count() === 1 ? '' : 's' }} saved in the database.
                </p>
            </div>
        </div>

    </div>
</div>
@endsection

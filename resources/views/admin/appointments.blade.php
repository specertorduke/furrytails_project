@extends('admin.adminLayout')

@section('title', 'Appointments')

@section('content')
<div class="tw-p-6 tw-min-h-screen tw-bg-gray-900">
    <!-- Header Section -->
    <div class="tw-flex tw-flex-col md:tw-flex-row tw-justify-between tw-items-start md:tw-items-center tw-mb-6">
        <div>
            <p class="tw-text-sm tw-text-gray-400">Analytics / Dashboard</p>
            <h1 class="tw-text-2xl tw-font-bold tw-text-white">Admin Dashboard</h1>
        </div>
        <div class="tw-mt-4 md:tw-mt-0">
            <div class="tw-bg-gray-800 tw-text-white tw-px-4 tw-py-2 tw-rounded-lg tw-flex tw-items-center tw-gap-2">
                <i class="fas fa-calendar-alt"></i>
                <span>{{ date('F d, Y') }}</span>
            </div>
        </div>
    </div>
</div>
@endsection
@props(['status'])

@php
$colors = [
    'Pending' => 'tw-bg-blue-100 tw-text-blue-800',
    'Active' => 'tw-bg-green-100 tw-text-green-800',
    'Completed' => 'tw-bg-gray-100 tw-text-gray-800',
    'Cancelled' => 'tw-bg-red-100 tw-text-red-800',
    'Missed' => 'tw-bg-yellow-100 tw-text-yellow-800',
];

$color = $colors[$status] ?? 'tw-bg-gray-100 tw-text-gray-800';
@endphp

<span {{ $attributes->merge(['class' => "tw-px-2 tw-py-1 tw-text-xs tw-font-medium tw-rounded-full {$color}"]) }}>
    {{ $status }}
</span>
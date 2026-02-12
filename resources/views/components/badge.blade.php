@props(['type'])

@php
$colors = [
    'Hadir' => 'bg-green-100 text-green-700',
    'Izin' => 'bg-yellow-100 text-yellow-700',
    'Sakit' => 'bg-blue-100 text-blue-700',
    'Cuti' => 'bg-purple-100 text-purple-700',
];
@endphp

<span class="px-3 py-1 rounded-full text-sm font-medium {{ $colors[$type] ?? 'bg-gray-100 text-gray-700' }}">
    {{ $type }}
</span>

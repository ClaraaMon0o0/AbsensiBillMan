@extends('layouts.admin')

@section('content')

<h1 class="text-2xl font-bold mb-6">Pengaturan Absensi</h1>

<x-card>

    @php
        $isOpen = $setting?->is_open ?? false;
    @endphp

    <p class="mb-6">
        Status saat ini:
        <strong class="{{ $isOpen ? 'text-green-600' : 'text-red-600' }}">
            {{ $isOpen ? 'DIBUKA' : 'DITUTUP' }}
        </strong>
    </p>

    <form method="POST" action="{{ route('admin.settings.toggle') }}">
        @csrf

        <button type="submit"
            class="px-6 py-2 rounded text-white transition
            {{ $isOpen ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }}">
            
            {{ $isOpen ? 'Tutup Absensi' : 'Buka Absensi' }}

        </button>
    </form>

</x-card>

@endsection

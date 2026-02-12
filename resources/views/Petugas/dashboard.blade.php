@extends('layouts.petugas')

@section('content')

<h1 class="text-2xl font-bold mb-6">Dashboard Petugas</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

    {{-- Status Hari Ini --}}
    <x-card>
        <h3 class="text-gray-500 mb-2">Status Hari Ini</h3>

        @if($sudahAbsen)
            <div class="p-3 bg-green-100 text-green-700 rounded">
                Sudah Absen ✅
            </div>
        @else
            <div class="p-3 bg-yellow-100 text-yellow-700 rounded mb-4">
                Belum Absen
            </div>

            <a href="{{ route('petugas.absensi.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Absen Sekarang
            </a>
        @endif
    </x-card>

    {{-- Total Absensi --}}
    <x-card>
        <h3 class="text-gray-500 mb-2">Total Absensi</h3>
        <p class="text-3xl font-bold">
            {{ $totalAbsensi }}
        </p>
    </x-card>

    {{-- Absensi Terakhir --}}
    <x-card>
        <h3 class="text-gray-500 mb-2">Absensi Terakhir</h3>

        @if($absensiTerakhir)
            <p class="font-medium">{{ $absensiTerakhir->tanggal }}</p>
            <div class="mt-2">
                <x-badge :type="$absensiTerakhir->status"/>
            </div>
        @else
            <p class="text-gray-400">Belum ada data</p>
        @endif
    </x-card>

</div>

@endsection

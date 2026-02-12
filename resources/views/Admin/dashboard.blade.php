@extends('layouts.admin')

@section('content')

<div class="flex items-center gap-3 mb-8">
    <div class="w-10 h-10 bg-[#0B2D45]/10 rounded-xl flex items-center justify-center">
        <i class="fas fa-chart-line text-[#155E76] text-lg"></i>
    </div>
    <div>
        <h1 class="text-2xl font-semibold text-gray-800 tracking-tight">Dashboard Admin</h1>
        <p class="text-sm text-gray-500 mt-1">Ringkasan data absensi dan petugas</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    
    {{-- Total Petugas --}}
    <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-all duration-300">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-[#0B2D45]/10 rounded-xl flex items-center justify-center">
                <i class="fas fa-users text-[#155E76] text-xl"></i>
            </div>
            <span class="text-xs font-medium text-gray-400 uppercase tracking-wider">Petugas</span>
        </div>
        
        <h3 class="text-sm font-medium text-gray-500 mb-1">Total Petugas</h3>
        <div class="flex items-baseline gap-2">
            <p class="text-4xl font-bold text-[#0B2D45]">{{ $totalPetugas }}</p>
            <span class="text-sm text-gray-400">orang</span>
        </div>
        
        <div class="mt-4 flex items-center gap-2 text-xs text-gray-500">
            <i class="fas fa-user-check text-[#155E76]"></i>
            <span>Petugas aktif terdaftar</span>
        </div>
    </div>

    {{-- Absensi Hari Ini --}}
    <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-all duration-300">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-[#0B2D45]/10 rounded-xl flex items-center justify-center">
                <i class="fas fa-calendar-check text-[#155E76] text-xl"></i>
            </div>
            <span class="text-xs font-medium text-gray-400 uppercase tracking-wider">Hari Ini</span>
        </div>
        
        <h3 class="text-sm font-medium text-gray-500 mb-1">Absensi Hari Ini</h3>
        <div class="flex items-baseline gap-2">
            <p class="text-4xl font-bold text-[#0B2D45]">{{ $totalAbsensiHariIni }}</p>
            <span class="text-sm text-gray-400">kali</span>
        </div>
        
        <div class="mt-4 flex items-center gap-2 text-xs text-gray-500">
            <i class="fas fa-clock text-[#155E76]"></i>
            <span>{{ now()->format('d M Y') }}</span>
        </div>
    </div>

    {{-- Status Absensi --}}
    <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-all duration-300">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-[#0B2D45]/10 rounded-xl flex items-center justify-center">
                <i class="fas fa-toggle-on text-[#155E76] text-xl"></i>
            </div>
            <span class="text-xs font-medium text-gray-400 uppercase tracking-wider">Status</span>
        </div>
        
        <h3 class="text-sm font-medium text-gray-500 mb-1">Status Absensi</h3>
        
        @if($isOpen)
            <div class="flex items-center gap-3">
                <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                <p class="text-3xl font-bold text-green-600">Dibuka</p>
            </div>
            <div class="mt-4 flex items-center gap-2 text-xs text-gray-500">
                <i class="fas fa-lock-open text-green-500"></i>
                <span>Absensi sedang aktif</span>
            </div>
        @else
            <div class="flex items-center gap-3">
                <div class="w-3 h-3 bg-red-500 rounded-full animate-pulse"></div>
                <p class="text-3xl font-bold text-red-600">Ditutup</p>
            </div>
            <div class="mt-4 flex items-center gap-2 text-xs text-gray-500">
                <i class="fas fa-lock text-red-500"></i>
                <span>Absensi sedang nonaktif</span>
            </div>
        @endif
    </div>

</div>

@endsection
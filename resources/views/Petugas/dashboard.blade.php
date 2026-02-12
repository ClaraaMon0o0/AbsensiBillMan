@extends('layouts.petugas')

@section('content')

<div class="flex items-center gap-3 mb-8">
    <div class="w-10 h-10 bg-gradient-to-br from-[#0B2D45]/10 to-[#155E76]/10 rounded-xl flex items-center justify-center border border-[#155E76]/20">
        <i class="fas fa-chart-pie text-[#155E76] text-lg"></i>
    </div>
    <div>
        <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Dashboard Petugas</h1>
        <p class="text-sm text-gray-500 mt-1">Ringkasan aktivitas absensi anda</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    {{-- Status Hari Ini --}}
    <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-all duration-300">
        <div class="flex items-center justify-between mb-4">
            <div class="w-10 h-10 bg-[#0B2D45]/10 rounded-xl flex items-center justify-center">
                <i class="fas fa-calendar-day text-[#155E76] text-lg"></i>
            </div>
            <span class="text-xs font-medium text-gray-400 uppercase tracking-wider">Hari Ini</span>
        </div>
        
        <h3 class="text-sm font-medium text-gray-500 mb-3">Status Kehadiran</h3>
        
        @if($sudahAbsen)
            <div class="flex items-center gap-3 p-4 bg-gradient-to-r from-green-50 to-emerald-50/50 rounded-xl border border-green-100">
                <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center shadow-sm shadow-green-500/20">
                    <i class="fas fa-check text-white text-lg"></i>
                </div>
                <div>
                    <span class="text-sm font-medium text-gray-600">Status</span>
                    <p class="text-lg font-bold text-green-600">Sudah Absen</p>
                </div>
            </div>
        @else
            <div class="flex flex-col gap-4">
                <div class="flex items-center gap-3 p-4 bg-gradient-to-r from-yellow-50 to-amber-50/50 rounded-xl border border-yellow-100">
                    <div class="w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center shadow-sm shadow-yellow-500/20">
                        <i class="fas fa-clock text-white text-lg"></i>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-600">Status</span>
                        <p class="text-lg font-bold text-yellow-600">Belum Absen</p>
                    </div>
                </div>
                
                <a href="{{ route('petugas.absensi.create') }}" 
                   class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-[#0B2D45] to-[#155E76] text-white px-5 py-3 rounded-xl hover:from-[#155E76] hover:to-[#1A7A8C] transition-all duration-300 shadow-md shadow-[#0B2D45]/20 text-sm font-medium group">
                    <i class="fas fa-camera group-hover:scale-110 transition-transform"></i>
                    <span>Absen Sekarang</span>
                    <i class="fas fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
        @endif
    </div>

    {{-- Total Absensi --}}
    <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-all duration-300">
        <div class="flex items-center justify-between mb-4">
            <div class="w-10 h-10 bg-[#0B2D45]/10 rounded-xl flex items-center justify-center">
                <i class="fas fa-clipboard-list text-[#155E76] text-lg"></i>
            </div>
            <span class="text-xs font-medium text-gray-400 uppercase tracking-wider">Riwayat</span>
        </div>
        
        <h3 class="text-sm font-medium text-gray-500 mb-2">Total Absensi</h3>
        
        <div class="flex items-baseline gap-2">
            <p class="text-4xl font-bold text-[#0B2D45]">{{ $totalAbsensi }}</p>
            <span class="text-sm text-gray-400">kali</span>
        </div>
        
        <div class="mt-4 flex items-center gap-2 text-xs text-gray-500">
            <i class="fas fa-calendar-alt text-[#155E76]"></i>
            <span>Sepanjang masa kerja</span>
        </div>
    </div>

    {{-- Absensi Terakhir --}}
    <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-all duration-300">
        <div class="flex items-center justify-between mb-4">
            <div class="w-10 h-10 bg-[#0B2D45]/10 rounded-xl flex items-center justify-center">
                <i class="fas fa-clock-rotate-left text-[#155E76] text-lg"></i>
            </div>
            <span class="text-xs font-medium text-gray-400 uppercase tracking-wider">Terakhir</span>
        </div>
        
        <h3 class="text-sm font-medium text-gray-500 mb-2">Absensi Terakhir</h3>
        
        @if($absensiTerakhir)
            <div class="flex flex-col gap-3">
                <div class="flex items-center gap-2">
                    <i class="fas fa-calendar text-gray-400 text-sm"></i>
                    <span class="text-base font-semibold text-gray-800">{{ \Carbon\Carbon::parse($absensiTerakhir->tanggal)->format('d M Y') }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="fas fa-tag text-gray-400 text-sm"></i>
                    <x-badge :type="$absensiTerakhir->status" />
                </div>
                <div class="flex items-center gap-2 text-xs text-gray-500">
                    <i class="fas fa-clock text-gray-400"></i>
                    <span>{{ \Carbon\Carbon::parse($absensiTerakhir->tanggal)->diffForHumans() }}</span>
                </div>
            </div>
        @else
            <div class="flex flex-col items-center justify-center py-6">
                <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mb-3">
                    <i class="fas fa-history text-gray-400 text-xl"></i>
                </div>
                <p class="text-sm text-gray-400">Belum ada data absensi</p>
            </div>
        @endif
    </div>

</div>

@endsection
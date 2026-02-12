@extends('layouts.admin')

@section('content')

<div class="flex items-center gap-3 mb-6">
    <div class="w-10 h-10 bg-gradient-to-br from-[#0B2D45]/10 to-[#155E76]/10 rounded-xl flex items-center justify-center border border-[#155E76]/20">
        <i class="fas fa-sliders-h text-[#155E76] text-lg"></i>
    </div>
    <div>
        <h1 class="text-xl font-bold text-gray-800 tracking-tight">Pengaturan Absensi</h1>
        <p class="text-xs text-gray-500 mt-0.5">Atur status absensi Petugas</p>
    </div>
</div>

<x-card>
    <div class="py-6">
        @php
            $isOpen = $setting?->is_open ?? false;
        @endphp

        <!-- Status Card Modern -->
        <div class="max-w-xl mx-auto">
            <div class="relative">
                <!-- Background Decoration -->
                <div class="absolute inset-0 bg-gradient-to-r from-[#0B2D45]/5 to-[#155E76]/5 rounded-2xl blur-lg"></div>
                
                <!-- Main Status Card -->
                <div class="relative bg-white rounded-2xl border border-gray-100 p-6 shadow-lg">
                    <div class="flex flex-col items-center text-center">
                        <!-- Icon Container -->
                        <div class="mb-4 relative">
                            <div class="absolute inset-0 bg-gradient-to-r from-yellow-400/20 to-yellow-500/20 rounded-full blur-md"></div>
                            <div class="relative w-20 h-20 rounded-xl bg-gradient-to-br from-[#0B2D45] to-[#155E76] flex items-center justify-center shadow-md shadow-[#0B2D45]/20">
                                @if($isOpen)
                                    <i class="fas fa-lock-open text-yellow-400 text-3xl"></i>
                                @else
                                    <i class="fas fa-lock text-yellow-400 text-3xl"></i>
                                @endif
                            </div>
                        </div>

                        <!-- Status Label -->
                        <div class="mb-4">
                            <span class="text-xs font-medium text-gray-400 uppercase tracking-wider">Status Absensi</span>
                            <div class="flex items-center justify-center gap-2 mt-2">
                                <div class="w-2 h-2 rounded-full {{ $isOpen ? 'bg-green-500' : 'bg-red-500' }} animate-pulse"></div>
                                <span class="text-2xl font-bold {{ $isOpen ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $isOpen ? 'Akses Dibuka' : 'Akses Ditutup' }}
                                </span>
                            </div>
                        </div>

                        <!-- Info Text -->
                        <p class="text-gray-500 text-xs mb-6 max-w-md">
                            @if($isOpen)
                                <i class="fas fa-info-circle text-blue-500 mr-1"></i>
                                Petugas dapat melakukan absensi saat ini
                            @else
                                <i class="fas fa-info-circle text-gray-400 mr-1"></i>
                                Absensi sedang tidak tersedia untuk karyawan
                            @endif
                        </p>

                        <!-- Divider -->
                        <div class="w-full border-t border-gray-100 my-4"></div>

                        <!-- Action Button -->
                        <form method="POST" action="{{ route('admin.settings.toggle') }}" class="w-full max-w-xs">
                            @csrf
                            
                            @if($isOpen)
                                <button type="submit"
                                    class="w-full bg-gradient-to-r from-red-500 to-red-600 text-white px-6 py-3 rounded-xl hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-md shadow-red-500/30 flex items-center justify-center gap-2 font-semibold text-sm group">
                                    <i class="fas fa-times-circle group-hover:rotate-90 transition-transform duration-300"></i>
                                    <span>Tutup Absensi</span>
                                </button>
                            @else
                                <button type="submit"
                                    class="w-full bg-gradient-to-r from-[#0B2D45] to-[#155E76] text-white px-6 py-3 rounded-xl hover:from-[#155E76] hover:to-[#1A7A8C] transition-all duration-300 shadow-md shadow-[#0B2D45]/30 flex items-center justify-center gap-2 font-semibold text-sm group">
                                    <i class="fas fa-check-circle group-hover:scale-110 transition-transform duration-300"></i>
                                    <span>Buka Absensi</span>
                                </button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-card>

@endsection
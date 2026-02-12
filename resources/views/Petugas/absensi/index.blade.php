@extends('layouts.petugas')

@section('content')

<div class="flex items-center gap-3 mb-8">
    <div class="w-10 h-10 bg-[#0B2D45]/10 rounded-xl flex items-center justify-center">
        <i class="fas fa-history text-[#155E76] text-lg"></i>
    </div>
    <h1 class="text-2xl font-semibold text-gray-800 tracking-tight">Riwayat Absensi</h1>
</div>

<x-card>
    {{-- FILTER --}}
    <div class="mb-8 p-5 bg-gray-50/80 rounded-2xl border border-gray-100">
        <form method="GET" action="{{ route('petugas.absensi.index') }}" class="flex flex-wrap items-end gap-4">
            <div class="space-y-1.5">
                <label class="text-xs font-medium text-gray-500 uppercase tracking-wider ml-1">Tanggal</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="far fa-calendar text-gray-400 text-sm"></i>
                    </div>
                    <input type="date"
                           name="tanggal"
                           value="{{ request('tanggal') }}"
                           class="pl-10 pr-4 py-2.5 bg-white border border-gray-200 rounded-xl focus:border-[#155E76] focus:ring-2 focus:ring-[#155E76]/20 transition-all text-sm">
                </div>
            </div>

            <div class="space-y-1.5">
                <label class="text-xs font-medium text-gray-500 uppercase tracking-wider ml-1">Status</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-filter text-gray-400 text-sm"></i>
                    </div>
                    <select name="status" 
                            class="pl-10 pr-8 py-2.5 bg-white border border-gray-200 rounded-xl focus:border-[#155E76] focus:ring-2 focus:ring-[#155E76]/20 transition-all text-sm appearance-none">
                        <option value="">Semua Status</option>
                        <option value="Hadir" {{ request('status')=='Hadir'?'selected':'' }}>Hadir</option>
                        <option value="Izin" {{ request('status')=='Izin'?'selected':'' }}>Izin</option>
                        <option value="Sakit" {{ request('status')=='Sakit'?'selected':'' }}>Sakit</option>
                        <option value="Cuti" {{ request('status')=='Cuti'?'selected':'' }}>Cuti</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <button type="submit"
                        class="bg-[#155E76] text-white px-6 py-2.5 rounded-xl hover:bg-[#1A7A8C] transition-all duration-300 shadow-md shadow-[#155E76]/20 flex items-center gap-2 text-sm font-medium">
                    <i class="fas fa-search"></i>
                    <span>Filter</span>
                </button>
                
                @if(request('tanggal') || request('status'))
                <a href="{{ route('petugas.absensi.index') }}" 
                   class="px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-gray-600 hover:bg-gray-50 transition-all text-sm flex items-center gap-2">
                    <i class="fas fa-times"></i>
                    <span>Reset</span>
                </a>
                @endif
            </div>
        </form>
    </div>

    {{-- TABLE --}}
    <div class="overflow-x-auto rounded-xl border border-gray-200">
        <table class="w-full">
            <thead>
                <tr class="bg-gradient-to-r from-gray-50 to-white border-b border-gray-200">
                    <th class="px-5 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal</th>
                    <th class="px-5 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kegiatan</th>
                    <th class="px-5 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Keterangan</th>
                    <th class="px-5 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Foto</th>
                    <th class="px-5 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @forelse($absensis as $absen)
                <tr class="hover:bg-gray-50/80 transition-colors">
                    <td class="px-5 py-4">
                        <span class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($absen->tanggal)->format('d M Y') }}</span>
                    </td>

                    <td class="px-5 py-4">
                        <span class="text-sm font-medium text-gray-800">{{ $absen->kegiatan }}</span>
                    </td>

                    <td class="px-5 py-4">
                        @if($absen->keterangan)
                            <span class="text-sm text-gray-600">{{ $absen->keterangan }}</span>
                        @else
                            <span class="text-sm text-gray-400">-</span>
                        @endif
                    </td>

                    <td class="px-5 py-4">
                        @if($absen->foto_path)
                            <a href="{{ asset('storage/' . $absen->foto_path) }}" target="_blank" 
                               class="block w-12 h-12 rounded-lg border border-gray-200 overflow-hidden hover:ring-2 hover:ring-[#155E76] hover:ring-offset-2 transition-all">
                                <img src="{{ asset('storage/' . $absen->foto_path) }}"
                                     class="w-full h-full object-cover">
                            </a>
                        @else
                            <span class="text-sm text-gray-400">-</span>
                        @endif
                    </td>

                    <td class="px-5 py-4">
                        <x-badge :type="$absen->status"/>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-5 py-12 text-center">
                        <div class="flex flex-col items-center gap-3">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-history text-gray-400 text-2xl"></i>
                            </div>
                            <p class="text-gray-500 font-medium">Tidak ada riwayat absensi</p>
                            <p class="text-sm text-gray-400">Belum ada catatan absensi untuk ditampilkan</p>
                            <a href="{{ route('petugas.absensi.create') }}" 
                               class="mt-2 inline-flex items-center gap-2 bg-gradient-to-r from-[#0B2D45] to-[#155E76] text-white px-5 py-2.5 rounded-xl hover:from-[#155E76] hover:to-[#1A7A8C] transition-all duration-300 shadow-md shadow-[#0B2D45]/20 text-sm font-medium">
                                <i class="fas fa-camera"></i>
                                <span>Absen Sekarang</span>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- PAGINATION --}}
    @if(method_exists($absensis, 'links'))
        <div class="mt-6 flex justify-end">
            {{ $absensis->withQueryString()->links() }}
        </div>
    @endif

</x-card>

@endsection
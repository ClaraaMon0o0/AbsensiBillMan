@extends('layouts.admin')

@section('content')

<h1 class="text-2xl font-bold mb-6">Monitoring Absensi</h1>

<x-card>

    {{-- FILTER + EXPORT --}}
    <div class="flex justify-between items-center mb-6 flex-wrap gap-4">

        {{-- FILTER --}}
        <form method="GET" action="{{ route('admin.absensi') }}" class="flex gap-4 flex-wrap">

            <input type="date"
                   name="tanggal"
                   value="{{ request('tanggal') }}"
                   class="border p-2 rounded">

            <select name="status"
                    class="border p-2 rounded">

                <option value="">Semua Status</option>
                <option value="Hadir" {{ request('status')=='Hadir'?'selected':'' }}>Hadir</option>
                <option value="Izin" {{ request('status')=='Izin'?'selected':'' }}>Izin</option>
                <option value="Sakit" {{ request('status')=='Sakit'?'selected':'' }}>Sakit</option>
                <option value="Cuti" {{ request('status')=='Cuti'?'selected':'' }}>Cuti</option>
            </select>

            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded">
                Filter
            </button>
        </form>

        {{-- EXPORT --}}
        <form method="GET"
              action="{{ route('admin.absensi.export') }}">

            <input type="hidden" name="tanggal" value="{{ request('tanggal') }}">

            <button type="submit"
                    class="bg-green-600 text-white px-4 py-2 rounded">
                Download Excel
            </button>
        </form>

    </div>

    {{-- TABLE --}}
    <div class="overflow-x-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-3">Nama</th>
                    <th class="p-3">Tanggal</th>
                    <th class="p-3">Kegiatan</th>
                    <th class="p-3">Keterangan</th>
                    <th class="p-3">Foto</th>
                    <th class="p-3">Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse($absensis as $absen)
                <tr class="border-b hover:bg-gray-50">

                    <td class="p-3">
                        {{ $absen->user->name }}
                    </td>

                    <td class="p-3">
                        {{ \Carbon\Carbon::parse($absen->tanggal)->format('d-m-Y') }}
                    </td>

                    <td class="p-3">
                        {{ $absen->kegiatan }}
                    </td>

                    <td class="p-3">
                        {{ $absen->keterangan ?? '-' }}
                    </td>

                    <td class="p-3">
                        @if($absen->foto_path)
                            <a href="{{ asset('storage/' . $absen->foto_path) }}" target="_blank">
                                <img src="{{ asset('storage/' . $absen->foto_path) }}"
                                     class="w-16 h-16 object-cover rounded border hover:scale-105 transition">
                            </a>
                        @else
                            -
                        @endif
                    </td>

                    <td class="p-3">
                        <x-badge :type="$absen->status"/>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center p-6 text-gray-500">
                        Tidak ada data absensi.
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    {{-- PAGINATION --}}
    @if(method_exists($absensis, 'links'))
        <div class="mt-6">
            {{ $absensis->withQueryString()->links() }}
        </div>
    @endif

</x-card>

@endsection

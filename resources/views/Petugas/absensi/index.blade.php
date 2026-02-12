@extends('layouts.petugas')

@section('content')

<h1 class="text-2xl font-bold mb-6">Riwayat Absensi</h1>

<x-card>

<table class="w-full">
    <thead>
        <tr class="bg-gray-100 text-left">
            <th class="p-3">Tanggal</th>
            <th class="p-3">Kegiatan</th>
            <th class="p-3">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($absensis as $absen)
        <tr class="border-b">
            <td class="p-3">{{ $absen->tanggal }}</td>
            <td class="p-3">{{ $absen->kegiatan }}</td>
            <td class="p-3">
                <x-badge :type="$absen->status"/>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</x-card>

@endsection

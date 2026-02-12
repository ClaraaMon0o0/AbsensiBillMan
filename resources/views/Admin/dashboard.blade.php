@extends('layouts.admin')

@section('content')

<h1 class="text-2xl font-bold mb-6">Dashboard Admin</h1>

<div class="grid grid-cols-3 gap-6">

    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-gray-500">Total Petugas</h3>
        <p class="text-3xl font-bold">{{ $totalPetugas }}</p>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-gray-500">Absensi Hari Ini</h3>
        <p class="text-3xl font-bold">{{ $totalAbsensiHariIni }}</p>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-gray-500">Status Absensi</h3>
        <p class="text-3xl font-bold">
            {{ $isOpen ? 'DIBUKA' : 'DITUTUP' }}
        </p>
    </div>

</div>

@endsection

@extends('layouts.admin')

@section('content')

<h1 class="text-2xl font-bold mb-6">Tambah User</h1>

<x-card>

<form method="POST" action="{{ route('admin.users.store') }}">
@csrf

<div class="mb-4">
    <label class="block mb-1">Nama</label>
    <input type="text" name="name" class="w-full border p-2 rounded" required>
</div>

<div class="mb-4">
    <label class="block mb-1">Email</label>
    <input type="email" name="email" class="w-full border p-2 rounded" required>
</div>

<div class="mb-4">
    <label class="block mb-1">Password</label>
    <input type="password" name="password" class="w-full border p-2 rounded" required>
</div>

<div class="mb-6">
    <label class="block mb-1">Role</label>
    <select name="role" class="w-full border p-2 rounded" required>
        <option value="admin">Admin</option>
        <option value="petugas">Petugas</option>
    </select>
</div>

<button class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
    Simpan
</button>

</form>

</x-card>

@endsection

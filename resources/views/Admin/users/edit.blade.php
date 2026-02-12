@extends('layouts.admin')

@section('content')

<h1 class="text-2xl font-bold mb-6">Edit User</h1>

<x-card>

<form method="POST" 
      action="{{ route('admin.users.update', $user) }}"
      onsubmit="return confirm('Apakah Anda yakin ingin memperbarui data user {{ $user->name }}?')">
@csrf
@method('PUT')

<div class="mb-4">
    <label class="block mb-1">Nama</label>
    <input type="text" name="name"
           value="{{ $user->name }}"
           class="w-full border p-2 rounded" required>
</div>

<div class="mb-4">
    <label class="block mb-1">Email</label>
    <input type="email" name="email"
           value="{{ $user->email }}"
           class="w-full border p-2 rounded" required>
</div>

<div class="mb-6">
    <label class="block mb-1">Role</label>
    <select name="role" class="w-full border p-2 rounded">
        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>
            Admin
        </option>
        <option value="petugas" {{ $user->role === 'petugas' ? 'selected' : '' }}>
            Petugas
        </option>
    </select>
</div>

<button type="submit"
        class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
    Update
</button>

</form>

</x-card>

@endsection

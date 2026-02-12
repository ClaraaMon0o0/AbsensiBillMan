@extends('layouts.admin')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Manajemen User</h1>
    <a href="{{ route('admin.users.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        + Tambah User
    </a>
</div>

<x-card>

@if($users->count() > 0)

<div class="overflow-x-auto">
    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="p-3">Nama</th>
                <th class="p-3">Email</th>
                <th class="p-3">Role</th>
                <th class="p-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3">{{ $user->name }}</td>
                <td class="p-3">{{ $user->email }}</td>
                <td class="p-3">
                    <span class="px-3 py-1 rounded-full text-sm font-medium
                        {{ $user->role === 'admin'
                            ? 'bg-purple-100 text-purple-700'
                            : 'bg-blue-100 text-blue-700' }}">
                        {{ ucfirst($user->role) }}
                    </span>
                </td>
                <td class="p-3 flex gap-2">
                    <a href="{{ route('admin.users.edit', $user) }}"
                       class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600">
                        Edit
                    </a>

                    <form action="{{ route('admin.users.destroy', $user) }}"
                          method="POST"
                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus user {{ $user->name }}?\n\nData yang sudah dihapus tidak dapat dikembalikan!')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $users->links() }}
</div>

@else

<div class="text-center py-10 text-gray-500">
    Belum ada user terdaftar.
</div>

@endif

</x-card>

@endsection

@extends('layouts.admin')

@section('content')

<div class="flex items-center justify-between mb-8">
    <div class="flex items-center gap-3">
        <div class="w-10 h-10 bg-[#0B2D45]/10 rounded-xl flex items-center justify-center">
            <i class="fas fa-users text-[#155E76] text-lg"></i>
        </div>
        <h1 class="text-2xl font-semibold text-gray-800 tracking-tight">Manajemen User</h1>
    </div>
    
    <a href="{{ route('admin.users.create') }}"
       class="bg-gradient-to-r from-[#0B2D45] to-[#155E76] text-white px-5 py-2.5 rounded-xl hover:from-[#155E76] hover:to-[#1A7A8C] transition-all duration-300 shadow-lg shadow-[#0B2D45]/20 flex items-center gap-2 text-sm font-medium">
        <i class="fas fa-plus"></i>
        <span>Tambah Petugas</span>
    </a>
</div>

<x-card>
    @if($users->count() > 0)

    <div class="overflow-x-auto rounded-xl border border-gray-200">
        <table class="w-full">
            <thead>
                <tr class="bg-gradient-to-r from-gray-50 to-white border-b border-gray-200">
                    <th class="px-5 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama</th>
                    <th class="px-5 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                    <th class="px-5 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Role</th>
                    <th class="px-5 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($users as $user)
                <tr class="hover:bg-gray-50/80 transition-colors">
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 bg-gradient-to-br from-[#0B2D45] to-[#155E76] rounded-full flex items-center justify-center shadow-sm">
                                <span class="text-white font-medium text-sm">{{ substr($user->name, 0, 1) }}</span>
                            </div>
                            <span class="text-sm font-medium text-gray-800">{{ $user->name }}</span>
                        </div>
                    </td>
                    
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-envelope text-gray-400 text-xs"></i>
                            <span class="text-sm text-gray-600">{{ $user->email }}</span>
                        </div>
                    </td>
                    
                    <td class="px-5 py-4">
                        @if($user->role === 'admin')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-medium bg-purple-50 text-purple-700 border border-purple-200">
                            <i class="fas fa-crown text-purple-500 text-xs"></i>
                            {{ ucfirst($user->role) }}
                        </span>
                        @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-medium bg-blue-50 text-[#155E76] border border-blue-200">
                            <i class="fas fa-user text-[#155E76] text-xs"></i>
                            {{ ucfirst($user->role) }}
                        </span>
                        @endif
                    </td>
                    
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.users.edit', $user) }}"
                               class="inline-flex items-center gap-1.5 bg-yellow-50 text-yellow-600 px-3 py-1.5 rounded-lg text-xs font-medium hover:bg-yellow-100 transition-colors border border-yellow-200">
                                <i class="fas fa-edit"></i>
                                Edit
                            </a>

                            <form action="{{ route('admin.users.destroy', $user) }}"
                                  method="POST"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus user {{ $user->name }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center gap-1.5 bg-red-50 text-red-600 px-3 py-1.5 rounded-lg text-xs font-medium hover:bg-red-100 transition-colors border border-red-200">
                                    <i class="fas fa-trash"></i>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6 flex justify-end">
        {{ $users->links() }}
    </div>

    @else
    <div class="text-center py-16">
        <div class="flex flex-col items-center gap-4">
            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center">
                <i class="fas fa-users text-gray-400 text-3xl"></i>
            </div>
            <div>
                <p class="text-gray-600 font-medium text-lg">Belum ada user terdaftar</p>
                <p class="text-sm text-gray-400 mt-1">Mulai dengan menambahkan user baru</p>
            </div>
            <a href="{{ route('admin.users.create') }}" 
               class="mt-2 inline-flex items-center gap-2 bg-[#155E76] text-white px-6 py-2.5 rounded-xl hover:bg-[#1A7A8C] transition-all duration-300 shadow-md shadow-[#155E76]/20 text-sm font-medium">
                <i class="fas fa-plus"></i>
                Tambah Petugas Pertama
            </a>
        </div>
    </div>
    @endif
</x-card>

@endsection
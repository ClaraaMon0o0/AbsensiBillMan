@extends('layouts.admin')

@section('content')

<div class="flex items-center justify-between mb-8">
    <div class="flex items-center gap-3">
        <div class="w-12 h-12 bg-gradient-to-br from-[#0B2D45]/10 to-[#155E76]/10 rounded-xl flex items-center justify-center border border-[#155E76]/20">
            <i class="fas fa-users-cog text-[#155E76] text-xl"></i>
        </div>
        <div>
            <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Manajemen User</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola data petugas dan administrator</p>
        </div>
    </div>
    
    <a href="{{ route('admin.users.create') }}"
       class="bg-gradient-to-r from-[#0B2D45] to-[#155E76] text-white px-6 py-3 rounded-xl hover:from-[#155E76] hover:to-[#1A7A8C] transition-all duration-300 shadow-lg shadow-[#0B2D45]/30 flex items-center gap-2.5 text-sm font-semibold group">
        <div class="w-6 h-6 bg-white/20 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
            <i class="fas fa-plus text-white text-xs"></i>
        </div>
        <span>Tambah Petugas</span>
    </a>
</div>

<x-card>
    @if($users->count() > 0)

    <!-- Search & Filter Bar -->
    <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400 text-sm"></i>
                </div>
                <input type="text" 
                       placeholder="Cari user..." 
                       class="pl-10 pr-4 py-2.5 bg-white border border-gray-200 rounded-xl focus:border-[#155E76] focus:ring-2 focus:ring-[#155E76]/20 transition-all text-sm w-64">
            </div>
            <select class="px-4 py-2.5 bg-white border border-gray-200 rounded-xl focus:border-[#155E76] focus:ring-2 focus:ring-[#155E76]/20 transition-all text-sm appearance-none">
                <option>Semua Role</option>
                <option>Admin</option>
                <option>Petugas</option>
            </select>
        </div>
        <div class="text-sm text-gray-500">
            <i class="fas fa-database mr-1"></i> Total: {{ $users->total() }} user
        </div>
    </div>

    <div class="overflow-x-auto rounded-xl border border-gray-200">
        <table class="w-full">
            <thead>
                <tr class="bg-gradient-to-r from-gray-50 to-white border-b border-gray-200">
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Role</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Terdaftar</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($users as $user)
                <tr class="hover:bg-gray-50/80 transition-colors group">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="relative">
                                <div class="w-10 h-10 bg-gradient-to-br from-[#0B2D45] to-[#155E76] rounded-xl flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                                    <span class="text-white font-semibold text-sm">{{ substr($user->name, 0, 1) }}</span>
                                </div>
                                @if($user->role === 'admin')
                                <div class="absolute -top-1 -right-1 w-4 h-4 bg-yellow-400 rounded-full flex items-center justify-center border-2 border-white">
                                    <i class="fas fa-crown text-[#0B2D45] text-[8px]"></i>
                                </div>
                                @endif
                            </div>
                            <div>
                                <span class="text-sm font-semibold text-gray-800">{{ $user->name }}</span>
                                @if($user->id === auth()->id())
                                    <span class="ml-2 text-[10px] font-medium bg-blue-100 text-[#155E76] px-2 py-0.5 rounded-full">Anda</span>
                                @endif
                            </div>
                        </div>
                    </td>
                    
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <div class="w-6 h-6 bg-gray-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-envelope text-gray-500 text-xs"></i>
                            </div>
                            <span class="text-sm text-gray-600">{{ $user->email }}</span>
                        </div>
                    </td>
                    
                    <td class="px-6 py-4">
                        @if($user->role === 'admin')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-gradient-to-r from-purple-50 to-purple-100 text-purple-700 border border-purple-200 shadow-sm">
                            <i class="fas fa-crown text-purple-500 text-xs"></i>
                            Administrator
                        </span>
                        @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-gradient-to-r from-blue-50 to-blue-100 text-[#155E76] border border-blue-200 shadow-sm">
                            <i class="fas fa-user-tie text-[#155E76] text-xs"></i>
                            Petugas
                        </span>
                        @endif
                    </td>
                    
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-calendar-alt text-gray-400 text-xs"></i>
                            <span class="text-xs text-gray-500">{{ $user->created_at->format('d M Y') }}</span>
                        </div>
                    </td>
                    
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            @if($user->id !== auth()->id())
                            <a href="{{ route('admin.users.edit', $user) }}"
                               class="inline-flex items-center gap-1.5 bg-gradient-to-r from-yellow-50 to-yellow-100 text-yellow-700 px-3 py-2 rounded-lg text-xs font-semibold hover:from-yellow-100 hover:to-yellow-200 transition-all duration-300 border border-yellow-300 shadow-sm hover:shadow-md">
                                <i class="fas fa-pen"></i>
                                Edit
                            </a>

                            <form action="{{ route('admin.users.destroy', $user) }}"
                                  method="POST"
                                  onsubmit="return confirm('⚠️ Apakah Anda yakin ingin menghapus user {{ $user->name }}?\n\nData yang sudah dihapus tidak dapat dikembalikan!')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center gap-1.5 bg-gradient-to-r from-red-50 to-red-100 text-red-700 px-3 py-2 rounded-lg text-xs font-semibold hover:from-red-100 hover:to-red-200 transition-all duration-300 border border-red-300 shadow-sm hover:shadow-md">
                                    <i class="fas fa-trash-alt"></i>
                                    Hapus
                                </button>
                            </form>
                            @else
                            <span class="inline-flex items-center gap-1.5 bg-gray-100 text-gray-500 px-3 py-2 rounded-lg text-xs font-semibold border border-gray-200">
                                <i class="fas fa-shield-alt"></i>
                                Current User
                            </span>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6 flex items-center justify-between">
        <div class="text-sm text-gray-500">
            Menampilkan {{ $users->firstItem() }} - {{ $users->lastItem() }} dari {{ $users->total() }} user
        </div>
        <div>
            {{ $users->links() }}
        </div>
    </div>

    @else
    <div class="text-center py-16 px-4">
        <div class="relative inline-block">
            <div class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center shadow-inner">
                <i class="fas fa-users-slash text-gray-500 text-4xl"></i>
            </div>
            <div class="absolute -top-2 -right-2 w-8 h-8 bg-[#155E76] rounded-full flex items-center justify-center border-4 border-white">
                <i class="fas fa-plus text-white text-xs"></i>
            </div>
        </div>
        <h3 class="text-xl font-bold text-gray-800 mt-6">Belum Ada User Terdaftar</h3>
        <p class="text-sm text-gray-500 mt-2 max-w-md mx-auto">
            Mulai kelola sistem absensi dengan menambahkan petugas atau administrator pertama Anda.
        </p>
        <div class="flex items-center justify-center gap-4 mt-8">
            <a href="{{ route('admin.users.create') }}" 
               class="inline-flex items-center gap-2.5 bg-gradient-to-r from-[#0B2D45] to-[#155E76] text-white px-6 py-3.5 rounded-xl hover:from-[#155E76] hover:to-[#1A7A8C] transition-all duration-300 shadow-lg shadow-[#0B2D45]/30 text-sm font-semibold group">
                <div class="w-6 h-6 bg-white/20 rounded-lg flex items-center justify-center group-hover:rotate-90 transition-transform">
                    <i class="fas fa-plus text-white text-xs"></i>
                </div>
                <span>Tambah User Pertama</span>
            </a>
            <a href="#" class="inline-flex items-center gap-2 bg-white text-gray-600 px-6 py-3.5 rounded-xl hover:bg-gray-50 transition-all duration-300 border border-gray-200 text-sm font-semibold">
                <i class="fas fa-book-open"></i>
                <span>Pelajari Lebih Lanjut</span>
            </a>
        </div>
    </div>
    @endif
</x-card>

@endsection
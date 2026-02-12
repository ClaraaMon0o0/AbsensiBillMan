@extends('layouts.admin')

@section('content')

<div class="flex items-center gap-3 mb-8">
    <div class="w-12 h-12 bg-gradient-to-br from-[#0B2D45]/10 to-[#155E76]/10 rounded-xl flex items-center justify-center border border-[#155E76]/20">
        <i class="fas fa-user-edit text-[#155E76] text-xl"></i>
    </div>
    <div>
        <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Edit User</h1>
        <p class="text-sm text-gray-500 mt-1">Memperbarui data user: <span class="font-semibold text-[#155E76]">{{ $user->name }}</span></p>
    </div>
</div>

<x-card>
    <form method="POST" 
          action="{{ route('admin.users.update', $user) }}"
          onsubmit="return confirm('⚠️ Apakah Anda yakin ingin memperbarui data user {{ $user->name }}?\n\nPastikan data yang dimasukkan sudah benar.')"
          class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Nama -->
        <div class="space-y-2">
            <label class="text-sm font-semibold text-gray-700 ml-1 flex items-center gap-2">
                <div class="w-5 h-5 bg-[#0B2D45]/10 rounded-lg flex items-center justify-center">
                    <i class="fas fa-user text-[#155E76] text-xs"></i>
                </div>
                Nama Lengkap
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fas fa-user-circle text-gray-400 text-sm"></i>
                </div>
                <input type="text" 
                       name="name"
                       value="{{ old('name', $user->name) }}"
                       placeholder="Masukkan nama lengkap"
                       class="w-full pl-10 pr-4 py-3 bg-white border border-gray-200 rounded-xl focus:border-[#155E76] focus:ring-2 focus:ring-[#155E76]/20 transition-all text-sm @error('name') border-red-500 @enderror"
                       required>
            </div>
            @error('name')
                <p class="text-red-500 text-xs mt-1 flex items-center gap-1">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Email -->
        <div class="space-y-2">
            <label class="text-sm font-semibold text-gray-700 ml-1 flex items-center gap-2">
                <div class="w-5 h-5 bg-[#0B2D45]/10 rounded-lg flex items-center justify-center">
                    <i class="fas fa-envelope text-[#155E76] text-xs"></i>
                </div>
                Alamat Email
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fas fa-envelope text-gray-400 text-sm"></i>
                </div>
                <input type="email" 
                       name="email"
                       value="{{ old('email', $user->email) }}"
                       placeholder="nama@email.com"
                       class="w-full pl-10 pr-4 py-3 bg-white border border-gray-200 rounded-xl focus:border-[#155E76] focus:ring-2 focus:ring-[#155E76]/20 transition-all text-sm @error('email') border-red-500 @enderror"
                       required>
            </div>
            @error('email')
                <p class="text-red-500 text-xs mt-1 flex items-center gap-1">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Role -->
        <div class="space-y-2">
            <label class="text-sm font-semibold text-gray-700 ml-1 flex items-center gap-2">
                <div class="w-5 h-5 bg-[#0B2D45]/10 rounded-lg flex items-center justify-center">
                    <i class="fas fa-tag text-[#155E76] text-xs"></i>
                </div>
                Hak Akses (Role)
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fas fa-shield-alt text-gray-400 text-sm"></i>
                </div>
                <select name="role" 
                        class="w-full pl-10 pr-10 py-3 bg-white border border-gray-200 rounded-xl focus:border-[#155E76] focus:ring-2 focus:ring-[#155E76]/20 transition-all text-sm appearance-none @error('role') border-red-500 @enderror"
                        required>
                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }} class="py-2">
                        Administrator
                    </option>
                    <option value="petugas" {{ old('role', $user->role) === 'petugas' ? 'selected' : '' }} class="py-2">
                        Petugas
                    </option>
                </select>
                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                    <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                </div>
            </div>
            @error('role')
                <p class="text-red-500 text-xs mt-1 flex items-center gap-1">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $message }}
                </p>
            @enderror
            
            <!-- Role Description -->
            <div class="mt-2 p-3 bg-gray-50 rounded-lg border border-gray-200">
                <div class="flex items-start gap-2">
                    <i class="fas fa-info-circle text-[#155E76] text-xs mt-0.5"></i>
                    <div class="text-xs text-gray-600">
                        <span class="font-semibold">Administrator:</span> Akses penuh ke semua fitur termasuk manajemen user dan pengaturan
                        <br>
                        <span class="font-semibold mt-1 inline-block">Petugas:</span> Akses terbatas untuk absensi dan riwayat pribadi
                    </div>
                </div>
            </div>
        </div>

        <!-- Info Akun -->
        <div class="bg-gradient-to-r from-blue-50/50 to-indigo-50/50 rounded-xl p-4 border border-blue-100/50">
            <div class="flex items-start gap-3">
                <div class="w-8 h-8 bg-[#155E76]/10 rounded-lg flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-clock text-[#155E76] text-sm"></i>
                </div>
                <div class="space-y-1">
                    <p class="text-xs font-semibold text-gray-700">Informasi Akun</p>
                    <p class="text-xs text-gray-500">
                        <span class="font-medium">Terdaftar:</span> {{ $user->created_at->format('d F Y, H:i') }}
                    </p>
                    <p class="text-xs text-gray-500">
                        <span class="font-medium">Terakhir diperbarui:</span> {{ $user->updated_at->format('d F Y, H:i') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
            <a href="{{ route('admin.users.index') }}" 
               class="px-6 py-3 bg-white border border-gray-200 rounded-xl text-gray-600 hover:bg-gray-50 transition-all duration-300 text-sm font-medium flex items-center gap-2">
                <i class="fas fa-times"></i>
                <span>Batal</span>
            </a>
            
            <button type="submit"
                    class="px-6 py-3 bg-gradient-to-r from-[#0B2D45] to-[#155E76] text-white rounded-xl hover:from-[#155E76] hover:to-[#1A7A8C] transition-all duration-300 shadow-lg shadow-[#0B2D45]/30 text-sm font-semibold flex items-center gap-2 group">
                <i class="fas fa-save group-hover:scale-110 transition-transform"></i>
                <span>Simpan Perubahan</span>
            </button>
        </div>
    </form>
</x-card>

@endsection
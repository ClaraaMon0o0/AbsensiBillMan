@extends('layouts.admin')

@section('content')

<div class="flex items-center gap-3 mb-8">
    <div class="w-12 h-12 bg-gradient-to-br from-[#0B2D45]/10 to-[#155E76]/10 rounded-xl flex items-center justify-center border border-[#155E76]/20">
        <i class="fas fa-user-plus text-[#155E76] text-xl"></i>
    </div>
    <div>
        <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Tambah User</h1>
        <p class="text-sm text-gray-500 mt-1">Buat akun baru untuk petugas atau administrator</p>
    </div>
</div>

<x-card>
    <form method="POST" 
          action="{{ route('admin.users.store') }}"
          onsubmit="return confirm('⚠️ Apakah Anda yakin ingin menambahkan user baru ini?\n\nPastikan semua data sudah benar.')"
          class="space-y-6">
        @csrf

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
                       value="{{ old('name') }}"
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
                       value="{{ old('email') }}"
                       placeholder="nama@absensi.com"
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

        <!-- Password -->
        <div class="space-y-2">
            <label class="text-sm font-semibold text-gray-700 ml-1 flex items-center gap-2">
                <div class="w-5 h-5 bg-[#0B2D45]/10 rounded-lg flex items-center justify-center">
                    <i class="fas fa-lock text-[#155E76] text-xs"></i>
                </div>
                Password
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fas fa-key text-gray-400 text-sm"></i>
                </div>
                <input type="password" 
                       name="password"
                       placeholder="Minimal 8 karakter"
                       class="w-full pl-10 pr-4 py-3 bg-white border border-gray-200 rounded-xl focus:border-[#155E76] focus:ring-2 focus:ring-[#155E76]/20 transition-all text-sm @error('password') border-red-500 @enderror"
                       required>
            </div>
            <p class="text-xs text-gray-400 mt-1 flex items-center gap-1">
                <i class="fas fa-info-circle"></i>
                Gunakan password yang kuat (minimal 8 karakter, kombinasi huruf dan angka)
            </p>
            @error('password')
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
                    <option value="" disabled selected>-- Pilih Hak Akses --</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }} class="py-2">
                        Administrator
                    </option>
                    <option value="petugas" {{ old('role') == 'petugas' ? 'selected' : '' }} class="py-2">
                        Petugas
                    </option>
                </select>
                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                    <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                </div>
            </div>
            
            <!-- Role Description Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-3">
                <div class="p-3 bg-purple-50/50 rounded-lg border border-purple-100 {{ old('role') == 'admin' ? 'ring-2 ring-purple-300' : '' }}">
                    <div class="flex items-start gap-2">
                        <div class="w-6 h-6 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-crown text-purple-600 text-xs"></i>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-purple-700">Administrator</p>
                            <p class="text-[10px] text-purple-600/80 mt-0.5">Akses penuh ke semua fitur, manajemen user, dan pengaturan sistem</p>
                        </div>
                    </div>
                </div>
                <div class="p-3 bg-blue-50/50 rounded-lg border border-blue-100 {{ old('role') == 'petugas' ? 'ring-2 ring-blue-300' : '' }}">
                    <div class="flex items-start gap-2">
                        <div class="w-6 h-6 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-user-tie text-[#155E76] text-xs"></i>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-[#155E76]">Petugas</p>
                            <p class="text-[10px] text-blue-600/80 mt-0.5">Akses terbatas untuk absensi dan riwayat pribadi</p>
                        </div>
                    </div>
                </div>
            </div>
            
            @error('role')
                <p class="text-red-500 text-xs mt-1 flex items-center gap-1">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Password Generator Info -->
        <div class="bg-gradient-to-r from-gray-50 to-gray-100/50 rounded-xl p-4 border border-gray-200">
            <div class="flex items-start gap-3">
                <div class="w-8 h-8 bg-[#155E76]/10 rounded-lg flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-shield-alt text-[#155E76] text-sm"></i>
                </div>
                <div class="space-y-1">
                    <p class="text-xs font-semibold text-gray-700">Rekomendasi Keamanan</p>
                    <p class="text-xs text-gray-500">
                        Password akan dienkripsi secara otomatis. User dapat mengubah password nanti melalui menu edit.
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
                <i class="fas fa-user-plus group-hover:scale-110 transition-transform"></i>
                <span>Tambah User</span>
                <i class="fas fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
            </button>
        </div>
    </form>
</x-card>

@endsection
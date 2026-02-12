<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - AbsensiBillman</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Font Awesome 6 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    {{-- Custom style --}}
    <style>
        * {
            transition: all 0.2s ease;
        }
        
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif !important;
            background: white;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }
        
        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.05);
        }
    </style>
</head>

<body class="min-h-screen flex antialiased bg-white">

    {{-- Sidebar --}}
    <aside class="w-72 bg-gradient-to-br from-[#0B2D45] via-[#155E76] to-[#1A7A8C] text-white shadow-xl flex flex-col relative overflow-hidden">
        
        <div class="absolute inset-0 opacity-5">
            <svg class="w-full h-full" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid" patternUnits="userSpaceOnUse" width="20" height="20">
                        <path d="M 20 0 L 0 0 0 20" fill="none" stroke="white" stroke-width="0.5"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid)"/>
            </svg>
        </div>

        {{-- Logo --}}
        <div class="relative p-8 border-b border-white/10">
            <div class="flex items-center gap-4">
                <div class="w-11 h-11 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-xl flex items-center justify-center shadow-lg shadow-yellow-500/20">
                    <i class="fas fa-bolt text-[#0B2D45] text-xl"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold tracking-tight text-white">
                        Absensi<span class="text-yellow-400">Billman</span>
                    </h2>
                    <p class="text-xs text-white/70 mt-1 font-medium">Admin Panel</p>
                </div>
            </div>
        </div>

        {{-- User Profile Card --}}
        <div class="relative mx-6 mt-6 p-4 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-xl flex items-center justify-center shadow-lg">
                    <span class="text-[#0B2D45] font-bold text-lg">{{ substr(auth()->user()->name ?? 'A', 0, 1) }}</span>
                </div>
                <div class="flex-1">
                    <h3 class="font-semibold text-white">{{ auth()->user()->name ?? 'Admin' }}</h3>
                    <div class="flex items-center gap-1.5 mt-1">
                        <div class="w-1.5 h-1.5 bg-yellow-400 rounded-full"></div>
                        <p class="text-xs text-white/80">Super Administrator</p>
                    </div>
                </div>
                <div class="px-2 py-1 bg-yellow-400/20 rounded-lg border border-yellow-400/30">
                    <i class="fas fa-crown text-yellow-400 text-xs"></i>
                </div>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 p-6 space-y-2 text-sm relative z-10 mt-4">
            
            <a href="{{ route('admin.absensi') }}"
               class="flex items-center gap-4 px-4 py-3 rounded-xl hover:bg-white/10 transition-all duration-300 group">
                <i class="fas fa-camera w-5 text-center text-yellow-400/80 group-hover:text-yellow-400"></i>
                <span class="font-medium text-white/90 group-hover:text-white">Monitoring Absensi</span>
            </a>

            <a href="{{ route('admin.users.index') }}"
               class="flex items-center gap-4 px-4 py-3 rounded-xl hover:bg-white/10 transition-all duration-300 group">
                <i class="fas fa-users w-5 text-center text-yellow-400/80 group-hover:text-yellow-400"></i>
                <span class="font-medium text-white/90 group-hover:text-white">Manajemen Petugas</span>
            </a>

            <a href="{{ route('admin.settings') }}"
               class="flex items-center gap-4 px-4 py-3 rounded-xl hover:bg-white/10 transition-all duration-300 group">
                <i class="fas fa-sliders-h w-5 text-center text-yellow-400/80 group-hover:text-yellow-400"></i>
                <span class="font-medium text-white/90 group-hover:text-white">Pengaturan</span>
            </a>
        </nav>

        {{-- Logout --}}
        <div class="relative p-6 border-t border-white/10">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full bg-gradient-to-r from-yellow-400 to-yellow-500 text-[#0B2D45] font-semibold py-3 px-4 rounded-xl hover:from-yellow-300 hover:to-yellow-400 transition-all duration-300 shadow-lg shadow-yellow-500/20 flex items-center justify-center gap-2 group">
                    <i class="fas fa-sign-out-alt group-hover:translate-x-1 transition-transform"></i>
                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </aside>

    {{-- Main Area --}}
    <div class="flex-1 flex flex-col bg-white">

        {{-- Top Navbar --}}
        <header class="bg-white px-8 py-4 flex justify-between items-center sticky top-0 z-20 border-b border-gray-200">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-[#0B2D45]/10 rounded-xl flex items-center justify-center">
                    <i class="fas fa-chart-pie text-[#155E76] text-lg"></i>
                </div>
                <h1 class="text-2xl font-semibold text-gray-800 tracking-tight">
                    @yield('title', 'Dashboard')
                </h1>
            </div>

            <div class="flex items-center gap-6">
                {{-- Date --}}
                <div class="hidden md:flex items-center gap-2 text-sm text-gray-500 bg-gray-50 px-4 py-2 rounded-full border border-gray-200">
                    <i class="far fa-calendar-alt text-[#155E76]"></i>
                    <span>{{ now()->format('d M Y') }}</span>
                </div>

                {{-- Admin Profile --}}
                <div class="flex items-center gap-3">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-semibold text-gray-800">{{ auth()->user()->name ?? 'Admin' }}</p>
                        <p class="text-xs text-gray-500">Super Administrator</p>
                    </div>
                    <div class="w-10 h-10 bg-gradient-to-br from-[#0B2D45] to-[#155E76] rounded-xl flex items-center justify-center shadow-md">
                        <span class="text-white font-semibold text-sm">{{ substr(auth()->user()->name ?? 'A', 0, 1) }}</span>
                    </div>
                </div>
            </div>
        </header>

        {{-- Content Area --}}
        <main class="flex-1 p-8">
            
            {{-- Flash Message --}}
            @include('components.flash')

            <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
                @yield('content')
            </div>

        </main>

    </div>

</body>
</html>
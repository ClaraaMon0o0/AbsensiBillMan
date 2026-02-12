<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petugas - AbsensiBillman</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Font Awesome 6 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        * {
            transition: all 0.2s ease;
        }
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif !important;
            background: white;
        }
    </style>
</head>
<body class="min-h-screen flex antialiased bg-white">

    {{-- Sidebar --}}
    <aside class="w-72 bg-gradient-to-br from-[#0B2D45] via-[#155E76] to-[#1A7A8C] text-white shadow-xl flex flex-col relative overflow-hidden">
        
        {{-- Background Pattern --}}
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
                    <p class="text-xs text-white/70 mt-1 font-medium">Petugas Panel</p>
                </div>
            </div>
        </div>

        {{-- User Info --}}
        <div class="relative mx-6 mt-6 p-4 bg-white/10 backdrop-blur-sm rounded-xl border border-white/20">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-lg flex items-center justify-center shadow-md">
                    <span class="text-[#0B2D45] font-bold text-sm">{{ substr(auth()->user()->name ?? 'P', 0, 1) }}</span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-white truncate">{{ auth()->user()->name ?? 'Petugas' }}</p>
                    <div class="flex items-center gap-1.5 mt-1">
                        <div class="w-1.5 h-1.5 bg-yellow-400 rounded-full"></div>
                        <p class="text-xs text-white/80">Petugas</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 p-6 space-y-2 text-sm relative z-10 mt-4">
            <div class="text-xs font-semibold text-white/50 uppercase tracking-wider px-4 mb-2">
                Menu
            </div>

            <a href="{{ route('petugas.dashboard') }}" 
               class="flex items-center gap-4 px-4 py-3 rounded-xl hover:bg-white/10 transition-all duration-300 group {{ request()->routeIs('petugas.dashboard') ? 'bg-white/10 border-l-4 border-yellow-400' : '' }}">
                <i class="fas fa-chart-pie w-5 text-center text-yellow-400/80 group-hover:text-yellow-400"></i>
                <span class="font-medium text-white/90 group-hover:text-white">Dashboard</span>
            </a>

            <a href="{{ route('petugas.absensi.index') }}" 
               class="flex items-center gap-4 px-4 py-3 rounded-xl hover:bg-white/10 transition-all duration-300 group {{ request()->routeIs('petugas.absensi.index') ? 'bg-white/10 border-l-4 border-yellow-400' : '' }}">
                <i class="fas fa-history w-5 text-center text-yellow-400/80 group-hover:text-yellow-400"></i>
                <span class="font-medium text-white/90 group-hover:text-white">Riwayat Absensi</span>
            </a>

            <a href="{{ route('petugas.absensi.create') }}" 
               class="flex items-center gap-4 px-4 py-3 rounded-xl hover:bg-white/10 transition-all duration-300 group {{ request()->routeIs('petugas.absensi.create') ? 'bg-white/10 border-l-4 border-yellow-400' : '' }}">
                <i class="fas fa-camera w-5 text-center text-yellow-400/80 group-hover:text-yellow-400"></i>
                <span class="font-medium text-white/90 group-hover:text-white">Absen Hari Ini</span>
            </a>
        </nav>

        {{-- Logout --}}
        <div class="relative p-6 border-t border-white/10">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full bg-gradient-to-r from-red-500/90 to-red-600/90 hover:from-red-500 hover:to-red-600 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300 shadow-lg shadow-red-500/20 flex items-center justify-center gap-2 group backdrop-blur-sm border border-white/10">
                    <i class="fas fa-sign-out-alt group-hover:translate-x-1 transition-transform"></i>
                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </aside>

    {{-- Main Content --}}
    <div class="flex-1 flex flex-col bg-white">
        {{-- Top Bar --}}
        <header class="bg-white/80 backdrop-blur-md px-8 py-4 flex justify-between items-center border-b border-gray-200/60 sticky top-0 z-20 shadow-sm">
            {{-- Left Section: Page Title --}}
            <div class="flex items-center gap-4">
                {{-- Mobile Menu Toggle (hidden on desktop) --}}
                <button class="lg:hidden w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center hover:bg-gray-200 transition-colors">
                    <i class="fas fa-bars text-[#155E76]"></i>
                </button>
                
                {{-- Breadcrumb / Page Icon --}}
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-[#0B2D45]/10 to-[#155E76]/10 rounded-xl flex items-center justify-center border border-[#155E76]/20">
                        <i class="fas fa-calendar-check text-[#155E76] text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-800 tracking-tight">
                            @yield('title', 'Dashboard Petugas')
                        </h1>
                        <p class="text-xs text-gray-500 mt-0.5">
                            {{-- Dynamic breadcrumb based on route --}}
                            @if(request()->routeIs('petugas.dashboard'))
                                Overview dan statistik
                            @elseif(request()->routeIs('petugas.absensi.index'))
                                Riwayat absensi anda
                            @elseif(request()->routeIs('petugas.absensi.create'))
                                Form absensi hari ini
                            @else
                                Panel petugas
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            {{-- Right Section: User Info & Date --}}
            <div class="flex items-center gap-6">
                {{-- Date Badge --}}
                <div class="hidden md:flex items-center gap-2.5 px-4 py-2 bg-gradient-to-r from-gray-50 to-white rounded-xl border border-gray-200 shadow-sm">
                    <div class="w-7 h-7 bg-[#0B2D45]/10 rounded-lg flex items-center justify-center">
                        <i class="fas fa-calendar-alt text-[#155E76] text-xs"></i>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xs font-medium text-gray-500">{{ now()->format('l') }}</span>
                        <span class="text-sm font-semibold text-gray-800">{{ now()->format('d M Y') }}</span>
                    </div>
                </div>

                {{-- User Profile Dropdown Trigger --}}
                <div class="flex items-center gap-3 group cursor-pointer relative">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-semibold text-gray-800">{{ auth()->user()->name ?? 'Petugas' }}</p>
                        <div class="flex items-center justify-end gap-1.5 mt-0.5">
                            <div class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></div>
                            <p class="text-xs text-gray-500">Petugas</p>
                        </div>
                    </div>
                    
                    {{-- Avatar with Badge --}}
                    <div class="relative">
                        <div class="w-10 h-10 bg-gradient-to-br from-[#0B2D45] to-[#155E76] rounded-xl flex items-center justify-center shadow-md group-hover:shadow-lg transition-shadow">
                            <span class="text-white font-bold text-sm">{{ substr(auth()->user()->name ?? 'P', 0, 1) }}</span>
                        </div>
                        <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 border-2 border-white rounded-full"></div>
                    </div>
                </div>
            </div>
        </header>

        {{-- Content --}}
        <main class="flex-1 p-8 bg-gray-50/50">
            @include('components.flash')
            
            <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
                @yield('content')
            </div>
        </main>
    </div>

</body>
</html>
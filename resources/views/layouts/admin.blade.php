<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - AbsensiBillman</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Font Awesome 6 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    {{-- Custom style untuk efek glassmorphism dan smooth transitions --}}
    <style>
        * {
            transition: all 0.2s ease;
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.05);
        }
        .nav-item-active {
            background: linear-gradient(90deg, rgba(37,99,235,0.2) 0%, rgba(37,99,235,0) 100%);
            border-left: 4px solid #FBBF24;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen flex antialiased">

    {{-- Sidebar --}}
    <aside class="w-72 bg-gradient-to-br from-blue-950 via-blue-900 to-blue-800 text-white shadow-2xl flex flex-col relative overflow-hidden">
        
        {{-- Animated background pattern --}}
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

        {{-- Logo / Brand with modern design --}}
        <div class="relative p-8 border-b border-blue-700/30">
            <div class="flex items-center gap-4">
                <div class="w-11 h-11 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-xl flex items-center justify-center shadow-lg shadow-yellow-500/20">
                    <i class="fas fa-bolt text-blue-950 text-xl"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold tracking-tight">
                        Absensi<span class="text-yellow-400">Billman</span>
                    </h2>
                    <p class="text-xs text-blue-200/80 mt-1 font-medium">Admin Panel</p>
                </div>
            </div>
        </div>

        {{-- Navigation with icons --}}
        <nav class="flex-1 p-6 space-y-2 text-sm relative z-10">
            
            <a href="{{ route('admin.absensi') }}"
               class="flex items-center gap-4 px-4 py-3 rounded-xl hover:bg-white/10 transition-all duration-300 group">
                <i class="fas fa-camera w-5 text-center text-yellow-400/80 group-hover:text-yellow-400"></i>
                <span class="font-medium">Monitoring Absensi</span>
            </a>

            <a href="{{ route('admin.users.index') }}"
               class="flex items-center gap-4 px-4 py-3 rounded-xl hover:bg-white/10 transition-all duration-300 group">
                <i class="fas fa-users w-5 text-center text-yellow-400/80 group-hover:text-yellow-400"></i>
                <span class="font-medium">Manajemen User</span>
            </a>

            <a href="{{ route('admin.settings') }}"
               class="flex items-center gap-4 px-4 py-3 rounded-xl hover:bg-white/10 transition-all duration-300 group">
                <i class="fas fa-sliders-h w-5 text-center text-yellow-400/80 group-hover:text-yellow-400"></i>
                <span class="font-medium">Pengaturan</span>
            </a>
        </nav>

        {{-- Logout with modern design --}}
        <div class="relative p-6 border-t border-blue-700/30">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full bg-gradient-to-r from-yellow-400 to-yellow-500 text-blue-950 font-semibold py-3 px-4 rounded-xl hover:from-yellow-300 hover:to-yellow-400 transition-all duration-300 shadow-lg shadow-yellow-500/20 flex items-center justify-center gap-2 group">
                    <i class="fas fa-sign-out-alt group-hover:translate-x-1 transition-transform"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    {{-- Main Area --}}
    <div class="flex-1 flex flex-col bg-gray-50/80">

        {{-- Top Navbar with glassmorphism --}}
        <header class="bg-white/80 backdrop-blur-xl shadow-sm px-8 py-5 flex justify-between items-center sticky top-0 z-20 border-b border-gray-200/50">
            <h1 class="text-2xl font-bold text-gray-800 tracking-tight">
                @yield('title', 'Dashboard')
            </h1>

            <div class="flex items-center gap-4">
                <div class="flex items-center gap-3 bg-blue-50/50 px-4 py-2 rounded-full">
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                    <span class="text-sm font-medium text-gray-700">{{ auth()->user()->name ?? 'Admin' }}</span>
                </div>
            </div>
        </header>

        {{-- Content Area with modern card design --}}
        <main class="flex-1 p-8">
            
            {{-- Flash Message --}}
            @include('components.flash')

            <div class="bg-white rounded-2xl shadow-xl shadow-gray-200/50 p-8 border border-gray-100 hover-lift">
                @yield('content')
            </div>

        </main>

    </div>

</body>
</html>
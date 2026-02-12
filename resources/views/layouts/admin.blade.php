<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - AbsensiBillman</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex">

    {{-- Sidebar --}}
    <aside class="w-64 bg-gray-900 text-white p-5">
        <h2 class="text-xl font-bold mb-6">AbsensiBillman</h2>

        <nav class="space-y-3">
            <a href="{{ route('admin.dashboard') }}" class="block hover:bg-gray-700 p-2 rounded">
                Dashboard
            </a>

            <a href="{{ route('admin.absensi') }}" class="block hover:bg-gray-700 p-2 rounded">
                Monitoring Absensi
            </a>

            <a href="{{ route('admin.users.index') }}" class="block hover:bg-gray-700 p-2 rounded">
                Manajemen User
            </a>

            <a href="{{ route('admin.settings') }}" class="block hover:bg-gray-700 p-2 rounded">
                Pengaturan
            </a>
        </nav>

        <div class="mt-10">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full bg-red-500 hover:bg-red-600 p-2 rounded">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- Main Content --}}
    <main class="flex-1 p-8">
        @include('components.flash')

        @yield('content')
    </main>

</body>
</html>

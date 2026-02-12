<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Petugas - AbsensiBillman</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex">

    <aside class="w-64 bg-blue-900 text-white p-5">
        <h2 class="text-xl font-bold mb-6">AbsensiBillman</h2>

        <nav class="space-y-3">
            <a href="{{ route('petugas.dashboard') }}" class="block hover:bg-blue-700 p-2 rounded">
                Dashboard
            </a>

            <a href="{{ route('petugas.absensi.index') }}" class="block hover:bg-blue-700 p-2 rounded">
                Riwayat Absensi
            </a>

            <a href="{{ route('petugas.absensi.create') }}" class="block hover:bg-blue-700 p-2 rounded">
                Absen Hari Ini
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

    <main class="flex-1 p-8">
        @include('components.flash')

        @yield('content')
    </main>

</body>
</html>

<!DOCTYPE html>
<html lang="{{ session('app_language', 'id') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aegis Vision - User Panel</title>
    <!-- Tailwind CSS & FontAwesome -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="min-h-screen flex {{ session('app_theme') == 'dark' ? 'bg-gray-900 text-gray-100' : 'bg-gray-50 text-gray-800' }}">

    <!-- Sidebar Panel User -->
    <aside class="w-64 {{ session('app_theme') == 'dark' ? 'bg-gray-800 border-gray-700 text-white' : 'bg-white border-gray-200 text-gray-800' }} border-r flex flex-col justify-between p-6">
        <div>
            <div class="mb-8">
                <h1 class="text-xl font-bold text-emerald-600">Aegis Vision</h1>
                <p class="text-xs text-gray-400">User Panel</p>
            </div>

            <!-- Urutan Menu Diperbaiki: Beranda -> Hasil Analisis -> Riwayat Analisis -->
            <nav class="space-y-2">
                <a href="{{ route('user.beranda') }}" class="flex items-center space-x-3 p-3 rounded-lg font-medium {{ request()->routeIs('user.beranda') ? 'bg-emerald-100 text-emerald-700' : 'hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                    <i class="fa-solid fa-house"></i> <span>Beranda</span>
                </a>
                <a href="{{ route('user.hasil') }}" class="flex items-center space-x-3 p-3 rounded-lg font-medium {{ request()->routeIs('user.hasil') ? 'bg-emerald-100 text-emerald-700' : 'hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                    <i class="fa-solid fa-shield-virus"></i> <span>Hasil Analisis</span>
                </a>
                <a href="{{ route('user.riwayat') }}" class="flex items-center space-x-3 p-3 rounded-lg font-medium {{ request()->routeIs('user.riwayat') ? 'bg-emerald-100 text-emerald-700' : 'hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                    <i class="fa-solid fa-clock-rotate-left"></i> <span>Riwayat Analisis</span>
                </a>
            </nav>
        </div>

        <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
            <form action="{{ route('user.logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center space-x-3 text-red-600 font-medium text-xs hover:underline">
                    <i class="fa-solid fa-right-from-bracket"></i> <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Wrapper -->
    <div class="flex-1 flex flex-col min-h-screen">
        <!-- Top Navbar -->
        <header class="{{ session('app_theme') == 'dark' ? 'bg-gray-800 border-gray-700' : 'bg-white border-gray-200' }} border-b px-8 py-4 flex justify-between items-center">
            <div></div>
            <div class="flex items-center gap-4">
                <a href="{{ route('user.notifikasi') }}" class="text-gray-500 hover:text-emerald-600 relative">
                    <i class="fa-solid fa-bell text-lg"></i>
                </a>
                <a href="{{ route('user.setelan') }}" class="text-gray-500 hover:text-emerald-600">
                    <i class="fa-solid fa-gear text-lg"></i>
                </a>

                <!-- Profil Dinamis -->
                <a href="{{ route('user.profil') }}" class="flex items-center gap-2 pl-4 border-l dark:border-gray-700 hover:opacity-80 transition cursor-pointer">
                    <div class="w-8 h-8 rounded-full bg-emerald-700 text-white flex items-center justify-center font-bold text-xs">
                        {{ strtoupper(substr(Auth::user()->email ?? 'U', 0, 1)) }}
                    </div>
                    <span class="text-xs font-semibold text-gray-700 dark:text-gray-200">{{ Auth::user()->email ?? 'pengguna' }}</span>
                </a>
            </div>
        </header>

        <!-- Dynamic Content Body -->
        <main class="p-8 flex-1">
            @yield('content')
        </main>
    </div>

</body>
</html>

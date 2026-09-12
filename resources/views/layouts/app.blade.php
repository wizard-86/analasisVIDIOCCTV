<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aegis Vision - Guest Panel</title>
    <!-- Tailwind CSS & FontAwesome -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="min-h-screen flex bg-gray-50 text-gray-800">

    <!-- Sidebar Panel Guest -->
    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col justify-between p-6">
        <div>
            <div class="mb-8">
                <h1 class="text-xl font-bold text-emerald-600">Aegis Vision</h1>
                <p class="text-xs text-gray-400">Guest Panel</p>
            </div>
            <nav class="space-y-2">
                <a href="{{ route('guest.beranda') }}" class="flex items-center space-x-3 p-3 rounded-lg font-medium {{ request()->routeIs('guest.beranda') ? 'bg-emerald-100 text-emerald-700' : 'hover:bg-gray-100' }}">
                    <i class="fa-solid fa-house"></i> <span>Beranda</span>
                </a>
                <a href="{{ route('guest.hasil') }}" class="flex items-center space-x-3 p-3 rounded-lg font-medium {{ request()->routeIs('guest.hasil') ? 'bg-emerald-100 text-emerald-700' : 'hover:bg-gray-100' }}">
                    <i class="fa-solid fa-shield-virus"></i> <span>Hasil Analisis</span>
                </a>
            </nav>
        </div>
    </aside>

    <!-- Main Content Wrapper -->
    <div class="flex-1 flex flex-col min-h-screen">
        <!-- Top Navbar -->
        <header class="bg-white border-b border-gray-200 px-8 py-4 flex justify-between items-center">
            <div></div>
            <div class="flex items-center gap-2">
                <!-- Tombol Ikon Orang Saja (Menuju Login) -->
                <a href="{{ route('login') }}" class="text-gray-500 hover:text-emerald-600 focus:outline-none p-2 rounded-lg hover:bg-gray-100 transition" title="Login">
                    <i class="fa-solid fa-user text-lg"></i>
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

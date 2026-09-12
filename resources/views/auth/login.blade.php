<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aegis Vision</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white border border-gray-200 rounded-2xl p-8 w-96 shadow-sm text-center">
        <div class="text-emerald-700 text-3xl mb-2"><i class="fa-solid fa-shield-halved"></i></div>
        <h2 class="text-xl font-bold text-gray-800">Aegis Vision</h2>
        <p class="text-xs text-gray-400 mb-6">Platform Keamanan Cerdas AI</p>

        <!-- Menampilkan pesan error jika login gagal -->
        @if ($errors->any())
            <div class="mb-4 bg-red-50 border border-red-200 text-red-600 text-xs p-3 rounded-lg text-left">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('login.store') }}" method="POST" class="space-y-4 text-left text-sm">
            @csrf
            <div>
                <label class="block text-xs text-gray-500 mb-1">Alamat Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email Anda" required class="w-full border rounded-lg p-2.5 text-sm focus:outline-none focus:border-emerald-600">
            </div>
            <div>
                <label class="block text-xs text-gray-500 mb-1">Kata Sandi</label>
                <input type="password" name="password" placeholder="••••••••" required class="w-full border rounded-lg p-2.5 text-sm focus:outline-none focus:border-emerald-600">
            </div>
            <button type="submit" class="w-full bg-emerald-700 text-white py-2.5 rounded-lg font-medium hover:bg-emerald-800 transition">Masuk ke Sistem</button>
            <div class="mt-4 text-center">
<div class="mt-4">
    <a href="{{ route('guest.beranda') }}" class="w-full border border-gray-300 text-gray-700 py-2.5 rounded-xl text-xs font-semibold hover:bg-gray-50 transition flex items-center justify-center shadow-sm block text-center">
        Masuk sebagai Guest
    </a>
</div>
        </form>

        <p class="text-xs text-gray-500 mt-4">Belum punya akun? <a href="{{ route('register') }}" class="text-emerald-700 font-medium">Daftar sekarang</a></p>
    </div>
</body>
</html>

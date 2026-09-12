<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CCTV Shoplifting</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-50 text-gray-800">

    <div class="bg-white border border-gray-200 rounded-3xl p-8 shadow-sm w-full max-w-md space-y-6">
        <!-- Logo & Header -->
        <div class="text-center space-y-2">
            <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center text-xl mx-auto shadow-sm">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            <h1 class="text-xl font-bold text-gray-900 tracking-tight">CCTV shoplifting</h1>
            <p class="text-xs text-gray-400">Platform Keamanan Cerdas AI</p>
        </div>

        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-xs font-semibold">
                {{ $errors->first() }}
            </div>
        @endif

        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-xs font-semibold">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form Login -->
        <form action="{{ route('login.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1.5">Alamat Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="Masukkan email Anda"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-xs focus:ring-2 focus:ring-emerald-500 outline-none transition">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1.5">Kata Sandi</label>
                <div class="relative">
                    <input type="password" name="password" id="password" required placeholder="••••••••"
                        class="w-full border border-gray-300 rounded-xl pl-4 pr-10 py-2.5 text-xs focus:ring-2 focus:ring-emerald-500 outline-none transition">
                    <!-- Tombol Ikon Mata -->
                    <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                        <i id="eyeIcon" class="fa-solid fa-eye text-xs"></i>
                    </button>
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full bg-emerald-700 text-white py-3 rounded-xl text-xs font-semibold hover:bg-emerald-800 transition shadow-sm">
                    Masuk ke Sistem
                </button>
            </div>
        </form>

        <!-- Tombol Masuk sebagai Guest -->
        <div>
            <a href="{{ route('guest.beranda') }}" class="w-full border border-gray-300 text-gray-700 py-2.5 rounded-xl text-xs font-semibold hover:bg-gray-50 transition flex items-center justify-center shadow-sm block text-center">
                Masuk sebagai Guest
            </a>
        </div>

        <div class="text-center text-xs text-gray-400 pt-2 border-t">
            Belum punya akun? <a href="{{ route('register') }}" class="text-emerald-700 font-bold hover:underline">Daftar sekarang</a>
        </div>
    </div>

    <!-- Script Toggle Password -->
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>

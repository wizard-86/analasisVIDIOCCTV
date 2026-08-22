<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Aegis Vision</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 flex items-center justify-center h-screen">
    <div class="bg-white border border-gray-200 rounded-2xl p-8 w-[420px] shadow-sm">
        <!-- Header Logo / Judul -->
        <div class="text-center mb-6">
            <div class="text-emerald-700 text-3xl mb-2"><i class="fa-solid fa-shield-halved"></i></div>
            <h2 class="text-xl font-bold text-gray-900">Daftar Akun Operator</h2>
            <p class="text-xs text-gray-400 mt-1">Silakan lengkapi data diri Anda untuk mengakses panel sistem.</p>
        </div>

        <!-- Menampilkan Pesan Error Validasi (Jika ada) -->
        @if ($errors->any())
            <div class="mb-4 bg-red-50 border border-red-200 text-red-600 text-xs p-3 rounded-lg space-y-1">
                @foreach ($errors->all() as $error)
                    <p>• {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <!-- Form Register -->
        <form action="{{ route('register.store') }}" method="POST" class="space-y-4 text-sm">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1">Nama Lengkap</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400"><i class="fa-regular fa-user text-xs"></i></span>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required class="w-full border border-gray-300 rounded-lg py-2.5 pl-9 pr-4 text-xs focus:outline-none focus:border-emerald-600 bg-gray-50">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1">Alamat Email</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400"><i class="fa-regular fa-envelope text-xs"></i></span>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="contoh@domain.com" required class="w-full border border-gray-300 rounded-lg py-2.5 pl-9 pr-4 text-xs focus:outline-none focus:border-emerald-600 bg-gray-50">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1">Kata Sandi</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400"><i class="fa-solid fa-lock text-xs"></i></span>
                    <input type="password" name="password" placeholder="Minimal 8 karakter" required class="w-full border border-gray-300 rounded-lg py-2.5 pl-9 pr-4 text-xs focus:outline-none focus:border-emerald-600 bg-gray-50">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1">Konfirmasi Kata Sandi</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400"><i class="fa-solid fa-lock text-xs"></i></span>
                    <input type="password" name="password_confirmation" placeholder="Ulangi kata sandi" required class="w-full border border-gray-300 rounded-lg py-2.5 pl-9 pr-4 text-xs focus:outline-none focus:border-emerald-600 bg-gray-50">
                </div>
            </div>

            <button type="submit" class="w-full bg-emerald-700 text-white py-2.5 rounded-lg text-xs font-semibold hover:bg-emerald-800 transition shadow-sm mt-2">
                Daftar Akun Sekarang
            </button>
        </form>

        <!-- Footer Link Login -->
        <p class="text-xs text-gray-500 mt-6 text-center">
            Sudah memiliki akun? <a href="{{ route('login') }}" class="text-emerald-700 font-semibold hover:underline">Masuk di sini</a>
        </p>
    </div>
</body>
</html>

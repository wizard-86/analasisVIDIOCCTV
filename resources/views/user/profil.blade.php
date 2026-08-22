@extends('layouts.user')
@section('content')
<div class="space-y-6 max-w-7xl mx-auto">
    <div>
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Profil Pengguna</h2>
        <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Informasi akun Anda pada sistem Aegis Vision.</p>
    </div>

    <!-- Kartu Profil Ringkas -->
    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl p-8 shadow-sm max-w-xl space-y-6">
        <div class="flex items-center gap-4 pb-6 border-b dark:border-gray-700">
            <!-- Inisial Huruf Pertama Otomatis dari Email -->
            <div class="w-16 h-16 rounded-full bg-emerald-700 text-white flex items-center justify-center font-bold text-2xl shadow-sm">
                {{ strtoupper(substr($user->email ?? 'U', 0, 1)) }}
            </div>
            <div>
                <h4 class="font-bold text-gray-900 dark:text-white text-sm">Akun Aktif</h4>
                <span class="inline-block mt-1 px-3 py-1 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-700 uppercase tracking-wide">
                    User
                </span>
            </div>
        </div>

        <!-- Detail Informasi Email -->
        <div class="space-y-4 text-xs">
            <div class="flex justify-between items-center py-2.5">
                <span class="text-gray-400 font-medium">Alamat Email:</span>
                <span class="font-bold text-gray-800 dark:text-gray-200">{{ $user->email ?? 'Tidak ditemukan' }}</span>
            </div>
        </div>
    </div>
</div>
@endsection

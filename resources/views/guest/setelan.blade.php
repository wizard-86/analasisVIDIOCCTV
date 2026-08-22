@extends('layouts.app')
@section('content')
<div class="space-y-6 max-w-6xl mx-auto">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Pengaturan Sistem</h2>
        <p class="text-sm text-gray-500">Konfigurasi preferensi tampilan dan akses publik Aegis Vision.</p>
    </div>

    <div class="grid grid-cols-3 gap-6">
        <!-- Kolom Kiri: Preferensi Sistem (Span 2) -->
        <div class="col-span-2 space-y-6">
            <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
                <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2 text-sm">
                    <i class="fa-solid fa-sliders text-emerald-700"></i> Preferensi Tampilan & Tinjauan
                </h3>
                <div class="space-y-4 text-sm">
                    <div class="flex justify-between items-center border-b pb-3">
                        <div>
                            <p class="font-medium text-gray-800 text-xs">Mode Pratinjau Publik</p>
                            <p class="text-[11px] text-gray-400">Menampilkan antarmuka dasar untuk pengunjung umum.</p>
                        </div>
                        <input type="checkbox" checked disabled class="accent-emerald-700 w-4 h-4 cursor-not-allowed">
                    </div>
                    <div class="flex justify-between items-center border-b pb-3">
                        <div>
                            <p class="font-medium text-gray-800 text-xs">Simpan Preferensi Sesi</p>
                            <p class="text-[11px] text-gray-400">Menyimpan konfigurasi filter sementara di browser.</p>
                        </div>
                        <input type="checkbox" checked class="accent-emerald-700 w-4 h-4 cursor-pointer">
                    </div>
                    <div class="pt-1">
                        <label class="block text-xs text-gray-500 mb-1 font-medium">Bahasa Antarmuka</label>
                        <select class="w-full border border-gray-300 rounded-xl p-2.5 text-xs bg-white focus:outline-none focus:border-emerald-600">
                            <option>Indonesia</option>
                            <option>English</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Status Akses Tamu & Tombol Aksi (Span 1) -->
        <div class="space-y-6">
            <div class="bg-emerald-50 border border-emerald-200 rounded-2xl p-6 shadow-sm space-y-4">
                <div class="flex items-center gap-3">
                    <div class="bg-emerald-700 text-white w-10 h-10 rounded-xl flex items-center justify-center font-bold text-sm">
                        <i class="fa-regular fa-user"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-emerald-900 text-sm">Mode Tamu (Guest)</h4>
                        <span class="text-[10px] text-emerald-600 font-medium">Belum masuk ke sistem</span>
                    </div>
                </div>
                <p class="text-xs text-gray-600 leading-relaxed">Anda sedang menjelajah sebagai tamu. Masuk ke sistem untuk membuka akses penuh ke riwayat video dan kontrol AI lanjutan.</p>
                <div class="pt-2 flex gap-2">
                    <a href="{{ route('login') }}" class="flex-1 bg-emerald-700 text-white text-center py-2.5 rounded-xl text-xs font-semibold hover:bg-emerald-800 transition shadow-sm">Masuk</a>
                    <a href="{{ route('register') }}" class="flex-1 bg-white border border-emerald-700 text-emerald-700 text-center py-2.5 rounded-xl text-xs font-semibold hover:bg-emerald-50 transition shadow-sm">Daftar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

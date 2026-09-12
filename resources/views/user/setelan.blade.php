@extends('layouts.user')
@section('content')
<div class="space-y-6 max-w-4xl mx-auto">
    <!-- Header Setelan -->
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Pengaturan Sistem</h2>
        <p class="text-xs text-gray-500 mt-0.5">Konfigurasi preferensi model kecerdasan buatan, privasi, dan tampilan antarmuka Aegis Vision.</p>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-xs font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('user.setelan.update') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Preferensi Analisis AI -->
        <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm space-y-4">
            <h3 class="font-bold text-gray-900 text-sm border-b pb-3">Preferensi Analisis AI & Model</h3>

            <div class="space-y-4">
                <label class="flex items-center justify-between cursor-pointer">
                    <div>
                        <span class="text-xs font-bold text-gray-800 block">Otomatis Mulai Analisis</span>
                        <span class="text-[11px] text-gray-400">Langsung jalankan ekstraksi model setelah video CCTV diunggah.</span>
                    </div>
                    <input type="checkbox" name="auto_analysis" value="1" {{ session('auto_analysis', true) ? 'checked' : '' }} class="w-4 h-4 text-emerald-600 rounded border-gray-300 focus:ring-emerald-500">
                </label>

                <label class="flex items-center justify-between cursor-pointer pt-3 border-t">
                    <div>
                        <span class="text-xs font-bold text-gray-800 block">Dynamic Face Blurring (Privasi Publik)</span>
                        <span class="text-[11px] text-gray-400">Menyamarkan wajah orang yang lewat secara otomatis pada rekaman CCTV.</span>
                    </div>
                    <input type="checkbox" name="face_blurring" value="1" {{ session('face_blurring', true) ? 'checked' : '' }} class="w-4 h-4 text-emerald-600 rounded border-gray-300 focus:ring-emerald-500">
                </label>
            </div>
        </div>

        <!-- Konfigurasi Parameter AI & Tampilan -->
        <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm space-y-4">
            <h3 class="font-bold text-gray-900 text-sm border-b pb-3">Parameter Model & Tampilan</h3>

            <div class="grid grid-cols-2 gap-4">
                <!-- Pilihan Tema -->
                <div class="space-y-1">
                    <label class="block text-xs font-bold text-gray-800">Tema Dashboard</label>
                    <select name="theme" class="w-full bg-gray-50 border border-gray-200 rounded-xl p-2.5 text-xs text-gray-700 focus:outline-none focus:border-emerald-600">
                        <option value="light" {{ session('app_theme', 'light') == 'light' ? 'selected' : '' }}>Light Mode (Default)</option>
                        <option value="dark" {{ session('app_theme', 'light') == 'dark' ? 'selected' : '' }}>Dark Mode</option>
                    </select>
                </div>

                <!-- Pengaturan Target Frame (Dinamis Sesuai Session) -->
                <div class="space-y-1">
                    <label class="block text-xs font-bold text-gray-800">Target Sampling Frame</label>
                    <select name="target_frames" class="w-full bg-gray-50 border border-gray-200 rounded-xl p-2.5 text-xs text-gray-700 focus:outline-none focus:border-emerald-600">
                        <option value="16" {{ session('target_frames', '32') == '16' ? 'selected' : '' }}>16 Frames (Cepat)</option>
                        <option value="32" {{ session('target_frames', '32') == '32' ? 'selected' : '' }}>32 Frames (Optimal Attention)</option>
                        <option value="64" {{ session('target_frames', '32') == '64' ? 'selected' : '' }}>64 Frames (Akurasi Tinggi)</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Tombol Simpan -->
        <div>
            <button type="submit" class="bg-emerald-700 text-white px-6 py-3 rounded-xl text-xs font-semibold hover:bg-emerald-800 transition shadow-sm flex items-center gap-2">
                <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection

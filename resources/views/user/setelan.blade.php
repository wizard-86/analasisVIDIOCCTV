@extends('layouts.user')
@section('content')
<div class="space-y-6 max-w-4xl mx-auto">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Pengaturan Sistem</h2>
        <p class="text-xs text-gray-500 mt-0.5">Konfigurasi preferensi model kecerdasan buatan, privasi, dan tampilan antarmuka.</p>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-xs font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('user.setelan.update') }}" method="POST" class="space-y-6">
        @csrf
        <!-- Preferensi Analisis AI & Model -->
        <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm space-y-5">
            <h3 class="font-bold text-gray-900 text-sm border-b pb-3">Preferensi Analisis AI & Model</h3>

            <label class="flex items-start gap-3 cursor-pointer">
                <input type="checkbox" name="auto_analysis" value="1" checked class="mt-0.5 rounded text-emerald-600 focus:ring-emerald-500">
                <div>
                    <span class="block font-bold text-gray-800 text-xs">Otomatis Mulai Analisis</span>
                    <span class="block text-[11px] text-gray-400">Langsung jalankan ekstraksi model setelah video CCTV diunggah.</span>
                </div>
            </label>

            <label class="flex items-start gap-3 cursor-pointer">
                <input type="checkbox" name="face_blurring" value="1" checked class="mt-0.5 rounded text-emerald-600 focus:ring-emerald-500">
                <div>
                    <span class="block font-bold text-gray-800 text-xs">Dynamic Face Blurring (Privasi Publik)</span>
                    <span class="block text-[11px] text-gray-400">Menyamarkan wajah orang yang lewat secara otomatis pada rekaman CCTV.</span>
                </div>
            </label>
        </div>

        <!-- Parameter Tampilan (Target Sampling Frame Dihapus) -->
        <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm space-y-4">
            <h3 class="font-bold text-gray-900 text-sm border-b pb-3">Parameter Model & Tampilan</h3>

            <div class="max-w-md">
                <label class="block font-bold text-gray-800 text-xs mb-1.5">Tema Dashboard</label>
                <select name="theme" class="w-full border border-gray-300 rounded-xl px-3 py-2 text-xs focus:ring-2 focus:ring-emerald-500 outline-none">
                    <option value="light">Light Mode (Default)</option>
                    <option value="dark">Dark Mode</option>
                </select>
            </div>
        </div>

        <div>
            <button type="submit" class="bg-emerald-700 text-white px-6 py-2.5 rounded-xl text-xs font-semibold hover:bg-emerald-800 transition shadow-sm">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection

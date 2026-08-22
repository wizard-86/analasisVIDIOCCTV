@extends('layouts.user')
@section('content')
<div class="space-y-6 max-w-7xl mx-auto">
    <div>
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Pengaturan Sistem</h2>
        <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Konfigurasi preferensi aplikasi, notifikasi, dan tampilan Aegis Vision.</p>
    </div>

    <!-- Notifikasi Sukses -->
    @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl text-xs font-semibold flex items-center gap-2">
        <i class="fa-solid fa-circle-check text-emerald-600"></i> {{ session('success') }}
    </div>
    @endif

    <!-- Form Pengaturan -->
    <form action="{{ route('user.setelan.update') }}" method="POST" class="space-y-6">
        @csrf
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl p-6 shadow-sm space-y-6">
            <h3 class="font-bold text-gray-900 dark:text-white text-sm border-b dark:border-gray-700 pb-3">Preferensi Analisis AI</h3>

            <!-- Checkbox 1 -->
            <label class="flex items-center justify-between cursor-pointer p-2 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition">
                <span class="text-xs text-gray-700 dark:text-gray-300 font-medium">Otomatis mulai analisis setelah video diunggah</span>
                <input type="checkbox" name="auto_analysis" value="1" {{ session('auto_analysis', true) ? 'checked' : '' }} class="w-4 h-4 text-emerald-600 rounded border-gray-300 focus:ring-emerald-500">
            </label>

            <!-- Checkbox 2 -->
            <label class="flex items-center justify-between cursor-pointer p-2 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition">
                <span class="text-xs text-gray-700 dark:text-gray-300 font-medium">Aktifkan Dynamic Face Blurring (Privasi Publik)</span>
                <input type="checkbox" name="face_blurring" value="1" {{ session('face_blurring', true) ? 'checked' : '' }} class="w-4 h-4 text-emerald-600 rounded border-gray-300 focus:ring-emerald-500">
            </label>
        </div>

        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl p-6 shadow-sm space-y-6">
            <h3 class="font-bold text-gray-900 dark:text-white text-sm border-b dark:border-gray-700 pb-3">Tampilan & Suara</h3>

            <div class="grid grid-cols-2 gap-6">
                <!-- Pilihan Tema -->
                <div class="space-y-2">
                    <label class="block text-xs font-medium text-gray-600 dark:text-gray-300">Tema Dashboard</label>
                    <select name="theme" class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl p-3 text-xs text-gray-700 dark:text-gray-200 focus:outline-none focus:border-emerald-600">
                        <option value="light" {{ session('app_theme') == 'light' ? 'selected' : '' }}>Light Mode (Default)</option>
                        <option value="dark" {{ session('app_theme') == 'dark' ? 'selected' : '' }}>Dark Mode</option>
                    </select>
                </div>

                <!-- Pengaturan Volume Suara Peringatan (Menggantikan Bahasa) -->
                <div class="space-y-2">
                    <div class="flex justify-between items-center">
                        <label class="block text-xs font-medium text-gray-600 dark:text-gray-300">Volume Suara Peringatan</label>
                        <span id="volumeValue" class="text-xs font-bold text-emerald-600">{{ session('app_volume', 70) }}%</span>
                    </div>
                    <div class="pt-2">
                        <input type="range" name="volume" id="volumeSlider" min="0" max="100" value="{{ session('app_volume', 70) }}" class="w-full accent-emerald-600 cursor-pointer">
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t dark:border-gray-700">
                <button type="submit" class="bg-emerald-700 text-white px-6 py-3 rounded-xl text-xs font-semibold hover:bg-emerald-800 transition shadow-sm flex items-center gap-2">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                </button>
            </div>
        </div>
    </form>
</div>

<!-- Skrip Interaktif Slider Volume -->
<script>
    const slider = document.getElementById('volumeSlider');
    const output = document.getElementById('volumeValue');

    slider.addEventListener('input', function() {
        output.textContent = this.value + '%';
    });
</script>
@endsection

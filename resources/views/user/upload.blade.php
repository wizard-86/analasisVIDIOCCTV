@extends('layouts.user')
@section('content')
<div class="space-y-6 max-w-7xl mx-auto">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Unggah Rekaman Keamanan</h2>
        <p class="text-xs text-gray-500 mt-0.5">Seret dan lepas file video untuk dianalisis oleh AI Aegis Vision.</p>
    </div>

    <!-- Form Utama Unggah Video -->
    <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-3 gap-6 items-start">
        @csrf
        <!-- Kolom Kiri: Area Drag & Drop & Tombol Pilih File (Span 2) -->
        <div class="col-span-2 bg-white border border-gray-200 rounded-2xl p-12 shadow-sm text-center flex flex-col items-center justify-center min-h-[380px] relative">
            <div class="w-16 h-16 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center text-2xl mb-4 shadow-sm">
                <i class="fa-solid fa-cloud-arrow-up"></i>
            </div>
            <h3 class="font-bold text-gray-800 text-sm mb-1">Tarik & Lepas Video Di Sini</h3>
            <p class="text-xs text-gray-400 mb-6">Mendukung MP4, AVI, MKV (Maks. 500MB)</p>

            <!-- Input File Asli Disembunyikan -->
            <input type="file" name="video" id="videoInput" required class="hidden" onchange="autofillDetails(this)">

            <label for="videoInput" class="bg-emerald-700 text-white px-6 py-2.5 rounded-xl text-xs font-semibold hover:bg-emerald-800 transition cursor-pointer shadow-sm">
                Pilih File
            </label>

            <!-- Indikator File Terpilih -->
            <p id="selectedFileLabel" class="text-xs text-emerald-700 font-semibold mt-3"></p>
        </div>

        <!-- Kolom Kanan: Detail Rekaman (Otomatis Terisi) (Span 1) -->
        <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm space-y-4">
            <h3 class="font-bold text-gray-900 text-sm border-b pb-3">Detail Rekaman</h3>

            <div class="space-y-1">
                <label class="block text-[11px] font-medium text-gray-500">Nama File (Otomatis)</label>
                <input type="text" name="nama_file" id="inputNamaFile" readonly class="w-full bg-gray-50 border border-gray-200 rounded-xl p-2.5 text-xs text-gray-700 focus:outline-none" placeholder="Belum ada file dipilih">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div class="space-y-1">
                    <label class="block text-[11px] font-medium text-gray-500">Tanggal</label>
                    <input type="text" name="tanggal" id="inputTanggal" readonly class="w-full bg-gray-50 border border-gray-200 rounded-xl p-2.5 text-xs text-gray-700 focus:outline-none" placeholder="dd/mm/yy">
                </div>
                <div class="space-y-1">
                    <label class="block text-[11px] font-medium text-gray-500">Waktu</label>
                    <input type="text" name="waktu" id="inputWaktu" readonly class="w-full bg-gray-50 border border-gray-200 rounded-xl p-2.5 text-xs text-gray-700 focus:outline-none" placeholder="--:--">
                </div>
            </div>

            <button type="submit" class="w-full bg-emerald-700 text-white py-3 rounded-xl text-xs font-semibold hover:bg-emerald-800 transition shadow-sm flex items-center justify-center gap-2 mt-4">
                <i class="fa-solid fa-microchip"></i> Mulai Analisis AI
            </button>
        </div>
    </form>
</div>

<!-- Skrip JavaScript untuk Mengisi Otomatis Nama, Tanggal, dan Waktu -->
<script>
    function autofillDetails(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];

            // 1. Masukkan Nama File ke Input
            document.getElementById('inputNamaFile').value = file.name;
            document.getElementById('selectedFileLabel').textContent = "File siap: " + file.name;

            // 2. Ambil Tanggal Hari Ini (Format: DD/MM/YY)
            const now = new Date();
            const day = String(now.getDate()).padStart(2, '0');
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const year = String(now.getFullYear()).slice(-2);
            document.getElementById('inputTanggal').value = `${day}/${month}/${year}`;

            // 3. Ambil Waktu Saat Ini (Format: HH:MM)
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            document.getElementById('inputWaktu').value = `${hours}:${minutes}`;
        }
    }
</script>
@endsection

@extends('layouts.app')
@section('content')
<div class="space-y-6 max-w-7xl mx-auto">
    <!-- Header Beranda -->
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Beranda</h2>
        <p class="text-xs text-gray-500 mt-0.5">Sistem Analisis Cerdas Siap Beroperasi. Mulai dengan mengunggah rekaman keamanan.</p>
    </div>

    <!-- Form Bungkus Keseluruhan -->
    <form action="{{ route('guest.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-3 gap-6 items-start">
        @csrf
        <!-- Kolom Kiri: Area Unggah Video (Span 2) -->
        <div class="col-span-2 bg-white border border-gray-200 rounded-2xl p-8 shadow-sm space-y-6">
            <div class="flex justify-between items-center border-b pb-4">
                <h3 class="font-bold text-gray-900 text-sm">Area Unggah Video</h3>
                <i class="fa-regular fa-file-video text-gray-400 text-lg"></i>
            </div>

            <!-- Kotak Drag & Drop dengan Tombol Kustom -->
            <div class="border-2 border-dashed border-gray-300 rounded-2xl p-10 text-center bg-gray-50 hover:bg-gray-100 transition relative flex flex-col items-center justify-center">
                <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center text-xl mb-3">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                </div>
                <h4 class="font-bold text-gray-800 text-sm mb-1">Tarik & Lepas Video di Sini</h4>
                <p class="text-xs text-gray-400 mb-4">atau klik tombol di bawah untuk memilih file dari komputer Anda.</p>

                <!-- Input File Asli Disembunyikan -->
                <input type="file" name="video" id="videoInput" required class="hidden" onchange="updateFileName(this)">

                <!-- Tombol Kustom yang Cantik -->
                <label for="videoInput" class="bg-emerald-50 text-emerald-700 border border-emerald-200 px-5 py-2.5 rounded-xl text-xs font-semibold hover:bg-emerald-100 transition cursor-pointer shadow-sm">
                    <i class="fa-solid fa-folder-open mr-1.5"></i> Pilih File Video
                </label>

                <!-- Teks Indikator Nama File Terpilih -->
                <p id="fileNameDisplay" class="text-xs text-gray-400 mt-2.5 italic">Belum ada file yang dipilih</p>

                <div class="flex gap-2 mt-4">
                    <span class="bg-gray-200 text-gray-700 text-[10px] px-2.5 py-1 rounded-md font-bold">MP4</span>
                    <span class="bg-gray-200 text-gray-700 text-[10px] px-2.5 py-1 rounded-md font-bold">AVI</span>
                    <span class="bg-gray-200 text-gray-700 text-[10px] px-2.5 py-1 rounded-md font-bold">Maks: 500MB</span>
                </div>
            </div>

            <button type="submit" class="w-full bg-emerald-700 text-white py-3 rounded-xl text-xs font-semibold hover:bg-emerald-800 transition shadow-sm flex items-center justify-center gap-2">
                <i class="fa-solid fa-microchip"></i> Proses Analisis AI Sekarang
            </button>
        </div>

        <!-- Kolom Kanan: Status Server & Ringkasan (Span 1) -->
        <div class="col-span-1 space-y-6">
            <!-- Bagian Widget Status Server di Beranda Guest -->
<div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm space-y-4">
    <div class="flex justify-between items-center">
        <span class="text-xs font-bold text-gray-400">STATUS SERVER</span>
        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-700 flex items-center gap-1">
            <span class="w-1.5 h-1.5 rounded-full bg-emerald-600 animate-pulse"></span> Online
        </span>
    </div>
    <div>
        <h4 class="font-extrabold text-gray-900 text-base">{{ $serverStatus ?? 'Optimal' }}</h4>
        <p class="text-[11px] text-gray-400 mt-0.5">Kapasitas Terpakai: {{ $storageUsed ?? 0 }} GB dari {{ $storageLimit ?? 5 }} GB</p>
    </div>
    <!-- Progress Bar Kapasitas (Maks 5GB) -->
    <div class="w-full bg-gray-100 h-2 rounded-full overflow-hidden">
        <div class="bg-emerald-600 h-full rounded-full transition-all duration-500" style="width: {{ $storagePercent ?? 0 }}%;"></div>
    </div>
</div>
            <!-- Ringkasan Hari Ini -->
            <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm space-y-3 text-center">
                <span class="text-xs text-gray-400 font-medium uppercase tracking-wider block text-left">Ringkasan Hari Ini</span>
                <div class="py-4 flex flex-col items-center justify-center">
                    <div class="text-gray-300 text-3xl mb-2"><i class="fa-regular fa-folder-open"></i></div>
                    <h4 class="font-bold text-gray-800 text-sm">Belum Ada Analisis</h4>
                    <p class="text-[11px] text-gray-400 mt-0.5">Unggah video untuk mulai deteksi ancaman.</p>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Skrip JavaScript untuk Mengubah Teks Nama File Secara Dinamis -->
<script>
    function updateFileName(input) {
        const display = document.getElementById('fileNameDisplay');
        if (input.files && input.files[0]) {
            display.textContent = "File terpilih: " + input.files[0].name;
            display.classList.remove('italic', 'text-gray-400');
            display.classList.add('text-emerald-700', 'font-bold');
        } else {
            display.textContent = "Belum ada file yang dipilih";
            display.classList.add('italic', 'text-gray-400');
            display.classList.remove('text-emerald-700', 'font-bold');
        }
    }
</script>
@endsection

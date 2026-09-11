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
            <div class="border-2 border-dashed border-gray-300 rounded-2xl p-6 md:p-10 text-center bg-gray-50 hover:bg-gray-100 transition relative flex flex-col items-center justify-center min-h-[300px]">
                
                <!-- Tampilan Default (Belum Ada File) -->
                <div id="defaultUploadState" class="flex flex-col items-center justify-center">
                    <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center text-xl mb-3">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                    </div>
                    <h4 class="font-bold text-gray-800 text-sm mb-1">Tarik & Lepas Video di Sini</h4>
                    <p class="text-xs text-gray-400 mb-4">atau klik tombol di bawah untuk memilih file dari komputer Anda.</p>
                </div>

                <!-- Tampilan Preview Video (Disembunyikan secara default) -->
                <div id="videoPreviewState" class="hidden flex-col items-center justify-center w-full mb-4">
                    <!-- Tag video dengan atribut controls agar bisa dimainkan/dilihat -->
                    <video id="videoPlayer" class="w-full max-h-[200px] rounded-xl border border-gray-200 bg-black shadow-sm" controls preload="metadata"></video>
                </div>

                <!-- Input File Asli Disembunyikan (Ditambahkan accept="video/mp4") -->
                <input type="file" name="video" id="videoInput" accept="video/mp4" required class="hidden" onchange="updateFileName(this)">

                <!-- Tombol Kustom yang Cantik -->
                <label for="videoInput" class="bg-emerald-50 text-emerald-700 border border-emerald-200 px-5 py-2.5 rounded-xl text-xs font-semibold hover:bg-emerald-100 transition cursor-pointer shadow-sm z-10">
                    <i class="fa-solid fa-folder-open mr-1.5"></i> Pilih File Video
                </label>

                <!-- Teks Indikator Nama File Terpilih -->
                <p id="fileNameDisplay" class="text-xs text-gray-400 mt-2.5 italic">Belum ada file yang dipilih</p>

                <!-- Indikator Label Tipe & Ukuran -->
                <div class="flex gap-2 mt-4">
                    <span class="bg-gray-200 text-gray-700 text-[10px] px-2.5 py-1 rounded-md font-bold">MP4</span>
                    <span class="bg-gray-200 text-gray-700 text-[10px] px-2.5 py-1 rounded-md font-bold">Maks: 50MB</span>
                </div>
            </div>

            <button type="submit" id="submitBtn" class="w-full bg-emerald-700 text-white py-3 rounded-xl text-xs font-semibold hover:bg-emerald-800 transition shadow-sm flex items-center justify-center gap-2 opacity-50 cursor-not-allowed" disabled>
                <i class="fa-solid fa-microchip"></i> Proses Analisis AI Sekarang
            </button>
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

<!-- Skrip JavaScript untuk Validasi Klien & Preview Video -->
<script>
    function updateFileName(input) {
        const display = document.getElementById('fileNameDisplay');
        const submitBtn = document.getElementById('submitBtn');
        
        // Element untuk Preview Video
        const defaultState = document.getElementById('defaultUploadState');
        const previewState = document.getElementById('videoPreviewState');
        const videoPlayer = document.getElementById('videoPlayer');
        
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const fileSize = file.size; // dalam bytes
            const fileName = file.name;
            const fileExt = fileName.split('.').pop().toLowerCase();

            // Validasi Tipe File (hanya mp4)
            if (fileExt !== 'mp4') {
                alert('Format file harus berjenis: MP4.');
                resetUploader(input, display, submitBtn, defaultState, previewState, videoPlayer);
                return;
            }

            // Validasi Ukuran File (Maksimal 50MB)
            const maxSizeBytes = 50 * 1024 * 1024;
            if (fileSize > maxSizeBytes) {
                alert('Ukuran file video maksimal adalah 50 MB.');
                resetUploader(input, display, submitBtn, defaultState, previewState, videoPlayer);
                return;
            }

            // --- JIKA VALIDASI LOLOS --- //
            
            // 1. Buat URL sementara untuk file video dan set ke player
            const fileURL = URL.createObjectURL(file);
            videoPlayer.src = fileURL;

            // 2. Ganti Tampilan UI (Sembunyikan ikon cloud, tampilkan player)
            defaultState.classList.add('hidden');
            previewState.classList.remove('hidden');
            previewState.classList.add('flex');

            // 3. Update teks nama file & aktifkan tombol submit
            display.textContent = "File terpilih: " + fileName;
            display.classList.remove('italic', 'text-gray-400');
            display.classList.add('text-emerald-700', 'font-bold');
            submitBtn.disabled = false;
            submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');

        } else {
            // Jika dialog dibatalkan (tidak memilih file apa-apa)
            resetUploader(input, display, submitBtn, defaultState, previewState, videoPlayer);
        }
    }

    // Fungsi Pembantu untuk mengembalikan tampilan ke awal jika terjadi error/batal
    function resetUploader(input, display, submitBtn, defaultState, previewState, videoPlayer) {
        input.value = ''; // Reset input
        
        // Bersihkan memori dan hapus source video
        if (videoPlayer.src) {
            URL.revokeObjectURL(videoPlayer.src);
            videoPlayer.src = '';
        }

        // Kembalikan UI ke awal
        defaultState.classList.remove('hidden');
        previewState.classList.add('hidden');
        previewState.classList.remove('flex');

        display.textContent = "Belum ada file yang dipilih";
        display.classList.add('italic', 'text-gray-400');
        display.classList.remove('text-emerald-700', 'font-bold');
        submitBtn.disabled = true;
        submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
    }
</script>
@endsection
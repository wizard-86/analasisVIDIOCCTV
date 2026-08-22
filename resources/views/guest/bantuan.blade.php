@extends('layouts.app')
@section('content')
<div class="space-y-6">
    <!-- Banner Pencarian -->
    <div class="bg-emerald-50 border border-emerald-100 rounded-2xl p-8 text-center shadow-sm">
        <h2 class="text-2xl font-bold text-gray-900 mb-2">Pusat Bantuan & Panduan</h2>
        <p class="text-sm text-gray-600 mb-6">Temukan jawaban atas pertanyaan Anda dan pelajari cara memaksimalkan kemampuan analisis video cerdas.</p>
        <div class="max-w-xl mx-auto relative">
            <input type="text" placeholder="Cari topik, masalah, atau panduan..." class="w-full bg-white border border-gray-300 rounded-full py-3 px-6 text-sm focus:outline-none focus:border-emerald-600 shadow-sm">
            <i class="fa-solid fa-magnifying-glass absolute right-5 top-3.5 text-gray-400"></i>
        </div>
    </div>

    <div class="grid grid-cols-3 gap-6">
        <!-- FAQ & Buku Panduan -->
        <div class="col-span-2 space-y-6">
            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                <h3 class="font-bold text-gray-800 mb-4">Pertanyaan Umum (FAQ)</h3>
                <div class="space-y-3 text-sm">
                    <details class="border-b pb-3 group">
                        <summary class="font-medium cursor-pointer text-gray-700 flex justify-between items-center">
                            Bagaimana cara mengunggah video untuk dianalisis?
                            <i class="fa-solid fa-chevron-down text-xs text-gray-400"></i>
                        </summary>
                        <p class="text-xs text-gray-500 mt-2 pl-2 border-l-2 border-emerald-600">Masuk ke menu Beranda, lalu tarik dan letakkan file video berformat MP4 atau AVI ke dalam area unggah (maksimal 500MB).</p>
                    </details>
                    <details class="border-b pb-3 group">
                        <summary class="font-medium cursor-pointer text-gray-700 flex justify-between items-center">
                            Format video apa saja yang didukung oleh sistem?
                            <i class="fa-solid fa-chevron-down text-xs text-gray-400"></i>
                        </summary>
                        <p class="text-xs text-gray-500 mt-2 pl-2 border-l-2 border-emerald-600">Sistem mendukung format video standar MP4 dan AVI dengan kompresi H.264.</p>
                    </details>
                    <details class="border-b pb-3 group">
                        <summary class="font-medium cursor-pointer text-gray-700 flex justify-between items-center">
                            Berapa lama waktu yang dibutuhkan untuk proses analisis AI?
                            <i class="fa-solid fa-chevron-down text-xs text-gray-400"></i>
                        </summary>
                        <p class="text-xs text-gray-500 mt-2 pl-2 border-l-2 border-emerald-600">Proses deteksi anomali berjalan real-time dan selesai dalam beberapa detik hingga 1 menit tergantung durasi video.</p>
                    </details>
                    <details class="pb-2 group">
                        <summary class="font-medium cursor-pointer text-gray-700 flex justify-between items-center">
                            Bagaimana sistem mendeteksi "anomali" keamanan?
                            <i class="fa-solid fa-chevron-down text-xs text-gray-400"></i>
                        </summary>
                        <p class="text-xs text-gray-500 mt-2 pl-2 border-l-2 border-emerald-600">Menggunakan model neural network terlatih untuk mengenali pola gerakan mencurigakan seperti shoplifting atau intrusi.</p>
                    </details>
                </div>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-gray-800 text-sm">Buku Panduan Lengkap Operator</h3>
                    <p class="text-xs text-gray-500 mt-1">Unduh dokumen PDF teknis berisi panduan kalibrasi dan zona notifikasi.</p>
                </div>
                <button class="bg-emerald-50 text-emerald-700 border border-emerald-200 px-4 py-2 rounded-lg text-xs font-semibold hover:bg-emerald-100 transition flex items-center gap-2">
                    <i class="fa-solid fa-download"></i> Unduh PDF (4.2 MB)
                </button>
            </div>
        </div>

        <!-- Sidebar Bantuan (Alur Kerja & Kontak) -->
        <div class="space-y-6">
            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                <span class="text-[10px] font-bold text-emerald-600 tracking-wider block mb-1">ALUR KERJA CEPAT</span>
                <h3 class="font-bold text-gray-800 mb-4">3 Langkah Analisis</h3>
                <div class="space-y-4 text-xs text-gray-600">
                    <div class="flex items-start gap-3">
                        <span class="bg-emerald-100 text-emerald-800 font-bold w-5 h-5 rounded-full flex items-center justify-center shrink-0">1</span>
                        <p><strong>Pilih Sumber Video:</strong> Unggah file atau sambungkan stream RTSP kamera.</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="bg-emerald-100 text-emerald-800 font-bold w-5 h-5 rounded-full flex items-center justify-center shrink-0">2</span>
                        <p><strong>Konfigurasi AI:</strong> Tentukan model deteksi (Intrusi, Objek, Wajah).</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="bg-emerald-100 text-emerald-800 font-bold w-5 h-5 rounded-full flex items-center justify-center shrink-0">3</span>
                        <p><strong>Pantau Laporan:</strong> Tinjau anomali di tab Riwayat dengan metrik akurasi.</p>
                    </div>
                </div>
                <button class="w-full mt-6 bg-emerald-700 text-white py-2.5 rounded-lg text-xs font-semibold hover:bg-emerald-800 transition flex items-center justify-center gap-2">
                    Mulai Analisis <i class="fa-solid fa-arrow-right"></i>
                </button>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm space-y-3">
                <h3 class="font-bold text-gray-800 text-sm">Hubungi Dukungan</h3>
                <p class="text-xs text-gray-500">Tim teknis kami tersedia 24/7 untuk mengatasi kendala sistem operasional Anda.</p>
                <div class="text-xs space-y-2 pt-2 border-t text-gray-600">
                    <p><i class="fa-regular fa-envelope text-emerald-600 mr-2"></i> support@aegisvision.id</p>
                    <p><i class="fa-solid fa-phone text-emerald-600 mr-2"></i> +62 800 1234 5679</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')
@section('content')
<div class="space-y-6 max-w-7xl mx-auto">
    <!-- Header Title -->
    <div class="flex justify-between items-center mb-2">
        <h2 class="text-2xl font-bold text-gray-900">
            {{ isset($analysis) ? 'Verifikasi Insiden ' . $analysis->incident_code : 'Hasil Analisis AI' }}
        </h2>
    </div>

    @if(isset($analysis))
        <!-- KONDISI 1: JIKA SUDAH ADA VIDEO DIANALISIS -->
        <div class="grid grid-cols-3 gap-6 items-start">
            <!-- Kolom Kiri: Galeri Frame Kejadian & Distribusi (Span 2) -->
            <div class="col-span-2 space-y-6">
                <!-- Galeri Frame Kejadian -->
                <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
                    <h3 class="font-bold text-gray-900 text-sm mb-4">Galeri Frame Kejadian</h3>
                    <div class="grid grid-cols-4 gap-4">
                        @foreach([['00:12', 'Shoplifting', '96%', true], ['00:12', 'Shoplifting', '92%', true], ['00:14', 'Normal', '99%', false], ['00:15', 'Normal', '98%', false], ['00:16', 'Normal', '95%', false], ['00:17', 'Shoplifting', '88%', true], ['00:18', 'Shoplifting', '95%', true]] as $frame)
                        <div class="border border-gray-200 rounded-xl overflow-hidden relative shadow-sm bg-gray-900">
                            <div class="h-28 flex items-center justify-center text-white text-xs opacity-80">Frame</div>
                            <span class="absolute top-1.5 left-1.5 bg-black/70 text-white text-[10px] px-1.5 py-0.5 rounded font-mono">{{ $frame[0] }}</span>
                            <div class="{{ $frame[3] ? 'bg-red-600' : 'bg-emerald-700' }} text-white text-[10px] px-2 py-1 flex justify-between font-bold">
                                <span>{{ $frame[1] }}</span>
                                <span>{{ $frame[2] }}</span>
                            </div>
                        </div>
                        @endforeach
                        <div class="border-2 border-dashed border-gray-200 rounded-xl flex flex-col items-center justify-center text-gray-400 text-xs font-semibold h-28 bg-gray-50/50">
                            +9 Frames
                        </div>
                    </div>
                </div>

                <!-- Analisis Distribusi Frame -->
                <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-gray-900 text-sm mb-3">Analisis Distribusi Frame</h3>
                        <p class="text-xs text-red-600 font-medium mb-1">● Shoplifting: 4 Frames (25%)</p>
                        <p class="text-xs text-emerald-700 font-medium">● Normal: 12 Frames (75%)</p>
                    </div>
                    <div class="flex items-center gap-6 border-l pl-8">
                        <div class="text-right">
                            <span class="text-xs text-gray-400 block font-medium">Persentase Akurasi</span>
                            <span class="text-3xl font-bold text-emerald-700 tracking-tight">{{ $analysis->accuracy ?? 96 }}%</span>
                            <span class="text-[10px] text-emerald-600 font-medium block">Confidence Score</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Prediksi, Detail & Tombol Aksi (Span 1) -->
            <div class="space-y-6">
                <!-- Prediksi Jenis Kejahatan -->
                <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
                    <span class="text-xs font-bold text-gray-400 block mb-3 flex items-center gap-1.5">
                        <i class="fa-solid fa-triangle-exclamation text-red-500"></i> Prediksi Jenis Kejahatan
                    </span>
                    <div class="bg-red-50 border border-red-200 rounded-xl p-4 text-center">
                        <span class="text-red-700 font-extrabold text-2xl tracking-wide">
                            {{ $analysis->status ?? 'Shoplifting' }} <span class="text-red-600">{{ $analysis->accuracy ?? 96 }}%</span>
                        </span>
                    </div>
                </div>

                <!-- Detail Insiden -->
                <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm text-sm space-y-3">
                    <h3 class="font-bold text-gray-900 text-sm border-b pb-3">Detail Insiden</h3>
                    <div class="flex justify-between text-xs py-1"><span class="text-gray-400 font-medium">Waktu Deteksi:</span> <span class="font-bold text-gray-800">{{ $analysis->created_at->format('d M Y, H:i') }} WIB</span></div>
                    <div class="flex justify-between text-xs py-1"><span class="text-gray-400 font-medium">Lokasi:</span> <span class="font-bold text-gray-800">{{ $analysis->location }}</span></div>
                    <div class="flex justify-between text-xs py-1"><span class="text-gray-400 font-medium">ID Kamera:</span> <span class="font-bold text-gray-800">{{ $analysis->camera_id }}</span></div>
                    <div class="flex justify-between text-xs py-1"><span class="text-gray-400 font-medium">Status Sistem:</span> <span class="font-bold text-emerald-700">Otomatis Ditandai</span></div>
                    <div class="flex justify-between text-xs py-1 pt-2 border-t"><span class="text-gray-400 font-medium">Total Frames Dianalisis:</span> <span class="font-bold text-gray-800">{{ $analysis->total_frames }} Frames</span></div>
                </div>

                <!-- Tombol Aksi Guest -->
                <div class="space-y-2.5">
                    <form action="{{ route('guest.verifikasi') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-emerald-700 text-white py-3 rounded-xl text-xs font-semibold hover:bg-emerald-800 transition flex items-center justify-center gap-2 shadow-sm">
                            <i class="fa-solid fa-rotate"></i> Verifikasi Ulang
                        </button>
                    </form>

                    <a href="{{ route('guest.download.laporan') }}" class="w-full bg-white border border-emerald-700 text-emerald-700 py-3 rounded-xl text-xs font-semibold hover:bg-emerald-50 transition flex items-center justify-center gap-2 block text-center shadow-sm">
                        <i class="fa-solid fa-download"></i> Download Laporan (PDF)
                    </a>
                </div>
            </div>
        </div>
    @else
        <!-- KONDISI 2: EMPTY STATE (JIKA BELUM ADA VIDEO DIUNGGAH SAMA SEKALI) -->
        <div class="bg-white border border-gray-200 rounded-2xl p-16 text-center space-y-4 shadow-sm">
            <div class="w-20 h-20 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center text-3xl mx-auto shadow-sm">
                <i class="fa-solid fa-video-slash"></i>
            </div>
            <h3 class="font-bold text-gray-800 text-base">Belum Ada Hasil Analisis</h3>
            <p class="text-xs text-gray-400 max-w-md mx-auto leading-relaxed">
                Anda belum mengunggah rekaman video pengawasan. Silakan kembali ke menu Beranda dan unggah video terlebih dahulu untuk melihat hasil deteksi kecerdasan buatan.
            </p>
            <div class="pt-4">
                <a href="{{ route('guest.beranda') }}" class="inline-flex items-center gap-2 bg-emerald-700 text-white px-6 py-3 rounded-xl text-xs font-semibold hover:bg-emerald-800 transition shadow-sm">
                    <i class="fa-solid fa-house"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    @endif
</div>
@endsection

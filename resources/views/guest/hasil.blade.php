@extends('layouts.app')
@section('content')
<!-- Tambahkan CDN Chart.js di bagian atas atau di layout utama Anda -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

            <!-- Kolom Kiri: Diagram Timeline, Distribusi, & Top 3 Frame (Span 2) -->
            <div class="col-span-2 space-y-6">
                <!-- Diagram Batang (Timeline Analisis) -->
                <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
                    <h3 class="font-bold text-gray-900 text-sm mb-4">Grafik Timeline Analisis Insiden (32 Frame)</h3>
                    <div class="relative h-80 w-full">
                        <canvas id="timelineChart"></canvas>
                    </div>
                </div>

                <!-- Analisis Distribusi Frame -->
                <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-gray-900 text-sm mb-3">Analisis Distribusi Frame</h3>
                        <p class="text-xs text-red-600 font-medium mb-1">● Shoplifting: 8 Frames (25%)</p>
                        <p class="text-xs text-emerald-700 font-medium">● Normal: 24 Frames (75%)</p>
                    </div>
                    <div class="flex items-center gap-6 border-l pl-8">
                        <div class="text-right">
                            <span class="text-xs text-gray-400 block font-medium">Persentase Akurasi</span>
                            <span class="text-3xl font-bold text-emerald-700 tracking-tight">{{ $analysis->accuracy ?? 97 }}%</span>
                            <span class="text-[10px] text-emerald-600 font-medium block">Bobot Attention</span>
                        </div>
                    </div>
                </div>

                <!-- Galeri Frame Kejadian (Top 3 Frame dengan Bobot Tertinggi) -->
                <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
                    <h3 class="font-bold text-gray-900 text-sm mb-4">Top 3 Frame - Bobot Attention</h3>
                    <div class="grid grid-cols-3 gap-4">
                        @foreach([
                            ['14', 'Normal', '99%', false],
                            ['15', 'Normal', '98%', false],
                            ['12', 'Shoplifting', '96%', true]
                        ] as $frame)
                        <div class="border border-gray-200 rounded-xl overflow-hidden relative shadow-sm bg-gray-900">
                            <div class="h-28 flex items-center justify-center text-white text-xs opacity-80">Visual Frame {{ $frame[0] }}</div>
                            <span class="absolute top-2 left-2 bg-black/70 text-white text-[10px] px-1.5 py-0.5 rounded font-mono">Frame {{ $frame[0] }}</span>
                            <div class="{{ $frame[3] ? 'bg-red-600' : 'bg-emerald-700' }} text-white text-xs px-2.5 py-1.5 flex justify-between font-bold">
                                <span>{{ $frame[1] }}</span>
                                <span>{{ $frame[2] }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Video Validasi, Prediksi & Tombol Aksi (Span 1) -->
            <div class="space-y-6">
                <!-- Video Player untuk Validasi -->
                <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm space-y-4">
                    <h3 class="font-bold text-gray-900 text-sm">Rekaman Video Asli</h3>
                    <div class="rounded-xl overflow-hidden border border-gray-200 bg-black shadow-sm flex items-center justify-center">
                        <video class="w-full max-h-[220px] object-contain" controls preload="metadata">
                            <source src="{{ asset('storage/' . $analysis->video_name) }}" type="video/mp4">
                            Browser Anda tidak mendukung pemutaran video.
                        </video>
                    </div>

                    <!-- Keterangan Detail Berkas Video Asli Sesuai Permintaan Dosen -->
                    <div class="border-t border-gray-100 pt-3 space-y-2 text-xs">
                        <div class="flex justify-between py-0.5">
                            <span class="text-gray-400 font-medium">Nama File Sistem</span>
                            <span class="text-gray-800 font-bold truncate max-w-[150px]" title="{{ basename($analysis->video_name ?? '') }}">
                                {{ basename($analysis->video_name ?? '-') }}
                            </span>
                        </div>
                        <div class="flex justify-between py-0.5">
                            <span class="text-gray-400 font-medium">Nama Asli Video</span>
                            <span class="text-gray-800 font-bold truncate max-w-[150px]" title="{{ $analysis->location ?? '' }}">
                                {{ $analysis->location ?? '-' }}
                            </span>
                        </div>
                        <div class="flex justify-between py-0.5">
                            <span class="text-gray-400 font-medium">Resolusi Video</span>
                            <span class="text-gray-800 font-bold">1280 x 720 (HD)</span>
                        </div>
                        <div class="flex justify-between py-0.5">
                            <span class="text-gray-400 font-medium">Ukuran Berkas</span>
                            <span class="text-gray-800 font-bold">
                                @php
                                    $fileSizeFormatted = '0 MB';
                                    if (!empty($analysis->video_name)) {
                                        $publicPath = public_path('storage/' . $analysis->video_name);
                                        $storagePath = storage_path('app/public/' . $analysis->video_name);

                                        if (file_exists($publicPath)) {
                                            $bytes = filesize($publicPath);
                                        } elseif (file_exists($storagePath)) {
                                            $bytes = filesize($storagePath);
                                        } else {
                                            $bytes = 0;
                                        }

                                        if ($bytes > 0) {
                                            $fileSizeFormatted = $bytes >= 1048576
                                                ? round($bytes / 1048576, 2) . ' MB'
                                                : round($bytes / 1024, 2) . ' KB';
                                        }
                                    }
                                @endphp
                                {{ $fileSizeFormatted }}
                            </span>
                        </div>
                        <div class="flex justify-between py-0.5">
                            <span class="text-gray-400 font-medium">Panjang / Durasi</span>
                            <span class="text-gray-800 font-bold">00:03 Detik</span>
                        </div>
                    </div>
                </div>

                <!-- Prediksi Jenis Kejahatan -->
                <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
                    <span class="text-xs font-bold text-gray-400 block mb-3 flex items-center gap-1.5">
                        <i class="fa-solid fa-triangle-exclamation text-red-500"></i> Prediksi Jenis Kejahatan
                    </span>

                    <div class="bg-red-50 border border-red-200 rounded-xl p-4 text-center">
                        <span class="text-red-700 font-extrabold text-2xl tracking-wide">
                            {{ $analysis->status ?? 'Shoplifting' }} <span class="text-red-600">{{ $analysis->accuracy ?? 97 }}%</span>
                        </span>
                    </div>
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
        <!-- KONDISI 2: EMPTY STATE -->
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

@if(isset($analysis))
<!-- Inisialisasi Chart.js untuk Diagram Batang 32 Frame Tampil Semua -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('timelineChart').getContext('2d');

        const labels32 = [];
        const dataScores32 = [];
        const backgroundColors32 = [];

        for (let i = 1; i <= 32; i++) {
            labels32.push('Frame ' + i);

            let score = Math.floor(Math.random() * (99 - 75 + 1)) + 75;
            dataScores32.push(score);

            if (score < 90) {
                backgroundColors32.push('#ef4444');
            } else {
                backgroundColors32.push('#047857');
            }
        }

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels32,
                datasets: [{
                    label: 'Bobot Attention (%)',
                    data: dataScores32,
                    backgroundColor: backgroundColors32,
                    borderRadius: 3,
                    barPercentage: 0.8,
                    categoryPercentage: 0.9
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let value = context.parsed.y;
                                let status = value < 90 ? 'Shoplifting' : 'Normal';
                                return `${status} (Bobot: ${value}%)`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        title: {
                            display: true,
                            text: 'Bobot Attention (%)',
                            font: { size: 10 }
                        }
                    },
                    x: {
                        ticks: {
                            autoSkip: false,
                            maxRotation: 45,
                            minRotation: 45,
                            font: { size: 9 }
                        },
                        title: {
                            display: true,
                            text: 'Frame (Total 32 Frame)',
                            font: { size: 10 }
                        }
                    }
                }
            }
        });
    });
</script>
@endif
@endsection

@extends('layouts.app')

@section('content')
<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@php
    // ==== Ambil data dari apiResponse, dengan fallback aman ====
    $prediction      = $apiResponse['prediction']        ?? ($analysis->status ?? 'Unknown');
    $confidence      = $apiResponse['confidence']        ?? (($analysis->accuracy ?? 0) / 100);
    $attentionWeights= $apiResponse['attention_weights'] ?? [];
    $topFrames       = $apiResponse['top_frames']        ?? [];
    $videoMeta       = $apiResponse['video_metadata']    ?? [];
    $predMeta        = $apiResponse['prediction_metadata'] ?? [];
    $threshold       = $predMeta['threshold']            ?? 0.5;

    // Hitung distribusi frame dari attention weights
    $totalFrames      = count($attentionWeights);
    $shopliftingCount = 0;
    $normalCount      = 0;
    foreach ($attentionWeights as $w) {
        // Threshold: weight di atas rata-rata/ambang tertentu dianggap "mencurigakan"
        // Kita pakai threshold dari metadata (0.5) untuk klasifikasi per-frame
        if ($w >= $threshold) {
            $shopliftingCount++;
        } else {
            $normalCount++;
        }
    }
    $shopliftingPct = $totalFrames > 0 ? round($shopliftingCount / $totalFrames * 100) : 0;
    $normalPct      = $totalFrames > 0 ? round($normalCount / $totalFrames * 100) : 0;

    // Badge warna
    $isShoplifting = strtolower($prediction) === 'shoplifting';
@endphp

<div class="space-y-6 max-w-7xl mx-auto">
    <!-- Header -->
    <div class="flex justify-between items-center mb-2">
        <h2 class="text-2xl font-bold text-gray-900">
            {{ isset($analysis) ? 'Verifikasi Insiden ' . $analysis->incident_code : 'Hasil Analisis AI' }}
        </h2>
    </div>

    @if(isset($analysis))
        <div class="grid grid-cols-3 gap-6 items-start">

            <!-- ============ KOLOM KIRI ============ -->
            <div class="col-span-2 space-y-6">

                <!-- Diagram Batang (Timeline Analisis) -->
                <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
                    <h3 class="font-bold text-gray-900 text-sm mb-4">
                        Grafik Timeline Analisis Insiden ({{ $totalFrames }} Frame)
                    </h3>
                    <div class="relative h-80 w-full">
                        <canvas id="timelineChart"></canvas>
                    </div>
                </div>

                <!-- Analisis Distribusi Frame -->
                <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-gray-900 text-sm mb-3">Analisis Distribusi Frame</h3>
                        <p class="text-xs {{ $isShoplifting ? 'text-red-600' : 'text-emerald-700' }} font-medium mb-1">
                            ● {{ $prediction }}: {{ $shopliftingCount }} Frames ({{ $shopliftingPct }}%)
                        </p>
                        <p class="text-xs text-emerald-700 font-medium">
                            ● Normal: {{ $normalCount }} Frames ({{ $normalPct }}%)
                        </p>
                    </div>
                    <div class="flex items-center gap-6 border-l pl-8">
                        <div class="text-right">
                            <span class="text-xs text-gray-400 block font-medium">Persentase Akurasi</span>
                            <span class="text-3xl font-bold {{ $isShoplifting ? 'text-red-700' : 'text-emerald-700' }} tracking-tight">
                                {{ number_format($confidence * 100, 0) }}%
                            </span>
                            <span class="text-[10px] text-gray-500 font-medium block">Confidence Score</span>
                        </div>
                    </div>
                </div>

                <!-- Top 3 Frame -->
                <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
                    <h3 class="font-bold text-gray-900 text-sm mb-4">Top 3 Frame - Bobot Attention</h3>

                    @if(!empty($topFrames))
                        <div class="grid grid-cols-3 gap-4">
                            @foreach($topFrames as $frame)
                                @php
                                    $frameWeight = $frame['weight'] ?? 0;
                                    $frameLabel  = $prediction; // label dari prediksi global
                                    $framePct    = number_format($frameWeight * 100, 0);
                                    $frameRed    = $isShoplifting;
                                @endphp
                                <div class="border border-gray-200 rounded-xl overflow-hidden relative shadow-sm bg-gray-900">
                                    <img src="{{ $frame['image'] }}"
                                         alt="Frame {{ $frame['frame_index'] }}"
                                         class="w-full h-28 object-cover">

                                    <span class="absolute top-2 left-2 bg-black/70 text-white text-[10px] px-1.5 py-0.5 rounded font-mono">
                                        Frame {{ $frame['frame_index'] }}
                                    </span>
                                    <span class="absolute top-2 right-2 bg-black/70 text-white text-[10px] px-1.5 py-0.5 rounded font-mono">
                                        {{ number_format($frame['timestamp_sec'] ?? 0, 1) }}s
                                    </span>

                                    <div class="{{ $frameRed ? 'bg-red-600' : 'bg-emerald-700' }} text-white text-xs px-2.5 py-1.5 flex justify-between font-bold">
                                        <span>{{ $frameLabel }}</span>
                                        <span>{{ $framePct }}%</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-xs text-gray-400 italic text-center py-6">
                            Tidak ada frame dengan bobot attention.
                        </p>
                    @endif
                </div>
            </div>

            <!-- ============ KOLOM KANAN ============ -->
            <div class="space-y-6">

                <!-- Video Player -->
                <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm space-y-4">
                    <h3 class="font-bold text-gray-900 text-sm">Rekaman Video Asli</h3>
                    <div class="rounded-xl overflow-hidden border border-gray-200 bg-black shadow-sm flex items-center justify-center">
                        <video class="w-full max-h-[220px] object-contain" controls preload="metadata">
                            <source src="{{ asset('storage/' . $analysis->video_name) }}" type="video/mp4">
                            Browser Anda tidak mendukung pemutaran video.
                        </video>
                    </div>

                    <!-- Metadata video dari apiResponse -->
                    <div class="border-t border-gray-100 pt-3 space-y-2 text-xs">
                        <div class="flex justify-between py-0.5">
                            <span class="text-gray-400 font-medium">Nama File Sistem</span>
                            <span class="text-gray-800 font-bold truncate max-w-[150px]" title="{{ basename($analysis->video_name ?? '') }}">
                                {{ basename($analysis->video_name ?? '-') }}
                            </span>
                        </div>
                        <div class="flex justify-between py-0.5">
                            <span class="text-gray-400 font-medium">Nama Asli Video</span>
                            <span class="text-gray-800 font-bold truncate max-w-[150px]" title="{{ $videoMeta['filename'] ?? $analysis->location }}">
                                {{ $videoMeta['filename'] ?? $analysis->location ?? '-' }}
                            </span>
                        </div>
                        <div class="flex justify-between py-0.5">
                            <span class="text-gray-400 font-medium">Resolusi Video</span>
                            <span class="text-gray-800 font-bold">
                                {{ $videoMeta['resolution'] ?? '1280 x 720 (HD)' }}
                            </span>
                        </div>
                        <div class="flex justify-between py-0.5">
                            <span class="text-gray-400 font-medium">Ukuran Berkas</span>
                            <span class="text-gray-800 font-bold">
                                @php
                                    $fileSizeFormatted = '0 MB';
                                    if (!empty($analysis->video_name)) {
                                        $publicPath  = public_path('storage/' . $analysis->video_name);
                                        $storagePath = storage_path('app/public/' . $analysis->video_name);
                                        $bytes = file_exists($publicPath)
                                            ? filesize($publicPath)
                                            : (file_exists($storagePath) ? filesize($storagePath) : 0);

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
                            <span class="text-gray-400 font-medium">FPS</span>
                            <span class="text-gray-800 font-bold">
                                {{ $videoMeta['fps'] ?? '-' }} fps
                            </span>
                        </div>
                        <div class="flex justify-between py-0.5">
                            <span class="text-gray-400 font-medium">Panjang / Durasi</span>
                            <span class="text-gray-800 font-bold">
                                @if(isset($videoMeta['duration_sec']))
                                    {{ gmdate("i:s", $videoMeta['duration_sec']) }} Menit
                                @else
                                    -
                                @endif
                            </span>
                        </div>
                        <div class="flex justify-between py-0.5">
                            <span class="text-gray-400 font-medium">Waktu Proses AI</span>
                            <span class="text-gray-800 font-bold">
                                {{ $predMeta['processing_time_ms'] ?? '-' }} ms
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Prediksi -->
                <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
                    <span class="text-xs font-bold text-gray-400 block mb-3 flex items-center gap-1.5">
                        <i class="fa-solid fa-triangle-exclamation text-red-500"></i> Prediksi Jenis Kejahatan
                    </span>

                    <div class="{{ $isShoplifting ? 'bg-red-50 border-red-200' : 'bg-emerald-50 border-emerald-200' }} border rounded-xl p-4 text-center">
                        <span class="{{ $isShoplifting ? 'text-red-700' : 'text-emerald-700' }} font-extrabold text-2xl tracking-wide">
                            {{ $prediction }}
                            <span class="{{ $isShoplifting ? 'text-red-600' : 'text-emerald-600' }}">
                                {{ number_format($confidence * 100, 0) }}%
                            </span>
                        </span>
                    </div>
                </div>

                <!-- Tombol Aksi -->
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
        <!-- EMPTY STATE -->
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

@if(isset($analysis) && !empty($attentionWeights))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('timelineChart').getContext('2d');

        // Data dari controller
        const weights     = @json($attentionWeights);
        const topIdx      = @json(collect($topFrames)->pluck('frame_index')->all());
        const threshold   = {{ $threshold }};
        const isShop      = {{ $isShoplifting ? 'true' : 'false' }};

        const labels = weights.map((_, i) => 'Frame ' + (i + 1));

        // Warna: merah kalau di top 3 ATAU weight >= threshold
        const bgColors = weights.map((w, i) =>
            (topIdx.includes(i) || w >= threshold) ? '#ef4444' : '#047857'
        );

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Bobot Attention (%)',
                    data: weights.map(w => +(w * 100).toFixed(2)), // konversi ke %
                    backgroundColor: bgColors,
                    borderRadius: 3,
                    barPercentage: 0.8,
                    categoryPercentage: 0.9
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let value = context.parsed.y;
                                let status = value >= (threshold * 100) ? 'High Attention' : 'Low Attention';
                                let isTop = topIdx.includes(context.dataIndex) ? ' ⭐ Top Frame' : '';
                                return `${status} (Bobot: ${value}%)${isTop}`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
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
                            text: `Frame (Total ${weights.length} Frame)`,
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
@extends('layouts.user')
@section('content')
<div class="space-y-6 max-w-7xl mx-auto">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Selamat Datang, User</h2>
        <p class="text-xs text-gray-500 mt-0.5">Berikut adalah ringkasan aktivitas analisis video Anda hari ini.</p>
    </div>

    <!-- Kolom Pencarian Aktif -->
    <form action="{{ route('user.search') }}" method="GET" class="relative">
        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
            <i class="fa-solid fa-magnifying-glass"></i>
        </span>
        <input type="text" name="q" placeholder="Cari berdasarkan kode insiden, lokasi, atau status..." class="w-full bg-white border border-gray-200 rounded-2xl py-3 pl-11 pr-4 text-xs focus:outline-none focus:border-emerald-600 shadow-sm">
    </form>

    <!-- 3 Kartu Statistik Dinamis dari Database -->
    <div class="grid grid-cols-3 gap-6">
        <!-- Kartu Video Saya -->
        <a href="{{ route('user.video.tersimpan') }}" class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm hover:border-emerald-600 transition block">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-xl">
                    <i class="fa-solid fa-video"></i>
                </div>
                <div>
                    <span class="text-xs text-gray-400 font-medium block">Video Saya</span>
                    <h3 class="text-2xl font-bold text-gray-900">{{ $totalVideo ?? 0 }}</h3>
                </div>
            </div>
        </a>

        <!-- Kartu Analisis Selesai -->
        <a href="{{ route('user.analisis.selesai') }}" class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm hover:border-emerald-600 transition block">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center text-xl">
                    <i class="fa-solid fa-square-poll-vertical"></i>
                </div>
                <div>
                    <span class="text-xs text-gray-400 font-medium block">Analisis Selesai</span>
                    <h3 class="text-2xl font-bold text-gray-900">{{ $analisisSelesai ?? 0 }}</h3>
                </div>
            </div>
        </a>

        <!-- Kartu Sisa Kuota Unggah (Dihitung dari sisa kapasitas) -->
        <a href="{{ route('user.penyimpanan') }}" class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm hover:border-emerald-600 transition block">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center text-xl">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                </div>
                <div>
                    <span class="text-xs text-gray-400 font-medium block">Sisa Kuota Unggah</span>
                    <h3 class="text-2xl font-bold text-gray-900">{{ 5 - (($totalVideo ?? 0) * 0.1) }} GB</h3>
                </div>
            </div>
        </a>
    </div>

    <!-- Hasil Analisis Saya & Tombol Lihat Semua -->
    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm space-y-4">
        <div class="flex justify-between items-center">
            <h3 class="font-bold text-gray-900 text-sm">Hasil Analisis Saya</h3>
            <a href="{{ route('user.analisis.selesai') }}" class="text-xs font-semibold text-emerald-700 hover:underline">Lihat Semua</a>
        </div>

        <!-- Grid Preview Aktivitas dari Database -->
        @if(isset($analyses) && $analyses->count() > 0)
            <div class="grid grid-cols-3 gap-4">
                @foreach($analyses as $item)
                <div class="border border-gray-200 rounded-xl p-4 space-y-3 shadow-sm bg-white">
                    <div class="h-28 bg-gray-900 rounded-lg flex items-center justify-center text-white text-xs">
                        <i class="fa-solid fa-file-video text-xl opacity-60 mr-2"></i> {{ $item->incident_code }}
                    </div>
                    <h4 class="font-bold text-gray-800 text-xs truncate">{{ $item->location }}</h4>
                    <div class="flex justify-between items-center text-[10px] pt-2 border-t">
                        <span class="bg-emerald-100 text-emerald-700 px-2.5 py-0.5 rounded-full font-bold">Selesai</span>
                        <a href="{{ route('user.hasil', $item->id) }}" class="text-emerald-700 font-semibold hover:underline">Lihat Detail →</a>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <!-- Tampilan Kosong Jika Belum Ada Data -->
            <div class="py-10 text-center space-y-2 border border-dashed rounded-xl bg-gray-50">
                <p class="text-xs text-gray-400">Belum ada riwayat analisis video yang tercatat di database.</p>
                <a href="{{ route('user.upload') }}" class="inline-block text-xs font-semibold text-emerald-700 hover:underline">Mulai Unggah Video Sekarang</a>
            </div>
        @endif
    </div>
</div>
@endsection

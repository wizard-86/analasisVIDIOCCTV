@extends('layouts.user')
@section('content')
<div class="space-y-6 max-w-7xl mx-auto">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Video Saya</h2>
            <p class="text-xs text-gray-500 mt-0.5">Daftar seluruh rekaman video CCTV yang pernah Anda unggah ke sistem.</p>
        </div>
        <a href="{{ route('user.beranda') }}" class="bg-emerald-700 text-white px-4 py-2 rounded-xl text-xs font-semibold hover:bg-emerald-800 transition">
            + Unggah Video Baru
        </a>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-xs font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
        @if(isset($videos) && $videos->count() > 0)
            <div class="grid grid-cols-3 gap-6">
                @foreach($videos as $video)
                <div class="border border-gray-200 rounded-xl overflow-hidden shadow-sm bg-white space-y-3 p-4">
                    <div class="h-32 bg-gray-900 rounded-lg flex items-center justify-center text-white text-xs">
                        <i class="fa-solid fa-file-video text-2xl opacity-70 mr-2"></i> {{ $video->incident_code }}
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-800 text-xs truncate">{{ $video->location }}</h4>
                        <p class="text-[10px] text-gray-400 mt-0.5">Diupload pada: {{ $video->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <div class="flex justify-between items-center pt-2 border-t text-xs">
                        <span class="text-emerald-700 font-bold">{{ $video->status }}</span>
                        <a href="{{ route('user.hasil', $video->id) }}" class="text-emerald-700 font-semibold hover:underline">Lihat Hasil →</a>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="py-12 text-center space-y-2">
                <div class="text-gray-300 text-4xl mb-2"><i class="fa-solid fa-video-slash"></i></div>
                <h4 class="font-bold text-gray-800 text-sm">Belum Ada Video Tersimpan</h4>
                <p class="text-xs text-gray-400">Silakan unggah video melalui menu beranda terlebih dahulu.</p>
            </div>
        @endif
    </div>
</div>
@endsection

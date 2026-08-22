@extends('layouts.user')
@section('content')
<div class="space-y-6 max-w-7xl mx-auto">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Video Tersimpan</h2>
        <p class="text-xs text-gray-500 mt-0.5">Daftar seluruh rekaman video CCTV yang tersimpan di server cloud Anda.</p>
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl p-8 shadow-sm">
        @if(isset($videos) && $videos->count() > 0)
            <div class="grid grid-cols-3 gap-6">
                @foreach($videos as $video)
                <div class="border border-gray-200 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition bg-white">
                    <div class="h-36 bg-gray-900 flex items-center justify-center text-white text-xs relative">
                        <i class="fa-solid fa-play text-2xl text-white/80"></i>
                        <span class="absolute bottom-2 right-2 bg-black/60 text-white text-[10px] px-2 py-0.5 rounded">02:45 min</span>
                    </div>
                    <div class="p-4 space-y-2">
                        <h4 class="font-bold text-gray-800 text-xs truncate">{{ $video->incident_code }} - {{ $video->location }}</h4>
                        <p class="text-[11px] text-gray-400">Diunggah: {{ $video->created_at->format('d M Y') }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <!-- Tampilan Elegan Saat Belum Ada Video -->
            <div class="py-16 text-center space-y-3">
                <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center text-2xl mx-auto">
                    <i class="fa-solid fa-video-slash"></i>
                </div>
                <h3 class="font-bold text-gray-800 text-sm">Belum Ada Video Tersimpan</h3>
                <p class="text-xs text-gray-400 max-w-sm mx-auto">Anda belum mengunggah rekaman video apapun. Mulai unggah video keamanan melalui menu Unggah Video.</p>
                <div class="pt-3">
                    <a href="{{ route('user.upload') }}" class="inline-block bg-emerald-700 text-white px-5 py-2.5 rounded-xl text-xs font-semibold hover:bg-emerald-800 transition shadow-sm">
                        Unggah Video Sekarang
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

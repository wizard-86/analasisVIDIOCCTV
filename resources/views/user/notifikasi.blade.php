@extends('layouts.user')
@section('content')
<div class="space-y-6 max-w-4xl mx-auto">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Notifikasi & Aktivitas</h2>
        <p class="text-xs text-gray-500 mt-0.5">Riwayat pemberitahuan sistem dan status pemrosesan kecerdasan buatan.</p>
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm space-y-4">
        @if(isset($analyses) && $analyses->count() > 0)
            <div class="space-y-3">
                @foreach($analyses as $item)
                <div class="flex items-center justify-between border-b border-gray-100 pb-3 last:border-none last:pb-0">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center font-bold text-xs">
                            <i class="fa-solid fa-bell"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-xs">Analisis Video Berhasil ({{ $item->incident_code }})</h4>
                            <p class="text-[11px] text-gray-400">Video "{{ $item->location }}" selesai dianalisis dengan status <span class="text-red-600 font-semibold">{{ $item->status }}</span>.</p>
                        </div>
                    </div>
                    <span class="text-[10px] text-gray-400 font-medium">{{ $item->created_at->diffForHumans() }}</span>
                </div>
                @endforeach
            </div>
        @else
            <div class="py-12 text-center space-y-2">
                <div class="text-gray-300 text-3xl mb-1"><i class="fa-regular fa-bell-slash"></i></div>
                <h4 class="font-bold text-gray-800 text-sm">Belum Ada Notifikasi</h4>
                <p class="text-xs text-gray-400">Belum ada aktivitas baru pada sistem Anda.</p>
                <div class="pt-2">
                    <!-- Diperbarui dari user.upload ke user.beranda -->
                    <a href="{{ route('user.beranda') }}" class="text-xs font-semibold text-emerald-700 hover:underline">Mulai Unggah Video</a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

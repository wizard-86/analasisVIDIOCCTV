@extends('layouts.user')
@section('content')
<div class="space-y-6 max-w-7xl mx-auto">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Notifikasi Sistem</h2>
        <p class="text-xs text-gray-500 mt-0.5">Pemberitahuan real-time mengenai aktivitas dan keamanan kamera.</p>
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
        @if(isset($analyses) && $analyses->count() > 0)
            <div class="space-y-4">
                <!-- Notifikasi Selamat Datang / Sistem Aktif -->
                <div class="p-4 bg-emerald-50 border border-emerald-100 rounded-xl flex items-start gap-4">
                    <div class="w-10 h-10 bg-emerald-100 text-emerald-700 rounded-xl flex items-center justify-center text-lg flex-shrink-0">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex justify-between items-center mb-1">
                            <h4 class="font-bold text-gray-900 text-xs">Sistem Keamanan Aktif</h4>
                            <span class="text-[10px] text-gray-400">Baru saja</span>
                        </div>
                        <p class="text-xs text-gray-600">Platform Aegis Vision siap memindai dan menganalisis rekaman video Anda.</p>
                    </div>
                </div>

                <!-- Notifikasi Berdasarkan Aktivitas / Unggahan Video Terbaru -->
                @foreach($analyses as $item)
                <div class="p-4 bg-gray-50 border border-gray-100 rounded-xl flex items-start gap-4">
                    <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-lg flex-shrink-0">
                        <i class="fa-solid fa-video"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex justify-between items-center mb-1">
                            <h4 class="font-bold text-gray-900 text-xs">Analisis Video Selesai ({{ $item->incident_code }})</h4>
                            <span class="text-[10px] text-gray-400">{{ $item->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-xs text-gray-600">Video di lokasi <span class="font-semibold">{{ $item->location }}</span> berhasil diproses dengan status <span class="font-bold text-red-600">{{ $item->status }}</span>.</p>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <!-- Tampilan Kosong (Empty State) Jika Belum Ada Notifikasi / Aktivitas -->
            <div class="py-16 text-center space-y-3">
                <div class="w-16 h-16 bg-gray-100 text-gray-400 rounded-full flex items-center justify-center text-2xl mx-auto shadow-sm">
                    <i class="fa-solid fa-bell-slash"></i>
                </div>
                <h3 class="font-bold text-gray-800 text-sm">Belum Ada Notifikasi</h3>
                <p class="text-xs text-gray-400 max-w-sm mx-auto leading-relaxed">
                    Belum ada aktivitas atau pemberitahuan sistem saat ini. Notifikasi akan muncul otomatis setelah Anda mulai mengunggah video.
                </p>
                <div class="pt-2">
                    <a href="{{ route('user.upload') }}" class="inline-block bg-emerald-700 text-white px-4 py-2 rounded-xl text-xs font-semibold hover:bg-emerald-800 transition">
                        Unggah Video Pertama
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

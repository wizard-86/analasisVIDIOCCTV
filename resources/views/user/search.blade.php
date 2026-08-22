@extends('layouts.user')
@section('content')
<div class="space-y-6 max-w-7xl mx-auto">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Hasil Pencarian</h2>
        <p class="text-xs text-gray-500 mt-0.5">Menampilkan hasil pencarian untuk kata kunci: <span class="font-bold text-emerald-700">"{{ $query ?? '' }}"</span></p>
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl p-8 shadow-sm">
        @if(isset($analyses) && $analyses->count() > 0)
            <div class="space-y-3">
                @foreach($analyses as $item)
                <div class="p-4 border border-gray-100 rounded-xl hover:bg-gray-50 flex justify-between items-center transition">
                    <div class="space-y-1">
                        <div class="flex items-center gap-2">
                            <span class="font-bold text-emerald-800 text-xs">{{ $item->incident_code }}</span>
                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold {{ $item->status == 'Shoplifting' ? 'bg-red-100 text-red-700' : 'bg-emerald-100 text-emerald-700' }}">{{ $item->status }}</span>
                        </div>
                        <p class="text-xs text-gray-600"><i class="fa-solid fa-location-dot text-gray-400 mr-1"></i> {{ $item->location }} ({{ $item->camera_id }})</p>
                    </div>
                    <a href="{{ route('user.hasil', $item->id) }}" class="bg-emerald-50 text-emerald-700 border border-emerald-200 px-4 py-2 rounded-xl text-xs font-semibold hover:bg-emerald-100 transition shadow-sm">
                        Lihat Detail
                    </a>
                </div>
                @endforeach
            </div>
        @else
            <!-- Desain Notifikasi Kata Kunci Tidak Ditemukan -->
            <div class="py-16 text-center space-y-3">
                <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center text-2xl mx-auto shadow-sm">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <h3 class="font-bold text-gray-800 text-sm">Data Tidak Ditemukan</h3>
                <p class="text-xs text-gray-400 max-w-sm mx-auto leading-relaxed">
                    Maaf, kata kunci <span class="font-semibold text-gray-600">"{{ $query }}"</span> tidak cocok dengan data insiden atau rekaman manapun di dalam sistem.
                </p>
                <div class="pt-3">
                    <a href="{{ route('user.dashboard') }}" class="inline-block bg-gray-100 text-gray-700 px-4 py-2 rounded-xl text-xs font-semibold hover:bg-gray-200 transition">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

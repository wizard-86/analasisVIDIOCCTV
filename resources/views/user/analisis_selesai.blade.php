@extends('layouts.user')
@section('content')
<div class="space-y-6 max-w-7xl mx-auto">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Analisis Selesai</h2>
        <p class="text-xs text-gray-500 mt-0.5">Daftar lengkap seluruh investigasi video yang telah selesai diproses oleh AI.</p>
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl p-8 shadow-sm">
        @if(isset($analyses) && $analyses->count() > 0)
            <div class="grid grid-cols-3 gap-6">
                @foreach($analyses as $item)
                <div class="border border-gray-200 rounded-xl p-4 space-y-3 shadow-sm hover:shadow transition bg-white">
                    <div class="flex justify-between items-center">
                        <span class="font-bold text-emerald-800 text-xs">{{ $item->incident_code }}</span>
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-700">Selesai</span>
                    </div>
                    <p class="text-xs font-medium text-gray-800">{{ $item->location }}</p>
                    <div class="flex justify-between items-center pt-2 border-t text-xs">
                        <span class="text-gray-400 text-[11px]">{{ $item->created_at->format('d M Y') }}</span>
                        <a href="{{ route('user.hasil', $item->id) }}" class="text-emerald-700 font-semibold hover:underline">Lihat Detail →</a>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="py-16 text-center space-y-3">
                <div class="w-16 h-16 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center text-2xl mx-auto">
                    <i class="fa-solid fa-folder-open"></i>
                </div>
                <h3 class="font-bold text-gray-800 text-sm">Belum Ada Analisis Selesai</h3>
                <p class="text-xs text-gray-400 max-w-sm mx-auto">Belum ada laporan investigasi AI yang selesai diproses saat ini.</p>
            </div>
        @endif
    </div>
</div>
@endsection

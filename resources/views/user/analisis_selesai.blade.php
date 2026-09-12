@extends('layouts.user')
@section('content')
<div class="space-y-6 max-w-7xl mx-auto">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Analisis Selesai</h2>
        <p class="text-xs text-gray-500 mt-0.5">Daftar laporan investigasi dan riwayat deteksi kecerdasan buatan yang telah tuntas diproses.</p>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-xs font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
        @if(isset($analyses) && $analyses->count() > 0)
            <div class="space-y-3">
                @foreach($analyses as $item)
                <div class="flex items-center justify-between border border-gray-100 rounded-xl p-4 hover:bg-gray-50 transition shadow-sm">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center font-bold text-xs">
                            AI
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-xs">Insiden: {{ $item->incident_code }} - <span class="text-red-600">{{ $item->status }}</span></h4>
                            <p class="text-[11px] text-gray-400">Lokasi/File: {{ $item->location }} | Akurasi: {{ $item->accuracy }}%</p>
                        </div>
                    </div>

                    <!-- Tombol Aksi (Detail & Hapus) -->
                    <div class="flex items-center gap-2">
                        <span class="bg-emerald-100 text-emerald-700 text-[10px] px-3 py-1 rounded-full font-bold">Selesai</span>

                        <a href="{{ route('user.hasil', $item->id) }}" class="bg-gray-100 text-gray-700 px-3 py-1.5 rounded-xl text-xs font-semibold hover:bg-emerald-700 hover:text-white transition">
                            Detail
                        </a>

                        <form action="{{ route('user.penyimpanan.hapus', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus riwayat analisis ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-50 text-red-600 px-3 py-1.5 rounded-xl text-xs font-semibold hover:bg-red-100 transition">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="py-12 text-center space-y-2">
                <div class="text-gray-300 text-4xl mb-2"><i class="fa-solid fa-square-poll-vertical"></i></div>
                <h4 class="font-bold text-gray-800 text-sm">Belum Ada Analisis Selesai</h4>
                <p class="text-xs text-gray-400">Belum ada video yang selesai diproses oleh model AI.</p>
            </div>
        @endif
    </div>
</div>
@endsection

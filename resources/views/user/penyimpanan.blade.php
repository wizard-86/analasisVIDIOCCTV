@extends('layouts.user')
@section('content')
<div class="space-y-6 max-w-7xl mx-auto">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Manajemen Penyimpanan</h2>
        <p class="text-xs text-gray-500 mt-0.5">Kelola kapasitas penyimpanan cloud dan data video riwayat analisis Anda.</p>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-xs font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <!-- Informasi Kapasitas -->
    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm space-y-4">
        <h3 class="font-bold text-gray-900 text-sm">Kapasitas Kuota Cloud</h3>
        <div class="w-full bg-gray-100 rounded-full h-3 overflow-hidden">
            <div class="bg-emerald-600 h-3 rounded-full" style="width: 8%;"></div>
        </div>
        <div class="flex justify-between text-xs text-gray-500 font-medium">
            <span>Terpakai: 0.4 GB dari 5.0 GB</span>
            <span class="text-emerald-700 font-bold">Sisa Kuota: 4.6 GB</span>
        </div>
    </div>

    <!-- Tabel Daftar Video untuk Dikelola/Dihapus -->
    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm space-y-4">
        <h3 class="font-bold text-gray-900 text-sm">Daftar File Tersimpan</h3>

        @if(isset($videos) && $videos->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-gray-50 text-gray-400 uppercase font-bold text-[10px]">
                        <tr>
                            <th class="p-3 rounded-l-xl">Kode Insiden</th>
                            <th class="p-3">Nama File / Lokasi</th>
                            <th class="p-3">Tanggal</th>
                            <th class="p-3 rounded-r-xl text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($videos as $vid)
                        <tr class="hover:bg-gray-50">
                            <td class="p-3 font-bold text-gray-800">{{ $vid->incident_code }}</td>
                            <td class="p-3 text-gray-600">{{ $vid->location }}</td>
                            <td class="p-3 text-gray-500">{{ $vid->created_at->format('d/m/Y H:i') }}</td>
                            <td class="p-3 text-center">
                                <form action="{{ route('user.penyimpanan.hapus', $vid->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data video ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-50 text-red-600 px-3 py-1.5 rounded-lg font-semibold hover:bg-red-100 transition">
                                        <i class="fa-solid fa-trash mr-1"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="py-10 text-center text-gray-400 text-xs">
                Tidak ada file video yang tersimpan di server.
            </div>
        @endif
    </div>
</div>
@endsection

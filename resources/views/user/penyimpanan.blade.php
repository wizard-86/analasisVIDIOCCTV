@extends('layouts.user')
@section('content')
<div class="space-y-6 max-w-7xl mx-auto">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Manajemen Penyimpanan & Kuota</h2>
        <p class="text-xs text-gray-500 mt-0.5">Kelola kapasitas cloud dan hapus video yang tidak dibutuhkan untuk membebaskan kuota.</p>
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl p-8 shadow-sm space-y-6">
        <!-- Progress Bar Kuota -->
        <div class="space-y-2">
            <div class="flex justify-between items-center text-xs">
                <span class="font-bold text-gray-700">Kapasitas Terpakai: 0.5 GB / 5 GB (Sisa 4.5 GB)</span>
                <span class="bg-emerald-100 text-emerald-700 font-bold px-2.5 py-0.5 rounded-full text-[10px]">Optimal</span>
            </div>
            <div class="w-full bg-gray-100 h-3 rounded-full overflow-hidden">
                <div class="bg-emerald-600 h-full w-[10%]"></div>
            </div>
        </div>

        <div class="pt-4 border-t">
            <h4 class="font-bold text-gray-800 text-sm mb-4">Daftar File di Server Cloud</h4>
            @if(isset($videos) && $videos->count() > 0)
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="bg-gray-50 text-gray-500 border-b">
                            <th class="p-3">Kode Insiden / File</th>
                            <th class="p-3">Lokasi</th>
                            <th class="p-3">Waktu</th>
                            <th class="p-3 text-center">Aksi Hapus</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach($videos as $video)
                        <tr class="hover:bg-gray-50">
                            <td class="p-3 font-semibold text-emerald-800">{{ $video->incident_code }}</td>
                            <td class="p-3 text-gray-600">{{ $video->location }}</td>
                            <td class="p-3 text-gray-400">{{ $video->created_at->format('d M Y') }}</td>
                            <td class="p-3 text-center">
                                <form action="{{ route('user.penyimpanan.hapus', $video->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus file ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="bg-red-50 text-red-600 px-3 py-1.5 rounded-lg font-semibold hover:bg-red-100 transition">
                                        <i class="fa-solid fa-trash mr-1"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <!-- Empty State Penyimpanan -->
                <div class="py-12 text-center space-y-3 bg-gray-50 rounded-xl border border-dashed border-gray-200">
                    <div class="w-14 h-14 bg-amber-50 text-amber-600 rounded-full flex items-center justify-center text-xl mx-auto">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                    </div>
                    <h4 class="font-bold text-gray-800 text-sm">Penyimpanan Anda Masih Kosong</h4>
                    <p class="text-xs text-gray-400 max-w-sm mx-auto">Belum ada file rekaman video yang membebani kuota server Anda.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

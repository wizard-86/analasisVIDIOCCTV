@extends('layouts.app')
@section('content')
<div class="space-y-6 max-w-7xl mx-auto">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Riwayat Analisis Tamu</h2>
        <p class="text-xs text-gray-500 mt-0.5">Daftar video dan hasil deteksi anomali yang telah disimpan selama sesi peninjauan Anda.</p>
    </div>

    <!-- Tabel Riwayat -->
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="bg-gray-50 text-gray-500 text-xs border-b">
                    <th class="p-4">Kode Insiden</th>
                    <th class="p-4">Lokasi & Kamera</th>
                    <th class="p-4">Status / Prediksi</th>
                    <th class="p-4">Akurasi</th>
                    <th class="p-4">Waktu</th>
                    <th class="p-4 text-center">Aksi Detail</th>
                </tr>
            </thead>
            <tbody class="divide-y text-gray-700">
                <tr class="hover:bg-gray-50">
                    <td class="p-4 font-semibold text-emerald-800">#INC-8492</td>
                    <td class="p-4">
                        <span class="block font-medium">Area Utara - Lorong B</span>
                        <span class="text-xs text-gray-400">CAM-04-NTH</span>
                    </td>
                    <td class="p-4">
                        <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700">Shoplifting</span>
                    </td>
                    <td class="p-4 font-bold text-emerald-600">96%</td>
                    <td class="p-4 text-xs text-gray-500">14 Okt 2023, 23:42 WIB</td>
                    <td class="p-4 text-center">
                        <a href="{{ route('guest.hasil') }}" class="bg-emerald-50 text-emerald-700 border border-emerald-200 px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-emerald-100 transition">
                            Cek Detail
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection

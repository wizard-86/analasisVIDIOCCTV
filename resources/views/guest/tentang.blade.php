@extends('layouts.app')
@section('content')
<div class="space-y-6">
    <!-- Bagian Atas -->
    <div class="grid grid-cols-3 gap-6">
        <div class="col-span-2 bg-white border border-gray-200 rounded-xl p-8 shadow-sm">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Kecerdasan Buatan untuk <span class="text-emerald-700">Keamanan Presisi</span></h2>
            <p class="text-sm text-gray-600 leading-relaxed">Aegis Vision adalah platform analitik video mutakhir yang dirancang khusus untuk memonitor, mendeteksi, dan menganalisis anomali keamanan secara real-time. Kami menjembatani kesenjangan antara pengawasan konvensional dan respons proaktif melalui teknologi AI yang transparan.</p>
        </div>
        <div class="bg-emerald-600 text-white rounded-xl p-6 flex flex-col justify-center shadow-sm">
            <span class="text-xs uppercase tracking-wider opacity-80 mb-1">STATUS SISTEM GLOBAL</span>
            <h3 class="text-xl font-bold">Optimal & Aman</h3>
        </div>
    </div>

    <!-- Bagian Tengah -->
    <div class="grid grid-cols-3 gap-6">
        <div class="bg-emerald-800 text-white rounded-xl p-6 shadow-sm flex flex-col justify-between">
            <div>
                <h3 class="font-bold text-lg mb-3">Visi Kami</h3>
                <p class="text-xs leading-relaxed opacity-90">Menciptakan ekosistem keamanan global yang bebas dari titik buta (blind spots), di mana teknologi AI bekerja harmonis bersama operator manusia untuk mencegah insiden sebelum terjadi, dengan memprioritaskan privasi dan etika komputasi.</p>
            </div>
        </div>
        <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm flex flex-col justify-center items-center text-center">
            <span class="text-xs text-gray-400 block mb-1">Akurasi Deteksi AI</span>
            <h3 class="text-4xl font-bold text-emerald-700">99.8%</h3>
        </div>
        <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
            <h3 class="font-bold text-lg text-gray-800 mb-2">Infrastruktur Teknologi</h3>
            <p class="text-xs text-gray-600 mb-4">Dibangun di atas arsitektur neural network berkinerja tinggi, sistem kami mampu memproses umpan video beresolusi 4K dengan latensi sub-milidetik.</p>
            <p class="text-xs text-emerald-700 font-medium space-y-1">
                <span class="block">✓ Real-time Edge Computing</span>
                <span class="block">✓ Enkripsi End-to-End 256bit</span>
            </p>
        </div>
    </div>

    <!-- Bagian Bawah -->
    <div class="grid grid-cols-3 gap-6">
        <div class="col-span-2 bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
            <h3 class="font-bold text-gray-800 mb-4">Misi Operasional</h3>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-gray-50 p-4 rounded-lg border">
                    <h4 class="font-semibold text-sm text-emerald-800 mb-1">Efisiensi Deteksi</h4>
                    <p class="text-xs text-gray-600">Memangkas waktu respons operator keamanan hingga 70% dengan memfilter alarm palsu.</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg border">
                    <h4 class="font-semibold text-sm text-emerald-800 mb-1">Integritas Data</h4>
                    <p class="text-xs text-gray-600">Menyimpan dan mengelola rekaman analitik dengan standar kepatuhan regulasi privasi global.</p>
                </div>
            </div>
        </div>
        <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
            <h3 class="font-bold text-gray-800 mb-2">Komitmen Privasi</h3>
            <p class="text-xs text-gray-600 leading-relaxed">Aegis Vision mengimplementasikan fitur pemudaran wajah dinamis (dynamic face blurring) untuk memastikan privasi publik tetap terjaga selama pemantauan pasif.</p>
        </div>
    </div>
</div>
@endsection

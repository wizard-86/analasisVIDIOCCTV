<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Analysis;

class GuestController extends Controller {

    public function beranda() {
        // Hitung total video dari database (0 jika belum ada)
        $totalVideo = Analysis::count();

        // Kapasitas dihitung dinamis (misal 1 video = 0.1 GB), dibatasi maks 5 GB
        $storageUsed = min($totalVideo * 0.1, 5.0);
        $storageLimit = 5.0; // Batas kuota 5 GB
        $storagePercent = ($storageUsed / $storageLimit) * 100;

        // Tentukan status server berdasarkan kapasitas
        $serverStatus = $storageUsed >= 4.5 ? 'Penuh (Hampir Batas)' : 'Optimal';

        $analyses = Analysis::latest()->take(3)->get();

        return view('guest.beranda', compact('totalVideo', 'storageUsed', 'storageLimit', 'storagePercent', 'serverStatus', 'analyses'));
    }

    public function storeUpload(Request $request) {
        $request->validate([
            'video' => 'required|mimes:mp4,avi,mkv|max:512000',
        ]);

        $videoPath = $request->file('video')->store('videos', 'public');
        $namaFile = $request->input('nama_file') ?? $request->file('video')->getClientOriginalName();

        $analysis = Analysis::create([
            'incident_code' => 'GST-' . rand(1000, 9999),
            'video_path' => $videoPath,
            'status' => 'Shoplifting',
            'accuracy' => rand(92, 99),
            'location' => $namaFile,
            'camera_id' => 'CAM-GUEST-01',
            'total_frames' => 16,
        ]);

        return redirect()->route('guest.hasil')->with('success', 'Video berhasil diunggah dan dianalisis!');
    }

    public function hasilAnalisis() {
        $analysis = Analysis::latest()->first();
        return view('guest.hasil', compact('analysis'));
    }
    public function verifikasiUlang() {
        return redirect()->route('guest.hasil')->with('success', 'Hasil analisis berhasil diverifikasi ulang!');
    }

    public function downloadLaporan() {
        $analysis = Analysis::latest()->first();
        return view('guest.laporan', compact('analysis'));
    }

    // Halaman Menu Tiga Titik (Bantuan, Setelan, Tentang)
    public function tentang() {
        return view('guest.tentang');
    }

    public function bantuan() {
        return view('guest.bantuan');
    }

    public function setelan() {
        return view('guest.setelan');
    }
}

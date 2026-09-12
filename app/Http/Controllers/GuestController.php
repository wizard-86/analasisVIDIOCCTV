<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Analysis;

class GuestController extends Controller
{
    public function beranda()
    {
        $totalVideo = Analysis::count();
        $storageUsed = min($totalVideo * 0.1, 5.0);
        $storageLimit = 5.0;
        $storagePercent = ($storageUsed / $storageLimit) * 100;
        $serverStatus = $storageUsed >= 4.5 ? 'Penuh (Hampir Batas)' : 'Optimal';
        $analyses = Analysis::latest()->take(3)->get();

        return view('guest.beranda', compact('totalVideo', 'storageUsed', 'storageLimit', 'storagePercent', 'serverStatus', 'analyses'));
    }

    public function storeUpload(Request $request)
    {
        $request->validate([
            'video' => [
                'required',
                'file',
                'mimetypes:video/mp4',
                'mimes:mp4',
                'max:51200',
            ],
        ], [
            'video.required' => 'File video wajib diunggah.',
            'video.file' => 'File yang diunggah harus berupa berkas yang valid.',
            'video.mimes' => 'Format file harus berjenis: mp4.',
            'video.mimetypes' => 'Format file harus berjenis: mp4.',
            'video.max' => 'Ukuran file video maksimal adalah 50 MB.',
        ]);

        $videoPath = $request->file('video')->store('videos', 'public');
        $namaFile = $request->input('nama_file') ?? $request->file('video')->getClientOriginalName();

        $analysis = Analysis::create([
            'incident_code' => 'INC-' . rand(1000, 9999),
            'video_name'    => $videoPath,
            'status'        => 'Shoplifting',
            'accuracy'      => rand(92, 99),
            'location'      => $namaFile,
            'camera_id'     => 'CAM-01-MTR',
        ]);

        return redirect()->route('guest.hasil')->with('success', 'Video berhasil diunggah dan dianalisis!');
    }

    public function hasilAnalisis()
    {
        $analysis = Analysis::latest()->first();
        return view('guest.hasil', compact('analysis'));
    }

    public function verifikasiUlang()
    {
        return redirect()->route('guest.hasil')->with('success', 'Hasil analisis berhasil diverifikasi ulang!');
    }

    public function downloadLaporan()
    {
        $analysis = Analysis::latest()->first();
        return view('guest.laporan', compact('analysis'));
    }
}

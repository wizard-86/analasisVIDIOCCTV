<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Analysis;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {
    public function dashboard() {
        $totalVideo = Analysis::count();
        $analisisSelesai = Analysis::count();
        $analyses = Analysis::latest()->take(3)->get();

        return view('user.dashboard', compact('totalVideo', 'analisisSelesai', 'analyses'));
    }

    public function upload() {
        return view('user.upload');
    }

    public function storeUpload(Request $request) {
        $request->validate([
            'video' => 'required|mimes:mp4,avi,mkv|max:512000',
        ]);

        $videoPath = $request->file('video')->store('videos', 'public');
        $namaFile = $request->input('nama_file') ?? $request->file('video')->getClientOriginalName();

        $analysis = Analysis::create([
            'user_id' => Auth::id() ?? 1,
            'incident_code' => 'INC-' . rand(1000, 9999),
            'video_path' => $videoPath,
            'status' => 'Shoplifting',
            'accuracy' => rand(92, 99),
            'location' => $namaFile,
            'camera_id' => 'CAM-01-MTR',
            'total_frames' => 16,
        ]);

        return redirect()->route('user.hasil', $analysis->id)->with('success', 'Video berhasil diunggah dan dianalisis!');
    }

    public function search(Request $request) {
        $query = $request->input('q');
        $analyses = Analysis::where('incident_code', 'like', "%$query%")
                            ->orWhere('location', 'like', "%$query%")
                            ->orWhere('status', 'like', "%$query%")
                            ->get();
        return view('user.search', compact('analyses', 'query'));
    }

    public function videoTersimpan() {
        $videos = Analysis::all();
        return view('user.video_tersimpan', compact('videos'));
    }

    public function analisisSelesai() {
        $analyses = Analysis::all();
        return view('user.analisis_selesai', compact('analyses'));
    }

    public function penyimpanan() {
        $videos = Analysis::all();
        return view('user.penyimpanan', compact('videos'));
    }

    public function hapusVideo($id) {
        $analysis = Analysis::find($id);
        if ($analysis) {
            $analysis->delete();
        }
        return redirect()->route('user.penyimpanan')->with('success', 'Video berhasil dihapus dari penyimpanan.');
    }

    public function hasil($id = null) {
        $analysis = $id ? Analysis::find($id) : Analysis::latest()->first();
        return view('user.hasil', compact('analysis'));
    }

    public function verifikasi($id) {
        return redirect()->route('user.hasil', $id)->with('success', 'Insiden berhasil diverifikasi ulang.');
    }

    public function abaikan() {
        return redirect()->route('user.upload');
    }

    public function logout() {
        return redirect()->route('login');
    }

    public function notifikasi() {
        $analyses = Analysis::latest()->take(5)->get(); // Ambil 5 aktivitas terakhir
        return view('user.notifikasi', compact('analyses'));
    }


    // Simpan Pengaturan Sistem
    // Simpan Pengaturan Sistem
    public function updateSetelan(Request $request) {
        // Simpan pilihan tema, volume, dan preferensi ke dalam session
        session([
            'app_theme' => $request->input('theme', 'light'),
            'app_volume' => $request->input('volume', '70'),
            'auto_analysis' => $request->has('auto_analysis'),
            'face_blurring' => $request->has('face_blurring'),
        ]);

        return redirect()->route('user.setelan')->with('success', 'Pengaturan sistem berhasil diperbarui!');
    }

    public function setelan() {
        return view('user.setelan');
    }

  /// Halaman Profil User
    public function profil() {
        $user = Auth::user();
        return view('user.profil', compact('user'));
    }
}

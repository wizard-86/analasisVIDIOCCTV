<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Analysis;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {
    public function riwayat() {
        $totalVideo = Analysis::count();
        $analisisSelesai = Analysis::count();
        $analyses = Analysis::latest()->get();

        return view('user.riwayat', compact('totalVideo', 'analisisSelesai', 'analyses'));
    }

    public function beranda() {
        return view('user.beranda');
    }

    public function storeUpload(Request $request) {
        $request->validate([
            'video' => 'required|mimes:mp4,avi,mkv|max:512000',
        ]);

        $videoPath = $request->file('video')->store('videos', 'public');
        $namaFile = $request->input('nama_file') ?? $request->file('video')->getClientOriginalName();

        // Ambil pilihan target frame dari session user (default 32 jika belum diset)
        $selectedFrames = (int) session('target_frames', 32);

        $analysis = Analysis::create([
            'user_id' => Auth::id() ?? 1,
            'incident_code' => 'INC-' . rand(1000, 9999),
            'video_name' => $videoPath,
            'status' => 'Shoplifting',
            'accuracy' => rand(92, 99),
            'location' => $namaFile,
            'camera_id' => 'CAM-01-MTR',
            'total_frames' => $selectedFrames,
        ]);

        return redirect()->route('user.hasil', $analysis->id)->with('success', 'Video berhasil diunggah dan dianalisis!');
    }

    public function hasil($id = null) {
        // Cek apakah class Analysis ada, lalu ambil data
        $analysis = class_exists(Analysis::class)
            ? ($id ? Analysis::find($id) : Analysis::latest()->first())
            : null;

        // Ambil target frames dengan aman dari database atau session (default 32)
        $targetFrames = 32;

        if ($analysis) {
            if (isset($analysis->total_frames) && !empty($analysis->total_frames)) {
                $targetFrames = (int) $analysis->total_frames;
            } else {
                $targetFrames = (int) session('target_frames', 32);
            }
        } else {
            $targetFrames = (int) session('target_frames', 32);
        }

        return view('user.hasil', compact('analysis', 'targetFrames'));
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

    public function verifikasi($id) {
        return redirect()->route('user.hasil', $id)->with('success', 'Insiden berhasil diverifikasi ulang.');
    }

    public function abaikan() {
        return redirect()->route('user.beranda');
    }

    public function logout() {
        return redirect()->route('login');
    }

    public function notifikasi() {
        $analyses = Analysis::latest()->take(5)->get();
        return view('user.notifikasi', compact('analyses'));
    }

  public function updateSetelan(Request $request) {
        // Simpan preferensi baru ke dalam session (tanpa target_frames)
        session([
            'app_theme' => $request->input('theme', 'light'),
            'auto_analysis' => $request->has('auto_analysis'),
            'face_blurring' => $request->has('face_blurring'),
        ]);

        return redirect()->route('user.setelan')->with('success', 'Pengaturan sistem berhasil diperbarui!');
    }

    public function setelan() {
        return view('user.setelan');
    }

    public function profil() {
        $user = Auth::user();
        return view('user.profil', compact('user'));
    }
}

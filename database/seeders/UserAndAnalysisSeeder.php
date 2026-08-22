<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserAndAnalysisSeeder extends Seeder {
    public function run(): void {
        // Buat data user dummy
        $userId = DB::table('users')->insertGetId([
            'name' => 'Operator Utama',
            'email' => 'user@aegisvision.com',
            'password' => Hash::make('password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Buat data riwayat analisis milik user tersebut
        DB::table('analyses')->insert([
            'user_id' => $userId,
            'incident_code' => 'INC-8492',
            'video_path' => 'videos/sample.mp4',
            'status' => 'Shoplifting',
            'accuracy' => 96,
            'location' => 'Area Utara - Lorong B',
            'camera_id' => 'CAM-04-NTH',
            'total_frames' => 16,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

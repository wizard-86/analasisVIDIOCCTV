<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnalysisSeeder extends Seeder {
    public function run(): void {
        DB::table('analyses')->insert([
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

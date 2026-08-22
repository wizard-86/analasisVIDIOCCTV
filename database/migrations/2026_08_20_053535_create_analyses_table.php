<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('analyses', function (Blueprint $table) {
            $table->id();
            $table->string('incident_code');
            $table->string('video_name');
            $table->string('status'); // Shoplifting / Normal
            $table->integer('accuracy');
            $table->string('location');
            $table->string('camera_id');
            $table->text('details')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('analyses');
    }
};

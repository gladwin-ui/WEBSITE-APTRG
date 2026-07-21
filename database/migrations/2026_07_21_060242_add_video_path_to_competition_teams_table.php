<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('competition_teams', function (Blueprint $table) {
            // Disiapkan untuk tahap video background halaman Tim Lomba (Timed Cards)
            $table->string('video_path')->nullable()->after('image_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('competition_teams', function (Blueprint $table) {
            $table->dropColumn('video_path');
        });
    }
};

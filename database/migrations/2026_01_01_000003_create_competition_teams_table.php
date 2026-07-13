<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('competition_teams', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('team_name');
            $table->string('krti_division');
            $table->string('krti_code');
            $table->string('aircraft_type');
            $table->string('tagline')->nullable();
            $table->text('description');
            $table->text('mission_theme');
            $table->json('specs');
            $table->string('logo_path')->nullable();
            $table->string('image_path')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('competition_teams');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lab_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('abbreviation');
            $table->string('tagline');
            $table->string('faculty');
            $table->year('founded_year');
            $table->text('about');
            $table->text('vision');
            $table->json('mission');
            $table->json('research_focus');
            $table->string('logo_path')->nullable();
            $table->string('instagram')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lab_profiles');
    }
};

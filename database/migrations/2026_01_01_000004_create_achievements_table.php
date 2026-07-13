<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('competition');
            $table->year('year');
            $table->string('rank');
            $table->string('category');
            $table->enum('level', ['Nasional', 'Internasional'])->default('Nasional');
            $table->foreignId('competition_team_id')->nullable()->constrained('competition_teams')->nullOnDelete();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('achievements');
    }
};

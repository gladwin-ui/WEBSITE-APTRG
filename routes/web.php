<?php

use App\Http\Controllers\AchievementController;
use App\Http\Controllers\CompetitionTeamController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StructureController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil', [ProfileController::class, 'index'])->name('profile');

Route::get('/divisi', [DivisionController::class, 'index'])->name('divisions.index');
Route::get('/divisi/{slug}', [DivisionController::class, 'show'])->name('divisions.show');

Route::get('/tim-krti', [CompetitionTeamController::class, 'index'])->name('teams.index');
Route::get('/tim-krti/{slug}', [CompetitionTeamController::class, 'show'])->name('teams.show');

Route::get('/prestasi', [AchievementController::class, 'index'])->name('achievements.index');
Route::get('/struktur', [StructureController::class, 'index'])->name('structure');

Route::get('/media/stream/{filename}', function ($filename) {
    $path = public_path('videos/' . $filename);
    if (!file_exists($path)) {
        $path = public_path('images/' . $filename);
    }
    if (!file_exists($path)) {
        abort(404);
    }
    return response()->file($path, [
        'Content-Type' => 'video/mp4',
        'Cache-Control' => 'public, max-age=31536000',
    ]);
})->name('media.stream');

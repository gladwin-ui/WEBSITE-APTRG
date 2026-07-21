<?php

namespace App\Http\Controllers;

use App\Models\CompetitionTeam;
use Illuminate\View\View;

class CompetitionTeamController extends Controller
{
    public function index(): View
    {
        $teams = CompetitionTeam::orderBy('order')->get();

        // Fallback media: foto lab yang sudah ada, digilir agar tiap tim beda latar
        $fallbacks = [
            'images/foto-mekanik.webp',
            'images/foto-sistem.webp',
            'images/foto-gcs.webp',
            'images/foto-nontech.webp',
            'images/bg-hero-1.webp',
        ];

        $teamsData = $teams->values()->map(function (CompetitionTeam $t, int $i) use ($fallbacks) {
            $hasRealImage = $t->image_path
                && $t->image_path !== 'images/placeholder-uav.svg' // placeholder generik, bukan foto tim
                && file_exists(public_path($t->image_path));
            $image = $hasRealImage ? $t->image_path : $fallbacks[$i % count($fallbacks)];

            return [
                'place'       => trim($t->krti_division . ' · ' . $t->krti_code),
                'title'       => strtoupper(preg_replace('/\s*TEAM$/i', '', $t->team_name)),
                'title2'      => 'TEAM',
                'description' => $t->description,
                'image'       => asset($image),
                'video'       => $t->video_path ? asset($t->video_path) : null,
                'href'        => route('teams.show', $t->slug),
            ];
        })->values();

        return view('teams.index', compact('teams', 'teamsData'));
    }

    public function show(string $slug): View
    {
        $team = CompetitionTeam::with('achievements')->where('slug', $slug)->firstOrFail();

        return view('teams.show', compact('team'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\CompetitionTeam;
use App\Models\Division;
use App\Models\LabProfile;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $profile = LabProfile::first();
        $divisions = Division::orderBy('order')->get();
        $teams = CompetitionTeam::orderBy('order')->get();
        $latestAchievements = Achievement::with('competitionTeam')
            ->orderByDesc('year')
            ->take(3)
            ->get();

        $stats = [
            'divisions_count' => Division::count(),
            'teams_count' => CompetitionTeam::count(),
            'achievements_count' => Achievement::count(),
            'established_year' => $profile?->founded_year ?? 2013,
        ];

        return view('home', compact('profile', 'divisions', 'teams', 'latestAchievements', 'stats'));
    }
}

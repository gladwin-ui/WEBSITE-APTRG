<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\View\View;

class AchievementController extends Controller
{
    public function index(): View
    {
        $achievements = Achievement::with('competitionTeam')
            ->orderByDesc('year')
            ->get();

        $years = $achievements->pluck('year')->unique()->sortDesc()->values();
        $competitions = $achievements->pluck('competition')->unique()->sort()->values();

        return view('achievements.index', compact('achievements', 'years', 'competitions'));
    }
}

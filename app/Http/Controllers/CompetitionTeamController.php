<?php

namespace App\Http\Controllers;

use App\Models\CompetitionTeam;
use Illuminate\View\View;

class CompetitionTeamController extends Controller
{
    public function index(): View
    {
        $teams = CompetitionTeam::orderBy('order')->get();

        return view('teams.index', compact('teams'));
    }

    public function show(string $slug): View
    {
        $team = CompetitionTeam::with('achievements')->where('slug', $slug)->firstOrFail();

        return view('teams.show', compact('team'));
    }
}

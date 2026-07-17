<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Member;
use Illuminate\View\View;

class DivisionController extends Controller
{
    public function index(): View
    {
        $divisions = Division::with('coordinator')->orderBy('order')->get();

        return view('divisions.index', compact('divisions'));
    }

    public function show(string $slug): View
    {
        $division = Division::where('slug', $slug)->firstOrFail();

        // Koordinator divisi ini (level 4 = Koordinator)
        $members = Member::where('division_id', $division->id)
            ->where('level', 4)
            ->get();
        $coordinator = $members->first();

        $responsibilities = is_array($division->responsibilities)
            ? $division->responsibilities
            : (json_decode($division->responsibilities, true) ?? []);

        return view('divisions.show', compact('division', 'coordinator', 'members', 'responsibilities'));
    }
}

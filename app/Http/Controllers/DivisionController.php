<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\View\View;

class DivisionController extends Controller
{
    public function index(): View
    {
        $divisions = Division::orderBy('order')->get();

        return view('divisions.index', compact('divisions'));
    }

    public function show(string $slug): View
    {
        $division = Division::where('slug', $slug)->firstOrFail();
        $members = $division->members()->orderBy('order')->get();

        return view('divisions.show', compact('division', 'members'));
    }
}

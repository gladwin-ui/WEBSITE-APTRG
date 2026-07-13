<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\View\View;

class StructureController extends Controller
{
    public function index(): View
    {
        $members = Member::orderBy('level')->orderBy('order')->get();
        $membersByLevel = $members->groupBy('level');

        return view('structure.index', compact('membersByLevel', 'members'));
    }
}

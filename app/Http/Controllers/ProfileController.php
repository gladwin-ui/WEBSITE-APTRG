<?php

namespace App\Http\Controllers;

use App\Models\LabProfile;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(): View
    {
        $profile = LabProfile::firstOrFail();

        return view('profile', compact('profile'));
    }
}

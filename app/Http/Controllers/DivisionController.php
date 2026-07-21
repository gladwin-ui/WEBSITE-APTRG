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

        // Data untuk galeri Timed Cards (desktop)
        $divisionsData = $divisions->values()->map(function (Division $d) {
            $clean = trim(str_ireplace('Divisi ', '', $d->name));
            $words = explode(' ', $clean);

            // Nama panjang (≥3 kata) dipecah dua baris; selain itu baris 2 = "DIVISION"
            if (count($words) >= 3) {
                $title  = strtoupper(implode(' ', array_slice($words, 0, -1)));
                $title2 = strtoupper(end($words));
            } else {
                $title  = strtoupper($clean);
                if ($title === 'MEKANIK') {
                    $title = 'MECHANIC';
                } elseif ($title === 'SISTEM') {
                    $title = 'SYSTEM';
                }
                $title2 = 'DIVISION';
            }

            $image = ($d->image_path && file_exists(public_path($d->image_path)))
                ? $d->image_path
                : 'images/bg-hero-1.webp';

            return [
                'place'       => 'APTRG',
                'title'       => $title,
                'title2'      => $title2,
                'description' => $d->short_description,
                'image'       => asset($image),
                'video'       => null,
                'href'        => route('divisions.show', $d->slug),
            ];
        })->values();

        return view('divisions.index', compact('divisions', 'divisionsData'));
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LabProfile extends Model
{
    protected $fillable = [
        'name',
        'abbreviation',
        'tagline',
        'faculty',
        'founded_year',
        'about',
        'vision',
        'mission',
        'research_focus',
        'logo_path',
        'instagram',
        'email',
        'address',
    ];

    protected $casts = [
        'mission' => 'array',
        'research_focus' => 'array',
    ];
}

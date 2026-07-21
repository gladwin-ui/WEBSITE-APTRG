<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CompetitionTeam extends Model
{
    protected $fillable = [
        'slug',
        'team_name',
        'krti_division',
        'krti_code',
        'aircraft_type',
        'tagline',
        'description',
        'mission_theme',
        'specs',
        'logo_path',
        'image_path',
        'video_path',
        'order',
    ];

    protected $casts = [
        'specs' => 'array',
    ];

    public function achievements(): HasMany
    {
        return $this->hasMany(Achievement::class);
    }
}

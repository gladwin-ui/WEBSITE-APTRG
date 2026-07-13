<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Achievement extends Model
{
    protected $fillable = [
        'title',
        'competition',
        'year',
        'rank',
        'category',
        'level',
        'competition_team_id',
        'description',
    ];

    public function competitionTeam(): BelongsTo
    {
        return $this->belongsTo(CompetitionTeam::class);
    }
}

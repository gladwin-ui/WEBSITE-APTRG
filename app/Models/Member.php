<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Member extends Model
{
    protected $fillable = [
        'name',
        'position',
        'level',
        'parent_id',
        'division_id',
        'study_program',
        'batch',
        'photo_path',
        'order',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Member::class, 'parent_id');
    }

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    public function getInitialsAttribute(): string
    {
        return collect(explode(' ', trim($this->name)))
            ->filter()->take(2)
            ->map(fn ($w) => mb_strtoupper(mb_substr($w, 0, 1)))
            ->implode('');
    }
}

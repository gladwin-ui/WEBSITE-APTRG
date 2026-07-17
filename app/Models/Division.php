<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Division extends Model
{
    protected $fillable = [
        'slug',
        'name',
        'short_description',
        'description',
        'responsibilities',
        'icon',
        'image_path',
        'order',
    ];

    protected $casts = [
        'responsibilities' => 'array',
    ];

    public function members(): HasMany
    {
        return $this->hasMany(Member::class);
    }

    public function coordinator(): HasOne
    {
        return $this->hasOne(Member::class)->where('level', 4);
    }
}

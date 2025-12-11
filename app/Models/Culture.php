<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Culture extends Model
{
    protected $fillable = [
        'name',
        'description',
        'region',
        'latitude',
        'longitude'
    ];


    public function deities(): HasMany
    {
        return $this->hasMany(Deity::class);
    }

    public function creatures(): HasMany
    {
        return $this->hasMany(Creature::class);
    }

    public function legends(): HasMany
    {
        return $this->hasMany(Legend::class);
    }

    public function getCoordinatesArray()
    {
        return [$this->latitude, $this->longitude];
    }
}
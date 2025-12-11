<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MythClass extends Model
{
    protected $table = 'myth_classes';

    public function deities(): HasMany
    {
        return $this->hasMany(Deity::class);
    }

    public function creatures(): HasMany
    {
        return $this->hasMany(Creature::class);
    }
}
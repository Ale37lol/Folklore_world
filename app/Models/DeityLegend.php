<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class DeityLegend extends Model
{
    public function legend()
{
    return $this->belongsTo(Legend::class);
}

public function deity()
{
    return $this->belongsTo(Deity::class);
}
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Creature extends Model
{
    protected $fillable = [
        'name',
        'type',
        'description',
        'culture_id',
        'class_id'
    ];

    public function culture(): BelongsTo
    {
        return $this->belongsTo(Culture::class);
    }

    public function class(): BelongsTo
    {
        return $this->belongsTo(MythClass::class, 'class_id');
    }

    public function legends()
    {
        return $this->belongsToMany(Legend::class, 'creature_legend')
            ->withPivot('role_in_legend');
    }

    // In your models
    public function scopeSearch($query, $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('name', 'like', "%{$term}%")
              ->orWhere('description', 'like', "%{$term}%")
              ->orWhere('type', 'like', "%{$term}%")
              ->orWhereHas('culture', function ($q) use ($term) {
                  $q->where('name', 'like', "%{$term}%");
              })
              ->orWhereHas('class', function ($q) use ($term) {
                  $q->where('name', 'like', "%{$term}%");
              });
        });
    }
    
}
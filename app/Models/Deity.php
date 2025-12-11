<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Deity extends Model
{
    protected $fillable = [
        'name',
        'role',
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

    public function familyRelations(): HasMany
    {
        return $this->hasMany(DeityFamily::class, 'parent_id');
    }

    public function legends()
    {
        return $this->belongsToMany(Legend::class, 'deity_legend')
            ->withPivot('role_in_legend');
    }

    // In your models
public function scopeSearch($query, $searchTerm)
{
    return $query->where('name', 'like', "%{$searchTerm}%")
        ->orWhere('description', 'like', "%{$searchTerm}%");
}
}
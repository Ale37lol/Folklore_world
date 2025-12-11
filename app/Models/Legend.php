<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Legend extends Model
{
    protected $fillable = [
        'title',
        'content',
        'culture_id',
        'is_verified'
    ];

    public function culture(): BelongsTo
    {
        return $this->belongsTo(Culture::class);
    }

    public function deities()
    {
        return $this->belongsToMany(Deity::class, 'deity_legend')
            ->withPivot('role_in_legend');
    }

    public function creatures()
    {
        return $this->belongsToMany(Creature::class, 'creature_legend')
            ->withPivot('role_in_legend');
    }




    public function scopeSearch($query, $searchTerm)
    {
        return $query->where('name', 'like', "%{$searchTerm}%")
            ->orWhere('description', 'like', "%{$searchTerm}%");
    }
}

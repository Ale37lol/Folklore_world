<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeityFamily extends Model
{
    protected $table = 'deity_families'; // Specifica esplicitamente il nome della tabella
    
    protected $fillable = [
        'parent_id',
        'child_id',
        'relationship_type',
        'notes'
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Deity::class, 'parent_id');
    }

    public function child(): BelongsTo
    {
        return $this->belongsTo(Deity::class, 'child_id');
    }
}
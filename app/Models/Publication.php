<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Publication extends Model
{
    protected $fillable = [
        'academic_id', 'title', 'authors', 'year', 'journal',
        'volume', 'pages', 'url', 'type',
    ];

    public function academic(): BelongsTo
    {
        return $this->belongsTo(Academic::class);
    }
}

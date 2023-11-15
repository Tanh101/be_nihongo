<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mean extends Model
{
    protected $fillable = [
        'word_id',
        'meaning',
        'example',
        'example_meaning',
        'image',
    ];

    public function word(): BelongsTo
    {
        return $this->belongsTo(Word::class);
    }
    
    use HasFactory;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dictionary extends Model
{
    protected $fillable = [
        'word_id',
        'example',
        'example_meaning',
    ];

    public function word():BelongsTo
    {
        return $this->belongsTo(Word::class, 'word_id', 'id');
    }

    use HasFactory, SoftDeletes;
}

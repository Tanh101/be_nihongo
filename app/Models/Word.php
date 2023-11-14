<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Word extends Model
{
    public function vocabularies()
    {
        return $this->belongsTo(Vocabulary::class);
    }

    public function dictionary(): HasOne
    {
        return $this->hasOne(Dictionary::class);
    }

    public function cards()
    {
        return $this->belongsTo(Card::class);
    }

    protected $fillable = [
        'word',
        'meaning',
        'pronunciation',
        'image',
    ];

    use HasFactory, SoftDeletes;
}

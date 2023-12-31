<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Word extends Model
{
    public function vocabulary()
    {
        return $this->belongsTo(Vocabulary::class);
    }

    public function means(): HasMany
    {
        return $this->hasMany(Mean::class);
    }

    protected $fillable = [
        'word',
        'pronunciation',
        'sino_vietnamese',
        'image',
    ];

    use HasFactory, SoftDeletes;
}

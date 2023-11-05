<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    public function vocabulary()
    {
        return $this->belongsTo(Vocabulary::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    protected $fillable = [
        'vocabulary_id',
        'content',
        'meaning',
        'status',
    ];

    use HasFactory, SoftDeletes;
}

<?php

namespace App\Models;

use App\Http\Controllers\words;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
    public function words()
    {
        return $this->belongsTo(Word::class);
    }

    public function flashcards()
    {
        return $this->belongsTo(Flashcard::class);
    }

    use HasFactory, SoftDeletes;
}

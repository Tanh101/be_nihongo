<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    public function vocabularies()
    {
        return $this->belongsTo(Vocabulary::class);
    }

    public function dictionaries()
    {
        return $this->belongsTo(Dictionary::class);
    }

    public function cards()
    {
        return $this->belongsTo(Card::class);
    }

    use HasFactory;
}

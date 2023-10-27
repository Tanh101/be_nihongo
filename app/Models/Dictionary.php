<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dictionary extends Model
{
    public function words()
    {
        return $this->belongsTo(Word::class);
    }

    use HasFactory;
}

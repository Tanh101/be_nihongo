<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    public function vocabularies()
    {
        return $this->hasMany(Vocabulary::class);
    }

    public function topics()
    {
        return $this->belongsTo(Topic::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    use HasFactory;
}

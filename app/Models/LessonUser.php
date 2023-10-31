<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class LessonUser extends Pivot
{
    use HasFactory;

    public function scopeLearning($query)
    {
        return $query->where('status', 'learning');
    }

    public function scopeLearned($query)
    {
        return $query->where('status', 'learned');
    }
}

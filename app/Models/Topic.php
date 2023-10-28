<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    protected $fillable = [
        'name',
        'description',
        'image',
        'status',
    ];
    
    use HasFactory;
}

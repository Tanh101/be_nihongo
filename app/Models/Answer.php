<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    protected $fillable = [
        'question_id',
        'content',
        'is_correct',
        'status',
    ];
    use HasFactory, SoftDeletes;
}

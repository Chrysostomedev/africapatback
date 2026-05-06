<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modèle Option
 */
class Option extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'text',
        'index',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}

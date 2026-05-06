<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modèle Question
 * 
 * Aligné sur les mock data du front.
 */
class Question extends Model
{
    use HasFactory;

    /**
     * Utilisation des UUIDs pour correspondre aux IDs du front (ex: q1, q2).
     */
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'civilization_id',
        'level',
        'question',
        'correct_answer_index',
        'explanation',
        'points',
    ];

    public function civilization()
    {
        return $this->belongsTo(Civilization::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'category',
        'difficulty',
        'reward_amount',
        'is_active',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function gameSessions()
    {
        return $this->hasMany(GameSession::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_score',
        'level',
        'xp_current',
        'xp_next_level',
        'energy',
        'streak_days',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

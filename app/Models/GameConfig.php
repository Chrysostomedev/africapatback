<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modèle GameConfig
 * 
 * Permet de piloter les paramètres des jeux depuis la DB.
 */
class GameConfig extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_key',
        'settings',
        'is_maintenance',
    ];

    protected $casts = [
        'settings' => 'json',
        'is_maintenance' => 'boolean',
    ];
}

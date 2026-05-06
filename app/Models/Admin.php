<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * Modèle Administrateur
 * 
 * Ce modèle est strictement réservé à la gestion de la plateforme par l'équipe AKWABA.
 * Il est totalement dissocié de la table 'users' qui concerne les joueurs.
 * L'authentification se fait par Email/Mot de passe classique.
 * 
 * @package App\Models
 */
class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * Les attributs qui peuvent être assignés massivement.
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Les attributs qui doivent être cachés pour la sérialisation.
     * 
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Les attributs qui doivent être castés dans des types natifs.
     * 
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed', // Hachage automatique du mot de passe
        ];
    }
}

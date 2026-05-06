<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modèle Région
 * 
 * Représente les régions administratives de Côte d'Ivoire (ex: Poro, Grands Ponts).
 * Utilisé pour la localisation des joueurs et les classements régionaux.
 * 
 * @package App\Models
 */
class Region extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',      // Nom de la région
        'code',      // Code administratif (ISO ou autre)
        'capital',   // Chef-lieu (ex: Korhogo, Dabou)
    ];

    /**
     * Relation : Une région contient plusieurs communes.
     */
    public function communes()
    {
        return $this->hasMany(Commune::class);
    }
}

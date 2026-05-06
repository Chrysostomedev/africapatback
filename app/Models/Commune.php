<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modèle Commune (ou Quartier)
 * 
 * Permet une granularité fine pour le ciblage local et les défis.
 * Exemple : Cocody, Yopougon, Marcory.
 * 
 * @package App\Models
 */
class Commune extends Model
{
    use HasFactory;

    protected $fillable = [
        'region_id', // ID de la région parente
        'name',      // Nom de la commune
        'zip_code',  // Code postal si applicable
    ];

    /**
     * Relation : Une commune appartient à une région.
     */
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modèle Civilisation
 * 
 * Représente les groupes culturels et ethniques de Côte d'Ivoire.
 * Ce modèle est au cœur du contenu éducatif d'AKWABA.
 * Exemple: Akan, Krou, Mandé du Nord, Mandé du Sud, Voltaïque.
 * 
 * @package App\Models
 */
class Civilization extends Model
{
    use HasFactory;

    /**
     * Champs assignables massivement.
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'name',          // Nom du groupe (ex: Akan)
        'description',   // Histoire et faits marquants
        'region_id',     // Région d'origine principale (FK)
        'image_path',    // Image représentative (IPFS ou Local)
        'is_active',     // Permet de masquer une civilisation en cours d'édition
    ];

    /**
     * Relation : Une civilisation appartient à une région principale.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mainRegion()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    /**
     * Relation : Une civilisation a plusieurs questions de jeu associées.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}

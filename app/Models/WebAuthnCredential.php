<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modèle WebAuthnCredential
 * 
 * Stocke les données techniques permettant de valider une empreinte digitale
 * ou un FaceID lors d'une connexion sans mot de passe ni signature manuelle de wallet.
 * 
 * @package App\Models
 */
class WebAuthnCredential extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'credential_id',
        'public_key',
        'counter',
        'device_name',
        'last_used_at',
    ];

    protected $casts = [
        'last_used_at' => 'datetime',
    ];

    /**
     * Relation : Le credential appartient à un utilisateur.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

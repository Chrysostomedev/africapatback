<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * Modèle Joueur (User)
 * 
 * C'est le cœur de l'application pour les utilisateurs finaux.
 * L'authentification est hybride : Wallet (MetaMask) + Biométrie (WebAuthn).
 * 
 * @package App\Models
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * Utilisation des UUIDs pour la sécurité des URLs et l'unicité blockchain.
     */
    protected $keyType = 'string';
    public $incrementing = false;

    /**
     * Attributs assignables.
     */
    protected $fillable = [
        'id',               // UUID
        'wallet_address',   // Adresse unique Polygon/MetaMask
        'pseudo',           // Nom d'affichage
        'email',            // Facultatif
        'avatar_url',       // URL vers l'avatar (IPFS ou local)
        'commune_id',       // Localisation ivoirienne (FK)
        'last_login_at',    // Historique de connexion
    ];

    /**
     * Masquer les infos sensibles.
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * Casting des types.
     */
    protected function casts(): array
    {
        return [
            'last_login_at' => 'datetime',
            'wallet_address' => 'string',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relations Eloquent
    |--------------------------------------------------------------------------
    */

    /**
     * Relation : Le joueur appartient à une commune (ivoirienne).
     */
    public function commune()
    {
        return $this->belongsTo(Commune::class);
    }

    /**
     * Relation : Les statistiques de jeu du joueur.
     */
    public function playerProfile()
    {
        return $this->hasOne(Player::class);
    }

    /**
     * Relation : Les clés biométriques (empreinte digitale) du joueur.
     */
    public function webauthnCredentials()
    {
        return $this->hasMany(WebAuthnCredential::class);
    }

    /**
     * Relation : Les NFTs possédés (ERC-1155).
     */
    public function nfts()
    {
        return $this->belongsToMany(Nft::class, 'user_nfts')->withPivot('quantity');
    }
}

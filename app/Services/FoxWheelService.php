<?php

namespace App\Services;

/**
 * Service FoxWheelService (La Roue du Renard)
 * 
 * Gère le système de "Roue de la Fortune" quotidienne (Le Renard Passe Passe).
 * Permet de gagner des tokens, des NFTs ou des bonus d'énergie.
 */
class FoxWheelService
{
    /**
     * Probabilités de la roue (Total 100%)
     */
    protected $probabilities = [
        'Tokens_1' => 50,    // 50% de chance de gagner 1 $AKWABA
        'Tokens_5' => 20,    // 20%
        'Energy_Boost' => 20, // 20%
        'NFT_Common' => 8,    // 8%
        'Jackpot_50' => 2,   // 2%
    ];

    /**
     * Faire tourner la roue.
     */
    public function spin(string $userId)
    {
        // Vérifier si l'utilisateur a déjà tourné aujourd'hui
        // (Logique à ajouter avec la table daily_claims)

        $rand = rand(1, 100);
        $current = 0;
        $reward = 'Nothing';

        foreach ($this->probabilities as $key => $chance) {
            $current += $chance;
            if ($rand <= $current) {
                $reward = $key;
                break;
            }
        }

        return [
            'result' => $reward,
            'message' => "Félicitations ! Tu as gagné : " . str_replace('_', ' ', $reward),
            'timestamp' => now()
        ];
    }
}

<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;

/**
 * Service ChallengeService
 * 
 * Gère les défis hebdomadaires et les récompenses liées à l'engagement.
 * Permet de créer des défis localisés (ex: "Défi de Cocody").
 */
class ChallengeService
{
    /**
     * Liste des défis actifs pour un utilisateur.
     */
    public function getActiveChallenges(string $userId)
    {
        // Simulation de récupération de défis
        return [
            [
                'id' => 1,
                'title' => 'Explorateur Akan',
                'description' => 'Répondre correctement à 20 questions sur la civilisation Akan.',
                'reward_akwaba' => 10.0,
                'progress' => 45, // 45%
            ],
            [
                'id' => 2,
                'title' => 'Champion de Yopougon',
                'description' => 'Gagner 3 parties de Marelle en étant localisé à Yopougon.',
                'reward_akwaba' => 25.0,
                'progress' => 0,
            ]
        ];
    }

    /**
     * Mettre à jour la progression d'un défi.
     */
    public function updateProgress(string $userId, int $challengeId, float $increment)
    {
        // Logique de mise à jour dans challenge_user
        return true;
    }
}

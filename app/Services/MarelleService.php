<?php

namespace App\Services;

use App\Models\GameSession;
use Illuminate\Support\Str;

/**
 * Service MarelleService
 * 
 * Gère la logique du jeu traditionnel de la Marelle (version numérique).
 * Ce jeu met l'accent sur l'agilité et la connaissance des symboles ivoiriens.
 */
class MarelleService
{
    /**
     * Initialiser une partie de Marelle.
     * 
     * @param string $userId
     */
    public function initializeGame(string $userId)
    {
        return [
            'session_id' => (string) Str::uuid(),
            'grid_size' => 10,
            'symbols' => ['Pagne', 'Calebasse', 'Tambour', 'Masque'],
            'difficulty' => 'Normal',
            'expires_at' => now()->addMinutes(10)
        ];
    }

    /**
     * Valider la fin d'une partie et calculer la récompense.
     * 
     * @param string $sessionId
     * @param int $jumps Nombre de sauts réussis
     * @param float $time Temps mis (secondes)
     */
    public function validateAndReward(string $sessionId, int $jumps, float $time)
    {
        // Calcul du score basé sur le ratio sauts/temps
        $score = $jumps * 100 - ($time * 2);
        $reward = $score > 500 ? 5.0 : 0.0; // 5 $AKWABA si score > 500

        return [
            'score' => $score,
            'reward_akwaba' => $reward,
            'status' => 'success'
        ];
    }
}

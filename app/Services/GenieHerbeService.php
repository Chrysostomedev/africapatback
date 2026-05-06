<?php

namespace App\Services;

use App\Models\Question;

/**
 * Service GenieHerbeService
 * 
 * Inspiré du célèbre jeu télévisé "Génie en Herbe".
 * Mode de jeu rapide avec des séries de questions thématiques.
 */
class GenieHerbeService
{
    /**
     * Générer une série de questions pour un "Match" de Génie en Herbe.
     */
    public function startMatch(string $civilizationId)
    {
        // On sélectionne 10 questions de difficulté croissante
        $questions = Question::where('civilization_id', $civilizationId)
            ->with('options')
            ->orderBy('level', 'asc')
            ->limit(10)
            ->get();

        return [
            'match_id' => str()->uuid(),
            'questions' => $questions,
            'time_bonus_multiplier' => 1.5,
        ];
    }

    /**
     * Calculer le score final du match.
     */
    public function calculateMatchScore(array $answers, float $totalTime)
    {
        $correctAnswers = 0;
        foreach ($answers as $answer) {
            if ($answer['is_correct']) {
                $correctAnswers++;
            }
        }

        // Score final : (Réponses correctes * 50) + Bonus de temps
        $baseScore = $correctAnswers * 50;
        $timeBonus = max(0, 300 - $totalTime); // Bonus si fini en moins de 5 min
        
        return [
            'correct_count' => $correctAnswers,
            'total_score' => $baseScore + $timeBonus,
            'rank' => $this->getRank($correctAnswers)
        ];
    }

    private function getRank(int $correct)
    {
        if ($correct >= 9) return 'PHARAON';
        if ($correct >= 7) return 'SAGE';
        if ($correct >= 5) return 'GARDIEN';
        return 'INITIE';
    }
}

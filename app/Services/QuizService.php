<?php

namespace App\Services;

use App\Models\Question;
use App\Models\Option;
use Illuminate\Support\Str;

/**
 * Service QuizService
 * 
 * Gère la banque de questions et les sessions de jeu.
 */
class QuizService
{
    /**
     * Synchroniser une question depuis les mock data.
     */
    public function syncQuestionFromMock(array $data)
    {
        $question = Question::updateOrCreate(
            ['id' => $data['id']],
            [
                'civilization_id' => $data['civilizationId'],
                'level' => $data['level'],
                'question' => $data['question'],
                'correct_answer_index' => $data['correctAnswerIndex'],
                'explanation' => $data['explanation'],
            ]
        );

        // Synchroniser les options
        foreach ($data['options'] as $index => $text) {
            Option::updateOrCreate(
                [
                    'question_id' => $question->id,
                    'index' => $index
                ],
                ['text' => $text]
            );
        }

        return $question;
    }

    /**
     * Récupérer des questions par civilisation et niveau.
     */
    public function getQuestions(string $civilizationId = null, string $level = null)
    {
        $query = Question::with('options');

        if ($civilizationId) {
            $query->where('civilization_id', $civilizationId);
        }

        if ($level) {
            $query->where('level', $level);
        }

        return $query->inRandomOrder()->get();
    }
}

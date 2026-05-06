<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\QuizService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

/**
 * Contrôleur QuizController
 * 
 * Utilisé par les joueurs pour récupérer les questions et soumettre les scores.
 */
class QuizController extends Controller
{
    use ApiResponseTrait;

    protected $quizService;

    public function __construct(QuizService $service)
    {
        $this->quizService = $service;
    }

    /**
     * Liste des questions filtrables.
     */
    public function index(Request $request)
    {
        $questions = $this->quizService->getQuestions(
            $request->civilization_id,
            $request->level
        );

        return $this->success($questions, 'Questions récupérées.');
    }

    /**
     * Synchronisation depuis l'admin (Mock data)
     */
    public function store(Request $request)
    {
        $question = $this->quizService->syncQuestionFromMock($request->all());
        return $this->success($question, 'Question synchronisée.', 201);
    }
}

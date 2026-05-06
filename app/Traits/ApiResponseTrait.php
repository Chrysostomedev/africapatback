<?php

namespace App\Traits;

/**
 * Trait ApiResponseTrait
 * 
 * Permet d'uniformiser toutes les réponses JSON renvoyées par l'API AKWABA.
 * Cela facilite l'intégration côté Next.js avec une structure prédictible.
 */
trait ApiResponseTrait
{
    /**
     * Succès de la requête.
     */
    protected function success($data, string $message = null, int $code = 200)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    /**
     * Erreur de la requête.
     */
    protected function error(string $message = null, int $code, $data = null)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'data' => $data,
        ], $code);
    }
}

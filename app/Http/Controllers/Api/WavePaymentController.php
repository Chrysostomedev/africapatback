<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\WaveService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

/**
 * Contrôleur WavePaymentController
 * 
 * Gère les flux de paiement Mobile Money avec Wave.
 */
class WavePaymentController extends Controller
{
    use ApiResponseTrait;

    protected $waveService;

    public function __construct(WaveService $service)
    {
        $this->waveService = $service;
    }

    /**
     * Initier un dépôt (Recharge Wallet)
     */
    public function deposit(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:100',
        ]);

        $session = $this->waveService->createCheckoutSession(
            $request->amount,
            'XOF',
            'order_' . str()->random(10)
        );

        return $this->success($session, 'Session de paiement Wave créée.');
    }

    /**
     * Webhook de Wave (Appelé par les serveurs Wave lors d'un succès)
     */
    public function webhook(Request $request)
    {
        // Logique de validation de signature Wave ici
        // Mise à jour du solde de l'utilisateur
        
        return response()->json(['status' => 'received']);
    }
}

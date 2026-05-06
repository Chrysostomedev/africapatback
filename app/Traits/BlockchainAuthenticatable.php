<?php

namespace App\Traits;

/**
 * Trait BlockchainAuthenticatable
 * 
 * Ajoute des méthodes utilitaires pour vérifier les signatures Web3 
 * et lier les adresses de wallet aux comptes utilisateurs.
 */
trait BlockchainAuthenticatable
{
    /**
     * Vérifier si une signature Ethereum est valide pour un message donné.
     * (Logique à implémenter avec kornrunner/keccak)
     */
    public function verifyWalletSignature(string $address, string $signature, string $message): bool
    {
        // 1. Récupérer la clé publique depuis la signature (ecrecover)
        // 2. Comparer avec l'adresse fournie
        return true; // Mock pour le moment
    }

    /**
     * Formater une adresse wallet pour la base de données (Lowercase).
     */
    public function formatWalletAddress(string $address): string
    {
        return strtolower(trim($address));
    }
}

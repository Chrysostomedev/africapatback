<?php

namespace App\Helpers;

/**
 * Classe AkwabaHelper
 * 
 * Contient des fonctions utilitaires globales pour le projet.
 */
class AkwabaHelper
{
    /**
     * Formater un montant en Francs CFA (XOF).
     * 
     * @param float $amount
     * @return string
     */
    public static function formatCurrency(float $amount): string
    {
        return number_format($amount, 0, ',', ' ') . ' FCFA';
    }

    /**
     * Tronquer une adresse de wallet pour l'affichage (0x1234...abcd).
     * 
     * @param string $address
     * @return string
     */
    public static function truncateWallet(string $address): string
    {
        return substr($address, 0, 6) . '...' . substr($address, -4);
    }

    /**
     * Générer un ID de transaction unique pour Mobile Money.
     * 
     * @param string $prefix
     * @return string
     */
    public static function generateTxRef(string $prefix = 'AKW'): string
    {
        return $prefix . '_' . strtoupper(str()->random(12));
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * Mailable RewardReceived
 * 
 * Envoyé à l'utilisateur lorsqu'il reçoit des tokens $AKWABA.
 */
class RewardReceived extends Mailable
{
    use Queueable, SerializesModels;

    public $amount;
    public $userName;

    /**
     * Créer une nouvelle instance de message.
     */
    public function __construct($amount, $userName)
    {
        $this->amount = $amount;
        $this->userName = $userName;
    }

    /**
     * Définir l'enveloppe du message.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Félicitations ! Vous avez reçu des tokens $AKWABA',
        );
    }

    /**
     * Définir le contenu du message.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.rewards.received', // Vue à créer dans resources/views/emails
            with: [
                'amount' => $this->amount,
                'userName' => $this->userName,
            ],
        );
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration pour la table 'webauthn_credentials'
 * 
 * Stocke les clés publiques et les métadonnées pour l'authentification biométrique 
 * (empreinte digitale, FaceID) via l'API WebAuthn/Passkeys.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('webauthn_credentials', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('user_id')->constrained()->onDelete('cascade');
            
            // ID unique du credential généré par le device
            $table->string('credential_id', 1024)->index();
            
            // Clé publique pour vérifier la signature
            $table->text('public_key');
            
            // Compteur de signature pour prévenir le rejeu (replay attacks)
            $table->integer('counter')->default(0);
            
            // Type de device (ex: iPhone, Android, Security Key)
            $table->string('device_name')->nullable();
            
            $table->timestamp('last_used_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('webauthn_credentials');
    }
};

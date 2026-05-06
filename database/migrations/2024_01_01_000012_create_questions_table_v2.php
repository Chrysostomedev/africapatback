<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration pour les Questions et Quizzes (V2 - Alignée sur les Mock Data)
 * 
 * Basée sur les niveaux : INITIE, GARDIEN, SAGE, PHARAON, ANCETRE.
 */
return new class extends Migration
{
    public function up(): void
    {
        // Table des Questions
        Schema::create('questions', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Ex: q1
            $table->foreignUuid('civilization_id')->constrained('civilizations')->onDelete('cascade');
            $table->enum('level', ['INITIE', 'GARDIEN', 'SAGE', 'PHARAON', 'ANCETRE']);
            $table->text('question');
            $table->integer('correct_answer_index');
            $table->text('explanation')->nullable();
            $table->integer('points')->default(10);
            $table->timestamps();
        });

        // Table des Options (Réponses possibles)
        Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('question_id')->constrained('questions')->onDelete('cascade');
            $table->string('text');
            $table->integer('index'); // Pour faire correspondre avec correctAnswerIndex
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('options');
        Schema::dropIfExists('questions');
    }
};

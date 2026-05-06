<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('players', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained()->onDelete('cascade');
            $table->bigInteger('total_score')->default(0);
            $table->integer('level')->default(1);
            $table->integer('xp_current')->default(0);
            $table->integer('xp_next_level')->default(1000);
            $table->integer('energy')->default(100);
            $table->integer('streak_days')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};

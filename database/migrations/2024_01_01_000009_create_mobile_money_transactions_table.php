<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mobile_money_transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained()->onDelete('cascade');
            $table->enum('provider', ['Orange', 'Wave', 'MTN']);
            $table->string('external_reference')->nullable();
            $table->decimal('amount', 18, 2);
            $table->string('currency')->default('XOF');
            $table->enum('type', ['Deposit', 'Withdrawal']);
            $table->enum('status', ['Pending', 'Success', 'Failed'])->default('Pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mobile_money_transactions');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('saldo_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('type', ['topup', 'purchase', 'refund']);  // topup=masuk, purchase=keluar
            $table->string('description');
            $table->bigInteger('amount');          // positif = masuk, negatif = keluar
            $table->unsignedBigInteger('balance_after');
            $table->enum('status', ['success', 'pending', 'failed'])->default('success');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('saldo_histories');
    }
};

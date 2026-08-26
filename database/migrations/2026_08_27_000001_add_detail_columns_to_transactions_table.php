<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // ID akun game (User ID / UID / Server ID, dll.)
            $table->string('user_id_game')->nullable()->after('item');

            // Metode pembayaran: saldo = potong saldo, qris = QRIS, dst.
            $table->string('payment_method')->default('saldo')->after('user_id_game');

            // Biaya admin (Rupiah); 0 jika tidak ada
            $table->unsignedBigInteger('admin_fee')->default(0)->after('payment_method');
        });
    }

    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn(['user_id_game', 'payment_method', 'admin_fee']);
        });
    }
};

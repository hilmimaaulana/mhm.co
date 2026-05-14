<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Menambah kolom metode_pembayaran tipe string, boleh kosong (nullable)
            // diletakkan setelah kolom 'status' agar rapi di database
            $table->string('metode_pembayaran')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Menghapus kolom jika migration di-rollback
            $table->dropColumn('metode_pembayaran');
        });
    }
};
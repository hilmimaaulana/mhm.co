<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Kita pakai try-catch manual, jangan pakai Schema::hasColumn
        try {
            Schema::table('orders', function (Blueprint $table) {
                $table->string('metode_pembayaran')->nullable()->after('status');
            });
        } catch (\Exception $e) {
            // Kalau kolom sudah ada, dia bakal error tapi ditangkep di sini
            // Jadi websitenya nggak akan crash
        }
    }

    public function down(): void
    {
        try {
            Schema::table('orders', function (Blueprint $table) {
                $table->dropColumn('metode_pembayaran');
            });
        } catch (\Exception $e) {}
    }
};
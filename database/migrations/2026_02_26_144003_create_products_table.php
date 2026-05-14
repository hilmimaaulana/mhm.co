<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->integer('harga');
            $table->string('gambar'); // Untuk gambar utama
            $table->string('gambar_belakang')->nullable(); // Tambahkan kolom ini agar tidak error
            $table->text('deskripsi')->nullable(); // Opsional: Tambahkan deskripsi jika perlu
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
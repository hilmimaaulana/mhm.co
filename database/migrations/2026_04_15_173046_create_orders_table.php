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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // 1. Tambahkan relasi ke User (siapa yang beli)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // 2. Tambahkan relasi ke Produk (untuk ambil GAMBAR dari tabel produk)
            $table->foreignId('product_id')->constrained()->onDelete('cascade');

            $table->string('nama_produk'); 
            $table->string('size');        
            $table->integer('harga');      
            $table->integer('quantity');   
            
            // 3. Status Pesanan (pending, dikemas, dikirim, tiba)
            $table->string('status')->default('pending'); 

            // 4. Tambahan kolom sesuai Model Order.php sebelumnya
            $table->string('metode_pembayaran')->nullable();
            $table->string('payment_status')->default('belum lunas');

            $table->timestamps();          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
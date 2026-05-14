<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',           // Tambahkan ini agar pesanan terhubung ke user
        'product_id',        // Tambahkan ini agar bisa mengambil gambar dari tabel produk
        'nama_produk',
        'size',
        'harga',
        'quantity',
        'status',            // Untuk menampung status: pending, dikemas, dikirim, tiba
        'metode_pembayaran', 
        'payment_status',    // Untuk menampung status: belum lunas, lunas
    ];

    /**
     * Relasi ke User
     * Satu pesanan dimiliki oleh satu user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Product
     * Ini yang digunakan untuk mengambil GAMBAR produk di halaman user_orders
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
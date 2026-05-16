<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan oleh model ini (opsional jika nama tabelnya 'products').
     */
    protected $table = 'products';

    /**
     * Atribut yang dapat diisi secara massal (Mass Assignable).
     * AMAN: Kolom 'kategori' sudah dihapus total dari sini jirr, 
     * biar sinkron sama database SQLite Vercel lo yang gak punya kolom kategori.
     */
    protected $fillable = [
        'nama',           // Nama produk
        'harga',          // Harga produk
        'gambar',         // Gambar tampak depan (Link Postimages)
        'gambar_belakang', // Gambar tampak belakang untuk fitur ganti foto (Link Postimages)
        'deskripsi',      // Deskripsi produk
    ];

    /**
     * Jika kamu tidak menggunakan timestamps (created_at & updated_at), 
     * ubah menjadi false. Tapi standarnya true.
     */
    public $timestamps = true;

    // --- TAMBAHKAN KODE DI BAWAH INI ---

    /**
     * Relasi ke Order
     * Satu produk bisa memiliki banyak pesanan (riwayat belanja)
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
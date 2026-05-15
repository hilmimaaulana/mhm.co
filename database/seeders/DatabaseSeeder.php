<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. BUAT USER ADMIN (Biar lo bisa login ke dashboard di Vercel)
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin Sepatuku',
                'password' => bcrypt('password123'), // Ganti sesuai keinginan
                'is_admin' => true,
            ]
        );

        // 2. DAFTAR NAMA FOTO (Masukan semua nama file yang ada di public/img lo)
        $daftarFoto = [
            '1777120472_thrasherbanner3.webp',
            '1777122182_tharsher2.jpg',
            '1777123446_converse1.jpg',
            '1777815709_vansknu1.png',
            '1777816208_converseonestar2.jpg',
            '1777816345_vansauthentic1.webp',
            '1777816450_vansera1.webp',
            // Tambahkan nama file lainnya di bawah ini...
        ];

        // 3. PROSES INPUT OTOMATIS (Looping)
        foreach ($daftarFoto as $key => $foto) {
            Product::updateOrCreate(
                ['image' => $foto], // Cek biar gak double kalau di-seed ulang
                [
                    'name' => 'Produk Sepatu ' . ($key + 1),
                    'price' => 500000 + ($key * 15000), // Harga variasi otomatis
                    'description' => 'Deskripsi kualitas tinggi untuk produk ' . $foto,
                    'status' => 'tersedia',
                    'metode_pembayaran' => 'Transfer Bank',
                ]
            );
        }

        // Jika lo punya seeder user lain, bisa dibuka komennya di bawah:
        // \App\Models\User::factory(10)->create();
    }
}
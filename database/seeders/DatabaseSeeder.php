<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Product;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. BUAT USER ADMIN
        // Pakai Hash::make atau bcrypt biar password aman
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'], // Gunakan email ini untuk LOGIN
            [
                'name' => 'Admin MHM',
                'password' => Hash::make('password123'), // Passwordnya: password123
                'is_admin' => 1, // Kita set 1 (True)
            ]
        );

        // 2. DAFTAR NAMA FOTO (SESUAIKAN DENGAN GITHUB LO)
        // Karena di GitHub lo nama filenya sudah bersih (converse1.jpg, dll), 
        // pastikan daftar di sini SAMA PERSIS dengan yang ada di folder public/img.
        $daftarFoto = [
            'converse1.jpg',
            'conversebanner.jpg',
            'converseonestar.jpg',
            'foto1.jpg',
            'bannerjaket2.jpg',
            'tharsher2.jpg',
            // Tambahin lagi semua yang ada di screenshot GitHub lo tadi gais...
        ];

        // 3. PROSES INPUT PRODUK OTOMATIS
        foreach ($daftarFoto as $key => $foto) {
            Product::updateOrCreate(
                ['image' => $foto], 
                [
                    'name' => 'Sepatu ' . ucfirst(str_replace(['.jpg', '.png', '.webp'], '', $foto)),
                    'price' => 750000 + ($key * 10000),
                    'description' => 'Produk original tersedia di MHM Store. Kualitas terjamin.',
                    'status' => 'tersedia',
                    'metode_pembayaran' => 'Transfer Bank',
                ]
            );
        }
    }
}
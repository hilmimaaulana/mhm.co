<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Artisan; // Tambahkan ini
use Illuminate\Support\Facades\Schema;  // Tambahkan ini

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // JURUS OTOMATIS MIGRATION UNTUK VERCEL
        // Jika pakai sqlite memory dan tabel belum ada, jalankan migrate
        if (config('database.default') == 'sqlite' && !Schema::hasTable('products')) {
            Artisan::call('migrate --force');
            
            // OPSIONAL: Kalau lo punya seeder buat isi data sepatu, tambahin ini:
            // Artisan::call('db:seed --force');
        }
    }
}
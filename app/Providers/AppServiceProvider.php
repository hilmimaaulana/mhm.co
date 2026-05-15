<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Vercel Auto-Migration & Seeding (Final Mission)
        |--------------------------------------------------------------------------
        | Kode ini otomatis menjalankan migrasi DAN mengisi data (seeding).
        */
        
        if (config('database.default') == 'sqlite') {
            // Kita cek tabel 'users' sebagai penanda apakah database sudah siap
            if (!Schema::hasTable('users')) {
                try {
                    // 1. Jalankan Migrasi (Buat Tabel)
                    Artisan::call('migrate --force');

                    // 2. Jalankan Seeder (Isi Data Produk & Foto)
                    Artisan::call('db:seed --force');
                    
                } catch (\Exception $e) {
                    // Catat ke log jika ada error SQLite versi lama di Vercel
                    \Log::error("Gagal Setup Database: " . $e->getMessage());
                }
            } else {
                // Jika tabel sudah ada, kita tetap jalankan migrate untuk 
                // memastikan kolom baru (seperti metode_pembayaran) terpasang
                try {
                    Artisan::call('migrate --force');
                } catch (\Exception $e) {
                    // Abaikan jika sudah up-to-date
                }
            }
        }
    }
}
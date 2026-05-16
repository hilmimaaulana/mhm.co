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
            
            // Kita gunakan static variable bawaan PHP agar perintah ini 
            // HANYA JALAN SEKALI per siklus request. Ini mengunci session admin biar gak mental!
            static $dbInitialized = false;

            if (!$dbInitialized) {
                // 1. Cek jika tabel utama 'users' belum ada sama sekali
                if (!Schema::hasTable('users')) {
                    try {
                        // Jalankan migrasi secara bersih
                        Artisan::call('migrate --force');

                        // Jalankan seeder untuk membuat akun admin & produk pertama kali
                        Artisan::call('db:seed --force');
                        
                        \Log::info("Vercel Database & Admin Berhasil Di-setup!");
                    } catch (\Exception $e) {
                        \Log::error("Gagal Setup Database Awal: " . $e->getMessage());
                    }
                } else {
                    // 2. Jika tabel sudah ada, cek kolom baru agar fitur kelola produk gak error
                    try {
                        if (Schema::hasTable('orders') && !Schema::hasColumn('orders', 'metode_pembayaran')) {
                            Artisan::call('migrate --force');
                        }
                    } catch (\Exception $e) {
                        // Abaikan jika database sudah sinkron
                    }
                }

                // Kunci statusnya supaya tidak dieksekusi lagi di halaman berikutnya
                $dbInitialized = true;
            }
        }
    }
}
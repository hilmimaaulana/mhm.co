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
            // Kita cek tabel 'users' untuk memastikan database sudah ada isinya
            if (!Schema::hasTable('users')) {
                try {
                    // 1. Jalankan Migrasi (Buat Tabel)
                    Artisan::call('migrate --force');

                    // 2. Jalankan Seeder (Buat User Admin & Data Produk)
                    // Ini kunci supaya lo bisa login admin pertama kali
                    Artisan::call('db:seed --force');
                    
                } catch (\Exception $e) {
                    \Log::error("Gagal Setup Database Awal: " . $e->getMessage());
                }
            } else {
                // Jika sudah ada tabel users, kita cek apakah ada kolom baru yang belum masuk
                // (Penting agar fitur kelola produk/metode pembayaran tidak error)
                try {
                    // Cek salah satu kolom yang baru lo tambahin di migration terakhir
                    if (!Schema::hasColumn('orders', 'metode_pembayaran')) {
                        Artisan::call('migrate --force');
                    }
                } catch (\Exception $e) {
                    // Abaikan jika database sudah sinkron
                }
            }
        }
    }
}
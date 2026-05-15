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
        | Vercel Auto-Migration (Supreme Version)
        |--------------------------------------------------------------------------
        | Kode ini otomatis menjalankan migrasi jika tabel utama belum ada.
        | Menggunakan try-catch untuk menghindari syntax error pada SQLite Vercel.
        */
        
        if (config('database.default') == 'sqlite') {
            // Cek tabel 'migrations' sebagai indikator utama database kosong
            if (!Schema::hasTable('migrations')) {
                try {
                    // Jalankan semua file migration secara paksa
                    Artisan::call('migrate --force');
                } catch (\Exception $e) {
                    // Mencatat error ke log jika migrasi gagal tapi web tetap jalan
                    \Log::error("Gagal Migrasi Otomatis: " . $e->getMessage());
                }
            } else {
                // Jika tabel migrations ada tapi ada tabel lain yang kurang (seperti tokens)
                // Kita coba jalankan sekali lagi untuk melengkapi
                try {
                    Artisan::call('migrate --force');
                } catch (\Exception $e) {
                    // Abaikan jika tabel/kolom sudah ada
                }
            }
        }
    }
}
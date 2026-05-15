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
        | Vercel Auto-Migration (Jurus Sapu Jagat)
        |--------------------------------------------------------------------------
        | Kode ini akan otomatis membuat semua tabel (users, products, orders, dll)
        | saat website pertama kali diakses di Vercel.
        */
        
        if (config('database.default') == 'sqlite') {
            // Cek tabel 'users' sebagai indikator database kosong
            if (!Schema::hasTable('users')) {
                // Jalankan semua file migration yang ada di folder database/migrations
                Artisan::call('migrate --force');
                
                // Jika kamu ingin data otomatis terisi (seperti data produk awal),
                // kamu bisa aktifkan baris di bawah ini (pastikan sudah buat Seeder):
                // Artisan::call('db:seed --force');
            }
        }
    }
}
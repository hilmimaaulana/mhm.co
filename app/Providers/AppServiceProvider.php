<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Cek jika menggunakan sqlite dan table products belum ada
        if (config('database.default') == 'sqlite') {
            if (!Schema::hasTable('products')) {
                Artisan::call('migrate --force');
                
                // Jika lo punya data awal (seeder), buka komen di bawah ini:
                // Artisan::call('db:seed --force');
            }
        }
    }
}
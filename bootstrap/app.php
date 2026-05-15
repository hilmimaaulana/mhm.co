<?php

$app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

/*
|--------------------------------------------------------------------------
| Vercel Read-Only Fix
|--------------------------------------------------------------------------
*/
// Tentukan path ke /tmp karena hanya folder ini yang bisa ditulis di Vercel
$storagePath = '/tmp/storage';

// Set path storage dan bootstrap cache secara paksa
$app->useStoragePath($storagePath);
$app->bind('path.bootstrap', function () use ($storagePath) {
    return $storagePath . '/bootstrap';
});

// Setup folder jika belum ada (ini penting agar tidak error directory not found)
if (!is_dir($storagePath . '/bootstrap/cache')) {
    mkdir($storagePath . '/framework/views', 0755, true);
    mkdir($storagePath . '/framework/cache', 0755, true);
    mkdir($storagePath . '/bootstrap/cache', 0755, true);
}

/*
|--------------------------------------------------------------------------
| Bind Interfaces
|--------------------------------------------------------------------------
*/
$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

return $app;
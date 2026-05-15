<?php

$app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

/*
|--------------------------------------------------------------------------
| Vercel Read-Only Fix (PENTING)
|--------------------------------------------------------------------------
*/

// Tentukan path ke /tmp karena hanya folder ini yang bisa ditulis di Vercel
$storagePath = '/tmp/storage';

// Pastikan folder-folder wajib ada di /tmp sebelum Laravel mulai bekerja
// Kita tambahkan folder 'sessions' agar fitur login/session tidak error
if (!is_dir($storagePath . '/bootstrap/cache')) {
    mkdir($storagePath . '/framework/views', 0755, true);
    mkdir($storagePath . '/framework/cache', 0755, true);
    mkdir($storagePath . '/framework/sessions', 0755, true);
    mkdir($storagePath . '/bootstrap/cache', 0755, true);
}

// Set path storage secara paksa ke /tmp
$app->useStoragePath($storagePath);

// Paksa Laravel mencari manifest bootstrap (packages.php/services.php) di /tmp
$app->bind('path.bootstrap', function () use ($storagePath) {
    return $storagePath . '/bootstrap';
});

/*
|--------------------------------------------------------------------------
| Bind Interfaces (Fungsi Asli - JANGAN DIUBAH)
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
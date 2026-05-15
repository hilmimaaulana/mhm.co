<?php

/*
|--------------------------------------------------------------------------
| Vercel Storage & Cache Bypass
|--------------------------------------------------------------------------
*/

// 1. Definisikan path /tmp
$storagePath = '/tmp/storage';

// 2. Buat struktur folder secara paksa jika belum ada
if (!is_dir($storagePath . '/framework/views')) {
    mkdir($storagePath . '/framework/views', 0755, true);
    mkdir($storagePath . '/framework/cache', 0755, true);
    mkdir($storagePath . '/framework/sessions', 0755, true);
    mkdir($storagePath . '/bootstrap/cache', 0755, true);
}

// 3. Set Environment Variables sebelum Laravel booting
putenv("APP_STORAGE=$storagePath");
putenv("VIEW_COMPILED_PATH=$storagePath/framework/views");
// BARIS PENTING: Paksa STREAM_CACHE_PATH ke folder yang bisa ditulis
putenv("STREAM_CACHE_PATH=$storagePath/bootstrap/cache");

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
*/

// Arahkan ke autoload.php
require __DIR__ . '/../vendor/autoload.php';

// Bootstrapping Laravel
$app = require_once __DIR__ . '/../bootstrap/app.php';

// 4. BINDING ULANG PATH (Agar Laravel tidak menulis ke /var/task/user)
$app->useStoragePath($storagePath);
$app->bind('path.bootstrap', function () use ($storagePath) {
    return $storagePath . '/bootstrap';
});

// 5. Jalankan Kernel
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
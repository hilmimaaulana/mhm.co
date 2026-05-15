<?php

// 1. Paksa environment ke folder /tmp sebelum autoload
$storagePath = '/tmp/storage';
if (!is_dir($storagePath)) {
    mkdir($storagePath, 0755, true);
    mkdir($storagePath . '/framework/views', 0755, true);
    mkdir($storagePath . '/framework/cache', 0755, true);
    mkdir($storagePath . '/framework/sessions', 0755, true);
    mkdir($storagePath . '/bootstrap/cache', 0755, true);
}

putenv("APP_STORAGE=$storagePath");
putenv("VIEW_COMPILED_PATH=$storagePath/framework/views");

// 2. Load Autoload
require __DIR__ . '/../vendor/autoload.php';

// 3. Bootstrapping Laravel
$app = require_once __DIR__ . '/../bootstrap/app.php';

// 4. Paksa config cache ke /tmp (KUNCI UTAMA)
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
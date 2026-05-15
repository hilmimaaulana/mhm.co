<?php

/*
|--------------------------------------------------------------------------
| Vercel Runtime Fix
|--------------------------------------------------------------------------
| Memaksa Laravel menggunakan folder /tmp untuk cache dan storage.
| Ini wajib karena sistem file Vercel bersifat Read-Only.
|
*/

// 1. Definisikan folder storage dan cache ke /tmp
putenv('APP_STORAGE=/tmp');
putenv('VIEW_COMPILED_PATH=/tmp');
putenv('SESSION_DRIVER=array');
putenv('LOG_CHANNEL=stderr');

// 2. Tambahkan konstanta untuk folder cache bootstrap (Jurus Pamungkas)
if (!isset($_ENV['STREAM_CACHE_PATH'])) {
    putenv('STREAM_CACHE_PATH=/tmp');
}

// 3. Arahkan ke autoload.php
require __DIR__ . '/../vendor/autoload.php';

// 4. Bootstrapping Laravel
$app = require_once __DIR__ . '/../bootstrap/app.php';

// 5. Jalankan Kernel Laravel
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
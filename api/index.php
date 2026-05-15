<?php

// 1. Arahkan ke autoload.php dengan realpath biar gak nyasar
require __DIR__ . '/../vendor/autoload.php';

// 2. Bootstrapping Laravel
$app = require_once __DIR__ . '/../bootstrap/app.php';

// 3. Jalankan Kernel Laravel
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
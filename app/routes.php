<?php
// Gunakan (use) semua controller Anda di sini
use Polinema\WebProfilLabSe\Controllers\ExampleController;

$app->get('/', [ExampleController::class, 'index']);
$app->get('/about', [ExampleController::class, 'about']);

// Rute 'fallback' jika tidak ada yang cocok
$app->notFound([ExampleController::class, 'notFound']);
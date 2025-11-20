<?php
// Gunakan (use) semua controller Anda di sini
use Polinema\WebProfilLabSe\Controllers\ExampleController;
use Polinema\WebProfilLabSe\Controllers\AuthController;
use Polinema\WebProfilLabSe\Controllers\AdminController;
use Polinema\WebProfilLabSe\Controllers\Admin\BlogController;
use Polinema\WebProfilLabSe\Controllers\Admin\PersonilController;
use Polinema\WebProfilLabSe\Controllers\Admin\ProfileController;
use Polinema\WebProfilLabSe\Controllers\Admin\RekrutmenController;

$app->get('/', [ExampleController::class, 'index']);
$app->get('/about', [ExampleController::class, 'about']);

$app->get('/login', [AuthController::class, 'login']);
$app->post('/login-proses', [AuthController::class, 'processLogin']);

// admin routes
$app->get('/admin', [AdminController::class, 'index']);

$app->get('/admin/blog', [BlogController::class, 'index']);

$app->get('/admin/personil', [PersonilController::class, 'index']);

$app->get('/admin/rekrutmen', [RekrutmenController::class, 'index']);

// Rute 'fallback' jika tidak ada yang cocok
$app->notFound([ExampleController::class, 'notFound']);
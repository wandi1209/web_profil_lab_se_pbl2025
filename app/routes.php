<?php

use Polinema\WebProfilLabSe\Controllers\HomeController;
use Polinema\WebProfilLabSe\Controllers\AuthController;
use Polinema\WebProfilLabSe\Controllers\AdminController;
use Polinema\WebProfilLabSe\Controllers\Admin\BlogController;
use Polinema\WebProfilLabSe\Controllers\Admin\PersonilController;
use Polinema\WebProfilLabSe\Controllers\Admin\ProfileController;
use Polinema\WebProfilLabSe\Controllers\Admin\RekrutmenController;

// public
$app->get('/', [HomeController::class, 'index']);
$app->get('/about', [HomeController::class, 'about']);
$app->get('/personil', [HomeController::class, 'personil']);
$app->get('/personil/detail', [HomeController::class, 'personilDetail']);

// auth
$app->get('/login', [AuthController::class, 'login']);
$app->post('/login-proses', [AuthController::class, 'processLogin']);
$app->get('/logout', [AuthController::class, 'logout']);

// admin dashboard
$app->get('/admin', [AdminController::class, 'index']);

// profile (admin)
$app->get('/admin/profile/tentangLab',      [ProfileController::class, 'tentangLab']);
$app->get('/admin/profile/visiMisi',        [ProfileController::class, 'visiMisi']);
$app->get('/admin/profile/roadmap',         [ProfileController::class, 'roadmap']);
$app->get('/admin/profile/scopePenelitian', [ProfileController::class, 'scopePenelitian']);
$app->get('/admin/profile/album',           [ProfileController::class, 'album']);

// personil (admin)
$app->get('/admin/personil', [PersonilController::class, 'index']);
// Dosen CRUD
$app->get('/admin/personil/dosen',               [PersonilController::class, 'dosen']);
$app->get('/admin/personil/createDosen',        [PersonilController::class, 'createDosen']);
$app->post('/admin/personil/storeDosen',        [PersonilController::class, 'storeDosen']);
$app->get('/admin/personil/dosen/editDosen',         [PersonilController::class, 'editDosen']);
$app->post('/admin/personil/updateDosen',       [PersonilController::class, 'updateDosen']);
$app->get('/admin/personil/dosen/deleteDosen',       [PersonilController::class, 'deleteDosen']);

$app->get('/admin/personil/mahasiswa', [PersonilController::class, 'mahasiswa']);

$app->get('/admin/rekrutmen', [RekrutmenController::class, 'index']);

// blog (admin)
$app->get('/admin/blog', [BlogController::class, 'index']);

// rekrutmen (admin)
$app->get('/admin/rekrutmen', [RekrutmenController::class, 'index']);

// fallback 404
$app->notFound([HomeController::class, 'notFound']);

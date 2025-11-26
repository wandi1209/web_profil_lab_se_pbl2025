<?php

use Polinema\WebProfilLabSe\Controllers\HomeController;
use Polinema\WebProfilLabSe\Controllers\AuthController;
use Polinema\WebProfilLabSe\Controllers\AdminController;

// admin
use Polinema\WebProfilLabSe\Controllers\Admin\BlogController;
use Polinema\WebProfilLabSe\Controllers\Admin\RekrutmenController;
use Polinema\WebProfilLabSe\Controllers\Admin\AlbumController;
use Polinema\WebProfilLabSe\Controllers\Admin\RoadmapController;
use Polinema\WebProfilLabSe\Controllers\Admin\ScopeController;
use Polinema\WebProfilLabSe\Controllers\Admin\TentangController;
use Polinema\WebProfilLabSe\Controllers\Admin\VisiMisiController;
use Polinema\WebProfilLabSe\Controllers\Admin\DosenController;
use Polinema\WebProfilLabSe\Controllers\Admin\MahasiswaController;

// ================== PUBLIC ==================
$app->get('/',                  [HomeController::class, 'index']);
$app->get('/about',             [HomeController::class, 'about']);

// TENTANG
$app->get('/tentang/profil',    [HomeController::class, 'profil']);
$app->get('/tentang/visi-misi', [HomeController::class, 'visi_misi']);
$app->get('/tentang/roadmap', [HomeController::class, 'roadmap']);

// ARTIKEL
$app->get('/artikel',           [HomeController::class, 'artikel']);

// PENDAFTARAN
$app->get('/pendaftaran',       [HomeController::class, 'pendaftaran']);

// PERSONIL 
$app->get('/personil/mahasiswa',          [HomeController::class, 'mahasiswa']);
$app->get('/personil/dosen/{id}',   [HomeController::class, 'personilDetail']);

// ================== AUTH ==================
$app->get('/login',             [AuthController::class, 'login']);
$app->post('/login-proses',     [AuthController::class, 'processLogin']);
$app->get('/logout',            [AuthController::class, 'logout']);

// ================== ADMIN DASHBOARD ==================
$app->get('/admin/dashboard',   [AdminController::class, 'index']);
$app->get('/admin',             [AdminController::class, 'index']);

// ================== PROFILE (ADMIN) ==================
$app->get('/admin/profile/tentangLab',        [TentangController::class,   'index']);
$app->get('/admin/profile/tentangLab/edit',   [TentangController::class,   'edit']);
$app->get('/admin/profile/tentangLab/delete', [TentangController::class,   'delete']);

$app->get('/admin/profile/visiMisi',          [VisiMisiController::class,  'index']);
$app->get('/admin/profile/visiMisi/edit',     [VisiMisiController::class,  'edit']);
$app->get('/admin/profile/visiMisi/delete',   [VisiMisiController::class,  'delete']);

$app->get('/admin/profile/roadmap',           [RoadmapController::class,   'index']);
$app->get('/admin/profile/roadmap/create',    [RoadmapController::class,   'create']);
$app->get('/admin/profile/roadmap/edit',      [RoadmapController::class,   'edit']);
$app->get('/admin/profile/roadmap/delete',    [RoadmapController::class,   'delete']);

$app->get('/admin/profile/scopePenelitian',   [ScopeController::class,     'index']);

$app->get('/admin/profile/album',             [AlbumController::class,     'index']);
$app->get('/admin/profile/album/create',      [AlbumController::class,     'create']);
$app->get('/admin/profile/album/edit',        [AlbumController::class,     'edit']);
$app->get('/admin/profile/album/delete',      [AlbumController::class,     'delete']);

// ================== PERSONIL (ADMIN) ==================

// /admin/personil aku arahkan ke daftar dosen dulu
$app->get('/admin/personil',                  [DosenController::class,     'index']);

// Dosen
$app->get('/admin/personil/dosen',            [DosenController::class,     'index']);
$app->get('/admin/personil/createDosen',      [DosenController::class,     'create']);
$app->get('/admin/personil/dosen/edit',       [DosenController::class,     'edit']);
$app->get('/admin/personil/dosen/delete',     [DosenController::class,     'delete']);

// Mahasiswa
$app->get('/admin/personil/mahasiswa',        [MahasiswaController::class, 'index']);
$app->get('/admin/personil/createMahasiswa',  [MahasiswaController::class, 'create']);
$app->get('/admin/personil/mahasiswa/edit',   [MahasiswaController::class, 'edit']);
$app->get('/admin/personil/mahasiswa/delete', [MahasiswaController::class, 'delete']);

// (route POST store/update bisa ditambah nanti setelah fungsi simpan dibuat)

// ================== BLOG (ADMIN) ==================
$app->get('/admin/blog',              [BlogController::class, 'index']);
$app->get('/admin/blog/createBlog',   [BlogController::class, 'create']);
$app->get('/admin/blog/edit',         [BlogController::class, 'edit']);
$app->get('/admin/blog/delete',       [BlogController::class, 'delete']);

// ================== REKRUTMEN (ADMIN) ==================
$app->get('/admin/rekrutmen',                 [RekrutmenController::class, 'index']);
$app->get('/admin/rekrutmen/createRekrutmen', [RekrutmenController::class, 'create']);
$app->get('/admin/rekrutmen/editRekrutmen',   [RekrutmenController::class, 'edit']);
$app->get('/admin/rekrutmen/deleteRekrutmen', [RekrutmenController::class, 'delete']);

// ================== FALLBACK 404 ==================
$app->notFound([HomeController::class, 'notFound']);

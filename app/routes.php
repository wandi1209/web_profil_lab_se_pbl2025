<?php

use Polinema\WebProfilLabSe\Controllers\HomeController;
use Polinema\WebProfilLabSe\Controllers\AuthController;
use Polinema\WebProfilLabSe\Controllers\AdminController;
use Polinema\WebProfilLabSe\Middlewares\AuthMiddleware;

// admin controllers
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
$app->get('/tentang/roadmap',   [HomeController::class, 'roadmap']);

// ANGGOTA
$app->get('/anggota/dosen',     [HomeController::class, 'dosen']);
$app->get('/anggota/mahasiswa', [HomeController::class, 'mahasiswa']);
$app->get('/anggota/alumni',    [HomeController::class, 'alumni']);

// ARTIKEL
$app->get('/artikel',           [HomeController::class, 'artikel']);

// PENDAFTARAN
$app->get('/pendaftaran',       [HomeController::class, 'pendaftaran']);

// PERSONIL 
$app->get('/personil/mahasiswa',      [HomeController::class, 'mahasiswa']);
$app->get('/personil/dosen/{id}',    [HomeController::class, 'personilDetail']);

// ================== AUTH ==================
$app->get('/login',             [AuthController::class, 'login']);
$app->post('/login-proses',     [AuthController::class, 'processLogin']);
$app->get('/logout',            [AuthController::class, 'logout']);

// ================== ADMIN DASHBOARD (PROTECTED) ==================
$app->get('/admin/dashboard', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminController();
    $controller->index();
});

$app->get('/admin', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminController();
    $controller->index();
});

// ================== PROFILE (ADMIN) ==================
// Tentang Lab (pakai tabel profile)
$app->get('/admin/profile/tentangLab',        [TentangController::class,   'index']);
$app->get('/admin/profile/tentangLab/edit',   [TentangController::class,   'edit']);
$app->get('/admin/profile/tentangLab/delete', [TentangController::class,   'delete']);
$app->post('/admin/profile/tentangLab/update',[TentangController::class,   'update']);

// Visi Misi (pakai tabel profile juga)
$app->get('/admin/profile/visiMisi',          [VisiMisiController::class,  'index']);
$app->get('/admin/profile/visiMisi/edit',     [VisiMisiController::class,  'edit']);
$app->get('/admin/profile/visiMisi/delete',   [VisiMisiController::class,  'delete']);
$app->post('/admin/profile/visiMisi/update',  [VisiMisiController::class,  'update']);

$app->get('/admin/profile/profil',           [RoadmapController::class,   'index']);
$app->get('/admin/profile/profil/create',    [RoadmapController::class,   'create']);
$app->get('/admin/profile/profil/edit',      [RoadmapController::class,   'edit']);
$app->get('/admin/profile/profil/delete',    [RoadmapController::class,   'delete']);

// Scope (read only)
$app->get('/admin/profile/scopePenelitian',   [ScopeController::class,     'index']);

// Album
$app->get('/admin/profile/album',             [AlbumController::class,     'index']);
$app->get('/admin/profile/album/create',      [AlbumController::class,     'create']);
$app->get('/admin/profile/album/edit',        [AlbumController::class,     'edit']);
$app->get('/admin/profile/album/delete',      [AlbumController::class,     'delete']);
$app->post('/admin/profile/album/store',      [AlbumController::class,     'store']);
$app->post('/admin/profile/album/update',     [AlbumController::class,     'update']);

// ================== PERSONIL (ADMIN) ==================
$app->get('/admin/personil',                  [DosenController::class,     'index']);

// Dosen
$app->get('/admin/personil/dosen',            [DosenController::class,     'index']);
$app->get('/admin/personil/createDosen',      [DosenController::class,     'create']);
$app->get('/admin/personil/dosen/edit',       [DosenController::class,     'edit']);
$app->get('/admin/personil/dosen/delete',     [DosenController::class,     'delete']);
$app->post('/admin/personil/dosen/store',     [DosenController::class,     'store']);
$app->post('/admin/personil/dosen/update',    [DosenController::class,     'update']);

// Mahasiswa
$app->get('/admin/personil/mahasiswa',        [MahasiswaController::class, 'index']);
$app->get('/admin/personil/createMahasiswa',  [MahasiswaController::class, 'create']);
$app->get('/admin/personil/mahasiswa/edit',   [MahasiswaController::class, 'edit']);
$app->get('/admin/personil/mahasiswa/delete', [MahasiswaController::class, 'delete']);
$app->post('/admin/personil/mahasiswa/store', [MahasiswaController::class, 'store']);
$app->post('/admin/personil/mahasiswa/update',[MahasiswaController::class, 'update']);

// ================== BLOG (ADMIN) ==================
$app->get('/admin/blog',              [BlogController::class, 'index']);
$app->get('/admin/blog/createBlog',   [BlogController::class, 'create']);
$app->get('/admin/blog/edit',         [BlogController::class, 'edit']);
$app->get('/admin/blog/delete',       [BlogController::class, 'delete']);
$app->post('/admin/blog/store',       [BlogController::class, 'store']);
$app->post('/admin/blog/update',      [BlogController::class, 'update']);

// ================== REKRUTMEN (ADMIN) ==================
$app->get('/admin/rekrutmen',                 [RekrutmenController::class, 'index']);
$app->get('/admin/rekrutmen/createRekrutmen', [RekrutmenController::class, 'create']);
$app->get('/admin/rekrutmen/editRekrutmen',   [RekrutmenController::class, 'edit']);
$app->get('/admin/rekrutmen/deleteRekrutmen', [RekrutmenController::class, 'delete']);

// ================== VISI MISI ==================
$app->get('/admin/profile/visiMisi', function() {
    AuthMiddleware::isAdmin();
    $controller = new VisiMisiController();
    $controller->index();
});

$app->post('/admin/profile/visiMisi/updateVisi', function() {
    AuthMiddleware::isAdmin();
    $controller = new VisiMisiController();
    $controller->updateVisi();
});

$app->post('/admin/profile/visiMisi/addMisi', function() {
    AuthMiddleware::isAdmin();
    $controller = new VisiMisiController();
    $controller->addMisi();
});

$app->post('/admin/profile/visiMisi/updateMisi', function() {
    AuthMiddleware::isAdmin();
    $controller = new VisiMisiController();
    $controller->updateMisi();
});

$app->post('/admin/profile/visiMisi/deleteMisi', function() {
    AuthMiddleware::isAdmin();
    $controller = new VisiMisiController();
    $controller->deleteMisi();
});

// ================== TENTANG LAB ==================
$app->get('/admin/profile/tentang', function() {
    AuthMiddleware::isAdmin();
    $controller = new TentangController();
    $controller->index();
});

$app->post('/admin/profile/tentang/save', function() {
    AuthMiddleware::isAdmin();
    $controller = new TentangController();
    $controller->save();
});

// ================== FALLBACK 404 ==================
$app->notFound([HomeController::class, 'notFound']);

// ADMIN - ALBUM
$app->get('/admin/album', function() {
    AuthMiddleware::isAdmin();
    $controller = new \Polinema\WebProfilLabSe\Controllers\Admin\AlbumController();
    $controller->index();
});

$app->get('/admin/album/create', function() {
    AuthMiddleware::isAdmin();
    $controller = new \Polinema\WebProfilLabSe\Controllers\Admin\AlbumController();
    $controller->create();
});

$app->post('/admin/album/store', function() {
    AuthMiddleware::isAdmin();
    $controller = new \Polinema\WebProfilLabSe\Controllers\Admin\AlbumController();
    $controller->store();
});

$app->get('/admin/album/edit', function() {
    AuthMiddleware::isAdmin();
    $controller = new \Polinema\WebProfilLabSe\Controllers\Admin\AlbumController();
    $controller->edit();
});

$app->post('/admin/album/update', function() {
    AuthMiddleware::isAdmin();
    $controller = new \Polinema\WebProfilLabSe\Controllers\Admin\AlbumController();
    $controller->update();
});

$app->get('/admin/album/delete', function() {
    AuthMiddleware::isAdmin();
    $controller = new \Polinema\WebProfilLabSe\Controllers\Admin\AlbumController();
    $controller->delete();
});

// ADMIN - SCOPE PENELITIAN
$app->get('/admin/scope', function() {
    AuthMiddleware::isAdmin();
    $controller = new \Polinema\WebProfilLabSe\Controllers\Admin\ScopeController();
    $controller->index();
});

$app->get('/admin/scope/create', function() {
    AuthMiddleware::isAdmin();
    $controller = new \Polinema\WebProfilLabSe\Controllers\Admin\ScopeController();
    $controller->create();
});

$app->post('/admin/scope/store', function() {
    AuthMiddleware::isAdmin();
    $controller = new \Polinema\WebProfilLabSe\Controllers\Admin\ScopeController();
    $controller->store();
});

$app->get('/admin/scope/edit', function() {
    AuthMiddleware::isAdmin();
    $controller = new \Polinema\WebProfilLabSe\Controllers\Admin\ScopeController();
    $controller->edit();
});

$app->post('/admin/scope/update', function() {
    AuthMiddleware::isAdmin();
    $controller = new \Polinema\WebProfilLabSe\Controllers\Admin\ScopeController();
    $controller->update();
});

$app->get('/admin/scope/delete', function() {
    AuthMiddleware::isAdmin();
    $controller = new \Polinema\WebProfilLabSe\Controllers\Admin\ScopeController();
    $controller->delete();
});

// ADMIN - BLOG/ARTIKEL
$app->get('/admin/blog', function() {
    AuthMiddleware::isAdmin();
    $controller = new \Polinema\WebProfilLabSe\Controllers\Admin\BlogController();
    $controller->index();
});

$app->get('/admin/blog/create', function() {
    AuthMiddleware::isAdmin();
    $controller = new \Polinema\WebProfilLabSe\Controllers\Admin\BlogController();
    $controller->create();
});

$app->post('/admin/blog/store', function() {
    AuthMiddleware::isAdmin();
    $controller = new \Polinema\WebProfilLabSe\Controllers\Admin\BlogController();
    $controller->store();
});

$app->get('/admin/blog/edit', function() {
    AuthMiddleware::isAdmin();
    $controller = new \Polinema\WebProfilLabSe\Controllers\Admin\BlogController();
    $controller->edit();
});

$app->post('/admin/blog/update', function() {
    AuthMiddleware::isAdmin();
    $controller = new \Polinema\WebProfilLabSe\Controllers\Admin\BlogController();
    $controller->update();
});

$app->get('/admin/blog/delete', function() {
    AuthMiddleware::isAdmin();
    $controller = new \Polinema\WebProfilLabSe\Controllers\Admin\BlogController();
    $controller->delete();
});

// ADMIN - REKRUTMEN
$app->get('/admin/rekrutmen', function() {
    AuthMiddleware::isAdmin();
    $controller = new \Polinema\WebProfilLabSe\Controllers\Admin\RekrutmenController();
    $controller->index();
});

$app->get('/admin/rekrutmen/detail', function() {
    AuthMiddleware::isAdmin();
    $controller = new \Polinema\WebProfilLabSe\Controllers\Admin\RekrutmenController();
    $controller->detail();
});

$app->get('/admin/rekrutmen/edit', function() {
    AuthMiddleware::isAdmin();
    $controller = new \Polinema\WebProfilLabSe\Controllers\Admin\RekrutmenController();
    $controller->edit();
});

$app->post('/admin/rekrutmen/updateStatus', function() {
    AuthMiddleware::isAdmin();
    $controller = new \Polinema\WebProfilLabSe\Controllers\Admin\RekrutmenController();
    $controller->updateStatus();
});

$app->get('/admin/rekrutmen/delete', function() {
    AuthMiddleware::isAdmin();
    $controller = new \Polinema\WebProfilLabSe\Controllers\Admin\RekrutmenController();
    $controller->delete();
});

// ADMIN - PERSONIL MAHASISWA
$app->get('/admin/personil/mahasiswa', function() {
    AuthMiddleware::isAdmin();
    $controller = new \Polinema\WebProfilLabSe\Controllers\Admin\MahasiswaController();
    $controller->index();
});

$app->get('/admin/personil/mahasiswa/create', function() {
    AuthMiddleware::isAdmin();
    $controller = new \Polinema\WebProfilLabSe\Controllers\Admin\MahasiswaController();
    $controller->create();
});

$app->post('/admin/personil/mahasiswa/store', function() {
    AuthMiddleware::isAdmin();
    $controller = new \Polinema\WebProfilLabSe\Controllers\Admin\MahasiswaController();
    $controller->store();
});

$app->get('/admin/personil/mahasiswa/edit', function() {
    AuthMiddleware::isAdmin();
    $controller = new \Polinema\WebProfilLabSe\Controllers\Admin\MahasiswaController();
    $controller->edit();
});

$app->post('/admin/personil/mahasiswa/update', function() {
    AuthMiddleware::isAdmin();
    $controller = new \Polinema\WebProfilLabSe\Controllers\Admin\MahasiswaController();
    $controller->update();
});

$app->get('/admin/personil/mahasiswa/delete', function() {
    AuthMiddleware::isAdmin();
    $controller = new \Polinema\WebProfilLabSe\Controllers\Admin\MahasiswaController();
    $controller->delete();
});

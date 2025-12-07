<?php

use Polinema\WebProfilLabSe\Controllers\HomeController;
use Polinema\WebProfilLabSe\Controllers\AuthController;
use Polinema\WebProfilLabSe\Controllers\ArtikelController;
use Polinema\WebProfilLabSe\Controllers\AdminController;
use Polinema\WebProfilLabSe\Controllers\PersonilController;
use Polinema\WebProfilLabSe\Controllers\PendaftaranController;
use Polinema\WebProfilLabSe\Middlewares\AuthMiddleware;

// admin controllers
use Polinema\WebProfilLabSe\Controllers\Admin\BlogController as AdminBlogController;
use Polinema\WebProfilLabSe\Controllers\Admin\RekrutmenController as AdminRekrutmenController;
use Polinema\WebProfilLabSe\Controllers\Admin\AlbumController as AdminAlbumController;
use Polinema\WebProfilLabSe\Controllers\Admin\RoadmapController as AdminRoadmapController;
use Polinema\WebProfilLabSe\Controllers\Admin\ScopeController as AdminScopeController;
use Polinema\WebProfilLabSe\Controllers\Admin\TentangController as AdminTentangController;
use Polinema\WebProfilLabSe\Controllers\Admin\VisiMisiController as AdminVisiMisiController;
use Polinema\WebProfilLabSe\Controllers\Admin\FokusRisetController as AdminFokusRisetController; 
use Polinema\WebProfilLabSe\Controllers\Admin\DosenController as AdminDosenController;
use Polinema\WebProfilLabSe\Controllers\Admin\MahasiswaController as AdminMahasiswaController;
use Polinema\WebProfilLabSe\Controllers\Admin\PublikasiController as AdminPublikasiController;
use Polinema\WebProfilLabSe\Controllers\Admin\UserController as AdminUserController;
use Polinema\WebProfilLabSe\Controllers\Admin\ResetController as AdminResetController;
 
// ================== PUBLIC ==================
$app->get('/',                  [HomeController::class, 'index']);
$app->get('/about',             [HomeController::class, 'about']);

// TENTANG
$app->get('/tentang/profil',    [HomeController::class, 'profil']);
$app->get('/tentang/visi-misi', [HomeController::class, 'visi_misi']);
$app->get('/tentang/fokus-riset',   [HomeController::class, 'fokus_riset']);
$app->get('/tentang/scope-penelitian',   [HomeController::class, 'scope_penelitian']);

// ANGGOTA (Gunakan PersonilController)
$app->get('/personil/dosen',     [PersonilController::class, 'dosen']);
$app->get('/personil/mahasiswa', [PersonilController::class, 'mahasiswa']);
$app->get('/personil/alumni',    [HomeController::class, 'alumni']);

// DETAIL PERSONIL (Gunakan PersonilController)
// Menangani klik detail dari halaman dosen/mahasiswa
$app->get('/personil/detail/{id}', [PersonilController::class, 'detail']);

// ARTIKEL
$app->get('/artikel',           [ArtikelController::class, 'index']);
$app->get('/artikel/detail/{slug}',      [ArtikelController::class, 'detail']);

// PENDAFTARAN
$app->post('/pendaftaran/store', [PendaftaranController::class, 'store']);
$app->get('/pendaftaran', [PendaftaranController::class, 'index']);
$app->get('/pendaftaran/cek-status', [PendaftaranController::class, 'cekStatus']);

// ================== AUTH ==================
$app->get('/login',             [AuthController::class, 'login']);
$app->post('/login-proses',     [AuthController::class, 'processLogin']);
$app->get('/logout',            [AuthController::class, 'logout']);

// FORGOT PASSWORD (PUBLIC)
$app->get('/forgot-password',   [AuthController::class, 'forgotPassword']);
$app->post('/forgot-password',  [AuthController::class, 'processForgotPassword']);

// ================== ADMIN DASHBOARD (PROTECTED - ALL ADMINS) ==================
// Menggunakan isAdmin() (Role 1 & 2 Boleh)
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
$app->post('/admin/refresh-stats', [AdminController::class, 'refreshStats']);

// ================== PROFILE (ADMIN) ==================
// Tentang Lab (pakai tabel profile)
$app->get('/admin/profile/tentangLab', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminTentangController();
    $controller->index();
});

$app->get('/admin/profile/tentangLab/edit', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminTentangController();
    $controller->edit();
});

$app->get('/admin/profile/tentangLab/delete', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminTentangController();
    $controller->delete();
});

$app->post('/admin/profile/tentangLab/update', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminTentangController();
    $controller->update();
});

// Visi Misi (pakai tabel profile juga)
$app->get('/admin/profile/visiMisi', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminVisiMisiController();
    $controller->index();
});

$app->get('/admin/profile/visiMisi/edit', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminVisiMisiController();
    $controller->edit();
});

$app->get('/admin/profile/visiMisi/delete', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminVisiMisiController();
    $controller->delete();
});

$app->post('/admin/profile/visiMisi/update', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminVisiMisiController();
    $controller->update();
});

// TAMBAHKAN ROUTE FOKUS RISET DI SINI (DENGAN MIDDLEWARE)
$app->get('/admin/profile/fokusRiset', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminFokusRisetController();
    $controller->index();
});

$app->get('/admin/profile/fokusRiset/create', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminFokusRisetController();
    $controller->create();
});

$app->post('/admin/profile/fokusRiset/store', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminFokusRisetController();
    $controller->store();
});

$app->get('/admin/profile/fokusRiset/edit', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminFokusRisetController();
    $controller->edit();
});

$app->post('/admin/profile/fokusRiset/update', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminFokusRisetController();
    $controller->update();
});

$app->post('/admin/profile/fokusRiset/delete', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminFokusRisetController();
    $controller->delete();
});
// -------------------------------------------

$app->get('/admin/profile/profil', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminRoadmapController();
    $controller->index();
});

$app->get('/admin/profile/profil/create', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminRoadmapController();
    $controller->create();
});

$app->get('/admin/profile/profil/edit', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminRoadmapController();
    $controller->edit();
});

$app->get('/admin/profile/profil/delete', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminRoadmapController();
    $controller->delete();
});

// Scope (read only)
$app->get('/admin/profile/scopePenelitian', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminScopeController();
    $controller->index();
});

// Album
$app->get('/admin/profile/album', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminAlbumController();
    $controller->index();
});

$app->get('/admin/profile/album/create', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminAlbumController();
    $controller->create();
});

$app->get('/admin/profile/album/edit', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminAlbumController();
    $controller->edit();
});

$app->get('/admin/profile/album/delete', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminAlbumController();
    $controller->delete();
});

$app->post('/admin/profile/album/store', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminAlbumController();
    $controller->store();
});

$app->post('/admin/profile/album/update', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminAlbumController();
    $controller->update();
});

// ================== PERSONIL (ADMIN) ==================
$app->get('/admin/personil', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminDosenController();
    $controller->index();
});

// Dosen
$app->get('/admin/personil/dosen', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminDosenController();
    $controller->index();
});

$app->get('/admin/personil/createDosen', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminDosenController();
    $controller->create();
});

$app->get('/admin/personil/dosen/edit', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminDosenController();
    $controller->edit();
});

$app->get('/admin/personil/dosen/delete', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminDosenController();
    $controller->delete();
});

$app->post('/admin/personil/dosen/store', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminDosenController();
    $controller->store();
});

$app->post('/admin/personil/dosen/update', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminDosenController();
    $controller->update();
});

// Mahasiswa
$app->get('/admin/personil/mahasiswa', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminMahasiswaController();
    $controller->index();
});

$app->get('/admin/personil/createMahasiswa', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminMahasiswaController();
    $controller->create();
});

$app->get('/admin/personil/mahasiswa/edit', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminMahasiswaController();
    $controller->edit();
});

$app->get('/admin/personil/mahasiswa/delete', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminMahasiswaController();
    $controller->delete();
});

$app->post('/admin/personil/mahasiswa/store', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminMahasiswaController();
    $controller->store();
});

$app->post('/admin/personil/mahasiswa/update', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminMahasiswaController();
    $controller->update();
});

// ================== BLOG (ADMIN) ==================
$app->get('/admin/blog', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminBlogController();
    $controller->index();
});

$app->get('/admin/blog/createBlog', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminBlogController();
    $controller->create();
});

$app->get('/admin/blog/edit', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminBlogController();
    $controller->edit();
});

$app->get('/admin/blog/delete', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminBlogController();
    $controller->delete();
});

$app->post('/admin/blog/store', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminBlogController();
    $controller->store();
});

$app->post('/admin/blog/update', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminBlogController();
    $controller->update();
});

// ================== REKRUTMEN (ADMIN) ==================
$app->get('/admin/rekrutmen', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminRekrutmenController();
    $controller->index();
});

$app->get('/admin/rekrutmen/createRekrutmen', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminRekrutmenController();
    $controller->create();
});

$app->get('/admin/rekrutmen/editRekrutmen', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminRekrutmenController();
    $controller->edit();
});

$app->get('/admin/rekrutmen/deleteRekrutmen', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminRekrutmenController();
    $controller->delete();
});

// ================== VISI MISI ==================
$app->get('/admin/profile/visiMisi', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminVisiMisiController();
    $controller->index();
});

$app->post('/admin/profile/visiMisi/updateVisi', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminVisiMisiController();
    $controller->updateVisi();
});

$app->post('/admin/profile/visiMisi/addMisi', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminVisiMisiController();
    $controller->addMisi();
});

$app->post('/admin/profile/visiMisi/updateMisi', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminVisiMisiController();
    $controller->updateMisi();
});

$app->post('/admin/profile/visiMisi/deleteMisi', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminVisiMisiController();
    $controller->deleteMisi();
});

// ================== TENTANG LAB ==================
$app->get('/admin/profile/tentang', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminTentangController();
    $controller->index();
});

$app->post('/admin/profile/tentang/save', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminTentangController();
    $controller->save();
});

// ================== FALLBACK 404 ==================
$app->notFound([HomeController::class, 'notFound']);

// ADMIN - ALBUM
$app->get('/admin/album', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminAlbumController();
    $controller->index();
});

$app->get('/admin/album/create', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminAlbumController();
    $controller->create();
});

$app->post('/admin/album/store', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminAlbumController();
    $controller->store();
});

$app->get('/admin/album/edit', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminAlbumController();
    $controller->edit();
});

$app->post('/admin/album/update', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminAlbumController();
    $controller->update();
});

$app->get('/admin/album/delete', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminAlbumController();
    $controller->delete();
});

// ADMIN - SCOPE PENELITIAN
$app->get('/admin/scope', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminScopeController();
    $controller->index();
});

$app->get('/admin/scope/create', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminScopeController();
    $controller->create();
});

$app->post('/admin/scope/store', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminScopeController();
    $controller->store();
});

$app->get('/admin/scope/edit', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminScopeController();
    $controller->edit();
});

$app->post('/admin/scope/update', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminScopeController();
    $controller->update();
});

$app->get('/admin/scope/delete', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminScopeController();
    $controller->delete();
});

// ADMIN - BLOG/ARTIKEL
$app->get('/admin/blog', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminBlogController();
    $controller->index();
});

$app->get('/admin/blog/create', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminBlogController();
    $controller->create();
});

$app->post('/admin/blog/store', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminBlogController();
    $controller->store();
});

$app->get('/admin/blog/edit', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminBlogController();
    $controller->edit();
});

$app->post('/admin/blog/update', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminBlogController();
    $controller->update();
});

$app->get('/admin/blog/delete', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminBlogController();
    $controller->delete();
});

// ADMIN - REKRUTMEN
$app->get('/admin/rekrutmen', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminRekrutmenController();
    $controller->index();
});

$app->get('/admin/rekrutmen/detail', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminRekrutmenController();
    $controller->detail();
});

$app->get('/admin/rekrutmen/edit', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminRekrutmenController();
    $controller->edit();
});

$app->post('/admin/rekrutmen/updateStatus', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminRekrutmenController();
    $controller->updateStatus();
});

$app->get('/admin/rekrutmen/delete', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminRekrutmenController();
    $controller->delete();
});

// ADMIN - PERSONIL MAHASISWA
$app->get('/admin/personil/mahasiswa', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminMahasiswaController();
    $controller->index();
});

$app->get('/admin/personil/mahasiswa/create', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminMahasiswaController();
    $controller->create();
});

$app->post('/admin/personil/mahasiswa/store', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminMahasiswaController();
    $controller->store();
});

$app->get('/admin/personil/mahasiswa/edit', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminMahasiswaController();
    $controller->edit();
});

$app->post('/admin/personil/mahasiswa/update', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminMahasiswaController();
    $controller->update();
});

$app->get('/admin/personil/mahasiswa/delete', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminMahasiswaController();
    $controller->delete();
});

// Routes Publikasi
$app->get('/admin/publikasi', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminPublikasiController();
    $controller->index();
});
$app->get('/admin/publikasi/create', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminPublikasiController();
    $controller->create();
});
$app->post('/admin/publikasi/store', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminPublikasiController();
    $controller->store();
});
$app->get('/admin/publikasi/edit', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminPublikasiController();
    $controller->edit();
});
$app->post('/admin/publikasi/update', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminPublikasiController();
    $controller->update();
});
$app->post('/admin/publikasi/delete', function() {
    AuthMiddleware::isAdmin();
    $controller = new AdminPublikasiController();
    $controller->delete();
});

// ================== SUPER ADMIN ONLY (PROTECTED - ROLE 1 ONLY) ==================
// Ganti isAdmin() menjadi isSuperAdmin() untuk route di bawah ini:

// 1. MANAJEMEN USER
$app->get('/admin/users', function() {
    AuthMiddleware::isSuperAdmin(); // <--- STRICT CHECK
    $controller = new AdminUserController();
    $controller->index();
});

$app->get('/admin/users/create', function() {
    AuthMiddleware::isSuperAdmin();
    $controller = new AdminUserController();
    $controller->create();
});

$app->post('/admin/users/store', function() {
    AuthMiddleware::isSuperAdmin();
    $controller = new AdminUserController();
    $controller->store();
});

$app->get('/admin/users/edit', function() {
    AuthMiddleware::isSuperAdmin();
    $controller = new AdminUserController();
    $controller->edit();
});

$app->post('/admin/users/update', function() {
    AuthMiddleware::isSuperAdmin();
    $controller = new AdminUserController();
    $controller->update();
});

$app->post('/admin/users/delete', function() {
    AuthMiddleware::isSuperAdmin();
    $controller = new AdminUserController();
    $controller->delete();
});

// 2. RESET PASSWORD REQUESTS
$app->get('/admin/reset-requests', function() {
    AuthMiddleware::isSuperAdmin(); // <--- STRICT CHECK
    $controller = new AdminResetController();
    $controller->index();
});

$app->post('/admin/reset-requests/approve', function() {
    AuthMiddleware::isSuperAdmin();
    $controller = new AdminResetController();
    $controller->approve();
});

$app->post('/admin/reset-requests/reject', function() {
    AuthMiddleware::isSuperAdmin();
    $controller = new AdminResetController();
    $controller->reject();
});

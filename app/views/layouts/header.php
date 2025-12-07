<?php
// 1. Setup URL & Halaman Saat Ini
$currentPage = strtok($_SERVER['REQUEST_URI'], '?');
$appUrl = $_ENV['APP_URL'] ?? '';

// 2. Logika Active State Dasar
$isBeranda = ($currentPage === '/') || ($currentPage === '/home.php');

// Cek Base Path jika aplikasi tidak di root domain
if (!empty($appUrl) && $appUrl !== '/') {
    $basePath = parse_url($appUrl, PHP_URL_PATH) ?? $appUrl; 
    // Normalisasi slash di akhir
    if (rtrim($currentPage, '/') === rtrim($basePath, '/')) {
        $isBeranda = true;
    }
}

// Deteksi Section Halaman
$isTentang = strpos($currentPage, '/tentang') !== false;
$isAnggota = strpos($currentPage, '/personil') !== false || strpos($currentPage, '/anggota') !== false;   
$isArtikel = strpos($currentPage, '/artikel') !== false;
$isPendaftaran = strpos($currentPage, '/pendaftaran') !== false;

// 3. LOGIKA FIX BUG ACTIVE STATE (ID 1 vs 10)
// Kita siapkan variabel ini di sini agar View HTML lebih bersih
$urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$urlSegments = explode('/', rtrim($urlPath, '/'));
$currentPersonilId = end($urlSegments); // Mengambil segmen terakhir URL (misal: 10)
$isDetailPage = strpos($urlPath, '/personil/detail/') !== false;

// 4. LOGIKA DATA MENU DOSEN (Injection & Fallback)
// Cek apakah data sudah dikirim dari Controller?
$dosenMenu = isset($globalDosenMenu) ? $globalDosenMenu : [];

// Jika kosong, ambil manual langsung dari Model (Fallback / Jaga-jaga)
if (empty($dosenMenu)) {
    try {
        $modelClass = 'Polinema\WebProfilLabSe\Models\Personil';
        if (class_exists($modelClass)) {
            $model = new $modelClass();
            if (method_exists($model, 'getDosenList')) {
                $dosenMenu = $model->getDosenList();
            }
        }
    } catch (Exception $e) {
        // Silent fail: Menu kosong jika error
        $dosenMenu = [];
    }
}
$featuredMenu = isset($globalFeaturedArticles) ? $globalFeaturedArticles : [];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? $pageTitle : 'Laboratorium Software Engineering' ?></title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link rel="stylesheet" href="<?= $appUrl ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $appUrl ?>/assets/css/landing_page.css">
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-dark navbar-glass py-3 sticky-top">
        <div class="container px-4">
            
            <a class="navbar-brand d-flex align-items-center gap-3" href="<?= $appUrl ?>/">
                <div class="d-flex align-items-center bg-white bg-opacity-10 rounded-3 px-2 py-1">
                    <img src="<?= $appUrl ?>/assets/icons/lab_se.svg" alt="Lab SE" width="36" height="36">
                    <div style="width: 1px; height: 24px; background: rgba(255,255,255,0.3); margin: 0 8px;"></div>
                    <img src="<?= $appUrl ?>/assets/icons/jti.svg" alt="Polinema" width="34" height="34">
                </div>
                
                <div class="d-flex flex-column brand-text">
                    <span class="brand-title text-white">Laboratorium SE</span>
                    <span class="brand-subtitle">Politeknik Negeri Malang</span>
                </div>
            </a>
            
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center gap-1">

                    <li class="nav-item">
                        <a class="nav-link nav-link-custom <?= $isBeranda ? 'active' : '' ?>" 
                        href="<?= $appUrl ?>/">
                            Beranda
                        </a>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link nav-link-custom <?= $isTentang ? 'active' : '' ?>" 
                        href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Tentang
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item <?= strpos($currentPage, '/tentang/profil') !== false ? 'active' : '' ?>" 
                                href="<?= $appUrl ?>/tentang/profil">
                                <i class="bi bi-building me-2"></i> Profil Lab
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item <?= strpos($currentPage, '/tentang/visi-misi') !== false ? 'active' : '' ?>" 
                                href="<?= $appUrl ?>/tentang/visi-misi">
                                <i class="bi bi-bullseye me-2"></i> Visi & Misi
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item <?= strpos($currentPage, '/tentang/fokus-riset') !== false ? 'active' : '' ?>" 
                                href="<?= $appUrl ?>/tentang/fokus-riset">
                                <i class="bi bi-lightbulb me-2"></i> Fokus Riset
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item <?= strpos($currentPage, '/tentang/scope-penelitian') !== false ? 'active' : '' ?>" 
                                href="<?= $appUrl ?>/tentang/scope-penelitian">
                                <i class="bi bi-search me-2"></i> Scope Penelitian
                                </a>
                            </li>

                            <?php if (!empty($featuredMenu)): ?>
                                <li><hr class="dropdown-divider bg-light opacity-25"></li>
                                <li class="px-3 py-1 small text-uppercase text-warning fw-bold" style="font-size: 0.65rem; letter-spacing: 1px;">
                                    Sorotan
                                </li>
                                
                                <?php foreach ($featuredMenu as $art): ?>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-start gap-2" 
                                        href="<?= $appUrl ?>/artikel/detail/<?= $art['slug'] ?>">
                                        <i class="bi bi-star-fill text-warning mt-1" style="font-size: 0.8rem;"></i>
                                        <span class="text-wrap" style="line-height: 1.3; font-size: 0.9rem;">
                                            <?= htmlspecialchars($art['title']) ?>
                                        </span>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>

                        </ul>
                    </li>

                    <!-- DROPDOWN ANGGOTA -->
                    <li class="nav-item dropdown">
                        <a class="nav-link nav-link-custom <?= $isAnggota ? 'active' : '' ?>" 
                        href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Anggota
                        </a>
                        <ul class="dropdown-menu">

                            <!-- LOOPING NAMA DOSEN -->
                            <?php if (!empty($dosenMenu)): ?>
                                <li class="px-3 py-1 small text-uppercase text-white fw-bold" style="font-size: 0.7rem;">Dosen</li>
                                
                                <?php foreach ($dosenMenu as $dosen): ?>
                                    <li>
                                        <a class="dropdown-item <?= ($isDetailPage && $currentPersonilId == $dosen['id']) ? 'active' : '' ?>" 
                                        href="<?= $appUrl ?>/personil/detail/<?= $dosen['id'] ?>">
                                        <i class="bi bi-person-badge me-2"></i>
                                        <?= htmlspecialchars($dosen['nama']) ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                                
                                <li><hr class="dropdown-divider bg-light opacity-25"></li>
                            <?php endif; ?>

                            <!-- Link Mahasiswa -->
                            <li>
                                <a class="dropdown-item <?= strpos($currentPage, '/personil/mahasiswa') !== false ? 'active' : '' ?>" 
                                href="<?= $appUrl ?>/personil/mahasiswa">
                                <i class="bi bi-mortarboard me-2"></i>
                                    Mahasiswa
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link nav-link-custom <?= $isArtikel ? 'active' : '' ?>" 
                        href="<?= $appUrl ?>/artikel">
                            Artikel
                        </a>
                    </li>

                    <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
                        <a class="btn btn-register" 
                        href="<?= $appUrl ?>/pendaftaran">
                            Pendaftaran Anggota
                        <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
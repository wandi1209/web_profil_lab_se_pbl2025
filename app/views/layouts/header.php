<?php
$currentPage = strtok($_SERVER['REQUEST_URI'], '?');
$appUrl = $_ENV['APP_URL'] ?? '';
$isBeranda = ($currentPage === '/') || ($currentPage === '/home.php');
if (!empty($appUrl) && $appUrl !== '/') {
    $basePath = parse_url($appUrl, PHP_URL_PATH) ?? $appUrl; 

    if (rtrim($currentPage, '/') === rtrim($basePath, '/')) {
        $isBeranda = true;
    }
}
$isTentang = strpos($currentPage, '/tentang') !== false;
$isAnggota = strpos($currentPage, '/personil') !== false;   
$isArtikel = strpos($currentPage, '/artikel') !== false;
$isPendaftaran = strpos($currentPage, '/pendaftaran') !== false;
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
            
            <a class="navbar-brand d-flex align-items-center gap-3" href="<?= $appUrl ?>/index.php">
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
                                <i class="bi bi-building me-2"></i> 
                                    Profil Lab
                                </a>
                            </li>

                            <li><hr class="dropdown-divider bg-light opacity-25"></li>

                            <li>
                                <a class="dropdown-item <?= strpos($currentPage, '/tentang/visi-misi') !== false ? 'active' : '' ?>" 
                                href="<?= $appUrl ?>/tentang/visi-misi">
                                <i class="bi bi-bullseye me-2"></i>
                                    Visi & Misi
                                </a>
                            </li>

                            <li><hr class="dropdown-divider bg-light opacity-25"></li>

                            <li>
                                <a class="dropdown-item <?= strpos($currentPage, '/tentang/fokus-riset') !== false ? 'active' : '' ?>" 
                                href="<?= $appUrl ?>/tentang/fokus-riset">
                                <i class="bi bi-lightbulb me-2"></i> Fokus Riset
                                </a>
                            </li>

                            <li><hr class="dropdown-divider bg-light opacity-25"></li>

                            <li>
                                <a class="dropdown-item <?= strpos($currentPage, '/tentang/scope-penelitian') !== false ? 'active' : '' ?>" 
                                href="<?= $appUrl ?>/tentang/scope-penelitian">
                                <i class="bi bi-search me-2"></i>
                                    Scope Penelitian
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link nav-link-custom <?= $isAnggota ? 'active' : '' ?>" 
                        href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Anggota
                        </a>
                        <ul class="dropdown-menu">

                            <li>
                                <a class="dropdown-item <?= strpos($currentPage, '/personil/dosen') !== false ? 'active' : '' ?>" 
                                href="<?= $appUrl ?>/personil/dosen/1">
                                <i class="bi bi-person-badge me-2"></i>
                                    Nama Dosen
                                </a>
                            </li>

                            <li><hr class="dropdown-divider bg-light opacity-25"></li>

                            <li>
                                <a class="dropdown-item <?= strpos($currentPage, '/personil/mahasiswa') !== false ? 'active' : '' ?>" 
                                href="<?= $appUrl ?>/personil/mahasiswa">
                                <i class="bi bi-people me-2"></i>
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
                        <a class="btn btn-register <?= $isPendaftaran ? 'active' : '' ?>" 
                        href="<?= $appUrl ?>/pendaftaran">
                            Pendaftaran Anggota
                        <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
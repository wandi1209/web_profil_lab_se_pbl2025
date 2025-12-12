<?php 
$pageTitle = "Beranda - Laboratorium SE"; 
?>

<section class="p-0 m-0 position-relative overflow-hidden">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="6000">
        
        <div class="carousel-inner">
            
            <div class="carousel-item active hero-slider-item">
                <img src="<?= $_ENV['APP_URL'] ?>/assets/images/gedung.webp" class="hero-img-zoom" alt="Gedung Laboratorium SE">
                
                <div class="hero-overlay"></div>
                <div class="hero-pattern"></div>

                <div class="hero-content container ps-md-5">
                    <div class="row">
                        <div class="col-lg-8 text-white">
                            <div class="animate-up delay-100">
                                <span class="badge bg-white bg-opacity-10 border border-white border-opacity-25 text-white mb-3 px-3 py-2 rounded-pill fw-light backdrop-blur">
                                    <i class="bi bi-patch-check-fill text-info me-2"></i> Center of Excellence
                                </span>
                            </div>

                            <h1 class="display-3 fw-bold mb-3 lh-1 animate-up delay-200" style="letter-spacing: -1px;">
                                Laboratorium <br>
                                <span style="color: #81dafc;">Software Engineering</span>
                            </h1>

                            <p class="fs-5 mb-5 text-white-50 animate-up delay-300" style="max-width: 600px; font-weight: 300; line-height: 1.8;">
                                Mencetak talenta digital masa depan melalui integrasi kurikulum industri, riset inovatif, dan pengembangan teknologi mutakhir di Politeknik Negeri Malang.
                            </p>

                            <div class="d-flex gap-3 animate-up delay-400">
                                <a href="<?= $_ENV['APP_URL'] ?>/tentang/profil" class="btn btn-primary bg-custom-blue border-0 px-4 py-3 rounded-pill fw-bold shadow-lg hover-scale">
                                    Pelajari Profil <i class="bi bi-arrow-right ms-2"></i>
                                </a>
                                </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-item hero-slider-item">
                <img src="<?= $_ENV['APP_URL'] ?>/assets/images/slider-2.jpg" class="hero-img-zoom" alt="Aktivitas Riset">
                
                <div class="hero-overlay"></div>
                <div class="hero-pattern"></div>

                <div class="hero-content container ps-md-5">
                    <div class="row">
                        <div class="col-lg-8 text-white">
                            <div class="animate-up delay-100">
                                <span class="badge bg-success bg-opacity-25 border border-success border-opacity-50 text-white mb-3 px-3 py-2 rounded-pill fw-light backdrop-blur">
                                    <i class="bi bi-cpu-fill me-2"></i> Research & Innovation
                                </span>
                            </div>

                            <h1 class="display-3 fw-bold mb-3 lh-1 animate-up delay-200">
                                Inovasi Teknologi <br>
                                <span class="text-success">Masa Depan</span>
                            </h1>

                            <p class="fs-5 mb-5 text-white-50 animate-up delay-300" style="max-width: 600px; font-weight: 300; line-height: 1.8;">
                                Fokus pada pengembangan Artificial Intelligence, Cloud Computing, dan Mobile Solutions untuk menjawab tantangan industri 4.0.
                            </p>

                            <div class="d-flex gap-3 animate-up delay-400">
                                <a href="<?= $_ENV['APP_URL'] ?>/#fokus-riset" class="btn btn-success border-0 px-4 py-3 rounded-pill fw-bold shadow-lg hover-scale">
                                    Lihat Fokus Riset <i class="bi bi-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <div class="glass-btn rounded-circle d-flex align-items-center justify-content-center ms-4" style="width: 50px; height: 50px;">
                <i class="bi bi-chevron-left fs-5"></i>
            </div>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <div class="glass-btn rounded-circle d-flex align-items-center justify-content-center me-4" style="width: 50px; height: 50px;">
                <i class="bi bi-chevron-right fs-5"></i>
            </div>
        </button>

    </div>
</section>

<section id='tentang' class="py-5 bg-white">
    <div class="container py-lg-5">
        <div class="row align-items-center g-5">
            
            <div class="col-lg-6 order-2 order-lg-1">
                <div class="about-img-wrapper">
                    <?php 
                        $imgTentang = !empty($tentang['gambar']) 
                            ? $_ENV['APP_URL'] . '/public' . $tentang['gambar'] 
                            : $_ENV['APP_URL'] . '/assets/images/gedung.webp';
                    ?>
                    <img src="<?= $imgTentang ?>" alt="Tentang Lab" class="about-img-main">
                    
                    <div class="floating-badge">
                        <div class="bg-custom-blue bg-opacity-10 p-2 rounded-circle text-custom-blue">
                            <i class="bi bi-trophy-fill fs-3"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0 text-dark">Akreditasi Unggul</h5>
                            <small class="text-secondary">Jurusan Teknologi Informasi</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 order-1 order-lg-2">
                <span class="text-custom-blue fw-bold text-uppercase small ls-1">Tentang Kami</span>
                <h2 class="display-6 fw-bold text-dark mt-2 mb-4"><?= htmlspecialchars($tentang['judul'] ?? 'Pusat Unggulan Rekayasa Perangkat Lunak') ?></h2>
                
                <div class="text-secondary lh-lg mb-4">
                    <?= ($tentang['konten'] ?? 'Deskripsi laboratorium belum tersedia.') ?>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-check-circle-fill text-success"></i>
                            <span class="fw-medium text-dark">Fasilitas Modern</span>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-check-circle-fill text-success"></i>
                            <span class="fw-medium text-dark">Kurikulum Industri</span>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-check-circle-fill text-success"></i>
                            <span class="fw-medium text-dark">Mentoring Dosen</span>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-check-circle-fill text-success"></i>
                            <span class="fw-medium text-dark">Riset Unggulan</span>
                        </div>
                    </div>
                </div>

                <a href="<?= $_ENV['APP_URL'] ?>/tentang/profil" class="btn btn-outline-primary rounded-pill px-4 fw-medium">
                    Selengkapnya Tentang Kami
                </a>
            </div>

        </div>
    </div>
</section>

<section id="galeri" class="py-5 bg-gradient-light overflow-hidden">
    <div class="container-fluid"> 
        <div class="container text-center mb-4">
            <span class="badge bg-custom-blue badge-pill fs-6 mb-2">Galeri</span>
            <h2 class="fw-bold text-dark">Album Kegiatan Lab</h2>
            <p class="text-secondary">Dokumentasi kegiatan riset, praktikum, dan kebersamaan tim.</p>
        </div>

        <div class="marquee-wrapper">
            <div class="marquee-content">
                <?php if (!empty($album)): ?>
                    <?php 
                    for ($i = 0; $i < 2; $i++) : 
                        foreach ($album as $photo) : 
                            $imgUrl = !empty($photo['foto_url']) 
                                ? $_ENV['APP_URL'] . '/public' . $photo['foto_url'] 
                                : $_ENV['APP_URL'] . '/assets/images/gedung.webp';
                    ?>
                        <div class="album-card">
                            <img src="<?= $imgUrl ?>" alt="<?= htmlspecialchars($photo['judul']) ?>">
                            <div class="album-overlay">
                                <h5 class="text-white mb-0 fw-medium"><?= htmlspecialchars($photo['judul']) ?></h5>
                            </div>
                        </div>
                    <?php 
                        endforeach; 
                    endfor; 
                    ?>
                <?php else: ?>
                    <p class="text-center text-muted w-100">Belum ada album kegiatan.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<section class="py-5 position-relative" style="background-color: #f8fafc;">
    <div class="container py-4">
        <div class="row g-5 items-center">
            <div class="col-lg-5">
                <div class="visi-card-modern">
                    <div class="visi-bg-shape"></div>
                    <div class="position-relative" style="z-index: 1;">
                        <div class="visi-icon-large">
                            <i class="bi bi-bullseye"></i>
                        </div>
                        <h6 class="text-uppercase fw-bold text-white-50 ls-1 mb-2">Visi Kami</h6>
                        <h2 class="fw-bold mb-4">Menjadi Pusat Keunggulan Teknologi Masa Depan</h2>
                        <p class="text-white-50 lh-lg mb-0">
                            "<?= htmlspecialchars($visi ?? 'Visi belum diatur.') ?>"
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="ps-lg-4">
                    <div class="mb-4">
                        <h6 class="text-custom-blue fw-bold text-uppercase small ls-1">Misi Kami</h6>
                        <h2 class="fw-bold text-dark">Langkah Strategis</h2>
                    </div>

                    <?php if (!empty($misi)): ?>
                        <?php foreach ($misi as $index => $m): ?>
                        <div class="misi-item">
                            <div class="misi-number"><?= str_pad($index + 1, 2, '0', STR_PAD_LEFT) ?></div>
                            <div>
                                <p class="misi-text mb-0"><?= htmlspecialchars($m['konten']) ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-muted">Data misi belum tersedia.</p>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</section>

<section id="fokus-riset" class="py-5 my-5 bg-white position-relative">
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 50%; background: linear-gradient(180deg, #f8fbff 0%, #ffffff 100%); z-index: 0;"></div>
    <div class="container position-relative" style="z-index: 1;">
        <div class="row mb-5 align-items-end">
            <div class="col-lg-8">
                <span class="text-custom-blue fw-bold text-uppercase small ls-1">Core Competency</span>
                <h2 class="display-6 fw-bold text-dark mt-1">Fokus Riset Utama</h2>
                <p class="text-secondary mb-0" style="max-width: 600px;">
                    Kami mendalami pilar-pilar utama dalam rekayasa perangkat lunak.
                </p>
            </div>
        </div>
        
        <div class="row g-4">
             <?php if (!empty($fokusRiset)): ?>
                <?php foreach ($fokusRiset as $index => $item) : 
                    $num = str_pad($index + 1, 2, '0', STR_PAD_LEFT);
                    $icon = !empty($item['icon']) ? $item['icon'] : 'bi-diagram-3-fill';
                    $desc = !empty($item['description']) ? $item['description'] : 'Pengembangan teknologi software terkini.';
                ?>
                    <div class="col-lg-4">
                        <div class="focus-card">
                            <div class="focus-number"><?= $num ?></div>
                            <div class="focus-content">
                                <div class="focus-icon-box"><i class="bi <?= htmlspecialchars($icon) ?>"></i></div>
                                <h4 class="fw-bold text-dark mb-3" style="font-size: 1.25rem;"><?= htmlspecialchars($item['title']) ?></h4>
                                <p class="text-secondary small mb-4"><?= htmlspecialchars($desc) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center text-muted">Data fokus riset belum tersedia.</div>
            <?php endif; ?>
        </div>
    </div>
</section>

<section id='publikasi' class="py-5 bg-soft-blue">
    <div class="container py-4">
        <div class="row align-items-end mb-5">
            <div class="col-lg-6">
                <span class="text-custom-blue fw-bold text-uppercase small ls-1">Riset & Karya</span>
                <h2 class="display-6 fw-bold text-dark mt-1">Sorotan Publikasi</h2>
                <p class="text-secondary mb-0">Karya ilmiah terpilih dari dosen dan mahasiswa kami.</p>
            </div>
        </div>

        <div class="row g-4">
            <?php if (!empty($publikasi)): ?>
                <?php foreach ($publikasi as $item) : 
                    $tahun    = htmlspecialchars($item['tahun'] ?? '');
                    $judul    = htmlspecialchars($item['judul'] ?? 'Judul publikasi');
                    $penulis  = htmlspecialchars($item['nama_penulis'] ?? 'Tim Riset');
                    $url      = htmlspecialchars($item['url'] ?? '#');
                    $fotoPersonil = !empty($item['foto_url'])
                        ? $_ENV['APP_URL'] . (strpos($item['foto_url'], '/public') === 0 ? $item['foto_url'] : '/public' . $item['foto_url'])
                        : $_ENV['APP_URL'] . '/assets/images/person-placeholder.jpg';
                    $personilId = $item['personil_id'] ?? null;
                ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="pub-card-modern p-4 d-flex flex-column h-100">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <span class="badge pub-badge-year rounded-pill px-3 py-2">
                                    <i class="bi bi-calendar-event me-1"></i> <?= $tahun ?>
                                </span>
                                <span class="pub-type-badge">
                                    <i class="bi bi-journal-text me-1"></i> Publikasi
                                </span>
                            </div>

                            <div class="mb-3">
                                <h5 class="fw-bold text-dark pub-title mb-0 line-clamp-3" title="<?= $judul ?>">
                                    <?= $judul ?>
                                </h5>
                            </div>

                            <div class="mt-auto">
                                <div class="d-flex align-items-center gap-2 mb-3">
                                    <img src="<?= $fotoPersonil ?>" alt="<?= htmlspecialchars($penulis) ?>" 
                                         class="rounded-circle shadow-sm object-fit-cover" 
                                         style="width:32px; height:32px; border: 2px solid #fff;">
                                    
                                    <?php if ($personilId): ?>
                                        <a href="<?= $_ENV['APP_URL'] ?>/personil/detail/<?= $personilId ?>" class="fw-bold text-dark text-decoration-none small">
                                            <?= $penulis ?>
                                        </a>
                                    <?php else: ?>
                                        <span class="text-secondary fw-medium small"><?= $penulis ?></span>
                                    <?php endif; ?>
                                </div>

                                <a href="<?= $url ?>" target="_blank" class="btn btn-read w-100 py-2">
                                    Baca Jurnal <i class="bi bi-arrow-right-short fs-5"></i>
                                </a>
                            </div>
                            </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <p class="text-muted">Belum ada data publikasi.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<section id="people" class="py-5" style="background-color: #f8f9fa;">
    <div class="container py-4">
        
        <div class="text-center mb-5">
            <span class="text-primary fw-bold text-uppercase small ls-1">People</span>
            <h2 class="display-6 fw-bold text-dark mt-1">Tim Laboratorium</h2>
            <div class="mx-auto mt-2" style="width: 60px; height: 3px; background-color: #0d6efd;"></div>
        </div>

        <ul class="nav nav-pills justify-content-center mb-5" id="teamTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active rounded-pill px-4 fw-medium shadow-sm" id="dosen-tab" data-bs-toggle="pill" data-bs-target="#pills-dosen" type="button" role="tab">
                    <i class="bi bi-person-video3 me-2"></i> Dosen
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link rounded-pill px-4 fw-medium shadow-sm ms-2" id="mahasiswa-tab" data-bs-toggle="pill" data-bs-target="#pills-mahasiswa" type="button" role="tab">
                    <i class="bi bi-mortarboard me-2"></i> Mahasiswa
                </button>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
            
            <div class="tab-pane fade show active" id="pills-dosen" role="tabpanel">
                <div class="row g-4 justify-content-center">
                    <?php if (!empty($dataDosen) && is_array($dataDosen)): ?>
                        <?php foreach ($dataDosen as $d) : ?>
                            <?php if (!is_array($d)) continue; 
                                // 1. Setup Variabel Data
                                $rawFoto = $d['foto_url'] ?? '';
                                $hasPublicPrefix = is_string($rawFoto) && strpos($rawFoto, '/public') === 0;
                                $fotoUrl = (!empty($rawFoto))
                                    ? ($hasPublicPrefix ? $_ENV['APP_URL'] . $rawFoto : $_ENV['APP_URL'] . '/public' . $rawFoto)
                                    : $_ENV['APP_URL'] . '/assets/images/person-placeholder.jpg';
                                
                                $nama = $d['nama'] ?? 'Tanpa Nama';
                                $posisi = $d['position'] ?? 'Dosen';
                                $id = $d['id'] ?? '#';
                                
                                // 2. LOGIKA PECAH STRING KEAHLIAN (FIX)
                                $keahlianString = $d['keahlian'] ?? '';
                                // Explode: String -> Array
                                $keahlianArray = array_filter(array_map('trim', explode(',', $keahlianString)));
                            ?>
                            
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="team-card">
                                    <div class="team-img-wrapper">
                                        <img src="<?= $fotoUrl ?>" alt="<?= htmlspecialchars($nama) ?>">
                                    </div>
                                    
                                    <h5 class="fw-bold text-dark mb-1"><?= htmlspecialchars($nama) ?></h5>
                                    <p class="text-role mb-2"><?= htmlspecialchars($posisi) ?></p>
                                    
                                    <div class="role-badge-container">
                                        <?php if(!empty($keahlianArray)): ?>
                                            <?php foreach(array_slice($keahlianArray, 0, 3) as $skill): ?>
                                                <span class="skill-pill">
                                                    <?= htmlspecialchars($skill) ?>
                                                </span>
                                            <?php endforeach; ?>
                                            
                                            <?php if(count($keahlianArray) > 3): ?>
                                                <span class="skill-pill bg-light text-secondary border">
                                                    +<?= count($keahlianArray) - 3 ?>
                                                </span>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <span class="skill-pill bg-light text-secondary">Dosen</span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="mt-auto">
                                        <a href="<?= $_ENV['APP_URL'] ?>/personil/detail/<?= $id ?>" class="btn btn-sm btn-outline-primary rounded-pill px-4">
                                            Profil <i class="bi bi-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12 text-center py-5">
                            <p class="text-muted">Data dosen belum tersedia.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="tab-pane fade" id="pills-mahasiswa" role="tabpanel">
                <div class="row g-4 justify-content-center">
                    <?php if (!empty($mahasiswa) && is_array($mahasiswa)): ?>
                        <?php foreach ($mahasiswa as $m) : ?>
                            <?php if (!is_array($m)) continue; 
                                $fotoUrlMhs = isset($m['foto_url']) && !empty($m['foto_url']) 
                                    ? $_ENV['APP_URL'] . '/public' . $m['foto_url'] 
                                    : $_ENV['APP_URL'] . '/assets/images/person-placeholder.jpg';
                                $namaMhs = $m['nama'] ?? 'Tanpa Nama';
                                $posisiMhs = $m['position'] ?? 'Mahasiswa';
                                
                                // LOGIKA KEAHLIAN MAHASISWA
                                $keahlianMhsString = $m['keahlian'] ?? '';
                                $keahlianMhsArray = array_filter(array_map('trim', explode(',', $keahlianMhsString)));
                            ?>
                            
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="team-card">
                                    <div class="team-img-wrapper">
                                        <img src="<?= $fotoUrlMhs ?>" alt="<?= htmlspecialchars($namaMhs) ?>">
                                    </div>
                                    
                                    <h5 class="fw-bold text-dark mb-1"><?= htmlspecialchars($namaMhs) ?></h5>
                                    <p class="text-role mb-2"><?= htmlspecialchars($posisiMhs) ?></p>
                                    
                                    <div class="role-badge-container">
                                        <?php if(!empty($keahlianMhsArray)): ?>
                                            <?php foreach(array_slice($keahlianMhsArray, 0, 3) as $skill): ?>
                                                <span class="skill-pill student-style">
                                                    <?= htmlspecialchars($skill) ?>
                                                </span>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                             <span class="skill-pill bg-light text-secondary">Mahasiswa</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12 text-center py-5">
                            <p class="text-muted">Data mahasiswa belum tersedia.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="text-center mt-5">
            <a id="btn-dynamic-action" href="<?= $_ENV['APP_URL'] ?>/personil/mahasiswa"
               class="btn btn-outline-primary rounded-pill px-5 py-2 fw-medium transition-all"
               style="display: none;"> Lihat Seluruh Mahasiswa <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<section id="scope" class="py-5 bg-white">
    <div class="container py-4">
        
        <div class="text-center mb-5">
            <span class="text-custom-blue fw-bold text-uppercase small ls-1">Research Areas</span>
            <h2 class="display-6 fw-bold text-dark mt-1">Scope Penelitian</h2>
            <p class="text-secondary mx-auto" style="max-width: 600px;">
                Kami memfokuskan riset pada teknologi mutakhir untuk menjawab tantangan industri digital masa depan.
            </p>
        </div>

        <div class="row g-4">
            <?php if (!empty($scopes)): ?>
                <?php foreach ($scopes as $index => $s) : 
                    // 1. Tentukan Tema Warna (Looping)
                    $themes = ['theme-blue', 'theme-purple', 'theme-green', 'theme-red', 'theme-orange', 'theme-cyan'];
                    $theme = $themes[$index % count($themes)];
                    
                    // 2. Parse Tags
                    $tags = [];
                    if (!empty($s['tags'])) {
                        $decoded = json_decode($s['tags'], true);
                        if (is_array($decoded)) {
                            $tags = $decoded;
                        } else {
                            $tags = array_map('trim', explode(',', $s['tags']));
                        }
                    }
                    
                    // 3. Setup Icon (Fallback ke 'bi-layers' jika kosong)
                    $iconClass = !empty($s['icon_bootstrap']) ? htmlspecialchars($s['icon_bootstrap']) : 'bi-layers';
                ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="scope-card <?= $theme ?> h-100">
                            
                            <div class="d-flex justify-content-between align-items-start mb-4 position-relative">
                                
                                <div class="scope-icon-box">
                                    <i class="bi <?= $iconClass ?>"></i>
                                </div>

                                <div class="scope-watermark">
                                    <i class="bi <?= $iconClass ?>"></i>
                                </div>
                            </div>

                            <h4 class="fw-bold text-dark mb-3"><?= htmlspecialchars($s['kategori']) ?></h4>
                            <p class="text-secondary small mb-4" style="line-height: 1.6;">
                                <?= htmlspecialchars($s['deskripsi']) ?>
                            </p>

                            <div class="scope-tags mt-auto">
                                <?php foreach($tags as $tag) : ?>
                                    <span class="scope-tag"><?= htmlspecialchars($tag) ?></span>
                                <?php endforeach; ?>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <p class="text-muted">Belum ada data scope penelitian.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<section id="artikel" class="py-5 bg-white">
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-end mb-5">
            <div>
                <span class="text-custom-blue fw-bold text-uppercase small ls-1">Update Terkini</span>
                <h2 class="display-6 fw-bold text-dark mt-1">Wawasan & Berita</h2>
            </div>
            <a href="<?= $_ENV['APP_URL'] ?>/artikel" class="btn btn-outline-primary rounded-pill px-4 fw-medium d-none d-md-inline-block">
                Lihat Semua <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="row g-4">
            <?php if (!empty($articles)): ?>
                <?php 
                    $heroArticle = $articles[0];
                    $sideArticles = array_slice($articles, 1);
                ?>
                <div class="col-lg-7">
                    <a href="<?= $_ENV['APP_URL'] ?>/artikel/detail/<?= $heroArticle['slug'] ?>" class="text-decoration-none">
                        <div class="blog-hero-card">
                            <?php 
                                $heroImg = !empty($heroArticle['gambar_url']) 
                                    ? $_ENV['APP_URL'] . '/public' . $heroArticle['gambar_url'] 
                                    : $_ENV['APP_URL'] . '/assets/images/gedung.webp';
                            ?>
                            <img src="<?= $heroImg ?>" alt="<?= htmlspecialchars($heroArticle['title']) ?>" class="blog-hero-img">
                            <div class="blog-hero-overlay"></div>
                            <div class="blog-hero-content">
                                <span class="blog-cat-badge cat-hero">
                                    <i class="bi bi-star-fill me-1"></i> Terbaru
                                </span>
                                <h3 class="blog-hero-title text-white">
                                    <?= htmlspecialchars($heroArticle['title']) ?>
                                </h3>
                                <div class="d-flex align-items-center text-white small mt-3 opacity-75">
                                    <span class="me-3"><i class="bi bi-calendar3 me-2"></i> <?= date('d M Y', strtotime($heroArticle['created_at'])) ?></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-5">
                    <div class="d-flex flex-column h-100">
                        <?php foreach($sideArticles as $art) : ?>
                        <a href="<?= $_ENV['APP_URL'] ?>/artikel/detail/<?= $art['slug'] ?>" class="text-decoration-none">
                            <div class="blog-list-card">
                                <div class="blog-list-img-wrapper">
                                    <?php 
                                        $sideImg = !empty($art['gambar_url']) 
                                            ? $_ENV['APP_URL'] . '/public' . $art['gambar_url'] 
                                            : $_ENV['APP_URL'] . '/assets/images/gedung.webp';
                                    ?>
                                    <img src="<?= $sideImg ?>" alt="<?= htmlspecialchars($art['title']) ?>" class="blog-list-img">
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="blog-cat-badge cat-news mb-2">Artikel</span>
                                        <i class="bi bi-arrow-right read-more-arrow"></i>
                                    </div>
                                    <h6 class="blog-list-title"><?= htmlspecialchars($art['title']) ?></h6>
                                    <div class="blog-meta">
                                        <span><i class="bi bi-calendar-event me-1"></i> <?= date('d M Y', strtotime($art['created_at'])) ?></span>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="col-12 text-center">
                    <p class="text-muted">Belum ada artikel terbaru.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const btnAction = document.getElementById('btn-dynamic-action');
    const tabEls = document.querySelectorAll('button[data-bs-toggle="pill"]');

    // Fungsi untuk cek tab mana yang aktif
    function toggleButton(targetId) {
        if (targetId === '#pills-mahasiswa') {
            btnAction.style.display = 'inline-block'; // Munculkan tombol
        } else {
            btnAction.style.display = 'none'; // Sembunyikan tombol
        }
    }

    // 1. Cek saat halaman pertama kali dimuat
    const activeTab = document.querySelector('.nav-link.active');
    if (activeTab) {
        toggleButton(activeTab.getAttribute('data-bs-target'));
    }

    // 2. Event Listener saat tab diklik/berubah
    tabEls.forEach(tab => {
        tab.addEventListener('shown.bs.tab', function (event) {
            const targetId = event.target.getAttribute('data-bs-target');
            toggleButton(targetId);
        });
    });
});
</script>

<style>
/* --- STYLES PUBLIKASI BARU --- */
.bg-soft-blue {
    background: linear-gradient(180deg, #f7fbff 0%, #ffffff 100%);
}
.pub-card-modern {
    border: 1px solid #e3eaf5;
    border-radius: 18px;
    background: #fff;
    box-shadow: 0 6px 18px rgba(16, 24, 40, 0.06);
    /* Gunakan 100% height agar mengikuti grid */
    height: 100%;
    min-height: 350px; /* Tambahkan sedikit minimum agar tidak gepeng jika konten sedikit */
    display: flex;
    flex-direction: column;
    transition: transform .2s, box-shadow .2s;
    position: relative;
    overflow: hidden;
}
.pub-card-modern:hover {
    transform: translateY(-4px) scale(1.02);
    box-shadow: 0 12px 32px rgba(16, 24, 40, 0.10);
}
.pub-badge-year {
    background: #e0f2fe;
    color: #0d6efd;
    border: 1px solid #bae6fd;
    font-weight: 500;
    font-size: .95rem;
}
.pub-type-badge {
    font-size: .85rem;
    color: #64748b;
    background: #f8fafc;
    border: 1px dashed #e2e8f0;
    padding: 6px 12px;
    border-radius: 999px;
}
/* Membatasi teks judul max 3 baris */
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    min-height: 4.5em; /* Menjaga layout tetap rapi jika judul pendek */
}
.pub-title {
    font-size: 1.05rem;
    line-height: 1.5;
}
.btn-read {
    background: #0d6efd;
    color: #fff;
    border-radius: 12px;
    border: none;
    font-weight: 500;
    transition: transform .15s, box-shadow .15s, background .15s;
}
.btn-read:hover {
    transform: translateY(-1px);
    box-shadow: 0 8px 20px rgba(13, 110, 253, 0.18);
    background: #0b5ed7;
    color: #fff;
}
.team-card {
    background: #fff;
    border: 1px solid #eaeff5;
    border-radius: 16px;
    padding: 30px 20px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.03); /* Shadow halus */
    transition: all 0.3s ease;
    height: 100%; /* Agar tinggi kartu sama */
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

.team-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
    border-color: #dbeafe;
}

.team-img-wrapper img {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border-radius: 50%;
    border: 4px solid #fff;
    box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    margin-bottom: 20px;
    transition: transform 0.3s ease;
}

.team-card:hover .team-img-wrapper img {
    transform: scale(1.05);
}

/* Container untuk Badge/Pills */
.role-badge-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 6px; /* Jarak antar badge */
    margin-top: 10px;
    margin-bottom: 20px;
}

/* Desain Badge Keahlian */
.skill-pill {
    font-size: 0.7rem;
    font-weight: 600;
    padding: 5px 12px;
    border-radius: 50px;
    background-color: #eff6ff; /* Biru sangat muda */
    color: #3b82f6; /* Biru cerah */
    border: 1px solid #dbeafe;
    display: inline-block;
}

/* Varian Hijau untuk Mahasiswa */
.skill-pill.student-style {
    background-color: #f0fdf4;
    color: #16a34a;
    border-color: #dcfce7;
}

.text-role {
    color: #64748b;
    font-size: 0.9rem;
}
/* --- Scope Card Styles --- */
.scope-card {
    position: relative;
    background: #fff;
    border: 1px solid #eef2f6;
    border-radius: 16px;
    padding: 30px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    overflow: hidden;
    display: flex;
    flex-direction: column;
}

.scope-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
    border-color: transparent;
}

/* SETTING KOTAK ICON (AGAR ICON DI TENGAH) */
.scope-icon-box {
    width: 64px;           /* Lebar Kotak */
    height: 64px;          /* Tinggi Kotak */
    border-radius: 16px;   /* Sudut membulat kotak */
    display: flex;         /* Flexbox untuk tengahin icon */
    align-items: center;
    justify-content: center;
    font-size: 1.75rem;    /* Ukuran Icon */
    transition: all 0.3s ease;
    position: relative; 
    z-index: 2;
    margin-bottom: 15px;
}

/* Watermark Icon */
.scope-watermark {
    position: absolute;
    top: -10px; right: -10px;
    font-size: 8rem;
    opacity: 0.05;
    transform: rotate(15deg);
    z-index: 1; pointer-events: none;
    transition: all 0.3s ease;
}
.scope-card:hover .scope-watermark {
    transform: rotate(0deg) scale(1.1);
    opacity: 0.1;
}

/* Tags */
.scope-tags { display: flex; flex-wrap: wrap; gap: 8px; }
.scope-tag {
    font-size: 0.75rem; font-weight: 600;
    padding: 4px 12px; border-radius: 50px;
    background: #f8f9fa; color: #6c757d;
    border: 1px solid #e9ecef;
}

/* --- TEMA WARNA (Background Kotak & Warna Icon) --- */

/* Biru */
.scope-card.theme-blue .scope-icon-box { background: rgba(13, 110, 253, 0.1); color: #0d6efd; }
.scope-card.theme-blue:hover { border-top: 4px solid #0d6efd; }
.scope-card.theme-blue .scope-watermark { color: #0d6efd; }

/* Ungu */
.scope-card.theme-purple .scope-icon-box { background: rgba(111, 66, 193, 0.1); color: #6f42c1; }
.scope-card.theme-purple:hover { border-top: 4px solid #6f42c1; }
.scope-card.theme-purple .scope-watermark { color: #6f42c1; }

/* Hijau */
.scope-card.theme-green .scope-icon-box { background: rgba(25, 135, 84, 0.1); color: #198754; }
.scope-card.theme-green:hover { border-top: 4px solid #198754; }
.scope-card.theme-green .scope-watermark { color: #198754; }

/* Merah */
.scope-card.theme-red .scope-icon-box { background: rgba(220, 53, 69, 0.1); color: #dc3545; }
.scope-card.theme-red:hover { border-top: 4px solid #dc3545; }
.scope-card.theme-red .scope-watermark { color: #dc3545; }

/* Oranye */
.scope-card.theme-orange .scope-icon-box { background: rgba(253, 126, 20, 0.1); color: #fd7e14; }
.scope-card.theme-orange:hover { border-top: 4px solid #fd7e14; }
.scope-card.theme-orange .scope-watermark { color: #fd7e14; }

/* Cyan */
.scope-card.theme-cyan .scope-icon-box { background: rgba(13, 202, 240, 0.1); color: #0dcaf0; }
.scope-card.theme-cyan:hover { border-top: 4px solid #0dcaf0; }
.scope-card.theme-cyan .scope-watermark { color: #0dcaf0; }

/* --- Hero Section Styles --- */
.hero-slider-item {
    height: 90vh; /* Tinggi memenuhi layar tapi menyisakan sedikit ruang */
    min-height: 600px;
    position: relative;
}

.hero-img-zoom {
    width: 100%;
    height: 100%;
    object-fit: cover;
    /* Efek Zoom lambat saat aktif */
    animation: zoomEffect 20s infinite alternate;
}

@keyframes zoomEffect {
    from { transform: scale(1); }
    to { transform: scale(1.1); }
}

/* Gradient Overlay: Agar teks terbaca jelas */
.hero-overlay {
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background: linear-gradient(90deg, rgba(5, 12, 28, 0.9) 0%, rgba(5, 12, 28, 0.6) 50%, rgba(5, 12, 28, 0.2) 100%);
    z-index: 1;
}

.hero-content {
    position: absolute;
    top: 50%; left: 0; right: 0;
    transform: translateY(-50%);
    z-index: 2;
}

/* Pattern Dot (Opsional hiasan) */
.hero-pattern {
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background-image: radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px);
    background-size: 30px 30px;
    z-index: 1;
    pointer-events: none;
}

/* Tombol Navigasi Glassmorphism */
.glass-btn {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: white;
    transition: all 0.3s ease;
}

.glass-btn:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: scale(1.1);
}

/* Animasi Teks */
.animate-up {
    opacity: 0;
    transform: translateY(30px);
    animation: fadeInUp 0.8s ease forwards;
}

.carousel-item.active .animate-up {
    animation-play-state: running;
}

.delay-100 { animation-delay: 0.2s; }
.delay-200 { animation-delay: 0.4s; }
.delay-300 { animation-delay: 0.6s; }
.delay-400 { animation-delay: 0.8s; }

@keyframes fadeInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Background Blur untuk Badge */
.backdrop-blur {
    backdrop-filter: blur(5px);
}

.bg-custom-blue {
    background-color: #0d6efd; /* Ganti dengan warna brand Polinema jika ada */
}

.hover-scale:hover {
    transform: translateY(-3px);
    transition: transform 0.3s ease;
}
#fokus-riset, #publikasi, #people, #scope , #artikel , #tentang {
    scroll-margin-top: 100px; /* Sesuaikan angka ini dengan tinggi navbar Anda + sedikit jarak napas */
}
</style>
<?php 
$pageTitle = "Beranda - Laboratorium SE"; 
?>

<section class="p-0 m-0 position-relative overflow-hidden">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="6000">
        
        <!-- Indicators (Garis Modern) -->
        <div class="carousel-indicators mb-5">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        </div>

        <div class="carousel-inner">
            
            <!-- === SLIDE 1: BRANDING UTAMA === -->
            <div class="carousel-item active hero-slider-item">
                <!-- Gambar Background dengan Efek Zoom -->
                <img src="<?= $_ENV['APP_URL'] ?>/assets/images/gedung.webp" class="hero-img-zoom" alt="Gedung Laboratorium SE">
                
                <!-- Layer Overlay & Pattern -->
                <div class="hero-overlay"></div>
                <div class="hero-pattern"></div>

                <!-- Konten Teks -->
                <div class="hero-content container ps-md-5" style="z-index: 3;">
                    <div class="row">
                        <div class="col-lg-8 text-white">
                            
                            <!-- Badge Animasi -->
                            <div class="animate-up delay-100">
                                <span class="badge bg-white bg-opacity-10 border border-white border-opacity-25 text-white mb-3 px-3 py-2 rounded-pill fw-light backdrop-blur">
                                    <i class="bi bi-patch-check-fill text-info me-2"></i> Center of Excellence
                                </span>
                            </div>

                            <!-- Judul Utama -->
                            <h1 class="display-3 fw-bold mb-3 lh-1 animate-up delay-200" style="letter-spacing: -1px;">
                                Laboratorium <br>
                                <span style="color: #81dafc;">Software Engineering</span>
                            </h1>
                            
                            <!-- Deskripsi -->
                            <p class="fs-5 mb-5 text-white-50 animate-up delay-300" style="max-width: 600px; font-weight: 300; line-height: 1.8;">
                                Mencetak talenta digital masa depan melalui integrasi kurikulum industri, riset inovatif, dan pengembangan teknologi mutakhir di Politeknik Negeri Malang.
                            </p>
                            
                            <!-- Tombol Aksi -->
                            <div class="d-flex gap-3 animate-up delay-400">
                                <a href="#" class="btn btn-primary bg-custom-blue border-0 px-4 py-3 rounded-pill fw-bold shadow-lg hover-scale">
                                    Pelajari Profil <i class="bi bi-arrow-right ms-2"></i>
                                </a>
                                <a href="#" class="btn glass-btn px-4 py-3 rounded-pill fw-medium">
                                    <i class="bi bi-play-fill me-1"></i> Video Intro
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- === SLIDE 2: RISET & INOVASI === -->
            <div class="carousel-item hero-slider-item">
                <img src="<?= $_ENV['APP_URL'] ?>/assets/images/gedung.webp" class="hero-img-zoom" alt="Aktivitas Riset">
                
                <div class="hero-overlay"></div>
                <div class="hero-pattern"></div>
                
                <div class="hero-content container ps-md-5" style="z-index: 3;">
                    <div class="row">
                        <div class="col-lg-8 text-white">
                            
                            <div class="animate-up delay-100">
                                <span class="badge bg-success bg-opacity-25 border border-success border-opacity-50 text-white mb-3 px-3 py-2 rounded-pill fw-light">
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
                                <a href="#" class="btn btn-success border-0 px-4 py-3 rounded-pill fw-bold shadow-lg">
                                    Lihat Hasil Riset
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Navigasi Kanan Kiri (Glass Effect) -->
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

<section class="py-5 bg-white">
    <div class="container py-lg-5">
        <div class="row align-items-center g-5">
            
            <div class="col-lg-6 order-2 order-lg-1">
                <div class="about-img-wrapper">
                    <img src="<?= $_ENV['APP_URL'] ?>/assets/images/gedung.webp" alt="Tentang Lab" class="about-img-main">
                    
                    <div class="floating-badge">
                        <div class="bg-custom-blue bg-opacity-10 p-2 rounded-circle text-custom-blue">
                            <i class="bi bi-trophy-fill fs-3"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0 text-dark">Akreditasi A</h5>
                            <small class="text-secondary">Program Studi TI</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 order-1 order-lg-2">
                <span class="text-custom-blue fw-bold text-uppercase small ls-1">Tentang Kami</span>
                <h2 class="display-6 fw-bold text-dark mt-2 mb-4">Pusat Unggulan Rekayasa Perangkat Lunak</h2>
                
                <p class="text-secondary lh-lg mb-4">
                    Laboratorium Rekayasa Perangkat Lunak merupakan fasilitas akademik di bawah naungan Jurusan Teknologi Informasi Politeknik Negeri Malang.
                </p>
                <p class="text-secondary lh-lg mb-4">
                    Kami berfokus pada bidang rekayasa pengembangan perangkat lunak dan tumbuh menjadi pusat aktivitas penelitian serta pengabdian masyarakat yang berorientasi pada solusi teknologi nyata.
                </p>

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

                <a href="#" class="btn btn-outline-primary rounded-pill px-4 fw-medium">
                    Selengkapnya Tentang Kami
                </a>
            </div>

        </div>
    </div>
</section>

<section class="py-5 bg-gradient-light overflow-hidden">
    <div class="container-fluid"> <div class="container text-center mb-4">
            <span class="badge bg-custom-blue badge-pill fs-6 mb-2">Galeri</span>
            <h2 class="fw-bold text-dark">Album Kegiatan Lab</h2>
            <p class="text-secondary">Dokumentasi kegiatan riset, praktikum, dan kebersamaan tim.</p>
        </div>

        <div class="marquee-wrapper">
            <div class="marquee-content">
                
                <?php 
                // DATA FOTO (Contoh Array)
                // Ganti 'image' dengan path foto asli Anda nanti
                $photos = [
                    ['img' => 'assets/images/gedung.webp', 'title' => 'Kunjungan Industri'],
                    ['img' => 'assets/images/gedung.webp', 'title' => 'Workshop UI/UX'],
                    ['img' => 'assets/images/gedung.webp', 'title' => 'Sidang Skripsi'],
                    ['img' => 'assets/images/gedung.webp', 'title' => 'Rapat Tim Riset'],
                    ['img' => 'assets/images/gedung.webp', 'title' => 'Lomba Gemastik'],
                ];

                // KITA LOOPING 2 KALI AGAR INFINITE SCROLL (Seamless)
                for ($i = 0; $i < 2; $i++) : 
                    foreach ($photos as $photo) : 
                ?>
                    
                    <div class="album-card">
                        <img src="<?= $_ENV['APP_URL'] ?>/<?= $photo['img'] ?>" alt="<?= $photo['title'] ?>">
                        
                        <div class="album-overlay">
                            <h5 class="text-white mb-0 fw-medium"><?= $photo['title'] ?></h5>
                        </div>
                    </div>

                <?php 
                    endforeach; 
                endfor; 
                ?>

            </div>
        </div>

    </div>
</section>

<section class="py-5 position-relative" style="background-color: #f8fafc;">
    <div class="container py-4">
        
        <div class="row g-5 items-center">
            
            <!-- KOLOM KIRI: VISI (Highlight) -->
            <div class="col-lg-5">
                <div class="visi-card-modern">
                    <!-- Hiasan Background -->
                    <div class="visi-bg-shape"></div>
                    
                    <div class="position-relative" style="z-index: 1;">
                        <div class="visi-icon-large">
                            <i class="bi bi-bullseye"></i>
                        </div>
                        <h6 class="text-uppercase fw-bold text-white-50 ls-1 mb-2">Visi Kami</h6>
                        <h2 class="fw-bold mb-4">Menjadi Pusat Keunggulan Teknologi Masa Depan</h2>
                        <p class="text-white-50 lh-lg mb-0">
                            "Menjadi laboratorium unggulan yang menghasilkan lulusan berkompeten di bidang rekayasa perangkat lunak, mampu bersaing di tingkat nasional dan internasional, serta berkontribusi dalam pengembangan teknologi informasi yang inovatif."
                        </p>
                    </div>
                </div>
            </div>

            <!-- KOLOM KANAN: MISI (List) -->
            <div class="col-lg-7">
                <div class="ps-lg-4">
                    <div class="mb-4">
                        <h6 class="text-custom-blue fw-bold text-uppercase small ls-1">Misi Kami</h6>
                        <h2 class="fw-bold text-dark">Langkah Strategis</h2>
                    </div>

                    <!-- Item Misi 1 -->
                    <div class="misi-item">
                        <div class="misi-number">01</div>
                        <div>
                            <h5 class="fw-bold text-dark mb-1">Pendidikan Berkualitas</h5>
                            <p class="misi-text">Menyelenggarakan pembelajaran berbasis praktik dan riset yang berkualitas tinggi untuk mahasiswa.</p>
                        </div>
                    </div>

                    <!-- Item Misi 2 -->
                    <div class="misi-item">
                        <div class="misi-number">02</div>
                        <div>
                            <h5 class="fw-bold text-dark mb-1">Kompetensi Industri</h5>
                            <p class="misi-text">Mengembangkan kompetensi teknis mahasiswa melalui proyek aplikatif yang relevan dengan kebutuhan industri.</p>
                        </div>
                    </div>

                    <!-- Item Misi 3 -->
                    <div class="misi-item">
                        <div class="misi-number">03</div>
                        <div>
                            <h5 class="fw-bold text-dark mb-1">Riset Inovatif</h5>
                            <p class="misi-text">Memfasilitasi penelitian teknologi perangkat lunak yang menghasilkan solusi nyata bagi masyarakat.</p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
<!-- SECTION: BERITA & ARTIKEL (MAGAZINE STYLE) -->
<section class="py-5 bg-white">
    <div class="container py-4">
        
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-end mb-5">
            <div>
                <span class="text-custom-blue fw-bold text-uppercase small ls-1">Update Terkini</span>
                <h2 class="display-6 fw-bold text-dark mt-1">Wawasan & Berita</h2>
            </div>
            <a href="#" class="btn btn-outline-primary rounded-pill px-4 fw-medium d-none d-md-inline-block">
                Lihat Semua <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="row g-4">
            
            <!-- KOLOM KIRI: HERO POST (FIXED) -->
            <div class="col-lg-7">
                <!-- Link Pembungkus Utama -->
                <a href="#" class="text-decoration-none">
                    <div class="blog-hero-card">
                        <!-- Gambar -->
                        <img src="<?= $_ENV['APP_URL'] ?>/assets/images/gedung.webp" alt="Hero Blog" class="blog-hero-img">
                        
                        <!-- Overlay Gelap -->
                        <div class="blog-hero-overlay"></div>
                        
                        <!-- Konten -->
                        <div class="blog-hero-content">
                            <!-- Badge -->
                            <span class="blog-cat-badge cat-hero">
                                <i class="bi bi-trophy-fill me-1"></i> Prestasi Gemilang
                            </span>
                            
                            <!-- Judul (Class text-white ditambahkan untuk safety) -->
                            <h3 class="blog-hero-title text-white">
                                Mahasiswa Lab SE Ciptakan Sistem AI Deteksi Dini Banjir, Raih Gold Medal Internasional
                            </h3>
                            
                            <!-- Meta Info (Dibuat Putih Transparan) -->
                            <div class="d-flex align-items-center text-white small mt-3 opacity-75">
                                <span class="me-3"><i class="bi bi-calendar3 me-2"></i> 12 Nov 2024</span>
                                <span class="me-3"><i class="bi bi-person-circle me-2"></i> Tim Riset AI</span>
                                <span><i class="bi bi-clock me-2"></i> 5 Menit Baca</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- KOLOM KANAN: SIDE LIST (Daftar Artikel Terbaru) -->
            <div class="col-lg-5">
                <div class="d-flex flex-column h-100">
                    
                    <?php 
                    // DATA DUMMY ARTIKEL SIDEBAR
                    $articles = [
                        [
                            'cat' => 'Technology', 'cat_class' => 'cat-tech',
                            'title' => 'Mengenal Flutter 3.0: Masa Depan Pengembangan Multi-Platform',
                            'date' => '10 Nov 2024',
                            'img' => 'assets/images/gedung.webp'
                        ],
                        [
                            'cat' => 'Event', 'cat_class' => 'cat-event',
                            'title' => 'Workshop Cyber Security: "Ethical Hacking for Beginners" Bersama Kominfo',
                            'date' => '08 Nov 2024',
                            'img' => 'assets/images/gedung.webp'
                        ],
                        [
                            'cat' => 'University', 'cat_class' => 'cat-news',
                            'title' => 'Kunjungan Studi Banding dari Politeknik Singapura ke Lab SE',
                            'date' => '01 Nov 2024',
                            'img' => 'assets/images/gedung.webp'
                        ]
                    ];

                    foreach($articles as $art) :
                    ?>
                    <!-- Item List -->
                    <a href="#" class="text-decoration-none">
                        <div class="blog-list-card">
                            <div class="blog-list-img-wrapper">
                                <img src="<?= $_ENV['APP_URL'] ?>/<?= $art['img'] ?>" alt="<?= $art['title'] ?>" class="blog-list-img">
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="blog-cat-badge <?= $art['cat_class'] ?> mb-2"><?= $art['cat'] ?></span>
                                    <i class="bi bi-arrow-right read-more-arrow"></i> <!-- Panah Animasi -->
                                </div>
                                <h6 class="blog-list-title"><?= $art['title'] ?></h6>
                                <div class="blog-meta">
                                    <span><i class="bi bi-calendar-event me-1"></i> <?= $art['date'] ?></span>
                                </div>
                            </div>
                        </div>
                    </a>
                    <?php endforeach; ?>

                    <!-- Tombol Mobile (Hanya muncul di HP) -->
                    <div class="mt-3 d-block d-md-none">
                        <a href="#" class="btn btn-outline-primary w-100 rounded-pill">Lihat Semua Berita</a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
<section class="py-5 bg-white position-relative">
    
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 50%; background: linear-gradient(180deg, #f8fbff 0%, #ffffff 100%); z-index: 0;"></div>

    <div class="container position-relative" style="z-index: 1;">
        
        <div class="row mb-5 align-items-end">
            <div class="col-lg-8">
                <span class="text-custom-blue fw-bold text-uppercase small ls-1">Core Competency</span>
                <h2 class="display-6 fw-bold text-dark mt-1">Fokus Riset Utama</h2>
                <p class="text-secondary mb-0" style="max-width: 600px;">
                    Kami mendalami pilar-pilar utama dalam rekayasa perangkat lunak untuk menghasilkan kontribusi ilmiah yang berdampak.
                </p>
            </div>
        </div>

        <div class="row g-4">
            <?php 
            // Data Fokus Riset (Isi + Icon + Deskripsi Singkat Dummy)
            $fokus = [
                [
                    "title" => "Software Engineering Methodologies and Architecture",
                    "icon"  => "bi-diagram-3-fill",
                    "desc"  => "Pengembangan metodologi agile, arsitektur microservices, dan pola desain sistem yang scalable."
                ],
                [
                    "title" => "Domain-Specific Software Engineering Applications",
                    "icon"  => "bi-window-stack",
                    "desc"  => "Penerapan rekayasa perangkat lunak pada domain spesifik seperti kesehatan, pendidikan, dan industri 4.0."
                ],
                [
                    "title" => "Emerging Technologies in Software Engineering",
                    "icon"  => "bi-rocket-takeoff-fill",
                    "desc"  => "Eksplorasi teknologi baru seperti Blockchain, IoT, dan AI dalam siklus hidup pengembangan software."
                ]
            ];

            // Loop dengan index ($i) untuk nomor urut
            foreach ($fokus as $index => $item) : 
                $num = str_pad($index + 1, 2, '0', STR_PAD_LEFT); // Membuat 01, 02, 03
            ?>
                <div class="col-lg-4">
                    <div class="focus-card">
                        
                        <div class="focus-number"><?= $num ?></div>

                        <div class="focus-content">
                            <div class="focus-icon-box">
                                <i class="bi <?= $item['icon'] ?>"></i>
                            </div>

                            <h4 class="fw-bold text-dark mb-3" style="font-size: 1.25rem; line-height: 1.4;">
                                <?= $item['title'] ?>
                            </h4>

                            <p class="text-secondary small mb-4">
                                <?= $item['desc'] ?>
                            </p>

                            <a href="#" class="text-decoration-none fw-semibold text-custom-blue small">
                                Pelajari Detail <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<section class="py-5 bg-soft-blue">
    <div class="container py-4">
        
        <div class="row align-items-end mb-5">
            <div class="col-lg-6">
                <span class="text-custom-blue fw-bold text-uppercase small ls-1">Riset & Karya</span>
                <h2 class="display-6 fw-bold text-dark mt-1">Sorotan Publikasi</h2>
                <p class="text-secondary mb-0">Karya ilmiah terpilih dari dosen dan mahasiswa kami yang telah diakui secara global.</p>
            </div>
            <div class="col-lg-6 text-lg-end mt-4 mt-lg-0">
                <div class="d-inline-flex flex-wrap gap-2">
                    <button class="btn btn-filter-modern active">Most Cited</button>
                    <button class="btn btn-filter-modern">Terbaru</button>
                    <button class="btn btn-filter-modern">Terlama</button>
                    <a href="#" class="btn btn-link text-decoration-none fw-medium text-custom-blue">
                        Lihat di SINTA <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <?php 
            $publikasi = [
                [
                    "title" => "Implementasi opinion mining (analisis sentimen) untuk ekstraksi data opini publik pada perguruan tinggi",
                    "year" => "2012",
                    "citations" => "211",
                    "author" => "Dr. Eng. Herman",
                    "is_most_cited" => true
                ],
                [
                    "title" => "Pengembangan sistem penunjang keputusan penentuan UKT mahasiswa dengan metode MOORA",
                    "year" => "2017",
                    "citations" => "72",
                    "author" => "Rosa A.S., M.Kom",
                    "is_most_cited" => false
                ],
                [
                    "title" => "Analisis Sentimen Twitter Menggunakan Metode Naïve Bayes Classifier (Studi Kasus SAMSAT)",
                    "year" => "2018",
                    "citations" => "39",
                    "author" => "Tim Riset AI",
                    "is_most_cited" => false
                ],
                [
                    "title" => "Developing vocabulary card base on Augmented Reality (AR) for learning English",
                    "year" => "2021",
                    "citations" => "34",
                    "author" => "Budi S., M.T.",
                    "is_most_cited" => false
                ]
            ];

            foreach ($publikasi as $item) : 
            ?>
                <div class="col-lg-3 col-md-6">
                    <div class="pub-card-modern p-4">
                        
                        <i class="bi bi-quote pub-bg-icon"></i>

                        <div class="pub-content">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <span class="badge bg-light text-secondary border rounded-pill px-3">
                                    <i class="bi bi-calendar-event me-1"></i> <?= $item['year'] ?>
                                </span>
                                <?php if($item['is_most_cited']): ?>
                                    <span class="badge-gold">
                                        <i class="bi bi-star-fill"></i> Top
                                    </span>
                                <?php endif; ?>
                            </div>

                            <h5 class="fw-bold text-dark mb-2" style="font-size: 1.1rem; line-height: 1.5; min-height: 80px;">
                                <?= $item['title'] ?>
                            </h5>

                            <p class="text-secondary small mb-4">
                                <i class="bi bi-person-circle me-1"></i> <?= $item['author'] ?>
                            </p>

                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="text-muted small">
                                        <i class="bi bi-chat-quote-fill text-custom-blue"></i> 
                                        <span class="fw-bold text-dark"><?= $item['citations'] ?></span> Sitasi
                                    </div>
                                </div>
                                
                                <a href="#" class="btn btn-read w-100 py-2">
                                    Baca Jurnal <i class="bi bi-arrow-right-short fs-5"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="row mt-5">
            <div class="col-12 text-center">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center gap-2 m-0">
                        <li class="page-item disabled"><a class="page-link rounded-circle border-0 bg-light text-muted" href="#"><i class="bi bi-chevron-left"></i></a></li>
                        <li class="page-item active"><a class="page-link rounded-circle border-0 bg-custom-blue" href="#">1</a></li>
                        <li class="page-item"><a class="page-link rounded-circle border-0 bg-light text-dark" href="#">2</a></li>
                        <li class="page-item"><a class="page-link rounded-circle border-0 bg-light text-dark" href="#">3</a></li>
                        <li class="page-item"><a class="page-link rounded-circle border-0 bg-light text-dark" href="#"><i class="bi bi-chevron-right"></i></a></li>
                    </ul>
                </nav>
            </div>
        </div>

    </div>
</section>

<section class="py-5" style="background-color: #fcfcfc;">
    <div class="container py-4">
        
        <div class="text-center mb-5">
            <span class="text-custom-blue fw-bold text-uppercase small ls-1">People</span>
            <h2 class="display-6 fw-bold text-dark mt-1">Tim Laboratorium</h2>
            <p class="text-secondary mx-auto" style="max-width: 600px;">
                Berkolaborasi dengan para ahli dan talenta muda berbakat untuk menciptakan inovasi teknologi masa depan.
            </p>
        </div>

        <ul class="nav nav-pills justify-content-center mb-5" id="teamTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active rounded-pill px-4 fw-medium" id="dosen-tab" data-bs-toggle="pill" data-bs-target="#pills-dosen" type="button" role="tab">
                    <i class="bi bi-person-video3 me-2"></i> Dosen & Instruktur
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link rounded-pill px-4 fw-medium" id="mahasiswa-tab" data-bs-toggle="pill" data-bs-target="#pills-mahasiswa" type="button" role="tab">
                    <i class="bi bi-mortarboard me-2"></i> Mahasiswa Peneliti
                </button>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
            
            <div class="tab-pane fade show active" id="pills-dosen" role="tabpanel">
                <div class="row g-4 justify-content-center">
                    <?php 
                    // Data Dummy Dosen
                    $dosen = [
                        ['name' => 'Prof. Dr. Budi Santoso', 'role' => 'Kepala Laboratorium', 'spec' => 'AI & Data Science', 'img' => 'assets/images/dosen1.jpg'],
                        ['name' => 'Dr. Siti Aminah, M.Kom', 'role' => 'Koordinator Riset', 'spec' => 'Software Engineering', 'img' => 'assets/images/dosen2.jpg'],
                        ['name' => 'Rudi Hermawan, MT', 'role' => 'Dosen Pembina', 'spec' => 'Mobile Dev', 'img' => 'assets/images/dosen3.jpg'],
                        ['name' => 'Maya Eka, M.Cs', 'role' => 'Dosen Ahli', 'spec' => 'Cyber Security', 'img' => 'assets/images/dosen4.jpg'],
                    ];

                    foreach ($dosen as $d) : 
                    ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="team-card">
                            <div class="team-img-wrapper">
                                <img src="<?= $_ENV['APP_URL'] ?>/assets/images/user-placeholder.png" alt="<?= $d['name'] ?>">
                            </div>
                            <span class="role-badge"><?= $d['spec'] ?></span>
                            <h5 class="fw-bold text-dark mb-1"><?= $d['name'] ?></h5>
                            <p class="text-secondary small mb-0"><?= $d['role'] ?></p>
                            
                            <div class="social-links">
                                <a href="#" class="social-btn"><i class="bi bi-linkedin"></i></a>
                                <a href="#" class="social-btn"><i class="bi bi-envelope-fill"></i></a>
                                <a href="#" class="social-btn"><i class="bi bi-journal-text"></i></a> </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="tab-pane fade" id="pills-mahasiswa" role="tabpanel">
                <div class="row g-4 justify-content-center">
                    <?php 
                    // Data Dummy Mahasiswa
                    $mhs = [
                        ['name' => 'Ahmad Fauzi', 'role' => 'Ketua Tim Developer', 'spec' => 'Fullstack Dev'],
                        ['name' => 'Sarah Putri', 'role' => 'UI/UX Designer', 'spec' => 'Product Design'],
                        ['name' => 'Dimas Anggara', 'role' => 'Mobile Engineer', 'spec' => 'Flutter Expert'],
                        ['name' => 'Eka Prasetya', 'role' => 'Data Analyst', 'spec' => 'Python & R'],
                    ];

                    foreach ($mhs as $m) : 
                    ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="team-card">
                            <div class="team-img-wrapper">
                                <img src="<?= $_ENV['APP_URL'] ?>/assets/images/user-placeholder.png" alt="<?= $m['name'] ?>">
                            </div>
                            <span class="role-badge" style="background: rgba(0, 166, 62, 0.1); color: #008236;"><?= $m['spec'] ?></span>
                            <h5 class="fw-bold text-dark mb-1"><?= $m['name'] ?></h5>
                            <p class="text-secondary small mb-0"><?= $m['role'] ?></p>
                            
                            <div class="social-links">
                                <a href="#" class="social-btn"><i class="bi bi-github"></i></a>
                                <a href="#" class="social-btn"><i class="bi bi-linkedin"></i></a>
                                <a href="#" class="social-btn"><i class="bi bi-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>

        <div class="text-center mt-5">
            <a href="#" class="btn btn-outline-primary rounded-pill px-5 py-2 fw-medium">
                Lihat Seluruh Anggota <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>

    </div>
</section>

<section class="py-5 bg-white">
    <div class="container py-4">
        
        <div class="text-center mb-5">
            <span class="text-custom-blue fw-bold text-uppercase small ls-1">Research Areas</span>
            <h2 class="display-6 fw-bold text-dark mt-1">Scope Penelitian</h2>
            <p class="text-secondary mx-auto" style="max-width: 600px;">
                Kami memfokuskan riset pada teknologi mutakhir untuk menjawab tantangan industri digital masa depan.
            </p>
        </div>

        <div class="row g-4">
            <?php 
            // DATA ARRAY SCOPE
            // Theme options: theme-blue, theme-purple, theme-green, theme-red, theme-orange, theme-cyan
            $scopes = [
                [
                    'title' => 'Web Development',
                    'desc'  => 'Rancang bangun aplikasi web modern yang responsif, scalable, dan aman menggunakan teknologi terkini.',
                    'icon'  => 'bi-globe',
                    'theme' => 'theme-blue',
                    'tags'  => ['Fullstack', 'PWA', 'Microservices', 'API']
                ],
                [
                    'title' => 'Artificial Intelligence',
                    'desc'  => 'Implementasi kecerdasan buatan untuk pemrosesan data, visi komputer, dan sistem pengambilan keputusan.',
                    'icon'  => 'bi-cpu-fill',
                    'theme' => 'theme-purple',
                    'tags'  => ['Deep Learning', 'NLP', 'Computer Vision', 'Data Mining']
                ],
                [
                    'title' => 'Mobile Computing',
                    'desc'  => 'Pengembangan aplikasi mobile native dan cross-platform yang mengutamakan User Experience (UX).',
                    'icon'  => 'bi-phone-fill',
                    'theme' => 'theme-green',
                    'tags'  => ['Android', 'iOS', 'Flutter', 'IoT Integration']
                ],
                [
                    'title' => 'Cyber Security',
                    'desc'  => 'Analisis keamanan sistem, pengujian celah keamanan (pentest), dan perlindungan data privasi.',
                    'icon'  => 'bi-shield-lock-fill',
                    'theme' => 'theme-red',
                    'tags'  => ['Network Security', 'Cryptography', 'Forensic', 'Ethical Hacking']
                ],
                [
                    'title' => 'Data Science',
                    'desc'  => 'Pengolahan big data dan visualisasi interaktif untuk mendukung analisis bisnis dan prediksi tren.',
                    'icon'  => 'bi-bar-chart-fill',
                    'theme' => 'theme-orange',
                    'tags'  => ['Big Data', 'Visualization', 'Business Intelligence', 'Statistics']
                ],
                [
                    'title' => 'Cloud Computing',
                    'desc'  => 'Arsitektur sistem berbasis awan, manajemen server, dan deployment otomatis (DevOps).',
                    'icon'  => 'bi-cloud-check-fill',
                    'theme' => 'theme-cyan',
                    'tags'  => ['AWS', 'Docker', 'Kubernetes', 'Serverless']
                ],
            ];

            foreach ($scopes as $s) : 
            ?>
                <div class="col-lg-4 col-md-6">
                    <div class="scope-card <?= $s['theme'] ?>">
                        
                        <i class="bi <?= $s['icon'] ?> scope-bg-icon"></i>

                        <div class="scope-icon-wrapper">
                            <i class="bi <?= $s['icon'] ?>"></i>
                        </div>

                        <h4 class="fw-bold text-dark mb-3"><?= $s['title'] ?></h4>
                        <p class="text-secondary small mb-4" style="line-height: 1.6;">
                            <?= $s['desc'] ?>
                        </p>

                        <div class="scope-tags">
                            <?php foreach($s['tags'] as $tag) : ?>
                                <span class="scope-tag"><?= $tag ?></span>
                            <?php endforeach; ?>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

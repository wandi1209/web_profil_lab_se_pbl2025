<?php
// DATA ARTICLE DUMMY
$articles = [
    'featured' => [
        'id' => 101,
        'title' => 'Menguasai Microservices: Panduan Implementasi dengan Kubernetes',
        'excerpt' => 'Arsitektur Microservices telah menjadi standar industri dalam pengembangan aplikasi skala besar. Pelajari langkah-langkah implementasi dengan orkestrasi Kubernetes.',
        'date' => '25 November 2025',
        'author' => 'Dr. Budi Santoso',
        'image' => 'assets/images/gedung.webp'
    ],
    'recent' => [
        ['id' => 102, 'title' => 'Peran Penting DevOps dalam Start-up Skala Kecil', 'date' => '20 November 2025', 'image' => 'assets/images/gedung.webp', 'excerpt' => 'Menghindari biaya tak terduga dengan adopsi praktik DevOps sejak dini.'],
        ['id' => 103, 'title' => 'Membandingkan Azure, AWS, dan GCP untuk Aplikasi Web', 'date' => '15 November 2025', 'image' => 'assets/images/gedung.webp', 'excerpt' => 'Studi komparatif mendalam mengenai tiga penyedia layanan cloud terbesar.'],
        ['id' => 104, 'title' => 'Panduan Lengkap Membangun API Aman dengan OAuth 2.0', 'date' => '10 November 2025', 'image' => 'assets/images/gedung.webp'],
        ['id' => 105, 'title' => 'SAST vs DAST: Kapan Menggunakan yang Mana?', 'date' => '05 November 2025', 'image' => 'assets/images/gedung.webp'],
        ['id' => 106, 'title' => 'The Future of AI in Software Testing', 'date' => '01 November 2025', 'image' => 'assets/images/gedung.webp'],
        ['id' => 107, 'title' => 'Why Agile Fails in Big Enterprises', 'date' => '28 Oktober 2025', 'image' => 'assets/images/gedung.webp'],
    ]
];

// Menggabungkan dan membatasi artikel untuk kolom kiri (Featured Utama + 2 Sorotan)
$all_featured = [$articles['featured']];
$recent_for_featured = array_slice($articles['recent'], 0, 2); // Ambil 2 artikel pertama dari recent
$all_featured = array_merge($all_featured, $recent_for_featured);

// Menghitung artikel yang tersisa untuk sidebar
$remaining_recent = array_slice($articles['recent'], 2); 
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Artikel Lab RPL</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="lab_profile.css">
    <link rel="stylesheet" href="assets/css/artikel.css">
</head>
<body>

<div class="vm-wrapper article-list-page">
    <h1 class="section-title">INOVASI LAB & WAWASAN TEKNOLOGI</h1>
    <p class="section-subtitle">Jelajahi riset, studi kasus, dan tren terbaru dari tim Lab Rekayasa Perangkat Lunak</p>
    
    <div class="article-grid">

        <div class="featured-column">
            
            <div class="multi-featured-grid">
                <?php foreach ($all_featured as $index => $art): ?>
                
                <div class="featured-card multi-card <?= ($index == 0) ? 'main-featured-card' : 'sub-featured-card' ?>">
                    <img src="<?= $art['image'] ?>" alt="Featured Image" class="featured-image">

                    <div class="featured-content">
                        <span class="article-category"><?= ($index == 0) ? 'UTAMA' : 'SOROTAN' ?></span>

                        <h2 class="featured-title">
                            <a href="artikel_detail.php?id=<?= $art['id'] ?>">
                                <?= $art['title'] ?>
                            </a>
                        </h2>

                        <?php if ($index == 0): ?>
                        <div class="featured-meta">
                            <span class="meta-item"><i class="bi bi-calendar"></i> <?= $art['date'] ?></span>
                            <span class="meta-item"><i class="bi bi-person-circle"></i> <?= $art['author'] ?></span>
                        </div>
                        <p class="featured-excerpt"><?= $art['excerpt'] ?></p>
                        <?php endif; ?>

                        <a href="artikel_detail.php?id=<?= $art['id'] ?>" class="read-more-btn">
                            Baca Selengkapnya <i class="bi bi-arrow-right-short"></i>
                        </a>
                    </div>
                </div>
                
                <?php endforeach; ?>
            </div>
        </div>

        <aside class="sidebar-column">
            <h3 class="sidebar-title">Artikel Lainnya</h3>

            <div class="recent-list-vertical-scroll">
                <div class="recent-list-inner-vertical">
                    <?php 
                    // FIX: Loop 4 kali agar konten sidebar memanjang dan scroll muncul (4 x 5 = 20 item total)
                    for ($i = 0; $i < 4; $i++) :
                        foreach ($remaining_recent as $art): 
                    ?>
                            <a href="artikel_detail.php?id=<?= $art['id'] ?>" class="recent-item">
                                <img src="<?= $art['image'] ?>" alt="Thumbnail" class="recent-thumb">
                                <div class="recent-info">
                                    <span class="recent-date"><?= $art['date'] ?></span>
                                    <h4 class="recent-title"><?= $art['title'] ?></h4>
                                    <span class="read-more-indicator">
                                        Baca <i class="bi bi-arrow-right-short"></i>
                                    </span>
                                </div>
                            </a>
                        <?php endforeach;
                    endfor; 
                    ?>
                </div>
            </div>
        </aside>
    </div>
</div>

</body>
</html>
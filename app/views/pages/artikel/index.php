<link rel="stylesheet" href="<?= $_ENV['APP_URL'] ?>/assets/css/artikel.css">

<div class="vm-wrapper article-list-page">
    <h1 class="section-title">INOVASI LAB & WAWASAN TEKNOLOGI</h1>
    <p class="section-subtitle">Jelajahi riset, studi kasus, dan tren terbaru dari tim Lab Rekayasa Perangkat Lunak</p>
    
    <div class="article-grid">

        <div class="featured-column">
            
            <?php if (empty($all_featured)): ?>
                <p style="text-align:center; color:#666;">Belum ada artikel yang diterbitkan.</p>
            <?php else: ?>

            <div class="multi-featured-grid">
                <?php foreach ($all_featured as $index => $art): 
                    // --- PREPARE DATA ---
                    $judul   = htmlspecialchars($art['title']);
                    $slug    = htmlspecialchars($art['slug']);
                    $tanggal = date('d F Y', strtotime($art['created_at']));
                    
                    // Excerpt: Pakai ringkasan jika ada, kalau tidak potong content
                    $excerptRaw = !empty($art['ringkasan']) ? $art['ringkasan'] : strip_tags($art['content']);
                    $excerpt    = htmlspecialchars(mb_strimwidth($excerptRaw, 0, 150, "..."));

                    // Gambar: Cek folder upload, fallback ke placeholder
                    $imgUrl = !empty($art['gambar_url']) 
                        ? $_ENV['APP_URL'] . '/public' . $art['gambar_url'] 
                        : $_ENV['APP_URL'] . '/assets/images/gedung.webp';

                    // Link
                    $link = $_ENV['APP_URL'] . '/artikel/detail/' . $slug;
                ?>
                
                <div class="featured-card multi-card <?= ($index == 0) ? 'main-featured-card' : 'sub-featured-card' ?>">
                    <img src="<?= $imgUrl ?>" alt="<?= $judul ?>" class="featured-image">

                    <div class="featured-content">
                        <span class="article-category"><?= ($index == 0) ? 'UTAMA' : 'SOROTAN' ?></span>

                        <h2 class="featured-title">
                            <a href="<?= $link ?>">
                                <?= $judul ?>
                            </a>
                        </h2>

                        <?php if ($index == 0): ?>
                        <div class="featured-meta">
                            <span class="meta-item"><i class="bi bi-calendar"></i> <?= $tanggal ?></span>
                            <span class="meta-item"><i class="bi bi-person-circle"></i> Admin Lab</span>
                        </div>
                        <p class="featured-excerpt"><?= $excerpt ?></p>
                        <?php endif; ?>

                        <a href="<?= $link ?>" class="read-more-btn">
                            Baca Selengkapnya <i class="bi bi-arrow-right-short"></i>
                        </a>
                    </div>
                </div>
                
                <?php endforeach; ?>
            </div>

            <?php endif; ?>
        </div>

        <aside class="sidebar-column">
            <h3 class="sidebar-title">Artikel Lainnya</h3>

            <div class="recent-list-vertical-scroll">
                <div class="recent-list-inner-vertical">
                    <?php if (empty($remaining_recent)): ?>
                        <p style="padding:10px; color:#888;">Tidak ada artikel lain.</p>
                    <?php else: ?>
                        
                        <?php foreach ($remaining_recent as $art): 
                            // --- PREPARE DATA SIDEBAR ---
                            $judulSide   = htmlspecialchars($art['title']);
                            $slugSide    = htmlspecialchars($art['slug']);
                            $tanggalSide = date('d M Y', strtotime($art['created_at']));
                            
                            $imgUrlSide = !empty($art['gambar_url']) 
                                ? $_ENV['APP_URL'] . '/public' . $art['gambar_url'] 
                                : $_ENV['APP_URL'] . '/assets/images/gedung.webp';
                            
                            $linkSide = $_ENV['APP_URL'] . '/artikel/detail/' . $slugSide;
                        ?>
                            <a href="<?= $linkSide ?>" class="recent-item">
                                <img src="<?= $imgUrlSide ?>" alt="Thumbnail" class="recent-thumb">
                                <div class="recent-info">
                                    <span class="recent-date"><?= $tanggalSide ?></span>
                                    <h4 class="recent-title"><?= $judulSide ?></h4>
                                    <span class="read-more-indicator">
                                        Baca <i class="bi bi-arrow-right-short"></i>
                                    </span>
                                </div>
                            </a>
                        <?php endforeach; ?>

                    <?php endif; ?>
                </div>
            </div>
        </aside>
    </div>
</div>
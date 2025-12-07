<?php
// Data $article sudah dikirim dari Controller
// Kita siapkan variabel pendukung agar kode HTML di bawah lebih bersih

// 1. Format Tanggal
$tanggal = date('d F Y', strtotime($article['created_at']));

// 2. Gambar (Fallback jika kosong)
$heroImage = !empty($article['gambar_url']) 
    ? $_ENV['APP_URL'] . '/public' . $article['gambar_url'] 
    : $_ENV['APP_URL'] . '/assets/images/gedung.webp';

// 3. Estimasi Waktu Baca (Hitung kata / 200)
$wordCount = str_word_count(strip_tags($article['content']));

// 5. Kategori (Jika ada kolom kategori, jika tidak default)
$category = $article['category'] ?? 'Berita & Artikel';

// 6. Tags (Jika disimpan string dipisah koma, explode jadi array)
// Contoh isi DB: "Kubernetes,DevOps,Cloud"
$tags = !empty($article['tags']) ? explode(',', $article['tags']) : []; 
?>

<link rel="stylesheet" href="<?= $_ENV['APP_URL'] ?>/assets/css/artikel.css"> 
<link rel="stylesheet" href="<?= $_ENV['APP_URL'] ?>/assets/css/article_detail.css">

<div class="vm-wrapper article-detail-page py-5">
    <article class="article-container">

        <header class="detail-header text-center mb-4">
            <span class="detail-category badge bg-primary bg-opacity-10 text-primary mb-3 px-3 py-2 rounded-pill">
                <?= htmlspecialchars($category) ?>
            </span>
            <h1 class="detail-title fw-bold display-5 mb-3"><?= htmlspecialchars($article['title']) ?></h1>
            
            <div class="detail-meta text-muted d-flex justify-content-center gap-3 small">
                <span class="meta-item"><i class="bi bi-calendar3 me-1"></i> <?= $tanggal ?></span>
            </div>
        </header>
        
        <figure class="detail-hero mb-5">
            <img src="<?= $heroImage ?>" 
                 alt="Ilustrasi: <?= htmlspecialchars($article['title']) ?>" 
                 class="img-fluid rounded-4 shadow-sm w-100" 
                 style="max-height: 500px; object-fit: cover;">
            <?php if (!empty($article['image_caption'])): ?>
                <figcaption class="text-center text-muted small mt-2">
                    <?= htmlspecialchars($article['image_caption']) ?>
                </figcaption>
            <?php endif; ?>
        </figure>

        <div class="detail-body">
            <?= $article['content'] ?>
        </div>

        <footer class="detail-footer mt-5 pt-4 border-top">
            
            <?php if (!empty($tags)): ?>
            <div class="tag-list mb-4">
                <span class="fw-bold me-2"><i class="bi bi-tags"></i> Tags:</span>
                <?php foreach($tags as $tag): ?>
                    <a href="<?= $_ENV['APP_URL'] ?>/artikel?tag=<?= urlencode(trim($tag)) ?>" 
                       class="badge bg-light text-secondary text-decoration-none border fw-normal me-1 p-2">
                       #<?= htmlspecialchars(trim($tag)) ?>
                    </a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            
            <div class="d-flex justify-content-between align-items-center">
                <a href="<?= $_ENV['APP_URL'] ?>/artikel" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="bi bi-arrow-left-short me-1"></i> Kembali ke Daftar
                </a>
            </div>
        </footer>

    </article>
</div>
<?php 
// Jika pageTitle belum dikirim dari controller, pakai default
$pageTitle = $pageTitle ?? "Scope Penelitian | Laboratorium Software Engineering"; 
?>

<section class="py-5 bg-light border-bottom">
    <div class="container py-4">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <span class="text-custom-blue fw-bold small text-uppercase ls-1">
                    Research Areas
                </span>
                <h1 class="fw-bold display-6 mt-2 text-dark">
                    Scope Penelitian Laboratorium SE
                </h1>
                <p class="text-secondary mt-3" style="max-width: 700px; margin: auto;">
                    Laboratorium Software Engineering berfokus pada area penelitian yang berkaitan 
                    dengan perkembangan teknologi digital modern. Setiap bidang riset dikembangkan 
                    untuk mendukung inovasi akademik dan industri berbasis teknologi masa depan.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container">

        <div class="row g-4">
            <?php if (!empty($scopes)): ?>
                <?php foreach ($scopes as $index => $s) : 
                    // 1. Tentukan Tema Warna (Looping: Biru, Ungu, Hijau, Merah, Orange, Cyan)
                    $themes = ['theme-blue', 'theme-purple', 'theme-green', 'theme-red', 'theme-orange', 'theme-cyan'];
                    // Gunakan modulus (%) agar warna berulang jika data lebih dari 6
                    $theme = $themes[$index % count($themes)];
                    
                    // 2. Parse Tags (JSON ke Array)
                    $tags = [];
                    if (!empty($s['tags'])) {
                        // Cek apakah formatnya JSON
                        $decoded = json_decode($s['tags'], true);
                        if (is_array($decoded)) {
                            $tags = $decoded;
                        } else {
                            // Jika disimpan sebagai string biasa dipisah koma (fallback)
                            $tags = explode(',', $s['tags']);
                        }
                    }
                    
                    // 3. Logika Icon: Prioritaskan Bootstrap Icon, lalu Image Upload, lalu Default
                    $iconElement = '';
                    if (!empty($s['icon_bootstrap'])) {
                        $iconClass = htmlspecialchars($s['icon_bootstrap']);
                        // Tampilkan ikon Bootstrap
                        $iconElement = '<i class="bi ' . $iconClass . '"></i>';
                        $bgIconClass = 'bi ' . $iconClass . ' scope-bg-icon';
                    } elseif (!empty($s['icon_url'])) {
                        // Tampilkan gambar upload
                        $imgSrc = $_ENV['APP_URL'] . '/public' . htmlspecialchars($s['icon_url']);
                        $iconElement = '<img src="' . $imgSrc . '" alt="Icon" style="width: 32px; height: 32px; object-fit: contain;">';
                        // Untuk background icon mungkin tidak pakai gambar agar tidak pecah, atau kosongkan
                        $bgIconClass = ''; 
                    } else {
                        // Default Icon
                        $iconElement = '<i class="bi bi-layers-fill"></i>';
                        $bgIconClass = 'bi bi-layers-fill scope-bg-icon';
                    }
                ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="scope-card <?= $theme ?>">

                            <?php if (!empty($bgIconClass)): ?>
                                <i class="<?= $bgIconClass ?>"></i>
                            <?php endif; ?>

                            <div class="scope-icon-wrapper">
                                <?= $iconElement ?>
                            </div>

                            <h4 class="fw-bold text-dark mb-3"><?= htmlspecialchars($s['kategori']) ?></h4>

                            <p class="text-secondary small mb-4">
                                <?= htmlspecialchars($s['deskripsi']) ?>
                            </p>

                            <div class="scope-tags">
                                <?php foreach ($tags as $tag) : ?>
                                    <span class="scope-tag"><?= htmlspecialchars(trim($tag)) ?></span>
                                <?php endforeach; ?>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Belum ada data scope penelitian yang ditambahkan.</p>
                </div>
            <?php endif; ?>
        </div>

    </div>
</section>
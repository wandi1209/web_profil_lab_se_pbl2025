<link rel="stylesheet" href="<?= $_ENV['APP_URL'] ?>/assets/css/visi_misi.css">

<div class="vm-wrapper">

    <section class="vision-section">
        <h2 class="section-title">VISI</h2>
        <div class="vision-card">
            <p class="vision-text">
                <?php 
                // Tampilkan visi, jika kosong tampilkan pesan default
                if (!empty($visi)) {
                    echo nl2br(htmlspecialchars($visi)); 
                } else {
                    echo "Visi belum ditambahkan.";
                }
                ?>
            </p>
        </div>
    </section>

    <section class="mission-section">
        <h2 class="section-title">MISI</h2>

        <div class="mission-grid">
            <?php if (!empty($misi) && is_array($misi)): ?>
                <?php foreach ($misi as $index => $item): ?>
                    <div class="mission-card">
                        <div class="mission-index-circle"><?= $index + 1 ?></div>
                        
                        <div class="mission-content-box">
                            <p class="mission-text">
                                <?= htmlspecialchars($item['konten']) ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="mission-card" style="width: 100%;">
                    <div class="mission-content-box" style="text-align: center;">
                        <p class="mission-text">Data misi belum tersedia.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
</div>
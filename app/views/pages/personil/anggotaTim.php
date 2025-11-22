<?php $baseUrl = '/web_profil_lab_se'; ?>

<div class="container py-5">
    <h2 class="fw-bold mb-4">
        <?= htmlspecialchars($title ?? 'Anggota Tim') ?>
    </h2>

    <div class="row g-4">
        <?php foreach ($dataDosen as $dosen): ?>
            <div class="col-12 col-md-6 col-lg-4">
                <a href="<?= $baseUrl ?>/personil/detail?id=<?= urlencode($dosen['id']) ?>" class="text-decoration-none text-dark">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body d-flex flex-column align-items-center">
                            <div class="mb-3" style="width: 140px; height: 140px;">
                                <img
                                    src="<?= htmlspecialchars($dosen['foto_url'] ?? $baseUrl . '/assets/img/default-avatar.png') ?>"
                                    alt="<?= htmlspecialchars($dosen['nama'] ?? 'Dosen') ?>"
                                    class="img-fluid rounded-circle"
                                    style="object-fit: cover; width: 100%; height: 100%;"
                                >
                            </div>
                            <h5 class="fw-bold mb-1">
                                <?= htmlspecialchars($dosen['nama'] ?? '') ?>
                            </h5>
                            <p class="text-muted mb-0">
                                <?= htmlspecialchars($dosen['jabatan'] ?? '') ?>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

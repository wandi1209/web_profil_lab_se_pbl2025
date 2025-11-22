<?php $baseUrl = '/web_profil_lab_se'; ?>

<div class="container py-5">

    <div class="row g-4">
        <div class="col-12">
            <div class="p-3 rounded-3 text-white" style="background: linear-gradient(90deg, #0059b3, #0099ff);">
                <h2 class="mb-0">
                    <?= htmlspecialchars($dosen['nama'] ?? 'Profil Dosen') ?>
                </h2>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-start">

                    <div class="mb-3 text-center" style="width: 200px; height: 240px; margin: 0 auto;">
                        <img
                            src="<?= htmlspecialchars($dosen['foto_url'] ?? $baseUrl . '/assets/img/default-avatar.png') ?>"
                            alt="<?= htmlspecialchars($dosen['nama'] ?? 'Dosen') ?>"
                            class="img-fluid rounded-3"
                            style="object-fit: cover; width: 100%; height: 100%;"
                        >
                    </div>

                    <p class="fw-semibold mb-1">NIP</p>
                    <p class="mb-2"><?= htmlspecialchars($dosen['nip'] ?? '-') ?></p>

                    <p class="fw-semibold mb-1">NIDN</p>
                    <p class="mb-2"><?= htmlspecialchars($dosen['nidn'] ?? '-') ?></p>

                    <p class="fw-semibold mb-1">Program Studi</p>
                    <p class="mb-2"><?= htmlspecialchars($dosen['program_studi'] ?? '-') ?></p>

                    <p class="fw-semibold mb-1">Jabatan</p>
                    <p class="mb-3"><?= htmlspecialchars($dosen['jabatan'] ?? '-') ?></p>

                    <hr>

                    <p class="fw-semibold mb-2">Kontak</p>
                    <?php if (!empty($dosen['links']['email'])): ?>
                        <p class="mb-1">
                            Email:
                            <a href="<?= htmlspecialchars($dosen['links']['email']) ?>">
                                <?= htmlspecialchars(str_replace('mailto:', '', $dosen['links']['email'])) ?>
                            </a>
                        </p>
                    <?php else: ?>
                        <p class="mb-1 text-muted">Email belum tersedia.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-8">

            <?php if (!empty($dosen['bidang'])): ?>
                <div class="mb-3">
                    <?php foreach ($dosen['bidang'] as $tag): ?>
                        <span class="badge rounded-pill text-dark border me-1 mb-1">
                            <?= htmlspecialchars($tag) ?>
                        </span>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($dosen['links'])): ?>
                <div class="mb-4">
                    <?php if (!empty($dosen['links']['linkedin'])): ?>
                        <a href="<?= htmlspecialchars($dosen['links']['linkedin']) ?>" class="btn btn-outline-primary btn-sm me-1 mb-1">LinkedIn</a>
                    <?php endif; ?>
                    <?php if (!empty($dosen['links']['google_scholar'])): ?>
                        <a href="<?= htmlspecialchars($dosen['links']['google_scholar']) ?>" class="btn btn-outline-primary btn-sm me-1 mb-1">Google Scholar</a>
                    <?php endif; ?>
                    <?php if (!empty($dosen['links']['sinta'])): ?>
                        <a href="<?= htmlspecialchars($dosen['links']['sinta']) ?>" class="btn btn-outline-primary btn-sm me-1 mb-1">Sinta</a>
                    <?php endif; ?>
                    <?php if (!empty($dosen['links']['cv'])): ?>
                        <a href="<?= htmlspecialchars($dosen['links']['cv']) ?>" class="btn btn-outline-primary btn-sm me-1 mb-1">CV</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <h3 class="fw-bold mb-3">Pendidikan & Sertifikasi</h3>

            <div class="row g-3">
                <div class="col-12 col-lg-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Pendidikan</h5>
                            <?php if (!empty($dosen['pendidikan'])): ?>
                                <ul class="mb-0">
                                    <?php foreach ($dosen['pendidikan'] as $item): ?>
                                        <li><?= htmlspecialchars($item) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <p class="text-muted mb-0">Data pendidikan belum tersedia.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Sertifikasi</h5>
                            <?php if (!empty($dosen['sertifikasi'])): ?>
                                <ul class="mb-0">
                                    <?php foreach ($dosen['sertifikasi'] as $item): ?>
                                        <li><?= htmlspecialchars($item) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <p class="text-muted mb-0">Data sertifikasi belum tersedia.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

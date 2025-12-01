<?php 
$pageTitle = $personil['kategori'] == 'dosen' ? "Detail Profil Dosen" : "Detail Profil " . ucfirst($personil['kategori']); 
?>

<section class="py-5">
    <div class="container">

        <h3 class="fw-bold mb-4">Detail Profile</h3>

        <div class="card shadow-sm p-4">

            <div class="row g-4 align-items-start">

                <!-- FOTO -->
                <div class="col-lg-4 text-center">
                    <?php if (!empty($personil['foto_url'])): ?>
                        <img src="<?= $_ENV['APP_URL'] . htmlspecialchars($personil['foto_url']) ?>" 
                             class="img-fluid rounded shadow-sm" 
                             alt="Foto <?= htmlspecialchars($personil['nama']) ?>"
                             style="max-width: 300px;">
                    <?php else: ?>
                        <img src="<?= $_ENV['APP_URL'] ?>/assets/images/user-placeholder.png" 
                             class="img-fluid rounded shadow-sm" 
                             alt="Foto Default"
                             style="max-width: 300px;">
                    <?php endif; ?>
                </div>

                <!-- INFORMASI -->
                <div class="col-lg-8">

                    <h4 class="fw-bold mb-1"><?= htmlspecialchars($personil['nama']) ?></h4>
                    <p class="text-secondary mb-3"><?= htmlspecialchars($personil['position']) ?></p>

                    <!-- EMAIL -->
                    <div class="mb-3">
                        <strong>Email:</strong>
                        <div class="mt-1">
                            <a href="mailto:<?= htmlspecialchars($personil['email']) ?>">
                                <?= htmlspecialchars($personil['email']) ?>
                            </a>
                        </div>
                    </div>

                    <!-- NIDN -->
                    <?php if (!empty($personil['nidn'])): ?>
                    <div class="mb-3">
                        <strong>NIDN:</strong>
                        <div class="mt-1"><?= htmlspecialchars($personil['nidn']) ?></div>
                    </div>
                    <?php endif; ?>

                    <!-- KEAHLIAN -->
                    <?php if (!empty($personil['keahlian'])): ?>
                    <div class="mb-3">
                        <strong>Bidang Keahlian:</strong>
                        <div class="mt-1"><?= nl2br(htmlspecialchars($personil['keahlian'])) ?></div>
                    </div>
                    <?php endif; ?>

                    <!-- PENDIDIKAN -->
                    <?php if (!empty($pendidikan)): ?>
                    <div class="mb-3">
                        <strong>Riwayat Pendidikan:</strong>
                        <ul class="small mt-1">
                            <?php foreach ($pendidikan as $item): ?>
                                <li><?= htmlspecialchars($item) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <!-- LINK SOSIAL -->
                    <?php if (!empty($personil['linkedin']) || !empty($personil['github'])): ?>
                    <div class="d-flex gap-3 mt-2">
                        
                        <?php if (!empty($personil['linkedin'])): ?>
                        <!-- LinkedIn -->
                        <a href="<?= htmlspecialchars($personil['linkedin']) ?>" 
                           target="_blank" 
                           class="d-inline-flex align-items-center justify-content-center"
                           style="width: 42px; height: 42px; border-radius: 50%; background: #0A66C2; color: white; font-size: 20px;">
                            <i class="bi bi-linkedin"></i>
                        </a>
                        <?php endif; ?>

                        <?php if (!empty($personil['github'])): ?>
                        <!-- Github -->
                        <a href="<?= htmlspecialchars($personil['github']) ?>" 
                           target="_blank" 
                           class="d-inline-flex align-items-center justify-content-center"
                           style="width: 42px; height: 42px; border-radius: 50%; background: #24292e; color: white; font-size: 20px;">
                            <i class="bi bi-github"></i>
                        </a>
                        <?php endif; ?>

                    </div>
                    <br>
                    <?php endif; ?>

                    <hr>

                    <!-- PUBLIKASI -->
                    <?php if (!empty($publikasi)): ?>
                    <div>
                        <strong>Publikasi Terbaru:</strong>
                        <ul class="small mt-1">
                            <?php foreach ($publikasi as $item): ?>
                                <li><?= htmlspecialchars($item) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                </div>

            </div>

        </div>

        <!-- Tombol Kembali -->
        <div class="mt-4">
            <a href="<?= $_ENV['APP_URL'] ?>/anggota/<?= $personil['kategori'] ?>" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>
        </div>

        <!-- FOOTER -->
        <footer class="mt-5 p-4 text-center text-secondary small border-top">
            &copy; <?= date('Y') ?> Laboratorium Software Engineering
        </footer>

    </div>
</section>
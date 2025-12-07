<?php 
$pageTitle = "Form Pendaftaran - Laboratorium SE"; 
?>
<section class="py-5" style="background-color: #f8fafc;">
    <div class="container">

        <?php if (!empty($_SESSION['success'])): ?>
            <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>
        <?php if (!empty($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <div class="row g-4">
            <div class="col-lg-7">
                <div class="card shadow-sm border-0 rounded-4 p-4">
                    <h4 class="fw-semibold mb-3">Form Pendaftaran</h4>

                    <form action="<?= $_ENV['APP_URL'] ?>/pendaftaran/store" method="POST">
                        <!-- Buat field tidak required di HTML. Validasi tetap di server. -->
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control rounded-3" placeholder="Masukkan Nama">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control rounded-3" placeholder="Masukkan Email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nomor HP</label>
                            <input type="text" name="no_hp" class="form-control rounded-3" placeholder="Masukkan Nomor HP">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">NIM</label>
                            <input type="text" name="nim" class="form-control rounded-3" placeholder="Masukkan NIM">
                        </div>
                        <?php $currentYear = (int)date('Y'); $years = range($currentYear, $currentYear - 4); ?>
                        <div class="mb-3">
                            <label class="form-label">Angkatan</label>
                            <select name="angkatan" class="form-select rounded-3">
                                <option value="">-- Pilih Angkatan --</option>
                                <?php foreach ($years as $y): ?>
                                    <option value="<?= $y ?>"><?= $y ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Prodi</label>
                            <select name="program_studi" class="form-select rounded-3">
                                <option value="">-- Pilih Prodi --</option>
                                <option>D4 Teknik Informatika</option>
                                <option>D4 Sistem Informasi Bisnis</option>
                                <option>D2 Pengembangan Piranti Lunak Situs</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Peminatan</label>
                            <input type="text" name="peminatan" class="form-control rounded-3" placeholder="Contoh: Web, AI, Cloud">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keahlian</label>
                            <input type="text" name="keahlian" class="form-control rounded-3" placeholder="Contoh: Laravel, React">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Link Portofolio</label>
                            <input type="url" name="portofolio_url" class="form-control rounded-3" placeholder="URL Portofolio">
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Alasan</label>
                            <textarea name="alasan" class="form-control rounded-3" rows="4" placeholder="Alasan bergabung..."></textarea>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary px-4 rounded-pill">Kirim Pendaftaran</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card shadow-sm border-0 rounded-4 p-4">
                    <h4 class="fw-semibold mb-3">Cek Status Pendaftaran</h4>
                    <form action="<?= $_ENV['APP_URL'] ?>/pendaftaran/cek-status" method="GET" class="row g-2">
                        <div class="col-8">
                            <input type="text" name="nim" class="form-control rounded-3" placeholder="Masukkan NIM">
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-outline-primary w-100 rounded-pill">Cek</button>
                        </div>
                    </form>

                    <?php if (isset($statusResult)): ?>
                        <?php if ($statusResult): ?>
                            <div class="alert alert-info mt-3">
                                <div><strong>Nama:</strong> <?= htmlspecialchars($statusResult['nama']) ?></div>
                                <div><strong>NIM:</strong> <?= htmlspecialchars($statusResult['nim']) ?></div>
                                <div><strong>Status:</strong> <?= htmlspecialchars($statusResult['status']) ?></div>
                                <div><strong>Tanggal Daftar:</strong> <?= date('d F Y H:i', strtotime($statusResult['created_at'])) ?></div>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-warning mt-3">Data pendaftar dengan NIM tersebut tidak ditemukan.</div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>
</section>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0">Tambah Publikasi</h3>
        <a href="<?= $_ENV['APP_URL'] ?>/admin/publikasi" class="btn btn-secondary">Kembali</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <form method="POST" action="<?= $_ENV['APP_URL'] ?>/admin/publikasi/store">
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Judul Publikasi</label>
                    <input type="text" name="judul" class="form-control" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Tahun</label>
                        <input type="number" name="tahun" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Penulis (Personil)</label>
                        <select name="personil_id" class="form-select" required>
                            <option value="">-- Pilih Penulis --</option>
                            <?php foreach ($personil as $p): ?>
                                <option value="<?= $p['id'] ?>">
                                    <?= htmlspecialchars($p['nama']) ?> (<?= $p['kategori'] ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Link URL (Opsional)</label>
                    <input type="url" name="url" class="form-control" placeholder="https://...">
                </div>

                <button type="submit" class="btn btn-primary px-4">Simpan</button>
            </form>
        </div>
    </div>
</div>
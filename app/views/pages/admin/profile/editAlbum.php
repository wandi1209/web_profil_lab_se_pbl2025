<div class="container-fluid">

    <h3 class="fw-bold mb-4">Edit Album</h3>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="/admin/album/update" method="POST" enctype="multipart/form-data">

                <input type="hidden" name="id" value="<?= $data['id'] ?>">

                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <input type="text" name="kategori" class="form-control"
                           value="<?= htmlspecialchars($data['kategori']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Konten</label>
                    <textarea name="konten" rows="5" class="form-control" required><?= htmlspecialchars($data['konten']) ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar Sekarang</label><br>

                    <?php if (!empty($data['gambar'])): ?>
                        <img src="/uploads/album/<?= $data['gambar'] ?>"
                             class="img-fluid rounded mb-3"
                             style="max-width: 280px;">
                    <?php else: ?>
                        <p class="text-muted">Tidak ada gambar</p>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label class="form-label">Ganti Gambar (opsional)</label>
                    <input type="file" name="gambar" class="form-control" accept="image/*">
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="/admin/album" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-warning">Update</button>
                </div>

            </form>

        </div>
    </div>

</div>

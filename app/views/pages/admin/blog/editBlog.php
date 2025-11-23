<div class="container-fluid">

    <h3 class="fw-bold mb-4">Edit Blog</h3>

    <form action="/admin/blog/update" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?= $blog['id'] ?>">

        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <input type="text" name="kategori" class="form-control"
                   value="<?= $blog['kategori'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Konten</label>
            <textarea name="konten" class="form-control" rows="5" required><?= $blog['konten'] ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Gambar</label><br>

            <?php if (!empty($blog['gambar'])): ?>
                <img src="/uploads/blog/<?= $blog['gambar'] ?>" 
                     style="max-width:200px; border-radius:6px; margin-bottom:10px;">
            <?php endif; ?>

            <input type="file" name="gambar" class="form-control">
            <small class="text-muted">Biarkan kosong jika tidak ingin mengganti gambar</small>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="/admin/blog" class="btn btn-secondary">Kembali</a>

    </form>

</div>

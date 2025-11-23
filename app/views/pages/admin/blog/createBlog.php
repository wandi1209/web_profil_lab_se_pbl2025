<div class="container-fluid">

    <h3 class="fw-bold mb-4">Tambah Blog</h3>

    <form action="/admin/blog/store" method="POST" enctype="multipart/form-data">

        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <input type="text" name="kategori" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Konten</label>
            <textarea name="konten" class="form-control" rows="5" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Gambar (opsional)</label>
            <input type="file" name="gambar" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="/admin/blog" class="btn btn-secondary">Kembali</a>

    </form>

</div>

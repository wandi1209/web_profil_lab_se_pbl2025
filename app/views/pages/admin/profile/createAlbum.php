<div class="container-fluid">

    <h3 class="fw-bold mb-4">Tambah Album</h3>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="/admin/album/store" method="POST" enctype="multipart/form-data">

                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <input type="text" name="kategori" class="form-control" placeholder="Masukkan kategori..." required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Konten</label>
                    <textarea name="konten" rows="5" class="form-control" placeholder="Masukkan konten..." required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar (opsional)</label>
                    <input type="file" name="gambar" class="form-control" accept="image/*">
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="/admin/album" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>

            </form>

        </div>
    </div>

</div>

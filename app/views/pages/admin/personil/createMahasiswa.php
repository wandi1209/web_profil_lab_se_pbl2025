<div class="container-fluid">

    <h3 class="fw-bold mb-4">Tambah Mahasiswa</h3>

    <form action="/admin/personil/mahasiswa/store" method="POST">

        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <input type="text" name="kategori" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Konten</label>
            <textarea name="konten" class="form-control" rows="5" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="/admin/personil/mahasiswa" class="btn btn-secondary">Kembali</a>

    </form>

</div>

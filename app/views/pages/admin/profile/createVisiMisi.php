<div class="container-fluid">

    <h3 class="fw-bold mb-4">Tambah Data Visi & Misi</h3>

    <form action="/admin/profile/visiMisi/store" method="POST">

        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <input type="text" name="kategori" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Konten</label>
            <textarea name="konten" rows="6" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="/admin/profile/visiMisi" class="btn btn-secondary">Kembali</a>

    </form>

</div>

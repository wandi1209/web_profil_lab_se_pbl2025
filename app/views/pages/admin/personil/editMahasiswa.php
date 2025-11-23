<div class="container-fluid">

    <h3 class="fw-bold mb-4">Edit Mahasiswa</h3>

    <form action="/admin/personil/mahasiswa/update" method="POST">

        <input type="hidden" name="id" value="<?= $data['id'] ?>">

        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <input type="text" name="kategori" value="<?= $data['kategori'] ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Konten</label>
            <textarea name="konten" class="form-control" rows="5" required><?= $data['konten'] ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="/admin/personil/mahasiswa" class="btn btn-secondary">Kembali</a>

    </form>

</div>

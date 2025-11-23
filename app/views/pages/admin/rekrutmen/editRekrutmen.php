<div class="container-fluid">

    <h3 class="fw-bold mb-4">Edit Data Rekrutmen</h3>

    <form action="/admin/profile/rekrutmen/index/update" method="POST">

        <input type="hidden" name="id" value="<?= $data['id'] ?>">

        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <input type="text" name="kategori" class="form-control"
                   value="<?= $data['kategori'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Konten</label>
            <textarea name="konten" rows="6" class="form-control" required><?= $data['konten'] ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="/admin/profile/rekrutmen" class="btn btn-secondary">Kembali</a>

    </form>

</div>

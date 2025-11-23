<div class="container-fluid">

    <h3 class="fw-bold mb-4">Edit Data Tentang Lab</h3>

    <form action="/admin/profile/tentangLab/update" method="POST">
        <input type="hidden" name="id" value="<?= $data['id'] ?>">

        <label>Kategori</label>
        <input type="text" name="kategori" class="form-control"
            value="<?= $data['kategori'] ?>">

        <label>Konten</label>
        <textarea name="konten" class="form-control" rows="6"><?= $data['konten'] ?></textarea>

        <button class="btn btn-primary mt-3">Update</button>
    </form>
</div>

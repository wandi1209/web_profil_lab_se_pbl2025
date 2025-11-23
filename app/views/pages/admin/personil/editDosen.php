<div class="container-fluid">

    <h3 class="fw-bold mb-4">Edit Dosen</h3>

    <form action="/admin/personil/dosen/update" method="POST" enctype="multipart/form-data">
        
        <input type="hidden" name="id" value="<?= $dosen['id'] ?>">

        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <input type="text" class="form-control" name="kategori" value="<?= $dosen['kategori'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Konten</label>
            <textarea class="form-control" name="konten" rows="5" required><?= $dosen['konten'] ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Gambar Saat Ini</label><br>
            <?php if (!empty($dosen['gambar'])): ?>
                <img src="/uploads/dosen/<?= $dosen['gambar'] ?>" style="max-width:250px; border-radius:8px;">
            <?php else: ?>
                <p class="text-muted">Tidak ada gambar</p>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label class="form-label">Ganti Gambar (opsional)</label>
            <input type="file" class="form-control" name="gambar" accept="image/*" onchange="previewNewImg(event)">
        </div>

        <div class="mb-3">
            <img id="newPreview" style="max-width:250px; display:none; border-radius:8px;">
        </div>

        <button class="btn btn-warning">Update</button>
        <a href="/admin/personil/dosen" class="btn btn-secondary">Kembali</a>

    </form>
</div>

<script>
function previewNewImg(event) {
    const img = document.getElementById('newPreview');
    img.src = URL.createObjectURL(event.target.files[0]);
    img.style.display = 'block';
}
</script>

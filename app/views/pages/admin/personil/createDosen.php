<div class="container-fluid">

    <h3 class="fw-bold mb-4">Tambah Dosen</h3>

    <form action="/admin/personil/dosen/store" method="POST" enctype="multipart/form-data">

        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <input type="text" class="form-control" name="kategori" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Konten</label>
            <textarea class="form-control" name="konten" rows="5" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Gambar (opsional)</label>
            <input type="file" class="form-control" name="gambar" accept="image/*" onchange="previewImage(event)">
        </div>

        <div class="mb-3">
            <img id="preview" style="max-width: 250px; display:none; border-radius:8px;">
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="/admin/personil/dosen" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<script>
function previewImage(event) {
    const img = document.getElementById('preview');
    img.src = URL.createObjectURL(event.target.files[0]);
    img.style.display = 'block';
}
</script>

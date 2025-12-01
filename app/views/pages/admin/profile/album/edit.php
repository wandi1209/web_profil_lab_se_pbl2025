<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0">Edit Album</h3>
        <a href="<?= $_ENV['APP_URL'] ?>/admin/album" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $_SESSION['error'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <div class="card">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Form Edit Album</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="<?= $_ENV['APP_URL'] ?>/admin/album/update" enctype="multipart/form-data">

                <input type="hidden" name="id" value="<?= $album['id'] ?>">

                <!-- Judul -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Judul <span class="text-danger">*</span></label>
                    <input
                        type="text"
                        name="judul"
                        class="form-control input-bordered"
                        value="<?= htmlspecialchars($album['judul']) ?>"
                        required>
                </div>

                <!-- Deskripsi -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Deskripsi</label>
                    <textarea
                        name="deskripsi"
                        class="form-control input-bordered"
                        rows="4"><?= htmlspecialchars($album['deskripsi'] ?? '') ?></textarea>
                </div>

                <!-- Kategori -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Kategori <span class="text-danger">*</span></label>
                    <select name="kategori" class="form-select input-bordered" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="kegiatan" <?= $album['kategori'] == 'kegiatan' ? 'selected' : '' ?>>Kegiatan</option>
                        <option value="workshop" <?= $album['kategori'] == 'workshop' ? 'selected' : '' ?>>Workshop</option>
                        <option value="seminar" <?= $album['kategori'] == 'seminar' ? 'selected' : '' ?>>Seminar</option>
                        <option value="kompetisi" <?= $album['kategori'] == 'kompetisi' ? 'selected' : '' ?>>Kompetisi</option>
                        <option value="lainnya" <?= $album['kategori'] == 'lainnya' ? 'selected' : '' ?>>Lainnya</option>
                    </select>
                </div>

                <!-- Foto -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Foto</label>

                    <!-- Preview Foto Lama -->
                    <?php if (!empty($album['foto_url'])): ?>
                    <div class="mb-3">
                        <img
                            src="<?= $_ENV['APP_URL'] . htmlspecialchars($album['foto_url']) ?>"
                            alt="Foto Album"
                            class="img-thumbnail border-preview"
                            style="max-width: 300px;">
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" name="hapus_foto" id="hapusFoto">
                            <label class="form-check-label text-danger" for="hapusFoto">
                                <i class="bi bi-trash me-1"></i>Hapus foto
                            </label>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Upload Foto Baru -->
                    <input
                        type="file"
                        name="foto"
                        class="form-control input-bordered"
                        accept="image/*"
                        id="inputFoto">
                    <small class="text-muted">
                        Format: JPG, PNG, GIF, WEBP | Maksimal 5MB
                        <?= !empty($album['foto_url']) ? ' | Upload foto baru untuk mengganti' : '' ?>
                    </small>

                    <!-- Preview Upload Baru -->
                    <div id="previewContainer" class="mt-3" style="display: none;">
                        <label class="form-label fw-bold">Preview Foto Baru:</label><br>
                        <img id="previewImage" src="" alt="Preview" class="img-thumbnail border-preview" style="max-width: 300px;">
                    </div>
                </div>

                <hr class="my-4">

                <!-- Buttons -->
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-2"></i>Simpan Perubahan
                    </button>
                    <a href="<?= $_ENV['APP_URL'] ?>/admin/album" class="btn btn-secondary">
                        <i class="bi bi-x-circle me-2"></i>Batal
                    </a>
                </div>

            </form>
        </div>
    </div>

</div>

<style>
/* Input Border Styling */
.input-bordered {
    border: 2px solid #dee2e6 !important;
    border-radius: 8px !important;
    padding: 10px 15px !important;
    transition: all 0.3s ease !important;
}

.input-bordered:focus {
    border-color: #0d6efd !important;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15) !important;
    outline: none !important;
}

.input-bordered:hover {
    border-color: #adb5bd !important;
}

/* Card Styling */
.card {
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    border: 1px solid #e0e0e0;
}

/* Preview Image Border */
.border-preview {
    border: 3px solid #dee2e6 !important;
    border-radius: 8px !important;
    padding: 5px !important;
    transition: border-color 0.3s ease !important;
}

.border-preview:hover {
    border-color: #0d6efd !important;
}

/* Checkbox Styling */
.form-check-input {
    border: 2px solid #dee2e6;
    cursor: pointer;
}

.form-check-input:checked {
    background-color: #dc3545;
    border-color: #dc3545;
}

.form-check-label {
    cursor: pointer;
}
</style>

<script>
// Preview foto baru
document.getElementById('inputFoto').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImage').src = e.target.result;
            document.getElementById('previewContainer').style.display = 'block';
        }
        reader.readAsDataURL(file);
    } else {
        document.getElementById('previewContainer').style.display = 'none';
    }
});

// Hide preview saat checkbox hapus dicentang
document.getElementById('hapusFoto')?.addEventListener('change', function() {
    if (this.checked) {
        document.getElementById('inputFoto').value = '';
        document.getElementById('previewContainer').style.display = 'none';
    }
});
</script>
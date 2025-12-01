<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0">Edit Artikel Blog</h3>
        <a href="<?= $_ENV['APP_URL'] ?>/admin/blog" class="btn btn-secondary">
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
            <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Form Edit Artikel</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="<?= $_ENV['APP_URL'] ?>/admin/blog/update" enctype="multipart/form-data">

                <input type="hidden" name="id" value="<?= $blog['id'] ?>">

                <!-- Judul -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Judul Artikel <span class="text-danger">*</span></label>
                    <input
                        type="text"
                        name="title"
                        class="form-control input-bordered"
                        value="<?= htmlspecialchars($blog['title']) ?>"
                        required>
                </div>

                <!-- Ringkasan -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Ringkasan/Excerpt</label>
                    <textarea
                        name="ringkasan"
                        class="form-control input-bordered"
                        rows="3"><?= htmlspecialchars($blog['ringkasan'] ?? '') ?></textarea>
                </div>

                <!-- Gambar -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Gambar Cover</label>

                    <!-- Preview Gambar Lama -->
                    <?php if (!empty($blog['gambar_url'])): ?>
                    <div class="mb-3">
                        <img
                            src="<?= $_ENV['APP_URL'] . htmlspecialchars($blog['gambar_url']) ?>"
                            alt="Cover"
                            class="img-thumbnail border-preview"
                            style="max-width: 400px;">
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" name="hapus_gambar" id="hapusGambar">
                            <label class="form-check-label text-danger" for="hapusGambar">
                                <i class="bi bi-trash me-1"></i>Hapus gambar
                            </label>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Upload Gambar Baru -->
                    <input
                        type="file"
                        name="gambar"
                        class="form-control input-bordered"
                        accept="image/*"
                        id="inputGambar">
                    <small class="text-muted">
                        Format: JPG, PNG, WEBP | Maksimal 5MB
                        <?= !empty($blog['gambar_url']) ? ' | Upload gambar baru untuk mengganti' : '' ?>
                    </small>

                    <!-- Preview Upload Baru -->
                    <div id="previewContainer" class="mt-3" style="display: none;">
                        <label class="form-label fw-bold">Preview Gambar Baru:</label><br>
                        <img id="previewImage" src="" alt="Preview" class="img-thumbnail border-preview" style="max-width: 400px;">
                    </div>
                </div>

                <!-- Konten -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Konten Artikel <span class="text-danger">*</span></label>
                    <textarea
                        name="content"
                        id="contentEditor"
                        class="form-control input-bordered"
                        rows="15"
                        required><?= htmlspecialchars($blog['content']) ?></textarea>
                </div>

                <hr class="my-4">

                <!-- Buttons -->
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-2"></i>Simpan Perubahan
                    </button>
                    <a href="<?= $_ENV['APP_URL'] ?>/admin/blog" class="btn btn-secondary">
                        <i class="bi bi-x-circle me-2"></i>Batal
                    </a>
                </div>

            </form>
        </div>
    </div>

</div>

<style>
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

.card {
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    border: 1px solid #e0e0e0;
}

.border-preview {
    border: 3px solid #dee2e6 !important;
    border-radius: 8px !important;
    padding: 5px !important;
}
</style>

<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>

<script>
// Preview gambar baru
document.getElementById('inputGambar').addEventListener('change', function(e) {
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
document.getElementById('hapusGambar')?.addEventListener('change', function() {
    if (this.checked) {
        document.getElementById('inputGambar').value = '';
        document.getElementById('previewContainer').style.display = 'none';
    }
});

// CKEditor (Optional)
/*
ClassicEditor
    .create(document.querySelector('#contentEditor'))
    .catch(error => {
        console.error(error);
    });
*/
</script>

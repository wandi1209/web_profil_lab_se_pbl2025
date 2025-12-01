<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0">Tentang Laboratorium</h3>
    </div>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $_SESSION['success'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $_SESSION['error'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <!-- FORM TENTANG -->
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Informasi Tentang Lab</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="<?= $_ENV['APP_URL'] ?>/admin/profile/tentang/save" enctype="multipart/form-data">
                
                <!-- Judul -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Judul <span class="text-danger">*</span></label>
                    <input 
                        type="text" 
                        name="judul" 
                        class="form-control input-bordered" 
                        placeholder="Contoh: Tentang Laboratorium Software Engineering"
                        value="<?= htmlspecialchars($tentang['judul'] ?? '') ?>"
                        required>
                    <small class="text-muted">Judul halaman tentang laboratorium</small>
                </div>

                <!-- Upload Gambar -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Gambar</label>
                    
                    <!-- Preview Gambar yang sudah ada -->
                    <?php if (!empty($tentang['gambar'])): ?>
                    <div class="mb-3">
                        <img 
                            src="<?= $_ENV['APP_URL']. "/public" . htmlspecialchars($tentang['gambar']) ?>" 
                            alt="Gambar Tentang" 
                            class="img-thumbnail"
                            style="max-width: 400px; max-height: 300px;">
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" name="hapus_gambar" id="hapusGambar">
                            <label class="form-check-label text-danger" for="hapusGambar">
                                <i class="bi bi-trash me-1"></i>Hapus gambar
                            </label>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Input File -->
                    <input 
                        type="file" 
                        name="gambar" 
                        class="form-control input-bordered" 
                        accept="image/*"
                        id="inputGambar">
                    <small class="text-muted">
                        Format: JPG, PNG, GIF, WEBP | Maksimal 5MB
                        <?= !empty($tentang['gambar']) ? ' | Upload gambar baru untuk mengganti' : '' ?>
                    </small>

                    <!-- Preview Upload Baru -->
                    <div id="previewContainer" class="mt-3" style="display: none;">
                        <label class="form-label fw-bold">Preview Gambar Baru:</label><br>
                        <img id="previewImage" src="" alt="Preview" class="img-thumbnail" style="max-width: 400px; max-height: 300px;">
                    </div>
                </div>

                <!-- Konten -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Konten <span class="text-danger">*</span></label>
                    <textarea 
                        name="konten" 
                        class="form-control input-bordered" 
                        rows="10" 
                        placeholder="Masukkan deskripsi lengkap tentang laboratorium..."
                        required><?= htmlspecialchars($tentang['konten'] ?? '') ?></textarea>
                    <small class="text-muted">Deskripsi lengkap tentang laboratorium (mendukung line break)</small>
                </div>

                <!-- Preview Section -->
                <?php if (!empty($tentang['konten'])): ?>
                <div class="mb-4">
                    <label class="form-label fw-bold">Preview Konten:</label>
                    <div class="border rounded p-3 bg-light">
                        <h5><?= htmlspecialchars($tentang['judul'] ?? '') ?></h5>
                        <hr>
                        <?php if (!empty($tentang['gambar'])): ?>
                        <img 
                            src="<?= $_ENV['APP_URL'] . htmlspecialchars($tentang['gambar']) ?>" 
                            alt="Gambar Tentang" 
                            class="img-fluid rounded mb-3"
                            style="max-width: 100%;">
                        <?php endif; ?>
                        <div class="preview-content">
                            <?= nl2br(htmlspecialchars($tentang['konten'])) ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Buttons -->
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-2"></i>Simpan Perubahan
                    </button>
                    <button type="reset" class="btn btn-secondary">
                        <i class="bi bi-arrow-counterclockwise me-2"></i>Reset
                    </button>
                </div>

            </form>
        </div>
    </div>

    <!-- Info Card -->
    <div class="card mt-4 border-info">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <i class="bi bi-info-circle-fill text-info me-3" style="font-size: 2rem;"></i>
                <div>
                    <h6 class="mb-1">Tips Pengisian:</h6>
                    <ul class="mb-0 small text-muted">
                        <li>Upload gambar dengan resolusi minimal 800x600px untuk hasil optimal</li>
                        <li>Gunakan gambar yang relevan dengan laboratorium</li>
                        <li>Gambar akan ditampilkan di halaman publik</li>
                        <li>Centang "Hapus gambar" untuk menghapus gambar yang ada</li>
                    </ul>
                </div>
            </div>
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
    border-color: #0b5ed7 !important;
}

/* Textarea specific */
textarea.input-bordered {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: 0.95rem;
    line-height: 1.6;
}

/* File input specific */
input[type="file"].input-bordered {
    padding: 8px 12px !important;
    cursor: pointer;
}

input[type="file"].input-bordered::-webkit-file-upload-button {
    background-color: #0d6efd;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 6px 15px;
    cursor: pointer;
    margin-right: 10px;
    transition: background-color 0.3s ease;
}

input[type="file"].input-bordered::-webkit-file-upload-button:hover {
    background-color: #0b5ed7;
}

/* Preview Content */
.preview-content {
    line-height: 1.8;
    text-align: justify;
}

/* Card Styling */
.card {
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    border: 1px solid #e0e0e0;
}

.card-header {
    border-bottom: 2px solid rgba(255,255,255,0.2);
}

/* Image Thumbnail */
.img-thumbnail {
    border: 3px solid #dee2e6;
    padding: 5px;
    transition: border-color 0.3s ease;
}

.img-thumbnail:hover {
    border-color: #0d6efd;
}

/* Form Check */
.form-check-input {
    border: 2px solid #dc3545;
    cursor: pointer;
}

.form-check-input:checked {
    background-color: #dc3545;
    border-color: #dc3545;
}

/* Label */
.form-label {
    margin-bottom: 8px;
    color: #495057;
}

/* Small Text */
small.text-muted {
    display: block;
    margin-top: 5px;
    font-size: 0.875rem;
}
</style>

<script>
// Preview gambar sebelum upload
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

// Hide preview ketika checkbox hapus gambar dicentang
document.getElementById('hapusGambar')?.addEventListener('change', function() {
    if (this.checked) {
        document.getElementById('inputGambar').value = '';
        document.getElementById('previewContainer').style.display = 'none';
    }
});
</script>
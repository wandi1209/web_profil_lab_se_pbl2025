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

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Informasi Tentang Lab</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="<?= $_ENV['APP_URL'] ?>/admin/profile/tentang/save" enctype="multipart/form-data">
                
                <div class="mb-4">
                    <label class="form-label fw-bold">Judul <span class="text-danger">*</span></label>
                    <input 
                        type="text" 
                        name="judul" 
                        class="form-control input-bordered" 
                        placeholder="Contoh: Tentang Laboratorium Software Engineering"
                        value="<?= htmlspecialchars($tentang['judul'] ?? '') ?>"
                        required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Gambar</label>
                    
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

                    <input 
                        type="file" 
                        name="gambar" 
                        class="form-control input-bordered" 
                        accept="image/*"
                        id="inputGambar">
                    <small class="text-muted">Format: JPG, PNG, GIF, WEBP | Maksimal 5MB</small>

                    <div id="previewContainer" class="mt-3" style="display: none;">
                        <label class="form-label fw-bold">Preview Gambar Baru:</label><br>
                        <img id="previewImage" src="" alt="Preview" class="img-thumbnail" style="max-width: 400px; max-height: 300px;">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Konten <span class="text-danger">*</span></label>
                    <textarea name="konten" id="summernote" class="form-control" required><?= $tentang['konten'] ?? '' ?></textarea>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-2"></i>Simpan Perubahan
                    </button>
                    <button type="reset" class="btn btn-secondary" id="btnReset">
                        <i class="bi bi-arrow-counterclockwise me-2"></i>Reset
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<script>
$(document).ready(function() {
    // Inisialisasi Summernote
    $('#summernote').summernote({
        placeholder: 'Tulis deskripsi lengkap tentang laboratorium...',
        tabsize: 2,
        height: 400, // Tinggi editor
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ],
        callbacks: {
            onImageUpload: function(files) {
                // Opsional: Handle image upload via AJAX jika diperlukan
                // uploadImage(files[0]);
            }
        }
    });

    // Reset Summernote saat tombol reset ditekan
    $('#btnReset').on('click', function() {
        $('#summernote').summernote('reset');
        $('#previewContainer').hide();
    });

    // Preview gambar cover (Script Lama)
    $('#inputGambar').on('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#previewImage').attr('src', e.target.result);
                $('#previewContainer').show();
            }
            reader.readAsDataURL(file);
        } else {
            $('#previewContainer').hide();
        }
    });

    // Hide preview saat hapus dicentang
    $('#hapusGambar').on('change', function() {
        if (this.checked) {
            $('#inputGambar').val('');
            $('#previewContainer').hide();
        }
    });
});
</script>

<style>
/* Style Input Bordered (Tetap sama) */
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

/* Style Khusus Summernote agar senada */
.note-editor.note-frame {
    border: 2px solid #dee2e6 !important;
    border-radius: 8px !important;
    box-shadow: none !important;
}
.note-editor.note-frame:focus-within {
    border-color: #0d6efd !important;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15) !important;
}
.note-toolbar {
    background-color: #f8f9fa !important;
    border-bottom: 2px solid #dee2e6 !important;
    border-radius: 8px 8px 0 0;
}
.note-statusbar {
    border-radius: 0 0 8px 8px;
}
</style>
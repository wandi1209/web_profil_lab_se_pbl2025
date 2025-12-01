<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0">Tambah Mahasiswa</h3>
        <a href="<?= $_ENV['APP_URL'] ?>/admin/personil/mahasiswa" class="btn btn-secondary">
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
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="bi bi-person-plus me-2"></i>Form Tambah Mahasiswa</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="<?= $_ENV['APP_URL'] ?>/admin/personil/mahasiswa/store" enctype="multipart/form-data">

                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <!-- Nama -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
                            <input
                                type="text"
                                name="nama"
                                class="form-control input-bordered"
                                placeholder="Masukkan nama lengkap"
                                required>
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                            <input
                                type="email"
                                name="email"
                                class="form-control input-bordered"
                                placeholder="contoh@example.com"
                                required>
                        </div>

                        <!-- NIM -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">NIM</label>
                            <input
                                type="text"
                                name="nidn"
                                class="form-control input-bordered"
                                placeholder="Masukkan NIM">
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="col-md-6">
                        <!-- Keahlian -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Keahlian/Bidang</label>
                            <input
                                type="text"
                                name="keahlian"
                                class="form-control input-bordered"
                                placeholder="Contoh: Web Development, Data Science">
                        </div>

                        <!-- LinkedIn -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">LinkedIn URL</label>
                            <input
                                type="url"
                                name="linkedin"
                                class="form-control input-bordered"
                                placeholder="https://linkedin.com/in/username">
                        </div>

                        <!-- GitHub -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">GitHub URL</label>
                            <input
                                type="url"
                                name="github"
                                class="form-control input-bordered"
                                placeholder="https://github.com/username">
                        </div>
                    </div>
                </div>

                <!-- Foto -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Foto Profil</label>
                    <input
                        type="file"
                        name="foto"
                        class="form-control input-bordered"
                        accept="image/*"
                        id="inputFoto">
                    <small class="text-muted">Format: JPG, PNG, WEBP | Maksimal 2MB | Ukuran disarankan 300x300px</small>

                    <!-- Preview -->
                    <div id="previewContainer" class="mt-3" style="display: none;">
                        <label class="form-label fw-bold">Preview:</label><br>
                        <img id="previewImage" src="" alt="Preview" class="rounded-circle border-preview" style="width: 150px; height: 150px; object-fit: cover;">
                    </div>
                </div>

                <hr class="my-4">

                <!-- Buttons -->
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-2"></i>Simpan
                    </button>
                    <button type="reset" class="btn btn-secondary">
                        <i class="bi bi-arrow-counterclockwise me-2"></i>Reset
                    </button>
                    <a href="<?= $_ENV['APP_URL'] ?>/admin/personil/mahasiswa" class="btn btn-outline-secondary">
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
    padding: 5px !important;
}
</style>

<script>
// Preview foto
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

// Reset preview
document.querySelector('button[type="reset"]').addEventListener('click', function() {
    document.getElementById('previewContainer').style.display = 'none';
});
</script>
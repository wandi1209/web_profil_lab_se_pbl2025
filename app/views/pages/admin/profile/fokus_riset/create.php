<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0">Tambah Fokus Riset</h3>
        <a href="<?= $_ENV['APP_URL'] ?>/admin/profile/fokusRiset" class="btn btn-secondary">
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
            <h5 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Form Tambah Fokus Riset</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="<?= $_ENV['APP_URL'] ?>/admin/profile/fokusRiset/store">

                <!-- Judul -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Judul Fokus Riset <span class="text-danger">*</span></label>
                    <input
                        type="text"
                        name="title"
                        class="form-control input-bordered"
                        placeholder="Contoh: Software Engineering"
                        required>
                </div>

                <!-- Icon -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Icon Bootstrap (Class Name) <span class="text-danger">*</span></label>
                    <input
                        type="text"
                        name="icon"
                        class="form-control input-bordered"
                        placeholder="Contoh: bi-diagram-3-fill"
                        required>
                    <small class="text-muted">Lihat referensi icon di <a href="https://icons.getbootstrap.com/" target="_blank">Bootstrap Icons</a>.</small>
                </div>

                <!-- Deskripsi -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Deskripsi Singkat <span class="text-danger">*</span></label>
                    <textarea
                        name="description"
                        class="form-control input-bordered"
                        rows="4"
                        placeholder="Deskripsi singkat tentang fokus riset ini..."
                        required></textarea>
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
                    <a href="<?= $_ENV['APP_URL'] ?>/admin/profile/fokusRiset" class="btn btn-outline-secondary">
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
</style>
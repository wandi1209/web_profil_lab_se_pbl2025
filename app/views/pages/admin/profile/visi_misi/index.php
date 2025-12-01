<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0">Visi & Misi</h3>
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

    <!-- FORM VISI -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="bi bi-flag me-2"></i>Visi Laboratorium</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="<?= $_ENV['APP_URL'] ?>/admin/profile/visiMisi/updateVisi">
                <div class="mb-3">
                    <label class="form-label fw-bold">Visi <span class="text-danger">*</span></label>
                    <textarea 
                        name="visi" 
                        class="form-control input-bordered" 
                        rows="4" 
                        placeholder="Masukkan visi laboratorium..."
                        required><?= htmlspecialchars($visi ?? '') ?></textarea>
                    <small class="text-muted">Visi tidak boleh kosong</small>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i>Simpan Visi
                </button>
            </form>
        </div>
    </div>

    <!-- FORM TAMBAH MISI -->
    <div class="card mb-4">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0"><i class="bi bi-list-task me-2"></i>Tambah Misi Baru</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="<?= $_ENV['APP_URL'] ?>/admin/profile/visiMisi/addMisi">
                <div class="mb-3">
                    <label class="form-label fw-bold">Misi <span class="text-danger">*</span></label>
                    <textarea 
                        name="misi" 
                        class="form-control input-bordered" 
                        rows="3" 
                        placeholder="Masukkan poin misi..."
                        required></textarea>
                    <small class="text-muted">Misi tidak boleh kosong</small>
                </div>
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Misi
                </button>
            </form>
        </div>
    </div>

    <!-- DAFTAR MISI -->
    <div class="card">
        <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-card-checklist me-2"></i>Daftar Misi</h5>
            <span class="badge bg-light text-dark"><?= count($listMisi ?? []) ?> Misi</span>
        </div>
        <div class="card-body">
            <?php if (!empty($listMisi)): ?>
                <div class="list-group">
                    <?php $no = 1; foreach ($listMisi as $misi): ?>
                    <div class="list-group-item">
                        <div class="d-flex align-items-start">
                            <div class="flex-shrink-0 me-3">
                                <span class="badge bg-primary rounded-circle" style="width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;">
                                    <?= $no++ ?>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <p class="mb-2"><?= nl2br(htmlspecialchars($misi['konten'])) ?></p>
                            </div>
                            <div class="flex-shrink-0 ms-3">
                                <button 
                                    type="button" 
                                    class="btn btn-warning btn-sm me-1" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editModal<?= $misi['id'] ?>">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button 
                                    type="button" 
                                    class="btn btn-danger btn-sm"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteModal<?= $misi['id'] ?>">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="editModal<?= $misi['id'] ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" action="<?= $_ENV['APP_URL'] ?>/admin/profile/visiMisi/updateMisi">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Misi #<?= $no - 1 ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="id" value="<?= $misi['id'] ?>">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Misi <span class="text-danger">*</span></label>
                                            <textarea 
                                                name="misi" 
                                                class="form-control input-bordered" 
                                                rows="4" 
                                                required><?= htmlspecialchars($misi['konten']) ?></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-save me-1"></i>Simpan Perubahan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Delete Confirmation -->
                    <div class="modal fade" id="deleteModal<?= $misi['id'] ?>" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title">
                                        <i class="bi bi-exclamation-triangle me-2"></i>Konfirmasi Hapus
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center mb-3">
                                        <i class="bi bi-trash" style="font-size: 3rem; color: #dc3545;"></i>
                                    </div>
                                    <p class="text-center mb-3">Apakah Anda yakin ingin menghapus misi berikut?</p>
                                    <div class="alert alert-warning">
                                        <strong>Misi #<?= $no - 1 ?>:</strong><br>
                                        <?= nl2br(htmlspecialchars(substr($misi['konten'], 0, 100))) ?>
                                        <?= strlen($misi['konten']) > 100 ? '...' : '' ?>
                                    </div>
                                    <p class="text-danger text-center mb-0">
                                        <small><i class="bi bi-info-circle me-1"></i>Data yang dihapus tidak dapat dikembalikan!</small>
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        <i class="bi bi-x-circle me-1"></i>Batal
                                    </button>
                                    <form method="POST" action="<?= $_ENV['APP_URL'] ?>/admin/profile/visiMisi/deleteMisi" style="display:inline;">
                                        <input type="hidden" name="id" value="<?= $misi['id'] ?>">
                                        <button type="submit" class="btn btn-danger">
                                            <i class="bi bi-trash me-1"></i>Ya, Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-5">
                    <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                    <p class="text-muted mt-3">Belum ada misi. Silakan tambahkan misi baru.</p>
                </div>
            <?php endif; ?>
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

/* Textarea specific */
textarea.input-bordered {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: 0.95rem;
    line-height: 1.6;
}

/* List Group */
.list-group-item {
    border-left: 3px solid #0d6efd;
    transition: all 0.3s ease;
}

.list-group-item:hover {
    background-color: #f8f9fa;
    border-left-color: #0a58ca;
}

/* Modal */
.modal-content {
    border: none;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
}

.modal-header.bg-danger {
    border-bottom: none;
}

/* Alert */
.alert-warning {
    background-color: #fff3cd;
    border-color: #ffc107;
    border-left: 4px solid #ffc107;
}

/* Card */
.card {
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    border: 1px solid #e0e0e0;
}

.card-header {
    border-bottom: 2px solid rgba(255,255,255,0.2);
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
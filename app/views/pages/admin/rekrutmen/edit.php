<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0">Update Status Pendaftar</h3>
        <a href="<?= $_ENV['APP_URL'] ?>/admin/rekrutmen" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Form Update Status</h5>
                </div>
                <div class="card-body">

                    <!-- Info Pendaftar (Read Only) -->
                    <div class="bg-light p-3 rounded mb-4">
                        <h6 class="fw-bold mb-3">Informasi Pendaftar:</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-2"><strong>Nama:</strong> <?= htmlspecialchars($pendaftar['nama']) ?></p>
                                <p class="mb-2"><strong>NIM:</strong> <?= htmlspecialchars($pendaftar['nim']) ?></p>
                                <p class="mb-2"><strong>Angkatan:</strong> <?= htmlspecialchars($pendaftar['angkatan'] ?? '-') ?></p>
                                <p class="mb-2"><strong>Peminatan:</strong> <?= htmlspecialchars($pendaftar['peminatan'] ?? '-') ?></p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2"><strong>Prodi:</strong> <?= htmlspecialchars($pendaftar['program_studi']) ?></p>
                                <p class="mb-2"><strong>Email:</strong> <?= htmlspecialchars($pendaftar['email']) ?></p>
                                <p class="mb-2"><strong>HP:</strong> <?= htmlspecialchars($pendaftar['no_hp'] ?? '-') ?></p>
                                <p class="mb-2"><strong>Keahlian:</strong> <?= htmlspecialchars($pendaftar['keahlian'] ?? '-') ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Form Update Status -->
                    <form method="POST" action="<?= $_ENV['APP_URL'] ?>/admin/rekrutmen/updateStatus">
                        <input type="hidden" name="id" value="<?= $pendaftar['id'] ?>">

                        <div class="mb-4">
                            <label class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-select input-bordered" required>
                                <option value="Pending" <?= $pendaftar['status'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="Diterima" <?= $pendaftar['status'] === 'Diterima' ? 'selected' : '' ?>>Diterima</option>
                                <option value="Ditolak" <?= $pendaftar['status'] === 'Ditolak' ? 'selected' : '' ?>>Ditolak</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Catatan/Keterangan</label>
                            <textarea
                                name="catatan"
                                class="form-control input-bordered"
                                rows="5"
                                placeholder="Tambahkan catatan (opsional)..."><?= htmlspecialchars($pendaftar['catatan'] ?? '') ?></textarea>
                            <small class="text-muted">Catatan akan terlihat di detail pendaftar</small>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>Simpan Perubahan
                            </button>
                            <a href="<?= $_ENV['APP_URL'] ?>/admin/rekrutmen/detail?id=<?= $pendaftar['id'] ?>" class="btn btn-info">
                                <i class="bi bi-eye me-2"></i>Lihat Detail
                            </a>
                            <a href="<?= $_ENV['APP_URL'] ?>/admin/rekrutmen" class="btn btn-secondary">
                                <i class="bi bi-x-circle me-2"></i>Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h6 class="mb-0"><i class="bi bi-info-circle me-2"></i>Panduan Status</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <span class="badge bg-warning mb-2">Pending</span>
                        <p class="small mb-0">Pendaftaran sedang diproses/ditinjau</p>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <span class="badge bg-success mb-2">Diterima</span>
                        <p class="small mb-0">Pendaftar diterima menjadi anggota</p>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <span class="badge bg-danger mb-2">Ditolak</span>
                        <p class="small mb-0">Pendaftaran ditolak dengan alasan tertentu</p>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header bg-light">
                    <h6 class="mb-0"><i class="bi bi-file-text me-2"></i>Alasan Bergabung</h6>
                </div>
                <div class="card-body">
                    <p class="small"><?= nl2br(htmlspecialchars($pendaftar['alasan'])) ?></p>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
.input-bordered { border: 2px solid #dee2e6 !important; border-radius: 8px !important; padding: 10px 15px !important; transition: all 0.3s ease !important; }
.input-bordered:focus { border-color: #0d6efd !important; box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15) !important; outline: none !important; }
.input-bordered:hover { border-color: #adb5bd !important; }
.card { box-shadow: 0 2px 4px rgba(0,0,0,0.1); border: 1px solid #e0e0e0; }
</style>

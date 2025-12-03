<div class="container-fluid">
    <h3 class="fw-bold mb-4">Permintaan Reset Password</h3>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= $_SESSION['success']; unset($_SESSION['success']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Tanggal Request</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($requests)): ?>
                            <tr><td colspan="4" class="text-center py-4">Tidak ada permintaan pending.</td></tr>
                        <?php else: ?>
                            <?php foreach ($requests as $req): ?>
                            <tr>
                                <td><?= date('d M Y H:i', strtotime($req['created_at'])) ?></td>
                                <td class="fw-bold"><?= htmlspecialchars($req['username']) ?></td>
                                <td><span class="badge bg-info"><?= htmlspecialchars($req['role_name']) ?></span></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#approveModal<?= $req['id'] ?>">
                                        <i class="bi bi-check-circle"></i> Setujui & Reset
                                    </button>
                                    
                                    <form action="<?= $_ENV['APP_URL'] ?>/admin/reset-requests/reject" method="POST" class="d-inline">
                                        <input type="hidden" name="request_id" value="<?= $req['id'] ?>">
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tolak permintaan ini?')">
                                            <i class="bi bi-x-circle"></i> Tolak
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal Approve -->
                            <div class="modal fade" id="approveModal<?= $req['id'] ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="<?= $_ENV['APP_URL'] ?>/admin/reset-requests/approve" method="POST">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Reset Password: <?= htmlspecialchars($req['username']) ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="request_id" value="<?= $req['id'] ?>">
                                                <div class="mb-3">
                                                    <label class="form-label">Masukkan Password Baru</label>
                                                    <input type="text" name="new_password" class="form-control" placeholder="Contoh: LabSE2025!" required>
                                                    <small class="text-muted">Password ini harus Anda berikan manual kepada user.</small>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan Password Baru</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
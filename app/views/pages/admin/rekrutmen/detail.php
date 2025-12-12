<?php
// AMBIL ROLE USER DARI SESSION
$userRole = $_SESSION['role_id'] ?? 2; 
$isSuperAdmin = ($userRole === 1);
?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0">Detail Pendaftar</h3>
        <a href="<?= $_ENV['APP_URL'] ?>/admin/rekrutmen" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Kembali
        </a>
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

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="bi bi-person-badge me-2"></i>Informasi Pendaftar</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="30%">Nama Lengkap</th>
                            <td>: <?= htmlspecialchars($pendaftar['nama']) ?></td>
                        </tr>
                        <tr>
                            <th>NIM</th>
                            <td>: <?= htmlspecialchars($pendaftar['nim']) ?></td>
                        </tr>
                        <tr>
                            <th>Peminatan</th>
                            <td>: <?= htmlspecialchars($pendaftar['peminatan'] ?? '-') ?></td>
                        </tr>
                        <tr>
                            <th>Keahlian</th>
                            <td>: <?= htmlspecialchars($pendaftar['keahlian'] ?? '-') ?></td>
                        </tr>
                        <tr>
                            <th>Angkatan</th>
                            <td>: <?= htmlspecialchars($pendaftar['angkatan'] ?? '-') ?></td>
                        </tr>
                        <tr>
                            <th>Program Studi</th>
                            <td>: <?= htmlspecialchars($pendaftar['program_studi']) ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>: <?= htmlspecialchars($pendaftar['email']) ?></td>
                        </tr>
                        <tr>
                            <th>No. HP</th>
                            <td>: <?= htmlspecialchars($pendaftar['no_hp']) ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal Daftar</th>
                            <td>: <?= date('d F Y H:i', strtotime($pendaftar['created_at'])) ?></td>
                        </tr>
                    </table>

                    <hr>

                    <h6 class="fw-bold mb-3">Alasan Bergabung:</h6>
                    <div class="bg-light p-3 rounded">
                        <?= nl2br(htmlspecialchars($pendaftar['alasan'])) ?>
                    </div>

                    <?php if (!empty($pendaftar['catatan'])): ?>
                    <hr>
                    <h6 class="fw-bold mb-3">Catatan Admin:</h6>
                    <div class="alert alert-info">
                        <?= nl2br(htmlspecialchars($pendaftar['catatan'])) ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="bi bi-clipboard-check me-2"></i>Status</h5>
                </div>
                <div class="card-body">
                    <?php
                    $badgeClass = '';
                    $iconClass = '';
                    switch($pendaftar['status']) {
                        case 'Diterima':
                            $badgeClass = 'bg-success';
                            $iconClass = 'bi-check-circle';
                            break;
                        case 'Ditolak':
                            $badgeClass = 'bg-danger';
                            $iconClass = 'bi-x-circle';
                            break;
                        default:
                            $badgeClass = 'bg-warning text-dark';
                            $iconClass = 'bi-clock-history';
                    }
                    ?>

                    <div class="text-center mb-4">
                        <i class="bi <?= $iconClass ?> text-muted" style="font-size: 4rem;"></i>
                        <h4 class="mt-3">
                            <span class="badge <?= $badgeClass ?>">
                                <?= htmlspecialchars($pendaftar['status']) ?>
                            </span>
                        </h4>
                    </div>

                    <div class="d-grid gap-2">
                        <?php if ($pendaftar['status'] !== 'Diterima' || $isSuperAdmin): ?>
                            <a href="<?= $_ENV['APP_URL'] ?>/admin/rekrutmen/edit?id=<?= $pendaftar['id'] ?>" 
                            class="btn btn-primary">
                                <i class="bi bi-pencil-square me-2"></i>Update Status
                            </a>
                        <?php else: ?>
                            <div class="alert alert-warning text-center p-2 mb-2 small">
                                <i class="bi bi-lock-fill"></i> Status DITERIMA terkunci.
                            </div>
                            <button class="btn btn-secondary" disabled>
                                <i class="bi bi-lock-fill me-2"></i>Update Status (Terkunci)
                            </button>
                        <?php endif; ?>

                        <?php if ($pendaftar['status'] !== 'Diterima' || $isSuperAdmin): ?>
                            <button onclick="deletePendaftar(<?= $pendaftar['id'] ?>)" 
                                    class="btn btn-danger">
                                <i class="bi bi-trash me-2"></i>Hapus Data
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <?php if (!empty($pendaftar['updated_at']) && $pendaftar['updated_at'] !== $pendaftar['created_at']): ?>
            <div class="card mt-3">
                <div class="card-body">
                    <small class="text-muted">
                        <i class="bi bi-clock me-1"></i>Terakhir diupdate:<br>
                        <?= date('d F Y H:i', strtotime($pendaftar['updated_at'])) ?>
                    </small>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function deletePendaftar(id) {
    Swal.fire({
        title: "Hapus data pendaftar?",
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Ya, hapus!",
        cancelButtonText: "Batal"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?= $_ENV['APP_URL'] ?>/admin/rekrutmen/delete?id=" + id;
        }
    });
}
</script>
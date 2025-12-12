<?php
// AMBIL ROLE USER DARI SESSION
// Sesuaikan key 'user' dan 'role' dengan cara login kamu menyimpan session
$userRole = $_SESSION['role_id'] ?? 2; 
$isSuperAdmin = ($userRole === 1);
?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0">Rekrutmen Anggota</h3>
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

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-start border-4 border-primary h-100">
                <div class="card-body">
                    <div class="text-muted small text-uppercase fw-bold mb-1">Total Pendaftar</div>
                    <div class="h3 mb-0 text-primary fw-bold"><?= $stats['total'] ?? 0 ?></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-start border-4 border-warning h-100">
                <div class="card-body">
                    <div class="text-muted small text-uppercase fw-bold mb-1">Pending</div>
                    <div class="h3 mb-0 text-warning fw-bold"><?= $stats['pending'] ?? 0 ?></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-start border-4 border-success h-100">
                <div class="card-body">
                    <div class="text-muted small text-uppercase fw-bold mb-1">Diterima</div>
                    <div class="h3 mb-0 text-success fw-bold"><?= $stats['diterima'] ?? 0 ?></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-start border-4 border-danger h-100">
                <div class="card-body">
                    <div class="text-muted small text-uppercase fw-bold mb-1">Ditolak</div>
                    <div class="h3 mb-0 text-danger fw-bold"><?= $stats['ditolak'] ?? 0 ?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-white py-3 border-0">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <h5 class="mb-0 fw-bold text-dark">Data Pendaftar</h5>
                
                <div class="input-group" style="max-width: 300px;">
                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" id="searchInput" class="form-control bg-light border-start-0" placeholder="Cari nama atau NIM...">
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="pendaftarTable">
                    <thead class="table-light">
                        <tr>
                            <th width="5%" class="ps-4">No</th>
                            <th width="20%">Nama & NIM</th>
                            <th width="15%">Prodi</th>
                            <th width="20%">Kontak</th>
                            <th width="10%">Status</th>
                            <th width="15%">Tanggal Daftar</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($dataPendaftar)): ?>
                        <?php $no = 1; foreach ($dataPendaftar as $row): ?>
                        <tr>
                            <td class="ps-4"><?= $no++ ?></td>
                            <td>
                                <div class="fw-bold text-dark"><?= htmlspecialchars($row['nama']) ?></div>
                                <div class="text-muted small font-monospace"><?= htmlspecialchars($row['nim']) ?></div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border">
                                    <?= htmlspecialchars($row['program_studi']) ?>
                                </span>
                            </td>
                            <td>
                                <div class="small">
                                    <i class="bi bi-envelope me-1 text-muted"></i> <?= htmlspecialchars($row['email']) ?><br>
                                    <i class="bi bi-whatsapp me-1 text-success"></i> <?= htmlspecialchars($row['no_hp']) ?>
                                </div>
                            </td>
                            <td>
                                <?php
                                $badgeClass = match($row['status']) {
                                    'Diterima' => 'bg-success',
                                    'Ditolak' => 'bg-danger',
                                    default => 'bg-warning text-dark'
                                };
                                ?>
                                <span class="badge <?= $badgeClass ?> rounded-pill">
                                    <?= htmlspecialchars($row['status']) ?>
                                </span>
                            </td>
                            <td>
                                <small class="text-muted">
                                    <?= date('d M Y, H:i', strtotime($row['created_at'])) ?>
                                </small>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <a href="<?= $_ENV['APP_URL'] ?>/admin/rekrutmen/detail?id=<?= $row['id'] ?>" 
                                    class="btn btn-outline-primary"
                                    title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <?php if ($row['status'] !== 'Diterima' || $isSuperAdmin): ?>
                                        <a href="<?= $_ENV['APP_URL'] ?>/admin/rekrutmen/edit?id=<?= $row['id'] ?>" 
                                        class="btn btn-outline-warning"
                                        title="Update Status">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    <?php else: ?>
                                        <button class="btn btn-outline-secondary" disabled title="Terkunci (Diterima)">
                                            <i class="bi bi-lock-fill"></i>
                                        </button>
                                    <?php endif; ?>
                                    <?php if ($row['status'] !== 'Diterima' || $isSuperAdmin): ?>
                                        <button onclick="deletePendaftar(<?= $row['id'] ?>)" 
                                                class="btn btn-outline-danger"
                                                title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    <?php else: ?>
                                        <button class="btn btn-outline-secondary" disabled>
                                            <i class="bi bi-slash-circle"></i>
                                        </button>
                                    <?php endif; ?>
                                    
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted py-5">
                                <i class="bi bi-inbox fs-1 d-block mb-2 opacity-50"></i>
                                <p class="m-0">Belum ada pendaftar baru</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// Search function
document.getElementById('searchInput').addEventListener('keyup', function() {
    const searchValue = this.value.toLowerCase();
    const table = document.getElementById('pendaftarTable');
    const rows = table.getElementsByTagName('tr');

    for (let i = 1; i < rows.length; i++) {
        const row = rows[i];
        const text = row.textContent.toLowerCase();
        
        if (text.includes(searchValue)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    }
});

// Delete function
function deletePendaftar(id) {
    Swal.fire({
        title: "Yakin hapus data?",
        text: "Data pendaftar ini akan dihapus permanen!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#dc3545",
        cancelButtonColor: "#6c757d",
        confirmButtonText: "Ya, Hapus!",
        cancelButtonText: "Batal"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?= $_ENV['APP_URL'] ?>/admin/rekrutmen/delete?id=" + id;
        }
    });
}
</script>
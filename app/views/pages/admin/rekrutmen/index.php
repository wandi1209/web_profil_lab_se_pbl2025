<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0">Rekrutmen Anggota</h3>

        <!-- Search -->
        <div class="input-group search-box" style="max-width: 260px;">
            <input type="text" id="searchInput" class="form-control" placeholder="Search">
            <span class="input-group-text"><i class="bi bi-search"></i></span>
        </div>
    </div>

    <!-- Alert Messages -->
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

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-primary">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Total Pendaftar</h6>
                    <h3 class="mb-0 text-primary"><?= $stats['total'] ?? 0 ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-warning">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Pending</h6>
                    <h3 class="mb-0 text-warning"><?= $stats['pending'] ?? 0 ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-success">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Diterima</h6>
                    <h3 class="mb-0 text-success"><?= $stats['diterima'] ?? 0 ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-danger">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Ditolak</h6>
                    <h3 class="mb-0 text-danger"><?= $stats['ditolak'] ?? 0 ?></h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel -->
    <div class="table-responsive mb-5">
        <table class="table table-bordered table-hover align-middle" id="pendaftarTable">
            <thead class="table-light">
                <tr>
                    <th width="5%">No</th>
                    <th width="15%">Nama</th>
                    <th width="10%">NIM</th>
                    <th width="10%">Kelas</th>
                    <th width="15%">Program Studi</th>
                    <th width="10%">Kontak</th>
                    <th width="10%">Status</th>
                    <th width="10%">Tanggal</th>
                    <th width="15%" class="text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
            <?php if (!empty($dataPendaftar)): ?>
                <?php $no = 1; foreach ($dataPendaftar as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($row['nama']) ?></td>
                    <td><?= htmlspecialchars($row['nim']) ?></td>
                    <td><?= htmlspecialchars($row['kelas']) ?></td>
                    <td><?= htmlspecialchars($row['program_studi']) ?></td>
                    <td>
                        <small>
                            <?= htmlspecialchars($row['email']) ?><br>
                            <?= htmlspecialchars($row['no_hp']) ?>
                        </small>
                    </td>
                    <td>
                        <?php
                        $badgeClass = '';
                        switch($row['status']) {
                            case 'Diterima':
                                $badgeClass = 'bg-success';
                                break;
                            case 'Ditolak':
                                $badgeClass = 'bg-danger';
                                break;
                            default:
                                $badgeClass = 'bg-warning';
                        }
                        ?>
                        <span class="badge <?= $badgeClass ?>">
                            <?= htmlspecialchars($row['status']) ?>
                        </span>
                    </td>
                    <td><?= date('d/m/Y', strtotime($row['created_at'])) ?></td>
                    <td class="text-center">
                        <!-- Detail -->
                        <a href="<?= $_ENV['APP_URL'] ?>/admin/rekrutmen/detail?id=<?= $row['id'] ?>" 
                           class="btn btn-info btn-sm mb-1"
                           title="Detail">
                            <i class="bi bi-eye"></i>
                        </a>

                        <!-- Edit Status -->
                        <a href="<?= $_ENV['APP_URL'] ?>/admin/rekrutmen/edit?id=<?= $row['id'] ?>" 
                           class="btn btn-warning btn-sm mb-1"
                           title="Update Status">
                            <i class="bi bi-pencil-square"></i>
                        </a>

                        <!-- Delete -->
                        <button onclick="deletePendaftar(<?= $row['id'] ?>)" 
                                class="btn btn-danger btn-sm mb-1"
                                title="Hapus">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9" class="text-center text-muted py-4">
                        <i class="bi bi-inbox" style="font-size: 3rem;"></i>
                        <p class="mt-2">Belum ada data pendaftar</p>
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
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
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0">Daftar Dosen</h3>

        <!-- Search -->
        <div class="input-group search-box" style="max-width: 260px;">
            <input type="text" id="searchInput" class="form-control input-bordered" placeholder="Cari dosen...">
            <span class="input-group-text"><i class="bi bi-search"></i></span>
        </div>
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

    <!-- Tombol Tambah -->
    <div class="mb-3">
        <a href="<?= $_ENV['APP_URL'] ?>/admin/personil/createDosen" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Tambah Dosen
        </a>
    </div>

    <!-- Tabel -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width:60px;">No</th>
                            <th style="width:100px;">Foto</th>
                            <th>Nama</th>
                            <th>Posisi</th>
                            <th>Email</th>
                            <th style="width:160px;" class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php if (!empty($dataDosen)): ?>
                        <?php $no = 1; foreach ($dataDosen as $row): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td>
                                <?php if (!empty($row['foto_url'])): ?>
                                    <img src="<?= $_ENV['APP_URL'] . '/public' . $row['foto_url'] ?>"
                                         alt="<?= htmlspecialchars($row['nama']) ?>"
                                         class="rounded"
                                         style="width: 60px; height: 60px; object-fit: cover;">
                                <?php else: ?>
                                    <div class="bg-secondary rounded d-flex align-items-center justify-content-center" 
                                         style="width: 60px; height: 60px;">
                                        <i class="bi bi-person text-white" style="font-size: 1.5rem;"></i>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <strong><?= htmlspecialchars($row['nama']) ?></strong>
                                <?php if (!empty($row['nidn'])): ?>
                                    <br><small class="text-muted">NIP: <?= htmlspecialchars($row['nidn']) ?></small>
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($row['position']) ?></td>
                            <td>
                                <a href="mailto:<?= htmlspecialchars($row['email']) ?>">
                                    <?= htmlspecialchars($row['email']) ?>
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="<?= $_ENV['APP_URL'] ?>/admin/personil/dosen/edit?id=<?= $row['id'] ?>" 
                                   class="btn btn-warning btn-sm" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <button onclick="deleteDosen(<?= $row['id'] ?>)" 
                                        class="btn btn-danger btn-sm" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="bi bi-inbox" style="font-size: 3rem;"></i>
                                <p class="mt-2">Belum ada data dosen</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<style>
.input-bordered {
    border: 2px solid #dee2e6 !important;
    border-radius: 8px !important;
    padding: 8px 12px !important;
}

.input-bordered:focus {
    border-color: #0d6efd !important;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15) !important;
}

.card {
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    border: 1px solid #e0e0e0;
}

.table th {
    font-weight: 600;
    color: #495057;
}
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function deleteDosen(id) {
    Swal.fire({
        title: "Yakin menghapus data?",
        text: "Data dosen akan dihapus permanen!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Ya, hapus!",
        cancelButtonText: "Batal"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?= $_ENV['APP_URL'] ?>/admin/personil/dosen/delete?id=" + id;
        }
    });
}

// Search functionality
document.getElementById('searchInput').addEventListener('keyup', function() {
    const searchText = this.value.toLowerCase();
    const tableRows = document.querySelectorAll('tbody tr');
    
    tableRows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchText) ? '' : 'none';
    });
});
</script>


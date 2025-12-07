<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0">Fokus Riset</h3>
        <a href="<?= $_ENV['APP_URL'] ?>/admin/profile/fokusRiset/create" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Tambah Baru
        </a>
    </div>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $_SESSION['success']; unset($_SESSION['success']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">#</th>
                            <th width="10%" class="text-center">Icon</th>
                            <th width="25%">Judul</th>
                            <th width="45%">Deskripsi</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (empty($fokus)): ?>
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                Belum ada data fokus riset
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php $no = 1; foreach ($fokus as $item): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td class="text-center">
                                <div class="bg-light border rounded p-2 d-inline-block">
                                    <i class="bi <?= htmlspecialchars($item['icon']) ?> fs-4 text-primary"></i>
                                </div>
                            </td>
                            <td>
                                <strong class="text-dark"><?= htmlspecialchars($item['title']) ?></strong>
                            </td>
                            <td>
                                <span class="d-inline-block text-secondary" style="max-width: 400px;">
                                    <?= htmlspecialchars($item['description']) ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="<?= $_ENV['APP_URL'] ?>/admin/profile/fokusRiset/edit?id=<?= $item['id'] ?>" 
                                   class="btn btn-sm btn-warning me-1"
                                   title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <button onclick="deleteFokus(<?= $item['id'] ?>)" 
                                        class="btn btn-sm btn-danger"
                                        title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function deleteFokus(id) {
    Swal.fire({
        title: "Yakin hapus data?",
        text: "Data fokus riset ini akan dihapus permanen!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#dc3545", // Merah
        cancelButtonColor: "#6c757d",  // Abu-abu
        confirmButtonText: "Ya, Hapus!",
        cancelButtonText: "Batal"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?= $_ENV['APP_URL'] ?>/admin/profile/fokusRiset/delete?id=" + id;
        }
    });
}
</script>
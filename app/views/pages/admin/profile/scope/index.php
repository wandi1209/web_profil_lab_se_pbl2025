<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0">Scope Penelitian</h3>
        <a href="<?= $_ENV['APP_URL'] ?>/admin/scope/create" class="btn btn-primary">
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
                            <th width="20%">Kategori</th>
                            <th width="15%">Icon</th>
                            <th width="35%">Deskripsi</th>
                            <th width="15%">Tags</th>
                            <th width="10%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (empty($dataScopePenelitian)): ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                Belum ada data scope penelitian
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php 
                        $scopeModel = new \Polinema\WebProfilLabSe\Models\Scope();
                        $no = 1; 
                        foreach ($dataScopePenelitian as $row): 
                            $tags = $scopeModel->parseTags($row['tags']);
                            
                            // Tentukan tampilan Icon (Bootstrap Class atau Text Upload)
                            $iconDisplay = '';
                            if (!empty($row['icon_bootstrap'])) {
                                $iconDisplay = '<i class="bi ' . htmlspecialchars($row['icon_bootstrap']) . ' fs-4 text-primary"></i> <small class="text-muted d-block" style="font-size:0.7em">' . htmlspecialchars($row['icon_bootstrap']) . '</small>';
                            } elseif (!empty($row['icon_url'])) {
                                // Jika Anda masih mendukung upload (opsional, jika sudah dihapus hiraukan)
                                $iconDisplay = '<span class="badge bg-info text-dark">Uploaded Image</span>';
                            } else {
                                $iconDisplay = '<span class="text-muted">-</span>';
                            }
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td>
                                <strong><?= htmlspecialchars($row['kategori']) ?></strong>
                            </td>
                            <td>
                                <?= $iconDisplay ?>
                            </td>
                            <td>
                                <span class="d-inline-block text-truncate" style="max-width: 300px;" title="<?= htmlspecialchars($row['deskripsi']) ?>">
                                    <?= htmlspecialchars($row['deskripsi']) ?>
                                </span>
                            </td>
                            <td>
                                <?php if (!empty($tags)): ?>
                                    <div class="d-flex flex-wrap gap-1">
                                        <?php foreach ($tags as $tag): ?>
                                            <span class="badge bg-light text-dark border"><?= htmlspecialchars($tag) ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                <?php else: ?>
                                    <span class="text-muted small">-</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <a href="<?= $_ENV['APP_URL'] ?>/admin/scope/edit?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning me-1">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button onclick="deleteScope(<?= $row['id'] ?>)" class="btn btn-sm btn-danger">
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
function deleteScope(id) {
    Swal.fire({
        title: "Yakin hapus data?",
        text: "Data scope ini akan dihapus permanen!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#dc3545", // Warna merah bootstrap danger
        cancelButtonColor: "#6c757d",  // Warna abu bootstrap secondary
        confirmButtonText: "Ya, Hapus!",
        cancelButtonText: "Batal"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?= $_ENV['APP_URL'] ?>/admin/scope/delete?id=" + id;
        }
    });
}
</script>
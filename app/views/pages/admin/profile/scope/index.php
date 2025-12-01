<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0">Scope Penelitian</h3>
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

    <!-- Tombol Tambah -->
    <div class="mb-3">
        <a href="<?= $_ENV['APP_URL'] ?>/admin/scope/create" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Tambah Data
        </a>
    </div>

    <!-- Tabel -->
    <div class="table-responsive mb-5">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th width="5%">No</th>
                    <th width="10%">Icon</th>
                    <th width="20%">Kategori</th>
                    <th width="35%">Deskripsi</th>
                    <th width="20%">Tags</th>
                    <th width="10%" class="text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
            <?php if (!empty($dataScopePenelitian)): ?>
                <?php 
                $scopeModel = new \Polinema\WebProfilLabSe\Models\Scope();
                $no = 1; 
                foreach ($dataScopePenelitian as $row): 
                    $tags = $scopeModel->parseTags($row['tags']);
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td>
                        <?php if (!empty($row['icon_url'])): ?>
                            <img src="<?= $_ENV['APP_URL'] . $row['icon_url'] ?>"
                                 alt="Icon"
                                 class="img-thumbnail"
                                 style="width: 50px; height: 50px; object-fit: contain;">
                        <?php else: ?>
                            <div class="bg-light d-flex align-items-center justify-content-center rounded"
                                 style="width: 50px; height: 50px;">
                                <i class="bi bi-image text-muted"></i>
                            </div>
                        <?php endif; ?>
                    </td>
                    <td>
                        <strong><?= htmlspecialchars($row['kategori']) ?></strong>
                    </td>
                    <td><?= htmlspecialchars($row['deskripsi']) ?></td>
                    <td>
                        <?php if (!empty($tags)): ?>
                            <?php foreach ($tags as $tag): ?>
                                <span class="badge bg-secondary me-1 mb-1"><?= htmlspecialchars($tag) ?></span>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <span class="text-muted">-</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <a href="<?= $_ENV['APP_URL'] ?>/admin/scope/edit?id=<?= $row['id'] ?>" 
                           class="btn btn-warning btn-sm"
                           title="Edit">
                            <i class="bi bi-pencil"></i>
                        </a>

                        <button onclick="deleteScope(<?= $row['id'] ?>)" 
                                class="btn btn-danger btn-sm"
                                title="Hapus">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>

            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">
                        <i class="bi bi-inbox" style="font-size: 3rem;"></i>
                        <p class="mt-2">Belum ada data scope penelitian</p>
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function deleteScope(id) {
    Swal.fire({
        title: "Hapus data?",
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Ya, hapus!",
        cancelButtonText: "Batal"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?= $_ENV['APP_URL'] ?>/admin/scope/delete?id=" + id;
        }
    });
}
</script>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0">Kelola Album</h3>
        <a href="<?= $_ENV['APP_URL'] ?>/admin/album/create" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Tambah Album
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

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">Foto</th>
                            <th width="20%">Judul</th>
                            <th width="30%">Deskripsi</th>
                            <th width="10%">Kategori</th>
                            <th width="10%">Tanggal</th>
                            <th width="10%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($dataAlbum)): ?>
                            <?php $no = 1; foreach ($dataAlbum as $row): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <?php if (!empty($row['foto_url'])): ?>
                                        <img src="<?= $_ENV['APP_URL']. '/public' . $row['foto_url'] ?>"
                                             alt="<?= htmlspecialchars($row['judul']) ?>"
                                             class="img-thumbnail shadow-sm"
                                             style="width: 80px; height: 80px; object-fit: cover;">
                                    <?php else: ?>
                                        <div class="bg-light border rounded d-flex align-items-center justify-content-center text-muted"
                                             style="width: 80px; height: 80px;">
                                            <i class="bi bi-image fs-4"></i>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="fw-bold text-dark"><?= htmlspecialchars($row['judul']) ?></span>
                                </td>
                                <td>
                                    <span class="d-inline-block text-secondary text-truncate" style="max-width: 250px;">
                                        <?= htmlspecialchars($row['deskripsi'] ?? '-') ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-info text-dark">
                                        <?= ucfirst($row['kategori']) ?>
                                    </span>
                                </td>
                                <td>
                                    <small class="text-muted">
                                        <i class="bi bi-calendar3 me-1"></i>
                                        <?= date('d/m/Y', strtotime($row['created_at'])) ?>
                                    </small>
                                </td>
                                <td class="text-center">
                                    <a href="<?= $_ENV['APP_URL'] ?>/admin/album/edit?id=<?= $row['id'] ?>"
                                       class="btn btn-warning btn-sm me-1"
                                       title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <button onclick="deleteAlbum(<?= $row['id'] ?>)"
                                            class="btn btn-danger btn-sm"
                                            title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted py-5">
                                    <i class="bi bi-images fs-1 d-block mb-2 opacity-50"></i>
                                    <p class="m-0">Belum ada data album</p>
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
function deleteAlbum(id) {
    Swal.fire({
        title: "Yakin hapus album?",
        text: "Data album beserta fotonya akan dihapus permanen!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#dc3545", // Merah
        cancelButtonColor: "#6c757d",  // Abu-abu
        confirmButtonText: "Ya, Hapus!",
        cancelButtonText: "Batal"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?= $_ENV['APP_URL'] ?>/admin/album/delete?id=" + id;
        }
    });
}
</script>
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0">Kelola Album</h3>
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
        <a href="<?= $_ENV['APP_URL'] ?>/admin/album/create" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Tambah Album
        </a>
    </div>

    <!-- Tabel -->
    <div class="table-responsive mb-5">
        <table class="table table-bordered table-hover align-middle">
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
                                     class="img-thumbnail"
                                     style="max-width: 100px; max-height: 100px; object-fit: cover;">
                            <?php else: ?>
                                <div class="bg-secondary d-flex align-items-center justify-content-center"
                                     style="width: 100px; height: 100px;">
                                    <i class="bi bi-image text-white" style="font-size: 2rem;"></i>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($row['judul']) ?></td>
                        <td><?= htmlspecialchars($row['deskripsi'] ?? '-') ?></td>
                        <td>
                            <span class="badge bg-info">
                                <?= ucfirst($row['kategori']) ?>
                            </span>
                        </td>
                        <td><?= date('d/m/Y', strtotime($row['created_at'])) ?></td>
                        <td class="text-center">
                            <a href="<?= $_ENV['APP_URL'] ?>/admin/album/edit?id=<?= $row['id'] ?>"
                               class="btn btn-warning btn-sm"
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
                        <td colspan="7" class="text-center text-muted py-4">
                            <i class="bi bi-inbox" style="font-size: 3rem;"></i>
                            <p class="mt-2">Belum ada data album</p>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

<script>
function deleteAlbum(id) {
    if (confirm('Apakah Anda yakin ingin menghapus album ini?')) {
        window.location.href = '<?= $_ENV['APP_URL'] ?>/admin/album/delete?id=' + id;
    }
}
</script>

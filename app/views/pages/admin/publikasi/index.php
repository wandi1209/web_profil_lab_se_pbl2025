<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0">Manajemen Publikasi</h3>
        <a href="<?= $_ENV['APP_URL'] ?>/admin/publikasi/create" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Tambah Baru
        </a>
    </div>

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
                            <th>#</th>
                            <th>Judul Publikasi</th>
                            <th>Penulis</th>
                            <th>Tahun</th>
                            <th>Link</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($publikasi)): ?>
                            <tr><td colspan="6" class="text-center">Belum ada data</td></tr>
                        <?php else: ?>
                            <?php foreach ($publikasi as $i => $row): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td class="fw-bold"><?= htmlspecialchars($row['judul']) ?></td>
                                <td>
                                    <?= htmlspecialchars($row['nama_penulis']) ?>
                                    <span class="badge bg-secondary text-white" style="font-size: 0.7em;">
                                        <?= $row['kategori'] ?>
                                    </span>
                                </td>
                                <td><?= $row['tahun'] ?></td>
                                <td>
                                    <?php if ($row['url']): ?>
                                        <a href="<?= $row['url'] ?>" target="_blank" class="btn btn-sm btn-outline-info">
                                            <i class="bi bi-link-45deg"></i> Buka
                                        </a>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= $_ENV['APP_URL'] ?>/admin/publikasi/edit?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="<?= $_ENV['APP_URL'] ?>/admin/publikasi/delete" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                    </form>
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
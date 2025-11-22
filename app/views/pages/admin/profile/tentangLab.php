<?php 
include_once __DIR__ . "/../../../layouts/admin/header.php";
include_once __DIR__ . "/../../../layouts/admin/sidebar.php";
?>

<div class="container-fluid p-4">

    <h3 class="fw-bold mb-3">
        <?= htmlspecialchars($title ?? 'Tentang Lab SE') ?>
    </h3>

    <p class="text-muted mb-3">
        Halaman ini digunakan untuk mengelola informasi umum mengenai Laboratorium Software Engineering,
        seperti deskripsi singkat, sejarah, fokus utama, dan informasi lain yang ingin ditampilkan
        pada halaman profil publik.
    </p>

    <div class="d-flex justify-content-end mb-3">
        <div class="input-group w-25">
            <input type="text" id="searchInput" class="form-control" placeholder="Search">
            <span class="input-group-text"><i class="bi bi-search"></i></span>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th style="width: 60px;">No.</th>
                    <th style="width: 180px;">Kategori</th>
                    <th>Konten</th>
                    <th style="width: 160px;">Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($dataTentang)): ?>
                    <?php $no = 1; foreach ($dataTentang as $row): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['kategori'] ?? '-') ?></td>
                            <td><?= nl2br(htmlspecialchars($row['konten'] ?? '')) ?></td>
                            <td>
                                <a href="/admin/profile/tentangLab/edit?id=<?= urlencode($row['id']) ?>" class="btn btn-warning btn-sm">
                                    Edit
                                </a>
                                <a href="/admin/profile/tentangLab/delete?id=<?= urlencode($row['id']) ?>" 
                                   class="btn btn-danger btn-sm" 
                                   onclick="return confirm('Yakin hapus?')">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center text-muted">
                            Belum ada data tentang lab yang tersimpan.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <a href="/admin/profile/tentangLab/create" class="btn btn-primary mt-3">
        Tambah Data
    </a>

</div>

<?php 
include_once __DIR__ . "/../../../layouts/admin/footer.php";
?>

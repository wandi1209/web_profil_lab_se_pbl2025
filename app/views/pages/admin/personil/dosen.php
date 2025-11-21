<?php 
include_once __DIR__ . "/../../../layouts/admin/header.php";
include_once __DIR__ . "/../../../layouts/admin/sidebar.php";
?>

<div class="container-fluid p-4">

    <h3 class="fw-bold mb-3">Tentang Lab SE</h3>

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
                    <th>No.</th>
                    <th>Kategori</th>
                    <th>Konten</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                <?php $no = 1; foreach ($dataTentang as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['kategori'] ?></td>
                    <td><?= nl2br($row['konten']) ?></td>
                    <td>
                        <a href="/admin/profile/tentangLab/edit?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="/admin/profile/tentangLab/delete?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>

    <a href="/admin/profile/tentangLab/create" class="btn btn-primary mt-3">Tambah Data</a>

</div>

<?php 
include_once __DIR__ . "/../../../layouts/admin/footer.php";
?>

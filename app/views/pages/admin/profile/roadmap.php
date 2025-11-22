<div class="container-fluid">

   <div class="d-flex justify-content-between align-items-center mb-4">
        <!-- Judul -->
        <h3 class="fw-bold m-0 text-start">Roadmap</h3>

        <!-- Search (kanan) -->
        <div class="input-group search-box">
            <input type="text" id="searchInput" class="form-control" placeholder="Search">
            <span class="input-group-text"><i class="bi bi-search"></i></span>
        </div>
    </div>

    <!-- TOMBOL TAMBAH DATA (di bawah search, kiri) -->
    <div class="mb-3">
        <a href="/admin/profile/createRoadmap" class="btn btn-primary"> + Tambah Data</a>
    </div>

    <!-- TABEL -->
    <div class="table-responsive mb-5">
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
            <?php if (!empty($dataRoadmap)): ?>
                <?php $no = 1; foreach ($dataRoadmap as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['kategori'] ?></td>
                    <td><?= nl2br($row['konten']) ?></td>
                    <td>
                        <a href="/admin/profile/roadmap/edit?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="/admin/profile/roadmap/delete?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center text-muted">Tidak ada data</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0">Visi & Misi</h3>

        <div class="input-group search-box" style="max-width: 260px;">
            <input type="text" id="searchInput" class="form-control" placeholder="Search">
            <span class="input-group-text"><i class="bi bi-search"></i></span>
        </div>
    </div>

    <!-- Tombol Tambah -->
    <div class="mb-3">
        <a href="/admin/profile/createVisiMisi" class="btn btn-primary"> + Tambah Data</a>
    </div>

    <!-- Tabel -->
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
            <?php if (!empty($dataVisiMisi)): ?>
                <?php $no = 1; foreach ($dataVisiMisi as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['kategori'] ?></td>
                    <td><?= nl2br($row['konten']) ?></td>
                    <td>
                        <a href="/admin/profile/visiMisi/edit?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>

                        <a href="/admin/profile/visiMisi/delete?id=<?= $row['id'] ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Yakin hapus?')">
                           Delete
                        </a>
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
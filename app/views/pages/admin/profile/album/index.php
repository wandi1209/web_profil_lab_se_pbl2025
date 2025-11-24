<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0">Album</h3>

        <!-- Search -->
        <div class="input-group search-box" style="max-width: 260px;">
            <input type="text" id="searchInput" class="form-control" placeholder="Search">
            <span class="input-group-text"><i class="bi bi-search"></i></span>
        </div>
    </div>

    <!-- Tombol Tambah -->
    <div class="mb-3">
        <a href="<?= $_ENV['APP_URL'] ?>/admin/profile/album/create" class="btn btn-primary"> + Tambah Data</a>
    </div>

    <!-- Tabel -->
    <div class="table-responsive mb-5">
        <table class="table table-bordered align-middle table-hover">
            <thead class="table-light">
                <tr>
                    <th style="width:60px;">No.</th>
                    <th style="width:200px;">Kategori</th>
                    <th>Konten</th>
                    <th style="width:160px;">Aksi</th>
                </tr>
            </thead>

            <tbody>
            <?php if (!empty($dataAlbum)): ?>
                <?php $no = 1; foreach ($dataAlbum as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($row['kategori']) ?></td>

                    <td style="min-width: 300px;">
                        <?= nl2br(htmlspecialchars($row['konten'])) ?>

                        <?php if (!empty($row['gambar'])): ?>
                            <div class="mt-3">
                                <img src="/uploads/album/<?= $row['gambar'] ?>"
                                     alt="Album Image"
                                     class="img-fluid rounded"
                                     style="max-width: 280px;">
                            </div>
                        <?php endif; ?>
                    </td>

                    <td>
                        <a href="/admin/album/edit?id=<?= $row['id'] ?>" 
                           class="btn btn-warning btn-sm mb-1 w-100">
                           <i class="bi bi-pencil-square"></i> Edit
                        </a>

                        <a href="/admin/album/delete?id=<?= $row['id'] ?>" 
                           class="btn btn-danger btn-sm w-100"
                           onclick="return confirm('Yakin hapus album ini?')">
                           <i class="bi bi-trash"></i> Delete
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center text-muted py-4">Tidak ada data</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

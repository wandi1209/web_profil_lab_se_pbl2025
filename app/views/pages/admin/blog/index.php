<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0">Blog Artikel</h3>

        <!-- Search -->
        <div class="input-group search-box" style="max-width: 260px;">
            <input type="text" id="searchInput" class="form-control" placeholder="Search">
            <span class="input-group-text"><i class="bi bi-search"></i></span>
        </div>
    </div>

    <!-- Tombol Tambah -->
    <div class="mb-3">
        <a href="/admin/blog/createBlog" class="btn btn-primary"> + Tambah Data</a>
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
            <?php if (!empty($dataBlog)): ?>
                <?php $no = 1; foreach ($dataBlog as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['kategori'] ?></td>

                    <td style="min-width:300px;">
                        <?= nl2br($row['konten']) ?>

                        <?php if (!empty($row['gambar'])): ?>
                            <br>
                            <img src="/uploads/blog/<?= $row['gambar'] ?>"
                                 alt="blog Image"
                                 style="max-width: 280px; margin-top:10px; border-radius:6px;">
                        <?php endif; ?>
                    </td>

                    <td>
                        <a href="/admin/blog/index/edit?id=<?= $row['id'] ?>" 
                           class="btn btn-warning btn-sm">Edit</a>

                        <a href="/admin/blog/index/delete?id=<?= $row['id'] ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Yakin hapus gambar ini?')">
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

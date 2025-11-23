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
                    <td><?= htmlspecialchars($row['kategori']) ?></td>

                    <td style="min-width:300px;">
                        <?= nl2br(htmlspecialchars($row['konten'])) ?>

                        <?php if (!empty($row['gambar'])): ?>
                            <br>
                            <img src="/uploads/blog/<?= $row['gambar'] ?>"
                                 alt="blog Image"
                                 style="max-width: 280px; margin-top:10px; border-radius:6px;">
                        <?php endif; ?>
                    </td>

                    <td>
                        <a href="/admin/blog/edit?id=<?= $row['id'] ?>" 
                           class="btn btn-warning btn-sm">Edit</a>

                        <button onclick="deleteBlog(<?= $row['id'] ?>)" 
                                class="btn btn-danger btn-sm">
                            Delete
                        </button>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function deleteBlog(id) {
    Swal.fire({
        title: "Yakin menghapus data?",
        text: "Data tidak dapat dikembalikan setelah dihapus!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Ya, hapus!",
        cancelButtonText: "Batal"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "/admin/blog/delete?id=" + id;
        }
    });
}
</script>

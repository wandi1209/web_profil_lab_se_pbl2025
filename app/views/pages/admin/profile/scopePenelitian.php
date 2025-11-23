<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0">Scope Penelitian</h3>

        <div class="input-group search-box" style="max-width: 260px;">
            <input type="text" id="searchInput" class="form-control" placeholder="Search">
            <span class="input-group-text"><i class="bi bi-search"></i></span>
        </div>
    </div>

    <div class="mb-3">
        <a href="/admin/profile/createScopePenelitian" class="btn btn-primary"> + Tambah Data</a>
    </div>

    <div class="table-responsive mb-5">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th style="width:60px;">No.</th>
                    <th style="width:200px;">Kategori</th>
                    <th>Konten</th>
                    <th style="width:160px;">Aksi</th>
                </tr>
            </thead>

            <tbody>
            <?php if (!empty($dataScopePenelitian)): ?>
                <?php $no = 1; foreach ($dataScopePenelitian as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['kategori'] ?></td>
                    <td style="min-width:280px;"><?= nl2br($row['konten']) ?></td>

                    <td>
                        <a href="/admin/profile/scopePenelitianLab/edit?id=<?= $row['id'] ?>" 
                           class="btn btn-warning btn-sm">Edit</a>

                        <button onclick="deleteScope(<?= $row['id'] ?>)" 
                                class="btn btn-danger btn-sm">Delete</button>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function deleteScope(id) {
    Swal.fire({
        title: "Hapus data?",
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Ya, hapus!",
        cancelButtonText: "Batal"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "/admin/profile/scopePenelitianLab/delete?id=" + id;
        }
    });
}
</script>

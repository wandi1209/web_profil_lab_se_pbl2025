<div class="container-fluid">

   <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0 text-start">Rekrutmen</h3>

        <div class="input-group search-box" style="max-width: 260px;">
            <input type="text" id="searchInput" class="form-control" placeholder="Search">
            <span class="input-group-text"><i class="bi bi-search"></i></span>
        </div>
    </div>

    <div class="mb-3">
        <a href="/admin/profile/createRekrutmen" class="btn btn-primary"> + Tambah Data</a>
    </div>

    <div class="table-responsive mb-5">
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
            <?php if (!empty($dataRekrutmen)): ?>
                <?php $no = 1; foreach ($dataRekrutmen as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['kategori'] ?></td>
                    <td style="min-width:280px;"><?= nl2br($row['konten']) ?></td>
                    <td class="text-center">

                        <!-- EDIT -->
                        <a href="/admin/profile/rekrutmen/index/edit?id=<?= $row['id'] ?>"
                           class="btn btn-warning btn-sm me-1">
                           <i class="bi bi-pencil-square"></i> Edit
                        </a>

                        <!-- DELETE -->
                        <button onclick="deleteRekrutmen(<?= $row['id'] ?>)"
                                class="btn btn-danger btn-sm">
                            <i class="bi bi-trash"></i> Delete
                        </button>

                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center text-muted py-3">Tidak ada data</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

<!-- SWEETALERT -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function deleteRekrutmen(id) {
    Swal.fire({
        title: "Yakin ingin menghapus?",
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Ya, hapus!",
        cancelButtonText: "Batal"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "/admin/profile/rekrutmen/index/delete?id=" + id;
        }
    });
}
</script>
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0 text-start">Mahasiswa</h3>

        <!-- Search -->
        <div class="input-group search-box" style="max-width: 260px;">
            <input type="text" id="searchInput" class="form-control" placeholder="Search">
            <span class="input-group-text"><i class="bi bi-search"></i></span>
        </div>
    </div>

    <!-- Tombol Tambah -->
    <div class="mb-3">
        <a href="/admin/personil/createMahasiswa" class="btn btn-primary"> + Tambah Data</a>
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
            <?php if (!empty($dataMahasiswa)): ?>
                <?php $no = 1; foreach ($dataMahasiswa as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['kategori'] ?></td>
                    <td><?= nl2br($row['konten']) ?></td>
                    <td>
                        <a href="/admin/personil/mahasiswa/edit?id=<?= $row['id'] ?>" 
                           class="btn btn-warning btn-sm">Edit</a>

                        <button onclick="deleteMahasiswa(<?= $row['id'] ?>)" 
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
function deleteMahasiswa(id) {
    Swal.fire({
        title: "Yakin menghapus data?",
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Ya, hapus!",
        cancelButtonText: "Batal"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "/admin/personil/mahasiswa/delete?id=" + id;
        }
    });
}
</script>
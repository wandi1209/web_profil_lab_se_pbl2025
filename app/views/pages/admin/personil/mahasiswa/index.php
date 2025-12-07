<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0">Mahasiswa</h3>
    </div>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $_SESSION['success'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $_SESSION['error'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-header bg-white py-3 border-0">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <a href="<?= $_ENV['APP_URL'] ?>/admin/personil/mahasiswa/create" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Data
                </a>

                <div class="input-group" style="max-width: 300px;">
                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" id="searchInput" class="form-control bg-light border-start-0" placeholder="Cari mahasiswa...">
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="mahasiswaTable">
                    <thead class="table-light">
                        <tr>
                            <th width="5%" class="ps-4">No</th>
                            <th width="10%">Foto</th>
                            <th width="25%">Identitas</th>
                            <th width="15%">NIM</th>
                            <th width="25%">Keahlian</th>
                            <th width="10%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($dataMahasiswa)): ?>
                        <?php $no = 1; foreach ($dataMahasiswa as $row): ?>
                        <tr>
                            <td class="ps-4"><?= $no++ ?></td>
                            <td>
                                <?php if (!empty($row['foto_url'])): ?>
                                    <img src="<?= $_ENV['APP_URL'] . '/public' . $row['foto_url'] ?>"
                                         alt="<?= htmlspecialchars($row['nama']) ?>"
                                         class="rounded-circle shadow-sm object-fit-cover"
                                         style="width: 50px; height: 50px;">
                                <?php else: ?>
                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center border text-secondary"
                                         style="width: 50px; height: 50px;">
                                        <i class="bi bi-person-fill fs-4"></i>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="fw-bold text-dark"><?= htmlspecialchars($row['nama']) ?></div>
                                <div class="small text-muted text-truncate" style="max-width: 200px;">
                                    <?= htmlspecialchars($row['email']) ?>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border font-monospace">
                                    <?= htmlspecialchars($row['nidn'] ?? '-') ?>
                                </span>
                            </td>
                            <td>
                                <?php if(!empty($row['keahlian'])): ?>
                                    <span class="d-inline-block text-secondary small" style="max-width: 250px;">
                                        <?= htmlspecialchars($row['keahlian']) ?>
                                    </span>
                                <?php else: ?>
                                    <span class="text-muted small">-</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <a href="<?= $_ENV['APP_URL'] ?>/admin/personil/mahasiswa/edit?id=<?= $row['id'] ?>" 
                                   class="btn btn-warning btn-sm me-1"
                                   title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <button onclick="deleteMahasiswa(<?= $row['id'] ?>)" 
                                        class="btn btn-danger btn-sm"
                                        title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-5">
                                <i class="bi bi-people fs-1 d-block mb-2 opacity-50"></i>
                                <p class="m-0">Belum ada data mahasiswa</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// Search function
document.getElementById('searchInput').addEventListener('keyup', function() {
    const searchValue = this.value.toLowerCase();
    const table = document.getElementById('mahasiswaTable');
    const rows = table.getElementsByTagName('tr');

    // Mulai dari 1 karena 0 adalah header
    for (let i = 1; i < rows.length; i++) {
        const row = rows[i];
        // Gabungkan semua teks dalam baris untuk pencarian
        const text = row.textContent.toLowerCase();
        
        if (text.includes(searchValue)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    }
});

// Delete function
function deleteMahasiswa(id) {
    Swal.fire({
        title: "Hapus data mahasiswa?",
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#dc3545", // Merah
        cancelButtonColor: "#6c757d",  // Abu-abu
        confirmButtonText: "Ya, Hapus!",
        cancelButtonText: "Batal"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?= $_ENV['APP_URL'] ?>/admin/personil/mahasiswa/delete?id=" + id;
        }
    });
}
</script>
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0">Mahasiswa</h3>

        <!-- Search -->
        <div class="input-group search-box" style="max-width: 260px;">
            <input type="text" id="searchInput" class="form-control" placeholder="Search">
            <span class="input-group-text"><i class="bi bi-search"></i></span>
        </div>
    </div>

    <!-- Alert Messages -->
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

    <!-- Tombol Tambah -->
    <div class="mb-3">
        <a href="<?= $_ENV['APP_URL'] ?>/admin/personil/mahasiswa/create" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Tambah Data
        </a>
    </div>

    <!-- Tabel -->
    <div class="table-responsive mb-5">
        <table class="table table-bordered table-hover align-middle" id="mahasiswaTable">
            <thead class="table-light">
                <tr>
                    <th width="5%">No</th>
                    <th width="12%">Foto</th>
                    <th width="20%">Nama</th>
                    <th width="20%">Email</th>
                    <th width="15%">NIM</th>
                    <th width="18%">Keahlian</th>
                    <th width="10%" class="text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
            <?php if (!empty($dataMahasiswa)): ?>
                <?php $no = 1; foreach ($dataMahasiswa as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td>
                        <?php if (!empty($row['foto_url'])): ?>
                            <img src="<?= $_ENV['APP_URL'] . '/public' . $row['foto_url'] ?>"
                                 alt="<?= htmlspecialchars($row['nama']) ?>"
                                 class="rounded-circle"
                                 style="width: 60px; height: 60px; object-fit: cover;">
                        <?php else: ?>
                            <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center"
                                 style="width: 60px; height: 60px;">
                                <i class="bi bi-person text-white" style="font-size: 1.5rem;"></i>
                            </div>
                        <?php endif; ?>
                    </td>
                    <td><strong><?= htmlspecialchars($row['nama']) ?></strong></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['nidn'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($row['keahlian'] ?? '-') ?></td>
                    <td class="text-center">
                        <a href="<?= $_ENV['APP_URL'] ?>/admin/personil/mahasiswa/edit?id=<?= $row['id'] ?>" 
                           class="btn btn-warning btn-sm mb-1"
                           title="Edit">
                            <i class="bi bi-pencil"></i>
                        </a>

                        <button onclick="deleteMahasiswa(<?= $row['id'] ?>)" 
                                class="btn btn-danger btn-sm mb-1"
                                title="Hapus">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">
                        <i class="bi bi-inbox" style="font-size: 3rem;"></i>
                        <p class="mt-2">Belum ada data mahasiswa</p>
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// Search function
document.getElementById('searchInput').addEventListener('keyup', function() {
    const searchValue = this.value.toLowerCase();
    const table = document.getElementById('mahasiswaTable');
    const rows = table.getElementsByTagName('tr');

    for (let i = 1; i < rows.length; i++) {
        const row = rows[i];
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
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Ya, hapus!",
        cancelButtonText: "Batal"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?= $_ENV['APP_URL'] ?>/admin/personil/mahasiswa/delete?id=" + id;
        }
    });
}
</script>
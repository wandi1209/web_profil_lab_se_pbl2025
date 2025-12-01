<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0">Blog Artikel</h3>

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
        <a href="<?= $_ENV['APP_URL'] ?>/admin/blog/create" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Tambah Artikel
        </a>
    </div>

    <!-- Tabel -->
    <div class="table-responsive mb-5">
        <table class="table table-bordered table-hover align-middle" id="blogTable">
            <thead class="table-light">
                <tr>
                    <th width="5%">No</th>
                    <th width="20%">Gambar</th>
                    <th width="25%">Judul</th>
                    <th width="35%">Ringkasan</th>
                    <th width="10%">Tanggal</th>
                    <th width="10%" class="text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
            <?php if (!empty($dataBlog)): ?>
                <?php $no = 1; foreach ($dataBlog as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td>
                        <?php if (!empty($row['gambar_url'])): ?>
                            <img src="<?= $_ENV['APP_URL']. '/public' . $row['gambar_url'] ?>"
                                 alt="<?= htmlspecialchars($row['title']) ?>"
                                 class="img-thumbnail"
                                 style="max-width: 150px; max-height: 100px; object-fit: cover;">
                        <?php else: ?>
                            <div class="bg-secondary d-flex align-items-center justify-content-center rounded"
                                 style="width: 150px; height: 100px;">
                                <i class="bi bi-image text-white" style="font-size: 2rem;"></i>
                            </div>
                        <?php endif; ?>
                    </td>
                    <td>
                        <strong><?= htmlspecialchars($row['title']) ?></strong>
                        <br>
                        <small class="text-muted">Slug: <?= htmlspecialchars($row['slug']) ?></small>
                    </td>
                    <td><?= htmlspecialchars(substr($row['ringkasan'] ?? '-', 0, 150)) ?><?= strlen($row['ringkasan'] ?? '') > 150 ? '...' : '' ?></td>
                    <td><?= date('d/m/Y', strtotime($row['created_at'])) ?></td>
                    <td class="text-center">
                        <a href="<?= $_ENV['APP_URL'] ?>/admin/blog/edit?id=<?= $row['id'] ?>" 
                           class="btn btn-warning btn-sm mb-1"
                           title="Edit">
                            <i class="bi bi-pencil"></i>
                        </a>

                        <button onclick="deleteBlog(<?= $row['id'] ?>)" 
                                class="btn btn-danger btn-sm mb-1"
                                title="Hapus">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">
                        <i class="bi bi-inbox" style="font-size: 3rem;"></i>
                        <p class="mt-2">Belum ada artikel</p>
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
    const table = document.getElementById('blogTable');
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
function deleteBlog(id) {
    Swal.fire({
        title: "Hapus artikel?",
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Ya, hapus!",
        cancelButtonText: "Batal"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?= $_ENV['APP_URL'] ?>/admin/blog/delete?id=" + id;
        }
    });
}
</script>

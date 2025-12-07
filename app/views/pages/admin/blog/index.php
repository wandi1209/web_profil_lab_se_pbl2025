<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0">Blog Artikel</h3>
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
                <a href="<?= $_ENV['APP_URL'] ?>/admin/blog/create" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Artikel
                </a>

                <div class="input-group" style="max-width: 300px;">
                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" id="searchInput" class="form-control bg-light border-start-0" placeholder="Cari judul artikel...">
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="blogTable">
                    <thead class="table-light">
                        <tr>
                            <th width="5%" class="ps-4">No</th>
                            <th width="15%">Cover</th>
                            <th width="30%">Info Artikel</th>
                            <th width="30%">Ringkasan</th>
                            <th width="10%">Tanggal</th>
                            <th width="10%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($dataBlog)): ?>
                        <?php $no = 1; foreach ($dataBlog as $row): ?>
                        <tr>
                            <td class="ps-4"><?= $no++ ?></td>
                            <td>
                                <?php if (!empty($row['gambar_url'])): ?>
                                    <img src="<?= $_ENV['APP_URL']. '/public' . $row['gambar_url'] ?>"
                                         alt="<?= htmlspecialchars($row['title']) ?>"
                                         class="rounded shadow-sm object-fit-cover"
                                         style="width: 100px; height: 60px;">
                                <?php else: ?>
                                    <div class="bg-light rounded border d-flex align-items-center justify-content-center text-muted"
                                         style="width: 100px; height: 60px;">
                                        <i class="bi bi-image"></i>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="fw-bold text-dark mb-1"><?= htmlspecialchars($row['title']) ?></div>
                                
                                <?php if (!empty($row['is_featured'])): ?>
                                    <span class="badge bg-warning text-dark me-1" style="font-size: 0.7rem;">
                                        <i class="bi bi-star-fill me-1"></i>Featured
                                    </span>
                                <?php endif; ?>
                                
                                <div class="text-muted small text-truncate" style="max-width: 250px;">
                                    <i class="bi bi-link-45deg"></i> /<?= htmlspecialchars($row['slug']) ?>
                                </div>
                            </td>
                            <td>
                                <span class="d-inline-block text-secondary small text-truncate" style="max-width: 300px;">
                                    <?= htmlspecialchars($row['ringkasan'] ?? '-') ?>
                                </span>
                            </td>
                            <td>
                                <small class="text-muted">
                                    <?= date('d M Y', strtotime($row['created_at'])) ?>
                                </small>
                            </td>
                            <td class="text-center">
                                <a href="<?= $_ENV['APP_URL'] ?>/admin/blog/edit?id=<?= $row['id'] ?>" 
                                   class="btn btn-warning btn-sm me-1"
                                   title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <button onclick="deleteBlog(<?= $row['id'] ?>)" 
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
                                <i class="bi bi-journal-text fs-1 d-block mb-2 opacity-50"></i>
                                <p class="m-0">Belum ada artikel yang diterbitkan</p>
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
    const table = document.getElementById('blogTable');
    const rows = table.getElementsByTagName('tr');

    // Mulai loop dari index 1 (melewati header)
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
        title: "Yakin hapus artikel?",
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#dc3545", // Merah
        cancelButtonColor: "#6c757d",  // Abu-abu
        confirmButtonText: "Ya, Hapus!",
        cancelButtonText: "Batal"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?= $_ENV['APP_URL'] ?>/admin/blog/delete?id=" + id;
        }
    });
}
</script>
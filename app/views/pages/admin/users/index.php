<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0">Manajemen User</h3>
        <a href="<?= $_ENV['APP_URL'] ?>/admin/users/create" class="btn btn-primary">
            <i class="bi bi-person-plus me-2"></i>Tambah User
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        // Ambil ID user login dengan aman
                        $currentUserId = $_SESSION['user_id'] ?? $_SESSION['user']['id'] ?? 0;
                        ?>

                        <?php foreach ($users as $i => $user): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td class="fw-bold"><?= htmlspecialchars($user['username']) ?></td>
                            <td>
                                <span class="badge bg-<?= $user['role_id'] == 1 ? 'danger' : 'primary' ?>">
                                    <?= htmlspecialchars($user['role_name'] ?? 'User') ?>
                                </span>
                            </td>
                            <td>
                                <a href="<?= $_ENV['APP_URL'] ?>/admin/users/edit?id=<?= $user['id'] ?>" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                
                                <?php if ($user['id'] != $currentUserId): ?>
                                    <!-- Form Delete dengan ID unik -->
                                    <form id="delete-form-<?= $user['id'] ?>" action="<?= $_ENV['APP_URL'] ?>/admin/users/delete" method="POST" class="d-inline">
                                        <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                        <!-- Tombol type="button" agar tidak auto submit, panggil fungsi JS -->
                                        <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete(<?= $user['id'] ?>)" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <button class="btn btn-sm btn-secondary" disabled title="Tidak bisa hapus diri sendiri">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // 1. Fungsi Konfirmasi Delete
    function confirmDelete(userId) {
        Swal.fire({
            title: 'Yakin hapus user ini?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Cari form berdasarkan ID dan submit
                document.getElementById('delete-form-' + userId).submit();
            }
        })
    }
</script>

<!-- 2. Script Menampilkan Notifikasi Session (Success/Error) -->
<?php if (isset($_SESSION['success'])): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '<?= $_SESSION['success'] ?>',
            timer: 3000,
            showConfirmButton: false
        });
    </script>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '<?= $_SESSION['error'] ?>',
            timer: 3000,
            showConfirmButton: false
        });
    </script>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>
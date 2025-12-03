<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0">Edit User</h3>
        <a href="<?= $_ENV['APP_URL'] ?>/admin/users" class="btn btn-secondary">Kembali</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <form method="POST" action="<?= $_ENV['APP_URL'] ?>/admin/users/update">
                <input type="hidden" name="id" value="<?= $user['id'] ?>">

                <!-- Username -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Username</label>
                    <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($user['username']) ?>" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Password Baru</label>
                        <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengganti password">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Role</label>
                        <select name="role_id" class="form-select" required>
                            <?php foreach ($roles as $role): ?>
                                <option value="<?= $role['id'] ?>" <?= $role['id'] == $user['role_id'] ? 'selected' : '' ?>>
                                    <?= $role['name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary px-4">Update User</button>
            </form>
        </div>
    </div>
</div>
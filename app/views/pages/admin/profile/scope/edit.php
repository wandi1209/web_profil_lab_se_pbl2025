<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0">Edit Scope Penelitian</h3>
        <a href="<?= $_ENV['APP_URL'] ?>/admin/scope" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $_SESSION['error'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <?php
    // Parse tags
    $scopeModel = new \Polinema\WebProfilLabSe\Models\Scope();
    $tagsList = $scopeModel->parseTags($scope['tags']);
    ?>

    <div class="card">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Form Edit Scope Penelitian</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="<?= $_ENV['APP_URL'] ?>/admin/scope/update" enctype="multipart/form-data">

                <input type="hidden" name="id" value="<?= $scope['id'] ?>">

                <!-- Kategori -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Kategori <span class="text-danger">*</span></label>
                    <input
                        type="text"
                        name="kategori"
                        class="form-control input-bordered"
                        value="<?= htmlspecialchars($scope['kategori']) ?>"
                        required>
                </div>

                <!-- Deskripsi -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Deskripsi <span class="text-danger">*</span></label>
                    <textarea
                        name="deskripsi"
                        class="form-control input-bordered"
                        rows="4"
                        required><?= htmlspecialchars($scope['deskripsi']) ?></textarea>
                </div>

                <!-- Icon/Logo -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Icon/Logo</label>

                    <!-- Preview Icon Lama -->
                    <?php if (!empty($scope['icon_url'])): ?>
                    <div class="mb-3">
                        <img
                            src="<?= $_ENV['APP_URL'] . htmlspecialchars($scope['icon_url']) ?>"
                            alt="Icon"
                            class="border-preview"
                            style="width: 100px; height: 100px; object-fit: contain;">
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" name="hapus_icon" id="hapusIcon">
                            <label class="form-check-label text-danger" for="hapusIcon">
                                <i class="bi bi-trash me-1"></i>Hapus icon
                            </label>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Upload Icon Baru -->
                    <input
                        type="file"
                        name="icon"
                        class="form-control input-bordered"
                        accept="image/*"
                        id="inputIcon">
                    <small class="text-muted">
                        Format: JPG, PNG, SVG | Maksimal 2MB
                        <?= !empty($scope['icon_url']) ? ' | Upload icon baru untuk mengganti' : '' ?>
                    </small>

                    <!-- Preview Upload Baru -->
                    <div id="previewContainer" class="mt-3" style="display: none;">
                        <label class="form-label fw-bold">Preview Icon Baru:</label><br>
                        <img id="previewImage" src="" alt="Preview" class="border-preview" style="max-width: 100px;">
                    </div>
                </div>

                <!-- Tags -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Tags (Teknologi/Topik)</label>
                    <div id="tagsContainer">
                        <?php if (!empty($tagsList)): ?>
                            <?php foreach ($tagsList as $tag): ?>
                            <div class="input-group mb-2">
                                <input
                                    type="text"
                                    name="tags[]"
                                    class="form-control input-bordered"
                                    value="<?= htmlspecialchars($tag) ?>">
                                <button type="button" class="btn btn-danger" onclick="removeTag(this)">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="input-group mb-2">
                                <input
                                    type="text"
                                    name="tags[]"
                                    class="form-control input-bordered"
                                    placeholder="Contoh: Fullstack, PWA">
                                <button type="button" class="btn btn-danger" onclick="removeTag(this)">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>
                    <button type="button" class="btn btn-sm btn-success" onclick="addTag()">
                        <i class="bi bi-plus-circle me-1"></i>Tambah Tag
                    </button>
                </div>

                <hr class="my-4">

                <!-- Buttons -->
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-2"></i>Simpan Perubahan
                    </button>
                    <a href="<?= $_ENV['APP_URL'] ?>/admin/scope" class="btn btn-secondary">
                        <i class="bi bi-x-circle me-2"></i>Batal
                    </a>
                </div>

            </form>
        </div>
    </div>

</div>

<style>
.input-bordered {
    border: 2px solid #dee2e6 !important;
    border-radius: 8px !important;
    padding: 10px 15px !important;
    transition: all 0.3s ease !important;
}

.input-bordered:focus {
    border-color: #0d6efd !important;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15) !important;
    outline: none !important;
}

.input-bordered:hover {
    border-color: #adb5bd !important;
}

.card {
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    border: 1px solid #e0e0e0;
}

.border-preview {
    border: 3px solid #dee2e6 !important;
    border-radius: 8px !important;
    padding: 5px !important;
}

.input-group .input-bordered {
    border-top-right-radius: 0 !important;
    border-bottom-right-radius: 0 !important;
}
</style>

<script>
// Preview icon baru
document.getElementById('inputIcon').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImage').src = e.target.result;
            document.getElementById('previewContainer').style.display = 'block';
        }
        reader.readAsDataURL(file);
    } else {
        document.getElementById('previewContainer').style.display = 'none';
    }
});

// Hide preview saat checkbox hapus dicentang
document.getElementById('hapusIcon')?.addEventListener('change', function() {
    if (this.checked) {
        document.getElementById('inputIcon').value = '';
        document.getElementById('previewContainer').style.display = 'none';
    }
});

// Tambah tag
function addTag() {
    const container = document.getElementById('tagsContainer');
    const div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.innerHTML = `
        <input
            type="text"
            name="tags[]"
            class="form-control input-bordered"
            placeholder="Contoh: API, Deep Learning">
        <button type="button" class="btn btn-danger" onclick="removeTag(this)">
            <i class="bi bi-trash"></i>
        </button>
    `;
    container.appendChild(div);
}

// Hapus tag
function removeTag(button) {
    button.parentElement.remove();
}
</script>
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0">Tambah Scope Penelitian</h3>
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

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Form Tambah Scope Penelitian</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="<?= $_ENV['APP_URL'] ?>/admin/scope/store" enctype="multipart/form-data">

                <!-- Kategori -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Kategori <span class="text-danger">*</span></label>
                    <input
                        type="text"
                        name="kategori"
                        class="form-control input-bordered"
                        placeholder="Contoh: Web Development, Artificial Intelligence"
                        required>
                </div>

                <!-- Deskripsi -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Deskripsi <span class="text-danger">*</span></label>
                    <textarea
                        name="deskripsi"
                        class="form-control input-bordered"
                        rows="4"
                        placeholder="Deskripsi singkat tentang scope penelitian..."
                        required></textarea>
                </div>

                <!-- Icon/Logo -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Icon/Logo (Opsional)</label>
                    <input
                        type="file"
                        name="icon"
                        class="form-control input-bordered"
                        accept="image/*"
                        id="inputIcon">
                    <small class="text-muted">Format: JPG, PNG, SVG | Maksimal 2MB | Ukuran disarankan 100x100px</small>

                    <!-- Preview -->
                    <div id="previewContainer" class="mt-3" style="display: none;">
                        <label class="form-label fw-bold">Preview:</label><br>
                        <img id="previewImage" src="" alt="Preview" class="border-preview" style="max-width: 100px; max-height: 100px;">
                    </div>
                </div>

                <!-- Tags -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Tags (Teknologi/Topik)</label>
                    <div id="tagsContainer">
                        <div class="input-group mb-2">
                            <input
                                type="text"
                                name="tags[]"
                                class="form-control input-bordered"
                                placeholder="Contoh: Fullstack, PWA, Microservices">
                            <button type="button" class="btn btn-danger" onclick="removeTag(this)">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-success" onclick="addTag()">
                        <i class="bi bi-plus-circle me-1"></i>Tambah Tag
                    </button>
                </div>

                <hr class="my-4">

                <!-- Buttons -->
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-2"></i>Simpan
                    </button>
                    <button type="reset" class="btn btn-secondary">
                        <i class="bi bi-arrow-counterclockwise me-2"></i>Reset
                    </button>
                    <a href="<?= $_ENV['APP_URL'] ?>/admin/scope" class="btn btn-outline-secondary">
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
// Preview icon
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

// Reset preview
document.querySelector('button[type="reset"]').addEventListener('click', function() {
    document.getElementById('previewContainer').style.display = 'none';
});
</script>
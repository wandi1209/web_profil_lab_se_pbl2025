<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0">Tambah Dosen</h3>
        <a href="<?= $_ENV['APP_URL'] ?>/admin/personil/dosen" class="btn btn-secondary">
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
            <h5 class="mb-0"><i class="bi bi-person-plus me-2"></i>Form Tambah Dosen</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="<?= $_ENV['APP_URL'] ?>/admin/personil/dosen/store" enctype="multipart/form-data">
                
                <h6 class="fw-bold text-primary mb-3"><i class="bi bi-info-circle me-2"></i>Informasi Dasar</h6>
                
                <div class="mb-4">
                    <label class="form-label fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" name="nama" class="form-control input-bordered" placeholder="Contoh: Dr. John Doe, M.Kom" required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Posisi/Jabatan <span class="text-danger">*</span></label>
                    <input type="text" name="position" class="form-control input-bordered" placeholder="Contoh: Kepala Lab / Dosen Pembimbing" required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Nomor Urut Tampil</label>
                    <input type="number" name="urutan" class="form-control input-bordered" placeholder="Contoh: 1 (Semakin kecil semakin di depan)" min="1">
                    <small class="text-muted">Kosongkan jika tidak ingin mengatur urutan (otomatis di akhir).</small>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control input-bordered" placeholder="Contoh: john.doe@polinema.ac.id" required>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-bold">NIDN</label>
                        <input type="text" name="nidn" class="form-control input-bordered" placeholder="Contoh: 0123456789">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Foto Profil</label>
                    <input type="file" name="foto" class="form-control input-bordered" accept="image/*" id="inputFoto">
                    <small class="text-muted">Format: JPG, PNG, GIF, WEBP | Maksimal 5MB</small>
                    <div id="previewContainer" class="mt-3" style="display: none;">
                        <label class="form-label fw-bold">Preview:</label><br>
                        <img id="previewImage" src="" alt="Preview" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                    </div>
                </div>

                <hr class="my-4">

                <h6 class="fw-bold text-primary mb-3"><i class="bi bi-mortarboard me-2"></i>Keahlian & Riwayat</h6>

                <div class="mb-4">
                    <label class="form-label fw-bold">Bidang Keahlian</label>
                    <textarea name="keahlian" class="form-control input-bordered" rows="3" placeholder="Contoh: AI, Machine Learning"></textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Riwayat Pendidikan</label>
                    <div id="pendidikanContainer">
                        <div class="input-group mb-2">
                            <input type="text" name="pendidikan[]" class="form-control input-bordered" placeholder="Contoh: S3 – Ilmu Komputer, UI (2018-2021)">
                            <button type="button" class="btn btn-danger" onclick="removeField(this)"><i class="bi bi-trash"></i></button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-success" onclick="addPendidikan()"><i class="bi bi-plus-circle me-1"></i>Tambah Pendidikan</button>
                </div>

                <hr class="my-4">

                <h6 class="fw-bold text-primary mb-3"><i class="bi bi-link-45deg me-2"></i>Link & Profil Akademik</h6>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-bold"><i class="bi bi-linkedin text-primary me-2"></i>LinkedIn</label>
                        <input type="url" name="linkedin" class="form-control input-bordered" placeholder="https://linkedin.com/in/username">
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-bold"><i class="bi bi-github me-2"></i>GitHub</label>
                        <input type="url" name="github" class="form-control input-bordered" placeholder="https://github.com/username">
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-bold"><i class="bi bi-journal-text text-warning me-2"></i>SINTA ID (Link)</label>
                        <input type="url" name="link_sinta" class="form-control input-bordered" placeholder="https://sinta.kemdikbud.go.id/authors/profile/...">
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-bold"><i class="bi bi-google text-primary me-2"></i>Google Scholar</label>
                        <input type="url" name="link_scholar" class="form-control input-bordered" placeholder="https://scholar.google.com/citations?user=...">
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save me-2"></i>Simpan</button>
                    <button type="reset" class="btn btn-secondary"><i class="bi bi-arrow-counterclockwise me-2"></i>Reset</button>
                    <a href="<?= $_ENV['APP_URL'] ?>/admin/personil/dosen" class="btn btn-outline-secondary"><i class="bi bi-x-circle me-2"></i>Batal</a>
                </div>

            </form>
        </div>
    </div>
</div>

<style>
.input-bordered { border: 2px solid #dee2e6 !important; border-radius: 8px !important; padding: 10px 15px !important; transition: all 0.3s ease !important; }
.input-bordered:focus { border-color: #0d6efd !important; box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15) !important; outline: none !important; }
.input-bordered:hover { border-color: #adb5bd !important; }
.card { box-shadow: 0 2px 4px rgba(0,0,0,0.1); border: 1px solid #e0e0e0; }
.img-thumbnail { border: 2px solid #dee2e6; }
.input-group .input-bordered { border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; }
</style>

<script>
document.getElementById('inputFoto').addEventListener('change', function(e) {
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
function addPendidikan() {
    const container = document.getElementById('pendidikanContainer');
    const div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.innerHTML = `<input type="text" name="pendidikan[]" class="form-control input-bordered" placeholder="Contoh: S2 – Teknologi Informasi, ITB (2015-2017)"><button type="button" class="btn btn-danger" onclick="removeField(this)"><i class="bi bi-trash"></i></button>`;
    container.appendChild(div);
}
function removeField(button) { button.parentElement.remove(); }
</script>
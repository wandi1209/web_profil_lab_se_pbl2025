<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0">Tambah Artikel Blog</h3>
        <a href="<?= $_ENV['APP_URL'] ?>/admin/blog" class="btn btn-secondary">
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
            <h5 class="mb-0"><i class="bi bi-file-earmark-text me-2"></i>Form Tambah Artikel</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="<?= $_ENV['APP_URL'] ?>/admin/blog/store" enctype="multipart/form-data">

                <!-- Judul -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Judul Artikel <span class="text-danger">*</span></label>
                    <input
                        type="text"
                        name="title"
                        class="form-control input-bordered"
                        placeholder="Masukkan judul artikel..."
                        required>
                    <small class="text-muted">Slug akan otomatis dibuat dari judul</small>
                </div>

                <!-- Ringkasan -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Ringkasan/Excerpt</label>
                    <textarea
                        name="ringkasan"
                        class="form-control input-bordered"
                        rows="3"
                        placeholder="Ringkasan singkat artikel (opsional)..."
                        maxlength="200"></textarea>
                    <small class="text-muted">Maksimal 200 karakter</small>
                </div>

                <!-- Gambar -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Gambar Cover</label>
                    <input
                        type="file"
                        name="gambar"
                        class="form-control input-bordered"
                        accept="image/*"
                        id="inputGambar">
                    <small class="text-muted">Format: JPG, PNG, WEBP | Maksimal 5MB</small>

                    <!-- Preview -->
                    <div id="previewContainer" class="mt-3" style="display: none;">
                        <label class="form-label fw-bold">Preview:</label><br>
                        <img id="previewImage" src="" alt="Preview" class="img-thumbnail border-preview" style="max-width: 400px;">
                    </div>
                </div>

                <!-- Konten dengan Summernote -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Konten Artikel <span class="text-danger">*</span></label>
                    <textarea
                        name="content"
                        id="summernote"
                        class="form-control"
                        required></textarea>
                </div>

                <hr class="my-4">

                <!-- Buttons -->
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-2"></i>Publish Artikel
                    </button>
                    <button type="reset" class="btn btn-secondary" id="btnReset">
                        <i class="bi bi-arrow-counterclockwise me-2"></i>Reset
                    </button>
                    <a href="<?= $_ENV['APP_URL'] ?>/admin/blog" class="btn btn-outline-secondary">
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

/* Summernote custom styling */
.note-editor.note-frame {
    border: 2px solid #dee2e6 !important;
    border-radius: 8px !important;
}

.note-editor.note-frame:focus-within {
    border-color: #0d6efd !important;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15) !important;
}

.note-toolbar {
    background-color: #f8f9fa !important;
    border-bottom: 2px solid #dee2e6 !important;
}
</style>

<!-- Summernote CSS -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

<!-- jQuery (required for Summernote) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Summernote JS -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<script>
$(document).ready(function() {
    // Inisialisasi Summernote
    $('#summernote').summernote({
        placeholder: 'Tulis konten artikel di sini...',
        height: 400,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ],
        fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Helvetica', 'Impact', 'Tahoma', 'Times New Roman', 'Verdana'],
        fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '20', '24', '36', '48'],
        dialogsInBody: true,
        callbacks: {
            onImageUpload: function(files) {
                // Handle image upload jika diperlukan
                for (let i = 0; i < files.length; i++) {
                    uploadImage(files[i]);
                }
            }
        }
    });

    // Preview gambar cover
    $('#inputGambar').on('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#previewImage').attr('src', e.target.result);
                $('#previewContainer').show();
            }
            reader.readAsDataURL(file);
        } else {
            $('#previewContainer').hide();
        }
    });

    // Reset form dan Summernote
    $('#btnReset').on('click', function() {
        $('#summernote').summernote('reset');
        $('#previewContainer').hide();
    });
});

// Function untuk upload image ke Summernote (opsional)
function uploadImage(file) {
    let data = new FormData();
    data.append("file", file);
    
    // Buat reader untuk preview langsung
    let reader = new FileReader();
    reader.onload = function(e) {
        $('#summernote').summernote('insertImage', e.target.result);
    }
    reader.readAsDataURL(file);
    
    // Atau upload ke server terlebih dahulu
    /*
    $.ajax({
        url: "<?= $_ENV['APP_URL'] ?>/admin/blog/upload-image",
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        type: "POST",
        success: function(url) {
            $('#summernote').summernote('insertImage', url);
        },
        error: function(data) {
            console.log(data);
        }
    });
    */
}
</script>

<?php 
include_once __DIR__ . "/../../../layouts/admin/header.php";
include_once __DIR__ . "/../../../layouts/admin/sidebar.php";
?>

<div class="container-fluid mt-4">

    <!-- Judul Halaman -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0">Tambah Data Tentang Lab SE</h3>
        <a href="/admin/profile/tentangLab" class="btn btn-secondary">Kembali</a>
    </div>

    <!-- Form Create -->
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="/admin/profile/tentangLab/store" method="POST">
                
                <!-- Kategori -->
                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Masukkan kategori" required>
                </div>

                <!-- Konten -->
                <div class="mb-3">
                    <label for="konten" class="form-label">Konten</label>
                    <textarea class="form-control" id="konten" name="konten" rows="5" placeholder="Masukkan konten" required></textarea>
                </div>

                <!-- Tombol Submit -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>

            </form>
        </div>
    </div>

</div>

<?php 
include_once __DIR__ . "/../../../layouts/admin/footer.php";
?>

<?php 
$pageTitle = "Profil - Laboratorium Rekayasa Perangkat Lunak"; 

// Setup variabel (sama seperti sebelumnya)
$judul   = $tentang['judul'] ?? 'Pengenalan Laboratorium';
$konten  = $tentang['konten'] ?? 'Deskripsi laboratorium belum tersedia.';
$gambar  = !empty($tentang['gambar']) 
            ? $_ENV['APP_URL'] . '/public' . $tentang['gambar'] 
            : $_ENV['APP_URL'] . '/assets/images/gedung.webp';
?>

<section class="py-5 bg-light-blue">
    <div class="container py-lg-4">
        
        <div class="text-center mb-5">
            <span class="text-primary fw-bold text-uppercase small ls-1">Profil Laboratorium</span>
            <h1 class="display-5 fw-bold text-dark mt-2">Laboratorium Rekayasa Perangkat Lunak</h1>
            <p class="text-secondary">Pusat Unggulan Jurusan Teknologi Informasi Politeknik Negeri Malang</p>
        </div>

        <div class="mb-5 text-center">
            <img src="<?= $gambar ?>" 
                 alt="Foto Laboratorium" 
                 class="img-fluid rounded-4 shadow-sm w-100" 
                 style="max-height: 500px; object-fit: cover;">
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                
                <div class="bg-white p-4 p-md-5 rounded-4 shadow-sm border-0">
                    <h2 class="h3 fw-bold text-dark mb-4">
                        <?= htmlspecialchars($judul) ?>
                    </h2>
                    
                    <div class="text-secondary lh-lg mb-5" style="font-size: 1.05rem;">
                        <?= $konten ?>
                    </div>

                    <div class="d-flex align-items-center p-3 bg-light rounded-3 border">
                        <div class="flex-shrink-0 bg-white p-2 rounded-circle shadow-sm me-3 text-warning">
                            <i class="bi bi-award-fill fs-3"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold text-dark mb-1">Terakreditasi Unggul</h6>
                            <p class="text-secondary mb-0 small">
                                Program Studi Teknologi Informasi, Politeknik Negeri Malang.
                            </p>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
</section>

<style>
.bg-light-blue {
    background-color: #f8f9fa; /* Abu-abu sangat muda bersih */
}
.ls-1 {
    letter-spacing: 1px;
}
</style>
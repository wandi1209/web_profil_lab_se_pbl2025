<?php 
$pageTitle = "Profil - Laboratorium Rekayasa Perangkat Lunak"; 
// Asumsi $pageHeader, $pageFooter, dan variabel lingkungan ($ENV) dimuat di sini
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/profil.css"> 

</head>
<body>

<section class="py-5 bg-light-blue">
    <div class="container py-lg-5">
        
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <span class="badge bg-custom-blue bg-opacity-75 text-white mb-2 px-3 py-2 rounded-pill fw-medium">
                    🏢 Profil Institusi
                </span>
                <h1 class="display-6 fw-bold text-dark mt-2 mb-3">
                    Laboratorium Rekayasa Perangkat Lunak (SE) 
                </h1>
                <p class="fs-5 text-secondary mx-auto">
                    Pusat Unggulan di bawah naungan Jurusan Teknologi Informasi Politeknik Negeri Malang, berfokus pada pengembangan dan penelitian teknologi perangkat lunak.
                </p>
            </div>
        </div>

        <div class="row g-5">

            <div class="col-lg-7">
                <h2 class="h3 fw-bold text-dark mb-4 border-bottom pb-2">Pengenalan Laboratorium</h2>
                
                <p class="text-secondary lh-lg mb-4">
                    Laboratorium Rekayasa Perangkat Lunak (Software Engineering-SE) merupakan fasilitas akademik yang secara strategis berada di bawah naungan Jurusan Teknologi Informas. Fokus utama kami adalah pada bidang rekayasa pengembangan perangkat lunak
                </p>
                <p class="text-secondary lh-lg mb-5">
                    Laboratorium ini didirikan dengan harapan untuk tumbuh menjadi pusat aktivitas penelitian dan pengabdian masyarakat yang berorientasi pada pengembangan teknologi perangkat lunak yang solutif Kami bertujuan menjadi pusat unggulan yang berdaya saing global, berkontribusi nyata pada kemajuan akademik, industri, dan masyarakat.
                </p>

                <div class="card p-4 border-0 shadow-sm bg-white">
                    <div class="d-flex align-items-center gap-3">
                        <i class="bi bi-award-fill text-info fs-3"></i>
                        <div>
                            <h5 class="fw-bold mb-0 text-dark">Akreditasi A Program Studi</h5>
                            <p class="text-secondary mb-0 small">
                                Kualitas pendidikan terjamin dengan status Akreditasi A pada Program Studi Teknologi Informasi.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <h2 class="h3 fw-bold text-dark mb-4 border-bottom pb-2">Cakupan Aktivitas</h2>
                
                <div class="d-flex flex-column gap-3 mb-4">
                    <div class="highlight-item d-flex align-items-start gap-2">
                        <i class="bi bi-arrow-right-circle-fill text-custom-blue mt-1 flex-shrink-0"></i>
                        <span class="fw-medium text-dark">Pengembangan Kompetensi Mahasiswa </span>
                    </div>
                    <div class="highlight-item d-flex align-items-start gap-2">
                        <i class="bi bi-arrow-right-circle-fill text-custom-blue mt-1 flex-shrink-0"></i>
                        <span class="fw-medium text-dark">Penelitian Fundamental dan Terapan </span>
                    </div>
                    <div class="highlight-item d-flex align-items-start gap-2">
                        <i class="bi bi-arrow-right-circle-fill text-custom-blue mt-1 flex-shrink-0"></i>
                        <span class="fw-medium text-dark">Kolaborasi Multi-Disiplin </span>
                    </div>
                    <div class="highlight-item d-flex align-items-start gap-2">
                        <i class="bi bi-arrow-right-circle-fill text-custom-blue mt-1 flex-shrink-0"></i>
                        <span class="fw-medium text-dark">Pengabdian Masyarakat Berbasis Riset </span>
                    </div>
                </div>

                <div class="mt-4">
                    <img src="<?= $_ENV['APP_URL'] ?>/assets/images/gedung.webp" alt="Gedung Laboratorium (Visual)" class="img-fluid rounded-3 shadow-lg" style="object-fit: cover;">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5" style="background-color: #f8fafc;">
    <div class="container py-lg-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h2 class="display-6 fw-bold text-dark mb-4 text-center">Ketentuan Khusus untuk Skripsi</h2>
                <p class="text-secondary mx-auto mb-5 text-center" style="max-width: 700px;">
                    Mahasiswa yang mengambil topik penelitian di Lab RPL wajib mematuhi batasan khusus berikut untuk memastikan kualitas rekayasa perangkat lunak dalam karya akhir.
                </p>

                <div class="row g-4">
                    
                    <div class="col-md-6">
                        <div class="card h-100 p-4 border-start border-5 border-info shadow-sm">
                            <h5 class="fw-bold text-dark mb-2">Keselarasan Topik & Area Riset</h5>
                            <p class="text-secondary small mb-0">
                                Judul skripsi harus selaras dengan area riset yang difokuskan oleh lab RPL serta sesuai dengan topik-topik yang telah ditetapkan dalam setiap area penelitian].
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card h-100 p-4 border-start border-5 border-primary shadow-sm">
                            <h5 class="fw-bold text-dark mb-2">Fokus pada Aspek Rekayasa Perangkat Lunak</h5>
                            <p class="text-secondary small mb-0">
                                Konten utama dalam pembahasan, analisis, dan diskusi diharapkan lebih menitikberatkan pada aspek rekayasa perangkat lunak (RPL), bukan hanya implementasi fungsional].
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card h-100 p-4 border-start border-5 border-success shadow-sm">
                            <h5 class="fw-bold text-dark mb-2">Tahapan Kerja Well-Organized</h5>
                            <p class="text-secondary small mb-0">
                                Setiap tahapan dalam proses rekayasa perangkat lunak yang dilakukan harus well-organized (mengikuti metodologi/teknik yang jelas, terencana dan terstruktur dengan baik)].
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card h-100 p-4 border-start border-5 border-warning shadow-sm">
                            <h5 class="fw-bold text-dark mb-2">Proses & Hasil Well-Documented</h5>
                            <p class="text-secondary small mb-0">
                                Setiap tahapan rekayasa perangkat lunak dalam pengerjaan skripsi, harus disertai proses dan hasil yang well-documented].
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
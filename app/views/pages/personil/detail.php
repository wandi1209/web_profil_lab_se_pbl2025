<?php 
$pageTitle = "Detail Profile Dosen"; 
?>

<section class="py-5">
    <div class="container">

        <h3 class="fw-bold mb-4">Detail Profile</h3>

        <div class="card shadow-sm p-4">

            <div class="row g-4 align-items-start">

                <!-- FOTO DOSEN -->
                <div class="col-lg-4 text-center">
                    <img src="<?= $_ENV['APP_URL'] ?>/assets/images/user-placeholder.png" 
                         class="img-fluid rounded shadow-sm" 
                         alt="Foto Dosen">
                </div>

                <!-- INFORMASI DOSEN -->
                <div class="col-lg-8">

                    <h4 class="fw-bold mb-1">Dr. Nama Dosen, M.Kom</h4>
                    <p class="text-secondary mb-3">Dosen Pembina Laboratorium</p>

                    <!-- EMAIL -->
                    <div class="mb-3">
                        <strong>Email:</strong>
                        <div class="mt-1">nama@kampus.ac.id</div>
                    </div>

                    <!-- NIDN -->
                    <div class="mb-3">
                        <strong>NIDN:</strong>
                        <div class="mt-1">123456789</div>
                    </div>

                    <!-- KEAHLIAN -->
                    <div class="mb-3">
                        <strong>Bidang Keahlian:</strong>
                        <div class="mt-1">AI & Machine Learning</div>
                    </div>

                    <!-- PENDIDIKAN -->
                    <div class="mb-3">
                        <strong>Riwayat Pendidikan:</strong>
                        <ul class="small mt-1">
                            <li>S3 – Ilmu Komputer</li>
                            <li>S2 – Teknologi Informasi</li>
                            <li>S1 – Informatika</li>
                        </ul>
                    </div>

                    <!-- LINK SOSIAL -->
                    <div class="d-flex gap-3 mt-2">

                        <!-- LinkedIn -->
                        <a href="https://linkedin.com/in/username" 
                        target="_blank" 
                        class="d-inline-flex align-items-center justify-content-center"
                        style="
                                width: 42px; 
                                height: 42px; 
                                border-radius: 50%; 
                                background: #0A66C2; 
                                color: white; 
                                font-size: 20px;
                        ">
                            <i class="bi bi-linkedin"></i>
                        </a>

                        <!-- Github -->
                        <a href="https://github.com/username" 
                        target="_blank" 
                        class="d-inline-flex align-items-center justify-content-center"
                        style="
                                width: 42px; 
                                height: 42px; 
                                border-radius: 50%; 
                                background: #24292e; 
                                color: white; 
                                font-size: 20px;
                        ">
                            <i class="bi bi-github"></i>
                        </a>

                    </div>
                    <br>

                    <hr>

                    <!-- PUBLIKASI -->
                    <div>
                        <strong>Publikasi Terbaru:</strong>
                        <ul class="small mt-1">
                            <li>Machine Learning for Smart Cities – 2024</li>
                            <li>Deep Learning Optimization – 2023</li>
                            <li>Neural Network Improvement – 2022</li>
                        </ul>
                    </div>

                </div>

            </div>

        </div>

        <!-- FOOTER -->
        <footer class="mt-5 p-4 text-center text-secondary small border-top">
            &copy; <?= date('Y') ?> Laboratorium Teknologi Informasi
        </footer>

    </div>
</section>
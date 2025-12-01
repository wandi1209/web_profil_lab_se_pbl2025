<?php 
$pageTitle = "Daftar Mahasiswa Peneliti"; 
?>

<section class="py-5">
    <div class="container">

        <!-- Title -->
        <div class="text-center mb-4">
            <h3 class="fw-bold">Daftar Mahasiswa Peneliti</h3>
            <p class="text-secondary">Mahasiswa aktif yang terlibat dalam riset dan proyek laboratorium.</p>
        </div>

        <div class="row g-4">

            <?php 
            $mhs = [
                ['name' => 'Ahmad Fauzi', 'role' => 'Team Lead', 'prodi' => 'D4 Teknik Informatika'],
                ['name' => 'Sarah Putri', 'role' => 'UI/UX Designer', 'prodi' => 'D4 Sistem Informasi Bisnis'],
                ['name' => 'Dimas Anggara', 'role' => 'Mobile Engineer', 'prodi' => 'D4 Teknik Informatika'],
                ['name' => 'Eka Prasetya', 'role' => 'Data Analyst', 'prodi' => 'D2 Pengembangan Piranti Lunak Situs'],
                ['name' => 'Lina Marlina', 'role' => 'Backend Developer', 'prodi' => 'D4 Sistem Informasi Bisnis'],
                ['name' => 'Rizky Hidayat', 'role' => 'Frontend Developer', 'prodi' => 'D4 Teknik Informatika'],
                ['name' => 'Nina Kurnia', 'role' => 'Research Assistant', 'prodi' => 'D4 Teknik Informatika'],
                ['name' => 'Budi Santoso', 'role' => 'QA Engineer', 'prodi' => 'D2 Pengembangan Piranti Lunak Situs'],
            ];

            foreach ($mhs as $m) :
            ?>

            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="team-card">
                    <div class="team-img-wrapper">
                        <img src="<?= $_ENV['APP_URL'] ?>/assets/images/user-placeholder.png" 
                             alt="<?= $m['name'] ?>">
                    </div>

                    <span class="role-badge" 
                        style="background: rgba(0, 166, 62, 0.1); color: #008236;">
                        <?= $m['prodi'] ?>
                    </span>

                    <h5 class="fw-bold text-dark mb-1"><?= $m['name'] ?></h5>
                    <p class="text-secondary small mb-0"><?= $m['role'] ?></p>

                    <div class="social-links">
                        <a href="#" class="social-btn"><i class="bi bi-github"></i></a>
                        <a href="#" class="social-btn"><i class="bi bi-linkedin"></i></a>
                        <a href="#" class="social-btn"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
            </div>

            <?php endforeach; ?>

        </div>

        <!-- Footer -->
        <footer class="mt-5 p-4 text-center text-secondary small border-top">
            &copy; <?= date('Y') ?> Laboratorium Teknologi Informasi
        </footer>

    </div>
</section>
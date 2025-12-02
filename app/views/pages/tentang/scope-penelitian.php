<?php 
$pageTitle = "Scope Penelitian | Laboratorium Software Engineering"; 
?>

<section class="py-5 bg-light border-bottom">
    <div class="container py-4">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <span class="text-custom-blue fw-bold small text-uppercase ls-1">
                    Research Areas
                </span>
                <h1 class="fw-bold display-6 mt-2 text-dark">
                    Scope Penelitian Laboratorium SE
                </h1>
                <p class="text-secondary mt-3" style="max-width: 700px; margin: auto;">
                    Laboratorium Software Engineering berfokus pada area penelitian yang berkaitan 
                    dengan perkembangan teknologi digital modern. Setiap bidang riset dikembangkan 
                    untuk mendukung inovasi akademik dan industri berbasis teknologi masa depan.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container">

        <?php 
        // Data Scope Penelitian
        $scopes = [
            [
                'title' => 'Web Development',
                'desc'  => 'Rancang bangun aplikasi web modern yang responsif, scalable, dan aman menggunakan teknologi terkini.',
                'icon'  => 'bi-globe',
                'theme' => 'theme-blue',
                'tags'  => ['Fullstack', 'PWA', 'Microservices', 'API']
            ],
            [
                'title' => 'Artificial Intelligence',
                'desc'  => 'Implementasi kecerdasan buatan untuk pemrosesan data, visi komputer, dan sistem pengambilan keputusan.',
                'icon'  => 'bi-cpu-fill',
                'theme' => 'theme-purple',
                'tags'  => ['Deep Learning', 'NLP', 'Computer Vision', 'Data Mining']
            ],
            [
                'title' => 'Mobile Computing',
                'desc'  => 'Pengembangan aplikasi mobile native dan cross-platform yang mengutamakan User Experience (UX).',
                'icon'  => 'bi-phone-fill',
                'theme' => 'theme-green',
                'tags'  => ['Android', 'iOS', 'Flutter', 'IoT Integration']
            ],
            [
                'title' => 'Cyber Security',
                'desc'  => 'Analisis keamanan sistem, pengujian celah keamanan (pentest), dan perlindungan data privasi.',
                'icon'  => 'bi-shield-lock-fill',
                'theme' => 'theme-red',
                'tags'  => ['Network Security', 'Cryptography', 'Forensic', 'Ethical Hacking']
            ],
            [
                'title' => 'Data Science',
                'desc'  => 'Pengolahan big data dan visualisasi interaktif untuk mendukung analisis bisnis dan prediksi tren.',
                'icon'  => 'bi-bar-chart-fill',
                'theme' => 'theme-orange',
                'tags'  => ['Big Data', 'Visualization', 'Business Intelligence', 'Statistics']
            ],
            [
                'title' => 'Cloud Computing',
                'desc'  => 'Arsitektur sistem berbasis awan, manajemen server, dan deployment otomatis (DevOps).',
                'icon'  => 'bi-cloud-check-fill',
                'theme' => 'theme-cyan',
                'tags'  => ['AWS', 'Docker', 'Kubernetes', 'Serverless']
            ],
        ];
        ?>

        <div class="row g-4">

            <?php foreach ($scopes as $s) : ?>
                <div class="col-lg-4 col-md-6">
                    <div class="scope-card <?= $s['theme'] ?>">

                        <i class="bi <?= $s['icon'] ?> scope-bg-icon"></i>

                        <div class="scope-icon-wrapper">
                            <i class="bi <?= $s['icon'] ?>"></i>
                        </div>

                        <h4 class="fw-bold text-dark mb-3"><?= $s['title'] ?></h4>

                        <p class="text-secondary small mb-4">
                            <?= $s['desc'] ?>
                        </p>

                        <div class="scope-tags">
                            <?php foreach ($s['tags'] as $tag) : ?>
                                <span class="scope-tag"><?= $tag ?></span>
                            <?php endforeach; ?>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>

        </div>

    </div>
</section>
<?php 
$pageTitle = "Fokus Riset | Laboratorium Software Engineering";
?>

<style>
    /* Animasi hover untuk card */
    .focus-card {
        transition: all 0.25s ease;
        border-radius: 14px;
    }
    .focus-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.12);
    }

    /* Animasi hover untuk icon di dalam card */
    .focus-icon {
        transition: all 0.25s ease;
    }
    .focus-card:hover .focus-icon {
        background-color: rgba(13, 110, 253, 0.15) !important;
        transform: scale(1.08);
    }
</style>

<section class="py-5 bg-light border-bottom">
    <div class="container py-4">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <span class="text-custom-blue fw-bold small text-uppercase ls-1">
                    Research Focus
                </span>
                <h1 class="fw-bold display-6 mt-2 text-dark">
                    Fokus Riset Laboratorium SE
                </h1>
                <p class="text-secondary mt-3" style="max-width: 700px; margin: auto;">
                    Laboratorium Software Engineering memusatkan penelitian pada beberapa area inti 
                    yang relevan dengan perkembangan teknologi dan kebutuhan industri modern. 
                </p>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container">

        <?php 
        $fokus = [
            [
                "title" => "Software Engineering Methodologies and Architecture",
                "icon"  => "bi-diagram-3-fill",
                "desc"  => "Pengembangan metodologi modern seperti Agile, Scrum, DevOps, 
                            serta eksplorasi arsitektur sistem seperti microservices dan cloud-native."
            ],
            [
                "title" => "Domain-Specific Software Engineering Applications",
                "icon"  => "bi-window-stack",
                "desc"  => "Penerapan rekayasa perangkat lunak pada sektor kesehatan, pendidikan, 
                            pemerintahan, smart city, dan industri 4.0."
            ],
            [
                "title" => "Emerging Technologies in Software Engineering",
                "icon"  => "bi-rocket-takeoff-fill",
                "desc"  => "Eksplorasi teknologi terbaru seperti AI, IoT, Blockchain,
                            serta pengembangan sistem autonomous dan immersive tech."
            ]
        ];
        ?>

        <div class="row g-4">
            <?php foreach ($fokus as $item) : ?>
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm h-100 focus-card">
                        <div class="card-body p-4 d-flex flex-column">

                            <div class="icon-box focus-icon mb-3 d-inline-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10" 
                                 style="width: 58px; height: 58px;">
                                <i class="bi <?= $item['icon'] ?> text-primary" style="font-size: 1.6rem;"></i>
                            </div>

                            <h4 class="fw-bold text-dark mb-3">
                                <?= $item['title'] ?>
                            </h4>

                            <p class="text-secondary small mb-3">
                                <?= $item['desc'] ?>
                            </p>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

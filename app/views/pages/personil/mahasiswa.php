<?php 
$pageTitle = "Daftar Mahasiswa Peneliti"; 
?>

<section class="py-5 section-student-bg">
    <div class="bg-deco-circle"></div>

    <div class="container position-relative" style="z-index: 2;">

        <div class="text-center mb-5 fade-in-down">
            <span class="badge bg-white text-success shadow-sm px-3 py-2 rounded-pill text-uppercase ls-1 mb-3 border">
                <i class="bi bi-stars me-1 text-warning"></i> Talenta Kami
            </span>
            <h2 class="display-6 fw-bold text-dark">Mahasiswa Peneliti</h2>
            <p class="text-secondary mx-auto fs-5" style="max-width: 600px;">
                Generasi penerus yang aktif mengembangkan inovasi teknologi di Laboratorium Software Engineering.
            </p>
        </div>

        <div class="row g-4 justify-content-center">

            <?php if (empty($mahasiswa)): ?>
                <div class="col-12 text-center py-5">
                    <div class="card border-0 shadow-sm rounded-4 p-5 mx-auto" style="max-width: 500px; background: rgba(255,255,255,0.8);">
                        <div class="mb-3">
                            <i class="bi bi-folder-x text-muted opacity-25" style="font-size: 4rem;"></i>
                        </div>
                        <h5 class="fw-bold text-dark">Belum Ada Data</h5>
                        <p class="text-muted mb-0">Data mahasiswa peneliti sedang dalam proses pembaruan.</p>
                    </div>
                </div>
            <?php else: ?>
                
                <?php foreach ($mahasiswa as $index => $m) : ?>
                <div class="col-xl-3 col-lg-4 col-md-6 fade-in-up" style="animation-delay: <?= $index * 100 ?>ms;">
                    
                    <div class="card card-student-premium h-100 border-0 shadow-sm">
                        
                        <div class="card-banner"></div>

                        <div class="card-body text-center px-4 pb-4">
                            
                            <div class="avatar-wrapper">
                                <?php 
                                    $fotoPath = !empty($m['foto_url']) 
                                        ? $_ENV['APP_URL'] . '/public' . $m['foto_url'] 
                                        : $_ENV['APP_URL'] . '/assets/images/person-placeholder.jpg';
                                ?>
                                <img src="<?= $fotoPath ?>" alt="<?= htmlspecialchars($m['nama']) ?>" class="student-avatar">
                            </div>

                            <div class="mt-3">
                                <h5 class="fw-bold text-dark mb-1 text-truncate" title="<?= htmlspecialchars($m['nama']) ?>">
                                    <?= htmlspecialchars($m['nama']) ?>
                                </h5>
                                <span class="badge bg-light text-secondary border fw-normal mb-3">
                                    <?= htmlspecialchars($m['position'] ?? 'Mahasiswa Peneliti') ?>
                                </span>
                            </div>

                            <div class="skills-wrapper mb-4">
                                <?php 
                                    $skills = array_filter(array_map('trim', explode(',', $m['keahlian'] ?? '')));
                                    if (!empty($skills)):
                                        foreach (array_slice($skills, 0, 3) as $skill): 
                                ?>
                                    <span class="skill-tag"><?= htmlspecialchars($skill) ?></span>
                                <?php 
                                        endforeach;
                                        if (count($skills) > 3): 
                                ?>
                                    <span class="skill-tag-more">+<?= count($skills) - 3 ?></span>
                                <?php 
                                        endif;
                                    endif; 
                                ?>
                            </div>

                            <div class="social-group">
                                <?php if (!empty($m['linkedin'])): ?>
                                    <a href="<?= htmlspecialchars($m['linkedin']) ?>" target="_blank" class="social-link linkedin" data-bs-toggle="tooltip" title="LinkedIn">
                                        <i class="bi bi-linkedin"></i>
                                    </a>
                                <?php endif; ?>

                                <?php if (!empty($m['github'])): ?>
                                    <a href="<?= htmlspecialchars($m['github']) ?>" target="_blank" class="social-link github" data-bs-toggle="tooltip" title="GitHub">
                                        <i class="bi bi-github"></i>
                                    </a>
                                <?php endif; ?>

                                <?php if (!empty($m['email'])): ?>
                                    <a href="mailto:<?= htmlspecialchars($m['email']) ?>" class="social-link email" data-bs-toggle="tooltip" title="Email">
                                        <i class="bi bi-envelope-fill"></i>
                                    </a>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>

                </div>
                <?php endforeach; ?>

            <?php endif; ?>

        </div>
    </div>
</section>

<style>
/* --- Background Area --- */
.section-student-bg {
    background-color: #f3f4f6;
    min-height: 100vh;
    position: relative;
    overflow: hidden;
}

.bg-deco-circle {
    position: absolute;
    top: -10%; right: -5%;
    width: 600px; height: 600px;
    background: radial-gradient(circle, rgba(25,135,84,0.05) 0%, rgba(255,255,255,0) 70%);
    border-radius: 50%;
    z-index: 1;
}

/* --- Card Structure --- */
.card-student-premium {
    border-radius: 20px;
    background: #fff;
    transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
    overflow: hidden;
    position: relative;
}

.card-student-premium:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
}

/* --- Banner Gradient --- */
.card-banner {
    height: 90px;
    background: linear-gradient(135deg, #198754 0%, #20c997 100%); /* Green Teal Gradient */
    width: 100%;
    position: relative;
}

/* --- Avatar --- */
.avatar-wrapper {
    margin-top: -50px; /* Pull up to overlap banner */
    position: relative;
    display: inline-block;
}

.student-avatar {
    width: 100px; height: 100px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #fff;
    background: #fff;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

/* --- Typography --- */
.ls-1 { letter-spacing: 1px; }

/* --- Skills Pills --- */
.skills-wrapper {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 6px;
    min-height: 30px;
}

.skill-tag {
    font-size: 0.75rem;
    font-weight: 600;
    color: #198754;
    background: #e9f7ef;
    padding: 4px 12px;
    border-radius: 50px;
    border: 1px solid #d1e7dd;
}

.skill-tag-more {
    font-size: 0.7rem;
    color: #6c757d;
    background: #f8f9fa;
    padding: 4px 8px;
    border-radius: 50px;
    border: 1px solid #dee2e6;
}

/* --- Social Buttons --- */
.social-group {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-top: auto;
}

.social-link {
    width: 38px; height: 38px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    background: #fff;
    border: 1px solid #e2e8f0;
    color: #64748b;
    font-size: 1.1rem;
    transition: all 0.2s;
    text-decoration: none;
}

.social-link:hover {
    transform: scale(1.1);
    border-color: transparent;
    color: #fff;
}

.social-link.linkedin:hover { background: #0077b5; box-shadow: 0 4px 10px rgba(0,119,181,0.3); }
.social-link.github:hover { background: #333; box-shadow: 0 4px 10px rgba(51,51,51,0.3); }
.social-link.email:hover { background: #dc3545; box-shadow: 0 4px 10px rgba(220,53,69,0.3); }

/* --- Animations --- */
.fade-in-down {
    animation: fadeInDown 0.8s ease-out forwards;
}

.fade-in-up {
    animation: fadeInUp 0.8s ease-out forwards;
    opacity: 0;
    transform: translateY(30px);
}

@keyframes fadeInDown {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes fadeInUp {
    to { opacity: 1; transform: translateY(0); }
}
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>
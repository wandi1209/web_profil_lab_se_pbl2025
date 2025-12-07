<?php 
// 1. Cek Kategori Dosen
$isDosen = isset($personil['kategori']) && $personil['kategori'] === 'Dosen';
$pageTitle = $isDosen ? "Detail Profil Dosen" : "Detail Profil Anggota";

// 2. Setup Foto URL
$fotoUrl = !empty($personil['foto_url']) 
    ? $_ENV['APP_URL'] . (strpos($personil['foto_url'], '/public') === 0 ? $personil['foto_url'] : '/public' . $personil['foto_url'])
    : $_ENV['APP_URL'] . '/assets/images/person-placeholder.jpg';

// 3. Cek Ketersediaan Link Sosmed
$hasLinkedin = !empty($personil['linkedin']);
$hasGithub   = !empty($personil['github']);
$hasSinta    = $isDosen && !empty($personil['link_sinta']);
$hasScholar  = $isDosen && !empty($personil['link_scholar']);
$hasSosmed   = $hasLinkedin || $hasGithub || $hasSinta || $hasScholar;
?>

<section class="py-5 section-profile-bg">
    <div class="container py-4">
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
            
            <div class="profile-header-banner"></div>

            <div class="card-body px-4 px-md-5 pb-5">
                
                <div class="row align-items-end" style="margin-top: -80px;">
                    <div class="col-lg-3 text-center text-lg-start">
                        <div class="position-relative d-inline-block">
                            <img src="<?= $fotoUrl ?>" alt="Foto Profil" class="profile-avatar shadow-lg">
                            <span class="badge-role shadow-sm">
                                <?= htmlspecialchars(ucwords($personil['kategori'] ?? 'Anggota')) ?>
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-9 text-center text-lg-start mt-3 mt-lg-0">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-end h-100 pb-2">
                            <div>
                                <h2 class="fw-bold text-dark mb-1 display-6"><?= htmlspecialchars($personil['nama']) ?></h2>
                                <p class="text-secondary fs-5 mb-2 mb-md-0"><?= htmlspecialchars($personil['position']) ?></p>
                            </div>
                            
                            <?php if ($hasSosmed): ?>
                            <div class="d-flex gap-2">
                                <?php if ($hasLinkedin): ?>
                                <a href="<?= htmlspecialchars($personil['linkedin']) ?>" target="_blank" class="social-btn linkedin" title="LinkedIn"><i class="bi bi-linkedin"></i></a>
                                <?php endif; ?>
                                
                                <?php if ($hasGithub): ?>
                                <a href="<?= htmlspecialchars($personil['github']) ?>" target="_blank" class="social-btn github" title="GitHub"><i class="bi bi-github"></i></a>
                                <?php endif; ?>
                                
                                <?php if ($hasSinta): ?>
                                <a href="<?= htmlspecialchars($personil['link_sinta']) ?>" target="_blank" class="social-btn sinta" title="SINTA ID"><span>S</span></a>
                                <?php endif; ?>
                                
                                <?php if ($hasScholar): ?>
                                <a href="<?= htmlspecialchars($personil['link_scholar']) ?>" target="_blank" class="social-btn scholar" title="Google Scholar"><i class="bi bi-google"></i></a>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <hr class="my-5 border-light">

                <div class="row g-5">
                    
                    <div class="col-lg-4">
                        
                        <div class="mb-5">
                            <h6 class="text-uppercase text-muted fw-bold small ls-1 mb-3">Kontak & Identitas</h6>
                            
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-square bg-light text-primary me-3">
                                    <i class="bi bi-envelope-fill"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Email</small>
                                    <a href="mailto:<?= htmlspecialchars($personil['email']) ?>" class="text-dark fw-bold text-decoration-none">
                                        <?= htmlspecialchars($personil['email']) ?>
                                    </a>
                                </div>
                            </div>

                            <?php if (!empty($personil['nidn'])): ?>
                            <div class="d-flex align-items-center">
                                <div class="icon-square bg-light text-success me-3">
                                    <i class="bi bi-person-vcard-fill"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block"><?= $isDosen ? 'NIDN/NIP' : 'NIM/NIP' ?></small>
                                    <span class="text-dark fw-bold"><?= htmlspecialchars($personil['nidn']) ?></span>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>

                        <?php if (!empty($personil['keahlian'])): ?>
                        <div>
                            <h6 class="text-uppercase text-muted fw-bold small ls-1 mb-3">Bidang Keahlian</h6>
                            <div class="d-flex flex-wrap gap-2">
                                <?php 
                                    $skills = array_filter(array_map('trim', explode(',', $personil['keahlian'])));
                                    foreach ($skills as $skill): 
                                ?>
                                    <span class="skill-badge"><?= htmlspecialchars($skill) ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>

                    </div>

                    <div class="col-lg-8 border-start-lg ps-lg-5">
                        
                        <?php if (!empty($pendidikan)): ?>
                        <div class="mb-5">
                            <div class="d-flex align-items-center mb-4">
                                <div class="icon-circle bg-primary-subtle text-primary me-3"><i class="bi bi-mortarboard-fill"></i></div>
                                <h4 class="fw-bold mb-0">Riwayat Pendidikan</h4>
                            </div>
                            
                            <div class="timeline ps-2">
                                <?php foreach ($pendidikan as $item): ?>
                                    <div class="timeline-item">
                                        <div class="timeline-dot"></div>
                                        <div class="timeline-content">
                                            <p class="mb-0 fw-medium text-dark fs-6"><?= htmlspecialchars($item) ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if (!empty($publikasi)): ?>
                        <div>
                            <div class="d-flex align-items-center mb-4">
                                <div class="icon-circle bg-danger-subtle text-danger me-3"><i class="bi bi-journal-bookmark-fill"></i></div>
                                <h4 class="fw-bold mb-0">Publikasi Terbaru</h4>
                            </div>

                            <div class="d-flex flex-column gap-3">
                                <?php foreach ($publikasi as $item): ?>
                                    <div class="pub-card">
                                        <i class="bi bi-file-earmark-text-fill text-secondary fs-4"></i>
                                        <span class="text-dark"><?= htmlspecialchars($item) ?></span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<style>
/* --- General --- */
.section-profile-bg {
    background-color: #f0f2f5;
    min-height: 100vh;
}
.ls-1 { letter-spacing: 1px; }
.border-start-lg { border-left: 1px solid #eee; }
@media (max-width: 991px) { .border-start-lg { border-left: none; } }

/* --- Banner & Avatar --- */
.profile-header-banner {
    height: 180px;
    background: linear-gradient(120deg, #073272ff 0%, #13537dff 100%);
    position: relative;
}
.profile-avatar {
    width: 160px;
    height: 160px;
    object-fit: cover;
    border-radius: 50%;
    border: 5px solid #fff;
    background: #fff;
}
.badge-role {
    position: absolute;
    bottom: 5px;
    right: 5px;
    background: #fff;
    color: #0d6efd;
    font-weight: 700;
    padding: 6px 16px;
    border-radius: 50px;
    font-size: 0.85rem;
    border: 1px solid #e0e0e0;
}

/* --- Social Buttons --- */
.social-btn {
    width: 40px; height: 40px;
    border-radius: 10px;
    display: inline-flex;
    align-items: center; justify-content: center;
    color: #fff; font-size: 1.2rem;
    transition: all 0.2s ease;
    text-decoration: none;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}
.social-btn:hover { transform: translateY(-3px); color: #fff; }
.social-btn.linkedin { background: #0077b5; }
.social-btn.github { background: #333; }
.social-btn.sinta { background: #ff9f00; font-family: serif; font-weight: bold; }
.social-btn.scholar { background: #4285F4; }

/* --- Icons & Badges --- */
.icon-square {
    width: 45px; height: 45px;
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.25rem;
}
.icon-circle {
    width: 40px; height: 40px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.2rem;
}
.skill-badge {
    background: #f8f9fa;
    border: 1px solid #e9ecef;
    color: #495057;
    padding: 6px 14px;
    border-radius: 50px;
    font-size: 0.85rem;
    font-weight: 500;
}

/* --- Timeline --- */
.timeline {
    border-left: 2px solid #e9ecef;
    margin-left: 10px;
    padding-bottom: 5px;
}
.timeline-item {
    position: relative;
    padding-left: 30px;
    margin-bottom: 20px;
}
.timeline-item:last-child { margin-bottom: 0; }
.timeline-dot {
    width: 12px; height: 12px;
    background: #0d6efd;
    border-radius: 50%;
    position: absolute;
    left: -7px; top: 5px;
    border: 2px solid #fff;
    box-shadow: 0 0 0 2px rgba(13, 110, 253, 0.2);
}

/* --- Publication Card --- */
.pub-card {
    background: #fff;
    border: 1px solid #f0f0f0;
    padding: 15px;
    border-radius: 12px;
    display: flex; gap: 15px; align-items: start;
    transition: all 0.2s;
}
.pub-card:hover {
    border-color: #0d6efd;
    background: #fcfdff;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}
</style>
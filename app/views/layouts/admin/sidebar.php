<?php
$current = $_SERVER['REQUEST_URI'] ?? '';
?>

<div id="sidebar" class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" 
     style="width: 280px; height: 100vh; position: sticky; top: 0; overflow-y: auto;">
    
    <ul class="nav nav-pills flex-column mb-auto">
        
        <li class="nav-item mb-3">
            <a href="<?= $_ENV['APP_URL'] ?>/admin/dashboard"
                class="nav-link text-white <?= str_contains($current, '/admin/dashboard') ? 'active' : '' ?>">
                <i class="bi bi-speedometer2 me-2"></i>
                <span>CMS Dashboard</span>
            </a>
        </li>

        <div class="sidebar-header text-center border-bottom border-secondary mb-3 pb-3">
            <h6 class="text-white m-0"><?= $_SESSION['username'] ?? 'Admin' ?></h6>
        </div>

        <li class="nav-item">
            <button class="nav-link text-white w-100 text-start d-flex justify-content-between align-items-center <?= str_contains($current, '/admin/profile') ? '' : 'collapsed' ?>"
                    type="button"
                    id="btn-profile"
                    onclick="toggleMenu('profileSubmenu', this)">
                <span><i class="bi bi-person me-2"></i> Profile</span>
                <i class="bi bi-chevron-down small"></i>
            </button>

            <div class="collapse <?= str_contains($current, '/admin/profile') ? 'show' : '' ?>" id="profileSubmenu">
                <ul class="list-unstyled fw-normal pb-1 small ms-3 mt-1 bg-dark bg-opacity-50 rounded">
                    <li><a href="<?= $_ENV['APP_URL'] ?>/admin/profile/tentangLab" class="nav-link text-white-50 <?= str_contains($current, 'tentangLab') ? 'text-white fw-bold' : '' ?>"><i class="bi bi-info-circle me-2"></i> Tentang Lab SE</a></li>
                    <li><a href="<?= $_ENV['APP_URL'] ?>/admin/profile/visiMisi" class="nav-link text-white-50 <?= str_contains($current, 'visiMisi') ? 'text-white fw-bold' : '' ?>"><i class="bi bi-eye me-2"></i> Visi & Misi</a></li>
                    <li><a href="<?= $_ENV['APP_URL'] ?>/admin/profile/roadmap" class="nav-link text-white-50 <?= str_contains($current, 'roadmap') ? 'text-white fw-bold' : '' ?>"><i class="bi bi-map me-2"></i> Roadmap</a></li>
                    <li><a href="<?= $_ENV['APP_URL'] ?>/admin/profile/scopePenelitian" class="nav-link text-white-50 <?= str_contains($current, 'scope') ? 'text-white fw-bold' : '' ?>"><i class="bi bi-search me-2"></i> Scope Penelitian</a></li>
                    <li><a href="<?= $_ENV['APP_URL'] ?>/admin/profile/album" class="nav-link text-white-50 <?= str_contains($current, 'album') ? 'text-white fw-bold' : '' ?>"><i class="bi bi-images me-2"></i> Album</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item mt-1">
            <button class="nav-link text-white w-100 text-start d-flex justify-content-between align-items-center <?= str_contains($current, '/admin/personil') ? '' : 'collapsed' ?>"
                    type="button"
                    id="btn-personil"
                    onclick="toggleMenu('personilSubmenu', this)">
                <span><i class="bi bi-person-badge me-2"></i> Personil</span>
                <i class="bi bi-chevron-down small"></i>
            </button>

            <div class="collapse <?= str_contains($current, '/admin/personil') ? 'show' : '' ?>" id="personilSubmenu">
                <ul class="list-unstyled fw-normal pb-1 small ms-3 mt-1 bg-dark bg-opacity-50 rounded">
                    <li><a href="<?= $_ENV['APP_URL'] ?>/admin/personil/dosen" class="nav-link text-white-50 <?= str_contains($current, '/admin/personil/dosen') ? 'text-white fw-bold' : '' ?>"><i class="bi bi-person-video3 me-2"></i> Dosen</a></li>
                    <li><a href="<?= $_ENV['APP_URL'] ?>/admin/personil/mahasiswa" class="nav-link text-white-50 <?= str_contains($current, '/admin/personil/mahasiswa') ? 'text-white fw-bold' : '' ?>"><i class="bi bi-mortarboard-fill me-2"></i> Mahasiswa</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item mt-1">
            <a href="<?= $_ENV['APP_URL'] ?>/admin/blog" class="nav-link text-white <?= str_contains($current, '/admin/blog') ? 'active' : '' ?>">
                <i class="bi bi-newspaper me-2"></i> Blog Artikel
            </a>
        </li>
        <li class="nav-item mt-1">
            <a href="<?= $_ENV['APP_URL'] ?>/admin/rekrutmen" class="nav-link text-white <?= str_contains($current, '/admin/rekrutmen') ? 'active' : '' ?>">
                <i class="bi bi-megaphone me-2"></i> Rekrutmen
            </a>
        </li>
    </ul>

    <div class="sidebar-logout mt-auto pt-3 border-top border-secondary">
        <a href="<?= $_ENV['APP_URL'] ?>/logout" class="nav-link text-white bg-danger bg-opacity-25 rounded text-center">
            <i class="bi bi-box-arrow-left me-2"></i> Log Out
        </a>
    </div>
</div>

<script>
function toggleMenu(targetId, clickedBtn) {
    // 1. CARI SEMUA MENU YANG SEDANG TERBUKA
    var allCollapses = document.querySelectorAll('.collapse.show');
    var allButtons = document.querySelectorAll('button[onclick^="toggleMenu"]');
    
    // 2. TUTUP MENU LAIN (Kecuali yang sedang diklik)
    allCollapses.forEach(function(el) {
        if (el.id !== targetId) {
            // Tutup pakai Bootstrap Instance
            if (typeof bootstrap !== 'undefined') {
                var bsInstance = bootstrap.Collapse.getInstance(el);
                if (bsInstance) bsInstance.hide();
            }
            // Paksa hapus class show (untuk safety)
            el.classList.remove('show'); 
        }
    });

    // 3. RESET VISUAL TOMBOL LAIN (Panah & Warna)
    allButtons.forEach(function(btn) {
        if (btn !== clickedBtn) {
            btn.classList.add('collapsed');
            btn.setAttribute('aria-expanded', 'false');
        }
    });

    // 4. TOGGLE MENU YANG DIKLIK
    var targetMenu = document.getElementById(targetId);
    
    if (typeof bootstrap !== 'undefined') {
        // Gunakan Bootstrap API
        // getOrCreateInstance memastikan tidak error jika belum diinisialisasi
        var bsCollapse = bootstrap.Collapse.getOrCreateInstance(targetMenu, { toggle: false });
        bsCollapse.toggle();
    } else {
        // Fallback Manual (Jika Bootstrap JS error/telat load)
        if (targetMenu.classList.contains('show')) {
            targetMenu.classList.remove('show');
            clickedBtn.classList.add('collapsed');
            clickedBtn.setAttribute('aria-expanded', 'false');
        } else {
            targetMenu.classList.add('show');
            clickedBtn.classList.remove('collapsed');
            clickedBtn.setAttribute('aria-expanded', 'true');
        }
    }
}
</script>
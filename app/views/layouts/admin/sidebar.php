<?php
$current = $_SERVER['REQUEST_URI'] ?? '';
?>
<div id="sidebar" class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark">
    <!-- Header Sidebar -->
    <li class="nav-item no-bullet">
        <a href="<?= $_ENV['APP_URL'] ?>/admin/dashboard"
            class="nav-link cms-title <?= str_contains($current, '/admin/dashboard') ? 'active' : '' ?>">
            <span>CMS Dashboard</span>
        </a>
    </li>

    <!-- Sidebar Header Admin Info -->
    <div class="sidebar-header text-center ">
        <h6 class="text-white mt-1 mb-3">
            <?= $_SESSION['user_name'] ?? 'Nama Admin' ?>
        </h6>
    </div>

    <!-- Menu -->
    <ul class="nav flex-column mb-auto" id="sidebarMenuList">

        <!-- PROFILE -->
        <li class="nav-item">
            <a class="nav-link dropdown-toggle <?= str_contains($current, '/admin/profile') ? '' : 'collapsed' ?>"
               href="#profileSubmenu"
               data-bs-toggle="collapse"
               aria-expanded="<?= str_contains($current, '/admin/profile') ? 'true' : 'false' ?>">
                <i class="bi bi-person"></i> Profile
            </a>

            <div class="collapse <?= str_contains($current, '/admin/profile') ? 'show' : '' ?>"
                 id="profileSubmenu">
                <ul class="list-unstyled fw-normal pb-1 small ms-3">
                    <li>
                        <a href="<?= $_ENV['APP_URL'] ?>/admin/profile/tentangLab"
                           class="nav-link <?= str_contains($current, 'tentangLab') ? 'active' : '' ?>">
                            <i class="bi bi-info-circle"></i> Tentang Lab SE
                        </a>
                    </li>
                    <li>
                        <a href="<?= $_ENV['APP_URL'] ?>/admin/profile/visiMisi"
                           class="nav-link <?= str_contains($current, 'visiMisi') ? 'active' : '' ?>">
                            <i class="bi bi-eye"></i> Visi & Misi
                        </a>
                    </li>
                    <li>
                        <a href="<?= $_ENV['APP_URL'] ?>/admin/profile/roadmap"
                           class="nav-link <?= str_contains($current, 'roadmap') ? 'active' : '' ?>">
                            <i class="bi bi-map"></i> Roadmap
                        </a>
                    </li>
                    <li>
                        <a href="<?= $_ENV['APP_URL'] ?>/admin/profile/scopePenelitian"
                           class="nav-link <?= str_contains($current, 'scope') ? 'active' : '' ?>">
                            <i class="bi bi-search"></i> Scope Penelitian
                        </a>
                    </li>
                    <li>
                        <a href="<?= $_ENV['APP_URL'] ?>/admin/profile/album"
                           class="nav-link <?= str_contains($current, 'album') ? 'active' : '' ?>">
                            <i class="bi bi-images"></i> Album
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- PERSONIL -->
        <li class="nav-item mt-2">
            <a class="nav-link dropdown-toggle <?= str_contains($current, '/admin/personil') ? '' : 'collapsed' ?>"
               href="#personilSubmenu"
               data-bs-toggle="collapse"
               aria-expanded="<?= str_contains($current, '/admin/personil') ? 'true' : 'false' ?>">
                <i class="bi bi-person-badge"></i> Personil
            </a>

            <div class="collapse <?= str_contains($current, '/admin/personil') ? 'show' : '' ?>" id="personilSubmenu">
                <ul class="list-unstyled fw-normal pb-1 small ms-3">
                    <li>
                        <a href="<?= $_ENV['APP_URL'] ?>/admin/personil/dosen"
                           class="nav-link <?= str_contains($current, '/admin/personil/dosen') ? 'active' : '' ?>">
                            <i class="bi bi-person-video3"></i> Dosen
                        </a>
                    </li>
                    <li>
                        <a href="<?= $_ENV['APP_URL'] ?>/admin/personil/mahasiswa"
                           class="nav-link <?= str_contains($current, '/admin/personil/mahasiswa') ? 'active' : '' ?>">
                            <i class="bi bi-mortarboard-fill"></i> Mahasiswa
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- BLOG -->
        <li class="nav-item mt-2">
            <a href="<?= $_ENV['APP_URL'] ?>/admin/blog"
               class="nav-link <?= str_contains($current, '/admin/blog') ? 'active' : '' ?>">
                <i class="bi bi-megaphone"></i> Blog Artikel
            </a>
        </li>

        <!-- REKRUTMEN -->
        <li class="nav-item">
            <a href="<?= $_ENV['APP_URL'] ?>/admin/rekrutmen"
               class="nav-link <?= str_contains($current, '/admin/rekrutmen') ? 'active' : '' ?>">
                <i class="bi bi-megaphone"></i> Rekrutmen
            </a>
        </li>
    </ul>

    <!-- LOGOUT -->
    <div class="sidebar-logout mt-auto p-2 border-top border-secondary">
        <a href="<?= $_ENV['APP_URL'] ?>/logout" class="nav-link">
            <i class="bi bi-box-arrow-left"></i> Log Out
        </a>
    </div>
</div>

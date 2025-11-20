<div id="sidebar" class="d-flex flex-column">
    <!-- Header Sidebar -->
    <div class="sidebar-header p-3 border-bottom border-secondary">
        <h5 class="text-white m-0">CMS Dashboard</h5>
        <small class="text-secondary">
            <?= $_SESSION['userName'] ?? 'Nama Admin' ?>
        </small>
    </div>

    <!-- Menu -->
    <ul class="nav flex-column mb-auto" id="sidebarMenuList">

        <!-- PROFILE -->
        <li class="nav-item">
            <a class="nav-link dropdown-toggle 
               <?= (str_contains($current, '/admin/tentang-lab') || str_contains($current, '/admin/visi-misi')) ? '' : 'collapsed' ?>"
               href="#profileSubmenu"
               data-bs-toggle="collapse"
               aria-expanded="<?= (str_contains($current, '/admin/tentang-lab') || str_contains($current, '/admin/visi-misi')) ? 'true' : 'false' ?>"
               aria-controls="profileSubmenu">

                <i class="bi bi-person"></i> Profile
            </a>

            <div class="collapse 
                <?= (str_contains($current, '/admin/tentang-lab') || str_contains($current, '/admin/visi-misi')) ? 'show' : '' ?>"
                id="profileSubmenu"
                data-bs-parent="#sidebarMenuList">

                <ul class="list-unstyled fw-normal pb-1 small ms-3">

                    <li>
                        <a href="<?= $_ENV['APP_URL'] ?>/admin/tentang-lab"
                           class="nav-link 
                           <?= str_contains($current, 'tentang-lab') ? 'active' : '' ?>">
                            <i class="bi bi-info-circle"></i> Tentang Lab SE
                        </a>
                    </li>

                    <li>
                        <a href="<?= $_ENV['APP_URL'] ?>/admin/visi-misi"
                           class="nav-link 
                           <?= str_contains($current, 'visi-misi') ? 'active' : '' ?>">
                            <i class="bi bi-eye"></i> Visi & Misi
                        </a>
                    </li>

                    <li>
                        <a href="<?= $_ENV['APP_URL'] ?>/admin/roadmap"
                           class="nav-link 
                           <?= str_contains($current, 'roadmap') ? 'active' : '' ?>">
                            <i class="bi bi-map"></i> Roadmap
                        </a>
                    </li>

                    <li>
                        <a href="<?= $_ENV['APP_URL'] ?>/admin/scope"
                           class="nav-link 
                           <?= str_contains($current, 'scope') ? 'active' : '' ?>">
                            <i class="bi bi-search"></i> Scope Penelitian
                        </a>
                    </li>

                    <li>
                        <a href="<?= $_ENV['APP_URL'] ?>/admin/album"
                           class="nav-link 
                           <?= str_contains($current, 'album') ? 'active' : '' ?>">
                            <i class="bi bi-images"></i> Album
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- PERSONIL -->
        <li class="nav-item mt-2">
            <a class="nav-link dropdown-toggle 
               <?= str_contains($current, '/admin/personil') ? '' : 'collapsed' ?>"
               href="#personilSubmenu"
               data-bs-toggle="collapse"
               aria-expanded="<?= str_contains($current, '/admin/personil') ? 'true' : 'false' ?>"
               aria-controls="personilSubmenu">

                <i class="bi bi-person-badge"></i> Personil
            </a>

            <div class="collapse 
                <?= str_contains($current, '/admin/personil') ? 'show' : '' ?>"
                id="personilSubmenu"
                data-bs-parent="#sidebarMenuList">

                <ul class="list-unstyled fw-normal pb-1 small ms-3">

                    <li>
                        <a href="<?= $_ENV['APP_URL'] ?>/admin/personil/dosen"
                           class="nav-link 
                           <?= str_contains($current, '/admin/personil/dosen') ? 'active' : '' ?>">
                            <i class="bi bi-person-video3"></i> Dosen
                        </a>
                    </li>

                    <li>
                        <a href="<?= $_ENV['APP_URL'] ?>/admin/personil/mahasiswa"
                           class="nav-link 
                           <?= str_contains($current, '/admin/personil/mahasiswa') ? 'active' : '' ?>">
                            <i class="bi bi-mortarboard-fill"></i> Mahasiswa
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- BLOG -->
        <li class="nav-item mt-2">
            <a href="<?= $_ENV['APP_URL'] ?>/admin/blog"
               class="nav-link 
               <?= str_contains($current, '/admin/blog') ? 'active' : '' ?>">
                <i class="bi bi-file-text"></i> Blog Artikel
            </a>
        </li>

        <!-- REKRUTMEN -->
        <li class="nav-item">
            <a href="<?= $_ENV['APP_URL'] ?>/admin/rekrutmen"
               class="nav-link 
               <?= str_contains($current, '/admin/rekrutmen') ? 'active' : '' ?>">
                <i class="bi bi-megaphone"></i> Rekrutmen
            </a>
        </li>

    </ul>

    <!-- LOGOUT -->
    <div class="sidebar-logout mt-auto p-3 border-top border-secondary">
        <a href="<?= $_ENV['APP_URL'] ?>/logout" class="nav-link">
            <i class="bi bi-box-arrow-left"></i> Log Out
        </a>
    </div>
</div>

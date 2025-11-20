<?php
namespace Polinema\WebProfilLabSe\Controllers;

use Polinema\WebProfilLabSe\Core\Controller;

class AdminController extends Controller {

    public function __construct() {

    }

    public function index() {
        require_once(__DIR__ . '/../views/layouts/header.php');
        ?>

        <?php
        require_once(__DIR__ . '/../views/layouts/sidebar.php');

        // Halaman utama
        $this->view('pages/admin/index');

        // Footer
        require_once(__DIR__ . '/../views/layouts/footer.php');
        ?>

        <!-- Script Active Dropdown -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const subLinks = document.querySelectorAll('.sub-link');

                subLinks.forEach(link => {
                    link.addEventListener('click', function() {
                        subLinks.forEach(sub => sub.classList.remove('active-sub-link'));
                        this.classList.add('active-sub-link');

                        document.querySelectorAll('.nav-link.dropdown-toggle')
                            .forEach(item => item.classList.remove('active'));

                        const parentLink = this.closest('.collapse').previousElementSibling;
                        if (parentLink) parentLink.classList.add('active');
                    });
                });
            });
        </script>
        <?php
    }
}

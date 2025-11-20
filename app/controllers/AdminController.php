<?php
namespace Polinema\WebProfilLabSe\Controllers;

use Polinema\WebProfilLabSe\Core\Controller;

class AdminController extends Controller {

    public function __construct() {
        // Logika konstruktor, jika ada
    }

    /**
     * Menampilkan Dashboard Admin menggunakan layout Admin.
     */
    public function index() {
        $data = [
            'title' => 'Dashboard Admin' // Contoh data yang mungkin dibutuhkan oleh view atau layout
        ];

        // 1. Panggil view dengan parameter:
        //    - 'pages/admin/index' (nama view yang akan dimuat)
        //    - $data (data yang akan diekstrak)
        //    - true (gunakan layout)
        //    - 'admin' (gunakan layout khusus admin, yaitu layouts/admin/header.php dan footer.php)
        $this->view('pages/admin/index', $data, true, 'admin');

        // Catatan: Karena $this->view() sudah me-require header dan footer (yang mungkin 
        // sudah termasuk sidebar), Anda tidak perlu lagi require_once() secara manual.
        
        // Namun, jika Script Active Dropdown adalah script spesifik halaman dashboard 
        // dan tidak termasuk dalam footer.php, Anda bisa menambahkannya setelah pemanggilan $this->view().
        // Jika skrip ini dibutuhkan di setiap halaman admin, sebaiknya pindahkan ke layouts/admin/footer.php.
        ?>

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
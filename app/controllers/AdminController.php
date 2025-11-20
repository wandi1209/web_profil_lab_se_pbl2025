<?php
namespace Polinema\WebProfilLabSe\Controllers;

use Polinema\WebProfilLabSe\Core\Controller;

class AdminController extends Controller {

    public function __construct() {
        // Logika konstruktor
    }

    public function index() {
        $data = [
            'title' => 'Dashboard Admin' 
        ];
        $this->view('pages/admin/index', $data, true, 'admin');
        ?>
        <?php
    }
}
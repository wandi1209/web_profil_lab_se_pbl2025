<?php
// Tentukan namespace
namespace Polinema\WebProfilLabSe\Controllers\Admin;
use Polinema\WebProfilLabSe\Core\Controller;

class ProfileController extends Controller {

    public function __construct() {
        // tempat load model
    }

    public function index() {
        $this->view('pages/admin/profile/index');
    }

    public function tentangLab() {
    // load model kalau ada
    // misal $dataTentang = $this->model("TentangModel")->getAll();

    $dataTentang = []; // sementara kosong biar tidak error

    $this->view('pages/admin/profile/tentangLab', [
        'dataTentang' => $dataTentang
    ]);
}

}
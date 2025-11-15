<?php
// Tentukan namespace
namespace Polinema\WebProfilLabSe\Controllers\Admin;
use Polinema\WebProfilLabSe\Core\Controller;

class RekrutmenController extends Controller {

    public function __construct() {
        // tempat load model
    }

    public function index() {
        $this->view('pages/admin/rekrutmen/index');
    }
}
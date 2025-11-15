<?php
// Tentukan namespace
namespace Polinema\WebProfilLabSe\Controllers;
use Polinema\WebProfilLabSe\Core\Controller;

class AdminController extends Controller {

    public function __construct() {
        // tempat load model
    }

    public function index() {
        $this->view('pages/admin/index');
    }
}
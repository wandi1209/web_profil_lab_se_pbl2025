<?php
// Tentukan namespace
namespace Polinema\WebProfilLabSe\Controllers;
use Polinema\WebProfilLabSe\Core\Controller;

class AuthController extends Controller {

    public function __construct() {
        // tempat load model
    }

    public function login() {
        $this->view('pages/auth/login');
    }
}
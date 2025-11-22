<?php

namespace Polinema\WebProfilLabSe\Controllers\Admin;

use Polinema\WebProfilLabSe\Core\Controller;

class PersonilController extends Controller
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION['is_login'])) {
            header('Location: /web_profil_lab_se/login');
            exit;
        }
    }

    public function index()
    {
        $dataDosen = [];

        $data = [
            'title'     => 'Personil Dosen Lab SE',
            'dataDosen' => $dataDosen
        ];

        $this->view('pages/admin/personil/dosen', $data);
    }
}

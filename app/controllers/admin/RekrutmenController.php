<?php

namespace Polinema\WebProfilLabSe\Controllers\Admin;

use Polinema\WebProfilLabSe\Core\Controller;

class RekrutmenController extends Controller
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
        $dataRekrutmen = [];

        $data = [
            'title' => 'Data Rekrutmen Mahasiswa Lab',
            'dataRekrutmen' => $dataRekrutmen
        ];

        $this->view('pages/admin/rekrutmen/index', $data, true, 'admin');
    }
    
}

<?php

namespace Polinema\WebProfilLabSe\Controllers\Admin;

use Polinema\WebProfilLabSe\Core\Controller;

class BlogController extends Controller
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
        $data = [
            'title' => 'Kelola Blog Artikel'
        ];

        $this->view('pages/admin/blog/index', $data, true, 'admin');
    }
}

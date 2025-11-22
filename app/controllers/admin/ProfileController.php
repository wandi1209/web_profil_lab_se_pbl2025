<?php

namespace Polinema\WebProfilLabSe\Controllers\Admin;

use Polinema\WebProfilLabSe\Core\Controller;

class ProfileController extends Controller
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
            'title' => 'Kelola Profil Laboratorium'
        ];

        $this->view('pages/admin/profile/index', $data);
    }

    public function tentangLab()
    {
        $dataTentang = [];

        $this->view('pages/admin/profile/tentangLab', [
            'title'       => 'Tentang Lab SE',
            'dataTentang' => $dataTentang
        ]);
    }

    public function visiMisi()
    {
        $data = [
            'title' => 'Visi & Misi Lab SE'
        ];

        $this->view('pages/admin/profile/visiMisi', $data);
    }

    public function roadmap()
    {
        $data = [
            'title' => 'Roadmap Penelitian Lab SE'
        ];

        $this->view('pages/admin/profile/roadmap', $data);
    }

    public function scopePenelitian()
    {
        $data = [
            'title' => 'Scope Penelitian Lab SE'
        ];

        $this->view('pages/admin/profile/scopePenelitian', $data);
    }

    public function album()
    {
        $data = [
            'title' => 'Album Kegiatan Lab SE'
        ];

        $this->view('pages/admin/profile/album', $data);
    }
}

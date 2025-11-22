<?php
namespace Polinema\WebProfilLabSe\Controllers\Admin;

use Polinema\WebProfilLabSe\Core\Controller;

class ProfileController extends Controller {

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

    public function index() {
        $data = ['title' => 'Profil Lab SE'];
        $this->view('pages/admin/profile/index', $data, true, 'admin');
    }

    public function tentangLab() {
        $dataTentang = []; 

        $data = [
            'title' => 'Tentang Lab SE',
            'dataTentang' => $dataTentang
        ];
        $this->view('pages/admin/profile/tentangLab', $data, true, 'admin');
    }

    public function createTentang() {
    $data = [
        'title' => 'Tambah Data Tentang Lab SE'
    ];
    $this->view('pages/admin/profile/createTentang', $data, true, 'admin');
    }
   
    public function visiMisi() {
        $dataVisiMisi = []; 

        $data = [
            'title' => 'Visi & Misi',
            'dataVisiMisi' => $dataVisiMisi
        ];

        $this->view('pages/admin/profile/visiMisi', $data, true, 'admin');
    }

    public function roadmap() {
        $dataRoadmap = []; 

        $data = [
            'title' => 'Roadmap',
            'dataRoadmap' => $dataRoadmap
        ];
        $this->view('pages/admin/profile/roadmap', $data, true, 'admin');
    }

    public function scopePenelitian() {
        $dataScopePenelitian = []; 

        $data = [
            'title' => 'Visi & Misi',
            'dataScopePenelitian' => $dataScopePenelitian
        ];

        $this->view('pages/admin/profile/ScopePenelitian', $data, true, 'admin');
    }

    public function album() {
    $dataAlbum = []; 
    $data = [
        'title' => 'Album',
        'dataAlbum' => $dataAlbum
    ];

    $this->view('pages/admin/profile/album', $data, true, 'admin');
    }
}

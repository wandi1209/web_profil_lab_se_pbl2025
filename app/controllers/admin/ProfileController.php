<?php
namespace Polinema\WebProfilLabSe\Controllers\Admin;

use Polinema\WebProfilLabSe\Core\Controller;

class ProfileController extends Controller {

    public function __construct()
    {

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
        $this->view('pages/admin/profile/tentang/index', $data, true, 'admin');
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

        $this->view('pages/admin/profile/visi_misi/index', $data, true, 'admin');
    }

    public function roadmap() {
        $dataRoadmap = []; 

        $data = [
            'title' => 'Roadmap',
            'dataRoadmap' => $dataRoadmap
        ];
        $this->view('pages/admin/profile/roadmap/index', $data, true, 'admin');
    }

    public function scopePenelitian() {
        $dataScopePenelitian = []; 

        $data = [
            'title' => 'Visi & Misi',
            'dataScopePenelitian' => $dataScopePenelitian
        ];

        $this->view('pages/admin/profile/scope/index', $data, true, 'admin');
    }

    public function album() {
    $dataAlbum = []; 
    $data = [
        'title' => 'Album',
        'dataAlbum' => $dataAlbum
    ];

    $this->view('pages/admin/profile/album/index', $data, true, 'admin');
    }

    public function createAlbum(){
        $data = [
            'title' => 'Album',
        ];
        $this->view('pages/admin/profile/album/create', $data, true, 'admin');
    }
}

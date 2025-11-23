<?php
// Tentukan namespace
namespace Polinema\WebProfilLabSe\Controllers\Admin;
use Polinema\WebProfilLabSe\Core\Controller;

class PersonilController extends Controller {

    public function __construct()
    {
        
    }

    public function index() {
        $this->view('pages/admin/personil/index');
    }
    public function dosen() {
    $dataDosen = []; 

    $data = [
        'title' => 'Album',
        'dataAlbum' => $dataDosen
    ];

    $this->view('pages/admin/personil/dosen', $data, true, 'admin');
    }

    public function mahasiswa() {
        $dataMahasiswa = []; 

        $data = [
            'title' => 'Mahasiswa',
            'dataMahasiswa' => $dataMahasiswa
        ];

        $this->view('pages/admin/personil/mahasiswa', $data, true, 'admin');
    }
}
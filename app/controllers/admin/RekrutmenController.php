<?php
namespace Polinema\WebProfilLabSe\Controllers\Admin;

use Polinema\WebProfilLabSe\Core\Controller;

class RekrutmenController extends Controller {

    public function __construct()
    {

    }

    public function index() {

        $data = [
            'title' => 'Rekrutmen'
        ];

        $this->view('pages/admin/rekrutmen/index', $data, true, 'admin');
    }
    public function rekrutmen() {
        $dataRekrutmen = []; 

        $data = [
            'title' => 'Visi & Misi',
            'dataRekrutmen' => $dataRekrutmen
        ];

        $this->view('pages/admin/rekrutmen/index', $data, true, 'admin');
    }
}

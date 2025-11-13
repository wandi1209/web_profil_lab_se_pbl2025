<?php
// Tentukan namespace
namespace Polinema\WebProfilLabSe\Controllers;
use Polinema\WebProfilLabSe\Core\Controller;

class ExampleController extends Controller {

    public function __construct() {
        // tempat load model
    }

    public function index() {
        $data = [
            'title' => 'Selamat Datang!',
            'description' => 'Ini adalah halaman utama proyek PBL.'
        ];

        $this->view('pages/home', $data);
    }

    public function about() {
        $data = [
            'title' => 'Halaman About!',
            'description' => 'Ini adalah halaman about proyek PBL.'
        ];

        $this->view('pages/about', $data);
    }

    public function notFound(){
        http_response_code(404);
        $this->view('errors/404');
    }
}
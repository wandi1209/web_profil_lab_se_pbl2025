<?php
namespace Polinema\WebProfilLabSe\Controllers\Admin;

use Polinema\WebProfilLabSe\Core\Controller;

class BlogController extends Controller {

    public function __construct()
    {
    }

    public function index() {

        $dataBlog = []; 
        
        $data = [
            'title'     => 'Blog Artikel',
            'dataBlog'  => $dataBlog
        ];

        $this->view('pages/admin/blog/index', $data, true, 'admin');
    }
}

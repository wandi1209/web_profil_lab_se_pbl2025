<?php
namespace Polinema\WebProfilLabSe\Controllers\Admin;

use Polinema\WebProfilLabSe\Core\Controller;

class ScopeController extends Controller
{
    // Menampilkan halaman scope
    public function index()
    {
        $data = [
            'title' => 'Scope Penelitian'
        ];

        $this->view('pages/admin/profile/scope/index', $data, true, 'admin');
    }
}

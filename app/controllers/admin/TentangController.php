<?php
namespace Polinema\WebProfilLabSe\Controllers\Admin;

use Polinema\WebProfilLabSe\Core\Controller;

class TentangController extends Controller
{
    // Menampilkan halaman tentang
    public function index()
    {
        $dataTentang = [];

        $data = [
            'title'       => 'Tentang Lab',
            'dataTentang' => $dataTentang
        ];

        $this->view('pages/admin/profile/tentang/index', $data, true, 'admin');
    }

    // Menampilkan form edit tentang
    public function edit()
    {
        $id = $_GET['id'] ?? null;

        $tentang = [
            'id'     => $id,
            'judul'  => '',
            'konten' => ''
        ];

        $data = [
            'title'   => 'Edit Tentang Lab',
            'tentang' => $tentang
        ];

        $this->view('pages/admin/profile/tentang/edit', $data, true, 'admin');
    }

    // Menghapus data tentang (belum diisi)
    public function delete()
    {
        // proses hapus akan ditambahkan nanti
    }
}

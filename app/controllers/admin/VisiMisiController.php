<?php
namespace Polinema\WebProfilLabSe\Controllers\Admin;

use Polinema\WebProfilLabSe\Core\Controller;

class VisiMisiController extends Controller
{
    // Menampilkan halaman visi misi
    public function index()
    {
        $dataVisiMisi = [];

        $data = [
            'title'       => 'Visi dan Misi',
            'dataVisiMisi'=> $dataVisiMisi
        ];

        // View: pages/admin/profile/visi_misi/index.php
        $this->view('pages/admin/profile/visi_misi/index', $data, true, 'admin');
    }

    // Menampilkan form edit visi misi
    public function edit()
    {
        $id = $_GET['id'] ?? null;

        $visiMisi = [
            'id'   => $id,
            'visi' => '',
            'misi' => ''
        ];

        $data = [
            'title'    => 'Edit Visi dan Misi',
            'visiMisi' => $visiMisi
        ];

        // View: pages/admin/profile/visi_misi/edit.php
        $this->view('pages/admin/profile/visi_misi/edit', $data, true, 'admin');
    }

    // Menghapus data visi misi (belum diisi)
    public function delete()
    {
        // Proses hapus akan ditambahkan nanti
    }
}

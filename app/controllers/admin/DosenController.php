<?php
namespace Polinema\WebProfilLabSe\Controllers\Admin;

use Polinema\WebProfilLabSe\Core\Controller;

class DosenController extends Controller
{
    // Menampilkan daftar dosen
    public function index()
    {
        // Sementara data dosen dikosongkan dulu
        $dataDosen = [];

        $data = [
            'title'     => 'Dosen',
            'dataDosen' => $dataDosen
        ];

        // Halaman: pages/admin/personil/dosen/index.php
        $this->view('pages/admin/personil/dosen/index', $data, true, 'admin');
    }

    // Menampilkan form tambah dosen
    public function create()
    {
        $data = [
            'title' => 'Tambah Dosen'
        ];

        // Halaman: pages/admin/personil/createDosen.php
        $this->view('pages/admin/personil/createDosen', $data, true, 'admin');
    }

    // Menampilkan form edit dosen
    public function edit()
    {
        $id = $_GET['id'] ?? null;

        // Data dummy, nanti diganti data dari database
        $dosen = [
            'id'       => $id,
            'kategori' => '',
            'konten'   => '',
            'gambar'   => ''
        ];

        $data = [
            'title' => 'Edit Dosen',
            'dosen' => $dosen
        ];

        // Halaman: pages/admin/personil/editDosen.php
        $this->view('pages/admin/personil/editDosen', $data, true, 'admin');
    }

    // Fungsi hapus dosen (kosong dulu)
    public function delete()
    {
        // Nanti diisi proses hapus data dosen
    }
}

<?php
namespace Polinema\WebProfilLabSe\Controllers\Admin;

use Polinema\WebProfilLabSe\Core\Controller;

class MahasiswaController extends Controller
{
    // Menampilkan daftar mahasiswa
    public function index()
    {
        // Sementara data mahasiswa dikosongkan dulu
        $dataMahasiswa = [];

        $data = [
            'title'         => 'Mahasiswa',
            'dataMahasiswa' => $dataMahasiswa
        ];

        // Halaman: pages/admin/personil/mahasiswa/index.php
        $this->view('pages/admin/personil/mahasiswa/index', $data, true, 'admin');
    }

    // Menampilkan form tambah mahasiswa
    public function create()
    {
        $data = [
            'title' => 'Tambah Mahasiswa'
        ];

        // Halaman: pages/admin/personil/createMahasiswa.php
        $this->view('pages/admin/personil/createMahasiswa', $data, true, 'admin');
    }

    // Menampilkan form edit mahasiswa
    public function edit()
    {
        $id = $_GET['id'] ?? null;

        // Data dummy, nanti diganti data dari database
        $mahasiswa = [
            'id'       => $id,
            'kategori' => '',
            'konten'   => ''
        ];

        $data = [
            'title'     => 'Edit Mahasiswa',
            'mahasiswa' => $mahasiswa
        ];

        // Halaman: pages/admin/personil/editMahasiswa.php
        $this->view('pages/admin/personil/editMahasiswa', $data, true, 'admin');
    }

    // Fungsi hapus mahasiswa (kosong dulu)
    public function delete()
    {
        // Nanti diisi proses hapus data mahasiswa
    }
}

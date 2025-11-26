<?php
namespace Polinema\WebProfilLabSe\Controllers\Admin;

use Polinema\WebProfilLabSe\Core\Controller;

class RekrutmenController extends Controller
{
    // Menampilkan daftar rekrutmen
    public function index()
    {
        // Sementara data rekrutmen dikosongkan dulu
        $dataRekrutmen = [];

        $data = [
            'title'        => 'Rekrutmen',
            'dataRekrutmen'=> $dataRekrutmen
        ];

        // View: pages/admin/rekrutmen/index.php
        $this->view('pages/admin/rekrutmen/index', $data, true, 'admin');
    }

    // Menampilkan form tambah rekrutmen
    public function create()
    {
        $data = [
            'title' => 'Tambah Rekrutmen'
        ];

        // View: pages/admin/rekrutmen/createRekrutmen.php
        $this->view('pages/admin/rekrutmen/createRekrutmen', $data, true, 'admin');
    }

    // Menampilkan form edit rekrutmen
    public function edit()
    {
        $id = $_GET['id'] ?? null;

        // Data dummy, nanti diganti data dari database
        $rekrutmen = [
            'id'      => $id,
            'judul'   => '',
            'deskripsi' => '',
            'status'  => ''
        ];

        $data = [
            'title'    => 'Edit Rekrutmen',
            'rekrutmen'=> $rekrutmen
        ];

        // View: pages/admin/rekrutmen/editRekrutmen.php
        $this->view('pages/admin/rekrutmen/editRekrutmen', $data, true, 'admin');
    }

    // Menghapus data rekrutmen (belum diisi)
    public function delete()
    {
        // Proses hapus akan ditambahkan nanti
    }
}

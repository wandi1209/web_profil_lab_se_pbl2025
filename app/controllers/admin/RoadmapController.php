<?php
namespace Polinema\WebProfilLabSe\Controllers\Admin;

use Polinema\WebProfilLabSe\Core\Controller;

class RoadmapController extends Controller
{
    // Menampilkan daftar roadmap
    public function index()
    {
        // Sementara data roadmap dikosongkan dulu
        $dataRoadmap = [];

        $data = [
            'title'       => 'Roadmap',
            'dataRoadmap' => $dataRoadmap
        ];

        // View: pages/admin/profile/roadmap/index.php
        $this->view('pages/admin/profile/roadmap/index', $data, true, 'admin');
    }

    // Menampilkan form tambah roadmap
    public function create()
    {
        $data = [
            'title' => 'Tambah Roadmap'
        ];

        // View: pages/admin/profile/roadmap/create.php
        $this->view('pages/admin/profile/roadmap/create', $data, true, 'admin');
    }

    // Menampilkan form edit roadmap
    public function edit()
    {
        $id = $_GET['id'] ?? null;

        // Data dummy, nanti diganti dengan data dari database
        $roadmap = [
            'id'        => $id,
            'judul'     => '',
            'deskripsi' => ''
        ];

        $data = [
            'title'   => 'Edit Roadmap',
            'roadmap' => $roadmap
        ];

        // View: pages/admin/profile/roadmap/edit.php
        $this->view('pages/admin/profile/roadmap/edit', $data, true, 'admin');
    }

    // Fungsi hapus roadmap (kosong dulu)
    public function delete()
    {
        // Nanti diisi proses hapus data roadmap
    }
}

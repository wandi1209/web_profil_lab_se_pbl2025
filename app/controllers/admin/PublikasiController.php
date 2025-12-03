<?php

namespace Polinema\WebProfilLabSe\Controllers\Admin;

use Polinema\WebProfilLabSe\Core\Controller;
use Polinema\WebProfilLabSe\Models\Publikasi;
use Polinema\WebProfilLabSe\Models\Personil;
use Polinema\WebProfilLabSe\Middlewares\AuthMiddleware;

class PublikasiController extends Controller
{
    private $publikasiModel;
    private $personilModel;

    public function __construct()
    {
        // Cek login admin
        AuthMiddleware::isAdmin();
        $this->publikasiModel = new Publikasi();
        $this->personilModel = new Personil();
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen Publikasi',
            'publikasi' => $this->publikasiModel->getAll()
        ];
        $this->view('pages/admin/publikasi/index', $data, true, 'admin');
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Publikasi',
            'personil' => $this->personilModel->getAll() // Untuk dropdown
        ];
        $this->view('pages/admin/publikasi/create', $data, true, 'admin');
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'judul'       => $_POST['judul'],
                'tahun'       => $_POST['tahun'],
                'personil_id' => $_POST['personil_id'],
                'url'         => $_POST['url'] ?? null
            ];

            if ($this->publikasiModel->create($data)) {
                $_SESSION['success'] = 'Publikasi berhasil ditambahkan';
            } else {
                $_SESSION['error'] = 'Gagal menambah data';
            }
            header('Location: ' . $_ENV['APP_URL'] . '/admin/publikasi');
            exit;
        }
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;
        $publikasi = $this->publikasiModel->getById($id);

        if (!$publikasi) {
            header('Location: ' . $_ENV['APP_URL'] . '/admin/publikasi');
            exit;
        }

        $data = [
            'title' => 'Edit Publikasi',
            'publikasi' => $publikasi,
            'personil' => $this->personilModel->getAll()
        ];
        $this->view('pages/admin/publikasi/edit', $data, true, 'admin');
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $data = [
                'judul'       => $_POST['judul'],
                'tahun'       => $_POST['tahun'],
                'personil_id' => $_POST['personil_id'],
                'url'         => $_POST['url'] ?? null
            ];

            if ($this->publikasiModel->update($id, $data)) {
                $_SESSION['success'] = 'Publikasi berhasil diupdate';
            } else {
                $_SESSION['error'] = 'Gagal update data';
            }
            header('Location: ' . $_ENV['APP_URL'] . '/admin/publikasi');
            exit;
        }
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            if ($this->publikasiModel->delete($id)) {
                $_SESSION['success'] = 'Publikasi berhasil dihapus';
            } else {
                $_SESSION['error'] = 'Gagal menghapus data';
            }
            header('Location: ' . $_ENV['APP_URL'] . '/admin/publikasi');
            exit;
        }
    }
}
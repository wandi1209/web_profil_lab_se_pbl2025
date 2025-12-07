<?php

namespace Polinema\WebProfilLabSe\Controllers\Admin;

use Polinema\WebProfilLabSe\Core\Controller;
use Polinema\WebProfilLabSe\Models\FokusRiset;
use Polinema\WebProfilLabSe\Middlewares\AuthMiddleware;

class FokusRisetController extends Controller
{
    private $fokusRisetModel;

    public function __construct()
    {
        // TAMBAHKAN MIDDLEWARE DI SINI
        AuthMiddleware::isAdmin();
        
        $this->fokusRisetModel = new FokusRiset();
    }

    public function index()
    {
        $data = [
            'title' => 'Kelola Fokus Riset',
            'fokus' => $this->fokusRisetModel->getAll()
        ];
        $this->view('pages/admin/profile/fokus_riset/index', $data, true, 'admin');
    }

    public function create()
    {
        $data = ['title' => 'Tambah Fokus Riset'];
        $this->view('pages/admin/profile/fokus_riset/create', $data, true, 'admin');
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title'       => $_POST['title'],
                'icon'        => $_POST['icon'],
                'description' => $_POST['description']
            ];

            if ($this->fokusRisetModel->create($data)) {
                header('Location: ' . $_ENV['APP_URL'] . '/admin/profile/fokusRiset?status=success&msg=Data berhasil ditambahkan');
            } else {
                header('Location: ' . $_ENV['APP_URL'] . '/admin/profile/fokusRiset/create?status=error&msg=Gagal menambah data');
            }
            exit;
        }
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: ' . $_ENV['APP_URL'] . '/admin/profile/fokusRiset');
            exit;
        }

        $fokus = $this->fokusRisetModel->getById($id);

        $data = [
            'title' => 'Edit Fokus Riset',
            'fokus' => $fokus
        ];
        $this->view('pages/admin/profile/fokus_riset/edit', $data, true, 'admin');
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $data = [
                'title'       => $_POST['title'],
                'icon'        => $_POST['icon'],
                'description' => $_POST['description']
            ];

            if ($this->fokusRisetModel->update($id, $data)) {
                header('Location: ' . $_ENV['APP_URL'] . '/admin/profile/fokusRiset?status=success&msg=Data berhasil diperbarui');
            } else {
                header('Location: ' . $_ENV['APP_URL'] . '/admin/profile/fokusRiset/edit?id=' . $id . '&status=error&msg=Gagal update data');
            }
            exit;
        }
    }

    public function delete()
    {
        $id = $_POST['id'] ?? null;
        if ($id && $this->fokusRisetModel->delete($id)) {
            header('Location: ' . $_ENV['APP_URL'] . '/admin/profile/fokusRiset?status=success&msg=Data berhasil dihapus');
        } else {
            header('Location: ' . $_ENV['APP_URL'] . '/admin/profile/fokusRiset?status=error&msg=Gagal menghapus data');
        }
        exit;
    }
}
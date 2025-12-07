<?php

namespace Polinema\WebProfilLabSe\Controllers\Admin;

use Polinema\WebProfilLabSe\Core\Controller;
use Polinema\WebProfilLabSe\Models\Scope;
use Exception;

class ScopeController extends Controller
{
    private $scopeModel;

    public function __construct()
    {
        $this->scopeModel = new Scope();
    }

    public function index()
    {
        $dataScopePenelitian = $this->scopeModel->getAll();
        $data = [
            'title' => 'Scope Penelitian',
            'dataScopePenelitian' => $dataScopePenelitian
        ];
        $this->view('pages/admin/profile/scope/index', $data, true, 'admin');
    }

    public function create()
    {
        $data = ['title' => 'Tambah Scope Penelitian'];
        $this->view('pages/admin/profile/scope/create', $data, true, 'admin');
    }

    // STORE: Hapus logika upload
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . $_ENV['APP_URL'] . '/admin/scope');
            exit;
        }

        $kategori = trim($_POST['kategori'] ?? '');
        $deskripsi = trim($_POST['deskripsi'] ?? '');
        $iconBootstrap = trim($_POST['icon_bootstrap'] ?? '');
        $tags = $_POST['tags'] ?? [];

        if (empty($kategori) || empty($deskripsi)) {
            $_SESSION['error'] = 'Kategori dan Deskripsi wajib diisi!';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/scope/create');
            exit;
        }

        try {
            $tagsJson = !empty($tags) ? json_encode(array_values($tags)) : null;

            $data = [
                'kategori'       => $kategori,
                'deskripsi'      => $deskripsi,
                'icon_bootstrap' => $iconBootstrap,
                'tags'           => $tagsJson
            ];

            $result = $this->scopeModel->create($data);

            if ($result) {
                $_SESSION['success'] = 'Scope penelitian berhasil ditambahkan!';
            } else {
                $_SESSION['error'] = 'Gagal menyimpan scope penelitian!';
            }

        } catch (Exception $e) {
            $_SESSION['error'] = 'Terjadi kesalahan: ' . $e->getMessage();
        }

        header('Location: ' . $_ENV['APP_URL'] . '/admin/scope');
        exit;
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: ' . $_ENV['APP_URL'] . '/admin/scope');
            exit;
        }
        $scope = $this->scopeModel->getById($id);
        if (!$scope) {
            $_SESSION['error'] = 'Scope penelitian tidak ditemukan!';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/scope');
            exit;
        }
        $data = [
            'title' => 'Edit Scope Penelitian',
            'scope' => $scope
        ];
        $this->view('pages/admin/profile/scope/edit', $data, true, 'admin');
    }

    // UPDATE: Hapus logika upload & unlink
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . $_ENV['APP_URL'] . '/admin/scope');
            exit;
        }

        $id = $_POST['id'] ?? null;
        $kategori = trim($_POST['kategori'] ?? '');
        $deskripsi = trim($_POST['deskripsi'] ?? '');
        $iconBootstrap = trim($_POST['icon_bootstrap'] ?? '');
        $tags = $_POST['tags'] ?? [];

        if (!$id || empty($kategori) || empty($deskripsi)) {
            $_SESSION['error'] = 'Kategori dan Deskripsi wajib diisi!';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/scope/edit?id=' . $id);
            exit;
        }

        try {
            $tagsJson = !empty($tags) ? json_encode(array_values($tags)) : null;

            $data = [
                'kategori'       => $kategori,
                'deskripsi'      => $deskripsi,
                'icon_bootstrap' => $iconBootstrap,
                'tags'           => $tagsJson
            ];

            $result = $this->scopeModel->update($id, $data);

            if ($result) {
                $_SESSION['success'] = 'Scope penelitian berhasil diperbarui!';
            } else {
                $_SESSION['error'] = 'Gagal memperbarui scope penelitian!';
            }

        } catch (Exception $e) {
            $_SESSION['error'] = 'Terjadi kesalahan: ' . $e->getMessage();
        }

        header('Location: ' . $_ENV['APP_URL'] . '/admin/scope');
        exit;
    }

    // DELETE: Hapus logika unlink image
    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $_SESSION['error'] = 'ID scope tidak valid!';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/scope');
            exit;
        }

        try {
            $result = $this->scopeModel->delete($id);

            if ($result) {
                $_SESSION['success'] = 'Scope penelitian berhasil dihapus!';
            } else {
                $_SESSION['error'] = 'Gagal menghapus scope penelitian!';
            }
        } catch (Exception $e) {
            $_SESSION['error'] = 'Terjadi kesalahan: ' . $e->getMessage();
        }

        header('Location: ' . $_ENV['APP_URL'] . '/admin/scope');
        exit;
    }
}
<?php

namespace Polinema\WebProfilLabSe\Controllers\Admin;

use Polinema\WebProfilLabSe\Core\Controller;
use Polinema\WebProfilLabSe\Models\User;
use Polinema\WebProfilLabSe\Middlewares\AuthMiddleware;

class UserController extends Controller
{
    private $userModel;

    public function __construct()
    {
        // Middleware level Controller
        AuthMiddleware::isSuperAdmin(); 
        
        $this->userModel = new User();
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen User',
            'users' => $this->userModel->getAllWithRoles()
        ];
        $this->view('pages/admin/users/index', $data, true, 'admin');
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah User',
            'roles' => $this->userModel->getRoles()
        ];
        $this->view('pages/admin/users/create', $data, true, 'admin');
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validasi sederhana
            if (empty($_POST['username']) || empty($_POST['password'])) {
                $_SESSION['error'] = "Username dan Password wajib diisi!";
                header('Location: ' . $_ENV['APP_URL'] . '/admin/users/create');
                exit;
            }

            $data = [
                'username'     => $_POST['username'],
                'password'     => $_POST['password'],
                'nama_lengkap' => $_POST['nama_lengkap'],
                'role_id'      => $_POST['role_id']
            ];

            if ($this->userModel->create($data)) {
                $_SESSION['success'] = "User berhasil ditambahkan!";
            } else {
                $_SESSION['error'] = "Gagal menambahkan user.";
            }
            header('Location: ' . $_ENV['APP_URL'] . '/admin/users');
            exit;
        }
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;
        $user = $this->userModel->getById($id);

        if (!$user) {
            header('Location: ' . $_ENV['APP_URL'] . '/admin/users');
            exit;
        }

        $data = [
            'title' => 'Edit User',
            'user'  => $user,
            'roles' => $this->userModel->getRoles()
        ];
        $this->view('pages/admin/users/edit', $data, true, 'admin');
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            
            $data = [
                'username'     => $_POST['username'],
                'password'     => $_POST['password'], // Bisa kosong
                'nama_lengkap' => $_POST['nama_lengkap'],
                'role_id'      => $_POST['role_id']
            ];

            if ($this->userModel->update($id, $data)) {
                $_SESSION['success'] = "Data user berhasil diperbarui!";
            } else {
                $_SESSION['error'] = "Gagal memperbarui data.";
            }
            header('Location: ' . $_ENV['APP_URL'] . '/admin/users');
            exit;
        }
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idToDelete = $_POST['id'];
            $currentUserId = $_SESSION['user']['id'];

            // PROTEKSI: Cek apakah menghapus diri sendiri
            if ($idToDelete == $currentUserId) {
                $_SESSION['error'] = "Anda tidak dapat menghapus akun Anda sendiri!";
                header('Location: ' . $_ENV['APP_URL'] . '/admin/users');
                exit;
            }

            if ($this->userModel->delete($idToDelete)) {
                $_SESSION['success'] = "User berhasil dihapus!";
            } else {
                $_SESSION['error'] = "Gagal menghapus user.";
            }
            header('Location: ' . $_ENV['APP_URL'] . '/admin/users');
            exit;
        }
    }
}
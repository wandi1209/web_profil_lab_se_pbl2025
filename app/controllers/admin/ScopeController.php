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

    /**
     * Halaman daftar scope penelitian
     */
    public function index()
    {
        $dataScopePenelitian = $this->scopeModel->getAll();

        $data = [
            'title' => 'Scope Penelitian',
            'dataScopePenelitian' => $dataScopePenelitian
        ];

        $this->view('pages/admin/profile/scope/index', $data, true, 'admin');
    }

    /**
     * Halaman form tambah scope
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Scope Penelitian'
        ];

        $this->view('pages/admin/profile/scope/create', $data, true, 'admin');
    }

    /**
     * Proses simpan scope baru
     */
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . $_ENV['APP_URL'] . '/admin/scope');
            exit;
        }

        $kategori = trim($_POST['kategori'] ?? '');
        $deskripsi = trim($_POST['deskripsi'] ?? '');
        $tags = $_POST['tags'] ?? [];

        // Validasi
        if (empty($kategori) || empty($deskripsi)) {
            $_SESSION['error'] = 'Kategori dan Deskripsi wajib diisi!';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/scope/create');
            exit;
        }

        try {
            // Handle upload icon (optional)
            $iconUrl = null;
            if (isset($_FILES['icon']) && $_FILES['icon']['error'] === UPLOAD_ERR_OK) {
                $iconUrl = $this->handleImageUpload($_FILES['icon'], 'scope');
            }

            // Convert tags array to JSON
            $tagsJson = !empty($tags) ? json_encode(array_values($tags)) : null;

            // Data untuk insert
            $data = [
                'kategori'   => $kategori,
                'deskripsi'  => $deskripsi,
                'icon_url'   => $iconUrl,
                'tags'       => $tagsJson
            ];

            // Simpan ke database
            $result = $this->scopeModel->create($data);

            if ($result) {
                $_SESSION['success'] = 'Scope penelitian berhasil ditambahkan!';
            } else {
                $_SESSION['error'] = 'Gagal menyimpan scope penelitian!';
            }

        } catch (Exception $e) {
            $_SESSION['error'] = 'Terjadi kesalahan: ' . $e->getMessage();
            error_log('ScopeController store Error: ' . $e->getMessage());
        }

        header('Location: ' . $_ENV['APP_URL'] . '/admin/scope');
        exit;
    }

    /**
     * Halaman form edit scope
     */
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

    /**
     * Proses update scope
     */
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . $_ENV['APP_URL'] . '/admin/scope');
            exit;
        }

        $id = $_POST['id'] ?? null;
        $kategori = trim($_POST['kategori'] ?? '');
        $deskripsi = trim($_POST['deskripsi'] ?? '');
        $tags = $_POST['tags'] ?? [];
        $hapusIcon = isset($_POST['hapus_icon']);

        // Validasi
        if (!$id || empty($kategori) || empty($deskripsi)) {
            $_SESSION['error'] = 'Kategori dan Deskripsi wajib diisi!';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/scope/edit?id=' . $id);
            exit;
        }

        try {
            $iconUrl = null;

            // Handle upload icon baru
            if (isset($_FILES['icon']) && $_FILES['icon']['error'] === UPLOAD_ERR_OK) {
                $iconUrl = $this->handleImageUpload($_FILES['icon'], 'scope');

                // Hapus icon lama
                $oldData = $this->scopeModel->getById($id);
                if ($oldData && !empty($oldData['icon_url'])) {
                    $oldIconPath = __DIR__ . '/../../../public' . $oldData['icon_url'];
                    if (file_exists($oldIconPath)) {
                        unlink($oldIconPath);
                    }
                }
            } elseif ($hapusIcon) {
                // Hapus icon lama
                $oldData = $this->scopeModel->getById($id);
                if ($oldData && !empty($oldData['icon_url'])) {
                    $oldIconPath = __DIR__ . '/../../../public' . $oldData['icon_url'];
                    if (file_exists($oldIconPath)) {
                        unlink($oldIconPath);
                    }
                }
                $iconUrl = '';
            }

            // Convert tags array to JSON
            $tagsJson = !empty($tags) ? json_encode(array_values($tags)) : null;

            // Data untuk update
            $data = [
                'kategori'   => $kategori,
                'deskripsi'  => $deskripsi,
                'tags'       => $tagsJson
            ];

            if ($iconUrl !== null) {
                $data['icon_url'] = $iconUrl;
            }

            // Update ke database
            $result = $this->scopeModel->update($id, $data);

            if ($result) {
                $_SESSION['success'] = 'Scope penelitian berhasil diperbarui!';
            } else {
                $_SESSION['error'] = 'Gagal memperbarui scope penelitian!';
            }

        } catch (Exception $e) {
            $_SESSION['error'] = 'Terjadi kesalahan: ' . $e->getMessage();
            error_log('ScopeController update Error: ' . $e->getMessage());
        }

        header('Location: ' . $_ENV['APP_URL'] . '/admin/scope');
        exit;
    }

    /**
     * Proses hapus scope
     */
    public function delete()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            $_SESSION['error'] = 'ID scope tidak valid!';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/scope');
            exit;
        }

        try {
            // Ambil data scope untuk hapus icon
            $scope = $this->scopeModel->getById($id);

            if (!$scope) {
                $_SESSION['error'] = 'Scope penelitian tidak ditemukan!';
                header('Location: ' . $_ENV['APP_URL'] . '/admin/scope');
                exit;
            }

            // Hapus icon dari storage
            if (!empty($scope['icon_url'])) {
                $iconPath = __DIR__ . '/../../../public' . $scope['icon_url'];
                if (file_exists($iconPath)) {
                    unlink($iconPath);
                }
            }

            // Hapus dari database
            $result = $this->scopeModel->delete($id);

            if ($result) {
                $_SESSION['success'] = 'Scope penelitian berhasil dihapus!';
            } else {
                $_SESSION['error'] = 'Gagal menghapus scope penelitian!';
            }

        } catch (Exception $e) {
            $_SESSION['error'] = 'Terjadi kesalahan: ' . $e->getMessage();
            error_log('ScopeController delete Error: ' . $e->getMessage());
        }

        header('Location: ' . $_ENV['APP_URL'] . '/admin/scope');
        exit;
    }

    /**
     * Handle upload gambar
     */
    private function handleImageUpload($file, $folder = 'scope')
    {
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml'];
        $maxSize = 2 * 1024 * 1024; // 2MB

        // Validasi tipe file
        if (!in_array($file['type'], $allowedTypes)) {
            return false;
        }

        // Validasi ukuran file
        if ($file['size'] > $maxSize) {
            return false;
        }

        // Generate nama file unik
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . '_' . time() . '.' . $extension;

        // Path upload
        $uploadPath = __DIR__ . '/../../../public/uploads/' . $folder . '/';

        // Buat folder jika belum ada
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        // Upload file
        if (move_uploaded_file($file['tmp_name'], $uploadPath . $filename)) {
            return '/uploads/' . $folder . '/' . $filename;
        }

        return false;
    }
}

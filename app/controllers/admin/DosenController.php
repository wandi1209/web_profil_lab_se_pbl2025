<?php

namespace Polinema\WebProfilLabSe\Controllers\Admin;

use Polinema\WebProfilLabSe\Core\Controller;
use Polinema\WebProfilLabSe\Models\Personil;

class DosenController extends Controller
{
    private $personilModel;
    private $uploadDir;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $this->personilModel = new Personil();
        $this->uploadDir = __DIR__ . '/../../../public/uploads/dosen/';
        
        // Buat folder jika belum ada
        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0777, true);
        }
    }

    /**
     * Menampilkan daftar dosen
     */
    public function index()
    {
        $dataDosen = $this->personilModel->getAll('dosen');

        $data = [
            'title'     => 'Daftar Dosen',
            'dataDosen' => $dataDosen
        ];

        $this->view('pages/admin/personil/dosen/index', $data, true, 'admin');
    }

    /**
     * Menampilkan form tambah dosen
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Dosen'
        ];

        $this->view('pages/admin/personil/dosen/create', $data, true, 'admin');
    }

    /**
     * Proses simpan dosen baru
     */
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . $_ENV['APP_URL'] . '/admin/personil/dosen');
            exit;
        }

        $nama = trim($_POST['nama'] ?? '');
        $position = trim($_POST['position'] ?? '');
        $email = trim($_POST['email'] ?? '');

        // Validasi
        if (empty($nama) || empty($position) || empty($email)) {
            $_SESSION['error'] = 'Semua field wajib diisi!';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/personil/createDosen');
            exit;
        }

        // Validasi email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'Format email tidak valid!';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/personil/createDosen');
            exit;
        }

        try {
            $fotoUrl = null;

            // Handle upload foto
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
                $fotoUrl = $this->handleImageUpload($_FILES['foto']);
                
                if (!$fotoUrl) {
                    $_SESSION['error'] = 'Gagal mengupload foto!';
                    header('Location: ' . $_ENV['APP_URL'] . '/admin/personil/createDosen');
                    exit;
                }
            }

            // Simpan ke database
            $result = $this->personilModel->create($nama, 'dosen', $position, $email, $fotoUrl);

            if ($result) {
                $_SESSION['success'] = 'Data dosen berhasil ditambahkan!';
            } else {
                $_SESSION['error'] = 'Gagal menyimpan data dosen!';
            }

        } catch (\Exception $e) {
            $_SESSION['error'] = 'Terjadi kesalahan: ' . $e->getMessage();
            error_log('DosenController store Error: ' . $e->getMessage());
        }

        header('Location: ' . $_ENV['APP_URL'] . '/admin/personil/dosen');
        exit;
    }

    /**
     * Menampilkan form edit dosen
     */
    public function edit()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            $_SESSION['error'] = 'ID tidak valid!';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/personil/dosen');
            exit;
        }

        $dosen = $this->personilModel->getById($id);

        if (!$dosen) {
            $_SESSION['error'] = 'Data dosen tidak ditemukan!';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/personil/dosen');
            exit;
        }

        $data = [
            'title' => 'Edit Dosen',
            'dosen' => $dosen
        ];

        $this->view('pages/admin/personil/dosen/edit', $data, true, 'admin');
    }

    /**
     * Proses update dosen
     */
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . $_ENV['APP_URL'] . '/admin/personil/dosen');
            exit;
        }

        $id = $_POST['id'] ?? null;
        $nama = trim($_POST['nama'] ?? '');
        $position = trim($_POST['position'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $hapusFoto = isset($_POST['hapus_foto']);

        // Validasi
        if (!$id || empty($nama) || empty($position) || empty($email)) {
            $_SESSION['error'] = 'Semua field wajib diisi!';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/personil/dosen/edit?id=' . $id);
            exit;
        }

        // Validasi email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'Format email tidak valid!';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/personil/dosen/edit?id=' . $id);
            exit;
        }

        try {
            $fotoUrl = null;

            // Handle upload foto baru
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
                $fotoUrl = $this->handleImageUpload($_FILES['foto']);
                
                if (!$fotoUrl) {
                    $_SESSION['error'] = 'Gagal mengupload foto!';
                    header('Location: ' . $_ENV['APP_URL'] . '/admin/personil/dosen/edit?id=' . $id);
                    exit;
                }

                // Hapus foto lama
                $oldData = $this->personilModel->getById($id);
                if ($oldData && !empty($oldData['foto_url'])) {
                    $oldImagePath = __DIR__ . '/../../../public' . $oldData['foto_url'];
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
            } elseif ($hapusFoto) {
                // Hapus foto lama
                $oldData = $this->personilModel->getById($id);
                if ($oldData && !empty($oldData['foto_url'])) {
                    $oldImagePath = __DIR__ . '/../../../public' . $oldData['foto_url'];
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                $fotoUrl = ''; // Set empty untuk hapus dari database
            }

            // Update ke database
            $result = $this->personilModel->update($id, $nama, 'dosen', $position, $email, $fotoUrl);

            if ($result) {
                $_SESSION['success'] = 'Data dosen berhasil diperbarui!';
            } else {
                $_SESSION['error'] = 'Gagal memperbarui data dosen!';
            }

        } catch (\Exception $e) {
            $_SESSION['error'] = 'Terjadi kesalahan: ' . $e->getMessage();
            error_log('DosenController update Error: ' . $e->getMessage());
        }

        header('Location: ' . $_ENV['APP_URL'] . '/admin/personil/dosen');
        exit;
    }

    /**
     * Hapus dosen
     */
    public function delete()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            $_SESSION['error'] = 'ID tidak valid!';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/personil/dosen');
            exit;
        }

        try {
            // Ambil data dosen untuk hapus foto
            $dosen = $this->personilModel->getById($id);
            
            if ($dosen) {
                // Hapus foto jika ada
                if (!empty($dosen['foto_url'])) {
                    $imagePath = __DIR__ . '/../../../public' . $dosen['foto_url'];
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }

                // Hapus dari database
                $result = $this->personilModel->delete($id);

                if ($result) {
                    $_SESSION['success'] = 'Data dosen berhasil dihapus!';
                } else {
                    $_SESSION['error'] = 'Gagal menghapus data dosen!';
                }
            } else {
                $_SESSION['error'] = 'Data dosen tidak ditemukan!';
            }

        } catch (\Exception $e) {
            $_SESSION['error'] = 'Terjadi kesalahan: ' . $e->getMessage();
            error_log('DosenController delete Error: ' . $e->getMessage());
        }

        header('Location: ' . $_ENV['APP_URL'] . '/admin/personil/dosen');
        exit;
    }

    /**
     * Handle upload image
     */
    private function handleImageUpload($file)
    {
        // Validasi tipe file
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
        
        if (!in_array($file['type'], $allowedTypes)) {
            return false;
        }

        // Validasi ukuran file (max 5MB)
        $maxSize = 5 * 1024 * 1024;
        if ($file['size'] > $maxSize) {
            return false;
        }

        // Generate nama file unik
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = 'dosen_' . time() . '_' . uniqid() . '.' . $extension;
        $targetPath = $this->uploadDir . $filename;

        // Upload file
        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            chmod($targetPath, 0644);
            return '/uploads/dosen/' . $filename;
        }

        return false;
    }
}

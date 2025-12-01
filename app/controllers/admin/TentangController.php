<?php

namespace Polinema\WebProfilLabSe\Controllers\Admin;

use Polinema\WebProfilLabSe\Core\Controller;
use Polinema\WebProfilLabSe\Models\Tentang;

class TentangController extends Controller
{
    private $tentangModel;
    private $uploadDir;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->tentangModel = new Tentang();
        $this->uploadDir = __DIR__ . '/../../../public/assets/images/tentang/';
        
        // Buat folder jika belum ada
        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0777, true);
        }
    }

    // Menampilkan halaman tentang
    public function index()
    {
        $dataTentang = $this->tentangModel->getTentang();

        $data = [
            'title' => 'Tentang Lab',
            'tentang' => $dataTentang
        ];

        $this->view('pages/admin/profile/tentang/index', $data, true, 'admin');
    }

    // Menyimpan data tentang
    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . $_ENV['APP_URL'] . '/admin/profile/tentang');
            exit;
        }

        $judul = trim($_POST['judul'] ?? '');
        $konten = trim($_POST['konten'] ?? '');
        $hapusGambar = isset($_POST['hapus_gambar']);

        // Validasi
        if (empty($judul)) {
            $_SESSION['error'] = 'Judul tidak boleh kosong!';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/profile/tentang');
            exit;
        }

        if (empty($konten)) {
            $_SESSION['error'] = 'Konten tidak boleh kosong!';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/profile/tentang');
            exit;
        }

        try {
            $gambarPath = null;

            // Cek apakah ada gambar yang diupload
            if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
                $gambarPath = $this->handleImageUpload($_FILES['gambar']);
                
                if (!$gambarPath) {
                    $_SESSION['error'] = 'Gagal mengupload gambar!';
                    header('Location: ' . $_ENV['APP_URL'] . '/admin/profile/tentang');
                    exit;
                }

                // Hapus gambar lama jika ada
                $dataTentang = $this->tentangModel->getTentang();
                if ($dataTentang && !empty($dataTentang['gambar'])) {
                    $oldImagePath = __DIR__ . '/../../../public' . $dataTentang['gambar'];
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
            } elseif ($hapusGambar) {
                // Hapus gambar lama
                $dataTentang = $this->tentangModel->getTentang();
                if ($dataTentang && !empty($dataTentang['gambar'])) {
                    $oldImagePath = __DIR__ . '/../../../public' . $dataTentang['gambar'];
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                $gambarPath = ''; // Set empty string untuk hapus dari database
            }

            // Simpan ke database
            $this->tentangModel->saveTentang($judul, $konten, $gambarPath);
            $_SESSION['success'] = 'Data tentang berhasil disimpan!';

        } catch (\Exception $e) {
            $_SESSION['error'] = 'Gagal menyimpan data: ' . $e->getMessage();
        }

        header('Location: ' . $_ENV['APP_URL'] . '/admin/profile/tentang');
        exit;
    }

    // Handle upload gambar
    private function handleImageUpload($file)
    {
        // Validasi tipe file
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
        if (!in_array($file['type'], $allowedTypes)) {
            $_SESSION['error'] = 'Tipe file tidak valid! Hanya JPG, PNG, GIF, dan WEBP yang diperbolehkan.';
            return false;
        }

        // Validasi ukuran file (max 5MB)
        $maxSize = 5 * 1024 * 1024; // 5MB
        if ($file['size'] > $maxSize) {
            $_SESSION['error'] = 'Ukuran file terlalu besar! Maksimal 5MB.';
            return false;
        }

        // Generate nama file unik
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = 'tentang_' . time() . '_' . uniqid() . '.' . $extension;
        $targetPath = $this->uploadDir . $filename;

        // Upload file
        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            // Return relative path untuk disimpan di database
            return '/assets/images/tentang/' . $filename;
        }

        return false;
    }
}

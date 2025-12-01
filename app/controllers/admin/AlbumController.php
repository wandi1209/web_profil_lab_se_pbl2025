<?php

namespace Polinema\WebProfilLabSe\Controllers\Admin;

use Polinema\WebProfilLabSe\Core\Controller;
use Polinema\WebProfilLabSe\Models\Album;
use Exception;

class AlbumController extends Controller
{
    private $albumModel;

    public function __construct()
    {
        $this->albumModel = new Album();
    }

    /**
     * Halaman daftar album
     */
    public function index()
    {
        $dataAlbum = $this->albumModel->getAll();

        $data = [
            'title'      => 'Kelola Album',
            'dataAlbum'  => $dataAlbum
        ];

        $this->view('pages/admin/profile/album/index', $data, true, 'admin');
    }

    /**
     * Halaman form tambah album
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Album'
        ];

        $this->view('pages/admin/profile/album/create', $data, true, 'admin');
    }

    /**
     * Proses simpan album baru
     */
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . $_ENV['APP_URL'] . '/admin/album');
            exit;
        }

        $judul = trim($_POST['judul'] ?? '');
        $deskripsi = trim($_POST['deskripsi'] ?? '');
        $kategori = trim($_POST['kategori'] ?? 'kegiatan');

        // Validasi
        if (empty($judul)) {
            $_SESSION['error'] = 'Judul wajib diisi!';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/album/create');
            exit;
        }

        // Validasi upload foto
        if (!isset($_FILES['foto']) || $_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['error'] = 'Foto wajib diupload!';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/album/create');
            exit;
        }

        try {
            // Handle upload foto
            $fotoUrl = $this->handleImageUpload($_FILES['foto'], 'album');

            if (!$fotoUrl) {
                $_SESSION['error'] = 'Gagal mengupload foto!';
                header('Location: ' . $_ENV['APP_URL'] . '/admin/album/create');
                exit;
            }

            // Data untuk insert
            $data = [
                'judul'     => $judul,
                'deskripsi' => $deskripsi,
                'foto_url'  => $fotoUrl,
                'kategori'  => $kategori
            ];

            // Simpan ke database
            $result = $this->albumModel->create($data);

            if ($result) {
                $_SESSION['success'] = 'Album berhasil ditambahkan!';
            } else {
                $_SESSION['error'] = 'Gagal menyimpan album!';
            }

        } catch (Exception $e) {
            $_SESSION['error'] = 'Terjadi kesalahan: ' . $e->getMessage();
            error_log('AlbumController store Error: ' . $e->getMessage());
        }

        header('Location: ' . $_ENV['APP_URL'] . '/admin/album');
        exit;
    }

    /**
     * Halaman form edit album
     */
    public function edit()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            header('Location: ' . $_ENV['APP_URL'] . '/admin/album');
            exit;
        }

        $album = $this->albumModel->getById($id);

        if (!$album) {
            $_SESSION['error'] = 'Album tidak ditemukan!';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/album');
            exit;
        }

        $data = [
            'title' => 'Edit Album',
            'album' => $album
        ];

        $this->view('pages/admin/profile/album/edit', $data, true, 'admin');
    }

    /**
     * Proses update album
     */
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . $_ENV['APP_URL'] . '/admin/album');
            exit;
        }

        $id = $_POST['id'] ?? null;
        $judul = trim($_POST['judul'] ?? '');
        $deskripsi = trim($_POST['deskripsi'] ?? '');
        $kategori = trim($_POST['kategori'] ?? 'kegiatan');
        $hapusFoto = isset($_POST['hapus_foto']);

        // Validasi
        if (!$id || empty($judul)) {
            $_SESSION['error'] = 'Judul wajib diisi!';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/album/edit?id=' . $id);
            exit;
        }

        try {
            $fotoUrl = null;

            // Handle upload foto baru
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
                $fotoUrl = $this->handleImageUpload($_FILES['foto'], 'album');

                if (!$fotoUrl) {
                    $_SESSION['error'] = 'Gagal mengupload foto!';
                    header('Location: ' . $_ENV['APP_URL'] . '/admin/album/edit?id=' . $id);
                    exit;
                }

                // Hapus foto lama
                $oldData = $this->albumModel->getById($id);
                if ($oldData && !empty($oldData['foto_url'])) {
                    $oldImagePath = __DIR__ . '/../../../public' . $oldData['foto_url'];
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
            } elseif ($hapusFoto) {
                // Hapus foto lama
                $oldData = $this->albumModel->getById($id);
                if ($oldData && !empty($oldData['foto_url'])) {
                    $oldImagePath = __DIR__ . '/../../../public' . $oldData['foto_url'];
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                $fotoUrl = '';
            }

            // Data untuk update
            $data = [
                'judul'     => $judul,
                'deskripsi' => $deskripsi,
                'kategori'  => $kategori
            ];

            if ($fotoUrl !== null) {
                $data['foto_url'] = $fotoUrl;
            }

            // Update ke database
            $result = $this->albumModel->update($id, $data);

            if ($result) {
                $_SESSION['success'] = 'Album berhasil diperbarui!';
            } else {
                $_SESSION['error'] = 'Gagal memperbarui album!';
            }

        } catch (Exception $e) {
            $_SESSION['error'] = 'Terjadi kesalahan: ' . $e->getMessage();
            error_log('AlbumController update Error: ' . $e->getMessage());
        }

        header('Location: ' . $_ENV['APP_URL'] . '/admin/album');
        exit;
    }

    /**
     * Proses hapus album
     */
    public function delete()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            $_SESSION['error'] = 'ID album tidak valid!';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/album');
            exit;
        }

        try {
            // Ambil data album untuk hapus foto
            $album = $this->albumModel->getById($id);

            if (!$album) {
                $_SESSION['error'] = 'Album tidak ditemukan!';
                header('Location: ' . $_ENV['APP_URL'] . '/admin/album');
                exit;
            }

            // Hapus foto dari storage
            if (!empty($album['foto_url'])) {
                $imagePath = __DIR__ . '/../../../public' . $album['foto_url'];
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            // Hapus dari database
            $result = $this->albumModel->delete($id);

            if ($result) {
                $_SESSION['success'] = 'Album berhasil dihapus!';
            } else {
                $_SESSION['error'] = 'Gagal menghapus album!';
            }

        } catch (Exception $e) {
            $_SESSION['error'] = 'Terjadi kesalahan: ' . $e->getMessage();
            error_log('AlbumController delete Error: ' . $e->getMessage());
        }

        header('Location: ' . $_ENV['APP_URL'] . '/admin/album');
        exit;
    }

    /**
     * Handle upload gambar
     */
    private function handleImageUpload($file, $folder = 'album')
    {
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
        $maxSize = 5 * 1024 * 1024; // 5MB

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

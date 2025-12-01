<?php

namespace Polinema\WebProfilLabSe\Controllers\Admin;

use Polinema\WebProfilLabSe\Core\Controller;
use Polinema\WebProfilLabSe\Models\Article;
use Exception;

class BlogController extends Controller
{
    private $articleModel;

    public function __construct()
    {
        $this->articleModel = new Article();
    }

    /**
     * Halaman daftar blog/artikel
     */
    public function index()
    {
        $dataBlog = $this->articleModel->getAll();

        $data = [
            'title'    => 'Blog Artikel',
            'dataBlog' => $dataBlog
        ];

        $this->view('pages/admin/blog/index', $data, true, 'admin');
    }

    /**
     * Halaman form tambah blog
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Blog'
        ];

        $this->view('pages/admin/blog/create', $data, true, 'admin');
    }

    /**
     * Proses simpan blog baru
     */
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . $_ENV['APP_URL'] . '/admin/blog');
            exit;
        }

        $title = trim($_POST['title'] ?? '');
        $ringkasan = trim($_POST['ringkasan'] ?? '');
        $content = trim($_POST['content'] ?? '');

        // Validasi
        if (empty($title) || empty($content)) {
            $_SESSION['error'] = 'Judul dan Konten wajib diisi!';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/blog/create');
            exit;
        }

        try {
            // Generate slug
            $slug = $this->articleModel->generateSlug($title);

            // Handle upload gambar
            $gambarUrl = null;
            if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
                $gambarUrl = $this->handleImageUpload($_FILES['gambar'], 'blog');
                
                if (!$gambarUrl) {
                    $_SESSION['error'] = 'Gagal mengupload gambar!';
                    header('Location: ' . $_ENV['APP_URL'] . '/admin/blog/create');
                    exit;
                }
            }

            // Data untuk insert
            $data = [
                'title'      => $title,
                'slug'       => $slug,
                'gambar_url' => $gambarUrl,
                'ringkasan'  => $ringkasan,
                'content'    => $content
            ];

            // Simpan ke database
            $result = $this->articleModel->create($data);

            if ($result) {
                $_SESSION['success'] = 'Artikel berhasil ditambahkan!';
            } else {
                $_SESSION['error'] = 'Gagal menyimpan artikel!';
            }

        } catch (Exception $e) {
            $_SESSION['error'] = 'Terjadi kesalahan: ' . $e->getMessage();
            error_log('BlogController store Error: ' . $e->getMessage());
        }

        header('Location: ' . $_ENV['APP_URL'] . '/admin/blog');
        exit;
    }

    /**
     * Halaman form edit blog
     */
    public function edit()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            header('Location: ' . $_ENV['APP_URL'] . '/admin/blog');
            exit;
        }

        $blog = $this->articleModel->getById($id);

        if (!$blog) {
            $_SESSION['error'] = 'Artikel tidak ditemukan!';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/blog');
            exit;
        }

        $data = [
            'title' => 'Edit Blog',
            'blog'  => $blog
        ];

        $this->view('pages/admin/blog/edit', $data, true, 'admin');
    }

    /**
     * Proses update blog
     */
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . $_ENV['APP_URL'] . '/admin/blog');
            exit;
        }

        $id = $_POST['id'] ?? null;
        $title = trim($_POST['title'] ?? '');
        $ringkasan = trim($_POST['ringkasan'] ?? '');
        $content = trim($_POST['content'] ?? '');
        $hapusGambar = isset($_POST['hapus_gambar']);

        // Validasi
        if (!$id || empty($title) || empty($content)) {
            $_SESSION['error'] = 'Judul dan Konten wajib diisi!';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/blog/edit?id=' . $id);
            exit;
        }

        try {
            // Generate slug baru jika title berubah
            $oldData = $this->articleModel->getById($id);
            $slug = ($oldData['title'] !== $title) 
                    ? $this->articleModel->generateSlug($title) 
                    : $oldData['slug'];

            $gambarUrl = null;

            // Handle upload gambar baru
            if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
                $gambarUrl = $this->handleImageUpload($_FILES['gambar'], 'blog');

                if (!$gambarUrl) {
                    $_SESSION['error'] = 'Gagal mengupload gambar!';
                    header('Location: ' . $_ENV['APP_URL'] . '/admin/blog/edit?id=' . $id);
                    exit;
                }

                // Hapus gambar lama
                if ($oldData && !empty($oldData['gambar_url'])) {
                    $oldImagePath = __DIR__ . '/../../../public' . $oldData['gambar_url'];
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
            } elseif ($hapusGambar) {
                // Hapus gambar lama
                if ($oldData && !empty($oldData['gambar_url'])) {
                    $oldImagePath = __DIR__ . '/../../../public' . $oldData['gambar_url'];
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                $gambarUrl = '';
            }

            // Data untuk update
            $data = [
                'title'     => $title,
                'slug'      => $slug,
                'ringkasan' => $ringkasan,
                'content'   => $content
            ];

            if ($gambarUrl !== null) {
                $data['gambar_url'] = $gambarUrl;
            }

            // Update ke database
            $result = $this->articleModel->update($id, $data);

            if ($result) {
                $_SESSION['success'] = 'Artikel berhasil diperbarui!';
            } else {
                $_SESSION['error'] = 'Gagal memperbarui artikel!';
            }

        } catch (Exception $e) {
            $_SESSION['error'] = 'Terjadi kesalahan: ' . $e->getMessage();
            error_log('BlogController update Error: ' . $e->getMessage());
        }

        header('Location: ' . $_ENV['APP_URL'] . '/admin/blog');
        exit;
    }

    /**
     * Proses hapus blog
     */
    public function delete()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            $_SESSION['error'] = 'ID artikel tidak valid!';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/blog');
            exit;
        }

        try {
            // Ambil data blog untuk hapus gambar
            $blog = $this->articleModel->getById($id);

            if (!$blog) {
                $_SESSION['error'] = 'Artikel tidak ditemukan!';
                header('Location: ' . $_ENV['APP_URL'] . '/admin/blog');
                exit;
            }

            // Hapus gambar dari storage
            if (!empty($blog['gambar_url'])) {
                $imagePath = __DIR__ . '/../../../public' . $blog['gambar_url'];
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            // Hapus dari database
            $result = $this->articleModel->delete($id);

            if ($result) {
                $_SESSION['success'] = 'Artikel berhasil dihapus!';
            } else {
                $_SESSION['error'] = 'Gagal menghapus artikel!';
            }

        } catch (Exception $e) {
            $_SESSION['error'] = 'Terjadi kesalahan: ' . $e->getMessage();
            error_log('BlogController delete Error: ' . $e->getMessage());
        }

        header('Location: ' . $_ENV['APP_URL'] . '/admin/blog');
        exit;
    }

    /**
     * Handle upload gambar
     */
    private function handleImageUpload($file, $folder = 'blog')
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

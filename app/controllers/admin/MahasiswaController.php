<?php

namespace Polinema\WebProfilLabSe\Controllers\Admin;

use Polinema\WebProfilLabSe\Core\Controller;
use Polinema\WebProfilLabSe\Models\Personil;
use Exception;

class MahasiswaController extends Controller
{
    private $personilModel;

    public function __construct()
    {
        $this->personilModel = new Personil();
    }

    /**
     * Halaman daftar mahasiswa
     */
    public function index()
    {
        $dataMahasiswa = $this->personilModel->getAll('Mahasiswa');

        $data = [
            'title'         => 'Mahasiswa',
            'dataMahasiswa' => $dataMahasiswa
        ];

        $this->view('pages/admin/personil/mahasiswa/index', $data, true, 'admin');
    }

    /**
     * Halaman form tambah mahasiswa
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Mahasiswa'
        ];

        $this->view('pages/admin/personil/mahasiswa/create', $data, true, 'admin');
    }

    /**
     * Proses simpan mahasiswa baru
     */
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . $_ENV['APP_URL'] . '/admin/personil/mahasiswa');
            exit;
        }

        $nama = trim($_POST['nama'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $nidn = trim($_POST['nidn'] ?? '');
        $keahlian = trim($_POST['keahlian'] ?? '');
        $linkedin = trim($_POST['linkedin'] ?? '');
        $github = trim($_POST['github'] ?? '');

        // Validasi
        if (empty($nama) || empty($email)) {
            $_SESSION['error'] = 'Nama dan Email wajib diisi!';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/personil/mahasiswa/create');
            exit;
        }

        try {
            // Handle upload foto
            $fotoUrl = null;
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
                $fotoUrl = $this->handleImageUpload($_FILES['foto'], 'personil');
                
                if (!$fotoUrl) {
                    $_SESSION['error'] = 'Gagal mengupload foto!';
                    header('Location: ' . $_ENV['APP_URL'] . '/admin/personil/mahasiswa/create');
                    exit;
                }
            }

            // Data untuk insert
            $data = [
                'nama'       => $nama,
                'kategori'   => 'Mahasiswa',
                'position'   => 'Mahasiswa',
                'email'      => $email,
                'nidn'       => $nidn,
                'keahlian'   => $keahlian,
                'pendidikan' => null,
                'publikasi'  => null,
                'linkedin'   => $linkedin,
                'github'     => $github,
                'foto_url'   => $fotoUrl
            ];

            // Simpan ke database
            $result = $this->personilModel->create($data);

            if ($result) {
                $_SESSION['success'] = 'Data mahasiswa berhasil ditambahkan!';
            } else {
                $_SESSION['error'] = 'Gagal menyimpan data mahasiswa!';
            }

        } catch (Exception $e) {
            $_SESSION['error'] = 'Terjadi kesalahan: ' . $e->getMessage();
            error_log('MahasiswaController store Error: ' . $e->getMessage());
        }

        header('Location: ' . $_ENV['APP_URL'] . '/admin/personil/mahasiswa');
        exit;
    }

    /**
     * Halaman form edit mahasiswa
     */
    public function edit()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            header('Location: ' . $_ENV['APP_URL'] . '/admin/personil/mahasiswa');
            exit;
        }

        $mahasiswa = $this->personilModel->getById($id);

        if (!$mahasiswa || $mahasiswa['kategori'] !== 'Mahasiswa') {
            $_SESSION['error'] = 'Data mahasiswa tidak ditemukan!';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/personil/mahasiswa');
            exit;
        }

        $data = [
            'title'     => 'Edit Mahasiswa',
            'mahasiswa' => $mahasiswa
        ];

        $this->view('pages/admin/personil/mahasiswa/edit', $data, true, 'admin');
    }

    /**
     * Proses update mahasiswa
     */
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . $_ENV['APP_URL'] . '/admin/personil/mahasiswa');
            exit;
        }

        $id = $_POST['id'] ?? null;
        $nama = trim($_POST['nama'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $nidn = trim($_POST['nidn'] ?? '');
        $keahlian = trim($_POST['keahlian'] ?? '');
        $linkedin = trim($_POST['linkedin'] ?? '');
        $github = trim($_POST['github'] ?? '');
        $hapusFoto = isset($_POST['hapus_foto']);

        // Validasi
        if (!$id || empty($nama) || empty($email)) {
            $_SESSION['error'] = 'Nama dan Email wajib diisi!';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/personil/mahasiswa/edit?id=' . $id);
            exit;
        }

        try {
            $fotoUrl = null;

            // Handle upload foto baru
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
                $fotoUrl = $this->handleImageUpload($_FILES['foto'], 'personil');

                if (!$fotoUrl) {
                    $_SESSION['error'] = 'Gagal mengupload foto!';
                    header('Location: ' . $_ENV['APP_URL'] . '/admin/personil/mahasiswa/edit?id=' . $id);
                    exit;
                }

                // Hapus foto lama
                $oldData = $this->personilModel->getById($id);
                if ($oldData && !empty($oldData['foto_url'])) {
                    $oldFotoPath = __DIR__ . '/../../../public' . $oldData['foto_url'];
                    if (file_exists($oldFotoPath)) {
                        unlink($oldFotoPath);
                    }
                }
            } elseif ($hapusFoto) {
                // Hapus foto lama
                $oldData = $this->personilModel->getById($id);
                if ($oldData && !empty($oldData['foto_url'])) {
                    $oldFotoPath = __DIR__ . '/../../../public' . $oldData['foto_url'];
                    if (file_exists($oldFotoPath)) {
                        unlink($oldFotoPath);
                    }
                }
                $fotoUrl = '';
            }

            // Data untuk update
            $data = [
                'nama'       => $nama,
                'kategori'   => 'Mahasiswa',
                'position'   => 'Mahasiswa',
                'email'      => $email,
                'nidn'       => $nidn,
                'keahlian'   => $keahlian,
                'pendidikan' => null,
                'publikasi'  => null,
                'linkedin'   => $linkedin,
                'github'     => $github
            ];

            if ($fotoUrl !== null) {
                $data['foto_url'] = $fotoUrl;
            }

            // Update ke database
            $result = $this->personilModel->update($id, $data);

            if ($result) {
                $_SESSION['success'] = 'Data mahasiswa berhasil diperbarui!';
            } else {
                $_SESSION['error'] = 'Gagal memperbarui data mahasiswa!';
            }

        } catch (Exception $e) {
            $_SESSION['error'] = 'Terjadi kesalahan: ' . $e->getMessage();
            error_log('MahasiswaController update Error: ' . $e->getMessage());
        }

        header('Location: ' . $_ENV['APP_URL'] . '/admin/personil/mahasiswa');
        exit;
    }

    /**
     * Proses hapus mahasiswa
     */
    public function delete()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            $_SESSION['error'] = 'ID mahasiswa tidak valid!';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/personil/mahasiswa');
            exit;
        }

        try {
            // Ambil data mahasiswa untuk hapus foto
            $mahasiswa = $this->personilModel->getById($id);

            if (!$mahasiswa || $mahasiswa['kategori'] !== 'Mahasiswa') {
                $_SESSION['error'] = 'Data mahasiswa tidak ditemukan!';
                header('Location: ' . $_ENV['APP_URL'] . '/admin/personil/mahasiswa');
                exit;
            }

            // Hapus foto dari storage
            if (!empty($mahasiswa['foto_url'])) {
                $fotoPath = __DIR__ . '/../../../public' . $mahasiswa['foto_url'];
                if (file_exists($fotoPath)) {
                    unlink($fotoPath);
                }
            }

            // Hapus dari database
            $result = $this->personilModel->delete($id);

            if ($result) {
                $_SESSION['success'] = 'Data mahasiswa berhasil dihapus!';
            } else {
                $_SESSION['error'] = 'Gagal menghapus data mahasiswa!';
            }

        } catch (Exception $e) {
            $_SESSION['error'] = 'Terjadi kesalahan: ' . $e->getMessage();
            error_log('MahasiswaController delete Error: ' . $e->getMessage());
        }

        header('Location: ' . $_ENV['APP_URL'] . '/admin/personil/mahasiswa');
        exit;
    }

    /**
     * Handle upload gambar
     */
    private function handleImageUpload($file, $folder = 'personil')
    {
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
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

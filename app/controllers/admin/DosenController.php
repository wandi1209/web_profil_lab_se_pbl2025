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
        
        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0777, true);
        }
    }

    public function index()
    {
        $dataDosen = $this->personilModel->getAll('Dosen');
        $data = [
            'title'     => 'Daftar Dosen',
            'dataDosen' => $dataDosen
        ];
        $this->view('pages/admin/personil/dosen/index', $data, true, 'admin');
    }

    public function create()
    {
        $data = ['title' => 'Tambah Dosen'];
        $this->view('pages/admin/personil/dosen/create', $data, true, 'admin');
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . $_ENV['APP_URL'] . '/admin/personil/dosen'); exit;
        }

        $nama = trim($_POST['nama'] ?? '');
        $position = trim($_POST['position'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $urutan = !empty($_POST['urutan']) ? (int)$_POST['urutan'] : 999;
        
        // TAMBAHAN: Tangkap SINTA & Scholar
        $linkSinta = trim($_POST['link_sinta'] ?? '');
        $linkScholar = trim($_POST['link_scholar'] ?? '');

        if (empty($nama) || empty($position) || empty($email)) {
            $_SESSION['error'] = 'Semua field wajib diisi!';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/personil/createDosen'); exit;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'Format email tidak valid!';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/personil/createDosen'); exit;
        }

        try {
            $fotoUrl = null;
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
                $fotoUrl = $this->handleImageUpload($_FILES['foto']);
                if (!$fotoUrl) {
                    $_SESSION['error'] = 'Gagal mengupload foto!';
                    header('Location: ' . $_ENV['APP_URL'] . '/admin/personil/createDosen'); exit;
                }
            }

            $result = $this->personilModel->create([
                'nama'        => $nama,
                'kategori'    => 'Dosen',
                'position'    => $position,
                'email'       => $email,
                'nidn'        => trim($_POST['nidn'] ?? ''),
                'keahlian'    => trim($_POST['keahlian'] ?? ''),
                'pendidikan'  => isset($_POST['pendidikan']) ? json_encode($_POST['pendidikan']) : null,
                'linkedin'    => trim($_POST['linkedin'] ?? ''),
                'github'      => trim($_POST['github'] ?? ''),
                'foto_url'    => $fotoUrl,
                'urutan'      => $urutan,
                'link_sinta'   => $linkSinta,    // Simpan ke Model
                'link_scholar' => $linkScholar   // Simpan ke Model
            ]);

            $_SESSION[$result ? 'success' : 'error'] = $result ? 'Data dosen berhasil ditambahkan!' : 'Gagal menyimpan data dosen!';
        } catch (\Exception $e) {
            $_SESSION['error'] = 'Terjadi kesalahan: ' . $e->getMessage();
            error_log('DosenController store Error: ' . $e->getMessage());
        }

        header('Location: ' . $_ENV['APP_URL'] . '/admin/personil/dosen'); exit;
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $_SESSION['error'] = 'ID tidak valid!';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/personil/dosen'); exit;
        }

        $dosen = $this->personilModel->getById($id);
        if (!$dosen) {
            $_SESSION['error'] = 'Data dosen tidak ditemukan!';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/personil/dosen'); exit;
        }

        $data = [
            'title' => 'Edit Dosen',
            'dosen' => $dosen
        ];
        $this->view('pages/admin/personil/dosen/edit', $data, true, 'admin');
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . $_ENV['APP_URL'] . '/admin/personil/dosen'); exit;
        }

        $id = $_POST['id'] ?? null;
        $nama = trim($_POST['nama'] ?? '');
        $position = trim($_POST['position'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $hapusFoto = isset($_POST['hapus_foto']);
        $urutan = !empty($_POST['urutan']) ? (int)$_POST['urutan'] : 999;
        
        // TAMBAHAN: Tangkap SINTA & Scholar
        $linkSinta = trim($_POST['link_sinta'] ?? '');
        $linkScholar = trim($_POST['link_scholar'] ?? '');

        if (!$id || empty($nama) || empty($position) || empty($email)) {
            $_SESSION['error'] = 'Semua field wajib diisi!';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/personil/dosen/edit?id=' . $id); exit;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'Format email tidak valid!';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/personil/dosen/edit?id=' . $id); exit;
        }

        try {
            $fotoUrl = null;
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
                $fotoUrl = $this->handleImageUpload($_FILES['foto']);
                if (!$fotoUrl) {
                    $_SESSION['error'] = 'Gagal mengupload foto!';
                    header('Location: ' . $_ENV['APP_URL'] . '/admin/personil/dosen/edit?id=' . $id); exit;
                }
                $oldData = $this->personilModel->getById($id);
                if ($oldData && !empty($oldData['foto_url'])) {
                    $oldImagePath = __DIR__ . '/../../../public' . $oldData['foto_url'];
                    if (file_exists($oldImagePath)) unlink($oldImagePath);
                }
            } elseif ($hapusFoto) {
                $oldData = $this->personilModel->getById($id);
                if ($oldData && !empty($oldData['foto_url'])) {
                    $oldImagePath = __DIR__ . '/../../../public' . $oldData['foto_url'];
                    if (file_exists($oldImagePath)) unlink($oldImagePath);
                }
                $fotoUrl = ''; 
            }

            $result = $this->personilModel->update($id, [
                'nama'        => $nama,
                'kategori'    => 'Dosen',
                'position'    => $position,
                'email'       => $email,
                'nidn'        => trim($_POST['nidn'] ?? ''),
                'keahlian'    => trim($_POST['keahlian'] ?? ''),
                'pendidikan'  => isset($_POST['pendidikan']) ? json_encode($_POST['pendidikan']) : null,
                'linkedin'    => trim($_POST['linkedin'] ?? ''),
                'github'      => trim($_POST['github'] ?? ''),
                'foto_url'    => $fotoUrl,
                'urutan'      => $urutan,
                'link_sinta'   => $linkSinta,    // Update ke Model
                'link_scholar' => $linkScholar   // Update ke Model
            ]);

            $_SESSION[$result ? 'success' : 'error'] = $result ? 'Data dosen berhasil diperbarui!' : 'Gagal memperbarui data dosen!';
        } catch (\Exception $e) {
            $_SESSION['error'] = 'Terjadi kesalahan: ' . $e->getMessage();
            error_log('DosenController update Error: ' . $e->getMessage());
        }

        header('Location: ' . $_ENV['APP_URL'] . '/admin/personil/dosen'); exit;
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $_SESSION['error'] = 'ID tidak valid!';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/personil/dosen'); exit;
        }

        try {
            $dosen = $this->personilModel->getById($id);
            if ($dosen) {
                if (!empty($dosen['foto_url'])) {
                    $imagePath = __DIR__ . '/../../../public' . $dosen['foto_url'];
                    if (file_exists($imagePath)) unlink($imagePath);
                }
                $result = $this->personilModel->delete($id);
                $_SESSION[$result ? 'success' : 'error'] = $result ? 'Data dosen berhasil dihapus!' : 'Gagal menghapus data dosen!';
            } else {
                $_SESSION['error'] = 'Data dosen tidak ditemukan!';
            }
        } catch (\Exception $e) {
            $_SESSION['error'] = 'Terjadi kesalahan: ' . $e->getMessage();
        }

        header('Location: ' . $_ENV['APP_URL'] . '/admin/personil/dosen'); exit;
    }

    private function handleImageUpload($file)
    {
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
        if (!in_array($file['type'], $allowedTypes)) return false;

        $maxSize = 5 * 1024 * 1024;
        if ($file['size'] > $maxSize) return false;

        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = 'dosen_' . time() . '_' . uniqid() . '.' . $extension;
        $targetPath = $this->uploadDir . $filename;

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            chmod($targetPath, 0644);
            return '/uploads/dosen/' . $filename;
        }
        return false;
    }
}
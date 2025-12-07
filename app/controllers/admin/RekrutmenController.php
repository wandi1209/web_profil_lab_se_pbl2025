<?php

namespace Polinema\WebProfilLabSe\Controllers\Admin;

use Polinema\WebProfilLabSe\Core\Controller;
use Polinema\WebProfilLabSe\Models\Pendaftar;
use Exception;

class RekrutmenController extends Controller
{
    private $pendaftarModel;

    public function __construct()
    {
        $this->pendaftarModel = new Pendaftar();
    }

    /**
     * Halaman daftar pendaftar rekrutmen
     */
    public function index()
    {
        $dataPendaftar = $this->pendaftarModel->getAll();
        $statistics = $this->pendaftarModel->getStatistics();

        $data = [
            'title'         => 'Rekrutmen Anggota',
            'dataPendaftar' => $dataPendaftar,
            'stats'         => $statistics
        ];

        $this->view('pages/admin/rekrutmen/index', $data, true, 'admin');
    }

    /**
     * Halaman detail pendaftar
     */
    public function detail()
    {
        $id = (int)($_GET['id'] ?? 0);
        $model = new \Polinema\WebProfilLabSe\Models\Pendaftar();
        $pendaftar = $model->findById($id);

        if (!$pendaftar) {
            $_SESSION['error'] = 'Data pendaftar tidak ditemukan.';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/rekrutmen');
            exit;
        }

        // Render view yang sudah membaca $pendaftar['catatan']
        $this->view('pages/admin/rekrutmen/detail', ['pendaftar' => $pendaftar], true, 'admin');
    }

    /**
     * Halaman edit status pendaftar
     */
    public function edit()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            header('Location: ' . $_ENV['APP_URL'] . '/admin/rekrutmen');
            exit;
        }

        $pendaftar = $this->pendaftarModel->getById($id);

        if (!$pendaftar) {
            $_SESSION['error'] = 'Data pendaftar tidak ditemukan!';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/rekrutmen');
            exit;
        }

        $data = [
            'title'     => 'Update Status Pendaftar',
            'pendaftar' => $pendaftar
        ];

        $this->view('pages/admin/rekrutmen/edit', $data, true, 'admin');
    }

    /**
     * Proses update status
     */
    public function updateStatus()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        // Bersihkan pesan lama
        unset($_SESSION['error'], $_SESSION['success']);

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . $_ENV['APP_URL'] . '/admin/rekrutmen');
            exit;
        }
        $id = (int)($_POST['id'] ?? 0);
        $status = trim($_POST['status'] ?? '');
        $catatan = trim($_POST['catatan'] ?? '');

        $model = new Pendaftar();

        // Jika status kosong, ambil status saat ini dari DB agar tidak mengosongkan
        if ($status === '') {
            $row = $model->findById($id);
            if (!$row) {
                $_SESSION['error'] = 'Data pendaftar tidak ditemukan.';
                header('Location: ' . $_ENV['APP_URL'] . '/admin/rekrutmen');
                exit;
            }
            $status = $row['status']; // pakai status lama
        }

        $ok = $model->updateStatus($id, $status, $catatan);

        $_SESSION[$ok ? 'success' : 'error'] = $ok ? 'Perubahan disimpan.' : 'Gagal menyimpan status.';
        header('Location: ' . $_ENV['APP_URL'] . '/admin/rekrutmen/detail?id=' . $id);
        exit;
    }

    /**
     * Proses hapus pendaftar
     */
    public function delete()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            $_SESSION['error'] = 'ID pendaftar tidak valid!';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/rekrutmen');
            exit;
        }

        try {
            $result = $this->pendaftarModel->delete($id);

            if ($result) {
                $_SESSION['success'] = 'Data pendaftar berhasil dihapus!';
            } else {
                $_SESSION['error'] = 'Gagal menghapus data!';
            }

        } catch (Exception $e) {
            $_SESSION['error'] = 'Terjadi kesalahan: ' . $e->getMessage();
            error_log('RekrutmenController delete Error: ' . $e->getMessage());
        }

        header('Location: ' . $_ENV['APP_URL'] . '/admin/rekrutmen');
        exit;
    }
}

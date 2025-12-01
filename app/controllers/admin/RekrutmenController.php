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
            'title'     => 'Detail Pendaftar',
            'pendaftar' => $pendaftar
        ];

        $this->view('pages/admin/rekrutmen/detail', $data, true, 'admin');
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
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . $_ENV['APP_URL'] . '/admin/rekrutmen');
            exit;
        }

        $id = $_POST['id'] ?? null;
        $status = $_POST['status'] ?? 'Pending';
        $catatan = trim($_POST['catatan'] ?? '');

        if (!$id) {
            $_SESSION['error'] = 'ID pendaftar tidak valid!';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/rekrutmen');
            exit;
        }

        try {
            $result = $this->pendaftarModel->updateStatus($id, $status, $catatan);

            if ($result) {
                $_SESSION['success'] = 'Status pendaftar berhasil diperbarui!';
            } else {
                $_SESSION['error'] = 'Gagal memperbarui status!';
            }

        } catch (Exception $e) {
            $_SESSION['error'] = 'Terjadi kesalahan: ' . $e->getMessage();
            error_log('RekrutmenController updateStatus Error: ' . $e->getMessage());
        }

        header('Location: ' . $_ENV['APP_URL'] . '/admin/rekrutmen');
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

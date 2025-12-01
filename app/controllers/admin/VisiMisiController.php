<?php
namespace Polinema\WebProfilLabSe\Controllers\Admin;

use Polinema\WebProfilLabSe\Core\Controller;
use Polinema\WebProfilLabSe\Models\VisiMisi;

class VisiMisiController extends Controller
{
    private $visiMisiModel;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->visiMisiModel = new VisiMisi();
    }

    // Menampilkan halaman visi misi
    public function index()
    {
        $visiData = $this->visiMisiModel->getVisi();
        $visi = $visiData['konten'] ?? '';
        $listMisi = $this->visiMisiModel->getAllMisi();

        $data = [
            'title'    => 'Visi dan Misi',
            'visi'     => $visi,
            'listMisi' => $listMisi
        ];

        $this->view('pages/admin/profile/visi_misi/index', $data, true, 'admin');
    }

    // Mengupdate visi
    public function updateVisi()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . $_ENV['APP_URL'] . '/admin/profile/visiMisi');
            exit;
        }

        $visi = trim($_POST['visi'] ?? '');

        if (empty($visi)) {
            $_SESSION['error'] = 'Visi tidak boleh kosong!';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/profile/visiMisi');
            exit;
        }

        try {
            $this->visiMisiModel->saveVisi($visi);
            $_SESSION['success'] = 'Visi berhasil disimpan!';
        } catch (\Exception $e) {
            $_SESSION['error'] = 'Gagal menyimpan visi: ' . $e->getMessage();
        }

        header('Location: ' . $_ENV['APP_URL'] . '/admin/profile/visiMisi');
        exit;
    }

    // Menambahkan misi baru
    public function addMisi()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . $_ENV['APP_URL'] . '/admin/profile/visiMisi');
            exit;
        }

        $misi = trim($_POST['misi'] ?? '');

        if (empty($misi)) {
            $_SESSION['error'] = 'Misi tidak boleh kosong!';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/profile/visiMisi');
            exit;
        }

        try {
            $this->visiMisiModel->createMisi($misi);
            $_SESSION['success'] = 'Misi berhasil ditambahkan!';
        } catch (\Exception $e) {
            $_SESSION['error'] = 'Gagal menambahkan misi: ' . $e->getMessage();
        }

        header('Location: ' . $_ENV['APP_URL'] . '/admin/profile/visiMisi');
        exit;
    }

    // Mengupdate misi yang sudah ada
    public function updateMisi()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . $_ENV['APP_URL'] . '/admin/profile/visiMisi');
            exit;
        }

        $id = $_POST['id'] ?? 0;
        $misi = trim($_POST['misi'] ?? '');

        if (empty($misi)) {
            $_SESSION['error'] = 'Misi tidak boleh kosong!';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/profile/visiMisi');
            exit;
        }

        try {
            $this->visiMisiModel->updateMisi($id, $misi);
            $_SESSION['success'] = 'Misi berhasil diperbarui!';
        } catch (\Exception $e) {
            $_SESSION['error'] = 'Gagal memperbarui misi: ' . $e->getMessage();
        }

        header('Location: ' . $_ENV['APP_URL'] . '/admin/profile/visiMisi');
        exit;
    }

    // Menghapus misi
    public function deleteMisi()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . $_ENV['APP_URL'] . '/admin/profile/visiMisi');
            exit;
        }

        $id = $_POST['id'] ?? 0;

        try {
            $this->visiMisiModel->deleteMisi($id);
            $_SESSION['success'] = 'Misi berhasil dihapus!';
        } catch (\Exception $e) {
            $_SESSION['error'] = 'Gagal menghapus misi: ' . $e->getMessage();
        }

        header('Location: ' . $_ENV['APP_URL'] . '/admin/profile/visiMisi');
        exit;
    }
}

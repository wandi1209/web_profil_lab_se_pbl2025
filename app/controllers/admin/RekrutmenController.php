<?php

namespace Polinema\WebProfilLabSe\Controllers\Admin;

use Polinema\WebProfilLabSe\Core\Controller;
use Polinema\WebProfilLabSe\Models\Pendaftar;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
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
     * Halaman edit status pendaftar (DENGAN PROTEKSI)
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

        // --- PROTEKSI HALAMAN EDIT ---
        // Ambil role dari session
        $userRole = $_SESSION['role_id'] ?? 2; 
        
        // Jika status 'Diterima' DAN user BUKAN Super Admin, tendang keluar
        if ($pendaftar['status'] === 'Diterima' && $userRole !== 1) {
            $_SESSION['error'] = 'AKSES DITOLAK: Data yang sudah "Diterima" dikunci. Hubungi Super Admin untuk mengedit.';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/rekrutmen');
            exit;
        }
        // -----------------------------

        $data = [
            'title'     => 'Update Status Pendaftar',
            'pendaftar' => $pendaftar
        ];

        $this->view('pages/admin/rekrutmen/edit', $data, true, 'admin');
    }

    /**
     * Proses update status (DENGAN PROTEKSI)
     */
    public function updateStatus()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        unset($_SESSION['error'], $_SESSION['success']);

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . $_ENV['APP_URL'] . '/admin/rekrutmen');
            exit;
        }

        $id = (int)($_POST['id'] ?? 0);
        $status = trim($_POST['status'] ?? '');
        $catatan = trim($_POST['catatan'] ?? '');

        $model = new Pendaftar();
        
        // Ambil data LAMA dari database
        $dataPendaftar = $model->findById($id);

        if (!$dataPendaftar) {
            $_SESSION['error'] = 'Data pendaftar tidak ditemukan.';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/rekrutmen');
            exit;
        }

        // --- PROTEKSI PROSES UPDATE ---
        $userRole = $_SESSION['role_id'] ?? 2;
        
        // Cek apakah data LAMA statusnya sudah 'Diterima'
        // Jika ya, Admin biasa tidak boleh mengubahnya lagi
        if ($dataPendaftar['status'] === 'Diterima' && $userRole !== 1) {
            $_SESSION['error'] = 'GAGAL MENYIMPAN: Data status "Diterima" terkunci dan tidak dapat diedit oleh Admin biasa.';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/rekrutmen/detail?id=' . $id);
            exit;
        }
        // ------------------------------

        // Jika status kosong, pakai data lama
        if ($status === '') {
            $status = $dataPendaftar['status'];
        }

        // Lakukan Update ke Database
        $ok = $model->updateStatus($id, $status, $catatan);

        if ($ok) {
            $_SESSION['success'] = 'Perubahan disimpan.';

            // LOGIKA EMAIL (Hanya kirim jika status BERUBAH jadi Diterima)
            // Kita cek agar tidak kirim email dobel jika statusnya sudah diterima dari awal
            if (strtolower($status) == 'diterima' && strtolower($dataPendaftar['status']) != 'diterima') {
                try {
                    $this->kirimEmailNotifikasi($dataPendaftar['email'], $dataPendaftar['nama'], $catatan);
                    $_SESSION['success'] .= ' Email notifikasi terkirim.';
                } catch (Exception $e) {
                    error_log("Gagal kirim email: " . $e->getMessage());
                    $_SESSION['error'] = 'Status terupdate, namun gagal mengirim email notifikasi.';
                }
            }
        } else {
            $_SESSION['error'] = 'Gagal menyimpan status.';
        }

        header('Location: ' . $_ENV['APP_URL'] . '/admin/rekrutmen/detail?id=' . $id);
        exit;
    }

    /**
     * 3. METHOD KIRIM EMAIL (PRIVATE) - Menggunakan ENV
     */
    private function kirimEmailNotifikasi($emailPenerima, $namaPenerima, $catatan)
    {
        $mail = new PHPMailer(true);

        // Server settings diambil dari $_ENV
        $mail->isSMTP();
        $mail->Host       = $_ENV['SMTP_HOST'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $_ENV['SMTP_USERNAME'];
        $mail->Password   = $_ENV['SMTP_PASSWORD'];
        $mail->SMTPSecure = $_ENV['SMTP_ENCRYPTION']; // tls atau ssl
        $mail->Port       = $_ENV['SMTP_PORT'];

        // Recipients
        $mail->setFrom($_ENV['SMTP_FROM_ADDRESS'], $_ENV['SMTP_FROM_NAME']);
        $mail->addAddress($emailPenerima, $namaPenerima);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Pengumuman Hasil Rekrutmen Lab SE - DITERIMA';
        
        // Template Email Sederhana
        $bodyContent = "
            <div style='font-family: Arial, sans-serif; color: #333;'>
                <h2>Halo, {$namaPenerima}!</h2>
                <p>Terima kasih telah mengikuti seluruh rangkaian proses rekrutmen Laboratorium Software Engineering (Lab SE).</p>
                
                <div style='background-color: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin: 20px 0;'>
                    <strong>SELAMAT!</strong> Status pendaftaran kamu adalah: <strong>DITERIMA</strong>.
                </div>

                <p><strong>Catatan Tambahan:</strong><br>
                " . (!empty($catatan) ? nl2br(htmlspecialchars($catatan)) : 'Tidak ada catatan khusus.') . "</p>
                
                <p>Mohon periksa website atau grup informasi secara berkala untuk jadwal kumpul perdana.</p>
                
                <br>
                <p>Salam hangat,<br>
                <strong>Tim Admin Lab SE Polinema</strong></p>
            </div>
        ";

        $mail->Body = $bodyContent;
        // Plain text version untuk email client jadul/non-html
        $mail->AltBody = "Selamat {$namaPenerima}, status rekrutmen Anda DITERIMA. Catatan: {$catatan}.";

        $mail->send();
    }

    /**
     * Proses hapus pendaftar (DENGAN VALIDASI)
     */
    public function delete()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            $_SESSION['error'] = 'ID pendaftar tidak valid!';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/rekrutmen');
            exit;
        }

        // 1. Ambil data pendaftar dulu untuk cek status
        $pendaftar = $this->pendaftarModel->findById($id);

        if (!$pendaftar) {
            $_SESSION['error'] = 'Data tidak ditemukan.';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/rekrutmen');
            exit;
        }

        // 2. LOGIKA VALIDASI
        // Cek Role user saat ini (Sesuaikan session ini dengan sistem login kamu)
        // Contoh: $_SESSION['role_id'] atau $_SESSION['role']
        $currentUserRole = $_SESSION['role_id'] ?? 2; 

        // Jika status Diterima DAN user BUKAN Super Admin -> Tolak
        if ($pendaftar['status'] === 'Diterima' && $currentUserRole !== 1) {
            $_SESSION['error'] = 'AKSES DITOLAK: Hanya Super Admin yang boleh menghapus pendaftar yang sudah Diterima!';
            header('Location: ' . $_ENV['APP_URL'] . '/admin/rekrutmen');
            exit;
        }

        // 3. Proses Hapus (Jika lolos validasi)
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

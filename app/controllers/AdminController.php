<?php

namespace Polinema\WebProfilLabSe\Controllers;

use Polinema\WebProfilLabSe\Core\Controller;
use Polinema\WebProfilLabSe\Models\AdminStats;

class AdminController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $statsModel = new AdminStats();
        $summary = $statsModel->getSummary();
        $perYear = $statsModel->getPendaftarPerTahun();

        $data = compact('summary', 'perYear');
        $this->view('pages/admin/index', $data, true, 'admin');
    }

    public function refreshStats()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $statsModel = new AdminStats();
        $ok = $statsModel->refresh();
        $_SESSION[$ok ? 'success' : 'error'] = $ok ? 'Statistik berhasil diperbarui.' : 'Gagal memperbarui statistik.';
        header('Location: ' . $_ENV['APP_URL'] . '/admin');
        exit;
    }
}

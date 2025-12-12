<?php

namespace Polinema\WebProfilLabSe\Controllers;

use Polinema\WebProfilLabSe\Core\Controller;
use Polinema\WebProfilLabSe\Models\Pendaftar;

class PendaftaranController extends Controller
{
    private Pendaftar $model;

    public function __construct()
    {
        $this->model = new Pendaftar();
        if (session_status() === PHP_SESSION_NONE) session_start();
    }

    // Halaman pendaftaran (tanpa required)
    public function index()
    {
        $data = ['statusResult' => null];
        $this->view('pages/pendaftaran', $data, true, 'default');
    }

    // Cek status berdasarkan NIM (GET)
    public function cekStatus()
    {
        $nim = trim($_GET['nim'] ?? '');
        $statusResult = $nim !== '' ? $this->model->findByNim($nim) : null;

        $this->view('pages/pendaftaran', ['statusResult' => $statusResult], true, 'default');
    }

    // Simpan pendaftaran (opsional, tanpa required di HTML)
    // Simpan pendaftaran
    public function store()
    {
        // 1. Ambil data input
        $data = [
            'nama'           => trim($_POST['nama'] ?? ''),
            'email'          => trim($_POST['email'] ?? ''),
            'no_hp'          => trim($_POST['no_hp'] ?? ''),
            'nim'            => trim($_POST['nim'] ?? ''),
            'angkatan'       => trim($_POST['angkatan'] ?? ''),
            'program_studi'  => trim($_POST['program_studi'] ?? ''),
            'peminatan'      => trim($_POST['peminatan'] ?? ''),
            'keahlian'       => trim($_POST['keahlian'] ?? ''),
            'portofolio_url' => trim($_POST['portofolio_url'] ?? ''),
            'alasan'         => trim($_POST['alasan'] ?? ''),
        ];

        // 2. VALIDASI DUPLIKASI DATA
        
        // Cek NIM
        if (!empty($data['nim']) && $this->model->findByNim($data['nim'])) {
            $_SESSION['error'] = "Gagal: NIM {$data['nim']} sudah terdaftar sebelumnya!";
            $this->view('pages/pendaftaran', ['statusResult' => null], true, 'default');
            return; // Hentikan proses
        }

        // Cek Email
        if (!empty($data['email']) && $this->model->findByEmail($data['email'])) {
            $_SESSION['error'] = "Gagal: Email {$data['email']} sudah digunakan!";
            $this->view('pages/pendaftaran', ['statusResult' => null], true, 'default');
            return; 
        }

        // Cek No HP
        if (!empty($data['no_hp']) && $this->model->findByNoHp($data['no_hp'])) {
            $_SESSION['error'] = "Gagal: Nomor HP {$data['no_hp']} sudah terdaftar!";
            $this->view('pages/pendaftaran', ['statusResult' => null], true, 'default');
            return; 
        }

        // 3. Jika aman, simpan ke database
        $ok = $this->model->create($data);
        
        $_SESSION[$ok ? 'success' : 'error'] = $ok ? 'Pendaftaran Berhasil dikirim.' : 'Gagal menyimpan data.';
        
        // Redirect agar form bersih (PRG Pattern) atau tetap load view
        // Disarankan redirect agar kalau di-refresh tidak submit ulang
        header('Location: ' . $_ENV['APP_URL'] . '/pendaftaran');
        exit;
    }
}
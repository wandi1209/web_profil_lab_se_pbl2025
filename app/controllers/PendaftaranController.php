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
    public function store()
    {
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
        $ok = $this->model->create($data);
        $_SESSION[$ok ? 'success' : 'error'] = $ok ? 'Berhasil dikirim.' : 'Gagal menyimpan.';
        $this->view('pages/pendaftaran', ['statusResult' => null], true, 'default');
    }
}
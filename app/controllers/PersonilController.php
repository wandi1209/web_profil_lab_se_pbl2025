<?php

namespace Polinema\WebProfilLabSe\Controllers;

use Polinema\WebProfilLabSe\Core\Controller;
use Polinema\WebProfilLabSe\Models\Personil;
use Polinema\WebProfilLabSe\Models\Publikasi; // Asumsi ada model Publikasi untuk detail

class PersonilController extends Controller
{
    private $personilModel;

    public function __construct()
    {
        $this->personilModel = new Personil();
    }

    // Halaman Daftar Dosen
    public function dosen()
    {
        $dosen = $this->personilModel->getAll('Dosen');

        $data = [
            'title' => 'Daftar Dosen Peneliti',
            'dosen' => $dosen
        ];

        $this->view('pages/personil/dosen', $data, true);
    }

    // Halaman Daftar Mahasiswa
    public function mahasiswa()
    {
        // Ambil data personil dengan kategori 'Mahasiswa'
        // Pastikan case sensitive sesuai database ('Mahasiswa' atau 'mahasiswa')
        $mahasiswa = $this->personilModel->getAll('Mahasiswa');

        $data = [
            'title' => 'Daftar Mahasiswa Peneliti',
            'mahasiswa' => $mahasiswa
        ];

        $this->view('pages/personil/mahasiswa', $data, true);
    }

    // Halaman Detail Personil (Dosen/Mahasiswa)
    public function detail($id)
    {
        $personil = $this->personilModel->getById($id);

        if (!$personil) {
            // Redirect atau tampilkan 404 jika ID tidak ditemukan
            header('Location: ' . $_ENV['APP_URL']);
            exit;
        }

        // Ambil data publikasi terkait (jika ada fitur publikasi)
        $publikasiModel = new Publikasi();
        // Asumsi method getByPersonilId ada di model Publikasi, atau gunakan logic manual
        // Jika belum ada method khusus, bisa dikosongkan dulu arraynya
        $publikasiRaw = $publikasiModel->getAll(); // Ini ambil semua, idealnya filter by ID
        
        // Filter manual sederhana jika model belum support filter by ID
        $publikasi = [];
        foreach($publikasiRaw as $p) {
            if($p['personil_id'] == $id) {
                $publikasi[] = $p['judul'] . ' (' . $p['tahun'] . ')';
            }
        }

        // Parsing data pendidikan (jika disimpan sebagai string dipisah koma/enter di DB)
        // Contoh: "S1 UB, S2 ITS"
        $pendidikan = [];
        if (!empty($personil['pendidikan'])) {
            $decoded = json_decode($personil['pendidikan'], true);
            if (is_array($decoded)) {
                $pendidikan = $decoded;
            }
        }

        $data = [
            'title' => 'Detail ' . $personil['nama'],
            'personil' => $personil,
            'pendidikan' => $pendidikan,
            'publikasi' => $publikasi
        ];

        $this->view('pages/personil/detail', $data, true);
    }
}
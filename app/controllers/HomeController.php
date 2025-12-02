<?php

namespace Polinema\WebProfilLabSe\Controllers;

use Polinema\WebProfilLabSe\Core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'title'       => 'Beranda Laboratorium SE',
            'description' => 'Halaman utama web profil Laboratorium Software Engineering.'
        ];

        $this->view('pages/home', $data, true);
    }

    public function profil()
    {
        $data = [
            'title'       => 'Tentang Laboratorium SE',
            'description' => 'Informasi singkat tentang profil Laboratorium Software Engineering.'
        ];

        $this->view('pages/tentang/profil', $data, true);
    }

    public function visi_misi()
    {
        $data = [
            'title'       => 'Visi & Misi Laboratorium SE',
            'description' => 'Visi dan misi dari Laboratorium Software Engineering.'
        ];

        $this->view('pages/tentang/visi-misi', $data, true);
    }

    public function fokus_riset()
    {
        $data = [];

        $this->view('pages/tentang/fokus-riset', $data, true);
    }

        public function scope_penelitian()
    {
        $data = [];

        $this->view('pages/tentang/scope-penelitian', $data, true);
    }

    public function mahasiswa()
    {
        $data = [];

        $this->view('pages/personil/mahasiswa', $data, true);
    }

    public function pendaftaran()
    {
        $data = [];

        $this->view('pages/pendaftaran', $data, true);
    }

    public function artikel()
    {
        $data = [];
        
        $this->view('pages/artikel', $data, true);
    }

    public function personil()
    {
        $dataDosen = [
            [
                'id'       => 1,
                'nama'     => 'Imam Fahrur Rozi, ST., MT.',
                'jabatan'  => 'Kepala Lab',
                'foto_url' => '/web_profil_lab_se/assets/img/dosen/imam.png',
            ],
            [
                'id'       => 2,
                'nama'     => 'Ridwan Rismanto, SST., M.Kom.',
                'jabatan'  => 'Tenaga Pengajar',
                'foto_url' => '/web_profil_lab_se/assets/img/dosen/ridwan.png',
            ],
            [
                'id'       => 3,
                'nama'     => 'Dian Hanifudin Subhi, S.Kom., M.Kom.',
                'jabatan'  => 'Tenaga Pengajar',
                'foto_url' => '/web_profil_lab_se/assets/img/dosen/dian.png',
            ],
            [
                'id'       => 4,
                'nama'     => 'Moch. Zawaruddin Abdullah, S.ST., M.Kom.',
                'jabatan'  => 'Tenaga Pengajar',
                'foto_url' => '/web_profil_lab_se/assets/img/dosen/zawa.png',
            ],
            [
                'id'       => 5,
                'nama'     => 'Ariadi Retno Ririd, S.Kom., M.Kom.',
                'jabatan'  => 'Tenaga Pengajar',
                'foto_url' => '/web_profil_lab_se/assets/img/dosen/ariadi.png',
            ],
            [
                'id'       => 6,
                'nama'     => 'Elok Nur Hamdana, S.T., M.T.',
                'jabatan'  => 'Tenaga Pengajar',
                'foto_url' => '/web_profil_lab_se/assets/img/dosen/elok.png',
            ]
        ];

        $this->view('pages/personil/anggotaTim', [
            'title'     => 'Anggota Tim',
            'dataDosen' => $dataDosen
        ]);
    }

    public function personilDetail($userId)
    {
        $id = $userId ?? null;

        if (!$id) {
            header('Location: ' . $_ENV['APP_URL'] . '/anggota/dosen');
            exit;
        }

        $personilModel = new \Polinema\WebProfilLabSe\Models\Personil();
        $personil = $personilModel->getById($id);

        if (!$personil) {
            header('Location: ' . $_ENV['APP_URL'] . '/anggota/dosen');
            exit;
        }

        // Parse JSON fields
        $pendidikan = $personilModel->parseJsonField($personil['pendidikan']);
        $publikasi = $personilModel->parseJsonField($personil['publikasi']);

        $data = [
            'title'      => 'Detail ' . $personil['nama'],
            'personil'   => $personil,
            'pendidikan' => $pendidikan,
            'publikasi'  => $publikasi
        ];

        $this->view('pages/personil/detail', $data, true);
    }

    public function notFound()
    {
        http_response_code(404);
        $this->view('errors/404');
    }
}

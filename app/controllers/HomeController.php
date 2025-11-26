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

    public function roadmap()
    {
        $data = [];

        $this->view('pages/tentang/roadmap', $data, true);
    }

    public function mahasiswa()
    {
        $data = [];

        $this->view('pages/personil/mahasiswa', $data, true);
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

    public function personilDetail($id)
    {
        // Data lengkap dosen
        $dataDosen = [
            1 => [
                'id'          => 1,
                'nama'        => 'Imam Fahrur Rozi, ST., MT.',
                'jabatan'     => 'Kepala Lab',
                'foto_url'    => '/web_profil_lab_se/assets/img/dosen/imam.png',
                'email'       => 'imam.rozi@polinema.ac.id',
                'phone'       => '+62 812-3456-7890',
                'nidn'        => '0123456789',
                'pendidikan'  => 'S2 Teknik Informatika',
                'bidang_keahlian' => 'Software Engineering, Project Management',
                'deskripsi'   => 'Kepala Laboratorium Software Engineering dengan pengalaman lebih dari 10 tahun di bidang pengembangan perangkat lunak dan manajemen proyek.'
            ],
            2 => [
                'id'          => 2,
                'nama'        => 'Ridwan Rismanto, SST., M.Kom.',
                'jabatan'     => 'Tenaga Pengajar',
                'foto_url'    => '/web_profil_lab_se/assets/img/dosen/ridwan.png',
                'email'       => 'ridwan.rismanto@polinema.ac.id',
                'phone'       => '+62 813-4567-8901',
                'nidn'        => '0234567890',
                'pendidikan'  => 'S2 Ilmu Komputer',
                'bidang_keahlian' => 'Web Development, Database Management',
                'deskripsi'   => 'Tenaga pengajar dengan spesialisasi dalam pengembangan aplikasi web dan manajemen basis data.'
            ],
            3 => [
                'id'            => 3,
                'nama'          => 'Dian Hanifudin Subhi, S.Kom., M.Kom.',
                'jabatan'       => 'Tenaga Pengajar',
                'foto_url'      => '/web_profil_lab_se/assets/img/dosen/dian.png',
                'nip'           => '198806102019031018',
                'nidn'          => '0010068807',
                'program_studi' => 'Teknik Informatika',
                'bidang'        => ['Cloud Computing'],
                'links'         => [
                    'linkedin'       => '#',
                    'google_scholar' => '#',
                    'sinta'          => '#',
                    'email'          => 'mailto:subhi1@mhs.if.its.ac.id',
                    'cv'             => '#'
                ],
                'pendidikan'    => [
                    'S2 – Teknik Informatika, Institut Teknologi Sepuluh Nopember',
                    'S1 – Teknik Informatika, Institut Teknologi Sepuluh Nopember'
                ],
                'sertifikasi'   => [
                    'IT Specialist – Software Development',
                    'Associate Cloud Engineer',
                    'AWS Knowledge: Cloud Essentials'
                ]
            ],
            4 => [
                'id'            => 4,
                'nama'          => 'Moch. Zawaruddin Abdullah, S.ST., M.Kom.',
                'jabatan'       => 'Tenaga Pengajar',
                'foto_url'      => '/web_profil_lab_se/assets/img/dosen/zawa.png',
                'nip'           => '198902102019031019',
                'nidn'          => '0010028906',
                'program_studi' => 'Sistem Informasi Bisnis',
                'bidang'        => ['Information Retrieval', 'Data Mining', 'Information System', 'Data Science', 'AI'],
                'links'         => [
                    'linkedin'       => '#',
                    'google_scholar' => '#',
                    'sinta'          => '#',
                    'email'          => 'mailto:zawaruddin@polinema.ac.id',
                    'cv'             => '#'
                ],
                'pendidikan'    => [
                    'S2 – Teknik Informatika, Institut Teknologi Sepuluh Nopember',
                    'D4 – Teknik Informatika, PENS',
                    'D3 – Teknik Informatika, Politeknik Negeri Bandung'
                ],
                'sertifikasi'   => [
                    'IT Specialist – Software Development',
                    'Certified Data Science Practitioner (DSP-110)',
                    'Associate Cloud Engineer'
                ]
            ],
            5 => [
                'id'            => 5,
                'nama'          => 'Ariadi Retno Ririd, S.Kom., M.Kom.',
                'jabatan'       => 'Tenaga Pengajar',
                'foto_url'      => '/web_profil_lab_se/assets/img/dosen/ariadi.png',
                'nip'           => '198108102005012002',
                'nidn'          => '0010088101',
                'program_studi' => 'Sistem Informasi Bisnis',
                'bidang'        => ['Data Mining'],
                'links'         => [
                    'linkedin'       => '#',
                    'google_scholar' => '#',
                    'sinta'          => '#',
                    'email'          => 'mailto:faniri4education@gmail.com',
                    'cv'             => '#'
                ],
                'pendidikan'    => [
                    'S2 – Magister Komputer, Institut Teknologi Sepuluh Nopember',
                    'S1 – Sarjana Komputer, Institut Teknologi Sepuluh Nopember'
                ],
                'sertifikasi'   => []
            ],
            6 => [
                'id'            => 6,
                'nama'          => 'Elok Nur Hamdana, S.T., M.T.',
                'jabatan'       => 'Tenaga Pengajar',
                'foto_url'      => '/web_profil_lab_se/assets/img/dosen/elok.png',
                'nip'           => '198610022019032011',
                'nidn'          => '0702108601',
                'program_studi' => 'Teknologi Informasi (Kampus Kab. Lumajang)',
                'bidang'        => ['Sistem Informasi'],
                'links'         => [
                    'linkedin'       => '#',
                    'google_scholar' => '#',
                    'sinta'          => '#',
                    'email'          => 'mailto:elok@polinema.ac.id',
                    'cv'             => '#'
                ],
                'pendidikan'    => [
                    'S2 – Magister Teknik, Universitas Brawijaya'
                ],
                'sertifikasi'   => []
            ]
        ];

        // Cek apakah ID dosen ada
        if (!isset($dataDosen[$id])) {
            return $this->notFound();
        }

        $this->view('pages/personil/detail', [
            'title' => 'Detail Dosen',
            'dosen' => $dataDosen[$id],
            
        ], $dataDosen[$id], true);
    }

    public function notFound()
    {
        http_response_code(404);
        $this->view('errors/404');
    }
}

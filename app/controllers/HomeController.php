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

        $this->view('pages/home', $data);
    }

    public function about()
    {
        $data = [
            'title'       => 'Tentang Laboratorium SE',
            'description' => 'Informasi singkat tentang profil Laboratorium Software Engineering.'
        ];

        $this->view('pages/about', $data);
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

    public function personilDetail()
    {
        $id = $_GET['id'] ?? null;

        $dataDosen = [
            1 => [
                'id'            => 1,
                'nama'          => 'Imam Fahrur Rozi, ST., MT.',
                'jabatan'       => 'Tenaga Pengajar',
                'foto_url'      => '/web_profil_lab_se/assets/img/dosen/imam.png',
                'nip'           => '198406102008121004',
                'nidn'          => '0010068402',
                'program_studi' => 'Teknik Informatika',
                'bidang'        => ['Programming', 'Software', 'Data Mining', 'Text Processing'],
                'links'         => [
                    'linkedin'       => '#',
                    'google_scholar' => '#',
                    'sinta'          => '#',
                    'email'          => 'mailto:imam@polinema.ac.id',
                    'cv'             => '#'
                ],
                'pendidikan'    => [
                    'S2 – Teknik Elektro, Universitas Brawijaya (2010–2012)',
                    'S1 – Teknik Elektro, Universitas Brawijaya (2002–2007)'
                ],
                'sertifikasi'   => []
            ],
            2 => [
                'id'            => 2,
                'nama'          => 'Ridwan Rismanto, SST., M.Kom.',
                'jabatan'       => 'Tenaga Pengajar',
                'foto_url'      => '/web_profil_lab_se/assets/img/dosen/ridwan.png',
                'nip'           => '198603182012121001',
                'nidn'          => '0018038602',
                'program_studi' => 'Teknik Informatika',
                'bidang'        => ['Computer Science'],
                'links'         => [
                    'linkedin'       => '#',
                    'google_scholar' => '#',
                    'sinta'          => '#',
                    'email'          => 'mailto:rismanto@polinema.ac.id',
                    'cv'             => '#'
                ],
                'pendidikan'    => [
                    'S3 – Teknologi Informasi',
                    'S2 – Computer Science, Kumamoto University',
                    'D4 – Teknik Informatika'
                ],
                'sertifikasi'   => []
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

        $detail = $dataDosen[(int) $id] ?? null;

        if (!$detail) {
            http_response_code(404);
            $this->view('errors/404');
            return;
        }

        $this->view('pages/personil/detailDosen', [
            'title' => 'Profil Dosen',
            'dosen' => $detail
        ]);
    }

    public function notFound()
    {
        http_response_code(404);
        $this->view('errors/404');
    }
}

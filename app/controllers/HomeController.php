<?php

namespace Polinema\WebProfilLabSe\Controllers;

use Polinema\WebProfilLabSe\Core\Controller;
use Polinema\WebProfilLabSe\Models\Tentang;
use Polinema\WebProfilLabSe\Models\Album;
use Polinema\WebProfilLabSe\Models\VisiMisi;
use Polinema\WebProfilLabSe\Models\Article;
use Polinema\WebProfilLabSe\Models\FokusRiset; 
use Polinema\WebProfilLabSe\Models\Publikasi;
use Polinema\WebProfilLabSe\Models\Personil;
use Polinema\WebProfilLabSe\Models\Scope; 

class HomeController extends Controller
{
    public function index()
    {
        // 1. Ambil Data Tentang
        $tentangModel = new Tentang();
        $tentang = $tentangModel->getTentang();

        // 2. Ambil Data Album
        $albumModel = new Album();
        $album = $albumModel->getAll();

        // 3. Ambil Visi & Misi
        $visiMisiModel = new VisiMisi();
        $visiMisiData = $visiMisiModel->getAll();

        // 4. Ambil Artikel
        $articleModel = new Article();
        $latestArticles = $articleModel->getLatest(4);

        // 5. Ambil Fokus Riset (Core Competency - Section Tengah)
        $fokusRisetModel = new FokusRiset();
        $fokusRiset = $fokusRisetModel->getAll();
        
        // 6. Ambil Publikasi
        $publikasiModel = new Publikasi();
        $publikasi = array_slice($publikasiModel->getAll(), 0, 4);

        // 7. Ambil Personil
        $personilModel = new Personil();

        // Ambil semua dosen dan mahasiswa (tanpa dipotong)
        $dosen = $personilModel->getAll('Dosen');
        $mahasiswa = $personilModel->getAll('Mahasiswa');

        // 8. Ambil Scope Penelitian
        $scopeModel = new Scope();
        $scopes = $scopeModel->getAll();

        $data = [
            'title'          => 'Beranda Laboratorium SE',
            'tentang'        => $tentang,
            'album'          => $album,
            'visi'           => $visiMisiData['visi'],
            'misi'           => $visiMisiData['misi'],
            'articles'       => $latestArticles,
            'publikasi'      => $publikasi,
            'dataDosen'          => $dosen,              
            'mahasiswa'      => array_slice($mahasiswa, 0, 4),          
            'fokusRiset'     => $fokusRiset,
            'scopes'         => $scopes     
        ];

        $this->view('pages/home', $data, true);
    }

    public function profil()
    {
        // Panggil Model Tentang
        $tentangModel = new Tentang();
        $dataTentang = $tentangModel->getTentang();

        $data = [
            'title'       => 'Tentang Laboratorium SE',
            'description' => 'Informasi singkat tentang profil Laboratorium Software Engineering.',
            'tentang'     => $dataTentang // Kirim data ke View
        ];

        $this->view('pages/tentang/profil', $data, true);
    }

    public function visi_misi()
    {
        // 1. Panggil Model
        $visiMisiModel = new VisiMisi();
        
        // 2. Ambil data (method getAll sudah mengembalikan array ['visi' => ..., 'misi' => ...])
        $dataVisiMisi = $visiMisiModel->getAll();

        $data = [
            'title'       => 'Visi & Misi Laboratorium SE',
            'description' => 'Visi dan misi dari Laboratorium Software Engineering.',
            'visi'        => $dataVisiMisi['visi'], // String konten visi
            'misi'        => $dataVisiMisi['misi']  // Array list misi
        ];

        $this->view('pages/tentang/visi-misi', $data, true);
    }

    public function fokus_riset()
    {
        // 1. Panggil Model
        $fokusModel = new FokusRiset();
        
        // 2. Ambil data dari database
        $fokusData = $fokusModel->getAll();

        $data = [
            // Kirim data ke view dengan key 'fokus'
            'fokus' => $fokusData 
        ];

        $this->view('pages/tentang/fokus-riset', $data, true);
    }

    public function scope_penelitian()
    {
        // 1. Panggil Model
        $scopeModel = new Scope();
        
        // 2. Ambil data dari database
        $scopesData = $scopeModel->getAll();

        $data = [
            'pageTitle' => "Scope Penelitian | Laboratorium Software Engineering",
            // Kirim data ke view dengan key 'scopes'
            'scopes'    => $scopesData 
        ];

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

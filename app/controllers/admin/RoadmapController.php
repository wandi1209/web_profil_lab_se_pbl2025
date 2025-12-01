<?php

namespace Polinema\WebProfilLabSe\Controllers\Admin;

use Polinema\WebProfilLabSe\Core\Controller;
use PDO;


class RoadmapController extends Controller
{
    private $db;

    public function __construct()
    {
        parent::__construct();

        $this->db = new PDO(
            'pgsql:host=localhost;port=5432;dbname=web_profile_lab_se',
            'postgres',
            'password'
        );
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function index()
    {
        $stmt = $this->db->query('SELECT * FROM roadmap ORDER BY tahun, urutan');
        $dataRoadmap = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $data = [
            'title'       => 'Roadmap',
            'dataRoadmap' => $dataRoadmap
        ];

        $this->view('pages/admin/profile/roadmap/index', $data, true, 'admin');
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Roadmap'
        ];

        $this->view('pages/admin/profile/roadmap/create', $data, true, 'admin');
    }

    public function store()
    {
        $lab_profile_id = $_POST['lab_profile_id'] ?? null;
        $judul          = $_POST['judul'] ?? '';
        $deskripsi      = $_POST['deskripsi'] ?? '';
        $tahun          = $_POST['tahun'] ?? null;
        $urutan         = $_POST['urutan'] ?? null;

        $sql = 'SELECT sp_roadmap_insert(
                    :lab_profile_id,
                    :judul,
                    :deskripsi,
                    :tahun,
                    :urutan
                )';

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':lab_profile_id' => $lab_profile_id,
            ':judul'          => $judul,
            ':deskripsi'      => $deskripsi,
            ':tahun'          => $tahun,
            ':urutan'         => $urutan,
        ]);

        header('Location: /admin/profile/roadmap');
        exit;
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: /admin/profile/roadmap');
            exit;
        }

        $stmt = $this->db->prepare('SELECT * FROM roadmap WHERE id = :id');
        $stmt->execute([':id' => $id]);
        $roadmap = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$roadmap) {
            header('Location: /admin/profile/roadmap');
            exit;
        }

        $data = [
            'title'   => 'Edit Roadmap',
            'roadmap' => $roadmap
        ];

        $this->view('pages/admin/profile/roadmap/edit', $data, true, 'admin');
    }

    public function update()
    {
        $id             = $_POST['id'] ?? null;
        $lab_profile_id = $_POST['lab_profile_id'] ?? null;
        $judul          = $_POST['judul'] ?? '';
        $deskripsi      = $_POST['deskripsi'] ?? '';
        $tahun          = $_POST['tahun'] ?? null;
        $urutan         = $_POST['urutan'] ?? null;

        if (!$id) {
            header('Location: /admin/profile/roadmap');
            exit;
        }

        $sql = 'SELECT sp_roadmap_update(
                    :id,
                    :lab_profile_id,
                    :judul,
                    :deskripsi,
                    :tahun,
                    :urutan
                )';

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id'             => $id,
            ':lab_profile_id' => $lab_profile_id,
            ':judul'          => $judul,
            ':deskripsi'      => $deskripsi,
            ':tahun'          => $tahun,
            ':urutan'         => $urutan,
        ]);

        header('Location: /admin/profile/roadmap');
        exit;
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;

        if ($id) {
            $sql = 'SELECT sp_roadmap_delete(:id)';
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $id]);
        }

        header('Location: /admin/profile/roadmap');
        exit;
    }
}

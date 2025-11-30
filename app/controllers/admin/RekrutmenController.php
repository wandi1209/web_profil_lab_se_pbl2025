<?php
namespace Polinema\WebProfilLabSe\Controllers\Admin;

use Polinema\WebProfilLabSe\Core\Controller;
use PDO;

class RekrutmenController extends Controller
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
        $stmt = $this->db->query('SELECT * FROM pendaftar ORDER BY created_at DESC');
        $dataRekrutmen = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $data = [
            'title'        => 'Rekrutmen',
            'dataRekrutmen'=> $dataRekrutmen
        ];

        $this->view('pages/admin/rekrutmen/index', $data, true, 'admin');
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Rekrutmen'
        ];

        $this->view('pages/admin/rekrutmen/createRekrutmen', $data, true, 'admin');
    }

    public function store()
    {
        $nama          = $_POST['nama'] ?? '';
        $nim           = $_POST['nim'] ?? '';
        $kelas         = $_POST['kelas'] ?? '';
        $program_studi = $_POST['program_studi'] ?? '';
        $alasan        = $_POST['alasan'] ?? '';

        $sql = 'SELECT sp_pendaftar_insert(
                    :nama,
                    :nim,
                    :kelas,
                    :program_studi,
                    :alasan
                )';

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':nama'          => $nama,
            ':nim'           => $nim,
            ':kelas'         => $kelas,
            ':program_studi' => $program_studi,
            ':alasan'        => $alasan,
        ]);

        header('Location: /admin/rekrutmen');
        exit;
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: /admin/rekrutmen');
            exit;
        }

        $stmt = $this->db->prepare('SELECT * FROM pendaftar WHERE id = :id');
        $stmt->execute([':id' => $id]);
        $rekrutmen = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$rekrutmen) {
            header('Location: /admin/rekrutmen');
            exit;
        }

        $data = [
            'title'    => 'Edit Rekrutmen',
            'rekrutmen'=> $rekrutmen
        ];

        $this->view('pages/admin/rekrutmen/editRekrutmen', $data, true, 'admin');
    }

    public function update()
    {
        $id            = $_POST['id'] ?? null;
        $nama          = $_POST['nama'] ?? '';
        $nim           = $_POST['nim'] ?? '';
        $kelas         = $_POST['kelas'] ?? '';
        $program_studi = $_POST['program_studi'] ?? '';
        $alasan        = $_POST['alasan'] ?? '';

        if (!$id) {
            header('Location: /admin/rekrutmen');
            exit;
        }

        $sql = 'SELECT sp_pendaftar_update(
                    :id,
                    :nama,
                    :nim,
                    :kelas,
                    :program_studi,
                    :alasan
                )';

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id'            => $id,
            ':nama'          => $nama,
            ':nim'           => $nim,
            ':kelas'         => $kelas,
            ':program_studi' => $program_studi,
            ':alasan'        => $alasan,
        ]);

        header('Location: /admin/rekrutmen');
        exit;
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;

        if ($id) {
            $sql = 'SELECT sp_pendaftar_delete(:id)';
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $id]);
        }

        header('Location: /admin/rekrutmen');
        exit;
    }
}

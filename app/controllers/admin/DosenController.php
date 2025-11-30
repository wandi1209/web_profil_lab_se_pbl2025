<?php
namespace Polinema\WebProfilLabSe\Controllers\Admin;

use Polinema\WebProfilLabSe\Core\Controller;
use PDO;

class DosenController extends Controller
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
        $stmt = $this->db->prepare("SELECT * FROM personil WHERE position = 'Dosen' ORDER BY id");
        $stmt->execute();
        $dataDosen = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $data = [
            'title'     => 'Dosen',
            'dataDosen' => $dataDosen
        ];

        $this->view('pages/admin/personil/dosen/index', $data, true, 'admin');
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Dosen'
        ];

        $this->view('pages/admin/personil/createDosen', $data, true, 'admin');
    }

    public function store()
    {
        $lab_profile_id = $_POST['lab_profile_id'] ?? null;
        $nama           = $_POST['nama'] ?? '';
        $email          = $_POST['email'] ?? '';
        $foto_url       = $_POST['foto_url'] ?? '';
        $position       = 'Dosen';

        $sql = 'SELECT sp_personil_insert(
                    :lab_profile_id,
                    :nama,
                    :position,
                    :email,
                    :foto_url
                )';

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':lab_profile_id' => $lab_profile_id,
            ':nama'           => $nama,
            ':position'       => $position,
            ':email'          => $email,
            ':foto_url'       => $foto_url,
        ]);

        header('Location: /admin/personil/dosen');
        exit;
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: /admin/personil/dosen');
            exit;
        }

        $stmt = $this->db->prepare('SELECT * FROM personil WHERE id = :id');
        $stmt->execute([':id' => $id]);
        $dosen = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$dosen) {
            header('Location: /admin/personil/dosen');
            exit;
        }

        $data = [
            'title' => 'Edit Dosen',
            'dosen' => $dosen
        ];

        $this->view('pages/admin/personil/editDosen', $data, true, 'admin');
    }

    public function update()
    {
        $id             = $_POST['id'] ?? null;
        $lab_profile_id = $_POST['lab_profile_id'] ?? null;
        $nama           = $_POST['nama'] ?? '';
        $email          = $_POST['email'] ?? '';
        $foto_url       = $_POST['foto_url'] ?? '';
        $position       = 'Dosen';

        if (!$id) {
            header('Location: /admin/personil/dosen');
            exit;
        }

        $sql = 'SELECT sp_personil_update(
                    :id,
                    :lab_profile_id,
                    :nama,
                    :position,
                    :email,
                    :foto_url
                )';

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id'             => $id,
            ':lab_profile_id' => $lab_profile_id,
            ':nama'           => $nama,
            ':position'       => $position,
            ':email'          => $email,
            ':foto_url'       => $foto_url,
        ]);

        header('Location: /admin/personil/dosen');
        exit;
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;

        if ($id) {
            $sql = 'SELECT sp_personil_delete(:id)';
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $id]);
        }

        header('Location: /admin/personil/dosen');
        exit;
    }
}

<?php
namespace Polinema\WebProfilLabSe\Controllers\Admin;

use Polinema\WebProfilLabSe\Core\Controller;
use PDO;

class VisiMisiController extends Controller
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
        $stmt = $this->db->query('SELECT * FROM profile ORDER BY id');
        $dataVisiMisi = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $data = [
            'title'       => 'Visi dan Misi',
            'dataVisiMisi'=> $dataVisiMisi
        ];

        $this->view('pages/admin/profile/visi_misi/index', $data, true, 'admin');
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: /admin/profile/visiMisi');
            exit;
        }

        $stmt = $this->db->prepare('SELECT * FROM profile WHERE id = :id');
        $stmt->execute([':id' => $id]);
        $visiMisi = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$visiMisi) {
            header('Location: /admin/profile/visiMisi');
            exit;
        }

        $data = [
            'title'    => 'Edit Visi dan Misi',
            'visiMisi' => $visiMisi
        ];

        $this->view('pages/admin/profile/visi_misi/edit', $data, true, 'admin');
    }

    public function update()
    {
        $id    = $_POST['id'] ?? null;
        $title = $_POST['title'] ?? '';
        $text  = $_POST['text'] ?? '';

        if (!$id) {
            header('Location: /admin/profile/visiMisi');
            exit;
        }

        $sql = 'SELECT sp_profile_update(:id, :title, :text)';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id'    => $id,
            ':title' => $title,
            ':text'  => $text,
        ]);

        header('Location: /admin/profile/visiMisi');
        exit;
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;

        if ($id) {
            $sql = 'SELECT sp_profile_delete(:id)';
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $id]);
        }

        header('Location: /admin/profile/visiMisi');
        exit;
    }
}

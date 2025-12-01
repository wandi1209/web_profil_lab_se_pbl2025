<?php
namespace Polinema\WebProfilLabSe\Controllers\Admin;

use Polinema\WebProfilLabSe\Core\Controller;
use PDO;

class AlbumController extends Controller
{
    /** @var PDO */
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
        $stmt = $this->db->query('SELECT * FROM album ORDER BY id DESC');
        $dataAlbum = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $data = [
            'title'     => 'Album',
            'dataAlbum' => $dataAlbum
        ];

        $this->view('pages/admin/profile/album/index', $data, true, 'admin');
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Album'
        ];

        $this->view('pages/admin/profile/album/create', $data, true, 'admin');
    }

    public function store()
    {
        $lab_profile_id = $_POST['lab_profile_id'] ?? null;
        $judul          = $_POST['judul'] ?? '';
        $gambar_url     = $_POST['gambar_url'] ?? '';
        $tautan_url     = $_POST['tautan_url'] ?? '';
        $aktif          = isset($_POST['aktif']);

        $sql = 'SELECT sp_album_insert(
                    :lab_profile_id,
                    :judul,
                    :gambar_url,
                    :tautan_url,
                    :aktif
                )';

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':lab_profile_id' => $lab_profile_id,
            ':judul'          => $judul,
            ':gambar_url'     => $gambar_url,
            ':tautan_url'     => $tautan_url,
            ':aktif'          => $aktif,
        ]);

        header('Location: /admin/profile/album');
        exit;
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: /admin/profile/album');
            exit;
        }

        $stmt = $this->db->prepare('SELECT * FROM album WHERE id = :id');
        $stmt->execute([':id' => $id]);
        $album = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$album) {
            header('Location: /admin/profile/album');
            exit;
        }

        $data = [
            'title' => 'Edit Album',
            'album' => $album
        ];

        $this->view('pages/admin/profile/album/edit', $data, true, 'admin');
    }

    public function update()
    {
        $id             = $_POST['id'] ?? null;
        $lab_profile_id = $_POST['lab_profile_id'] ?? null;
        $judul          = $_POST['judul'] ?? '';
        $gambar_url     = $_POST['gambar_url'] ?? '';
        $tautan_url     = $_POST['tautan_url'] ?? '';
        $aktif          = isset($_POST['aktif']);

        if (!$id) {
            header('Location: /admin/profile/album');
            exit;
        }

        $sql = 'SELECT sp_album_update(
                    :id,
                    :lab_profile_id,
                    :judul,
                    :gambar_url,
                    :tautan_url,
                    :aktif
                )';

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id'             => $id,
            ':lab_profile_id' => $lab_profile_id,
            ':judul'          => $judul,
            ':gambar_url'     => $gambar_url,
            ':tautan_url'     => $tautan_url,
            ':aktif'          => $aktif,
        ]);

        header('Location: /admin/profile/album');
        exit;
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;

        if ($id) {
            $sql = 'SELECT sp_album_delete(:id)';
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $id]);
        }

        header('Location: /admin/profile/album');
        exit;
    }
}

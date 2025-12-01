<?php
namespace Polinema\WebProfilLabSe\Controllers\Admin;

use Polinema\WebProfilLabSe\Core\Controller;
use PDO;

class BlogController extends Controller
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
        $stmt = $this->db->query('SELECT * FROM article ORDER BY created_at DESC');
        $dataBlog = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $data = [
            'title'    => 'Blog Artikel',
            'dataBlog' => $dataBlog
        ];

        $this->view('pages/admin/blog/index', $data, true, 'admin');
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Blog'
        ];

        $this->view('pages/admin/blog/createBlog', $data, true, 'admin');
    }

    public function store()
    {
        $judul      = $_POST['judul'] ?? '';
        $slug       = $_POST['slug'] ?? '';
        $gambar_url = $_POST['gambar_url'] ?? '';
        $ringkasan  = $_POST['ringkasan'] ?? '';
        $konten     = $_POST['konten'] ?? '';
        $author_id  = $_POST['author_id'] ?? 1;

        $sql = 'SELECT sp_article_insert(
                    :judul,
                    :slug,
                    :gambar_url,
                    :ringkasan,
                    :konten,
                    :author_id
                )';

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':judul'      => $judul,
            ':slug'       => $slug,
            ':gambar_url' => $gambar_url,
            ':ringkasan'  => $ringkasan,
            ':konten'     => $konten,
            ':author_id'  => $author_id,
        ]);

        header('Location: /admin/blog');
        exit;
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: /admin/blog');
            exit;
        }

        $stmt = $this->db->prepare('SELECT * FROM article WHERE id = :id');
        $stmt->execute([':id' => $id]);
        $blog = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$blog) {
            header('Location: /admin/blog');
            exit;
        }

        $data = [
            'title' => 'Edit Blog',
            'blog'  => $blog
        ];

        $this->view('pages/admin/blog/editBlog', $data, true, 'admin');
    }

    public function update()
    {
        $id         = $_POST['id'] ?? null;
        $judul      = $_POST['judul'] ?? '';
        $slug       = $_POST['slug'] ?? '';
        $gambar_url = $_POST['gambar_url'] ?? '';
        $ringkasan  = $_POST['ringkasan'] ?? '';
        $konten     = $_POST['konten'] ?? '';
        $author_id  = $_POST['author_id'] ?? 1;

        if (!$id) {
            header('Location: /admin/blog');
            exit;
        }

        $sql = 'SELECT sp_article_update(
                    :id,
                    :judul,
                    :slug,
                    :gambar_url,
                    :ringkasan,
                    :konten,
                    :author_id
                )';

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id'         => $id,
            ':judul'      => $judul,
            ':slug'       => $slug,
            ':gambar_url' => $gambar_url,
            ':ringkasan'  => $ringkasan,
            ':konten'     => $konten,
            ':author_id'  => $author_id,
        ]);

        header('Location: /admin/blog');
        exit;
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;

        if ($id) {
            $sql = 'SELECT sp_article_delete(:id)';
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $id]);
        }

        header('Location: /admin/blog');
        exit;
    }
}

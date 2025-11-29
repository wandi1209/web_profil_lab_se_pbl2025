<?php

namespace Polinema\WebProfilLabSe\Models;

use Polinema\WebProfilLabSe\Core\Database;
use PDO;

class Article
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll()
    {
        // PERBAIKAN: Menggunakan tabel "user" dengan tanda kutip
        $query = 'SELECT a.*, u.username as author_name 
                  FROM article a 
                  LEFT JOIN "user" u ON a.author_id = u.id 
                  ORDER BY a.created_at DESC';
                  
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ... method find, findBySlug, create, update, delete sama seperti sebelumnya ...
    
    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM article WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function findBySlug($slug)
    {
        $stmt = $this->db->prepare("SELECT * FROM article WHERE slug = :slug");
        $stmt->execute([':slug' => $slug]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($title, $slug, $gambar_url, $ringkasan, $content, $author_id)
    {
        $query = "INSERT INTO article (title, slug, gambar_url, ringkasan, content, author_id, created_at) 
                  VALUES (:title, :slug, :gambar_url, :ringkasan, :content, :author_id, NOW())";

        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':title'      => $title,
            ':slug'       => $slug,
            ':gambar_url' => $gambar_url,
            ':ringkasan'  => $ringkasan,
            ':content'    => $content,
            ':author_id'  => $author_id
        ]);
    }

    public function update($id, $title, $slug, $gambar_url, $ringkasan, $content)
    {
        if ($gambar_url) {
            $query = "UPDATE article SET title = :title, slug = :slug, gambar_url = :gambar, 
                      ringkasan = :ringkasan, content = :content WHERE id = :id";
            $params = [
                ':id' => $id, ':title' => $title, ':slug' => $slug, 
                ':gambar' => $gambar_url, ':ringkasan' => $ringkasan, ':content' => $content
            ];
        } else {
            $query = "UPDATE article SET title = :title, slug = :slug, 
                      ringkasan = :ringkasan, content = :content WHERE id = :id";
            $params = [
                ':id' => $id, ':title' => $title, ':slug' => $slug, 
                ':ringkasan' => $ringkasan, ':content' => $content
            ];
        }

        $stmt = $this->db->prepare($query);
        return $stmt->execute($params);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM article WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
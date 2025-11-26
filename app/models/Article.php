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

    // Buat artikel baru
    public function create($title, $slug, $gambarUrl, $ringkasan, $content, $authorId)
    {
        $stmt = $this->db->prepare("
            INSERT INTO article (title, slug, gambar_url, ringkasan, content, created_at, author_id)
            VALUES (:title, :slug, :gambar_url, :ringkasan, :content, NOW(), :author_id)
        ");

        return $stmt->execute([
            'title'      => $title,
            'slug'       => $slug,
            'gambar_url' => $gambarUrl,
            'ringkasan'  => $ringkasan,
            'content'    => $content,
            'author_id'  => $authorId
        ]);
    }

    // Update artikel
    public function update($id, $title, $slug, $gambarUrl, $ringkasan, $content)
    {
        $stmt = $this->db->prepare("
            UPDATE article
            SET title = :title,
                slug = :slug,
                gambar_url = :gambar_url,
                ringkasan = :ringkasan,
                content = :content
            WHERE id = :id
        ");

        return $stmt->execute([
            'title'      => $title,
            'slug'       => $slug,
            'gambar_url' => $gambarUrl,
            'ringkasan'  => $ringkasan,
            'content'    => $content,
            'id'         => $id
        ]);
    }

    // Hapus artikel
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM article WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>
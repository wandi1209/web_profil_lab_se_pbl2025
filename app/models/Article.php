<?php

namespace Polinema\WebProfilLabSe\Models;

use Polinema\WebProfilLabSe\Core\Database;

class Article
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll()
    {
        return $this->db->query("SELECT * FROM article")->fetchAll();
    }

    public function getByAuthor($authorId)
    {
        $stmt = $this->db->prepare("SELECT * FROM article WHERE author_id = :id");
        $stmt->execute([':id' => $authorId]);

        return $stmt->fetchAll();
    }
}

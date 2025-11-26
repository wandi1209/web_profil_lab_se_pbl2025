<?php

namespace Polinema\WebProfilLabSe\Models;

use Polinema\WebProfilLabSe\Core\Database;
use PDO;

class FokusRiset
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    // Tambah fokus riset baru
    public function create($title)
    {
        $stmt = $this->db->prepare("
            INSERT INTO fokusriset (title, created_at)
            VALUES (:title, NOW())
        ");

        return $stmt->execute([
            'title' => $title
        ]);
    }

    // Update fokus riset
    public function update($id, $title)
    {
        $stmt = $this->db->prepare("
            UPDATE fokusriset
            SET title = :title
            WHERE id = :id
        ");

        return $stmt->execute([
            'title' => $title,
            'id'    => $id
        ]);
    }

    // Hapus fokus riset
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM fokusriset WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>
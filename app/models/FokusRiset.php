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

    public function getAll()
    {
        try {
            $stmt = $this->db->query("SELECT * FROM fokusriset ORDER BY id ASC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM fokusriset WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Tambah data (Update: tambah icon & description)
    public function create($data)
    {
        $stmt = $this->db->prepare("
            INSERT INTO fokusriset (title, icon, description, created_at)
            VALUES (:title, :icon, :description, NOW())
        ");

        return $stmt->execute([
            'title'       => $data['title'],
            'icon'        => $data['icon'] ?? 'bi-diagram-3-fill',
            'description' => $data['description'] ?? ''
        ]);
    }

    // Update data
    public function update($id, $data)
    {
        $stmt = $this->db->prepare("
            UPDATE fokusriset
            SET title = :title,
                icon = :icon,
                description = :description
            WHERE id = :id
        ");

        return $stmt->execute([
            'title'       => $data['title'],
            'icon'        => $data['icon'],
            'description' => $data['description'],
            'id'          => $id
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM fokusriset WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>
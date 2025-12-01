<?php

namespace Polinema\WebProfilLabSe\Models;

use Polinema\WebProfilLabSe\Core\Database;
use PDO;

class Album
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM album ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Khusus untuk mengambil gambar yang dijadikan slider
    public function getSliders()
    {
        $stmt = $this->db->query("SELECT * FROM album WHERE slider = 1 AND aktif = 1");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($title, $gambar_url, $tautan_url, $aktif, $slider)
    {
        $query = "INSERT INTO album (title, gambar_url, tautan_url, aktif, slider) 
                  VALUES (:title, :gambar, :tautan, :aktif, :slider)";
        
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':title'  => $title,
            ':gambar' => $gambar_url,
            ':tautan' => $tautan_url,
            ':aktif'  => $aktif,
            ':slider' => $slider
        ]);
    }

    public function update($id, $title, $gambar_url, $tautan_url, $aktif, $slider)
    {
        $query = "UPDATE album SET title = :title, tautan_url = :tautan, 
                  aktif = :aktif, slider = :slider";
        
        $params = [
            ':id' => $id, ':title' => $title, ':tautan' => $tautan_url, 
            ':aktif' => $aktif, ':slider' => $slider
        ];

        if ($gambar_url) {
            $query .= ", gambar_url = :gambar";
            $params[':gambar'] = $gambar_url;
        }
        
        $query .= " WHERE id = :id";
        
        $stmt = $this->db->prepare($query);
        return $stmt->execute($params);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM album WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
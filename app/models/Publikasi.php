<?php

namespace Polinema\WebProfilLabSe\Models;

use Polinema\WebProfilLabSe\Core\Database;
use PDO;

class Publikasi
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll()
    {
        // Join ke tabel personil untuk ambil nama penulis
        $query = "SELECT p.*, per.nama as nama_penulis, per.kategori 
                  FROM publikasi p
                  JOIN personil per ON p.personil_id = per.id
                  ORDER BY p.tahun DESC, p.created_at DESC";
        
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $query = "SELECT * FROM publikasi WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        try {
            $query = "INSERT INTO publikasi (personil_id, judul, tahun, url) 
                      VALUES (:personil_id, :judul, :tahun, :url)";
            
            $stmt = $this->db->prepare($query);
            return $stmt->execute([
                ':personil_id' => $data['personil_id'],
                ':judul'       => $data['judul'],
                ':tahun'       => $data['tahun'],
                ':url'         => $data['url']
            ]);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function update($id, $data)
    {
        try {
            $query = "UPDATE publikasi 
                      SET personil_id = :personil_id, 
                          judul = :judul, 
                          tahun = :tahun, 
                          url = :url,
                          updated_at = CURRENT_TIMESTAMP
                      WHERE id = :id";
            
            $stmt = $this->db->prepare($query);
            return $stmt->execute([
                ':id'          => $id,
                ':personil_id' => $data['personil_id'],
                ':judul'       => $data['judul'],
                ':tahun'       => $data['tahun'],
                ':url'         => $data['url']
            ]);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM publikasi WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
?>
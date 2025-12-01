<?php

namespace Polinema\WebProfilLabSe\Models;

use Polinema\WebProfilLabSe\Core\Database;
use PDO;

class Roadmap
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll()
    {
        // Biasanya roadmap diurutkan berdasarkan tahun atau urutan
        $stmt = $this->db->query("SELECT * FROM roadmap ORDER BY tahun ASC, urutan ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($judul, $deskripsi, $tahun, $urutan)
    {
        $query = "INSERT INTO roadmap (judul, deskripsi, tahun, urutan) 
                  VALUES (:judul, :deskripsi, :tahun, :urutan)";
        
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':judul'     => $judul,
            ':deskripsi' => $deskripsi,
            ':tahun'     => $tahun,
            ':urutan'    => $urutan
        ]);
    }

    public function update($id, $judul, $deskripsi, $tahun, $urutan)
    {
        $query = "UPDATE roadmap SET judul = :judul, deskripsi = :deskripsi, 
                  tahun = :tahun, urutan = :urutan WHERE id = :id";
        
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':id'        => $id,
            ':judul'     => $judul,
            ':deskripsi' => $deskripsi,
            ':tahun'     => $tahun,
            ':urutan'    => $urutan
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM roadmap WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
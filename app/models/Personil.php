<?php

namespace Polinema\WebProfilLabSe\Models;

use Polinema\WebProfilLabSe\Core\Database;

class Personil
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getByLab($labId)
    {
        $stmt = $this->db->prepare("SELECT * FROM personil WHERE lab_profile_id = :id");
        $stmt->execute([':id' => $labId]);
        return $stmt->fetchAll();
    }

    // CRUD Dosen
    
    public function getAllDosen()
    {
        $stmt = $this->db->query("SELECT * FROM dosen ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    public function getDosenById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM dosen WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function insertDosen($kategori, $konten, $gambar)
    {
        $stmt = $this->db->prepare("
            INSERT INTO dosen (kategori, konten, gambar)
            VALUES (:kategori, :konten, :gambar)
        ");

        return $stmt->execute([
            ':kategori' => $kategori,
            ':konten'   => $konten,
            ':gambar'   => $gambar
        ]);
    }

    public function updateDosen($id, $kategori, $konten, $gambarBaru = null)
    {
        if ($gambarBaru) {
            $stmt = $this->db->prepare("
                UPDATE dosen
                SET kategori = :kategori,
                    konten = :konten,
                    gambar = :gambar
                WHERE id = :id
            ");

            return $stmt->execute([
                ':kategori' => $kategori,
                ':konten'   => $konten,
                ':gambar'   => $gambarBaru,
                ':id'       => $id
            ]);
        } else {
            $stmt = $this->db->prepare("
                UPDATE dosen
                SET kategori = :kategori,
                    konten = :konten
                WHERE id = :id
            ");

            return $stmt->execute([
                ':kategori' => $kategori,
                ':konten'   => $konten,
                ':id'       => $id
            ]);
        }
    }

    public function deleteDosen($id)
    {
        $stmt = $this->db->prepare("DELETE FROM dosen WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}

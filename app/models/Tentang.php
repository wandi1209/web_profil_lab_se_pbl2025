<?php

namespace Polinema\WebProfilLabSe\Models;

use Polinema\WebProfilLabSe\Core\Database;
use PDO;

class Tentang
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Get data tentang (hanya 1 record)
     */
    public function getTentang()
    {
        $query = "SELECT * FROM tentang LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Create atau Update Tentang dengan gambar
     */
    public function saveTentang($judul, $konten, $gambar = null)
    {
        // Cek apakah data tentang sudah ada
        $existing = $this->getTentang();

        if ($existing) {
            // Update
            if ($gambar !== null) {
                // Update dengan gambar baru
                $query = "UPDATE tentang SET judul = :judul, konten = :konten, gambar = :gambar, updated_at = CURRENT_TIMESTAMP WHERE id = :id";
                $stmt = $this->db->prepare($query);
                return $stmt->execute([
                    ':judul' => $judul,
                    ':konten' => $konten,
                    ':gambar' => $gambar,
                    ':id' => $existing['id']
                ]);
            } else {
                // Update tanpa gambar
                $query = "UPDATE tentang SET judul = :judul, konten = :konten, updated_at = CURRENT_TIMESTAMP WHERE id = :id";
                $stmt = $this->db->prepare($query);
                return $stmt->execute([
                    ':judul' => $judul,
                    ':konten' => $konten,
                    ':id' => $existing['id']
                ]);
            }
        } else {
            // Insert
            $query = "INSERT INTO tentang (judul, konten, gambar) VALUES (:judul, :konten, :gambar)";
            $stmt = $this->db->prepare($query);
            return $stmt->execute([
                ':judul' => $judul,
                ':konten' => $konten,
                ':gambar' => $gambar
            ]);
        }
    }

    /**
     * Delete Tentang
     */
    public function deleteTentang($id)
    {
        $query = "DELETE FROM tentang WHERE id = :id";
        $stmt = $this->db->prepare($query);

        return $stmt->execute([':id' => $id]);
    }
}
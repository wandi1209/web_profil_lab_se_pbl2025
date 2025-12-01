<?php

namespace Polinema\WebProfilLabSe\Models;

use Polinema\WebProfilLabSe\Core\Database;
use PDO;

class VisiMisi
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Get Visi (hanya 1 record)
     */
    public function getVisi()
    {
        $query = "SELECT * FROM visi_misi WHERE kategori = 'visi' LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Get semua Misi
     */
    public function getAllMisi()
    {
        $query = "SELECT * FROM visi_misi WHERE kategori = 'misi' ORDER BY id ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get Misi by ID
     */
    public function getMisiById($id)
    {
        $query = "SELECT * FROM visi_misi WHERE id = :id AND kategori = 'misi' LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Create atau Update Visi
     */
    public function saveVisi($konten)
    {
        // Cek apakah visi sudah ada
        $existing = $this->getVisi();

        if ($existing) {
            // Update
            $query = "UPDATE visi_misi SET konten = :konten WHERE kategori = 'visi'";
            $stmt = $this->db->prepare($query);
            return $stmt->execute([':konten' => $konten]);
        } else {
            // Insert
            $query = "INSERT INTO visi_misi (kategori, konten) VALUES ('visi', :konten)";
            $stmt = $this->db->prepare($query);
            return $stmt->execute([':konten' => $konten]);
        }
    }

    /**
     * Create Misi baru
     */
    public function createMisi($konten)
    {
        $query = "INSERT INTO visi_misi (kategori, konten) VALUES ('misi', :konten)";
        $stmt = $this->db->prepare($query);

        return $stmt->execute([':konten' => $konten]);
    }

    /**
     * Update Misi
     */
    public function updateMisi($id, $konten)
    {
        $query = "UPDATE visi_misi SET konten = :konten WHERE id = :id AND kategori = 'misi'";
        $stmt = $this->db->prepare($query);

        return $stmt->execute([
            ':konten' => $konten,
            ':id' => $id
        ]);
    }

    /**
     * Delete Misi
     */
    public function deleteMisi($id)
    {
        $query = "DELETE FROM visi_misi WHERE id = :id AND kategori = 'misi'";
        $stmt = $this->db->prepare($query);

        return $stmt->execute([':id' => $id]);
    }

    /**
     * Count total Misi
     */
    public function countMisi()
    {
        $query = "SELECT COUNT(*) as total FROM visi_misi WHERE kategori = 'misi'";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }

    /**
     * Get all Visi & Misi untuk public view
     */
    public function getAll()
    {
        $visi = $this->getVisi();
        $misi = $this->getAllMisi();

        return [
            'visi' => $visi['konten'] ?? '',
            'misi' => $misi
        ];
    }
}
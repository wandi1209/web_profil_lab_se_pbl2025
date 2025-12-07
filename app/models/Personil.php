<?php

namespace Polinema\WebProfilLabSe\Models;

use Polinema\WebProfilLabSe\Core\Database;
use PDO;
use Exception;

class Personil
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Get all personil dengan filter kategori
     */
    /**
     * Get all personil dengan filter kategori
     */
    public function getAll($kategori = null)
    {
        try {
            if ($kategori) {
                if (strtolower(trim($kategori)) === 'dosen') {
                    $query = "SELECT * FROM personil WHERE TRIM(kategori) = :kategori ORDER BY urutan ASC, id ASC";
                } else {
                    $query = "SELECT * FROM personil WHERE TRIM(kategori) = :kategori ORDER BY id DESC";
                }
                $stmt = $this->db->prepare($query);
                $stmt->execute([':kategori' => $kategori]);
            } else {
                $query = "SELECT * FROM personil ORDER BY id DESC";
                $stmt = $this->db->prepare($query);
                $stmt->execute();
            }
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log('Personil getAll Error: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Get personil by ID
     */
    public function getById($id)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM personil WHERE id = :id LIMIT 1");
            $stmt->execute([':id' => $id]);

            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            error_log('Personil getById Error: ' . $e->getMessage());
            return null;
        }
    }

/**
     * Create personil baru (UPDATE: Tambah Sinta & Scholar)
     */
    public function create($data)
    {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO personil (
                    nama, kategori, position, email, nidn, keahlian, 
                    pendidikan, linkedin, github, foto_url, urutan,
                    link_sinta, link_scholar
                )
                VALUES (
                    :nama, :kategori, :position, :email, :nidn, :keahlian,
                    :pendidikan, :linkedin, :github, :foto, :urutan,
                    :link_sinta, :link_scholar
                )
            ");

            return $stmt->execute([
                ':nama'         => $data['nama'],
                ':kategori'     => $data['kategori'],
                ':position'     => $data['position'],
                ':email'        => $data['email'],
                ':nidn'         => $data['nidn'] ?? null,
                ':keahlian'     => $data['keahlian'] ?? null,
                ':pendidikan'   => $data['pendidikan'] ?? null,
                ':linkedin'     => $data['linkedin'] ?? null,
                ':github'       => $data['github'] ?? null,
                ':foto'         => $data['foto_url'] ?? null,
                ':urutan'       => $data['urutan'] ?? 999,
                ':link_sinta'   => $data['link_sinta'] ?? null,   // TAMBAHAN
                ':link_scholar' => $data['link_scholar'] ?? null  // TAMBAHAN
            ]);

        } catch (Exception $e) {
            error_log('Personil create Error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Update personil (UPDATE: Tambah Sinta & Scholar)
     */
    public function update($id, $data)
    {
        try {
            $query = "
                UPDATE personil
                SET nama = :nama,
                    kategori = :kategori,
                    position = :position,
                    email = :email,
                    nidn = :nidn,
                    keahlian = :keahlian,
                    pendidikan = :pendidikan,
                    linkedin = :linkedin,
                    github = :github,
                    urutan = :urutan,
                    link_sinta = :link_sinta,       
                    link_scholar = :link_scholar,   
                    updated_at = CURRENT_TIMESTAMP
            ";

            $params = [
                ':nama'         => $data['nama'],
                ':kategori'     => $data['kategori'],
                ':position'     => $data['position'],
                ':email'        => $data['email'],
                ':nidn'         => $data['nidn'] ?? null,
                ':keahlian'     => $data['keahlian'] ?? null,
                ':pendidikan'   => $data['pendidikan'] ?? null,
                ':linkedin'     => $data['linkedin'] ?? null,
                ':github'       => $data['github'] ?? null,
                ':urutan'       => $data['urutan'] ?? 999,
                ':link_sinta'   => $data['link_sinta'] ?? null,   // TAMBAHAN
                ':link_scholar' => $data['link_scholar'] ?? null, // TAMBAHAN
                ':id'           => $id
            ];

            if (array_key_exists('foto_url', $data)) {
                $query .= ", foto_url = :foto";
                $params[':foto'] = $data['foto_url'];
            }

            $query .= " WHERE id = :id";

            $stmt = $this->db->prepare($query);
            return $stmt->execute($params);

        } catch (Exception $e) {
            error_log('Personil update Error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Delete personil
     */
    public function delete($id)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM personil WHERE id = :id");
            return $stmt->execute([':id' => $id]);

        } catch (Exception $e) {
            error_log('Personil delete Error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Count personil by kategori
     */
    public function countByKategori($kategori)
    {
        try {
            $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM personil WHERE kategori = :kategori");
            $stmt->execute([':kategori' => $kategori]);
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'] ?? 0;

        } catch (Exception $e) {
            error_log('Personil countByKategori Error: ' . $e->getMessage());
            return 0;
        }
    }

    /**
     * Parse JSON field (untuk pendidikan & publikasi)
     * Convert JSON string ke array
     */
    public function parseJsonField($jsonString)
    {
        // Jika kosong atau null, return array kosong
        if (empty($jsonString) || is_null($jsonString)) {
            return [];
        }

        // Jika sudah array, langsung return
        if (is_array($jsonString)) {
            return $jsonString;
        }

        // Decode JSON
        $decoded = json_decode($jsonString, true);

        // Jika decode gagal atau bukan array, return array kosong
        if (json_last_error() !== JSON_ERROR_NONE || !is_array($decoded)) {
            error_log('JSON Parse Error: ' . json_last_error_msg());
            return [];
        }

        return $decoded;
    }

    // TAMBAHKAN INI JIKA BELUM ADA
    public function getDosenList()
    {
        try {
            // FIX: Gunakan IN untuk menangani 'Dosen' (besar) atau 'dosen' (kecil)
            $query = "SELECT id, nama FROM personil WHERE kategori IN ('Dosen', 'dosen') ORDER BY nama ASC";
            $stmt = $this->db->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            return [];
        }
    }
}
?>
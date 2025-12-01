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
    public function getAll($kategori = null)
    {
        try {
            if ($kategori) {
                $query = "SELECT * FROM personil WHERE kategori = :kategori ORDER BY id DESC";
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
     * Create personil baru
     */
    public function create($data)
    {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO personil (
                    nama, kategori, position, email, nidn, keahlian, 
                    pendidikan, publikasi, linkedin, github, foto_url
                )
                VALUES (
                    :nama, :kategori, :position, :email, :nidn, :keahlian,
                    :pendidikan, :publikasi, :linkedin, :github, :foto
                )
            ");

            return $stmt->execute([
                ':nama'        => $data['nama'],
                ':kategori'    => $data['kategori'],
                ':position'    => $data['position'],
                ':email'       => $data['email'],
                ':nidn'        => $data['nidn'] ?? null,
                ':keahlian'    => $data['keahlian'] ?? null,
                ':pendidikan'  => $data['pendidikan'] ?? null,
                ':publikasi'   => $data['publikasi'] ?? null,
                ':linkedin'    => $data['linkedin'] ?? null,
                ':github'      => $data['github'] ?? null,
                ':foto'        => $data['foto_url'] ?? null
            ]);

        } catch (Exception $e) {
            error_log('Personil create Error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Update personil
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
                    publikasi = :publikasi,
                    linkedin = :linkedin,
                    github = :github,
                    updated_at = CURRENT_TIMESTAMP
            ";

            $params = [
                ':nama'        => $data['nama'],
                ':kategori'    => $data['kategori'],
                ':position'    => $data['position'],
                ':email'       => $data['email'],
                ':nidn'        => $data['nidn'] ?? null,
                ':keahlian'    => $data['keahlian'] ?? null,
                ':pendidikan'  => $data['pendidikan'] ?? null,
                ':publikasi'   => $data['publikasi'] ?? null,
                ':linkedin'    => $data['linkedin'] ?? null,
                ':github'      => $data['github'] ?? null,
                ':id'          => $id
            ];

            // Jika ada foto baru
            if (isset($data['foto_url'])) {
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
}
?>
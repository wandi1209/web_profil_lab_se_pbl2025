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
    public function create($nama, $kategori, $position, $email, $fotoUrl = null)
    {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO personil (nama, kategori, position, email, foto_url)
                VALUES (:nama, :kategori, :position, :email, :foto)
            ");

            return $stmt->execute([
                ':nama'     => $nama,
                ':kategori' => $kategori,
                ':position' => $position,
                ':email'    => $email,
                ':foto'     => $fotoUrl
            ]);

        } catch (Exception $e) {
            error_log('Personil create Error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Update personil
     */
    public function update($id, $nama, $kategori, $position, $email, $fotoUrl = null)
    {
        try {
            if ($fotoUrl !== null) {
                $query = "
                    UPDATE personil
                    SET nama = :nama,
                        kategori = :kategori,
                        position = :position,
                        email = :email,
                        foto_url = :foto,
                        updated_at = CURRENT_TIMESTAMP
                    WHERE id = :id
                ";

                $params = [
                    ':nama'     => $nama,
                    ':kategori' => $kategori,
                    ':position' => $position,
                    ':email'    => $email,
                    ':foto'     => $fotoUrl,
                    ':id'       => $id
                ];

            } else {
                $query = "
                    UPDATE personil
                    SET nama = :nama,
                        kategori = :kategori,
                        position = :position,
                        email = :email,
                        updated_at = CURRENT_TIMESTAMP
                    WHERE id = :id
                ";

                $params = [
                    ':nama'     => $nama,
                    ':kategori' => $kategori,
                    ':position' => $position,
                    ':email'    => $email,
                    ':id'       => $id
                ];
            }

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
}
?>
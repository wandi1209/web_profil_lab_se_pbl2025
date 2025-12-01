<?php

namespace Polinema\WebProfilLabSe\Models;

use Polinema\WebProfilLabSe\Core\Database;
use PDO;
use Exception;

class Album
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Get all albums
     */
    public function getAll()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM album ORDER BY created_at DESC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log('Album getAll Error: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Get album by ID
     */
    public function getById($id)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM album WHERE id = :id LIMIT 1");
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log('Album getById Error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Create new album
     */
    public function create($data)
    {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO album (judul, deskripsi, foto_url, kategori)
                VALUES (:judul, :deskripsi, :foto_url, :kategori)
            ");

            return $stmt->execute([
                ':judul'     => $data['judul'],
                ':deskripsi' => $data['deskripsi'] ?? null,
                ':foto_url'  => $data['foto_url'],
                ':kategori'  => $data['kategori'] ?? 'kegiatan'
            ]);
        } catch (Exception $e) {
            error_log('Album create Error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Update album
     */
    public function update($id, $data)
    {
        try {
            $query = "
                UPDATE album
                SET judul = :judul,
                    deskripsi = :deskripsi,
                    kategori = :kategori,
                    updated_at = CURRENT_TIMESTAMP
            ";

            $params = [
                ':judul'     => $data['judul'],
                ':deskripsi' => $data['deskripsi'] ?? null,
                ':kategori'  => $data['kategori'] ?? 'kegiatan',
                ':id'        => $id
            ];

            // Jika ada foto baru
            if (isset($data['foto_url'])) {
                $query .= ", foto_url = :foto_url";
                $params[':foto_url'] = $data['foto_url'];
            }

            $query .= " WHERE id = :id";

            $stmt = $this->db->prepare($query);
            return $stmt->execute($params);
        } catch (Exception $e) {
            error_log('Album update Error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Delete album
     */
    public function delete($id)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM album WHERE id = :id");
            return $stmt->execute([':id' => $id]);
        } catch (Exception $e) {
            error_log('Album delete Error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Count albums by category
     */
    public function countByKategori($kategori)
    {
        try {
            $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM album WHERE kategori = :kategori");
            $stmt->execute([':kategori' => $kategori]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'] ?? 0;
        } catch (Exception $e) {
            error_log('Album countByKategori Error: ' . $e->getMessage());
            return 0;
        }
    }

    /**
     * Get albums by category
     */
    public function getByKategori($kategori)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM album WHERE kategori = :kategori ORDER BY created_at DESC");
            $stmt->execute([':kategori' => $kategori]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log('Album getByKategori Error: ' . $e->getMessage());
            return [];
        }
    }
}
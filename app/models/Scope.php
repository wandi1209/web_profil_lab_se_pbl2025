<?php

namespace Polinema\WebProfilLabSe\Models;

use Polinema\WebProfilLabSe\Core\Database;
use PDO;
use Exception;

class Scope
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM scope_penelitian ORDER BY id ASC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log('Scope getAll Error: ' . $e->getMessage());
            return [];
        }
    }

    public function getById($id)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM scope_penelitian WHERE id = :id LIMIT 1");
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log('Scope getById Error: ' . $e->getMessage());
            return null;
        }
    }

    // CREATE: Hapus icon_url
    public function create($data)
    {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO scope_penelitian (kategori, deskripsi, icon_bootstrap, tags)
                VALUES (:kategori, :deskripsi, :icon_bootstrap, :tags)
            ");

            return $stmt->execute([
                ':kategori'       => $data['kategori'],
                ':deskripsi'      => $data['deskripsi'],
                ':icon_bootstrap' => $data['icon_bootstrap'] ?? null,
                ':tags'           => $data['tags'] ?? null
            ]);
        } catch (Exception $e) {
            error_log('Scope create Error: ' . $e->getMessage());
            return false;
        }
    }

    // UPDATE: Hapus icon_url
    public function update($id, $data)
    {
        try {
            $query = "
                UPDATE scope_penelitian
                SET kategori = :kategori,
                    deskripsi = :deskripsi,
                    tags = :tags,
                    updated_at = CURRENT_TIMESTAMP
            ";

            $params = [
                ':kategori'   => $data['kategori'],
                ':deskripsi'  => $data['deskripsi'],
                ':tags'       => $data['tags'] ?? null,
                ':id'         => $id
            ];

            // Cek icon_bootstrap (menggunakan array_key_exists agar bisa update jadi NULL/Kosong)
            if (array_key_exists('icon_bootstrap', $data)) {
                $query .= ", icon_bootstrap = :icon_bootstrap";
                $params[':icon_bootstrap'] = $data['icon_bootstrap'];
            }

            $query .= " WHERE id = :id";

            $stmt = $this->db->prepare($query);
            return $stmt->execute($params);
        } catch (Exception $e) {
            error_log('Scope update Error: ' . $e->getMessage());
            return false;
        }
    }

    public function delete($id)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM scope_penelitian WHERE id = :id");
            return $stmt->execute([':id' => $id]);
        } catch (Exception $e) {
            error_log('Scope delete Error: ' . $e->getMessage());
            return false;
        }
    }

    public function parseTags($jsonString)
    {
        if (empty($jsonString) || is_null($jsonString)) return [];
        if (is_array($jsonString)) return $jsonString;
        $decoded = json_decode($jsonString, true);
        if (json_last_error() !== JSON_ERROR_NONE || !is_array($decoded)) return [];
        return $decoded;
    }
}
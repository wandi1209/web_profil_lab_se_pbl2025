<?php

namespace Polinema\WebProfilLabSe\Models;

use Polinema\WebProfilLabSe\Core\Database;
use PDO;
use Exception;

class Pendaftar
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Create pendaftar baru (dari landing page)
     */
    public function create($nama, $nim, $kelas, $prodi, $alasan, $email, $no_hp)
    {
        try {
            $query = "INSERT INTO pendaftar (nama, nim, kelas, program_studi, alasan, email, no_hp, status, created_at) 
                      VALUES (:nama, :nim, :kelas, :prodi, :alasan, :email, :hp, 'Pending', CURRENT_TIMESTAMP)";
            
            $stmt = $this->db->prepare($query);
            return $stmt->execute([
                ':nama'   => $nama,
                ':nim'    => $nim,
                ':kelas'  => $kelas,
                ':prodi'  => $prodi,
                ':alasan' => $alasan,
                ':email'  => $email,
                ':hp'     => $no_hp
            ]);
        } catch (Exception $e) {
            error_log('Pendaftar create Error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Get all pendaftar
     */
    public function getAll()
    {
        try {
            $stmt = $this->db->query("SELECT * FROM pendaftar ORDER BY created_at DESC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log('Pendaftar getAll Error: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Get pendaftar by ID
     */
    public function getById($id)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM pendaftar WHERE id = :id LIMIT 1");
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log('Pendaftar getById Error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Update status pendaftar (Admin only)
     */
    public function updateStatus($id, $status, $catatan = null)
    {
        try {
            $query = "UPDATE pendaftar 
                      SET status = :status, 
                          catatan = :catatan,
                          updated_at = CURRENT_TIMESTAMP 
                      WHERE id = :id";
                      
            $stmt = $this->db->prepare($query);
            return $stmt->execute([
                ':id'      => $id, 
                ':status'  => $status,
                ':catatan' => $catatan
            ]);
        } catch (Exception $e) {
            error_log('Pendaftar updateStatus Error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Delete pendaftar
     */
    public function delete($id)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM pendaftar WHERE id = :id");
            return $stmt->execute([':id' => $id]);
        } catch (Exception $e) {
            error_log('Pendaftar delete Error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Get statistics by status
     */
    public function getStatistics()
    {
        try {
            $stmt = $this->db->query("
                SELECT 
                    COUNT(*) as total,
                    SUM(CASE WHEN status = 'Pending' THEN 1 ELSE 0 END) as pending,
                    SUM(CASE WHEN status = 'Diterima' THEN 1 ELSE 0 END) as diterima,
                    SUM(CASE WHEN status = 'Ditolak' THEN 1 ELSE 0 END) as ditolak
                FROM pendaftar
            ");
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log('Pendaftar getStatistics Error: ' . $e->getMessage());
            return [
                'total' => 0,
                'pending' => 0,
                'diterima' => 0,
                'ditolak' => 0
            ];
        }
    }

    /**
     * Search pendaftar
     */
    public function search($keyword)
    {
        try {
            $stmt = $this->db->prepare("
                SELECT * FROM pendaftar 
                WHERE nama ILIKE :keyword 
                   OR nim ILIKE :keyword 
                   OR email ILIKE :keyword 
                   OR program_studi ILIKE :keyword
                ORDER BY created_at DESC
            ");
            $stmt->execute([':keyword' => '%' . $keyword . '%']);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log('Pendaftar search Error: ' . $e->getMessage());
            return [];
        }
    }
}
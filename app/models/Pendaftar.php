<?php

namespace Polinema\WebProfilLabSe\Models;

use Polinema\WebProfilLabSe\Core\Database;
use PDO;
use Exception;

class Pendaftar
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Create pendaftar baru (dari landing page)
     */
    public function create(array $data): bool
    {
        try {
            $sql = "
                INSERT INTO pendaftar 
                    (nama, email, no_hp, nim, angkatan, program_studi, peminatan, keahlian, portofolio_url, alasan, status, created_at, updated_at)
                VALUES 
                    (:nama, :email, :no_hp, :nim, :angkatan, :program_studi, :peminatan, :keahlian, :portofolio_url, :alasan, 'Pending', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
            ";
            $stmt = $this->db->prepare($sql);
            $ok = $stmt->execute([
                ':nama'           => $data['nama'],
                ':email'          => $data['email'],
                ':no_hp'          => $data['no_hp'] ?? null,
                ':nim'            => $data['nim'],
                ':angkatan'       => $data['angkatan'],
                ':program_studi'  => $data['program_studi'],
                ':peminatan'      => $data['peminatan'],
                ':keahlian'       => $data['keahlian'],
                ':portofolio_url' => $data['portofolio_url'] ?? null,
                ':alasan'         => $data['alasan'],
            ]);
            if (!$ok) {
                $err = $stmt->errorInfo(); throw new Exception($err[2] ?? 'DB insert failed');
            }
            return true;
        } catch (Exception $e) {
            error_log('Pendaftar create Error: ' . $e->getMessage());
            $_SESSION['error'] = 'DB Error: ' . $e->getMessage();
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
    public function updateStatus(int $id, string $status, ?string $catatan = null): bool
    {
        try {
            $statusNorm = ucfirst(strtolower($status)); // Pending/Diterima/Ditolak

            // Update status + catatan (catatan boleh kosong)
            $stmt = $this->db->prepare("
                UPDATE pendaftar
                   SET status = :status,
                       catatan = :catatan,
                       updated_at = CURRENT_TIMESTAMP
                 WHERE id = :id
            ");
            $ok = $stmt->execute([
                ':id'      => $id,
                ':status'  => $statusNorm,
                ':catatan' => $catatan
            ]);
            if (!$ok) {
                $err = $stmt->errorInfo();
                throw new Exception($err[2] ?? 'Gagal UPDATE pendaftar');
            }

            // Hanya panggil prosedur saat status baru adalah Diterima
            if ($statusNorm === 'Diterima') {
                // Jika PostgreSQL < 11, ubah ke SELECT approve_mahasiswa_fn(:pid)
                $proc = $this->db->prepare("CALL approve_mahasiswa(:pid)");
                if (!$proc->execute([':pid' => $id])) {
                    $err = $proc->errorInfo();
                    throw new Exception($err[2] ?? 'Gagal CALL approve_mahasiswa');
                }
            }

            return true;
        } catch (Exception $e) {
            error_log('Pendaftar updateStatus Error: ' . $e->getMessage());
            if (session_status() === PHP_SESSION_ACTIVE) {
                $_SESSION['error'] = 'DB Error: ' . $e->getMessage();
            }
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

    /**
     * Find pendaftar by ID
     */
    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare("
            SELECT id, nama, email, no_hp, nim, angkatan, program_studi,
                   peminatan, keahlian, portofolio_url, alasan, status,
                   catatan, created_at, updated_at
            FROM pendaftar
            WHERE id = :id
            LIMIT 1
        ");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    /**
     * Find pendaftar by Nim
     */
    public function findByNim(string $nim): ?array
    {
        $stmt = $this->db->prepare("
            SELECT id, nama, email, no_hp, nim, angkatan, program_studi,
                peminatan, keahlian, portofolio_url, alasan, status,
                created_at, updated_at
            FROM pendaftar
            WHERE nim = :nim
            LIMIT 1
        ");

        $stmt->execute([':nim' => $nim]);
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    public function findByEmail($email)
    {
        $stmt = $this->db->prepare("
            SELECT id, nama, email, no_hp, nim, angkatan, program_studi,
                peminatan, keahlian, portofolio_url, alasan, status,
                created_at, updated_at
            FROM pendaftar
            WHERE email = :email
            LIMIT 1
        ");

        $stmt->execute([':email' => $email]);
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    public function findByNoHp($noHp)
    {
        $stmt = $this->db->prepare("
            SELECT id, nama, email, no_hp, nim, angkatan, program_studi,
                peminatan, keahlian, portofolio_url, alasan, status,
                created_at, updated_at
            FROM pendaftar
            WHERE no_hp = :no_hp
            LIMIT 1
        ");

        $stmt->execute([':no_hp' => $noHp]);
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }
}
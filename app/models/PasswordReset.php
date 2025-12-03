<?php

namespace Polinema\WebProfilLabSe\Models;

use Polinema\WebProfilLabSe\Core\Database;
use PDO;

class PasswordReset
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    // 1. User membuat request
    public function createRequest($username)
    {
        // Cek user ada atau tidak
        $stmt = $this->db->prepare('SELECT id FROM "users" WHERE username = :username');
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return false; // User tidak ditemukan
        }

        // Cek apakah sudah ada request pending
        $stmt = $this->db->prepare("SELECT id FROM password_reset_requests WHERE user_id = :uid AND status = 'pending'");
        $stmt->execute([':uid' => $user['id']]);
        if ($stmt->fetch()) {
            return true; // Anggap sukses agar tidak spam, padahal sudah ada request
        }

        // Buat request baru
        $query = "INSERT INTO password_reset_requests (user_id, status) VALUES (:uid, 'pending')";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([':uid' => $user['id']]);
    }

    // 2. Super Admin melihat semua request pending
    public function getAllPending()
    {
        $query = "SELECT r.*, u.username, ro.name as role_name
                  FROM password_reset_requests r
                  JOIN users u ON r.user_id = u.id
                  LEFT JOIN role ro ON u.role_id = ro.id
                  WHERE r.status = 'pending'
                  ORDER BY r.created_at DESC";
        
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 3. Super Admin menyetujui dan mereset password
    public function approveReset($requestId, $newPassword)
    {
        try {
            $this->db->beginTransaction();

            // Ambil user_id dari request
            $stmt = $this->db->prepare("SELECT user_id FROM password_reset_requests WHERE id = :id");
            $stmt->execute([':id' => $requestId]);
            $request = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$request) {
                $this->db->rollBack();
                return false;
            }

            // Update password user
            $newHash = password_hash($newPassword, PASSWORD_DEFAULT);
            $updateUser = $this->db->prepare('UPDATE "users" SET password_hash = :pass WHERE id = :uid');
            $updateUser->execute([
                ':pass' => $newHash,
                ':uid' => $request['user_id']
            ]);

            // Update status request jadi completed
            $updateReq = $this->db->prepare("UPDATE password_reset_requests SET status = 'completed', updated_at = CURRENT_TIMESTAMP WHERE id = :id");
            $updateReq->execute([':id' => $requestId]);

            $this->db->commit();
            return true;

        } catch (\Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }

    // 4. Reject request
    public function rejectRequest($requestId)
    {
        $stmt = $this->db->prepare("UPDATE password_reset_requests SET status = 'rejected', updated_at = CURRENT_TIMESTAMP WHERE id = :id");
        return $stmt->execute([':id' => $requestId]);
    }
}
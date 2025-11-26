<?php

namespace Polinema\WebProfilLabSe\Models;

use Polinema\WebProfilLabSe\Core\Database;
use PDO;

class Session
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    /*CREATE SESSION*/
    public function create($userId, $token, $expiresAt)
    {
        $query = "INSERT INTO session (user_id, access_token, created_at, expires_at)
                  VALUES (:uid, :token, NOW(), :exp)";

        $stmt = $this->db->prepare($query);

        return $stmt->execute([
            ':uid'   => $userId,
            ':token' => $token,
            ':exp'   => $expiresAt
        ]);
    }


    /*UPDATE SESSION bisa update token atau expired*/
    public function update($id, $newToken = null, $newExpires = null)
    {
        // buat dinamis query
        $parts = [];
        $params = [':id' => $id];

        if ($newToken !== null) {
            $parts[] = "access_token = :token";
            $params[':token'] = $newToken;
        }

        if ($newExpires !== null) {
            $parts[] = "expires_at = :exp";
            $params[':exp'] = $newExpires;
        }

        if (empty($parts)) {
            return false; // tidak ada yang di-update
        }

        $query = "UPDATE session SET " . implode(', ', $parts) . " WHERE id = :id";
        $stmt = $this->db->prepare($query);

        return $stmt->execute($params);
    }

    /*DELETE SESSION BY ID*/
    public function delete($id)
    {
        $query = "DELETE FROM session WHERE id = :id";
        $stmt = $this->db->prepare($query);

        return $stmt->execute([':id' => $id]);
    }

    /*DELETE SESSION BY USER ID saat user logout -> hapus semua session user*/
    public function deleteByUserId($userId)
    {
        $query = "DELETE FROM session WHERE user_id = :uid";
        $stmt = $this->db->prepare($query);

        return $stmt->execute([':uid' => $userId]);
    }
}
?>
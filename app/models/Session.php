<?php

namespace Polinema\WebProfilLabSe\Models;

use Polinema\WebProfilLabSe\Core\Database;

class Session
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function createSession($userId, $token, $expires)
    {
        $query = "INSERT INTO session (user_id, acces_token, created_at, expires_at)
                  VALUES (:uid, :token, NOW(), :exp)";
        $stmt = $this->db->prepare($query);

        return $stmt->execute([
            ':uid' => $userId,
            ':token' => $token,
            ':exp' => $expires
        ]);
    }
}

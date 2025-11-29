<?php

namespace Polinema\WebProfilLabSe\Models;

use Polinema\WebProfilLabSe\Core\Database;
use PDO;

class User
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll()
    {
        // Join dengan tabel role untuk menampilkan nama role
        $query = 'SELECT u.*, r.name as role_name 
                  FROM "user" u 
                  LEFT JOIN role r ON u.role_id = r.id';
        
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Untuk keperluan Login
    public function findByUsername($username)
    {
        $stmt = $this->db->prepare('SELECT * FROM "user" WHERE username = :username');
        $stmt->execute([':username' => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($username, $password, $role_id)
    {
        // Password wajib di-hash sebelum masuk database!
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $query = 'INSERT INTO "user" (username, password_hash, role_id) 
                  VALUES (:username, :pass, :role)';
        
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':username' => $username,
            ':pass'     => $passwordHash,
            ':role'     => $role_id
        ]);
    }

    public function update($id, $username, $role_id, $password = null)
    {
        if ($password) {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $query = 'UPDATE "user" SET username = :username, password_hash = :pass, role_id = :role WHERE id = :id';
            $params = [':id' => $id, ':username' => $username, ':pass' => $passwordHash, ':role' => $role_id];
        } else {
            $query = 'UPDATE "user" SET username = :username, role_id = :role WHERE id = :id';
            $params = [':id' => $id, ':username' => $username, ':role' => $role_id];
        }

        $stmt = $this->db->prepare($query);
        return $stmt->execute($params);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare('DELETE FROM "user" WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }
}
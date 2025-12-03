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

    // Ambil user login
    public function findByUsername($username)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute([':username' => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // --- CRUD METHODS ---

    // 1. Get All Users (Hapus created_at dan nama_lengkap dari query)
    public function getAllWithRoles()
    {
        $query = "SELECT u.id, u.username, u.role_id, r.name as role_name 
                  FROM users u 
                  LEFT JOIN role r ON u.role_id = r.id 
                  ORDER BY u.id ASC";
        return $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    // 2. Get User by ID
    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 3. Get All Roles
    public function getRoles()
    {
        return $this->db->query("SELECT * FROM role ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC);
    }

    // 4. Create User (Hapus nama_lengkap)
    public function create($data)
    {
        $hash = password_hash($data['password'], PASSWORD_DEFAULT);
        
        $query = "INSERT INTO users (username, password_hash, role_id) 
                  VALUES (:username, :password, :role)";
        
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':username' => $data['username'],
            ':password' => $hash,
            ':role'     => $data['role_id']
        ]);
    }

    // 5. Update User (Hapus nama_lengkap)
    public function update($id, $data)
    {
        if (!empty($data['password'])) {
            $hash = password_hash($data['password'], PASSWORD_DEFAULT);
            $query = "UPDATE users SET username = :username, role_id = :role, password_hash = :pass WHERE id = :id";
            $params = [
                ':username' => $data['username'],
                ':role'     => $data['role_id'],
                ':pass'     => $hash,
                ':id'       => $id
            ];
        } else {
            $query = "UPDATE users SET username = :username, role_id = :role WHERE id = :id";
            $params = [
                ':username' => $data['username'],
                ':role'     => $data['role_id'],
                ':id'       => $id
            ];
        }

        $stmt = $this->db->prepare($query);
        return $stmt->execute($params);
    }

    // 6. Delete User
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
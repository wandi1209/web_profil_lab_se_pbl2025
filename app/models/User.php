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

    /*FIND USER BY USERNAME*/
    public function findByUsername($username)
    {
        $query = "SELECT * FROM users WHERE username = :username LIMIT 1";
        $stmt = $this->db->prepare($query);

        $stmt->execute([
            ':username' => $username
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /*CHECK LOGIN*/
    public function checkLogin($username, $password)
    {
        $user = $this->findByUsername($username);

        if (!$user) {
            return false;
        }

        if (!password_verify($password, $user['password_hash'])) {
            return false;
        }

        return $user;
    }

    /*CREATE USER username, password_hash, role_id*/
    public function create($username, $password, $roleId)
    {
        $query = "INSERT INTO users (username, password_hash, role_id)
                  VALUES (:username, :password_hash, :role_id)";
        $stmt = $this->db->prepare($query);

        return $stmt->execute([
            ':username'      => $username,
            ':password_hash' => password_hash($password, PASSWORD_DEFAULT),
            ':role_id'       => $roleId
        ]);
    }

    /*UPDATE USER Bisa update username, password (opsional), role_id*/
    public function update($id, $username, $password = null, $roleId)
    {
        // Jika password tidak diubah
        if ($password === null) {
            $query = "UPDATE users
                      SET username = :username,
                          role_id = :role_id
                      WHERE id = :id";
            $stmt = $this->db->prepare($query);

            return $stmt->execute([
                ':id'       => $id,
                ':username' => $username,
                ':role_id'  => $roleId
            ]);
        }

        // Jika password diubah
        $query = "UPDATE users
                  SET username = :username,
                      password_hash = :password_hash,
                      role_id = :role_id
                  WHERE id = :id";

        $stmt = $this->db->prepare($query);

        return $stmt->execute([
            ':id'           => $id,
            ':username'     => $username,
            ':password_hash'=> password_hash($password, PASSWORD_DEFAULT),
            ':role_id'      => $roleId
        ]);
    }

    /*
       DELETE USER */
    public function delete($id)
    {
        $query = "DELETE FROM users WHERE id = :id";
        $stmt = $this->db->prepare($query);

        return $stmt->execute([
            ':id' => $id
        ]);
    }

    /*FIND BY ID (jika dibutuhkan CRUD)*/
    public function findById($id)
    {
        $query = "SELECT * FROM users WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($query);

        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
<?php

namespace Polinema\WebProfilLabSe\Models;

use Polinema\WebProfilLabSe\Core\Database;
use PDO;

class Role
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    /*CREATE ROLE*/
    public function create($name)
    {
        $query = "INSERT INTO role (name) VALUES (:name)";
        $stmt = $this->db->prepare($query);

        return $stmt->execute([
            ':name' => $name
        ]);
    }

    /*UPDATE ROLE*/
    public function update($id, $name)
    {
        $query = "UPDATE role SET name = :name WHERE id = :id";
        $stmt = $this->db->prepare($query);

        return $stmt->execute([
            ':id'   => $id,
            ':name' => $name
        ]);
    }

    /*DELETE ROLE*/
    public function delete($id)
    {
        $query = "DELETE FROM role WHERE id = :id";
        $stmt = $this->db->prepare($query);

        return $stmt->execute([
            ':id' => $id
        ]);
    }
}
?>
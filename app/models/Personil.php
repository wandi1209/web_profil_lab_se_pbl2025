<?php

namespace Polinema\WebProfilLabSe\Models;

use Polinema\WebProfilLabSe\Core\Database;
use PDO;

class Personil
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM personil");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($nama, $position, $email, $foto_url)
    {
        $query = "INSERT INTO personil (nama, position, email, foto_url) 
                  VALUES (:nama, :position, :email, :foto)";
        
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':nama'     => $nama,
            ':position' => $position,
            ':email'    => $email,
            ':foto'     => $foto_url
        ]);
    }

    public function update($id, $nama, $position, $email, $foto_url)
    {
        $query = "UPDATE personil SET nama = :nama, position = :position, email = :email";
        $params = [':id' => $id, ':nama' => $nama, ':position' => $position, ':email' => $email];

        if ($foto_url) {
            $query .= ", foto_url = :foto";
            $params[':foto'] = $foto_url;
        }

        $query .= " WHERE id = :id";

        $stmt = $this->db->prepare($query);
        return $stmt->execute($params);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM personil WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
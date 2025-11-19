<?php

namespace Polinema\WebProfilLabSe\Models;

use Polinema\WebProfilLabSe\Core\Database;

class PersonilRiset
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getByPersonil($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM PersonilRiset WHERE personil_id = :id");
        $stmt->execute([':id' => $id]);

        return $stmt->fetchAll();
    }
}

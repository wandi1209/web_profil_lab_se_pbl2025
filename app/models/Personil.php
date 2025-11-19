<?php

namespace Polinema\WebProfilLabSe\Models;

use Polinema\WebProfilLabSe\Core\Database;

class Personil
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getByLab($labId)
    {
        $stmt = $this->db->prepare("SELECT * FROM personil WHERE lab_profile_id = :id");
        $stmt->execute([':id' => $labId]);
        return $stmt->fetchAll();
    }
}

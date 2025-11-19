<?php

namespace Polinema\WebProfilLabSe\Models;

use Polinema\WebProfilLabSe\Core\Database;

class Roadmap
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getByLab($labId)
    {
        $stmt = $this->db->prepare("SELECT * FROM roadmap WHERE lab_profile_id = :id ORDER BY urutan ASC");
        $stmt->execute([':id' => $labId]);

        return $stmt->fetchAll();
    }
}

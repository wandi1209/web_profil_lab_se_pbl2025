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

    public function getAll()
    {
        return $this->db->query("SELECT * FROM role")->fetchAll();
    }
}

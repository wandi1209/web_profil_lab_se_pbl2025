<?php

namespace Polinema\WebProfilLabSe\Models;

use Polinema\WebProfilLabSe\Core\Database;

class Profile
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll()
    {
        return $this->db->query("SELECT * FROM profile")->fetchAll();
    }
}


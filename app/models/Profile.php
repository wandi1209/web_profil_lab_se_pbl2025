<?php

namespace Polinema\WebProfilLabSe\Models;

use Polinema\WebProfilLabSe\Core\Database;
use PDO;

class Profile
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * CREATE PROFILE
     * Sesuai ERD: kolom title, text, section_key
     */
    public function create($title, $text, $section_key)
    {
        $query = "INSERT INTO profile (title, text, section_key) 
                  VALUES (:title, :text, :section_key)";

        $stmt = $this->db->prepare($query);

        return $stmt->execute([
            ':title'       => $title,
            ':text'        => $text,
            ':section_key' => $section_key
        ]);
    }

    /**
     * UPDATE PROFILE
     * Logika gambar dihapus karena tidak ada kolom gambar di tabel profile ERD
     */
    public function update($id, $title, $text, $section_key)
    {
        $query = "UPDATE profile 
                  SET title = :title, 
                      text = :text, 
                      section_key = :section_key 
                  WHERE id = :id";

        $stmt = $this->db->prepare($query);

        return $stmt->execute([
            ':id'          => $id,
            ':title'       => $title,
            ':text'        => $text,
            ':section_key' => $section_key
        ]);
    }

    /**
     * DELETE PROFILE
     */
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM profile WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    /**
     * GET ALL PROFILES (Tambahan agar bisa menampilkan data)
     */
    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM profile");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * GET BY ID (Tambahan untuk edit)
     */
    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM profile WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
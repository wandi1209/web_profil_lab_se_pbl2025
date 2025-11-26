<?php

namespace Polinema\WebProfilLabSe\Models;

use Polinema\WebProfilLabSe\Core\Database;
use PDO;

class Album
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    // Tambah album baru
    public function create($title, $gambarUrl, $tautanUrl, $aktif, $slider)
    {
        $stmt = $this->db->prepare("
            INSERT INTO album (title, gambar_url, tautan_url, aktif, slider)
            VALUES (:title, :gambar_url, :tautan_url, :aktif, :slider)
        ");

        return $stmt->execute([
            'title'       => $title,
            'gambar_url'  => $gambarUrl,
            'tautan_url'  => $tautanUrl,
            'aktif'       => $aktif,
            'slider'      => $slider
        ]);
    }

    // Update album
    public function update($id, $title, $gambarUrl, $tautanUrl, $aktif, $slider)
    {
        $stmt = $this->db->prepare("
            UPDATE album
            SET title = :title,
                gambar_url = :gambar_url,
                tautan_url = :tautan_url,
                aktif = :aktif,
                slider = :slider
            WHERE id = :id
        ");

        return $stmt->execute([
            'title'       => $title,
            'gambar_url'  => $gambarUrl,
            'tautan_url'  => $tautanUrl,
            'aktif'       => $aktif,
            'slider'      => $slider,
            'id'          => $id
        ]);
    }

    // Hapus album
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM album WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>
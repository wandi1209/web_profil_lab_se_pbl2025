<?php

namespace Polinema\WebProfilLabSe\Models;

use Polinema\WebProfilLabSe\Core\Database;
use PDO;

class Publikasi
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }


    /*CREATE PUBLIKASI*/
    public function create($labProfileId, $judul, $penulis, $tahun, $url)
    {
        $query = "
            INSERT INTO publikasi (lab_profile_id, judul, penulis, tahun, url)
            VALUES (:lab, :judul, :penulis, :tahun, :url)
        ";

        $stmt = $this->db->prepare($query);

        return $stmt->execute([
            ':lab'     => $labProfileId,
            ':judul'   => $judul,
            ':penulis' => $penulis,
            ':tahun'   => $tahun,
            ':url'     => $url
        ]);
    }

    /*UPDATE PUBLIKASI*/
    public function update($id, $judul, $penulis, $tahun, $url)
    {
        $query = "
            UPDATE publikasi
            SET judul   = :judul,
                penulis = :penulis,
                tahun   = :tahun,
                url     = :url
            WHERE id = :id
        ";

        $stmt = $this->db->prepare($query);

        return $stmt->execute([
            ':id'      => $id,
            ':judul'   => $judul,
            ':penulis' => $penulis,
            ':tahun'   => $tahun,
            ':url'     => $url
        ]);
    }

    /*DELETE PUBLIKASI*/
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM publikasi WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
?>
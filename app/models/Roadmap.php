<?php

namespace Polinema\WebProfilLabSe\Models;

use Polinema\WebProfilLabSe\Core\Database;
use PDO;

class Roadmap
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    /*CREATE ROADMAP*/
    public function create($labProfileId, $judul, $deskripsi, $tahun, $urutan)
    {
        $query = "
            INSERT INTO roadmap (lab_profile_id, judul, deskripsi, tahun, urutan)
            VALUES (:lab, :judul, :deskripsi, :tahun, :urutan)
        ";

        $stmt = $this->db->prepare($query);

        return $stmt->execute([
            ':lab'      => $labProfileId,
            ':judul'    => $judul,
            ':deskripsi'=> $deskripsi,
            ':tahun'    => $tahun,
            ':urutan'   => $urutan
        ]);
    }

    /*UPDATE ROADMAP*/
    public function update($id, $judul, $deskripsi, $tahun, $urutan)
    {
        $query = "
            UPDATE roadmap
            SET judul = :judul,
                deskripsi = :deskripsi,
                tahun = :tahun,
                urutan = :urutan
            WHERE id = :id
        ";

        $stmt = $this->db->prepare($query);

        return $stmt->execute([
            ':id'        => $id,
            ':judul'     => $judul,
            ':deskripsi' => $deskripsi,
            ':tahun'     => $tahun,
            ':urutan'    => $urutan
        ]);
    }

    /*DELETE ROADMAP*/
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM roadmap WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
?>
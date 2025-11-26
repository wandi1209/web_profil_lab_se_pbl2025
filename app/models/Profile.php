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

    /*CREATE PROFILE*/
    public function create($labProfileId, $visi, $misi, $deskripsi, $gambar = null)
    {
        $query = "
            INSERT INTO profile (lab_profile_id, visi, misi, deskripsi, gambar)
            VALUES (:lab, :visi, :misi, :desk, :gambar)
        ";

        $stmt = $this->db->prepare($query);

        return $stmt->execute([
            ':lab'    => $labProfileId,
            ':visi'   => $visi,
            ':misi'   => $misi,
            ':desk'   => $deskripsi,
            ':gambar' => $gambar
        ]);
    }

    /*UPDATE PROFILE*/
    public function update($id, $visi, $misi, $deskripsi, $gambar = null)
    {
        // Jika gambar tidak diubah, tidak perlu update field gambar
        if ($gambar === null) {
            $query = "
                UPDATE profile
                SET visi = :visi,
                    misi = :misi,
                    deskripsi = :desk
                WHERE id = :id
            ";

            $params = [
                ':id'   => $id,
                ':visi' => $visi,
                ':misi' => $misi,
                ':desk' => $deskripsi,
            ];
        } else {
            $query = "
                UPDATE profile
                SET visi = :visi,
                    misi = :misi,
                    deskripsi = :desk,
                    gambar = :gambar
                WHERE id = :id
            ";

            $params = [
                ':id'     => $id,
                ':visi'   => $visi,
                ':misi'   => $misi,
                ':desk'   => $deskripsi,
                ':gambar' => $gambar,
            ];
        }

        $stmt = $this->db->prepare($query);
        return $stmt->execute($params);
    }

    /*DELETE PROFILE*/
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM profile WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
?>
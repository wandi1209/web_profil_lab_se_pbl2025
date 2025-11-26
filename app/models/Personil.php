<?php

namespace Polinema\WebProfilLabSe\Models;

use Polinema\WebProfilLabSe\Core\Database;
use PDO;
use Exception;

class Personil
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    /*Tambah personil baru*/
    public function create($nama, $position, $email, $fotoUrl)
    {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO personil (nama, position, email, foto_url)
                VALUES (:nama, :position, :email, :foto)
            ");

            return $stmt->execute([
                ':nama'     => $nama,
                ':position' => $position,
                ':email'    => $email,
                ':foto'     => $fotoUrl
            ]);

        } catch (Exception $e) {
            return false;
        }
    }

    /*Update personil*/
    public function update($id, $nama, $position, $email, $fotoUrl = null)
    {
        try {
            if ($fotoUrl !== null) {
                $query = "
                    UPDATE personil
                    SET nama = :nama,
                        position = :position,
                        email = :email,
                        foto_url = :foto
                    WHERE id = :id
                ";

                $params = [
                    ':nama'     => $nama,
                    ':position' => $position,
                    ':email'    => $email,
                    ':foto'     => $fotoUrl,
                    ':id'       => $id
                ];

            } else {
                $query = "
                    UPDATE personil
                    SET nama = :nama,
                        position = :position,
                        email = :email
                    WHERE id = :id
                ";

                $params = [
                    ':nama'     => $nama,
                    ':position' => $position,
                    ':email'    => $email,
                    ':id'       => $id
                ];
            }

            $stmt = $this->db->prepare($query);
            return $stmt->execute($params);

        } catch (Exception $e) {
            return false;
        }
    }

    /*Delete personil*/
    public function delete($id)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM personil WHERE id = :id");
            return $stmt->execute([':id' => $id]);

        } catch (Exception $e) {
            return false;
        }
    }
}
?>
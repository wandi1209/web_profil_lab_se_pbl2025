<?php

namespace Polinema\WebProfilLabSe\Models;

use Polinema\WebProfilLabSe\Core\Database;
use PDO;

class Pendaftar
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($nama, $nim, $kelas, $prodi, $alasan, $email, $no_hp)
    {
        $query = "INSERT INTO pendaftar (nama, nim, kelas, program_studi, alasan, email, no_hp, status, created_at) 
                  VALUES (:nama, :nim, :kelas, :prodi, :alasan, :email, :hp, 'Pending', NOW())";
        
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':nama'   => $nama,
            ':nim'    => $nim,
            ':kelas'  => $kelas,
            ':prodi'  => $prodi,
            ':alasan' => $alasan,
            ':email'  => $email,
            ':hp'     => $no_hp
        ]);
    }

    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM pendaftar ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Update Status (misal: diterima/ditolak)
    public function updateStatus($id, $status)
    {
        $stmt = $this->db->prepare("UPDATE pendaftar SET status = :status WHERE id = :id");
        return $stmt->execute([':id' => $id, ':status' => $status]);
    }
}
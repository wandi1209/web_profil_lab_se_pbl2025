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

    // Tambah pendaftar baru
    public function create($data)
    {
        $query = "INSERT INTO pendaftar 
            (nama, nim, kelas, program_studi, alasan, created_at, email, no_hp, status) 
            VALUES 
            (:nama, :nim, :kelas, :program_studi, :alasan, NOW(), :email, :no_hp, :status)";

        $stmt = $this->db->prepare($query);

        return $stmt->execute([
            'nama'          => $data['nama'],
            'nim'           => $data['nim'],
            'kelas'         => $data['kelas'],
            'program_studi' => $data['program_studi'],
            'alasan'        => $data['alasan'],
            'email'         => $data['email'],
            'no_hp'         => $data['no_hp'],
            'status'        => $data['status'] ?? 'pending'
        ]);
    }

    // Update data pendaftar
    public function update($id, $data)
    {
        $query = "UPDATE pendaftar SET 
            nama = :nama,
            nim = :nim,
            kelas = :kelas,
            program_studi = :program_studi,
            alasan = :alasan,
            email = :email,
            no_hp = :no_hp,
            status = :status
        WHERE id = :id";

        $stmt = $this->db->prepare($query);

        return $stmt->execute([
            'nama'          => $data['nama'],
            'nim'           => $data['nim'],
            'kelas'         => $data['kelas'],
            'program_studi' => $data['program_studi'],
            'alasan'        => $data['alasan'],
            'email'         => $data['email'],
            'no_hp'         => $data['no_hp'],
            'status'        => $data['status'],
            'id'            => $id
        ]);
    }

    // Hapus pendaftar
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM pendaftar WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>
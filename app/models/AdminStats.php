<?php

namespace Polinema\WebProfilLabSe\Models;

use Polinema\WebProfilLabSe\Core\Database;
use PDO;

class AdminStats
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getSummary(): array
    {
        $stmt = $this->db->query("SELECT * FROM mv_admin_stats LIMIT 1");
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: [
            'total_pendaftar' => 0,
            'pending_count'   => 0,
            'diterima_count'  => 0,
            'ditolak_count'   => 0,
            'total_personil'  => 0,
            'dosen_count'     => 0,
            'mhs_count'       => 0,
            'lainnya_count'   => 0,
        ];
    }

    public function getPendaftarPerTahun(): array
    {
        $stmt = $this->db->query("
            SELECT angkatan AS tahun, COUNT(*) AS jumlah
            FROM pendaftar
            WHERE angkatan IS NOT NULL
            GROUP BY angkatan
            ORDER BY angkatan DESC
            LIMIT 5
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }

    public function refresh(): bool
    {
        // Note: CONCURRENTLY butuh MV punya index unik; gunakan non-concurrent jika belum
        $this->db->exec("REFRESH MATERIALIZED VIEW mv_admin_stats");
        return true;
    }
}
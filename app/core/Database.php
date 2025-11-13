<?php
namespace Polinema\WebProfilLabSe\Core;

// Gunakan class PDO bawaan PHP
use PDO;
use PDOException;

class Database {
    // Properti untuk menyimpan instance (Singleton)
    private static $instance = null;
    
    private $conn;

    // Ambil konfigurasi dari file .env
    private $host;
    private $user;
    private $pass;
    private $name;
    private $port;

    // Constructor dibuat private agar tidak bisa di-instance dari luar
    private function __construct() {
        $this->host = $_ENV['DB_HOST'];
        $this->user = $_ENV['DB_USER'];
        $this->pass = $_ENV['DB_PASS'];
        $this->name = $_ENV['DB_NAME'];
        $this->port = $_ENV['DB_PORT'] ?? '5432'; 

        $dsn = 'pgsql:host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->name;
        
        $options = [
            PDO::ATTR_PERSISTENT => true, // Koneksi persisten
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Tampilkan error sebagai exception
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Hasil default sebagai array asosiatif
        ];

        try {
            $this->conn = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            die('Koneksi Gagal: ' . $e->getMessage());
        }
    }

    /**
     * Metode static untuk mendapatkan instance Database (Singleton)
     * @return Database Instance
     */
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    /**
     * Metode untuk mendapatkan koneksi PDO
     * @return PDO Koneksi
     */
    public function getConnection() {
        return $this->conn;
    }
}
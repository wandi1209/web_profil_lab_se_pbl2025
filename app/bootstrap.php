<?php
// Memuat Autoloader Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Memuat Variabel Lingkungan (.env)
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

?>
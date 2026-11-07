<?php
// Memuat Autoloader Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Memuat Variabel Lingkungan (.env)
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();

// Trust HTTPS dari Cloudflare Tunnel / Reverse Proxy
if (
    (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') ||
    (!empty($_SERVER['HTTP_CF_VISITOR']) && strpos($_SERVER['HTTP_CF_VISITOR'], '"scheme":"https"') !== false)
) {
    $_SERVER['HTTPS'] = 'on';
    $_SERVER['SERVER_PORT'] = 443;
}

date_default_timezone_set('Asia/Jakarta');

?>
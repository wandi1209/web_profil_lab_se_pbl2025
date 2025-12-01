<?php

namespace Polinema\WebProfilLabSe\Middlewares;

class AuthMiddleware
{
    /**
     * Check apakah user sudah login
     */
    public static function handle()
    {
        // Start session jika belum
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Cek apakah user sudah login
        if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
            // Simpan URL yang ingin diakses untuk redirect setelah login
            $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
            
            // Redirect ke halaman login
            header('Location: ' . $_ENV['APP_URL'] . '/login');
            exit;
        }
    }

    /**
     * Check apakah user adalah admin (role_id = 1)
     */
    public static function isAdmin()
    {
        // Start session jika belum
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Cek apakah user sudah login
        if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
            // Simpan URL yang ingin diakses
            $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
            
            // Redirect ke halaman login
            header('Location: ' . $_ENV['APP_URL'] . '/login');
            exit;
        }

        // Cek role admin (role_id = 1 untuk admin)
        if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 1) {
            // Redirect ke home dengan pesan error
            header('Location: ' . $_ENV['APP_URL'] . '/?error=forbidden');
            exit;
        }
    }

    /**
     * Logout user
     */
    public static function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Hapus semua session
        session_unset();
        session_destroy();

        // Redirect ke login
        header('Location: ' . $_ENV['APP_URL'] . '/login');
        exit;
    }
}
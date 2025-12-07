<?php

namespace Polinema\WebProfilLabSe\Middlewares;

class AuthMiddleware
{
    /**
     * Pastikan session aktif
     */
    private static function ensureSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Cek apakah user sudah login (Role apapun)
     */
    public static function handle()
    {
        self::ensureSession();

        if (!isset($_SESSION['user_id'])) {
            $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
            header('Location: ' . $_ENV['APP_URL'] . '/login');
            exit;
        }
    }

    /**
     * Cek apakah user adalah ADMIN (Bisa Super Admin atau Admin Biasa)
     */
    public static function isAdmin()
    {
        self::handle(); // Pastikan login dulu

        $allowedRoles = [1, 2]; 

        if (!in_array($_SESSION['role_id'], $allowedRoles)) {
            // UBAH REDIRECT KE /admin (KONSISTEN DENGAN ROUTES)
            header('Location: ' . $_ENV['APP_URL'] . '/admin');
            exit;
        }
    }

    /**
     * Cek apakah user adalah SUPER ADMIN (Hanya Role ID 1)
     * Digunakan untuk Manajemen User dan Reset Password
     */
    public static function isSuperAdmin()
    {
        self::handle(); // Pastikan login dulu

        // HANYA Role 1 yang boleh lewat
        if ($_SESSION['role_id'] != 1) {
            // Jika Admin biasa mencoba akses, kembalikan ke dashboard dengan pesan error
            $_SESSION['error'] = "Akses Ditolak! Anda tidak memiliki izin Super Admin.";
            header('Location: ' . $_ENV['APP_URL'] . '/admin/dashboard');
            exit;
        }
    }

    /**
     * Logout user
     */
    public static function logout()
    {
        self::ensureSession();
        session_unset();
        session_destroy();
        header('Location: ' . $_ENV['APP_URL'] . '/login');
        exit;
    }
}
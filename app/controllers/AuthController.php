<?php

namespace Polinema\WebProfilLabSe\Controllers;

use Polinema\WebProfilLabSe\Core\Controller;
use Polinema\WebProfilLabSe\Models\User;
use Polinema\WebProfilLabSe\Models\PasswordReset; // Tambahkan ini di atas

class AuthController extends Controller {

    // 2. Menampilkan Halaman Login (GET)
    public function login() {
        // Pastikan session dimulai
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Jika sudah login, redirect ke dashboard
        if (isset($_SESSION['is_login']) && $_SESSION['is_login'] === true) {
            header('Location: ' . $_ENV['APP_URL'] . '/admin/dashboard');
            exit;
        }

        $this->view('pages/auth/login');
    }

    // 3. Memproses Login (POST)
    public function processLogin() {
        // Pastikan session dimulai
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Validasi request method
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . $_ENV['APP_URL'] . '/login');
            exit;
        }

        // Ambil input dari form
        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');

        // Validasi input tidak kosong
        if (empty($username) || empty($password)) {
            $_SESSION['error'] = "Username dan password tidak boleh kosong!";
            header('Location: ' . $_ENV['APP_URL'] . '/login');
            exit;
        }

        // Panggil Model
        $userModel = new User();
        $userData = $userModel->findByUsername($username);

        // Cek apakah user ditemukan dan password cocok
        if ($userData && password_verify($password, $userData['password_hash'])) {
            // --- LOGIN SUKSES ---
            
            // Regenerate session ID untuk keamanan
            session_regenerate_id(true);
            
            // Simpan data penting ke session
            $_SESSION['is_login'] = true;
            $_SESSION['user_id'] = $userData['id'];
            $_SESSION['role_id'] = $userData['role_id']; 
            $_SESSION['username'] = $userData['username'];

            // Set flash message success
            $_SESSION['success'] = "Login berhasil! Selamat datang, " . $userData['username'];

            // Redirect ke dashboard admin
            header('Location: ' . $_ENV['APP_URL'] . '/admin/dashboard');
            exit;
        } else {
            // --- LOGIN GAGAL ---
            
            // Set flash message error
            $_SESSION['error'] = "Username atau password salah!";
            
            // Kembalikan ke halaman login
            header('Location: ' . $_ENV['APP_URL'] . '/login');
            exit;
        }
    }
    
    // 4. Logout
    public function logout() {
        // Pastikan session dimulai
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Hapus semua data session
        $_SESSION = array();

        // Hapus cookie session jika ada
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 3600, '/');
        }

        // Destroy session
        session_destroy();

        // Redirect ke halaman login
        header('Location: ' . $_ENV['APP_URL'] . '/login');
        exit;
    }

    // 5. Halaman Lupa Password
    public function forgotPassword() {
        $this->view('pages/auth/forgot_password');
    }

    // 6. Proses Request Reset
    public function processForgotPassword() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . $_ENV['APP_URL'] . '/forgot-password');
            exit;
        }

        $username = trim($_POST['username'] ?? '');

        if (empty($username)) {
            $_SESSION['error'] = "Username harus diisi!";
            header('Location: ' . $_ENV['APP_URL'] . '/forgot-password');
            exit;
        }

        $resetModel = new PasswordReset();
        // Kita selalu bilang sukses demi keamanan (agar orang tidak bisa cek username valid/tidak)
        // Tapi logic di model akan cek user exist atau tidak
        $resetModel->createRequest($username);

        $_SESSION['success'] = "Permintaan reset password dikirim! Silakan hubungi Super Admin untuk persetujuan.";
        header('Location: ' . $_ENV['APP_URL'] . '/login');
        exit;
    }
}
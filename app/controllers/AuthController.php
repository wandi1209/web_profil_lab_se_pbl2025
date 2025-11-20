<?php

namespace Polinema\WebProfilLabSe\Controllers;

use Polinema\WebProfilLabSe\Core\Controller;
use Polinema\WebProfilLabSe\Models\User;

class AuthController extends Controller {

    // 2. Menampilkan Halaman Login (GET)
    public function login() {
        $this->view('pages/auth/login', false);
    }

    // 3. Memproses Login (POST)
    public function processLogin() {
        // Pastikan session dimulai
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Ambil input dari form
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // Panggil Model
        $userModel = new User();
        $userData = $userModel->checkLogin($username, $password);

        if ($userData) {
            // --- LOGIN SUKSES ---
            
            // Simpan data penting ke session
            $_SESSION['is_login'] = true;
            $_SESSION['user_id'] = $userData['id'];
            $_SESSION['role'] = $userData['role_id']; 
            $_SESSION['username'] = $userData['username'];

            // Redirect ke dashboard admin
            header('Location: /web_profil_lab_se/admin'); 
            exit;
        } else {
            // --- LOGIN GAGAL ---
            
            // Set flash message error (opsional, bisa pakai session juga)
            $_SESSION['error'] = "Username atau password salah!";
            
            // Kembalikan ke halaman login
            header('Location: /web_profil_lab_se/login');
            exit;
        }
    }
    
    public function logout() {
        session_start();
        session_destroy();
        header('Location: /web_profil_lab_se/login');
        exit;
    }
}
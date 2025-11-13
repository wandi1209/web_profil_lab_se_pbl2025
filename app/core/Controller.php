<?php
// Tentukan namespace
namespace Polinema\WebProfilLabSe\Core;

class Controller {

    /**
     * Helper untuk memuat View.
     * @param string $view Path ke file view (mis: 'pages/home')
     * @param array $data Data yang akan diekstrak untuk view
     */
    public function view($view, $data = []) {
        // Ekstrak $data menjadi variabel (mis: $data['title'] -> $title)
        extract($data);

        // Path ke file view
        $viewPath = __DIR__ . '/../views/' . $view . '.php';

        if (file_exists($viewPath)) {
            // Muat header
            require_once __DIR__ . '/../views/layouts/header.php';
            
            // Muat konten view
            require_once $viewPath;
            
            // Muat footer
            require_once __DIR__ . '/../views/layouts/footer.php';
        } else {
            // Jika file view tidak ada
            die("View tidak ditemukan: " . $viewPath);
        }
    }

    /**
     * Helper untuk memuat Model.
     * @param string $model Nama class Model (mis: 'User')
     * @return object Instance dari model
     */
    public function model($model) {
        // Tentukan namespace lengkap ke model
        $modelName = "Polinema\\WebProfilLabSe\\Models\\" . $model;
        
        if (class_exists($modelName)) {
            // Buat instance baru dari model
            return new $modelName();
        }
        return null;
    }
}
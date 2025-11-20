<?php
// Tentukan namespace
namespace Polinema\WebProfilLabSe\Core;

class Controller {

    /**
     * Helper untuk memuat View.
     * @param string $view Path ke file view (mis: 'pages/home')
     * @param array $data Data yang akan diekstrak untuk view
     * @param bool $useLayout Tentukan apakah akan menggunakan layout atau tidak
     * @param string $layoutType Tentukan jenis layout ('default' atau 'admin')
     */
    public function view($view, $data = [], $useLayout = false, $layoutType = 'default') {
        // Ekstrak data agar variabelnya tersedia langsung di dalam view
        extract($data); 

        $viewPath = __DIR__ . '/../views/' . $view . '.php';

        if (!file_exists($viewPath)) {
            die("View tidak ditemukan: " . $viewPath);
        }

        if ($useLayout) {
            $sidebarPath = null; // Inisialisasi

            // Tentukan path layout berdasarkan $layoutType
            if ($layoutType === 'admin') {
                $headerPath = __DIR__ . '/../views/layouts/admin/header.php';
                // Variabel yang benar: $sidebarPath
                $sidebarPath = __DIR__ . '/../views/layouts/admin/sidebar.php'; 
                $footerPath = __DIR__ . '/../views/layouts/admin/footer.php';
            } else { // layoutType default atau lainnya
                $headerPath = __DIR__ . '/../views/layouts/header.php';
                $footerPath = __DIR__ . '/../views/layouts/footer.php';
            }

            // Cek dan muat header
            if (!file_exists($headerPath)) {
                die("Layout Header tidak ditemukan: " . $headerPath);
            }
            require_once $headerPath;

            // Cek dan muat Sidebar (hanya untuk layout admin)
            if ($sidebarPath !== null) {
                 if (!file_exists($sidebarPath)) {
                    die("Layout Sidebar tidak ditemukan: " . $sidebarPath);
                }
                require_once $sidebarPath;
            }

            // Muat konten view
            require_once $viewPath;

            // Cek dan muat footer
            if (!file_exists($footerPath)) {
                die("Layout Footer tidak ditemukan: " . $footerPath);
            }
            require_once $footerPath;

        } else {
            // Muat view tanpa layout
            require_once $viewPath;
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
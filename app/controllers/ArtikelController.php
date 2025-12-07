<?php

namespace Polinema\WebProfilLabSe\Controllers;

use Polinema\WebProfilLabSe\Core\Controller;
use Polinema\WebProfilLabSe\Models\Article;

class ArtikelController extends Controller
{
    public function index()
    {
        // 1. Panggil Model
        $articleModel = new Article();
        
        // 2. Ambil semua artikel (terurut dari terbaru)
        // Kita ambil agak banyak, misal 10 atau 15 untuk mengisi sidebar
        $articles = $articleModel->getLatest(15); 

        // 3. Logika Pemisahan Data
        $all_featured = [];
        $remaining_recent = [];

        if (!empty($articles)) {
            // Ambil 3 artikel pertama untuk Kolom Kiri (1 Utama + 2 Sorotan)
            $all_featured = array_slice($articles, 0, 3);
            
            // Sisanya untuk Sidebar kanan
            $remaining_recent = array_slice($articles, 3);
        }

        $data = [
            'title'            => 'Daftar Artikel & Berita',
            'all_featured'     => $all_featured,
            'remaining_recent' => $remaining_recent
        ];
        
        $this->view('pages/artikel/index', $data, true);
    }

    public function detail($slug)
    {
        $articleModel = new Article();
        
        // 1. Ambil data artikel berdasarkan SLUG
        $article = $articleModel->getBySlug($slug);

        // 2. Cek jika artikel tidak ditemukan (404)
        if (!$article) {
            // Opsional: Tampilkan view 404 khusus
            // $this->view('errors/404'); 
            // Atau redirect:
            header('Location: ' . $_ENV['APP_URL'] . '/artikel');
            exit;
        }

        // 3. Siapkan data untuk View
        $data = [
            'title'   => $article['title'], // Untuk <title> di header
            'article' => $article
        ];
        
        // 4. Load View
        $this->view('pages/artikel/detail', $data, true);
    }
}
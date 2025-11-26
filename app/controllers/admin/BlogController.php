<?php
namespace Polinema\WebProfilLabSe\Controllers\Admin;

use Polinema\WebProfilLabSe\Core\Controller;

class BlogController extends Controller
{
    public function __construct()
    {
    }

    // Menampilkan daftar blog
    public function index()
    {
        // Sementara data blog dikosongkan dulu
        $dataBlog = [];

        // Data yang dikirim ke view
        $data = [
            'title'    => 'Blog Artikel',
            'dataBlog' => $dataBlog
        ];

        // Tampilkan halaman index blog
        $this->view('pages/admin/blog/index', $data, true, 'admin');
    }

    // Menampilkan form tambah blog
    public function create()
    {
        $data = [
            'title' => 'Tambah Blog'
        ];

        // Tampilkan halaman form tambah blog
        $this->view('pages/admin/blog/createBlog', $data, true, 'admin');
    }

    // Menampilkan form edit blog
    public function edit()
    {
        // Ambil id dari parameter URL (sementara belum ambil data dari database)
        $id = $_GET['id'] ?? null;

        // Data blog masih dummy, nanti diganti dengan data dari database
        $blog = [
            'id'       => $id,
            'kategori' => '',
            'konten'   => '',
            'gambar'   => ''
        ];

        $data = [
            'title' => 'Edit Blog',
            'blog'  => $blog
        ];

        // Tampilkan halaman form edit blog
        $this->view('pages/admin/blog/editBlog', $data, true, 'admin');
    }

    // Fungsi hapus blog (belum diisi logika hapus)
    public function delete()
    {
        // Nanti diisi proses hapus data blog
    }
}

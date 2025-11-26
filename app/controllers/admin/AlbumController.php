<?php
namespace Polinema\WebProfilLabSe\Controllers\Admin;

use Polinema\WebProfilLabSe\Core\Controller;

class AlbumController extends Controller
{
    // Menampilkan daftar album
    public function index()
    {
        // Sementara data album dikosongkan dulu
        $dataAlbum = [];

        $data = [
            'title'     => 'Album',
            'dataAlbum' => $dataAlbum
        ];

        // View: pages/admin/profile/album/index.php
        $this->view('pages/admin/profile/album/index', $data, true, 'admin');
    }

    // Menampilkan form tambah album
    public function create()
    {
        $data = [
            'title' => 'Tambah Album'
        ];

        // View: pages/admin/profile/album/create.php
        $this->view('pages/admin/profile/album/create', $data, true, 'admin');
    }

    // Menampilkan form edit album
    public function edit()
    {
        $id = $_GET['id'] ?? null;

        // Data dummy, nanti diganti dengan data dari database
        $album = [
            'id'        => $id,
            'judul'     => '',
            'deskripsi' => '',
            'gambar'    => ''
        ];

        $data = [
            'title' => 'Edit Album',
            'album' => $album
        ];

        // View: pages/admin/profile/album/edit.php
        $this->view('pages/admin/profile/album/edit', $data, true, 'admin');
    }

    // Fungsi hapus album (kosong dulu)
    public function delete()
    {
        // Nanti diisi proses hapus data album
    }
}

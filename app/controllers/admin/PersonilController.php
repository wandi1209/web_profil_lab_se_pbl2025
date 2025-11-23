<?php

namespace Polinema\WebProfilLabSe\Controllers\Admin;

use Polinema\WebProfilLabSe\Core\Controller;

class PersonilController extends Controller
{
    private $jsonFile;

    public function __construct()
    {
        // File penyimpanan sementara tanpa DB
        $this->jsonFile = __DIR__ . "/../../../storage/dosen.json";

        // Kalau file belum ada → buat baru
        if (!file_exists($this->jsonFile)) {
            file_put_contents($this->jsonFile, json_encode([]));
        }
    }

    // Ambil semua data dari file JSON
    private function getData()
    {
        return json_decode(file_get_contents($this->jsonFile), true);
    }

    // Simpan data ke JSON
    private function saveData($data)
    {
        file_put_contents($this->jsonFile, json_encode($data, JSON_PRETTY_PRINT));
    }

    // LIST DATA DOSEN
    public function dosen()
    {
        $dataDosen = $this->getData();

        $this->view('pages/admin/personil/dosen', [
            'title' => 'Data Dosen',
            'dataDosen' => $dataDosen
        ], true, 'admin');
    }

    // PAGE CREATE
    public function createDosen()
    {
        $this->view('pages/admin/personil/createDosen', [
            'title' => 'Tambah Dosen'
        ], true, 'admin');
    }

    // STORE
    public function storeDosen()
    {
        $kategori = $_POST['kategori'];
        $konten   = $_POST['konten'];

        $gambar = null;

        if (!empty($_FILES['gambar']['name'])) {

            $allowed = ['jpg','jpeg','png','webp'];
            $ext = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));

            if (!in_array($ext, $allowed)) {
                die("Format file tidak didukung.");
            }

            $namaFile = time() . "_" . uniqid() . "." . $ext;

            $path = __DIR__ . "/../../../public/uploads/dosen/";

            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }

            move_uploaded_file($_FILES['gambar']['tmp_name'], $path . $namaFile);

            $gambar = $namaFile;
        }

        $data = $this->getData();

        $data[] = [
            'id' => time(),
            'kategori' => $kategori,
            'konten' => $konten,
            'gambar' => $gambar
        ];

        $this->saveData($data);

        header("Location: /admin/personil/dosen");
        exit;
    }

    // PAGE EDIT
    public function editDosen()
    {
        if (!isset($_GET['id'])) die("ID tidak ditemukan.");

        $id = $_GET['id'];
        $data = $this->getData();

        $dosen = null;
        foreach ($data as $item) {
            if ($item['id'] == $id) {
                $dosen = $item;
                break;
            }
        }

        if (!$dosen) die("Data tidak ditemukan.");

        $this->view('pages/admin/personil/editDosen', [
            'title' => 'Edit Dosen',
            'dosen' => $dosen
        ], true, 'admin');
    }

    // UPDATE
    public function updateDosen()
    {
        $id = $_POST['id'];
        $kategori = $_POST['kategori'];
        $konten   = $_POST['konten'];

        $data = $this->getData();

        foreach ($data as &$item) {
            if ($item['id'] == $id) {

                $gambarLama = $item['gambar'];
                $gambarBaru = $gambarLama;

                if (!empty($_FILES['gambar']['name'])) {

                    $extValid = ['jpg','jpeg','png','webp'];
                    $ext = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));
                    if (!in_array($ext, $extValid)) die("Format file tidak didukung.");

                    $namaFile = time() . "_" . uniqid() . "." . $ext;
                    $uploadPath = __DIR__ . "/../../../public/uploads/dosen/";

                    move_uploaded_file($_FILES['gambar']['tmp_name'], $uploadPath . $namaFile);

                    // Hapus gambar lama
                    if (!empty($gambarLama) && file_exists($uploadPath . $gambarLama)) {
                        unlink($uploadPath . $gambarLama);
                    }

                    $gambarBaru = $namaFile;
                }

                $item['kategori'] = $kategori;
                $item['konten'] = $konten;
                $item['gambar'] = $gambarBaru;
            }
        }

        $this->saveData($data);

        header("Location: /admin/personil/dosen");
        exit;
    }

    // DELETE
    public function deleteDosen()
    {
        if (!isset($_GET['id'])) die("ID tidak ditemukan.");

        $id = $_GET['id'];
        $data = $this->getData();
        $newData = [];

        foreach ($data as $item) {
            if ($item['id'] != $id) {
                $newData[] = $item;
            } else {
                // hapus gambar
                if (!empty($item['gambar'])) {
                    $path = __DIR__ . "/../../../public/uploads/dosen/" . $item['gambar'];
                    if (file_exists($path)) unlink($path);
                }
            }
        }

        $this->saveData($newData);

        header("Location: /admin/personil/dosen");
        exit;
    }
}
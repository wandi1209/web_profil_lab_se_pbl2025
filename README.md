# Web Profil Laboratorium RPL - Politeknik Negeri Malang

Proyek ini adalah sistem profil lab untuk Laboratorium Rekayasa Perangkat Lunak (RPL) di Politeknik Negeri Malang. Proyek ini dibangun *from scratch* (native) menggunakan PHP murni dengan menerapkan arsitektur MVC (Model-View-Controller) dan *routing* deklaratif yang terinspirasi oleh Laravel.



---

## 🚀 Fitur Utama

* **Arsitektur MVC Kustom:** Dibangun dari nol untuk memisahkan logika (`Model`), tampilan (`View`), dan kontrol alur (`Controller`).
* **Router Deklaratif:** Menggunakan sistem *routing* "ala Laravel" yang didefinisikan dalam `app/routes.php`, mendukung:
    * Rute `GET`, `POST`, `PUT`, dan `DELETE`.
    * *Method Spoofing* (menggunakan input `_method`) untuk `PUT` & `DELETE`.
    * Penanganan halaman 404 kustom.
* **Manajemen Konfigurasi:** Menggunakan file `.env` (via `vlucas/phpdotenv`) untuk mengelola semua variabel lingkungan (database, URL aplikasi) dengan aman.
* **Autoloading PSR-4:** Dikelola oleh Composer untuk memuat semua *class* (`Core`, `Controller`, `Model`) secara otomatis tanpa `require_once`.
* **Koneksi Database (Singleton):** Menggunakan *Singleton Pattern* untuk koneksi database (PDO) agar efisien dan terhubung ke **PostgreSQL**.
* **Frontend:** Menggunakan **Bootstrap 5** untuk desain yang responsif.

---

## 🛠️ Teknologi yang Digunakan

* **Backend:** PHP 8.x (Native)
* **Database:** PostgreSQL
* **Dependency Manager:** Composer
* **Frontend:** HTML, Bootstrap 5, CSS, JS
* **Web Server:** Apache (via MAMP/XAMPP/Laragon)

---

## 🏁 Getting Started (Cara Menjalankan Proyek)

Berikut adalah langkah-langkah untuk menginstal dan menjalankan proyek ini di lingkungan lokal Anda.

### 1. Prasyarat

* **PHP** (disarankan 8.1+)
* **Web Server Lokal** (seperti **XAMPP**, **MAMP**, atau **Laragon**) yang menjalankan **Apache**. Pastikan tidak menjalankan Nginx.
* **PostgreSQL** (pastikan *driver* `pdo_pgsql` aktif di `php.ini` Anda)
* **Composer** (terinstal secara global)

### 2. Instalasi Lokal

1.  **Clone repositori ini:**
    ```bash
    git clone https://[URL_GIT_ANDA]/web_profil_lab_se.git
    cd web_profil_lab_se
    ```
    (Jika menggunakan Laragon, *clone* langsung ke dalam folder `C:/laragon/www/`)

2.  **Install dependensi Composer:**
    (Perintah ini akan mengunduh `vlucas/phpdotenv` dan membuat folder `vendor/`)
    ```bash
    composer install
    ```

3.  **Buat file konfigurasi `.env`:**
    Salin file `.env.example` (jika Anda membuatnya) atau buat file `.env` baru di *root* proyek.

    * Di Windows (Command Prompt):
        ```cmd
        copy .env.example .env
        ```
    * Di macOS/Linux (Terminal):
        ```bash
        cp .env.example .env
        ```

4.  **Konfigurasi `.env`:**
    Buka file `.env` dan isi dengan konfigurasi database PostgreSQL Anda. Pastikan `APP_URL` sesuai dengan URL lokal Anda.

    ```env
    # Contoh untuk XAMPP/MAMP (dalam sub-folder)
    APP_URL="http://localhost/web_profil_lab_se"
    
    # Contoh untuk Laragon (dengan Virtual Host)
    # APP_URL="http://web_profil_lab_se.test"

    DB_HOST="localhost"
    DB_PORT="5432"
    DB_NAME="nama_database_profil_lab"
    DB_USER="postgres"
    DB_PASS="password_anda"
    ```

5.  **Siapkan Database:**
    Buka pgAdmin atau `psql` dan buat database (`nama_database_profil_lab`) sesuai dengan yang Anda tulis di `.env`. Jalankan migrasi atau impor tabel SQL Anda.

### 3. Konfigurasi Web Server Apache (Sangat Penting)

Proyek ini tidak menggunakan folder `/public` dan sangat bergantung pada file `.htaccess` untuk *routing*. Anda harus mengaktifkan `mod_rewrite` dan `AllowOverride` di Apache.

#### Jika Anda menggunakan XAMPP (Windows/Linux/macOS):

1.  **Aktifkan `mod_rewrite`:**
    * Buka **XAMPP Control Panel**, klik "Config" di baris Apache, lalu pilih `httpd.conf`.
    * Cari (Ctrl+F) baris: `#LoadModule rewrite_module modules/mod_rewrite.so`
    * **Hapus tanda pagar (`#`)** di depannya.

2.  **Izinkan `.htaccess`:**
    * Di file `httpd.conf` yang sama, cari blok `<Directory ...>` yang menunjuk ke folder `htdocs` Anda (misal: `<Directory "C:/xampp/htdocs">`).
    * Di dalam blok itu, ubah baris `AllowOverride None` menjadi **`AllowOverride All`**.

3.  **Restart Apache:**
    * Simpan file `httpd.conf`.
    * **Stop** dan **Start** lagi *service* Apache di XAMPP Control Panel.

#### Jika Anda menggunakan MAMP (macOS):

1.  **Aktifkan `mod_rewrite`:**
    * Buka MAMP, klik `File` > `Edit Template` > `Apache` > `httpd.conf`.
    * Cari baris: `#LoadModule rewrite_module modules/mod_rewrite.so`
    * **Hapus tanda pagar (`#`)** di depannya.

2.  **Izinkan `.htaccess`:**
    * Di file `httpd.conf` yang sama, cari blok `<Directory ...>` yang menunjuk ke `htdocs` MAMP (misal: `<Directory "/Applications/MAMP/htdocs">`).
    * Di dalam blok itu, ubah baris `AllowOverride None` menjadi **`AllowOverride All`**.

3.  **Restart Server:**
    * Simpan file `httpd.conf`.
    * **Stop** dan **Start** lagi server di aplikasi MAMP.

#### Jika Anda menggunakan Laragon (Windows):

Laragon sangat fleksibel. Cara termudah untuk mengonfigurasinya adalah melalui menu.

1.  **Aktifkan `mod_rewrite`:**
    * Klik kanan ikon Laragon di *tray*, pilih `Apache` > `httpd.conf`.
    * Cari (Ctrl+F) baris: `#LoadModule rewrite_module modules/mod_rewrite.so`.
    * **Hapus tanda pagar (`#`)** di depannya (seringkali sudah nonaktif secara *default*).

2.  **Izinkan `.htaccess`:**
    * Di file `httpd.conf` yang sama, cari blok yang menunjuk ke *Document Root* Anda (defaultnya `C:/laragon/www`): `<Directory "C:/laragon/www">`.
    * Di dalam blok itu, ubah baris `AllowOverride None` menjadi **`AllowOverride All`**.

3.  **Restart Apache:**
    * Simpan file `httpd.conf`.
    * Di jendela utama Laragon, klik **"Stop"** lalu **"Start All"**.

### 4. Selesai!
Buka proyek di browser Anda: `http://localhost/web_profil_lab_se` (atau `http://web_profil_lab_se.test` jika pakai Laragon VHost).

---
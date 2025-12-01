<?php 
$pageTitle = "Form Pendaftaran - Laboratorium SE"; 
?>

<section class="py-5" style="background-color: #f8fafc;">
    <div class="container">

        <!-- Bungkus Utama -->
        <div class="mx-auto" style="max-width: 700px;">

            <!-- Card Form -->
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h4 
                    class="fw-semibold mb-3"
                    style="
                        background-color: #0b4e82; 
                        color: white; 
                        padding: 22px 20px;
                        margin: -24px -24px 20px -24px; 
                        border-top-left-radius: 12px;
                        border-top-right-radius: 12px;
                        text-align: center;
                    ">
                    FORM PENDAFTARAN ANGGOTA LABORATORIUM
                </h4>

                <form action="#" method="POST">

                    <!-- NAMA -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama</label>
                        <input type="text" name="nama" class="form-control rounded-3" placeholder="Masukkan Nama">
                    </div>

                    <!-- EMAIL -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control rounded-3" placeholder="Masukkan Email">
                    </div>

                    <!-- NOMOR HP -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nomor HP</label>
                        <input type="text" name="nohp" class="form-control rounded-3" placeholder="Masukkan Nomor HP">
                    </div>

                    <!-- NIM -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">NIM</label>
                        <input type="text" name="nim" class="form-control rounded-3" placeholder="Masukkan NIM">
                    </div>

                    <!-- ANGKATAN -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Angkatan</label>
                        <select name="angkatan" class="form-select rounded-3">
                            <option value="">-- Pilih Angkatan --</option>
                            <option>2021</option>
                            <option>2022</option>
                            <option>2023</option>
                            <option>2024</option>
                            <option>2025</option>
                        </select>
                    </div>

                    <!-- KELAS -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kelas</label>
                        <input type="text" name="kelas" class="form-control rounded-3" placeholder="Masukkan Kelas">
                    </div>

                    <!-- PRODI -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Prodi</label>
                        <select name="prodi" class="form-select rounded-3">
                            <option value="">-- Pilih Prodi --</option>
                            <option>D4 Teknik Informatika</option>
                            <option>D4 Sistem Informasi Bisnis</option>
                            <option>D2 Pengembangan Piranti Lunak Situs</option>
                        </select>
                    </div>

                    <!-- PORTOFOLIO -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Link Portofolio</label>
                        <input type="url" name="portofolio" class="form-control rounded-3" placeholder="Masukkan URL Portofolio (GitHub/Behance/LinkedIn)">
                    </div>

                    <!-- ALASAN -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Alasan</label>
                        <textarea name="alasan" class="form-control rounded-3" rows="4" placeholder="Tuliskan alasan mendaftar..."></textarea>
                    </div>

                    <!-- TOMBOL -->
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill fw-semibold">
                            Kirim Pendaftaran
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</section>
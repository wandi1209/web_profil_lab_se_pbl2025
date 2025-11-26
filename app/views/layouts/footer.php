<footer class="bg-footer-dark pt-5 pb-4 mt-auto">
        <div class="container position-relative" style="z-index: 1;">
            
            <div class="row g-5 mb-5">
                
                <div class="col-lg-5">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <img src="<?= $_ENV['APP_URL'] ?>/assets/icons/lab_se.svg" width="40" alt="Logo Lab SE">
                        <div class="lh-1">
                            <h5 class="mb-0 text-white fw-bold">Laboratorium SE</h5>
                            <small class="text-white-50" style="font-size: 12px;">Politeknik Negeri Malang</small>
                        </div>
                    </div>
                    <p class="small lh-lg mb-4" style="max-width: 400px; color: #94a3b8;">
                        Pusat keunggulan riset dan pengembangan teknologi perangkat lunak. Kami berkomitmen mencetak talenta digital profesional yang siap bersaing di industri 4.0.
                    </p>
                    
                    <div class="d-flex gap-2">
                        <a href="#" class="social-btn-footer ig" title="Instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-btn-footer li" title="LinkedIn"><i class="bi bi-linkedin"></i></a>
                        <a href="#" class="social-btn-footer gh" title="GitHub"><i class="bi bi-github"></i></a>
                        <a href="#" class="social-btn-footer yt" title="YouTube"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h5 class="footer-title">Jelajahi</h5>
                    <ul class="list-unstyled d-flex flex-column gap-3 small">
                        <li><a href="<?= $_ENV['APP_URL'] ?>/index.php" class="footer-link"><i class="bi bi-chevron-right me-1" style="font-size: 10px;"></i> Beranda</a></li>
                        <li><a href="#" class="footer-link"><i class="bi bi-chevron-right me-1" style="font-size: 10px;"></i> Profil Anggota</a></li>
                        <li><a href="#" class="footer-link"><i class="bi bi-chevron-right me-1" style="font-size: 10px;"></i> Riset & Publikasi</a></li>
                        <li><a href="#" class="footer-link"><i class="bi bi-chevron-right me-1" style="font-size: 10px;"></i> Blog Artikel</a></li>
                        <li><a href="#" class="footer-link"><i class="bi bi-chevron-right me-1" style="font-size: 10px;"></i> Fasilitas</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6">
                    <h5 class="footer-title">Hubungi Kami</h5>
                    <ul class="list-unstyled d-flex flex-column gap-3 small" style="color: #94a3b8;">
                        <li class="d-flex gap-3">
                            <i class="bi bi-geo-alt-fill text-primary mt-1"></i>
                            <span>
                                Gedung Sipil Lt. 8, Politeknik Negeri Malang.<br>
                                Jl. Soekarno Hatta No.9, Jatimulyo, Kec. Lowokwaru, Kota Malang, 65141
                            </span>
                        </li>
                        <li class="d-flex gap-3">
                            <i class="bi bi-envelope-fill text-primary mt-1"></i>
                            <span>lab.rpl@polinema.ac.id</span>
                        </li>
                        <li class="d-flex gap-3">
                            <i class="bi bi-telephone-fill text-primary mt-1"></i>
                            <span>(0341) 404424</span>
                        </li>
                    </ul>
                </div>

            </div>

            <div class="border-top border-secondary border-opacity-25 pt-4 d-flex flex-column flex-md-row justify-content-between align-items-center small">
                <p class="mb-2 mb-md-0 text-secondary">
                    &copy; <?= date('Y') ?> Laboratorium Software Engineering. All rights reserved.
                </p>
                <div class="d-flex gap-4">
                    <a href="#" class="footer-link" style="font-size: 12px;">Privacy Policy</a>
                    <a href="#" class="footer-link" style="font-size: 12px;">Terms of Service</a>
                </div>
            </div>

        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
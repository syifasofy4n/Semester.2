<?php
// =============================================
// footer.php - FOOTER dengan Alerts Bootstrap
// =============================================
?>

<footer class="mt-4">
    <!-- Alert info di footer (sesuai tugas: gunakan komponen alerts) -->
    <div class="container mb-2">
        <div class="alert alert-info alert-dismissible fade show d-flex align-items-center" role="alert">
            <i class="bi bi-info-circle-fill me-2 fs-5"></i>
            <div>
                <strong>Informasi:</strong> Website ini dibuat sebagai tugas mata kuliah Pemrograman Web menggunakan
                Bootstrap 5 dan PHP. Semua data yang ditampilkan adalah data asli milik pemilik website.
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>

    <!-- Footer utama -->
    <div class="bg-dark text-white py-4 mt-2">
        <div class="container">
            <div class="row">

                <!-- Kolom 1: Info Singkat -->
                <div class="col-md-4 mb-3">
                    <h6 class="fw-bold"><i class="bi bi-person-badge"></i> MyPortfolio</h6>
                    <p class="text-muted small">
                        Personal home page yang dibuat menggunakan PHP dan Bootstrap.
                        Berisi informasi profil, riwayat pendidikan, dan cara menghubungi saya.
                    </p>
                </div>

                <!-- Kolom 2: Link Cepat -->
                <div class="col-md-4 mb-3">
                    <h6 class="fw-bold">Link Cepat</h6>
                    <ul class="list-unstyled">
                        <li><a href="index.php?page=home" class="text-muted text-decoration-none"><i class="bi bi-chevron-right"></i> Home</a></li>
                        <li><a href="index.php?page=about" class="text-muted text-decoration-none"><i class="bi bi-chevron-right"></i> About Me</a></li>
                        <li><a href="index.php?page=contact" class="text-muted text-decoration-none"><i class="bi bi-chevron-right"></i> Contact Me</a></li>
                        <li><a href="index.php?page=studies" class="text-muted text-decoration-none"><i class="bi bi-chevron-right"></i> My Studies</a></li>
                    </ul>
                </div>

                <!-- Kolom 3: Kontak -->
                <div class="col-md-4 mb-3">
                    <h6 class="fw-bold">Hubungi Saya</h6>
                    <p class="text-muted small">
                        <i class="bi bi-envelope"></i> namaKamu@email.com<br>
                        <i class="bi bi-geo-alt"></i> Jakarta, Indonesia<br>
                        <i class="bi bi-telephone"></i> +62 812 xxxx xxxx
                    </p>
                </div>

            </div>

            <hr class="border-secondary">

            <!-- Copyright -->
            <div class="row">
                <div class="col-md-6 text-muted small">
                    &copy; <?= date('Y') ?> Personal Home Page - Dibuat dengan <i class="bi bi-heart-fill text-danger"></i>
                </div>
                <div class="col-md-6 text-end text-muted small">
                    Powered by Bootstrap 5 &amp; PHP
                </div>
            </div>

        </div>
    </div>
</footer>

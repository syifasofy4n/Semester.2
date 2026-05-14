<?php
// =============================================
// sidebar.php - SIDEBAR dengan List Group
// =============================================
$current_page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>

<!-- Sidebar: Info Singkat -->
<div class="card shadow-sm mb-3">
    <div class="card-body text-center">
        <!-- Foto profil kecil -->
        <img src="uploads/WhatsApp Image 2025-11-20 at 23.02.29.jpeg"
             class="rounded-circle mb-2" width="80" alt="Foto Profil">
        <h6 class="card-title mb-0 fw-bold">Syifa Sakinah Sofyan (sofy)</h6>
        <small class="text-muted">Mahasiswa Informatika</small>
        <hr>
        <small class="text-muted">
            <i class="bi bi-geo-alt"></i> Depok, Indonesia
        </small>
    </div>
</div>

<!-- Sidebar: Navigasi List Group -->
<div class="card shadow-sm mb-3">
    <div class="card-header bg-primary text-white fw-bold">
        <i class="bi bi-grid"></i> Navigasi
    </div>
    <div class="list-group list-group-flush">
        <a href="index.php?page=home"
           class="list-group-item list-group-item-action d-flex align-items-center gap-2 <?= $current_page=='home' ? 'active' : '' ?>">
            <i class="bi bi-house-fill"></i> Home
        </a>
        <a href="index.php?page=about"
           class="list-group-item list-group-item-action d-flex align-items-center gap-2 <?= $current_page=='about' ? 'active' : '' ?>">
            <i class="bi bi-person-fill"></i> About Me
        </a>
        <a href="index.php?page=contact"
           class="list-group-item list-group-item-action d-flex align-items-center gap-2 <?= $current_page=='contact' ? 'active' : '' ?>">
            <i class="bi bi-envelope-fill"></i> Contact Me
        </a>
    </div>
</div>

<!-- Sidebar: My Studies -->
<div class="card shadow-sm mb-3">
    <div class="card-header bg-success text-white fw-bold">
        <i class="bi bi-mortarboard-fill"></i> My Studies
    </div>
    <div class="list-group list-group-flush">
        <a href="index.php?page=level"
           class="list-group-item list-group-item-action d-flex align-items-center gap-2 <?= in_array($current_page, ['level','level_create','level_edit']) ? 'active' : '' ?>">
            <i class="bi bi-list-ol"></i> Level Pendidikan
        </a>
        <a href="index.php?page=studies"
           class="list-group-item list-group-item-action d-flex align-items-center gap-2 <?= in_array($current_page, ['studies','studies_create','studies_edit']) ? 'active' : '' ?>">
            <i class="bi bi-journal-bookmark-fill"></i> Riwayat Studi
        </a>
    </div>
</div>

<!-- Sidebar: Info Login -->
<div class="card shadow-sm">
    <div class="card-body p-2">
        <?php if (isLogin()): ?>
            <div class="text-center">
                <span class="badge bg-success w-100 p-2">
                    <i class="bi bi-shield-check"></i>
                    Login sebagai: <?= htmlspecialchars($_SESSION['user']['nama']) ?>
                </span>
                <a href="logout.php" class="btn btn-sm btn-outline-danger w-100 mt-2">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </div>
        <?php else: ?>
            <div class="text-center">
                <span class="badge bg-secondary w-100 p-2 mb-2">
                    <i class="bi bi-person-x"></i> Belum Login
                </span>
                <a href="index.php?page=login" class="btn btn-sm btn-primary w-100">
                    <i class="bi bi-box-arrow-in-right"></i> Login Sekarang
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

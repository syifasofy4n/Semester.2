<?php
// =============================================
// menu.php - NAVBAR dengan Login/Logout
// =============================================
$current_page = isset($_GET['page']) ? $_GET['page'] : 'home';

function isActive($page, $current) {
    return $page === $current ? 'active' : '';
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">

        <!-- Brand / Logo -->
        <a class="navbar-brand fw-bold" href="index.php">
            <i class="bi bi-person-badge"></i> MyPortfolio
        </a>

        <!-- Tombol hamburger untuk mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Isi Menu -->
        <div class="collapse navbar-collapse" id="navbarMenu">

            <!-- Menu Kiri -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link <?= isActive('home', $current_page) ?>" href="index.php?page=home">
                        <i class="bi bi-house"></i> Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= isActive('about', $current_page) ?>" href="index.php?page=about">
                        <i class="bi bi-person"></i> About Me
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= isActive('contact', $current_page) ?>" href="index.php?page=contact">
                        <i class="bi bi-envelope"></i> Contact Me
                    </a>
                </li>

                <!-- Dropdown My Studies -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= (in_array($current_page, ['level','level_create','level_edit','studies','studies_create','studies_edit'])) ? 'active' : '' ?>"
                       href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-mortarboard"></i> My Studies
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="index.php?page=level">
                                <i class="bi bi-list-ol"></i> Level Pendidikan
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="index.php?page=studies">
                                <i class="bi bi-journal-bookmark"></i> Riwayat Studi
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>

            <!-- Menu Kanan: Login / Nama User -->
            <ul class="navbar-nav">
                <?php if (isLogin()): ?>
                    <!-- Kalau sudah login: tampilkan nama, role, dan tombol logout -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i>
                            <?= htmlspecialchars($_SESSION['user']['nama']) ?>
                            <span class="badge bg-warning text-dark ms-1">
                                <?= htmlspecialchars($_SESSION['user']['role']) ?>
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <span class="dropdown-item-text text-muted small">
                                    Login sebagai: <strong><?= htmlspecialchars($_SESSION['user']['username']) ?></strong>
                                </span>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger" href="logout.php">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php else: ?>
                    <!-- Kalau belum login: tampilkan tombol Login -->
                    <li class="nav-item">
                        <a class="nav-link <?= isActive('login', $current_page) ?>" href="index.php?page=login">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </a>
                    </li>
                <?php endif; ?>
            </ul>

        </div>
    </div>
</nav>

<?php
// =============================================
// index.php - FILE UTAMA (ROUTER)
// Semua halaman dimuat lewat file ini
// =============================================
include 'config.php';

// Tentukan halaman mana yang mau ditampilkan
// Kalau tidak ada ?page=xxx, default ke 'home'
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Daftar halaman yang diizinkan (keamanan)
$allowed_pages = ['home', 'about', 'contact', 'login', 'level', 'level_create', 'level_edit', 'level_delete', 'studies', 'studies_create', 'studies_edit', 'studies_delete'];

if (!in_array($page, $allowed_pages)) {
    $page = 'home';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Home Page</title>

    <!-- Bootstrap 5 dari Bootswatch tema Flatly (bisa ganti di bootswatch.com) -->
    <link rel="stylesheet" href="https://bootswatch.com/5/flatly/bootstrap.min.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .main-wrapper {
            min-height: calc(100vh - 200px);
        }
        .sidebar .list-group-item {
            border-left: 3px solid transparent;
            transition: all 0.2s;
        }
        .sidebar .list-group-item:hover,
        .sidebar .list-group-item.active {
            border-left: 3px solid #2c3e50;
            background-color: #ecf0f1;
            color: #2c3e50;
        }
        .card-hover:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.12);
            transition: all 0.3s;
        }
        .page-content {
            animation: fadeIn 0.3s ease-in;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<!-- ===== HEADER (Carousel) ===== -->
<?php include 'header.php'; ?>

<!-- ===== MENU (Navbar) ===== -->
<?php include 'menu.php'; ?>

<!-- ===== KONTEN UTAMA ===== -->
<div class="container-fluid main-wrapper mt-3 mb-3">
    <div class="container">
        <div class="row">

            <!-- SIDEBAR (3 kolom) -->
            <div class="col-md-3 mb-3">
                <div class="sidebar">
                    <?php include 'sidebar.php'; ?>
                </div>
            </div>

            <!-- MAIN CONTENT (9 kolom) -->
            <div class="col-md-9">
                <div class="page-content">
                    <?php
                    // Tampilkan pesan notifikasi kalau ada
                    if (isset($_GET['msg'])) {
                        $msg = $_GET['msg'];
                        if ($msg === 'login_required') {
                            echo '<div class="alert alert-warning alert-dismissible fade show">
                                    <i class="bi bi-exclamation-triangle"></i> Kamu harus login dulu untuk mengakses halaman tersebut.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                  </div>';
                        } elseif ($msg === 'logout_success') {
                            echo '<div class="alert alert-info alert-dismissible fade show">
                                    <i class="bi bi-check-circle"></i> Berhasil logout. Sampai jumpa!
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                  </div>';
                        } elseif ($msg === 'saved') {
                            echo '<div class="alert alert-success alert-dismissible fade show">
                                    <i class="bi bi-check-circle"></i> Data berhasil disimpan!
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                  </div>';
                        } elseif ($msg === 'deleted') {
                            echo '<div class="alert alert-danger alert-dismissible fade show">
                                    <i class="bi bi-trash"></i> Data berhasil dihapus!
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                  </div>';
                        }
                    }

                    // Load halaman yang sesuai
                    switch ($page) {
                        case 'home':
                            include 'pages/home.php';
                            break;
                        case 'about':
                            include 'pages/about.php';
                            break;
                        case 'contact':
                            include 'pages/contact.php';
                            break;
                        case 'login':
                            include 'pages/login.php';
                            break;
                        case 'level':
                            include 'studies/level/index.php';
                            break;
                        case 'level_create':
                            include 'studies/level/create.php';
                            break;
                        case 'level_edit':
                            include 'studies/level/edit.php';
                            break;
                        case 'level_delete':
                            include 'studies/level/delete.php';
                            break;
                        case 'studies':
                            include 'studies/studies/index.php';
                            break;
                        case 'studies_create':
                            include 'studies/studies/create.php';
                            break;
                        case 'studies_edit':
                            include 'studies/studies/edit.php';
                            break;
                        case 'studies_delete':
                            include 'studies/studies/delete.php';
                            break;
                        default:
                            include 'pages/home.php';
                    }
                    ?>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- ===== FOOTER ===== -->
<?php include 'footer.php'; ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
// =============================================
// config.php - KONEKSI DATABASE
// Letakkan file ini di root folder project
// =============================================

// Mulai session di semua halaman
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Setting koneksi database
$host = "localhost";
$user = "root";
$pass = "";              // Kosong = default XAMPP
$db   = "personal_web";

// Buat koneksi
$conn = mysqli_connect($host, $user, $pass, $db);
mysqli_set_charset($conn, "utf8");

// Cek apakah koneksi berhasil
if (!$conn) {
    die("<div class='alert alert-danger m-3'>
        ❌ Koneksi database gagal! <br>
        Pastikan XAMPP sudah nyala dan database sudah dibuat.<br>
        Error: " . mysqli_connect_error() . "
    </div>");
}

// =============================================
// FUNGSI HELPER
// =============================================

// Cek apakah user sudah login
function isLogin() {
    return isset($_SESSION['user']);
}

// Paksa login - redirect ke halaman login kalau belum login
function requireLogin() {
    if (!isLogin()) {
        header("Location: " . BASE_URL . "?page=login&msg=login_required");
        exit;
    }
}

// Bersihkan input dari karakter berbahaya
function clean($conn, $input) {
    return mysqli_real_escape_string($conn, htmlspecialchars(trim($input)));
}

// Base URL project
define('BASE_URL', 'index.php');
define('UPLOAD_DIR', 'uploads/');
?>

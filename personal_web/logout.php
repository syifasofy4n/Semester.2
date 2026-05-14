<?php
// =============================================
// logout.php - PROSES LOGOUT
// =============================================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Hapus semua data session
session_unset();
session_destroy();

// Redirect ke home dengan pesan logout berhasil
header("Location: index.php?msg=logout_success");
exit;
?>

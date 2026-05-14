<?php
// studies/studies/delete.php - HAPUS STUDIES
requireLogin();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    // Ambil data dulu untuk hapus fotonya juga
    $result = mysqli_query($conn, "SELECT foto_sekolah FROM studies WHERE id = $id LIMIT 1");
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Hapus file foto kalau ada
        if (!empty($row['foto_sekolah']) && file_exists(UPLOAD_DIR . $row['foto_sekolah'])) {
            unlink(UPLOAD_DIR . $row['foto_sekolah']);
        }

        // Hapus data dari database
        mysqli_query($conn, "DELETE FROM studies WHERE id = $id");
    }
}

header("Location: index.php?page=studies&msg=deleted");
exit;
?>

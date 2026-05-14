<?php
// studies/level/delete.php - HAPUS LEVEL
requireLogin();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    // Cek dulu apakah level ini dipakai di tabel studies
    $cek = mysqli_query($conn, "SELECT COUNT(*) as total FROM studies WHERE idlevel = $id");
    $row = mysqli_fetch_assoc($cek);

    if ($row['total'] > 0) {
        // Tidak bisa hapus kalau masih dipakai
        header("Location: index.php?page=level&msg=cant_delete");
        echo '<script>
            alert("Tidak bisa hapus! Level ini masih digunakan di data Studies.");
            window.location = "index.php?page=level";
        </script>';
        exit;
    }

    mysqli_query($conn, "DELETE FROM level WHERE id = $id");
}

header("Location: index.php?page=level&msg=deleted");
exit;
?>

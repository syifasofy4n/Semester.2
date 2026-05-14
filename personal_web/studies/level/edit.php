<?php

requireLogin();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$error = '';

// Cari data yang mau diedit
$result = mysqli_query($conn, "SELECT * FROM level WHERE id = $id LIMIT 1");
if (!$result || mysqli_num_rows($result) === 0) {
    echo '<div class="alert alert-danger">Data tidak ditemukan!</div>';
    echo '<a href="index.php?page=level" class="btn btn-secondary">Kembali</a>';
    return;
}
$level = mysqli_fetch_assoc($result);

// Proses update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = clean($conn, $_POST['nama'] ?? '');

    if (empty($nama)) {
        $error = "Nama level wajib diisi!";
    } else {
        $query = "UPDATE level SET nama = '$nama' WHERE id = $id";
        if (mysqli_query($conn, $query)) {
            header("Location: index.php?page=level&msg=saved");
            exit;
        } else {
            $error = "Gagal update: " . mysqli_error($conn);
        }
    }
}
?>

<div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
    <h4 class="mb-0"><i class="bi bi-pencil"></i> Edit Level Pendidikan</h4>
    <a href="index.php?page=level" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<?php if ($error): ?>
    <div class="alert alert-danger"><i class="bi bi-x-circle"></i> <?= $error ?></div>
<?php endif; ?>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="index.php?page=level_edit&id=<?= $id ?>">
            <div class="mb-3">
                <label class="form-label fw-bold">Nama Level <span class="text-danger">*</span></label>
                <input type="text"
                       name="nama"
                       class="form-control"
                       value="<?= htmlspecialchars(isset($_POST['nama']) ? $_POST['nama'] : $level['nama']) ?>"
                       required>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning">
                    <i class="bi bi-save"></i> Update
                </button>
                <a href="index.php?page=level" class="btn btn-secondary">
                    <i class="bi bi-x"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>

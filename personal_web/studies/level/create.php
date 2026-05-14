<?php
// studies/level/create.php - TAMBAH LEVEL
requireLogin();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = clean($conn, $_POST['nama'] ?? '');

    if (empty($nama)) {
        $error = "Nama level wajib diisi!";
    } else {
        $query = "INSERT INTO level (nama) VALUES ('$nama')";
        if (mysqli_query($conn, $query)) {
            header("Location: index.php?page=level&msg=saved");
            exit;
        } else {
            $error = "Gagal menyimpan: " . mysqli_error($conn);
        }
    }
}
?>

<div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
    <h4 class="mb-0"><i class="bi bi-plus-circle"></i> Tambah Level Pendidikan</h4>
    <a href="index.php?page=level" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<?php if ($error): ?>
    <div class="alert alert-danger"><i class="bi bi-x-circle"></i> <?= $error ?></div>
<?php endif; ?>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="index.php?page=level_create">
            <div class="mb-3">
                <label class="form-label fw-bold">Nama Level <span class="text-danger">*</span></label>
                <input type="text"
                       name="nama"
                       class="form-control"
                       placeholder="contoh: TK, SD, SMP, SMA, S1 ..."
                       value="<?= isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : '' ?>"
                       required>
                <div class="form-text">Isi nama jenjang pendidikan</div>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save"></i> Simpan
                </button>
                <a href="index.php?page=level" class="btn btn-secondary">
                    <i class="bi bi-x"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>

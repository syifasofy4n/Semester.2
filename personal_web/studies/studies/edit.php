<?php
// =============================================
// studies/studies/edit.php - EDIT STUDIES
// =============================================
requireLogin();

$id    = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$error = '';

// Ambil data yang mau diedit
$result = mysqli_query($conn, "SELECT * FROM studies WHERE id = $id LIMIT 1");
if (!$result || mysqli_num_rows($result) === 0) {
    echo '<div class="alert alert-danger">Data tidak ditemukan!</div>';
    echo '<a href="index.php?page=studies" class="btn btn-secondary">Kembali</a>';
    return;
}
$study = mysqli_fetch_assoc($result);

// Ambil daftar level untuk dropdown
$levels = mysqli_query($conn, "SELECT * FROM level ORDER BY id ASC");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama        = clean($conn, $_POST['nama'] ?? '');
    $idlevel     = (int)($_POST['idlevel'] ?? 0);
    $keterangan  = clean($conn, $_POST['keterangan'] ?? '');
    $tahun_lulus = clean($conn, $_POST['tahun_lulus'] ?? '');

    if (empty($nama) || $idlevel === 0) {
        $error = "Nama dan level wajib diisi!";
    } else {
        $foto_sekolah = $study['foto_sekolah']; // default: foto lama

        // Kalau ada upload foto baru
        if (!empty($_FILES['foto_sekolah']['name'])) {
            $file    = $_FILES['foto_sekolah'];
            $ext     = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

            if (!in_array($ext, $allowed)) {
                $error = "Format foto tidak didukung!";
            } elseif ($file['size'] > 2 * 1024 * 1024) {
                $error = "Ukuran foto maksimal 2MB!";
            } else {
                $nama_baru = 'school_' . time() . '_' . rand(100, 999) . '.' . $ext;
                if (!is_dir(UPLOAD_DIR)) mkdir(UPLOAD_DIR, 0755, true);

                if (move_uploaded_file($file['tmp_name'], UPLOAD_DIR . $nama_baru)) {
                    // Hapus foto lama kalau ada
                    if (!empty($foto_sekolah) && file_exists(UPLOAD_DIR . $foto_sekolah)) {
                        unlink(UPLOAD_DIR . $foto_sekolah);
                    }
                    $foto_sekolah = $nama_baru;
                } else {
                    $error = "Gagal upload foto baru!";
                }
            }
        }

        // Hapus foto lama kalau user centang "hapus foto"
        if (isset($_POST['hapus_foto']) && !empty($foto_sekolah)) {
            if (file_exists(UPLOAD_DIR . $foto_sekolah)) {
                unlink(UPLOAD_DIR . $foto_sekolah);
            }
            $foto_sekolah = '';
        }

        if (empty($error)) {
            $query = "UPDATE studies SET
                        nama = '$nama',
                        idlevel = $idlevel,
                        keterangan = '$keterangan',
                        tahun_lulus = '$tahun_lulus',
                        foto_sekolah = '$foto_sekolah'
                      WHERE id = $id";
            if (mysqli_query($conn, $query)) {
                header("Location: index.php?page=studies&msg=saved");
                exit;
            } else {
                $error = "Gagal update: " . mysqli_error($conn);
            }
        }
    }
}
?>

<div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
    <h4 class="mb-0"><i class="bi bi-pencil"></i> Edit Riwayat Studi</h4>
    <a href="index.php?page=studies" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<?php if ($error): ?>
    <div class="alert alert-danger"><i class="bi bi-x-circle"></i> <?= $error ?></div>
<?php endif; ?>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="index.php?page=studies_edit&id=<?= $id ?>" enctype="multipart/form-data">

            <div class="row">
                <div class="col-md-8 mb-3">
                    <label class="form-label fw-bold">Nama Sekolah <span class="text-danger">*</span></label>
                    <input type="text" name="nama" class="form-control"
                           value="<?= htmlspecialchars(isset($_POST['nama']) ? $_POST['nama'] : $study['nama']) ?>"
                           required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">Level <span class="text-danger">*</span></label>
                    <select name="idlevel" class="form-select" required>
                        <option value="">-- Pilih Level --</option>
                        <?php
                        mysqli_data_seek($levels, 0);
                        while ($lv = mysqli_fetch_assoc($levels)):
                            $sel = ($lv['id'] == (isset($_POST['idlevel']) ? $_POST['idlevel'] : $study['idlevel'])) ? 'selected' : '';
                        ?>
                        <option value="<?= $lv['id'] ?>" <?= $sel ?>><?= htmlspecialchars($lv['nama']) ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="3"><?= htmlspecialchars(isset($_POST['keterangan']) ? $_POST['keterangan'] : $study['keterangan']) ?></textarea>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">Tahun Lulus</label>
                    <input type="number" name="tahun_lulus" class="form-control"
                           min="1990" max="<?= date('Y') + 5 ?>"
                           value="<?= htmlspecialchars(isset($_POST['tahun_lulus']) ? $_POST['tahun_lulus'] : $study['tahun_lulus']) ?>">
                </div>

                <div class="col-md-8 mb-3">
                    <label class="form-label fw-bold">Foto Sekolah</label>
                    <?php if (!empty($study['foto_sekolah']) && file_exists(UPLOAD_DIR . $study['foto_sekolah'])): ?>
                        <div class="mb-2">
                            <img src="<?= UPLOAD_DIR . htmlspecialchars($study['foto_sekolah']) ?>"
                                 class="rounded" style="max-height:80px; max-width:150px; object-fit:cover;">
                            <div class="form-check mt-1">
                                <input class="form-check-input" type="checkbox" name="hapus_foto" id="hapusFoto">
                                <label class="form-check-label text-danger small" for="hapusFoto">
                                    Hapus foto ini
                                </label>
                            </div>
                        </div>
                    <?php endif; ?>
                    <input type="file" name="foto_sekolah" class="form-control" accept="image/*"
                           onchange="previewFoto(this)">
                    <div class="form-text">Kosongkan jika tidak ingin mengganti foto</div>
                    <img id="fotoPreview" src="" class="mt-2 rounded d-none"
                         style="max-height:80px; max-width:150px; object-fit:cover;">
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning">
                    <i class="bi bi-save"></i> Update
                </button>
                <a href="index.php?page=studies" class="btn btn-secondary">
                    <i class="bi bi-x"></i> Batal
                </a>
            </div>

        </form>
    </div>
</div>

<script>
function previewFoto(input) {
    const preview = document.getElementById('fotoPreview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.classList.remove('d-none');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

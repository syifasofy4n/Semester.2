<?php
// =============================================
// studies/studies/create.php - TAMBAH STUDIES
// =============================================
requireLogin();

$error = '';

// Ambil data level untuk dropdown
$levels = mysqli_query($conn, "SELECT * FROM level ORDER BY id ASC");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama         = clean($conn, $_POST['nama'] ?? '');
    $idlevel      = (int)($_POST['idlevel'] ?? 0);
    $keterangan   = clean($conn, $_POST['keterangan'] ?? '');
    $tahun_lulus  = clean($conn, $_POST['tahun_lulus'] ?? '');

    if (empty($nama) || $idlevel === 0) {
        $error = "Nama sekolah dan level wajib diisi!";
    } else {
        // Proses upload foto
        $foto_sekolah = '';
        if (!empty($_FILES['foto_sekolah']['name'])) {
            $file      = $_FILES['foto_sekolah'];
            $ext       = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $allowed   = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

            if (!in_array($ext, $allowed)) {
                $error = "Format foto tidak didukung! Gunakan JPG, PNG, atau GIF.";
            } elseif ($file['size'] > 2 * 1024 * 1024) { // max 2MB
                $error = "Ukuran foto maksimal 2MB!";
            } else {
                // Buat nama file unik agar tidak tertimpa
                $foto_sekolah = 'school_' . time() . '_' . rand(100, 999) . '.' . $ext;

                // Pastikan folder uploads ada
                if (!is_dir(UPLOAD_DIR)) {
                    mkdir(UPLOAD_DIR, 0755, true);
                }

                // Pindahkan file ke folder uploads
                if (!move_uploaded_file($file['tmp_name'], UPLOAD_DIR . $foto_sekolah)) {
                    $error = "Gagal upload foto!";
                    $foto_sekolah = '';
                }
            }
        }

        if (empty($error)) {
            $query = "INSERT INTO studies (nama, idlevel, keterangan, tahun_lulus, foto_sekolah)
                      VALUES ('$nama', $idlevel, '$keterangan', '$tahun_lulus', '$foto_sekolah')";
            if (mysqli_query($conn, $query)) {
                header("Location: index.php?page=studies&msg=saved");
                exit;
            } else {
                $error = "Gagal simpan: " . mysqli_error($conn);
            }
        }
    }
}
?>

<div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
    <h4 class="mb-0"><i class="bi bi-plus-circle"></i> Tambah Riwayat Studi</h4>
    <a href="index.php?page=studies" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<?php if ($error): ?>
    <div class="alert alert-danger"><i class="bi bi-x-circle"></i> <?= $error ?></div>
<?php endif; ?>

<div class="card shadow-sm">
    <div class="card-body">
        <!-- enctype="multipart/form-data" WAJIB untuk upload file! -->
        <form method="POST" action="index.php?page=studies_create" enctype="multipart/form-data">

            <div class="row">
                <div class="col-md-8 mb-3">
                    <label class="form-label fw-bold">Nama Sekolah/Universitas <span class="text-danger">*</span></label>
                    <input type="text"
                           name="nama"
                           class="form-control"
                           placeholder="contoh: SDN 01 Jakarta"
                           value="<?= htmlspecialchars($_POST['nama'] ?? '') ?>"
                           required>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">Level Pendidikan <span class="text-danger">*</span></label>
                    <select name="idlevel" class="form-select" required>
                        <option value="">-- Pilih Level --</option>
                        <?php
                        // Reset pointer result
                        mysqli_data_seek($levels, 0);
                        while ($lv = mysqli_fetch_assoc($levels)):
                        ?>
                        <option value="<?= $lv['id'] ?>"
                            <?= (isset($_POST['idlevel']) && $_POST['idlevel'] == $lv['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($lv['nama']) ?>
                        </option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Keterangan</label>
                <textarea name="keterangan"
                          class="form-control"
                          rows="3"
                          placeholder="Ceritakan tentang sekolah/pengalaman belajar di sini..."><?= htmlspecialchars($_POST['keterangan'] ?? '') ?></textarea>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">Tahun Lulus</label>
                    <input type="number"
                           name="tahun_lulus"
                           class="form-control"
                           placeholder="contoh: 2020"
                           min="1990" max="<?= date('Y') + 5 ?>"
                           value="<?= htmlspecialchars($_POST['tahun_lulus'] ?? '') ?>">
                </div>

                <div class="col-md-8 mb-3">
                    <label class="form-label fw-bold">Foto Sekolah</label>
                    <input type="file"
                           name="foto_sekolah"
                           class="form-control"
                           accept="image/*"
                           onchange="previewFoto(this)">
                    <div class="form-text">Format: JPG, PNG, GIF. Maksimal 2MB</div>
                    <!-- Preview foto sebelum upload -->
                    <img id="fotoPreview" src="" class="mt-2 rounded d-none"
                         style="max-height:100px; max-width:200px; object-fit:cover;">
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save"></i> Simpan
                </button>
                <a href="index.php?page=studies" class="btn btn-secondary">
                    <i class="bi bi-x"></i> Batal
                </a>
            </div>

        </form>
    </div>
</div>

<script>
// Preview foto sebelum diupload
function previewFoto(input) {
    const preview = document.getElementById('fotoPreview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('d-none');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

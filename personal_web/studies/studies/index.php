<?php
// =============================================
// studies/studies/index.php - LIST STUDIES
// =============================================
requireLogin();

// Ambil data studies + nama level (JOIN 2 tabel)
$query = "SELECT s.*, l.nama as nama_level
          FROM studies s
          LEFT JOIN level l ON s.idlevel = l.id
          ORDER BY s.tahun_lulus ASC";
$studies = mysqli_query($conn, $query);
?>

<div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
    <h4 class="mb-0"><i class="bi bi-journal-bookmark-fill"></i> Riwayat Studi</h4>
    <a href="index.php?page=studies_create" class="btn btn-success">
        <i class="bi bi-plus-circle"></i> Tambah Studi
    </a>
</div>

<!-- Tabel Studies -->
<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Sekolah</th>
                        <th>Level</th>
                        <th>Keterangan</th>
                        <th>Tahun Lulus</th>
                        <th>Foto</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    if ($studies && mysqli_num_rows($studies) > 0):
                        while ($row = mysqli_fetch_assoc($studies)):
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td class="fw-bold"><?= htmlspecialchars($row['nama']) ?></td>
                        <td>
                            <span class="badge bg-primary">
                                <?= htmlspecialchars($row['nama_level'] ?? 'N/A') ?>
                            </span>
                        </td>
                        <td>
                            <small><?= htmlspecialchars(substr($row['keterangan'], 0, 60)) ?>
                            <?= strlen($row['keterangan']) > 60 ? '...' : '' ?></small>
                        </td>
                        <td>
                            <?php if ($row['tahun_lulus']): ?>
                                <span class="badge bg-success"><?= $row['tahun_lulus'] ?></span>
                            <?php else: ?>
                                <span class="text-muted small">-</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if (!empty($row['foto_sekolah']) && file_exists(UPLOAD_DIR . $row['foto_sekolah'])): ?>
                                <img src="<?= UPLOAD_DIR . htmlspecialchars($row['foto_sekolah']) ?>"
                                     class="rounded" width="50" height="50"
                                     style="object-fit:cover;"
                                     alt="Foto">
                            <?php else: ?>
                                <span class="text-muted small"><i class="bi bi-image"></i> -</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <a href="index.php?page=studies_edit&id=<?= $row['id'] ?>"
                               class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="index.php?page=studies_delete&id=<?= $row['id'] ?>"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Hapus data <?= htmlspecialchars($row['nama']) ?>?')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php
                        endwhile;
                    else:
                    ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            <i class="bi bi-inbox fs-3"></i><br>
                            Belum ada data studi. <a href="index.php?page=studies_create">Tambah sekarang</a>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

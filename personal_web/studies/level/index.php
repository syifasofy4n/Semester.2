<?php
// =============================================
// studies/level/index.php - LIST LEVEL
// =============================================

// Wajib login untuk akses CRUD
requireLogin();

// Ambil semua data level
$levels = mysqli_query($conn, "SELECT * FROM level ORDER BY id ASC");
?>

<div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
    <h4 class="mb-0"><i class="bi bi-list-ol"></i> Level Pendidikan</h4>
    <a href="index.php?page=level_create" class="btn btn-success">
        <i class="bi bi-plus-circle"></i> Tambah Level
    </a>
</div>

<!-- Tabel Data Level -->
<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover table-striped mb-0">
            <thead class="table-dark">
                <tr>
                    <th width="60">No</th>
                    <th>ID</th>
                    <th>Nama Level</th>
                    <th width="150" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                if ($levels && mysqli_num_rows($levels) > 0):
                    while ($row = mysqli_fetch_assoc($levels)):
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><span class="badge bg-secondary"><?= $row['id'] ?></span></td>
                    <td><?= htmlspecialchars($row['nama']) ?></td>
                    <td class="text-center">
                        <a href="index.php?page=level_edit&id=<?= $row['id'] ?>"
                           class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <a href="index.php?page=level_delete&id=<?= $row['id'] ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Yakin mau hapus level <?= htmlspecialchars($row['nama']) ?>?')">
                            <i class="bi bi-trash"></i> Hapus
                        </a>
                    </td>
                </tr>
                <?php
                    endwhile;
                else:
                ?>
                <tr>
                    <td colspan="4" class="text-center text-muted py-4">
                        <i class="bi bi-inbox fs-3"></i><br>
                        Belum ada data level. <a href="index.php?page=level_create">Tambah sekarang</a>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    <a href="index.php?page=studies" class="btn btn-outline-primary btn-sm">
        <i class="bi bi-arrow-right"></i> Lihat Data Studies
    </a>
</div>

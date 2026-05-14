<?php
?>

<h4 class="mb-3 border-bottom pb-2">
    <i class="bi bi-person-lines-fill"></i> About Me
</h4>

<!-- Accordion Bootstrap (sesuai tugas) -->
<div class="accordion shadow-sm" id="accordionAbout">

    <!-- Accordion 1: Hobby -->
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseHobby">
                <i class="bi bi-controller me-2 text-primary"></i> Hobby & Minat
            </button>
        </h2>
        <div id="collapseHobby" class="accordion-collapse collapse show" data-bs-parent="#accordionAbout">
            <div class="accordion-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex align-items-start mb-3">
                            <div class="bg-primary text-white rounded p-2 me-3">
                                <i class="bi bi-controller fs-4"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Gaming</h6>
                                <p class="text-muted small mb-0">Suka main game minecraft,duolingo,tebak gambar</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start mb-3">
                            <div class="bg-success text-white rounded p-2 me-3">
                                <i class="bi bi-camera fs-4"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Fotografi</h6>
                                <p class="text-muted small mb-0">Suka mengabadikan momen lewat kamera smartphone</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-start mb-3">
                            <div class="bg-warning text-white rounded p-2 me-3">
                                <i class="bi bi-book fs-4"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Membaca</h6>
                                <p class="text-muted small mb-0">Suka baca buku, novel, dan artikel online</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start mb-3">
                            <div class="bg-info text-white rounded p-2 me-3">
                                <i class="bi bi-code-slash fs-4"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Coding</h6>
                                <p class="text-muted small mb-0">Membuat project web dan aplikasi kecil di waktu luang</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Accordion 2: Favorite Menu (Makanan Favorit) -->
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFavorite">
                <i class="bi bi-egg-fried me-2 text-warning"></i> Favorite Menu (Makanan & Minuman Favorit)
            </button>
        </h2>
        <div id="collapseFavorite" class="accordion-collapse collapse" data-bs-parent="#accordionAbout">
            <div class="accordion-body">
                <div class="row row-cols-2 row-cols-md-4 g-3">

                    <!-- Item makanan favorit -->
                    <?php
                    $foods = [
                        ['icon' => '🍜', 'nama' => 'Mie Goreng', 'desc' => 'Sarapan favorit setiap hari'],
                        ['icon' => '🍗', 'nama' => 'Ayam Bakar', 'desc' => 'Dengan sambal matah'],
                        ['icon' => '🧋', 'nama' => 'Boba Tea', 'desc' => 'Minuman wajib setiap keluar'],
                        ['icon' => '🍕', 'nama' => 'Pizza', 'desc' => 'Kalau lagi lapar banget'],
                        ['icon' => '☕', 'nama' => 'Kopi', 'desc' => 'Teman begadang ngoding'],
                        ['icon' => '🍦', 'nama' => 'Es Krim', 'desc' => 'Pencuci mulut terbaik'],
                    
                    ];
                    foreach ($foods as $food): ?>
                    <div class="col">
                        <div class="card text-center h-100 card-hover">
                            <div class="card-body p-2">
                                <div class="fs-2 mb-1"><?= $food['icon'] ?></div>
                                <h6 class="card-title small fw-bold mb-1"><?= $food['nama'] ?></h6>
                                <p class="card-text" style="font-size:11px; color:#888;"><?= $food['desc'] ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>

    <!-- Accordion 3: Pengalaman Organisasi -->
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOrg">
                <i class="bi bi-people me-2 text-success"></i> Pengalaman Organisasi
            </button>
        </h2>
        <div id="collapseOrg" class="accordion-collapse collapse" data-bs-parent="#accordionAbout">
            <div class="accordion-body">

                <!-- Timeline organisasi -->
                <?php
                $orgs = [
                    [
                        'tahun' => '2025 - Sekarang',
                        'nama' => 'Anggota Volounter Gensmart Indonesia',
                        'jabatan' => 'Anggota Aktif',
                        'desc' => 'Mengadakan kegiatan sosial,edukasi hingga pelatihan kepemimpinan.',
                        'color' => 'primary'
                    ],
                    [
                        'tahun' => '2024 - 2025',
                        'nama' => 'Bagian Youtrangers',
                        'jabatan' => 'Anggota Aktif',
                        'desc' => 'Mengikuti kegiatan yang diselenggarakan tiap pekanny',
                        'color' => 'success'
                    ],
                    [
                        'tahun' => '2022 - 2024',
                        'nama' => 'OSIS SMA',
                        'jabatan' => 'Ketua keamanan',
                        'desc' => 'Mengorganisir keamanan sekolah.',
                        'color' => 'warning'
                    ],
                    [
                        'tahun' => '2021 - 2022',
                        'nama' => 'Menjadi pasuka khusus (PASUS) kepramukaan',
                        'jabatan' => 'Ketua SDM',
                        'desc' => 'Membuat materi yang akan diselenggarakan tiap minggu nya.',
                        'color' => 'danger'
                    ],
                ];
                foreach ($orgs as $org): ?>

                <div class="d-flex mb-3">
                    <div class="me-3 text-center" style="min-width:80px;">
                        <span class="badge bg-<?= $org['color'] ?> p-2 w-100" style="font-size:10px;">
                            <?= $org['tahun'] ?>
                        </span>
                    </div>
                    <div class="border-start border-<?= $org['color'] ?> border-3 ps-3 flex-grow-1">
                        <h6 class="fw-bold mb-0"><?= $org['nama'] ?></h6>
                        <p class="text-muted small mb-1"><em><?= $org['jabatan'] ?></em></p>
                        <p class="mb-0 small"><?= $org['desc'] ?></p>
                    </div>
                </div>

                <?php endforeach; ?>

            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePrestasi">
                <i class="bi bi-trophy me-2 text-warning"></i> Prestasi & Penghargaan
            </button>
        </h2>
        <div id="collapsePrestasi" class="accordion-collapse collapse" data-bs-parent="#accordionAbout">
            <div class="accordion-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex align-items-center gap-2">
                        <span class="badge bg-warning text-dark">🥇</span>
                        <div>
                            <strong>Juara 1 LCC</strong>
                            <br><small class="text-muted">Tingkat SMA - 2024</small>
                        </div>
                    </li>
                    <li class="list-group-item d-flex align-items-center gap-2">
                        <span class="badge bg-secondary">🥈</span>
                        <div>
                            <strong>Juara 3 LCC</strong>
                            <br><small class="text-muted">Tingkat SMA- 2022</small>
                        </div>
                    </li>
                    <li class="list-group-item d-flex align-items-center gap-2">
                        <span class="badge bg-success">📜</span>
                        <div>
                            <strong>Juara 2 alfiyah</strong>
                            <br><small class="text-muted">Tingkat SMP- 2023</small>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>
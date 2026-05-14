<?php
// =============================================
// header.php - HEADER dengan Carousel Bootstrap
// =============================================
?>
<!-- Carousel Header -->
<div id="carouselHeader" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">

    <!-- Indikator titik-titik di bawah carousel -->
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselHeader" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#carouselHeader" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#carouselHeader" data-bs-slide-to="2"></button>
    </div>

    <!-- Isi slide carousel -->
    <div class="carousel-inner">

        <!-- Slide 1 -->
        <div class="carousel-item active">
            <!-- Ganti URL gambar dengan foto kamu, atau gunakan gambar dari internet -->
            <img src="uploads/pemweb4.jpg" class="d-block w-100" style="height:280px; object-fit:cover;" alt="Banner 1">
            <div class="carousel-caption d-none d-md-block" style="background:rgba(0,0,0,0.4); border-radius:10px; padding:15px;">
                <h3><i class="bi bi-house-heart"></i> Selamat Datang!</h3>
                <p>Di Personal Home Page saya</p>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item">
            <img src="uploads/pemweb2.jpg" class="d-block w-100" style="height:280px; object-fit:cover;" alt="Banner 2">
            <div class="carousel-caption d-none d-md-block" style="background:rgba(0,0,0,0.4); border-radius:10px; padding:15px;">
                <h3><i class="bi bi-person-circle"></i> Kenalan Yuk!</h3>
                <p>Mahasiswa Informatika yang suka coding</p>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item">
            <img src="uploads/pemweb3.webp" class="d-block w-100" style="height:280px; object-fit:cover;" alt="Banner 3">
            <div class="carousel-caption d-none d-md-block" style="background:rgba(0,0,0,0.4); border-radius:10px; padding:15px;">
                <h3><i class="bi bi-mortarboard"></i> Riwayat Pendidikan</h3>
                <p>Lihat perjalanan belajar saya</p>
            </div>
        </div>

    </div>

    <!-- Tombol Previous & Next -->
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselHeader" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselHeader" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
        <span class="visually-hidden">Next</span>
    </button>

</div>

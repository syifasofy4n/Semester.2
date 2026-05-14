-- =============================================
-- DATABASE SETUP - personal_web
-- Jalankan di phpMyAdmin > SQL
-- =============================================

CREATE DATABASE IF NOT EXISTS personal_web;
USE personal_web;

-- Tabel users (untuk login)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','user') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel level pendidikan
CREATE TABLE level (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(50) NOT NULL
);

-- Tabel studies (riwayat pendidikan)
CREATE TABLE studies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    idlevel INT NOT NULL,
    keterangan TEXT,
    tahun_lulus YEAR,
    foto_sekolah VARCHAR(255),
    FOREIGN KEY (idlevel) REFERENCES level(id) ON DELETE CASCADE
);

-- =============================================
-- DATA AWAL
-- =============================================

-- User admin (password: admin123)
INSERT INTO users (nama, username, password, role) VALUES
('Nama Kamu', 'admin', MD5('admin123'), 'admin');

-- Level pendidikan
INSERT INTO level (nama) VALUES
('TK'), ('SD'), ('SMP'), ('SMA'), ('D3'), ('S1'), ('S2'), ('S3');

-- Contoh data studies
INSERT INTO studies (nama, idlevel, keterangan, tahun_lulus, foto_sekolah) VALUES
('TK Harapan Bangsa', 1, 'Taman kanak-kanak pertama yang saya ikuti', 2005, ''),
('SDN 01 Negeri', 2, 'Sekolah dasar dengan banyak kenangan indah', 2011, ''),
('SMPN 1 Kota', 3, 'Mulai belajar organisasi dan kepemimpinan', 2014, ''),
('SMAN 1 Unggulan', 4, 'Aktif di OSIS dan ekstrakurikuler', 2017, ''),
('Universitas Nurul Fikri', 6, 'Jurusan Informatika, IPK 3.8', 2021, '');

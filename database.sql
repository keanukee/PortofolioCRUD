CREATE DATABASE IF NOT EXISTS db_portofolio;
USE db_portofolio;

CREATE TABLE IF NOT EXISTS Portofolio_1094 (
  id INT AUTO_INCREMENT PRIMARY KEY,
  judul VARCHAR(100) NOT NULL,
  deskripsi TEXT,
  gambar VARCHAR(255),
  link VARCHAR(255),
  tanggal DATE
);

INSERT INTO Portofolio_1094 (judul, deskripsi, gambar, link, tanggal) VALUES
('Website Toko Online', 'Aplikasi e-commerce sederhana dengan PHP dan MySQL.', '', '#', '2026-08-10'),
('Aplikasi Absensi', 'Sistem absensi mahasiswa berbasis web.', '', '#', '2026-09-15');

<?php
include 'koneksi.php';
$proyek = mysqli_query($conn, "SELECT * FROM Portofolio_1094 ORDER BY tanggal DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Portofolio - Keanu</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<nav><div class="container">
  <a href="#home" class="logo">Keanu.</a>
  <ul>
    <li><a href="#tentang">Tentang</a></li>
    <li><a href="#pengalaman">Pengalaman</a></li>
    <li><a href="#proyek">Proyek</a></li>
    <li><a href="#kontak">Kontak</a></li>
    <li><a href="admin.php">Admin</a></li>
  </ul>
</div></nav>

<!-- HERO (statis: ganti teks sesuai dirimu) -->
<section class="hero" id="home"><div class="container">
  <div class="foto">N</div>
  <h1>Halo, saya <span>Keanu</span></h1>
  <p>Mahasiswa Teknik Informatika yang tertarik pada pengembangan web dan desain antarmuka.</p>
  <a href="#proyek" class="btn">Lihat Proyek</a>
  <a href="#kontak" class="btn outline">Hubungi Saya</a>
</div></section>

<!-- TENTANG & SKILL (statis) -->
<section id="tentang"><div class="container">
  <h2 class="judul">Tentang <span>Saya</span></h2>
  <div class="tentang">
    <div>
      <p>Saya mahasiswa semester 3 di Politeknik Caltex Riau, jurusan Teknik Informatika. Saya senang membangun aplikasi web yang rapi, fungsional, dan mudah digunakan.</p>
    </div>
    <div class="skills">
      <span>HTML</span><span>CSS</span><span>JavaScript</span><span>PHP</span>
      <span>MySQL</span><span>Git</span><span>Laravel</span><span>UI Design</span>
    </div>
  </div>
</div></section>

<!-- PENGALAMAN (statis) -->
<section id="pengalaman"><div class="container">
  <h2 class="judul">Pendidikan & <span>Pengalaman</span></h2>
  <div class="timeline">
    <div class="item"><small>2025 - Sekarang</small><h3>D4 Teknik Informatika</h3><p>Politeknik Caltex Riau</p></div>
    <div class="item"><small>2025</small><h3>Asisten Praktikum Pemrograman Web</h3><p>Membantu mahasiswa memahami dasar PHP dan MySQL.</p></div>
    <div class="item"><small>2022 - 2025</small><h3>SMA</h3><p>SMA Cendana Rumbai</p></div>
  </div>
</div></section>

<!-- PROYEK (DINAMIS: CRUD tabel Portofolio_1094) -->
<section id="proyek"><div class="container">
  <h2 class="judul">Proyek <span>Saya</span></h2>
  <div class="grid">
    <?php if (mysqli_num_rows($proyek) == 0) { ?>
      <p>Belum ada proyek. Tambahkan lewat halaman <a href="admin.php" style="color:var(--accent)">Admin</a>.</p>
    <?php } ?>
    <?php while ($p = mysqli_fetch_assoc($proyek)) { ?>
      <div class="card">
        <?php if ($p['gambar']) { ?>
          <img src="uploads/<?= htmlspecialchars($p['gambar']) ?>" alt="<?= htmlspecialchars($p['judul']) ?>">
        <?php } else { ?>
          <div class="img">&#128187;</div>
        <?php } ?>
        <div class="isi">
          <h3><?= htmlspecialchars($p['judul']) ?></h3>
          <small><?= date('d M Y', strtotime($p['tanggal'])) ?></small>
          <p><?= nl2br(htmlspecialchars($p['deskripsi'])) ?></p>
          <?php if ($p['link'] && $p['link'] != '#') { ?>
            <a class="btn kecil" href="<?= htmlspecialchars($p['link']) ?>" target="_blank">Lihat Proyek</a>
          <?php } ?>
        </div>
      </div>
    <?php } ?>
  </div>
</div></section>

<!-- KONTAK (statis) -->
<section id="kontak" class="kontak"><div class="container">
  <h2 class="judul">Hubungi <span>Saya</span></h2>
  <p>Email: keanu@email.com</p>
  <p>WhatsApp: 08xx-xxxx-xxxx</p>
  <p>GitHub: github.com/keanukee</p>
</div></section>

<footer>&copy; <?= date('Y') ?> Keanu. All rights reserved.</footer>
</body>
</html>

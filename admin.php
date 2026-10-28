<?php
include 'koneksi.php';
$data = mysqli_query($conn, "SELECT * FROM Portofolio_1094 ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin - Kelola Proyek</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container admin">
  <div class="bar">
    <h2>Kelola <span style="color:var(--accent)">Proyek</span></h2>
    <div>
      <a href="index.php" class="btn kecil outline" style="margin:0 6px 0 0">&larr; Lihat Website</a>
      <a href="form.php" class="btn kecil">+ Tambah Proyek</a>
    </div>
  </div>
  <div style="overflow-x:auto">
  <table>
    <tr><th>No</th><th>Gambar</th><th>Judul</th><th>Tanggal</th><th>Link</th><th>Aksi</th></tr>
    <?php $no = 1; while ($r = mysqli_fetch_assoc($data)) { ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?php if ($r['gambar']) { ?><img src="uploads/<?= htmlspecialchars($r['gambar']) ?>"><?php } else { echo '-'; } ?></td>
      <td><?= htmlspecialchars($r['judul']) ?></td>
      <td><?= $r['tanggal'] ?></td>
      <td><?= htmlspecialchars($r['link']) ?></td>
      <td>
        <a class="btn kecil kuning" href="form.php?id=<?= $r['id'] ?>">Edit</a>
        <form action="hapus.php" method="post" style="display:inline" onsubmit="return confirm('Hapus proyek ini?')">
          <input type="hidden" name="id" value="<?= $r['id'] ?>">
          <button class="btn kecil merah" type="submit">Hapus</button>
        </form>
      </td>
    </tr>
    <?php } ?>
  </table>
  </div>
</div>
</body>
</html>

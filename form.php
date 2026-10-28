<?php
// Satu file untuk Create (tanpa ?id) dan Update (dengan ?id)
include 'koneksi.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$row = ['judul' => '', 'deskripsi' => '', 'gambar' => '', 'link' => '', 'tanggal' => date('Y-m-d')];
$error = '';

if ($id) {
    $res = mysqli_query($conn, "SELECT * FROM Portofolio_1094 WHERE id=$id");
    $row = mysqli_fetch_assoc($res);
    if (!$row) { die("Data tidak ditemukan"); }
}

if (isset($_POST['simpan'])) {
    $judul = trim($_POST['judul']);
    $deskripsi = $_POST['deskripsi'];
    $link = trim($_POST['link']);
    $tanggal = $_POST['tanggal'];
    $namaGambar = $row['gambar'];

    if (!empty($_FILES['gambar']['name'])) {
        $ext = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
            $error = "Format gambar harus jpg, png, gif, atau webp.";
        } elseif ($_FILES['gambar']['size'] > 2 * 1024 * 1024) {
            $error = "Ukuran gambar maksimal 2 MB.";
        } else {
            if ($namaGambar && file_exists("uploads/" . $namaGambar)) {
                unlink("uploads/" . $namaGambar);
            }
            $namaGambar = uniqid() . "." . $ext;
            move_uploaded_file($_FILES['gambar']['tmp_name'], "uploads/" . $namaGambar);
        }
    }

    if (!$error) {
        if ($id) {
            $stmt = mysqli_prepare($conn, "UPDATE Portofolio_1094 SET judul=?, deskripsi=?, gambar=?, link=?, tanggal=? WHERE id=?");
            mysqli_stmt_bind_param($stmt, "sssssi", $judul, $deskripsi, $namaGambar, $link, $tanggal, $id);
        } else {
            $stmt = mysqli_prepare($conn, "INSERT INTO Portofolio_1094 (judul, deskripsi, gambar, link, tanggal) VALUES (?,?,?,?,?)");
            mysqli_stmt_bind_param($stmt, "sssss", $judul, $deskripsi, $namaGambar, $link, $tanggal);
        }
        mysqli_stmt_execute($stmt);
        header("Location: admin.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= $id ? 'Edit' : 'Tambah' ?> Proyek</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container admin">
  <form class="form" method="post" enctype="multipart/form-data">
    <h2><?= $id ? 'Edit' : 'Tambah' ?> Proyek</h2>
    <?php if ($error) { ?><div class="alert"><?= $error ?></div><?php } ?>

    <label>Judul</label>
    <input type="text" name="judul" value="<?= htmlspecialchars($row['judul']) ?>" required>

    <label>Deskripsi</label>
    <textarea name="deskripsi" rows="4"><?= htmlspecialchars($row['deskripsi']) ?></textarea>

    <label>Link Proyek (opsional)</label>
    <input type="text" name="link" value="<?= htmlspecialchars($row['link']) ?>">

    <label>Tanggal</label>
    <input type="date" name="tanggal" value="<?= $row['tanggal'] ?>" required>

    <label>Gambar (maks 2 MB)</label>
    <?php if ($row['gambar']) { ?>
      <img class="preview" src="uploads/<?= htmlspecialchars($row['gambar']) ?>">
    <?php } ?>
    <input type="file" name="gambar" accept="image/*">

    <div class="aksi">
      <button class="btn" type="submit" name="simpan"><?= $id ? 'Update' : 'Simpan' ?></button>
      <a href="admin.php" style="color:var(--muted)">Batal</a>
    </div>
  </form>
</div>
</body>
</html>

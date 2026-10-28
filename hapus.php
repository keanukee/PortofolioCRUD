<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = (int) $_POST['id'];

    $res = mysqli_query($conn, "SELECT gambar FROM Portofolio_1094 WHERE id=$id");
    $row = mysqli_fetch_assoc($res);
    if ($row && $row['gambar'] && file_exists("uploads/" . $row['gambar'])) {
        unlink("uploads/" . $row['gambar']);
    }

    mysqli_query($conn, "DELETE FROM Portofolio_1094 WHERE id=$id");
}
header("Location: admin.php");
exit;

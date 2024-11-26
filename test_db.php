<?php
include 'db_connect.php';
echo $conn->ping() ? "Koneksi Berhasil" : "Koneksi Gagal";
?>
